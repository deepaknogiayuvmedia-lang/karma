<div id="sidebarMain" class="d-none">
    <aside style="text-align: {{Session::get('direction') === 'rtl' ? 'right' : 'left'}};"
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered">
        <div class="navbar-vertical-container">
            <div class="navbar-vertical-footer-offset pb-0">
                <div class="navbar-brand-wrapper justify-content-between side-logo">
                    <!-- Logo -->
                    @php($e_commerce_logo=\App\Model\BusinessSetting::where(['type'=>'company_web_logo'])->first()->value)
                    <a class="navbar-brand" href="{{route('delivery-man.dashboard')}}" aria-label="Front">
                        <img onerror="this.src='{{asset('assets/back-end/img/900x400/img1.jpg')}}'"
                            class="navbar-brand-logo-mini for-web-logo max-h-30"
                            src="{{asset(config('app.public_storage_path').'/company/'.$e_commerce_logo)}}" alt="Logo">
                    </a>
                    <!-- End Logo -->

                    <!-- Navbar Vertical Toggle -->
                    <button type="button" class="d-none js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->

                    <button type="button" class="js-navbar-vertical-aside-toggle-invoker close mr-3">
                        <i class="tio-first-page navbar-vertical-aside-toggle-short-align" data-toggle="tooltip" data-placement="right" title="" data-original-title="Collapse"></i>
                        <i class="tio-last-page navbar-vertical-aside-toggle-full-align" data-template="<div class=&quot;tooltip d-none d-sm-block&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><div class=&quot;tooltip-inner&quot;></div></div>" data-toggle="tooltip" data-placement="right" title="" data-original-title="Expand"></i>
                    </button>
                </div>

                <!-- Content -->
                <div class="navbar-vertical-content">
                    <!-- Search Form -->
                    <div class="sidebar--search-form pb-3 pt-4">
                        <div class="search--form-group">
                            <button type="button" class="btn"><i class="tio-search"></i></button>
                            <input type="text" class="js-form-search form-control form--control" id="search-bar-input"
                                placeholder="{{\App\CPU\translate('search_menu')}}...">
                        </div>
                    </div>
                    <!-- End Search Form -->

                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        <!-- Dashboard -->
                        <li class="navbar-vertical-aside-has-menu {{request()->routeIs('delivery-man.dashboard') ? 'show' : ''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{route('delivery-man.dashboard')}}">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{\App\CPU\translate('Dashboard')}}
                                </span>
                            </a>
                        </li>
                        <!-- End Dashboard -->

                        <!-- Orders Section -->
                        <li class="nav-item">
                            <small class="nav-subtitle">{{\App\CPU\translate('order_management')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <li class="navbar-vertical-aside-has-menu {{request()->routeIs('delivery-man.orders*') ? 'active' : ''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <i class="tio-shopping-cart nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{\App\CPU\translate('My Orders')}}
                                </span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{request()->routeIs('delivery-man.orders*') ? 'block' : 'none'}}">
                                <li class="nav-item {{!request('status') ? 'active' : ''}}">
                                    <a class="nav-link" href="{{route('delivery-man.orders')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\CPU\translate('All')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{request('status') == 'pending' ? 'active' : ''}}">
                                    <a class="nav-link" href="{{route('delivery-man.orders', ['status' => 'pending'])}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\CPU\translate('Pending')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{request('status') == 'confirmed' ? 'active' : ''}}">
                                    <a class="nav-link" href="{{route('delivery-man.orders', ['status' => 'confirmed'])}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\CPU\translate('Confirmed')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{request('status') == 'processing' ? 'active' : ''}}">
                                    <a class="nav-link" href="{{route('delivery-man.orders', ['status' => 'processing'])}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\CPU\translate('Processing')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{request('status') == 'out_for_delivery' ? 'active' : ''}}">
                                    <a class="nav-link" href="{{route('delivery-man.orders', ['status' => 'out_for_delivery'])}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\CPU\translate('Out For Delivery')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{request('status') == 'delivered' ? 'active' : ''}}">
                                    <a class="nav-link" href="{{route('delivery-man.orders', ['status' => 'delivered'])}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\CPU\translate('Delivered')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{request('status') == 'canceled' ? 'active' : ''}}">
                                    <a class="nav-link" href="{{route('delivery-man.orders', ['status' => 'canceled'])}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\CPU\translate('Canceled')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- End Orders Section -->

                        <!-- Earning Section -->
                        <li class="nav-item">
                            <small class="nav-subtitle">{{\App\CPU\translate('finance')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <li class="navbar-vertical-aside-has-menu {{request()->routeIs('delivery-man.earning') ? 'active' : ''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{route('delivery-man.earning')}}">
                                <i class="tio-wallet nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{\App\CPU\translate('My Earning')}}
                                </span>
                            </a>
                        </li>

                        <li class="navbar-vertical-aside-has-menu {{request()->routeIs('delivery-man.withdraw*') ? 'active' : ''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{route('delivery-man.withdraw.form')}}">
                                <i class="tio-money-alt nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    Withdraw Request
                                </span>
                            </a>
                        </li>
                        <!-- End Earning Section -->

                        <!-- Account Section -->
                        <li class="nav-item">
                            <small class="nav-subtitle">{{\App\CPU\translate('account')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <li class="navbar-vertical-aside-has-menu {{request()->routeIs('delivery-man.profile*') ? 'active' : ''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{route('delivery-man.profile')}}">
                                <i class="tio-user-circle nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{\App\CPU\translate('Profile')}}
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </aside>
</div>

@push('script_2')
    <script>
        $(window).on('load', function() {
            if ($(".navbar-vertical-content li.active").length) {
                $('.navbar-vertical-content').animate({
                    scrollTop: $(".navbar-vertical-content li.active").offset().top - 150
                }, 10);
            }
        });
        // Sidebar Menu Search
        var $rows = $('.navbar-vertical-content .navbar-nav > li');
        $('#search-bar-input').keyup(function() {
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function() {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                return !~text.indexOf(val);
            }).hide();
        });
    </script>
@endpush
