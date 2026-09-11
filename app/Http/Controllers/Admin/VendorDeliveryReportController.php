<?php

namespace App\Http\Controllers\Admin;

use App\CPU\translate;
use App\Model\Seller;
use App\Model\DeliveryMan;
use App\Model\Order;
use App\Model\OrderTransaction;
use App\Model\SellerWallet;
use App\Model\DeliverymanWallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class VendorDeliveryReportController extends Controller
{
    /**
     * Display vendor performance report page
     */
    public function vendor_report(Request $request)
    {
        $from_date = $request->get('from_date', Carbon::now()->subMonth());
        $to_date = $request->get('to_date', Carbon::now());
        $status = $request->get('status', null);
        $sort_by = $request->get('sort_by', 'earning');

        $sellers = Seller::query()
            ->with(['wallet', 'orders', 'shop'])
            ->when($status, function ($q) use ($status) {
                return $q->where('status', $status);
            });

        // Calculate performance metrics
        $sellers = $sellers->get()->map(function ($seller) use ($from_date, $to_date) {
            $orders = Order::where('seller_id', $seller->id)
                ->whereBetween('created_at', [$from_date, $to_date])
                ->get();

            $total_earning = OrderTransaction::where('seller_id', $seller->id)
                ->where('seller_is', 'seller')
                ->whereBetween('created_at', [$from_date, $to_date])
                ->sum('seller_amount');

            $order_count = $orders->count();
            $delivered_orders = $orders->where('order_status', 'delivered')->count();
            $cancelled_orders = $orders->where('order_status', 'cancelled')->count();
            $avg_order_value = $order_count > 0 ? $orders->sum('order_amount') / $order_count : 0;
            $rating = $seller->reviews_count ?? 0;

            return (object)[
                'id' => $seller->id,
                'shop_name' => $seller->shop?->shop_name ?? $seller->name,
                'seller_name' => $seller->name,
                'email' => $seller->email,
                'phone' => $seller->phone,
                'status' => $seller->status,
                'shop_image' => $seller->shop?->image ?? null,
                'seller_image' => $seller->image ?? null,
                'total_earning' => $total_earning,
                'pending_balance' => $seller->wallet?->pending_withdraw ?? 0,
                'withdrawn' => $seller->wallet?->withdrawn ?? 0,
                'total_commission' => OrderTransaction::where('seller_id', $seller->id)
                    ->whereBetween('created_at', [$from_date, $to_date])
                    ->sum('admin_commission'),
                'order_count' => $order_count,
                'delivered_orders' => $delivered_orders,
                'cancelled_orders' => $cancelled_orders,
                'avg_order_value' => $avg_order_value,
                'rating' => $rating,
                'cancellation_rate' => $order_count > 0 ? ($cancelled_orders / $order_count) * 100 : 0,
                'delivery_rate' => $order_count > 0 ? ($delivered_orders / $order_count) * 100 : 0,
                'approval_date' => $seller->created_at,
            ];
        });

        // Sort by requested column
        if ($sort_by === 'earning') {
            $sellers = $sellers->sortByDesc('total_earning');
        } elseif ($sort_by === 'orders') {
            $sellers = $sellers->sortByDesc('order_count');
        } elseif ($sort_by === 'rating') {
            $sellers = $sellers->sortByDesc('rating');
        }

        return view('admin-views.custom-reports.vendor-report', [
            'sellers' => $sellers->values(),
            'from_date' => $from_date,
            'to_date' => $to_date,
            'status' => $status,
            'sort_by' => $sort_by,
        ]);
    }

    /**
     * Display delivery staff performance report page
     */
    public function delivery_report(Request $request)
    {
        $from_date = $request->get('from_date', Carbon::now()->subMonth());
        $to_date = $request->get('to_date', Carbon::now());
        $status = $request->get('status', null);
        $sort_by = $request->get('sort_by', 'deliveries');

        $delivery_men = DeliveryMan::query()
            ->with(['wallet', 'orders', 'review'])
            ->when($status, function ($q) use ($status) {
                return $q->where('is_active', $status === 'active' ? 1 : 0);
            });

        $delivery_men = $delivery_men->get()->map(function ($delivery_man) use ($from_date, $to_date) {
            $orders = Order::where('delivery_man_id', $delivery_man->id)
                ->whereBetween('created_at', [$from_date, $to_date])
                ->get();

            $delivered_orders = $orders->where('order_status', 'delivered')->count();
            $pending_orders = $orders->whereIn('order_status', ['processing', 'shipped'])->count();
            $cancelled_orders = $orders->where('order_status', 'cancelled')->count();
            $total_orders = $orders->count();

            $total_earning = DB::table('deliveryman_transactions')
                ->where('delivery_man_id', $delivery_man->id)
                ->whereBetween('created_at', [$from_date, $to_date])
                ->sum('amount');

            $avg_rating = DB::table('reviews')
                ->where('delivery_man_id', $delivery_man->id)
                ->avg('rating') ?? 0;

            $review_count = DB::table('reviews')
                ->where('delivery_man_id', $delivery_man->id)
                ->count();

            return (object)[
                'id' => $delivery_man->id,
                'name' => $delivery_man->name,
                'email' => $delivery_man->email,
                'phone' => $delivery_man->phone,
                'is_active' => $delivery_man->is_active,
                'avatar' => $delivery_man->image ?? null,
                'total_earning' => $total_earning,
                'pending_balance' => $delivery_man->wallet?->pending_withdraw ?? 0,
                'withdrawn' => $delivery_man->wallet?->withdrawn ?? 0,
                'total_deliveries' => $delivered_orders,
                'pending_deliveries' => $pending_orders,
                'cancelled_orders' => $cancelled_orders,
                'total_orders' => $total_orders,
                'delivery_success_rate' => $total_orders > 0 ? ($delivered_orders / $total_orders) * 100 : 0,
                'avg_rating' => round($avg_rating, 2),
                'review_count' => $review_count,
                'created_at' => $delivery_man->created_at,
            ];
        });

        // Sort by requested column
        if ($sort_by === 'deliveries') {
            $delivery_men = $delivery_men->sortByDesc('total_deliveries');
        } elseif ($sort_by === 'earning') {
            $delivery_men = $delivery_men->sortByDesc('total_earning');
        } elseif ($sort_by === 'rating') {
            $delivery_men = $delivery_men->sortByDesc('avg_rating');
        }

        return view('admin-views.custom-reports.delivery-report', [
            'delivery_men' => $delivery_men->values(),
            'from_date' => $from_date,
            'to_date' => $to_date,
            'status' => $status,
            'sort_by' => $sort_by,
        ]);
    }

    /**
     * Export vendor report as PDF
     */
    public function export_vendor_pdf(Request $request)
    {
        $from_date = $request->get('from_date', Carbon::now()->subMonth());
        $to_date = $request->get('to_date', Carbon::now());
        $status = $request->get('status', null);

        $sellers = Seller::query()
            ->with(['wallet', 'orders', 'shop'])
            ->when($status, function ($q) use ($status) {
                return $q->where('status', $status);
            })
            ->get()
            ->map(function ($seller) use ($from_date, $to_date) {
                $orders = Order::where('seller_id', $seller->id)
                    ->whereBetween('created_at', [$from_date, $to_date])
                    ->get();

                $total_earning = OrderTransaction::where('seller_id', $seller->id)
                    ->where('seller_is', 'seller')
                    ->whereBetween('created_at', [$from_date, $to_date])
                    ->sum('seller_amount');

                $order_count = $orders->count();
                $delivered_orders = $orders->where('order_status', 'delivered')->count();
                $cancelled_orders = $orders->where('order_status', 'cancelled')->count();

                return (object)[
                    'shop_name' => $seller->shop?->shop_name ?? $seller->name,
                    'seller_name' => $seller->name,
                    'email' => $seller->email,
                    'phone' => $seller->phone,
                    'status' => $seller->status,
                    'total_earning' => $total_earning,
                    'pending_balance' => $seller->wallet?->pending_withdraw ?? 0,
                    'order_count' => $order_count,
                    'delivered_orders' => $delivered_orders,
                    'cancelled_orders' => $cancelled_orders,
                    'avg_order_value' => $order_count > 0 ? $orders->sum('order_amount') / $order_count : 0,
                ];
            });

        $pdf = Pdf::loadView('admin-views.custom-reports.vendor-pdf', [
            'sellers' => $sellers,
            'from_date' => Carbon::parse($from_date)->format('Y-m-d'),
            'to_date' => Carbon::parse($to_date)->format('Y-m-d'),
            'generated_at' => now()->format('Y-m-d H:i:s'),
        ]);

        return $pdf->download('vendor-report-' . now()->format('Y-m-d-His') . '.pdf');
    }

    /**
     * Export vendor report as Excel
     */
    public function export_vendor_excel(Request $request)
    {
        $from_date = $request->get('from_date', Carbon::now()->subMonth());
        $to_date = $request->get('to_date', Carbon::now());
        $status = $request->get('status', null);

        $sellers = Seller::query()
            ->with(['wallet', 'orders', 'shop'])
            ->when($status, function ($q) use ($status) {
                return $q->where('status', $status);
            })
            ->get()
            ->map(function ($seller) use ($from_date, $to_date) {
                $orders = Order::where('seller_id', $seller->id)
                    ->whereBetween('created_at', [$from_date, $to_date])
                    ->get();

                $total_earning = OrderTransaction::where('seller_id', $seller->id)
                    ->where('seller_is', 'seller')
                    ->whereBetween('created_at', [$from_date, $to_date])
                    ->sum('seller_amount');

                $order_count = $orders->count();
                $delivered_orders = $orders->where('order_status', 'delivered')->count();
                $cancelled_orders = $orders->where('order_status', 'cancelled')->count();

                return [
                    'Shop Name' => $seller->shop?->shop_name ?? $seller->name,
                    'Seller Name' => $seller->name,
                    'Email' => $seller->email,
                    'Phone' => $seller->phone,
                    'Status' => ucfirst($seller->status),
                    'Total Earning' => number_format($total_earning, 2),
                    'Pending Balance' => number_format($seller->wallet?->pending_withdraw ?? 0, 2),
                    'Order Count' => $order_count,
                    'Delivered Orders' => $delivered_orders,
                    'Cancelled Orders' => $cancelled_orders,
                    'Avg Order Value' => number_format($order_count > 0 ? $orders->sum('order_amount') / $order_count : 0, 2),
                ];
            });

        return (new FastExcel($sellers))->download('vendor-report-' . now()->format('Y-m-d-His') . '.xlsx');
    }

    /**
     * Export delivery staff report as PDF
     */
    public function export_delivery_pdf(Request $request)
    {
        $from_date = $request->get('from_date', Carbon::now()->subMonth());
        $to_date = $request->get('to_date', Carbon::now());
        $status = $request->get('status', null);

        $delivery_men = DeliveryMan::query()
            ->when($status, function ($q) use ($status) {
                return $q->where('is_active', $status === 'active' ? 1 : 0);
            })
            ->get()
            ->map(function ($delivery_man) use ($from_date, $to_date) {
                $orders = Order::where('delivery_man_id', $delivery_man->id)
                    ->whereBetween('created_at', [$from_date, $to_date])
                    ->get();

                $delivered_orders = $orders->where('order_status', 'delivered')->count();
                $pending_orders = $orders->whereIn('order_status', ['processing', 'shipped'])->count();
                $cancelled_orders = $orders->where('order_status', 'cancelled')->count();
                $total_orders = $orders->count();

                $total_earning = DB::table('deliveryman_transactions')
                    ->where('delivery_man_id', $delivery_man->id)
                    ->whereBetween('created_at', [$from_date, $to_date])
                    ->sum('amount');

                $avg_rating = DB::table('reviews')
                    ->where('delivery_man_id', $delivery_man->id)
                    ->avg('rating') ?? 0;

                return (object)[
                    'name' => $delivery_man->name,
                    'email' => $delivery_man->email,
                    'phone' => $delivery_man->phone,
                    'status' => $delivery_man->is_active ? 'Active' : 'Inactive',
                    'total_earning' => $total_earning,
                    'pending_balance' => $delivery_man->wallet?->pending_withdraw ?? 0,
                    'total_deliveries' => $delivered_orders,
                    'pending_deliveries' => $pending_orders,
                    'cancelled_orders' => $cancelled_orders,
                    'total_orders' => $total_orders,
                    'delivery_success_rate' => $total_orders > 0 ? ($delivered_orders / $total_orders) * 100 : 0,
                    'avg_rating' => round($avg_rating, 2),
                ];
            });

        $pdf = Pdf::loadView('admin-views.custom-reports.delivery-pdf', [
            'delivery_men' => $delivery_men,
            'from_date' => Carbon::parse($from_date)->format('Y-m-d'),
            'to_date' => Carbon::parse($to_date)->format('Y-m-d'),
            'generated_at' => now()->format('Y-m-d H:i:s'),
        ]);

        return $pdf->download('delivery-report-' . now()->format('Y-m-d-His') . '.pdf');
    }

    /**
     * Export delivery staff report as Excel
     */
    public function export_delivery_excel(Request $request)
    {
        $from_date = $request->get('from_date', Carbon::now()->subMonth());
        $to_date = $request->get('to_date', Carbon::now());
        $status = $request->get('status', null);

        $delivery_men = DeliveryMan::query()
            ->when($status, function ($q) use ($status) {
                return $q->where('is_active', $status === 'active' ? 1 : 0);
            })
            ->get()
            ->map(function ($delivery_man) use ($from_date, $to_date) {
                $orders = Order::where('delivery_man_id', $delivery_man->id)
                    ->whereBetween('created_at', [$from_date, $to_date])
                    ->get();

                $delivered_orders = $orders->where('order_status', 'delivered')->count();
                $pending_orders = $orders->whereIn('order_status', ['processing', 'shipped'])->count();
                $cancelled_orders = $orders->where('order_status', 'cancelled')->count();
                $total_orders = $orders->count();

                $total_earning = DB::table('deliveryman_transactions')
                    ->where('delivery_man_id', $delivery_man->id)
                    ->whereBetween('created_at', [$from_date, $to_date])
                    ->sum('amount');

                $avg_rating = DB::table('reviews')
                    ->where('delivery_man_id', $delivery_man->id)
                    ->avg('rating') ?? 0;

                return [
                    'Delivery Staff Name' => $delivery_man->name,
                    'Email' => $delivery_man->email,
                    'Phone' => $delivery_man->phone,
                    'Status' => $delivery_man->is_active ? 'Active' : 'Inactive',
                    'Total Earning' => number_format($total_earning, 2),
                    'Pending Balance' => number_format($delivery_man->wallet?->pending_withdraw ?? 0, 2),
                    'Total Deliveries' => $delivered_orders,
                    'Pending Deliveries' => $pending_orders,
                    'Cancelled Orders' => $cancelled_orders,
                    'Success Rate (%)' => number_format($total_orders > 0 ? ($delivered_orders / $total_orders) * 100 : 0, 2),
                    'Average Rating' => round($avg_rating, 2),
                ];
            });

        return (new FastExcel($delivery_men))->download('delivery-report-' . now()->format('Y-m-d-His') . '.xlsx');
    }

    /**
     * Comparative report between vendors
     */
    public function vendor_comparison(Request $request)
    {
        $from_date = $request->get('from_date', Carbon::now()->subMonth());
        $to_date = $request->get('to_date', Carbon::now());
        $limit = $request->get('limit', 10);

        // Top sellers by earnings
        $top_sellers = Seller::with(['wallet', 'orders', 'shop'])
            ->get()
            ->map(function ($seller) use ($from_date, $to_date) {
                $total_earning = OrderTransaction::where('seller_id', $seller->id)
                    ->where('seller_is', 'seller')
                    ->whereBetween('created_at', [$from_date, $to_date])
                    ->sum('seller_amount');

                return (object)[
                    'id' => $seller->id,
                    'shop_name' => $seller->shop?->shop_name ?? $seller->name,
                    'total_earning' => $total_earning,
                ];
            })
            ->sortByDesc('total_earning')
            ->take($limit);

        // Top delivery staff by completed deliveries
        $top_delivery = DeliveryMan::get()
            ->map(function ($delivery_man) use ($from_date, $to_date) {
                $delivered = Order::where('delivery_man_id', $delivery_man->id)
                    ->where('order_status', 'delivered')
                    ->whereBetween('created_at', [$from_date, $to_date])
                    ->count();

                return (object)[
                    'id' => $delivery_man->id,
                    'name' => $delivery_man->name,
                    'delivered' => $delivered,
                ];
            })
            ->sortByDesc('delivered')
            ->take($limit);

        return view('admin-views.custom-reports.comparison-report', [
            'top_sellers' => $top_sellers,
            'top_delivery' => $top_delivery,
            'from_date' => $from_date,
            'to_date' => $to_date,
        ]);
    }
}
