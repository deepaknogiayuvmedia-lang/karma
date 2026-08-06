<?php

namespace App\Http\Controllers\Admin;

use App\CPU\BackEndHelper;
use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\CPU\Tallymethod;
use App\Http\Controllers\BaseController;
use App\Model\Brand;
use App\Model\BusinessSetting;
use App\Model\Category;
use App\Model\Color;
use App\Model\DealOfTheDay;
use App\Model\FlashDealProduct;
use App\Model\Product;
use App\Model\Review;
use App\Model\Translation;
use App\Model\Wishlist;
use App\Model\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use function App\CPU\translate;
use App\Model\Cart;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Tempproduct;


class ProductController extends BaseController
{
    public function add_new()
    {
        $cat = Category::where(['parent_id' => 0])->get();
        $br = Brand::orderBY('name', 'ASC')->get();
        $brand_setting = BusinessSetting::where('type', 'product_brand')->first()->value;
        $digital_product_setting = BusinessSetting::where('type', 'digital_product')->first()->value;
        return view('admin-views.product.add-new', compact('cat', 'br', 'brand_setting', 'digital_product_setting'));
    }

    public function featured_status(Request $request)
    {
        $product = Product::find($request->id);
        $product->featured = ($product['featured'] == 0 || $product['featured'] == null) ? 1 : 0;
        $product->save();
        $data = $request->status;
        return response()->json($data);
    }

