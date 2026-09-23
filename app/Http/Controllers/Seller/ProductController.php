<?php

namespace App\Http\Controllers\Seller;

use App\CPU\BackEndHelper;
use App\CPU\Convert;
use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Attribute;
use App\Model\Brand;
use App\Model\BusinessSetting;
use App\Model\Category;
use App\Model\Color;
use App\Model\DealOfTheDay;
use App\Model\FlashDealProduct;
use App\Model\Product;
use App\Model\Review;
use App\Model\Tag;
use App\Model\Translation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Model\Cart;
use App\Model\Seller;
use App\CPU\Tallymethod;
use App\Model\OrderDetail;
use App\Model\Order;
use App\Model\ProductEditRequest;
use App\Model\ProductChangeRequest;
use App\Model\Tempproduct;
use App\Model\Wishlist;
use Nwidart\Modules\Json;
use stdClass;

use function App\CPU\translate;

class ProductController extends Controller
{
    public function add_new()
    {
        $cat = Category::where(['parent_id' => 0])->get();
        $br = Brand::orderBY('name', 'ASC')->get();
        $brand_setting = BusinessSetting::where('type', 'product_brand')->first()->value;
        $digital_product_setting = BusinessSetting::where('type', 'digital_product')->first()->value;
        return view('seller-views.product.add-new', compact('cat', 'br', 'brand_setting', 'digital_product_setting'));
    }

    public function status_update(Request $request)
    {
        if ($request['status'] == 0) {
            Product::where(['id' => $request['id'], 'added_by' => 'seller', 'user_id' => \auth('seller')->id()])->update([
                'status' => $request['status'],
            ]);
            return response()->json([
                'success' => 1,
            ], 200);
        } elseif ($request['status'] == 1) {
            if (Product::find($request['id'])->request_status == 1) {
                Product::where(['id' => $request['id']])->update([
                    'status' => $request['status'],
                ]);
                return response()->json([
                    'success' => 1,
                ], 200);
            } else {
                return response()->json([
                    'success' => 0,
                ], 200);
            }
        }
    }
    public function admintoseller(Request $request)
    {
        $sellerproduct = Product::where(['added_by' => 'seller', 'user_id' => \auth('seller')->id()])->where('pid', '!=', null)->pluck('pid')->toArray();
        if ($request['id']) {
            $product = Product::findOrFail($request['id']);
            if (in_array($product->id, $sellerproduct)) {
                return response()->json([
                    'success' => 0,
                    'message' => 'You have already Added this product.',
                ], 200);
            }

            do {
                $code = random_int(100000, 999999);
            } while (Product::where('code', $code)->exists());
            $duplicate   = $product->replicate();
            $duplicate->user_id = \auth('seller')->id();
            $duplicate->added_by = 'seller';
            $duplicate->pid = $product->id;
            $duplicate->unit_price = Convert::usd($request->price);
            $duplicate->slug = $duplicate->slug . '-' . Str::random(6);
            $duplicate->tax            = 0;
            $duplicate->discount       = 0;
            $duplicate->status         = 0;
            $duplicate->shipping_cost  = 0;
            $duplicate->multiply_qty   = 0;
            $duplicate->minimum_order_qty = 1;
            $duplicate->featured       = 0;
            $duplicate->featured_status = 0;
            $duplicate->code = $code;

            // Update variations with qty from modal
            $variants = $request->variants ?? [];
            $stock_count = 0;
            if (!empty($variants) && is_array($variants)) {
                $variations = json_decode($duplicate->variation, true) ?? [];
                foreach ($variants as $variantData) {
                    $variantType = $variantData['type'] ?? '';
                    $variantQty = abs(intval($variantData['qty'] ?? 0));
                    foreach ($variations as &$item) {
                        if ($item['type'] == $variantType) {
                            $item['qty'] = $variantQty;
                        }
                        $stock_count += $item['qty'];
                    }
                    unset($item);
                }
                $duplicate->variation = json_encode($variations);
                $duplicate->current_stock = $stock_count;
            } else {
                $duplicate->current_stock  = 0;
            }

            unset($duplicate->reviews_count);

            $duplicate->save();

            // Copy translations (name, description, technical_name) from original product
            $translations = \App\Model\Translation::where('translationable_type', 'App\Model\Product')
                ->where('translationable_id', $product->id)
                ->whereIn('key', ['name', 'description', 'technical_name'])
                ->get();

            foreach ($translations as $t) {
                \App\Model\Translation::insert([
                    'translationable_type' => 'App\Model\Product',
                    'translationable_id' => $duplicate->id,
                    'locale' => $t->locale,
                    'key' => $t->key,
                    'value' => $t->value,
                ]);
            }

            return response()->json([
                'success' => 1,
                'message' => 'Product Added successfully',
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'message' => 'Something went wrong',
            ], 200);
        }
    }

