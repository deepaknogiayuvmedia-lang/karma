<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductEditRequest extends Model
{
    protected $fillable = [
        'product_id',
        'seller_id',
        'status',
        'seller_note',
        'admin_note',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(\App\Model\Product::class);
    }

    public function seller()
    {
        return $this->belongsTo(\App\Model\Seller::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(\App\User::class, 'reviewed_by');
    }
}
