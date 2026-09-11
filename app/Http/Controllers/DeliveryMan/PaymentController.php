<?php

namespace App\Http\Controllers\DeliveryMan;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\BusinessSetting;
use App\Model\DeliverymanWallet;
use App\Model\DeliveryManTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
    public function verify_payment(Request $request)
    {
        $deliveryMan = auth('delivery_man')->user();

        $request->validate([
            'order_id' => 'required|integer',
            'payment_method' => 'required|string',
            'transaction_id' => 'nullable|string',
        ]);

        $order = Order::where('id', $request->order_id)
            ->where('delivery_man_id', $deliveryMan->id)
            ->where('payment_status', 'unpaid')
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found or already paid.'
            ], 404);
        }

        $order->payment_status = 'paid';
        $order->payment_method = $request->payment_method;
        $order->save();

        Log::info('Delivery Man - Payment Verified', [
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id ?? 'N/A',
            'delivery_man_id' => $deliveryMan->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment received successfully!',
            'order_id' => $order->id,
            'amount' => $order->order_amount,
        ]);
    }

    public function create_razorpay_order(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
        ]);

        $deliveryMan = auth('delivery_man')->user();
        $order = Order::where('id', $request->order_id)
            ->where('delivery_man_id', $deliveryMan->id)
            ->where('payment_status', 'unpaid')
            ->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        $config = Helpers::get_business_settings('razor_pay');
        if (!$config || !$config['status']) {
            return response()->json(['success' => false, 'message' => 'Razorpay not enabled'], 400);
        }

        $amount = round(\App\CPU\Convert::usdToinr($order->order_amount)) * 100;

        try {
            $client = new \Razorpay\Api\Api($config['razor_key'], $config['razor_secret']);
            $orderData = [
                'receipt' => 'order_' . $order->id,
                'amount' => $amount,
                'currency' => 'INR',
            ];
            $razorpayOrder = $client->order->create($orderData);

            return response()->json([
                'success' => true,
                'key' => $config['razor_key'],
                'order_id' => $razorpayOrder->id,
                'amount' => $razorpayOrder->amount,
                'currency' => 'INR',
                'name' => \App\Model\BusinessSetting::where('type', 'company_name')->first()->value ?? 'Store',
                'description' => 'Order #' . $order->id,
                'image' => asset(config('app.public_storage_path') . '/company/' . (\App\Model\BusinessSetting::where('type', 'company_web_logo')->first()->value ?? '')),
                'customer_name' => $order->customer->f_name . ' ' . $order->customer->l_name,
                'customer_email' => $order->customer->email ?? '',
                'customer_contact' => $order->shippingAddress->phone ?? '',
            ]);
        } catch (\Exception $e) {
            Log::error('Razorpay Order Create Error', ['order_id' => $order->id, 'error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Failed to create order: ' . $e->getMessage()], 500);
        }
    }

    public function phonepe_get_url(Request $request)
    {
        $deliveryMan = auth('delivery_man')->user();

        $request->validate([
            'order_id' => 'required|integer',
        ]);

        $order = Order::where('id', $request->order_id)
            ->where('delivery_man_id', $deliveryMan->id)
            ->where('payment_status', 'unpaid')
            ->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found or already paid'], 404);
        }

        $setting = BusinessSetting::where('type', 'phone_pe')->first();
        if (!$setting) {
            return response()->json(['success' => false, 'message' => 'PhonePe not configured'], 400);
        }

        $config = json_decode($setting->value, true);
        if (!($config['status'] ?? false)) {
            return response()->json(['success' => false, 'message' => 'PhonePe is disabled'], 400);
        }

        $merchantId = trim($config['phone_pe_merchant_code'] ?? '');
        $saltKey = trim($config['phone_pe_secret_key'] ?? '');
        $saltIndex = trim($config['phone_pe_salt_index'] ?? '1');
        if (empty($saltIndex)) $saltIndex = '1';

        $merchantTransactionId = 'DM_PP_' . $order->id . '_' . time();
        $amountPaise = round(\App\CPU\Convert::usdToinr($order->order_amount) * 100);

        $mode = strtolower($config['environment'] ?? 'sandbox');
        $isV2 = !empty($config['phone_pe_client_id']);

        if ($isV2) {
            $accessToken = $this->phonepeGetV2AccessToken($config);
            if (!$accessToken) {
                return response()->json(['success' => false, 'message' => 'PhonePe authentication failed'], 500);
            }

            $baseUrl = ($mode == 'live') ? 'https://api.phonepe.com/apis/pg' : 'https://api-preprod.phonepe.com/apis/pg-sandbox';
            $url = $baseUrl . '/checkout/v2/pay';

            $payload = [
                "merchantOrderId" => $merchantTransactionId,
                "amount" => $amountPaise,
                "paymentFlow" => [
                    "type" => "PG_CHECKOUT",
                    "merchantUrls" => [
                        "redirectUrl" => route('delivery-man.payment.phonepe-response')
                    ]
                ]
            ];

            try {
                $client = new Client();
                $response = $client->post($url, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'O-Bearer ' . $accessToken,
                    ],
                    'json' => $payload,
                    'http_errors' => false,
                ]);

                $responseData = json_decode($response->getBody(), true);

                if ($response->getStatusCode() == 200 && isset($responseData['redirectUrl'])) {
                    session()->put('dm_phonepe_txn_id', $merchantTransactionId);
                    session()->put('dm_phonepe_order_id', $order->id);
                    return response()->json(['success' => true, 'redirect_url' => $responseData['redirectUrl']]);
                }

                $msg = $responseData['message'] ?? 'Payment initiation failed';
                return response()->json(['success' => false, 'message' => 'PhonePe Error: ' . $msg], 500);
            } catch (\Exception $e) {
                Log::error('PhonePe V2 AJAX Error', ['order_id' => $order->id, 'error' => $e->getMessage()]);
                return response()->json(['success' => false, 'message' => 'PhonePe connection failed'], 500);
            }
        }

        $data = [
            'merchantId' => $merchantId,
            'merchantTransactionId' => $merchantTransactionId,
            'merchantUserId' => 'DM_' . $deliveryMan->id,
            'amount' => $amountPaise,
            'redirectUrl' => route('delivery-man.payment.phonepe-response'),
            'redirectMode' => 'REDIRECT',
            'callbackUrl' => route('delivery-man.payment.phonepe-response'),
            'mobileNumber' => $order->shippingAddress->phone ?? '9999999999',
            'paymentInstrument' => [
                'type' => 'PAY_PAGE'
            ]
        ];

        $encode = json_encode($data, JSON_UNESCAPED_SLASHES);
        $base64 = base64_encode($encode);
        $fullString = $base64 . '/pg/v1/pay' . $saltKey;
        $sha256 = hash('sha256', $fullString);
        $finalXHeader = $sha256 . '###' . $saltIndex;

        $baseUrl = ($mode == 'live') ? 'https://api.phonepe.com/apis/hermes' : 'https://api-preprod.phonepe.com/apis/pg-sandbox';
        $url = $baseUrl . '/pg/v1/pay';

        try {
            $client = new Client();
            $response = $client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-VERIFY' => $finalXHeader,
                ],
                'json' => ['request' => $base64],
                'http_errors' => false,
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['success']) && $responseData['success'] == true && isset($responseData['data']['instrumentResponse']['redirectInfo']['url'])) {
                session()->put('dm_phonepe_txn_id', $merchantTransactionId);
                session()->put('dm_phonepe_order_id', $order->id);
                return response()->json(['success' => true, 'redirect_url' => $responseData['data']['instrumentResponse']['redirectInfo']['url']]);
            }

            $msg = $responseData['message'] ?? 'Payment initiation failed';
            return response()->json(['success' => false, 'message' => 'PhonePe Error: ' . $msg], 500);
        } catch (\Exception $e) {
            Log::error('PhonePe AJAX Error', ['order_id' => $order->id, 'error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'PhonePe connection failed'], 500);
        }
    }

    public function phonepe_payment(Request $request)
    {
        $deliveryMan = auth('delivery_man')->user();
        $orderId = $request->query('order_id');

        if (!$orderId) {
            return redirect()->route('delivery-man.orders')->with('error', 'Order ID missing');
        }

        $order = Order::where('id', $orderId)
            ->where('delivery_man_id', $deliveryMan->id)
            ->where('payment_status', 'unpaid')
            ->first();

        if (!$order) {
            return redirect()->route('delivery-man.orders')->with('error', 'Order not found or already paid');
        }

        $setting = BusinessSetting::where('type', 'phone_pe')->first();
        if (!$setting) {
            return redirect()->route('delivery-man.order-details', $orderId)->with('error', 'PhonePe not configured');
        }

        $config = json_decode($setting->value, true);
        if (!($config['status'] ?? false)) {
            return redirect()->route('delivery-man.order-details', $orderId)->with('error', 'PhonePe is disabled');
        }

        $merchantId = trim($config['phone_pe_merchant_code'] ?? '');
        $saltKey = trim($config['phone_pe_secret_key'] ?? '');
        $saltIndex = trim($config['phone_pe_salt_index'] ?? '1');
        if (empty($saltIndex)) $saltIndex = '1';

        $merchantTransactionId = 'DM_PP_' . $order->id . '_' . time();
        $amountPaise = round(\App\CPU\Convert::usdToinr($order->order_amount) * 100);

        $isV2 = !empty($config['phone_pe_client_id']);

        if ($isV2) {
            $accessToken = $this->phonepeGetV2AccessToken($config);
            if (!$accessToken) {
                return redirect()->route('delivery-man.order-details', $orderId)->with('error', 'PhonePe authentication failed');
            }

            $mode = strtolower($config['environment'] ?? 'sandbox');
            $baseUrl = ($mode == 'live') ? 'https://api.phonepe.com/apis/pg' : 'https://api-preprod.phonepe.com/apis/pg-sandbox';
            $url = $baseUrl . '/checkout/v2/pay';

            $payload = [
                "merchantOrderId" => $merchantTransactionId,
                "amount" => $amountPaise,
                "paymentFlow" => [
                    "type" => "PG_CHECKOUT",
                    "merchantUrls" => [
                        "redirectUrl" => route('delivery-man.payment.phonepe-response')
                    ]
                ]
            ];

            try {
                $client = new Client();
                $response = $client->post($url, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'O-Bearer ' . $accessToken,
                    ],
                    'json' => $payload,
                    'http_errors' => false,
                ]);

                $responseData = json_decode($response->getBody(), true);

                if ($response->getStatusCode() == 200 && isset($responseData['redirectUrl'])) {
                    session()->put('dm_phonepe_txn_id', $merchantTransactionId);
                    session()->put('dm_phonepe_order_id', $order->id);
                    return redirect()->away($responseData['redirectUrl']);
                }

                $msg = $responseData['message'] ?? 'Payment initiation failed';
                return redirect()->route('delivery-man.order-details', $orderId)->with('error', 'PhonePe Error: ' . $msg);
            } catch (\Exception $e) {
                Log::error('PhonePe V2 Error (Delivery Man)', ['order_id' => $order->id, 'error' => $e->getMessage()]);
                return redirect()->route('delivery-man.order-details', $orderId)->with('error', 'PhonePe connection failed');
            }
        }

        $data = [
            'merchantId' => $merchantId,
            'merchantTransactionId' => $merchantTransactionId,
            'merchantUserId' => 'DM_' . $deliveryMan->id,
            'amount' => $amountPaise,
            'redirectUrl' => route('delivery-man.payment.phonepe-response'),
            'redirectMode' => 'POST',
            'callbackUrl' => route('delivery-man.payment.phonepe-response'),
            'mobileNumber' => $order->shippingAddress->phone ?? '9999999999',
            'paymentInstrument' => [
                'type' => 'PAY_PAGE'
            ]
        ];

        $encode = json_encode($data, JSON_UNESCAPED_SLASHES);
        $base64 = base64_encode($encode);
        $fullString = $base64 . '/pg/v1/pay' . $saltKey;
        $sha256 = hash('sha256', $fullString);
        $finalXHeader = $sha256 . '###' . $saltIndex;

        $mode = strtolower($config['environment'] ?? 'sandbox');
        $baseUrl = ($mode == 'live') ? 'https://api.phonepe.com/apis/hermes' : 'https://api-preprod.phonepe.com/apis/pg-sandbox';
        $url = $baseUrl . '/pg/v1/pay';

        try {
            $client = new Client();
            $response = $client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-VERIFY' => $finalXHeader,
                ],
                'json' => ['request' => $base64],
                'http_errors' => false,
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['success']) && $responseData['success'] == true && isset($responseData['data']['instrumentResponse']['redirectInfo']['url'])) {
                session()->put('dm_phonepe_txn_id', $merchantTransactionId);
                session()->put('dm_phonepe_order_id', $order->id);
                return redirect()->away($responseData['data']['instrumentResponse']['redirectInfo']['url']);
            }

            $msg = $responseData['message'] ?? 'Payment initiation failed';
            return redirect()->route('delivery-man.order-details', $orderId)->with('error', 'PhonePe Error: ' . $msg);
        } catch (\Exception $e) {
            Log::error('PhonePe Error (Delivery Man)', ['order_id' => $order->id, 'error' => $e->getMessage()]);
            return redirect()->route('delivery-man.order-details', $orderId)->with('error', 'PhonePe connection failed');
        }
    }

    public function phonepe_response(Request $request)
    {
        $merchantTransactionId = session()->get('dm_phonepe_txn_id');
        $orderId = session()->get('dm_phonepe_order_id');

        if (!$merchantTransactionId || !$orderId) {
            return redirect()->route('delivery-man.orders')->with('error', 'Payment session expired');
        }

        $setting = BusinessSetting::where('type', 'phone_pe')->first();
        $config = $setting ? json_decode($setting->value, true) : null;

        if (!$config) {
            return redirect()->route('delivery-man.order-details', $orderId)->with('error', 'PhonePe not configured');
        }

        $statusData = $this->phonepeCheckStatus($config, $merchantTransactionId);

        if ($statusData && isset($statusData['success']) && $statusData['success'] == true && $statusData['code'] == 'PAYMENT_SUCCESS') {
            $order = Order::find($orderId);
            if ($order) {
                $order->payment_status = 'paid';
                $order->payment_method = 'phone_pe';
                $order->save();

                Log::info('Delivery Man - PhonePe Payment Success', [
                    'order_id' => $orderId,
                    'txn_id' => $merchantTransactionId,
                ]);
            }

            session()->forget('dm_phonepe_txn_id');
            session()->forget('dm_phonepe_order_id');

            return redirect()->route('delivery-man.order-details', $orderId)->with('success', 'PhonePe payment successful!');
        }

        session()->forget('dm_phonepe_txn_id');
        session()->forget('dm_phonepe_order_id');

        return redirect()->route('delivery-man.order-details', $orderId)->with('error', 'PhonePe payment failed or cancelled');
    }

    private function phonepeGetV2AccessToken($config)
    {
        $clientId = trim($config['phone_pe_client_id'] ?? '');
        $clientSecret = trim($config['phone_pe_secret_key'] ?? '');
        $clientVersion = trim($config['phone_pe_client_version'] ?? $config['phone_pe_salt_index'] ?? '1');

        $mode = strtolower($config['environment'] ?? 'sandbox');
        $oauthUrl = ($mode == 'live')
            ? 'https://api.phonepe.com/apis/identity-manager/v1/oauth/token'
            : 'https://api-preprod.phonepe.com/apis/pg-sandbox/v1/oauth/token';

        try {
            $client = new Client();
            $response = $client->post($oauthUrl, [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                    'grant_type' => 'client_credentials',
                    'client_version' => $clientVersion,
                ],
                'http_errors' => false,
            ]);

            $data = json_decode($response->getBody(), true);
            if (isset($data['access_token'])) {
                return $data['access_token'];
            }
        } catch (\Exception $e) {
            Log::error('PhonePe V2 Token Error', ['error' => $e->getMessage()]);
        }
        return null;
    }

    private function phonepeCheckStatus($config, $merchantTransactionId)
    {
        $isV2 = !empty($config['phone_pe_client_id']);

        if ($isV2) {
            $accessToken = $this->phonepeGetV2AccessToken($config);
            if (!$accessToken) {
                return ['success' => false, 'code' => 'AUTH_FAILED'];
            }

            $mode = strtolower($config['environment'] ?? 'sandbox');
            $baseUrl = ($mode == 'live') ? 'https://api.phonepe.com/apis/pg' : 'https://api-preprod.phonepe.com/apis/pg-sandbox';
            $url = $baseUrl . '/checkout/v2/order/' . $merchantTransactionId . '/status';

            try {
                $client = new Client();
                $response = $client->get($url, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'O-Bearer ' . $accessToken,
                    ],
                    'http_errors' => false,
                ]);

                if ($response->getStatusCode() == 200) {
                    $responseData = json_decode($response->getBody(), true);
                    if (isset($responseData['state']) && $responseData['state'] == 'COMPLETED') {
                        return ['success' => true, 'code' => 'PAYMENT_SUCCESS'];
                    }
                    return ['success' => false, 'code' => $responseData['state'] ?? 'FAILED'];
                }
            } catch (\Exception $e) {
                Log::error('PhonePe V2 Status Check Error', ['error' => $e->getMessage()]);
            }
            return ['success' => false, 'code' => 'FAILED'];
        }

        $merchantId = trim($config['phone_pe_merchant_code'] ?? '');
        $saltKey = trim($config['phone_pe_secret_key'] ?? '');
        $saltIndex = trim($config['phone_pe_salt_index'] ?? '1');

        $string = '/pg/v1/status/' . $merchantId . '/' . $merchantTransactionId . $saltKey;
        $sha256 = hash('sha256', $string);
        $finalXHeader = $sha256 . '###' . $saltIndex;

        $mode = strtolower($config['environment'] ?? 'sandbox');
        $baseUrl = ($mode == 'live') ? 'https://api.phonepe.com/apis/hermes' : 'https://api-preprod.phonepe.com/apis/pg-sandbox';
        $url = $baseUrl . '/pg/v1/status/' . $merchantId . '/' . $merchantTransactionId;

        try {
            $client = new Client();
            $response = $client->get($url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-VERIFY' => $finalXHeader,
                    'X-MERCHANT-ID' => $merchantId,
                ],
                'http_errors' => false,
            ]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error('PhonePe Status Check Error', ['error' => $e->getMessage()]);
        }
        return null;
    }
}
