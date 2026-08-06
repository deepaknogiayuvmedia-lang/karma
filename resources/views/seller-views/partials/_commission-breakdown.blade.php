{{-- Phase 15: Seller Commission Breakdown --}}
@php
    $recent_orders = \App\Model\OrderTransaction::with(['order.details.product'])
        ->where('seller_is', 'seller')
        ->where('seller_id', auth('seller')->id())
        ->where('status', 'disburse')
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();
@endphp

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">
            <i class="tio-chart-bar-2"></i> {{\App\CPU\translate('Commission Breakdown')}}
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-bordered mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>{{\App\CPU\translate('Order')}}</th>
                        <th>{{\App\CPU\translate('Product')}}</th>
                        <th class="text-center">{{\App\CPU\translate('Qty')}}</th>
                        <th class="text-right">{{\App\CPU\translate('Product Price')}}</th>
                        <th class="text-right">{{\App\CPU\translate('Admin Commission')}}</th>
                        <th class="text-center">{{\App\CPU\translate('Type')}}</th>
                        <th class="text-right">{{\App\CPU\translate('Seller Earnings')}}</th>
                        <th class="text-right">{{\App\CPU\translate('Net Amount')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_orders as $transaction)
                        @if(isset($transaction->order) && isset($transaction->order->details))
                            @foreach($transaction->order->details as $detail)
                                @if(isset($detail->product))
                                    @php
                                        $product = $detail->product;
                                        $qty = $detail->qty;
                                        $unit_price = $detail->price / max($qty, 1);
                                        $product_total = $detail->price;
                                        $commission = $transaction->admin_commission * ($product_total / max($transaction->order_amount, 1));
                                        $seller_earning = $product_total - $commission;
                                        $commission_type = $product->admin_commission_type ?? 'percentage';
                                        $commission_value = $product->admin_commission ?? 0;
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="{{route('seller.order.order-details', $transaction->order_id)}}"
                                               class="text-primary">
                                                #{{$transaction->order_id}}
                                            </a>
                                            <br>
                                            <small class="text-muted">{{$transaction->created_at->format('d M Y')}}</small>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if(isset($product->thumbnail))
                                                    <img src="{{asset(env('PUBLIC_STORAGE_PATH').'/product/thumbnail/'.$product->thumbnail)}}"
                                                         alt="{{$product->name}}"
                                                         class="mr-2 rounded"
                                                         width="32" height="32"
                                                         style="object-fit:cover;">
                                                @endif
                                                <span>{{Str::limit($product->name, 30)}}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">{{$qty}}</td>
                                        <td class="text-right">
                                            {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($unit_price))}}
                                        </td>
                                        <td class="text-right text-danger">
                                            -{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($commission))}}
                                        </td>
                                        <td class="text-center">
                                            @if($commission_value > 0)
                                                <span class="badge badge-soft-primary">
                                                    {{$commission_type === 'fixed' ? \App\CPU\translate('Fixed') : $commission_value.'%'}}
                                                </span>
                                            @else
                                                <span class="badge badge-soft-secondary">
                                                    {{\App\CPU\translate('Global')}}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-right text-success">
                                            {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($seller_earning))}}
                                        </td>
                                        <td class="text-right font-weight-bold">
                                            {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($seller_earning))}}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                {{\App\CPU\translate('No recent transactions found')}}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
