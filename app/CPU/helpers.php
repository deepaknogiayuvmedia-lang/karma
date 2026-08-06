<?php

namespace App\CPU;

use App\Model\Admin;
use App\Model\BusinessSetting;
use App\Model\Category;
use App\Model\Color;
use App\Model\Coupon;
use App\Model\Currency;
use App\Model\Order;
use App\Model\Review;
use App\Model\Seller;
use App\Model\ShippingMethod;
use App\User;
use Carbon\Carbon;
use Google\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Helpers
{
    public static function status($id)
    {
        if ($id == 1) {
            $x = 'active';
        } elseif ($id == 0) {
            $x = 'in-active';
        }

        return $x;
    }

    public static function transaction_formatter($transaction)
    {
        if ($transaction['paid_by'] == 'customer') {
            $user = User::find($transaction['payer_id']);
            $payer = $user->f_name . ' ' . $user->l_name;
        } elseif ($transaction['paid_by'] == 'seller') {
            $user = Seller::find($transaction['payer_id']);
            $payer = $user->f_name . ' ' . $user->l_name;
        } elseif ($transaction['paid_by'] == 'admin') {
            $user = Admin::find($transaction['payer_id']);
            $payer = $user->name;
        }

        if ($transaction['paid_to'] == 'customer') {
            $user = User::find($transaction['payment_receiver_id']);
            $receiver = $user->f_name . ' ' . $user->l_name;
        } elseif ($transaction['paid_to'] == 'seller') {
            $user = Seller::find($transaction['payment_receiver_id']);
            $receiver = $user->f_name . ' ' . $user->l_name;
        } elseif ($transaction['paid_to'] == 'admin') {
            $user = Admin::find($transaction['payment_receiver_id']);
            $receiver = $user->name;
        }

        $transaction['payer_info'] = $payer;
        $transaction['receiver_info'] = $receiver;

        return $transaction;
    }

    public static function get_customer($request = null)
    {
        $user = null;
        if (auth('customer')->check()) {
            $user = auth('customer')->user(); // for web
        } elseif ($request != null && $request->user() != null) {
            $user = $request->user(); //for api
        } elseif (session()->has('customer_id')) {
            $user = User::find(session('customer_id'));
        }

        if ($user == null) {
            $user = 'offline';
        }

        return $user;
    }

    public static function coupon_discount($request)
    {
        $discount = 0;
        $user = Helpers::get_customer($request);
        $couponLimit = Order::where('customer_id', $user->id)
            ->where('coupon_code', $request['coupon_code'])->count();

        $coupon = Coupon::where(['code' => $request['coupon_code']])
            ->where('limit', '>', $couponLimit)
            ->where('status', '=', 1)
            ->whereDate('start_date', '<=', Carbon::parse()->toDateString())
            ->whereDate('expire_date', '>=', Carbon::parse()->toDateString())->first();

        if (isset($coupon)) {
            $total = 0;
            foreach (CartManager::get_cart(CartManager::get_cart_group_ids($request)) as $cart) {
                $product_subtotal = $cart['price'] * $cart['quantity'];
                $total += $product_subtotal;
            }
            if ($total >= $coupon['min_purchase']) {
                if ($coupon['discount_type'] == 'percentage') {
                    $discount = (($total / 100) * $coupon['discount']) > $coupon['max_discount'] ? $coupon['max_discount'] : (($total / 100) * $coupon['discount']);
                } else {
                    $discount = $coupon['discount'];
                }
            }
        }

        return $discount;
    }

    public static function default_lang()
    {
        if (strpos(url()->current(), '/api')) {
            $lang = App::getLocale();
        } elseif (session()->has('local')) {
            $lang = session('local');
        } else {
            $data = Helpers::get_business_settings('language');
            $code = 'en';
            $direction = 'ltr';
            foreach ($data as $ln) {
                if (array_key_exists('default', $ln) && $ln['default']) {
                    $code = $ln['code'];
                    if (array_key_exists('direction', $ln)) {
                        $direction = $ln['direction'];
                    }
                }
            }
            session()->put('local', $code);
            Session::put('direction', $direction);
            $lang = $code;
        }
        return $lang;
    }

    public static function rating_count($product_id, $rating)
    {
        return Review::where(['product_id' => $product_id, 'rating' => $rating])->whereNull('delivery_man_id')->count();
    }

    public static function get_business_settings($name)
    {
        $config = null;
        $check = ['currency_model', 'currency_symbol_position', 'system_default_currency', 'language', 'company_name', 'decimal_point_settings'];
        // dump($name);
        if (in_array($name, $check) == true && session()->has($name)) {
            $config = session($name);
        } else {
            $data = BusinessSetting::where(['type' => $name])->first();
            if (isset($data)) {
                $config = json_decode($data['value'], true);
                if (is_null($config)) {
                    $config = $data['value'];
                }
            }

            if (in_array($name, $check) == true) {
                session()->put($name, $config);
            }
        }

        return $config;
    }

    public static function get_settings($object, $type)
    {
        $config = null;
        foreach ($object as $setting) {
            if ($setting['type'] == $type) {
                $config = $setting;
            }
        }
        return $config;
    }

    public static function get_shipping_methods($seller_id, $type)
    {
        if ($type == 'admin') {
            return ShippingMethod::where(['status' => 1])->where(['creator_type' => 'admin'])->get();
        } else {
            return ShippingMethod::where(['status' => 1])->where(['creator_id' => $seller_id, 'creator_type' => $type])->get();
        }
    }

    public static function get_image_path($type)
    {
        $path = asset(env('PUBLIC_STORAGE_PATH') . '/brand');
        return $path;
    }

    public static function set_data_format($data)
    {
        $colors = is_array($data['colors']) ? $data['colors'] : json_decode($data['colors']);
        $query_data = Color::whereIn('code', $colors)->pluck('name', 'code')->toArray();
        $color_final = [];
        foreach ($query_data as $key => $color) {
            $color_final[] = array(
                'name' => $color,
                'code' => $key,
            );
        }

        $variation = [];
        $data['category_ids'] = is_array($data['category_ids']) ? $data['category_ids'] : json_decode($data['category_ids']);
        $data['images'] = is_array($data['images']) ? $data['images'] : json_decode($data['images']);
        $data['color_image'] = isset($data['color_image']) ? (is_array($data['color_image']) ? $data['color_image'] : json_decode($data['color_image'])) : null;
        $data['colors_formatted'] = $color_final;
        $attributes = [];
        if ((is_array($data['attributes']) ? $data['attributes'] : json_decode($data['attributes'])) != null) {
            $attributes_arr = is_array($data['attributes']) ? $data['attributes'] : json_decode($data['attributes']);
            foreach ($attributes_arr as $attribute) {
                $attributes[] = (int)$attribute;
            }
        }
        $data['attributes'] = $attributes;
        $data['choice_options'] = is_array($data['choice_options']) ? $data['choice_options'] : json_decode($data['choice_options']);
        $variation_arr = is_array($data['variation']) ? $data['variation'] : json_decode($data['variation'], true);
        foreach ($variation_arr as $var) {
            $variation[] = [
                'type' => $var['type'],
                'price' => (float)$var['price'],
                'sku' => $var['sku'],
                'qty' => (int)$var['qty'],
            ];
        }
        $data['variation'] = $variation;

        return $data;
    }


    public static function product_data_formatting($data, $multi_data = false)
    {
        if ($data) {
            $storage = [];
            if ($multi_data == true) {
                foreach ($data as $item) {
                    $storage[] = Helpers::set_data_format($item);
                }
                $data = $storage;
            } else {
                $data = Helpers::set_data_format($data);;
            }

            return $data;
        }
        return null;
    }

    public static function units()
    {
        $x = ['kg', 'pc', 'gms', 'ltrs'];
        return $x;
    }

    public static function remove_invalid_charcaters($str)
    {
        return str_ireplace(['\'', '"', ',', ';', '<', '>', '?'], ' ', preg_replace('/\s\s+/', ' ', $str));
    }

    public static function saveJSONFile($code, $data)
    {
        ksort($data);
        $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(base_path('resources/lang/en/messages.json'), stripslashes($jsonData));
    }

    public static function combinations($arrays)
    {
        $result = [[]];
        foreach ($arrays as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, [$property => $property_value]);
                }
            }
            $result = $tmp;
        }
        return $result;
    }

    public static function error_processor($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            $err_keeper[] = ['code' => $index, 'message' => $error[0]];
        }
        return $err_keeper;
    }

    public static function currency_load()
    {
        $default = Helpers::get_business_settings('system_default_currency');
        $current = \session('system_default_currency_info');
        if (session()->has('system_default_currency_info') == false || $default != $current['id']) {
            $id = Helpers::get_business_settings('system_default_currency');
            $currency = Currency::find($id);
            session()->put('system_default_currency_info', $currency);
            session()->put('currency_code', $currency->code);
            session()->put('currency_symbol', $currency->symbol);
            session()->put('currency_exchange_rate', $currency->exchange_rate);
        }
    }

    public static function currency_converter($amount)
    {
        // Multi-currency removed - website supports INR only
        $rate = 1;

        return Helpers::set_symbol(round($amount * $rate, 2));
    }

    public static function language_load()
    {
        if (\session()->has('language_settings')) {
            $language = \session('language_settings');
        } else {
            $language = BusinessSetting::where('type', 'language')->first();
            \session()->put('language_settings', $language);
        }
        return $language;
    }

    public static function tax_calculation($price, $tax, $tax_type)
    {
        $amount = ($price / 100) * $tax;
        return $amount;
    }

    public static function get_price_range($product)
    {
        $lowest_price = $product->unit_price;
        $highest_price = $product->unit_price;

        foreach (json_decode($product->variation) as $key => $variation) {
            if ($lowest_price > $variation->price) {
                $lowest_price = round($variation->price, 2);
            }
            if ($highest_price < $variation->price) {
                $highest_price = round($variation->price, 2);
            }
        }

        $lowest_price = Helpers::currency_converter($lowest_price - Helpers::get_product_discount($product, $lowest_price));
        $highest_price = Helpers::currency_converter($highest_price - Helpers::get_product_discount($product, $highest_price));

        if ($lowest_price == $highest_price) {
            return $lowest_price;
        }
        return $lowest_price . ' - ' . $highest_price;
    }

    public static function get_product_discount($product, $price)
    {
        $discount = 0;
        if ($product->discount_type == 'percent') {
            $discount = ($price * $product->discount) / 100;
        } elseif ($product->discount_type == 'flat') {
            $discount = $product->discount;
        }

        return floatval($discount);
    }

    public static function module_permission_check($mod_name)
    {
        $user_role = auth('admin')->user()->role;
        $permission = $user_role->module_access;
        if (isset($permission) && $user_role->status == 1 && in_array($mod_name, (array)json_decode($permission)) == true) {
            return true;
        }

        if (auth('admin')->user()->admin_role_id == 1) {
            return true;
        }
        return false;
    }

    public static function convert_currency_to_usd($price)
    {
        // Multi-currency removed - website supports INR only
        return floatval($price);
    }

    public static function order_status_update_message($status)
    {
        if ($status == 'pending') {
            $data = BusinessSetting::where('type', 'order_pending_message')->first()->value;
        } elseif ($status == 'confirmed') {
            $data = BusinessSetting::where('type', 'order_confirmation_msg')->first()->value;
        } elseif ($status == 'processing') {
            $data = BusinessSetting::where('type', 'order_processing_message')->first()->value;
        } elseif ($status == 'out_for_delivery') {
            $data = BusinessSetting::where('type', 'out_for_delivery_message')->first()->value;
        } elseif ($status == 'delivered') {
            $data = BusinessSetting::where('type', 'order_delivered_message')->first()->value;
        } elseif ($status == 'returned') {
            $data = BusinessSetting::where('type', 'order_returned_message')->first()->value;
        } elseif ($status == 'failed') {
            $data = BusinessSetting::where('type', 'order_failed_message')->first()->value;
        } elseif ($status == 'delivery_boy_delivered') {
            $data = BusinessSetting::where('type', 'delivery_boy_delivered_message')->first()->value;
        } elseif ($status == 'del_assign') {
            $data = BusinessSetting::where('type', 'delivery_boy_assign_message')->first()->value;
        } elseif ($status == 'ord_start') {
            $data = BusinessSetting::where('type', 'delivery_boy_start_message')->first()->value;
        } elseif ($status == 'expected_delivery_date') {
            $data = BusinessSetting::where('type', 'delivery_boy_expected_delivery_date_message')->first()->value;
        } elseif ($status == 'canceled') {
            $data = BusinessSetting::where('type', 'order_canceled')->first()->value;
        } else {
            $data = '{"status":"0","message":""}';
        }

        $res = json_decode($data, true);

        if ($res['status'] == 0) {
            return 0;
        }
        return $res['message'];
    }

    
    /**
     * Device wise notification send (FCM HTTP v1 API)
     */
    public static function send_push_notif_to_device($fcm_token, $data)
    {
      
        if (empty($fcm_token)) {
            return null;
        }
        if (empty($data)) {
            return null;
        }
      
        if (!isset($data['order_id'])) {
            $data['order_id'] = null;
            
        }
        $client = new Client();
        $client->setAuthConfig(storage_path('app/firebase-adminsdk.json'));
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        $tokenData = $client->fetchAccessTokenWithAssertion();

        $accessToken = $tokenData['access_token'] ?? ($client->getAccessToken()['access_token'] ?? null);
        
        $project_id = self::get_business_settings('fcm_project_id');
        $url = "https://fcm.googleapis.com/v1/projects/". $project_id ."/messages:send";

        $image = asset(env('PUBLIC_STORAGE_PATH') . '/notification') . '/' . $data['image'];

        $response = \Illuminate\Support\Facades\Http::withToken($accessToken)->post($url, [
            "message" => [
                "token" => $fcm_token,
                "notification" => [
                    "title" => $data['title'],
                    "body"  => $data['description'],
                    "image" => $image,
                ],
                "data" => [
                    "title"    => $data['title'],
                    "body"     => $data['description'],
                    "image"    => $image,
                    "order_id" => (string)($data['order_id'] ?? ''),
                    "is_read"  => "0",
                ],
            ]
        ]);
       
        return $response->json();
    }

    public static function send_push_notif_to_topic($data)
    {
        $project_id = self::get_business_settings('fcm_project_id');

        $url = "https://fcm.googleapis.com/v1/projects/" . $project_id . "/messages:send";

        $accessToken = self::getAccessToken();

        $header = [
            "Authorization: Bearer " . $accessToken,
            "Content-Type: application/json"
        ];
        $image = asset(env('PUBLIC_STORAGE_PATH') . '/notification') . '/' . $data['image'];
        $topic = $data->role_type ?? 'sixvalley';
        $postdata = json_encode([
            "message" => [
                "topic" => $topic,
                "notification" => [
                    "title" => $data->title,
                    "body" => $data->description,
                    "image" => $image
                ],
                "data" => [
                    "title" => $data->title,
                    "body" => $data->description,
                    "image" => $image,
                    "is_read" => "0"
                ]
            ]
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);
        // dd($result);
        curl_close($ch);

        return $result;
    }

    public static function send_whatsapp_notification($phone, $status, $order_id = null)
    {
        $config = self::get_whatsapp_config();
        
        if (!$config || !$config->access_token || !$config->phone_number_id) {
            return [
                'status'  => 0,
                'message' => 'WhatsApp configuration missing'
            ];
        }
        // Map order status → template "type" value stored in JSON
        $status_map = [
            'pending'   => 'confirmed',
            'confirmed' => 'confirmed',
            'processing' => 'processing',
            'out_for_delivery' => 'processing',
            'canceled'  => 'canceled',
            'returned'  => 'returned',
            'failed'    => 'canceled',
        ];

        $type = $status_map[$status] ?? $status;
        // dd($type);
        // Load templates from JSON and find the one matching the type
        $json      = file_get_contents(base_path('whatsapp_templates.json'));
        $templates = json_decode($json, true) ?? [];
        $template  = collect($templates)->firstWhere('type', $type);

        if (!$template) {
            return [
                'status'  => 0,
                'message' => 'No WhatsApp template found in JSON for type: ' . $status
            ];
        }

        // Fetch order + relations for building template parameters
        $order = null;
        if ($order_id) {
            $order = \App\Model\Order::with(['customer', 'details.product', 'shippingAddress'])->find($order_id);
        }
        dump($template);
        // Clean phone number - keep digits only
        dump($phone);
        $phone = preg_replace('/[^0-9]/', '', $phone);
        // Auto-add India country code if 10-digit number
        if (strlen($phone) === 10) {
            $phone = '91' . $phone;
        }

        // Remove leading zero (e.g. 0XXXXXXXXXX → 91XXXXXXXXXX)
        if (strlen($phone) === 11 && $phone[0] === '0') {
            $phone = '91' . substr($phone, 1);
        }

        // Validate phone is not empty
        if (empty($phone)) {
            return [
                'status'  => 0,
                'message' => 'Phone number is empty or invalid'
            ];
        }
        $url = "https://graph.facebook.com/v25.0/{$config->phone_number_id}/messages";
        dump($url);

        $body = [
            "messaging_product" => "whatsapp",
            "to"                => $phone,
            "type"              => "template",
            "template"          => [
                "name"     => $template['name'],
                "language" => [
                    "code" => $template['language']
                ]
            ]
        ];
        dump($body);
        // Build named parameters from order data based on each template's variables
        if ($order) {
            $customer_name = trim(($order->customer->f_name ?? '') . ' ' . ($order->customer->l_name ?? '')) ?: 'Customer';
            $first_detail  = $order->details->first();
            $product_name  = $first_detail?->product?->name ?? 'Product';
            $qty           = $order->details->sum('qty');
            $order_amount  = '₹' . number_format($order->order_amount, 2);
            $shop_name     = self::get_business_settings('company_name') ?? 'Our Store';
            $delivery_date = $order->expected_delivery_date
                ? date('d M Y', strtotime($order->expected_delivery_date))
                : 'Soon';
            $address      = $order->shippingAddress?->address ?? 'N/A';
            $order_id_str = (string)$order->id;

            /*
             * Parameter maps per template name
             * order_confirmation_2 : name, p_name, qty, o_id, d_address, d_date, category, ps_name
             * packaging_order      : name, o_id, p_name, qty, d_date, s_name
             * order_cancelled      : name, id, amount
             * order_recovery       : name, s_name, email
             */
            $param_map = [
                'order_confirmation_2' => [
                    ['parameter_name' => 'name',      'text' => $customer_name],
                    ['parameter_name' => 'p_name1',    'text' => $product_name],
                    ['parameter_name' => 'p_name2',    'text' => $product_name],
                    ['parameter_name' => 'qty',       'text' => (string)$qty],
                    ['parameter_name' => 'o_id',      'text' => '#' . $order_id_str],
                    ['parameter_name' => 'd_address', 'text' => $address],
                    ['parameter_name' => 'd_date',    'text' => $delivery_date],
                    ['parameter_name' => 'category',  'text' => 'Order'],
                    ['parameter_name' => 'ps_name',   'text' => $shop_name],
                ],
                'packaging_order' => [
                    ['parameter_name' => 'name',   'text' => $customer_name],
                    ['parameter_name' => 'o_id',   'text' => '#' . $order_id_str],
                    ['parameter_name' => 'p_name', 'text' => $product_name],
                    ['parameter_name' => 'qty',    'text' => (string)$qty],
                    ['parameter_name' => 'd_date', 'text' => $delivery_date],
                    ['parameter_name' => 's_name', 'text' => $shop_name],
                ],
                'order_cancelled' => [
                    ['parameter_name' => 'name',   'text' => $customer_name],
                    ['parameter_name' => 'id',     'text' => '#' . $order_id_str],
                    ['parameter_name' => 'amount', 'text' => $order_amount],
                ],
                'order_recovery' => [
                    ['parameter_name' => 'name',   'text' => $customer_name],
                    ['parameter_name' => 's_name', 'text' => $shop_name],
                    ['parameter_name' => 'email',  'text' => $order->customer?->email ?? ''],
                ],
            ];

            if (isset($param_map[$template['name']])) {
                $parameters = array_map(
                    function($p) { return array_merge(['type' => 'text'], $p); },
                    $param_map[$template['name']]
                );
                $body['template']['components'] = [
                    [
                        'type'       => 'body',
                        'parameters' => $parameters,
                    ]
                ];
            }
        }
        dump($body);
        try {
            $response = \Illuminate\Support\Facades\Http::withToken($config->access_token)
                ->post($url, $body);

            \Illuminate\Support\Facades\Log::info('WhatsApp Send Request', [
                'url'  => $url,
                'body' => $body,
            ]);
             dump($response->body());
            if ($response->successful()) {
                \Illuminate\Support\Facades\Log::info('WhatsApp Send Success', $response->json());
                return [
                    'status'  => 1,
                    'message' => 'WhatsApp message sent successfully',
                    'data'    => $response->json()
                ];
            } else {
                \Illuminate\Support\Facades\Log::error('WhatsApp Send Failed', [
                    'http_status' => $response->status(),
                    'response'    => $response->json(),
                ]);
                return [
                    'status'  => 0,
                    'message' => 'WhatsApp API Error: ' . ($response->json()['error']['message'] ?? 'Unknown error'),
                    'data'    => $response->json()
                ];
            }
        } catch (\Exception $e) {
            return [
                'status'  => 0,
                'message' => 'Exception: ' . $e->getMessage()
            ];
        }
    }



    public static function get_seller_by_token($request)
    {
        $data = '';
        $success = 0;

        $token = explode(' ', $request->header('authorization'));
        if (count($token) > 1 && strlen($token[1]) > 30) {
            $seller = Seller::where(['auth_token' => $token['1']])->first();
            if (isset($seller)) {
                $data = $seller;
                $success = 1;
            }
        }

        return [
            'success' => $success,
            'data' => $data
        ];
    }

    public static function remove_dir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir") Helpers::remove_dir($dir . "/" . $object);
                    else unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    public static function currency_code()
    {
        Helpers::currency_load();
        if (session()->has('currency_symbol')) {
            $symbol = session('currency_symbol');
            $code = Currency::where(['symbol' => $symbol])->first()->code;
        } else {
            $system_default_currency_info = session('system_default_currency_info');
            $code = $system_default_currency_info->code;
        }
        return $code;
    }

    public static function get_language_name($key)
    {
        $values = Helpers::get_business_settings('language');
        foreach ($values as $value) {
            if ($value['code'] == $key) {
                $key = $value['name'];
            }
        }

        return $key;
    }

    public static function setEnvironmentValue($envKey, $envValue)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        if (is_bool(env($envKey))) {
            $oldValue = var_export(env($envKey), true);
        } else {
            $oldValue = env($envKey);
        }

        if (strpos($str, $envKey) !== false) {
            $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}", $str);
        } else {
            $str .= "{$envKey}={$envValue}\n";
        }
        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
        return $envValue;
    }

    public static function requestSender()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => route(base64_decode('YWN0aXZhdGlvbi1jaGVjaw==')),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        $data = json_decode($response, true);
        return $data;
    }

    public static function sales_commission($order)
    {
        $discount_amount = 0;
        if ($order->coupon_code) {
            $coupon = Coupon::where(['code' => $order->coupon_code])->first();
            if ($coupon) {
                $discount_amount = $coupon->coupon_type == 'free_delivery' ? 0 : $order['discount_amount'];
            }
        }
        $order_summery = OrderManager::order_summary($order);
        $order_total = $order_summery['subtotal'] - $order_summery['total_discount_on_product'] - $discount_amount;
        $commission_amount = self::seller_sales_commission($order['seller_is'], $order['seller_id'], $order_total);

        return $commission_amount;
    }

    public static function sales_commission_before_order($cart_group_id, $coupon_discount)
    {
        $carts = CartManager::get_cart($cart_group_id);
        $cart_summery = OrderManager::order_summary_before_place_order($carts, $coupon_discount);
        $commission_amount = self::seller_sales_commission($carts[0]['seller_is'], $carts[0]['seller_id'], $cart_summery['order_total']);

        return $commission_amount;
    }

    public static function seller_sales_commission($seller_is, $seller_id, $order_total)
    {
        $commission_amount = 0;
        if ($seller_is == 'seller') {
            $seller = Seller::find($seller_id);
            if (isset($seller) && $seller['sales_commission_percentage'] !== null) {
                $commission = $seller['sales_commission_percentage'];
            } else {
                $commission = Helpers::get_business_settings('sales_commission');
            }
            $commission_amount = number_format(($order_total / 100) * $commission, 2);
        }
        return $commission_amount;
    }

    /**
     * Calculate commission for a single product (Phase 6: Per-Product Commission)
     * Priority: Product → Seller → Global
     */
    public static function product_commission($product, $product_price = null)
    {
        $price = $product_price ?? $product->unit_price;
        $commission_amount = 0;

        // 1. Check product-level commission first
        if ($product->admin_commission > 0) {
            if ($product->admin_commission_type === 'fixed') {
                $commission_amount = $product->admin_commission;
            } else {
                // Percentage
                $commission_amount = ($price / 100) * $product->admin_commission;
            }
        }
        // 2. Check seller-level commission
        elseif ($product->seller && $product->seller->sales_commission_percentage !== null) {
            $commission = $product->seller->sales_commission_percentage;
            $commission_amount = ($price / 100) * $commission;
        }
        // 3. Fall back to global commission
        else {
            $commission = Helpers::get_business_settings('sales_commission');
            $commission_amount = ($price / 100) * $commission;
        }

        return number_format($commission_amount, 2);
    }

    /**
     * Get commission info for display (Phase 15: Seller Commission View)
     * Returns array with commission details
     */
    public static function get_commission_info($product, $quantity = 1)
    {
        $unit_price = $product->unit_price;
        $total_price = $unit_price * $quantity;
        $commission_amount = floatval(self::product_commission($product, $unit_price)) * $quantity;
        $seller_earnings = $total_price - $commission_amount;

        return [
            'product_price' => $total_price,
            'commission_amount' => $commission_amount,
            'commission_type' => $product->admin_commission_type ?? 'percentage',
            'commission_value' => $product->admin_commission ?? 0,
            'seller_earnings' => $seller_earnings,
            'net_amount' => $seller_earnings,
        ];
    }

    public static function categoryName($id)
    {
        return Category::select('name')->find($id)->name;
    }

    public static function set_symbol($amount)
    {
        $decimal_point_settings = Helpers::get_business_settings('decimal_point_settings');
        $position = Helpers::get_business_settings('currency_symbol_position');
        if (!is_null($position) && $position == 'left') {
            $string = currency_symbol() . '' . number_format($amount, (!empty($decimal_point_settings) ? $decimal_point_settings : 0));
        } else {
            $string = number_format($amount, !empty($decimal_point_settings) ? $decimal_point_settings : 0) . '' . currency_symbol();
        }
        return $string;
    }

    public static function pagination_limit()
    {
        $pagination_limit = BusinessSetting::where('type', 'pagination_limit')->first();
        if ($pagination_limit != null) {
            return $pagination_limit->value;
        } else {
            return 25;
        }
    }

    public static function gen_mpdf($view, $file_prefix, $file_postfix)
    {
        $mpdf = new \Mpdf\Mpdf(['default_font' => 'FreeSerif', 'mode' => 'utf-8', 'format' => [190, 250]]);
        /* $mpdf->AddPage('XL', '', '', '', '', 10, 10, 10, '10', '270', '');*/
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;

        $mpdf_view = $view;
        $mpdf_view = $mpdf_view->render();
        $mpdf->WriteHTML($mpdf_view);
        $mpdf->Output($file_prefix . $file_postfix . '.pdf', 'D');
    }

    public static function get_whatsapp_config()
    {
        $whatsapp = \App\Model\WhatsAppSetting::where('user_id', auth('admin')->id())->first();
        if (!$whatsapp) {
            $whatsapp = \App\Model\WhatsAppSetting::first();
        }
        return $whatsapp;
    }

    public static function get_shipping_config()
    {
        $config = \App\Model\ThirdPartyShippingMethod::where('user_id', auth('admin')->id())->first();
        if (!$config) {
            $config = \App\Model\ThirdPartyShippingMethod::first();
        }
        return $config;
    }
}


