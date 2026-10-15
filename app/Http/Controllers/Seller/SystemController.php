<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Model\SellerNotification;
use App\Model\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SystemController extends Controller
{
    public function order_data()
    {
        $sellerId = auth('seller')->id();

        $new_order = DB::table('orders')->where(['seller_is' => 'seller'])
                                        ->where(['seller_id' => $sellerId])
                                        ->where(['checked' => 0])->count();
        return response()->json([
            'success' => 1,
            'data' => ['new_order' => $new_order]
        ]);
    }

    public function notifications()
    {
        $notifications = SellerNotification::where('seller_id', auth('seller')->id())
            ->latest()
            ->paginate(\App\CPU\Helpers::pagination_limit());

        return view('seller-views.notification.index', compact('notifications'));
    }

    public function read_approval_notification(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        SellerNotification::where('seller_id', auth('seller')->id())
            ->where('id', $request->id)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

}
