<?php

namespace App\CPU;

use Illuminate\Support\Facades\Http;
use App\Model\Order;
use App\Model\ShippingAddress;
use App\Model\Shop;


class shepping
{
    public static function CreateWhereHouse($data)
    {
        $config = Helpers::get_shipping_config();
        
        if (!$config || !$config->status) {
            return ['status' => 'error', 'message' => 'Delhivery is not active'];
        }

        $api_token = $config->api_secret;
        
        // Delhivery Client Warehouse Creation API endpoint
        $url = "https://staging-express.delhivery.com/api/backend/clientwarehouse/create/";
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Token ' . $api_token,
                'Content-Type' => 'application/json'
            ])->post($url, $data);

            if ($response->successful()) {
                return [
                    'status' => 'success',
                    'data' => $response->json()
                ];
            }
            return [
                'status' => 'error', 
                'message' => 'Delhivery API connection failed: ' . $response->status(),
                'data' => $response->json()
            ];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Exception: ' . $e->getMessage()];
        }
    }

    public static function UpdateWhereHouse($data)
    {
        $config = Helpers::get_shipping_config();
        
        if (!$config || !$config->status) {
            return ['status' => 'error', 'message' => 'Delhivery is not active'];
        }

        $api_token = $config->api_secret;
        
        // Delhivery Client Warehouse Edit API endpoint
        $url = "https://staging-express.delhivery.com/api/backend/clientwarehouse/edit/";
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Token ' . $api_token,
                'Content-Type' => 'application/json'
            ])->post($url, $data);

            if ($response->successful()) {
                return [
                    'status' => 'success',
                    'data' => $response->json()
                ];
            }
            return [
                'status' => 'error', 
                'message' => 'Delhivery API connection failed: ' . $response->status(),
                'data' => $response->json()
            ];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Exception: ' . $e->getMessage()];
        }
    }

    // shipment create
    public static function CreateShipment($order_id)
    {
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
        
        // Prepare shipment data
        $shipment_data = [
            "name" => $shipping->contact_person_name,
            "add" => $shipping->address,
            "pin" => $shipping->zip,
            "phone" => $shipping->phone,
            "order" => (string)$order->id . (env('APP_MODE') == 'dev' ? '-' . time() : ''),
            "payment_mode" => $order->payment_method == 'cash_on_delivery' ? 'COD' : 'Prepaid',
            "cod_amount" => $order->payment_method == 'cash_on_delivery' ? $order->order_amount : 0,
            "total_amount" => $order->order_amount,
            "city" => $shipping->city ?? '',
            "state" => $shipping->state ?? '',
            "country" => "India"
        ];
        $pickup_location = [
            "name" => trim(Helpers::get_business_settings('company_name') ?? "Karma"),
            "add" => "Ajmer",
            "city" => "Ajmer",
            "pin" => "305001"
        ];

        if ($order->seller_is == 'seller') {
            $shop = Shop::where('seller_id', $order->seller_id)->first();
            if ($shop && $shop->wherehouse) {
                $wherehouse = is_array($shop->wherehouse) ? $shop->wherehouse : json_decode($shop->wherehouse, true);
                $pickup_location = [
                    "name" => trim($shop->name),
                    "add" => $wherehouse['address_line1'] ?? $shop->address ?? '',
                    "city" => $wherehouse['city'] ?? $shop->city ?? '',
                    "pin" => $wherehouse['pincode'] ?? $shop->pincode ?? '',
                ];
            }
        } else {
            $admin = \App\Model\Admin::where('id', $order->seller_id)->first() ?? \App\Model\Admin::whereNotNull('wherehouse')->first();
            if ($admin && $admin->wherehouse) {
                $wherehouse = is_array($admin->wherehouse) ? $admin->wherehouse : json_decode($admin->wherehouse, true);
                $pickup_location = [
                    "name" => trim($admin->name),
                    "add" => $wherehouse['address_line1'] ?? '',
                    "city" => $wherehouse['city'] ?? '',
                    "pin" => $wherehouse['pincode'] ?? '',
                ];
            }
        }

        // Format for Delhivery API
        $payload = [
            "shipments" => [$shipment_data],
            "pickup_location" => $pickup_location
        ];

        // Delhivery Shipment Creation API endpoint
        $url = "https://staging-express.delhivery.com/api/cmu/create.json";
        
        try {
            $response = Http::asForm()->withHeaders([
                'Authorization' => 'Token ' . $api_token,
            ])->post($url, [
                'format' => 'json',
                'data' => json_encode($payload)
            ]);
            // dd($response->json());
            if ($response->successful()) {
                $result = $response->json();
                if (isset($result['success']) && $result['success']) {
                    return [
                        'status' => 'success',
                        'waybill' => $result['packages'][0]['waybill'],
                        'data' => $result
                    ];
                } else {
                    $error_message = $result['rmk'] ?? 'Unknown error from Delhivery';
                    if (isset($result['packages'][0]['remarks'][0])) {
                        $error_message = $result['packages'][0]['remarks'][0];
                    }
                    return [
                        'status' => 'error',
                        'message' => $error_message
                    ];
                }
            }
            return [
                'status' => 'error', 
                'message' => 'Delhivery API connection failed: ' . $response->status(),
                'data' => $response->json()
            ];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Exception: ' . $e->getMessage()];
        }
    }
    // shipment tracking
    public static function track_shipment($waybill)
    {
        $config = Helpers::get_shipping_config();
        
        if (!$config || !$config->status) {
            return ['status' => 'error', 'message' => 'Delhivery is not active'];
        }

        $api_token = $config->api_secret;
        
        // Delhivery Tracking API endpoint
        $url = (env('APP_MODE') == 'live' ? "https://track.delhivery.com" : "https://staging-express.delhivery.com") . "/api/v1/packages/json/?waybill=" . $waybill;
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Token ' . $api_token,
            ])->get($url);

            if ($response->successful()) {
                return [
                    'status' => 'success',
                    'data' => $response->json()
                ];
            }
            return [
                'status' => 'error', 
                'message' => 'Delhivery API connection failed: ' . $response->status(),
                'data' => $response->json()
            ];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Exception: ' . $e->getMessage()];
        }
    }

    // update shipment
    public static function UpdateShipment($waybill, $order_id)
    {
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
        
        // Delhivery Edit/Update API endpoint
        $url = (env('APP_MODE') == 'live' ? "https://track.delhivery.com" : "https://staging-express.delhivery.com") . "/api/p/edit";
        
        // Build update data
        $update_data = [
            'waybill' => $waybill,
            'name' => $shipping->contact_person_name,
            'add' => $shipping->address,
            'pin' => $shipping->zip,
            'phone' => $shipping->phone,
            'payment_mode' => $order->payment_method == 'cash_on_delivery' ? 'COD' : 'Prepaid',
            'cod_amount' => $order->payment_method == 'cash_on_delivery' ? $order->order_amount : 0,
        ];

        try {
            $response = Http::asForm()->withHeaders([
                'Authorization' => 'Token ' . $api_token,
            ])->post($url, $update_data);

            if ($response->successful()) {
                return [
                    'status' => 'success',
                    'data' => $response->json()
                ];
            }
            return [
                'status' => 'error', 
                'message' => 'Delhivery API connection failed: ' . $response->status(),
                'data' => $response->json()
            ];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Exception: ' . $e->getMessage()];
        }
    }

    // cancel shipment
    public static function CancelShipment($waybill, $order_id)
    {
        $config = Helpers::get_shipping_config();
        
        if (!$config || !$config->status) {
            return ['status' => 'error', 'message' => 'Delhivery is not active'];
        }

        $api_token = $config->api_secret;
        
        // Delhivery Cancel/Edit API endpoint
        $url = (env('APP_MODE') == 'live' ? "https://track.delhivery.com" : "https://staging-express.delhivery.com") . "/api/p/edit";
        
        try {
            $response = Http::asForm()->withHeaders([
                'Authorization' => 'Token ' . $api_token,
            ])->post($url, [
                'waybill' => $waybill,
                'cancellation' => 'true',
            ]);

            if ($response->successful()) {
                // Clear the third-party delivery info from the order
              

                return [
                    'status' => 'success',
                    'data' => $response->json()
                ];
            }
            return [
                'status' => 'error', 
                'message' => 'Delhivery API connection failed: ' . $response->status(),
                'data' => $response->json()
            ];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Exception: ' . $e->getMessage()];
        }
    }

       public static function check_pincode($pin)
    {
        $config = Helpers::get_shipping_config();
        
        if (!$config || !$config->status) {
            return ['status' => 'error', 'message' => 'Delhivery is not active'];
        }

        $api_token = $config->api_secret;
        
        // Delhivery Pincode Serviceability API endpoint
        $url = "https://staging-express.delhivery.com/c/api/pin-codes/json/?filter_codes=" . $pin;
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Token ' . $api_token,
                'Content-Type' => 'application/json'
            ])->get($url);
                // dd($response->json());
            if ($response->successful()) {
                $result = $response->json();
             
                // If delivery_codes array exists and has length > 0, the pincode is serviceable
                if (isset($result['delivery_codes']) && count($result['delivery_codes']) > 0) {
                    $details = $result['delivery_codes'][0]['postal_code'] ?? null;

                    return [
                        'status' => 'success',
                        'serviceable' => true,
                        'message' => 'Pincode is serviceable.',
                        'data' => $details
                    ];
                } else {
                    return [
                        'status' => 'error',
                        'serviceable' => false,
                        'message' => 'Service is not available for this pincode.',
                        'data' => []
                    ];
                }
            }
            return [
                'status' => 'error', 
                'serviceable' => false,
                'message' => 'Delhivery API connection failed: ' . $response->status(),
                'data' => $response->json()
            ];
        } catch (\Exception $e) {
            return ['status' => 'error', 'serviceable' => false, 'message' => 'Exception: ' . $e->getMessage()];
        }
    }
}

