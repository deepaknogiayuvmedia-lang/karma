<?php

namespace App\Http\Controllers;

use App\CPU\CartManager;
use App\CPU\Helpers;
use App\CPU\OrderManager;
use App\Model\Order;
use App\Model\Product;
use App\Model\OrderTransaction;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Razorpay\Api\Api;
use Redirect;
use Session;

class RazorPayController extends Controller
{
    public function payWithRazorpay()
    {
        if (!view()->exists('razor-pay')) {
            return redirect()->route('checkout-payment');
        }

        return view('razor-pay');
    }

    public function payment(Request $request)
    {
        $payment_id = $request->input('razorpay_payment_id');
        if (empty($payment_id)) {
            Toastr::error('Payment process failed');
            return back();
        }

        // Verify the checkout signature when Razorpay provides it.
        $order_id = $request->input('razorpay_order_id');
        $signature = $request->input('razorpay_signature');
        if (!empty($order_id) && !empty($signature)) {
            $expected = hash_hmac('sha256', $order_id . '|' . $payment_id, (string) config('razor.razor_secret'));
            if (!hash_equals($expected, (string) $signature)) {
                Toastr::error('Payment verification failed');
                return back();
            }
        }

        try {
            $api = new Api(config('razor.razor_key'), config('razor.razor_secret'));
            $payment = $api->payment->fetch($payment_id);

            // Idempotency: a payment already converted into orders must not create them again.
            if (Order::where('transaction_ref', $payment_id)->exists()) {
                CartManager::cart_clean();
                return $this->payment_complete_response();
            }

            $status = $payment['status'] ?? '';
            if (!in_array($status, ['authorized', 'captured'], true)) {
                Toastr::error('Payment process failed');
                return back();
            }

            // Verify the paid amount against the server-side cart total.
            // Must mirror the value rendered into the Razorpay checkout form:
            // (round(usdToinr(cart_grand_total() - coupon_discount))) * 100.
            $discount = session()->has('coupon_discount') ? session('coupon_discount') : 0;
            $expected_paise = (int) (round(\App\CPU\Convert::usdToinr(CartManager::cart_grand_total() - $discount)) * 100);
            $paid_paise = (int) ($payment['amount'] ?? 0);
            if ($expected_paise <= 0 || $paid_paise !== $expected_paise) {
                Toastr::error('Payment amount mismatch. Please contact support.');
                return back();
            }

            if ($status === 'authorized') {
                $payment = $api->payment->fetch($payment_id)->capture(['amount' => $paid_paise]);
            }

            $unique_id = OrderManager::gen_unique_id();
            $order_ids = [];
            foreach (CartManager::get_cart_group_ids() as $group_id) {
                $data = [
                    'payment_method' => 'razor_pay',
                    'order_status' => 'confirmed',
                    'payment_status' => 'paid',
                    'transaction_ref' => $payment_id,
                    'order_group_id' => $unique_id,
                    'cart_group_id' => $group_id
                ];
                $order_id = OrderManager::generate_order($data);
                array_push($order_ids, $order_id);
            }
            CartManager::cart_clean();

        } catch (\Exception $exception) {
            Toastr::error('Payment process failed');
            return back();
        }

        return $this->payment_complete_response();
    }

    private function payment_complete_response()
    {
        if (session()->has('payment_mode') && session('payment_mode') == 'app') {
            return redirect()->route('payment-success');
        }

        return view('web-views.checkout-complete');
    }

    public function success()
    {
        if (session()->has('payment_mode') && session('payment_mode') == 'app') {
            return redirect()->route('payment-success');
        }
        
        if (auth('customer')->check()) {
            Toastr::success('Payment success.');
            return redirect('/account-oder');
        }
        return response()->json(['message' => 'Payment succeeded'], 200);
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
