<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TallyCompany extends Model
{
    protected $fillable = ['company_name', 'seller_id', 'status'];
}
