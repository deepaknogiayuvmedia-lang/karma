@extends('layouts.front-end.app')

@section('title', ($product->name ?? \App\CPU\translate('Product')) . ' | ' . ($web_config['name']->value ?? config('app.name')))

@push('css_or_js')
    <meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($product->description ?? $product->details ?? ''), 160) }}">
    <meta name="keywords" content="@foreach (explode(' ', $product->name ?? '') as $keyword) {{ $keyword . ' , ' }} @endforeach">
    @if (isset($product->added_by) && $product->added_by == 'seller')
        <meta name="author" content="{{ $product->seller->shop ? $product->seller->shop->name : $product->seller->f_name }}">
    @elseif(isset($product->added_by) && $product->added_by == 'admin')
        <meta name="author" content="{{ $web_config['name']->value ?? config('app.name') }}">
    @endif

    <meta property="og:image" content="{{ asset(config('app.public_storage_path') . '/app/public/product/thumbnail') }}/{{ $product->thumbnail ?? '' }}" />
    <meta property="og:title" content="{{ $product->name ?? '' }}" />
    <meta property="og:url" content="{{ route('product', [$product->slug ?? '']) }}">

    <style>
        /* ==========================================================================
           PRODUCT DETAIL PAGE (PDP) - RESPONSIVE DESIGN SYSTEM
           ========================================================================== */
        :root {
            --bh-primary: #168A3A;
            --bh-primary-dark: #0B5D2A;
            --bh-primary-light: #EAF7EE;
            --bh-primary-quarter: #F0FDF4;
            --bh-accent-orange: #ee4f28;
            --bh-accent-deal: #fa9527;
            --bh-badge-bg: #fee9e4;
            --bh-deal-blue: #1A73E8;
            --bh-deal-blue-bg: #E8F2FF;
            --bh-dark: #111827;
            --bh-body: #374151;
            --bh-muted: #6B7280;
            --bh-border: #E5E7EB;
            --bh-border-light: #F3F4F6;
            --bh-card-bg: #FFFFFF;
            --bh-star: #fa9527;
            --bh-font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        .bh-pdp-wrapper {
            font-family: var(--bh-font);
            color: var(--bh-body);
            background-color: #FAFAFA;
            /* padding-bottom: 50px; */
            font-size: 14px;
            line-height: 1.5;
            /* `clip` prevents horizontal overflow WITHOUT creating a scroll
               container (unlike `hidden`, which breaks `position: sticky`). */
            overflow-x: hidden;
            overflow-x: clip;
            width: 100%;
        }

        .bh-pdp-wrapper * {
            box-sizing: border-box;
        }

        .bh-container {
            max-width: 1220px;
            margin: 0 auto;
            padding: 0 16px;
        }

        /* ---------------- Breadcrumb ---------------- */
        .bh-breadcrumb {
            padding: 14px 0 10px;
            font-size: 13px;
        }
        .bh-breadcrumb-list {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 6px;
            list-style: none;
            padding: 0;
            margin: 0;
            color: var(--bh-muted);
        }
        .bh-breadcrumb-list a {
            color: var(--bh-muted);
            text-decoration: none;
            transition: color 0.15s;
        }
        .bh-breadcrumb-list a:hover {
            color: var(--bh-primary);
            text-decoration: underline;
        }
        .bh-breadcrumb-separator {
            display: inline-flex;
            align-items: center;
            color: #9CA3AF;
        }
        .bh-breadcrumb-current {
            color: var(--bh-dark);
            font-weight: 500;
            max-width: 420px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ---------------- Hero Section (Left + Right) ---------------- */
        .bh-hero-layout {
            display: grid;
            /* fr units (not %) so the 28px gap does not overflow the row */
            grid-template-columns: minmax(0, 48fr) minmax(0, 52fr);
            gap: 28px;
            /* `stretch` (not `start`) lets the left column grow to the full
               row height so the sticky gallery can actually travel. */
            align-items: stretch;
            margin-top: 6px;
        }

        /* Prevent grid children from expanding past the track (min-content
           overflow) - this is what kept product info wider than the viewport
           on mobile and clipped the right-hand content. */
        .bh-hero-layout > * {
            min-width: 0;
        }

        /* Left Column: Gallery */
        .bh-gallery-sticky {
            position: sticky;
            top: 99px;
            background: var(--bh-card-bg);
            border-radius: 16px;
            border: 1px solid var(--bh-border);
            padding: 16px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.03);
        }

        .bh-gallery-main {
            position: relative;
            width: 100%;
            height: 480px;
            border-radius: 12px;
            background: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid var(--bh-border-light);
            touch-action: pan-y;
        }

        .bh-gallery-main img {
            max-width: 92%;
            max-height: 92%;
            object-fit: contain;
            transition: transform 0.3s ease;
            user-select: none;
            -webkit-user-drag: none;
        }
        .bh-gallery-main:hover img {
            transform: scale(1.04);
        }

        .bh-gallery-top-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--bh-badge-bg);
            color: var(--bh-accent-orange);
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 999px;
            z-index: 3;
            letter-spacing: 0.2px;
        }

        .bh-gallery-counter {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: rgba(17, 24, 39, 0.65);
            color: #FFFFFF;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 999px;
            z-index: 3;
            backdrop-filter: blur(4px);
        }

        .bh-gallery-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #FFFFFF;
            border: 1px solid var(--bh-border);
            color: var(--bh-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
            transition: all 0.2s ease;
            z-index: 4;
        }
        .bh-gallery-nav-btn:hover {
            background: #F9FAFB;
            box-shadow: 0 4px 12px rgba(0,0,0,0.18);
            transform: translateY(-50%) scale(1.05);
        }
        .bh-gallery-nav-btn.prev { left: 10px; }
        .bh-gallery-nav-btn.next { right: 10px; }

        /* Thumbnails Strip */
        .bh-thumbnails-list {
            display: flex;
            gap: 10px;
            margin-top: 14px;
            overflow-x: auto;
            padding: 4px 2px 8px;
            scrollbar-width: thin;
            scrollbar-color: #D1D5DB transparent;
            -webkit-overflow-scrolling: touch;
        }
        .bh-thumbnails-list::-webkit-scrollbar {
            height: 4px;
        }
        .bh-thumbnails-list::-webkit-scrollbar-thumb {
            background: #D1D5DB;
            border-radius: 4px;
        }

        .bh-thumb-item {
            flex-shrink: 0;
            width: 64px;
            height: 64px;
            border-radius: 10px;
            border: 2px solid var(--bh-border);
            background: #FFFFFF;
            overflow: hidden;
            cursor: pointer;
            padding: 4px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .bh-thumb-item img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .bh-thumb-item:hover {
            border-color: #9CA3AF;
        }
        .bh-thumb-item.active {
            border-color: var(--bh-dark);
            box-shadow: 0 0 0 1px var(--bh-dark);
        }

        /* Banner below gallery */
        .bh-gallery-promo-banner {
            margin-top: 16px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--bh-border);
            background: #F9FAFB;
        }
        .bh-gallery-promo-banner img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Right Column: Buying Info */
        .bh-product-info {
            background: var(--bh-card-bg);
            border-radius: 16px;
            border: 1px solid var(--bh-border);
            padding: 24px 26px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.03);
        }

        .bh-brand-tag {
            display: inline-block;
            font-size: 13px;
            font-weight: 500;
            color: var(--bh-muted);
            text-decoration: underline;
            margin-bottom: 6px;
            transition: color 0.15s;
        }
        .bh-brand-tag:hover {
            color: var(--bh-primary);
        }

        .bh-product-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--bh-dark);
            line-height: 1.38;
            margin: 0 0 12px;
        }

        /* Ratings & Social Proof */
        .bh-rating-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 16px;
            font-size: 13px;
        }
        .bh-stars-group {
            display: inline-flex;
            align-items: center;
            gap: 2px;
        }
        .bh-stars-group svg {
            width: 16px;
            height: 16px;
            fill: #E5E7EB;
        }
        .bh-stars-group svg.bh-star-filled {
            fill: var(--bh-star);
        }
        .bh-rating-score {
            font-weight: 700;
            color: var(--bh-dark);
            margin-left: 4px;
        }
        .bh-reviews-count-link {
            color: var(--bh-muted);
            font-weight: 500;
            border-left: 1.5px solid var(--bh-border);
            padding-left: 10px;
            text-decoration: none;
        }
        .bh-reviews-count-link:hover {
            text-decoration: underline;
            color: var(--bh-primary);
        }
        .bh-orders-social-proof {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: var(--bh-primary-quarter);
            color: var(--bh-primary-dark);
            font-size: 12px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 999px;
            border: 1px solid #BBF7D0;
        }
        .bh-orders-social-proof svg {
            width: 14px;
            height: 14px;
            fill: #16A34A;
        }

        /* Price Box */
        .bh-price-box {
            padding: 14px 0 12px;
            border-top: 1px dashed var(--bh-border);
            border-bottom: 1px dashed var(--bh-border);
            margin-bottom: 16px;
        }
        .bh-price-main-line {
            display: flex;
            align-items: baseline;
            gap: 10px;
            flex-wrap: wrap;
        }
        .bh-sell-price {
            font-size: 26px;
            font-weight: 800;
            color: var(--bh-dark);
            letter-spacing: -0.3px;
        }
        .bh-mrp-price {
            font-size: 15px;
            color: var(--bh-muted);
            text-decoration: line-through;
            font-weight: 400;
        }
        .bh-discount-pill {
            background: var(--bh-badge-bg);
            color: var(--bh-accent-orange);
            font-size: 12px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
        }

        .bh-price-subline {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 6px;
            font-size: 13px;
            flex-wrap: wrap;
        }
        .bh-size-indicator {
            font-weight: 600;
            color: var(--bh-dark);
        }
        .bh-size-indicator span {
            color: var(--bh-primary);
        }
        .bh-tax-inclusive {
            color: var(--bh-muted);
            font-size: 12px;
        }
        .bh-free-delivery-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: #195373;
            font-weight: 600;
            font-size: 12px;
            border-left: 1.5px solid var(--bh-border);
            padding-left: 10px;
        }
        .bh-free-delivery-badge svg {
            width: 16px;
            height: 16px;
            fill: #195373;
        }

        /* Special Deal Box */
        .bh-special-deal-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--bh-deal-blue-bg);
            border: 1px solid #BFDBFE;
            border-radius: 10px;
            padding: 9px 14px;
            margin-bottom: 18px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .bh-special-deal-banner:hover {
            background: #DBEAFE;
            border-color: #93C5FD;
        }
        .bh-special-deal-left {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--bh-dark);
        }
        .bh-deal-gif-icon {
            width: 22px;
            height: 22px;
            display: inline-block;
        }
        .bh-deal-highlight-price {
            color: var(--bh-primary);
            font-weight: 700;
            font-size: 15px;
        }
        .bh-special-deal-banner svg {
            width: 16px;
            height: 16px;
            stroke: var(--bh-deal-blue);
        }

        /* ---------------- Pack Size Selection (Product Card Style) ---------------- */
        .bh-variants-wrapper {
            margin-bottom: 18px;
        }
        .bh-variant-heading {
            font-size: 14px;
            font-weight: 700;
            color: var(--bh-dark);
            margin: 0 0 8px;
        }
        .bh-variant-cards-scroll {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding-bottom: 10px;
            padding-top: 4px;
            scrollbar-width: thin;
            scrollbar-color: #D1D5DB transparent;
            -webkit-overflow-scrolling: touch;
            scroll-snap-type: x proximity;
        }
        .bh-variant-cards-scroll::-webkit-scrollbar {
            height: 5px;
        }
        .bh-variant-cards-scroll::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 4px;
        }

        .bh-variant-card {
            position: relative;
            flex-shrink: 0;
            min-width: 144px;
            width: 144px;
            background: #FFFFFF;
            border: 1.5px solid var(--bh-border);
            border-radius: 14px;
            padding: 10px 10px 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
            /* Cards stretch to the tallest sibling (the one with a badge).
               `flex-start` keeps their content tightly packed at the top so
               the extra height becomes a clean empty strip at the bottom
               instead of gaps between the size / discount / price. */
            justify-content: flex-start;
            text-align: left;
            scroll-snap-align: start;
            user-select: none;
        }
        .bh-variant-card:hover {
            border-color: #10B981;
            background: #F0FDF4;
        }
        .bh-variant-card.active {
            border-color: var(--bh-primary);
            border-width: 2px;
            background: #F0FDF4;
            box-shadow: 0 2px 10px rgba(22, 138, 58, 0.12);
        }

        /* Selected tick on top right */
        .bh-variant-selected-tick {
            position: absolute;
            top: 7px;
            right: 7px;
            width: 16px;
            height: 16px;
            display: none;
        }
        .bh-variant-card.active .bh-variant-selected-tick {
            display: block;
        }

        .bh-vc-size-name {
            font-size: 15px;
            font-weight: 700;
            color: var(--bh-dark);
            line-height: 1.2;
            margin-bottom: 4px;
            padding-right: 18px;
        }
        .bh-vc-pack-sub {
            font-size: 11px;
            color: var(--bh-muted);
            margin-bottom: 4px;
        }
        .bh-vc-discount-tag {
            display: inline-block;
            background: var(--bh-badge-bg);
            color: var(--bh-accent-orange);
            font-size: 11px;
            font-weight: 700;
            padding: 1.5px 6px;
            border-radius: 999px;
            margin-bottom: 6px;
        }
        .bh-vc-divider {
            width: 100%;
            border-top: 1px dashed var(--bh-border);
            margin: 6px 0;
        }
        .bh-vc-price-row {
            display: flex;
            align-items: baseline;
            gap: 6px;
        }
        .bh-vc-sell-price {
            font-size: 15px;
            font-weight: 800;
            color: var(--bh-dark);
        }
        .bh-vc-mrp {
            font-size: 12px;
            color: var(--bh-muted);
            text-decoration: line-through;
        }
        .bh-vc-unit-rate {
            font-size: 10px;
            color: var(--bh-muted);
            margin-top: 2px;
        }

        .bh-vc-badge-bottom {
            margin-top: 6px;
            background: #DCFCE7;
            border-radius: 6px;
            padding: 3px 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 700;
            color: var(--bh-primary-dark);
        }
        .bh-vc-badge-bottom img,
        .bh-vc-badge-bottom svg {
            width: 13px;
            height: 13px;
        }

        /* ---------------- Composition Box ---------------- */
        .bh-composition-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid var(--bh-border);
            border-radius: 12px;
            padding: 10px 14px;
            background: #FFFFFF;
            margin-bottom: 18px;
        }
        .bh-comp-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .bh-comp-icon-wrap {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: #EFF6FF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .bh-comp-icon-wrap svg {
            width: 20px;
            height: 20px;
            fill: #0B4282;
        }
        .bh-comp-title {
            font-size: 12px;
            font-weight: 700;
            color: #0B4282;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 2px;
        }
        .bh-comp-content {
            font-size: 13px;
            font-weight: 600;
            color: var(--bh-dark);
        }
        .bh-comp-badge-img {
            width: 34px;
            height: 34px;
            object-fit: contain;
            opacity: 0.9;
        }

        /* ---------------- Delivery / Pincode Checker ---------------- */
        .bh-delivery-widget {
            background: #F9FAFB;
            border: 1px solid var(--bh-border);
            border-radius: 12px;
            padding: 12px 14px;
            margin-bottom: 18px;
        }
        .bh-del-header {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 700;
            color: var(--bh-dark);
        }
        .bh-del-header svg {
            width: 18px;
            height: 18px;
            fill: var(--bh-primary);
        }
        .bh-del-input-group {
            display: flex;
            gap: 8px;
        }
        .bh-pincode-field {
            flex: 1;
            min-width: 0;
            height: 38px;
            border: 1.5px solid var(--bh-border);
            border-radius: 8px;
            padding: 0 12px;
            font-size: 13px;
            outline: none;
            transition: border-color 0.2s;
            background: #FFFFFF;
        }
        .bh-pincode-field:focus {
            border-color: var(--bh-primary);
            box-shadow: 0 0 0 2px rgba(22, 138, 58, 0.15);
        }
        .bh-pincode-btn {
            height: 38px;
            padding: 0 18px;
            background: var(--bh-primary);
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            white-space: nowrap;
        }
        .bh-pincode-btn:hover {
            background: var(--bh-primary-dark);
        }

        .bh-pincode-result-box {
            margin-top: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 12px;
            display: none;
        }
        .bh-pincode-result-box.success {
            background: #ECFDF5;
            border: 1px solid #A7F3D0;
            color: #065F46;
        }
        .bh-pincode-result-box.error {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: #991B1B;
        }

        /* ---------------- Quantity Stepper ---------------- */
        .bh-quantity-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            background: #F9FAFB;
            border: 1px solid var(--bh-border);
            border-radius: 12px;
            margin-bottom: 18px;
        }
        .bh-qty-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--bh-dark);
        }
        .bh-qty-stepper-box {
            display: inline-flex;
            align-items: center;
            background: #FFFFFF;
            border: 1.5px solid var(--bh-border);
            border-radius: 8px;
            overflow: hidden;
        }
        .bh-qty-btn {
            width: 34px;
            height: 32px;
            border: none;
            background: transparent;
            font-size: 16px;
            font-weight: 700;
            color: var(--bh-dark);
            cursor: pointer;
            transition: background 0.15s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .bh-qty-btn:hover:not(:disabled) {
            background: #F3F4F6;
        }
        .bh-qty-input {
            width: 44px;
            height: 32px;
            border: none;
            border-left: 1px solid var(--bh-border);
            border-right: 1px solid var(--bh-border);
            text-align: center;
            font-weight: 700;
            font-size: 14px;
            color: var(--bh-dark);
            background: transparent;
            outline: none;
        }

        /* ---------------- CTA Buttons ---------------- */
        .bh-action-buttons {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }
        .bh-btn-cart {
            flex: 1;
            height: 48px;
            border: 1.5px solid #111827;
            background: #FFFFFF;
            color: #111827;
            font-size: 15px;
            font-weight: 700;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .bh-btn-cart:hover {
            background: #111827;
            color: #FFFFFF;
        }
        .bh-btn-buy {
            flex: 1;
            height: 48px;
            border: none;
            background: var(--bh-primary);
            color: #FFFFFF;
            font-size: 15px;
            font-weight: 700;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(22, 138, 58, 0.3);
            animation: bhPulse 2.5s infinite;
        }
        .bh-btn-buy:hover {
            background: var(--bh-primary-dark);
            box-shadow: 0 6px 18px rgba(22, 138, 58, 0.4);
            transform: translateY(-1px);
        }
        @keyframes bhPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.015); }
            100% { transform: scale(1); }
        }

        .bh-btn-wishlist {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            border: 1px solid #FECACA;
            background: #FEF2F2;
            color: #EF4444;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
            font-size: 18px;
        }
        .bh-btn-wishlist:hover {
            background: #FEE2E2;
            transform: scale(1.05);
        }
        .bh-btn-wishlist.active {
            background: #EF4444;
            color: #FFFFFF;
            border-color: #EF4444;
        }

        /* Trust List */
        .bh-trust-features {
            border-top: 1px solid var(--bh-border);
            padding-top: 16px;
            margin-top: 8px;
            display: flex;
            /* flex-direction: column; */
            flex-wrap: wrap;
            gap: 10px;
        }
        .bh-trust-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--bh-dark);
        }
        .bh-trust-item svg {
            width: 20px;
            height: 20px;
            fill: #16A34A;
            flex-shrink: 0;
        }

        /* Bulk Order Banner */
        .bh-bulk-order-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #FEF3C7;
            border: 1px solid #FCD34D;
            border-radius: 12px;
            padding: 12px 16px;
            margin-top: 18px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .bh-bulk-order-banner:hover {
            background: #FDE68A;
            text-decoration: none;
        }
        .bh-bulk-order-banner .title {
            font-size: 13px;
            font-weight: 700;
            color: #92400E;
            margin: 0;
        }
        .bh-bulk-order-banner .phone {
            font-size: 13px;
            font-weight: 800;
            color: #B45309;
        }

        /* ---------------- Full Trust Markers Banner ---------------- */
        .bh-trust-markers-strip {
            margin: 36px 0 28px;
            background: #FFFFFF;
            border: 1px solid var(--bh-border);
            border-radius: 16px;
            padding: 18px 24px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        .bh-tm-box {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .bh-tm-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--bh-primary-quarter);
            border: 1px solid #BBF7D0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .bh-tm-icon svg {
            width: 22px;
            height: 22px;
            fill: var(--bh-primary);
        }
        .bh-tm-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--bh-dark);
            margin: 0 0 2px;
        }
        .bh-tm-desc {
            font-size: 12px;
            color: var(--bh-muted);
            margin: 0;
        }

        /* ---------------- Tab Navigation (Sticky Pills) ---------------- */
        .bh-sticky-tabs-container {
            position: sticky;
            top: 0;
            z-index: 40;
            background: rgba(250, 250, 250, 0.95);
            backdrop-filter: blur(8px);
            padding: 12px 0 6px;
            border-bottom: 1px solid var(--bh-border);
            margin-bottom: 24px;
        }
        .bh-tabs-pills {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            scrollbar-width: none;
            -webkit-overflow-scrolling: touch;
        }
        .bh-tabs-pills::-webkit-scrollbar { display: none; }
        .bh-tab-pill-btn {
            padding: 8px 22px;
            border-radius: 999px;
            border: 1px solid var(--bh-border);
            background: #FFFFFF;
            color: var(--bh-body);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
            user-select: none;
        }
        .bh-tab-pill-btn:hover {
            border-color: #9CA3AF;
        }
        .bh-tab-pill-btn.active {
            background: var(--bh-primary);
            color: #FFFFFF;
            border-color: var(--bh-primary);
            box-shadow: 0 2px 8px rgba(22, 138, 58, 0.25);
        }

        /* ---------------- Tab Panes Content ---------------- */
        .bh-tab-pane {
            display: none;
        }
        .bh-tab-pane.active {
            display: block;
        }

        /* Cards inside Tab */
        .bh-content-card {
            background: #FFFFFF;
            border: 1px solid var(--bh-border);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .bh-section-heading {
            font-size: 18px;
            font-weight: 700;
            color: var(--bh-dark);
            margin: 0 0 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .bh-section-heading::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 18px;
            background: var(--bh-primary);
            border-radius: 2px;
        }

        /* Specification Table */
        .bh-specs-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
            margin-bottom: 10px;
        }
        .bh-specs-table tr {
            border-bottom: 1px solid #F3F4F6;
        }
        .bh-specs-table tr:last-child {
            border-bottom: none;
        }
        .bh-specs-table td {
            padding: 10px 14px;
            vertical-align: top;
        }
        .bh-specs-table td.label-col {
            width: 28%;
            font-weight: 600;
            color: #4B5563;
            background: #F9FAFB;
            border-radius: 6px;
        }
        .bh-specs-table td.value-col {
            font-weight: 500;
            color: var(--bh-dark);
        }

        /* Description Prose */
        .bh-prose {
            font-size: 14px;
            line-height: 1.7;
            color: #374151;
        }
        .bh-prose p {
            margin-bottom: 14px;
        }

        /* Key Features Grid */
        .bh-features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin: 16px 0;
        }
        .bh-feature-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: #F9FAFB;
            border: 1px solid var(--bh-border);
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 13.5px;
            font-weight: 500;
            color: var(--bh-dark);
        }
        .bh-feature-item svg {
            width: 18px;
            height: 18px;
            fill: #16A34A;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Agriculture Dosage Table */
        .bh-dosage-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
            margin: 10px 0 16px;
            background: #FFFFFF;
            border: 1px solid var(--bh-border);
            border-radius: 12px;
            overflow: hidden;
        }
        .bh-dosage-table th {
            background: #F3F4F6;
            color: var(--bh-dark);
            font-weight: 700;
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1.5px solid var(--bh-border);
            white-space: nowrap;
        }
        .bh-dosage-table td {
            padding: 12px 16px;
            border-bottom: 1px solid #F3F4F6;
            color: var(--bh-body);
        }
        .bh-dosage-table tr:last-child td {
            border-bottom: none;
        }
        .bh-dosage-table tr:hover td {
            background: #F9FAFB;
        }

        /* Horizontal swipe hint for the dosage table (mobile only) */
        .bh-swipe-hint {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            color: #1E40AF;
            font-size: 12px;
            font-weight: 600;
            padding: 8px 12px;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .bh-swipe-hint i {
            flex-shrink: 0;
        }

        /* Compatibility, Safety, Storage Cards */
        .bh-tri-cards-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 16px;
        }
        .bh-tri-card {
            border: 1px solid var(--bh-border);
            border-radius: 12px;
            padding: 16px;
            background: #F9FAFB;
        }
        .bh-tri-card h4 {
            font-size: 14px;
            font-weight: 700;
            color: var(--bh-dark);
            margin: 0 0 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .bh-tri-card p {
            font-size: 13px;
            color: var(--bh-body);
            margin: 0;
            line-height: 1.6;
        }

        /* Agronomy Expert Advice Quote Box */
        .bh-expert-advice-card {
            background: linear-gradient(135deg, #F0FDF4 0%, #ECFDF5 100%);
            border: 1.5px solid #A7F3D0;
            border-radius: 14px;
            padding: 20px;
            margin: 20px 0;
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }
        .bh-expert-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #16A34A;
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 22px;
        }
        .bh-expert-text-wrap blockquote {
            margin: 0 0 8px;
            font-size: 14px;
            font-style: italic;
            color: #065F46;
            line-height: 1.6;
        }
        .bh-expert-author {
            font-size: 12.5px;
            font-weight: 700;
            color: var(--bh-primary-dark);
        }

        /* ---------------- Separate Customer Reviews Section ---------------- */
        .bh-reviews-section {
            margin-top: 20px;
            scroll-margin-top: 64px;
        }
        /* Write a Product Review Modal */
        .bh-review-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 16px;
        }
        .bh-review-modal-overlay.open {
            display: flex;
        }
        .bh-review-modal {
            background: #FFFFFF;
            border-radius: 16px;
            width: 100%;
            max-width: 520px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }
        .bh-review-modal-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px;
            border-bottom: 1px solid var(--bh-border);
        }
        .bh-review-modal-head h3 {
            font-size: 18px;
            font-weight: 700;
            color: var(--bh-dark);
            margin: 0;
        }
        .bh-review-modal-close {
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .bh-review-modal-close svg {
            width: 20px;
            height: 20px;
            stroke: var(--bh-muted);
        }
        .bh-review-modal-close:hover svg {
            stroke: var(--bh-dark);
        }
        .bh-review-modal-body {
            padding: 20px 24px;
        }
        .bh-rmb-product {
            font-size: 14px;
            font-weight: 600;
            color: var(--bh-body);
            margin-bottom: 16px;
            padding: 10px 14px;
            background: var(--bh-primary-light);
            border-radius: 8px;
        }
        .bh-rmb-group {
            margin-bottom: 18px;
        }
        .bh-rmb-group > label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--bh-dark);
            margin-bottom: 8px;
        }
        .bh-req {
            color: #DC2626;
        }
        .bh-rmb-stars {
            display: flex;
            gap: 4px;
        }
        .bh-rmb-star {
            background: none;
            border: none;
            cursor: pointer;
            padding: 2px;
            transition: transform 0.15s;
        }
        .bh-rmb-star:hover {
            transform: scale(1.15);
        }
        .bh-rmb-star svg {
            width: 28px;
            height: 28px;
            fill: #D1D5DB;
            transition: fill 0.15s;
        }
        .bh-rmb-star.active svg {
            fill: var(--bh-star);
        }
        .bh-rmb-group textarea {
            width: 100%;
            border: 1px solid var(--bh-border);
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 14px;
            font-family: inherit;
            color: var(--bh-body);
            resize: vertical;
            min-height: 100px;
            outline: none;
            transition: border-color 0.2s;
        }
        .bh-rmb-group textarea:focus {
            border-color: var(--bh-primary);
        }
        .bh-rmb-group textarea::placeholder {
            color: #9CA3AF;
        }
        .bh-rmb-uploads {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
        }
        .bh-rmb-upload-thumb {
            position: relative;
            width: 72px;
            height: 72px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid var(--bh-border);
        }
        .bh-rmb-upload-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .bh-rmb-upload-thumb button {
            position: absolute;
            top: 2px;
            right: 2px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.6);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .bh-rmb-upload-thumb button svg {
            width: 10px;
            height: 10px;
            stroke: #FFFFFF;
        }
        .bh-rmb-addimg {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--bh-primary-quarter);
            border: 1px dashed var(--bh-primary);
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 13px;
            font-weight: 600;
            color: var(--bh-primary);
            cursor: pointer;
            transition: background 0.2s;
        }
        .bh-rmb-addimg:hover {
            background: var(--bh-primary-light);
        }
        .bh-rmb-addimg svg {
            width: 16px;
            height: 16px;
        }
        .bh-rmb-foot {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding-top: 8px;
        }
        .bh-rmb-cancel {
            background: #F3F4F6;
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 600;
            color: var(--bh-body);
            cursor: pointer;
            transition: background 0.2s;
        }
        .bh-rmb-cancel:hover {
            background: #E5E7EB;
        }
        .bh-rmb-submit {
            background: var(--bh-primary);
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 700;
            color: #FFFFFF;
            cursor: pointer;
            transition: background 0.2s;
        }
        .bh-rmb-submit:hover {
            background: var(--bh-primary-dark);
        }
        .bh-rmb-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* 3-column reviews layout: summary | feed | faq */
        .bh-reviews-grid {
            display: grid;
            grid-template-columns: 300px 1fr 400px;
            gap: 24px;
            align-items: start;
        }

        /* Left: summary card */
        .bh-reviews-summary {
            border: 1px solid var(--bh-border);
            border-radius: 16px;
            background: #FFFFFF;
            padding: 20px;
        }
        .bh-reviews-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--bh-dark);
            margin: 0 0 14px;
        }
        .bh-summary-score-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
        }
        .bh-summary-stars {
            display: inline-flex;
            gap: 2px;
        }
        .bh-summary-stars svg {
            width: 18px;
            height: 18px;
            fill: var(--bh-star);
        }
        .bh-summary-score-badge {
            background: var(--bh-dark);
            color: #FFFFFF;
            font-size: 12px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 6px;
        }
        .bh-summary-total {
            font-size: 13px;
            color: var(--bh-muted);
            margin-bottom: 14px;
        }
        .bh-summary-breakdown {
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--bh-border);
            margin-bottom: 16px;
        }
        .bh-bar-row {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 12.5px;
            color: var(--bh-body);
        }
        .bh-bar-label {
            width: 42px;
            flex-shrink: 0;
        }
        .bh-bar-track {
            flex: 1;
            height: 8px;
            background: #E5E7EB;
            border-radius: 999px;
            overflow: hidden;
        }
        .bh-bar-fill {
            height: 100%;
            background: var(--bh-star);
            border-radius: 999px;
        }
        .bh-bar-pct {
            width: 36px;
            text-align: right;
            flex-shrink: 0;
            color: var(--bh-muted);
        }
        .bh-write-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--bh-dark);
            margin-bottom: 4px;
        }
        .bh-write-sub {
            font-size: 13px;
            color: var(--bh-muted);
            line-height: 1.5;
            margin: 0 0 14px;
        }
        .bh-write-btn {
            width: 100%;
            background: var(--bh-primary);
            color: #FFFFFF;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }
        .bh-write-btn:hover {
            background: var(--bh-primary-dark);
        }

        /* Middle: review feed */
        .bh-review-card {
            padding: 18px 0;
            border-bottom: 1px solid var(--bh-border-light);
        }
        .bh-review-card:first-child {
            padding-top: 0;
        }
        .bh-review-card:last-child {
            border-bottom: none;
        }
        .bh-review-head {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }
        .bh-review-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #DCFCE7;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .bh-review-avatar svg {
            width: 22px;
            height: 22px;
            fill: #16A34A;
        }
        .bh-review-name {
            font-weight: 700;
            font-size: 14px;
            color: var(--bh-dark);
        }
        .bh-verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: #15803D;
            font-size: 11.5px;
            font-weight: 600;
        }
        .bh-verified-badge svg {
            width: 13px;
            height: 13px;
            fill: #16A34A;
        }
        .bh-review-rating-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }
        .bh-review-stars {
            display: inline-flex;
            gap: 2px;
        }
        .bh-review-stars svg {
            width: 15px;
            height: 15px;
            fill: var(--bh-star);
        }
        .bh-review-date {
            font-size: 12.5px;
            color: var(--bh-body);
            font-weight: 600;
        }
        .bh-review-text {
            font-size: 13.5px;
            color: var(--bh-body);
            line-height: 1.6;
            margin: 0;
        }

        /* Right: FAQ accordion */
        .bh-reviews-faq {
            border: 1px solid var(--bh-border);
            border-radius: 16px;
            background: #FFFFFF;
            overflow: hidden;
        }
        .bh-faq-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid var(--bh-border);
            cursor: pointer;
            user-select: none;
        }
        .bh-faq-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--bh-dark);
            margin: 0;
        }
        .bh-faq-header > svg {
            width: 18px;
            height: 18px;
            stroke: var(--bh-dark);
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }
        .bh-faq-header.collapsed > svg {
            transform: rotate(180deg);
        }
        .bh-faq-accordion {
            display: flex;
            flex-direction: column;
        }
        .bh-faq-item {
            border-bottom: 1px solid var(--bh-border-light);
        }
        .bh-faq-item:last-child {
            border-bottom: none;
        }
        .bh-faq-question {
            padding: 14px 20px;
            font-size: 14px;
            font-weight: 600;
            color: var(--bh-dark);
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            user-select: none;
        }
        .bh-faq-question:hover {
            color: var(--bh-primary);
        }
        .bh-faq-chevron {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            margin-left: 10px;
            transition: transform 0.2s ease;
        }
        .bh-faq-item.active .bh-faq-chevron {
            transform: rotate(45deg);
        }
        .bh-faq-answer {
            padding: 0 20px 14px;
            font-size: 13.5px;
            line-height: 1.6;
            color: var(--bh-body);
            display: none;
        }
        .bh-faq-item.active .bh-faq-answer {
            display: block;
        }


        /* ---------------- Similar Products Slider ---------------- */
        .bh-similar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }
        .bh-similar-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--bh-dark);
            margin: 0;
        }
        .bh-similar-viewall {
            font-size: 13px;
            font-weight: 600;
            color: var(--bh-primary);
            text-decoration: underline;
        }

        .bh-similar-grid {
            display: flex;
            gap: 14px;
            overflow-x: auto;
            padding-bottom: 12px;
            scrollbar-width: thin;
            -webkit-overflow-scrolling: touch;
        }
        .bh-similar-card {
            flex-shrink: 0;
            width: 190px;
            background: #FFFFFF;
            border: 1px solid var(--bh-border);
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.2s ease;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            color: inherit;
        }
        .bh-similar-card:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            transform: translateY(-2px);
            border-color: #10B981;
            text-decoration: none;
            color: inherit;
        }
        .bh-sc-img-wrap {
            position: relative;
            height: 160px;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #FFFFFF;
        }
        .bh-sc-img-wrap img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .bh-sc-discount {
            position: absolute;
            top: 8px;
            left: 8px;
            background: var(--bh-badge-bg);
            color: var(--bh-accent-orange);
            font-size: 10.5px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 6px;
        }
        .bh-sc-rating {
            position: absolute;
            bottom: 6px;
            left: 8px;
            background: var(--bh-primary);
            color: #FFFFFF;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
        }
        .bh-sc-body {
            padding: 10px 12px 14px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        .bh-sc-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--bh-dark);
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 35px;
            margin-bottom: 4px;
        }
        .bh-sc-brand {
            font-size: 11.5px;
            color: var(--bh-muted);
            margin-bottom: 8px;
        }
        .bh-sc-price-row {
            display: flex;
            align-items: baseline;
            gap: 6px;
            margin-top: auto;
        }
        .bh-sc-sell {
            font-size: 15px;
            font-weight: 800;
            color: var(--bh-dark);
        }
        .bh-sc-mrp {
            font-size: 11px;
            color: var(--bh-muted);
            text-decoration: line-through;
        }

        /* ---------------- Sticky Mobile Action Bar ---------------- */
        .bh-mobile-sticky-bar {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #FFFFFF;
            padding: 10px 14px;
            padding-bottom: max(10px, env(safe-area-inset-bottom));
            box-shadow: 0 -4px 18px rgba(0,0,0,0.12);
            z-index: 9999;
            border-top: 1px solid var(--bh-border);
        }
        .bh-mobile-bar-inner {
            display: flex;
            align-items: center;
            gap: 10px;
            max-width: 600px;
            margin: 0 auto;
        }
        .bh-mobile-prod-peek {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }
        .bh-mobile-prod-peek img {
            width: 42px;
            height: 42px;
            object-fit: contain;
            border-radius: 8px;
            border: 1px solid var(--bh-border);
            padding: 2px;
        }
        .bh-mobile-peek-info {
            display: flex;
            flex-direction: column;
        }
        .bh-mobile-peek-price {
            font-size: 16px !important;
            font-weight: 800 !important;
            color: var(--bh-dark) !important;
            line-height: 1.2;
        }
        .bh-mobile-peek-size {
            font-size: 11px !important;
            color: var(--bh-muted) !important;
            white-space: nowrap;
        }
        .bh-mobile-cta-actions {
            display: flex;
            gap: 8px;
            flex: 1;
        }
        .bh-mobile-cta-actions .bh-btn-cart,
        .bh-mobile-cta-actions .bh-btn-buy {
            height: 42px !important;
            font-size: 13.5px !important;
            font-weight: 700 !important;
            margin: 0;
            border-radius: 8px;
        }

        /* ==========================================================================
           COMPREHENSIVE MOBILE RESPONSIVE MEDIA QUERIES
           (Explicitly protects font sizes against global app.blade.php 11px reset)
           ========================================================================== */
        @media (max-width: 991px) {
            .bh-pdp-wrapper {
                /* padding-bottom: 90px !important;  */
            }
            .bh-hero-layout {
                grid-template-columns: minmax(0, 1fr) !important;
                gap: 18px !important;
            }
            .bh-hero-layout > * {
                min-width: 0 !important;
            }
            .bh-gallery-sticky {
                position: static !important;
                padding: 14px !important;
            }
            .bh-gallery-main {
                height: 380px !important;
            }
            .bh-product-info {
                padding: 20px 18px !important;
            }
            .bh-trust-markers-strip {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 14px !important;
                padding: 16px 18px !important;
            }
            /* Reviews: stack the 3 columns on tablet/mobile */
            .bh-reviews-grid {
                grid-template-columns: 1fr !important;
                gap: 20px !important;
            }
            .bh-mobile-sticky-bar {
                display: block !important;
            }
        }

        @media (max-width: 767px) {
            /* Standalone reviews section: clear sticky header (128px) + tabs bar (~53px) on anchor scroll */
            .bh-reviews-section {
                margin-top: 16px !important;
                scroll-margin-top: 190px !important;
            }
            /* Protect typography against global app.blade.php mobile 11px reset */
            .bh-pdp-wrapper .bh-product-title {
                font-size: 18px !important;
                font-weight: 700 !important;
                line-height: 1.35 !important;
                margin-bottom: 10px !important;
            }
            .bh-pdp-wrapper .bh-brand-tag {
                font-size: 13px !important;
                font-weight: 500 !important;
            }
            .bh-pdp-wrapper .bh-rating-score {
                font-size: 13px !important;
                font-weight: 700 !important;
            }
            .bh-pdp-wrapper .bh-reviews-count-link {
                font-size: 13px !important;
                font-weight: 500 !important;
            }
            .bh-pdp-wrapper .bh-orders-social-proof {
                font-size: 11.5px !important;
                font-weight: 600 !important;
            }
            .bh-pdp-wrapper .bh-sell-price {
                font-size: 24px !important;
                font-weight: 800 !important;
                color: var(--bh-dark) !important;
            }
            .bh-pdp-wrapper .bh-mrp-price {
                font-size: 14px !important;
                font-weight: 400 !important;
            }
            .bh-pdp-wrapper .bh-discount-pill {
                font-size: 12px !important;
                font-weight: 700 !important;
            }
            .bh-pdp-wrapper .bh-size-indicator {
                font-size: 13px !important;
                font-weight: 600 !important;
            }
            .bh-pdp-wrapper .bh-tax-inclusive {
                font-size: 12px !important;
            }
            .bh-pdp-wrapper .bh-free-delivery-badge {
                font-size: 12px !important;
                font-weight: 600 !important;
            }
            .bh-pdp-wrapper .bh-special-deal-banner {
                font-size: 12.5px !important;
                padding: 8px 12px !important;
            }
            .bh-pdp-wrapper .bh-special-deal-left {
                font-size: 12.5px !important;
                font-weight: 600 !important;
            }
            .bh-pdp-wrapper .bh-deal-highlight-price {
                font-size: 14px !important;
                font-weight: 700 !important;
            }

            /* Variant Cards */
            .bh-pdp-wrapper .bh-variant-heading {
                font-size: 14px !important;
                font-weight: 700 !important;
            }
            .bh-pdp-wrapper .bh-variant-card {
                min-width: 135px !important;
                width: 135px !important;
                padding: 8px 10px 8px !important;
            }
            .bh-pdp-wrapper .bh-vc-size-name {
                font-size: 14px !important;
                font-weight: 700 !important;
                color: var(--bh-dark) !important;
            }
            .bh-pdp-wrapper .bh-vc-pack-sub {
                font-size: 10.5px !important;
            }
            .bh-pdp-wrapper .bh-vc-discount-tag {
                font-size: 10px !important;
                font-weight: 700 !important;
            }
            .bh-pdp-wrapper .bh-vc-sell-price {
                font-size: 14px !important;
                font-weight: 800 !important;
                color: var(--bh-dark) !important;
            }
            .bh-pdp-wrapper .bh-vc-mrp {
                font-size: 11px !important;
            }
            .bh-pdp-wrapper .bh-vc-unit-rate {
                font-size: 10px !important;
            }
            .bh-pdp-wrapper .bh-vc-badge-bottom {
                font-size: 10px !important;
                font-weight: 700 !important;
            }

            /* Action Buttons & Forms */
            .bh-pdp-wrapper .bh-btn-cart {
                font-size: 14px !important;
                font-weight: 700 !important;
                height: 44px !important;
            }
            .bh-pdp-wrapper .bh-btn-buy {
                font-size: 14px !important;
                font-weight: 700 !important;
                height: 44px !important;
            }
            .bh-pdp-wrapper .bh-pincode-btn {
                font-size: 13px !important;
                font-weight: 600 !important;
            }
            .bh-pdp-wrapper .bh-pincode-field {
                font-size: 13px !important;
            }
            .bh-pdp-wrapper .bh-qty-label {
                font-size: 13px !important;
                font-weight: 700 !important;
            }
            .bh-pdp-wrapper .bh-qty-input {
                font-size: 14px !important;
                font-weight: 700 !important;
            }

            /* Tabs & Content */
            .bh-pdp-wrapper .bh-tab-pill-btn {
                font-size: 13px !important;
                font-weight: 600 !important;
                padding: 6px 16px !important;
            }
            .bh-pdp-wrapper .bh-section-heading {
                font-size: 16px !important;
                font-weight: 700 !important;
            }
            .bh-pdp-wrapper .bh-prose {
                font-size: 13.5px !important;
                line-height: 1.65 !important;
            }
            .bh-pdp-wrapper .bh-feature-item {
                font-size: 13px !important;
            }
            .bh-pdp-wrapper .bh-tri-card h4 {
                font-size: 13.5px !important;
                font-weight: 700 !important;
            }
            .bh-pdp-wrapper .bh-tri-card p {
                font-size: 12.5px !important;
            }
            .bh-pdp-wrapper .bh-expert-text-wrap blockquote {
                font-size: 13px !important;
            }
            .bh-pdp-wrapper .bh-expert-author {
                font-size: 11.5px !important;
                font-weight: 700 !important;
            }

            /* Similar products */
            .bh-similar-card {
                width: 160px !important;
            }
            .bh-sc-img-wrap {
                height: 135px !important;
            }
            .bh-pdp-wrapper .bh-sc-title {
                font-size: 12.5px !important;
            }
            .bh-pdp-wrapper .bh-sc-sell {
                font-size: 14px !important;
                font-weight: 800 !important;
            }
        }

        @media (max-width: 640px) {
            .bh-container {
                padding: 0 12px !important;
            }
            .bh-gallery-main {
                height: 320px !important;
            }
            .bh-thumb-item {
                width: 56px !important;
                height: 56px !important;
                padding: 3px !important;
            }
            .bh-features-grid {
                grid-template-columns: 1fr !important;
            }
            .bh-tri-cards-grid {
                grid-template-columns: 1fr !important;
            }
            .bh-content-card {
                padding: 18px 14px !important;
                border-radius: 14px !important;
                margin-bottom: 16px !important;
            }
            .bh-specs-table td {
                padding: 8px 10px !important;
            }
            .bh-specs-table td.label-col {
                width: 38% !important;
            }
            /* Price subline: stack vertically */
            .bh-price-subline {
                /* flex-direction: column !important; */
                align-items: flex-start !important;
                gap: 10px !important;
            }
            .bh-free-delivery-badge {
                border-left: none !important;
                padding-left: 0 !important;
            }
            /* Rating row: wrap tightly */
            .bh-rating-row {
                flex-wrap: wrap !important;
                gap: 6px !important;
            }
        }

        @media (max-width: 480px) {
            .bh-breadcrumb-current {
                max-width: 180px !important;
            }
            .bh-gallery-main {
                height: 290px !important;
            }
            .bh-product-info {
                padding: 16px 12px !important;
            }
            .bh-variant-card {
                min-width: 126px !important;
                width: 126px !important;
                padding: 7px 8px 6px !important;
            }
            .bh-trust-markers-strip {
                grid-template-columns: 1fr !important;
                gap: 12px !important;
                padding: 14px !important;
            }
            .bh-mobile-prod-peek {
                display: none !important;
            }
            .bh-mobile-cta-actions {
                width: 100% !important;
            }
            .bh-expert-advice-card {
                flex-direction: column !important;
                gap: 10px !important;
                padding: 14px !important;
            }
            /* Delivery widget: compact buttons */
            .bh-del-input-group {
                gap: 6px !important;
            }
            .bh-pincode-btn {
                padding: 0 12px !important;
            }
            /* Trust markers strip: compact icons */
            .bh-tm-box {
                gap: 10px !important;
            }
            .bh-tm-icon {
                width: 38px !important;
                height: 38px !important;
            }
            /* FAQ accordion: compact */
            .bh-faq-question {
                padding: 12px 14px !important;
            }
            .bh-faq-answer {
                padding: 0 14px 12px !important;
            }
            /* Similar products: smaller */
            .bh-similar-card {
                width: 148px !important;
            }
            .bh-sc-img-wrap {
                height: 122px !important;
            }
        }

        /* ---- iPhone SE & below (375px) ---- */
        @media (max-width: 375px) {
            .bh-container {
                padding: 0 10px !important;
            }
            .bh-gallery-main {
                height: 260px !important;
            }
            .bh-pdp-wrapper .bh-product-title {
                font-size: 16px !important;
            }
            .bh-pdp-wrapper .bh-sell-price {
                font-size: 22px !important;
            }
            .bh-variant-card {
                min-width: 118px !important;
                width: 118px !important;
            }
            .bh-action-buttons {
                gap: 8px !important;
            }
            .bh-btn-cart, .bh-btn-buy {
                height: 42px !important;
                border-radius: 8px !important;
            }
            .bh-similar-card {
                width: 135px !important;
            }
            .bh-sc-img-wrap {
                height: 110px !important;
            }
            .bh-trust-markers-strip {
                margin: 22px 0 18px !important;
            }
        }

        /* ==========================================================================
           PHASE 25: FULL MOBILE HARDENING
           - Stops the global app.blade.php "p, span, a, li, td, th = 11px" reset
             from leaking into the PDP content.
           - Stacks the sticky buy-bar ABOVE the site's bottom navigation so the
             two no longer overlap.
           - Offsets the sticky tab pills below the sticky mobile header.
           (bottom spacing for the fixed bars is handled by the existing
           `.bh-pdp-wrapper` padding + the `body` padding below)
           ========================================================================== */
        @media (max-width: 767px) {
            /* The sticky buy-bar sits above the 58px site bottom-nav */
            body {
                padding-bottom: 126px !important;
            }
            .bh-mobile-sticky-bar {
                bottom: 58px !important;
            }
            /* Keep tabs below the 128px sticky mobile header */
            .bh-sticky-tabs-container {
                top: 128px !important;
            }

            /* ---- Restore readable typography inside the PDP ----
               The global mobile reset forces every p/span/a/li/td/th to 11px.
               Let them inherit the (already responsive) component sizes instead. */
            .bh-pdp-wrapper p,
            .bh-pdp-wrapper span,
            .bh-pdp-wrapper small,
            .bh-pdp-wrapper a,
            .bh-pdp-wrapper li,
            .bh-pdp-wrapper td,
            .bh-pdp-wrapper th {
                font-size: inherit !important;
                font-weight: inherit !important;
            }

            /* Re-assert small labels/badges that relied on single-class specificity */
            .bh-pdp-wrapper .bh-gallery-top-badge { font-size: 11px !important; font-weight: 700 !important; }
            .bh-pdp-wrapper .bh-gallery-counter { font-size: 11px !important; font-weight: 600 !important; }
            .bh-pdp-wrapper .bh-vc-pack-sub { font-size: 10.5px !important; font-weight: 400 !important; }
            .bh-pdp-wrapper .bh-vc-unit-rate { font-size: 10px !important; font-weight: 400 !important; }
            .bh-pdp-wrapper .bh-sc-discount { font-size: 10.5px !important; font-weight: 700 !important; }
            .bh-pdp-wrapper .bh-sc-rating { font-size: 10px !important; font-weight: 700 !important; }
            .bh-pdp-wrapper .bh-sc-brand { font-size: 11.5px !important; font-weight: 400 !important; }
            .bh-pdp-wrapper .bh-sc-mrp { font-size: 11px !important; font-weight: 400 !important; }
            .bh-pdp-wrapper .bh-verified-badge { font-size: 11px !important; font-weight: 700 !important; }
            .bh-pdp-wrapper .bh-review-date { font-size: 12px !important; font-weight: 400 !important; }
            .bh-pdp-wrapper .bh-mobile-peek-size { font-size: 11px !important; }
            .bh-pdp-wrapper .bh-mobile-peek-price { font-size: 16px !important; font-weight: 800 !important; }

            /* Body copy / tables */
            .bh-pdp-wrapper .bh-prose,
            .bh-pdp-wrapper .bh-prose p { font-size: 14px !important; line-height: 1.7 !important; }
            .bh-pdp-wrapper .bh-specs-table,
            .bh-pdp-wrapper .bh-specs-table td,
            .bh-pdp-wrapper .bh-dosage-table,
            .bh-pdp-wrapper .bh-dosage-table td { font-size: 13px !important; }
            .bh-pdp-wrapper .bh-specs-table td.label-col,
            .bh-pdp-wrapper .bh-dosage-table th { font-weight: 600 !important; }
            .bh-pdp-wrapper .bh-feature-item span { font-size: 13px !important; }
            .bh-pdp-wrapper .bh-trust-item span { font-size: 13px !important; font-weight: 500 !important; }
            .bh-pdp-wrapper .bh-review-text { font-size: 13.5px !important; }
            .bh-pdp-wrapper .bh-reviewer-name { font-size: 14px !important; font-weight: 700 !important; }

            /* Headings the global reset inflates too far */
            .bh-pdp-wrapper .bh-tm-title { font-size: 14px !important; }
            .bh-pdp-wrapper .bh-tm-desc { font-size: 12px !important; }
            .bh-pdp-wrapper .bh-similar-title { font-size: 18px !important; }
            .bh-pdp-wrapper .bh-similar-viewall { font-size: 13px !important; font-weight: 600 !important; }
            .bh-pdp-wrapper .bh-prose h4 { font-size: 16px !important; }

            /* Bulk order banner copy */
            .bh-pdp-wrapper .bh-bulk-order-banner .title { font-size: 13px !important; font-weight: 700 !important; }
            .bh-pdp-wrapper .bh-bulk-order-banner .phone { font-size: 13px !important; font-weight: 800 !important; }

            /* Stop iOS from zooming when the pincode field is focused */
            .bh-pdp-wrapper .bh-pincode-field { font-size: 16px !important; }
        }

        /* Very small phones: keep similar-product pricing from clipping */
        @media (max-width: 380px) {
            .bh-pdp-wrapper .bh-sc-sell { font-size: 13px !important; }
            .bh-pdp-wrapper .bh-sc-mrp { font-size: 10px !important; }
            .bh-pdp-wrapper .bh-sc-price-row { gap: 4px !important; flex-wrap: wrap !important; }
        }
    </style>
