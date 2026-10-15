<?php

namespace App\Http\Controllers\Customer\Auth;

use App\CPU\CartManager;
use App\CPU\Helpers;
use App\CPU\SMS_module;
use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use App\Model\PhoneOrEmailVerification;
use App\Model\Wishlist;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Session;
use function App\CPU\translate;

class RegisterController extends Controller
{
    public $login = null;
    public function __construct()
    {
        $this->middleware('guest:customer', ['except' => ['logout']]);
    }

    public function register()
    {
        session()->put('keep_return_url', url()->previous());
        return view('customer-view.auth.register');
    }

    public function social_terms_consent(Request $request)
    {
        $request->validate([
            'terms_accepted' => 'required|accepted',
        ]);

        session([
            'signup_terms_accepted_at' => now()->toDateTimeString(),
            'signup_terms_version' => config('app.terms_version'),
        ]);

        return response()->json(['accepted' => true]);
    }

    public function submit(Request $request)
    {
        $phoneVerification = Helpers::get_business_settings('phone_verification');
        $request->validate([
            'f_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => [$phoneVerification ? 'required' : 'nullable', 'string', 'max:32', 'unique:users,phone'],
            'farm_acres' => 'nullable|numeric|min:0|max:1000000',
            'crops_sown' => 'nullable|string|max:2000',
            'farm_latitude' => 'nullable|numeric|between:-90,90',
            'farm_longitude' => 'nullable|numeric|between:-180,180',
            'farm_location_name' => 'nullable|string|max:255',
            'farm_address' => 'nullable|string|max:1000',
            'terms_accepted' => 'required|accepted',
            'password' => 'required|min:8|same:con_password'
        ], [
            'f_name.required' => 'First name is required',
        ]);

        //recaptcha validation
        $recaptcha = Helpers::get_business_settings('recaptcha');
        if (isset($recaptcha) && $recaptcha['status'] == 1) {
            $request->validate([
                'g-recaptcha-response' => [
                    'required',
                    function ($attribute, $value, $fail) use ($recaptcha) {
                        try {
                            $response = Http::asForm()->timeout(5)->post(
                                'https://www.google.com/recaptcha/api/siteverify',
                                ['secret' => $recaptcha['secret_key'], 'response' => $value]
                            );
                        } catch (ConnectionException $exception) {
                            Log::warning('Registration reCAPTCHA verification unavailable.');
                            $fail(\App\CPU\translate('ReCAPTCHA verification is temporarily unavailable. Please try again.'));
                            return;
                        }

                        $result = $response->json();
                        if (!$response->successful() || !is_array($result) || empty($result['success'])) {
                            $fail(\App\CPU\translate('ReCAPTCHA Failed'));
                        }
                    },
                ],
            ]);
        } else {
            $captchaCode = Session('default_captcha_code');
            $captchaValue = $request->input('default_captcha_value');
            if (!$captchaCode || !is_string($captchaValue) || strtolower($captchaValue) !== strtolower($captchaCode)) {
                Session::forget('default_captcha_code');
                return back()
                    ->withErrors(['default_captcha_value' => \App\CPU\translate('Captcha Failed. Please enter the new captcha shown.')])
                    ->withInput($request->except(['password', 'con_password', 'default_captcha_value']));
            }
            Session::forget('default_captcha_code');
        }

        $user = User::create([
            'f_name' => $request['f_name'],
            'l_name' => $request['l_name'],
            'email' => $request['email'],
            'phone' => $request->input('phone', ''),
            'farm_acres' => $request->input('farm_acres'),
            'crops_sown' => $request->input('crops_sown'),
            'farm_latitude' => $request->input('farm_latitude'),
            'farm_longitude' => $request->input('farm_longitude'),
            'farm_location_name' => $request->input('farm_location_name'),
            'farm_address' => $request->input('farm_address'),
            'terms_accepted_at' => now(),
            'terms_version' => config('app.terms_version'),
            'is_active' => 1,
            'password' => bcrypt($request['password'])
        ]);

        $phone_verification = Helpers::get_business_settings('phone_verification');
        $email_verification = Helpers::get_business_settings('email_verification');
        if ($phone_verification && !$user->is_phone_verified) {
            return redirect(route('customer.auth.check', ['id' => $user->id, 'type' => 'register']));
        }
        if ($email_verification && !$user->is_email_verified) {
            return redirect(route('customer.auth.check', ['id' => $user->id, 'type' => 'register']));
        }

        auth('customer')->login($user);
        $wish_list = Wishlist::whereHas('wishlistProduct', function ($query) {
            return $query;
        })->where('customer_id', $user->id)->pluck('product_id')->toArray();
        session()->put('wish_list', $wish_list);
        CartManager::cart_to_db();

        Toastr::success(translate('registration_success_login_now'));
        return redirect(\App\CPU\Helpers::safe_return_url(session('keep_return_url')));
    }