if (!function_exists('currency_symbol')) {
    function currency_symbol()
    {
        Helpers::currency_load();
        if (\session()->has('currency_symbol')) {
            $symbol = \session('currency_symbol');
        } else {
            $system_default_currency_info = \session('system_default_currency_info');
            $symbol = $system_default_currency_info->symbol;
        }
        return $symbol;
    }
}
//formats currency
if (!function_exists('format_price')) {
    function format_price($price)
    {
        return number_format($price, 2) . currency_symbol();
    }
}

function translate($key)
{
    $local = Helpers::default_lang();
    App::setLocale($local);

    try {
        $lang_array = include(base_path('resources/lang/' . $local . '/messages.php'));
        $processed_key = ucfirst(str_replace('_', ' ', Helpers::remove_invalid_charcaters($key)));
        $key = Helpers::remove_invalid_charcaters($key);
        if (!array_key_exists($key, $lang_array)) {
            $lang_array[$key] = $processed_key;
            $str = "<?php return " . var_export($lang_array, true) . ";";
            file_put_contents(base_path('resources/lang/' . $local . '/messages.php'), $str);
            $result = $processed_key;
        } else {
            $result = __('messages.' . $key);
        }
    } catch (\Exception $exception) {
        $result = __('messages.' . $key);
    }

    return $result;
}

