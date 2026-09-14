<!-- Footer (BigHaat Specification) -->
<footer class="bh-footer rtl">
    <!-- Top Green Bar with Brand Logo & Social Links -->
    <div style="background-color: var(--bh-dark-green, #0B5D2A); color: #ffffff;" class="py-3">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-3 col-6 text-center text-md-left mb-2 mb-md-0">
                    <a class="d-inline-block" href="{{ route('home') }}">
                        <img src="{{ asset(config('app.public_storage_path') . '/company/') }}/{{ $web_config['footer_logo']->value }}"
                            onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                            alt="{{ $web_config['name']->value }}" style="max-height: 48px; width: auto;" />
                    </a>
                </div>
                <div class="col-md-5 col-12 text-center my-2 my-md-0">
                    <span class="font-weight-bold mr-2 text-white" style="font-size: 0.9rem;">
                        <i class="fa fa-shield mr-1"></i> 100% Genuine Agri Products & Trusted Brand
                    </span>
                </div>
                <div class="col-md-4 col-12 text-center text-md-right">
                    @php($social_media = \App\Model\SocialMedia::where('active_status', 1)->get())
                    @if (isset($social_media))
                        <div class="d-inline-flex gap-2">
                            @foreach ($social_media as $item)
                                <a class="btn btn-sm btn-circle text-white mx-1" style="background: rgba(255,255,255,0.15); width: 34px; height: 34px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;"
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
    <div class="py-5" style="background-color: #ffffff; border-bottom: 1px solid var(--bh-border, #E1E6E2);">
        <div class="container">
            <div class="row {{ Session::get('direction') === 'rtl' ? 'text-md-right' : 'text-md-left' }}">
                
                <!-- Column 1: Company Info -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase font-weight-bold mb-3" style="color: var(--bh-text-primary, #1B1F1D); font-size: 0.9rem; letter-spacing: 0.5px;">
                        {{ \App\CPU\translate('COMPANY') }}
                    </h6>
                    <ul class="list-unstyled mb-3" style="font-size: 0.85rem; line-height: 2;">
                        <li><a href="{{ route('about-us') }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('About Us') }}</a></li>
                        <li><a href="{{ route('contacts') }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('Contact Us') }}</a></li>
                        <li><a href="{{ route('terms') }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('Terms & Conditions') }}</a></li>
                        <li><a href="{{ route('privacy-policy') }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('Privacy Policy') }}</a></li>
                    </ul>
                    @if(\App\CPU\Helpers::get_business_settings('company_phone')!=null)
                        <div class="d-flex align-items-center mb-2" style="font-size: 0.85rem; color: var(--bh-text-secondary, #66706A);">
                            <i class="fa fa-phone mr-2 text-success"></i>
                            <a href="tel:{{ $web_config['phone']->value }}" style="color: var(--bh-text-primary, #1B1F1D); font-weight: 600;">
                                {{ \App\CPU\Helpers::get_business_settings('company_phone') }}
                            </a>
                        </div>
                    @endif
                    @if(\App\CPU\Helpers::get_business_settings('company_email')!=null)
                        <div class="d-flex align-items-center" style="font-size: 0.85rem; color: var(--bh-text-secondary, #66706A);">
                            <i class="fa fa-envelope mr-2 text-success"></i>
                            <a href="mailto:{{ \App\CPU\Helpers::get_business_settings('company_email') }}" style="color: var(--bh-text-primary, #1B1F1D);">
                                {{ \App\CPU\Helpers::get_business_settings('company_email') }}
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Column 2: Shop Categories -->
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase font-weight-bold mb-3" style="color: var(--bh-text-primary, #1B1F1D); font-size: 0.9rem; letter-spacing: 0.5px;">
                        {{ \App\CPU\translate('SHOP') }}
                    </h6>
                    <ul class="list-unstyled mb-0" style="font-size: 0.85rem; line-height: 2;">
                        <li><a href="{{ route('products', ['data_from' => 'latest', 'page' => 1]) }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('All Products') }}</a></li>
                        <li><a href="{{ route('products', ['data_from' => 'featured', 'page' => 1]) }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('Seeds') }}</a></li>
                        <li><a href="{{ route('products', ['data_from' => 'best-selling', 'page' => 1]) }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('Crop Protection') }}</a></li>
                        <li><a href="{{ route('products', ['data_from' => 'top-rated', 'page' => 1]) }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('Fertilizers') }}</a></li>
                        <li><a href="{{ route('brands') }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('Top Brands') }}</a></li>
                    </ul>
                </div>

                <!-- Column 3: Help & Support -->
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase font-weight-bold mb-3" style="color: var(--bh-text-primary, #1B1F1D); font-size: 0.9rem; letter-spacing: 0.5px;">
                        {{ \App\CPU\translate('HELP') }}
                    </h6>
                    <ul class="list-unstyled mb-0" style="font-size: 0.85rem; line-height: 2;">
                        <li><a href="{{ route('track-order.index') }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('Track Order') }}</a></li>
                        <li><a href="{{ route('shipping-policy') }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('Shipping Policy') }}</a></li>
                        <li><a href="{{ route('refund-policy') }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('Refund Policy') }}</a></li>
                        <li><a href="{{ route('return-policy') }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('Return Policy') }}</a></li>
                        <li><a href="{{ route('cancellation-policy') }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('Cancellation Policy') }}</a></li>
                    </ul>
                </div>

                <!-- Column 4: Resources -->
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase font-weight-bold mb-3" style="color: var(--bh-text-primary, #1B1F1D); font-size: 0.9rem; letter-spacing: 0.5px;">
                        {{ \App\CPU\translate('RESOURCES') }}
                    </h6>
                    <ul class="list-unstyled mb-0" style="font-size: 0.85rem; line-height: 2;">
                        <li><a href="{{ route('technical-names') }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('Technical Names') }}</a></li>
                        <li><a href="{{ route('helpTopic') }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('FAQ') }}</a></li>
                        <li><a href="{{ route('categories') }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('Crop Guides') }}</a></li>
                        <li><a href="{{ route('home') }}" style="color: var(--bh-text-secondary, #66706A);">{{ \App\CPU\translate('Kisan Vedika') }}</a></li>
                    </ul>
                </div>

                <!-- Column 5: Newsletter Subscription -->
                <div class="col-lg-3 col-md-12">
                    <h6 class="text-uppercase font-weight-bold mb-3" style="color: var(--bh-text-primary, #1B1F1D); font-size: 0.9rem; letter-spacing: 0.5px;">
                        {{ \App\CPU\translate('NEWSLETTER') }}
                    </h6>
                    <p style="font-size: 0.82rem; color: var(--bh-text-secondary, #66706A); line-height: 1.5;" class="mb-3">
                        {{ \App\CPU\translate('Subscribe to receive farming tips, new product arrivals & exclusive discounts.') }}
                    </p>
                    <form action="{{ route('subscription') }}" method="post" class="mb-3">
                        @csrf
                        <div class="input-group">
                            <input type="email" name="subscription_email" class="form-control"
                                placeholder="{{ \App\CPU\translate('Your email address...') }}" required
                                style="border-radius: 8px 0 0 8px; border: 1px solid var(--bh-border, #E1E6E2); font-size: 0.85rem;">
                            <div class="input-group-append">
                                <button class="btn btn-bh-primary" type="submit" style="border-radius: 0 8px 8px 0 !important; font-size: 0.85rem;">
                                    {{ \App\CPU\translate('Subscribe') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Copyright & Payment Badges Strip -->
    <div class="py-3" style="background-color: var(--bh-bg, #F7F8F6);">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6 col-12 text-center text-md-left mb-2 mb-md-0">
                    <p class="mb-0" style="font-size: 0.82rem; color: var(--bh-text-secondary, #66706A);">
                        {{ $web_config['copyright_text']->value }}
                    </p>
                </div>
                <div class="col-md-6 col-12 text-center text-md-right">
                    <span style="font-size: 0.8rem; color: var(--bh-text-secondary, #66706A);" class="mr-2">
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
