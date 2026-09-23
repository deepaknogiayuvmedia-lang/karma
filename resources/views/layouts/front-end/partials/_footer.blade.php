<!-- Footer (BigHaat Specification) -->
<footer class="bh-footer rtl">
    <!-- Top Green Bar with Brand Logo & Social Links -->
    <div class="bh-footer-topbar">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-3 col-6  text-md-left mb-2 mb-md-0">
                    <a class="d-inline-block" href="{{ route('home') }}">
                        <img src="{{ asset(config('app.public_storage_path') . '/company/') }}/{{ $web_config['footer_logo']->value }}"
                            onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                            alt="{{ $web_config['name']->value }}" style="max-height: 48px; width: auto;" />
                    </a>
                </div>
             
                <div class="col-md-4 col-6 text-end  text-md-right">
                    @php($social_media = \App\Model\SocialMedia::where('active_status', 1)->get())
                    @if (isset($social_media))
                        <div class="d-inline-flex gap-2">
                            @foreach ($social_media as $item)
                                <a class="btn btn-sm btn-circle text-white mx-1 bh-footer-social-icon"
                                    target="_blank" href="{{ $item->link }}">
                                    <i class="{{ $item->icon }}" aria-hidden="true"></i>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Footer Body (5-Column Desktop Layout) -->
    <div class="bh-footer-body">
        <div class="container">
            <div class="row {{ Session::get('direction') === 'rtl' ? 'text-md-right' : 'text-md-left' }}">
                
                <!-- Column 1: Company Info -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="bh-footer-heading">{{ \App\CPU\translate('COMPANY') }}</h6>
                    <ul class="list-unstyled mb-3 bh-footer-links">
                        <li><a href="{{ route('about-us') }}">{{ \App\CPU\translate('About Us') }}</a></li>
                        <li><a href="{{ route('contacts') }}">{{ \App\CPU\translate('Contact Us') }}</a></li>
                        <li><a href="{{ route('terms') }}">{{ \App\CPU\translate('Terms & Conditions') }}</a></li>
                        <li><a href="{{ route('privacy-policy') }}">{{ \App\CPU\translate('Privacy Policy') }}</a></li>
                    </ul>
                    @if(\App\CPU\Helpers::get_business_settings('company_phone')!=null)
                        <div class="d-flex align-items-center mb-2 bh-footer-contact">
                            <i class="fa fa-phone mr-2 text-success"></i>
                            <a href="tel:{{ $web_config['phone']->value }}" class="bh-footer-contact-link">
                                {{ \App\CPU\Helpers::get_business_settings('company_phone') }}
                            </a>
                        </div>
                    @endif
                    @if(\App\CPU\Helpers::get_business_settings('company_email')!=null)
                        <div class="d-flex align-items-center bh-footer-contact">
                            <i class="fa fa-envelope mr-2 text-success"></i>
                            <a href="mailto:{{ \App\CPU\Helpers::get_business_settings('company_email') }}" class="bh-footer-contact-link">
                                {{ \App\CPU\Helpers::get_business_settings('company_email') }}
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Column 2: Shop Categories -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="bh-footer-heading">{{ \App\CPU\translate('SHOP') }}</h6>
                    <ul class="list-unstyled mb-0 bh-footer-links">
                        <li><a href="{{ route('products', ['data_from' => 'latest', 'page' => 1]) }}">{{ \App\CPU\translate('All Products') }}</a></li>
                        <li><a href="{{ route('products', ['data_from' => 'featured', 'page' => 1]) }}">{{ \App\CPU\translate('Seeds') }}</a></li>
                        <li><a href="{{ route('products', ['data_from' => 'best-selling', 'page' => 1]) }}">{{ \App\CPU\translate('Crop Protection') }}</a></li>
                        <li><a href="{{ route('products', ['data_from' => 'top-rated', 'page' => 1]) }}">{{ \App\CPU\translate('Fertilizers') }}</a></li>
                        <li><a href="{{ route('brands') }}">{{ \App\CPU\translate('Top Brands') }}</a></li>
                    </ul>
                </div>

                <!-- Column 3: Help & Support -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="bh-footer-heading">{{ \App\CPU\translate('HELP') }}</h6>
                    <ul class="list-unstyled mb-0 bh-footer-links">
                        <li><a href="{{ route('track-order.index') }}">{{ \App\CPU\translate('Track Order') }}</a></li>
                        <li><a href="{{ route('shipping-policy') }}">{{ \App\CPU\translate('Shipping Policy') }}</a></li>
                        <li><a href="{{ route('refund-policy') }}">{{ \App\CPU\translate('Refund Policy') }}</a></li>
                        <li><a href="{{ route('return-policy') }}">{{ \App\CPU\translate('Return Policy') }}</a></li>
                        <li><a href="{{ route('cancellation-policy') }}">{{ \App\CPU\translate('Cancellation Policy') }}</a></li>
                    </ul>
                </div>

                <!-- Column 4: Resources -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="bh-footer-heading">{{ \App\CPU\translate('RESOURCES') }}</h6>
                    <ul class="list-unstyled mb-0 bh-footer-links">
                        <li><a href="{{ route('technical-names') }}">{{ \App\CPU\translate('Technical Names') }}</a></li>
                        <li><a href="{{ route('helpTopic') }}">{{ \App\CPU\translate('FAQ') }}</a></li>
                        <li><a href="{{ route('categories') }}">{{ \App\CPU\translate('Crop Guides') }}</a></li>
                        <li><a href="{{ route('home') }}">{{ \App\CPU\translate('Kisan Vedika') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Copyright & Payment Badges Strip -->
    <div class="bh-footer-bottombar">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6 col-12 text-center text-md-left mb-2 mb-md-0">
                    <p class="mb-0 bh-footer-copyright">
                        {{ $web_config['copyright_text']->value }}
                    </p>
                </div>
                <div class="col-md-6 col-12 text-center text-md-right">
                    <span class="bh-footer-secure">
                        <i class="fa fa-lock text-success mr-1"></i> {{ \App\CPU\translate('100% Secure Checkout') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Cookie Settings -->
    @php($cookie = $web_config['cookie_setting'] ? json_decode($web_config['cookie_setting']['value'], true) : null)
    @if ($cookie && $cookie['status'] == 1)
        <section id="cookie-section"></section>
    @endif
</footer>
