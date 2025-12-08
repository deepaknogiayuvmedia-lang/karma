<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    protected $guarded = [];
    protected $casts = [
        'customer_id' => 'integer',
    ];
}