    public static function check($id, $type = null)
    {
        $user = User::find($id);
        $loginuser = $type;
        

        $token = rand(1000, 9999);
        DB::table('phone_or_email_verifications')->insert([
            'phone_or_email' => $user->email,
            'token' => $token,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $phone_verification = Helpers::get_business_settings('phone_verification');
        $email_verification = Helpers::get_business_settings('email_verification');
        if ($phone_verification && !$user->is_phone_verified) {
            SMS_module::send($user->phone, $token);
            $response = translate('please_check_your_SMS_for_OTP');
            Toastr::success($response);
        }

        if ($email_verification ) {
            $emailServices_smtp = Helpers::get_business_settings('mail_config');
            if ($emailServices_smtp['status'] == 0) {
                $emailServices_smtp = Helpers::get_business_settings('mail_config_sendgrid');
            }
            if ($emailServices_smtp['status'] == 1) {
                Mail::to($user->email)->send(new \App\Mail\EmailVerification($token));
                $response = translate('check_your_email');
            }else{
                $response= translate('email_failed');
            }

            Toastr::success($response);
        }
     
        
        return view('customer-view.auth.verify', compact('user','loginuser'));
    }

    public static function verify(Request $request)
    {
        Validator::make($request->all(), [
            'token' => 'required',
        ]);

      

        $email_status = Helpers::get_business_settings('email_verification');
        $phone_status = Helpers::get_business_settings('phone_verification');

        $user = User::find($request->id);
        $verify = PhoneOrEmailVerification::where(['phone_or_email' => $user->email, 'token' => $request['token']])->first();

        if ($email_status == 1 || ($email_status == 0 && $phone_status == 0)) {
            if (isset($verify)) {
                // try {
                //     $user->is_email_verified = 1;
                //     $user->save();
                //   
                // } catch (\Exception $exception) {
                //     Toastr::info('Try again');
                // }
                $verify->delete();
                Toastr::success(translate('verification_done_successfully'));
                
                // Login the user and create session
                if (in_array($request->type, ['login', 'register'], true)) {
                    auth('customer')->login($user);
                    $wish_list = Wishlist::whereHas('wishlistProduct',function($q){
                        return $q;
                    })->where('customer_id', $user->id)->pluck('product_id')->toArray();
                    session()->put('wish_list', $wish_list);
                    CartManager::cart_to_db();
                    
                    return redirect(\App\CPU\Helpers::safe_return_url(session('keep_return_url')));
                }
                else{
                    return redirect(route('customer.auth.login'));
                }
            } else {
                Toastr::error(translate('Verification_code_or_OTP mismatched'));
                return redirect()->back();
            }

        } else {
            if (isset($verify)) {
                try {
                    $user->is_phone_verified = 1;
                    $user->save();
                    $verify->delete();
                } catch (\Exception $exception) {
                    Toastr::info('Try again');
                }

                Toastr::success('Verification Successfully Done');
                
                // Login the user and create session
                auth('customer')->login($user);
                $wish_list = Wishlist::whereHas('wishlistProduct',function($q){
                    return $q;
                })->where('customer_id', $user->id)->pluck('product_id')->toArray();
                session()->put('wish_list', $wish_list);
                CartManager::cart_to_db();

                return redirect(\App\CPU\Helpers::safe_return_url(session('keep_return_url')));
            } else {
                Toastr::error('Verification code/ OTP mismatched');
                return redirect()->back();
            }

        }

        return redirect(route('home'));
    }

    public static function login_process($user, $email, $password)
    {
        if (auth('customer')->attempt(['email' => $email, 'password' => $password], true)) {
            $wish_list = Wishlist::whereHas('wishlistProduct',function($q){
                return $q;
            })->where('customer_id', $user->id)->pluck('product_id')->toArray();

            session()->put('wish_list', $wish_list);
            $company_name = BusinessSetting::where('type', 'company_name')->first();
            $message = 'Welcome to ' . $company_name->value . '!';
            CartManager::cart_to_db();
        } else {
            $message = 'Credentials are not matched or your account is not active!';
        }

        return $message;
    }

}
