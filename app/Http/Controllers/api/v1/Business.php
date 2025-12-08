<?php

namespace App\Http\Controllers\api\v1;

use App\Model\BusinessSetting;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;



class Business extends Controller
{
        function sucess($msg, $values)
    {
        $data['status'] = true;
        $data['data'] = $values;
        $data['message'] = $msg;

        return $data;
    }
    public function business()
    {
       
            $BusinessSetting = BusinessSetting::all();
      
 return
            $this->sucess("data get successfully", $BusinessSetting);
     
    }

   
}
