<?php

namespace App\Http\Controllers;

use App\CPU\CartManager;
use App\CPU\Helpers;
use App\CPU\OrderManager;
use App\Model\BusinessSetting;
use App\Model\Currency;
use App\Model\Order;
use App\Model\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class StripePaymentController extends Controller
{
    public function payment_process_3d()
    {
        $currency_model = Helpers::get_business_settings('currency_model');
        if ($currency_model == 'multi_currency') {
            $currency_code = 'INR';
        } else {
            $default = BusinessSetting::where(['type' => 'system_default_currency'])->first()->value;
            $currency_code = Currency::find($default)->code;
        }

        $discount = session()->has('coupon_discount') ? session('coupon_discount') : 0;
        $value = CartManager::cart_grand_total() - $discount;
        $tran = OrderManager::gen_unique_id();

        session()->put('transaction_ref', $tran);
        $config = \App\CPU\Helpers::get_business_settings('stripe');
        if (empty($config['api_key'] ?? null)) {
            return redirect()->route('checkout-payment')
                ->with('error', 'Stripe payment is not configured. Please add your API key.');
        }
        Stripe::setApiKey($config['api_key']);
        header('Content-Type: application/json');

        $YOUR_DOMAIN = url('/');

        $products = [];
        foreach (CartManager::get_cart() as $detail) {
            array_push($products, [
                'name' => $detail->product['name'],
                'image' => 'def.png'
            ]);
        }

        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => $currency_code,
                    'unit_amount' => round($value, 2) * 100,
                    'product_data' => [
                        'name' => BusinessSetting::where(['type' => 'company_name'])->first()->value,
                        'images' => [asset(config('app.public_storage_path').'/company') . '/' . Helpers::get_business_settings('company_web_logo')],
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/pay-stripe/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => url()->previous(),
        ]);

        return response()->json(['id' => $checkout_session->id]);
    }

    public function success(Request $request)
    {
        if (session()->has('payment_mode') && session('payment_mode') == 'app') {
            return redirect()->route('payment-success');
        }

        $session_id = $request->query('session_id');
        $tran = session('transaction_ref');

        // The order must be created only from a Stripe-verified checkout session.
        if (empty($session_id) || empty($tran) || !auth('customer')->check()) {
            Toastr::error('Payment verification failed');
            return redirect('/account-oder');
        }

        try {
            $config = Helpers::get_business_settings('stripe');
            if (empty($config['api_key'] ?? null)) {
                throw new \RuntimeException('Stripe api key missing');
            }
            Stripe::setApiKey($config['api_key']);

            $stripe_session = \Stripe\Checkout\Session::retrieve($session_id);

            if ($stripe_session->payment_status !== 'paid' || $stripe_session->status !== 'complete') {
                Toastr::error('Payment verification failed');
                return redirect('/account-oder');
            }

            $discount = session()->has('coupon_discount') ? session('coupon_discount') : 0;
            $expected_paise = (int) round(round(CartManager::cart_grand_total() - $discount, 2) * 100);
            $paid_paise = (int) ($stripe_session->amount_total ?? 0);
            if ($expected_paise <= 0 || $paid_paise !== $expected_paise) {
                Toastr::error('Payment amount mismatch. Please contact support.');
                return redirect('/account-oder');
            }

            // Idempotency: this checkout session must not create orders twice.
            if (Order::where('transaction_ref', $tran)->exists()) {
                CartManager::cart_clean();
                Toastr::success('Payment success.');
                return view('web-views.checkout-complete');
            }

            $unique_id = OrderManager::gen_unique_id();
            foreach (CartManager::get_cart_group_ids() as $group_id) {
                OrderManager::generate_order([
                    'payment_method' => 'stripe',
                    'order_status' => 'confirmed',
                    'payment_status' => 'paid',
                    'transaction_ref' => $tran,
                    'order_group_id' => $unique_id,
                    'cart_group_id' => $group_id
                ]);
            }
            CartManager::cart_clean();
        } catch (\Throwable $e) {
            Toastr::error('Payment verification failed');
            return redirect('/account-oder');
        }

        Toastr::success('Payment success.');
        return view('web-views.checkout-complete');
    }

    public function fail()
    {
        if (session()->has('payment_mode') && session('payment_mode') == 'app') {
            return redirect()->route('payment-fail');
        }
        
        if (auth('customer')->check()) {
            Toastr::error('Payment failed.');
            return redirect('/account-oder');
        }
        return response()->json(['message' => 'Payment failed'], 403);
    }
}
