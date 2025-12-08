<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    protected $fillable = [
        'leadid',
        'authid',
        'authfullname',
        'orderstatus',
        'message',
        'override',
        'notifycustomer',
    ];
}