    public function set_commission(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'commission' => 'required|numeric|min:0',
            'commission_type' => 'required|in:percentage,fixed',
        ]);

        if ($request->commission_type === 'percentage' && $request->commission > 100) {
            return response()->json(['success' => false, 'message' => 'Percentage cannot exceed 100%']);
        }

        $product = Product::find($request->product_id);

        if ($request->commission_type === 'fixed') {
            if ($request->commission > $product->unit_price) {
                return response()->json(['success' => false, 'message' => 'Commission cannot exceed product price (' . \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($product->unit_price)) . ')']);
            }
            $product->admin_commission = BackEndHelper::currency_to_usd($request->commission);
        } else {
            $product->admin_commission = $request->commission;
        }
        $product->admin_commission_type = $request->commission_type;
        $product->save();

        return response()->json(['success' => true, 'message' => 'Commission updated successfully']);
    }

    public function get_sellers($id)
    {
        $sellers = Product::where('pid', $id)
            ->where('added_by', 'seller')
            ->select('id', 'user_id', 'unit_price', 'current_stock', 'status')
            ->get();

        $sellerData = [];
        foreach ($sellers as $s) {
            $seller = \App\Model\Seller::find($s->user_id);
            if ($seller) {
                $shop = $seller->shop ?? null;
                $sellerData[] = [
                    'id' => $s->id,
                    'name' => $seller->f_name . ' ' . $seller->l_name,
                    'shop_name' => $shop ? $shop->name : 'N/A',
                    'price' => $s->unit_price,
                    'stock' => $s->current_stock,
                    'status' => $s->status,
                ];
            }
        }

        return response()->json(['sellers' => $sellerData]);
    }

    public function approve_status(Request $request)
    {
        $product = Product::find($request->id);
        // Phase 8: Handle new approval workflow
        if ($product->approval_status === 'pending' || $product->approval_status === 'pending_edit') {
            $product->approval_status = 'approved';
            $product->edit_status = 'none';
        } else {
            $product->request_status = ($product['request_status'] == 0) ? 1 : 0;
        }
        $product->save();

        return redirect()->route('admin.product.list', ['seller', 'status' => $product['request_status']]);
    }

    public function deny(Request $request)
    {
        $product = Product::find($request->id);
        // Phase 8: Handle new approval workflow
        $product->approval_status = 'rejected';
        $product->request_status = 2;
        $product->denied_note = $request->denied_note;
        $product->save();

        return redirect()->route('admin.product.list', ['seller', 'status' => 2]);
    }

    // Phase 9: Admin Verify Product
    public function verify(Request $request)
    {
        $product = Product::find($request->id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->verified = !$product->verified;
        $product->verified_by = $product->verified ? auth('admin')->id() : null;
        $product->verified_at = $product->verified ? now() : null;
        $product->save();

        // Send notification to seller
        if ($product->seller_id && $product->verified) {
            $seller = \App\Model\Seller::find($product->seller_id);
            if ($seller && !empty($seller->cm_firebase_token)) {
                $title = 'Product Verified';
                $body = "Your product \"{$product->name}\" has been verified by admin.";
                \App\CPU\Helpers::send_push_notif_to_device($seller->cm_firebase_token, [
                    'title' => $title,
                    'body' => $body,
                ]);
            }
        }

        $status = $product->verified ? 'verified' : 'unverified';
        return response()->json(['status' => $status, 'message' => "Product {$status} successfully"]);
    }

    // Phase 9: Bulk Verify Products
    public function bulk_verify(Request $request)
    {
        $productIds = $request->product_ids;
        if (empty($productIds)) {
            return response()->json(['error' => 'No products selected'], 400);
        }

        $products = Product::whereIn('id', $productIds)->get();
        Product::whereIn('id', $productIds)->update([
            'verified' => 1,
            'verified_by' => auth('admin')->id(),
            'verified_at' => now(),
        ]);

        // Send notifications to sellers
        foreach ($products as $product) {
            if ($product->seller_id) {
                $seller = \App\Model\Seller::find($product->seller_id);
                if ($seller && !empty($seller->cm_firebase_token)) {
                    $title = 'Product Verified';
                    $body = "Your product \"{$product->name}\" has been verified by admin.";
                    \App\CPU\Helpers::send_push_notif_to_device($seller->cm_firebase_token, [
                        'title' => $title,
                        'body' => $body,
                    ]);
                }
            }
        }

        return response()->json(['message' => count($productIds) . ' products verified successfully']);
    }

    public function view($id)
    {
        $product = Product::with(['reviews'])->where(['id' => $id])->first();
        $reviews = Review::where(['product_id' => $id])->whereNull('delivery_man_id')->paginate(Helpers::pagination_limit());
        return view('admin-views.product.view', compact('product', 'reviews'));
    }

    public function store(Request $request)
    {
        $adminId = auth('admin')->id();
        
        $validator = Validator::make($request->all(), [
            'name'                 => 'required',
            'category_id'          => 'required',
            'product_type'         => 'required',
            'digital_product_type' => 'required_if:product_type,==,digital',
            'digital_file_ready'   => 'required_if:digital_product_type,==,ready_product|mimes: jpg,jpeg,png,webp,gif,webp,zip,pdf',
            'unit'                 => 'required_if:product_type,==,physical',
            'image'                => 'required',
            'tax'                  => 'required|min:0',
            'tax_model'            => 'required',
            'unit_price'           => 'required|numeric|gt:0',
            'purchase_price'       => 'required|numeric|gt:0',
            'discount'             => 'required|gt:-1',
            'shipping_cost'        => 'required_if:product_type,==,physical|gt:-1',
            'code'                 => 'required|numeric|min:1|digits_between:6,20|unique:products',
            'minimum_order_qty'    => 'required|numeric|min:1',
        ], [
            'image.required'                   => 'Product thumbnail is required!',
            'category_id.required'             => 'Category is required!',
            'unit.required_if'                 => 'Unit is required!',
            'code.min'                         => 'Code must be positive!',
            'code.digits_between'              => 'Code must be minimum 6 digits!',
            'minimum_order_qty.required'       => 'Minimum order quantity is required!',
            'minimum_order_qty.min'            => 'Minimum order quantity must be positive!',
            'digital_file_ready.required_if'   => 'Ready product upload is required!',
            'digital_file_ready.mimes'         => 'Ready product upload must be a file of type: pdf, zip, jpg, jpeg, png, gif.',
            'digital_product_type.required_if' => 'Digital product type is required!',
            'shipping_cost.required_if'        => 'Shipping Cost is required!',
        ]);

        if (!$request->has('colors_active') && !$request->file('images')) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'images',
                    'Product images is required!'
                );
            });
        }

        $brand_setting = BusinessSetting::where('type', 'product_brand')->first()->value;
        if ($brand_setting && empty($request->brand_id)) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'brand_id',
                    'Brand is required!'
                );
            });
        }

        if ($request['discount_type'] == 'percent') {
            $dis = ($request['unit_price'] / 100) * $request['discount'];
        } else {
            $dis = $request['discount'];
        }

        if ($request['product_type'] == 'physical' && $request['unit_price'] <= $dis) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'unit_price',
                    'Discount can not be more or equal to the price!'
                );
            });
        }

        if (is_null($request->name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'name',
                    'Name field is required!'
                );
            });
        }

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        if (Product::where('code', $request->code)->exists()) {
            Toastr::error(translate('Product with this code already exists!'));
            return back();
        }

        $p11 = new Product();
        try {
            $p11->save();
        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), 'Duplicate entry') || str_contains($e->getMessage(), 'UNIQUE constraint failed')) {
                Toastr::error(translate('Product with this code already exists!'));
                return back();
            }
            throw $e;
        }
        if (!$p11) {
            Toastr::error(translate('Product creation failed!'));
            return back();
        }
        $p = Product::find($p11->id);

        $p->user_id  = auth('admin')->id();
        $p->added_by = "admin";
        $p->name     = $request->name[array_search('en', $request->lang)];
        $p->tally_name = $request->prn[0];
        $p->code     = $request->code;  // Removed since already set
        $p->slug     = Str::slug($request->name[array_search('en', $request->lang)], '-') . '-' . Str::random(6);

        $product_images = [];
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            foreach ($request->colors as $color) {
                $color_ = str_replace('#', '', $color);
                $img = 'color_image_' . $color_;
                if ($request->file($img)) {
                    $image_name = ImageManager::upload('product/', 'png', $request->file($img));
                    $product_images[] = $image_name;
                    $color_image_serial[] = [
                        'color' => $color_,
                        'image_name' => $image_name,
                    ];
                }
            }
            if (count($product_images) != count($request->colors)) {
                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'images',
                        'Color images is required!'
                    );
                });
            }
        }

        $category = [];
        $categoryName = null;
        if ($request->category_id != null) {

            array_push($category, [

                'id' => $request->category_id,
                'position' => 1,
            ]);
        }
        if ($request->sub_category_id != null) {

            array_push($category, [
                'id' => $request->sub_category_id,
                'position' => 2,
            ]);
        }
        if ($request->sub_sub_category_id != null) {

            array_push($category, [
                'id' => $request->sub_sub_category_id,
                'position' => 3,
            ]);
        }
        $categoryName = Category::find($category[count($category) - 1]['id'])?->name ?? $request->sub_sub_category_id;
        if (\App\CPU\Tallymethod::isSyncEnabled($adminId)) {
            $response = Tallymethod::createGroup($categoryName,auth('admin')->id());
            if (!Tallymethod::isSuccess($response)) {
                Toastr::error(translate('Tally group creation failed for sub sub category: ') . $categoryName);
                return back();
            }
        }
        $p->category_ids         = json_encode($category);
        $p->brand_id             = $request->brand_id;
        $p->unit                 = $request->product_type == 'physical' ? $request->unit : null;
        $p->digital_product_type = $request->product_type == 'digital' ? $request->digital_product_type : null;
        $p->product_type         = $request->product_type;
        $default_lang_index = array_search(Helpers::default_lang(), $request->lang ?? []);
        $p->details              = $default_lang_index !== false ? ($request->description[$default_lang_index] ?? '') : '';

        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $p->colors = $request->product_type == 'physical' ? json_encode($request->colors) : json_encode([]);
        } else {
            $colors = [];
            $p->colors = $request->product_type == 'physical' ? json_encode($colors) : json_encode([]);
        }
        $choice_options = [];
        if ($request->has('choice')) {
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_' . $no;
                $item['name'] = 'choice_' . $no;
                $item['title'] = $request->choice[$key];
                $item['options'] = explode(',', implode('|', $request[$str]));
                array_push($choice_options, $item);
            }
        }
        $p->choice_options = $request->product_type == 'physical' ? json_encode($choice_options) : json_encode([]);
        //combinations start
        $options = [];
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        }
        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $my_str = implode('|', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }
        //Generates the combinations of customer choice options

        $combinations = Helpers::combinations($options);

        $variations = [];
        $stock_count = 0;
        $oldunit = null;
        if (count($combinations[0]) > 0) {
            foreach ($combinations as $key => $combination) {
                $str = '';
                foreach ($combination as $k => $item) {
                    if ($k > 0) {
                        $str .= '-' . str_replace(' ', '', $item);
                    } else {
                        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                            $color_name = Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        } else {
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }

                $item = [];
                $unit = preg_replace('/[^a-zA-Z]/', '', $str);
                if ($oldunit != $unit) {
                    $oldunit = $unit;
                    if (\App\CPU\Tallymethod::isSyncEnabled($adminId)) {
                        $response = Tallymethod::createUnit($oldunit,auth('admin')->id());
                        if (!Tallymethod::isSuccess($response)) {
                            Toastr::error(translate('Tally unit creation failed for unit: ') . $oldunit);
                            return back();
                        }
                    }   
                }
                $item['type'] = $str;
                $item['price'] = BackEndHelper::currency_to_usd(abs($request['price_' . str_replace('.', '_', $str)]));
                $item['sku'] = $request['sku_' . str_replace('.', '_', $str)];
                $item['qty'] = abs($request['qty_' . str_replace('.', '_', $str)]);
                if (\App\CPU\Tallymethod::isSyncEnabled($adminId)) {
                    $response = Tallymethod::createOrAlterItem($p->tally_name . '-' . $str . '-' . $p->id, $categoryName, $item['qty'], $unit, $item['price'],auth('admin')->id());
                    if (!Tallymethod::isSuccess($response)) {
                        Toastr::error(translate('Tally item creation failed for item: ') . $p->tally_name . '-' . $str);
                        return back();
                    }
                }
                array_push($variations, $item);
                $stock_count += $item['qty'];
            }
        } else {
            $stock_count = (int)$request['current_stock'];
        }

        if ($validator->errors()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        //combinations end
        $p->variation         = $request->product_type == 'physical' ? json_encode($variations) : json_encode([]);
        $p->unit_price        = BackEndHelper::currency_to_usd($request->unit_price);
        $p->purchase_price    = BackEndHelper::currency_to_usd($request->purchase_price);
        $p->tax               = $request->tax_type == 'flat' ? BackEndHelper::currency_to_usd($request->tax) : $request->tax;
        $p->tax_type          = $request->tax_type;
        $p->tax_model          = $request->tax_model;
        $p->discount          = $request->discount_type == 'flat' ? BackEndHelper::currency_to_usd($request->discount) : $request->discount;
        $p->discount_type     = $request->discount_type;
        $p->discount_amount = $request->discount_type == 'flat' ? $request->unit_price - $request->discount : $request->unit_price * ($request->discount / 100);
        $p->actual_amount =   $request->unit_price - $p->discount_amount;
        $p->attributes        = $request->product_type == 'physical' ? json_encode($request->choice_attributes) : json_encode([]);
        $p->current_stock     = $request->product_type == 'physical' ? abs($stock_count) : 0;
        $p->minimum_order_qty = $request->minimum_order_qty;
        $p->video_provider    = 'youtube';
        $p->video_url         = $request->video_link;
        $p->request_status    = 1;
        $p->verified          = 1;
        $p->verified_by       = auth('admin')->id();
        $p->verified_at       = now();
        $p->shipping_cost     = $request->product_type == 'physical' ? BackEndHelper::currency_to_usd($request->shipping_cost) : 0;
        $p->multiply_qty      = ($request->product_type == 'physical') ? ($request->multiplyQTY == 'on' ? 1 : 0) : 0;
        // Phase 6: Per-Product Commission
        $p->admin_commission = $request->admin_commission ?? 0;
        $p->admin_commission_type = $request->admin_commission_type ?? 'percentage';
        // Phase 7: Product Priority
        $p->priority = $request->priority ?? 0;
        // Phase 8: Approval Status (admin products are auto-approved)
        $p->approval_status = 'approved';

        // if ($request->ajax()) {

        //     return response()->json([], 200);
        // } else {
        if ($request->file('images')) {
            foreach ($request->file('images') as $img) {
                $image_name = ImageManager::upload('product/', 'png', $img);
                $product_images[] = $image_name;
                if ($request->has('colors_active')) {
                    $color_image_serial[] = [
                        'color' => null,
                        'image_name' => $image_name,
                    ];
                } else {
                    $color_image_serial = [];
                }
            }
        }
        $p->color_image = json_encode($color_image_serial);
        $p->images = json_encode($product_images);
        $p->thumbnail = ImageManager::upload('product/thumbnail/', 'png', $request->image);

        if ($request->product_type == 'digital' && $request->digital_product_type == 'ready_product') {
            $p->digital_file_ready = ImageManager::upload('product/digital-product/', $request->digital_file_ready->getClientOriginalExtension(), $request->digital_file_ready);
        }

        $p->meta_title       = $request->meta_title;
        $p->meta_description = $request->meta_description;
        $p->meta_image       = ImageManager::upload('product/meta/', 'png', $request->meta_image);
        $p->save();
        // Sync with Tally
        $tag_ids = [];
        if ($request->tags != null) {
            $tags = explode(",", $request->tags);
        }
        if (isset($tags)) {
            foreach ($tags as $key => $value) {
                $tag = Tag::firstOrNew(
                    ['tag' => trim($value)]
                );
                $tag->save();
                $tag_ids[] = $tag->id;
            }
        }
        $p->tags()->sync($tag_ids);

        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\Product',
                    'translationable_id' => $p->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
            if ($request->description[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\Product',
                    'translationable_id' => $p->id,
                    'locale' => $key,
                    'key' => 'description',
                    'value' => $request->description[$index],
                ));
            }
        }
        Translation::insert($data);

        Toastr::success(translate('Product added successfully!'));
        return response()->json([], 200);

        // }    
    }

    function list(Request $request, $type)
    {
        $query_param = [];
        $search = $request['search'];
        if ($type == 'in_house') {
            $pro = Product::where(['added_by' => 'admin']);
        } else {
            $pro = Product::where(['added_by' => 'seller'])->where('request_status', $request->status);
        }

        // Verified filter
        $verified_filter = $request->verified ?? null;
        if ($verified_filter === 'verified') {
            $pro->where('verified', 1);
        } elseif ($verified_filter === 'unverified') {
            $pro->where('verified', 0);
        }

        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $pro = $pro->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }

        $request_status = $request['status'];
        $pro = $pro->orderBy('id', 'DESC')->paginate(Helpers::pagination_limit())->appends(['status' => $request['status']])->appends(['verified' => $verified_filter])->appends($query_param);

        // Counts for tabs
        $all_count = Product::where('added_by', $type == 'in_house' ? 'admin' : 'seller')
            ->when($type != 'in_house', fn($q) => $q->where('request_status', $request_status))
            ->count();
        $verified_count = Product::where('added_by', $type == 'in_house' ? 'admin' : 'seller')
            ->where('verified', 1)
            ->when($type != 'in_house', fn($q) => $q->where('request_status', $request_status))
            ->count();
        $unverified_count = Product::where('added_by', $type == 'in_house' ? 'admin' : 'seller')
            ->where('verified', 0)
            ->when($type != 'in_house', fn($q) => $q->where('request_status', $request_status))
            ->count();

        return view('admin-views.product.list', compact('pro', 'search', 'request_status', 'type', 'verified_filter', 'all_count', 'verified_count', 'unverified_count'));
    }

    /**
     * Export product list by excel
     * @param Request $request
     * @param $type
     */
    public function export_excel(Request $request, $type)
    {
        $products = Product::when($type == 'in_house', function ($q) {
            $q->where(['added_by' => 'admin']);
        })->when($type != 'in_house', function ($q) use ($request) {
            $q->where(['added_by' => 'seller'])->where('request_status', $request->status);
        })->latest()->get();
        //export from product
        $data = [];
        foreach ($products as $item) {
            $category_id = 0;
            $sub_category_id = 0;
            $sub_sub_category_id = 0;
            foreach (json_decode($item->category_ids, true) as $category) {
                if ($category['position'] == 1) {
                    $category_id = $category['id'];
                } else if ($category['position'] == 2) {
                    $sub_category_id = $category['id'];
                } else if ($category['position'] == 3) {
                    $sub_sub_category_id = $category['id'];
                }
            }
            $data[] = [
                'name' => $item->name,
                'Product Type'          => $item->product_type,
                'category_id'           => $category_id,
                'sub_category_id'       => $sub_category_id,
                'sub_sub_category_id'   => $sub_sub_category_id,
                'brand_id'              => $item->brand_id,
                'unit'                  => $item->unit,
                'min_qty'               => $item->min_qty,
                'refundable'            => $item->refundable,
                'youtube_video_url'     => $item->video_url,
                'unit_price'            => $item->unit_price,
                'purchase_price'        => $item->purchase_price,
                'tax'                   => $item->tax,
                'discount'              => $item->discount,
                'discount_type'         => $item->discount_type,
                'current_stock'         => $item->product_type == 'physical' ? $item->current_stock : null,
                'details'               => $item->details,
                'thumbnail'             => 'thumbnail/' . $item->thumbnail,
                'Status'                => $item->status == 1 ? 'Active' : 'Inactive',
            ];
        }

        return (new FastExcel($data))->download('product_list.xlsx');
    }

    public function updated_product_list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $pro = Product::where(['added_by' => 'seller'])
                ->where('is_shipping_cost_updated', 0)
                ->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->Where('name', 'like', "%{$value}%");
                    }
                });
            $query_param = ['search' => $request['search']];
        } else {
            $pro = Product::where(['added_by' => 'seller'])->where('is_shipping_cost_updated', 0);
        }
        $pro = $pro->orderBy('id', 'DESC')->paginate(Helpers::pagination_limit())->appends($query_param);

        return view('admin-views.product.updated-product-list', compact('pro', 'search'));
    }

    public function stock_limit_list(Request $request, $type)
    {
        $stock_limit = Helpers::get_business_settings('stock_limit');
        $sort_oqrderQty = $request->get('sort_oqrderQty');

        // build query params for pagination links; keep everything except the page number itself
        $query_param = $request->except('page');

        $search = $request->get('search');
        if ($type == 'in_house') {
            $pro = Product::where(['added_by' => 'admin', 'product_type' => 'physical']);
        } else {
            $pro = Product::where(['added_by' => 'seller', 'product_type' => 'physical'])
                ->where('request_status', $request->get('status'));
        }

        if ($search) {
            $key = explode(' ', $search);
            $pro = $pro->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->where('name', 'like', "%{$value}%");
                }
            });
        }

        $request_status = $request->get('status');

        $pro = $pro
            ->when($sort_oqrderQty == 'quantity_asc', function ($q) {
                return $q->orderBy('current_stock', 'asc');
            })
            ->when($sort_oqrderQty == 'quantity_desc', function ($q) {
                return $q->orderBy('current_stock', 'desc');
            })
            ->when($sort_oqrderQty == 'order_asc', function ($q) {
                return $q->orderBy('order_details_count', 'asc');
            })
            ->when($sort_oqrderQty == 'order_desc', function ($q) {
                return $q->orderBy('order_details_count', 'desc');
            })
            ->when($sort_oqrderQty == 'default', function ($q) {
                return $q->orderBy('id');
            });

        // for JavaScript pagination we need ALL rows on the page
        $pro = $pro->orderBy('id', 'DESC')->get();
        $paginate_limit = Helpers::pagination_limit();
        return view('admin-views.product.stock-limit-list', compact(
            'pro',
            'search',
            'request_status',
            'sort_oqrderQty',
            'stock_limit',
            'paginate_limit',

        ));
    }

    public function update_quantity(Request $request)
    {
        $product = Product::find($request->data['id']);

        $variations = json_decode($product->variation, true) ?? [];
        $categories = json_decode($product->category_ids, true);

        $categoryName = $categories[count($categories) - 1]['id'] ?? null;
        $categoryName = Category::find($categoryName)?->name ?? $categoryName;

        $stock_count = 0;
        if ($product) {
            foreach ($variations as $key => &$item) {
                if ($item['type'] == $request->data['variation']) {

                    $item['type'] = $request->data['variation'];
                    $item['price'] = BackEndHelper::currency_to_usd(abs($request->data['price']));
                    $item['qty'] = abs($request->data['qty']);
                    $unit =  $unit = preg_replace('/[^a-zA-Z]/', '', $item['type']);
                    $response = Tallymethod::createUnit($unit);
                    if (!Tallymethod::isSuccess($response)) {
                        Toastr::error(translate('Tally unit creation failed for unit: ') . $unit);
                        return back();
                    }
                    $order_pending_qty = OrderDetail::where('product_id', $request->data['id'])->where('delivery_status', 'pending')->where('variant', $item['type'])->sum('qty');
                    // dd($order_pending_qty);
                    $response = Tallymethod::updateOpeningStock($product->tally_name . '-' . $item['type'] . '-' . $request->data['id'], $categoryName, $item['qty'] + $order_pending_qty, $unit, $item['price']);
                    if (!Tallymethod::isSuccess($response)) {
                        Toastr::error(translate('Tally item creation failed for item: ') . $product->tally_name . '-' . $item['type']);
                        return back();
                    }
                }

                $stock_count += $item['qty'];
            }
        }

        if ($stock_count >= 0) {
            $product->variation = json_encode($variations);
            $product->current_stock = $stock_count;
            $product->purchase_price = $request->data['purchase_price'];
            $product->save();
            Toastr::success(\App\CPU\translate('product_quantity_updated_successfully!'));
            return back();
        } else {
            Toastr::warning(\App\CPU\translate('product_quantity_can_not_be_less_than_0_!'));
            return back();
        }
    }

    public function status_update(Request $request)
    {

        $product = Product::where(['id' => $request['id']])->first();
        $success = 1;

        if ($request['status'] == 1) {
            if ($product->added_by == 'seller' && ($product->request_status == 0 || $product->request_status == 2)) {
                $success = 0;
            } else {
                $product->status = $request['status'];
            }
        } else {
            $product->status = $request['status'];
        }
        $product->save();
        return response()->json([
            'success' => $success,
        ], 200);
    }

    public function updated_shipping(Request $request)
    {

        $product = Product::where(['id' => $request['product_id']])->first();
        if ($request->status == 1) {
            $product->shipping_cost = $product->temp_shipping_cost;
            $product->is_shipping_cost_updated = $request->status;
        } else {
            $product->is_shipping_cost_updated = $request->status;
        }

        $product->save();
        return response()->json([], 200);
    }

    public function get_categories(Request $request)
    {
        $cat = Category::where(['parent_id' => $request->parent_id])->get();
        $res = '<option value="' . 0 . '" disabled selected>---' . translate("Select") . '---</option>';
        foreach ($cat as $row) {
            if ($row->id == $request->sub_category) {
                $res .= '<option value="' . $row->id . '" selected >' . $row->name . '</option>';
            } else {
                $res .= '<option value="' . $row->id . '">' . $row->name . '</option>';
            }
        }
        return response()->json([
            'select_tag' => $res,
        ]);
    }

    public function sku_combination(Request $request)
    {
        $options = [];
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        } else {
            $colors_active = 0;
        }

        $unit_price = $request->unit_price;
        $product_name = $request->name[array_search('en', $request->lang)];

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $my_str = implode('', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        $combinations = Helpers::combinations($options);
        return response()->json([
            'view' => view('admin-views.product.partials._sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name'))->render(),
        ]);
    }

    public function get_variations(Request $request)
    {
        $product = Product::find($request['id']);
        return response()->json(data: [
            'view' => view('admin-views.product.partials._update_stock', compact('product'))->render()
        ]);
    }

    public function edit($id)
    {
        $product = Product::withoutGlobalScopes()->with('translations')->find($id);
        $product_category = json_decode($product->category_ids);
        $product->colors = json_decode($product->colors);
        $categories = Category::where(['parent_id' => 0])->get();
        $br = Brand::orderBY('name', 'ASC')->get();
        $brand_setting = BusinessSetting::where('type', 'product_brand')->first()->value;
        $digital_product_setting = BusinessSetting::where('type', 'digital_product')->first()->value;

        return view('admin-views.product.edit', compact('categories', 'br', 'product', 'product_category', 'brand_setting', 'digital_product_setting'));
    }

    public function update(Request $request, $id)
    {
        $adminId = auth('admin')->id(); 

        $product = Product::find($id);
        $validator = Validator::make($request->all(), [
            'name'                  => 'required',
            'prn'                   => 'required',
            'category_id'           => 'required',
            'product_type'          => 'required',
            'digital_product_type'  => 'required_if:product_type,==,digital',
            'digital_file_ready'    => 'mimes: jpg,jpeg,png,webp,gif,webp,zip,pdf',
            'unit'                  => 'required_if:product_type,==,physical',
            'tax'                   => 'required|min:0',
            'tax_model'             => 'required',
            'unit_price'            => 'required|numeric|gt:0',
            'purchase_price'        => 'required|numeric|gt:0',
            'discount'              => 'required|gt:-1',
            'shipping_cost'         => 'required_if:product_type,==,physical|gt:-1',
            'code'                  => 'required|numeric|min:1|digits_between:6,20|unique:products,code,' . $product->id,
            'minimum_order_qty'     => 'required|numeric|min:1',
        ], [
            'name.required'                     => 'Product name is required!',
            'prn.required'                      => 'Product PRN is required!',
            'category_id.required'              => 'category  is required!',
            'unit.required_if'                  => 'Unit  is required!',
            'code.min'                          => 'Code must be positive!',
            'code.digits_between'               => 'Code must be minimum 6 digits!',
            'minimum_order_qty.required'        => 'Minimum order quantity is required!',
            'minimum_order_qty.min'             => 'Minimum order quantity must be positive!',
            'digital_file_ready.mimes'          => 'Ready product upload must be a file of type: pdf, zip, jpg, jpeg, png, gif.',
            'digital_product_type.required_if'  => 'Digital product type is required!',
            'shipping_cost.required_if'         => 'Shipping Cost is required!',
        ]);

        $brand_setting = BusinessSetting::where('type', 'product_brand')->first()->value;
        if ($brand_setting && empty($request->brand_id)) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'brand_id',
                    'Brand is required!'
                );
            });
        }

        if (
            ($request->product_type == 'digital') &&
            ($request->digital_product_type == 'ready_product') &&
            empty($product->digital_file_ready) &&
            !$request->file('digital_file_ready')
        ) {
            $validator->after(function ($validator) {
                $validator->errors()->add('digital_file_ready', 'Ready product upload is required!');
            });
        }

        if ($request['discount_type'] == 'percent') {
            $dis = ($request['unit_price'] / 100) * $request['discount'];
        } else {
            $dis = $request['discount'];
        }

        if ($request['product_type'] == 'physical' && $request['unit_price'] <= $dis) {
            $validator->after(function ($validator) {
                $validator->errors()->add('unit_price', 'Discount can not be more or equal to the price!');
            });
        }

        if (is_null($request->name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'name',
                    'Name field is required!'
                );
            });
        }

        $product_images = json_decode($product->images);
        $color_image_array = [];
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $db_color_image = $product->color_image ? json_decode($product->color_image, true) : [];
            if (!$db_color_image) {
                foreach ($product_images as $image) {
                    $db_color_image[] = [
                        'color' => null,
                        'image_name' => $image,
                    ];
                }
            }

            $db_color_image_final = [];
            if ($db_color_image) {
                foreach ($db_color_image as $color_img) {
                    if ($color_img['color']) {
                        $db_color_image_final[] = $color_img['color'];
                    }
                }
            }

            $input_colors = [];
            foreach ($request->colors as $color) {
                $input_colors[] = str_replace('#', '', $color);
            }
            $diff_color = array_diff($db_color_image_final, $input_colors);

            $color_image_required = [];
            if ($db_color_image) {
                foreach ($db_color_image as $color_img) {
                    if ($color_img['color'] != null && !in_array($color_img['color'], $diff_color)) {
                        $color_image_required[] = [
                            'color' => $color_img['color'],
                            'image_name' => $color_img['image_name'],
                        ];
                    }
                }
            }
            $color_image_array = $db_color_image;

            foreach ($input_colors as $color) {
                if (!in_array($color, $db_color_image_final)) {
                    $img = 'color_image_' . $color;
                    if ($request->file($img)) {
                        $image_name = ImageManager::upload('product/', 'png', $request->file($img));
                        $product_images[] = $image_name;
                        $col_img_arr = [
                            'color' => $color,
                            'image_name' => $image_name,
                        ];
                        $color_image_required[] = $col_img_arr;
                        $color_image_array[] = $col_img_arr;
                    }
                }
            }

            if (count($color_image_required) != count($request->colors)) {
                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'images',
                        'Color images is required!'
                    );
                });
            }
        }

        $product->name = $request->name[array_search('en', $request->lang)];
        $product->tally_name = $request->prn[0];
        $categoryName = null;
        $category = [];
        if ($request->category_id != null) {
            array_push($category, [

                'id' => $request->category_id,
                'position' => 1,
            ]);
        }
        if ($request->sub_category_id != null) {
            array_push($category, [
                'id' => $request->sub_category_id,
                'position' => 2,
            ]);
        }
        if ($request->sub_sub_category_id != null) {
            array_push($category, [
                'id' => $request->sub_sub_category_id,
                'position' => 3,
            ]);
        }

        $categoryName = Category::find($category[count($category) - 1]['id'])?->name ?? $request->sub_sub_category_id;
        if (\App\CPU\Tallymethod::isSyncEnabled($adminId)) {
            $response = Tallymethod::createGroup($categoryName,auth('admin')->id());
            if (!Tallymethod::isSuccess($response)) {
                Toastr::error(translate('Tally group creation failed for sub sub category: ') . $categoryName);
                return back();
            }
        }
        $product->product_type          = $request->product_type;
        $product->category_ids          = json_encode($category);

        $product->unit                  = $request->product_type == 'physical' ? $request->unit : null;
        $product->digital_product_type  = $request->product_type == 'digital' ? $request->digital_product_type : null;
        $product->code                  = $request->code;
        $product->minimum_order_qty     = $request->minimum_order_qty;
        $default_lang_index = array_search(Helpers::default_lang(), $request->lang ?? []);
        $product->details               = $default_lang_index !== false ? ($request->description[$default_lang_index] ?? '') : '';

        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $product->colors = $request->product_type == 'physical' ? json_encode($request->colors) : json_encode([]);
        } else {
            $colors = [];
            $product->colors = json_encode($colors);
        }
        $choice_options = [];
        if ($request->has('choice')) {
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_' . $no;
                $item['name'] = 'choice_' . $no;
                $item['title'] = $request->choice[$key];
                $item['options'] = explode(',', implode('|', $request[$str]));
                array_push($choice_options, $item);
            }
        }
        $product->choice_options = $request->product_type == 'physical' ? json_encode($choice_options) : json_encode([]);
        $variations = [];
        //combinations start
        $options = [];
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        }
        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $my_str = implode('|', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }
        //Generates the combinations of customer choice options
        $combinations = Helpers::combinations($options);
        $variations = [];
        $stock_count = 0;
        $oldunit = Null;
        if (count($combinations[0]) > 0) {
            foreach ($combinations as $key => $combination) {
                $str = '';
                foreach ($combination as $k => $item) {
                    if ($k > 0) {
                        $str .= '-' . str_replace(' ', '', $item);
                    } else {
                        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                            $color_name = Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        } else {
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }
                $item = [];
                $unit = preg_replace('/[^a-zA-Z]/', '', $str);
                if ($oldunit != $unit) {
                    $oldunit = $unit;
                    if (\App\CPU\Tallymethod::isSyncEnabled($adminId)) {
                        $response = Tallymethod::createUnit($oldunit,auth('admin')->id());
                        if (!Tallymethod::isSuccess($response)) {
                            Toastr::error(translate('Tally unit creation failed for unit: ') . $oldunit);
                            return back();
                        }
                    }
                    // dump($oldunit);
                }

                $item['type'] = $str;
                $item['price'] = BackEndHelper::currency_to_usd(abs($request['price_' . str_replace('.', '_', $str)]));
                $item['sku'] = $request['sku_' . str_replace('.', '_', $str)];
                $item['qty'] = abs($request['qty_' . str_replace('.', '_', $str)]);
                $order_pending_qty = OrderDetail::where('product_id', $product->id)->where('delivery_status', 'pending')->where('variant', $item['type'])->sum('qty');
                // tally product update
                if (\App\CPU\Tallymethod::isSyncEnabled($adminId)) {
                    $response = Tallymethod::updateOpeningStock($product->tally_name . '-' . $str . '-' . $product->id, $categoryName, $item['qty'] + $order_pending_qty, $unit, $item['price'],auth('admin')->id());
                    if (!Tallymethod::isSuccess($response)) {
                        Toastr::error(translate('Tally item creation failed for item: ') . $product->tally_name . '-' . $str);
                        return back();
                    }
                }
                array_push($variations, $item);
                $stock_count += $item['qty'];
            }
        } else {
            $stock_count = (int)$request['current_stock'];
        }
        // dd();
        if ($validator->errors()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        //combinations end

        $product->variation      = $request->product_type == 'physical' ? json_encode($variations) : json_encode([]);
        $product->unit_price     = BackEndHelper::currency_to_usd($request->unit_price);
        $product->purchase_price = BackEndHelper::currency_to_usd($request->purchase_price);
        $product->tax            = $request->tax == 'flat' ? BackEndHelper::currency_to_usd($request->tax) : $request->tax;
        $product->tax_type       = $request->tax_type;
        $product->tax_model          = $request->tax_model;
        $product->discount       = $request->discount_type == 'flat' ? BackEndHelper::currency_to_usd($request->discount) : $request->discount;
        $product->attributes     = $request->product_type == 'physical' ? json_encode($request->choice_attributes) : json_encode([]);
        $product->discount_type  = $request->discount_type;
        $product->discount_amount = $request->discount_type == 'flat' ? $request->unit_price - $request->discount : $request->unit_price * ($request->discount / 100);
        $product->actual_amount =   $request->unit_price - $product->discount_amount;
        $product->current_stock  = $request->product_type == 'physical' ? abs($stock_count) : 0;
        $product->video_provider = 'youtube';
        $product->video_url = $request->video_link;
        if ($product->added_by == 'seller' && $product->request_status == 2) {
            $product->request_status = 1;
        }

        $product->shipping_cost = $request->product_type == 'physical' ? BackEndHelper::currency_to_usd($request->shipping_cost) : 0;
        $product->multiply_qty = ($request->product_type == 'physical') ? ($request->multiplyQTY == 'on' ? 1 : 0) : 0;
        // Phase 6: Per-Product Commission
        $product->admin_commission = $request->admin_commission ?? 0;
        $product->admin_commission_type = $request->admin_commission_type ?? 'percentage';
        // Phase 7: Product Priority
        $product->priority = $request->priority ?? 0;
        if ($request->ajax()) {
            return response()->json([], 200);
        } else {
            if ($request->file('images')) {
                foreach ($request->file('images') as $img) {
                    $image_name = ImageManager::upload('product/', 'png', $img);
                    $product_images[] = $image_name;
                    if ($request->has('colors_active')) {
                        $color_image_array[] = [
                            'color' => null,
                            'image_name' => $image_name,
                        ];
                    }
                }
            }
            $product->images = json_encode($product_images);
            $product->color_image = json_encode($color_image_array);

            if ($request->file('image')) {
                $product->thumbnail = ImageManager::update('product/thumbnail/', $product->thumbnail, 'png', $request->file('image'));
            }

            if ($request->product_type == 'digital') {
                if ($request->digital_product_type == 'ready_product' && $request->hasFile('digital_file_ready')) {
                    $product->digital_file_ready = ImageManager::update('product/digital-product/', $product->digital_file_ready, $request->digital_file_ready->getClientOriginalExtension(), $request->file('digital_file_ready'));
                } elseif (($request->digital_product_type == 'ready_after_sell') && $product->digital_file_ready) {
                    ImageManager::delete('product/digital-product/' . $product->digital_file_ready);
                    $product->digital_file_ready = null;
                }
            } elseif ($request->product_type == 'physical' && $product->digital_file_ready) {
                ImageManager::delete('product/digital-product/' . $product->digital_file_ready);
                $product->digital_file_ready = null;
            }

            $product->meta_title = $request->meta_title;
            $product->meta_description = $request->meta_description;
            if ($request->file('meta_image')) {
                $product->meta_image = ImageManager::update('product/meta/', $product->meta_image, 'png', $request->file('meta_image'));
            }
            // Sync with Tally

            // Always update SQL
            $product->save();


            $tag_ids = [];
            if ($request->tags != null) {
                $tags = explode(",", $request->tags);
            }
            if (isset($tags)) {
                foreach ($tags as $key => $value) {
                    $tag = Tag::firstOrNew(
                        ['tag' => trim($value)]
                    );
                    $tag->save();
                    $tag_ids[] = $tag->id;
                }
            }
            $product->tags()->sync($tag_ids);

            foreach ($request->lang as $index => $key) {
                if ($request->name[$index] && $key != 'en') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'App\Model\Product',
                            'translationable_id' => $product->id,
                            'locale' => $key,
                            'key' => 'name'
                        ],
                        ['value' => $request->name[$index]]
                    );
                }
                if ($request->description[$index] && $key != 'en') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'App\Model\Product',
                            'translationable_id' => $product->id,
                            'locale' => $key,
                            'key' => 'description'
                        ],
                        ['value' => $request->description[$index]]
                    );
                }
            }
            Toastr::success('Product updated successfully.');
            return back();
        }
    }

    public function remove_image(Request $request)
    {
        ImageManager::delete('/product/' . $request['image']);
        $product = Product::find($request['id']);
        $array = [];
        if (count(json_decode($product['images'])) < 2) {
            Toastr::warning('You cannot delete all images!');
            return back();
        }
        $colors = json_decode($product['colors']);
        $color_image = json_decode($product['color_image']);
        $color_image_arr = [];
        if ($colors && $color_image) {
            foreach ($color_image as $img) {
                if ($img->color != $request->color && $img->image_name != $request->name) {
                    $color_image_arr[] = [
                        'color' => $img->color != null ? $img->color : null,
                        'image_name' => $img->image_name,
                    ];
                }
            }
        }

        foreach (json_decode($product['images']) as $image) {
            if ($image != $request['name']) {
                array_push($array, $image);
            }
        }
        Product::where('id', $request['id'])->update([
            'images' => json_encode($array),
            'color_image' => json_encode($color_image_arr),
        ]);
        Toastr::success('Product image removed successfully!');
        return back();
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $variant = json_decode($product->variation, true);
        $categories = json_decode($product->category_ids, true);

        $categoryName = $categories[count($categories) - 1]['id'] ?? null;
        $categoryName = Category::find($categoryName)?->name ?? $categoryName;
        if (count($variant) > 0) {
            foreach ($variant as $item) {
                $order_pending_qty = OrderDetail::where('product_id', $product->id)->where('delivery_status', 'pending')->where('variant', $item['type'])->sum('qty');
                // dd($order_pending_qty);
                $unit =  $unit = preg_replace('/[^a-zA-Z]/', '', $item['type']);
               
                if ($order_pending_qty > 0) {
                    $response = Tallymethod::updateOpeningStock($product->tally_name . '-' . $item['type'] . '-' . $product->id, $categoryName, $order_pending_qty, $unit, $item['price'],auth('admin')->id());
                    if (!Tallymethod::isSuccess($response)) {
                        Toastr::error(translate('You can not delete this product because there are pending orders for this product variant: ') . $item['type'],auth('admin')->id());
                        return back();
                    }
                } else {
                    $response = Tallymethod::deleteItem($product->tally_name . '-' . $item['type'] . '-' . $product->id,auth('admin')->id());
                    if (!Tallymethod::isSuccess($response)) {
                        Toastr::error(translate('Tally item deletion failed for item: ') . $product->tally_name . '-' . $item['type']);
                        return back();
                    }
                }
            }
        }


        $translation = Translation::where('translationable_type', 'App\Model\Product')
            ->where('translationable_id', $id);
        $translation->delete();
        if(Product::where(['pid' => $id])->get()){
            Cart::where('product_id', $product->id)->delete();
        Wishlist::where('product_id', $product->id)->delete();
            foreach (json_decode($product['images'], true) as $image) {
                ImageManager::delete('/product/' . $image);
            }
            ImageManager::delete('/product/thumbnail/' . $product['thumbnail']);
        }
        $product->delete();

        FlashDealProduct::where(['product_id' => $id])->delete();
        DealOfTheDay::where(['product_id' => $id])->delete();

        Toastr::success('Product removed successfully!');
        return back();
    }

    public function bulk_import_index()
    {
        return view('admin-views.product.bulk-import');
    }

    public function bulk_import_data(Request $request)
    {
        try {
            $collections = (new FastExcel)->import($request->file('products_file'));
        } catch (\Exception $exception) {
            Toastr::error('You have uploaded a wrong format file, please upload the right file.');
            return back();
        }


        $data = [];
        $col_key = ['name', 'category_id', 'sub_category_id', 'sub_sub_category_id', 'brand_id', 'unit', 'min_qty', 'refundable', 'youtube_video_url', 'unit_price', 'purchase_price', 'tax', 'discount', 'discount_type', 'current_stock', 'details', 'thumbnail'];
        $skip = ['youtube_video_url', 'details', 'thumbnail'];

        foreach ($collections as $collection) {
            foreach ($collection as $key => $value) {
                if ($key != "" && !in_array($key, $col_key)) {
                    Toastr::error('Please upload the correct format file.');
                    return back();
                }

                if ($key != "" && $value === "" && !in_array($key, $skip)) {
                    Toastr::error('Please fill ' . $key . ' fields');
                    return back();
                }
            }

            $thumbnail = explode('/', $collection['thumbnail']);

            array_push($data, [
                'name' => $collection['name'],
                'slug' => Str::slug($collection['name'], '-') . '-' . Str::random(6),
                'category_ids' => json_encode([['id' => (string)$collection['category_id'], 'position' => 1], ['id' => (string)$collection['sub_category_id'], 'position' => 2], ['id' => (string)$collection['sub_sub_category_id'], 'position' => 3]]),
                'brand_id' => $collection['brand_id'],
                'unit' => $collection['unit'],
                'min_qty' => $collection['min_qty'],
                'refundable' => $collection['refundable'],
                'unit_price' => $collection['unit_price'],
                'purchase_price' => $collection['purchase_price'],
                'tax' => $collection['tax'],
                'discount' => $collection['discount'],
                'discount_type' => $collection['discount_type'],
                'current_stock' => $collection['current_stock'],
                'details' => $collection['details'],
                'video_provider' => 'youtube',
                'video_url' => $collection['youtube_video_url'],
                'images' => json_encode(['def.png']),
                'thumbnail' => $thumbnail[1] ?? $thumbnail[0],
                'status' => 1,
                'request_status' => 1,
                'colors' => json_encode([]),
                'attributes' => json_encode([]),
                'choice_options' => json_encode([]),
                'variation' => json_encode([]),
                'featured_status' => 1,
                'added_by' => 'admin',
                'user_id' => auth('admin')->id(),
            ]);
        }
        DB::table('products')->insert($data);
        Toastr::success(count($data) . ' - Products imported successfully!');
        return back();
    }

    public function bulk_export_data()
    {
        $products = Product::where(['added_by' => 'admin'])->get();
        //export from product
        $storage = [];
        foreach ($products as $item) {
            $category_id = 0;
            $sub_category_id = 0;
            $sub_sub_category_id = 0;
            foreach (json_decode($item->category_ids, true) as $category) {
                if ($category['position'] == 1) {
                    $category_id = $category['id'];
                } else if ($category['position'] == 2) {
                    $sub_category_id = $category['id'];
                } else if ($category['position'] == 3) {
                    $sub_sub_category_id = $category['id'];
                }
            }
            $storage[] = [
                'name' => $item->name,
                'category_id' => $category_id,
                'sub_category_id' => $sub_category_id,
                'sub_sub_category_id' => $sub_sub_category_id,
                'brand_id' => $item->brand_id,
                'unit' => $item->unit,
                'min_qty' => $item->min_qty,
                'refundable' => $item->refundable,
                'youtube_video_url' => $item->video_url,
                'unit_price' => $item->unit_price,
                'purchase_price' => $item->purchase_price,
                'tax' => $item->tax,
                'discount' => $item->discount,
                'discount_type' => $item->discount_type,
                'current_stock' => $item->current_stock,
                'details' => $item->details,
                'thumbnail' => 'thumbnail/' . $item->thumbnail,
            ];
        }
        return (new FastExcel($storage))->download('inhouse_products.xlsx');
    }

    public function barcode(Request $request, $id)
    {
        if ($request->limit > 270) {
            Toastr::warning(translate('You can not generate more than 270 barcode'));
            return back();
        }
        $product = Product::findOrFail($id);
        $limit =  $request->limit ?? 4;
        return view('admin-views.product.barcode', compact('product', 'limit'));
    }

    public function sysc_tally()
    {
        $adminId = auth('admin')->id();
        if (!\App\CPU\Tallymethod::isSyncEnabled($adminId)) {
             return response()->json(['success' => false, 'message' => translate('Tally synchronization is disabled.')]);
        }

        // dd('sysc tally'); 
        $products = Product::where(['added_by' => 'admin'])->get();
        
        foreach ($products as $product) {
            $category_ids = json_decode($product->category_ids, true);
            $category = Category::where('id', $category_ids[count($category_ids) - 1]['id'])->first();
            $variation = json_decode($product->variation, true);
            foreach($variation as $key => $value){
                $order_pending_qty = OrderDetail::where('product_id', $product->id)->where('delivery_status', 'pending')->where('variant', $value['type'])->sum('qty');
                $unit =  preg_replace('/[^a-zA-Z]/', '', $value['type']);
                // dump($unit);
                if (\App\CPU\Tallymethod::isSyncEnabled($adminId)) {
                    $response = Tallymethod::createGroup($category->name,auth('admin')->id());
                    if (!Tallymethod::isSuccess($response)) {
                        Toastr::error(translate('Tally group creation failed for item: ') . $product->tally_name);
                        return back();
                    }
                    
                    $response = Tallymethod::createUnit($unit,auth('admin')->id());
                    if (!Tallymethod::isSuccess($response)) {
                        Toastr::error(translate('Tally unit creation failed for item: ') . $product->tally_name);
                        return back();
                    }
                    $response = Tallymethod::updateOpeningStock($product->tally_name.'-'.$value['type'].'-'.$product->id, $category->name,$value['qty']+$order_pending_qty, $unit, $value['price'],auth('admin')->id());
                    if (!Tallymethod::isSuccess($response)) {
                        Toastr::error(translate('Tally item creation failed for item: ') . $product->tally_name);
                        return back();
                    }
                }
            }
        }
        Toastr::success(translate('Tally item creation successful'));
        return response()->json(['success' => true]);
    }

    public function sysc_web()
    {
        $adminId = auth('admin')->id();
        if (!\App\CPU\Tallymethod::isSyncEnabled($adminId)) {
            Toastr::warning(translate('Tally synchronization is disabled.'));
            return back();
        }

        Tempproduct::truncate();
        $response = Tallymethod::exportStockSummary($adminId);
        
       if (preg_match('/<ENVELOPE>.*?<\/ENVELOPE>/s', $response, $matches)) {
            $cleanXml = $matches[0];
            libxml_use_internal_errors(true);
            $xmlObject = simplexml_load_string($cleanXml);

            if ($xmlObject) {
                $count = count($xmlObject->DSPACCNAME);

                for ($i = 0; $i < $count; $i++) {

                    $nameNode = $xmlObject->DSPACCNAME[$i];
                    $nameFromTally = (string) $nameNode->DSPDISPNAME;
                    $stockNode = $xmlObject->DSPSTKINFO[$i]->DSPSTKCL ?? null;

                    if (! $stockNode) {
                        continue;
                    }

                    $closingBalance = (string) $stockNode->DSPCLQTY;
                    $rate = (string) $stockNode->DSPCLRATE;
                    
                    // Extract Product ID from name (Example: Redmi TV-49)
                    if (preg_match('/-(\d+)$/', $nameFromTally, $matchesId)) {
                        $reversed = strrev($nameFromTally);
                        // 3 parts me tod do (kyunki last 2 '-' chahiye)
                        $matchesArray = explode('-', $reversed, 3);
                        $matchesArray = array_map('strrev', $matchesArray);
                        
                        $productId = $matchesArray[0];
                        $variant = $matchesArray[1] ?? null;
                        $tally_name = $matchesArray[2] ?? null;

                        $qtyFromTally = (double) preg_replace('/[^0-9.\-]/', '', $closingBalance);
                        $rateFromTally = (double) preg_replace('/[^0-9.\-]/', '', $rate);
                        $unit = preg_replace('/[^a-zA-Z]/', '', $closingBalance);
                        
                        $product = Product::find($productId);
                        if ($product) {
                            $variation = json_decode($product->variation, true);
                            $foundVariant = null;
                            if ($variation) {
                                foreach ($variation as $v) {
                                    if ($v['type'] == $variant) {
                                        $foundVariant = $v;
                                        break;
                                    }
                                }
                            }
                            
                            if ($foundVariant) {
                                // Web Qty includes stock + pending orders
                                $order_pending_qty = OrderDetail::where('product_id', $productId)
                                    ->where('delivery_status', 'pending')
                                    ->where('variant', $variant)
                                    ->sum('qty');
                                
                                $webQtyTotal = (double)$foundVariant['qty'] + (double)$order_pending_qty;
                                $webPrice = (double)$foundVariant['price'];
                                
                                // Convert web price to current currency for comparison with Tally rate
                                $currentWebPrice = (double)BackEndHelper::usd_to_currency($webPrice);
                                
                                // If mismatch, add to staging table
                                if ($webQtyTotal != $qtyFromTally || $currentWebPrice != $rateFromTally) {
                                    Tempproduct::create([
                                        'product_id' => $productId,
                                        'tally_name' => $tally_name,
                                        'variant' => $variant,
                                        'qty' => $qtyFromTally,
                                        'rate' => $rateFromTally,
                                        'unit' => $unit,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        }
        
        return response()->json(['success' => true, 'message' => 'Synced to Web successfully!']);
    }
}
