<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\MembershipPlan;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class MembershipPlanController extends Controller
{
    public function index()
    {
        $plans = MembershipPlan::latest()->paginate(25);
        return view('admin-views.membership-plan.index', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'duration_type' => 'required|in:day,month,year',
            'user_type' => 'required|in:customer,seller',
        ]);

        $features = $request->features ?? [];
        // Filter out empty features
        $features = array_filter($features, function($value) {
            return !is_null($value) && $value !== '';
        });

        MembershipPlan::create([
            'name' => $request->name,
            'features' => $features,
            'price' => $request->price,
            'duration' => $request->duration,
            'duration_type' => $request->duration_type,
            'user_type' => $request->user_type,
            'status' => 1,
        ]);

        Toastr::success('Membership Plan created successfully!');
        return back();
    }

    public function edit($id)
    {
        $plan = MembershipPlan::findOrFail($id);
        return view('admin-views.membership-plan.edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'duration_type' => 'required|in:day,month,year',
            'user_type' => 'required|in:customer,seller',
        ]);

        $plan = MembershipPlan::findOrFail($id);
        
        $features = $request->features ?? [];
        $features = array_filter($features, function($value) {
            return !is_null($value) && $value !== '';
        });

        $plan->update([
            'name' => $request->name,
            'features' => $features,
            'price' => $request->price,
            'duration' => $request->duration,
            'duration_type' => $request->duration_type,
            'user_type' => $request->user_type,
        ]);

        Toastr::success('Membership Plan updated successfully!');
        return redirect()->route('admin.membership-plan.index');
    }

    public function status_update(Request $request)
    {
        $plan = MembershipPlan::findOrFail($request->id);
        $plan->status = $request->status;
        $plan->save();

        return response()->json(['message' => 'Status updated successfully!']);
    }

    public function destroy($id)
    {
        $plan = MembershipPlan::findOrFail($id);
        $plan->delete();
        Toastr::success('Membership Plan deleted successfully!');
        return back();
    }
}
