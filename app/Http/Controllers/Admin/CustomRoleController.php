<?php

namespace App\Http\Controllers\Admin;

use App\CPU\BackEndHelper;
use App\Http\Controllers\Controller;
use App\Model\AdminRole;
use App\Model\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class CustomRoleController extends Controller
{
    public function create(Request $request)
    {
        $search = $request['search'];
        $key = explode(' ', $request['search']);
        $rl = AdminRole::whereNotIn('id', [1])
            ->when($search != null, function ($query) use ($key) {
                foreach ($key as $value) {
                    $query->where('name', 'like', "%{$value}%");
                }
            })->latest()->get();
        return view('admin-views.custom-role.create', compact('rl', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:admin_roles',
        ], [
            'name.required' => 'Role name is required!'
        ]);

        DB::table('admin_roles')->insert([
            'name' => $request->name,
            'module_access' => json_encode($this->scoped_modules($request->input('modules', []))),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Toastr::success('Role added successfully!');
        return back();
    }

    public function edit($id)
    {
        $role = AdminRole::where(['id' => $id])->first(['id', 'name', 'module_access']);
        return view('admin-views.custom-role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Role name is required!'
        ]);

        DB::table('admin_roles')->where(['id' => $id])->update([
            'name' => $request->name,
            'module_access' => json_encode($this->scoped_modules($request->input('modules', []))),
            'status' => 1,
            'updated_at' => now()
        ]);

        Toastr::success('Role updated successfully!');
        return back();
    }

    public function employee_role_status_update(Request $request)
    {
        $admin_role = AdminRole::find($request->id);
        $admin_role->status = $request->status;
        $admin_role->save();

        return response()->json([
            'success' => 1,
        ], 200);

    }


    /**
     * Export product list by excel
     * @param Request $request
     * @param $type
     */
    public function export(Request $request){
        $key = explode(' ', $request['search']);
        $rl = AdminRole::whereNotIn('id', [1])
            ->when($request['search'] != null, function ($query) use ($key) {
                foreach ($key as $value) {
                    $query->where('name', 'like', "%{$value}%");
                }
            })->latest()->get();

        return (new FastExcel($rl))->download('role_list.xlsx');
    }

    public function delete(Request $request)
    {
        // The master admin role must never be removed: `module_permission_check()`
        // relies on it for the super-admin bypass and cannot be re-created by UI.
        if ((int) $request->id === 1) {
            return response()->json(['message' => 'The master admin role cannot be deleted.'], 422);
        }

        $role = AdminRole::find($request->id);
        if (!$role) {
            return response()->json(['message' => 'Role not found.'], 404);
        }

        $role->delete();
        return response()->json();
    }

    /**
     * Modules that may be stored on a role. Keep this list in sync with the
     * checkboxes in resources/views/admin-views/custom-role and with the
     * `module:` route gates in routes/admin.php.
     */
    protected function allowed_modules()
    {
        return [
            'dashboard',
            'order_management',
            'product_management',
            'promotion_management',
            'support_section',
            'report',
            'user_section',
            'system_settings',
            'pos_management',
        ];
    }

    /**
     * Keep only known module names, and never let an admin grant a module it
     * does not hold itself (role.md: prevent users escalating their own role).
     * The master admin (role id 1) is not restricted by this.
     */
    protected function scoped_modules($requested)
    {
        $modules = array_values(array_intersect((array) $requested, $this->allowed_modules()));

        $admin = auth('admin')->user();
        if ($admin && (int) $admin->admin_role_id !== 1) {
            $own = (array) json_decode((string) ($admin->role->module_access ?? ''), true);
            $modules = array_values(array_intersect($modules, $own));
        }

        return $modules;
    }
}
