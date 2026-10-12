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

    /* ===== Improved Cart Design ===== */
    .cart-header {
        background: linear-gradient(135deg, #0F5C2C 0%, #168A3A 100%);
        color: #fff;
        padding: 1.25rem 1.5rem;
        border-radius: 14px 14px 0 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .cart-header h3 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 700;
    }
    .cart-header .cart-count {
        background: rgba(255,255,255,0.2);
        border-radius: 999px;
        padding: 0.25rem 0.75rem;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Product Card - Desktop: horizontal layout */
    .cart-product-card {
        background: #fff;
        border: 1px solid #E8ECEA;
        border-radius: 12px;
        overflow: hidden;
        transition: box-shadow 0.2s ease, transform 0.2s ease;
        margin-bottom: 1rem;
    }
    .cart-product-card:hover {
        box-shadow: 0 8px 24px rgba(17, 24, 39, 0.1);
    }

    .cart-product-inner {
        display: flex;
        flex-direction: row;
    }

    .cart-product-img-wrapper {
        flex-shrink: 0;
        width: 140px;
        height: 140px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem;
    }
    .cart-product-img-wrapper img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 8px;
    }

    .cart-product-body {
        flex: 1;
        padding: 1rem 1.25rem;
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .cart-product-name {
        font-size: 0.95rem;
        font-weight: 600;
        color: #1c252e;
        margin-bottom: 0.35rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .cart-product-name a {
        color: inherit;
        text-decoration: none;
    }
    .cart-product-name a:hover {
        color: #168A3A;
    }

    .cart-product-variations {
        display: flex;
        flex-wrap: wrap;
        gap: 0.35rem;
        margin-bottom: 0.5rem;
    }
    .cart-product-variations .badge {
        background: #f3f4f6;
        color: #4b5563;
        font-weight: 500;
        font-size: 0.7rem;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
    }

    .cart-product-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: auto;
        padding-top: 0.75rem;
    }

    .cart-product-price-section {
        display: flex;
        flex-direction: column;
    }
    .cart-product-price {
        font-size: 1.05rem;
        font-weight: 700;
        color: #168A3A;
    }
    .cart-product-original {
        font-size: 0.78rem;
        color: #9ca3af;
        text-decoration: line-through;
    }
    .cart-product-total {
        font-size: 0.8rem;
        color: #6b7280;
        margin-top: 2px;
    }

    .cart-product-actions {
        /* margin-left: auto; */
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 0.5rem;
    }

    .cart-qty-stepper-sm {
        transform: scale(0.85);
        transform-origin: right center;
    }

    .cart-remove-link {
        font-size: 0.78rem;
        color: #dc2626;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.25rem 0;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }
    .cart-remove-link:hover {
        color: #b91c1c;
        text-decoration: underline;
    }

    /* Shipping & Note Cards */
    .cart-shipping-card {
        background: #fff;
        border: 1px solid #E8ECEA;
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1rem;
    }
    .cart-shipping-card label {
        font-weight: 600;
        color: #1c252e;
        margin-bottom: 0.75rem;
        display: block;
        font-size: 0.95rem;
    }

    .cart-order-note {
        background: #fff;
        border: 1px solid #E8ECEA;
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }
    .cart-order-note label {
        font-weight: 600;
        color: #1c252e;
        margin-bottom: 0.75rem;
        display: block;
        font-size: 0.95rem;
    }

    /* Action Buttons */
    .cart-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .cart-actions .btn {
        flex: 1;
        min-width: 140px;
        padding: 0.875rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    /* Empty Cart */
    .empty-cart-wrapper {
        background: #fff;
        border-radius: 16px;
        padding: 3rem 2rem;
        text-align: center;
    }
    .empty-cart-wrapper img {
        width: 120px;
        opacity: 0.6;
        margin-bottom: 1.5rem;
    }
    .empty-cart-wrapper h4 {
        color: #6b7280;
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    /* ===== Tablet ===== */
    @media (max-width: 991px) {
        .cart-product-img-wrapper {
            width: 120px;
            height: 120px;
        }
        .cart-product-body {
            padding: 0.85rem 1rem;
        }
        .cart-product-name {
            font-size: 0.88rem;
        }
    }

    /* ===== Mobile ===== */
    @media (max-width: 767px) {
        .cart-product-inner {
            flex-direction: row;
        }
        .cart-product-img-wrapper {
            flex-shrink: 0;
        }
        .cart-product-actions {
            flex-direction: column;
            align-items: flex-end;
        }
        .cart-header {
            padding: 0.85rem 1rem;
        }
        .cart-header h3 {
            font-size: 0.9rem;
        }
        .cart-product-card {
            border-radius: 10px;
            margin-bottom: 0.75rem;
        }
        .cart-product-img-wrapper {
            width: 100px;
            height: 100px;
            padding: 0.5rem;
        }
        .cart-product-body {
            padding: 0.6rem 0.75rem;
        }
        .cart-product-name {
            font-size: 0.8rem;
            margin-bottom: 0.25rem;
        }
        .cart-product-variations .badge {
            font-size: 0.6rem;
            padding: 0.1rem 0.3rem;
        }
        .cart-product-meta {
            padding-top: 0.5rem;
        }
        .cart-product-price {
            font-size: 0.85rem;
        }
        .cart-product-original {
            font-size: 0.7rem;
        }
        .cart-product-total {
            font-size: 0.7rem;
        }
        .cart-product-actions {
            gap: 0.35rem;
        }
        .cart-qty-stepper {
            transform: scale(0.75);
            margin-right: -10px;
        }
        .cart-qty-field {
            width: 30px;
            font-size: 12px;
        }
        .cart-qty-btn {
            width: 26px;
            height: 26px;
            font-size: 13px;
        }
        .cart-remove-link {
            font-size: 0.68rem;
        }
        .cart-shipping-card,
        .cart-order-note {
            padding: 0.85rem;
        }
        .cart-actions {
            flex-direction: column;
            gap: 0.5rem;
        }
        .cart-actions .btn {
            width: 100%;
            padding: 0.7rem 1rem;
            font-size: 0.85rem;
        }
    }
</style>

@php($shippingMethod=\App\CPU\Helpers::get_business_settings('shipping_method'))
@php($cart=\App\Model\Cart::where(['customer_id' => auth('customer')->id()])->get()->groupBy('cart_group_id'))
@php($totalItems = 0)
@foreach($cart as $group)
    @foreach($group as $item)
        @php($totalItems += $item->quantity)
    @endforeach
@endforeach

<div class="cart-header mb-3">
    <h3 class="text-white">
        <i class="czi-cart mr-2"></i>{{ \App\CPU\translate('shopping_cart')}}
    </h3>
    <span class="cart-count">{{ $totalItems }} {{ \App\CPU\translate('items') }}</span>
</div>

<div class="row g-3">
    <!-- Products Section -->
    <section class="col-lg-8">
        @if(count($cart) == 0)
            <div class="empty-cart-wrapper">
                <img src="{{asset('assets/front-end/img/empty-cart.png')}}" onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'" alt="Empty Cart">
                <h4>{{\App\CPU\translate('cart_empty')}}</h4>
                <a href="{{route('home')}}" class="btn btn--primary px-4">
                    {{\App\CPU\translate('continue_shopping')}}
                </a>
            </div>
        @else
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

                    <!-- Product Card -->
                    <div class="cart-product-card">
                        <div class="cart-product-inner align-items-center">
                            <!-- Image -->
                            <div class="cart-product-img-wrapper">
                                <a href="{{route('product',$cartItem['slug'])}}">
                                    <img src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$cartItem['thumbnail'] ?? 'placeholder.jpg'}}"
                                         onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                         alt="{{$cartItem['name']}}">
                                </a>
                            </div>

                            <!-- Details -->
                            <div class="cart-product-body">
                                <div class="cart-product-name">
                                    <a href="{{route('product',$cartItem['slug'])}}">
                                        {{$cartItem['name']}}
                                    </a>
                                </div>

                                @if(!empty(json_decode($cartItem['variations'],true)))
                                    <div class="cart-product-variations">
                                        @foreach(json_decode($cartItem['variations'],true) as $key1 => $variation)
                                            <span class="badge">{{$key1}} : {{$variation}}</span>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="cart-product-meta">
                                    <div class="cart-product-price-section">
                                        <span class="cart-product-price">
                                            {{ \App\CPU\Helpers::currency_converter(($cartItem['price'] ?? 0)-($cartItem['discount'] ?? 0)) }}
                                        </span>
                                        @if(($cartItem['discount'] ?? 0) > 0)
                                            <span class="cart-product-original">
                                                {{\App\CPU\Helpers::currency_converter($cartItem['price'])}}
                                            </span>
                                        @endif
                                        <span class="cart-product-total">
                                            Total: {{ \App\CPU\Helpers::currency_converter(($cartItem['price']-$cartItem['discount'])*$cartItem['quantity']) }}
                                        </span>
                                    </div>

                                    <div class="cart-product-actions">
                                        <div class="cart-qty-stepper cart-qty-stepper-sm">
                                            @php($minimum_order=\App\Model\Product::select('minimum_order_qty')->find($cartItem['product_id']))
                                            <button class="cart-qty-btn btn-number" type="button" data-type="minus"
                                                data-field="quantity[{{ $cartItem['id'] }}]"
                                                {{ $cartItem['quantity'] <= ($minimum_order->minimum_order_qty ?? 1) ? 'disabled' : '' }}>-</button>
                                            <input class="cart-qty-field" type="text" name="quantity[{{ $cartItem['id'] }}]"
                                                id="cartQuantity{{$cartItem['id']}}"
                                                value="{{$cartItem['quantity']}}" min="{{ $minimum_order->minimum_order_qty ?? 1 }}" max="100"
                                                product-type="physical"
                                                onchange="updateCartQuantity('{{ $minimum_order->minimum_order_qty ?? 1 }}', '{{$cartItem['id']}}')">
                                            <button class="cart-qty-btn btn-number" type="button" data-type="plus"
                                                data-field="quantity[{{ $cartItem['id'] }}]" product-type="physical">+</button>
                                        </div>
                                        <button class="cart-remove-link" onclick="removeFromCart({{ $cartItem['id'] }})" type="button">
                                            <i class="czi-close-circle"></i>
                                            {{ \App\CPU\translate('remove') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                   
                @endforeach
            @endforeach

            <!-- Inhouse Shipping -->
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
                    <div class="cart-shipping-card">
                        <label>{{\App\CPU\translate('choose_shipping_method')}} ({{\App\CPU\translate('all_items')}})</label>
                        <select class="form-control" onchange="set_shipping_id(this.value,'all_cart_group')">
                            <option>{{\App\CPU\translate('choose_shipping_method')}}</option>
                            @foreach($shippings as $shipping)
                                <option value="{{$shipping['id']}}" {{$choosen_shipping['shipping_method_id']==$shipping['id']?'selected':''}}>
                                    {{$shipping['title'].' ( '.$shipping['duration'].' ) '.\App\CPU\Helpers::currency_converter($shipping['cost'])}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
            @endif

            <!-- Order Note -->
            <div class="cart-order-note">
                <label for="order_note">
                    {{\App\CPU\translate('order_note')}}
                    <span class="text-muted font-weight-normal">({{\App\CPU\translate('Optional')}})</span>
                </label>
                <textarea class="form-control" id="order_note" name="order_note" rows="2"
                          placeholder="{{\App\CPU\translate('special_instructions_for_seller')}}"
                          style="border-radius: 8px;">{{ session('order_note') ?? '' }}</textarea>
            </div>

            <!-- Actions -->
            <div class="cart-actions">
                <a href="{{route('home')}}" class="btn btn-outline-primary">
                    <i class="fa fa-{{Session::get('direction') === "rtl" ? 'forward' : 'backward'}}"></i>
                    {{\App\CPU\translate('continue_shopping')}}
                </a>
                <a onclick="checkout()" class="btn btn--primary">
                    {{\App\CPU\translate('checkout')}}
                    <i class="fa fa-{{Session::get('direction') === "rtl" ? 'backward' : 'forward'}}"></i>
                </a>
            </div>
        @endif
    </section>

    <!-- Sidebar -->
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

    function checkout() {
        let order_note = $('#order_note')?.val() || '';
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