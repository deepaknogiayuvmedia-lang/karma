<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppSetting extends Model
{
    use HasFactory;

    protected $table = 'whatsapp_settings';

    protected $fillable = [
        'user_id',  
        'app_id',
        'api_secret_key',
        'phone_number_id',
        'whatsapp_business_account_id',
        'access_token',
        'status',
    ];
}
