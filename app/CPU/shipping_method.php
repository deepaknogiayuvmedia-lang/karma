<?php

namespace App\CPU;

use Illuminate\Support\Facades\Http;
use App\Model\Order;
use App\Model\ShippingAddress;

class Delhivery {
    public static function create_shipment($order_id) {
        $config = Helpers::get_shipping_config();
        
        if (!$config || !$config->status) {
            return ['status' => 'error', 'message' => 'Delhivery is not active'];
        }

        $order = Order::with('customer')->find($order_id);
        if (!$order) {
            return ['status' => 'error', 'message' => 'Order not found'];
        }

        $shipping = ShippingAddress::find($order->shipping_address);
        if (!$shipping) {
            $shipping_data = json_decode($order->shipping_address_data);
            if ($shipping_data) {
                $shipping = (object)[
                    'contact_person_name' => $shipping_data->contact_person_name ?? ($order->customer->f_name . ' ' . $order->customer->l_name),
                    'address' => $shipping_data->address ?? '',
                    'zip' => $shipping_data->zip ?? '',
                    'phone' => $shipping_data->phone ?? $order->customer->phone,
                    'city' => $shipping_data->city ?? '',
                    'state' => $shipping_data->state ?? '',
                ];
            }
        }

        if (!$shipping) {
            return ['status' => 'error', 'message' => 'Shipping address not found'];
        }

        $api_token = $config->api_secret;
        
        // Delhivery API endpoint
        $url = "https://track.delhivery.com/api/cmu/create.json";
        
        // Prepare shipment data
        $shipment_data = [
            "name" => $shipping->contact_person_name,
            "add" => $shipping->address,
            "pin" => $shipping->zip,
            "phone" => $shipping->phone,
            "order" => (string)$order->id,
            "payment_mode" => $order->payment_method == 'cash_on_delivery' ? 'COD' : 'Prepaid',
            "cod_amount" => $order->payment_method == 'cash_on_delivery' ? $order->order_amount : 0,
            "total_amount" => $order->order_amount,
            "city" => $shipping->city ?? '',
            "state" => $shipping->state ?? '',
            "country" => "India"
        ];

        $pickup_location = [
            "name" => Helpers::get_business_settings('company_name') ?? "Karma",
            "add" => "Ajmer",
            "city" => "Ajmer",
            "pin" => "305001"
        ];

        if ($order->seller_is == 'seller') {
            $shop = \App\Model\Shop::where('seller_id', $order->seller_id)->first();
            if ($shop) {
                $wherehouse = json_decode($shop->wherehouse);
                $pickup_location = [
                    "name" => $shop->name,
                    "add" => $wherehouse->address_line1 ?? $shop->address,
                    "city" => $wherehouse->city ?? $shop->city,
                    "pin" => $wherehouse->pin ?? $shop->pincode,
                ];
            }
        }

        // Format for Delhivery CMU API
        $payload = [
            "shipments" => [$shipment_data],
            "pickup_location" => $pickup_location
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Token ' . $api_token,
                'Content-Type' => 'application/json'
            ])->post($url, [
                'format' => 'json',
                'data' => json_encode($payload)
            ]);

            if ($response->successful()) {
                $result = $response->json();
                if (isset($result['success']) && $result['success']) {
                    return [
                        'status' => 'success',
                        'waybill' => $result['packages'][0]['waybill'],
                        'data' => $result
                    ];
                } else {
                    return [
                        'status' => 'error',
                        'message' => $result['rmk'] ?? 'Unknown error from Delhivery'
                    ];
                }
            }
            return ['status' => 'error', 'message' => 'Delhivery API connection failed: ' . $response->status()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Exception: ' . $e->getMessage()];
        }
    }
 


}
