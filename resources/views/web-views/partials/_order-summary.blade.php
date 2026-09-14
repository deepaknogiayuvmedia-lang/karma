<aside class="col-lg-4 pt-4 pt-lg-2">
    <div class="card border p-3 shadow-sm rounded-lg" style="background-color: var(--bh-surface, #ffffff);">
        <h5 class="font-weight-bold mb-3 pb-2 border-bottom" style="color: var(--bh-text-primary, #1B1F1D);">
            <i class="fa fa-shopping-bag text-success mr-2"></i> {{\App\CPU\translate('Order Summary')}}
        </h5>

        @php($shippingMethod=\App\CPU\Helpers::get_business_settings('shipping_method'))
        @php($sub_total=0)
        @php($total_tax=0)
        @php($total_shipping_cost=0)
        @php($order_wise_shipping_discount=\App\CPU\CartManager::order_wise_shipping_discount())
        @php($total_discount_on_product=0)
        @php($cart=\App\CPU\CartManager::get_cart())
        @php($cart_group_ids=\App\CPU\CartManager::get_cart_group_ids())
        @php($shipping_cost=\App\CPU\CartManager::get_shipping_cost())
        @if($cart->count() > 0)
            @foreach($cart as $key => $cartItem)
                @php($sub_total+=$cartItem['price']*$cartItem['quantity'])
                @php($total_tax+=$cartItem['tax_model']=='exclude' ? ($cartItem['tax']*$cartItem['quantity']):0)
                @php($total_discount_on_product+=$cartItem['discount']*$cartItem['quantity'])
            @endforeach
            @php($total_shipping_cost=$shipping_cost)
        @else
            <div class="text-muted text-center py-2">{{\App\CPU\translate('empty_cart')}}</div>
        @endif

        <div class="d-flex justify-content-between py-1" style="font-size: 0.88rem;">
            <span class="text-muted">{{\App\CPU\translate('sub_total')}}</span>
            <span class="font-weight-bold">{{\App\CPU\Helpers::currency_converter($sub_total)}}</span>
        </div>
        <div class="d-flex justify-content-between py-1" style="font-size: 0.88rem;">
            <span class="text-muted">{{\App\CPU\translate('tax')}}</span>
            <span class="font-weight-bold">{{\App\CPU\Helpers::currency_converter($total_tax)}}</span>
        </div>
        <div class="d-flex justify-content-between py-1" style="font-size: 0.88rem;">
            <span class="text-muted">{{\App\CPU\translate('shipping')}}</span>
            <span class="font-weight-bold text-success">{{\App\CPU\Helpers::currency_converter($total_shipping_cost)}}</span>
        </div>
        @if($total_discount_on_product > 0)
            <div class="d-flex justify-content-between py-1" style="font-size: 0.88rem;">
                <span class="text-muted">{{\App\CPU\translate('discount_on_product')}}</span>
                <span class="font-weight-bold text-danger">- {{\App\CPU\Helpers::currency_converter($total_discount_on_product)}}</span>
            </div>
        @endif

        @if(session()->has('coupon_discount'))
            @php($coupon_discount = session()->has('coupon_discount')?session('coupon_discount'):0)
            <div class="d-flex justify-content-between py-1" style="font-size: 0.88rem;">
                <span class="text-muted">{{\App\CPU\translate('coupon_discount')}}</span>
                <span class="font-weight-bold text-danger" id="coupon-discount-amount">
                    - {{\App\CPU\Helpers::currency_converter($coupon_discount+$order_wise_shipping_discount)}}
                </span>
            </div>
            @php($coupon_dis=session('coupon_discount'))
        @else
            <div class="mt-3 pt-2 border-top">
                <form class="needs-validation" action="javascript:" method="post" novalidate id="coupon-code-ajax">
                    <div class="input-group input-group-sm">
                        <input class="form-control" type="text" name="code" placeholder="{{\App\CPU\translate('Enter Coupon Code')}}" required style="border-radius: var(--bh-radius-sm) 0 0 var(--bh-radius-sm);">
                        <div class="input-group-append">
                            <button class="btn btn-bh-primary" type="button" onclick="couponCode()" style="border-radius: 0 var(--bh-radius-sm) var(--bh-radius-sm) 0 !important; font-size: 0.82rem;">
                                {{\App\CPU\translate('Apply')}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @php($coupon_dis=0)
        @endif

        <hr class="my-3">
        <div class="d-flex justify-content-between align-items-center">
            <span class="font-weight-bold" style="font-size: 1.05rem; color: var(--bh-text-primary, #1B1F1D);">{{\App\CPU\translate('Total Payable')}}</span>
            <span class="font-weight-bold" style="font-size: 1.4rem; color: var(--bh-primary, #168A3A);">
                {{\App\CPU\Helpers::currency_converter($sub_total+$total_tax+$total_shipping_cost-$coupon_dis-$total_discount_on_product-$order_wise_shipping_discount)}}
            </span>
        </div>

        <div class="mt-3 pt-3 border-top text-center" style="font-size: 0.78rem; color: var(--bh-text-secondary, #66706A);">
            <div class="d-flex justify-content-around">
                <div><i class="fa fa-shield text-success mb-1 d-block" style="font-size: 1.1rem;"></i> Genuine Quality</div>
                <div><i class="fa fa-truck text-success mb-1 d-block" style="font-size: 1.1rem;"></i> Fast Shipping</div>
                <div><i class="fa fa-lock text-success mb-1 d-block" style="font-size: 1.1rem;"></i> Secure Payment</div>
            </div>
        </div>
    </div>
</aside>
