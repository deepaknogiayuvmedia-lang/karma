<?php

namespace App\Http\Controllers\Seller;

use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Seller;
use App\Model\Shop;
use App\Model\AdminNotification;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use function App\CPU\translate;

class ProfileController extends Controller
{
    public function view()
    {
        $data = Seller::where('id', auth('seller')->id())->first();
        return view('seller-views.profile.view', compact('data'));
    }

    public function edit($id)
    {
        if (auth('seller')->id() != $id) {
            Toastr::warning(translate('you_can_not_change_others_profile'));
            return back();
        }
        $data = Seller::where('id', auth('seller')->id())->first();
        $shop_banner = Shop::select('banner')->where('seller_id', auth('seller')->id())->first()->banner;
        
        return view('seller-views.profile.edit', compact('data', 'shop_banner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'phone' => 'required'
        ], [
            'f_name.required' => 'First name is required!',
            'l_name.required' => 'Last name is required!',
            'phone.required' => 'Phone number is required!',
        ]);

        $seller = Seller::find(auth('seller')->id());
        $seller->f_name = $request->f_name;
        $seller->l_name = $request->l_name;
        $seller->phone = $request->phone;
        if ($request->image) {
            $seller->image = ImageManager::update('seller/', $seller->image, 'png', $request->file('image'));
        }
        $profileChanged = $seller->isDirty(['f_name', 'l_name', 'phone', 'image']);
        $seller->save();

        if ($profileChanged) {
            $this->notifyAdminOfSellerProfileUpdate(
                $seller,
                'Vendor Profile Updated',
                'The vendor updated their account profile information.'
            );
        }

        Toastr::info('Profile updated successfully!');
        return back();
    }

    public function settings_password_update(Request $request)
    {
        $request->validate([
            'password' => 'required|same:confirm_password|min:8',
            'confirm_password' => 'required',
        ]);

        $seller = Seller::find(auth('seller')->id());
        $seller->password = bcrypt($request['password']);
        $seller->save();
        Toastr::success('Seller password updated successfully!');
        return back();
    }

    public function bank_update(Request $request, $id)
    {
        $bank = Seller::find(auth('seller')->id());
        $bank->bank_name = $request->bank_name;
        $bank->branch = $request->branch;
        $bank->holder_name = $request->holder_name;
        $bank->account_no = $request->account_no;
        $bankDetailsChanged = $bank->isDirty(['bank_name', 'branch', 'holder_name', 'account_no']);
        $bank->save();

        if ($bankDetailsChanged) {
            $this->notifyAdminOfSellerProfileUpdate(
                $bank,
                'Vendor Bank Details Updated',
                'The vendor updated their bank details.'
            );
        }

        Toastr::success('Bank Info updated');
        return redirect()->route('seller.profile.view');
    }

    private function notifyAdminOfSellerProfileUpdate(Seller $seller, string $title, string $message): void
    {
        AdminNotification::create([
            'seller_id' => $seller->id,
            'title' => $title,
            'message' => trim(($seller->f_name ?? '') . ' ' . ($seller->l_name ?? '')) . ': ' . $message,
            'link' => route('admin.sellers.view', $seller->id),
            'is_read' => 0,
        ]);
    }

    public function bank_edit($id)
    {
        if (auth('seller')->id() != $id) {
            Toastr::warning(translate('you_can_not_change_others_info'));
            return back();
        }
        $data = Seller::where('id', auth('seller')->id())->first();
        return view('seller-views.profile.bankEdit', compact('data'));
    }

}
