<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DelhiveryShipment extends Model
{
    protected $table = 'delhivery_shipments';

    protected $fillable = [
        'order_id',
        'provider',
        'client_reference',
        'waybill',
        'shipment_reference',
        'status',
        'tracking_status',
        'pickup_location',
        'cod_amount',
        'weight_kg',
        'request_payload',
        'response_payload',
        'tracking_payload',
        'error_message',
        'created_at_carrier',
        'last_synced_at',
        'cancel_requested_at',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'request_payload' => 'array',
            'response_payload' => 'array',
            'tracking_payload' => 'array',
            'cod_amount' => 'float',
            'weight_kg' => 'float',
            'created_at_carrier' => 'datetime',
            'last_synced_at' => 'datetime',
            'cancel_requested_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }
}
