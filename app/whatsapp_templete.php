<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class whatsapp_templete extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'template_id',
        'components',
        'category',
        'language',
        'type',
        'status',
    ];
}
