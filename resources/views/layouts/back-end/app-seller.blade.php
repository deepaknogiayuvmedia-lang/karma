<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ Session::get('direction') }}"
    style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->

    <title>@yield('title')</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <!--to make http ajax request to https-->
    <!--    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">-->
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset(config('app.public_storage_path').'/company/2026-01-16-696a1a8e76ddb.png') }}">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/back-end') }}/css/vendor.min.css">
    <link rel="stylesheet" href="{{ asset('assets/back-end') }}/css/custom.css">


    <link rel="stylesheet" href="{{ asset('assets/back-end') }}/vendor/icon-set/style.css">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{ asset('assets/back-end') }}/css/theme.minc619.css?v=1.0">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/style.css">
    @if (Session::get('direction') === 'rtl')
        <link rel="stylesheet" href="{{ asset('assets/back-end') }}/css/menurtl.css">
    @endif
    {{-- light box --}}
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}">
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
    <!-- <style>
        :root {
            --theameColor: #045cff;
        }

        .rtl {
            direction: {{ Session::get('direction') }};
        }
    </style> -->
    <script
        src="{{ asset('assets/back-end') }}/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js">
    </script>
    <link rel="stylesheet" href="{{ asset('assets/back-end') }}/css/toastr.css">
    <!-- Phase: CKEditor 5 Height Fix -->
    <style>
        .ck-editor__editable {
            min-height: 250px !important;
            max-height: 400px !important;
            height: 300px !important;
            overflow: auto !important;
        }
        .ck-editor {
            min-height: 350px !important;
        }
        /* CKEditor 5 Color Picker Fix */
        .ck-color-grid {
            min-width: 280px !important;
        }
        .ck-color-grid__tile {
            width: 24px !important;
            height: 24px !important;
        }
    </style>
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
                        src="{{ asset(config('app.public_storage_path').'/company') }}/{{ \App\CPU\Helpers::get_business_settings('loader_gif') }}"
                        onerror="this.src='{{ asset('assets/front-end/img/loader.gif') }}'">
                </center>
            </div>
        </div>
    </div>
    {{-- loader --}}
    <!-- JS Preview mode only -->
    @include('layouts.back-end.partials-seller._header')
    @include('layouts.back-end.partials-seller._side-bar')

    <!-- END ONLY DEV -->

    <main id="content" role="main" class="main pointer-event">
        <!-- Back Button -->
        <a href="javascript:history.back()" class="back-btn" title="Go Back">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        </a>
        <!-- End Back Button -->
        <!-- Content -->
        @yield('content')
        <!-- End Content -->

        <!-- Footer -->
        @include('layouts.back-end.partials-seller._footer')
        <!-- End Footer -->

        @include('layouts.back-end.partials-seller._modals')

    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    <!-- ========== END SECONDARY CONTENTS ========== -->
    <script src="{{ asset('assets/back-end') }}/js/custom.js"></script>
    <!-- JS Implementing Plugins -->

    <!-- JS Front -->
    <script src="{{ asset('assets/back-end') }}/js/vendor.min.js"></script>
    <script src="{{ asset('assets/back-end') }}/js/theme.min.js"></script>
    <script src="{{ asset('assets/back-end') }}/js/sweet_alert.js"></script>
    <script src="{{ asset('assets/back-end') }}/js/toastr.js"></script>
    {!! Toastr::message() !!}

    @stack('script')

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
    <!-- JS Plugins Init. -->
    <script>
        $(document).on('ready', function() {
            // ONLY DEV
            // =======================================================
            if (window.localStorage.getItem('hs-builder-popover') === null) {
                $('#builderPopover').popover('show')
                    .on('shown.bs.popover', function() {
                        $('.popover').last().addClass('popover-dark')
                    });

                $(document).on('click', '#closeBuilderPopover', function() {
                    window.localStorage.setItem('hs-builder-popover', true);
                    $('#builderPopover').popover('dispose');
                });
            } else {
                $('#builderPopover').on('show.bs.popover', function() {
                    return false
                });
            }
            // END ONLY DEV
            // =======================================================

            // BUILDER TOGGLE INVOKER
            // =======================================================
            $('.js-navbar-vertical-aside-toggle-invoker').click(function() {
                $('.js-navbar-vertical-aside-toggle-invoker i').tooltip('hide');
            });

            // INITIALIZATION OF MEGA MENU
            // =======================================================
            /*var megaMenu = new HSMegaMenu($('.js-mega-menu'), {
                desktop: {
                    position: 'left'
                }
            }).init();*/


            // INITIALIZATION OF NAVBAR VERTICAL NAVIGATION
            // =======================================================
            var sidebar = $('.js-navbar-vertical-aside').hsSideNav();


            // INITIALIZATION OF TOOLTIP IN NAVBAR VERTICAL MENU
            // =======================================================
            $('.js-nav-tooltip-link').tooltip({
                boundary: 'window'
            })

            $(".js-nav-tooltip-link").on("show.bs.tooltip", function(e) {
                if (!$("body").hasClass("navbar-vertical-aside-mini-mode")) {
                    return false;
                }
            });


            // INITIALIZATION OF UNFOLD
            // =======================================================
            $('.js-hs-unfold-invoker').each(function() {
                var unfold = new HSUnfold($(this)).init();
            });


            // INITIALIZATION OF FORM SEARCH
            // =======================================================
            $('.js-form-search').each(function() {
                new HSFormSearch($(this)).init()
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function() {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });


            // INITIALIZATION OF DATERANGEPICKER
            // =======================================================
            $('.js-daterangepicker').daterangepicker();

            $('.js-daterangepicker-times').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });

            var start = moment();
            var end = moment();

            function cb(start, end) {
                $('#js-daterangepicker-predefined .js-daterangepicker-predefined-preview').html(start.format(
                    'MMM D') + ' - ' + end.format('MMM D, YYYY'));
            }

            $('#js-daterangepicker-predefined').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);


            // INITIALIZATION OF CLIPBOARD
            // =======================================================
            $('.js-clipboard').each(function() {
                var clipboard = $.HSCore.components.HSClipboard.init(this);
            });
        });
    </script>

    @stack('script_2')


    <script src="{{ asset('assets/back-end') }}/js/bootstrap.min.js"></script>
    {{-- light box --}}
    <script src="{{ asset('js/lightbox.min.js') }}"></script>
    <audio id="myAudio">
        <source src="{{ asset('assets/back-end/sound/notification.mp3') }}" type="audio/mpeg">
    </audio>
    <script>
        var audio = document.getElementById("myAudio");

        function playAudio() {
            audio.play();
        }

        function pauseAudio() {
            audio.pause();
        }

        $("#reset").on('click', function (){
            let placeholderImg = $("#placeholderImg").data('img');
            console.log(placeholderImg)
            $('#viewer').attr('src', placeholderImg);
            $('.spartan_remove_row').click();
        });
    </script>
    <script>
        setInterval(function() {
            $.get({
                url: '{{ route('seller.get-order-data') }}',
                dataType: 'json',
                success: function(response) {
                    let data = response.data;
                    if (data.new_order > 0) {
                        playAudio();
                        $('#popup-modal').appendTo("body").modal('show');
                    }
                },
            });
        }, 10000);

        function check_order() {
            location.href = '{{ route('seller.orders.list', ['status' => 'all']) }}';
        }
    </script>

    <script>
        $("#search-bar-input").keyup(function() {
            $("#search-card").css("display", "block");
            let key = $("#search-bar-input").val();
            if (key.length > 0) {
                $.get({
                    url: '{{ url('/') }}/admin/search-function/',
                    dataType: 'json',
                    data: {
                        key: key
                    },
                    beforeSend: function() {
                        $('#loading').show();
                    },
                    success: function(data) {
                        $('#search-result-box').empty().html(data.result)
                    },
                    complete: function() {
                        $('#loading').hide();
                    },
                });
            } else {
                $('#search-result-box').empty();
            }
        });

        $(document).mouseup(function(e) {
            var container = $("#search-card");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.hide();
            }
        });

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

    <script>
        function call_demo() {
            toastr.info('Update option is disabled for demo!', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    </script>
    <script>
        function openInfoWeb() {
            var x = document.getElementById("website_info");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
    <!-- IE Support -->
    <script>
        if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write(
            '<script src="{{ asset('assets/back-end') }}/vendor/babel-polyfill/polyfill.min.js"><\/script>');
    </script>
    <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-messaging-compat.js"></script>

    <script>
       
        const firebaseConfig = {
            apiKey: "AIzaSyAB2BkJP_9iQiFVyjLeRftIfs7DJEumWoo",
            authDomain: "multi-vendor-5d507.firebaseapp.com",
            databaseURL: "https://multi-vendor-5d507-default-rtdb.firebaseio.com",
            projectId: "multi-vendor-5d507",
            storageBucket: "multi-vendor-5d507.firebasestorage.app",
            messagingSenderId: "593155222746",
            appId: "1:593155222746:web:107a9a6d16bd534f4309e3",
        };

        // Init
        if (!firebase.apps.length) {
            firebase.initializeApp(firebaseConfig);
        }

        const messaging = firebase.messaging();

        // Register SW
        function registerServiceWorker() {
            if ('serviceWorker' in navigator) {
                // const swPath = '{{ asset('firebase-messaging-sw.js') }}';
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
                    vapidKey: "{{ \App\CPU\Helpers::get_business_settings('push_notification_key') }}",
                    serviceWorkerRegistration: registration
                })
                .then((currentToken) => {
                    if (currentToken) {
                        console.log("SELLER TOKEN:", currentToken);
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
                url: "{{ route('seller.update-fcm-token') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    token: token
                },
                success: function() {
                    console.log('Seller Token saved');
                }
            });
        }

        // Foreground message
        messaging.onMessage((payload) => {
            console.log("🔥 Foreground:", payload);
            toastr.info("New Notification", payload.notification.body);
        });


        // Permission
        @if(auth('seller')->check())
        Notification.requestPermission().then(permission => {
        
            if (permission === "granted") {
                registerServiceWorker();
            }
        });
        @endif
    </script>
</body>

</html>

