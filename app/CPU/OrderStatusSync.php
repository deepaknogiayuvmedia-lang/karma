<?php

namespace App\CPU;

use App\Mail\NotificationMail;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\OrderTransaction;
use App\Model\DeliverymanWallet;
use App\Model\DeliveryManTransaction;
use App\Traits\CommonTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;
use function App\CPU\translate;

class OrderStatusSync
{
    use CommonTrait;

    /**
     * Forward-only pipeline. A status may only advance forward in this list.
     */
    const PIPELINE = ['pending', 'confirmed', 'processing', 'out_for_delivery', 'delivered'];

    /**
     * Terminal statuses - once set, never changed automatically.
     */
    const TERMINAL = ['failed', 'returned', 'canceled'];

    /**
     * Map a Delhivery courier status to one of our order_status values.
     * Returns null when the courier status is unknown or needs no change.
     */
    public static function map_delhivery_status($courier_status)
    {
        if (!$courier_status || !is_string($courier_status)) {
            return null;
        }
        

        $s = strtolower(trim($courier_status));

        // Order of checks matters: "Out for Delivery" contains "delivery",
        // "Undelivered" contains "deliver", "RTO in Transit" contains "transit".
        if (str_contains($s, 'out for delivery')) {
            return 'out_for_delivery';
        }
        if (str_contains($s, 'not picked')) {
            return 'canceled';
        }
        if (str_contains($s, 'undeliver') || str_contains($s, 'attempt') || str_contains($s, 'failed')) {
            return 'failed';
        }
        if (str_contains($s, 'rto') || str_contains($s, 'return')) {
            return 'returned';
        }
        if (str_contains($s, 'cancel') || str_contains($s, 'lost') || str_contains($s, 'dispos')) {
            return 'canceled';
        }
        if (str_contains($s, 'deliver')) {
            return 'delivered';
        }
        // Early/transit states only move an order forward to processing.
        $transit_keywords = ['pending', 'manifest', 'picked', 'transit', 'reach', 'hold', 'hub', 'scan', 'ship'];
        foreach ($transit_keywords as $keyword) {
            if (str_contains($s, $keyword)) {
                return 'processing';
            }
        }

        return null;
    }

    /**
     * Decide whether $new_status may be applied to $order (forward-only rule,
     * terminal guard, no-op guard). Returns true/false and logs the reason
     * for every skipped transition.
     */
    public static function should_apply(Order $order, $new_status)
    {
        $current = $order->order_status;

        if ($current == $new_status) {
            return false;
        }

        if (in_array($current, self::TERMINAL)) {
            Log::info('Delhivery status sync skipped: order already terminal', [
                'order_id' => $order->id, 'current' => $current, 'incoming' => $new_status,
            ]);
            return false;
        }

        // A delivered order never moves automatically (courier post-delivery
        // noise like "RTO" after delivery needs a manual review).
        if ($current == 'delivered') {
            Log::warning('Delhivery status sync skipped: order already delivered', [
                'order_id' => $order->id, 'incoming' => $new_status,
            ]);
            return false;
        }

        // Forward-only inside the normal pipeline.
        if (in_array($new_status, self::PIPELINE)) {
            $current_rank = array_search($current, self::PIPELINE);
            $new_rank = array_search($new_status, self::PIPELINE);

            // Unknown current status (should not happen) - be conservative.
            if ($current_rank === false) {
                return false;
            }
            if ($new_rank <= $current_rank) {
                Log::info('Delhivery status sync skipped: would not advance order', [
                    'order_id' => $order->id, 'current' => $current, 'incoming' => $new_status,
                ]);
                return false;
            }

            // Same guard as the manual admin flow: COD/unpaid orders cannot
            // become "delivered" until payment_status is paid.
            if ($new_status == 'delivered' && $order->payment_status != 'paid') {
                Log::warning('Delhivery status sync skipped: delivered blocked, payment not paid', [
                    'order_id' => $order->id, 'payment_status' => $order->payment_status,
                ]);
                return false;
            }
        }

        // Negative outcomes (failed/returned/canceled) are allowed from any
        // non-terminal state, but only when the courier explicitly reports them.
        return true;
    }

