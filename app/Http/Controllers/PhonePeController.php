<?php

namespace App\Http\Controllers;

use App\CPU\CartManager;
use App\CPU\Helpers;
use App\CPU\OrderManager;
use App\Model\BusinessSetting;
use App\Model\Order;
use Brian2694\Toastr\Facades\Toastr;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Log;

class PhonePeController extends Controller
{
    private function getConfig()
    {
        $setting = BusinessSetting::where('type', 'phone_pe')->first();
        if (!$setting) {
            return null;
        }
        return json_decode($setting->value, true);
    }

    private function getBaseUrl($config)
    {
        $mode = strtolower($config['environment'] ?? 'sandbox');
        if ($mode == 'live') {
            return 'https://api.phonepe.com/apis/hermes';
        }
        return 'https://api-preprod.phonepe.com/apis/pg-sandbox';
    }

    private function isV2($config)
    {
        return !empty($config['phone_pe_client_id']);
    }

    private function getV2AccessToken($config)
    {
        $clientId = trim($config['phone_pe_client_id'] ?? '');
        $clientSecret = trim($config['phone_pe_secret_key'] ?? '');
        // Prefer explicit client_version if set, otherwise fallback to salt_index (used previously)
        $clientVersion = trim($config['phone_pe_client_version'] ?? $config['phone_pe_salt_index'] ?? '1');
        
        $mode = strtolower($config['environment'] ?? 'sandbox');
        if ($mode == 'live') {
            $oauthUrl = 'https://api.phonepe.com/apis/identity-manager/v1/oauth/token';
        } else {
            $oauthUrl = 'https://api-preprod.phonepe.com/apis/pg-sandbox/v1/oauth/token';
        }

        try {
            $client = new Client();
            $response = $client->post($oauthUrl, [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => [
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                    'client_version' => $clientVersion,
                    'grant_type' => 'client_credentials'
                ],
                'http_errors' => false
            ]);
            
            if ($response->getStatusCode() == 200) {
                $tokenData = json_decode($response->getBody(), true);
                return $tokenData['access_token'] ?? null;
            } else {
                // Capture body for debugging (might be JSON with error message)
                $body = (string) $response->getBody();
                
                Log::error('PhonePe V2 OAuth failed: HTTP ' . $response->getStatusCode() . ' Body: ' . $body);
                return null;
            }
        } catch (\Exception $e) {
            \Log::error('PhonePe V2 OAuth Error: ' . $e->getMessage());
        }

        return null;
    }

    private function getV2BaseUrl($config)
    {
        $mode = strtolower($config['environment'] ?? 'sandbox');
        if ($mode == 'live') {
            return 'https://api.phonepe.com/apis/pg';
        }
        return 'https://api-preprod.phonepe.com/apis/pg-sandbox';
    }

    public function payment(Request $request)
    {
        $config = $this->getConfig();
        if (!$config || !($config['status'] ?? false)) {
            Toastr::error('PhonePe not configured');
            return back();
        }

        $order_id = Order::orderBy('id', 'DESC')->first()->id ?? 100001;
        $discount = session()->has('coupon_discount') ? session('coupon_discount') : 0;
        $amount = CartManager::cart_grand_total() - $discount;
        $amount = \App\CPU\Convert::usdToinr($amount);
        $user = Helpers::get_customer();
        // dd($config);
        $merchantId = trim($config['phone_pe_merchant_code'] ?? '');
        $saltKey = trim($config['phone_pe_secret_key'] ?? '');
        $saltIndex = trim($config['phone_pe_salt_index'] ?? '');
        if (empty($saltIndex)) {
            $saltIndex = '1';
        }
        $merchantTransactionId = 'PP_' . $order_id . '_' . time();
        $amountPaise = round($amount * 100);

        if ($this->isV2($config)) {
            $accessToken = $this->getV2AccessToken($config);
            if (!$accessToken) {
                Toastr::error('PhonePe V2 authentication failed. Please check your credentials.');
                return back();
            }

            $url = $this->getV2BaseUrl($config) . '/checkout/v2/pay';
            $payload = [
                "merchantOrderId" => $merchantTransactionId,
                "amount" => $amountPaise,
                "paymentFlow" => [
                    "type" => "PG_CHECKOUT",
                    "merchantUrls" => [
                        "redirectUrl" => route('phonepe-response')
                    ]
                ]
            ];

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
                session()->put('phonepe_txn_id', $merchantTransactionId);
                return redirect()->away($responseData['redirectUrl']);
            }

            $msg = $responseData['message'] ?? 'Payment initiation failed';
            Toastr::error('PhonePe V2 Error: ' . $msg);
            return back();
        }

        $data = [
            'merchantId' => $merchantId,
            'merchantTransactionId' => $merchantTransactionId,
            'merchantUserId' => (string)($user['id'] ?? 'MUID_' . $order_id),
            'amount' => $amountPaise,
            'redirectUrl' => route('phonepe-response'),
            'redirectMode' => 'POST',
            'callbackUrl' => route('phonepe-callback'),
            'mobileNumber' => $user['phone'] ?? '9999999999',
            'paymentInstrument' => [
                'type' => 'PAY_PAGE'
            ]
        ];

        $encode = json_encode($data, JSON_UNESCAPED_SLASHES);
        $base64 = base64_encode($encode);
        $fullString = $base64 . '/pg/v1/pay' . $saltKey;
        $sha256 = hash('sha256', $fullString);
        $finalXHeader = $sha256 . '###' . $saltIndex;

