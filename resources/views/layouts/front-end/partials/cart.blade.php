<style>
    .cart-dd-wrap {
        width: 360px;
        max-height: 420px;
        border: none;
        border-radius: 12px;
        box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        padding: 0;
        overflow: hidden;
    }
    .cart-dd-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px;
        border-bottom: 1px solid #f0f0f0;
        background: #fafafa;
    }
    .cart-dd-header h6 {
        margin: 0;
        font-size: 14px;
        font-weight: 700;
        color: #1c252e;
    }
    .cart-dd-header .cart-count-badge {
        background: #168A3A;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 20px;
    }
    .cart-dd-items {
        max-height: 240px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #d1d5db transparent;
    }
    .cart-dd-items::-webkit-scrollbar {
        width: 4px;
    }
    .cart-dd-items::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 4px;
    }
    .cart-dd-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 18px;
        border-bottom: 1px solid #f5f5f5;
        transition: background 0.15s ease;
        position: relative;
    }
    .cart-dd-item:last-child {
        border-bottom: none;
    }
    .cart-dd-item:hover {
        background: #f9fafb;
    }
    .cart-dd-item-img {
        width: 56px;
        height: 56px;
        border-radius: 8px;
        object-fit: contain;
        border: 1px solid #f0f0f0;
        flex-shrink: 0;
        background: #fff;
    }
    .cart-dd-item-info {
        flex: 1;
        min-width: 0;
    }
    .cart-dd-item-name {
        font-size: 13px;
        font-weight: 600;
        color: #1c252e;
        margin: 0 0 2px;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-decoration: none;
    }
    .cart-dd-item-name:hover {
        color: #168A3A;
    }
    .cart-dd-item-var {
        font-size: 11px;
        color: #8c98a4;
        margin-bottom: 4px;
    }
    .cart-dd-item-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 4px;
    }
    .cart-dd-item-qty {
        font-size: 12px;
        color: #66706A;
        font-weight: 500;
    }
    .cart-dd-item-price {
        font-size: 14px;
        font-weight: 700;
        color: #168A3A;
    }
    .cart-dd-item-remove {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 20px;
        height: 20px;
        border: none;
        background: transparent;
        color: #ccc;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        opacity: 0;
        transition: all 0.15s ease;
        cursor: pointer;
        padding: 0;
    }
    .cart-dd-item:hover .cart-dd-item-remove {
        opacity: 1;
    }
    .cart-dd-item-remove:hover {
        background: #fef2f2;
        color: #ef4444;
    }
    .cart-dd-footer {
        border-top: 1px solid #f0f0f0;
        background: #fafafa;
    }
    .cart-dd-subtotal {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 18px;
    }
    .cart-dd-subtotal span:first-child {
        font-size: 13px;
        color: #66706A;
        font-weight: 500;
    }
    .cart-dd-subtotal span:last-child {
        font-size: 15px;
        color: #1c252e;
        font-weight: 700;
    }
    .cart-dd-actions {
        padding: 0 18px 14px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .cart-dd-btn-view {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        width: 100%;
        padding: 9px;
        border: 1.5px solid #168A3A;
        border-radius: 8px;
        background: #fff;
        color: #168A3A;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .cart-dd-btn-view:hover {
        background: #168A3A;
        color: #fff;
    }
    .cart-dd-btn-checkout {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        width: 100%;
        padding: 9px;
        border: none;
        border-radius: 8px;
        background: #168A3A;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .cart-dd-btn-checkout:hover {
        background: #0B5D2A;
        color: #fff;
    }
    .cart-dd-empty {
        padding: 40px 20px;
        text-align: center;
    }
    .cart-dd-empty-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
    }
    .cart-dd-empty-icon i {
        font-size: 22px;
        color: #9ca3af;
    }
    .cart-dd-empty h6 {
        font-size: 14px;
        font-weight: 600;
        color: #1c252e;
        margin: 0 0 4px;
    }
    .cart-dd-empty p {
        font-size: 12px;
        color: #9ca3af;
        margin: 0;
    }
    @media (max-width: 767px) {
        .cart-dd-wrap { width: 300px; }
    }