    /**
     * Apply the new order status and run the exact same side-effect pipeline
     * as the manual admin status change (Admin\OrderController::status()):
     * FCM + email, WhatsApp, stock update, status history, loyalty points,
     * delivery-man wallet, seller wallet disbursement.
     *
     * Returns true when the status was changed.
     */
    public static function apply(Order $order, $new_status, $cause = null)
    {
        if (!self::should_apply($order, $new_status)) {
            return false;
        }

        if (!isset($order->customer)) {
            Log::warning('Delhivery status sync skipped: order has no customer', ['order_id' => $order->id]);
            return false;
        }

        $cause = $cause ?: 'Delhivery auto-sync';

        // --- FCM push + fallback email (mirrors OrderController::status) ---
        $fcm_token = $order->customer->cm_firebase_token ?? null;
        $value = Helpers::order_status_update_message($new_status);
        if (!empty($fcm_token)) {
            try {
                if ($value) {
                    $data = [
                        'title' => translate('Order'),
                        'description' => $value,
                        'order_id' => $order['id'],
                        'image' => '',
                    ];
                    $result = Helpers::send_push_notif_to_device($fcm_token, $data);

                    if (isset($result['error']['details'][0]['errorCode']) &&
                        $result['error']['details'][0]['errorCode'] === 'UNREGISTERED') {
                        $order->customer->cm_firebase_token = null;
                        $order->customer->save();
                    } else {
                        if (!empty($order->customer->email)) {
                            $name = trim($order->customer->f_name . ' ' . $order->customer->l_name) ?: $order->customer->name;
                            Mail::to($order->customer->email)->send(new NotificationMail($data['title'], $data['description'], $name, 'info'));
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::error('Delhivery status sync FCM error', ['order_id' => $order->id, 'message' => $e->getMessage()]);
            }
        }

        // --- WhatsApp notification (deduped per order+status inside helper) ---
        try {
            $result = Helpers::send_whatsapp_notification($order->customer->phone ?? null, $new_status, $order->id);
            Log::info('WhatsApp Order Status (auto-sync)', [
                'order_id' => $order->id,
                'status' => $new_status,
                'result' => $result,
            ]);
        } catch (\Exception $e) {
            Log::error('WhatsApp Order Error (auto-sync)', [
                'order_id' => $order->id,
                'message' => $e->getMessage(),
            ]);
        }

        $previous_status = $order->order_status;

        // --- Status + stock (same as manual flow) ---
        $order->order_status = $new_status;
        OrderManager::stock_update_on_order_status_change($order, $new_status);
        $order->save();

        // --- Loyalty points on delivered + paid ---
        $loyalty_point_status = Helpers::get_business_settings('loyalty_point_status');
        if ($loyalty_point_status == 1 && $new_status == 'delivered' && $order->payment_status == 'paid') {
            try {
                CustomerManager::create_loyalty_point_transaction(
                    $order->customer_id, $order->id,
                    Convert::default($order->order_amount - $order->shipping_cost),
                    'order_place'
                );
            } catch (\Exception $e) {
                Log::error('Delhivery status sync loyalty error', ['order_id' => $order->id, 'message' => $e->getMessage()]);
            }
        }

        // --- Delivery-man wallet on delivered (Delhivery orders have no
        //     delivery man, block kept for parity with the manual flow) ---
        if ($order->delivery_man_id && $new_status == 'delivered') {
            $dm_wallet = DeliverymanWallet::where('delivery_man_id', $order->delivery_man_id)->first();
            $cash_in_hand = $order->payment_method == 'cash_on_delivery' ? $order->order_amount : 0;

            if (empty($dm_wallet)) {
                DeliverymanWallet::create([
                    'delivery_man_id' => $order->delivery_man_id,
                    'current_balance' => BackEndHelper::currency_to_usd($order->deliveryman_charge) ?? 0,
                    'cash_in_hand' => BackEndHelper::currency_to_usd($cash_in_hand),
                    'pending_withdraw' => 0,
                    'total_withdraw' => 0,
                ]);
            } else {
                $dm_wallet->current_balance += BackEndHelper::currency_to_usd($order->deliveryman_charge) ?? 0;
                $dm_wallet->cash_in_hand += BackEndHelper::currency_to_usd($cash_in_hand);
                $dm_wallet->save();
            }

            if ($order->deliveryman_charge && $new_status == 'delivered') {
                DeliveryManTransaction::create([
                    'delivery_man_id' => $order->delivery_man_id,
                    'user_id' => 0,
                    'user_type' => 'system',
                    'credit' => BackEndHelper::currency_to_usd($order->deliveryman_charge) ?? 0,
                    'transaction_id' => Uuid::uuid4(),
                    'transaction_type' => 'deliveryman_charge',
                ]);
            }
        }

        // --- Status history row + its WhatsApp send (deduped) ---
        self::add_order_status_history($order->id, 0, $new_status, 'system', $cause);

        // --- Seller/admin wallet disbursement on delivered ---
        $transaction = OrderTransaction::where(['order_id' => $order['id']])->first();
        if (!isset($transaction) || $transaction['status'] != 'disburse') {
            if ($new_status == 'delivered' && $order['seller_id'] != null) {
                OrderManager::wallet_manage_on_order_status_change($order, 'system');
            }
        }

        if ($new_status == 'delivered') {
            OrderDetail::where('order_id', $order->id)->update(['delivery_status' => 'delivered']);
        }

        Log::info('Delhivery status sync: order status updated', [
            'order_id' => $order->id,
            'from' => $previous_status,
            'to' => $new_status,
            'waybill' => $order->third_party_delivery_tracking_id,
        ]);

        return true;
    }
}
