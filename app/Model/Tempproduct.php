<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tempproduct extends Model
{
    protected $fillable = [
        'product_id',
        'tally_name',
        'variant',
        'qty',
        'rate',
        'unit',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'product_id' => 'integer',
        'qty' => 'double',
        'rate' => 'double',
    ];
}
