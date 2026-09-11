<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class DeliveryMan extends Authenticatable
{
    use Notifiable;

    protected $hidden = ['password','auth_token'];

    protected $casts = [
        'is_active'=>'integer'
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'delivery_man_id');
    }

    public function wallet()
    {
        return $this->hasOne(DeliverymanWallet::class);
    }

    public function transactions()
    {
        return $this->hasMany(DeliveryManTransaction::class);
    }
    public function chats()
    {
        return $this->hasMany(Chatting::class);
    }
    public function review()
    {
        return $this->hasMany(Review::class, 'delivery_man_id');
    }

    public function rating(){
        return $this->hasMany(Review::class)
            ->select(DB::raw('avg(rating) average, delivery_man_id'))
            ->groupBy('delivery_man_id');
    }
}
