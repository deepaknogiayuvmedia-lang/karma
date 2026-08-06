<?php

namespace App\Http\Controllers\Admin;

use App\CPU\BackEndHelper;
use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\CPU\OrderManager;
use App\Http\Controllers\Controller;
use App\Model\ProductQuery;

use App\Traits\CommonTrait;
use App\Model\ShippingAddress;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Ramsey\Uuid\Uuid;
use function App\CPU\translate;
use App\CPU\CustomerManager;
use App\CPU\Convert;
use App\Model\Product;

class ProductQueryController extends Controller
{

    public function list(Request $request)
    {

        // $orders = ProductQuery::join('products','products.id','=','product_queries.product_id')->join('chanals','chanals.id','=','product_queries.chanal_id')->where('product_queries.name','Like','%'.$request->search.'%');
        // if($request->filter){
        //     $orders=$orders->where('product_queries.status',$request->filter);
        // }
        // if($request->from){
        //     $orders=$orders->whereDate('product_queries.created_at', '>=', $request->from);
        // }
        // if($request->to){
        //     $orders=$orders->whereDate('product_queries.created_at', '<=', $request->to);
        // }
        // if($request->search){
        //     $orders=$orders->where('product_queries.name','Like','%'.$request->search.'%')->orwhere('product_queries.email','Like','%'.$request->search.'%')->orwhere('product_queries.mobile','Like','%'.$request->search.'%');
        // }
        // $orders=$orders->orderBy('product_queries.id','desc')
        //     ->paginate(Helpers::pagination_limit(),['product_queries.*','products.name as product_name','products.unit_price','products.tax','products.tax_type','products.tax_model','products.discount','products.discount_type','chanals.name as chid']);
       
        $query_param = [];
        $search = $request['search'];
        $search1 = $request['search1'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $biddings = DB::table('biddings')
                ->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->Where('product_name', 'like', "%{$value}%");
                    }
                });
            $query_param = ['search' => $request['search']];
        } else {
            $biddings = DB::table('biddings');
        }
        $biddings = $biddings->orderBy('id', 'DESC')->paginate(Helpers::pagination_limit())->appends($query_param);

        return view(
            'admin-views.productquery.list',
            compact('biddings','search')
        );
    }
}
