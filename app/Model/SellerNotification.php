<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SellerNotification extends Model
{
    protected $fillable = [
        'seller_id',
        'product_id',
        'title',
        'description',
        'type',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}
