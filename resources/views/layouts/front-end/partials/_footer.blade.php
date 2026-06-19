<!-- Footer -->
<style>
    .social-media :hover {
        color: {{ $web_config['secondary_color'] }} !important;
    }

    .start_address_under_line {
        {{ Session::get('direction') === 'rtl' ? 'width: 344px;' : 'width: 331px;' }}
    }

    @media (max-width: 500px) {
        .mobblock {
            display: none !important;
        }
    }

    @media (max-width: 1200px) {
        .__inline-9 .end-footer {
            justify-content: center;
        }
    }
</style>
<div class="__inline-9 rtl">

    @php
        $mobileNavItems = [
            ['route' => 'home', 'icon' => 'czi-home', 'label' => 'Home'],
            ['route' => 'categories', 'icon' => 'czi-filter', 'label' => 'Shop'],
            ['route' => 'brands', 'icon' => 'czi-bookmark', 'label' => 'Brands'],
            ['route' => 'shop-cart', 'icon' => 'czi-cart', 'label' => 'Cart'],
            ['route' => 'user-account', 'icon' => 'czi-user', 'label' => 'Account'],
        ];
    @endphp

    <style>
        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 99;
            background: {{ $web_config['primary_color'] }};
            /* box-shadow: 0 -2px 8px rgba(0,0,0,0.12); */
            padding: 4px 0;
        }

        .mobile-bottom-nav .nav-item {
            flex: 1;
            text-align: center;
            padding: 2px 0;
        }

        .mobile-bottom-nav .nav-item a {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.7);
            transition: color 0.2s;
            padding: 4px 0;
            border-radius: 8px;
        }

        .mobile-bottom-nav .nav-item a.active {
            color: #fff;
        }

        .mobile-bottom-nav .nav-item a.active .nav-icon {
            transform: scale(1.1);
        }

        .mobile-bottom-nav .nav-item a .nav-icon {
            font-size: 22px;
            transition: transform 0.2s;
        }

        .mobile-bottom-nav .nav-item a .nav-label {
            font-size: 10px;
            line-height: 1.2;
            margin-top: 1px;
            white-space: nowrap;
        }
    </style>

    <div class="d-md-none mobile-bottom-nav">
        <div class="d-flex">
            @foreach ($mobileNavItems as $item)
                @php
                    $isActive = Request::is($item['route'] == 'home' ? '/' : $item['route'] . '*');
                @endphp
                <div class="nav-item">
                    <a href="{{ route($item['route']) }}" class="{{ $isActive ? 'active' : '' }}">
                        <i class="navbar-tool-icon {{ $item['icon'] }} nav-icon"></i>
                        <span class="nav-label">{{ $item['label'] }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <!-- mobile app footer end -->
    <!-- Grid row -->
    <div style="background: #00695c;">
        <div class="container py-3">
            <div class="d-flex flex-wrap end-footer footer-end last-footer-content-align ">
                <div class="">
                    <a class="d-block" href="{{ route('home') }}">
                        <img class="{{ Session::get('direction') === 'rtl' ? 'rightalign' : '' }}"
                            src="{{ asset(env('PUBLIC_STORAGE_PATH') . '/company/') }}/{{ $web_config['footer_logo']->value }}"
                            onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                            alt="{{ $web_config['name']->value }}" style="max-width:150px;" />
                    </a>
                </div>

                <div class="d-flex __text-14px mb-2 mt-2 mobblock">
                    <div class="{{ Session::get('direction') === 'rtl' ? 'ml-3' : 'mr-3' }}">
                        <a class="widget-list-link text-white"
                            href="{{ route('about-us') }}">{{ \App\CPU\translate('About Company') }}</a>
                    </div>
                    <div class="{{ Session::get('direction') === 'rtl' ? 'ml-3' : 'mr-3' }}">
                        <a class="widget-list-link text-white"
                            href="{{ route('terms') }}">{{ \App\CPU\translate('terms_&_conditions') }}</a>
                    </div>

                    <div class="{{ Session::get('direction') === 'rtl' ? 'ml-3' : 'mr-3' }}">
                        <a class="widget-list-link text-white"
                            href="{{ route('refund-policy') }}">{{ \App\CPU\translate('refund_policy') }}</a>
                    </div>


                    <div class="{{ Session::get('direction') === 'rtl' ? 'ml-3' : 'mr-3' }}">
                        <a class="widget-list-link text-white"
                            href="{{ route('return-policy') }}">{{ \App\CPU\translate('return_policy') }}</a>
                    </div>

                    <div class="{{ Session::get('direction') === 'rtl' ? 'ml-3' : 'mr-3' }}">
                        <a class="widget-list-link text-white"
                            href="{{ route('cancellation-policy') }}">{{ \App\CPU\translate('cancellation_policy') }}</a>
                    </div>






                    <div>
                        <a class="widget-list-link text-white" href="{{ route('privacy-policy') }}">
                            {{ \App\CPU\translate('privacy_policy') }}
                        </a>
                    </div>
                </div>

                <div
                    class="mt-2 max-sm-100 justify-content-center d-flex flex-wrap mt-md-3 mt-0 mb-md-3 {{ Session::get('direction') === 'rtl' ? 'text-right' : 'text-left' }}">
                    @php($social_media = \App\Model\SocialMedia::where('active_status', 1)->get())
                    @if (isset($social_media))
                        @foreach ($social_media as $item)
                            <span class="social-media ">
                                <a class="social-btn text-white sb-light sb-{{ $item->name }} {{ Session::get('direction') === 'rtl' ? 'ml-2' : 'mr-2' }} mb-2"
                                    target="_blank" href="{{ $item->link }}">
                                    <i class="{{ $item->icon }}" aria-hidden="true"></i>
                                </a>
                            </span>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
    </div>
    <!-- Grid row -->



    <!-- Footer Links -->
    <div class="pt-4" style="background: #fff;">
        <div class="container text-center __pb-13px">

            <!-- Footer links -->
            <div
                class="row justify-content-between {{ Session::get('direction') === 'rtl' ? 'text-md-right' : 'text-md-left' }} mt-3 pb-3 ">
                <!-- Grid column -->
                <div class="col-md-4 footer-web-logo">
                    <h6 class="text-uppercase mb-4 font-weight-bold footer-heder">Contact Info</h6>

                    <div class=" mb-2">
                        <span class="__text-14px"><i class="fa fa-map-marker m-2"></i>
                            {{ \App\CPU\Helpers::get_business_settings('shop_address') }} </span>
                    </div>
                    <div class="mb-2">
                        <a class="widget-list-link" href="tel: {{ $web_config['phone']->value }}">
                            <span><i
                                    class="fa fa-phone m-2"></i>{{ \App\CPU\Helpers::get_business_settings('company_phone') }}
                            </span>
                        </a>

                    </div>
                    <div class="mb-2">
                        <a class="widget-list-link"
                            href="mailto: {{ \App\CPU\Helpers::get_business_settings('company_email') }}">
                            <span><i class="fa fa-envelope m-2"></i>
                                {{ \App\CPU\Helpers::get_business_settings('company_email') }} </span>
                        </a>
                    </div>
                </div>


                <div class="col-md-2 footer-padding-bottom">
                    <h6 class="text-uppercase mb-4 font-weight-bold footer-heder">Products</h6>
                    <ul class="widget-list __pb-10px">
                        @php(
    $flash_deals = \App\Model\FlashDeal::where(['status' => 1, 'deal_type' => 'flash_deal'])->whereDate('start_date', '<=', date('Y-m-d'))->whereDate('end_date', '>=', date('Y-m-d'))->first()
)
                        @if (isset($flash_deals))
                            <li class="widget-list-item">
                                <a class="widget-list-link" href="{{ route('flash-deals', [$flash_deals['id']]) }}">
                                    {{ \App\CPU\translate('flash_deal') }}
                                </a>
                            </li>
                        @endif
                        <li class="widget-list-item"><a class="widget-list-link"
                                href="{{ route('products', ['data_from' => 'featured', 'page' => 1]) }}">{{ \App\CPU\translate('featured_products') }}</a>
                        </li>
                        <li class="widget-list-item"><a class="widget-list-link"
                                href="{{ route('products', ['data_from' => 'latest', 'page' => 1]) }}">{{ \App\CPU\translate('latest_products') }}</a>
                        </li>
                        <li class="widget-list-item"><a class="widget-list-link"
                                href="{{ route('products', ['data_from' => 'best-selling', 'page' => 1]) }}">{{ \App\CPU\translate('best_selling_product') }}</a>
                        </li>
                        <li class="widget-list-item"><a class="widget-list-link"
                                href="{{ route('products', ['data_from' => 'top-rated', 'page' => 1]) }}">{{ \App\CPU\translate('top_rated_product') }}</a>
                        </li>

                    </ul>
                </div>

                <div class="col-md-2 footer-padding-bottom"
                    style="{{ Session::get('direction') === 'rtl' ? 'padding-right:20px;' : '' }}">
                    <h6 class="text-uppercase mb-4 font-weight-bold footer-heder">Services</h6>
                    @php($refund_policy = \App\CPU\Helpers::get_business_settings('refund-policy'))
                    @php($return_policy = \App\CPU\Helpers::get_business_settings('return-policy'))
                    @php($cancellation_policy = \App\CPU\Helpers::get_business_settings('cancellation-policy'))
                    @if (auth('customer')->check())
                        <ul class="widget-list __pb-10px">
                            <li class="widget-list-item">
                                <a class="widget-list-link"
                                    href="{{ route('user-account') }}">{{ \App\CPU\translate('profile_info') }}</a>
                            </li>

                            <li class="widget-list-item">
                                <a class="widget-list-link"
                                    href="{{ route('track-order.index') }}">{{ \App\CPU\translate('track_order') }}</a>
                            </li>

                            @if (isset($refund_policy['status']) && $refund_policy['status'] == 1)
                                <li class="widget-list-item">
                                    <a class="widget-list-link"
                                        href="{{ route('refund-policy') }}">{{ \App\CPU\translate('refund_policy') }}</a>
                                </li>
                            @endif

                            <li class="widget-list-item">
                                <a class="widget-list-link"
                                    href="{{ route('account-tickets') }}">{{ \App\CPU\translate('Support Ticket') }}</a>
                            </li>

                        </ul>
                    @else
                        <ul class="widget-list __pb-10px">
                            <li class="widget-list-item">
                                <a class="widget-list-link"
                                    href="{{ route('customer.auth.login') }}">{{ \App\CPU\translate('profile_info') }}</a>
                            </li>
                            <li class="widget-list-item">
                                <a class="widget-list-link"
                                    href="{{ route('customer.auth.login') }}">{{ \App\CPU\translate('wish_list') }}</a>
                            </li>

                            <li class="widget-list-item">
                                <a class="widget-list-link"
                                    href="{{ route('track-order.index') }}">{{ \App\CPU\translate('track_order') }}</a>
                            </li>
                            <li class="widget-list-item">
                                <a class="widget-list-link"
                                    href="{{ route('customer.auth.login') }}">{{ \App\CPU\translate('Support Ticket') }}</a>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <!-- Footer links -->


        <!-- Grid row -->
        <div style="background: #fff;">
            <div class="container border border-left-0 border-right-0">

                <div class="d-flex flex-wrap end-footer footer-end last-footer-content-align">
                    <div
                        class="max-sm-100 justify-content-center d-flex flex-wrap mt-md-3 mt-0 mb-md-3 {{ Session::get('direction') === 'rtl' ? 'text-right' : 'text-left' }}">
                        <div class="mb-2">
                            <h6 class="text-uppercase mb-1 font-weight-bold footer-heder">
                                {{ \App\CPU\translate('NEWS LETTER') }}</h6>
                            <span>{{ \App\CPU\translate('subscribe to our new channel to get latest updates') }}</span>
                        </div>
                    </div>

                    <div class="col-md-6 footer-padding-bottom mb-md-3 mt-md-3">

                        <div class="text-nowrap position-relative">
                            <form action="{{ route('subscription') }}" method="post">
                                @csrf
                                <input type="email" name="subscription_email" class="form-control subscribe-border"
                                    placeholder="{{ \App\CPU\translate('Your Email Address') }}" required
                                    style="padding: 11px;text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                <button class="subscribe-button" type="submit">
                                    {{ \App\CPU\translate('subscribe') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Grid row -->
        </div>
        <!-- Footer Links -->

        <!-- Grid row -->
        <div style="background: #fff;">
            <div class="container">

                <div class="d-flex flex-wrap end-footer footer-end last-footer-content-align">
                    <div class="mt-3">
                        <p
                            class="{{ Session::get('direction') === 'rtl' ? 'text-right ' : 'text-left' }} __text-16px">
                            {{ $web_config['copyright_text']->value }}</p>
                    </div>
                    <div class="">
                        <a class="d-block" href="{{ route('home') }}">
                            <img class="{{ Session::get('direction') === 'rtl' ? 'rightalign' : '' }}"
                                src="{{ asset('public/assets/front-end/img/payment.png') }}"
                                onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                alt="{{ $web_config['name']->value }}" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Grid row -->


        <!-- Footer Links -->

        <!-- Cookie Settings -->
        @php($cookie = $web_config['cookie_setting'] ? json_decode($web_config['cookie_setting']['value'], true) : null)
        @if ($cookie && $cookie['status'] == 1)
            <section id="cookie-section"></section>
        @endif
        </footer>
    </div>
