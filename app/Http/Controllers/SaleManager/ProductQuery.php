<?php

namespace App\Http\Controllers\SaleManager;

// use App\CPU\BackEndHelper;
use App\CPU\Helpers;
// use App\CPU\ImageManager;

use App\Http\Controllers\Controller;
use App\Model\AdminCart;
use App\Model\BillingAddress;
use App\Model\CustomerDetail;
use App\Model\Cart;
use App\Model\Master;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\PostOffice;
use App\Model\ProductQuery as SaleProductQuery;
// use App\Traits\CommonTrait;
// use App\Model\ShippingAddress;
// use Brian2694\Toastr\Facades\Toastr;
use App\Model\ShippingAddress;
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
use App\Model\FollowUp;
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

    public function all_leads(Request $request)
    {
        $auth = auth('sale_manager')->user();
        $orders = SaleProductQuery::join('products', 'products.id', '=', 'product_queries.product_id')->join('chanals', 'chanals.id', '=', 'product_queries.chanal_id')->where('product_queries.name', 'Like', '%' . '$request->search' . '%');
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
        $orders = $orders->orderBy('product_queries.id', 'desc')
            ->paginate(Helpers::pagination_limit(), ['product_queries.*', 'products.name as product_name', 'products.unit_price', 'products.tax', 'products.tax_type', 'products.tax_model', 'products.discount', 'products.discount_type', 'chanals.name as chid']);

        return view(
            'sale-manager.all_leads',
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
        // dd($request->all());
        $auth = auth('sale_manager')->user();
        $query = SaleProductQuery::where('id', $id)->first();
        $customer = User::where('phone', $query->mobile)->first();
        // dd($customer);
        $customerId = $customer->id;
        $products = Product::get();
        $chanals = Chanal::get();
        $postofficedata = PostOffice::where('Pincode', '=', $query->address)->get();
        $postofficesingle = PostOffice::where('Pincode', '=', $query->address)->first();
        $masterdata = Master::where('type', '=', 'Master')->get();
        $cardlist = AdminCart::where('customerid', $customerId)->get();
        //dd($cardlist);
        return view(
            'sale-manager.create_order',
            compact(
                'query',
                'products',
                'chanals',
                'postofficedata',
                'postofficesingle',
                'customer',
                'masterdata',
                'auth',
                'cardlist',
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
            $userid = User::where('phone', '=', $order->mobile)->get();
            if ($userid->isEmpty()) {
                User::create([
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
        // dd($request->all());
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
            $cardlist = AdminCart::where('customerid', $customerId)->get();
            return response()->json($cardlist);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function filtermasters_ajax(Request $request)
    {
        $masters = Master::where('type', '=', $request->selectedType)->get();
        return response()->json(['master' => $masters]);
    }
    public function deleterow(Request $request)
    {
        $id = $request->input('cartid');
        //  dd($id);
        $data = AdminCart::find($id);
        $customerId = $data->customerid;
        $data->delete();
        $cardlist = AdminCart::where('customerid', $customerId)->get();
        return response()->json($cardlist);
    }

    public function updateqty(Request $request)
    {
        $id = $request->input('leadid');
        $qty = $request->input('quantity');
        $data = AdminCart::find($id);
        $customerId = $data->customerid;
        $data->qty = $qty;
        $data->save();
        $cardlist = AdminCart::where('customerid', $customerId)->get();
        return response()->json($cardlist);
    }
    public function inserteditorder(Request $request)
    {
        $auth = auth('sale_manager')->user();
        try {
            $orderdata = Order::create([
                'customer_id' => $request->customerid,
                'customer_type' => 'customer',
                'payment_status' => $request->paymentstatus,
                'order_status' => 'confirmed',
                'payment_method' => $request->paymentmethod,
                'order_amount' => $request->totalpayable,
                'shipping_address' => $request->billingaddress,
                'discount_amount' => $request->discountamt,
                'deliveryman_charge' => $request->shippingcharges + $request->codcharges,
            ]);
            $customerdata = CustomerDetail::create([
                'order_id' => $orderdata->id,
                'did_no' => $request->didno,
                'incomingcallno' => $request->incomingcallno,
                'mobileno' => $request->mobileno,
                'agentname' => $request->agentname,
                'customername' => $request->customername,
                'channalname' => $request->channalname,
                'gender' => $request->gender,
                'bloodgroup' => $request->bloodgroup,
                'weight' => $request->weight,
                'age' => $request->age,
                'diseaseproblem' => $request->diseaseproblem,
                'height' => $request->height,
                'dispositionlevelone' => $request->dispositionlevelone,
                'occupation' => $request->occupation,
                'hospitalname' => $request->hospitalname,
                'dispositionleveltwo' => $request->dispositionleveltwo,
                'remarksandcomments' => $request->remarksandcomments,
            ]);

            $admincartdata = AdminCart::where('customerid', $request->customerid)->get();
            foreach ($admincartdata as $value) {
                $productDetails = json_decode($value->product_details);
                $orderdetailsdata = OrderDetail::create([
                    'order_id' => $orderdata->id,
                    'product_id' => $productDetails->id,
                    'seller_id' => $auth->id,
                    'product_details' => $value->product_details,
                    'qty' => $value->qty,
                    'price' => $productDetails->unit_price * $value->qty,
                    'tax_model' => 'include',
                    'delivery_status' => 'confirmed',
                    'payment_status' => $request->paymentstatus,
                    'is_stock_decreased' => 0,
                ]);
            }

            $shipping = ShippingAddress::where('customer_id', '=', $request->customerid)->get();
            if ($shipping->isEmpty()) {
                $shippingdata = ShippingAddress::create([
                    'customer_id' => $request->customerid,
                    'contact_person_name' => $request->customername,
                    'address_type' => 'parmanent',
                    'address' => $request->billingaddress . ' Post Office Address ' . $request->billingpostoffice,
                    'city' => $request->billingcity,
                    'zip' => $request->billingpincode,
                    'phone' => $request->mobileno,
                    'state' => $request->billingstate,
                    'country' => $request->billingcountry,
                    'latitude' => 0,
                    'longitude' => 0,
                    'is_billing' => 1,
                ]);
                ShippingAddress::create([
                    'customer_id' => $request->customerid,
                    'contact_person_name' => $request->customername,
                    'address_type' => 'parmanent',
                    'address' => $request->billingaddress . ' Post Office Address ' . $request->billingpostoffice,
                    'city' => $request->billingcity,
                    'zip' => $request->billingpincode,
                    'phone' => $request->mobileno,
                    'state' => $request->billingstate,
                    'country' => $request->billingcountry,
                    'latitude' => 0,
                    'longitude' => 0,
                    'is_billing' => 0,
                ]);
                BillingAddress::create([
                    'customer_id' => $request->customerid,
                    'contact_person_name' => $request->customername,
                    'address_type' => 'parmanent',
                    'address' => $request->billingaddress,
                    'city' => $request->billingcity,
                    'zip' => $request->billingpincode,
                    'phone' => $request->mobileno,
                    'state' => $request->billingstate,
                    'country' => $request->billingcountry,
                    'latitude' => 0,
                    'longitude' => 0,
                ]);
            }
            $order = SaleProductQuery::find($request->queryid);
            $order->status = '3';
            $order->save();
            $deletedata = AdminCart::where('customerid', '=', $request->customerid)->delete();
            return redirect()->route('sale.pro.list')->with('success', "Order Created Successfully.!!!!!");
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function vieworder_details(Request $request)
    {
        $orderid = $request->id;
        $followupdata = FollowUp::orderBy('created_at','desc')->get();
        // dd($followupdata);
        return view('sale-manager.view_orderdetails', compact('orderid','followupdata'));
    }

    public function create_followup(Request $req)
    {
        $auth = auth('sale_manager')->user();
        $validatedData = $req->validate([
            'orderid' => 'required',
            'orderstatus' => 'required',
            'remarksandcomments' => 'required',
        ]);
        $followUp = new FollowUp();
        $followUp->authid = $auth->id;
        $followUp->authfullname = $auth->name;
        $followUp->leadid = $req->input('orderid');
        $followUp->orderstatus = $req->input('orderstatus');
        $followUp->message = $req->input('remarksandcomments');
        $followUp->override = $req->has('override') ? true : false;
        $followUp->notifycustomer = $req->has('notifycustomer') ? true : false;
        $followUp->save();


        $followupdata = FollowUp::orderBy('created_at','desc')->get();
        $responseData = [
            'msg' => 'Successfully Added..!!!!!',
            'data' => $followupdata->toArray(),
        ];
        return response()->json($responseData);
    }

}
