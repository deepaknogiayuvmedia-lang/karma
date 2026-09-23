<style>
    .cart-qty-stepper {
        display: inline-flex;
        align-items: center;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
    }
    .cart-qty-btn {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: #fff;
        font-size: 16px;
        font-weight: 700;
        color: #333;
        cursor: pointer;
        transition: all 0.15s ease;
        padding: 0;
    }
    .cart-qty-btn:hover:not(:disabled) {
        background: #f3f4f6;
        color: #168a3a;
    }
    .cart-qty-btn:disabled {
        color: #d1d5db;
        cursor: not-allowed;
        background: #f9fafb;
    }
    .cart-qty-field {
        width: 40px;
        height: 32px;
        border: none;
        border-left: 1px solid #e5e7eb;
        border-right: 1px solid #e5e7eb;
        text-align: center;
        font-weight: 700;
        font-size: 14px;
        color: #111;
        background: #fff;
        outline: none;
        padding: 0;
    }
</style>

<div class="feature_header mb-3">
    <h3 class="font-weight-bold text-capitalize m-0" style="font-size: 1.25rem;">
        <i class="czi-cart mr-2 text-primary"></i>{{ \App\CPU\translate('shopping_cart')}}
    </h3>
</div>

@php($shippingMethod=\App\CPU\Helpers::get_business_settings('shipping_method'))
@php($cart=\App\Model\Cart::where(['customer_id' => auth('customer')->id()])->get()->groupBy('cart_group_id'))

