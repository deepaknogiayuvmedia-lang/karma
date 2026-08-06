<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductChangeRequest extends Model
{
    protected $fillable = [
        'product_id',
        'seller_id',
        'edit_request_id',
        'old_data',
        'new_data',
        'status',
        'seller_note',
        'admin_note',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'old_data' => 'json',
        'new_data' => 'json',
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

    public function editRequest()
    {
        return $this->belongsTo(ProductEditRequest::class, 'edit_request_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(\App\User::class, 'reviewed_by');
    }
}
