@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('My Wishlists'))

@push('css_or_js')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* ===== Premium Wishlist ===== */
        #set-wish-list {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        #set-wish-list .wl-item {
            border: 1px solid #E5E9F0;
            border-radius: 14px;
            background: #FFFFFF;
            box-shadow: 0 2px 12px rgba(17, 24, 39, .04);
            margin-bottom: 14px;
            overflow: hidden;
            transition: box-shadow 180ms ease, border-color 180ms ease;
        }
        #set-wish-list .wl-item:hover {
            border-color: #D0D7E2;
            box-shadow: 0 6px 20px rgba(17, 24, 39, .07);
        }
        #set-wish-list .wl-item .row {
            margin: 0;
            align-items: center;
        }
        #set-wish-list .wl-img {
            padding: 14px;
        }
        #set-wish-list .wl-img a {
            display: block;
            border-radius: 10px;
            overflow: hidden;
            background: #F9FAFB;
            border: 1px solid #EEF1F6;
            aspect-ratio: 1;
        }
        #set-wish-list .wl-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 250ms ease;
        }
        #set-wish-list .wl-item:hover .wl-img img {
            transform: scale(1.04);
        }
        #set-wish-list .wl-body {
            padding: 14px 16px 14px 4px;
            min-width: 0;
        }
        #set-wish-list .wl-name {
            font-size: 15px;
            font-weight: 600;
            color: #111827;
            margin: 0 0 6px;
            letter-spacing: -.01em;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        #set-wish-list .wl-name a {
            color: #111827;
            text-decoration: none;
            transition: color 150ms ease;
        }
        #set-wish-list .wl-name a:hover {
            color: {{$web_config['primary_color']}};
        }
        #set-wish-list .wl-brand {
            display: inline-block;
            font-size: 12.5px;
            font-weight: 500;
            color: #6B7280;
            background: #F3F4F6;
            border-radius: 6px;
            padding: 3px 9px;
            margin-bottom: 10px;
        }
        #set-wish-list .wl-prices {
            display: flex;
            align-items: baseline;
            flex-wrap: wrap;
            gap: 8px;
        }
        #set-wish-list .wl-price {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            letter-spacing: -.01em;
        }
        #set-wish-list .wl-price-old {
            font-size: 13.5px;
            font-weight: 400;
            color: #9CA3AF;
            text-decoration: line-through;
        }
        #set-wish-list .wl-remove {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #FFFFFF;
            border: 1px solid #E5E9F0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #EF4444;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(17, 24, 39, .08);
            transition: background 150ms ease, border-color 150ms ease, color 150ms ease;
            z-index: 2;
            text-decoration: none;
        }
        #set-wish-list .wl-remove:hover {
            background: #FEF2F2;
            border-color: #FECACA;
            color: #DC2626;
        }
        #set-wish-list .wl-item {
            position: relative;
        }

        /* Empty state */
        #set-wish-list .wl-empty {
            border: 1.5px dashed #D9DEE7;
            border-radius: 16px;
            background: #FAFBFC;
            padding: 56px 24px;
            text-align: center;
        }
        #set-wish-list .wl-empty i {
            font-size: 42px;
            color: #D1D5DB;
            margin-bottom: 14px;
            display: block;
        }
        #set-wish-list .wl-empty h6 {
            font-size: 15px;
            font-weight: 500;
            color: #6B7280;
            margin: 0;
        }
        #set-wish-list .wl-empty-badge {
            display: inline-block;
        }

        @media (max-width: 767.98px) {
            #set-wish-list .wl-img { padding: 12px 12px 0; }
            #set-wish-list .wl-img a { aspect-ratio: 16/10; }
            #set-wish-list .wl-body { padding: 12px 14px 16px; }
            #set-wish-list .wl-remove { top: 18px; right: 18px; }
        }
    </style>
@endpush

@section('content')
    <!-- Page Content-->
    <div class="container rtl pb-5" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <h3 class="headerTitle my-3 text-center">{{\App\CPU\translate('wishlist')}}</h3>

        <div class="row">
            <!-- Sidebar-->
        @include('web-views.partials._profile-aside')
        <!-- Content  -->
            <section class="col-lg-9 col-md-9" id="set-wish-list">
                <!-- Item-->

                @include('web-views.partials._wish-list-data',['wishlists'=>$wishlists, 'brand_setting'=>$brand_setting])
            </section>
        </div>
    </div>
@endsection

