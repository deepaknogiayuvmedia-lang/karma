<?php

namespace App\Http\Controllers\DeliveryMan;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\DeliverymanWallet;
use App\Model\Order;
use App\Model\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $deliveryMan = auth('delivery_man')->user();

        $pendingOrders = Order::where('delivery_man_id', $deliveryMan->id)
            ->whereIn('order_status', ['pending', 'confirmed', 'processing'])
            ->count();

        $outForDelivery = Order::where('delivery_man_id', $deliveryMan->id)
            ->where('order_status', 'out_for_delivery')
            ->count();

        $deliveredToday = Order::where('delivery_man_id', $deliveryMan->id)
            ->where('order_status', 'delivered')
            ->whereDate('updated_at', today())
            ->count();

        $totalDelivered = Order::where('delivery_man_id', $deliveryMan->id)
            ->where('order_status', 'delivered')
            ->count();

        $wallet = DeliverymanWallet::where('delivery_man_id', $deliveryMan->id)->first();
        $currentBalance = $wallet->current_balance ?? 0;
        $cashInHand = $wallet->cash_in_hand ?? 0;

        $recentOrders = Order::where('delivery_man_id', $deliveryMan->id)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('delivery-man-views.dashboard', compact(
            'pendingOrders', 'outForDelivery', 'deliveredToday', 'totalDelivered',
            'currentBalance', 'cashInHand', 'recentOrders', 'deliveryMan'
        ));
    }
}
