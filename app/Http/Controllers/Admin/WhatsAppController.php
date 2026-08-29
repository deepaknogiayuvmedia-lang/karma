<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\WhatsAppSetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Http;

class WhatsAppController extends Controller
{
    private $jsonPath;

    public function __construct()
    {
        $this->jsonPath = base_path('whatsapp_templates.json');
    }

    private function getJsonTemplates()
    {
        if (!file_exists($this->jsonPath)) {
            file_put_contents($this->jsonPath, '[]');
            return [];
        }
        $json = file_get_contents($this->jsonPath);
        return json_decode($json, true) ?? [];
    }

    private function saveJsonTemplates($templates)
    {
        file_put_contents($this->jsonPath, json_encode($templates, JSON_PRETTY_PRINT));
    }

    public function index()
    {
        $whatsapp_setting = \App\CPU\Helpers::get_whatsapp_config();
        return view('admin-views.business-settings.whatsapp.index', compact('whatsapp_setting'));
    }

    public function store(Request $request)
    {
        WhatsAppSetting::updateOrCreate(
            ['user_id' => auth('admin')->id()],
            [
                'app_id' => $request->app_id,
                'api_secret_key' => $request->api_secret_key,
                'phone_number_id' => $request->phone_number_id,
                'whatsapp_business_account_id' => $request->whatsapp_business_account_id,
                'access_token' => $request->access_token,
                'status' => $request->has('status') ? 1 : 0,
            ]
        );
        Toastr::success('WhatsApp Settings updated successfully');
        return back();
    }

    public function templete()
    {
        $templetes = $this->getJsonTemplates();
        return view('admin-views.business-settings.whatsapp.templete', compact('templetes'));
    }

