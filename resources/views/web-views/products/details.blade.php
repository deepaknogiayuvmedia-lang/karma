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

    @if ($product['meta_image'] != null)
        <meta property="og:image"
            content="{{ asset(config('app.public_storage_path') . '/app/public/product/meta') }}/{{ $product->meta_image }}" />
        <meta property="twitter:card"
            content="{{ asset(config('app.public_storage_path') . '/app/public/product/meta') }}/{{ $product->meta_image }}" />
    @else
        <meta property="og:image"
            content="{{ asset(config('app.public_storage_path') . '/app/public/product/thumbnail') }}/{{ $product->thumbnail }}" />
        <meta property="twitter:card"
            content="{{ asset(config('app.public_storage_path') . '/app/public/product/thumbnail/') }}/{{ $product->thumbnail }}" />
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
        :root {
            --pd-primary: {{ $web_config['primary_color'] ?? '#2563eb' }};
            --pd-secondary: {{ $web_config['secondary_color'] ?? '#3b82f6' }};
            --pd-dark: #0f172a;
            --pd-gray-50: #f8fafc;
            --pd-gray-100: #f1f5f9;
            --pd-gray-200: #e2e8f0;
            --pd-gray-400: #94a3b8;
            --pd-gray-600: #475569;
        }

        /* Container & Card Redesign */
        .pd-container {
            padding-top: 20px;
            padding-bottom: 40px;
        }

        .pd-main-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--pd-gray-200);
            padding: 28px;
            margin-bottom: 24px;
        }

        /* Gallery Styling */
        .cz-preview {
            background: var(--pd-gray-50);
            border-radius: 18px;
            border: 1px solid var(--pd-gray-200);
            overflow: hidden;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 380px;
        }

        .cz-preview-item img {
            max-height: 360px;
            width: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .cz-preview-item:hover img {
            transform: scale(1.03);
        }

        .cz-thumblist-item {
            width: 68px !important;
            height: 68px !important;
            border-radius: 12px !important;
            border: 2px solid var(--pd-gray-200) !important;
            margin-right: 8px;
            transition: all 0.2s ease;
        }

        .cz-thumblist-item.active, .cz-thumblist-item:hover {
            border-color: var(--pd-primary) !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        /* Product Main Info */
        .pd-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--pd-dark);
            line-height: 1.35;
            margin-bottom: 12px;
        }

        .pd-meta-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }

        .pd-rating-badge {
            background: #fffbeb;
            border: 1px solid #fef3c7;
            color: #d97706;
            font-weight: 700;
            font-size: 13px;
            padding: 4px 10px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .pd-meta-pill {
            background: var(--pd-gray-100);
            color: var(--pd-gray-600);
            font-size: 12px;
            font-weight: 500;
            padding: 5px 12px;
            border-radius: 8px;
        }

        /* Price Section */
        .pd-price-card {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 1px solid var(--pd-gray-200);
            border-radius: 14px;
            padding: 16px 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
        }

        .pd-current-price {
            font-size: 28px;
            font-weight: 800;
            color: var(--pd-dark);
        }

        .pd-old-price {
            font-size: 16px;
            color: var(--pd-gray-400);
            text-decoration: line-through;
            font-weight: 500;
        }

        .pd-discount-pill {
            background: linear-gradient(135deg, #ff5722 0%, #ff9800 100%);
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            box-shadow: 0 2px 8px rgba(255, 87, 34, 0.25);
        }

        .pd-tax-info {
            font-size: 12px;
            color: var(--pd-gray-600);
            margin-left: auto;
        }

        /* Variation Cards Styling */
        .variation-group-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--pd-dark);
            margin-top: 14px;
            margin-bottom: 10px;
        }

        .variation-cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 16px;
        }

        .variation-card-wrapper {
            position: relative;
            cursor: pointer;
            user-select: none;
            margin-bottom: 5px;
        }

        .variation-card-input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
            margin: 0;
            pointer-events: none;
        }

        .variation-card {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            min-width: 145px;
            max-width: 185px;
            min-height: 115px;
            background: #ffffff;
            border: 1.5px solid #cbd5e0;
            border-radius: 16px;
            padding: 20px 10px 8px 10px;
            transition: all 0.2s ease-in-out;
            text-align: center;
            box-sizing: border-box;
            overflow: hidden;
        }

        .variation-card-wrapper:hover .variation-card {
            border-color: #718096;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
        }

        .variation-card-input:checked + .variation-card {
            border: 2px solid #2e7d32 !important;
            background-color: #e8f5e9 !important;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.15);
        }

        .variation-discount-badge {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background: #ff9100;
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 10px;
            border-radius: 0 0 8px 8px;
            white-space: nowrap;
            line-height: 1.2;
            box-shadow: 0 2px 4px rgba(255, 145, 0, 0.25);
            z-index: 1;
        }

        .variation-option-title {
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
            margin-top: 8px;
            margin-bottom: 6px;
            line-height: 1.3;
        }

        .variation-price-box {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-bottom: 4px;
        }

        .variation-sell-price {
            font-size: 15px;
            font-weight: 800;
            color: #1a202c;
        }

        .variation-original-price {
            font-size: 12px;
            color: #a0aec0;
            text-decoration: line-through;
        }

        .variation-tag-badge {
            width: calc(100% + 20px);
            margin-left: -10px;
            margin-right: -10px;
            margin-bottom: -8px;
            margin-top: 4px;
            background: #f3e8ff;
            color: #8b5cf6;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 6px;
            border-radius: 0 0 14px 14px;
            text-align: center;
        }

        /* Quantity & Total Price Box */
        .pd-qty-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--pd-gray-50);
            border: 1px solid var(--pd-gray-200);
            border-radius: 14px;
            padding: 12px 18px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pd-stepper {
            display: inline-flex;
            align-items: center;
            background: #ffffff;
            border: 1px solid var(--pd-gray-200);
            border-radius: 10px;
            overflow: hidden;
        }

        .pd-stepper-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: none;
            color: var(--pd-dark);
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }

        .pd-stepper-btn:hover:not(:disabled) {
            background: var(--pd-gray-100);
        }

        .pd-stepper-input {
            width: 44px;
            height: 36px;
            border: none;
            text-align: center;
            font-weight: 700;
            font-size: 14px;
            color: var(--pd-dark);
            background: transparent;
        }

        /* Action Buttons */
        .pd-actions-row {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            align-items: center;
        }

        .pd-btn-buy {
            flex: 1;
            height: 50px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff !important;
            font-weight: 700;
            font-size: 15px;
            border: none;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.25);
            transition: all 0.2s ease;
        }

        .pd-btn-buy:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35);
        }

        .pd-btn-cart {
            flex: 1;
            height: 50px;
            background: linear-gradient(135deg, var(--pd-primary) 0%, var(--pd-secondary) 100%);
            color: #ffffff !important;
            font-weight: 700;
            font-size: 15px;
            border: none;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.25);
            transition: all 0.2s ease;
        }

        .pd-btn-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
        }

        .pd-btn-wish {
            width: 50px;
            height: 50px;
            background: #fef2f2;
            border: 1px solid #fee2e2;
            color: #ef4444;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .pd-btn-wish:hover {
            background: #fee2e2;
            transform: scale(1.05);
        }

        /* Sidebar & Trust Cards */
        .pd-side-card {
            background: #ffffff;
            border: 1px solid var(--pd-gray-200);
            border-radius: 18px;
            padding: 18px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }

        .pd-pincode-trigger {
            background: var(--pd-gray-50);
            border: 1.5px dashed #cbd5e0;
            border-radius: 12px;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-bottom: 16px;
        }

        .pd-pincode-trigger:hover {
            border-color: var(--pd-primary);
            background: #f1f5f9;
        }

        .pd-trust-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.04);
        }

        .pd-trust-card-title {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 14px;
        }

        .pd-trust-badge-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 14px;
            border-radius: 14px;
            background: #ffffff;
            border: 1px solid #f1f5f9;
            margin-bottom: 10px;
            transition: all 0.25s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        }

        .pd-trust-badge-item:last-child {
            margin-bottom: 0;
        }

        .pd-trust-badge-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.08);
            border-color: #dbeafe;
        }

        .pd-trust-badge-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .pd-trust-icon-green {
            background: #dcfce7;
            color: #16a34a;
        }

        .pd-trust-icon-blue {
            background: #dbeafe;
            color: #2563eb;
        }

        .pd-trust-icon-purple {
            background: #f3e8ff;
            color: #9333ea;
        }

        .pd-trust-badge-heading {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .pd-trust-badge-sub {
            font-size: 11px;
            color: #64748b;
            margin: 0;
        }

        /* Tabs & Content */
        .pd-tabs-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid var(--pd-gray-200);
            padding: 24px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.03);
            margin-top: 10px;
        }

        .pd-nav-tabs {
            border-bottom: 2px solid var(--pd-gray-200);
            gap: 10px;
            margin-bottom: 20px;
        }

        .pd-nav-tabs .nav-link {
            font-size: 16px;
            font-weight: 700;
            color: var(--pd-gray-600);
            border: none;
            border-bottom: 3px solid transparent;
            padding: 10px 20px;
            border-radius: 0;
            transition: all 0.2s ease;
        }

        .pd-nav-tabs .nav-link.active {
            color: var(--pd-primary);
            border-bottom-color: var(--pd-primary);
            background: transparent;
        }

        .description-content.collapsed {
            max-height: 380px;
            overflow: hidden;
            position: relative;
        }

        .rotate {
            transform: rotate(180deg);
            transition: transform 0.3s;
        }

        table {
            width: 100%;
        }
    </style>
