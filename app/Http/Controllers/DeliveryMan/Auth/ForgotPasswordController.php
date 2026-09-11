<?php

namespace App\Http\Controllers\DeliveryMan\Auth;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\DeliveryMan;
use App\Model\PasswordReset;
use App\Model\Seller;
use App\Model\Admin;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function forgot_password()
    {
        return view('delivery-man-views.auth.forgot-password');
    }

    public function reset_password_request(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $delivery_man = DeliveryMan::where('phone', $request->phone)->first();

        if (!$delivery_man) {
            return back()->withErrors(\App\CPU\translate('phone_number_not_found'));
        }

        $otp = rand(1000, 9999);

        PasswordReset::where(['user_type' => 'delivery_man', 'identity' => $delivery_man->phone])->delete();
        PasswordReset::insert([
            'identity' => $delivery_man->phone,
            'token' => $otp,
            'user_type' => 'delivery_man',
            'created_at' => now(),
        ]);

        // Send notification to Seller
        if ($delivery_man->seller_id > 0) {
            $seller = Seller::find($delivery_man->seller_id);
            if ($seller) {
                // Send email to seller
                try {
                    $emailData = [
                        'subject' => 'Delivery Man Password Reset Request',
                        'delivery_man_name' => $delivery_man->f_name . ' ' . $delivery_man->l_name,
                        'delivery_man_phone' => $delivery_man->phone,
                        'otp' => $otp,
                        'message' => 'A delivery man has requested a password reset. Please verify and reset the password from your panel.',
                    ];
                    Mail::to($seller->email)->send(new \App\Mail\DeliverymanPasswordResetMail($otp));
                } catch (\Exception $e) {}

                // Send FCM notification to seller
                if ($seller->cm_firebase_token) {
                    Helpers::send_push_notif_to_device($seller->cm_firebase_token, [
                        'title' => 'Delivery Man Password Reset',
                        'body' => $delivery_man->f_name . ' ' . $delivery_man->l_name . ' has requested a password reset.',
                    ]);
                }
            }
        }

        // Send notification to Admin
        $admins = Admin::all();
        foreach ($admins as $admin) {
            try {
                if ($admin->fcm_token) {
                    Helpers::send_push_notif_to_device($admin->fcm_token, [
                        'title' => 'Delivery Man Password Reset',
                        'body' => $delivery_man->f_name . ' ' . $delivery_man->l_name . ' (Phone: ' . $delivery_man->phone . ') has requested a password reset.',
                    ]);
                }
            } catch (\Exception $e) {}
        }

        Toastr::success(\App\CPU\translate('Password reset request sent to your seller/admin. They will contact you soon.'));
        return redirect()->route('delivery-man.auth.login');
    }
}
