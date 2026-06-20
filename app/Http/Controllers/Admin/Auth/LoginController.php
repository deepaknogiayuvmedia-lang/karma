<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use App\CPU\Helpers;
use Illuminate\Support\Facades\Session;
use App\Model\Admin;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function captcha($tmp)
    {

        $phrase = new PhraseBuilder;
        $code = $phrase->build(4);
        $builder = new CaptchaBuilder($code, $phrase);
        $builder->setBackgroundColor(220, 210, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        $builder->build($width = 100, $height = 40, $font = null);
        $phrase = $builder->getPhrase();

        if(Session::has('default_captcha_code')) {
            Session::forget('default_captcha_code');
        }
        Session::put('default_captcha_code', $phrase);
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }

    public function login()
    {
        return view('admin-views.auth.login');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        //recaptcha validation
        $recaptcha = Helpers::get_business_settings('recaptcha');
        if (isset($recaptcha) && $recaptcha['status'] == 1) {
            try {
                $request->validate([
                    'g-recaptcha-response' => [
                        function ($attribute, $value, $fail) {
                            $secret_key = Helpers::get_business_settings('recaptcha')['secret_key'];
                            $response = $value;
                            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $response;
                            $response = \file_get_contents($url);
                            $response = json_decode($response);
                            if (!$response->success) {
                                $fail(\App\CPU\translate('ReCAPTCHA Failed'));
                            }
                        },
                    ],
                ]);
            } catch (\Exception $exception) {
            }
        } else {

            if (strtolower($request->default_captcha_value) != strtolower(Session('default_captcha_code'))) {
                Session::forget('default_captcha_code');
                return back()->withErrors(\App\CPU\translate('Captcha Failed'));
            }

        }
        $admin = Admin::where('email', $request->email)->first();
        if (isset($admin) && $admin->status != 1) {
            return redirect()->back()->withInput($request->only('email', 'remember'))
                ->withErrors(['You are blocked!!, contact with admin.']);
        }

        if (isset($admin) && Hash::check($request->password, $admin->password)) {
            // Generate a 6-digit OTP code
            $otp = rand(100000, 999999);

            // Store verification details in session
            Session::put('admin_otp_verification', [
                'admin_id' => $admin->id,
                'email' => $admin->email,
                'otp' => $otp,
                'remember' => $request->remember,
                'expires_at' => now()->addMinutes(10)->timestamp,
            ]);

            // Try sending email
            try {
                $emailServices_smtp = Helpers::get_business_settings('mail_config');
                if (isset($emailServices_smtp) && $emailServices_smtp['status'] == 0) {
                    $emailServices_smtp = Helpers::get_business_settings('mail_config_sendgrid');
                }

                if (isset($emailServices_smtp) && $emailServices_smtp['status'] == 1) {
                    Mail::to($admin->email)->send(new \App\Mail\EmailVerification($otp));
                }

                Log::info("Admin login OTP sent to {$admin->email}: {$otp}");
            } catch (\Exception $e) {
                Log::error("Failed to send Admin login OTP: " . $e->getMessage());
            }

            Toastr::success(\App\CPU\translate('OTP verification code sent to your email.'));
            return redirect()->route('admin.auth.otp-verification');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))
            ->withErrors(['Credentials does not match.']);
    }

    public function otp_verification()
    {
        if (!Session::has('admin_otp_verification')) {
            return redirect()->route('admin.auth.login');
        }
        return view('admin-views.auth.verify-otp');
    }

    public function otp_verification_submit(Request $request)
    {
        if (!Session::has('admin_otp_verification')) {
            return redirect()->route('admin.auth.login');
        }

        $session_data = Session::get('admin_otp_verification');

        if ($session_data['expires_at'] < time()) {
            Toastr::error(\App\CPU\translate('OTP code has expired. Please request a new one.'));
            return back();
        }

        $otp = $request->otp;
        if (is_array($otp)) {
            $otp = implode('', $otp);
        }

        if ($otp == $session_data['otp']) {
            auth('admin')->loginUsingId($session_data['admin_id'], $session_data['remember']);
            Session::forget('admin_otp_verification');
            Toastr::success(\App\CPU\translate('Welcome to your dashboard!'));
            return redirect()->route('admin.dashboard');
        }

        Toastr::error(\App\CPU\translate('Invalid OTP code. Please try again.'));
        return back();
    }

    public function resend_otp(Request $request)
    {
        if (!Session::has('admin_otp_verification')) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => \App\CPU\translate('Session expired, please login again.')], 403);
            }
            return redirect()->route('admin.auth.login');
        }

        $session_data = Session::get('admin_otp_verification');
        $otp = rand(100000, 999999);

        $session_data['otp'] = $otp;
        $session_data['expires_at'] = now()->addMinutes(10)->timestamp;
        Session::put('admin_otp_verification', $session_data);

        try {
            $emailServices_smtp = Helpers::get_business_settings('mail_config');
            if (isset($emailServices_smtp) && $emailServices_smtp['status'] == 0) {
                $emailServices_smtp = Helpers::get_business_settings('mail_config_sendgrid');
            }

            if (isset($emailServices_smtp) && $emailServices_smtp['status'] == 1) {
                Mail::to($session_data['email'])->send(new \App\Mail\EmailVerification($otp));
            }

            Log::info("Admin login OTP resent to {$session_data['email']}: {$otp}");

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => \App\CPU\translate('OTP verification code has been resent to your email.')
                ]);
            }
        } catch (\Exception $e) {
            Log::error("Failed to resend Admin login OTP: " . $e->getMessage());
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => \App\CPU\translate('OTP regenerated (logged for local dev).')
                ]);
            }
        }

        Toastr::success(\App\CPU\translate('OTP verification code has been resent to your email.'));
        return back();
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.auth.login');
    }
}