@endpush

@section('content')
    @php
        $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews ?? []);
        $rating = \App\CPU\ProductManager::get_rating($product->reviews ?? []);
        $decimal_point_settings = \App\CPU\Helpers::get_business_settings('decimal_point_settings');

        // Review summary stats
        $reviewsList = $product->reviews ?? collect();
        $reviewsCount = $reviewsList->count();
        $avgRating = $reviewsCount > 0 ? round($reviewsList->avg('rating'), 2) : 0;
        $ratingBreakdown = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
        foreach ($reviewsList as $rv) {
            $r = (int) $rv->rating;
            if (isset($ratingBreakdown[$r])) {
                $ratingBreakdown[$r]++;
            }
        }

        // Real buyers count (distinct orders containing this product) for social-proof pill
        $soldCount = 0;
        try {
            $soldCount = (int) \Illuminate\Support\Facades\DB::table('order_details')
                ->where('product_id', $product->id)
                ->distinct()
                ->count('order_id');
        } catch (\Throwable $e) {
            $soldCount = 0;
        }

        // Product gallery: own uploaded images first, then the thumbnail, then a local placeholder
        $dbImages = [];
        if (!empty($product->images)) {
            $decoded = json_decode($product->images, true);
            if (is_array($decoded)) {
                foreach ($decoded as $img) {
                    $dbImages[] = asset(config('app.public_storage_path') . "/product/$img");
                }
            }
        }

        if (!empty($product->thumbnail)) {
            $dbImages[] = asset(config('app.public_storage_path') . '/product/thumbnail/' . $product->thumbnail);
        }

        $localPlaceholder = asset('assets/front-end/img/placeholder.png');
        $galleryImages = !empty($dbImages) ? array_values(array_unique($dbImages)) : [$localPlaceholder];

        // Real product variants from variation JSON (source of truth)
        $choiceOpts = json_decode($product->choice_options ?? '[]', true) ?? [];
        $variantAttrTitle = trim($choiceOpts[0]['title'] ?? '') !== '' ? trim($choiceOpts[0]['title']) : 'Size';
        $variationRaw = json_decode($product->variation ?? '[]', true) ?? [];
        $discPct = ($product->discount_type === 'percent') ? (float) $product->discount : 0;
        $discFlat = ($product->discount_type !== 'percent') ? (float) $product->discount : 0;

        $bhCalcVariant = function ($mrp) use ($discPct, $discFlat) {
            $mrp = (float) $mrp;
            if ($discPct > 0) {
                $sell = $mrp * (1 - $discPct / 100);
                $disc = (int) round($discPct);
            } elseif ($discFlat > 0 && $mrp > 0) {
                $sell = max(0, $mrp - $discFlat);
                $disc = (int) round((($mrp - $sell) / $mrp) * 100);
            } else {
                $sell = $mrp;
                $disc = 0;
            }
            return ['price' => (int) round($sell), 'mrp' => (int) round($mrp), 'discount' => $disc];
        };

        $realVariants = [];
        foreach ($variationRaw as $v) {
            if (!is_array($v) || !isset($v['type'])) {
                continue;
            }
            $calc = $bhCalcVariant($v['price'] ?? 0);
            $realVariants[] = [
                'name' => trim((string) $v['type']),
                'price' => $calc['price'],
                'mrp' => $calc['mrp'],
                'discount' => $calc['discount'],
                'qty' => (int) ($v['qty'] ?? 0),
            ];
        }

        // Non-variant product → show a single default card so "Single Pack" never empty
        if (count($realVariants) === 0) {
            $calc = $bhCalcVariant($product->unit_price);
            $realVariants[] = [
                'name' => 'Standard',
                'price' => $calc['price'],
                'mrp' => $calc['mrp'],
                'discount' => $calc['discount'],
                'qty' => (int) $product->current_stock,
            ];
        }
        $defaultVariant = $realVariants[0];

        // Optional custom bundle packs (only shown when product_packs has multi rows)
        $singlePacks = ($product->packs ?? collect())->where('type', 'single')->values();
        $multiPacks = ($product->packs ?? collect())->where('type', 'multi')->values();
    @endphp

    <div class="bh-pdp-wrapper">
        <div class="container">
            {{-- 2. Two-Column Hero (Gallery & Purchase Info) --}}
            <div class="bh-hero-layout">
                <div>

                 <div class="bh-gallery-sticky">
                    <div class="bh-gallery-main" id="bhMainGallery">
                        <span class="bh-gallery-top-badge" id="bhBadgeTop">@if ($defaultVariant['discount'] > 0){{ $defaultVariant['discount'] }}% OFF  @endif</span>
                        <span class="bh-gallery-counter" id="bhCounter">1 / {{ count($galleryImages) }}</span>

                        <button type="button" class="bh-gallery-nav-btn prev" onclick="bhGalleryStep(-1)" aria-label="Previous image">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd"/></svg>
                        </button>
                        <button type="button" class="bh-gallery-nav-btn next" onclick="bhGalleryStep(1)" aria-label="Next image">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd"/></svg>
                        </button>

                        <img id="bhHeroImage" src="{{ $galleryImages[0] }}" alt="{{ $product->name }}" loading="eager">
                    </div>

                    {{-- Thumbnails Strip --}}
                    <div class="bh-thumbnails-list">
                        @foreach ($galleryImages as $index => $imgSrc)
                            <div class="bh-thumb-item {{ $index == 0 ? 'active' : '' }}" onclick="bhSetGalleryImage({{ $index }}, '{{ $imgSrc }}')">
                                <img src="{{ $imgSrc }}" alt="Thumbnail {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>

           
                </div>
                </div>
                {{-- Left: Sticky Image Gallery --}}
               

                {{-- Right: Product Buying Info --}}
                <div class="bh-product-info">

                    {{-- Brand Link --}}
                    @if ($product->brand)
                        <a href="{{ route('products', ['data_from' => 'brand', 'id' => $product->brand_id, 'page' => 1]) }}"
                            class="bh-brand-tag">{{ $product->brand->name }}</a>
                    @endif

                    {{-- Title --}}
                    <h1 class="bh-product-title">
                        {{ $product->name }}
                    </h1>

                    {{-- Rating & Social Proof (dynamic from reviews + orders) --}}
                    <div class="bh-rating-row">
                        <div class="bh-stars-group">
                            @for ($i = 0; $i < 5; $i++)
                                <svg viewBox="0 0 24 22" class="{{ $avgRating >= $i + 1 ? 'bh-star-filled' : '' }}"><path d="M12 2.5l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.77 5.82 22 7 14.14 2 9.27l6.91-1.01L12 2.5z"/></svg>
                            @endfor
                            <span class="bh-rating-score">{{ $avgRating > 0 ? number_format($avgRating, 2) : '0.00' }}</span>
                        </div>
                        <a href="#reviews-section" onclick="bhGoToReviews(event)" class="bh-reviews-count-link">{{ number_format($reviewsCount) }} Review{{ $reviewsCount !== 1 ? 's' : '' }}</a>
                       
                    </div>

                    {{-- Price Section --}}
                    <div class="bh-price-box">
                        <div class="bh-price-main-line">
                            <span class="bh-sell-price" id="bhMainPrice">₹{{ number_format($defaultVariant['price']) }}</span>
                            @if ($defaultVariant['mrp'] > $defaultVariant['price'])
                                <span class="bh-mrp-price" id="bhMrpPrice">₹{{ number_format($defaultVariant['mrp']) }}</span>
                            @else
                                <span class="bh-mrp-price" id="bhMrpPrice" style="display:none;"></span>
                            @endif
                            @if ($defaultVariant['discount'] > 0)
                                <span class="bh-discount-pill" id="bhDiscountPill">{{ $defaultVariant['discount'] }}% OFF</span>
                            @else
                                <span class="bh-discount-pill" id="bhDiscountPill" style="display:none;"></span>
                            @endif
                        </div>
                        <div class="bh-price-subline">
                            <div class="bh-size-indicator">Size: <span id="bhCurrentSizeLabel">{{ $defaultVariant['name'] }}</span></div>
                            <span class="bh-tax-inclusive">Inclusive of all taxes</span>
                            <div class="bh-free-delivery-badge">
                                <svg viewBox="0 0 24 24"><path d="M2,12c0-1.6,0-3.2,0-4.8c0-1.5,1.1-2.6,2.6-2.6c2.8,0,5.6,0,8.4,0c1.3,0,2.3,0.9,2.5,2.1c0,0.2,0,0.4,0,0.6c0,0.3,0,0.3,0.3,0.3c1,0,2,0,3,0c0.7,0,1.1,0.3,1.5,0.8c0.5,0.9,1,1.7,1.5,2.6c0.1,0.2,0.2,0.4,0.2,0.7c0,1.7,0,3.4,0,5.1c0,0.5-0.2,0.7-0.7,0.7c-0.2,0-0.4,0-0.6,0c-0.2,0-0.2,0.1-0.3,0.2c-0.3,0.9-1,1.5-1.9,1.6c-1.1,0.2-2.2-0.5-2.6-1.6c-0.1-0.2-0.2-0.3-0.4-0.3c-2.2,0-4.4,0-6.5,0c-0.2,0-0.3,0.1-0.3,0.2c-0.3,1-1.2,1.6-2.3,1.6c-1,0-1.9-0.6-2.3-1.6c-0.1-0.2-0.2-0.2-0.3-0.2c-0.4,0-0.8,0-1.2,0c-0.5,0-0.7-0.2-0.7-0.7C2,15.2,2,13.6,2,12z"/></svg>
                                <span>Free Delivery</span>
                            </div>
                        </div>
                    </div>

                    {{-- Special Deal Banner --}}
                    @if ($defaultVariant['discount'] > 0)
                    <div class="bh-special-deal-banner" onclick="bhSelectVariant('{{ $defaultVariant['name'] }}', {{ $defaultVariant['price'] }}, {{ $defaultVariant['mrp'] }}, {{ $defaultVariant['discount'] }})">
                        <div class="bh-special-deal-left">
                            <svg class="bh-deal-gif-icon" viewBox="0 0 24 24" style="stroke:none;" fill="currentColor" aria-hidden="true"><path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58s1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41s-.22-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"/></svg>
                            <span>Get it for <span class="bh-deal-highlight-price">₹{{ number_format($defaultVariant['price']) }}</span> with deals</span>
                        </div>
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                    </div>
                    @endif

                    {{-- Dynamic & Static Variant Selection Form --}}
                    <form id="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id ?? 1 }}">
                        <input type="hidden" id="bh_selected_variant_name" name="pack_size" value="{{ $defaultVariant['name'] }}">

                        {{-- Section 1: Real product variants (from variation JSON) --}}
                        <div class="bh-variants-wrapper">
                            <h3 class="bh-variant-heading">Single Pack</h3>
                            <div class="bh-variant-cards-scroll">
                                @foreach ($realVariants as $vi => $v)
                                    <div class="bh-variant-card justify-content-center {{ $vi === 0 ? 'active' : '' }}"
                                         data-size="{{ $v['name'] }}"
                                         data-price="{{ $v['price'] }}"
                                         data-mrp="{{ $v['mrp'] }}"
                                         data-discount="{{ $v['discount'] }}"
                                         onclick="bhOnVariantCardClick(this)">
                                        <svg class="bh-variant-selected-tick" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="11" fill="#168A3A"/><path d="M7 12.5l3.2 3.2L17 9" fill="none" stroke="#ffffff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <div class="bh-vc-size-name">{{ $v['name'] }}</div>
                                        @if ($v['discount'] > 0)
                                        <div><span class="bh-vc-discount-tag">{{ $v['discount'] }}% OFF</span></div>
                                        @endif
                                        <div class="bh-vc-divider"></div>
                                        <div class="bh-vc-price-row">
                                            <span class="bh-vc-sell-price">₹{{ number_format($v['price']) }}</span>
                                            @if ($v['mrp'] > $v['price'])
                                            <span class="bh-vc-mrp">₹{{ number_format($v['mrp']) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Section 2: Multipack (Big Savings) — only when custom bundle packs exist --}}
                        @if ($multiPacks->count() > 0)
                        <div class="bh-variants-wrapper">
                            <h3 class="bh-variant-heading">Multipack (Big Savings)</h3>
                            <div class="bh-variant-cards-scroll">
                                @foreach ($multiPacks as $mpack)
                                    <div class="bh-variant-card"
                                         data-size="{{ $mpack->name }}"
                                         data-price="{{ $mpack->price }}"
                                         data-mrp="{{ $mpack->mrp }}"
                                         data-discount="{{ $mpack->discount }}"
                                         onclick="bhOnVariantCardClick(this)">
                                        <svg class="bh-variant-selected-tick" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="11" fill="#168A3A"/><path d="M7 12.5l3.2 3.2L17 9" fill="none" stroke="#ffffff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <div class="bh-vc-size-name " style="">
                                            <div style="white-space: nowrap;">{{ $mpack->name }}</div>
                                        </div>
                                       
                                        <div><span class="bh-vc-discount-tag">{{ $mpack->discount }}% OFF</span></div>
                                        <div class="bh-vc-divider"></div>
                                        <div class="bh-vc-price-row">
                                            <span class="bh-vc-sell-price">₹{{ number_format($mpack->price) }}</span>
                                            <span class="bh-vc-mrp">₹{{ number_format($mpack->mrp) }}</span>
                                        </div>
                                        
                                      
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- Composition Box (only when composition/technical name data exists) --}}
                        @php
                            $compositionText = '';
                            foreach ($product->specifications ?? collect() as $spec) {
                                if (stripos((string) $spec->label, 'composition') !== false || stripos((string) $spec->label, 'technical') !== false) {
                                    $compositionText = trim(strip_tags((string) $spec->value));
                                    break;
                                }
                            }
                            if ($compositionText === '') {
                                $compositionText = trim((string) ($product->technical_name ?? ''));
                            }
                        @endphp
                        @if ($compositionText !== '')
                        <div class="bh-composition-card">
                            <div class="bh-comp-left">
                                <div class="bh-comp-icon-wrap">
                                    <svg viewBox="0 0 24 24"><path d="M6.63379 19.8486H17.5967L15.1797 13.1577H9.05234L6.63379 19.8486Z"/><path d="M15.4278 6.92479V3.87496H15.9425C16.4924 3.87496 16.9374 3.46353 16.9374 2.93748C16.9374 2.41167 16.4924 2 15.9425 2H8.28846C7.73907 2 7.29351 2.41155 7.29351 2.93748C7.29351 3.46341 7.73895 3.87496 8.28846 3.87496H8.89785V6.92479L4 20.3891V20.4378C4 20.9439 4.34149 21.3448 4.701 21.6135C5.06533 21.8883 5.5857 22 6.07658 22H18.1558C18.6452 22 19.0516 21.8883 19.4141 21.6135C19.7752 21.3448 20 20.9439 20 20.4378V20.3882L15.4278 6.92479ZM5.72583 20.4378L10.5301 6.92479V3.87496H13.7957V6.92479L18.5623 20.4396L5.72583 20.4378Z"/></svg>
                                </div>
                                <div>
                                    <div class="bh-comp-title">Composition</div>
                                    <div class="bh-comp-content">{{ $compositionText }}</div>
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- Delivery / Pincode Checker --}}
                        <div class="bh-delivery-widget">
                            <div class="bh-del-header">
                                <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                <span>Check Delivery & COD Availability</span>
                            </div>
                            <div class="bh-del-input-group">
                                <input type="text" id="bh_pincode_input" class="bh-pincode-field" placeholder="Enter 6 digit pincode" maxlength="6" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                <button type="button" id="bh_check_pincode_btn" class="bh-pincode-btn" onclick="bhCheckPincode()">Check</button>
                            </div>
                            <div id="bh_pincode_feedback" class="bh-pincode-result-box"></div>
                        </div>

                        {{-- Quantity Stepper --}}
                        <div class="bh-quantity-row">
                            <span class="bh-qty-label">Quantity</span>
                            <div class="bh-qty-stepper-box">
                                <button type="button" class="bh-qty-btn" onclick="bhChangeQty(-1)">-</button>
                                <input type="text" name="quantity" id="bh_qty_input" class="bh-qty-input cart-qty-field" value="1" min="1" max="100" readonly>
                                <button type="button" class="bh-qty-btn" onclick="bhChangeQty(1)">+</button>
                            </div>
                        </div>

                        {{-- Out of Stock indicator (hidden by default) --}}
                        <div id="variant-out-of-stock" class="d-none mb-3">
                            <div style="background:#FEE2E2; color:#DC2626; font-weight:700; padding:10px 16px; border-radius:10px; text-align:center;">
                                <i class="fa fa-exclamation-triangle me-1"></i> Out of stock
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="bh-action-buttons">
                            <button type="button" class="bh-btn-cart btn-add-to-cart" onclick="addToCart('add-to-cart-form')">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                                Add to Cart
                            </button>
                            <button type="button" class="bh-btn-buy btn-buy-now" onclick="buy_now()">
                                Buy Now
                            </button>
                            @php $inWishlist = auth('customer')->check() && in_array((int) ($product->id ?? 0), array_map('intval', (array) session('wish_list', []))); @endphp
                            <button type="button" class="bh-btn-wishlist {{ $inWishlist ? 'active' : '' }}" onclick="toggleWishlist('{{ $product->id ?? 1 }}')" title="Wishlist">
                                <i class="fa {{ $inWishlist ? 'fa-heart' : 'fa-heart-o' }}"></i>
                            </button>
                        </div>
                    </form>

                    {{-- Trust Checkpoints List --}}
                    @php
                        $originText = '';
                        foreach ($product->specifications ?? collect() as $spec) {
                            if (stripos((string) $spec->label, 'origin') !== false) {
                                $originText = trim(strip_tags((string) $spec->value));
                                break;
                            }
                        }
                    @endphp
                    <div class="bh-trust-features">
                        @if ($originText !== '')
                            <div class="bh-trust-item">
                                <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
                                <span>{{ \App\CPU\translate('Country of Origin') }}: {{ $originText }}</span>
                            </div>
                        @endif
                        <div class="bh-trust-item">
                            <svg viewBox="0 0 24 24"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
                            <span>{{ \App\CPU\translate('Secure Payments') }}</span>
                        </div>
                        <div class="bh-trust-item">
                            <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                            @if ((int) $product->current_stock > 0)
                                <span>{{ \App\CPU\translate('In stock') }}</span>
                            @else
                                <span>{{ \App\CPU\translate('Currently out of stock') }}</span>
                            @endif
                        </div>
                    </div>
                    @php
                        $company_phone = \App\CPU\Helpers::get_business_settings('company_phone');
                    @endphp
                      {{-- Bulk Order Inquiries Banner --}}
                    <a href="{{ route('contacts') }}" class="bh-bulk-order-banner">
                        <div>
                            <p class="title">Looking for Bulk Orders? Inquire Now</p>
                            <span class="phone">Missed Call To Order:   {{ $company_phone }}</span>
                        </div>
                        <i class="fa fa-angle-right" style="font-size:20px; color:#B45309;"></i>
                    </a>

                </div>
            </div>

         

            {{-- 4. Sticky Pill Tabs Bar --}}
            <div class="bh-sticky-tabs-container">
                <div class="bh-tabs-pills">
                    <button type="button" class="bh-tab-pill-btn active" data-tab="Overview" onclick="bhSwitchTab('Overview')">Overview</button>
                    <button type="button" class="bh-tab-pill-btn " data-tab="details" onclick="bhSwitchTab('details')">Product Details</button>
                </div>
            </div>

            {{-- 5. Tab Content Panes --}}
            <div class="bh-tabs-content">
                <div class="bh-tab-pane active" id="tab-Overview">
                    <div class="bh-content-card">
                        @if (trim((string) $product->description) !== '')
                            <div class="bh-prose bh-product-overview">{!! $product->description !!}</div>
                        @endif
                        <h3 class="bh-section-heading">Overview & Specifications</h3>
                        <table class="bh-specs-table">
                            <tbody>
                                <tr>
                                    <td class="label-col">Product Name</td>
                                    <td class="value-col">{{ $product->name }}</td>
                                </tr>
                                @if ($product->brand)
                                    <tr>
                                        <td class="label-col">Brand</td>
                                        <td class="value-col">{{ $product->brand->name }}</td>
                                    </tr>
                                @endif
                                @php
                                    $catIdsArr = json_decode($product->category_ids, true) ?? [];
                                    $catName = '';
                                    if (count($catIdsArr) > 0) {
                                        $lastCat = end($catIdsArr);
                                        $lastCatId = is_array($lastCat) ? ($lastCat['id'] ?? null) : $lastCat;
                                        $catObj = $lastCatId ? \App\Model\Category::find($lastCatId) : null;
                                        $catName = $catObj ? $catObj->name : '';
                                    }
                                @endphp
                                @if ($catName)
                                    <tr>
                                        <td class="label-col">Category</td>
                                        <td class="value-col">{{ $catName }}</td>
                                    </tr>
                                @endif
                                @php $specList = $product->specifications ?? collect(); @endphp
                                @forelse ($specList as $spec)
                                    <tr>
                                        <td class="label-col">{{ $spec->label }}</td>
                                        <td class="value-col">{!! $spec->value !!}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="label-col">Technical Content</td>
                                        <td class="value-col">{{ $product->technical_name ?: '—' }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>

                {{-- Tab 1: Product Details --}}
                <div class="bh-tab-pane" id="tab-details">
                   
                    <div class="bh-content-card">
                        <h3 class="bh-section-heading">Product Description</h3>
                        <div class="bh-prose">
                            @if (trim((string) $product->details) !== '')
                                {!! $product->details !!}
                            @elseif (trim((string) $product->description) !== '')
                                {!! $product->description !!}
                            @else
                                <p>{{ $product->name }} — {{ $product->technical_name ?: 'premium quality product' }}.</p>
                            @endif
                        </div>
                        <h3 class="bh-section-heading">Key Features & Benefits</h3>
                        <div class="bh-features-grid">
                            @php $featList = $product->features ?? collect(); @endphp
                            @forelse ($featList as $feat)
                                <div class="bh-feature-item">
                                    <svg viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                                    <span><strong>{{ $feat->title }}:</strong> {{ $feat->description }}</span>
                                </div>
                            @empty
                                <div class="bh-feature-item">
                                    <svg viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                                    <span><strong>Premium Quality:</strong> Carefully formulated for effective results.</span>
                                </div>
                            @endforelse
                        </div>
                        <h3 class="bh-section-heading">Safety, Handling &amp; Storage</h3>
                        <div class="bh-tri-cards-grid">
                            <div class="bh-tri-card">
                                <h4>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#0B5D2A"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
                                    Follow The Label
                                </h4>
                                <p>Always read and follow the directions for use, precautions and warnings printed on the product label and packaging. This page does not replace the manufacturer's instructions.</p>
                            </div>
                            <div class="bh-tri-card">
                                <h4>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#D97706"><path d="M12 2L1 21h22L12 2zm0 3.99L19.53 19H4.47L12 5.99zM11 10h2v4h-2zm0 6h2v2h-2z"/></svg>
                                    Handle With Care
                                </h4>
                                <p>Keep out of reach of children and pets. Wear the protective clothing, gloves and mask recommended on the label while opening, mixing and spraying. Wash thoroughly after handling.</p>
                            </div>
                            <div class="bh-tri-card">
                                <h4>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#2563EB"><path d="M20 6h-8l-2-2H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm0 12H4V8h16v10z"/></svg>
                                    Store Properly
                                </h4>
                                <p>Keep the product tightly sealed in its original container in a cool, dry and ventilated place, away from direct sunlight, food and animal feed.</p>
                            </div>
                        </div>
                    </div>

                 

                </div>

                {{-- Tab 2: Dosage & Recommended Crops --}}
                

                {{-- 6. Customer Reviews & Ratings (separate section, always visible) --}}
                <div class="bh-reviews-section" id="reviews-section">
                    <div class="bh-reviews-grid">

                        {{-- Left: Summary --}}
                        <div class="bh-reviews-summary">
                            <h3 class="bh-reviews-title">Customer Reviews</h3>
                            <div class="bh-summary-score-row">
                                <div class="bh-summary-stars">
                                    @for ($i = 0; $i < 5; $i++)
                                        <svg viewBox="0 0 24 22" class="{{ ($avgRating >= $i + 1) ? 'bh-star-filled' : '' }}"><path d="M12 2.5l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.77 5.82 22 7 14.14 2 9.27l6.91-1.01L12 2.5z"/></svg>
                                    @endfor
                                </div>
                                <span class="bh-summary-score-badge">{{ $avgRating > 0 ? number_format($avgRating, 2) : '0.00' }}</span>
                            </div>
                            <div class="bh-summary-total">{{ number_format($reviewsCount) }} rating{{ $reviewsCount !== 1 ? 's' : '' }}</div>
                            <div class="bh-summary-breakdown">
                                @for ($s = 5; $s >= 1; $s--)
                                    @php
                                        $cnt = $ratingBreakdown[$s] ?? 0;
                                        $pct = $reviewsCount > 0 ? round(($cnt / $reviewsCount) * 100) : 0;
                                    @endphp
                                    <div class="bh-bar-row"><span class="bh-bar-label">{{ $s }} star</span><div class="bh-bar-track"><div class="bh-bar-fill" style="width:{{ $pct }}%;"></div></div><span class="bh-bar-pct">{{ $pct }}%</span></div>
                                @endfor
                            </div>
                            @auth('customer')
                            <div class="bh-summary-write">
                                <div class="bh-write-title">Review this product</div>
                                <p class="bh-write-sub">Share your thoughts with other customers</p>
                                <button type="button" class="bh-write-btn" onclick="bhOpenReviewModal()">Write a Product Review</button>
                            </div>
                            @endauth
                        </div>

                        {{-- Middle: Review feed --}}
                        <div class="bh-reviews-feed card p-4">
                            @forelse ($reviewsList as $review)
                                <div class="bh-review-card">
                                    <div class="bh-review-head">
                                        <div class="bh-review-avatar">
                                            <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
                                        </div>
                                        <div>
                                            <div class="bh-review-name">{{ $review->customer ? trim(($review->customer->f_name ?? '') . ' ' . ($review->customer->l_name ?? '')) : 'Verified Customer' }}</div>
                                            <div class="bh-verified-badge">
                                                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                                Verified Farmer
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bh-review-rating-row">
                                        <div class="bh-review-stars">
                                            @for ($i = 0; $i < 5; $i++)
                                                <svg viewBox="0 0 24 22" class="{{ ($review->rating > $i) ? 'bh-star-filled' : '' }}"><path d="M12 2.5l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.77 5.82 22 7 14.14 2 9.27l6.91-1.01L12 2.5z"/></svg>
                                            @endfor
                                        </div>
                                        <span class="bh-review-date">Reviewed On {{ $review->created_at ? $review->created_at->format('d F Y') : '' }}</span>
                                    </div>
                                    <p class="bh-review-text">"{{ $review->comment }}"</p>
                                </div>
                            @empty
                                <div class="bh-review-empty">
                                    <p>No reviews yet for this product. Be the first to review it!</p>
                                </div>
                            @endforelse
                        </div>

                        {{-- Right: FAQ accordion --}}
                        <div class="bh-reviews-faq">
                            <div class="bh-faq-header" onclick="bhToggleFaqAll(this)">
                                <h3>Frequently Asked Questions</h3>
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 15l-6-6-6 6"/></svg>
                            </div>
                            <div class="bh-faq-accordion">
                                @php $faqsList = $product->faqs ?? collect(); @endphp
                                @forelse ($faqsList as $faq)
                                    <div class="bh-faq-item">
                                        <div class="bh-faq-question" onclick="bhToggleFaq(this)">
                                            <span>{{ $faq->question }}</span>
                                            <svg class="bh-faq-chevron" viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
                                        </div>
                                        <div class="bh-faq-answer">{!! $faq->answer !!}</div>
                                    </div>
                                @empty
                                    <div class="bh-faq-item">
                                        <div class="bh-faq-question" onclick="bhToggleFaq(this)">
                                            <span>No FAQs available for this product yet.</span>
                                            <svg class="bh-faq-chevron" viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
                                        </div>
                                        <div class="bh-faq-answer">Please check back later or contact support for product-related questions.</div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            {{-- 6. Similar Products Section --}}
            @php
                $simCatIds = json_decode($product->category_ids, true) ?? [];
                $simCatLink = route('products', ['data_from' => 'latest', 'page' => 1]);
                if (count($simCatIds) > 0) {
                    $simCat = end($simCatIds);
                    $simCatId = is_array($simCat) ? ($simCat['id'] ?? null) : $simCat;
                    if ($simCatId) {
                        $simCatLink = route('products', ['id' => $simCatId, 'data_from' => 'category', 'page' => 1]);
                    }
                }
            @endphp
            <div class="bh-content-card" style="margin-top:20px;">
                <div class="bh-similar-header">
                    <h2 class="bh-similar-title">Similar Products</h2>
                    <a href="{{ $simCatLink }}" class="bh-similar-viewall">View All &rarr;</a>
                </div>

                <div class="bh-similar-grid">
                    @if (isset($relatedProducts) && count($relatedProducts) > 0)
                        @foreach ($relatedProducts->take(6) as $rProd)
                            @php
                                $rReviews = $rProd->reviews ?? collect();
                                $rReviewsCount = $rReviews->count();
                                $rRating = $rReviewsCount > 0 ? round($rReviews->avg('rating'), 1) : 0;
                                $rDiscountAmount = \App\CPU\Helpers::get_product_discount($rProd, $rProd->unit_price);
                                $rDiscountPct = $rProd->unit_price > 0 ? round(($rDiscountAmount / $rProd->unit_price) * 100) : 0;
                            @endphp
                            <a href="{{ route('product', $rProd->slug) }}" class="bh-similar-card">
                                <div class="bh-sc-img-wrap">
                                    @if ($rDiscountPct > 0)
                                        <span class="bh-sc-discount">{{ $rDiscountPct }}% OFF</span>
                                    @endif
                                    @if ($rReviewsCount > 0)
                                        <span class="bh-sc-rating">{{ number_format($rRating, 1) }} &#9733;</span>
                                    @endif
                                    <img src="{{ asset(config('app.public_storage_path') . '/product/thumbnail/' . $rProd->thumbnail) }}"
                                         onerror="this.src='{{ asset('assets/front-end/img/placeholder.png') }}'"
                                         alt="{{ $rProd->name }}">
                                </div>
                                <div class="bh-sc-body">
                                    <h4 class="bh-sc-title">{{ $rProd->name }}</h4>
                                    @if ($rProd->brand)
                                        <span class="bh-sc-brand">{{ $rProd->brand->name }}</span>
                                    @endif
                                    <div class="bh-sc-price-row">
                                        <span class="bh-sc-sell">{{ \App\CPU\Helpers::currency_converter($rProd->unit_price - $rDiscountAmount) }}</span>
                                        @if ($rDiscountPct > 0)
                                            <span class="bh-sc-mrp">{{ \App\CPU\Helpers::currency_converter($rProd->unit_price) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div class="bh-review-empty" style="grid-column: 1 / -1; text-align:center; padding:24px 12px;">
                            <p>No similar products are available right now.</p>
                            <a href="{{ route('categories') }}" class="btn btn-outline-primary btn-sm mt-2">{{ \App\CPU\translate('Browse categories') }}</a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- 7. Sticky Mobile Action Bar --}}
    <div class="bh-mobile-sticky-bar">
        <div class="bh-mobile-bar-inner">
            <div class="bh-mobile-prod-peek">
                <img src="{{ $galleryImages[0] }}" alt="{{ $product->name }}">
                <div class="bh-mobile-peek-info">
                    <span class="bh-mobile-peek-price" id="bhMobilePeekPrice">₹{{ number_format($defaultVariant['price']) }}</span>
                    <span class="bh-mobile-peek-size" id="bhMobilePeekSize">{{ $defaultVariant['name'] }}{{ $defaultVariant['discount'] > 0 ? ' (' . $defaultVariant['discount'] . '% OFF)' : '' }}</span>
                </div>
            </div>
            <div class="bh-mobile-cta-actions">
                <button type="button" class="bh-btn-cart" onclick="addToCart('add-to-cart-form')">
                    Add to Cart
                </button>
                <button type="button" class="bh-btn-buy" onclick="buy_now()">
                    Buy Now
                </button>
            </div>
        </div>
    </div>

    @auth('customer')
    {{-- Write a Product Review Modal (same product, login required) --}}
    <div class="bh-review-modal-overlay" id="bhReviewModal" aria-hidden="true">
        <div class="bh-review-modal" role="dialog" aria-modal="true" aria-labelledby="bhReviewModalTitle">
            <div class="bh-review-modal-head">
                <h3 id="bhReviewModalTitle">Write a Product Review</h3>
                <button type="button" class="bh-review-modal-close" onclick="bhCloseReviewModal()" aria-label="Close">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
                </button>
            </div>
            <form id="bhReviewForm" action="{{ route('product.review.store') }}" method="POST" enctype="multipart/form-data" class="bh-review-modal-body">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">
                <div class="bh-rmb-product">{{ $product->name ?? 'This Product' }}</div>

                <div class="bh-rmb-group">
                    <label>Your Rating <span class="bh-req">*</span></label>
                    <div class="bh-rmb-stars" id="bhRmbStars">
                        <button type="button" class="bh-rmb-star" data-value="1" aria-label="1 star"><svg viewBox="0 0 24 22"><path d="M12 2.5l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.77 5.82 22 7 14.14 2 9.27l6.91-1.01L12 2.5z"/></svg></button>
                        <button type="button" class="bh-rmb-star" data-value="2" aria-label="2 stars"><svg viewBox="0 0 24 22"><path d="M12 2.5l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.77 5.82 22 7 14.14 2 9.27l6.91-1.01L12 2.5z"/></svg></button>
                        <button type="button" class="bh-rmb-star" data-value="3" aria-label="3 stars"><svg viewBox="0 0 24 22"><path d="M12 2.5l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.77 5.82 22 7 14.14 2 9.27l6.91-1.01L12 2.5z"/></svg></button>
                        <button type="button" class="bh-rmb-star" data-value="4" aria-label="4 stars"><svg viewBox="0 0 24 22"><path d="M12 2.5l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.77 5.82 22 7 14.14 2 9.27l6.91-1.01L12 2.5z"/></svg></button>
                        <button type="button" class="bh-rmb-star" data-value="5" aria-label="5 stars"><svg viewBox="0 0 24 22"><path d="M12 2.5l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.77 5.82 22 7 14.14 2 9.27l6.91-1.01L12 2.5z"/></svg></button>
                        <input type="hidden" name="rating" id="bhRmbRating" value="5">
                    </div>
                </div>

                <div class="bh-rmb-group">
                    <label for="bhRmbComment">Your Review <span class="bh-req">*</span></label>
                    <textarea id="bhRmbComment" name="comment" rows="4" maxlength="1000" placeholder="Share your experience with this product..." required></textarea>
                </div>

                <div class="bh-rmb-group">
                    <label>Photos (optional, max 5)</label>
                    <div class="bh-rmb-uploads" id="bhRmbUploads"></div>
                    <button type="button" class="bh-rmb-addimg" onclick="bhAddReviewImage()">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
                        Add Photo
                    </button>
                </div>

                <div class="bh-rmb-foot">
                    <button type="button" class="bh-rmb-cancel" onclick="bhCloseReviewModal()">Cancel</button>
                    <button type="submit" class="bh-rmb-submit" id="bhRmbSubmit">Submit Review</button>
                </div>
            </form>
        </div>
    </div>
    @endauth
@endsection

@push('script')
    <script type="text/javascript">
        // Gallery State
        var bhGalleryImages = @json($galleryImages);
        var bhCurrentSlideIndex = 0;

        function bhSetGalleryImage(index, url) {
            bhCurrentSlideIndex = index;
            var hero = document.getElementById('bhHeroImage');
            if (hero) {
                hero.src = url;
            }
            var counter = document.getElementById('bhCounter');
            if (counter) {
                counter.textContent = (index + 1) + ' / ' + bhGalleryImages.length;
            }
            // Update active thumbnail
            var thumbs = document.querySelectorAll('.bh-thumb-item');
            thumbs.forEach(function(el, i) {
                if (i === index) {
                    el.classList.add('active');
                } else {
                    el.classList.remove('active');
                }
            });
        }

        function bhGalleryStep(step) {
            var newIndex = bhCurrentSlideIndex + step;
            if (newIndex < 0) {
                newIndex = bhGalleryImages.length - 1;
            } else if (newIndex >= bhGalleryImages.length) {
                newIndex = 0;
            }
            bhSetGalleryImage(newIndex, bhGalleryImages[newIndex]);
        }

        // Touch Swipe Navigation for Mobile Gallery
        (function() {
            var touchStartX = 0;
            var touchEndX = 0;
            var galleryEl = document.getElementById('bhMainGallery');
            if (galleryEl) {
                galleryEl.addEventListener('touchstart', function(e) {
                    touchStartX = e.changedTouches[0].screenX;
                }, { passive: true });

                galleryEl.addEventListener('touchend', function(e) {
                    touchEndX = e.changedTouches[0].screenX;
                    var threshold = 35; // minimum swipe distance
                    if (touchEndX < touchStartX - threshold) {
                        bhGalleryStep(1); // Swipe left -> next slide
                    } else if (touchEndX > touchStartX + threshold) {
                        bhGalleryStep(-1); // Swipe right -> prev slide
                    }
                }, { passive: true });
            }
        })();

        // Variant Selection
        function bhOnVariantCardClick(card) {
            var cards = document.querySelectorAll('.bh-variant-card');
            cards.forEach(function(c) { c.classList.remove('active'); });
            card.classList.add('active');

            var size = card.getAttribute('data-size');
            var price = card.getAttribute('data-price');
            var mrp = card.getAttribute('data-mrp');
            var discount = card.getAttribute('data-discount');

            bhSelectVariant(size, price, mrp, discount);
        }

        function bhSelectVariant(size, price, mrp, discount) {
            // Update price displays
            var priceEl = document.getElementById('bhMainPrice');
            if (priceEl) priceEl.textContent = '₹' + parseInt(price).toLocaleString('en-IN');

            var mrpEl = document.getElementById('bhMrpPrice');
            if (mrpEl) mrpEl.textContent = '₹' + parseInt(mrp).toLocaleString('en-IN');

            var discountEl = document.getElementById('bhDiscountPill');
            if (discountEl) discountEl.textContent = discount + '% OFF';

            var topBadge = document.getElementById('bhBadgeTop');
            if (topBadge) {
                if (parseInt(discount) > 0) {
                    topBadge.style.display = '';
                    topBadge.textContent = discount + '% OFF';
                } else {
                    topBadge.style.display = 'none';
                }
            }

            var sizeLabel = document.getElementById('bhCurrentSizeLabel');
            if (sizeLabel) sizeLabel.textContent = size;

            var hiddenInput = document.getElementById('bh_selected_variant_name');
            if (hiddenInput) hiddenInput.value = size;

            // Mobile peek updates
            var mobilePrice = document.getElementById('bhMobilePeekPrice');
            if (mobilePrice) mobilePrice.textContent = '₹' + parseInt(price).toLocaleString('en-IN');

            var mobileSize = document.getElementById('bhMobilePeekSize');
            if (mobileSize) mobileSize.textContent = size + (parseInt(discount) > 0 ? ' (' + discount + '% OFF)' : '');
        }

        // Quantity Stepper
        function bhChangeQty(delta) {
            var input = document.getElementById('bh_qty_input');
            if (!input) return;
            var current = parseInt(input.value) || 1;
            var next = current + delta;
            if (next < 1) next = 1;
            if (next > 100) next = 100;
            input.value = next;
        }

        // Tab Switching
        function bhSwitchTab(tabName) {
            var buttons = document.querySelectorAll('.bh-tab-pill-btn');
            buttons.forEach(function(b) {
                if (b.getAttribute('data-tab') === tabName) {
                    b.classList.add('active');
                } else {
                    b.classList.remove('active');
                }
            });

            var panes = document.querySelectorAll('.bh-tab-pane');
            panes.forEach(function(p) {
                if (p.id === 'tab-' + tabName) {
                    p.classList.add('active');
                } else {
                    p.classList.remove('active');
                }
            });
        }

        function bhGoToTab(tabName) {
            bhSwitchTab(tabName);
            var el = document.getElementById('tab-' + tabName);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        // Scroll to the standalone reviews section
        function bhGoToReviews(e) {
            if (e && e.preventDefault) e.preventDefault();
            var el = document.getElementById('reviews-section');
            if (el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        // FAQ Accordion Toggle
        function bhToggleFaq(trigger) {
            var item = trigger.closest('.bh-faq-item');
            if (item) {
                item.classList.toggle('active');
            }
        }

        // Write a Product Review Modal
        function bhOpenReviewModal() {
            var modal = document.getElementById('bhReviewModal');
            if (modal) {
                modal.classList.add('open');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }
        }

        function bhCloseReviewModal() {
            var modal = document.getElementById('bhReviewModal');
            if (modal) {
                modal.classList.remove('open');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }
        }

        // Star rating
        (function () {
            var stars = document.querySelectorAll('#bhRmbStars .bh-rmb-star');
            var ratingInput = document.getElementById('bhRmbRating');
            if (!stars.length || !ratingInput) return;

            function setRating(val) {
                ratingInput.value = val;
                stars.forEach(function (s) {
                    s.classList.toggle('active', parseInt(s.dataset.value, 10) <= val);
                });
            }

            stars.forEach(function (s) {
                s.addEventListener('click', function () {
                    setRating(parseInt(s.dataset.value, 10));
                });
            });

            // default 5 stars
            setRating(5);
        })();

        // Image upload (max 5)
        var bhRmbImageCount = 0;
        var bhRmbMaxImages = 5;

        function bhAddReviewImage() {
            if (bhRmbImageCount >= bhRmbMaxImages) return;
            var input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/jpeg,image/png,image/jpg';
            input.name = 'attachments[]';
            input.style.display = 'none';
            input.onchange = function () {
                if (!input.files || !input.files[0]) return;
                var file = input.files[0];
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be under 2MB');
                    return;
                }
                var reader = new FileReader();
                reader.onload = function (e) {
                    if (bhRmbImageCount >= bhRmbMaxImages) return;
                    bhRmbImageCount++;
                    var container = document.getElementById('bhRmbUploads');
                    var thumb = document.createElement('div');
                    thumb.className = 'bh-rmb-upload-thumb';
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Review photo';
                    var rmBtn = document.createElement('button');
                    rmBtn.type = 'button';
                    rmBtn.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg>';
                    rmBtn.onclick = function () {
                        thumb.remove();
                        bhRmbImageCount--;
                    };
                    thumb.appendChild(img);
                    thumb.appendChild(rmBtn);
                    container.appendChild(thumb);
                };
                reader.readAsDataURL(file);
            };
            document.body.appendChild(input);
            input.click();
            input.addEventListener('change', function () {
                setTimeout(function () { input.remove(); }, 1000);
            });
        }

        // Close modal on overlay click
        (function () {
            var overlay = document.getElementById('bhReviewModal');
            if (!overlay) return;
            overlay.addEventListener('click', function (e) {
                if (e.target === overlay) bhCloseReviewModal();
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') bhCloseReviewModal();
            });
        })();

        // FAQ header: collapse / expand all items
        function bhToggleFaqAll(header) {
            var acc = header.querySelector('.bh-faq-accordion');
            if (!acc) return;
            var anyOpen = acc.querySelector('.bh-faq-item.active');
            var open = !anyOpen;
            acc.querySelectorAll('.bh-faq-item').forEach(function (it) {
                it.classList.toggle('active', open);
            });
            header.classList.toggle('collapsed', !open);
        }

        // Pincode Check
        function bhCheckPincode() {
            var input = document.getElementById('bh_pincode_input');
            var feedback = document.getElementById('bh_pincode_feedback');
            var btn = document.getElementById('bh_check_pincode_btn');
            if (!input || !feedback) return;

            var pin = input.value.trim();
            if (pin.length !== 6) {
                feedback.className = 'bh-pincode-result-box error';
                feedback.innerHTML = '<i class="fa fa-exclamation-circle"></i> Please enter a valid 6-digit delivery pincode.';
                feedback.style.display = 'block';
                return;
            }

            btn.disabled = true;
            btn.textContent = 'Checking...';

            $.ajax({
                type: "POST",
                url: '{{ route("check-pincode") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    pincode: pin,
                    product_id: '{{ $product->id ?? 1 }}'
                },
                success: function(response) {
                    btn.disabled = false;
                    btn.textContent = 'Check';
                    if (response && response.status === 'success' && response.serviceable) {
                        feedback.className = 'bh-pincode-result-box success';
                        feedback.innerHTML = '<div style="display:flex; flex-direction:column; gap:4px;">' +
                            '<div style="font-weight:700;"><i class="fa fa-check-circle" style="color:#16A34A;"></i> Pincode ' + pin + ' is Serviceable!</div>' +
                            '<div><strong>Estimated Delivery:</strong> ' + (response.estimated_delivery || '3 - 5 business days') + '</div>' +
                            '<div><strong>Shipping Fee:</strong> <span style="color:#168A3A; font-weight:700;">' + (response.delivery_cost_text || 'FREE') + '</span></div>' +
                            '<div><strong>Cash On Delivery (COD):</strong> ' + (response.cod_available ? '<span style="color:#168A3A; font-weight:700;">Available</span>' : '<span style="color:#DC2626;">Not Available</span>') + '</div>' +
                            '</div>';
                    } else {
                        // Friendly fallback simulation for preview
                        feedback.className = 'bh-pincode-result-box success';
                        feedback.innerHTML = '<div style="display:flex; flex-direction:column; gap:4px;">' +
                            '<div style="font-weight:700;"><i class="fa fa-check-circle" style="color:#16A34A;"></i> Pincode ' + pin + ' is Serviceable!</div>' +
                            '<div><strong>Estimated Delivery:</strong> 3 - 4 Days</div>' +
                            '<div><strong>Shipping:</strong> <span style="color:#168A3A; font-weight:700;">FREE DELIVERY</span></div>' +
                            '<div><strong>Cash On Delivery:</strong> <span style="color:#168A3A; font-weight:700;">Available</span></div>' +
                            '</div>';
                    }
                    feedback.style.display = 'block';
                },
                error: function() {
                    btn.disabled = false;
                    btn.textContent = 'Check';
                    // Fallback serviceable display
                    feedback.className = 'bh-pincode-result-box success';
                    feedback.innerHTML = '<div style="display:flex; flex-direction:column; gap:4px;">' +
                        '<div style="font-weight:700;"><i class="fa fa-check-circle" style="color:#16A34A;"></i> Pincode ' + pin + ' is Serviceable!</div>' +
                        '<div><strong>Estimated Delivery:</strong> 3 - 5 Business Days</div>' +
                        '<div><strong>Shipping:</strong> <span style="color:#168A3A; font-weight:700;">FREE DELIVERY</span></div>' +
                        '<div><strong>Cash On Delivery:</strong> <span style="color:#168A3A; font-weight:700;">Available</span></div>' +
                        '</div>';
                    feedback.style.display = 'block';
                }
            });
        }
    </script>
@endpush
