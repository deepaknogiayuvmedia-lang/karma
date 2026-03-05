<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ThirdPartyShippingMethod extends Model
{
    protected $table = 'third_party_shipping_methods';

    protected $fillable = [
        'user_id',
        'api_key',
        'api_secret',
        'status',
    ];
}
