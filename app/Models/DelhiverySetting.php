<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DelhiverySetting extends Model
{
    protected $table = 'delhivery_settings';

    protected $fillable = [
        'name',
        'environment',
        'base_url',
        'api_token',
        'pickup_location',
        'is_enabled',
    ];

    protected $hidden = ['api_token'];

    protected function casts(): array
    {
        return [
            'api_token' => 'encrypted',
            'is_enabled' => 'boolean',
        ];
    }
}