    public function sync_templates()
    {
        $config = \App\CPU\Helpers::get_whatsapp_config();

        if (!$config || !$config->access_token) {
            Toastr::error('WhatsApp API credentials are missing!');
            return back();
        }

        if (!$config->phone_number_id) {
            Toastr::error('Phone Number ID is required!');
            return back();
        }

        try {
            $token = $config->access_token;
            $wabaId = $config->whatsapp_business_account_id;

            // Auto-detect WABA ID from Phone Number ID if not set
            if (!$wabaId) {
                $phoneRes = Http::withoutVerifying()->withToken($token)
                    ->get("https://graph.facebook.com/v26.0/{$config->phone_number_id}");

                if ($phoneRes->successful()) {
                    $wabaId = $phoneRes->json('wa_business_account')['id'] ?? null;
                }
            }

            if (!$wabaId) {
                Toastr::error('Could not find WhatsApp Business Account ID. Please set it in settings.');
                return back();
            }

            $url = "https://graph.facebook.com/v26.0/{$wabaId}/message_templates?fields=name,category,language,status,components";
            $response = Http::withoutVerifying()->withToken($token)->get($url);

            if ($response->successful()) {
                $templates = $response->json()['data'] ?? [];

                // Store old type mappings
                $oldTemplates = $this->getJsonTemplates();
                $oldTypeMap = [];
                foreach ($oldTemplates as $old) {
                    if (isset($old['type']) && $old['type'] !== null) {
                        $oldTypeMap[$old['name']] = $old['type'];
                    }
                }

                // Save fresh templates to JSON
                $newTemplates = [];
                foreach ($templates as $tpl) {
                    $newTemplates[] = [
                        'id' => $tpl['id'] ?? '',
                        'name' => $tpl['name'],
                        'components' => $tpl['components'] ?? null,
                        'category' => $tpl['category'],
                        'language' => $tpl['language'],
                        'status' => strtoupper($tpl['status']),
                        'type' => $oldTypeMap[$tpl['name']] ?? null,
                        'is_active' => 1,
                    ];
                }

                $this->saveJsonTemplates($newTemplates);
                Toastr::success('Templates synced successfully! (' . count($newTemplates) . ' templates)');
            } else {
                $errorData = $response->json();
                $errorMsg = $errorData['error']['message'] ?? 'Could not fetch templates.';

                \Illuminate\Support\Facades\Log::error('WhatsApp Sync Failed', [
                    'url' => $url,
                    'response' => $errorData,
                ]);

                Toastr::error('API Error: ' . $errorMsg);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('WhatsApp Sync Exception', [
                'message' => $e->getMessage(),
            ]);
            Toastr::error('Failed: ' . $e->getMessage());
        }

        return back();
    }

    public function update_template_type(Request $request)
    {
        $request->validate([
            'template_id' => 'required',
            'type' => 'required'
        ]);

        try {
            $templates = $this->getJsonTemplates();

            // Remove this status from all other templates' status_type
            foreach ($templates as &$tpl) {
                if (isset($tpl['status_type']) && is_array($tpl['status_type'])) {
                    $tpl['status_type'] = array_values(array_diff($tpl['status_type'], [$request->type]));
                }
            }

            // Add this status to the selected template's status_type
            foreach ($templates as &$tpl) {
                if (($tpl['id'] ?? '') === $request->template_id) {
                    if (!isset($tpl['status_type']) || !is_array($tpl['status_type'])) {
                        $tpl['status_type'] = [];
                    }
                    if (!in_array($request->type, $tpl['status_type'])) {
                        $tpl['status_type'][] = $request->type;
                        $tpl['status_type'] = array_values($tpl['status_type']);
                    }
                    break;
                }
            }
            unset($tpl);

            $this->saveJsonTemplates($templates);

            return response()->json([
                'status' => 1,
                'message' => 'WhatsApp Template mapping updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to update mapping: ' . $e->getMessage()
            ], 500);
        }
    }

    public function status(Request $request)
    {
        try {
            $templates = $this->getJsonTemplates();

            foreach ($templates as &$tpl) {
                if (($tpl['id'] ?? '') === $request->template_id) {
                    $tpl['is_active'] = $request->status;
                    break;
                }
            }
            unset($tpl);

            $this->saveJsonTemplates($templates);

            return response()->json([
                'status' => 1,
                'message' => 'Status updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function send_test_message(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'template_name' => 'required|string',
        ]);

        $config = \App\CPU\Helpers::get_whatsapp_config();

        if (!$config || !$config->access_token || !$config->phone_number_id) {
            return response()->json([
                'status' => 0,
                'message' => 'WhatsApp API credentials not configured!'
            ], 400);
        }

        // Clean phone number
        $phone = preg_replace('/[^0-9]/', '', $request->phone);
        if (strlen($phone) === 10) {
            $phone = '91' . $phone;
        }
        if (strlen($phone) === 11 && $phone[0] === '0') {
            $phone = '91' . substr($phone, 1);
        }

        // Find template from JSON
        $templates = $this->getJsonTemplates();
        $template = null;
        foreach ($templates as $tpl) {
            if (($tpl['name'] ?? '') === $request->template_name) {
                $template = $tpl;
                break;
            }
        }

        if (!$template) {
            return response()->json([
                'status' => 0,
                'message' => 'Template not found: ' . $request->template_name
            ], 404);
        }

        $langCode = $template['language'] ?? 'en_US';

        // Sample values for test message
        $sampleValues = [
            'name'      => 'Test User',
            'p_name1'   => 'Test Product',
            'p_name2'   => 'Test Product',
            'p_name'    => 'Test Product',
            'qty'       => '1',
            'o_id'      => '#99999',
            'id'        => '#99999',
            'd_address' => 'Test Address, Mumbai',
            'd_date'    => date('d M Y'),
            'category'  => 'Order',
            'ps_name'   => 'Test Store',
            's_name'    => 'Test Store',
            'amount'    => '₹999.00',
            'email'     => 'test@example.com',
            'time'      => date('h:i A'),
        ];

        $body = [
            "messaging_product" => "whatsapp",
            "to" => $phone,
            "type" => "template",
            "template" => [
                "name" => $template['name'],
                "language" => [
                    "code" => $langCode
                ]
            ]
        ];

        // Auto-build parameters from template's body text named_params
        $bodyComponent = collect($template['components'] ?? [])->firstWhere('type', 'BODY');
        $namedParams   = $bodyComponent['example']['body_text_named_params'] ?? [];

        $parameters = [];
        foreach ($namedParams as $param) {
            $paramName = $param['param_name'];
            $parameters[] = [
                'type'           => 'text',
                'parameter_name' => $paramName,
                'text'           => $sampleValues[$paramName] ?? $param['example'] ?? '',
            ];
        }

        if (!empty($parameters)) {
            $body['template']['components'] = [
                [
                    'type'       => 'body',
                    'parameters' => $parameters,
                ]
            ];
        }

        try {
            $url = "https://graph.facebook.com/v26.0/{$config->phone_number_id}/messages";
            $response = Http::withoutVerifying()->withToken($config->access_token)->post($url, $body);

            if ($response->successful()) {
                \Illuminate\Support\Facades\Log::info('WhatsApp Test Message Sent', [
                    'phone' => $phone,
                    'template' => $template['name'],
                    'response' => $response->json(),
                ]);
                return response()->json([
                    'status' => 1,
                    'message' => 'Test message sent successfully to ' . $phone,
                    'data' => $response->json()
                ]);
            } else {
                $error = $response->json()['error']['message'] ?? 'Unknown error';
                return response()->json([
                    'status' => 0,
                    'message' => 'API Error: ' . $error,
                    'data' => $response->json()
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to send: ' . $e->getMessage()
            ], 500);
        }
    }
}