    public function featured_status(Request $request)
    {
        return response()->json([
            'success' => false,
            'message' => 'Only Admin can update featured status'
        ], 403);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name'                  => 'required',
            'category_id'           => 'required',
            'product_type'          => 'required',
            'digital_product_type'  => 'required_if:product_type,==,digital',
            'digital_file_ready'    => 'required_if:digital_product_type,==,ready_product|mimes: jpg,jpeg,png,webp,gif,webp,zip,pdf',
            'unit'                  => 'required_if:product_type,==,physical',
            'image'                 => 'required',
            'tax'                   => 'required|min:0',
            'tax_model'             => 'required',
            'unit_price'            => 'required|numeric|gt:0',
            'purchase_price'        => 'required|numeric|gt:0',
            'discount'              => 'nullable|numeric|min:0',
            'shipping_cost'         => 'required_if:product_type,==,physical|gt:-1',
            'code'                  => 'required|numeric|min:1|digits_between:6,20|unique:products',
            'minimum_order_qty'     => 'required|numeric|min:1',
        ], [
            'name.required'                     => 'Product name is required!',
            'category_id.required'              => 'category  is required!',
            'image.required'                    => 'Product thumbnail is required!',
            'unit.required_if'                  => 'Unit is required!',
            'code.min'                          => 'The code must be positive!',
            'code.digits_between'               => 'The code must be minimum 6 digits!',
            'minimum_order_qty.required'        => 'The minimum order quantity is required!',
            'minimum_order_qty.min'             => 'The minimum order quantity must be positive!',
            'digital_file_ready.required_if'    => 'Ready product upload is required!',
            'digital_file_ready.mimes'          => 'Ready product upload must be a file of type: pdf, zip, jpg, jpeg, png, gif.',
            'digital_product_type.required_if'  => 'Digital product type is required!',
            'shipping_cost.required_if'         => 'Shipping Cost is required!',
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

        if ($request->filled('discount')) {
            if ($request['discount_type'] == 'percent') {
                $dis = ($request['unit_price'] / 100) * $request['discount'];
            } else {
                $dis = $request['discount'];
            }

            if ($request['unit_price'] <= $dis) {
                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'unit_price',
                        'Discount can not be more or equal to the price!'
                    );
                });
            }
        }

        if (is_null($request->name[array_search('en', (array) $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'name',
                    'Name field is required!'
                );
            });
        }

        $product = new Product();
        $product->user_id = auth('seller')->id();
        $product->added_by = "seller";
        $product->name = $request->name[array_search('en', (array) $request->lang)];
        $product->technical_name = $request->technical_name[array_search('en', (array) $request->lang)];
        $product->tally_name = $request->prn[0];
        $product->slug = Str::slug($request->name[array_search('en', (array) $request->lang)], '-') . '-' . Str::random(6);

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

        $category_last = $category[count($category) - 1]['id'];
        $category_obj = Category::find($category_last);
        $categoryName = $category_obj ? $category_obj->name : $request->sub_sub_category_id;
        if (\App\CPU\Tallymethod::isSyncEnabled(auth('seller')->id())) {
            $response = Tallymethod::createGroup($categoryName,auth('seller')->id());
            if (!Tallymethod::isSuccess($response)) {
                Toastr::error(translate('Tally group creation failed for sub sub category: ') . $categoryName);
                return back();
            }
        }

        $product->category_ids          = json_encode($category);
        $product->brand_id              = $request->brand_id;
        $product->unit                  = $request->product_type == 'physical' ? $request->unit : null;
        $product->digital_product_type  = $request->product_type == 'digital' ? $request->digital_product_type : null;
        $product->product_type          = $request->product_type;
        $product->code                  = $request->code;
        $product->minimum_order_qty     = $request->minimum_order_qty;
        $product->details               = $request->description[array_search('en', (array) $request->lang)];

        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $product->colors = $request->product_type == 'physical' ? json_encode($request->colors) : json_encode([]);
        } else {
            $colors = [];
            $product->colors = $request->product_type == 'physical' ? json_encode($colors) : json_encode([]);
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
                    if (\App\CPU\Tallymethod::isSyncEnabled(auth('seller')->id())) {
                        $response = Tallymethod::createUnit($oldunit,auth('seller')->id());
                        if (!Tallymethod::isSuccess($response)) {
                            Toastr::error(translate('Tally unit creation failed for unit: ') . $oldunit);
                        }
                    }
                }
                $item['type'] = $str;
                $item['price'] = Convert::usd(abs($request['price_' . str_replace('.', '_', $str)]));
                $item['sku'] = $request['sku_' . str_replace('.', '_', $str)];
                $item['qty'] = abs($request['qty_' . str_replace('.', '_', $str)]);
                if (\App\CPU\Tallymethod::isSyncEnabled(auth('seller')->id())) {
                    $response = Tallymethod::createOrAlterItem($product->tally_name . '-' . $str . '-' . $product->id, $categoryName, $item['qty'], $unit, $item['price'],auth('seller')->id());
                    if (!Tallymethod::isSuccess($response)) {
                        Toastr::error(translate('Tally item creation failed for item: ') . $product->tally_name . '-' . $str);
                    }
                }

                array_push($variations, $item);
                $stock_count += $item['qty'];
            }
        } else {
            $stock_count = (int)$request['current_stock'];
            // if (\App\CPU\Tallymethod::isSyncEnabled(auth('seller')->id())) {
            //     $response = Tallymethod::createOrAlterItem($product->tally_name . '-' . $product->id, $categoryName, $stock_count, $product->unit, $product->unit_price,auth('seller')->id());
            //     if (!Tallymethod::isSuccess($response)) {
            //         Toastr::error(translate('Tally item creation failed for item: ') . $product->tally_name);
            //     }
            // }
        }

        if ($validator->errors()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        //combinations end
        $product->variation      = $request->product_type == 'physical' ? json_encode($variations) : json_encode([]);
        $product->unit_price     = Convert::usd($request->unit_price);
        $product->purchase_price = Convert::usd($request->purchase_price);
        $product->tax            = $request->tax;
        $product->tax_type       = $request->tax_type;
        $product->tax_model      = $request->tax_model;
        $product->discount       = $request->discount_type == 'flat' ? Convert::usd($request->discount) : $request->discount;
        $product->discount_type  = $request->discount_type;
        $product->discount_amount = $request->discount_type == 'flat' ? $request->unit_price - $request->discount : $request->unit_price * ($request->discount / 100);
        $product->actual_amount =   $request->unit_price - $product->discount_amount;
        $product->attributes     = $request->product_type == 'physical' ? json_encode($request->choice_attributes) : json_encode([]);
        $product->current_stock  = $request->product_type == 'physical' ? abs($stock_count) : 0;
        $product->video_provider = 'youtube';
        $product->video_url      = $request->video_link;
        $product->request_status = Helpers::get_business_settings('new_product_approval') == 1 ? 0 : 1;
        $product->status         = 0;
        $product->shipping_cost  = $request->product_type == 'physical' ? Convert::usd($request->shipping_cost) : 0;
        $product->multiply_qty   = ($request->product_type == 'physical') ? ($request->multiplyQTY == 'on' ? 1 : 0) : 0;
        // Phase 8: Approval Workflow - seller products start as pending
        $product->approval_status = Helpers::get_business_settings('new_product_approval') == 1 ? 'pending' : 'approved';
        $product->admin_commission = $request->admin_commission ?? 0;
        $product->admin_commission_type = $request->admin_commission_type ?? 'percentage';
        $product->priority = $request->priority ?? 0;

        if ($request->ajax()) {
            return response()->json([], 200);
        } else {
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
            $product->color_image = json_encode($color_image_serial);
            $product->images = json_encode($product_images);
            $product->thumbnail = ImageManager::upload('product/thumbnail/', 'png', $request->file('image'));

            if ($request->product_type == 'digital' && $request->digital_product_type == 'ready_product') {
                $product->digital_file_ready = ImageManager::upload('product/digital-product/', $request->digital_file_ready->getClientOriginalExtension(), $request->digital_file_ready);
            }

            $product->meta_title = $request->meta_title;
            $product->meta_description = $request->meta_description;
            $product->meta_image = ImageManager::upload('product/meta/', 'png', $request->meta_image);
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

            $data = [];
            foreach ($request->lang as $index => $key) {
                if ($request->name[$index] && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Model\Product',
                        'translationable_id' => $product->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ));
                }
                if ($request->description[$index] && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Model\Product',
                        'translationable_id' => $product->id,
                        'locale' => $key,
                        'key' => 'description',
                        'value' => $request->description[$index],
                    ));
                }
                if (isset($request->technical_name[$index]) && $request->technical_name[$index] && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Model\Product',
                        'translationable_id' => $product->id,
                        'locale' => $key,
                        'key' => 'technical_name',
                        'value' => $request->technical_name[$index],
                    ));
                }
                if (isset($request->prn[$index]) && $request->prn[$index] && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Model\Product',
                        'translationable_id' => $product->id,
                        'locale' => $key,
                        'key' => 'tally_name',
                        'value' => $request->prn[$index],
                    ));
                }
            }
            Translation::insert($data);
            Toastr::success('Product added successfully!');
            return redirect()->route('seller.product.list');
        }
    }

    function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $products = Product::where(['added_by' => 'seller', 'user_id' => \auth('seller')->id()])
                ->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->Where('name', 'like', "%{$value}%");
                    }
                });
            $query_param = ['search' => $request['search']];
        } else {
            $products = Product::where(['added_by' => 'seller', 'user_id' => \auth('seller')->id()]);
        }
        $products = $products->orderBy('id', 'DESC')->paginate(Helpers::pagination_limit())->appends($query_param);

        return view('seller-views.product.list', compact('products', 'search'));
    }
    function adminlist(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        $sellerId = \auth('seller')->id();
        $sellerproduct = Product::where(['added_by' => 'seller', 'user_id' => $sellerId])->where('pid', '!=', null)->pluck('pid')->toArray();
        $myProductIds = Product::where(['added_by' => 'seller', 'user_id' => $sellerId])->pluck('id')->toArray();

        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $query_param = ['search' => $request['search']];

            $adminProducts = Product::where(['added_by' => 'admin'])
                ->whereNotIn('id', $sellerproduct)
                ->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->Where('name', 'like', "%{$value}%");
                    }
                })->get();

            $sellerProducts = Product::where('added_by', 'seller')
                ->where('user_id', '!=', $sellerId)
                ->whereNotIn('id', $myProductIds)
                ->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->Where('name', 'like', "%{$value}%");
                    }
                })
                ->whereNotIn('pid', $sellerproduct)
                ->groupBy('pid')
                ->selectRaw('*, MIN(id) as id')
                ->get();
        } else {
            $adminProducts = Product::where(['added_by' => 'admin'])
                ->whereNotIn('id', $sellerproduct)->get();

            $sellerProducts = Product::where('added_by', 'seller')
                ->where('user_id', '!=', $sellerId)
                ->whereNotIn('id', $myProductIds)
                ->whereNotIn('pid', $adminProducts->pluck('id')->toArray())
                ->groupBy('pid')
                ->selectRaw('*, MIN(id) as id')
                ->get();
        }

        $allProducts = $adminProducts->concat($sellerProducts)->sortByDesc('id')->values();
        $products = $allProducts->paginate(Helpers::pagination_limit())->appends($query_param);

        return view('seller-views.product.adminproduct', compact('products', 'search'));
    }

    public function stock_limit_list(Request $request, $type)
    {
        $stock_limit = Helpers::get_business_settings('stock_limit');
        $sort_oqrderQty = $request->get('sort_oqrderQty');

        // build query params for pagination links; keep everything except the page number itself
        $query_param = $request->except('page');

        $search = $request->get('search');
        $pro = Product::where(['added_by' => 'seller', 'product_type' => 'physical', 'user_id' => auth('seller')->id()])
            ->withCount('order_details');

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
        return view('seller-views.product.stock-limit-list', compact(
            'pro',
            'search',
            'request_status',
            'sort_oqrderQty',
            'stock_limit',
            'paginate_limit',

        ));
    }

    public function get_variations(Request $request)
    {
        $product = Product::find($request['id']);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $variations = json_decode($product->variation, true) ?? [];

        return response()->json([
            'variations' => $variations,
            'product_name' => $product->name,
        ]);
    }

    public function update_quantity(Request $request)
    {
        $product = Product::find($request->data['id']);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found']);
        }

        // Only allow seller to update their own products
        if ($product->added_by === 'seller' && $product->user_id !== auth('seller')->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized']);
        }

        $variations = json_decode($product->variation, true) ?? [];

        $stock_count = 0;
        foreach ($variations as $key => &$item) {
            if ($item['type'] == $request->data['variation']) {
                $item['price'] = BackEndHelper::currency_to_usd(abs($request->data['price']));
                $item['qty'] = abs($request->data['qty']);
            }
            $stock_count += $item['qty'];
        }
        unset($item);

        if ($stock_count >= 0) {
            $product->variation = json_encode($variations);
            $product->current_stock = $stock_count;
            $product->purchase_price = BackEndHelper::currency_to_usd(abs($request->data['purchase_price']));
            $product->save();
            return response()->json(['success' => true, 'message' => 'Quantity updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Quantity cannot be less than 0']);
        }
    }

    public function update_price_variants(Request $request)
    {
        $product = Product::find($request->id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found']);
        }

        if ($product->added_by === 'seller' && $product->user_id !== auth('seller')->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized']);
        }

        // Update price fields
        if ($request->has('unit')) {
            $product->unit = $request->unit;
        }
        if ($request->has('unit_price')) {
            $product->unit_price = BackEndHelper::currency_to_usd(abs($request->unit_price));
        }
        if ($request->has('purchase_price')) {
            $product->purchase_price = BackEndHelper::currency_to_usd(abs($request->purchase_price));
        }
        if ($request->has('discount')) {
            $product->discount = $request->discount_type == 'flat'
                ? BackEndHelper::currency_to_usd(abs($request->discount))
                : abs($request->discount);
            $product->discount_type = $request->discount_type ?? 'flat';
        }
        if ($request->has('tax')) {
            $product->tax = $request->tax_model == 'flat'
                ? BackEndHelper::currency_to_usd(abs($request->tax))
                : abs($request->tax);
            $product->tax_model = $request->tax_model ?? 'include';
        }
        if ($request->has('shipping_cost')) {
            $product->shipping_cost = BackEndHelper::currency_to_usd(abs($request->shipping_cost));
        }
        if ($request->has('minimum_order_qty')) {
            $product->minimum_order_qty = abs($request->minimum_order_qty);
        }
        if ($request->has('current_stock')) {
            $product->current_stock = abs($request->current_stock);
        }

        // Update variations
        if ($request->has('variants') && is_array($request->variants)) {
            $variations = json_decode($product->variation, true) ?? [];
            $existingTypes = array_column($variations, 'type');
            $stock_count = 0;

            foreach ($request->variants as $variantData) {
                $variantType = $variantData['type'] ?? '';
                $variantPrice = BackEndHelper::currency_to_usd(abs($variantData['price'] ?? 0));
                $variantQty = abs(intval($variantData['qty'] ?? 0));
                $variantSku = $variantData['sku'] ?? '';

                $found = false;
                foreach ($variations as &$item) {
                    if ($item['type'] == $variantType) {
                        $item['price'] = $variantPrice;
                        $item['qty'] = $variantQty;
                        if ($variantSku !== '') {
                            $item['sku'] = $variantSku;
                        }
                        $found = true;
                    }
                }
                unset($item);

                // New variant - not found in existing, add it
                if (!$found && $variantType !== '' && $variantType !== 'default') {
                    $variations[] = [
                        'type' => $variantType,
                        'price' => $variantPrice,
                        'qty' => $variantQty,
                        'sku' => $variantSku,
                    ];
                }
            }

            // Remove deleted variants
            $deletedVariants = $request->deleted_variants ?? [];
            if (!empty($deletedVariants) && is_array($deletedVariants)) {
                $variations = array_filter($variations, function ($item) use ($deletedVariants) {
                    return !in_array($item['type'], $deletedVariants);
                });
                $variations = array_values($variations);
            }

            foreach ($variations as $item) {
                $stock_count += $item['qty'];
            }

            $product->variation = json_encode($variations);
            $product->current_stock = $stock_count;

            $choice_options = json_decode($product->choice_options, true) ?? [];
            if (!empty($choice_options)) {
                $num_choices = count($choice_options);
                if ($num_choices === 1) {
                    $choice_options[0]['options'] = array_column($variations, 'type');
                } else {
                    $new_options = array_fill(0, $num_choices, []);
                    foreach ($variations as $var) {
                        $type = $var['type'] ?? '';
                        if ($type === '' || $type === 'default') continue;
                        $parts = explode('-', $type);
                        if (count($parts) >= $num_choices) {
                            for ($i = 0; $i < $num_choices; $i++) {
                                if (!in_array($parts[$i], $new_options[$i])) {
                                    $new_options[$i][] = $parts[$i];
                                }
                            }
                        }
                    }
                    for ($i = 0; $i < $num_choices; $i++) {
                        $choice_options[$i]['options'] = $new_options[$i];
                    }
                }
                $product->choice_options = json_encode($choice_options);
            }
        }

        $product->save();

        return response()->json(['success' => true, 'message' => 'Product updated successfully']);
    }

    /**
     * Product total stock report export by excel
     * @param Request $request
     * @return string|\Symfony\Component\HttpFoundation\StreamedResponse
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function stock_limit_export(Request $request)
    {

        $sort = $request['sort'] ?? 'ASC';

        $products = Product::when(empty($request['seller_id']) || $request['seller_id'] == 'all', function ($query) {
            $query->whereIn('added_by', ['admin', 'seller']);
        })
            ->when($request['seller_id'] == 'in_house', function ($query) {
                $query->where(['added_by' => 'admin']);
            })
            ->when($request['seller_id'] != 'in_house' && isset($request['seller_id']) && $request['seller_id'] != 'all', function ($query) use ($request) {
                $query->where(['added_by' => 'seller', 'user_id' => $request['seller_id']]);
            })
            ->orderBy('current_stock', $sort)->get();

        $data = array();
        foreach ($products as $product) {
            $data[] = array(
                'Product Name'   => $product->name,
                'Date'           => date('d M Y', strtotime($product->created_at)),
                'Total Stock'    => $product->current_stock,
            );
        }

        return (new FastExcel($data))->download('total_product_stock.xlsx');
    }


    public function get_categories(Request $request)
    {
        $cat = Category::where(['parent_id' => $request->parent_id])->get();
        $res = '<option value="' . 0 . '" disabled selected>---Select---</option>';
        foreach ($cat as $row) {
            if ($row->id == $request->sub_category) {
                $res .= '<option value="' . $row->id . '" selected >' . $row->name . '</option>';
            } else {
                $res .= '<option value="' . $row->id . '">' . $row->name . '</option>';
            }
        }
        return response()->json([
            'select_tag' => $res,
            'count' => $cat->count(),
        ]);
    }

    public function search_categories(Request $request)
    {
        $query = $request->input('q', '');
        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->where('parent_id', '!=', 0)
            ->limit(10)
            ->pluck('name')
            ->toArray();
        return response()->json($categories);
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
        $product_name = $request->name[array_search('en', (array) $request->lang)];

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

    public function edit($id)
    {
        $product = Product::withoutGlobalScopes()->find($id);

        $product_category = json_decode($product->category_ids, true) ?? [];
        $product->colors = json_decode($product->colors);
        $categories = Category::where(['parent_id' => 0])->get();
        $br = Brand::orderBY('name', 'ASC')->get();
        $brand_setting = BusinessSetting::where('type', 'product_brand')->first()->value;
        $digital_product_setting = BusinessSetting::where('type', 'digital_product')->first()->value;

        return view('seller-views.product.edit', compact('categories', 'br', 'product', 'product_category', 'brand_setting', 'digital_product_setting'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $validator = Validator::make($request->all(), [
            'name'                  => 'required',
            'category_id'           => 'required',
            'product_type'          => 'required',
            'digital_product_type'  => 'required_if:product_type,==,digital',
            'digital_file_ready'    => 'mimes: jpg,jpeg,png,webp,gif,webp,zip,pdf',
            'unit'                  => 'required_if:product_type,==,physical',
            'tax'                   => 'required|min:0',
            'tax_model'             => 'required',
            'unit_price'            => 'required|numeric|gt:0',
            'purchase_price'        => 'required|numeric|gt:0',
            'discount'              => 'nullable|numeric|min:0',
            'shipping_cost'         => 'required_if:product_type,==,physical|gt:-1',
            'code'                  => 'required|numeric|min:1|digits_between:6,20|unique:products,code,' . $product->id,
            'minimum_order_qty'     => 'required|numeric|min:1',
        ], [
            'name.required'                     => 'Product name is required!',
            'category_id.required'              => 'Category is required!',
            'unit.required_if'                  => 'Unit is required!',
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

        if ($request->filled('discount')) {
            if ($request['discount_type'] == 'percent') {
                $dis = ($request['unit_price'] / 100) * $request['discount'];
            } else {
                $dis = $request['discount'];
            }

            if ($request['unit_price'] <= $dis) {
                $validator->after(function ($validator) {
                    $validator->errors()->add('unit_price', 'Discount can not be more or equal to the price!');
                });
            }
        }

        if (is_null($request->name[array_search('en', (array) $request->lang)])) {
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

        $product->name = $request->name[array_search('en', (array) $request->lang)];
        $product->technical_name = $request->technical_name[array_search('en', (array) $request->lang)];
        $product->tally_name = $request->prn[0];

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
        $category_last = $category[count($category) - 1]['id'];
        $category_obj = Category::find($category_last);
        $categoryName = $category_obj ? $category_obj->name : $request->sub_sub_category_id;
        if (\App\CPU\Tallymethod::isSyncEnabled(auth('seller')->id())) {
            $response = Tallymethod::createGroup($categoryName,auth('seller')->id());
            if (!Tallymethod::isSuccess($response)) {
                Toastr::error(translate('Tally group creation failed for sub sub category: ') . $categoryName);
                return back();
            }
        }

        $product->product_type          = $request->product_type;
        $product->category_ids          = json_encode($category);
        $product->brand_id              = isset($request->brand_id) ? $request->brand_id : null;
        $product->unit                  = $request->product_type == 'physical' ? $request->unit : null;
        $product->digital_product_type  = $request->product_type == 'digital' ? $request->digital_product_type : null;
        $product->details               = $request->description[array_search('en', (array) $request->lang)];

        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $product->colors = $request->product_type == 'physical' ? json_encode($request->colors) : json_encode([]);
        } else {
            $colors = [];
            $product->colors = $request->product_type == 'physical' ? json_encode($colors) : json_encode([]);
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
                    if (\App\CPU\Tallymethod::isSyncEnabled(auth('seller')->id())) {
                        $response = Tallymethod::createUnit($oldunit,auth('seller')->id());
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
                $order_pending_qty = OrderDetail::where('product_id', $product->id)->where('delivery_status', 'pending')->where('variant', $item['type'])->sum('qty');
                // tally product update
                if (\App\CPU\Tallymethod::isSyncEnabled(auth('seller')->id())) {
                    $response = Tallymethod::updateOpeningStock($product->tally_name . '-' . $str . '-' . $product->id, $categoryName, $item['qty'] + $order_pending_qty, $unit, $item['price'],auth('seller')->id());
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

        if ($validator->errors()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        //combinations end
        $product->variation         = $request->product_type == 'physical' ? json_encode($variations) : json_encode([]);
        $product->unit_price        = Convert::usd($request->unit_price);
        $product->purchase_price    = Convert::usd($request->purchase_price);
        $product->tax               = $request->tax;
        $product->tax_model         = $request->tax_model;
        $product->code              = $request->code;
        $product->minimum_order_qty = $request->minimum_order_qty;
        $product->tax_type          = $request->tax_type;
        $product->discount          = $request->discount_type == 'flat' ? Convert::usd($request->discount) : $request->discount;
        $product->discount_amount = $request->discount_type == 'flat' ? $request->unit_price - $request->discount : $request->unit_price * ($request->discount / 100);
        $product->actual_amount = $request->unit_price - $product->discount_amount;
        $product->attributes        = $request->product_type == 'physical' ? json_encode($request->choice_attributes) : json_encode([]);
        $product->discount_type     = $request->discount_type;
        $product->current_stock     = $request->product_type == 'physical' ? abs($stock_count) : 0;
        $product->shipping_cost     = $request->product_type == 'physical' ? (Helpers::get_business_settings('product_wise_shipping_cost_approval') == 1 ? $product->shipping_cost : Convert::usd($request->shipping_cost)) : 0;
        $product->multiply_qty      = ($request->product_type == 'physical') ? ($request->multiplyQTY == 'on' ? 1 : 0) : 0;
        // Update category_ids
        $product->category_ids = json_encode($request->category ?? []);
        // Phase 8: Approval Workflow - approved products need re-approval after edit
        if ($product->approval_status === 'approved') {
            $product->approval_status = 'pending_edit';
            $product->edit_status = 'pending_edit';
        }
        $product->admin_commission = $request->admin_commission ?? $product->admin_commission;
        $product->admin_commission_type = $request->admin_commission_type ?? $product->admin_commission_type;
        $product->priority = $request->priority ?? $product->priority;

        if (Helpers::get_business_settings('product_wise_shipping_cost_approval') == 1 && $product->shipping_cost != Convert::usd($request->shipping_cost)) {
            $product->temp_shipping_cost = Convert::usd($request->shipping_cost);
            $product->is_shipping_cost_updated = 0;
        }

        $product->video_provider = 'youtube';
        $product->video_url = $request->video_link;
        if ($product->request_status == 2) {
            $product->request_status = 0;
        }

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
                $product->thumbnail = ImageManager::update('product/thumbnail/', $product->thumbnail, 'png', $request->file('image'), $product->id);
            }

            if ($request->product_type == 'digital') {
                if ($request->digital_product_type == 'ready_product' && $request->hasFile('digital_file_ready')) {
                    $product->digital_file_ready = ImageManager::update('product/digital-product/', $product->digital_file_ready, $request->digital_file_ready->getClientOriginalExtension(), $request->file('digital_file_ready'), $product->id);
                } elseif (($request->digital_product_type == 'ready_after_sell') && $product->digital_file_ready) {
                    if (!ImageManager::isImageUsedElsewhere($product->digital_file_ready, $product->id)) {
                        ImageManager::delete('product/digital-product/' . $product->digital_file_ready);
                    }
                    $product->digital_file_ready = null;
                }
            } elseif ($request->product_type == 'physical' && $product->digital_file_ready) {
                if (!ImageManager::isImageUsedElsewhere($product->digital_file_ready, $product->id)) {
                    ImageManager::delete('product/digital-product/' . $product->digital_file_ready);
                }
                $product->digital_file_ready = null;
            }

            $product->meta_title = $request->meta_title;
            $product->meta_description = $request->meta_description;
            if ($request->file('meta_image')) {
                $product->meta_image = ImageManager::update('product/meta/', $product->meta_image, 'png', $request->file('meta_image'), $product->id);
            }

            // Capture old product data for change request
            $oldData = [
                'name' => $product->name,
                'technical_name' => $product->technical_name,
                'tally_name' => $product->tally_name,
                'description' => $product->details,
                'unit_price' => $product->unit_price,
                'purchase_price' => $product->purchase_price,
                'discount' => $product->discount,
                'discount_type' => $product->discount_type,
                'tax' => $product->tax,
                'tax_model' => $product->tax_model,
                'unit' => $product->unit,
                'minimum_order_qty' => $product->minimum_order_qty,
                'shipping_cost' => $product->shipping_cost,
                'category_ids' => $product->category_ids,
                'brand_id' => $product->brand_id,
                'colors' => $product->colors,
                'attributes' => $product->attributes,
                'choice_attributes' => $product->choice_attributes,
                'variation' => $product->variation,
                'stocks' => $product->stocks,
                'sku' => $product->sku,
                'code' => $product->code,
                'video_provider' => $product->video_provider,
                'video_url' => $product->video_url,
                'meta_title' => $product->meta_title,
                'meta_description' => $product->meta_description,
                'product_type' => $product->product_type,
                'digital_product_type' => $product->digital_product_type,
                'digital_file_ready' => $product->digital_file_ready,
                'images' => $product->images,
                'thumbnail' => $product->thumbnail,
                'meta_image' => $product->meta_image,
                'color_image' => $product->color_image,
                'choice_options' => $product->choice_options,
                'admin_commission' => $product->admin_commission,
                'admin_commission_type' => $product->admin_commission_type,
                'priority' => $product->priority,
            ];

            // Build new data from request
            $newData = [
                'name' => $request->name[0] ?? $product->name,
                'technical_name' => $request->technical_name ?? $product->technical_name,
                'tally_name' => $request->prn[0] ?? $product->tally_name,
                'description' => $request->description[0] ?? $product->details,
                'unit_price' => $request->unit_price,
                'purchase_price' => $request->purchase_price ?? $product->purchase_price,
                'discount' => $request->discount_type == 'flat' ? $request->discount : $request->discount,
                'discount_type' => $request->discount_type,
                'tax' => $request->tax,
                'tax_model' => $request->tax_model,
                'unit' => $request->unit,
                'minimum_order_qty' => $request->minimum_order_qty,
                'shipping_cost' => $request->shipping_cost,
                'category_ids' => json_encode($request->category ?? []),
                'brand_id' => $request->brand_id ?? $product->brand_id,
                'colors' => json_encode($request->colors ?? []),
                'attributes' => json_encode($request->choice_attributes ?? []),
                'choice_attributes' => json_encode($request->choice_attributes ?? []),
                'variation' => $request->variation ?? $product->variation,
                'stocks' => $request->stocks,
                'sku' => $request->sku,
                'code' => $request->code,
                'video_provider' => 'youtube',
                'video_url' => $request->video_link,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'product_type' => $request->product_type,
                'digital_product_type' => $request->digital_product_type ?? null,
                'digital_file_ready' => $product->digital_file_ready,
                'images' => $product->images,
                'thumbnail' => $product->thumbnail,
                'meta_image' => $product->meta_image,
                'color_image' => $product->color_image,
                'choice_options' => $product->choice_options,
                'admin_commission' => $request->admin_commission ?? $product->admin_commission,
                'admin_commission_type' => $request->admin_commission_type ?? $product->admin_commission_type,
                'priority' => $request->priority ?? $product->priority,
            ];

            // Add translations
            $translations = [];
            foreach ($request->lang as $index => $locale) {
                if ($locale != 'en') {
                    $translations[$locale] = [];
                    if (!empty($request->name[$index])) {
                        $translations[$locale]['name'] = $request->name[$index];
                    }
                    if (!empty($request->description[$index])) {
                        $translations[$locale]['description'] = $request->description[$index];
                    }
                    if (!empty($request->technical_name[$index])) {
                        $translations[$locale]['technical_name'] = $request->technical_name[$index];
                    }
                    if (!empty($request->prn[$index])) {
                        $translations[$locale]['tally_name'] = $request->prn[$index];
                    }
                }
            }
            if (!empty($translations)) {
                $newData['translations'] = $translations;
            }

            // Store uploaded images in temp folder
            $tempImages = [];
            if ($request->file('images')) {
                foreach ($request->file('images') as $img) {
                    $imageName = time() . '_' . rand(1000, 9999) . '.' . $img->getClientOriginalExtension();
                    $img->move(storage_path('app/public/temp/product_images'), $imageName);
                    $tempImages['images'][] = $imageName;
                }
            }
            if ($request->file('image')) {
                $thumbName = time() . '_thumb.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(storage_path('app/public/temp/product_images'), $thumbName);
                $tempImages['thumbnail'] = $thumbName;
            }
            if ($request->file('meta_image')) {
                $metaName = time() . '_meta.' . $request->file('meta_image')->getClientOriginalExtension();
                $request->file('meta_image')->move(storage_path('app/public/temp/product_images'), $metaName);
                $tempImages['meta_image'] = $metaName;
            }
            if ($request->file('digital_file_ready')) {
                $digitalName = time() . '_digital.' . $request->file('digital_file_ready')->getClientOriginalExtension();
                $request->file('digital_file_ready')->move(storage_path('app/public/temp/product_images'), $digitalName);
                $tempImages['digital_file_ready'] = $digitalName;
            }
            $newData['temp_images'] = $tempImages;

            // Check if there's already a pending change request for this product
            $existingChangeRequest = ProductChangeRequest::where('product_id', $id)
                ->where('seller_id', auth('seller')->id())
                ->where('status', 'pending')
                ->exists();

            if ($existingChangeRequest) {
                Toastr::error('You already have a pending change request for this product. Please wait for admin approval before submitting a new one.');
                return back();
            }

            // Create change request
            $editRequest = ProductEditRequest::where('product_id', $id)
                ->where('seller_id', auth('seller')->id())
                ->where('status', 'approved')
                ->latest()
                ->first();

            ProductChangeRequest::create([
                'product_id' => $id,
                'seller_id' => auth('seller')->id(),
                'edit_request_id' => $editRequest->id,
                'old_data' => $oldData,
                'new_data' => $newData,
                'status' => 'pending',
                'seller_note' => 'Product edit submitted for admin approval',
            ]);

            // Set product to pending_edit status
            if ($product->approval_status === 'approved') {
                $product->approval_status = 'pending_edit';
                $product->edit_status = 'pending_edit';
                $product->save();
            }

            // Invalidate the edit request so seller can't edit again without new request
            $editRequest->status = 'used';
            $editRequest->save();

            Toastr::success('Change request sent to admin for approval.');
            return back();
        }
    }

    public function request_edit(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'note' => 'required|string|min:5',
        ]);

        $productId = $request->product_id;
        $product = Product::find($productId);

        if (!$product) {
            Toastr::error('Product not found.');
            return back();
        }

        // Check if there's already a pending request
        $existingRequest = ProductEditRequest::where('product_id', $productId)
            ->where('seller_id', auth('seller')->id())
            ->where('status', 'pending')
            ->exists();

        if ($existingRequest) {
            Toastr::info('Edit request already pending for this product.');
            return back();
        }

        // Check if there's already an approved request (seller can edit directly)
        $approvedRequest = ProductEditRequest::where('product_id', $productId)
            ->where('seller_id', auth('seller')->id())
            ->where('status', 'approved')
            ->exists();

        if ($approvedRequest) {
            Toastr::info('You already have edit access for this product.');
            return back();
        }

        ProductEditRequest::create([
            'product_id' => $productId,
            'seller_id' => auth('seller')->id(),
            'status' => 'pending',
            'seller_note' => $request->note ?? 'Requesting edit access for product',
        ]);

        Toastr::success('Edit request sent to admin for approval.');
        return back();
    }

    public function edit_requests()
    {
        $requests = ProductEditRequest::with('product')
            ->where('seller_id', auth('seller')->id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('seller-views.product.edit-requests', compact('requests'));
    }

    public function change_requests()
    {
        $requests = ProductChangeRequest::with('product', 'editRequest')
            ->where('seller_id', auth('seller')->id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('seller-views.product.change-requests', compact('requests'));
    }

    public function view_change_request($id)
    {
        $changeRequest = ProductChangeRequest::with(['product', 'editRequest'])
            ->where('seller_id', auth('seller')->id())
            ->find($id);

        if (!$changeRequest) {
            Toastr::error('Request not found.');
            return back();
        }

        // Gather related IDs for human‑readable display
        $brandIds = collect([
            $changeRequest->old_data['brand_id'] ?? null,
            $changeRequest->new_data['brand_id'] ?? null,
        ])->filter()->unique()->toArray();

        // Category IDs are stored as array of objects with 'id' key
        $categoryIds = collect();
        foreach (['category_ids'] as $key) {
            $oldCats = $changeRequest->old_data[$key] ?? [];
            $newCats = $changeRequest->new_data[$key] ?? [];
            $oldCats = is_string($oldCats) ? json_decode($oldCats, true) : $oldCats;
            $newCats = is_string($newCats) ? json_decode($newCats, true) : $newCats;
            $categoryIds = $categoryIds->merge(collect($oldCats))->merge(collect($newCats));
        }
        $categoryIds = $categoryIds->pluck('id')->filter()->unique()->toArray();

        // Attributes & Choice Attributes (may be stored as JSON strings)
        $oldAttrs = $changeRequest->old_data['attributes'] ?? [];
        $newAttrs = $changeRequest->new_data['attributes'] ?? [];
        $oldAttrs = is_string($oldAttrs) ? json_decode($oldAttrs, true) : $oldAttrs;
        $newAttrs = is_string($newAttrs) ? json_decode($newAttrs, true) : $newAttrs;
        $attributeIds = collect($oldAttrs)->merge($newAttrs)->filter()->unique()->toArray();

        $oldChoice = $changeRequest->old_data['choice_attributes'] ?? [];
        $newChoice = $changeRequest->new_data['choice_attributes'] ?? [];
        $oldChoice = is_string($oldChoice) ? json_decode($oldChoice, true) : $oldChoice;
        $newChoice = is_string($newChoice) ? json_decode($newChoice, true) : $newChoice;
        $choiceAttrIds = collect($oldChoice)->merge($newChoice)->filter()->unique()->toArray();

        // Colors
        $oldColors = $changeRequest->old_data['colors'] ?? [];
        $newColors = $changeRequest->new_data['colors'] ?? [];
        $oldColors = is_string($oldColors) ? json_decode($oldColors, true) : $oldColors;
        $newColors = is_string($newColors) ? json_decode($newColors, true) : $newColors;
        $colorIds = collect($oldColors)->merge($newColors)->pluck('id')->filter()->unique()->toArray();

        // Load mappings to avoid N+1 queries
        $brandMap = $brandIds ? Brand::whereIn('id', $brandIds)->pluck('name', 'id')->toArray() : [];
        $categoryMap = $categoryIds ? Category::whereIn('id', $categoryIds)->pluck('name', 'id')->toArray() : [];
        $attributeMap = $attributeIds ? Attribute::whereIn('id', $attributeIds)->pluck('name', 'id')->toArray() : [];
        $choiceAttrMap = $choiceAttrIds ? Attribute::whereIn('id', $choiceAttrIds)->pluck('name', 'id')->toArray() : [];
        $colorMap = $colorIds ? \App\Model\Color::whereIn('id', $colorIds)->pluck('code', 'id')->toArray() : [];

        return view('admin-views.product.view-change-request', compact(
            'changeRequest',
            'brandMap',
            'categoryMap',
            'attributeMap',
            'choiceAttrMap',
            'colorMap'
        ));
    }

    public function view($id)
    {
        $product = Product::with(['reviews', 'translations', 'rating', 'tags'])->where(['id' => $id])->first();
        $reviews = Review::where(['product_id' => $id])->paginate(Helpers::pagination_limit());
        return view('seller-views.product.view', compact('product', 'reviews'));
    }

    public function remove_image(Request $request)
    {
        if (!ImageManager::isImageUsedElsewhere($request['image'], $request['id'])) {
            ImageManager::delete('/product/' . $request['image']);
        }
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

        $category_id_last = $categories[count($categories) - 1]['id'] ?? null;
        $category_obj = Category::find($category_id_last);
        $categoryName = $category_obj ? $category_obj->name : $category_id_last;
        
        if ($variant && count($variant) > 0) {
            foreach ($variant as $item) {
                $order_pending_qty = OrderDetail::where('product_id', $product->id)
                    ->where('variant', $item['type'])
                    ->whereHas('order', function ($q) {
                        $q->whereIn('delivery_status', ['pending', 'confirmed', 'processing', 'out_for_delivery']);
                    })->sum('qty');
                    
                $unit = preg_replace('/[^a-zA-Z]/', '', $item['type']);
                if ($order_pending_qty > 0) {
                    $response = Tallymethod::updateOpeningStock($product->tally_name . '-' . $item['type'] . '-' . $product->id, $categoryName, $order_pending_qty, $unit, $item['price']);
                    if (!Tallymethod::isSuccess($response)) {
                        Toastr::error(translate('You can not delete this product because there are pending orders for this product variant: ') . $item['type']);
                        return back();
                    }
                } else {
                    $response = Tallymethod::deleteItem($product->tally_name . '-' . $item['type'] . '-' . $product->id, auth('seller')->id());
                    if (!Tallymethod::isSuccess($response)) {
                        Toastr::error(translate('Tally item deletion failed for item: ') . $product->tally_name . '-' . $item['type']);
                        return back();
                    }
                }
            }
        } else {
            $order_pending_qty = OrderDetail::where('product_id', $product->id)
                ->whereHas('order', function ($q) {
                    $q->whereIn('delivery_status', ['pending', 'confirmed', 'processing', 'out_for_delivery']);
                })->sum('qty');

            if ($order_pending_qty > 0) {
                $response = Tallymethod::updateOpeningStock($product->tally_name . '-' . $product->id, $categoryName, $order_pending_qty, $product->unit, $product->unit_price);
                if (!Tallymethod::isSuccess($response)) {
                    Toastr::error(translate('You can not delete this product because there are pending orders for this product.'));
                    return back();
                }
            } else {
                $response = Tallymethod::deleteItem($product->tally_name . '-' . $product->id, auth('seller')->id());
                if (!Tallymethod::isSuccess($response)) {
                    Toastr::error(translate('Tally item deletion failed for item: ') . $product->tally_name);
                    return back();
                }
            }
        }

        Cart::where('product_id', $product->id)->delete();
        Wishlist::where('product_id', $product->id)->delete();
        foreach (json_decode($product['images'], true) as $image) {
            if (!ImageManager::isImageUsedElsewhere($image, $product->id)) {
                ImageManager::delete('/product/' . $image);
            }
        }
        if (!ImageManager::isImageUsedElsewhere($product->thumbnail, $product->id)) {
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
        return view('seller-views.product.bulk-import');
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
                'status' => 0,
                'colors' => json_encode([]),
                'attributes' => json_encode([]),
                'choice_options' => json_encode([]),
                'variation' => json_encode([]),
                'featured_status' => 1,
                'added_by' => 'seller',
                'user_id' => auth('seller')->id(),
            ]);
        }
        DB::table('products')->insert($data);
        Toastr::success(count($data) . ' - Products imported successfully!');
        return back();
    }

    public function bulk_export_data()
    {
        $products = Product::where(['added_by' => 'seller', 'user_id' => \auth('seller')->id()])->get();
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
                'thumbnail' => 'thumbnail/' . $item->thumbnail

            ];
        }
        return (new FastExcel($storage))->download('products.xlsx');
    }

    public function barcode(Request $request, $id)
    {
        if ($request->limit > 270) {
            Toastr::warning(translate('You can not generate more than 270 barcode'));
            return back();
        }
        $product = Product::findOrFail($id);
        $limit =  $request->limit ?? 4;
        return view('seller-views.product.barcode', compact('product', 'limit'));
    }

    public function bidding_list(Request $request)
    {
        // SELF SELLER BIDDING LISTQ

        $Product = Product::where('added_by', 'seller')->where('user_id', auth('seller')->id())->get();
        $query_param = [];
        $search = $request['search'];
        $search1 = $request['search1'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $biddings = DB::table('biddings')->where(['user_id' => \auth('seller')->id()])
                ->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->Where('product_name', 'like', "%{$value}%");
                    }
                });
            $query_param = ['search' => $request['search']];
        } else {
            $biddings = DB::table('biddings')->where(['user_id' => \auth('seller')->id()]);
        }
        $biddings = $biddings->orderBy('id', 'DESC')->paginate(Helpers::pagination_limit())->appends($query_param);



        // OTHER SELLER BIDDING LIST


        if ($request->has('search1')) {
            $key = explode(' ', $request['search1']);
            $allbiddings = DB::table('biddings')->where('user_id', '!=', auth('seller')->id())->where('status', 'pending')
                ->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->Where('product_name', 'like', "%{$value}%");
                    }
                });
            $query_param = ['search1' => $request['search1']];
        } else {
            $allbiddings = DB::table('biddings')->where('user_id', '!=', auth('seller')->id())->where('status', 'pending');
        }
        $allbiddings = $allbiddings->orderBy('id', 'DESC')->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('seller-views.product.biding', compact('biddings', 'Product', 'allbiddings', 'search', 'search1'));
    }
    public function bidding_place(Request $request)

    {
        // dd($request->all());
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required|numeric|min:1',

        ]);



        DB::table('biddings')->updateOrInsert(
            [

                'id' => $request->id,
            ],
            [
                'user_id' => auth('seller')->id(),
                'product_name' => $request->product_id,
                'product_qty' => $request->qty,
                'description' => $request->description,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        if ($request->id == null) {
            Toastr::success('Bidding placed successfully!');
        } else {
            Toastr::success('Bidding updated successfully!');
        }

        return back();
    }

    /**
     * Upload vendor invoice (PDF) for a bidding via AJAX
     */
    public function uploadInvoice(Request $request)
    {
        $request->validate([
            'invoice' => 'required|mimes:pdf|max:10240', // max 10MB
            'bidding_id' => 'required|integer',
        ]);

        if (!$request->file('invoice')->isValid()) {
            return response()->json(['status' => 'error', 'message' => 'Invalid file upload'], 422);
        }

        $file = $request->file('invoice');
        $path = $file->store('invoices', 'public');

        // Try to update biddings table if column exists
        try {
            if (Schema::hasTable('biddings') && Schema::hasColumn('biddings', 'vendor_invoice')) {
                DB::table('biddings')->where('id', $request->bidding_id)->update([
                    'vendor_invoice' => $path,
                    'updated_at' => now(),
                ]);
            } else {
                // still update updated_at to mark activity if possible
                if (Schema::hasTable('biddings')) {
                    DB::table('biddings')->where('id', $request->bidding_id)->update([
                        'updated_at' => now(),
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Don't fail the upload if DB update isn't possible
        }

        return response()->json(['status' => 'success', 'path' => Storage::url($path), 'raw_path' => $path]);
    }

    public function vendor_bidding_place(Request $request)
    {;
        $array = [];
        $bidding = DB::table('biddings')->where('id', $request->input('product_id'))->where('status', 'pending')->first();

        // sava as arry object in table
        if ($bidding) {
            if ($bidding->bedders != null) {
                $array = json_decode($bidding->bedders, true);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Bidding Closed!']);
        }


        $item = new stdClass();
        $item->vendor_id = auth('seller')->id();
        $item->price = $request->input('amount');
        $yes = false;
        foreach ($array as $key => $value) {
            if ($value['price'] == $request->input('amount')) {
                return response()->json(['status' => 'error', 'message' => 'This Price Bidding Already Apply successfully!']);
            }
            if ($value['vendor_id'] == auth('seller')->id()) {
                $array[$key]['price'] =  $request->input('amount');
                $yes = true;
            }
        }
        if (!$yes) {
            $array[] = $item;
        }
        // dd($array);
        DB::table('biddings')->where('id', $request->input('product_id'))->update([
            'bedders' => json_encode($array),
            'updated_at' => now(),
        ]);

        // return json response with success status and message
        return response()->json(['status' => 'success', 'message' => 'Bidding place successfully!']);
    }
    public function get_bidding_details(Request $request)
    {

        $alldata = DB::table('biddings')->where('id', $request->input('product_id'))->first();

        if ($alldata->bedders != null) {
            $data = json_decode($alldata->bedders); // array of stdClass

            foreach ($data as $key => $value) {

                $seller = Seller::select('f_name', 'l_name', 'phone')
                    ->find($value->vendor_id);

                if ($seller) {
                    $value->name = $seller->f_name . ' ' . $seller->l_name;
                    $data[$key]->phone = $seller->phone;
                }
            }
        }
        if ($request->input('data') == 0) {
            return response()->json([
                'status' => 'success',
                'data' => $data,
                'bidstatus' => $alldata->status,
                'document' => $alldata->vendor_invoice,
                'document_url' => asset(config('app.public_storage_path') . '/' . $alldata->vendor_invoice),

            ]);
        } else {
            return response()->json([
                'status' => 'success',
                'alldata' => $alldata,
            ]);
        }
    }
    public function bidding_close(Request $request)
    {
        $data = DB::table('biddings')->where('id', $request->input('product_id'))->where('status', 'pending')->select('bedders')->first();
        $data = json_decode($data->bedders); // array of stdClass

        foreach ($data as $key => $value) {

            if ($request->input('userid') == $value->vendor_id) {
                $data[$key]->done = 1;
            }
        }
        DB::table('biddings')->where('id', $request->input('product_id'))->update([
            'bedders' => json_encode($data),
            'status' => 'close',
            'updated_at' => now(),
        ]);

        return response()->json(['status' => 'success', 'message' => 'Bidding assigned successfully!']);
    }
    public function bidding_delete(Request $request)
    {
        DB::table('biddings')->delete($request->input('recordid'));
        return response()->json(['status' => 'success', 'message' => 'Bidding Deleted successfully!']);
    }
    public function bidding_win(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $biddings = DB::table('biddings')->where('status', 'close')
                ->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->Where('product_name', 'like', "%{$value}%");
                    }
                });
            $query_param = ['search' => $request['search']];
        } else {
            $biddings = DB::table('biddings')->where('status', 'close');
        }
        $biddings = $biddings->orderBy('id', 'DESC')->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('seller-views.product.winbid', compact('biddings', 'search'));
    }

    public function sysc_tally()
    {
        $sellerId = auth('seller')->id();
        if (!\App\CPU\Tallymethod::isSyncEnabled($sellerId)) {
             return response()->json(['success' => false, 'message' => translate('Tally synchronization is disabled.')]);
        }
          
        $products = Product::where(['added_by' => 'seller', 'user_id' => $sellerId])->get();
        foreach ($products as $product) {
            $category_ids = json_decode($product->category_ids, true);
            if (!empty($category_ids)) {
                $category_last = $category_ids[count($category_ids) - 1]['id'];
                $category = Category::where('id', $category_last)->first();
                $categoryName = $category ? $category->name : '';
            } else {
                $categoryName = '';
            }

            $variation = json_decode($product->variation, true);
            if ($variation) {
                foreach ($variation as $key => $value) {
                    $order_pending_qty = OrderDetail::where('product_id', $product->id)
                        ->where('variant', $value['type'])
                        ->whereHas('order', function ($q) {
                            $q->whereIn('delivery_status', ['pending', 'confirmed', 'processing', 'out_for_delivery']);
                        })->sum('qty');

                    $unit = preg_replace('/[^a-zA-Z]/', '', $value['type']);
                    if (\App\CPU\Tallymethod::isSyncEnabled(auth('seller')->id())) {    
                        $response = Tallymethod::createGroup($categoryName,auth('seller')->id());
                    
                    if (!Tallymethod::isSuccess($response)) {
                        Toastr::error(translate('Tally sync failed for item: ') . $product->tally_name . '-' . $value['type']);
                    }
                    $response = Tallymethod::createUnit($unit,auth('seller')->id());
                    if (!Tallymethod::isSuccess($response)) {
                        Toastr::error(translate('Tally sync failed for item: ') . $product->tally_name . '-' . $value['type']);
                    }
                    
                    $response = Tallymethod::updateOpeningStock($product->tally_name . '-' . $value['type'] . '-' . $product->id, $categoryName, $value['qty'] + $order_pending_qty, $unit, $value['price'],auth('seller')->id());
                    
                    if (!Tallymethod::isSuccess($response)) {
                        Toastr::error(translate('Tally sync failed for item: ') . $product->tally_name . '-' . $value['type']);
                    }
                }
                }
            } else {
                $order_pending_qty = OrderDetail::where('product_id', $product->id)
                    ->whereHas('order', function ($q) {
                        $q->whereIn('delivery_status', ['pending', 'confirmed', 'processing', 'out_for_delivery']);
                    })->sum('qty');
                    $unit = preg_replace('/[^a-zA-Z]/', '', $product->unit);
                    if (\App\CPU\Tallymethod::isSyncEnabled(auth('seller')->id())) {
                        $response = Tallymethod::createGroup($categoryName,auth('seller')->id());
                    
                        if (!Tallymethod::isSuccess($response)) {
                            Toastr::error(translate('Tally sync failed for item: ') . $product->tally_name . '-' . $product->unit);
                        }
                        $response = Tallymethod::createUnit($unit,auth('seller')->id());
                        if (!Tallymethod::isSuccess($response)) {
                            Toastr::error(translate('Tally sync failed for item: ') . $product->tally_name . '-' . $product->unit);
                        }
                        $response = Tallymethod::updateOpeningStock($product->tally_name . '-' . $product->id, $categoryName, $product->current_stock + $order_pending_qty, $product->unit, $product->unit_price,auth('seller')->id());
                        
                        if (!Tallymethod::isSuccess($response)) {
                            Toastr::error(translate('Tally sync failed for item: ') . $product->tally_name);
                        }
                    }
            }
        }
        Toastr::success(translate('Tally sync successful'));
               return response()->json(['success' => true]);

    }

    public function sysc_web()
    {
        $sellerId = auth('seller')->id();
        if (!\App\CPU\Tallymethod::isSyncEnabled($sellerId)) {
             return response()->json(['success' => false, 'message' => 'Tally synchronization is disabled.']);
        }

        Tempproduct::truncate();
        $response = Tallymethod::exportStockSummary($sellerId);
        
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
                    
                    if (preg_match('/-(\d+)$/', $nameFromTally, $matchesId)) {
                        $reversed = strrev($nameFromTally);
                        $matchesArray = explode('-', $reversed, 3);
                        $matchesArray = array_map('strrev', $matchesArray);
                        
                        $productId = $matchesArray[0];
                        $variant = $matchesArray[1] ?? null;
                        $tally_name = $matchesArray[2] ?? null;

                        $qtyFromTally = (double) preg_replace('/[^0-9.\-]/', '', $closingBalance);
                        $rateFromTally = (double) preg_replace('/[^0-9.\-]/', '', $rate);
                        $unit = preg_replace('/[^a-zA-Z]/', '', $closingBalance);
                        
                        $product = Product::find($productId);
                        if ($product && $product->added_by == 'seller' && $product->user_id == auth('seller')->id()) {
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
                                $order_pending_qty = OrderDetail::where('product_id', $productId)
                                    ->where('delivery_status', 'pending')
                                    ->where('variant', $variant)
                                    ->sum('qty');
                                
                                $webQtyTotal = (double)$foundVariant['qty'] + (double)$order_pending_qty;
                                $webPrice = (double)$foundVariant['price'];
                                $currentWebPrice = (double)BackEndHelper::usd_to_currency($webPrice);
                                
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
