<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerZero extends Model
{
    use HasFactory;
    protected $fillable = [
        'photo',
        'device_id',
        'url',
        'banner_type',
        'status',
    ];
   
   
}