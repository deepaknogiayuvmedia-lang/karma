<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\CPU\shepping;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function view()
    {
        $data = Admin::where('id', auth('admin')->id())->first();
        return view('admin-views.profile.view', compact('data'));
    }

    public function edit($id)
    {
        $data = Admin::where('id', $id)->first();
        $shop_banner = Helpers::get_business_settings('shop_banner');
        return view('admin-views.profile.edit', compact('data', 'shop_banner'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        if ($request->image) {
            $admin->image = ImageManager::update('admin/', $admin->image, 'png', $request->file('image'));
        }
        $admin->save();
        Toastr::info('Profile updated successfully!');
        return back();
    }

    public function settings_password_update(Request $request)
    {
        $request->validate([
            'password' => 'required|same:confirm_password|min:8',
            'confirm_password' => 'required',
        ]);

        $admin = Admin::find(auth('admin')->id());
        $admin->password = bcrypt($request['password']);
        $admin->save();
        Toastr::success('Admin password updated successfully!');
        return back();
    }

    public function whereHouse(Request $request)
    {
        $admin = Admin::find(auth('admin')->id());
        $warehouseAddress = [
            'address_line1' => $request->address_line1,
            'city'          => $request->city,
            'state'         => $request->state,
            'pincode'       => $request->pincode,
            'phone'         => $request->phone,
            'country'       => 'India',
        ];

        // Prepare data for Delhivery API
        $apiData = [
            'name'            => $admin->name,
            'address'         => $request->address_line1,
            'pin'             => $request->pincode,
            'phone'           => $request->phone,
            'city'            => $request->city,
            'state'           => $request->state,
            'country'         => 'India',
            'email'           => $admin->email,
            'registered_name' => $admin->name,
            'return_address'  => $request->address_line1,
            'return_pin'      => $request->pincode,
            'return_city'     => $request->city,
            'return_state'    => $request->state,
            'return_country'  => 'India',
        ];

        // Call Delhivery API helper (Create if not exists, otherwise update)
        if ($admin->wherehouse) {
            $result = shepping::UpdateWhereHouse($apiData);
            $success_msg = 'Warehouse updated on Delhivery and locally!';
        } else {
            $result = shepping::CreateWhereHouse($apiData);
            $success_msg = 'Warehouse created on Delhivery and saved locally!';
        }

        if ($result['status'] == 'success') {
            $admin->wherehouse = $warehouseAddress; // Auto-cast to JSON by model
            $admin->save();
            Toastr::success($success_msg);
        } else {
            Toastr::error('Delhivery API Error: ' . ($result['message'] ?? 'Unknown error'));
        }

        return back();
    }
}
