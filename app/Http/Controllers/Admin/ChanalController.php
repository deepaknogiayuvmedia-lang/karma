<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use App\Model\Chanal;
use Brian2694\Toastr\Facades\Toastr;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpseclib3\Crypt\RSA\Formats\Keys\JWK;

class ChanalController extends Controller
{
   

    // Social Media
    public function chanal()
    {
        // $about_us = BusinessSetting::where('type', 'about_us')->first();
        return view('admin-views.business-settings.chanal');
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $data = Chanal::orderBy('id', 'desc')->get();
            return response()->json($data);
        }
    }

    public function chanal_store(Request $request)
    {
        $check = Chanal::where('name', $request->name)->first();
        if ($check != null) {
            return response()->json([
                'error' => 1,
            ]);
        }
        
        $social_media = new Chanal;
        $social_media->name = $request->name;
      
        $social_media->save();
        return response()->json([
            'success' => 1,
        ]);
    }

    public function chanal_edit(Request $request)
    {
        $data = Chanal::where('id', $request->id)->first();
        return response()->json($data);
    }

    public function chanal_update(Request $request)
    {
        $social_media = Chanal::find($request->id);
        $social_media->name = $request->name;
        $social_media->save();
        return response()->json();
    }

    public function chanal_delete(Request $request)
    {
        $br = Chanal::find($request->id);
        $br->delete();
        return response()->json();
    }

    public function chanal_status_update(Request $request)
    {
        Chanal::where(['id' => $request['id']])->update([
            'status' => $request['status'],
        ]);
        return response()->json([
            'success' => 1,
        ], 200);
    }



  

}
