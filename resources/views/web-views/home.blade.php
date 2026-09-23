@extends('layouts.front-end.app')

@section('title', $web_config['name']->value . ' ' . \App\CPU\translate('Online Shopping') . ' | ' .
    $web_config['name']->value . ' ' . \App\CPU\translate(' Ecommerce'))

    @push('css_or_js')
        <meta property="og:image"
            content="{{ asset(config('app.public_storage_path') . '/company') }}/{{ $web_config['web_logo']->value }}" />
        <meta property="og:title" content="Welcome To {{ $web_config['name']->value }} Home" />
        <meta property="og:url" content="{{ env('APP_URL') }}">
        <meta property="og:description" content="{!! substr($web_config['about']->value, 0, 100) !!}">

        <meta property="twitter:card"
            content="{{ asset(config('app.public_storage_path') . '/company') }}/{{ $web_config['web_logo']->value }}" />
        <meta property="twitter:title" content="Welcome To {{ $web_config['name']->value }} Home" />
        <meta property="twitter:url" content="{{ env('APP_URL') }}">
        <meta property="twitter:description" content="{!! substr($web_config['about']->value, 0, 100) !!}">

        <link rel="stylesheet" href="{{ asset('assets/front-end') }}/css/home.css" />
        <style>
            .cz-countdown-days {
                border: .5px solid var(--primary_color);
            }

            .btn-scroll-top {
                background: var(--primary_color);
            }

            .__best-selling:hover .ptr,
            .flash_deal_product:hover .flash-product-title {
                color: var(--primary_color);
            }

            .cz-countdown-hours {
                border: .5px solid var(--primary_color);
            }

            .cz-countdown-minutes {
                border: .5px solid var(--primary_color);
            }

            .cz-countdown-seconds {
                border: .5px solid var(--primary_color);
            }

            .flash_deal_product_details .flash-product-price {
                color: var(--primary_color);
            }

            .featured_deal_left {
                background: var(--primary_color) 0% 0% no-repeat padding-box;
            }

            .category_div:hover {
                color: var(--primary_color);
            }

            .deal_of_the_day {
                background: var(--primary_color);
            }

            .best-selleing-image {
                background: var(--primary_color)10;
            }

            .top-rated-image {
                background: var(--primary_color)10;
            }

            @media (max-width: 800px) {
                .categories-view-all {
                        {
                            {
                            session('direction')==="rtl" ? 'margin-left: 10px;': 'margin-right: 6px;'
                        }
                    }
                }

                .categories-title {
                        {
                            {
                            Session: :get('direction')==="rtl" ? 'margin-right: 0px;': 'margin-left: 6px;'
                        }
                    }
                }

                .seller-list-title {
                        {
                            {
                            Session: :get('direction')==="rtl" ? 'margin-right: 0px;': 'margin-left: 10px;'
                        }
                    }
                }

                .seller-list-view-all {
                        {
                            {
                            Session: :get('direction')==="rtl" ? 'margin-left: 20px;': 'margin-right: 10px;'
                        }
                    }
                }

                .category-product-view-title {
                        {
                            {
                            Session: :get('direction')==="rtl" ? 'margin-right: 16px;': 'margin-left: -8px;'
                        }
                    }
                }

                .category-product-view-all {
                        {
                            {
                            Session: :get('direction')==="rtl" ? 'margin-left: -7px;': 'margin-right: 5px;'
                        }
                    }
                }
            }

            @media (min-width: 801px) {
                .categories-view-all {
                        {
                            {
                            session('direction')==="rtl" ? 'margin-left: 30px;': 'margin-right: 27px;'
                        }
                    }
                }

                .categories-title {
                        {
                            {
                            Session: :get('direction')==="rtl" ? 'margin-right: 25px;': 'margin-left: 25px;'
                        }
                    }
                }

                .seller-list-title {
                        {
                            {
                            Session: :get('direction')==="rtl" ? 'margin-right: 6px;': 'margin-left: 10px;'
                        }
                    }
                }

                .seller-list-view-all {
                        {
                            {
                            Session: :get('direction')==="rtl" ? 'margin-left: 12px;': 'margin-right: 10px;'
                        }
                    }
                }

                .seller-card {
                        {
                            {
                            Session: :get('direction')==="rtl" ? 'padding-left:0px !important;': 'padding-right:0px !important;'
                        }
                    }
                }

                .category-product-view-title {
                        {
                            {
                            Session: :get('direction')==="rtl" ? 'margin-right: 10px;': 'margin-left: -12px;'
                        }
                    }
                }

                .category-product-view-all {
                        {
                            {
                            Session: :get('direction')==="rtl" ? 'margin-left: -20px;': 'margin-right: 0px;'
                        }
                    }
                }
            }

            .countdown-card {
                background: {{ $web_config['primary_color'] }}10;

            }

            .flash-deal-text {
                color: var(--primary_color);
            }

            .countdown-background {
                background: #00695c;
            }

            }

            .czi-arrow-left {
                color: var(--primary_color);
                background: var(--primary_color)10;
            }

            .czi-arrow-right {
                color: var(--primary_color);
                background: var(--primary_color)10;
            }

            .flash-deals-background-image {
                background: var(--primary_color)10;
            }

            .view-all-text {
                color: var(--primary_color) !important;
            }

            .feature-product .czi-arrow-left {
                color: var(--primary_color);
                background: var(--primary_color)10
            }

            .feature-product .czi-arrow-right {
                color: var(--primary_color);
                background: var(--primary_color)10;
                font-size: 12px;
            }

            .block-policy2 {
                border: 1px solid #ebebeb;
                border-radius: 3px;
                padding: 22px 0 15px 0;
                margin: 40px 0;
                display: inline-block;
                width: 100%;
            }

            .block-policy2 ul {
                list-style: none;
                padding: 6px;
            }

            .block-policy2 ul li {
                float: left;
                padding: 0 15px;
                text-align: center;
                width: 25%;

                position: relative;
                margin: 10px 0;
                /* min-width: 240px; */
                font-size: 14px;
            }

            .block-policy2 ul li:before {
                background: #ebebeb none repeat scroll 0 0;
                content: "";
                height: 50px;
                position: absolute;
                right: 0;
                top: 3px;
                width: 1px;
            }

            .block-policy2 ul li .item-inner {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .block-policy2 ul li .item-inner .policy-icon {
                width: 60px;
                height: 52px;
                object-fit: contain;
                float: left;
                margin-right: 10px;
            }

            .block-policy2 ul li .item-inner .content {
                float: left;
                text-align: left;
                margin-top: 3px;
            }

            .block-policy2 ul li .item-inner .content a {
                color: #333;
                font-weight: 700;
                text-transform: uppercase;
            }

            .block-policy2 ul li .item-inner .content p {
                line-height: 100%;
                margin: 0;
                text-transform: capitalize;
            }

            @media (min-width: 768px) and (max-width: 991px) {
                .block-policy2 ul li {
                    width: 33.33%;
                }
            }

            @media (min-width: 420px) and (max-width: 767.99px) {
                .block-policy2 {
                    border: none;
                    background: linear-gradient(135deg, #f0faf2 0%, #e8f5e9 100%);
                    border-radius: 12px;
                    padding: 12px 8px;
                    margin: 16px 0;
                }

                .block-policy2 ul {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 10px;
                    padding: 0;
                    margin: 0;
                }

                .block-policy2 ul li {
                    float: none;
                    width: auto;
                    padding: 10px 6px;
                    margin: 0;
                    text-align: center;
                    background: #fff;
                    border-radius: 10px;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
                    position: relative;
                }

                .block-policy2 ul li:before {
                    display: none;
                }

                .block-policy2 ul li .item-inner {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    gap: 6px;
                }

                .block-policy2 ul li .item-inner .policy-icon {
                    float: none;
                    margin-right: 0;
                    width: 44px;
                    height: 38px;
                }

                .block-policy2 ul li .item-inner .content {
                    float: none;
                    text-align: center;
                    margin-top: 0;
                }

                .block-policy2 ul li .item-inner .content a {
                    font-size: 11px;
                    font-weight: 700;
                    letter-spacing: 0.3px;
                    line-height: 1.3;
                    display: block;
                    color: #1a5c2a;
                }

                .block-policy2 ul li .item-inner .content p {
                    font-size: 10px;
                    color: #666;
                    margin-top: 2px;
                    line-height: 1.2;
                }
            }

            @media (max-width: 419px) {
                .block-policy2 {
                    border: none;
                    background: linear-gradient(135deg, #f0faf2 0%, #e8f5e9 100%);
                    border-radius: 12px;
                    padding: 12px 8px;
                    margin: 16px 0;
                }

                .block-policy2 ul {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 10px;
                    padding: 0;
                    margin: 0;
                }

                .block-policy2 ul li {
                    float: none;
                    width: auto;
                    padding: 12px 6px;
                    margin: 0;
                    text-align: center;
                    background: #fff;
                    border-radius: 10px;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
                    position: relative;
                }

                .block-policy2 ul li:before {
                    display: none;
                }

                .block-policy2 ul li .item-inner {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    gap: 5px;
                }

                .block-policy2 ul li .item-inner .policy-icon {
                    float: none;
                    margin-right: 0;
                    width: 50px;
                    height: 44px;
                }

                .block-policy2 ul li .item-inner .content {
                    float: none;
                    text-align: center;
                    margin-top: 0;
                }

                .block-policy2 ul li .item-inner .content a {
                    font-size: 10px;
                    font-weight: 700;
                    letter-spacing: 0.2px;
                    line-height: 1.2;
                    display: block;
                    color: #1a5c2a;
                }

                .block-policy2 ul li .item-inner .content p {
                    font-size: 9px;
                    color: #666;
                    margin-top: 2px;
                    line-height: 1.2;
                }
            }
        </style>

        <link rel="stylesheet" href="{{ asset('assets/front-end') }}/css/owl.carousel.min.css" />
        <link rel="stylesheet" href="{{ asset('assets/front-end') }}/css/owl.theme.default.min.css" />

        <style>
            .mobile-sticky-category {
                position: -webkit-sticky;
                position: sticky;
                top: 0;
                z-index: 9;
                background: #fff;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
                padding: 8px 0;
                border-bottom: 1px solid #f0f0f0;
                width: 100%;
                max-width: 100%;
                box-sizing: border-box;
            }

            .mobile-sticky-category .owl-stage {
                display: flex;
                align-items: center;
            }

            .mobile-sticky-category .cate-item {
                padding: 0 12px;
                text-decoration: none;
                color: #333;
                display: block;
                text-align: center;
                border-right: 1px solid #f0f0f0;
            }

            .mobile-sticky-category .owl-item:last-child .cate-item {
                border-right: none;
            }

            .mobile-sticky-category .cate-item img {
                width: 50px;
                height: 50px;
                object-fit: cover;
                border-radius: 50%;
                margin: 0 auto 4px;
                display: block;
            }

            .mobile-sticky-category .cate-item span {
                text-align: center;
                line-height: 1.2;
                /* max-width: 70px; */
                overflow: hidden;
                font-size: 10px;
                color: #555;
                display: block;
                font-weight: 900;
            }

            @media (min-width: 769px) {
                .mobile-sticky-category {
                    display: none !important;
                }
            }
        </style>
    @endpush

@section('content')

    <div class="__inline-61">
        @php($decimal_point_settings = !empty(\App\CPU\Helpers::get_business_settings('decimal_point_settings')) ? \App\CPU\Helpers::get_business_settings('decimal_point_settings') : 0)
        <!-- Hero (Banners + Slider)-->
        @php($main_banner = \App\Model\Banner::where('banner_type','Main Banner')->where('published',1)->orderBy('id','desc')->get())
        @if(isset($main_banner) && count($main_banner) > 0)
        <section class="bh-home-section bh-home-section-t bg-transparent">
            <div class="container-fluid px-0">
                <div class="row m-0">
                    <div class="col-12 p-0">
                        @include('web-views.partials._home-top-slider')
                    </div>
                </div>
            </div>
        </section>
        @endif



        <!-- Section 04: Shop by Crop (Crop-First Discovery) -->
     
        @php($business_mode = \App\CPU\Helpers::get_business_settings('business_mode'))
        {{-- categries --}}

        @if (isset($categories) && count($categories) > 0)
            @if ($business_mode == 'multi')
                <div class="mobile-sticky-category owl-carousel py-2" id="mobile-category-slider">
                    @foreach ($categories as $category)
                        <a class="cate-item"
                            href="{{ route('products', ['id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}">
                            <img src="{{ asset(config('app.public_storage_path') . '/category/' . $category->icon) }}"
                                onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                alt="{{ $category->name }}">
                            <span>{{ $category->name }}</span>
                        </a>
                    @endforeach
                </div>
                <div class="bh-home-section container d-lg-block d-none">
                    <div class="row">
                        <div class="col-md-12 mb-0">
                            <div class="border-0 bg-transparent h-100">
                                <div class="card-body p-0">
                                    <div class="bh-section-header">
                                        <div class="bh-section-title-wrap">
                                            <h3 class="bh-section-title">{{ \App\CPU\translate('categories') }}</h3>
                                        </div>
                                        <a class="bh-view-all-link" href="{{ route('categories') }}">
                                            {{ \App\CPU\translate('view_all') }}
                                            <i class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}"></i>
                                        </a>
                                    </div>
                                    <div class="carousel-wrap ">
                                        <div class=" mt-3 owl-carousel owl-theme" id="categorylist_slider">
                                            @foreach ($categories as $key => $category)
                                                @if ($key < 12)
                                                    <div class="text-center  __cate-item ">
                                                        <a
                                                            href="{{ route('products', ['id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}">
                                                            <div class="__img overflow-hidden rounded-circle" style="margin: 0 auto;"  >
                                                                <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                                    src="{{ asset(config('app.public_storage_path') . '/category/' . $category->icon) }}"
                                                                    alt="{{ $category->name }}">
                                                            </div>
                                                            <p class="text-center  mt-2">{{ $category->name }}
                                                            </p>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <div class="bh-home-section container d-none d-md-block">
                    <div class=" border-0 h-100 pb-0">
                        <div class="card-body p-0">
                            <div class="bh-section-header">
                                <div class="bh-section-title-wrap">
                                    <h3 class="bh-section-title">{{ \App\CPU\translate('categories') }}</h3>
                                </div>
                                <a class="bh-view-all-link" href="{{ route('categories') }}">
                                    {{ \App\CPU\translate('view_all') }}
                                    <i class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}"></i>
                                </a>
                            </div>
                            <div class="carousel-wrap ">
                                <div class=" mt-3 owl-carousel owl-theme" id="categorylist_slider">
                                    @foreach ($categories as $key => $category)
                                        @if ($key < 6)
                                            <div class="text-center __cate-item">
                                                <a
                                                    href="{{ route('products', ['id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}">
                                                    <div class="__img">
                                                        <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                            src="{{ asset(config('app.public_storage_path') . '/category/' . $category->icon) }}"
                                                            alt="{{ $category->name }}">
                                                        <p class="text-center small mt-1">
                                                            {{ Str::limit($category->name, 12) }}</p>
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif

    @if (isset($recentlyViewed) && count($recentlyViewed) > 0)
        <div class="bh-home-section container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bh-section-header px-0">
                        <div class="bh-section-title-wrap">
                            <h3 class="bh-section-title">{{ \App\CPU\translate('recently_viewed') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="feature-product">
                        <div class="carousel-wrap p-1">
                            <div class="owl-carousel owl-theme " id="recently_viewed_products_list">
                                @foreach ($recentlyViewed as $rv)
                                    @if ($rv->product && $rv->product->indexing == 1)
                                        <div>
                                            @include('web-views.partials._feature-product', [
                                                'product' => $rv->product,
                                                'decimal_point_settings' => $decimal_point_settings,
                                            ])
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (isset($bestSellProduct) && count($bestSellProduct) > 0)
        <div class="bh-home-section container rtl">
            <div class="row m-0">

                <!-- Best Selling -->
                <div class="col-12 p-0">
                    <div class="h-100">
                        <div class="card-body p-0">

                            <div class="bh-section-header">
                                <div class="bh-section-title-wrap">
                                    <img class="bh-section-icon" src="{{ asset('assets/front-end/png/best sellings.png') }}" alt="Best Sellings">
                                    <h3 class="bh-section-title">Best Sellings</h3>
                                </div>
                            </div>

                            <div class="row g-3">
                                @foreach ($bestSellProduct as $key => $bestSell)
                                    @if ($bestSell && $bestSell->product)
                                        @php($product = $bestSell->product)
                                        <div class="col-xxl-2 col-xl-2-4 col-lg-2-4 col-md-4 col-sm-4 col-6 mb-3 px-2">
                                            @include('web-views.partials._single-product', [
                                                'product' => $product,
                                                'decimal_point_settings' => $decimal_point_settings,
                                            ])
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif

    {{-- flash deal --}}
    @php(
    $flash_deals = \App\Model\FlashDeal::with([
        'products' => function ($query) {
            $query->with('product')->whereHas('product', function ($q) {
                $q->active();
            });
        }
    ])->where(['status' => 1])->where(['deal_type' => 'flash_deal'])->whereDate('start_date', '<=', date('Y-m-d'))->whereDate('end_date', '>=', date('Y-m-d'))->first()
)

    @if (isset($flash_deals) && isset($flash_deals->products) && count($flash_deals->products) > 0)
        <section class="bh-home-section overflow-hidden">
            <div class="container">
                <div class="flash-deal-view-all-web row d-none d-lg-flex justify-content-{{ Session::get(key: 'direction') === 'rtl' ? 'start' : 'end' }}"
                    style="{{ Session::get('direction') === 'rtl' ? 'margin-left: 2px;' : 'margin-right:2px;' }}">
                    @if (count($flash_deals->products) > 0)
                        <a class="text-capitalize view-all-text"
                            href="{{ route('flash-deals', [isset($flash_deals) ? $flash_deals['id'] : 0]) }}">
                            {{ \App\CPU\translate('view_all') }}
                            <i
                                class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1' }}"></i>
                        </a>
                    @endif
                </div>
                <div class="row d-flex {{ Session::get('direction') === 'rtl' ? 'flex-row-reverse' : 'flex-row' }}">


                    <div class="col-xl-3 col-lg-4 mt-2 countdown-card">
                        <div class="m-2">
                            <div class="flash-deal-text">
                                <span>{{ \App\CPU\translate('flash deal') }}</span>
                            </div>
                            <div class="text-center text-white">
                                <div class="countdown-background">
                                    <span class="cz-countdown d-flex justify-content-center align-items-center"
                                        data-countdown="{{ isset($flash_deals) ? date('m/d/Y', strtotime($flash_deals['end_date'])) : '' }} 11:59:00 PM">
                                        <span class="cz-countdown-days">
                                            <span class="cz-countdown-value"></span>
                                            <span>{{ \App\CPU\translate('day') }}</span>
                                        </span>
                                        <span class="cz-countdown-value p-1">:</span>
                                        <span class="cz-countdown-hours">
                                            <span class="cz-countdown-value"></span>
                                            <span>{{ \App\CPU\translate('hrs') }}</span>
                                        </span>
                                        <span class="cz-countdown-value p-1">:</span>
                                        <span class="cz-countdown-minutes">
                                            <span class="cz-countdown-value"></span>
                                            <span>{{ \App\CPU\translate('min') }}</span>
                                        </span>
                                        <span class="cz-countdown-value p-1">:</span>
                                        <span class="cz-countdown-seconds">
                                            <span class="cz-countdown-value"></span>
                                            <span>{{ \App\CPU\translate('sec') }}</span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flash-deal-view-all-mobile col-lg-12 d-block d-xl-none"
                        style="{{ Session::get('direction') === 'rtl' ? 'margin-left: 2px;' : 'margin-right:2px;' }}">
                    </div>
                    <div class="col-xl-9 col-lg-8 {{ Session::get('direction') === 'rtl' ? 'pr-md-4' : 'pl-md-4' }}">
                        <div class="d-lg-none {{ Session::get('direction') === 'rtl' ? 'text-left' : 'text-right' }}">
                            <a class="mt-2 text-capitalize view-all-text"
                                href="{{ route('flash-deals', [isset($flash_deals) ? $flash_deals['id'] : 0]) }}">
                                {{ \App\CPU\translate('view_all') }}
                                <i
                                    class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1' }}"></i>
                            </a>
                        </div>
                        <div class="carousel-wrap">
                            <div class="owl-carousel owl-theme mt-2" id="flash-deal-slider">
                                @foreach ($flash_deals->products as $key => $deal)
                                    @if ($deal->product)
                                        @include('web-views.partials._product-card-1', [
                                            'product' => $deal->product,
                                            'decimal_point_settings' => $decimal_point_settings,
                                        ])
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

     {{-- New Arrivals --}}
    @if (isset($latest_products) && count($latest_products) > 0)
        <div class="bh-home-section container rtl">
            <div class=" h-100">
                <div class="card-body p-0">
                    <div class="bh-section-header">
                        <div class="bh-section-title-wrap">
                            <img class="bh-section-icon" src="{{ asset('assets/front-end/png/new-arrivals.png') }}" alt="New Arrivals">
                            <h3 class="bh-section-title">{{ \App\CPU\translate('new_arrivals') }}</h3>
                        </div>
                        <a class="bh-view-all-link" href="{{ route('newProduct') }}">
                            {{ \App\CPU\translate('view_all') }}
                            <i class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}"></i>
                        </a>
                    </div>
                    <div class="owl-carousel owl-theme" id="new-arrivals-slider">
                        @foreach ($latest_products as $product)
                            <div class="item">
                                @include('web-views.partials._single-product', [
                                    'product' => $product,
                                    'decimal_point_settings' => $decimal_point_settings ?? 2,
                                ])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- featured deal --}}
    @php(
    $featured_deals = \App\Model\FlashDeal::with([
        'products' => function ($query_one) {
            $query_one->with('product.reviews')->whereHas('product', function ($query_two) {
                $query_two->active();
            });
        }
    ])->whereDate('start_date', '<=', date('Y-m-d'))->whereDate('end_date', '>=', date('Y-m-d'))->where(['status' => 1])->where(['deal_type' => 'feature_deal'])->first()
)

    @if (isset($featured_deals) && isset($featured_deals->products) && count($featured_deals->products) > 0)
        <section class="bh-home-section featured_deal rtl" style="background: rgb(234 245 241 / 10);">
            <div class="container">
                <div class="row __featured-deal-wrap" style="background: {{ $web_config['primary_color'] }};">
                    <div class="col-12 pb-2">
                        @if (count($featured_deals->products) > 0)
                            <div
                                class="{{ Session::get('direction') === 'rtl' ? 'text-left ml-lg-3' : 'text-right mr-lg-3' }}">
                                <a class="text-capitalize text-white"
                                    href="{{ route('products', ['data_from' => 'featured_deal']) }}">
                                    {{ \App\CPU\translate('view_all') }}
                                    <i
                                        class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1' : 'right ml-1' }} text-white"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="m-lg-4 mb-4">
                            <span class="featured_deal_title __pt-12">{{ \App\CPU\translate('featured_deal') }}</span>
                            <br>

                            <span
                                class="text-white text-left">{{ \App\CPU\translate('See the latest deals and exciting new offers') }}!</span>

                        </div>

                    </div>

                    <div
                        class="col-xl-9 col-lg-8 d-flex align-items-center justify-content-center {{ Session::get('direction') === 'rtl' ? 'pl-md-4' : 'pr-md-4' }}">
                        <div class="owl-carousel owl-theme" id="web-feature-deal-slider">
                            @foreach ($featured_deals->products as $key => $product)
                                @include('web-views.partials._feature-deal-product', [
                                    'product' => $product->product,
                                    'decimal_point_settings' => $decimal_point_settings,
                                ])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    {{-- Dynamic Banner Section above Brands --}}
        @php($main_section_banners = \App\Model\Banner::where('banner_type', 'Brand Section Banner')->where('published', 1)->orderBy('id', 'desc')->get())
        @if ($main_section_banners->count() == 0)
            @php($main_section_banners = \App\Model\Banner::where('banner_type', 'Main Section Banner')->where('published', 1)->orderBy('id', 'desc')->get())
        @endif
        @if ($main_section_banners->count() == 0)
            @php($main_section_banners = \App\Model\Banner::where('published', 1)->orderBy('id', 'desc')->take(4)->get())
        @endif

        @if (isset($main_section_banners) && count($main_section_banners) > 0)
            <div class='bh-home-section container-fluid px-0'>
                <div class="row m-0">
                    <div class="col-md-12 p-0">
                        <div class="carousel-wrap">
                            <div class="owl-carousel owl-theme" id="main_section_banner_slider">
                                @foreach ($main_section_banners as $mainbanner)
                                    <div class="item">
                                        <a href="{{ $mainbanner->url && $mainbanner->url != '#' ? $mainbanner->url : 'javascript:' }}"
                                            class="d-block">
                                            <img class="d-block w-100 rounded __shadow-sm"
                                                style="max-height: 280px; object-fit: cover;"
                                                onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                src="{{ asset(config('app.public_storage_path') . '/banner') }}/{{ $mainbanner['photo'] }}"
                                                alt="Banner">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    {{-- brands --}}
    @if ($brand_setting && isset($brands) && count($brands) > 0)
        <section class="bh-home-section rtl " style="background: rgb(234 245 241 / 10);">
            <!-- Heading-->
            <div class="container">
                <div class="bh-section-header px-0">
                    <div class="bh-section-title-wrap">
                        <h3 class="bh-section-title">{{ \App\CPU\translate('brands') }}</h3>
                    </div>
                    <a class="bh-view-all-link" href="{{ route('brands') }}">
                        {{ \App\CPU\translate('view_all') }}
                        <i class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}"></i>
                    </a>
                </div>
            </div>
            <div class="container-fluid">
                <div class="brand-slider">
                    <div class="owl-carousel owl-theme py-2" id="brands-slider">
                        @foreach ($brands as $brand)
                            <div class="px-1">
                                <a href="{{ route('products', ['id' => $brand['id'], 'data_from' => 'brand', 'page' => 1]) }}"
                                    class="bh-brand-box">
                                    <img src="{{ asset(config('app.public_storage_path') . '/brand/' . $brand->image) }}"
                                        onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                        alt="{{ $brand->name }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (isset($latest_products) && count($latest_products) > 0)
        <div class="bh-home-section container rtl">
            {{-- Latest products --}}
            <div class="col-xl-12 col-md-12 p-0 mt-2">
                <div class="latest-product-margin">
                    <div class="bh-section-header px-0">
                        <div class="bh-section-title-wrap">
                            <h3 class="bh-section-title">{{ \App\CPU\translate('latest_products') }}</h3>
                        </div>
                        <a class="bh-view-all-link" href="{{ route('products', ['data_from' => 'latest']) }}">
                            {{ \App\CPU\translate('view_all') }}
                            <i class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}"></i>
                        </a>
                    </div>

                    <div class="row mt-0 g-3 d-none d-sm-flex" style="overflow:hidden;">
                        @foreach ($latest_products->take(12) as $product)
                            <div class="col-xxl-2 col-xl-2-4 col-lg-2-4 col-md-4 col-sm-4 col-6 mb-3 px-2">
                                @include('web-views.partials._single-product', [
                                    'product' => $product,
                                    'decimal_point_settings' => $decimal_point_settings,
                                ])
                            </div>
                        @endforeach
                    </div>

                        <div class="d-block d-sm-none mt-2">
                            <div class="owl-carousel owl-theme" id="latest-products-slider">
                                @foreach ($latest_products as $product)
                                    <div class="p-1">
                                        @include('web-views.partials._single-product', [
                                            'product' => $product,
                                            'decimal_point_settings' => $decimal_point_settings,
                                        ])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
    @endif
    <div class="bh-home-section container-fluid px-0">
        <div class="banners banners2">
            <div class="banner">
                <a href="#" class="w-100"><img src="{{ asset('assets/front-end/img/id2-banner2.png') }}" alt="image" class="w-100"></a>
            </div>
        </div>
    </div>
    {{-- delivery type --}}

    <section class="bh-home-section so-page-builder">
        <div class="container" style="padding:0;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_pfg8  col-style">
                <div class="block-policy2">
                    <ul>
                        <li class="item-2">
                            <div class="item-inner">
                                <img class="policy-icon" src="{{ asset('assets/front-end/img/policy/price.png') }}" alt="Best Price">
                                <div class="content">
                                    <a href="#">{{ \App\CPU\translate('Best Price Assured') }}</a>
                                    <p>{{ \App\CPU\translate('Guaranteed Lowest') }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="item-3">
                            <div class="item-inner">
                                <img class="policy-icon" src="{{ asset('assets/front-end/img/policy/advice.png') }}" alt="Expert Advice">
                                <div class="content">
                                    <a href="#">{{ \App\CPU\translate('Expert Advice') }}</a>
                                    <p>{{ \App\CPU\translate('Support 24/7') }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="item-4">
                            <div class="item-inner">
                                <img class="policy-icon" src="{{ asset('assets/front-end/img/policy/safe_secure.png') }}" alt="Safe & Secure">
                                <div class="content">
                                    <a href="#">{{ \App\CPU\translate('Safe & Secure Payment') }}</a>
                                    <p>{{ \App\CPU\translate('100% Protected') }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="item-5">
                            <div class="item-inner">
                                <img class="policy-icon" src="{{ asset('assets/front-end/img/policy/original.png') }}" alt="Original Products">
                                <div class="content">
                                    <a href="#">{{ \App\CPU\translate('Original Products') }}</a>
                                    <p>{{ \App\CPU\translate('100% Genuine') }}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>
    {{-- Banner  --}}
    
    @php($footer_banners = \App\Model\Banner::where('banner_type', 'Footer Banner')->where('published', 1)->orderBy('id', 'desc')->get())
    @if(isset($footer_banners) && count($footer_banners) > 0)
    <div class="bh-home-section container-fluid px-0">
        <div class="row m-0 __inline-62">

            <div class="col-md-12 p-0">
                <div class="feature-product">
                    <div class="carousel-wrap p-1">
                        <div class="owl-carousel owl-theme " id="footer_banner_list">
                            
                            @foreach ($footer_banners as $banner)
                                <div class="col-md-12 p-0">


                                    <a href="{{ $banner->url }}" class="d-block">
                                        <img class="footer_banner_img w-100"
                                            onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                            src="{{ asset(config('app.public_storage_path') . '/banner') }}/{{ $banner['photo'] }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    </div>
@endsection

@push('script')
    {{-- Owl Carousel --}}
    <script src="{{ asset('assets/front-end/js/owl.carousel.min.js') }}"></script>

    <script>
        $('#flash-deal-slider').owlCarousel({
            loop: false,
            autoplay: false,
            margin: 20,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session('direction') }}': false,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 2
                },
                //Large
                992: {
                    items: 2
                },
                //Extra large
                1200: {
                    items: 2
                },
                //Extra extra large
                1400: {
                    items: 3
                }
            }
        })

        $('#web-feature-deal-slider').owlCarousel({
            loop: false,
            autoplay: true,
            margin: 20,
            nav: false,
            //navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session(' direction ') }}': true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 2
                },
                //Large
                992: {
                    items: 2
                },
                //Extra large
                1200: {
                    items: 2
                },
                //Extra extra large
                1400: {
                    items: 2
                }
            }
        })


        $('#featured_products_list').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 15,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session(' direction ') }}': true,
            responsive: {
                0: { items: 2, margin: 8 },
                360: { items: 2, margin: 10 },
                576: { items: 3, margin: 12 },
                768: { items: 3, margin: 15 },
                992: { items: 5, margin: 15 },
                1200: { items: 5, margin: 15 },
                1400: { items: 6, margin: 15 }
            }
        });

        $('#recently_viewed_products_list').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            smartSpeed: 800,
            margin: 15,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session('direction') }}': true,
            responsive: {
                0: { items: 2, margin: 8 },
                360: { items: 2, margin: 10 },
                576: { items: 3, margin: 12 },
                768: { items: 3, margin: 15 },
                992: { items: 5, margin: 15 },
                1200: { items: 5, margin: 15 },
                1400: { items: 6, margin: 15 }
            }
        });

        $('#new-arrivals-slider').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 15,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session('direction') }}': true,
            responsive: {
                0: { items: 2, margin: 8 },
                360: { items: 2, margin: 10 },
                576: { items: 3, margin: 12 },
                768: { items: 3, margin: 15 },
                992: { items: 5, margin: 15 },
                1200: { items: 5, margin: 15 },
                1400: { items: 6, margin: 15 }
            }
        });

        $('#mobile-category-slider').owlCarousel({
            loop: false,
            autoplay: false,
            margin: 0,
            nav: false,
            dots: false,
            pullDrag: true,
            freeDrag: false,
            mouseDrag: true,
            touchDrag: true,
            responsive: {
                0: {
                    items: 3
                },
                480: {
                    items: 5
                },
                640: {
                    items: 6
                }
            }
        });

        $('#categorylist_slider').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            smartSpeed: 800,
            margin: 50,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session('direction') }}': true,
            responsive: {
                0: {
                    items: 1,
                    margin: 10,
                },
                360: {
                    items: 2,
                    margin: 10,
                },
                375: {
                    items: 2,
                    margin: 10,
                },
                425: {
                    items: 2,
                    margin: 10,
                },
                540: {
                    items: 2,
                    margin: 10,
                },
                576: {
                    items: 2,
                    margin: 10,
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 5
                },
                1400: {
                    items: 6
                }
            }
        });

        $('#main_section_banner').owlCarousel({
            loop: true,
            autoplay: false,
            margin: 20,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session(' direction ') }}': false,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
                    items: 1
                },
                //Small
                576: {
                    items: 1
                },
                //Medium
                768: {
                    items: 2
                },
                //Large
                992: {
                    items: 2
                },
                //Extra large
                1200: {
                    items: 2
                },
                //Extra extra large
                1400: {
                    items: 3
                }
            }
        });

        $('#footer_banner_list').owlCarousel({
            loop: true,
            autoplay: false,
            margin: 50,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session(' direction ') }}': false,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 2
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 1
                },
                //Large
                992: {
                    items: 1
                },
                //Extra large
                1200: {
                    items: 4
                },
                //Extra extra large
                1400: {
                    items: 4
                }
            }
        });

        $('#brands-slider').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            margin: 12,
            nav: false,
            dots: false,
            autoplayHoverPause: true,
            responsive: {
                0: { items: 3, margin: 8 },
                360: { items: 3, margin: 8 },
                576: { items: 5, margin: 10 },
                768: { items: 7, margin: 12 },
                992: { items: 8, margin: 12 },
                1200: { items: 9, margin: 12 },
                1400: { items: 10, margin: 12 }
            }
        });

        $('#category-slider, #top-seller-slider').owlCarousel({
            loop: false,
            autoplay: false,
            margin: 20,
            nav: false,
            // navText: ["<i class='czi-arrow-left'></i>","<i class='czi-arrow-right'></i>"],
            dots: true,
            autoplayHoverPause: true,
            '{{ session('direction ') }}': true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 2
                },
                360: {
                    items: 3
                },
                375: {
                    items: 3
                },
                540: {
                    items: 4
                },
                //Small
                576: {
                    items: 5
                },
                //Medium
                768: {
                    items: 6
                },
                //Large
                992: {
                    items: 8
                },
                //Extra large
                1200: {
                    items: 10
                },
                //Extra extra large
                1400: {
                    items: 11
                }
            }
        })

        $('#latest-products-slider').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            margin: 10,
            nav: false,
            dots: true,
            autoplayHoverPause: true,
            '{{ session('direction') }}': true,
            responsive: {
                0: {
                    items: 2
                },
                360: {
                    items: 2
                },
                375: {
                    items: 2
                },
                480: {
                    items: 2
                }
            }
        });

        $('#main_section_banner_slider, #footer_banner_list').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 3500,
            margin: 10,
            nav: false,
            dots: true,
            autoplayHoverPause: true,
            '{{ session('direction') }}': true,
            responsive: {
                0: {
                    items: 1
                }
            }
        });
    </script>

    <script>
        function updateStickyCategoryTop() {
            var header = document.querySelector('.navbar-sticky');
            var catBar = document.querySelector('.mobile-sticky-category');
            if (header && catBar) {
                var headerHeight = header.offsetHeight;
                catBar.style.top = headerHeight + 'px';
            }
        }
        updateStickyCategoryTop();
        window.addEventListener('resize', updateStickyCategoryTop);
        var observer = new MutationObserver(updateStickyCategoryTop);
        var header = document.querySelector('.navbar-sticky');
        if (header) {
            observer.observe(header, {
                attributes: true,
                attributeFilter: ['class', 'style']
            });
        }
    </script>
@endpush
