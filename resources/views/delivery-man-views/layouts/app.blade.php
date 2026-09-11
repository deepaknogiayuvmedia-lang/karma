<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ Session::get('direction') }}"
    style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Delivery Man Panel')</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/vendor.min.css">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/custom.css">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/vendor/icon-set/style.css">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/theme.minc619.css?v=1.0">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/style.css">
    @if (Session::get('direction') === 'rtl')
        <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/menurtl.css">
    @endif
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/toastr.css">
    @stack('css_or_js')
    <style>
        .back-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9999;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #073b74 0%, #073b74 100%);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
        }
        .back-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
            color: #fff;
            text-decoration: none;
        }
        .back-btn:active {
            transform: translateY(-1px);
        }
    </style>
    <script src="{{asset('assets/back-end')}}/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js"></script>
</head>

<body class="footer-offset">
    <!-- Builder -->
    @include('layouts.back-end.partials._front-settings')
    <!-- End Builder -->

    {{-- loader --}}
    <div class="row">
        <div class="col-12 position-fixed z-9999 mt-10rem">
            <div id="loading" style="display: none;">
                <center>
                    <img width="200"
                        src="{{asset(config('app.public_storage_path').'/company')}}/{{\App\CPU\Helpers::get_business_settings('loader_gif')}}"
                        onerror="this.src='{{asset('assets/front-end/img/loader.gif')}}'">
                </center>
            </div>
        </div>
    </div>
    {{-- loader --}}

    @include('delivery-man-views.partials._header')
    @include('delivery-man-views.partials._side-bar')

    <main id="content" role="main" class="main pointer-event">
        <!-- Back Button -->
        <a href="javascript:history.back()" class="back-btn" title="Go Back">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        </a>
        <!-- End Back Button -->

        <!-- Content -->
        <div class="content container-fluid">
            @yield('content')
        </div>
        <!-- End Content -->

        <!-- Footer -->
        @include('delivery-man-views.partials._footer')
        <!-- End Footer -->
    </main>

    <script src="{{asset('assets/back-end')}}/js/custom.js"></script>
    <!-- JS Implementing Plugins -->
    <script src="{{asset('assets/back-end')}}/js/vendor.min.js"></script>
    <!-- JS Front -->
    <script src="{{asset('assets/back-end')}}/js/theme.min.js"></script>
    <script src="{{asset('assets/back-end')}}/js/sweet_alert.js"></script>
    <script src="{{asset('assets/back-end')}}/js/toastr.js"></script>
    {!! Toastr::message() !!}

    @stack('script')

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error('{{$error}}', 'Error', {
                    CloseButton: true,
                    ProgressBar: true
                });
            @endforeach
        </script>
    @endif

    <!-- JS Plugins Init. -->
    <script>
        $(document).on('ready', function() {
            // BUILDER TOGGLE INVOKER
            $('.js-navbar-vertical-aside-toggle-invoker').click(function() {
                $('.js-navbar-vertical-aside-toggle-invoker i').tooltip('hide');
            });

            // INITIALIZATION OF NAVBAR VERTICAL NAVIGATION
            var sidebar = $('.js-navbar-vertical-aside').hsSideNav();

            // INITIALIZATION OF TOOLTIP IN NAVBAR VERTICAL MENU
            $('.js-nav-tooltip-link').tooltip({
                boundary: 'window'
            })

            $(".js-nav-tooltip-link").on("show.bs.tooltip", function(e) {
                if (!$("body").hasClass("navbar-vertical-aside-mini-mode")) {
                    return false;
                }
            });

            // INITIALIZATION OF UNFOLD
            $('.js-hs-unfold-invoker').each(function() {
                var unfold = new HSUnfold($(this)).init();
            });

            // INITIALIZATION OF FORM SEARCH
            $('.js-form-search').each(function() {
                new HSFormSearch($(this)).init()
            });

            // INITIALIZATION OF SELECT2
            $('.js-select2-custom').each(function() {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>

    @stack('script_2')

    <script src="{{asset('assets/back-end')}}/js/bootstrap.min.js"></script>
    <script>
        function form_alert(id, message) {
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $('#' + id).submit()
                }
            })
        }
    </script>
    <!-- IE Support -->
    <script>
        if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write(
            '<script src="{{asset('assets/back-end')}}/vendor/babel-polyfill/polyfill.min.js"><\/script>');
    </script>
</body>

</html>
