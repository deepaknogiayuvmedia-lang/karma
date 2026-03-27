<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $casts = [
        'status'     => 'integer',
        'cron_sent'  => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }

    /**
     * Only notifications not yet dispatched by the cron command.
     */
    public function scopeUnsent($query)
    {
        return $query->where('cron_sent', false);
    }
}

