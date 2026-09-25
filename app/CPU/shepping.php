<?php

namespace App\CPU;

use App\Model\Order;
use App\Model\ShippingAddress;
use App\Model\Shop;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class shepping
{
    public static function is_live(): bool
    {
        $config = Helpers::get_shipping_config();
        if ($config && !empty($config->environment)) {
            return $config->environment === 'live';
        }
        return env('APP_MODE') == 'live';
    }

    public static function base_url(): string
    {
        return self::is_live()
            ? 'https://track.delhivery.com'
            : 'https://staging-express.delhivery.com';
    }

    public static function CreateWhereHouse($data)
    {
        
        $config = Helpers::get_shipping_config();

        if (!$config || !$config->status) {
            return ['status' => 'error', 'message' => 'Delhivery is not active'];
        }

        $api_token = $config->api_secret;
        
        if (empty($api_token)) {
            return ['status' => 'error', 'message' => 'Delhivery API token is not configured. Please set the API Secret in shipping settings.'];
        }

        $url = self::base_url() . '/api/backend/clientwarehouse/create/';
        
        try {   
            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => 'Token ' . $api_token,
                'Content-Type' => 'application/json'
            ])->post($url, $data);
           
            error_log("===== DELHIVERY CREATE WAREHOUSE REQUEST =====");
            error_log("URL: " . $url);
            error_log("Data: " . json_encode($data));
            error_log("Response Status: " . $response->status());
            error_log("Response Body: " . $response->body());

            if ($response->successful()) {
                return [
                    'status' => 'success',
                    'data' => $response->json()
                ];
            }

            $errorMsg = 'Delhivery API error: ' . $response->status();
            $body = $response->json();
            if (isset($body['error'])) {
                $errorMsg .= ' - ' . $body['error'];
            } elseif (isset($body['message'])) {
                $errorMsg .= ' - ' . $body['message'];
            }

            return [
                'status' => 'error',
                'message' => $errorMsg,
                'data' => $body
            ];
        } catch (\Exception $e) {
            error_log("DELHIVERY CREATE WAREHOUSE EXCEPTION: " . $e->getMessage());
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
        $url = self::base_url() . '/api/backend/clientwarehouse/edit/';

        try {
            $response = Http::withoutVerifying()->withHeaders([
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
            "order" => (string)$order->id . (!self::is_live() ? '-' . time() : ''),
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

        $base_url = self::base_url();
        $url = $base_url . "/api/cmu/create.json";

        try {
            $response = Http::withoutVerifying()->asForm()->withHeaders([
                'Authorization' => 'Token ' . $api_token,
            ])->post($url, [
                'format' => 'json',
                'data' => json_encode($payload)
            ]);

            error_log("===== DELHIVERY CREATE SHIPMENT RESPONSE =====");
            error_log("Status: " . $response->status());
            error_log("Body: " . $response->body());

            $result = $response->json();

            if ($response->successful() && isset($result['success']) && $result['success']) {
                return [
                    'status' => 'success',
                    'waybill' => $result['packages'][0]['waybill'],
                    'data' => $result
                ];
            }

            // Even if success=false, check if waybill was generated (partial save)
            if (isset($result['packages'][0]['waybill']) && !empty($result['packages'][0]['waybill'])) {
                $waybill = $result['packages'][0]['waybill'];
                $remarks = $result['packages'][0]['remarks'][0] ?? ($result['rmk'] ?? '');

                return [
                    'status' => 'partial',
                    'waybill' => $waybill,
                    'message' => $remarks ?: 'Package partially saved. Waybill generated but manifest charge failed. Please recharge Delhivery account.',
                    'data' => $result
                ];
            }

            // No waybill - full failure
            $error_message = $result['rmk'] ?? 'Unknown error from Delhivery';
            if (isset($result['packages'][0]['remarks'][0])) {
                $error_message = $result['packages'][0]['remarks'][0];
            }

            return [
                'status' => 'error',
                'message' => $error_message,
                'data' => $result
            ];
        } catch (\Exception $e) {
            error_log("DELHIVERY CREATE SHIPMENT EXCEPTION: " . $e->getMessage());
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
        $url = self::base_url() . "/api/v1/packages/json/?waybill=" . $waybill;
        
        try {
            $response = Http::withoutVerifying()->withHeaders([
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
        $url = self::base_url() . "/api/p/edit";
        
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
            $response = Http::withoutVerifying()->asForm()->withHeaders([
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
        $url = self::base_url() . "/api/p/edit";
        
        try {
            $response = Http::withoutVerifying()->asForm()->withHeaders([
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
            Log::warning('Delhivery shipping config not found or inactive');
            return ['status' => 'error', 'serviceable' => false, 'message' => 'Delhivery is not active'];
        }

        $api_token = $config->api_secret;
        
        $url = self::base_url() . "/c/api/pin-codes/json/?filter_codes=" . $pin;
        
        Log::info('Delhivery pincode check', ['pin' => $pin, 'url' => $url, 'mode' => self::is_live() ? 'live' : 'test']);

        try {
            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => 'Token ' . $api_token,
                'Content-Type' => 'application/json'
            ])->timeout(10)->get($url);

            $body = $response->json();

            Log::info('Delhivery API response', [
                'pin' => $pin,
                'status_code' => $response->status(),
                'body' => $body
            ]);

            if ($response->successful() && isset($body['delivery_codes']) && count($body['delivery_codes']) > 0) {
                $code = $body['delivery_codes'][0];
                $postal = $code['postal_code'] ?? [];

                $cod = ($postal['cod'] ?? '') === 'Y';
                $pre_paid = ($postal['pre_paid'] ?? '') === 'Y';
                $pickup = ($postal['pickup'] ?? '') === 'Y';
                $repl = ($postal['repl'] ?? '') === 'Y';

                return [
                    'status' => 'success',
                    'serviceable' => true,
                    'message' => 'Pincode is serviceable.',
                    'cod_available' => $cod,
                    'pre_paid' => $pre_paid,
                    'pickup' => $pickup,
                    'repl' => $repl,
                    'district' => $postal['district'] ?? '',
                    'state_code' => $postal['state_code'] ?? '',
                    'data' => $postal
                ];
            }

            return [
                'status' => 'error',
                'serviceable' => false,
                'cod_available' => false,
                'message' => 'Delivery not available for this pincode.',
                'data' => $body ?? []
            ];
        } catch (\Exception $e) {
            Log::error('Delhivery pincode check exception', ['pin' => $pin, 'error' => $e->getMessage()]);
            return ['status' => 'error', 'serviceable' => false, 'message' => 'API error: ' . $e->getMessage()];
        }
    }

    public static function get_shipping_charges($destination_pin, $payment_type = 'COD', $cod_amount = 0, $weight_grams = 500)
    {
        $config = Helpers::get_shipping_config();

        if (!$config || !$config->status) {
            return ['status' => 'error', 'message' => 'Delhivery is not active'];
        }

        $api_token = $config->api_secret;

        // Get origin pincode from admin warehouse
        $o_pin = '305001';
        $admin = \App\Model\Admin::whereNotNull('wherehouse')->first();
        if ($admin && $admin->wherehouse) {
            $wherehouse = is_array($admin->wherehouse) ? $admin->wherehouse : json_decode($admin->wherehouse, true);
            if (!empty($wherehouse['pincode'])) {
                $o_pin = $wherehouse['pincode'];
            }
        }

        $url = self::base_url() . "/api/kinko/v1/invoice/charges/.json";

        $params = [
            'md' => 'E',
            'ss' => 'Delivered',
            'd_pin' => $destination_pin,
            'o_pin' => $o_pin,
            'cgm' => $weight_grams,
            'pt' => $payment_type,
            'cod' => $cod_amount
        ];

        Log::info('Delhivery shipping charges API', ['params' => $params]);

        try {
            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => 'Token ' . $api_token,
                'Content-Type' => 'application/json'
            ])->timeout(10)->get($url, $params);

            $body = $response->json();

            Log::info('Delhivery shipping charges response', [
                'status_code' => $response->status(),
                'body' => $body
            ]);

            if ($response->successful() && isset($body[0])) {
                $charges = $body[0];
                $total_amount = $charges['total_amount'] ?? $charges['amount'] ?? 0;
                $freight = $charges['freight'] ?? 0;
                $cod_charge = $charges['cod_charges'] ?? 0;
                $tax = $charges['tax'] ?? 0;
                $other_charges = $charges['other_charges'] ?? 0;

                return [
                    'status' => 'success',
                    'total_amount' => (float) $total_amount,
                    'freight' => (float) $freight,
                    'cod_charge' => (float) $cod_charge,
                    'tax' => (float) $tax,
                    'other_charges' => (float) $other_charges,
                    'amount_text' => \App\CPU\Helpers::currency_converter($total_amount)
                ];
            }

            return [
                'status' => 'error',
                'message' => 'Unable to calculate shipping charges.',
                'data' => $body ?? []
            ];
        } catch (\Exception $e) {
            Log::error('Delhivery shipping charges exception', ['error' => $e->getMessage()]);
            return ['status' => 'error', 'message' => 'API error: ' . $e->getMessage()];
        }
    }
}