</style>

@php($cart=\App\CPU\CartManager::get_cart())
<div class="navbar-tool dropdown {{Session::get('direction') === 'rtl' ? 'mr-md-3' : 'ml-md-3'}}"
     style="margin-{{Session::get('direction') === 'rtl' ? 'left' : 'right'}}: 6px">
    <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{route('shop-cart')}}">
        <span class="navbar-tool-label">
            {{$cart->count()}}
        </span>
        <i class="navbar-tool-icon czi-cart"></i>
    </a>
    <a class="navbar-tool-text {{Session::get('direction') === 'rtl' ? 'mr-2' : 'ml-2'}}" href="{{route('shop-cart')}}">
        <small>{{\App\CPU\translate('my_cart')}}</small>
        {{\App\CPU\Helpers::currency_converter(\App\CPU\CartManager::cart_total_applied_discount($cart))}}
    </a>

    <!-- Cart Dropdown -->
    <div class="dropdown-menu dropdown-menu-{{Session::get('direction') === 'rtl' ? 'left' : 'right'}} cart-dd-wrap">
        @if($cart->count() > 0)
            @php($sub_total=0)
            @php($total_tax=0)

            <!-- Header -->
            <div class="cart-dd-header">
                <h6>{{\App\CPU\translate('Shopping Cart')}}</h6>
                <span class="cart-count-badge">{{$cart->count()}} {{\App\CPU\translate('items')}}</span>
            </div>

            <!-- Items List -->
            <div class="cart-dd-items">
                @foreach($cart as $cartItem)
                    <div class="cart-dd-item">
                        <button class="cart-dd-item-remove" type="button"
                                onclick="removeFromCart({{ $cartItem['id'] }})" title="{{\App\CPU\translate('remove')}}">
                            <i class="fa fa-times"></i>
                        </button>
                        <a href="{{route('product',$cartItem['slug'])}}">
                            <img class="cart-dd-item-img"
                                 onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                 src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$cartItem['thumbnail']}}"
                                 alt="{{$cartItem['name']}}">
                        </a>
                        <div class="cart-dd-item-info">
                            <a class="cart-dd-item-name" href="{{route('product',$cartItem['slug'])}}">
                                {{Str::limit($cartItem['name'],35)}}
                            </a>
                            @foreach(json_decode($cartItem['variations'],true) as $key=>$variation)
                                <div class="cart-dd-item-var">{{$key}}: {{$variation}}</div>
                            @endforeach
                            <div class="cart-dd-item-bottom">
                                <span class="cart-dd-item-qty">x{{$cartItem['quantity']}}</span>
                                <span class="cart-dd-item-price">
                                    {{\App\CPU\Helpers::currency_converter(($cartItem['price']-$cartItem['discount'])*$cartItem['quantity'])}}
                                </span>
                            </div>
                        </div>
                    </div>
                    @php($sub_total+=($cartItem['price']-$cartItem['discount'])*$cartItem['quantity'])
                    @php($total_tax+=$cartItem['tax']*$cartItem['quantity'])
                @endforeach
            </div>

            <!-- Footer -->
            <div class="cart-dd-footer">
                <div class="cart-dd-subtotal">
                    <span>{{\App\CPU\translate('Subtotal')}}</span>
                    <span>{{\App\CPU\Helpers::currency_converter($sub_total)}}</span>
                </div>
                <div class="cart-dd-actions">
                    <a class="cart-dd-btn-view" href="{{route('shop-cart')}}">
                        <i class="fa fa-shopping-bag"></i> {{\App\CPU\translate('View Cart')}}
                    </a>
                    <a class="cart-dd-btn-checkout" href="{{route('checkout-details')}}">
                        <i class="fa fa-lock"></i> {{\App\CPU\translate('Checkout')}}
                    </a>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="cart-dd-empty">
                <div class="cart-dd-empty-icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <h6>{{\App\CPU\translate('Your cart is empty')}}</h6>
                <p>{{\App\CPU\translate('Add items to get started')}}</p>
            </div>
        @endif
    </div>
</div>
