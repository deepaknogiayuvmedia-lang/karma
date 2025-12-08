<?php

namespace App\Http\Controllers\SaleManager;

// use App\CPU\BackEndHelper;
use App\CPU\Helpers;
// use App\CPU\ImageManager;

use App\Http\Controllers\Controller;
use App\Model\AdminCart;
use App\Model\Cart;
use App\Model\Order;
use App\Model\PostOffice;
use App\Model\ProductQuery as SaleProductQuery;
// use App\Traits\CommonTrait;
// use App\Model\ShippingAddress;
// use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\CPU\BackEndHelper;
// use Illuminate\Support\Facades\View;
// use Ramsey\Uuid\Uuid;
// use function App\CPU\translate;
use Illuminate\Support\Facades\DB;
// use App\CPU\Convert;
// use Rap2hpoutre\FastExcel\FastExcel;
use Auth;
use App\Model\Product;
use App\Model\Chanal;
use App\User;

class ProductQuery extends Controller
{

    public function list(Request $request)
    {
        $auth = auth('sale_manager')->user();
        $orders = SaleProductQuery::join('products', 'products.id', '=', 'product_queries.product_id')->join('chanals', 'chanals.id', '=', 'product_queries.chanal_id')->where('product_queries.name', 'Like', '%' . $request->search . '%');
        $products = Product::get();   // getting products data
        $chanals = Chanal::get();
        if ($request->filter) {
            $orders = $orders->where('product_queries.status', $request->filter);
        }
        if ($request->from) {
            $orders = $orders->whereDate('product_queries.created_at', '>=', $request->from);
        }
        if ($request->to) {
            $orders = $orders->whereDate('product_queries.created_at', '<=', $request->to);
        }
        if ($request->search) {
            $orders = $orders->where('product_queries.name', 'Like', '%' . $request->search . '%')->orwhere('product_queries.email', 'Like', '%' . $request->search . '%')->orwhere('product_queries.mobile', 'Like', '%' . $request->search . '%');
        }
        $orders = $orders->where('sale_employ_id', $auth->id)->orderBy('product_queries.id', 'desc')
            ->paginate(Helpers::pagination_limit(), ['product_queries.*', 'products.name as product_name', 'products.unit_price', 'products.tax', 'products.tax_type', 'products.tax_model', 'products.discount', 'products.discount_type', 'chanals.name as chid']);

        return view(
            'sale-manager.product_query',
            compact(
                'orders',
                'products',
                'chanals'   // sending it here
            )
        );
    }

    public function customer_edit(Request $request, $id)
    {
        $query = SaleProductQuery::where('id', $id)->first();
        $products = Product::get();
        $chanals = Chanal::get();
        return view(
            'sale-manager.customer_data_edit',
            compact(
                'query',
                'products',
                'chanals'
            )
        );

    }
    public function create_order(Request $request, $id)
    {

        $query = SaleProductQuery::where('id', $id)->first();
        $customer = User::where('phone', $query->mobile)->first();
        $products = Product::get();
        $chanals = Chanal::get();
        $postofficedata = PostOffice::where('Pincode', '=', $query->address)->get();
        $postofficesingle = PostOffice::where('Pincode', '=', $query->address)->first();
        // dd($postofficedata);
        return view(
            'sale-manager.create_order',
            compact(
                'query',
                'products',
                'chanals',
                'postofficedata',
                'postofficesingle',
                'customer',
            )
        );

    }
    public function customer_update(Request $request, $id)
    {
        $query = SaleProductQuery::find($id);
        $query->name = $request->name;
        $query->mobile = $request->mobile;
        $query->email = $request->email;
        $query->address = $request->address;
        $query->product_id = $request->products;
        $query->chanal_id = $request->chanals;
        $query->save();
        return redirect()->route('sale.pro.list');
    }

    public function status(Request $request)
    {
        $order = SaleProductQuery::find($request->rowid);
        if ($request->status == '6') {
            $userid = User::where('phone','=',$order->mobile);
            if($userid==null){
                $user = User::create([
                    'f_name' => $order->name,
                    'l_name' => $order->name,
                    'email' => $order->email,
                    'phone' => $order->mobile,
                    'is_active' => 1,
                    'password' => bcrypt($order->mobile)
                ]);
            }
        }
        $order->status = $request->status;
        $order->save();
        return response()->json(["success" => true]);
    }

    public function addproduct_ajax(Request $request)
    {
        $auth = auth('sale_manager')->user();
        $customerId = $request->input('customerid');
        $quantity = $request->input('quantity');
        $productId = $request->input('productid');
        $products = Product::find($productId);
        try {
            $finaldata = [
                'customerid' => $customerId,
                'product_id' => $productId,
                'product_details' => $products,
                'qty' => $quantity,
                'seller_id' => $auth->id,
            ];
            DB::table('admin_carts')->insert($finaldata);
            $cardlist = AdminCart::where( 'customerid' , $customerId)->get();
            return response()->json($cardlist);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function deleterow(Request $request)
    {
        $cartid = $request->input('cartid');
        $data = AdminCart::find($cartid)->delete();
        return back()->with('success',"Deleted.!!!");
    }

}
