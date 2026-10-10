<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    protected $table = 'product_specifications';

    protected $fillable = ['product_id', 'label', 'value', 'sort_order'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
