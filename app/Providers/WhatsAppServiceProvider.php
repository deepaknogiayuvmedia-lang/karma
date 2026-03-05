<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WhatsAppServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            $whatsapp = \App\Model\WhatsAppSetting::where('user_id', auth('admin')->id())->first();
            if ($whatsapp) {
                config([
                    'whatsapp.app_id' => $whatsapp->app_id,
                    'whatsapp.api_secret_key' => $whatsapp->api_secret_key,
                    'whatsapp.phone_number_id' => $whatsapp->phone_number_id,
                    'whatsapp.whatsapp_business_account_id' => $whatsapp->whatsapp_business_account_id,
                    'whatsapp.access_token' => $whatsapp->access_token,
                    'whatsapp.status' => $whatsapp->status,
                ]);
            }
        } catch (\Exception $ex) {
            //  
        }
    }
}
