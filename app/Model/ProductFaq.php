<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductFaq extends Model
{
    protected $table = 'product_faqs';

    protected $fillable = ['product_id', 'question', 'answer', 'sort_order'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
