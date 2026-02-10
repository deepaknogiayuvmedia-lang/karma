<?php

namespace App\Http\Controllers\Seller;

use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Shop;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function view()
    {
        $shop = Shop::where(['seller_id' => auth('seller')->id()])->first();
        if (isset($shop) == false) {
            DB::table('shops')->insert([
                'seller_id' => auth('seller')->id(),
                'name' => auth('seller')->user()->f_name,
                'address' => '',
                'contact' => auth('seller')->user()->phone,
                'image' => 'def.png',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $shop = Shop::where(['seller_id' => auth('seller')->id()])->first();
        }

        return view('seller-views.shop.shopInfo', compact('shop'));
    }

    public function edit($id)
    {
        $shop = Shop::where(['seller_id' =>  auth('seller')->id()])->first();
        return view('seller-views.shop.edit', compact('shop'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'banner'      => 'mimes:png,jpg,jpeg|max:2048',
            'image'       => 'mimes:png,jpg,jpeg|max:2048',
        ], [
            'banner.mimes'   => 'Banner image type jpg, jpeg or png',
            'banner.max'     => 'Banner Maximum size 2MB',
            'image.mimes'    => 'Image type jpg, jpeg or png',
            'image.max'      => 'Image Maximum size 2MB',
        ]);

        $shop = Shop::find($id);
        $shop->name = $request->name;
        $shop->address = $request->address;
        $shop->contact = $request->contact;
        if ($request->image) {
            $shop->image = ImageManager::update('shop/', $shop->image, 'png', $request->file('image'));
        }
        if ($request->banner) {
            $shop->banner = ImageManager::update('shop/banner/', $shop->banner, 'png', $request->file('banner'));
        }
        $shop->save();

        Toastr::info('Shop updated successfully!');
        return redirect()->route('seller.shop.view');
    }

    public function vacation_add(Request $request, $id)
    {
        $shop = Shop::find($id);
        $shop->vacation_status = $request->vacation_status == 'on' ? 1 : 0;
        $shop->vacation_start_date = $request->vacation_start_date;
        $shop->vacation_end_date = $request->vacation_end_date;
        $shop->vacation_note = $request->vacation_note;
        $shop->save();

        Toastr::success('Vacation mode updated successfully!');
        return redirect()->back();
    }

    public function temporary_close(Request $request)
    {
        $shop = Shop::find($request->id);

        $shop->temporary_close = $request->status == 'checked' ? 1 : 0;
        $shop->save();

        return response()->json(['status' => true], 200);
    }


    public function save_address(Request $request, $id)
    {
        $business = [];
        $warehouse = [];


        // ================= BUSINESS ADDRESS JSON =================
        $businessAddress = [
            'address_line1' => $request->business_address_line1,
            'city'          => $request->business_city,
            'state'         => $request->business_state,
            'pincode'       => $request->business_pincode,
            'country'       => $request->business_country,
        ];

        // ================= WAREHOUSE ADDRESS JSON =================
        $warehouseAddress = [
            'address_line1' => $request->warehouse_address_line1,
            'city'          => $request->warehouse_city,
            'state'         => $request->warehouse_state,
            'pincode'       => $request->warehouse_pincode,
            'country'       => $request->warehouse_country,
        ];

        $shop = Shop::find($id);

        $shop->whatsapp_no = $request->whatsapp_number;
        $shop->gst_no = $request->gst_number;
        //save certificate
        if ($request->hasFile('gst_certificate')) {

            // delete old file
            if (!empty($shop->gst_doc) && Storage::disk('public')->exists('document/' . $shop->gst_doc)) {
                Storage::disk('public')->delete('document/' . $shop->gst_doc);
            }

            // new file name
            $file = $request->file('gst_certificate');
            $fileName = time() . '_gst.' . $file->getClientOriginalExtension();

            // store file
            $file->storeAs('document', $fileName, 'public');

            // save in DB
            $shop->gst_doc = $fileName;
        }
        $shop->pen_no = $request->pan_number;
        if ($request->hasFile('pan_card')) {

            // delete old file
            if (!empty($shop->pen_doc) && Storage::disk('public')->exists('document/' . $shop->pen_doc)) {
                Storage::disk('public')->delete('document/' . $shop->pen_doc);
            }

            // new file name
            $file = $request->file('pan_card');
            $fileName = time() . '_pan.' . $file->getClientOriginalExtension();

            // store file
            $file->storeAs('document', $fileName, 'public');

            // save in DB
            $shop->pen_doc = $fileName;
        }
        $shop->business_address = json_encode($businessAddress);
        $shop->wherehouse        = json_encode($warehouseAddress);

        $shop->save();

        Toastr::success('Shop address updated successfully!');
        return redirect()->back();
    }
}