function auto_translator($q, $sl, $tl)
{
    $res = file_get_contents("https://translate.googleapis.com/translate_a/single?client=gtx&ie=UTF-8&oe=UTF-8&dt=bd&dt=ex&dt=ld&dt=md&dt=qca&dt=rw&dt=rm&dt=ss&dt=t&dt=at&sl=" . $sl . "&tl=" . $tl . "&hl=hl&q=" . urlencode($q), $_SERVER['DOCUMENT_ROOT'] . "/transes.html");
    $res = json_decode($res);
    return str_replace('_', ' ', $res[0][0][0]);
}

function getLanguageCode(string $country_code): string
{
    $locales = array(
        'af-ZA',
        'am-ET',
        'ar-AE',
        'ar-BH',
        'ar-DZ',
        'ar-EG',
        'ar-IQ',
        'ar-JO',
        'ar-KW',
        'ar-LB',
        'ar-LY',
        'ar-MA',
        'ar-OM',
        'ar-QA',
        'ar-SA',
        'ar-SY',
        'ar-TN',
        'ar-YE',
        'az-Cyrl-AZ',
        'az-Latn-AZ',
        'be-BY',
        'bg-BG',
        'bn-BD',
        'bs-Cyrl-BA',
        'bs-Latn-BA',
        'cs-CZ',
        'da-DK',
        'de-AT',
        'de-CH',
        'de-DE',
        'de-LI',
        'de-LU',
        'dv-MV',
        'el-GR',
        'en-AU',
        'en-BZ',
        'en-CA',
        'en-GB',
        'en-IE',
        'en-JM',
        'en-MY',
        'en-NZ',
        'en-SG',
        'en-TT',
        'en-US',
        'en-ZA',
        'en-ZW',
        'es-AR',
        'es-BO',
        'es-CL',
        'es-CO',
        'es-CR',
        'es-DO',
        'es-EC',
        'es-ES',
        'es-GT',
        'es-HN',
        'es-MX',
        'es-NI',
        'es-PA',
        'es-PE',
        'es-PR',
        'es-PY',
        'es-SV',
        'es-US',
        'es-UY',
        'es-VE',
        'et-EE',
        'fa-IR',
        'fi-FI',
        'fil-PH',
        'fo-FO',
        'fr-BE',
        'fr-CA',
        'fr-CH',
        'fr-FR',
        'fr-LU',
        'fr-MC',
        'he-IL',
        'hi-IN',
        'hr-BA',
        'hr-HR',
        'hu-HU',
        'hy-AM',
        'id-ID',
        'ig-NG',
        'is-IS',
        'it-CH',
        'it-IT',
        'ja-JP',
        'ka-GE',
        'kk-KZ',
        'kl-GL',
        'km-KH',
        'ko-KR',
        'ky-KG',
        'lb-LU',
        'lo-LA',
        'lt-LT',
        'lv-LV',
        'mi-NZ',
        'mk-MK',
        'mn-MN',
        'ms-BN',
        'ms-MY',
        'mt-MT',
        'nb-NO',
        'ne-NP',
        'nl-BE',
        'nl-NL',
        'pl-PL',
        'prs-AF',
        'ps-AF',
        'pt-BR',
        'pt-PT',
        'ro-RO',
        'ru-RU',
        'rw-RW',
        'sv-SE',
        'si-LK',
        'sk-SK',
        'sl-SI',
        'sq-AL',
        'sr-Cyrl-BA',
        'sr-Cyrl-CS',
        'sr-Cyrl-ME',
        'sr-Cyrl-RS',
        'sr-Latn-BA',
        'sr-Latn-CS',
        'sr-Latn-ME',
        'sr-Latn-RS',
        'sw-KE',
        'tg-Cyrl-TJ',
        'th-TH',
        'tk-TM',
        'tr-TR',
        'uk-UA',
        'ur-PK',
        'uz-Cyrl-UZ',
        'uz-Latn-UZ',
        'vi-VN',
        'wo-SN',
        'yo-NG',
        'zh-CN',
        'zh-HK',
        'zh-MO',
        'zh-SG',
        'zh-TW'
    );

    foreach ($locales as $locale) {
        $locale_region = explode('-', $locale);
        if (strtoupper($country_code) == $locale_region[1]) {
            return $locale_region[0];
        }
    }

    return "en";
}
