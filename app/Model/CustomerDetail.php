<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    protected $fillable = [
        'order_id',
        'did_no',
        'incomingcallno',
        'mobileno',
        'agentname',
        'customername',
        'channalname',
        'gender',
        'bloodgroup',
        'weight',
        'age',
        'diseaseproblem',
        'height',
        'dispositionlevelone',
        'occupation',
        'hospitalname',
        'dispositionleveltwo',
        'remarksandcomments'
    ];
}
