<?php

namespace App\Http\Controllers\DeliveryMan;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\DeliveryManTransaction;
use App\Model\DeliverymanWallet;
use App\Model\Order;
use App\Traits\CommonTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    use CommonTrait;

    public function orders(Request $request)
    {
        $deliveryMan = auth('delivery_man')->user();
        $query = Order::where('delivery_man_id', $deliveryMan->id);

        if ($request->status) {
            $query->where('order_status', $request->status);
        }

        $orders = $query->with(['details.product', 'delivery_man', 'shippingAddress', 'billingAddress', 'customer'])->orderBy('id', 'desc')->paginate(15);

        return view('delivery-man-views.orders', compact('orders'));
    }

    public function order_details($id)
    {
        $deliveryMan = auth('delivery_man')->user();
        $order = Order::with(['details.product', 'delivery_man', 'shippingAddress', 'billingAddress', 'customer'])
            ->where('id', $id)
            ->where('delivery_man_id', $deliveryMan->id)
            ->firstOrFail();

        return view('delivery-man-views.order-details', compact('order'));
    }

    public function send_delivery_otp(Request $request)
    {
        $deliveryMan = auth('delivery_man')->user();
        $order = Order::with(['customer', 'shippingAddress', 'billingAddress'])
            ->where('id', $request->order_id)
            ->where('delivery_man_id', $deliveryMan->id)
            ->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found!'], 404);
        }

        // Generate 4-digit OTP
        $otp = str_pad(random_int(1000, 9999), 4, '0', STR_PAD_LEFT);
        $order->delivery_otp = $otp;
        $order->save();

        $email = $order->customer->email ?? null;
        if (empty($email) && $order->shippingAddress) {
            $email = $order->shippingAddress->email ?? null;
        }
        if (empty($email) && $order->billingAddress) {
            $email = $order->billingAddress->email ?? null;
        }

        if (empty($email)) {
            return response()->json(['success' => false, 'message' => 'Customer email not found for this order!'], 400);
        }

        try {
            \Mail::to($email)->send(new \App\Mail\DeliveryOtpMail($order, $otp));
            Log::info('Delivery OTP Email Sent via AJAX', [
                'order_id' => $order->id,
                'email' => $email,
                'otp' => $otp,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'OTP email sent to customer (' . $email . ') successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Delivery OTP Email Failed via AJAX', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP email: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update_status(Request $request)
    {
        $deliveryMan = auth('delivery_man')->user();
        $order = Order::with(['customer', 'shippingAddress'])
            ->where('id', $request->order_id)
            ->where('delivery_man_id', $deliveryMan->id)
            ->firstOrFail();

        $validStatuses = ['out_for_delivery', 'delivered', 'canceled', 'returned'];
        if (!in_array($request->status, $validStatuses)) {
            Toastr::error('Invalid status selected');
            return back();
        }

        // OTP verification for delivered status
        if ($request->status == 'delivered') {
            if (empty($order->delivery_otp)) {
                Toastr::error('Delivery OTP not generated. Please click Send OTP Email.');
                return back();
            }
            if (empty($request->otp) || $request->otp != $order->delivery_otp) {
                Toastr::error('Invalid OTP! Order status has NOT been updated.');
                return back();
            }
        }

        // Generate OTP + send email when status changes to out_for_delivery
        $otp = null;
        if ($request->status == 'out_for_delivery') {
            $otp = str_pad(random_int(1000, 9999), 4, '0', STR_PAD_LEFT);
            $order->delivery_otp = $otp;
        }

        $order->order_status = $request->status;
        $order->cause = $request->cause ?? null;

        // Set payment status for COD orders on delivery
        if ($request->status == 'delivered' && $order->payment_method == 'cash_on_delivery') {
            $order->payment_status = $request->payment_status ?? 'paid';
        }

        $order->save();

        // Send OTP email to customer when out_for_delivery
        if ($request->status == 'out_for_delivery' && $otp) {
            try {
                $customer = $order->customer;
                if ($customer && !empty($customer->email)) {
                    \Mail::to($customer->email)->send(new \App\Mail\DeliveryOtpMail($order, $otp));
                    Log::info('Delivery OTP Email Sent', [
                        'order_id' => $order->id,
                        'email' => $customer->email,
                        'otp' => $otp,
                    ]);
                } else {
                    Log::warning('Delivery OTP Email Skipped - No email', [
                        'order_id' => $order->id,
                        'customer_id' => $order->customer_id,
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Delivery OTP Email Failed', [
                    'order_id' => $order->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        // WhatsApp Notification to Customer
        try {
            $customerPhone = $order->customer->phone ?? null;
            if (empty($customerPhone) && $order->shippingAddress) {
                $customerPhone = $order->shippingAddress->phone ?? null;
            }
            if ($customerPhone) {
                $result = Helpers::send_whatsapp_notification($customerPhone, $request->status, $order->id);
                Log::info('WhatsApp Order Status (DeliveryMan)', [
                    'order_id' => $order->id,
                    'status' => $request->status,
                    'phone' => $customerPhone,
                    'result' => $result,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('WhatsApp Notification Failed (DeliveryMan)', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);
        }

        // If delivered, credit wallet
        if ($request->status == 'delivered') {
            $wallet = DeliverymanWallet::firstOrCreate(['delivery_man_id' => $deliveryMan->id]);
            $wallet->current_balance += $order->deliveryman_charge;
            $wallet->save();

            DeliveryManTransaction::create([
                'delivery_man_id' => $deliveryMan->id,
                'credit' => $order->deliveryman_charge,
                'debit' => 0,
                'transaction_type' => 'deliveryman_charge',
            ]);

            if ($order['payment_method'] == 'cash_on_delivery' && $order->payment_status == 'paid') {
                $wallet->cash_in_hand += $order['order_amount'];
                $wallet->save();

                DeliveryManTransaction::create([
                    'delivery_man_id' => $deliveryMan->id,
                    'credit' => $order['order_amount'],
                    'debit' => 0,
                    'transaction_type' => 'cash_in_hand',
                ]);
            }
        }

        Toastr::success('Order status updated successfully!');
        return back();
    }
}
