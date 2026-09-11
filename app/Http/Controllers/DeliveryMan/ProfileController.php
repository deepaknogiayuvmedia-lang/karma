<?php

namespace App\Http\Controllers\DeliveryMan;

use App\Http\Controllers\Controller;
use App\Model\DeliveryMan;
use App\CPU\ImageManager;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        $deliveryMan = auth('delivery_man')->user();
        return view('delivery-man-views.profile', compact('deliveryMan'));
    }

    public function update_profile(Request $request)
    {
        $deliveryMan = auth('delivery_man')->user();

        $request->validate([
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'email' => 'required|email|unique:delivery_men,email,' . $deliveryMan->id,
            'phone' => 'required|unique:delivery_men,phone,' . $deliveryMan->id,
            'address' => 'nullable|string',
        ]);

        $deliveryMan->f_name = $request->f_name;
        $deliveryMan->l_name = $request->l_name;
        $deliveryMan->email = $request->email;
        $deliveryMan->phone = $request->phone;
        $deliveryMan->address = $request->address;

        if ($request->hasFile('image')) {
            $deliveryMan->image = ImageManager::update('delivery-man/', $deliveryMan->image ?? 'def.png', 'jpg', $request->file('image'));
        }

        $deliveryMan->save();

        Toastr::success('Profile updated successfully!');
        return back();
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $deliveryMan = auth('delivery_man')->user();

        if (!Hash::check($request->current_password, $deliveryMan->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match']);
        }

        $deliveryMan->password = bcrypt($request->password);
        $deliveryMan->save();

        Toastr::success('Password changed successfully!');
        return back();
    }
}
