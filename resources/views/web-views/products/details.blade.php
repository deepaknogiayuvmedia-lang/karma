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
            --pd-primary: var(--bh-primary, #168A3A);
            --pd-secondary: var(--bh-dark-green, #0B5D2A);
            --pd-dark: #1B1F1D;
            --pd-gray-50: #f8fafc;
            --pd-gray-100: #f1f5f9;
            --pd-gray-200: #e2e8f0;
            --pd-gray-400: #94a3b8;
            --pd-gray-600: #66706A;
            --pd-green-light: #EAF7EE;
            --pd-green-border: #168A3A;
            --pd-orange: #ff9100;
            --pd-purple: #8b5cf6;
            --pd-red: #D93025;
        }

        /* BigHaat-style PDP Layout */
        .bhpdp-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 16px;
            overflow-x: hidden;
        }

        /* Breadcrumb */
        .bhpdp-breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #666;
            margin-block: 16px;
            flex-wrap: wrap;
            @media (width < 576px) {
               margin-block : 16px;
            }
        }

        .bhpdp-breadcrumb a {
            color: #666;
            text-decoration: none;
        }

        .bhpdp-breadcrumb a:hover {
            color: var(--pd-primary);
            text-decoration: underline;
        }

        .bhpdp-breadcrumb svg {
            width: 12px;
            height: 12px;
            color: #999;
            flex-shrink: 0;
        }

        /* Two Column Layout */
        .bhpdp-hero {
            display: flex;
            gap: 32px;
            align-items: flex-start;
        }

        .bhpdp-hero-left {
            flex: 1;
            position: sticky;
            top: 20px;
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            padding: 12px;
            max-height: calc(100vh - 40px);
            overflow: hidden;
        }

        .bhpdp-hero-right {
            flex: 1;
            padding: 0 8px;
            width: 100%;
            min-width: 0;
        }

        /* Image Gallery */
        .bhpdp-gallery {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }

        .bhpdp-gallery-track {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .bhpdp-gallery-track::-webkit-scrollbar {
            display: none;
        }

        .bhpdp-gallery-slide {
            flex: 0 0 100%;
            scroll-snap-align: start;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 400px;
            max-height: 500px;
            background: #f9fafb;
            border-radius: 12px;
        }

        .bhpdp-gallery-slide img {
            max-width: 100%;
            max-height: 480px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .bhpdp-gallery-slide img:hover {
            transform: scale(1.03);
        }

        .bhpdp-gallery-counter {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            z-index: 5;
        }

        .bhpdp-gallery-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            z-index: 5;
            transition: all 0.2s;
        }

        .bhpdp-gallery-nav:hover {
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .bhpdp-gallery-nav.prev {
            left: 10px;
        }

        .bhpdp-gallery-nav.next {
            right: 10px;
        }

        /* Thumbnails */
        .bhpdp-thumbnails {
            display: flex;
            gap: 8px;
            margin-top: 10px;
            overflow-x: auto;
            padding: 4px 0;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .bhpdp-thumbnails::-webkit-scrollbar {
            display: none;
        }

        .bhpdp-thumb {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            border-radius: 8px;
            border: 2px solid transparent;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.2s;
            background: #f3f4f6;
        }

        .bhpdp-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .bhpdp-thumb.active,
        .bhpdp-thumb:hover {
            border-color: #000;
        }

        /* Social Proof Bar */
        .bhpdp-social-proof {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 8px 14px;
            margin-bottom: 14px;
            font-size: 13px;
            font-weight: 600;
            color: #166534;
        }

        .bhpdp-social-proof svg {
            width: 18px;
            height: 18px;
            color: #22c55e;
            flex-shrink: 0;
        }

        /* Product Title */
        .bhpdp-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--pd-dark);
            line-height: 1.4;
            margin-bottom: 10px;
        }

        /* Feature Badges */
        .bhpdp-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 12px;
        }

        .bhpdp-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .bhpdp-badge-green {
            background: #EFF6E7;
            color: #2E7D32;
            border: 1px solid #D6EEBA;
        }

        .bhpdp-badge-purple {
            background: #FAF5FF;
            color: #5E00B0;
            border: 1px solid #DFCDEE;
        }

        .bhpdp-badge-orange {
            background: #FFF4E9;
            color: #964600;
            border: 1px solid #FFE6CE;
        }

        .bhpdp-badge-blue {
            background: #DCEBFE;
            color: #1447E6;
            border: 1px solid #C6DFFF;
        }

        /* Rating */
        .bhpdp-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }

        .bhpdp-rating-stars {
            display: flex;
            gap: 2px;
        }

        .bhpdp-rating-stars svg {
            width: 14px;
            height: 14px;
            color: #f59e0b;
        }

        .bhpdp-rating-text {
            font-size: 13px;
            color: #666;
            font-weight: 500;
        }

        .bhpdp-rating-link {
            font-size: 13px;
            color: #666;
            text-decoration: none;
            border-left: 1px solid #ddd;
            padding-left: 10px;
            font-weight: 500;
        }

        .bhpdp-rating-link:hover {
            color: var(--pd-primary);
            text-decoration: underline;
        }

        /* Price Section */
        .bhpdp-price-section {
            margin-bottom: 16px;
        }

        .bhpdp-price-row {
            display: flex;
            align-items: baseline;
            gap: 10px;
            flex-wrap: wrap;
        }

        .bhpdp-price-current {
            font-size: 26px;
            font-weight: 700;
            color: var(--pd-dark);
        }

        .bhpdp-price-old {
            font-size: 16px;
            color: #999;
            text-decoration: line-through;
            font-weight: 400;
        }

        .bhpdp-price-discount {
            background: #dcfce7;
            color: #166534;
            font-size: 13px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 6px;
        }

        .bhpdp-price-mrp {
            font-size: 14px;
            color: #666;
            margin-top: 4px;
        }

        .bhpdp-price-tax {
            font-size: 13px;
            color: #999;
            text-decoration: underline;
            margin-top: 4px;
        }


        /* Variant Selector */
        .bhpdp-variant-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--pd-dark);
            margin-bottom: 10px;
            margin-top: 16px;
        }

        .bhpdp-variant-scroll {
            display: flex;
            flex-wrap: nowrap;
            gap: 10px;
            overflow-x: auto;
            overflow-y: hidden;
            padding-bottom: 8px;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            width: 100%;
        }

        .bhpdp-variant-scroll::-webkit-scrollbar {
            height: 6px;
        }

        .bhpdp-variant-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .bhpdp-variant-scroll::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .bhpdp-variant-scroll::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        .bhpdp-variant-card {
            position: relative;
            flex-shrink: 0;
            min-width: 120px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            padding: 10px;
            cursor: pointer;
            transition: all 0.2s;
            background: #fff;
            text-align: center;
        }

        .bhpdp-variant-card:hover {
            border-color: #999;
        }

        .bhpdp-variant-card.active {
            border-color: var(--pd-green-border);
            background: var(--pd-green-light);
            box-shadow: 0 0 0 2px rgba(46, 125, 50, 0.1);
        }

        .bhpdp-variant-discount {
            position: absolute;
            top: 0px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--pd-orange);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 0 0 6px 6px;
            white-space: nowrap;
        }

        .bhpdp-variant-name {
            font-size: 16px;
            font-weight: 600;
            color: var(--pd-dark);
            margin-top: 6px;
            margin-bottom: 6px;
        }

        .bhpdp-variant-price {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .bhpdp-variant-sell {
            font-size: 14px;
            font-weight: 700;
            color: var(--pd-dark);
        }

        .bhpdp-variant-original {
            font-size: 11px;
            color: #aaa;
            text-decoration: line-through;
        }

        .bhpdp-variant-tag {
            background: #f3e8ff;
            color: #7c3aed;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 4px;
            margin-top: 6px;
        }

        /* Color Selector */
        .bhpdp-colors {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            flex-wrap: wrap;
        }

        .bhpdp-color-opt {
            position: relative;
        }

        .bhpdp-color-opt input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .bhpdp-color-swatch {
            display: block;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid #e5e7eb;
            cursor: pointer;
            transition: all 0.2s;
        }

        .bhpdp-color-opt input:checked+.bhpdp-color-swatch {
            border-color: var(--pd-dark);
            box-shadow: 0 0 0 2px #fff, 0 0 0 4px var(--pd-dark);
        }

        /* Quantity */
        .bhpdp-qty-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 16px;
            margin: 16px 0;
        }

        .bhpdp-qty-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--pd-dark);
        }

        .bhpdp-qty-stepper {
            display: inline-flex;
            align-items: center;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
        }

        .bhpdp-qty-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            color: var(--pd-dark);
            transition: background 0.15s;
        }

        .bhpdp-qty-btn:hover:not(:disabled) {
            background: #f3f4f6;
        }

        .bhpdp-qty-input {
            width: 40px;
            height: 32px;
            border: none;
            border-left: 1px solid #e5e7eb;
            border-right: 1px solid #e5e7eb;
            text-align: center;
            font-weight: 700;
            font-size: 14px;
            color: var(--pd-dark);
            background: transparent;
        }

        /* Trust Info Row */
        .bhpdp-trust-row {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .bhpdp-trust-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #555;
            font-weight: 500;
        }

        .bhpdp-trust-item svg {
            width: 18px;
            height: 18px;
            color: var(--pd-primary);
            flex-shrink: 0;
        }

        /* Action Buttons */
        .bhpdp-actions {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }

        .bhpdp-btn-cart {
            flex: 1;
            height: 46px;
            background: #fff;
            color: var(--pd-dark);
            border: 2px solid var(--pd-dark);
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .bhpdp-btn-cart:hover {
            background: #f3f4f6;
        }

        .bhpdp-btn-buy {
            flex: 1;
            height: 46px;
            background: var(--pd-primary);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .bhpdp-btn-buy:hover {
            opacity: 0.92;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .bhpdp-btn-wish {
            width: 46px;
            height: 46px;
            background: #fef2f2;
            border: 1px solid #fee2e2;
            color: #ef4444;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .bhpdp-btn-wish:hover {
            background: #fee2e2;
            transform: scale(1.05);
        }

        /* Out of Stock Button */
        .bhpdp-btn-oos {
            flex: 1;
            height: 46px;
            background: #fee2e2;
            color: #dc2626;
            border: 2px solid #fca5a5;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: not-allowed;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .bhpdp-mobile-cta .bhpdp-btn-oos {
            flex: 1;
            height: 44px;
        }

        /* Home-style Sections */
        .bhpdp-home-section {
            margin-top: 32px;
        }

        .bhpdp-home-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .bhpdp-home-section-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--pd-dark);
        }

        .bhpdp-home-section-link {
            font-size: 13px;
            font-weight: 600;
            color: #333;
            text-decoration: none;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 6px 14px;
            transition: all 0.2s;
        }

        .bhpdp-home-section-link:hover {
            background: #f3f4f6;
            border-color: #ccc;
        }

        .bhpdp-scroll-carousel {
            display: flex;
            gap: 14px;
            overflow-x: auto;
            padding-bottom: 12px;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .bhpdp-scroll-carousel::-webkit-scrollbar {
            display: none;
        }

        .bhpdp-hcard {
            flex-shrink: 0;
            width: 190px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            transition: all 0.2s;
            position: relative;
        }

        .bhpdp-hcard:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .bhpdp-hcard-img {
            position: relative;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            background: #f9fafb;
        }

        .bhpdp-hcard-img img {
            max-height: 130px;
            max-width: 100%;
            object-fit: contain;
        }

        .bhpdp-hcard-badge {
            position: absolute;
            top: 0;
            left: 0;
            background: #ef4444;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 0 0 8px 0;
        }

        .bhpdp-hcard-info {
            padding: 10px;
        }

        .bhpdp-hcard-name {
            font-size: 12px;
            font-weight: 500;
            color: var(--pd-dark);
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 4px;
            min-height: 34px;
        }

        .bhpdp-hcard-price-row {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .bhpdp-hcard-price {
            font-size: 14px;
            font-weight: 700;
            color: var(--pd-dark);
        }

        .bhpdp-hcard-old {
            font-size: 11px;
            color: #aaa;
            text-decoration: line-through;
        }

        .bhpdp-hcard-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 4px;
        }

        .bhpdp-hcard-stars {
            display: flex;
            gap: 1px;
        }

        .bhpdp-hcard-stars svg {
            width: 11px;
            height: 11px;
            color: #f59e0b;
        }

        .bhpdp-hcard-rating-text {
            font-size: 10px;
            color: #999;
        }

        .bhpdp-banner-card {
            border-radius: 14px;
            overflow: hidden;
            position: relative;
            background: #f3f4f6;
        }

        .bhpdp-banner-card img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
            max-height: 200px;
        }

        .bhpdp-brand-scroll {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            padding-bottom: 12px;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .bhpdp-brand-scroll::-webkit-scrollbar {
            display: none;
        }

        .bhpdp-brand-card {
            flex-shrink: 0;
            width: 100px;
            height: 100px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            transition: all 0.2s;
        }

        .bhpdp-brand-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .bhpdp-brand-card img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .bhpdp-brand-name {
            text-align: center;
            font-size: 11px;
            color: #666;
            margin-top: 4px;
            font-weight: 500;
        }

        /* Sticky Tabs */
        .bhpdp-sticky-tabs {
            position: sticky;
            top: 0;
           
            z-index: 50;
            
            margin-top: 24px;
        }

        .bhpdp-tabs-inner {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding: 12px 0;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .bhpdp-tabs-inner::-webkit-scrollbar {
            display: none;
        }

        .bhpdp-tab-btn {
            flex-shrink: 0;
            padding: 6px 18px;
            border-radius: 20px;
            border: 1px solid #d1d5db;
            background: #fff;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .bhpdp-tab-btn:hover {
            border-color: #999;
        }

        .bhpdp-tab-btn.active {
            background: var(--pd-primary);
            color: #fff;
            border-color: var(--pd-primary);
        }

        /* Tab Content */
        .bhpdp-tab-content {
            padding: 24px 0;
        }

        .bhpdp-tab-pane {
            display: none;
        }

        .bhpdp-tab-pane.active {
            display: block;
        }

        /* Description Card */
        .bhpdp-desc-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #f0f0f0;
        }

        .bhpdp-desc-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--pd-dark);
            margin-bottom: 14px;
        }

        .bhpdp-desc-content {
            font-size: 14px;
            color: #444;
            line-height: 1.7;
        }

        .bhpdp-desc-content.collapsed {
            max-height: 300px;
            overflow: hidden;
            position: relative;
        }

        .bhpdp-desc-content.collapsed::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: linear-gradient(transparent, #fff);
        }

        .bhpdp-view-more {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 20px;
            border: 1px solid #ddd;
            border-radius: 20px;
            background: #fff;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            cursor: pointer;
            margin: 12px auto 0;
            transition: all 0.2s;
        }

        .bhpdp-view-more:hover {
            background: #f9fafb;
        }

        /* Video Embed */
        .bhpdp-video-wrap {
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .bhpdp-video-wrap iframe {
            width: 100%;
            height: 360px;
            border: none;
            border-radius: 14px;
        }

        /* Reviews */
        .bhpdp-reviews-summary {
            display: flex;
            gap: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .bhpdp-reviews-big-rating {
            text-align: center;
            min-width: 120px;
        }

        .bhpdp-reviews-big-num {
            font-size: 48px;
            font-weight: 700;
            color: #f59e0b;
            line-height: 1;
        }

        .bhpdp-reviews-big-stars {
            display: flex;
            justify-content: center;
            gap: 2px;
            margin: 6px 0;
        }

        .bhpdp-reviews-big-count {
            font-size: 13px;
            color: #999;
        }

        .bhpdp-reviews-bars {
            flex: 1;
        }

        .bhpdp-review-bar-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }

        .bhpdp-review-bar-label {
            font-size: 12px;
            color: #888;
            width: 48px;
            flex-shrink: 0;
        }

        .bhpdp-review-bar-track {
            flex: 1;
            height: 6px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
        }

        .bhpdp-review-bar-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.5s;
        }

        .bhpdp-review-bar-count {
            font-size: 12px;
            font-weight: 600;
            color: #555;
            width: 24px;
            text-align: right;
            flex-shrink: 0;
        }

        .bhpdp-review-item {
            padding: 16px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .bhpdp-review-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .bhpdp-review-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            color: #666;
        }

        .bhpdp-review-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--pd-dark);
        }

        .bhpdp-review-date {
            font-size: 12px;
            color: #999;
        }

        .bhpdp-review-stars {
            display: flex;
            gap: 2px;
            margin-bottom: 6px;
        }

        .bhpdp-review-text {
            font-size: 14px;
            color: #444;
            line-height: 1.6;
        }

        /* Similar Products Section */
        .bhpdp-similar-section {
            margin-top: 24px;
        }

        .bhpdp-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .bhpdp-section-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--pd-dark);
        }

        .bhpdp-section-link {
            font-size: 13px;
            font-weight: 600;
            color: #333;
            text-decoration: none;
            padding: 6px 14px;
        }
        .bhpdp-section-link:hover {
            background: var(--pd-primary);
            color: #fff;
            border-color: var(--pd-primary);
        }

        /* Similar Products - Single Row Slider & Grid */
        .bhpdp-similar-slider {
            display: flex !important;
            flex-wrap: nowrap !important;
            overflow-x: auto !important;
            gap: 14px !important;
            padding: 4px 2px 14px 2px !important;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        .bhpdp-similar-slider::-webkit-scrollbar {
            height: 6px;
        }

        .bhpdp-similar-slider::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .bhpdp-similar-slider::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .bhpdp-similar-slider::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .bhpdp-similar-item {
            flex: 0 0 calc(16.666% - 12px) !important;
            min-width: 170px !important;
            scroll-snap-align: start;
        }

        @media (max-width: 768px) {
            .bhpdp-similar-item {
                flex: 0 0 160px !important;
                min-width: 160px !important;
            }
        }"

        .bhpdp-similar-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.25s ease;
            text-decoration: none !important;
            display: flex;
            flex-direction: column;
        }

        .bhpdp-similar-card:hover {
            border-color: var(--pd-primary, #2563eb);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.1);
        }

        .bhpdp-similar-card-img {
            width: 100%;
            aspect-ratio: 1;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            position: relative;
            overflow: hidden;
        }

        .bhpdp-similar-card-img img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .bhpdp-similar-card:hover .bhpdp-similar-card-img img {
            transform: scale(1.08);
        }

        .bhpdp-similar-card-badge {
            position: absolute;
            top: 8px;
            left: 8px;
            background: #ef4444;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 6px;
            z-index: 999;
        }

        .bhpdp-similar-card-stock {
            position: absolute;
            top: 8px;
            right: 8px;
            background: #6b7280;
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .bhpdp-similar-card-body {
            padding: 10px 12px 12px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .bhpdp-similar-card-name {
            font-size: 13px;
            font-weight: 600;
            color: #0f172a;
            line-height: 1.35;
            margin-bottom: 6px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 35px;
        }

        .bhpdp-similar-card-price {
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .bhpdp-similar-card-old {
            font-size: 11px;
            color: #94a3b8;
            text-decoration: line-through;
        }

        .bhpdp-similar-card-save {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            background: #dcfce7;
            color: #15803d;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
            margin-top: 4px;
            width: fit-content;
        }

        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        transition: all 0.2s;
        position: relative;
        }

        .bhpdp-product-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .bhpdp-product-img {
            position: relative;
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            background: #f9fafb;
        }

        .bhpdp-product-img img {
            max-height: 140px;
            max-width: 100%;
            object-fit: contain;
        }

        .bhpdp-product-badge {
            position: absolute;
            top: 0;
            left: 0;
            background: var(--pd-primary);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 0 0 8px 0;
        }

        .bhpdp-product-wish {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 30px;
            height: 30px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #999;
            transition: all 0.2s;
        }

        .bhpdp-product-wish:hover {
            color: var(--pd-red);
        }

        .bhpdp-product-info {
            padding: 10px;
        }

        .bhpdp-product-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--pd-dark);
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 4px;
            min-height: 36px;
        }

        .bhpdp-product-brand {
            font-size: 11px;
            color: #999;
            margin-bottom: 6px;
        }

        .bhpdp-product-price-row {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .bhpdp-product-price {
            font-size: 15px;
            font-weight: 700;
            color: var(--pd-dark);
        }

        .bhpdp-product-old-price {
            font-size: 12px;
            color: #aaa;
            text-decoration: line-through;
        }

        .bhpdp-product-save {
            font-size: 11px;
            color: #16a34a;
            font-weight: 600;
        }

        /* Sticky Mobile CTA Bar */
        .bhpdp-mobile-cta {
            display: none;
            position: fixed;
            bottom: 50px;
            left: 0;
            right: 0;
            background: #fff;
            padding: 10px 16px;
            box-shadow: 0 -2px 12px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }

        .bhpdp-mobile-cta-inner {
            display: flex;
            gap: 10px;
        }

        .bhpdp-mobile-cta .bhpdp-btn-cart,
        .bhpdp-mobile-cta .bhpdp-btn-buy {
            flex: 1;
            height: 44px;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .bhpdp-hero {
                flex-direction: column;
                gap: 20px;
            }

            .bhpdp-hero-left {
                position: static;
                max-height: none;
                width: 100%;
            }

            .bhpdp-gallery-slide {
                min-height: 320px;
                max-height: 400px;
            }

            .bhpdp-mobile-cta {
                display: block;
            }

            .bhpdp-actions {
                display: none;
            }

            body {
                padding-bottom: 70px;
            }

            .bhpdp-section-title {
                font-size: 15px;
                font-weight: 700;
                color: var(--pd-dark);
            }
        }

        @media (max-width: 575px) {
            .bhpdp-gallery-slide {
                min-height: 260px;
                max-height: 340px;
            }

            .bhpdp-gallery-slide img {
                max-height: 250px;
            }

            .bhpdp-title {
                font-size: 17px;
            }

            .bhpdp-price-current {
                font-size: 22px;
            }

            .bhpdp-product-card {
                width: 160px;
            }

            .bhpdp-product-img {
                height: 130px;
            }

            .bhpdp-reviews-summary {
                flex-direction: column;
                gap: 16px;
            }

            .bhpdp-variant-scroll {
                overflow-x: auto;
                overflow-y: hidden;
                scroll-behavior: smooth;
                padding-bottom: 10px;
                margin: 0 -15px;
                padding-left: 15px;
                padding-right: 15px;
            }

            .bhpdp-section-title {
                font-size: 15px;
                font-weight: 700;
                color: var(--pd-dark);
            }
        }

        /* Smooth scroll for gallery */
        .bhpdp-gallery-track {
            scroll-snap-type: x mandatory;
        }

        /* Out of stock overlay */
        .bhpdp-oos-overlay {
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            border-radius: 12px;
        }

        .bhpdp-oos-text {
            background: #fee2e2;
            color: #dc2626;
            font-size: 13px;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 8px;
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

    <div class="container">
        {{-- Breadcrumb --}}
        <nav class="bhpdp-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <svg viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                    clip-rule="evenodd" />
            </svg>
            @if (!empty($product->category_ids))
                @php $cats = json_decode($product->category_ids); @endphp
                @if (!empty($cats[0]))
                    @php $cat = \App\Model\Category::find($cats[0]->id); @endphp
                    @if ($cat)
                        <a
                            href="{{ route('products', ['id' => $cat->id, 'data_from' => 'category']) }}">{{ $cat->name }}</a>
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                clip-rule="evenodd" />
                        </svg>
                    @endif
                @endif
            @endif
            <span style="color:#333; font-weight:500;">{{ Str::limit($product->name, 50) }}</span>
        </nav>

        {{-- Hero Section: Two Columns --}}
        <div class="bhpdp-hero row">

            {{-- Left Column: Image Gallery --}}
            <div class="bhpdp-hero-left col-lg-6">
                <div class="bhpdp-gallery" id="bhpdpGallery">
                    <button class="bhpdp-gallery-nav prev" onclick="bhGalleryPrev()" aria-label="Previous image">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button class="bhpdp-gallery-nav next" onclick="bhGalleryNext()" aria-label="Next image">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div class="bhpdp-gallery-track" id="bhGalleryTrack">
                        @if ($product->images != null && json_decode($product->images) > 0)
                            @if (json_decode($product->colors) && $product->color_image)
                                @foreach (json_decode($product->color_image) as $key => $photo)
                                    <div class="bhpdp-gallery-slide" data-index="{{ $key }}">
                                        <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                            src="{{ asset(config('app.public_storage_path') . "/product/$photo->image_name") }}"
                                            alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                            @else
                                @foreach (json_decode($product->images) as $key => $photo)
                                    <div class="bhpdp-gallery-slide" data-index="{{ $key }}">
                                        <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                            src="{{ asset(config('app.public_storage_path') . "/product/$photo") }}"
                                            alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                            @endif
                        @endif

                        @if ($product->video_url != null)
                            <div class="bhpdp-gallery-slide" data-index="video" style="padding:0; background:#000;">
                                <iframe src="{{ $product->video_url }}"
                                    style="width:100%; height:100%; min-height:400px; border:none; border-radius:12px;"
                                    allowfullscreen></iframe>
                            </div>
                        @endif
                    </div>

                    @php
                        $totalImages = 0;
                        if ($product->images != null) {
                            $decoded = json_decode($product->images);
                            $totalImages = is_array($decoded) ? count($decoded) : 0;
                        }
                        if ($product->video_url != null) {
                            $totalImages++;
                        }
                    @endphp
                    @if ($totalImages > 1)
                        <div class="bhpdp-gallery-counter" id="bhGalleryCounter">1 / {{ $totalImages }}</div>
                    @endif
                </div>

                {{-- Thumbnails --}}
                <div class="bhpdp-thumbnails" id="bhThumbnails">
                    @if ($product->images != null && json_decode($product->images) > 0)
                        @if (json_decode($product->colors) && $product->color_image)
                            @foreach (json_decode($product->color_image) as $key => $photo)
                                <div class="bhpdp-thumb {{ $key == 0 ? 'active' : '' }}" data-index="{{ $key }}"
                                    onclick="bhGoToSlide({{ $key }})">
                                    <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                        src="{{ asset(config('app.public_storage_path') . "/product/$photo->image_name") }}"
                                        alt="Thumb">
                                </div>
                            @endforeach
                        @else
                            @foreach (json_decode($product->images) as $key => $photo)
                                <div class="bhpdp-thumb {{ $key == 0 ? 'active' : '' }}"
                                    data-index="{{ $key }}" onclick="bhGoToSlide({{ $key }})">
                                    <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                        src="{{ asset(config('app.public_storage_path') . "/product/$photo") }}"
                                        alt="Thumb">
                                </div>
                            @endforeach
                        @endif
                    @endif

                    @if ($product->video_url != null)
                        <div class="bhpdp-thumb" data-index="video" onclick="bhGoToSlide('video')"
                            style="display:flex; align-items:center; justify-content:center; background:#000; color:#fff;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right Column: Product Info --}}
            <div class="bhpdp-hero-right col-lg-6">

                {{-- Social Proof --}}
              
                {{-- Title --}}
                <h1 class="bhpdp-title">{{ $product->name }}</h1>
                @if ($product->tags->count() > 0)
                    @php
                        $tag_colors = [
                            ['bg' => '#f0fdf4', 'border' => '#bbf7d0', 'color' => '#168A3A'],
                            ['bg' => '#eff6ff', 'border' => '#bfdbfe', 'color' => '#1d4ed8'],
                            ['bg' => '#fef3c7', 'border' => '#fde68a', 'color' => '#92400e'],
                            ['bg' => '#fce7f3', 'border' => '#fbcfe8', 'color' => '#9d174d'],
                            ['bg' => '#f5f3ff', 'border' => '#ddd6fe', 'color' => '#6d28d9'],
                            ['bg' => '#ecfdf5', 'border' => '#a7f3d0', 'color' => '#047857'],
                            ['bg' => '#fff7ed', 'border' => '#fed7aa', 'color' => '#c2410c'],
                            ['bg' => '#f0f9ff', 'border' => '#bae6fd', 'color' => '#0369a1'],
                        ];
                    @endphp
                    <div style="display:flex; flex-wrap:wrap; gap:6px; margin-top:6px;">
                        @foreach ($product->tags as $idx => $tag)
                            @php $clr = $tag_colors[$idx % count($tag_colors)]; @endphp
                            <span style="display:inline-flex; align-items:center; gap:4px; background:{{ $clr['bg'] }}; border:1px solid {{ $clr['border'] }}; color:{{ $clr['color'] }}; font-size:11px; font-weight:600; padding:3px 10px; border-radius:20px;">
                                <i class="fa fa-tag" style="font-size:9px;"></i>
                                {{ $tag->tag }}
                            </span>
                        @endforeach
                    </div>
                @endif

                {{-- Feature Badges --}}
                <div class="bhpdp-badges" style="display:none;">
                    <span class="bhpdp-badge bhpdp-badge-green">100% Authentic</span>
                    <span class="bhpdp-badge bhpdp-badge-blue">Fast Delivery</span>
                    @if ($product->discount > 0)
                        <span class="bhpdp-badge bhpdp-badge-orange">Best Price</span>
                    @endif
                </div>

                {{-- Rating --}}
                <div class="bhpdp-rating">
                    <div class="bhpdp-rating-stars">
                        @for ($i = 0; $i < 5; $i++)
                            @if ($i < floor($overallRating[0]))
                                <svg viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @else
                                <svg viewBox="0 0 20 20" fill="#e5e7eb">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endif
                        @endfor
                    </div>
                    <span class="bhpdp-rating-text">{{ number_format($overallRating[0], 1) }} | {{ $overallRating[1] }}
                        Reviews</span>
                    <a class="bhpdp-rating-link" href="#tab-reviews"
                        onclick="bhSwitchTab('reviews')">{{ $countOrder ?? 0 }} orders</a>
                </div>

                {{-- Price Section --}}
                <div class="bhpdp-price-section">
                    <div class="bhpdp-price-row">
                        <span class="bhpdp-price-current">{{ \App\CPU\Helpers::get_price_range($product) }}</span>
                        @if ($product->discount > 0)
                            <span
                                class="bhpdp-price-old">{{ \App\CPU\Helpers::currency_converter($product->unit_price) }}</span>
                            @php
                                $main_discount_percent = 0;
                                if ($product->discount_type == 'percent') {
                                    $main_discount_percent = round($product->discount);
                                } elseif ($product->unit_price > 0) {
                                    $main_discount_percent = round(($product->discount / $product->unit_price) * 100);
                                }
                            @endphp
                            @if ($main_discount_percent > 0)
                                <span class="bhpdp-price-discount">{{ $main_discount_percent }}% OFF</span>
                            @endif
                        @endif
                    </div>
                    <div class="bhpdp-price-mrp" id="bhpdp-selected-variant-label">
                        @if (!empty($product->choice_options) && count(json_decode($product->choice_options)) > 0)
                            @php
                                $firstChoice = json_decode($product->choice_options)[0];
                                $firstOption = trim($firstChoice->options[0] ?? '');
                            @endphp
                            <span style="color:#666; font-size:13px;">{{ $firstChoice->title }}:</span>
                            <strong id="bhpdp-selected-variant-text" style="color:#222;">{{ $firstOption }}</strong>
                        @else
                            MRP: {{ \App\CPU\Helpers::currency_converter($product->unit_price) }}
                        @endif
                    </div>
                    <div class="bhpdp-price-tax">(tax incl.)</div>
                </div>

                <form id="add-to-cart-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">

                    {{-- Colors --}}
                    @if (count(json_decode($product->colors)) > 0)
                        <div class="bhpdp-variant-label">Color</div>
                        <div class="bhpdp-colors">
                            @foreach (json_decode($product->colors) as $key => $color)
                                <label class="bhpdp-color-opt">
                                    <input type="radio" name="color" value="{{ $color }}"
                                        {{ $key == 0 ? 'checked' : '' }}
                                        onchange="focus_preview_image_by_color('{{ str_replace('#', '', $color) }}')">
                                    <span class="bhpdp-color-swatch" style="background: {{ $color }};"></span>
                                </label>
                            @endforeach
                        </div>
                    @endif

                    {{-- Variations --}}
                    @if (!empty($product->choice_options) && count(json_decode($product->choice_options)) > 0)
                        @php
                            $variations_list = !empty($product->variation)
                                ? json_decode($product->variation, true)
                                : [];
                           
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
                                        'title' => $has_multipack_distinction ? 'Single Pack' : $choice->title,
                                        'options' => $single_pack_options,
                                    ];
                                }
                                if (!empty($multipack_options)) {
                                    $groups[] = [
                                        'title' => 'Big Savings on Multipack',
                                        'options' => $multipack_options,
                                    ];
                                }
                            @endphp

                            @foreach ($groups as $group)
                                <div class="bhpdp-variant-label">{{ $group['title'] }}</div>
                                <div class="bhpdp-variant-scroll">
                                    @foreach ($group['options'] as $item)
                                        @php
                                            $option = $item['option'];
                                            $opt_idx = $item['original_index'];
                                            // Trim whitespace & remove spaces for matching
                                            $opt_clean = str_replace(' ', '', trim($option));
                                            
                                            $matched_variant = null;
                                            foreach ($variations_list as $v) {
                                               
                                                if (isset($v['type'])) {
                                                   
                                                    // Also clean the variation type for reliable compare
                                                    $v_type_clean = str_replace(' ', '', trim($v['type']));
                                                      
                                                    if (
                                                        $v_type_clean === $opt_clean ||
                                                        (function_exists('str_ends_with')
                                                            ? str_ends_with($v_type_clean, '-' . $opt_clean) ||
                                                                str_ends_with($v_type_clean, $opt_clean)
                                                            : substr($v_type_clean, -strlen($opt_clean)) === $opt_clean)
                                                    ) {
                                                        $matched_variant = $v;
                                                        
                                                    }
                                                }
                                            }

                                            $v_price = $matched_variant
                                                ? $matched_variant['price']
                                                : $product->unit_price;
                                            $v_discount = \App\CPU\Helpers::get_product_discount($product, $v_price);
                                            $v_final_price = $v_price - $v_discount;
                                            $discount_percent = 0;
                                            if ($v_price > 0 && $v_discount > 0) {
                                                $discount_percent = round(($v_discount / $v_price) * 100);
                                            }

                                            $tag_text = null;
                                            if (!empty($single_pack_options) && $opt_idx == 0) {
                                                $tag_text = 'Best Seller';
                                            } elseif (!empty($multipack_options) && $item === $multipack_options[0]) {
                                                $tag_text = 'Value Pack';
                                            }
                                        @endphp

                                        <label class="bhpdp-variant-card {{ $opt_idx == 0 ? 'active' : '' }}"
                                            onclick="bhSelectVariant(this, '{{ $choice->name }}')"
                                            data-final-price="{{ $v_final_price }}"
                                            data-orig-price="{{ $v_price }}"
                                            data-discount-pct="{{ $discount_percent }}"
                                            data-display-final="{{ \App\CPU\Helpers::currency_converter($v_final_price) }}"
                                            data-display-orig="{{ $v_discount > 0 ? \App\CPU\Helpers::currency_converter($v_price) : '' }}">
                                            <input type="radio" name="{{ $choice->name }}"
                                                value="{{ trim($option) }}" {{ $opt_idx == 0 ? 'checked' : '' }}
                                                style="display:none;">
                                            @if ($discount_percent > 0)
                                                <span class="bhpdp-variant-discount">{{ $discount_percent }}% OFF</span>
                                            @endif
                                            <div class="bhpdp-variant-name">{{ trim($option) }}</div>
                                            <div class="bhpdp-variant-price">
                                                <span
                                                    class="bhpdp-variant-sell">{{ \App\CPU\Helpers::currency_converter($v_final_price) }}</span>
                                                @if ($v_discount > 0)
                                                    <span
                                                        class="bhpdp-variant-original">{{ \App\CPU\Helpers::currency_converter($v_price) }}</span>
                                                @endif
                                            </div>
                                            @if ($tag_text)
                                                <div class="bhpdp-variant-tag">{{ $tag_text }}</div>
                                            @endif
                                        </label>
                                    @endforeach
                                </div>
                            @endforeach
                        @endforeach
                    @endif

                    {{-- Quantity --}}
                    <div class="bhpdp-qty-row">
                        <span class="bhpdp-qty-label">{{ \App\CPU\translate('Quantity') }}</span>
                        <div style="display:flex; align-items:center; gap:14px;">
                            <div class="bhpdp-qty-stepper">
                                <button class="bhpdp-qty-btn btn-number" type="button" data-type="minus"
                                    data-field="quantity" disabled="disabled">-</button>
                                <input type="text" name="quantity" class="bhpdp-qty-input cart-qty-field"
                                    value="{{ $product->minimum_order_qty ?? 1 }}"
                                    product-type="{{ $product->product_type }}"
                                    min="{{ $product->minimum_order_qty ?? 1 }}" max="100">
                                <button class="bhpdp-qty-btn btn-number" type="button"
                                    product-type="{{ $product->product_type }}" data-type="plus"
                                    data-field="quantity">+</button>
                            </div>
                            <div id="chosen_price_div" style="display:flex; align-items:center; gap:6px;">
                                <span style="font-size:13px; color:#999;">Total:</span>
                                <span id="chosen_price" style="font-size:18px; font-weight:700; color:#16a34a;"></span>
                            </div>
                        </div>
                    </div>
                @php
                    $orderCount = $countOrder ?? 0;
                @endphp
                @if ($orderCount > 0)
                    <div class="bhpdp-social-proof">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                        <span>{{ number_format($orderCount) }}+ customers ordered recently</span>
                    </div>
                @endif

                    {{-- Out of Stock --}}
                    <div id="variant-out-of-stock" class="d-none mb-3">
                        <div
                            style="background:#fee2e2; color:#dc2626; font-weight:700; padding:10px 16px; border-radius:10px; text-align:center;">
                            <i class="fa fa-exclamation-triangle me-1"></i> {{ \App\CPU\translate('out_of_stock') }}
                        </div>
                    </div>

                    {{-- Trust Info --}}
                    <div class="bhpdp-trust-row">
                        <div class="bhpdp-trust-item">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z" />
                            </svg>
                            <span>Country of Origin India</span>
                        </div>
                        <div class="bhpdp-trust-item">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z" />
                            </svg>
                            <span>Secure Payments</span>
                        </div>
                        <div class="bhpdp-trust-item">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                            </svg>
                            <span>In stock, Ready to Ship</span>
                        </div>
                    </div>

                    {{-- Pincode Checker --}}
                    <div class="bhpdp-pincode-checker" style="background:#f9fafb; border:1px solid #e5e7eb; border-radius:12px; padding:14px 16px; margin:14px 0;">
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:10px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="#168A3A"><path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg>
                            <span style="font-size:13px; font-weight:700; color:#1c252e;">{{ \App\CPU\translate('Delivery') }}</span>
                        </div>
                        <div style="display:flex; gap:8px;">
                            <input type="text" id="pdp_pincode_input" maxlength="6"
                                placeholder="{{ \App\CPU\translate('Enter delivery pincode') }}"
                                style="flex:1; border:1.5px solid #e5e7eb; border-radius:8px; padding:8px 12px; font-size:13px; outline:none; transition:border-color 0.2s;"
                                onfocus="this.style.borderColor='#168A3A'" onblur="this.style.borderColor='#e5e7eb'"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                            <button type="button" id="pdp_check_pincode_btn"
                                style="background:#168A3A; color:#fff; border:none; border-radius:8px; padding:8px 16px; font-size:13px; font-weight:600; cursor:pointer; transition:background 0.2s; white-space:nowrap;"
                                onmouseover="this.style.background='#0B5D2A'" onmouseout="this.style.background='#168A3A'">
                                {{ \App\CPU\translate('Check') }}
                            </button>
                        </div>
                        <div id="pdp_pincode_result" style="margin-top:10px; display:none;">
                            <div id="pdp_pincode_result_content"></div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="bhpdp-actions">
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
                            <button class="bhpdp-btn-cart btn-add-to-cart" type="button" disabled
                                style="opacity:0.6;">{{ \App\CPU\translate('add_to_cart') }}</button>
                            <button class="bhpdp-btn-buy btn-buy-now" type="button" disabled
                                style="opacity:0.6;">{{ \App\CPU\translate('buy_now') }}</button>
                        @else
                            <button class="bhpdp-btn-cart btn-add-to-cart" onclick="addToCart()" type="button">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
                                </svg>
                                {{ \App\CPU\translate('add_to_cart') }}
                            </button>
                            <button class="bhpdp-btn-buy btn-buy-now" onclick="buy_now()" type="button">
                                {{ \App\CPU\translate('buy_now') }}
                            </button>
                            <button class="bhpdp-btn-oos btn btn-danger btn-oos d-none w-100" type="button" disabled
                                style="flex:1; height:46px; border-radius:10px; font-size:14px; font-weight:600;">
                                <span>{{ \App\CPU\translate('out_of_stock') }}</span>
                            </button>
                        @endif

                        <button type="button" onclick="addWishlist('{{ $product['id'] }}')" class="bhpdp-btn-wish"
                            title="Add to Wishlist">
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
                        <div
                            style="background:#fef3c7; border:1px solid #fde68a; color:#92400e; padding:10px 16px; border-radius:10px; margin-top:10px;">
                            {{ \App\CPU\translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>

        {{-- Sticky Tab Navigation --}}
        <div class="bhpdp-sticky-tabs bg-transparent px-3">
            <div class="bhpdp-tabs-inner" id="bhTabs">
                <button class="bhpdp-tab-btn active" onclick="bhSwitchTab('overview')"
                    data-tab="overview">Overview</button>
                @if (count($product->reviews) > 0 ||
                        ($reviews_of_product = App\Model\Review::where('product_id', $product->id)->count() > 0))
                    <button class="bhpdp-tab-btn" onclick="bhSwitchTab('reviews')" data-tab="reviews">Reviews
                        ({{ $overallRating[1] }})</button>
                @endif
                <button class="bhpdp-tab-btn" onclick="bhSwitchTab('similar')" data-tab="similar">Similar
                    Products</button>
            </div>
        </div>

        {{-- Tab Content --}}
        <div class="bhpdp-tab-content">

            {{-- Overview Tab --}}
            <div class="bhpdp-tab-pane active" id="tab-overview">
                @if ($product->video_url != null && (json_decode($product->images) == null || count(json_decode($product->images)) == 0))
                    <div class="bhpdp-video-wrap">
                        <iframe src="{{ $product->video_url }}" allowfullscreen></iframe>
                    </div>
                @endif

                <div class="bhpdp-desc-card">
                    <div class="bhpdp-desc-title">{{ \App\CPU\translate('overview') }}</div>
                    <div id="product-description" class="bhpdp-desc-content collapsed">
                        {!! $product['details'] !!}
                    </div>
                    @if (!empty($product['details']) && strlen(strip_tags($product['details'])) > 300)
                        <button type="button" class="bhpdp-view-more" onclick="bhToggleDesc()">
                            <span id="bh-desc-text">{{ \App\CPU\translate('View more') }}</span>
                            <svg id="bh-desc-icon" width="14" height="14" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endif
                </div>
            </div>

            {{-- Reviews Tab --}}
            <div class="bhpdp-tab-pane" id="tab-reviews">
                @php
                    $reviews_of_product = App\Model\Review::where('product_id', $product->id)->paginate(2);
                @endphp

                @if ($reviews_of_product->count() > 0)
                    <div class="bhpdp-reviews-summary">
                        <div class="bhpdp-reviews-big-rating">
                            <div class="bhpdp-reviews-big-num">{{ number_format($overallRating[0], 1) }}</div>
                            <div class="bhpdp-reviews-big-stars">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < floor($overallRating[0]))
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="#f59e0b">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @else
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="#e5e7eb">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <div class="bhpdp-reviews-big-count">{{ $reviews_of_product->total() }} ratings</div>
                        </div>

                        <div class="bhpdp-reviews-bars">
                            @php
                                $labels = ['5 Star', '4 Star', '3 Star', '2 Star', '1 Star'];
                                $colors = ['#22c55e', '#3b82f6', '#f59e0b', '#f97316', '#ef4444'];
                            @endphp
                            @foreach ([0, 1, 2, 3, 4] as $idx)
                                @php
                                    $pct = $overallRating[1] != 0 ? ($rating[$idx] / $overallRating[1]) * 100 : 0;
                                @endphp
                                <div class="bhpdp-review-bar-row">
                                    <span class="bhpdp-review-bar-label">{{ $labels[$idx] }}</span>
                                    <div class="bhpdp-review-bar-track">
                                        <div class="bhpdp-review-bar-fill"
                                            style="width:{{ $pct }}%; background:{{ $colors[$idx] }};"></div>
                                    </div>
                                    <span class="bhpdp-review-bar-count">{{ $rating[$idx] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div id="product-review-list">
                    @if (count($product->reviews) == 0)
                        <div style="text-align:center; padding:40px 0; color:#999;">
                            <i class="fa fa-comments-o" style="font-size:40px; margin-bottom:10px; display:block;"></i>
                            <p style="margin:0;">{{ \App\CPU\translate('product_review_not_available') }}</p>
                        </div>
                    @endif
                </div>

                @if (count($product->reviews) > 2)
                    <div style="text-align:center; margin-top:20px;">
                        <button class="bhpdp-view-more" onclick="load_review()">
                            {{ \App\CPU\translate('view more') }}
                        </button>
                    </div>
                @endif
            </div>

            {{-- Similar Products Tab --}}
            <div class="bhpdp-tab-pane" id="tab-similar">
                <div class="bhpdp-section-header">
                    <h3 class="bhpdp-section-title">{{ \App\CPU\translate('Similar Products') }}</h3>
                    @php $category = json_decode($product['category_ids']); @endphp
                    @if ($category)
                        <a class="bhpdp-section-link"
                            href="{{ route('products', ['id' => $category[0]->id, 'data_from' => 'category', 'page' => 1]) }}">
                            {{ \App\CPU\translate('view_all') }} &rarr;
                        </a>
                    @endif
                </div>

                @if (count($relatedProducts) > 0)
                    <div class="bhpdp-similar-slider">
                        @foreach ($relatedProducts->take(6) as $relatedProduct)
                            <div class="bhpdp-similar-item">
                                @include('web-views.partials._single-product', [
                                    'product' => $relatedProduct,
                                    'decimal_point_settings' => $decimal_point_settings ?? 2,
                                ])
                            </div>
                        @endforeach
                    </div>
                @else"
                    <div style="text-align:center; padding:40px 0; color:#999;">
                        <small>{{ \App\CPU\translate('similar') }}
                            {{ \App\CPU\translate('product_not_available') }}</small>
                    </div>
                @endif
            </div>
        </div>
    </div>



    {{-- Sticky Mobile CTA --}}
    <div class="bhpdp-mobile-cta" id="bhpdp-mobile-cta">
        <div class="bhpdp-mobile-cta-inner">
            <button class="bhpdp-btn-cart btn-add-to-cart" onclick="addToCart()" type="button">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
                </svg>
                {{ \App\CPU\translate('add_to_cart') }}
            </button>
            <button class="bhpdp-btn-buy btn-buy-now" onclick="buy_now()" type="button">
                {{ \App\CPU\translate('buy_now') }}
            </button>
            <button class="btn btn-danger btn-oos d-none w-100" type="button" disabled
                style="flex:1; height:44px; border-radius:10px; font-size:14px; font-weight:600;">
                <span>{{ \App\CPU\translate('out_of_stock') }}</span>
            </button>
        </div>
    </div>


    {{-- Attachment View Modal --}}
    <div class="modal fade rtl" id="show-modal-view" tabindex="-1" role="dialog" aria-labelledby="show-modal-image"
        aria-hidden="true" style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius:20px;">
                <div class="modal-body p-2 text-center position-relative">
                    <button class="btn btn-sm btn-circle btn-dark position-absolute"
                        style="top:10px; right:10px; z-index:10;" data-dismiss="modal">
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
            var thumb = document.querySelector('.bhpdp-thumb[data-index="0"]');
            if (thumb) {
                var allThumbs = document.querySelectorAll('.bhpdp-thumb');
                allThumbs.forEach(function(t) {
                    t.classList.remove('active');
                });
                if (thumb) thumb.classList.add('active');
            }
            var track = document.getElementById('bhGalleryTrack');
            if (track) {
                var slides = track.querySelectorAll('.bhpdp-gallery-slide');
                if (slides[0]) slides[0].scrollIntoView({
                    behavior: 'smooth',
                    inline: 'start',
                    block: 'nearest'
                });
            }
        }

        // Gallery Navigation
        var bhCurrentSlide = 0;
        var bhTotalSlides = document.querySelectorAll('.bhpdp-gallery-slide').length;

        function bhGoToSlide(index) {
            var track = document.getElementById('bhGalleryTrack');
            if (!track) return;
            var slides = track.querySelectorAll('.bhpdp-gallery-slide');
            var thumbs = document.querySelectorAll('.bhpdp-thumb');

            if (typeof index === 'string' && index === 'video') {
                index = slides.length - 1;
            }

            if (slides[index]) {
                slides[index].scrollIntoView({
                    behavior: 'smooth',
                    inline: 'start',
                    block: 'nearest'
                });
                bhCurrentSlide = index;

                thumbs.forEach(function(t) {
                    t.classList.remove('active');
                });
                if (thumbs[index]) thumbs[index].classList.add('active');

                var counter = document.getElementById('bhGalleryCounter');
                if (counter) counter.textContent = (index + 1) + ' / ' + bhTotalSlides;
            }
        }

        function bhGalleryPrev() {
            if (bhCurrentSlide > 0) {
                bhGoToSlide(bhCurrentSlide - 1);
            }
        }

        function bhGalleryNext() {
            if (bhCurrentSlide < bhTotalSlides - 1) {
                bhGoToSlide(bhCurrentSlide + 1);
            }
        }

        // Track scroll position to update active thumbnail
        var bhGalleryTrack = document.getElementById('bhGalleryTrack');
        if (bhGalleryTrack) {
            bhGalleryTrack.addEventListener('scroll', function() {
                var scrollLeft = bhGalleryTrack.scrollLeft;
                var slideWidth = bhGalleryTrack.querySelector('.bhpdp-gallery-slide')?.offsetWidth || 1;
                var newIndex = Math.round(scrollLeft / slideWidth);
                if (newIndex !== bhCurrentSlide && newIndex >= 0 && newIndex < bhTotalSlides) {
                    bhCurrentSlide = newIndex;
                    var thumbs = document.querySelectorAll('.bhpdp-thumb');
                    thumbs.forEach(function(t) {
                        t.classList.remove('active');
                    });
                    if (thumbs[newIndex]) thumbs[newIndex].classList.add('active');

                    var counter = document.getElementById('bhGalleryCounter');
                    if (counter) counter.textContent = (newIndex + 1) + ' / ' + bhTotalSlides;
                }
            });
        }

        // Tab Switching
        function bhSwitchTab(tab) {
            var tabs = document.querySelectorAll('.bhpdp-tab-btn');
            var panes = document.querySelectorAll('.bhpdp-tab-pane');

            tabs.forEach(function(t) {
                t.classList.remove('active');
            });
            panes.forEach(function(p) {
                p.classList.remove('active');
            });

            var activeTab = document.querySelector('.bhpdp-tab-btn[data-tab="' + tab + '"]');
            var activePane = document.getElementById('tab-' + tab);

            if (activeTab) activeTab.classList.add('active');
            if (activePane) activePane.classList.add('active');
        }

        // Variant Selection
        function bhSelectVariant(label, name) {
            // Update active card
            var parent = label.closest('.bhpdp-variant-scroll');
            if (parent) {
                parent.querySelectorAll('.bhpdp-variant-card').forEach(function(c) {
                    c.classList.remove('active');
                });
            }
            label.classList.add('active');

            // Update main price display
            var finalPrice = label.getAttribute('data-display-final');
            var origPrice  = label.getAttribute('data-display-orig');
            var discPct    = label.getAttribute('data-discount-pct');

            if (finalPrice) {
                // Sell / current price
                var sellEl = document.querySelector('.bhpdp-price-current');
                if (sellEl) sellEl.textContent = finalPrice;

                // Original / MRP price (strikethrough)
                var origEl = document.querySelector('.bhpdp-price-old');
                if (origEl) {
                    if (origPrice) {
                        origEl.textContent = origPrice;
                        origEl.style.display = '';
                    } else {
                        origEl.style.display = 'none';
                    }
                }

                // Selected variant type label
                var variantTextEl = document.getElementById('bhpdp-selected-variant-text');
                if (variantTextEl) {
                    var variantNameEl = label.querySelector('.bhpdp-variant-name');
                    if (variantNameEl) {
                        variantTextEl.textContent = variantNameEl.textContent.trim();
                    }
                }

                // Discount badge
                var discEl = document.querySelector('.bhpdp-price-discount');
                if (discEl) {
                    if (discPct && parseInt(discPct) > 0) {
                        discEl.textContent = discPct + '% OFF';
                        discEl.style.display = '';
                    } else {
                        discEl.style.display = 'none';
                    }
                }
            }
        }

        // Description Toggle
        function bhToggleDesc() {
            var desc = document.getElementById('product-description');
            var text = document.getElementById('bh-desc-text');
            var icon = document.getElementById('bh-desc-icon');

            if (desc.classList.contains('collapsed')) {
                desc.classList.remove('collapsed');
                text.textContent = "{{ \App\CPU\translate('View less') }}";
                if (icon) icon.style.transform = 'rotate(180deg)';
            } else {
                desc.classList.add('collapsed');
                text.textContent = "{{ \App\CPU\translate('View more') }}";
                if (icon) icon.style.transform = 'rotate(0deg)';
            }
        }

        // Pincode Check - Inline
        $('#pdp_check_pincode_btn').on('click', function() {
            let pincode = $('#pdp_pincode_input').val().trim();
            if (pincode === '' || pincode.length !== 6) {
                toastr.warning('{{ \App\CPU\translate('Please enter a valid 6-digit pincode') }}');
                return;
            }
            let $btn = $(this);
            $btn.attr('disabled', true).text('{{ \App\CPU\translate('Checking...') }}');
            $('#pdp_pincode_result').hide();

            $.ajax({
                type: "POST",
                url: '{{ route("check-pincode") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    pincode: pincode,
                    product_id: '{{ $product->id }}'
                },
                success: function(response) {
                    $btn.removeAttr('disabled').text('{{ \App\CPU\translate('Check') }}');
                    if (response.status === 'success' && response.serviceable) {
                        let codBadge = response.cod_available
                            ? '<div style="display:flex; align-items:center; justify-content:space-between;">'
                            + '<span style="font-size:12px; color:#66706A;">{{ \App\CPU\translate("Cash on Delivery") }}</span>'
                            + '<span style="font-size:12px; font-weight:600; color:#168A3A;"><i class="fa fa-check-circle" style="margin-right:3px;"></i>{{ \App\CPU\translate("Available") }}</span>'
                            + '</div>'
                            : '<div style="display:flex; align-items:center; justify-content:space-between;">'
                            + '<span style="font-size:12px; color:#66706A;">{{ \App\CPU\translate("Cash on Delivery") }}</span>'
                            + '<span style="font-size:12px; font-weight:600; color:#dc2626;"><i class="fa fa-times-circle" style="margin-right:3px;"></i>{{ \App\CPU\translate("Not Available") }}</span>'
                            + '</div>';

                        let html = '<div style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:8px; padding:12px;">'
                            + '<div style="display:flex; align-items:center; gap:6px; margin-bottom:8px;">'
                            + '<i class="fa fa-check-circle" style="color:#16a34a; font-size:14px;"></i>'
                            + '<span style="font-size:12px; font-weight:600; color:#16a34a;">{{ \App\CPU\translate("Delivery Available") }}</span>'
                            + '</div>'
                            + '<div style="display:flex; flex-direction:column; gap:6px;">'
                            + '<div style="display:flex; align-items:center; justify-content:space-between;">'
                            + '<span style="font-size:12px; color:#66706A;">{{ \App\CPU\translate("Estimated Delivery") }}</span>'
                            + '<span style="font-size:12px; font-weight:600; color:#1c252e;">' + response.estimated_delivery + '</span>'
                            + '</div>'
                            + '<div style="display:flex; align-items:center; justify-content:space-between;">'
                            + '<span style="font-size:12px; color:#66706A;">{{ \App\CPU\translate("Delivery Charge") }}</span>'
                            + '<span style="font-size:12px; font-weight:600; color:#168A3A;">' + response.delivery_cost_text + '</span>'
                            + '</div>'
                            + codBadge
                            + '</div>'
                            + '</div>';
                        $('#pdp_pincode_result_content').html(html);
                    } else {
                        let html = '<div style="background:#fef2f2; border:1px solid #fecaca; border-radius:8px; padding:12px; display:flex; align-items:center; gap:8px;">'
                            + '<i class="fa fa-times-circle" style="color:#dc2626; font-size:14px;"></i>'
                            + '<span style="font-size:12px; font-weight:600; color:#dc2626;">{{ \App\CPU\translate("Delivery not available for this pincode") }}</span>'
                            + '</div>';
                        $('#pdp_pincode_result_content').html(html);
                    }
                    $('#pdp_pincode_result').show();
                },
                error: function() {
                    $btn.removeAttr('disabled').text('{{ \App\CPU\translate('Check') }}');
                    toastr.error('{{ \App\CPU\translate('Error checking pincode. Please try again.') }}');
                }
            });
        });

        // Allow Enter key to check pincode
        $('#pdp_pincode_input').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#pdp_check_pincode_btn').click();
            }
        });

        // Load Reviews
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
@endpush
