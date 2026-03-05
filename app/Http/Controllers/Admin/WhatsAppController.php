<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\WhatsAppSetting;
use Brian2694\Toastr\Facades\Toastr;

use App\whatsapp_templete;
use Illuminate\Support\Facades\Http;

class WhatsAppController extends Controller
{
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
                'status' => 0,
            ]
        );
        Toastr::success('WhatsApp Settings updated successfully');
        return back();
    }

    public function templete()
    {
        $json = file_get_contents(base_path('whatsapp_templates.json'));
        $templetes = json_decode($json, true);
        return view('admin-views.business-settings.whatsapp.templete', compact('templetes'));
    }

    public function sync_templates()
    {
        $config = \App\CPU\Helpers::get_whatsapp_config();

        if (!$config || !$config->access_token || !$config->whatsapp_business_account_id) {
            Toastr::error('WhatsApp API credentials are missing!');
            return back();
        }

        try {
            // dump($config->access_token);
            // dump($config->whatsapp_business_account_id);
            // dd('');
            $response = Http::withToken($config->access_token)
                ->get("https://graph.facebook.com/v19.0/{$config->whatsapp_business_account_id}/message_templates");

            if ($response->successful()) {
                $templates = $response->json()['data'];
                file_put_contents(base_path('whatsapp_templates.json'), json_encode($templates, JSON_PRETTY_PRINT));

                foreach ($templates as $tpl) {
                    whatsapp_templete::updateOrCreate(
                        ['template_id' => $tpl['id'] ?? ''],
                        [
                            'name' => $tpl['name'],
                            'components' => json_encode($tpl['components']),
                            'category' => $tpl['category'],
                            'language' => $tpl['language'],
                            'status' => strtolower($tpl['status']),
                        ]
                    );
                }

                Toastr::success('Templates synced successfully from WhatsApp API');
            } else {
                $error = $response->json()['error']['message'] ?? 'Unknown error';
                Toastr::error('API Error: ' . $error);
            }
        } catch (\Exception $e) {
            Toastr::error('Something went wrong: ' . $e->getMessage());
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
            // Reset previous templates for this type
            \App\whatsapp_templete::where('type', $request->type)->update(['type' => null]);
            
            // Assign new template to this type
            \App\whatsapp_templete::where('template_id', $request->template_id)->update(['type' => $request->type]);

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
            $template = \App\whatsapp_templete::where('template_id', $request->template_id)->first();
            $template->is_active = $request->status;
            $template->save();

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
}