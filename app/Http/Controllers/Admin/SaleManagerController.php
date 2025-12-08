<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\SaleManager;
use App\Model\ProductQuery;
use App\Model\AdminRole;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleManagerController extends Controller
{

    public function add_new()
    {
        return view('admin-views.sale_employee.add-new');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'email' => 'required|email|unique:sale_managers',
            'password'=>'required',
            'phone'=>'required'

        ], [
            'name.required' => 'Name is required!',
            'password.required' => 'Password is required!',
            'phone.required' => 'Mobile No is required!',
            'email.required' => 'Email id is Required',
            'image.required' => 'Image is Required',

        ]);



        DB::table('sale_managers')->insert([
            'name' => $request->name,
            'mobile' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status'=>1,
            'photo' => ImageManager::upload('admin/', 'png', $request->file('image')),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Toastr::success('Sale Employee added successfully!');
        return redirect()->route('admin.sale.employee.emp-list');
    }

    function list(Request $request)
    {
        $search = $request['search'];
        $key = explode(' ', $request['search']);
        $em = SaleManager::when($search!=null, function($query) use($key){
                        foreach ($key as $value) {
                            $query->where('name', 'like', "%{$value}%")
                                ->orWhere('mobile', 'like', "%{$value}%")
                                ->orWhere('email', 'like', "%{$value}%");
                        }
                    })
                    ->orderby('id','desc')->paginate(Helpers::pagination_limit());

        return view('admin-views.sale_employee.list', compact('em','search'));
    }

    public function edit($id)
    {
        $e = SaleManager::where(['id' => $id])->first();

        return view('admin-views.sale_employee.edit', compact('e'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:sale_managers,email,'.$id,
        ], [
            'name.required' => 'Name is required!',
        ]);


      $e = SaleManager::where(['id' => $id])->first();
        if ($request['password'] == null) {
            $pass = $e['password'];
        } else {
            if (strlen($request['password']) < 7) {
                Toastr::warning('Password length must be 8 character.');
                return back();
            }
            $pass = bcrypt($request['password']);
        }

        if ($request->has('image')) {
            $e['photo'] = ImageManager::update('admin/', $e['image'], 'png', $request->file('image'));
        }

        DB::table('sale_managers')->where(['id' => $id])->update([
            'name' => $request->name,
            'mobile' => $request->phone,
            'email' => $request->email,
            'password' => $pass,
            'photo' => $e['photo'],
            'updated_at' => now(),
        ]);

        Toastr::success('Sale Employee updated successfully!');
        return back();
    }
    // public function status(Request $request)
    // {
    //     $employee = Admin::find($request->id);
    //     $employee->status = $request->status;
    //     $employee->save();

    //     Toastr::success('Employee status updated!');
    //     return back();
    // }
    public function asign_product(Request $request)
    {
        $data=json_decode($request->qid);

        foreach($data as $quid){
        $employee = ProductQuery::find($quid->value);
        $employee->sale_employ_id = $request->employid;
        $employee->status ='2';
        $employee->save();

        }
        //  Toastr::success('Product Asign updated!');
        // return back();
        return response()->json(['success'=>true]);
    }


}
