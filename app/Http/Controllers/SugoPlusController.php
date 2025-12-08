<?php

namespace App\Http\Controllers;

use App\Model\ProductQuery;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class SugoPlusController extends Controller
{

    public function index()
    {
        return view('sugo-plus');
    }

    public function stamin(Request $request)
    {
        $urls = $request;
        return view('stamin',compact('urls'));
    }
    public function ketoplus()
    {
        return view('ketoplus');
    }
    public function thankyoupage(Request $request , $product)
    {
        // dd($request->all());
        $utmSource = $request->query('utm_source');
        $utmMedium = $request->query('utm_medium');
        $utmCampaign = $request->query('utm_campaign');
        return view('thankyou');
    }
}
