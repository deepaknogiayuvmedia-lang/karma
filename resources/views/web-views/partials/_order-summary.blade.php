<aside class="col-lg-4 pt-4 pt-lg-2 {{ request()->routeIs('checkout-details', 'checkout-payment') ? 'os-sticky-sidebar' : '' }}">
    <style>
        @media (min-width: 992px) {
            .os-sticky-sidebar {
                position: sticky;
                top: 90px;
                align-self: flex-start;
                z-index: 2;
            }
        }

        @media (max-width: 991.98px) {
            .os-sticky-sidebar {
                position: static;
            }
        }

        .os-card {
            --os-primary: #168A3A;
            background: #fff;
            border: 1px solid #E8ECEA;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(17, 24, 39, 0.06);
            overflow: hidden;
        }

        .os-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.15rem;
            background: linear-gradient(135deg, #0F5C2C 0%, #168A3A 100%);
            color: #fff;
        }

        .os-head h5 {
            margin: 0;
            font-size: 0.98rem;
            font-weight: 700;
            letter-spacing: 0.01em;
        }

        .os-head .os-count {
            font-size: 0.75rem;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.28);
            border-radius: 999px;
            padding: 0.2rem 0.6rem;
        }

        .os-empty {
            padding: 1.5rem 1rem;
            text-align: center;
            color: #66706A;
            font-size: 0.88rem;
        }

        .os-rows {
            padding: 1rem 1.15rem 0.35rem;
        }

        .os-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.75rem;
            padding: 0.4rem 0;
            font-size: 0.86rem;
        }

        .os-row .os-label {
            color: #66706A;
        }

        .os-row .os-val {
            font-weight: 700;
            color: #1B1F1D;
        }

        .os-row.os-discount .os-val {
            color: #DC2626;
        }

        .os-row.os-ship .os-val {
            color: #168A3A;
        }

        .os-coupon {
            padding: 0.5rem 1.15rem 0.85rem;
        }

        .os-coupon .input-group {
            border: 1.5px solid #E5E7EB;
            border-radius: 10px;
            overflow: hidden;
        }

        .os-coupon .form-control {
            border: none;
            font-size: 0.84rem;
            padding: 0.55rem 0.75rem;
        }

        .os-coupon .form-control:focus {
            box-shadow: none;
        }

        .os-coupon .btn-apply {
            border: none;
            background: var(--os-primary);
            color: #fff;
            font-weight: 700;
            font-size: 0.8rem;
            padding: 0 1rem;
            letter-spacing: 0.02em;
        }

        .os-coupon .btn-apply:hover {
            background: #127230;
        }

        .os-coupon-applied {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
            background: #F0FDF4;
            border: 1px dashed #86EFAC;
            border-radius: 10px;
            padding: 0.55rem 0.75rem;
            font-size: 0.82rem;
            color: #166534;
            font-weight: 600;
        }

        .os-total {
            margin: 0.25rem 1.15rem 1rem;
            padding: 0.9rem 1rem;
            background: #F0FDF4;
            border: 1.5px solid #BBF7D0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
        }

        .os-total .os-total-label {
            font-size: 0.9rem;
            font-weight: 700;
            color: #14532D;
        }

        .os-total .os-total-label small {
            display: block;
            font-weight: 500;
            font-size: 0.72rem;
            color: #4D7C5A;
            margin-top: 0.1rem;
        }

        .os-total .os-total-val {
            font-size: 1.45rem;
            font-weight: 800;
            color: #168A3A;
            line-height: 1;
            letter-spacing: -0.02em;
        }

        .os-trust {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.35rem;
            padding: 0.9rem 1.15rem 1.1rem;
            text-align: center;
            border-top: 1px dashed #E5E7EB;
        }

        .os-trust div {
            font-size: 0.68rem;
            color: #66706A;
            font-weight: 600;
            line-height: 1.25;
        }

        .os-trust i {
            display: block;
            font-size: 1.05rem;
            color: #168A3A;
            margin-bottom: 0.25rem;
        }
    </style>

    {{-- Products Grid for Mobile --}}
    <style>
        .os-products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            gap: 10px;
            padding: 10px;
        }

        .os-product-card {
            background: #fff;
            border: 1px solid #E8ECEA;
            border-radius: 12px;
            padding: 8px;
            text-align: center;
            transition: all 0.2s ease;
        }

        .os-product-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .os-product-img {
            width: 50px;
            height: 50px;
            margin: 0 auto 6px;
            background: #F8F9FA;
            border-radius: 8px;
            overflow: hidden;
        }

        .os-product-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .os-product-name {
            font-size: 12px;
            font-weight: 600;
            color: #1c252e;
            margin: 4px 0 2px;
            line-height: 1.3;
        }

        .os-product-qty {
            font-size: 11px;
            color: #66706A;
            margin-bottom: 4px;
        }

        .os-product-price {
            font-size: 13px;
            color: #168A3A;
            font-weight: 700;
            margin-top: 4px;
        }
    </style>

   
    {{-- Coupon Section --}}
    @php($sub_total=0)
    @php($total_tax=0)
    @php($total_shipping_cost=0)
    @php($order_wise_shipping_discount=\App\CPU\CartManager::order_wise_shipping_discount())
    @php($total_discount_on_product=0)
    @php($cart=\App\CPU\CartManager::get_cart())
    @php($cart_group_ids=\App\CPU\CartManager::get_cart_group_ids())
    @php($shipping_cost=session('delhivery_shipping_cost', 0))
    @php($item_count=0)
    @php($format_order_price = function ($amount) {
        if (request()->routeIs('checkout-details', 'checkout-payment')) {
            $rounded_amount = round((float) $amount);
            $formatted_amount = number_format(abs($rounded_amount), 0);
            $sign = $rounded_amount < 0 ? '-' : '';
            \App\CPU\Helpers::currency_load();
            $currency_symbol = session('currency_symbol');
            return \App\CPU\Helpers::get_business_settings('currency_symbol_position') === 'left'
                ? $sign . $currency_symbol . $formatted_amount
                : $sign . $formatted_amount . $currency_symbol;
        }

        return \App\CPU\Helpers::currency_converter($amount);
    })
    @if($cart->count() > 0)
        @foreach($cart as $key => $cartItem)
            @php($sub_total+=$cartItem['price']*$cartItem['quantity'])
            @php($total_tax+=$cartItem['tax_model']=='exclude' ? ($cartItem['tax']*$cartItem['quantity']):0)
            @php($total_discount_on_product+=$cartItem['discount']*$cartItem['quantity'])
            @php($item_count+=$cartItem['quantity'])
        @endforeach
        @php($total_shipping_cost=$shipping_cost)
    @endif

    <div class="os-card">
        <div class="os-head">
            <h5 class="text-white"><i class="fa fa-receipt mr-2"></i>{{\App\CPU\translate('Order Summary')}}</h5>
            @if($item_count > 0)
                <span class="os-count">{{ $item_count }} {{ \App\CPU\translate('items') }}</span>
            @endif
        </div>

        @if($cart->count() > 0)
            {{-- Products listed in the order summary --}}
            <style>
                .os-product-list { padding: 0.75rem 1.15rem 0.25rem; }
                .os-pl-item { display: flex; align-items: center; gap: 0.6rem; padding: 0.45rem 0; border-bottom: 1px dashed #E8ECEA; }
                .os-pl-item:last-child { border-bottom: none; }
                .os-pl-img { width: 44px; height: 44px; flex: 0 0 44px; background: #F8F9FA; border: 1px solid #E8ECEA; border-radius: 9px; overflow: hidden; }
                .os-pl-img img { width: 100%; height: 100%; object-fit: contain; }
                .os-pl-body { min-width: 0; flex: 1; }
                .os-pl-name { font-size: 0.8rem; font-weight: 600; color: #1B1F1D; line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
                .os-pl-var { font-size: 0.7rem; color: #66706A; margin-top: 1px; }
                .os-pl-meta { font-size: 0.72rem; color: #66706A; margin-top: 2px; }
                .os-pl-meta b { color: #168A3A; font-weight: 700; }
            </style>
            <div class="os-product-list">
                @foreach($cart as $cartItem)
                    @php($plVariations = json_decode($cartItem['variations'], true) ?: [])
                    <div class="os-pl-item">
                        <div class="os-pl-img">
                            <img src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$cartItem['thumbnail'] ?? 'placeholder.jpg'}}"
                                 onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                 alt="{{$cartItem['name']}}">
                        </div>
                        <div class="os-pl-body">
                            <div class="os-pl-name">{{$cartItem['name']}}</div>
                            @if(!empty($plVariations))
                                <div class="os-pl-var">
                                    @foreach($plVariations as $vKey => $vVal)
                                        {{$vKey}}: {{$vVal}}@if(!$loop->last) · @endif
                                    @endforeach
                                </div>
                            @endif
                            <div class="os-pl-meta">
                                Qty {{$cartItem['quantity']}} · <b>{{ $format_order_price($cartItem['price'] * $cartItem['quantity']) }}</b>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="os-rows">
                <div class="os-row">
                    <span class="os-label">{{\App\CPU\translate('sub_total')}}</span>
                    <span class="os-val">{{ $format_order_price($sub_total) }}</span>
                </div>
                @if($total_tax > 0)
                    <div class="os-row">
                        <span class="os-label">{{\App\CPU\translate('tax')}}</span>
                        <span class="os-val">{{ $format_order_price($total_tax) }}</span>
                    </div>
                @endif
                <div class="os-row os-ship">
                    <span class="os-label">{{\App\CPU\translate('shipping')}}</span>
                    <span class="os-val" id="order-summary-shipping">
                        @if(session()->has('delhivery_shipping_cost'))
                            @if($total_shipping_cost > 0)
                                {{ $format_order_price($total_shipping_cost) }}
                            @else
                                {{\App\CPU\translate('Free')}}
                            @endif
                        @else
                            {{\App\CPU\translate('Check pincode')}}
                        @endif
                    </span>
                </div>
                @if($total_discount_on_product > 0)
                    <div class="os-row os-discount">
                        <span class="os-label">{{\App\CPU\translate('discount_on_product')}}</span>
                        <span class="os-val">- {{ $format_order_price($total_discount_on_product) }}</span>
                    </div>
                @endif
            </div>

            @if(session()->has('coupon_discount'))
                @php($coupon_discount = session('coupon_discount') ?: 0)
                @php($coupon_dis = $coupon_discount)
                <div class="os-coupon">
                    <div class="os-coupon-applied">
                        <span><i class="fa fa-tag mr-1"></i> {{\App\CPU\translate('coupon_discount')}} ({{ session('coupon_code') ?? '' }})</span>
                        <span id="coupon-discount-amount">- {{ $format_order_price($coupon_discount+$order_wise_shipping_discount) }}</span>
                    </div>
                </div>
            @else
                @php($coupon_dis = 0)
                <div class="os-coupon">
                    <form class="needs-validation" action="javascript:" method="post" novalidate id="coupon-code-ajax">
                        <div class="input-group">
                            <input class="form-control" type="text" name="code"
                                   placeholder="{{\App\CPU\translate('Enter Coupon Code')}}" required>
                            <div class="input-group-append">
                                <button class="btn-apply" type="button" onclick="couponCode()">
                                    {{\App\CPU\translate('Apply')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif

            @php($exact_order_total = $sub_total+$total_tax+$total_shipping_cost-$coupon_dis-$total_discount_on_product-$order_wise_shipping_discount)
            @php($rounded_component_total = round($sub_total)+round($total_tax)+round($total_shipping_cost)-round($coupon_dis+$order_wise_shipping_discount)-round($total_discount_on_product))
            @php($rounding_adjustment = round($exact_order_total)-$rounded_component_total)

            <div class="os-total">
                <div class="os-total-label">
                    {{\App\CPU\translate('Total Payable')}}
                    <small>{{\App\CPU\translate('inclusive of all taxes')}}</small>
                </div>
                <div class="os-total-val" id="order-summary-total">
                    {{ $format_order_price($exact_order_total) }}
                </div>
            </div>
        @else
            <div class="os-empty">
                <i class="fa fa-shopping-cart d-block mb-2" style="font-size:1.6rem;color:#C5CBD3;"></i>
                {{\App\CPU\translate('empty_cart')}}
            </div>
        @endif

        <div class="os-trust">
            <div><i class="fa fa-certificate"></i> Genuine Quality</div>
            <div><i class="fa fa-truck"></i> Fast Shipping</div>
            <div><i class="fa fa-lock"></i> Secure Payment</div>
        </div>
    </div>
</aside>
