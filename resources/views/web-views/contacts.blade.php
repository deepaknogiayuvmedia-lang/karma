@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('Contact Us'))

@push('css_or_js')
    <meta property="og:image" content="{{asset(env('PUBLIC_STORAGE_PATH').'/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Contact {{$web_config['name']->value}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset(env('PUBLIC_STORAGE_PATH').'/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Contact {{$web_config['name']->value}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --contact-primary: {{ $web_config['primary_color'] ?? '#006554' }};
            --contact-primary-light: {{ $web_config['primary_color'] ?? '#006554' }}15;
        }

        .contact-page-wrapper {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: #1f2937;
            background: #f9fafb;
            padding-bottom: 60px;
        }

        /* Hero Header */
        .contact-hero {
            background: linear-gradient(135deg, rgba(255,255,255,1) 0%, #f3f4f6 100%);
            padding: 48px 0 36px;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 40px;
        }
        .contact-hero-title {
            font-size: 2.25rem;
            font-weight: 800;
            color: #111827;
            letter-spacing: -0.02em;
            margin-bottom: 10px;
        }
        .contact-hero-subtitle {
            font-size: 1.05rem;
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Contact Info Card (Left Column) */
        .contact-info-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            padding: 32px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .contact-img-wrap {
            text-align: center;
            margin-bottom: 28px;
            padding: 20px;
            background: linear-gradient(135deg, var(--contact-primary-light) 0%, #ffffff 100%);
            border-radius: 16px;
            border: 1px solid #e5e7eb;
        }
        .contact-img-wrap img {
            max-width: 85%;
            height: auto;
            max-height: 220px;
            object-fit: contain;
        }

        .contact-info-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .contact-info-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .contact-info-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: var(--contact-primary-light);
            color: var(--contact-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .contact-info-label {
            font-size: 0.8125rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #9ca3af;
            margin-bottom: 2px;
        }
        .contact-info-val {
            font-size: 0.95rem;
            font-weight: 600;
            color: #111827;
            line-height: 1.4;
            text-decoration: none !important;
        }
        .contact-info-val:hover {
            color: var(--contact-primary);
        }

        /* Contact Form Card (Right Column) */
        .contact-form-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            padding: 36px 32px;
        }

        .contact-form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 24px;
            position: relative;
            padding-bottom: 12px;
        }
        .contact-form-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: {{ Session::get('direction') === 'rtl' ? 'auto' : '0' }};
            right: {{ Session::get('direction') === 'rtl' ? '0' : 'auto' }};
            width: 50px;
            height: 3px;
            background: var(--contact-primary);
            border-radius: 2px;
        }

        .form-label-custom {
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
            display: block;
        }

        .input-icon-group {
            position: relative;
        }
        .input-icon-group i.input-icon {
            position: absolute;
            left: {{ Session::get('direction') === 'rtl' ? 'auto' : '16px' }};
            right: {{ Session::get('direction') === 'rtl' ? '16px' : 'auto' }};
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1rem;
            pointer-events: none;
            transition: color 0.2s;
        }

        .form-control-custom {
            display: block;
            width: 100%;
            height: 48px;
            padding-left: {{ Session::get('direction') === 'rtl' ? '16px' : '44px' }};
            padding-right: {{ Session::get('direction') === 'rtl' ? '44px' : '16px' }};
            font-size: 0.9375rem;
            font-weight: 400;
            color: #1f2937;
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            transition: all 0.2s ease;
            font-family: inherit;
        }
        .form-control-custom:focus {
            background-color: #ffffff;
            border-color: var(--contact-primary);
            box-shadow: 0 0 0 4px var(--contact-primary-light);
            outline: none;
        }
        .input-icon-group:focus-within i.input-icon {
            color: var(--contact-primary);
        }

        textarea.form-control-custom {
            height: auto;
            padding: 14px 16px;
        }

        /* Captcha Block */
        .captcha-container {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 24px;
        }

        .captcha-img-box {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #ffffff;
            padding: 4px 12px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
        }

        .btn-refresh-captcha {
            color: #6b7280;
            cursor: pointer;
            font-size: 1.1rem;
            transition: color 0.2s, transform 0.2s;
        }
        .btn-refresh-captcha:hover {
            color: var(--contact-primary);
            transform: rotate(90deg);
        }

        /* Submit Button */
        .btn-contact-submit {
            background: var(--contact-primary);
            color: #ffffff !important;
            font-weight: 600;
            font-size: 1rem;
            height: 50px;
            padding: 0 32px;
            border-radius: 12px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
            transition: filter 0.2s ease, transform 0.1s ease;
        }
        .btn-contact-submit:hover {
            filter: brightness(0.92);
            transform: translateY(-1px);
            color: #ffffff !important;
        }

        @media (max-width: 991.98px) {
            .contact-info-card {
                margin-bottom: 30px;
            }
            .contact-hero-title {
                font-size: 1.75rem;
            }
        }
    </style>
@endpush

@section('content')
<div class="contact-page-wrapper">
    <!-- Hero Header Banner -->
    <div class="contact-hero text-center">
        <div class="container">
            <h1 class="contact-hero-title">{{\App\CPU\translate('contact_us')}}</h1>
            <p class="contact-hero-subtitle">
                {{\App\CPU\translate('Have a question, feedback, or need assistance? Reach out to our dedicated support team and we will get back to you promptly.')}}
            </p>
        </div>
    </div>

    @php($company_phone = \App\CPU\Helpers::get_business_settings('company_phone'))
    @php($company_email = \App\CPU\Helpers::get_business_settings('company_email'))
    @php($company_address = \App\CPU\Helpers::get_business_settings('shop_address') ?? \App\CPU\Helpers::get_business_settings('company_address'))

    <div class="container rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="row">
            <!-- Left Column: Illustration & Info -->
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="contact-info-card">
                    <div class="contact-img-wrap">
                        <img src="{{asset("assets/front-end/png/contact.png")}}" alt="{{\App\CPU\translate('contact_us')}}">
                    </div>

                    <div class="contact-info-list">
                        @if($company_phone)
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div>
                                    <div class="contact-info-label">{{\App\CPU\translate('Call Us')}}</div>
                                    <a href="tel:{{ $company_phone }}" class="contact-info-val">
                                        {{ $company_phone }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if($company_email)
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div>
                                    <div class="contact-info-label">{{\App\CPU\translate('Email Us')}}</div>
                                    <a href="mailto:{{ $company_email }}" class="contact-info-val">
                                        {{ $company_email }}
                                    </a>
                                </div>
                            </div>
                        @endif


                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <div>
                                <div class="contact-info-label">{{\App\CPU\translate('Working Hours')}}</div>
                                <div class="contact-info-val">
                                    {{\App\CPU\translate('Mon - Sat: 9:00 AM - 6:00 PM')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Contact Form -->
            <div class="col-lg-7">
                <div class="contact-form-card">
                    <h2 class="contact-form-title">{{\App\CPU\translate('send_us_a_message')}}</h2>
                    
                    <form action="{{route('contact.store')}}" method="POST" id="getResponse">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label-custom">{{\App\CPU\translate('your_name')}} <span class="text-danger">*</span></label>
                                <div class="input-icon-group">
                                    <i class="fa fa-user input-icon"></i>
                                    <input class="form-control-custom name" name="name" type="text"
                                           value="{{ old('name') }}" placeholder="John Doe" required>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label class="form-label-custom">{{\App\CPU\translate('email_address')}} <span class="text-danger">*</span></label>
                                <div class="input-icon-group">
                                    <i class="fa fa-envelope input-icon"></i>
                                    <input class="form-control-custom email" name="email" type="email"
                                           value="{{ old('email') }}" placeholder="johndoe@email.com" required>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label class="form-label-custom">{{\App\CPU\translate('your_phone')}} <span class="text-danger">*</span></label>
                                <div class="input-icon-group">
                                    <i class="fa fa-phone input-icon"></i>
                                    <input class="form-control-custom mobile_number" type="text" name="mobile_number"
                                           value="{{ old('mobile_number') }}" placeholder="{{\App\CPU\translate('Contact Number')}}" required>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label class="form-label-custom">{{\App\CPU\translate('Subject')}} <span class="text-danger">*</span></label>
                                <div class="input-icon-group">
                                    <i class="fa fa-tag input-icon"></i>
                                    <input class="form-control-custom subject" type="text" name="subject"
                                           value="{{ old('subject') }}" placeholder="{{\App\CPU\translate('Short title')}}" required>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label-custom">{{\App\CPU\translate('Message')}} <span class="text-danger">*</span></label>
                                <textarea class="form-control-custom message" name="message" rows="5" placeholder="{{\App\CPU\translate('Type your message here...')}}" required>{{ old('message') ?? old('subject') }}</textarea>
                            </div>
                        </div>

                        {{-- recaptcha --}}
                        @php($recaptcha = \App\CPU\Helpers::get_business_settings('recaptcha'))
                        @if(isset($recaptcha) && $recaptcha['status'] == 1)
                            <div id="recaptcha_element" class="w-100 mb-3" data-type="image"></div>
                        @else
                            <div class="captcha-container">
                                <div class="row align-items-center">
                                    <div class="col-sm-6 mb-2 mb-sm-0">
                                        <input type="text" class="form-control-custom" style="padding-left: 16px;" name="default_captcha_value" value=""
                                               placeholder="{{\App\CPU\translate('Enter captcha value')}}" autocomplete="off" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="captcha-img-box justify-content-between">
                                            <a onclick="javascript:re_captcha();" class="d-flex align-items-center justify-content-between w-100 text-decoration-none" style="cursor: pointer;">
                                                <img src="{{ URL('/contact/code/captcha/1') }}" class="input-field __h-40 rounded" id="default_recaptcha_id" style="max-height: 38px; width: auto;">
                                                <i class="tio-refresh btn-refresh-captcha ml-2" title="Refresh Captcha"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="mt-4">
                            <button class="btn-contact-submit" type="submit">
                                <i class="fa fa-paper-plane"></i>
                                {{\App\CPU\translate('send_message')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
{{-- recaptcha scripts start --}}
@if(isset($recaptcha) && $recaptcha['status'] == 1)
    <script type="text/javascript">
        var onloadCallback = function () {
            grecaptcha.render('recaptcha_element', {
                'sitekey': '{{ \App\CPU\Helpers::get_business_settings('recaptcha')['site_key'] }}'
            });
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <script>
        $("#getResponse").on('submit', function (e) {
            var response = grecaptcha.getResponse();

            if (response.length === 0) {
                e.preventDefault();
                toastr.error("{{\App\CPU\translate('Please check the recaptcha')}}");
            }
        });
    </script>
@else
<script type="text/javascript">
    function re_captcha() {
        $url = "{{ URL('/contact/code/captcha') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('default_recaptcha_id').src = $url;
        console.log('url: '+ $url);
    }
</script>
@endif
{{-- recaptcha scripts end --}}
@endpush
