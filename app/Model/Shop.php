<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'seller_id',
        'name',
        'address',
        'contact',
        'image',
        'vacation_start_date',
        'vacation_end_date',
        'vacation_note',
        'vacation_status',
        'temporary_close',
        'banner',
        'whatsapp_no',
        'gst_no',
        'gst_doc',
        'pen_no',
        'pen_doc',
        'business_address',
        'wherehouse',
    ];


    protected $casts = [
        'seller_id ' => 'integer',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function scopeActive($query)
    {
        return $query->whereHas('seller', function ($query) {
            $query->where(['status' => 'approved']);
        });
    }
}
