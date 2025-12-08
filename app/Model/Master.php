<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    protected $fillable = [
        'label',
        'value',
        'type',
        'status',
    ];
}
