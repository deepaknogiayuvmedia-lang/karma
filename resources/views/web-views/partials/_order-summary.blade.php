<aside class="col-lg-4 pt-4 pt-lg-2">
    <style>
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

    @php($shippingMethod=\App\CPU\Helpers::get_business_settings('shipping_method'))
    @php($sub_total=0)
    @php($total_tax=0)
    @php($total_shipping_cost=0)
    @php($order_wise_shipping_discount=\App\CPU\CartManager::order_wise_shipping_discount())
    @php($total_discount_on_product=0)
    @php($cart=\App\CPU\CartManager::get_cart())
    @php($cart_group_ids=\App\CPU\CartManager::get_cart_group_ids())
    @php($shipping_cost=\App\CPU\CartManager::get_shipping_cost())
    @php($item_count=0)
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
            <div class="os-rows">
                <div class="os-row">
                    <span class="os-label">{{\App\CPU\translate('sub_total')}}</span>
                    <span class="os-val">{{\App\CPU\Helpers::currency_converter($sub_total)}}</span>
                </div>
                @if($total_tax > 0)
                    <div class="os-row">
                        <span class="os-label">{{\App\CPU\translate('tax')}}</span>
                        <span class="os-val">{{\App\CPU\Helpers::currency_converter($total_tax)}}</span>
                    </div>
                @endif
                <div class="os-row os-ship">
                    <span class="os-label">{{\App\CPU\translate('shipping')}}</span>
                    <span class="os-val" id="order-summary-shipping">
                        @if($total_shipping_cost > 0)
                            {{\App\CPU\Helpers::currency_converter($total_shipping_cost)}}
                        @else
                            {{\App\CPU\translate('Free')}}
                        @endif
                    </span>
                </div>
                @if($total_discount_on_product > 0)
                    <div class="os-row os-discount">
                        <span class="os-label">{{\App\CPU\translate('discount_on_product')}}</span>
                        <span class="os-val">- {{\App\CPU\Helpers::currency_converter($total_discount_on_product)}}</span>
                    </div>
                @endif
            </div>

            @if(session()->has('coupon_discount'))
                @php($coupon_discount = session('coupon_discount') ?: 0)
                @php($coupon_dis = $coupon_discount)
                <div class="os-coupon">
                    <div class="os-coupon-applied">
                        <span><i class="fa fa-tag mr-1"></i> {{\App\CPU\translate('coupon_discount')}} ({{ session('coupon_code') ?? '' }})</span>
                        <span id="coupon-discount-amount">- {{\App\CPU\Helpers::currency_converter($coupon_discount+$order_wise_shipping_discount)}}</span>
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

            <div class="os-total">
                <div class="os-total-label">
                    {{\App\CPU\translate('Total Payable')}}
                    <small>{{\App\CPU\translate('inclusive of all taxes')}}</small>
                </div>
                <div class="os-total-val" id="order-summary-total">
                    {{\App\CPU\Helpers::currency_converter($sub_total+$total_tax+$total_shipping_cost-$coupon_dis-$total_discount_on_product-$order_wise_shipping_discount)}}
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
