<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    protected $table = 'product_features';

    protected $fillable = ['product_id', 'icon', 'title', 'description', 'sort_order'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
