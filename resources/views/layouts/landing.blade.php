@stack('title')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
      href="{{ asset('customassets/assets/materialize.min.css') }}"
      type="text/css"
      rel="stylesheet"
      media="screen,projection"
    />
    <link rel="stylesheet" href="{{ asset('customassets/assets/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('customassets/assets/form-style.css') }}" />
    <script
      type="text/javascript"
      src="https://code.jquery.com/jquery-1.12.4.min.js"
    ></script>
    <!-- Styles -->
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NJ6N83BN');</script>
    <!-- End Google Tag Manager -->
    <!-- Mgid Sensor -->
<script type="text/javascript">
    (function() {
        var d = document, w = window;
        w.MgSensorData = w.MgSensorData || [];
        w.MgSensorData.push({
            cid:841036,
            lng:"us",
            project: "a.mgid.com"
        });
        var l = "a.mgid.com";
        var n = d.getElementsByTagName("script")[0];
        var s = d.createElement("script");
        s.type = "text/javascript";
        s.async = true;
        var dt = !Date.now?new Date().valueOf():Date.now();
        s.src = "https://" + l + "/mgsensor.js?d=" + dt;
        n.parentNode.insertBefore(s, n);
    })();
</script>
<!-- /Mgid Sensor -->
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NJ6N83BN"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('customassets/assets/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('customassets/assets/scrollmenu.js') }}"></script>
    <script src="{{ asset('customassets/assets/scripts.js') }}"></script>
</body>
</html>

