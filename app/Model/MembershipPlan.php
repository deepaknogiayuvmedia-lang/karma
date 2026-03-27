<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'features',
        'price',
        'duration',
        'duration_type',
        'user_type',
        'status',
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'float',
        'duration' => 'integer',
        'status' => 'integer',
    ];
}
