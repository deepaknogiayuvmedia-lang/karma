@extends('layouts.front-end.app')

@section('title', $product['name'])

@push('css_or_js')
    <meta name="description" content="{{ $product->slug }}">
    <meta name="keywords" content="@foreach (explode(' ', $product['name']) as $keyword) {{ $keyword . ' , ' }} @endforeach">
    @if ($product->added_by == 'seller')
        <meta name="author" content="{{ $product->seller->shop ? $product->seller->shop->name : $product->seller->f_name }}">
    @elseif($product->added_by == 'admin')
        <meta name="author" content="{{ $web_config['name']->value }}">
    @endif
    <!-- Viewport-->

    @if ($product['meta_image'] != null)
        <meta property="og:image"
            content="{{ asset(env('PUBLIC_STORAGE_PATH') . '/app/public/product/meta') }}/{{ $product->meta_image }}" />
        <meta property="twitter:card"
            content="{{ asset(env('PUBLIC_STORAGE_PATH') . '/app/public/product/meta') }}/{{ $product->meta_image }}" />
    @else
        <meta property="og:image"
            content="{{ asset(env('PUBLIC_STORAGE_PATH') . '/app/public/product/thumbnail') }}/{{ $product->thumbnail }}" />
        <meta property="twitter:card"
            content="{{ asset(env('PUBLIC_STORAGE_PATH') . '/app/public/product/thumbnail/') }}/{{ $product->thumbnail }}" />
    @endif

    @if ($product['meta_title'] != null)
        <meta property="og:title" content="{{ $product->meta_title }}" />
        <meta property="twitter:title" content="{{ $product->meta_title }}" />
    @else
        <meta property="og:title" content="{{ $product->name }}" />
        <meta property="twitter:title" content="{{ $product->name }}" />
    @endif
    <meta property="og:url" content="{{ route('product', [$product->slug]) }}">

    @if ($product['meta_description'] != null)
        <meta property="twitter:description" content="{!! $product['meta_description'] !!}">
        <meta property="og:description" content="{!! $product['meta_description'] !!}">
    @else
        <meta property="og:description"
            content="@foreach (explode(' ', $product['name']) as $keyword) {{ $keyword . ' , ' }} @endforeach">
        <meta property="twitter:description"
            content="@foreach (explode(' ', $product['name']) as $keyword) {{ $keyword . ' , ' }} @endforeach">
    @endif
    <meta property="twitter:url" content="{{ route('product', [$product->slug]) }}">

    <link rel="stylesheet" href="{{ asset('assets/front-end/css/product-details.css') }}" />
    <style>
        .btn-number:hover {
            color: {{ $web_config['secondary_color'] }};

        /* Phase 17: Product Detail Mobile Fix */
        @media (max-width: 767px) {
            .product-gallery {
                position: relative;
                overflow: hidden;
                border-radius: 8px;
            }
            .product-gallery .product-gallery__canvas {
                max-height: 350px;
                overflow: hidden;
            }
            .product-gallery img {
                width: 100%;
                height: auto;
                max-height: 350px;
                object-fit: contain;
            }
            .product-gallery-thumbnails {
                display: flex;
                overflow-x: auto;
                gap: 8px;
                padding: 8px 0;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
            }
            .product-gallery-thumbnails::-webkit-scrollbar {
                display: none;
            }
            .product-gallery-thumbnails .product-gallery__thumbnail {
                flex: 0 0 60px;
                height: 60px;
                object-fit: cover;
                border-radius: 6px;
                border: 2px solid transparent;
                cursor: pointer;
                transition: border-color 0.2s;
            }
            .product-gallery-thumbnails .product-gallery__thumbnail.active {
                border-color: var(--primary_color);
            }
            .product-gallery-nav {
                display: none;
            }
        }

        }

        .for-total-price {
            margin- {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: -30%;
        }

        .feature_header span {
            padding- {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 15px;
        }

        .flash-deals-background-image {
            background: {{ $web_config['primary_color'] }}10;
        }

        @media (max-width: 768px) {
            .for-total-price {
                padding- {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 30%;
            }

            .product-quantity {
                padding- {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 4%;
            }

            .for-margin-bnt-mobile {
                margin- {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 7px;
            }

        }

        @media (max-width: 375px) {
            .for-margin-bnt-mobile {
                margin- {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 3px;
            }

            .for-discount {
                margin- {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 10% !important;
            }

            .for-dicount-div {
                margin-top: -5%;
                margin- {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: -7%;
            }

            .product-quantity {
                margin- {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 4%;
            }

        }

        @media (max-width: 500px) {
            .for-dicount-div {
                margin- {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: -5%;
            }

            .for-total-price {
                margin- {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: -20%;
            }

            .view-btn-div {
                float: {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }};
            }

            .for-discount {
                margin- {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 7%;
            }

            .for-mobile-capacity {
                margin- {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 7%;
            }
        }
    </style>
    <style>
        table {
            width: 100%
        }
        .__inline-23 thead {
            color: black
        }
    </style>

@endpush

@section('content')
    <?php
    $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);
    $rating = \App\CPU\ProductManager::get_rating($product->reviews);
    $decimal_point_settings = \App\CPU\Helpers::get_business_settings('decimal_point_settings');
    ?>
    <div class="__inline-23">
        <!-- Page Content-->
        <div class="container mt-4 rtl" style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
            <!-- General info tab-->
            <div class="row {{ Session::get('direction') === 'rtl' ? '__dir-rtl' : '' }}">
                <!-- Product gallery-->
                <div class="col-lg-9 col-12">
                    <div class="row">
                        <div class="col-lg-5 col-md-4 col-12">
                            <div class="cz-product-gallery">
                                <div class="cz-preview">
                                    @if ($product->images != null && json_decode($product->images) > 0)
                                        @if (json_decode($product->colors) && $product->color_image)
                                            @foreach (json_decode($product->color_image) as $key => $photo)
                                                @if ($photo->color != null)
                                                    <div class="cz-preview-item d-flex align-items-center justify-content-center {{ $key == 0 ? 'active' : '' }}"
                                                        id="image{{ $photo->color }}">
                                                        <img class=" img-responsive w-100 __max-h-323px"
                                                            onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                            src="{{ asset(env('PUBLIC_STORAGE_PATH') . "/product/$photo->image_name") }}"
                                                            data-zoom="{{ asset(env('PUBLIC_STORAGE_PATH') . "/product/$photo->image_name") }}"
                                                            alt="Product image" width="">
                                                        
                                                    </div>
                                                @else
                                                    <div class="cz-preview-item d-flex align-items-center justify-content-center {{ $key == 0 ? 'active' : '' }}"
                                                        id="image{{ $key }}">
                                                        <img class=" img-responsive w-100 __max-h-323px"
                                                            onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                            src="{{ asset(env('PUBLIC_STORAGE_PATH') . "/product/$photo->image_name") }}"
                                                            data-zoom="{{ asset(env('PUBLIC_STORAGE_PATH') . "/product/$photo->image_name") }}"
                                                            alt="Product image" width="">
                                                        
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach (json_decode($product->images) as $key => $photo)
                                                <div class="cz-preview-item d-flex align-items-center justify-content-center {{ $key == 0 ? 'active' : '' }}"
                                                    id="image{{ $key }}">
                                                    <img class=" img-responsive w-100 __max-h-323px"
                                                        onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                        src="{{ asset(env('PUBLIC_STORAGE_PATH') . "/product/$photo") }}"
                                                        data-zoom="{{ asset(env('PUBLIC_STORAGE_PATH') . "/product/$photo") }}"
                                                        alt="Product image" width="">
                                                    
                                                </div>
                                            @endforeach
                                        @endif
                                    @endif
                                </div>
                                <div class="cz">
                                    <div class="table-responsive __max-h-515px" data-simplebar>
                                        <div class="d-flex">
                                            @if ($product->images != null && json_decode($product->images) > 0)
                                                @if (json_decode($product->colors) && $product->color_image)
                                                    @foreach (json_decode($product->color_image) as $key => $photo)
                                                        @if ($photo->color != null)
                                                            <div class="cz-thumblist">
                                                                <a class="cz-thumblist-item  {{ $key == 0 ? 'active' : '' }} d-flex align-items-center justify-content-center"
                                                                    id="preview-img{{ $photo->color }}"
                                                                    href="#image{{ $photo->color }}">
                                                                    <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                                        src="{{ asset(env('PUBLIC_STORAGE_PATH') . "/product/$photo->image_name") }}"
                                                                        alt="Product thumb">
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="cz-thumblist">
                                                                <a class="cz-thumblist-item  {{ $key == 0 ? 'active' : '' }} d-flex align-items-center justify-content-center"
                                                                    id="preview-img{{ $key }}"
                                                                    href="#image{{ $key }}">
                                                                    <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                                        src="{{ asset(env('PUBLIC_STORAGE_PATH') . "/product/$photo->image_name") }}"
                                                                        alt="Product thumb">
                                                                </a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach (json_decode($product->images) as $key => $photo)
                                                        <div class="cz-thumblist">
                                                            <a class="cz-thumblist-item  {{ $key == 0 ? 'active' : '' }} d-flex align-items-center justify-content-center"
                                                                id="preview-img{{ $key }}"
                                                                href="#image{{ $key }}">
                                                                <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                                    src="{{ asset(env('PUBLIC_STORAGE_PATH') . "/product/$photo") }}"
                                                                    alt="Product thumb">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product details-->
                        <div class="col-lg-7 col-md-8 col-12 mt-md-0 mt-sm-3"
                            style="direction: {{ Session::get('direction') }}">
                            <div class="details __h-100">
                                <span class="mb-2 __inline-24">{{ $product->name }}</span>
                                <div class="d-flex flex-wrap align-items-center mb-2 pro">
                                    <span
                                        class="d-inline-block  align-middle mt-1 {{ Session::get('direction') === 'rtl' ? 'ml-md-2 ml-sm-0 pl-2' : 'mr-md-2 mr-sm-0 pr-2' }} __color-FE961C">{{ $overallRating[0] }}</span>
                                    <div class="star-rating"
                                        style="{{ Session::get('direction') === 'rtl' ? 'margin-left: 25px;' : 'margin-right: 25px;' }}">
                                        @for ($inc = 0; $inc < 5; $inc++)
                                            @if ($inc < $overallRating[0])
                                                <i class="sr-star czi-star-filled active"></i>
                                            @else
                                                <i class="sr-star czi-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span
                                        class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{ Session::get('direction') === 'rtl' ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1' }}">{{ $overallRating[1] }}
                                        {{ \App\CPU\translate('Reviews') }}</span>
                                    <span class="__inline-25"></span>
                                    <span
                                        class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{ Session::get('direction') === 'rtl' ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1' }}">{{ $countOrder }}
                                        {{ \App\CPU\translate('orders') }} </span>
                                    <span class="__inline-25"> </span>
                                    <span
                                        class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{ Session::get('direction') === 'rtl' ? 'mr-1 ml-md-2 ml-0 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-0 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1' }} text-capitalize">
                                        {{ $countWishlist }} {{ \App\CPU\translate('wish_listed') }} </span>

                                </div>
                                <div class="mb-3">
                                    @if ($product->discount > 0)
                                        <strike style="color: #E96A6A;"
                                            class="{{ Session::get('direction') === 'rtl' ? 'ml-1' : 'mr-3' }}">
                                            {{ \App\CPU\Helpers::currency_converter($product->unit_price) }}
                                        </strike>
                                    @endif
                                    <span class="h3 font-weight-normal text-accent ">
                                        {{ \App\CPU\Helpers::get_price_range($product) }}
                                    </span>
                                    <span
                                        class="{{ Session::get('direction') === 'rtl' ? 'mr-2' : 'ml-2' }} __text-12px font-regular">
                                        (<span>{{ \App\CPU\translate('tax') }} : </span>
                                        <span id="set-tax-amount"></span>)
                                    </span>
                                </div>

                                <form id="add-to-cart-form" class="mb-2">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <div
                                        class="position-relative {{ Session::get('direction') === 'rtl' ? 'ml-n4' : 'mr-n4' }} mb-2">
                                        @if (count(json_decode($product->colors)) > 0)
                                            <div class="flex-start">
                                                <div class="product-description-label mt-2 text-body">
                                                    {{ \App\CPU\translate('color') }}:
                                                </div>
                                                <div>
                                                    <ul class="list-inline checkbox-color mb-1 flex-start {{ Session::get('direction') === 'rtl' ? 'mr-2' : 'ml-2' }}"
                                                        style="padding-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 0;">
                                                        @foreach (json_decode($product->colors) as $key => $color)
                                                            <div>
                                                                <li>
                                                                    <input type="radio"
                                                                        id="{{ $product->id }}-color-{{ str_replace('#', '', $color) }}"
                                                                        name="color" value="{{ $color }}"
                                                                        @if ($key == 0) checked @endif>
                                                                    <label style="background: {{ $color }};"
                                                                        for="{{ $product->id }}-color-{{ str_replace('#', '', $color) }}"
                                                                        data-toggle="tooltip"
                                                                        onclick="focus_preview_image_by_color('{{ str_replace('#', '', $color) }}')">
                                                                        <span class="outline"></span></label>
                                                                </li>
                                                            </div>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                        @php
                                            $qty = 0;
                                            if (!empty($product->variation)) {
                                                foreach (json_decode($product->variation) as $key => $variation) {
                                                    $qty += $variation->qty;
                                                }
                                            }
                                        @endphp
                                    </div>
                                    @foreach (json_decode($product->choice_options) as $key => $choice)
                                        <div class="row flex-start mx-0">
                                            <div
                                                class="product-description-label text-body mt-2 {{ Session::get('direction') === 'rtl' ? 'pl-2' : 'pr-2' }}">
                                                {{ $choice->title }}
                                                :
                                            </div>
                                            <div>
                                                <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2 mx-1 flex-start row"
                                                    style="padding-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 0;">
                                                    @foreach ($choice->options as $key => $option)
                                                        <div>
                                                            <li class="for-mobile-capacity">
                                                                <input type="radio"
                                                                    id="{{ $choice->name }}-{{ $option }}"
                                                                    name="{{ $choice->name }}"
                                                                    value="{{ $option }}"
                                                                    @if ($key == 0) checked @endif>
                                                                <label class="__text-12px"
                                                                    for="{{ $choice->name }}-{{ $option }}">{{ $option }}</label>
                                                            </li>
                                                        </div>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Quantity + Add to cart -->
                                    <div class="mt-2">
                                        <div class="product-quantity d-flex flex-wrap align-items-center __gap-15">
                                            <div class="d-flex align-items-center">
                                                <div class="product-description-label text-body mt-2">
                                                    {{ \App\CPU\translate('Quantity') }}:</div>
                                                <div class="d-flex justify-content-center align-items-center __w-160px"
                                                    style="color: {{ $web_config['primary_color'] }}">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-number __p-10" type="button"
                                                            data-type="minus" data-field="quantity" disabled="disabled"
                                                            style="color: {{ $web_config['primary_color'] }}">
                                                            -
                                                        </button>
                                                    </span>
                                                    <input type="text" name="quantity"
                                                        class="form-control input-number text-center cart-qty-field __inline-29"
                                                        placeholder="1" value="{{ $product->minimum_order_qty ?? 1 }}"
                                                        product-type="{{ $product->product_type }}"
                                                        min="{{ $product->minimum_order_qty ?? 1 }}" max="100">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-number __p-10" type="button"
                                                            product-type="{{ $product->product_type }}" data-type="plus"
                                                            data-field="quantity"
                                                            style="color: {{ $web_config['primary_color'] }}">
                                                            +
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div id="chosen_price_div">
                                                <div
                                                    class="d-flex justify-content-center align-items-center {{ Session::get('direction') === 'rtl' ? 'ml-2' : 'mr-2' }}">
                                                    <div class="product-description-label">
                                                        <strong>{{ \App\CPU\translate('total_price') }}</strong> : </div>
                                                    &nbsp; <strong id="chosen_price"></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters d-none mt-2 flex-start d-flex">
                                        <div class="col-12">
                                            @if ($product['product_type'] == 'physical' && $product['current_stock'] <= 0)
                                                <h5 class="mt-3 text-danger">{{ \App\CPU\translate('out_of_stock') }}
                                                </h5>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Variant Out of Stock Message -->
                                    <div id="variant-out-of-stock" class="d-none mt-2">
                                        <h5 class="text-danger font-weight-bold">
                                            <i class="tio-warning"></i> {{ \App\CPU\translate('out_of_stock') }}
                                        </h5>
                                    </div>

                                    <div class="__btn-grp mt-2 mb-3">
                                        @if (
                                            ($product->added_by == 'seller' &&
                                                ($seller_temporary_close ||
                                                    (isset($product->seller->shop) &&
                                                        $product->seller->shop->vacation_status &&
                                                        $current_date >= $seller_vacation_start_date &&
                                                        $current_date <= $seller_vacation_end_date))) ||
                                                ($product->added_by == 'admin' &&
                                                    ($inhouse_temporary_close ||
                                                        ($inhouse_vacation_status &&
                                                            $current_date >= $inhouse_vacation_start_date &&
                                                            $current_date <= $inhouse_vacation_end_date))))
                                            <button class="btn btn-secondary" type="button" disabled>
                                                {{ \App\CPU\translate('buy_now') }}
                                            </button>
                                            <button class="btn btn--primary string-limit" type="button" disabled>
                                                {{ \App\CPU\translate('add_to_cart') }}
                                            </button>
                                        @else
                                            <button
                                                class="btn btn-secondary element-center __iniline-26 btn-gap-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }} btn-buy-now"
                                                onclick="buy_now()" type="button">
                                                <span class="string-limit">{{ \App\CPU\translate('buy_now') }}</span>
                                            </button>
                                            <button
                                                class="btn btn--primary element-center btn-gap-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }} btn-add-to-cart"
                                                onclick="addToCart()" type="button">
                                                <span class="string-limit">{{ \App\CPU\translate('add_to_cart') }}</span>
                                            </button>
                                            <button
                                                class="btn btn-danger element-center btn-oos d-none" type="button" disabled>
                                                <span class="string-limit">{{ \App\CPU\translate('out_of_stock') }}</span>
                                            </button>
                                        @endif
                                        <button type="button" onclick="addWishlist('{{ $product['id'] }}')"
                                            class="btn __text-18px text-danger">
                                            <i class="fa fa-heart-o " aria-hidden="true"></i>
                                            <span
                                                class="countWishlist-{{ $product['id'] }}">{{ $countWishlist }}</span>
                                        </button>
                                        @if (
                                            ($product->added_by == 'seller' &&
                                                ($seller_temporary_close ||
                                                    (isset($product->seller->shop) &&
                                                        $product->seller->shop->vacation_status &&
                                                        $current_date >= $seller_vacation_start_date &&
                                                        $current_date <= $seller_vacation_end_date))) ||
                                                ($product->added_by == 'admin' &&
                                                    ($inhouse_temporary_close ||
                                                        ($inhouse_vacation_status &&
                                                            $current_date >= $inhouse_vacation_start_date &&
                                                            $current_date <= $inhouse_vacation_end_date))))
                                            <div class="alert alert-danger" role="alert">
                                                {{ \App\CPU\translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now') }}
                                            </div>
                                        @endif
                                    </div>
                                </form>

                                <!-- <div style="text-align:{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};"
                                        class="sharethis-inline-share-buttons"></div> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="rtl col-12"
                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                            <div class="row">
                                <div class="col-12">
                                    <div class="">
                                        <!-- Tabs-->
                                        <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link __inline-27 active " href="#overview"
                                                    data-toggle="tab" role="tab">
                                                    {{ \App\CPU\translate('overview') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link __inline-27" href="#reviews" data-toggle="tab"
                                                    role="tab">
                                                    {{ \App\CPU\translate('reviews') }}
                                                </a>
                                            </li>
                                        </ul>
                                        <div
                                            class="px-4 pt-lg-3 pb-3 mb-3 mr-0 mr-md-2 bg-white __review-overview __rounded-10">
                                            <div class="tab-content px-lg-3">
                                                <!-- Tech specs tab-->
                                                <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                                    <div class="row pt-2 specification">
                                                        @if ($product->video_url != null)
                                                            <div class="col-12 mb-4">
                                                                <iframe width="420" height="315"
                                                                    src="{{ $product->video_url }}">
                                                                </iframe>
                                                            </div>
                                                        @endif

                                                        <div class="text-body col-lg-12 col-md-12 overflow-scroll">
                                                            {!! $product['details'] !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                @php($reviews_of_product = App\Model\Review::where('product_id', $product->id)->paginate(2))
                                                <!-- Reviews tab-->
                                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                                    @if($reviews_of_product->count() > 0)
                                                    <div class="row pt-2 pb-3">
                                                        <div class="col-lg-4 col-md-5 ">
                                                            <div
                                                                class=" row d-flex justify-content-center align-items-center">
                                                                <div
                                                                    class="col-12 d-flex justify-content-center align-items-center">
                                                                    <h2 class="overall_review mb-2 __inline-28">
                                                                        {{ $overallRating[1] }}
                                                                    </h2>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center star-rating ">
                                                                    @if (round($overallRating[0]) == 5)
                                                                        @for ($i = 0; $i < 5; $i++)
                                                                            <i
                                                                                class="czi-star-filled font-size-sm text-accent {{ Session::get('direction') === 'rtl' ? 'ml-1' : 'mr-1' }}"></i>
                                                                        @endfor
                                                                    @endif
                                                                    @if (round($overallRating[0]) == 4)
                                                                        @for ($i = 0; $i < 4; $i++)
                                                                            <i
                                                                                class="czi-star-filled font-size-sm text-accent {{ Session::get('direction') === 'rtl' ? 'ml-1' : 'mr-1' }}"></i>
                                                                        @endfor
                                                                        <i
                                                                            class="czi-star font-size-sm text-muted {{ Session::get('direction') === 'rtl' ? 'ml-1' : 'mr-1' }}"></i>
                                                                    @endif
                                                                    @if (round($overallRating[0]) == 3)
                                                                        @for ($i = 0; $i < 3; $i++)
                                                                            <i
                                                                                class="czi-star-filled font-size-sm text-accent {{ Session::get('direction') === 'rtl' ? 'ml-1' : 'mr-1' }}"></i>
                                                                        @endfor
                                                                        @for ($j = 0; $j < 2; $j++)
                                                                            <i
                                                                                class="czi-star font-size-sm text-accent {{ Session::get('direction') === 'rtl' ? 'ml-1' : 'mr-1' }}"></i>
                                                                        @endfor
                                                                    @endif
                                                                    @if (round($overallRating[0]) == 2)
                                                                        @for ($i = 0; $i < 2; $i++)
                                                                            <i
                                                                                class="czi-star-filled font-size-sm text-accent {{ Session::get('direction') === 'rtl' ? 'ml-1' : 'mr-1' }}"></i>
                                                                        @endfor
                                                                        @for ($j = 0; $j < 3; $j++)
                                                                            <i
                                                                                class="czi-star font-size-sm text-accent {{ Session::get('direction') === 'rtl' ? 'ml-1' : 'mr-1' }}"></i>
                                                                        @endfor
                                                                    @endif
                                                                    @if (round($overallRating[0]) == 1)
                                                                        @for ($i = 0; $i < 4; $i++)
                                                                            <i
                                                                                class="czi-star font-size-sm text-accent {{ Session::get('direction') === 'rtl' ? 'ml-1' : 'mr-1' }}"></i>
                                                                        @endfor
                                                                        <i
                                                                            class="czi-star-filled font-size-sm text-accent {{ Session::get('direction') === 'rtl' ? 'ml-1' : 'mr-1' }}"></i>
                                                                    @endif
                                                                    @if (round($overallRating[0]) == 0)
                                                                        @for ($i = 0; $i < 5; $i++)
                                                                            <i
                                                                                class="czi-star font-size-sm text-muted {{ Session::get('direction') === 'rtl' ? 'ml-1' : 'mr-1' }}"></i>
                                                                        @endfor
                                                                    @endif
                                                                </div>
                                                                <div
                                                                    class="col-12 d-flex justify-content-center align-items-center mt-2">
                                                                    <span class="text-center">
                                                                        {{ $reviews_of_product->total() }}
                                                                        {{ \App\CPU\translate('ratings') }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 col-md-7 pt-sm-3 pt-md-0">
                                                            <div class="d-flex align-items-center mb-2 font-size-sm">
                                                                <div class="__rev-txt"><span
                                                                        class="d-inline-block align-middle text-body">{{ \App\CPU\translate('Excellent') }}</span>
                                                                </div>
                                                                <div class="w-0 flex-grow">
                                                                    <div class="progress text-body __h-5px">
                                                                        <div class="progress-bar " role="progressbar"
                                                                            style="background-color: {{ $web_config['primary_color'] }} !important;width: <?php echo $widthRating = $rating[0] != 0 ? ($rating[0] / $overallRating[1]) * 100 : 0; ?>%;"
                                                                            aria-valuenow="60" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-1 text-body">
                                                                    <span
                                                                        class=" {{ Session::get('direction') === 'rtl' ? 'mr-3 float-left' : 'ml-3 float-right' }} ">
                                                                        {{ $rating[0] }}
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                                <div class="__rev-txt"><span
                                                                        class="d-inline-block align-middle ">{{ \App\CPU\translate('Good') }}</span>
                                                                </div>
                                                                <div class="w-0 flex-grow">
                                                                    <div class="progress __h-5px">
                                                                        <div class="progress-bar" role="progressbar"
                                                                            style="background-color: {{ $web_config['primary_color'] }} !important;width: <?php echo $widthRating = $rating[1] != 0 ? ($rating[1] / $overallRating[1]) * 100 : 0; ?>%; background-color: #a7e453;"
                                                                            aria-valuenow="27" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-1">
                                                                    <span
                                                                        class="{{ Session::get('direction') === 'rtl' ? 'mr-3 float-left' : 'ml-3 float-right' }}">
                                                                        {{ $rating[1] }}
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                                <div class="__rev-txt"><span
                                                                        class="d-inline-block align-middle ">{{ \App\CPU\translate('Average') }}</span>
                                                                </div>
                                                                <div class="w-0 flex-grow">
                                                                    <div class="progress __h-5px">
                                                                        <div class="progress-bar" role="progressbar"
                                                                            style="background-color: {{ $web_config['primary_color'] }} !important;width: <?php echo $widthRating = $rating[2] != 0 ? ($rating[2] / $overallRating[1]) * 100 : 0; ?>%; background-color: #ffda75;"
                                                                            aria-valuenow="17" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-1">
                                                                    <span
                                                                        class="{{ Session::get('direction') === 'rtl' ? 'mr-3 float-left' : 'ml-3 float-right' }}">
                                                                        {{ $rating[2] }}
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                                <div class="__rev-txt "><span
                                                                        class="d-inline-block align-middle">{{ \App\CPU\translate('Below Average') }}</span>
                                                                </div>
                                                                <div class="w-0 flex-grow">
                                                                    <div class="progress __h-5px">
                                                                        <div class="progress-bar" role="progressbar"
                                                                            style="background-color: {{ $web_config['primary_color'] }} !important;width: <?php echo $widthRating = $rating[3] != 0 ? ($rating[3] / $overallRating[1]) * 100 : 0; ?>%; background-color: #fea569;"
                                                                            aria-valuenow="9" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-1">
                                                                    <span
                                                                        class="{{ Session::get('direction') === 'rtl' ? 'mr-3 float-left' : 'ml-3 float-right' }}">
                                                                        {{ $rating[3] }}
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex align-items-center text-body font-size-sm">
                                                                <div class="__rev-txt"><span
                                                                        class="d-inline-block align-middle ">{{ \App\CPU\translate('Poor') }}</span>
                                                                </div>
                                                                <div class="w-0 flex-grow">
                                                                    <div class="progress __h-5px">
                                                                        <div class="progress-bar" role="progressbar"
                                                                            style="background-color: {{ $web_config['primary_color'] }} !important;backbround-color:{{ $web_config['primary_color'] }};width: <?php echo $widthRating = $rating[4] != 0 ? ($rating[4] / $overallRating[1]) * 100 : 0; ?>%;"
                                                                            aria-valuenow="4" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-1">
                                                                    <span
                                                                        class="{{ Session::get('direction') === 'rtl' ? 'mr-3 float-left' : 'ml-3 float-right' }}">
                                                                        {{ $rating[4] }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="row pb-4 mb-3">
                                                        <div class="__inline-30">
                                                            <span
                                                                class="text-capitalize">{{ \App\CPU\translate('Product Review') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row pb-4">
                                                        <div class="col-12" id="product-review-list">
                                                            {{-- @foreach ($reviews_of_product as $productReview) --}}
                                                            {{-- @include('web-views.partials.product-reviews',['productRevie'=>$productRevie]) --}}
                                                            {{-- @endforeach --}}
                                                            @if (count($product->reviews) == 0)
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h6 class=" text-center m-0" style="color:gray">
                                                                            {{ \App\CPU\translate('product_review_not_available') }}
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </div>  
                                                        @if (count($product->reviews) > 2)
                                                            <div class="col-12">
                                                                <div
                                                                    class="card-footer d-flex justify-content-center align-items-center">
                                                                    <button class="btn text-white"
                                                                        style="background: {{ $web_config['primary_color'] }};"
                                                                        onclick="load_review()">{{ \App\CPU\translate('view more') }}</button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 ">
                    <!-- Pincode Modal Trigger -->
                    <div class="product-details-shipping-details mb-3 cursor-pointer" style="cursor:pointer;" data-toggle="modal" data-target="#pincodeModal">
                        <div class="shipping-details-bottom-border">
                            <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fa fa-map-marker text-primary mr-2"></i>
                                    <span class="font-weight-bold">{{ \App\CPU\translate('Check Delivery Info') }}</span>
                                </div>
                                <div>
                                    <span id="pincode-status-text" class="text-muted"><i class="czi-arrow-right"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-details-shipping-details">
                        <div class="shipping-details-bottom-border">
                            <div class="px-3 py-3">
                                <img class="{{ Session::get('direction') === 'rtl' ? 'float-right ml-2' : 'mr-2' }} __img-20"
                                    src="{{ asset('assets/front-end/png/Payment.png') }}" alt="">
                                <span>{{ \App\CPU\translate('Safe Payment') }}</span>
                            </div>
                        </div>
                        <div class="shipping-details-bottom-border">
                            <div class="px-3 py-3">
                                <img class="{{ Session::get('direction') === 'rtl' ? 'float-right ml-2' : 'mr-2' }} __img-20"
                                    src="{{ asset('assets/front-end/png/money.png') }}" alt="">
                                <span>{{ \App\CPU\translate('7 Days Return Policy') }}</span>
                            </div>
                        </div>
                        <div class="shipping-details-bottom-border">
                            <div class="px-3 py-3">
                                <img class="{{ Session::get('direction') === 'rtl' ? 'float-right ml-2' : 'mr-2' }} __img-20"
                                    src="{{ asset('assets/front-end/png/Genuine.png') }}" alt="">
                                <span>{{ \App\CPU\translate('100% Authentic Products') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Other Vendors at Lower Price --}}
                    @if(isset($otherVendorProducts) && count($otherVendorProducts) > 0)
                        <style>
                            .ov-section { margin-top: 30px; }
                            .ov-header {
                                display: flex; align-items: center; gap: 12px;
                                margin-bottom: 16px; padding-bottom: 12px;
                                border-bottom: 2px solid #e8f5e9;
                            }
                            .ov-header-icon {
                                width: 40px; height: 40px; border-radius: 10px;
                                background: linear-gradient(135deg, #43a047, #66bb6a);
                                display: flex; align-items: center; justify-content: center;
                                color: #fff; font-size: 18px;
                            }
                            .ov-header h4 { margin: 0; font-size: 18px; font-weight: 700; color: #333; }
                            .ov-header p { margin: 0; font-size: 12px; color: #888; }
                            .ov-card {
                                border: 1px solid #e0e0e0; border-radius: 12px;
                                background: #fff; overflow: hidden; margin-bottom: 12px;
                                transition: all 0.3s ease; cursor: pointer; position: relative;
                            }
                            .ov-card:hover {
                                border-color: #43a047;
                                box-shadow: 0 4px 20px rgba(67,160,71,0.15);
                                transform: translateY(-2px);
                            }
                            .ov-card-inner {
                                display: flex; align-items: stretch; padding: 0;
                            }
                            .ov-card-img {
                                width: 110px; min-height: 110px; flex-shrink: 0;
                                display: flex; align-items: center; justify-content: center;
                                background: #f9f9f9; border-right: 1px solid #eee;
                                padding: 8px;
                            }
                            .ov-card-img img {
                                max-width: 100%; max-height: 250px; object-fit: contain;
                            }
                            .ov-card-body {
                                flex: 1; padding: 12px 16px; display: flex;
                                flex-direction: column; justify-content: center; gap: 4px;
                            }
                            .ov-seller-name {
                                font-size: 12px; color: #666; display: flex;
                                align-items: center; gap: 4px;
                            }
                            .ov-seller-name i { font-size: 12px; color: #43a047; }
                            .ov-price-row {
                                display: flex; align-items: baseline; gap: 8px; flex-wrap: wrap;
                            }
                            .ov-price { font-size: 18px; font-weight: 700; color: #333; }
                            .ov-price-old { font-size: 13px; color: #999; text-decoration: line-through; }
                            .ov-badge {
                                display: inline-flex; align-items: center; gap: 4px;
                                font-size: 11px; font-weight: 600; padding: 3px 8px;
                                border-radius: 20px; width: fit-content;
                            }
                            .ov-badge-save { background: #e8f5e9; color: #2e7d32; }
                            .ov-badge-same { background: #f3f4f6; color: #6b7280; }
                            .ov-badge-more { background: #fce4ec; color: #c62828; }
                            .ov-stock-badge {
                                position: absolute; top: 8px; right: 8px;
                                font-size: 10px; padding: 2px 8px; border-radius: 4px;
                            }
                            .ov-rating { display: flex; align-items: center; gap: 4px; }
                            .ov-rating i { font-size: 10px; }
                            .ov-rating span { font-size: 11px; color: #999; }
                            .ov-btn {
                                display: inline-flex; align-items: center; gap: 4px;
                                background: #43a047; color: #fff; border: none; border-radius: 6px;
                                padding: 6px 14px; font-size: 12px; font-weight: 600;
                                text-decoration: none; transition: background 0.2s;
                            }
                            .ov-btn:hover { background: #388e3c; color: #fff; text-decoration: none; }
                            @media (max-width: 576px) {
                               
                                .ov-card-img { width: auto; min-height: 60px; border-right: none; border-bottom: 1px solid #eee; }
                                .ov-card-body { padding: 12px; }
                            }
                        </style>
                        <div class="ov-section">
                            <div class="ov-header">
                                <div class="ov-header-icon">
                                    <i class="tio-store"></i>
                                </div>
                                <div>
                                    <h4>{{ \App\CPU\translate('Available from Other Vendors') }}</h4>
                                    <p>{{ count($otherVendorProducts) }} {{ \App\CPU\translate('seller(s) have this product') }}</p>
                                </div>
                            </div>
                            @foreach ($otherVendorProducts as $ovProduct)
                                @php($savings = $product->unit_price - $ovProduct->unit_price)
                                @php($ovDiscountPrice = $ovProduct->unit_price - \App\CPU\Helpers::get_product_discount($ovProduct, $ovProduct->unit_price))
                                @php($ovRating = \App\CPU\ProductManager::get_overall_rating($ovProduct->reviews))
                                <div class="ov-card" onclick="window.location='{{ route('product', $ovProduct->slug) }}'">
                                    @if($ovProduct['current_stock'] <= 0)
                                        <span class="ov-stock-badge badge badge-danger">{{ \App\CPU\translate('Stock Out') }}</span>
                                    @endif
                                    <div class="ov-card-inner">
                                        <div class="ov-card-img">
                                            <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $ovProduct->thumbnail }}"
                                                alt="{{ $ovProduct->name }}">
                                        </div>
                                        <div class="ov-card-body">
                                            <div class="ov-seller-name">
                                                <i class="tio-store"></i>
                                                @if($ovProduct->seller && $ovProduct->seller->shop)
                                                    {{ $ovProduct->seller->shop->name }}
                                                @else
                                                    {{ \App\CPU\translate('Admin') }}
                                                @endif
                                            </div>
                                            <div class="ov-price-row">
                                                <span class="ov-price">{{ \App\CPU\Helpers::currency_converter($ovDiscountPrice) }}</span>
                                                @if($ovProduct->discount > 0)
                                                    <span class="ov-price-old">{{ \App\CPU\Helpers::currency_converter($ovProduct->unit_price) }}</span>
                                                @endif
                                            </div>
                                            <div class="ov-rating">
                                                @for($i = 0; $i < 5; $i++)
                                                    @if($i < $ovRating[0])
                                                        <i class="czi-star-filled" style="color:#f59e0b;"></i>
                                                    @else
                                                        <i class="czi-star" style="color:#d1d5db;"></i>
                                                    @endif
                                                @endfor
                                                <span>({{ $ovRating[1] }} {{ \App\CPU\translate('reviews') }})</span>
                                            </div>
                                            @if($savings > 0)
                                                <div class="ov-badge ov-badge-save">
                                                    <i class="tio-arrow-circle-down"></i>
                                                    {{ \App\CPU\translate('Save') }} {{ \App\CPU\Helpers::currency_converter($savings) }}
                                                </div>
                                            @elseif($savings == 0)
                                                <div class="ov-badge ov-badge-same">
                                                    {{ \App\CPU\translate('Same price as current') }}
                                                </div>
                                            @else
                                                <div class="ov-badge ov-badge-more">
                                                    {{ \App\CPU\Helpers::currency_converter(abs($savings)) }} {{ \App\CPU\translate('more') }}
                                                </div>
                                            @endif
                                            <div style="margin-top:6px;">
                                                <a href="{{ route('product', $ovProduct->slug) }}" class="ov-btn" onclick="event.stopPropagation();">
                                                    {{ \App\CPU\translate('View from this Seller') }}
                                                    <i class="tio-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="row flex-between">
                        <div class="text-capitalize font-bold __text-30px"
                            style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 5px;' : 'margin-left: 5px;' }}">
                            <span>{{ \App\CPU\translate('similar_products') }}</span>
                        </div>

                        <div class="view_all d-flex justify-content-center align-items-center">
                            <div>
                                @php($category = json_decode($product['category_ids']))
                                @if ($category)
                                    <a class="text-capitalize view-all-text"
                                        style="color:{{ $web_config['primary_color'] }} !important;{{ Session::get('direction') === 'rtl' ? 'margin-left:10px;' : 'margin-right: 8px;' }}"
                                        href="{{ route('products', ['id' => $category[0]->id, 'data_from' => 'category', 'page' => 1]) }}">{{ \App\CPU\translate('view_all') }}
                                        <i
                                            class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 ' : 'right ml-1 mr-n1' }}"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Grid-->

                    <!-- Product-->
                    <div class="row mt-4 row-cols-xl-1 row-cols-lg-1 row-cols-md-1 row-cols-1">
                        @if (count($relatedProducts) > 0)
                            @foreach ($relatedProducts->take(5) as $key => $relatedProduct)
                                <div class=" px-3 py-1">
                                    @include('web-views.partials._inline-single-product', [
                                        'product' => $relatedProduct,
                                        'decimal_point_settings' => $decimal_point_settings,
                                    ])
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6>{{ \App\CPU\translate('similar') }}
                                            {{ \App\CPU\translate('product_not_available') }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if (isset($recentlyViewed) && count($recentlyViewed) > 0)
                        <div class="row flex-between mt-4">
                            <div class="text-capitalize font-bold __text-30px"
                                style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 5px;' : 'margin-left: 5px;' }}">
                                <span>{{ \App\CPU\translate('recently_viewed') }}</span>
                            </div>
                        </div>

                        <div class="row mt-4 row-cols-xl-1 row-cols-lg-1 row-cols-md-1 row-cols-1">
                            @foreach ($recentlyViewed as $rv)
                                @if($rv->product)
                                    <div class=" p-3">
                                        @include('web-views.partials._inline-single-product', [
                                            'product' => $rv->product,
                                            'decimal_point_settings' => $decimal_point_settings,
                                        ])
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    

    <!-- Pincode Check Modal -->
    <div class="modal fade rtl" id="pincodeModal" tabindex="-1" role="dialog" aria-labelledby="pincodeModalLabel" aria-hidden="true" style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pincodeModalLabel">{{ \App\CPU\translate('Select Delivery Address') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-4">
                    <p class="font-weight-bold text-dark mb-3">{{ \App\CPU\translate('Use pin code to check delivery info') }}</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="w-100 {{ Session::get('direction') === 'rtl' ? 'ml-2' : 'mr-2' }}">
                            <input type="text" id="delivery_pincode_input" class="form-control" placeholder="{{ \App\CPU\translate('Enter pin code') }}">
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary text-white" style="background:#d1d1d1; font-weight:bold; border:none;" id="check_delivery_pincode_btn">{{ \App\CPU\translate('Submit') }}</button>
                        </div>
                    </div>
                    <div id="pincode_check_result" class="mt-2"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade rtl" id="show-modal-view" tabindex="-1" role="dialog" aria-labelledby="show-modal-image"
        aria-hidden="true" style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body flex justify-content-center">
                    <button class="btn btn-default __inline-33"
                        style="{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: -7px;"
                        data-dismiss="modal">
                        <i class="fa fa-close"></i>
                    </button>
                    <img class="element-center" id="attachment-view" src="">
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        cartQuantityInitialize();
        getVariantPrice();
        $('#add-to-cart-form input').on('change', function() {
            getVariantPrice();
        });

        function showInstaImage(link) {
            $("#attachment-view").attr("src", link);
            $('#show-modal-view').modal('toggle')
        }

        function focus_preview_image_by_color(key) {
            $('a[href="#image' + key + '"]')[0].click();
        }
    </script>
    <script>
        $(document).ready(function() {
            load_review();
        });
        let load_review_count = 1;

        function load_review() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: '{{ route('review-list-product') }}',
                data: {
                    product_id: {{ $product->id }},
                    offset: load_review_count
                },
                success: function(data) {
                    $('#product-review-list').append(data.productReview)
                    if (data.not_empty == 0 && load_review_count > 2) {
                        toastr.info('{{ \App\CPU\translate('no more review remain to load') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        console.log('iff');
                    }
                }
            });
            load_review_count++
        }
    </script>

    {{-- Messaging with shop seller --}}
    <script>
        $('#contact-seller').on('click', function(e) {
            // $('#seller_details').css('height', '200px');
            $('#seller_details').animate({
                'height': '276px'
            });
            $('#msg-option').css('display', 'block');
        });
        $('#sendBtn').on('click', function(e) {
            e.preventDefault();
            let msgValue = $('#msg-option').find('textarea').val();
            let data = {
                message: msgValue,
                shop_id: $('#msg-option').find('textarea').attr('shop-id'),
                seller_id: $('.msg-option').find('.seller_id').attr('seller-id'),
            }
            if (msgValue != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: '{{ route('messages_store') }}',
                    data: data,
                    success: function(respons) {
                        console.log('send successfully');
                    }
                });
                $('#chatInputBox').val('');
                $('#msg-option').css('display', 'none');
                $('#contact-seller').find('.contact').attr('disabled', '');
                $('#seller_details').animate({
                    'height': '125px'
                });
                $('#go_to_chatbox').css('display', 'block');
            } else {
                console.log('say something');
            }
        });
        $('#cancelBtn').on('click', function(e) {
            e.preventDefault();
            $('#seller_details').animate({
                'height': '114px'
            });
            $('#msg-option').css('display', 'none');
        });
    </script>

    <script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=5f55f75bde227f0012147049&product=sticky-share-buttons"
        async="async"></script>

    <script>
        $('#check_delivery_pincode_btn').on('click', function() {
            let pincode = $('#delivery_pincode_input').val();
            if (pincode === '') {
                toastr.warning('{{ \App\CPU\translate('Please enter a pin code') }}');
                return;
            }
            
            $('#check_delivery_pincode_btn').attr('disabled', true).text('{{ \App\CPU\translate('Wait...') }}');
            $('#pincode_check_result').html('');

            $.ajax({
                type: "post",
                url: '{{ route('check-pincode') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    pincode: pincode
                },
                success: function(response) {
                    $('#check_delivery_pincode_btn').removeAttr('disabled').text('{{ \App\CPU\translate('Submit') }}');
                    if (response.status === 'success' && response.serviceable) {
                        $('#pincode_check_result').html('<div class="text-success mt-2 font-weight-bold"><i class="fa fa-check-circle"></i> {{ \App\CPU\translate('Delivery available in this area.') }}</div>');
                        $('#pincode-status-text').html('<span class="text-success font-weight-bold">' + pincode + '</span>');
                        $('#delivery_pincode_input').css('border-color', '#28a745');
                        setTimeout(function() {
                            $('#pincodeModal').modal('hide');
                        }, 2500);
                    } else {
                        $('#pincode_check_result').html('<div class="text-danger mt-2 font-weight-bold"><i class="fa fa-times-circle"></i> {{ \App\CPU\translate('Delivery not available in this area.') }}</div>');
                        $('#pincode-status-text').html('<span class="text-danger font-weight-bold">' + pincode + '</span>');
                        $('#delivery_pincode_input').css('border-color', '#dc3545');
                    }
                },
                error: function() {
                    $('#check_delivery_pincode_btn').removeAttr('disabled').text('{{ \App\CPU\translate('Submit') }}');
                    $('#pincode_check_result').html('<div class="text-danger mt-2 font-weight-bold"><i class="fa fa-exclamation-circle"></i> {{ \App\CPU\translate('Error checking pin code.') }}</div>');
                }
            });
        });
    </script>
@endpush