        $url = $this->getBaseUrl($config) . '/pg/v1/pay';

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
            $redirectUrl = $responseData['data']['instrumentResponse']['redirectInfo']['url'];
            session()->put('phonepe_txn_id', $merchantTransactionId);
            return redirect()->away($redirectUrl);
        }   
        
        $msg = $responseData['message'] ?? (isset($responseData['code']) ? 'PhonePe Error: ' . $responseData['code'] : 'Payment initiation failed');
        if (isset($responseData['code']) && $responseData['code'] == '404') {
            $msg = 'PhonePe Error: Merchant ID not found. Please check if your Merchant ID and Environment (Sandbox/Live) match.';
        }
        
        Toastr::error($msg);
        return back();
    }

    public function callback(Request $request)
    {
        $config = $this->getConfig();
        if (!$config) {
            return response()->json(['status' => 'ERROR']);
        }

        if ($this->isV2($config)) {
            return response()->json(['status' => 'OK']);
        }

        $saltKey = $config['phone_pe_secret_key'] ?? '';
        $saltIndex = $config['phone_pe_salt_index'] ?? 1;

        $xVerify = $request->header('X-VERIFY');
        if ($xVerify) {
            $parts = explode('###', $xVerify);
            if (count($parts) == 2) {
                $receivedHash = $parts[0];
                $payload = file_get_contents('php://input');
                $string = $payload . '/pg/v1/pay' . $saltKey;
                $sha256 = hash('sha256', $string);
                if ($sha256 === $receivedHash) {
                    $responseData = json_decode($payload, true);
                    if (isset($responseData['response'])) {
                        $decoded = json_decode(base64_decode($responseData['response']), true);
                        if (isset($decoded['data']['merchantTransactionId'])) {
                            $status = $this->checkStatus($config, $decoded['data']['merchantTransactionId']);
                            if ($status && $status['success'] && $status['code'] == 'PAYMENT_SUCCESS') {
                                $unique_id = OrderManager::gen_unique_id();
                                $order_ids = [];
                                foreach (CartManager::get_cart_group_ids() as $group_id) {
                                    $data = [
                                        'payment_method' => 'phone_pe',
                                        'order_status' => 'confirmed',
                                        'payment_status' => 'paid',
                                        'transaction_ref' => $decoded['data']['merchantTransactionId'],
                                        'order_group_id' => $unique_id,
                                        'cart_group_id' => $group_id
                                    ];
                                    $order_id = OrderManager::generate_order($data);
                                    array_push($order_ids, $order_id);
                                }
                                CartManager::cart_clean();
                                
                                if (session()->has('payment_mode') && session('payment_mode') == 'app') {
                                    // For app mode, cart is already cleaned, response() will handle redirect
                                }
                            }
                        }
                    }
                }
            }
        }

        return response()->json(['status' => 'OK']);
    }

    public function response(Request $request)
    {
        $config = $this->getConfig();
        if (!$config) {
            Toastr::error('PhonePe not configured');
            return back();
        }

        $merchantTransactionId = session()->get('phonepe_txn_id');
        if (!$merchantTransactionId && $request->has('transactionId')) {
            $merchantTransactionId = $request->input('transactionId');
        }

        if ($this->isV2($config) && !$merchantTransactionId && $request->has('merchantOrderId')) {
            $merchantTransactionId = $request->input('merchantOrderId');
        }

        $statusData = $this->checkStatus($config, $merchantTransactionId);
       
        if ($statusData && isset($statusData['success']) && $statusData['success'] == true && $statusData['code'] == 'PAYMENT_SUCCESS') {
            $unique_id = OrderManager::gen_unique_id();
            $order_ids = [];
            foreach (CartManager::get_cart_group_ids() as $group_id) {
                $data = [
                    'payment_method' => 'phone_pe',
                    'order_status' => 'confirmed',
                    'payment_status' => 'paid',
                    'transaction_ref' => $merchantTransactionId,
                    'order_group_id' => $unique_id,
                    'cart_group_id' => $group_id
                ];
                $order_id = OrderManager::generate_order($data);
                array_push($order_ids, $order_id);
            }

            session()->forget('phonepe_txn_id');
            CartManager::cart_clean();

            if (session()->has('payment_mode') && session('payment_mode') == 'app') {
                return redirect()->route('payment-success');
            } else {
                return view('web-views.checkout-complete');
            }
        }

        if (session()->has('payment_mode') && session('payment_mode') == 'app') {
            return redirect()->route('payment-fail');
        }
        Toastr::error('Payment process failed!');
        return back();
    }

    private function checkStatus($config, $merchantTransactionId)
    {
        if ($this->isV2($config)) {
            $accessToken = $this->getV2AccessToken($config);
            if (!$accessToken) {
                return ['success' => false, 'code' => 'AUTH_FAILED'];
            }

            $url = $this->getV2BaseUrl($config) . '/checkout/v2/order/' . $merchantTransactionId . '/status';

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
                        return [
                            'success' => true,
                            'code' => 'PAYMENT_SUCCESS'
                        ];
                    }
                    return [
                        'success' => false,
                        'code' => $responseData['state'] ?? 'FAILED'
                    ];
                }
            } catch (\Exception $e) {
                \Log::error('PhonePe V2 Status Error: ' . $e->getMessage());
            }

            return ['success' => false, 'code' => 'FAILED'];
        }

        $merchantId = trim($config['phone_pe_merchant_code'] ?? '');
        $saltKey = trim($config['phone_pe_secret_key'] ?? '');
        $saltIndex = trim($config['phone_pe_salt_index'] ?? '');
        if (empty($saltIndex)) {
            $saltIndex = '1';
        }

        $string = '/pg/v1/status/' . $merchantId . '/' . $merchantTransactionId . $saltKey;
        $sha256 = hash('sha256', $string);
        $finalXHeader = $sha256 . '###' . $saltIndex;

        $url = $this->getBaseUrl($config) . '/pg/v1/status/' . $merchantId . '/' . $merchantTransactionId;

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
    }
}
