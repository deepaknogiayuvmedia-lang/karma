<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- Phase 20: Product Description Layout Fix -->
    <style>
        /* Responsive tables in product description */
        .product-description table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .product-description table th,
        .product-description table td {
            border: 1px solid #dee2e6;
            padding: 10px 12px;
            text-align: left;
        }
        .product-description table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .product-description table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        @media (max-width: 767px) {
            .product-description .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                margin: 10px 0;
            }
            .product-description table {
                min-width: 500px;
                font-size: 0.85rem;
            }
            .product-description table th,
            .product-description table td {
                padding: 6px 8px;
                white-space: nowrap;
            }
        }
        /* Typography fix for product description */
        .product-description h1,
        .product-description h2,
        .product-description h3,
        .product-description h4 {
            margin-top: 1.2em;
            margin-bottom: 0.6em;
        }
        .product-description p {
            margin-bottom: 1em;
            line-height: 1.7;
        }
        .product-description img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }
        .product-description ul,
        .product-description ol {
            padding-left: 1.5em;
            margin-bottom: 1em;
        }
        .product-description li {
            margin-bottom: 0.3em;
            line-height: 1.6;
        }
    </style>
    <meta charset="utf-8">
    <title>
        @yield('title')
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset(config('app.public_storage_path') . '/company') }}/{{ $web_config['fav_icon']->value }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset(config('app.public_storage_path') . '/company') }}/{{ $web_config['fav_icon']->value }}">

    <link rel="stylesheet" media="screen"
        href="{{ asset('assets/front-end') }}/vendor/simplebar/dist/simplebar.min.css" />
    <link rel="stylesheet" media="screen"
        href="{{ asset('assets/front-end') }}/vendor/tiny-slider/dist/tiny-slider.css" />
    <link rel="stylesheet" media="screen"
        href="{{ asset('assets/front-end') }}/vendor/drift-zoom/dist/drift-basic.min.css" />
    <link rel="stylesheet" media="screen"
        href="{{ asset('assets/front-end') }}/vendor/lightgallery.js/dist/css/lightgallery.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/back-end') }}/css/toastr.css" />
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="{{ asset('assets/front-end') }}/css/theme.min.css">
    <link rel="stylesheet" media="screen" href="{{ asset('assets/front-end') }}/css/slick.css">
    <link rel="stylesheet" media="screen" href="{{ asset('assets/front-end') }}/css/font-awesome.min.css">
    <!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="{{ asset('assets/back-end') }}/css/toastr.css" />
    <link rel="stylesheet" href="{{ asset('assets/front-end') }}/css/master.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Titillium+Web:wght@400;600;700&display=swap"
        rel="stylesheet">
    {{-- light box --}}
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back-end') }}/vendor/icon-set/style.css">
    @stack('css_or_js')

    <link rel="stylesheet" href="{{ asset('assets/front-end') }}/css/home.css" />
    <link rel="stylesheet" href="{{ asset('assets/front-end') }}/css/responsive1.css" />


    <link rel="stylesheet" href="{{ asset('assets/front-end') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('assets/front-end') }}/css/bighaat-theme.css">
    {{-- dont touch this --}}
    <meta name="_token" content="{{ csrf_token() }}">
    <!-- Phase 21: UI Improvements -->
    <style>
        /* Cards */
        .card {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }
        /* Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 8px 20px;
            transition: all 0.2s ease;
        }
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .btn--primary {
            border-radius: 8px;
        }
        /* Forms */
        .form-control {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            border-color: var(--primary_color, #007bff);
            box-shadow: 0 0 0 3px rgba(0,123,255,0.15);
        }
        /* Tables */
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        /* Badges */
        .badge {
            border-radius: 6px;
            padding: 4px 10px;
            font-weight: 500;
        }
        /* Product cards */
        .product-card {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        /* Alerts */
        .alert {
            border-radius: 10px;
            border: none;
        }
        /* Dropdown menus */
        .dropdown-menu {
            border-radius: 10px;
            border: 1px solid #e9ecef;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            padding: 8px 0;
        }
        .dropdown-item {
            padding: 8px 16px;
            border-radius: 6px;
            margin: 0 8px;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        /* Mobile improvements */
        @media (max-width: 767px) {
            .btn {
                padding: 10px 16px;
                font-size: 0.9rem;
            }
            
            .table {
                font-size: 0.85rem;
            }
            .product-card .product-card__body {
                padding: 12px;
            }
            .product-card .product-card__title {
                font-size: 0.9rem;
            }
        }
    </style>
    {{-- dont touch this --}}
    <!--to make http ajax request to https-->
    <!--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">-->

    <style>
        .rtl {
            direction: {{ Session::get('direction') }};
        }

        .password-toggle-btn .password-toggle-indicator:hover {
            color: {{ $web_config['primary_color'] }};
        }

        .password-toggle-btn .custom-control-input:checked~.password-toggle-indicator {
            color: {{ $web_config['secondary_color'] }};
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            color: {{ $web_config['primary_color'] }};
        }

        .dropdown-item.active,
        .dropdown-item:active {
            color: {{ $web_config['secondary_color'] }};
        }

        .navbar-light .navbar-tool-icon-box {
            color: {{ $web_config['primary_color'] }};
        }

        .search_button {
            background-color: {{ $web_config['primary_color'] }};
        }


        .navbar-stuck-menu {
            background-color: {{ $web_config['primary_color'] }};
        }

        .mega-nav .nav-item .nav-link {
            color: {{ $web_config['primary_color'] }} !important;
        }

        .checkbox-alphanumeric label:hover {
            border-color: {{ $web_config['primary_color'] }};
        }

        ::-webkit-scrollbar-thumb:hover {
            background: {{ $web_config['secondary_color'] }} !important;
        }

        [type="radio"] {
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        [type="radio"]+span:after {
            box-shadow: 0 0 0 0.10em{{ $web_config['secondary_color'] }};
        }

        [type="radio"]:checked+span:after {
            background: {{ $web_config['secondary_color'] }};
            box-shadow: 0 0 0 0.10em{{ $web_config['secondary_color'] }};
        }

        .navbar-tool .navbar-tool-label {
            background-color: {{ $web_config['secondary_color'] }} !important;
        }

        .btn--primary {
            color: #fff;
            background-color: {{ $web_config['primary_color'] }} !important;
            border-color: {{ $web_config['primary_color'] }} !important;
        }

        .btn--primary:hover {
            color: #fff;
            background-color: {{ $web_config['primary_color'] }} !important;
            border-color: {{ $web_config['primary_color'] }} !important;
        }

        .btn-secondary {
            background-color: {{ $web_config['secondary_color'] }} !important;
            border-color: {{ $web_config['secondary_color'] }} !important;
        }

        .btn-outline-accent:hover {
            color: #fff;
            background-color: {{ $web_config['primary_color'] }};
            border-color: {{ $web_config['primary_color'] }};
        }

        .btn-outline-accent {
            color: {{ $web_config['primary_color'] }};
            border-color: {{ $web_config['primary_color'] }};
        }

        .text-accent {
            color: {{ $web_config['primary_color'] }};
        }

        a:hover {
            color: {{ $web_config['secondary_color'] }};
        }

        .active-menu {
            color: {{ $web_config['secondary_color'] }} !important;
        }

        .page-item.active>.page-link {
            box-shadow: 0 0.5rem 1.125rem -0.425rem{{ $web_config['primary_color'] }}
        }

        .page-item.active .page-link {
            background-color: {{ $web_config['primary_color'] }};
        }

        .btn-outline-accent:not(:disabled):not(.disabled):active,
        .btn-outline-accent:not(:disabled):not(.disabled).active,
        .show>.btn-outline-accent.dropdown-toggle {
            background-color: {{ $web_config['secondary_color'] }};
            border-color: {{ $web_config['secondary_color'] }};
        }

        .btn-outline-primary {
            color: {{ $web_config['primary_color'] }};
            border-color: {{ $web_config['primary_color'] }};
        }

        .btn-outline-primary:hover {
            background-color: {{ $web_config['secondary_color'] }};
            border-color: {{ $web_config['secondary_color'] }};
        }

        .btn-outline-primary:focus,
        .btn-outline-primary.focus {
            box-shadow: 0 0 0 0{{ $web_config['secondary_color'] }};
        }

        .btn-outline-primary:not(:disabled):not(.disabled):active,
        .btn-outline-primary:not(:disabled):not(.disabled).active,
        .show>.btn-outline-primary.dropdown-toggle {
            background-color: {{ $web_config['primary_color'] }};
            border-color: {{ $web_config['primary_color'] }};
        }

        .btn-outline-primary:not(:disabled):not(.disabled):active:focus,
        .btn-outline-primary:not(:disabled):not(.disabled).active:focus,
        .show>.btn-outline-primary.dropdown-toggle:focus {
            box-shadow: 0 0 0 0{{ $web_config['primary_color'] }};
        }

        .for-discoutn-value {
            background: {{ $web_config['primary_color'] }};
        }

        .dropdown-menu {
            margin-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }} -8px !important;
        }

        /* Footer */
        .bh-footer-topbar {
            background-color: var(--bh-dark-green, #0B5D2A);
            color: #ffffff;
            padding: 12px 0;
        }
        .bh-footer-social-icon {
            background: rgba(255,255,255,0.15);
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .bh-footer-body {
            padding: 40px 0;
            background-color: #ffffff;
            border-bottom: 1px solid var(--bh-border, #E1E6E2);
        }
        .bh-footer-heading {
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--bh-text-primary, #1B1F1D);
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            line-height: 1.4;
        }
        .bh-footer-links {
            font-size: 0.85rem;
            line-height: 2;
        }
        .bh-footer-links li a {
            color: var(--bh-text-secondary, #66706A);
            text-decoration: none;
            transition: color 0.2s;
        }
        .bh-footer-links li a:hover {
            color: var(--bh-dark-green, #0B5D2A);
        }
        .bh-footer-contact {
            font-size: 0.85rem;
            color: var(--bh-text-secondary, #66706A);
        }
        .bh-footer-contact-link {
            color: var(--bh-text-primary, #1B1F1D);
            font-weight: 600;
            text-decoration: none;
        }
        .bh-footer-contact-link:hover {
            color: var(--bh-dark-green, #0B5D2A);
        }
        .bh-footer-text {
            font-size: 0.82rem;
            color: var(--bh-text-secondary, #66706A);
            line-height: 1.5;
        }
        .bh-footer-input {
            border-radius: 8px 0 0 8px;
            border: 1px solid var(--bh-border, #E1E6E2);
            font-size: 0.85rem;
        }
        .bh-footer-subscribe-btn {
            border-radius: 0 8px 8px 0 !important;
            font-size: 0.85rem;
        }
        .bh-footer-bottombar {
            padding: 12px 0;
            background-color: var(--bh-bg, #F7F8F6);
        }
        .bh-footer-copyright {
            font-size: 0.82rem;
            color: var(--bh-text-secondary, #66706A);
        }
        .bh-footer-secure {
            font-size: 0.8rem;
            color: var(--bh-text-secondary, #66706A);
        }
    </style>

    @php($google_tag_manager_id = \App\CPU\Helpers::get_business_settings('google_tag_manager_id'))
    @if ($google_tag_manager_id)
        <!-- Google Tag Manager -->
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '{{ $google_tag_manager_id }}');
        </script>
        <!-- End Google Tag Manager -->
    @endif
    @php($pixel_analytices_user_code = \App\CPU\Helpers::get_business_settings('pixel_analytics'))
    @if ($pixel_analytices_user_code)
        <!-- Facebook Pixel Code -->
        <script>
            ! function(f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function() {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{your-pixel-id-goes-here}');
            fbq('track', 'PageView');
        </script>
        <noscript>
            <img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id={your-pixel-id-goes-here}&ev=PageView&noscript=1" />
        </noscript>
        <!-- End Facebook Pixel Code -->
    @endif
</head>
<!-- Body-->

<body class="toolbar-enabled">
    @if ($google_tag_manager_id)
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $google_tag_manager_id }}" height="0"
                width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif
    <!-- Sign in / sign up modal-->
    @include('layouts.front-end.partials._modals')
    <!-- Navbar-->
    <!-- Quick View Modal-->
    @include('layouts.front-end.partials._quick-view-modal')
    <!-- Navbar Electronics Store-->
    @include('layouts.front-end.partials._header')
    <!-- Page title-->

    {{-- loader --}}
    <div class="row">
        <div class="col-12" style="margin-top:10rem;position: fixed;z-index: 9999;">
            <div id="loading" style="display: none;">
                <center>
                    <img width="200"
                        src="{{ asset(config('app.public_storage_path') . '/company') }}/{{ \App\CPU\Helpers::get_business_settings('loader_gif') }}"
                        onerror="this.src='{{ asset('assets/front-end/img/loader.gif') }}'">
                </center>
            </div>
        </div>
    </div>
    {{-- loader --}}

    <!-- Page Content-->
    <!-- Back Button -->
   
    <!-- End Back Button -->
    @yield('content')

    <!-- Footer-->
    <!-- Footer-->
    @include('layouts.front-end.partials._footer')

    <!-- Mobile Bottom Navigation Toolbar (BigHaat Specification) -->
    <div class="bh-mobile-nav">
        <a href="{{ route('home') }}" class="bh-mobile-nav-item {{ request()->is('/') ? 'active' : '' }}">
            <i class="fa fa-home"></i>
            <span>{{ \App\CPU\translate('Home') }}</span>
        </a>
        <a href="{{ route('categories') }}" class="bh-mobile-nav-item {{ request()->is('categories*') ? 'active' : '' }}">
            <i class="fa fa-th-large"></i>
            <span>{{ \App\CPU\translate('Categories') }}</span>
        </a>
        <a href="{{ route('products', ['data_from' => 'search', 'page' => 1]) }}" class="bh-mobile-nav-item">
            <i class="fa fa-search"></i>
            <span>{{ \App\CPU\translate('Search') }}</span>
        </a>
        <a href="{{ route('account-oder') }}" class="bh-mobile-nav-item {{ request()->is('account-oder*') ? 'active' : '' }}">
            <i class="fa fa-shopping-bag"></i>
            <span>{{ \App\CPU\translate('Orders') }}</span>
        </a>
        <a href="{{ route('user-account') }}" class="bh-mobile-nav-item {{ request()->is('user-account*') ? 'active' : '' }}">
            <i class="fa fa-user"></i>
            <span>{{ \App\CPU\translate('Account') }}</span>
        </a>
    </div>

    <div class="__floating-btn">
        @php($whatsapp = \App\CPU\Helpers::get_business_settings('whatsapp'))
        @if (isset($whatsapp['status']) && $whatsapp['status'] == 1)
            <div class="wa-widget-send-button">
                <a href="https://web.whatsapp.com/send/?phone={{ $whatsapp['phone'] }}?text=Hello%20there!"
                    target="_blank">
                    <img src="{{ asset('assets/front-end/img/whatsapp.svg') }}"
                        class="wa-messenger-svg-whatsapp wh-svg-icon" alt="Chat with us on WhatsApp">
                </a>
            </div>
        @endif

        {{--    @php($messenger = \App\CPU\Helpers::get_business_settings('messenger')) --}}
        {{--    @if (isset($messenger['status']) && $messenger['status'] == 1) --}}
        {{--        {!! $messenger['script'] !!} --}}
        {{--    @endif --}}

        <!-- Vendor scrits: js libraries and plugins-->
    </div>

    {{-- <script src="{{asset('assets/front-end')}}/vendor/jquery/dist/jquery.slim.min.js"></script> --}}
    <script src="{{ asset('assets/front-end') }}/vendor/jquery/dist/jquery-2.2.4.min.js"></script>
    <script src="{{ asset('assets/front-end') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/front-end') }}/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js">
    </script>
    <script src="{{ asset('assets/front-end') }}/vendor/simplebar/dist/simplebar.min.js"></script>
    <script src="{{ asset('assets/front-end') }}/vendor/tiny-slider/dist/min/tiny-slider.js"></script>
    <script src="{{ asset('assets/front-end') }}/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

    {{-- light box --}}
    <script src="{{ asset('js/lightbox.min.js') }}"></script>
    <script src="{{ asset('assets/front-end') }}/vendor/drift-zoom/dist/Drift.min.js"></script>
    <script src="{{ asset('assets/front-end') }}/vendor/lightgallery.js/dist/js/lightgallery.min.js"></script>
    <script src="{{ asset('assets/front-end') }}/vendor/lg-video.js/dist/lg-video.min.js"></script>
    {{-- Toastr --}}
    <script src="{{ asset('assets/back-end/js/toastr.js') }}"></script>
    <!-- Main theme script-->
    <script src="{{ asset('assets/front-end') }}/js/theme.min.js"></script>
    <script src="{{ asset('assets/front-end') }}/js/slick.min.js"></script>

    <script src="{{ asset('assets/front-end') }}/js/sweet_alert.js"></script>
    {!! Toastr::message() !!}
      <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-messaging-compat.js"></script>

    <script>
      
        const firebaseConfig = {
            apiKey: "{{ \App\CPU\Helpers::get_business_settings('fcm_api_key') }}",
            authDomain: "{{ \App\CPU\Helpers::get_business_settings('fcm_auth_domain') }}",
            projectId: "{{ \App\CPU\Helpers::get_business_settings('fcm_project_id') }}",
            storageBucket: "{{ \App\CPU\Helpers::get_business_settings('fcm_storage_bucket') }}",
            messagingSenderId: "{{ \App\CPU\Helpers::get_business_settings('fcm_messaging_sender_id') }}",
            appId: "{{ \App\CPU\Helpers::get_business_settings('fcm_app_id') }}",
        };

        // Init
        if (!firebase.apps.length) {
            firebase.initializeApp(firebaseConfig);
        }

        const messaging = firebase.messaging();

        // Register SW
        function registerServiceWorker() {
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/firebase-messaging-sw.js')
                    .then(function(registration) {
                        getToken(registration);
                    })
                    .catch(function(err) {
                        console.error('SW registration failed:', err);
                    });
            }
        }

        // Get Token
        function getToken(registration) {
            messaging.getToken({
                    vapidKey: "{{ \App\CPU\Helpers::get_business_settings('fcm_vapid_key') }}",
                    serviceWorkerRegistration: registration
                })
                .then((currentToken) => {
                    if (currentToken) {
                     
                        saveToken(currentToken);
                    } else {
                        console.warn("No token available");
                    }
                })
                .catch((err) => {
                    console.error("Token Error:", err);
                });
        }

        // Save Token
        function saveToken(token) {
            $.ajax({
                type: "POST",
                url: "{{ route('update-fcm-token') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    token: token
                },
                success: function() {
                    
                }
            });
        }

        // Foreground message
        messaging.onMessage((payload) => {
            console.log("🔥 Foreground:", payload);

            alert("Notification aayi");
        });


        // Permission
        Notification.requestPermission().then(permission => {
           
            if (permission === "granted") {
                registerServiceWorker();
            }
        });
    </script>
    <script>
        function addWishlist(product_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('store-wishlist') }}",
                method: 'POST',
                data: {
                    product_id: product_id
                },
                success: function(data) {
                    if (data.value == 1) {
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('.countWishlist').html(data.count);
                        $('.countWishlist-' + product_id).text(data.product_count);
                        $('.tooltip').html('');

                    } else if (data.value == 2) {
                        Swal.fire({
                            type: 'info',
                            title: 'WishList',
                            text: data.error
                        });
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'WishList',
                            text: data.error
                        });
                    }
                }
            });
        }

        function removeWishlist(product_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('delete-wishlist') }}",
                method: 'POST',
                data: {
                    id: product_id
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    Swal.fire({
                        type: 'success',
                        title: 'WishList',
                        text: data.success
                    });
                    $('.countWishlist').html(data.count);
                    $('#set-wish-list').html(data.wishlist);
                    $('.tooltip').html('');
                },
                complete: function() {
                    $('#loading').hide();
                },
            });
        }

        function quickView(product_id) {
            $.get({
                url: '{{ route('quick-view') }}',
                dataType: 'json',
                data: {
                    product_id: product_id
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    console.log("success...")
                    $('#quick-view').modal('show');
                    $('#quick-view-modal').empty().html(data.view);
                },
                complete: function() {
                    $('#loading').hide();
                },
            });
        }

        function addToCart(form_id = 'add-to-cart-form', redirect_to_checkout = false) {
            var $form = $('#' + form_id);
            var maxQty = parseInt($form.find('.cart-qty-field').attr('max')) || 0;
            var currentQty = parseInt($form.find('input[name=quantity]').val()) || 0;

            if (maxQty <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Out of Stock',
                    text: '{{ \App\CPU\translate("This variant is currently out of stock") }}'
                });
                return false;
            }

            if (checkAddToCartValidity()) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.post({
                    url: '{{ route('cart.add') }}',
                    data: $('#' + form_id).serializeArray(),
                    beforeSend: function() {
                        $('#loading').show();
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status == 1) {
                            updateNavCart();
                            toastr.success(response.message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                            $('.call-when-done').click();
                            if (redirect_to_checkout) {
                                location.href = "{{ route('checkout-details') }}";
                            }
                            return false;
                        } else if (response.status == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Cart',
                                text: response.message
                            });
                            return false;
                        }
                    },
                    complete: function() {
                        $('#loading').hide();

                    }
                });
            } else {
                Swal.fire({
                    type: 'info',
                    title: 'Cart',
                    text: '{{ \App\CPU\translate('please_choose_all_the_options') }}'
                });
            }
        }

        function buy_now() {
            addToCart('add-to-cart-form', true);
            /* location.href = "{{ route('checkout-details') }}"; */
        }

        // Phase 4: Language Search Functionality
        $(document).ready(function() {
            $('#langSearchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#langList .lang-item').filter(function() {
                    $(this).toggle($(this).data('name').indexOf(value) > -1);
                });
            });
            // Keep dropdown open when clicking inside
            $('.__language-bar .dropdown-menu').on('click', function(e) {
                e.stopPropagation();
            });
        });

        function removeFromCart(key) {
            $.post('{{ route('cart.remove') }}', {
                _token: '{{ csrf_token() }}',
                key: key
            }, function(response) {
                $('#cod-for-cart').hide();
                updateNavCart();
                $('#cart-summary').empty().html(response.data);
                toastr.info('{{ \App\CPU\translate('Item has been removed from cart') }}', {
                    CloseButton: true,
                    ProgressBar: true
                });
                let segment_array = window.location.pathname.split('/');
                let segment = segment_array[segment_array.length - 1];
                if (segment === 'checkout-payment' || segment === 'checkout-details') {
                    location.reload();
                }
            });
        }

        function updateNavCart() {
            $.post('{{ route('cart.nav-cart') }}', {
                _token: '{{ csrf_token() }}'
            }, function(response) {
                $('#cart_items').html(response.data);
            });
        }

        function cartQuantityInitialize() {
            $('.btn-number').click(function(e) {
                e.preventDefault();

                fieldName = $(this).attr('data-field');
                type = $(this).attr('data-type');
                productType = $(this).attr('product-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());

                if (!isNaN(currentVal)) {
                    console.log(productType)
                    if (type == 'minus') {

                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }

                    } else if (type == 'plus') {

                        if (currentVal < input.attr('max') || (productType === 'digital')) {
                            input.val(currentVal + 1).change();
                        }

                        if ((parseInt(input.val()) == input.attr('max')) && (productType === 'physical')) {
                            $(this).attr('disabled', true);
                        }

                    }
                } else {
                    input.val(0);
                }
            });

            $('.input-number').focusin(function() {
                $(this).data('oldValue', $(this).val());
            });

            $('.input-number').change(function() {
                productType = $(this).attr('product-type');
                minValue = parseInt($(this).attr('min'));
                maxValue = parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());

                var name = $(this).attr('name');
                if (valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Cart',
                        text: '{{ \App\CPU\translate('Sorry, the minimum order quantity does not match') }}'
                    });
                    $(this).val($(this).data('oldValue'));
                }
                if (productType === 'digital' || valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Cart',
                        text: '{{ \App\CPU\translate('Sorry, stock limit exceeded') }}.'
                    });
                    $(this).val($(this).data('oldValue'));
                }


            });
            $(".input-number").keydown(function(e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        }

        function updateQuantity(key, element) {
            $.post('<?php echo e(route('cart.updateQuantity')); ?>', {
                _token: '<?php echo e(csrf_token()); ?>',
                key: key,
                quantity: element.value
            }, function(data) {
                updateNavCart();
                $('#cart-summary').empty().html(data);
            });
        }

        function updateCartQuantity(minimum_order_qty, key) {
            /* var quantity = $("#cartQuantity" + key).children("option:selected").val(); */
            var quantity = $("#cartQuantity" + key).val();
            if (minimum_order_qty > quantity) {
                toastr.error('{{ \App\CPU\translate('minimum_order_quantity_cannot_be_less_than_') }}' +
                    minimum_order_qty);
                $("#cartQuantity" + key).val(minimum_order_qty);
                return false;
            }

            $.post('{{ route('cart.updateQuantity') }}', {
                _token: '{{ csrf_token() }}',
                key: key,
                quantity: quantity
            }, function(response) {
                if (response.status == 0) {
                    toastr.error(response.message, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    $("#cartQuantity" + key).val(response['qty']);
                } else {
                    updateNavCart();
                    $('#cart-summary').empty().html(response);
                }
            });
        }

        $('#add-to-cart-form input').on('change', function() {
            getVariantPrice();
        });

        function getVariantPrice() {
            var $form = $('#add-to-cart-form');
            if ($form.find('input[name=quantity]').val() > 0 && checkAddToCartValidity()) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '{{ route('cart.variant_price') }}',
                    data: $form.serializeArray(),
                    success: function(data) {
                        $form.find('#chosen_price_div').removeClass('d-none');
                        $form.find('#chosen_price_div #chosen_price').html(data.price);
                        $form.find('#set-tax-amount').html(data.tax);
                        $form.find('#set-discount-amount').html(data.discount);
                        $form.find('#available-quantity').html(data.quantity);
                        $form.find('.cart-qty-field').attr('max', data.quantity);

                        // Out of stock handling
                        if (data.quantity <= 0) {
                            $form.find('#variant-out-of-stock, #qv-variant-out-of-stock').removeClass('d-none');
                            $form.find('.cart-qty-field').val(0).attr('max', 0);
                            $form.find('.btn-buy-now, .btn-add-to-cart').addClass('d-none');
                            $form.find('.btn-oos').removeClass('d-none');
                        } else {
                            $form.find('#variant-out-of-stock, #qv-variant-out-of-stock').addClass('d-none');
                            $form.find('.btn-buy-now, .btn-add-to-cart').removeClass('d-none');
                            $form.find('.btn-oos').addClass('d-none');
                        }
                    }
                });
            }
        }

        function checkAddToCartValidity() {
            var names = {};
            $('#add-to-cart-form input:radio').each(function() { // find unique names
                names[$(this).attr('name')] = true;
            });
            var count = 0;
            $.each(names, function() { // then count them
                count++;
            });
            if ($('input:radio:checked').length == count) {
                return true;
            }
            return false;
        }

        @if (Request::is('/') && \Illuminate\Support\Facades\Cookie::has('popup_banner') == false)
            $(document).ready(function() {
                $('#popup-modal').appendTo("body").modal('show');
            });
            @php(\Illuminate\Support\Facades\Cookie::queue('popup_banner', 'off', 1))
        @endif

        $(".clickable").click(function() {
            let link = $(this).find("a").attr("href");
            if (!link) {
                link = $(this).closest('.product-single-hover').find("a[href*='product/']").attr("href");
            }
            if (!link) {
                link = $(this).siblings().find("a").attr("href");
            }
            if (link) {
                window.location = link;
            }
            return false;
        });
    </script>

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', Error, {
                    CloseButton: true,
                    ProgressBar: true
                });
            @endforeach
        </script>
    @endif

    <script>
        function couponCode() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{ route('coupon.apply') }}',
                data: $('#coupon-code-ajax').serializeArray(),
                success: function(data) {
                    /* console.log(data);
                    return false; */
                    if (data.status == 1) {
                        let ms = data.messages;
                        ms.forEach(
                            function(m, index) {
                                toastr.success(m, index, {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            }
                        );
                    } else {
                        let ms = data.messages;
                        ms.forEach(
                            function(m, index) {
                                toastr.error(m, index, {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            }
                        );
                    }
                    setInterval(function() {
                        location.reload();
                    }, 2000);
                }
            });
        }

        jQuery(document).mouseup(function(e) {
            var container = jQuery(".search-card");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.hide();
            }
        });

    

        document.querySelectorAll('img').forEach(function(img) {
            img.addEventListener('error', function(event) {
                event.target.src = '{{ asset('assets/front-end/img/image-place-holder.png') }}';
                event.onerror = null;
            });
        });

        function route_alert(route, message) {
            Swal.fire({
                title: '{{ \App\CPU\translate('Are you sure') }}?',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '{{ $web_config['primary_color'] }}',
                cancelButtonText: '{{ \App\CPU\translate('No') }}',
                confirmButtonText: '{{ \App\CPU\translate('Yes') }}',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href = route;
                }
            })
        }
    </script>
    <script>
        $('.filter-show-btn').on('click', function() {
            $('#shop-sidebar').toggleClass('show')
        })
    </script>

    <script>
        @php($cookie = $web_config['cookie_setting'] ? json_decode($web_config['cookie_setting']['value'], true) : null)
        let cookie_content = `
        <div class="cookie-section">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-between column-gap-4 row-gap-3">
                    <div class="text-wrapper">
                        <h5 class="title">{{ \App\CPU\translate('Your_Privacy_Matter') }}</h5>
                        <div>{{ $cookie ? $cookie['cookie_text'] : '' }}</div>
                    </div>
                    <div class="btn-wrapper">
                        <span class="text-white cursor-pointer" id="cookie-reject">{{ \App\CPU\translate('no') }}, {{ \App\CPU\translate('thanks') }}</span>
                        <button class="btn btn-success cookie-accept" id="cookie-accept">{{ \App\CPU\translate('yes') }}, {{ \App\CPU\translate('i_Accept') }}</button>
                    </div>
                </div>
            </div>
        </div>
    `;
        $(document).on('click', '#cookie-accept', function() {
            document.cookie = '6valley_cookie_consent=accepted; max-age=' + 60 * 60 * 24 * 30;
            $('#cookie-section').hide();
        });
        $(document).on('click', '#cookie-reject', function() {
            document.cookie = '6valley_cookie_consent=reject; max-age=' + 60 * 60 * 24;
            $('#cookie-section').hide();
        });

        $(document).ready(function() {
            if (document.cookie.indexOf("6valley_cookie_consent=accepted") !== -1) {
                $('#cookie-section').hide();
            } else {
                $('#cookie-section').html(cookie_content).show();
            }
        });
    </script>
    @stack('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var links = document.querySelectorAll('a');

            var urlParams = new URLSearchParams(window.location.search);

            if (urlParams.toString() === '') {

                return;

            }

            for (var i = 0; i < links.length; i++) {

                var link = links[i];

                var linkUrl = link.href;

                var hashIndex = linkUrl.indexOf('#');

                var urlWithoutHash = linkUrl;

                var urlHash = '';

                if (hashIndex !== -1) {

                    urlWithoutHash = linkUrl.substring(0, hashIndex);

                    urlHash = linkUrl.substring(hashIndex);

                }

                var existingParams = new URLSearchParams(urlWithoutHash.split('?')[1]);

                urlParams.forEach(function(value, key) {

                    if (!existingParams.has(key)) {

                        existingParams.append(key, value);

                    }

                });

                link.href = urlWithoutHash.split('?')[0] + '?' + existingParams.toString() + urlHash;

            }

        });
    </script>

    <!--Mgid Sensor -->
    <script type="text/javascript">
        (function() {
            var d = document,
                w = window;
            w.MgSensorData = w.MgSensorData || [];
            w.MgSensorData.push({
                cid: 841036,
                lng: "us",
                project: "a.mgid.com"
            });
            var l = "a.mgid.com";
            var n = d.getElementsByTagName("script")[0];
            var s = d.createElement("script");
            s.type = "text/javascript";
            s.async = true;
            var dt = !Date.now ? new Date().valueOf() : Date.now();
            s.src = "https://" + l + "/mgsensor.js?d=" + dt;
            n.parentNode.insertBefore(s, n);
        })();
    </script>
    <!-- /Mgid Sensor -->
</body>

</html>

