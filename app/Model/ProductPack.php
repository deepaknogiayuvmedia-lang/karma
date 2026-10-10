<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductPack extends Model
{
    protected $table = 'product_packs';

    protected $fillable = [
        'product_id', 'type', 'name', 'sub', 'quantity', 'price', 'mrp',
        'discount', 'unit_rate', 'badge', 'is_active', 'sort_order'
    ];

    protected $casts = [
        'price' => 'float',
        'mrp' => 'float',
        'quantity' => 'integer',
        'is_active' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
