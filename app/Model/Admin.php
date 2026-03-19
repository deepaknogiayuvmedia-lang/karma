<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'image',
        'password',
        'wherehouse',
    ];

    protected $casts = [
        'wherehouse' => 'array',
    ];

    public function role(){
        return $this->belongsTo(AdminRole::class,'admin_role_id');
    }

}