<div class="row g-3">
    <!-- List of items-->
    <section class="col-lg-8">
        @if(count($cart) == 0)
            <div class="card border-0 shadow-sm p-5 text-center mb-3">
                <div class="py-4">
                    <img src="{{asset('assets/front-end/img/empty-cart.png')}}" onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'" alt="Empty Cart" style="width: 100px;" class="mb-3 opacity-60">
                    <h4 class="text-muted text-capitalize mb-3">{{\App\CPU\translate('cart_empty')}}</h4>
                    <a href="{{route('home')}}" class="btn btn--primary px-4">
                        {{\App\CPU\translate('continue_shopping')}}
                    </a>
                </div>
            </div>
        @else
            <!-- Single Unified Card for All Products -->
            <div class="card __card cart_information mb-3 border-0 shadow-sm rounded-10 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table __cart-table mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="font-weight-bold text-center __w-5p">{{\App\CPU\translate('SL#')}}</th>
                                <th class="font-weight-bold __w-45">{{\App\CPU\translate('product_details')}}</th>
                                <th class="font-weight-bold text-center __w-15p">{{\App\CPU\translate('unit_price')}}</th>
                                <th class="font-weight-bold text-center __w-15p">{{\App\CPU\translate('qty')}}</th>
                                <th class="font-weight-bold text-center __w-15p">{{\App\CPU\translate('price')}}</th>
                                <th class="font-weight-bold text-center __w-5p"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @php($sl = 1)
                            @php($physical_product = false)
                            @php($lastCartGroupItem = null)

                            @foreach($cart as $group_key => $group)
                                @php($group_physical = false)
                                @foreach($group as $row)
                                    @if ($row->product_type == 'physical')
                                        @php($physical_product = true)
                                        @php($group_physical = true)
                                    @endif
                                @endforeach

                                @foreach($group as $cart_key => $cartItem)
                                    @php($lastCartGroupItem = $cartItem)
                                    @if ($shippingMethod=='inhouse_shipping')
                                        @php($admin_shipping = \App\Model\ShippingType::where('seller_id', 0)->first())
                                        @php($shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise')
                                    @else
                                        @if ($cartItem->seller_is == 'admin')
                                            @php($admin_shipping = \App\Model\ShippingType::where('seller_id', 0)->first())
                                            @php($shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise')
                                        @else
                                            @php($seller_shipping = \App\Model\ShippingType::where('seller_id', $cartItem->seller_id)->first())
                                            @php($shipping_type = isset($seller_shipping) == true ? $seller_shipping->shipping_type : 'order_wise')
                                        @endif
                                    @endif

                                    <tr class="align-middle">
                                        <td class="text-center font-weight-bold text-muted">{{$sl++}}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3 flex-shrink-0">
                                                    <a href="{{route('product',$cartItem['slug'])}}">
                                                        <img class="rounded border p-1 __img-62 object-cover"
                                                                onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                                                src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$cartItem['thumbnail']}}"
                                                                alt="{{$cartItem['name']}}" style="width: 60px; height: 60px; object-fit: cover;">
                                                    </a>
                                                </div>
                                                <div class="text-break __line-2 flex-grow-1">
                                                    <a href="{{route('product',$cartItem['slug'])}}" class="font-weight-semibold text-dark text-hover-primary" style="font-size: 0.95rem; text-decoration: none;">
                                                        {{$cartItem['name']}}
                                                    </a>
                                                    @if(!empty(json_decode($cartItem['variations'],true)))
                                                        <div class="d-flex flex-wrap mt-1">
                                                            @foreach(json_decode($cartItem['variations'],true) as $key1 => $variation)
                                                                <span class="badge badge-soft-secondary mr-2 mb-1 px-2 py-1" style="font-weight: 500; font-size: 0.75rem;">
                                                                    {{$key1}} : {{$variation}}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="text-accent font-weight-bold">
                                                {{ \App\CPU\Helpers::currency_converter($cartItem['price']-$cartItem['discount']) }}
                                            </div>
                                            @if($cartItem['discount'] > 0)
                                                <small class="text-muted text-decoration-line-through d-block">
                                                    {{\App\CPU\Helpers::currency_converter($cartItem['price'])}}
                                                </small>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-block">
                                                @php($minimum_order=\App\Model\Product::select('minimum_order_qty')->find($cartItem['product_id']))
                                                <div class="cart-qty-stepper">
                                                    <button class="cart-qty-btn btn-number" type="button" data-type="minus"
                                                        data-field="quantity[{{ $cartItem['id'] }}]" {{ $cartItem['quantity'] <= ($minimum_order->minimum_order_qty ?? 1) ? 'disabled' : '' }}>-</button>
                                                    <input class="cart-qty-field" type="text" name="quantity[{{ $cartItem['id'] }}]"
                                                        id="cartQuantity{{$cartItem['id']}}"
                                                        value="{{$cartItem['quantity']}}"
                                                        min="{{ $minimum_order->minimum_order_qty ?? 1 }}" max="100"
                                                        product-type="physical"
                                                        onchange="updateCartQuantity('{{ $minimum_order->minimum_order_qty ?? 1 }}', '{{$cartItem['id']}}')">
                                                    <button class="cart-qty-btn btn-number" type="button" data-type="plus"
                                                        data-field="quantity[{{ $cartItem['id'] }}]"
                                                        product-type="physical">+</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="font-weight-bold text-dark">
                                                {{ \App\CPU\Helpers::currency_converter(($cartItem['price']-$cartItem['discount'])*$cartItem['quantity']) }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-link text-danger p-1"
                                                    onclick="removeFromCart({{ $cartItem['id'] }})" type="button" title="{{\App\CPU\translate('remove')}}">
                                                <i class="czi-close-circle" style="font-size: 1.25rem;"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Seller wise shipping selection inside group -->
                                    @if($group_physical && $shippingMethod=='sellerwise_shipping' && $shipping_type == 'order_wise')
                                        @if($cart_key == $group->count() - 1)
                                            @php($choosen_shipping=\App\Model\CartShipping::where(['cart_group_id'=>$cartItem['cart_group_id']])->first())
                                            @if(isset($choosen_shipping)==false)
                                                @php($choosen_shipping['shipping_method_id']=0)
                                            @endif
                                            @php($shippings=\App\CPU\Helpers::get_shipping_methods($cartItem['seller_id'],$cartItem['seller_is']))
                                            <tr class="bg-light">
                                                <td colspan="4" class="py-2 px-3">
                                                    <select class="form-control form-control-sm"
                                                            onchange="set_shipping_id(this.value,'{{$cartItem['cart_group_id']}}')">
                                                        <option>{{\App\CPU\translate('choose_shipping_method')}}</option>
                                                        @foreach($shippings as $shipping)
                                                            <option
                                                                value="{{$shipping['id']}}" {{$choosen_shipping['shipping_method_id']==$shipping['id']?'selected':''}}>
                                                                {{$shipping['title'].' ( '.$shipping['duration'].' ) '.\App\CPU\Helpers::currency_converter($shipping['cost'])}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td colspan="2" class="py-2 px-3 text-right">
                                                    <span class="text-muted mr-1 font-weight-medium">{{\App\CPU\translate('shipping_cost')}} :</span>
                                                    <span class="font-weight-bold text-dark">
                                                        {{\App\CPU\Helpers::currency_converter($choosen_shipping['shipping_method_id']!= 0?$choosen_shipping->shipping_cost:0)}}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Inhouse Shipping Option -->
            @if($shippingMethod=='inhouse_shipping' && isset($lastCartGroupItem))
                <?php
                    $admin_shipping = \App\Model\ShippingType::where('seller_id', 0)->first();
                    $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
                ?>
                @if ($shipping_type == 'order_wise' && $physical_product)
                    @php($shippings=\App\CPU\Helpers::get_shipping_methods(1,'admin'))
                    @php($choosen_shipping=\App\Model\CartShipping::where(['cart_group_id'=>$lastCartGroupItem['cart_group_id']])->first())

                    @if(isset($choosen_shipping)==false)
                        @php($choosen_shipping['shipping_method_id']=0)
                    @endif
                    <div class="card border-0 shadow-sm p-3 mb-3 rounded-10">
                        <label class="font-weight-bold mb-2">{{\App\CPU\translate('choose_shipping_method')}}</label>
                        <select class="form-control" onchange="set_shipping_id(this.value,'all_cart_group')">
                            <option>{{\App\CPU\translate('choose_shipping_method')}}</option>
                            @foreach($shippings as $shipping)
                                <option
                                    value="{{$shipping['id']}}" {{$choosen_shipping['shipping_method_id']==$shipping['id']?'selected':''}}>
                                    {{$shipping['title'].' ( '.$shipping['duration'].' ) '.\App\CPU\Helpers::currency_converter($shipping['cost'])}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
            @endif

            <!-- Order Note -->
            <div class="card border-0 shadow-sm p-3 mb-4 rounded-10">
                <form method="get">
                    <div class="form-group mb-0">
                        <label for="order_note" class="form-label font-weight-bold text-dark mb-1">
                            {{\App\CPU\translate('order_note')}} 
                            <span class="text-muted font-weight-normal">({{\App\CPU\translate('Optional')}})</span>
                        </label>
                        <textarea class="form-control border-light-2" id="order_note" name="order_note" rows="2" placeholder="{{\App\CPU\translate('special_instructions_for_seller')}}" style="border-radius: 8px;">{{ session('order_note')}}</textarea>
                    </div>
                </form>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex btn-full-max-sm align-items-center __gap-6px flex-wrap justify-content-between mb-4">
                <a href="{{route('home')}}" class="btn btn-outline-primary px-4 py-2" style="border-radius: 8px; font-weight: 500;">
                    <i class="fa fa-{{Session::get('direction') === "rtl" ? 'forward' : 'backward'}} mr-2"></i> {{\App\CPU\translate('continue_shopping')}}
                </a>
                <a onclick="checkout()"
                class="btn btn--primary px-4 py-2 pull-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}" style="border-radius: 8px; font-weight: 600;">
                    {{\App\CPU\translate('checkout')}}
                    <i class="fa fa-{{Session::get('direction') === "rtl" ? 'backward' : 'forward'}} ml-2"></i>
                </a>
            </div>
        @endif
    </section>

    <!-- Sidebar-->
    @include('web-views.partials._order-summary')
</div>

<script>
    cartQuantityInitialize();

    function set_shipping_id(id, cart_group_id) {
        $.get({
            url: '{{url('/')}}/customer/set-shipping-method',
            dataType: 'json',
            data: {
                id: id,
                cart_group_id: cart_group_id
            },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                location.reload();
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    }
</script>
<script>
    function checkout() {
        let order_note = $('#order_note').val();
        $.post({
            url: "{{route('order_note')}}",
            data: {
                _token: '{{csrf_token()}}',
                order_note: order_note,
            },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                let url = "{{ route('checkout-details') }}";
                location.href = url;
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    }
</script>