@endpush

@section('content')
    <?php
    $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);
    $rating = \App\CPU\ProductManager::get_rating($product->reviews);
    $decimal_point_settings = \App\CPU\Helpers::get_business_settings('decimal_point_settings');
    ?>

    <div class="pd-container">
        <div class="container rtl" style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
            <div class="row {{ Session::get('direction') === 'rtl' ? '__dir-rtl' : '' }}">
                
                <!-- Main Product View (Gallery + Details) -->
                <div class="col-lg-9 col-12">
                    <div class="pd-main-card">
                        <div class="row">
                            
                            <!-- Left: Product Image Gallery -->
                            <div class="col-lg-5 col-md-5 col-12 mb-4 mb-md-0">
                                <div class="cz-product-gallery">
                                    <div class="cz-preview">
                                        @if ($product->images != null && json_decode($product->images) > 0)
                                            @if (json_decode($product->colors) && $product->color_image)
                                                @foreach (json_decode($product->color_image) as $key => $photo)
                                                    @if ($photo->color != null)
                                                        <div class="cz-preview-item d-flex align-items-center justify-content-center {{ $key == 0 ? 'active' : '' }}"
                                                            id="image{{ $photo->color }}">
                                                            <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                                src="{{ asset(config('app.public_storage_path') . "/product/$photo->image_name") }}"
                                                                data-zoom="{{ asset(config('app.public_storage_path') . "/product/$photo->image_name") }}"
                                                                alt="Product image">
                                                        </div>
                                                    @else
                                                        <div class="cz-preview-item d-flex align-items-center justify-content-center {{ $key == 0 ? 'active' : '' }}"
                                                            id="image{{ $key }}">
                                                            <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                                src="{{ asset(config('app.public_storage_path') . "/product/$photo->image_name") }}"
                                                                data-zoom="{{ asset(config('app.public_storage_path') . "/product/$photo->image_name") }}"
                                                                alt="Product image">
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach (json_decode($product->images) as $key => $photo)
                                                    <div class="cz-preview-item d-flex align-items-center justify-content-center {{ $key == 0 ? 'active' : '' }}"
                                                        id="image{{ $key }}">
                                                        <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                            src="{{ asset(config('app.public_storage_path') . "/product/$photo") }}"
                                                            data-zoom="{{ asset(config('app.public_storage_path') . "/product/$photo") }}"
                                                            alt="Product image">
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                    
                                    <!-- Thumbnails -->
                                    <div class="cz">
                                        <div class="table-responsive" data-simplebar>
                                            <div class="d-flex pt-1">
                                                @if ($product->images != null && json_decode($product->images) > 0)
                                                    @if (json_decode($product->colors) && $product->color_image)
                                                        @foreach (json_decode($product->color_image) as $key => $photo)
                                                            @if ($photo->color != null)
                                                                <div class="cz-thumblist">
                                                                    <a class="cz-thumblist-item {{ $key == 0 ? 'active' : '' }} d-flex align-items-center justify-content-center"
                                                                        id="preview-img{{ $photo->color }}"
                                                                        href="#image{{ $photo->color }}">
                                                                        <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                                            src="{{ asset(config('app.public_storage_path') . "/product/$photo->image_name") }}"
                                                                            alt="Product thumb">
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <div class="cz-thumblist">
                                                                    <a class="cz-thumblist-item {{ $key == 0 ? 'active' : '' }} d-flex align-items-center justify-content-center"
                                                                        id="preview-img{{ $key }}"
                                                                        href="#image{{ $key }}">
                                                                        <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                                            src="{{ asset(config('app.public_storage_path') . "/product/$photo->image_name") }}"
                                                                            alt="Product thumb">
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        @foreach (json_decode($product->images) as $key => $photo)
                                                            <div class="cz-thumblist">
                                                                <a class="cz-thumblist-item {{ $key == 0 ? 'active' : '' }} d-flex align-items-center justify-content-center"
                                                                    id="preview-img{{ $key }}"
                                                                    href="#image{{ $key }}">
                                                                    <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                                        src="{{ asset(config('app.public_storage_path') . "/product/$photo") }}"
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

                            <!-- Right: Product Information & Form -->
                            <div class="col-lg-7 col-md-7 col-12" style="direction: {{ Session::get('direction') }}">
                                <div class="details">
                                    <h1 class="pd-title">{{ $product->name }}</h1>

                                    <!-- Rating & Stats Meta Row -->
                                    <div class="pd-meta-row">
                                        <div class="pd-rating-badge">
                                            <i class="fa fa-star text-warning"></i>
                                            <span>{{ number_format($overallRating[0], 1) }}</span>
                                        </div>
                                        <span class="pd-meta-pill">
                                            {{ $overallRating[1] }} {{ \App\CPU\translate('Reviews') }}
                                        </span>
                                        <span class="pd-meta-pill">
                                            {{ $countOrder }} {{ \App\CPU\translate('orders') }}
                                        </span>
                                        <span class="pd-meta-pill">
                                            {{ $countWishlist }} {{ \App\CPU\translate('wish_listed') }}
                                        </span>
                                    </div>

                                    <!-- Price Banner -->
                                    <div class="pd-price-card">
                                        <div class="pd-current-price">
                                            {{ \App\CPU\Helpers::get_price_range($product) }}
                                        </div>
                                        @if ($product->discount > 0)
                                            <div class="pd-old-price">
                                                {{ \App\CPU\Helpers::currency_converter($product->unit_price) }}
                                            </div>
                                            @php
                                                $main_discount_percent = 0;
                                                if ($product->discount_type == 'percent') {
                                                    $main_discount_percent = round($product->discount);
                                                } elseif ($product->unit_price > 0) {
                                                    $main_discount_percent = round(($product->discount / $product->unit_price) * 100);
                                                }
                                            @endphp
                                            @if ($main_discount_percent > 0)
                                                <div class="pd-discount-pill">
                                                    {{ $main_discount_percent }}% OFF
                                                </div>
                                            @endif
                                        @endif
                                        <div class="pd-tax-info">
                                            ({{ \App\CPU\translate('tax') }} : <span id="set-tax-amount"></span>)
                                        </div>
                                    </div>

                                    <form id="add-to-cart-form" class="mb-2">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">

                                        <!-- Colors -->
                                        @if (count(json_decode($product->colors)) > 0)
                                            <div class="mb-3">
                                                <div class="variation-group-title">
                                                    {{ \App\CPU\translate('color') }}:
                                                </div>
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
                                                                    <span class="outline"></span>
                                                                </label>
                                                            </li>
                                                        </div>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <!-- Variations (Cards UI) -->
                                        @if (!empty($product->choice_options) && count(json_decode($product->choice_options)) > 0)
                                            @php
                                                $variations_list = !empty($product->variation) ? json_decode($product->variation, true) : [];
                                            @endphp

                                            @foreach (json_decode($product->choice_options) as $choice_key => $choice)
                                                @php
                                                    $single_pack_options = [];
                                                    $multipack_options = [];

                                                    $has_multipack_distinction = false;
                                                    foreach ($choice->options as $opt) {
                                                        if (preg_match('/pack\s*of|multipack|\bpack\b/i', $opt)) {
                                                            $has_multipack_distinction = true;
                                                            break;
                                                        }
                                                    }

                                                    if ($has_multipack_distinction) {
                                                        foreach ($choice->options as $opt_idx => $opt) {
                                                            if (preg_match('/pack\s*of|multipack|\bpack\b/i', $opt)) {
                                                                $multipack_options[] = ['option' => $opt, 'original_index' => $opt_idx];
                                                            } else {
                                                                $single_pack_options[] = ['option' => $opt, 'original_index' => $opt_idx];
                                                            }
                                                        }
                                                    } else {
                                                        foreach ($choice->options as $opt_idx => $opt) {
                                                            $single_pack_options[] = ['option' => $opt, 'original_index' => $opt_idx];
                                                        }
                                                    }

                                                    $groups = [];
                                                    if (!empty($single_pack_options)) {
                                                        $groups[] = [
                                                            'title' => $has_multipack_distinction ? \App\CPU\translate('Single Pack') : $choice->title,
                                                            'options' => $single_pack_options
                                                        ];
                                                    }
                                                    if (!empty($multipack_options)) {
                                                        $groups[] = [
                                                            'title' => \App\CPU\translate('Big Savings on Multipack'),
                                                            'options' => $multipack_options
                                                        ];
                                                    }
                                                @endphp

                                                @foreach ($groups as $group)
                                                    <div class="mb-3">
                                                        <div class="variation-group-title">
                                                            {{ $group['title'] }}
                                                        </div>
                                                        <div class="variation-cards-container">
                                                            @foreach ($group['options'] as $item)
                                                                @php
                                                                    $option = $item['option'];
                                                                    $opt_idx = $item['original_index'];

                                                                    $opt_clean = str_replace(' ', '', $option);
                                                                    $matched_variant = null;
                                                                    foreach ($variations_list as $v) {
                                                                        if (isset($v['type']) && (
                                                                            $v['type'] == $opt_clean || 
                                                                            (function_exists('str_ends_with') ? str_ends_with($v['type'], '-' . $opt_clean) || str_ends_with($v['type'], $opt_clean) : (substr($v['type'], -strlen($opt_clean)) === $opt_clean))
                                                                        )) {
                                                                            $matched_variant = $v;
                                                                            break;
                                                                        }
                                                                    }

                                                                    $v_price = $matched_variant ? $matched_variant['price'] : $product->unit_price;
                                                                    $v_discount = \App\CPU\Helpers::get_product_discount($product, $v_price);
                                                                    $v_final_price = $v_price - $v_discount;

                                                                    $discount_percent = 0;
                                                                    if ($v_price > 0 && $v_discount > 0) {
                                                                        $discount_percent = round(($v_discount / $v_price) * 100);
                                                                    }

                                                                    $tag_text = null;
                                                                    if (!empty($single_pack_options) && $opt_idx == 0) {
                                                                        $tag_text = \App\CPU\translate('Best Seller');
                                                                    } elseif (!empty($multipack_options) && $item === $multipack_options[0]) {
                                                                        $tag_text = \App\CPU\translate('Value Pack');
                                                                    }
                                                                @endphp

                                                                <label class="variation-card-wrapper">
                                                                    <input type="radio"
                                                                        class="variation-card-input"
                                                                        id="{{ $choice->name }}-{{ $option }}"
                                                                        name="{{ $choice->name }}"
                                                                        value="{{ $option }}"
                                                                        @if ($opt_idx == 0) checked @endif>
                                                                    
                                                                    <div class="variation-card">
                                                                        @if ($discount_percent > 0)
                                                                            <div class="variation-discount-badge">
                                                                                {{ $discount_percent }}% OFF
                                                                            </div>
                                                                        @endif

                                                                        <div class="variation-option-title">
                                                                            {{ $option }}
                                                                        </div>

                                                                        <div class="variation-price-box">
                                                                            <span class="variation-sell-price">
                                                                                {{ \App\CPU\Helpers::currency_converter($v_final_price) }}
                                                                            </span>
                                                                            @if ($v_discount > 0)
                                                                                <span class="variation-original-price">
                                                                                    {{ \App\CPU\Helpers::currency_converter($v_price) }}
                                                                                </span>
                                                                            @endif
                                                                        </div>

                                                                        @if ($tag_text)
                                                                            <div class="variation-tag-badge">
                                                                                {{ $tag_text }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        @endif

                                        <!-- Quantity & Total Price Box -->
                                        <div class="pd-qty-container">
                                            <div class="d-flex align-items-center gap-3">
                                                <span class="font-weight-bold text-dark me-2">{{ \App\CPU\translate('Quantity') }}:</span>
                                                <div class="pd-stepper">
                                                    <button class="pd-stepper-btn btn-number" type="button" data-type="minus" data-field="quantity" disabled="disabled">-</button>
                                                    <input type="text" name="quantity" class="pd-stepper-input input-number cart-qty-field" value="{{ $product->minimum_order_qty ?? 1 }}" product-type="{{ $product->product_type }}" min="{{ $product->minimum_order_qty ?? 1 }}" max="100">
                                                    <button class="pd-stepper-btn btn-number" type="button" product-type="{{ $product->product_type }}" data-type="plus" data-field="quantity">+</button>
                                                </div>
                                            </div>
                                            <div id="chosen_price_div" class="d-flex align-items-center">
                                                <span class="text-muted me-2">{{ \App\CPU\translate('total_price') }}:</span>
                                                <span id="chosen_price" class="h4 font-weight-bold text-success mb-0"></span>
                                            </div>
                                        </div>

                                        <!-- Out of Stock Warnings -->
                                        <div id="variant-out-of-stock" class="d-none mb-3">
                                            <div class="alert alert-danger font-weight-bold mb-0">
                                                <i class="fa fa-exclamation-triangle me-2"></i> {{ \App\CPU\translate('out_of_stock') }}
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="pd-actions-row">
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
                                                <button class="pd-btn-buy" type="button" disabled style="opacity:0.6;">{{ \App\CPU\translate('buy_now') }}</button>
                                                <button class="pd-btn-cart" type="button" disabled style="opacity:0.6;">{{ \App\CPU\translate('add_to_cart') }}</button>
                                            @else
                                                <button class="pd-btn-buy btn-buy-now" onclick="buy_now()" type="button">
                                                    <i class="fa fa-bolt"></i>
                                                    <span>{{ \App\CPU\translate('buy_now') }}</span>
                                                </button>
                                                <button class="pd-btn-cart btn-add-to-cart" onclick="addToCart()" type="button">
                                                    <i class="fa fa-shopping-bag"></i>
                                                    <span>{{ \App\CPU\translate('add_to_cart') }}</span>
                                                </button>
                                                <button class="btn btn-danger btn-oos d-none w-100" type="button" disabled>
                                                    <span>{{ \App\CPU\translate('out_of_stock') }}</span>
                                                </button>
                                            @endif

                                            <button type="button" onclick="addWishlist('{{ $product['id'] }}')" class="pd-btn-wish" title="Add to Wishlist">
                                                <i class="fa fa-heart-o"></i>
                                            </button>
                                        </div>

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
                                            <div class="alert alert-warning mt-2 mb-0" role="alert">
                                                {{ \App\CPU\translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now') }}
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Tabs: Overview & Reviews -->
                    <div class="pd-tabs-card">
                        <ul class="nav pd-nav-tabs nav-tabs" role="tablist">
                            <?php $reviews_of_product = App\Model\Review::where('product_id', $product->id)->paginate(2); ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="#overview" data-toggle="tab" role="tab">
                                    {{ \App\CPU\translate('overview') }}
                                </a>
                            </li>
                            @if ($reviews_of_product->count() > 0)
                                <li class="nav-item">
                                    <a class="nav-link" href="#reviews" data-toggle="tab" role="tab">
                                        {{ \App\CPU\translate('reviews') }} ({{ $reviews_of_product->total() }})
                                    </a>
                                </li>
                            @endif
                        </ul>

                        <div class="tab-content pt-2">
                            <!-- Overview Tab -->
                            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                @if ($product->video_url != null)
                                    <div class="mb-4 text-center">
                                        <iframe width="100%" height="380" src="{{ $product->video_url }}" style="border-radius:14px; border:none;"></iframe>
                                    </div>
                                @endif

                                <div class="text-body">
                                    <div id="product-description" class="description-content collapsed" style="transition: max-height 0.3s ease;">
                                        {!! $product['details'] !!}
                                    </div>
                                    @if (!empty($product['details']) && strlen(strip_tags($product['details'])) > 300)
                                        <div class="text-center mt-3">
                                            <button type="button" id="view-more-btn" class="btn btn-outline-primary rounded-pill px-4" onclick="toggleDescription()">
                                                <span id="view-more-text">{{ \App\CPU\translate('View more') }}</span>
                                                <i id="view-more-icon" class="czi-chevron-down ml-1"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Reviews Tab -->
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                @if ($reviews_of_product->count() > 0)
                                    <div class="row pt-2 pb-4 border-bottom mb-4">
                                        <div class="col-lg-4 col-md-5 text-center border-right">
                                            <h1 class="display-3 font-weight-bold text-warning mb-0">{{ number_format($overallRating[0], 1) }}</h1>
                                            <div class="star-rating mb-2">
                                                @for ($inc = 0; $inc < 5; $inc++)
                                                    @if ($inc < $overallRating[0])
                                                        <i class="fa fa-star text-warning"></i>
                                                    @else
                                                        <i class="fa fa-star-o text-muted"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <p class="text-muted mb-0">{{ $reviews_of_product->total() }} {{ \App\CPU\translate('ratings') }}</p>
                                        </div>

                                        <div class="col-lg-8 col-md-7 pt-3 pt-md-0">
                                            @php
                                                $labels = ['5 Star', '4 Star', '3 Star', '2 Star', '1 Star'];
                                                $colors = ['#10b981', '#3b82f6', '#f59e0b', '#f97316', '#ef4444'];
                                            @endphp
                                            @foreach ([0, 1, 2, 3, 4] as $idx)
                                                @php
                                                    $pct = $overallRating[1] != 0 ? ($rating[$idx] / $overallRating[1]) * 100 : 0;
                                                @endphp
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="text-muted me-2" style="width:55px; font-size:13px;">{{ $labels[$idx] }}</span>
                                                    <div class="progress flex-grow-1 mx-2" style="height: 7px; border-radius:10px; background:#e2e8f0;">
                                                        <div class="progress-bar" role="progressbar" style="width: {{ $pct }}%; background-color: {{ $colors[$idx] }}; border-radius:10px;"></div>
                                                    </div>
                                                    <span class="text-dark font-weight-bold" style="width:30px; font-size:13px; text-align:right;">{{ $rating[$idx] }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div id="product-review-list">
                                    @if (count($product->reviews) == 0)
                                        <div class="text-center py-5">
                                            <i class="fa fa-comments-o text-muted display-4 mb-3"></i>
                                            <p class="text-muted m-0">{{ \App\CPU\translate('product_review_not_available') }}</p>
                                        </div>
                                    @endif
                                </div>

                                @if (count($product->reviews) > 2)
                                    <div class="text-center mt-4">
                                        <button class="btn btn-outline-primary rounded-pill px-4" onclick="load_review()">
                                            {{ \App\CPU\translate('view more') }}
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar: Delivery Checker & Similar Products -->
                <div class="col-lg-3 col-12 mt-4 mt-lg-0">
                    
                    <!-- Pincode Check Trigger Card -->
                    <div class="pd-side-card" data-toggle="modal" data-target="#pincodeModal" style="cursor:pointer;">
                        <div class="pd-pincode-trigger mb-0">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa fa-map-marker text-primary font-size-lg me-2"></i>
                                <span class="font-weight-bold text-dark">{{ \App\CPU\translate('Check Delivery Info') }}</span>
                            </div>
                            <span id="pincode-status-text" class="text-muted"><i class="czi-arrow-right"></i></span>
                        </div>
                    </div>

                    <!-- Trust Badges Card -->
                    <div class="pd-trust-card">
                        <div class="pd-trust-card-title">
                            <i class="fa fa-shield text-primary me-1"></i> {{ \App\CPU\translate('Buyer Assurance') }}
                        </div>
                        
                        <div class="pd-trust-badge-item">
                            <div class="pd-trust-badge-icon pd-trust-icon-green">
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <div>
                                <div class="pd-trust-badge-heading">{{ \App\CPU\translate('100% Authentic Products') }}</div>
                                <div class="pd-trust-badge-sub">Direct from Verified Brands & Sellers</div>
                            </div>
                        </div>

                        <div class="pd-trust-badge-item">
                            <div class="pd-trust-badge-icon pd-trust-icon-blue">
                                <i class="fa fa-lock"></i>
                            </div>
                            <div>
                                <div class="pd-trust-badge-heading">{{ \App\CPU\translate('Safe & Secure Payment') }}</div>
                                <div class="pd-trust-badge-sub">100% Encrypted SSL Transactions</div>
                            </div>
                        </div>

                        <div class="pd-trust-badge-item">
                            <div class="pd-trust-badge-icon pd-trust-icon-purple">
                                <i class="fa fa-truck"></i>
                            </div>
                            <div>
                                <div class="pd-trust-badge-heading">{{ \App\CPU\translate('Express Delivery') }}</div>
                                <div class="pd-trust-badge-sub">Fast Priority Dispatch & Order Tracking</div>
                            </div>
                        </div>
                    </div>

                    <!-- Similar Products Section -->
                    <div class="pd-side-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="font-weight-bold text-dark mb-0" style="font-size:16px;">
                                {{ \App\CPU\translate('similar_products') }}
                            </h6>
                            <?php $category = json_decode($product['category_ids']); ?>
                            @if ($category)
                                <a class="text-primary font-weight-bold" style="font-size:13px;"
                                    href="{{ route('products', ['id' => $category[0]->id, 'data_from' => 'category', 'page' => 1]) }}">
                                    {{ \App\CPU\translate('view_all') }} &rarr;
                                </a>
                            @endif
                        </div>

                        <div class="row row-cols-1 g-3">
                            @if (count($relatedProducts) > 0)
                                @foreach ($relatedProducts->take(5) as $key => $relatedProduct)
                                    <div class="col mb-2">
                                        @include('web-views.partials._inline-single-product', [
                                            'product' => $relatedProduct,
                                            'decimal_point_settings' => $decimal_point_settings,
                                        ])
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12 text-center py-4 text-muted">
                                    <small>{{ \App\CPU\translate('similar') }} {{ \App\CPU\translate('product_not_available') }}</small>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Pincode Check Modal -->
    <div class="modal fade rtl" id="pincodeModal" tabindex="-1" role="dialog" aria-labelledby="pincodeModalLabel"
        aria-hidden="true" style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius:20px; border:none; box-shadow: 0 10px 40px rgba(0,0,0,0.15);">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-dark" id="pincodeModalLabel">{{ \App\CPU\translate('Select Delivery Address') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-4 pt-3">
                    <p class="text-muted mb-3">{{ \App\CPU\translate('Use pin code to check delivery info') }}</p>
                    <div class="d-flex align-items-center gap-2">
                        <div class="w-100 me-2">
                            <input type="text" id="delivery_pincode_input" class="form-control rounded-pill px-3"
                                placeholder="{{ \App\CPU\translate('Enter pin code') }}" style="height:46px;">
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary rounded-pill px-4 font-weight-bold"
                                id="check_delivery_pincode_btn" style="height:46px;">{{ \App\CPU\translate('Submit') }}</button>
                        </div>
                    </div>
                    <div id="pincode_check_result" class="mt-2"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attachment View Modal -->
    <div class="modal fade rtl" id="show-modal-view" tabindex="-1" role="dialog" aria-labelledby="show-modal-image"
        aria-hidden="true" style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius:20px;">
                <div class="modal-body p-2 text-center position-relative">
                    <button class="btn btn-sm btn-circle btn-dark position-absolute" style="top:10px; right:10px; z-index:10;" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                    <img class="img-fluid rounded" id="attachment-view" src="">
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
            $('#show-modal-view').modal('toggle');
        }

        function focus_preview_image_by_color(key) {
            $('a[href="#image' + key + '"]')[0].click();
        }

        function toggleDescription() {
            var desc = document.getElementById('product-description');
            var btnText = document.getElementById('view-more-text');
            if (desc.classList.contains('collapsed')) {
                desc.classList.remove('collapsed');
                btnText.textContent = "{{ \App\CPU\translate('View less') }}";
                document.getElementById('view-more-icon').classList.add('rotate');
            } else {
                desc.classList.add('collapsed');
                btnText.textContent = "{{ \App\CPU\translate('View more') }}";
                document.getElementById('view-more-icon').classList.remove('rotate');
            }
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
                    $('#product-review-list').append(data.productReview);
                    if (data.not_empty == 0 && load_review_count > 2) {
                        toastr.info('{{ \App\CPU\translate('no more review remain to load') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                }
            });
            load_review_count++;
        }
    </script>

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
                        $('#pincode_check_result').html(
                            '<div class="text-success mt-2 font-weight-bold"><i class="fa fa-check-circle me-1"></i> {{ \App\CPU\translate('Delivery available in this area.') }}</div>'
                        );
                        $('#pincode-status-text').html('<span class="text-success font-weight-bold">' + pincode + '</span>');
                        $('#delivery_pincode_input').css('border-color', '#28a745');
                        setTimeout(function() {
                            $('#pincodeModal').modal('hide');
                        }, 2500);
                    } else {
                        $('#pincode_check_result').html(
                            '<div class="text-danger mt-2 font-weight-bold"><i class="fa fa-times-circle me-1"></i> {{ \App\CPU\translate('Delivery not available in this area.') }}</div>'
                        );
                        $('#pincode-status-text').html('<span class="text-danger font-weight-bold">' + pincode + '</span>');
                        $('#delivery_pincode_input').css('border-color', '#dc3545');
                    }
                },
                error: function() {
                    $('#check_delivery_pincode_btn').removeAttr('disabled').text('{{ \App\CPU\translate('Submit') }}');
                    $('#pincode_check_result').html(
                        '<div class="text-danger mt-2 font-weight-bold"><i class="fa fa-exclamation-circle me-1"></i> {{ \App\CPU\translate('Error checking pin code.') }}</div>'
                    );
                }
            });
        });
    </script>
@endpush
