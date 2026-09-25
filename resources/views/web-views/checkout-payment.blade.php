@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('Choose Payment Method'))

@push('css_or_js')
    <style>
        .stripe-button-el {
            display: none !important;
        }

        .razorpay-payment-button {
            display: none !important;
        }

        .pay-page {
            --pay-primary: {{ $web_config['primary_color'] ?? '#168A3A' }};
        }

        .pay-heading {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--bh-text-primary, #1B1F1D);
            margin: 1.75rem 0 0.35rem;
        }

        .pay-sub {
            font-size: 0.9rem;
            color: var(--bh-text-secondary, #66706A);
            margin-bottom: 1.25rem;
        }

        .pay-opt-list {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .pay-opt {
            position: relative;
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.1rem;
            background: #fff;
            border: 1.5px solid #E5E7EB;
            border-radius: 12px;
            cursor: pointer;
            transition: border-color 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
        }

        .pay-opt:hover {
            border-color: var(--pay-primary);
            box-shadow: 0 4px 14px rgba(22, 138, 58, 0.08);
        }

        .pay-opt.selected {
            border-color: var(--pay-primary);
            background: #F0FDF4;
            box-shadow: 0 0 0 3px rgba(22, 138, 58, 0.12);
        }

        .pay-opt input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .pay-opt .pay-radio {
            flex-shrink: 0;
            width: 22px;
            height: 22px;
            border: 2px solid #C5CBD3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color 0.15s ease;
        }

        .pay-opt.selected .pay-radio {
            border-color: var(--pay-primary);
        }

        .pay-opt .pay-radio::after {
            content: '';
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--pay-primary);
            transform: scale(0);
            transition: transform 0.15s ease;
        }

        .pay-opt.selected .pay-radio::after {
            transform: scale(1);
        }

        .pay-opt .pay-icon-wrap {
            flex-shrink: 0;
            width: 56px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #F8FAF9;
            border-radius: 8px;
            border: 1px solid #EEF2F0;
            overflow: hidden;
        }

        .pay-opt .pay-icon-wrap img {
            max-width: 48px;
            max-height: 32px;
            object-fit: contain;
        }

        .pay-opt .pay-info {
            flex: 1;
            min-width: 0;
        }

        .pay-opt .pay-title {
            display: block;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--bh-text-primary, #1B1F1D);
            line-height: 1.3;
        }

        .pay-opt .pay-desc {
            display: block;
            font-size: 0.8rem;
            color: var(--bh-text-secondary, #66706A);
            margin-top: 0.15rem;
        }

        .pay-opt .pay-badge {
            flex-shrink: 0;
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--pay-primary);
            background: #DCFCE7;
            border-radius: 999px;
            padding: 0.2rem 0.55rem;
            display: none;
        }

        .pay-opt.selected .pay-badge {
            display: inline-block;
        }

        .pay-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1.5rem;
            align-items: center;
        }

        .pay-actions .btn-pay {
            flex: 1;
            min-width: 180px;
            background: var(--pay-primary);
            border-color: var(--pay-primary);
            color: #fff;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.7rem 1.25rem;
            border-radius: 10px;
            letter-spacing: 0.01em;
        }

        .pay-actions .btn-pay:hover,
        .pay-actions .btn-pay:focus {
            background: #127230;
            border-color: #127230;
            color: #fff;
            box-shadow: 0 6px 16px rgba(22, 138, 58, 0.28);
        }

        .pay-actions .btn-pay:disabled {
            opacity: 0.55;
            cursor: not-allowed;
            box-shadow: none;
        }

        .pay-actions .btn-back {
            flex-shrink: 0;
            min-width: 140px;
            background: #fff;
            border: 1.5px solid #D1D5DB;
            color: #374151;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.7rem 1.25rem;
            border-radius: 10px;
        }

        .pay-actions .btn-back:hover {
            background: #F9FAFB;
            border-color: #9CA3AF;
            color: #111827;
        }

        .pay-secure {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem 1.5rem;
            margin-top: 1.25rem;
            padding-top: 1rem;
            border-top: 1px solid #EEF2F0;
            font-size: 0.78rem;
            color: var(--bh-text-secondary, #66706A);
        }

        .pay-secure span {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .pay-secure i {
            color: var(--pay-primary);
        }

        .pay-forms {
            display: none;
        }

        #pay-redirecting {
            display: none;
            text-align: center;
            padding: 2rem 1rem;
        }

        #pay-redirecting .spinner {
            width: 36px;
            height: 36px;
            border: 3px solid #E5E7EB;
            border-top-color: var(--pay-primary);
            border-radius: 50%;
            margin: 0 auto 0.85rem;
            animation: paySpin 0.7s linear infinite;
        }

        @keyframes paySpin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 576px) {
            .pay-opt {
                padding: 0.85rem;
                gap: 0.7rem;
            }

            .pay-opt .pay-icon-wrap {
                width: 48px;
                height: 34px;
            }

            .pay-actions .btn-pay,
            .pay-actions .btn-back {
                flex: 1 1 100%;
            }
        }
    </style>

    {{--stripe--}}
    <script src="https://js.stripe.com/v3/"></script>
    {{--stripe--}}
@endpush

@section('content')
    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 rtl pay-page"
         style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="row">
            <div class="col-md-12 mb-5 pt-5">
                <div class="feature_header __feature_header">
                    <span>{{ \App\CPU\translate('payment_method')}}</span>
                </div>
            </div>
            <section class="col-lg-8">
                <div class="checkout_details" id="pay-checkout-details">
                    @include('web-views.partials._checkout-steps',['step'=>2])

                    <div id="pay-redirecting">
                        <div class="spinner"></div>
                        <h3 class="h6 mb-1">{{\App\CPU\translate('Redirecting_to_the_payment')}}...</h3>
                        <p class="text-muted mb-0" style="font-size:0.88rem;">{{\App\CPU\translate('Please_do_not_close_this_window')}}</p>
                    </div>

                    <div id="pay-select-ui">
                        <h2 class="pay-heading">{{\App\CPU\translate('choose_payment')}}</h2>
                        <p class="pay-sub">{{\App\CPU\translate('Select a payment method to continue')}}</p>

                        @php($config=\App\CPU\Helpers::get_business_settings('cash_on_delivery'))
                        @php($coupon_discount = session()->has('coupon_discount') ? session('coupon_discount') : 0)
                        @php($amount = \App\CPU\CartManager::cart_grand_total() - $coupon_discount)
                        @php($digital_payment=\App\CPU\Helpers::get_business_settings('digital_payment'))
                        @php($pay_method_count = 0)

                        <div class="pay-opt-list" id="pay-opt-list">
                            {{-- Cash on Delivery --}}
                            @if(!$cod_not_show && $config['status'])
                                @php($pay_method_count++)
                                <label class="pay-opt selected" data-pay="cod">
                                    <input type="radio" name="selected_pay_method" value="cod" checked>
                                    <span class="pay-radio"></span>
                                    <span class="pay-icon-wrap">
                                        <img src="{{asset('assets/front-end/img/cod.png')}}" alt="COD">
                                    </span>
                                    <span class="pay-info">
                                        <span class="pay-title">{{\App\CPU\translate('Cash_on_Delivery')}}</span>
                                        <span class="pay-desc">{{\App\CPU\translate('Pay_with_cash_when_your_order_arrives')}}</span>
                                    </span>
                                    <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                </label>
                            @endif

                            @if ($digital_payment['status']==1)
                                {{-- Wallet --}}
                                @php($config=\App\CPU\Helpers::get_business_settings('wallet_status'))
                                @if($config==1)
                                    @php($pay_method_count++)
                                    <label class="pay-opt" data-pay="wallet">
                                        <input type="radio" name="selected_pay_method" value="wallet">
                                        <span class="pay-radio"></span>
                                        <span class="pay-icon-wrap">
                                            <img src="{{asset('assets/front-end/img/wallet.png')}}" alt="Wallet">
                                        </span>
                                        <span class="pay-info">
                                            <span class="pay-title">{{\App\CPU\translate('Wallet')}}</span>
                                            <span class="pay-desc">{{\App\CPU\translate('Pay_from_your_wallet_balance')}}</span>
                                        </span>
                                        <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                    </label>
                                @endif

                                {{-- Offline Payment --}}
                                @php($config=\App\CPU\Helpers::get_business_settings('offline_payment'))
                                @if(isset($config) && $config['status'])
                                    @php($pay_method_count++)
                                    <label class="pay-opt" data-pay="offline">
                                        <input type="radio" name="selected_pay_method" value="offline">
                                        <span class="pay-radio"></span>
                                        <span class="pay-icon-wrap">
                                            <img src="{{asset('assets/front-end/img/pay-offline.png')}}" alt="Offline">
                                        </span>
                                        <span class="pay-info">
                                            <span class="pay-title">{{\App\CPU\translate('Offline_Payment')}}</span>
                                            <span class="pay-desc">{{\App\CPU\translate('Pay_via_bank_transfer_or_manual_method')}}</span>
                                        </span>
                                        <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                    </label>
                                @endif

                                {{-- SSLCommerz --}}
                                @php($config=\App\CPU\Helpers::get_business_settings('ssl_commerz_payment'))
                                @if(isset($config) && $config['status'])
                                    @php($pay_method_count++)
                                    <label class="pay-opt" data-pay="sslcommerz">
                                        <input type="radio" name="selected_pay_method" value="sslcommerz">
                                        <span class="pay-radio"></span>
                                        <span class="pay-icon-wrap">
                                            <img src="{{asset('assets/front-end/img/sslcomz.png')}}" alt="SSLCommerz">
                                        </span>
                                        <span class="pay-info">
                                            <span class="pay-title">SSLCommerz</span>
                                            <span class="pay-desc">{{\App\CPU\translate('Pay_securely_with_cards_and_net_banking')}}</span>
                                        </span>
                                        <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                    </label>
                                @endif

                                {{-- PayPal --}}
                                @php($config=\App\CPU\Helpers::get_business_settings('paypal'))
                                @if($config['status'])
                                    @php($pay_method_count++)
                                    <label class="pay-opt" data-pay="paypal">
                                        <input type="radio" name="selected_pay_method" value="paypal">
                                        <span class="pay-radio"></span>
                                        <span class="pay-icon-wrap">
                                            <img src="{{asset('assets/front-end/img/paypal.png')}}" alt="PayPal">
                                        </span>
                                        <span class="pay-info">
                                            <span class="pay-title">PayPal</span>
                                            <span class="pay-desc">{{\App\CPU\translate('Pay_with_your_paypal_account')}}</span>
                                        </span>
                                        <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                    </label>
                                @endif

                                {{-- Stripe --}}
                                @php($config=\App\CPU\Helpers::get_business_settings('stripe'))
                                @if($config['status'])
                                    @php($pay_method_count++)
                                    <label class="pay-opt" data-pay="stripe">
                                        <input type="radio" name="selected_pay_method" value="stripe">
                                        <span class="pay-radio"></span>
                                        <span class="pay-icon-wrap">
                                            <img src="{{asset('assets/front-end/img/stripe.png')}}" alt="Stripe">
                                        </span>
                                        <span class="pay-info">
                                            <span class="pay-title">Stripe</span>
                                            <span class="pay-desc">{{\App\CPU\translate('Credit_Debit_Card')}}</span>
                                        </span>
                                        <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                    </label>
                                @endif

                                {{-- Razorpay --}}
                                @php($config=\App\CPU\Helpers::get_business_settings('razor_pay'))
                                @php($inr=\App\Model\Currency::where(['symbol'=>'₹'])->first())
                                @php($usd=\App\Model\Currency::where(['code'=>'INR'])->first())
                                @if(isset($inr) && isset($usd) && $config['status'])
                                    @php($pay_method_count++)
                                    <label class="pay-opt" data-pay="razorpay">
                                        <input type="radio" name="selected_pay_method" value="razorpay">
                                        <span class="pay-radio"></span>
                                        <span class="pay-icon-wrap">
                                            <img src="{{asset('assets/front-end/img/razor.png')}}" alt="Razorpay">
                                        </span>
                                        <span class="pay-info">
                                            <span class="pay-title">Razorpay</span>
                                            <span class="pay-desc">{{\App\CPU\translate('UPI_Cards_and_more')}}</span>
                                        </span>
                                        <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                    </label>
                                @endif

                                {{-- Paystack --}}
                                @php($config=\App\CPU\Helpers::get_business_settings('paystack'))
                                @if($config['status'])
                                    @php($pay_method_count++)
                                    <label class="pay-opt" data-pay="paystack">
                                        <input type="radio" name="selected_pay_method" value="paystack">
                                        <span class="pay-radio"></span>
                                        <span class="pay-icon-wrap">
                                            <img src="{{asset('assets/front-end/img/paystack.png')}}" alt="Paystack">
                                        </span>
                                        <span class="pay-info">
                                            <span class="pay-title">Paystack</span>
                                            <span class="pay-desc">{{\App\CPU\translate('Pay_securely_online')}}</span>
                                        </span>
                                        <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                    </label>
                                @endif

                                {{-- SenangPay --}}
                                @php($myr=\App\Model\Currency::where(['code'=>'MYR'])->first())
                                @php($usd=\App\Model\Currency::where(['code'=>'inr'])->first())
                                @php($config=\App\CPU\Helpers::get_business_settings('senang_pay'))
                                @if(isset($myr) && isset($usd) && $config['status'])
                                    @php($pay_method_count++)
                                    <label class="pay-opt" data-pay="senangpay">
                                        <input type="radio" name="selected_pay_method" value="senangpay">
                                        <span class="pay-radio"></span>
                                        <span class="pay-icon-wrap">
                                            <img src="{{asset('assets/front-end/img/senangpay.png')}}" alt="SenangPay">
                                        </span>
                                        <span class="pay-info">
                                            <span class="pay-title">SenangPay</span>
                                            <span class="pay-desc">{{\App\CPU\translate('Pay_securely_online')}}</span>
                                        </span>
                                        <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                    </label>
                                @endif

                                {{-- Paymob --}}
                                @php($config=\App\CPU\Helpers::get_business_settings('paymob_accept'))
                                @if($config['status'])
                                    @php($pay_method_count++)
                                    <label class="pay-opt" data-pay="paymob">
                                        <input type="radio" name="selected_pay_method" value="paymob">
                                        <span class="pay-radio"></span>
                                        <span class="pay-icon-wrap">
                                            <img src="{{asset('assets/front-end/img/paymob.png')}}" alt="Paymob">
                                        </span>
                                        <span class="pay-info">
                                            <span class="pay-title">Paymob</span>
                                            <span class="pay-desc">{{\App\CPU\translate('Pay_securely_online')}}</span>
                                        </span>
                                        <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                    </label>
                                @endif

                                {{-- bKash --}}
                                @php($config=\App\CPU\Helpers::get_business_settings('bkash'))
                                @if(isset($config) && $config['status'])
                                    @php($pay_method_count++)
                                    <label class="pay-opt" data-pay="bkash">
                                        <input type="radio" name="selected_pay_method" value="bkash">
                                        <span class="pay-radio"></span>
                                        <span class="pay-icon-wrap">
                                            <img src="{{asset('assets/front-end/img/bkash.png')}}" alt="bKash">
                                        </span>
                                        <span class="pay-info">
                                            <span class="pay-title">bKash</span>
                                            <span class="pay-desc">{{\App\CPU\translate('Pay_with_bkash')}}</span>
                                        </span>
                                        <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                    </label>
                                @endif

                                {{-- Paytabs --}}
                                @php($config=\App\CPU\Helpers::get_business_settings('paytabs'))
                                @if(isset($config) && $config['status'])
                                    @php($pay_method_count++)
                                    <label class="pay-opt" data-pay="paytabs">
                                        <input type="radio" name="selected_pay_method" value="paytabs">
                                        <span class="pay-radio"></span>
                                        <span class="pay-icon-wrap">
                                            <img src="{{asset('assets/front-end/img/paytabs.png')}}" alt="Paytabs">
                                        </span>
                                        <span class="pay-info">
                                            <span class="pay-title">Paytabs</span>
                                            <span class="pay-desc">{{\App\CPU\translate('Pay_securely_online')}}</span>
                                        </span>
                                        <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                    </label>
                                @endif

                                {{-- MercadoPago --}}
                                @php($config=\App\CPU\Helpers::get_business_settings('mercadopago'))
                                @if(isset($config) && $config['status'])
                                    @php($pay_method_count++)
                                    <label class="pay-opt" data-pay="mercadopago">
                                        <input type="radio" name="selected_pay_method" value="mercadopago">
                                        <span class="pay-radio"></span>
                                        <span class="pay-icon-wrap">
                                            <img src="{{asset('assets/front-end/img/MercadoPago_(Horizontal).svg')}}" alt="MercadoPago">
                                        </span>
                                        <span class="pay-info">
                                            <span class="pay-title">MercadoPago</span>
                                            <span class="pay-desc">{{\App\CPU\translate('Pay_securely_online')}}</span>
                                        </span>
                                        <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                    </label>
                                @endif

                                {{-- Flutterwave --}}
                                @php($config=\App\CPU\Helpers::get_business_settings('flutterwave'))
                                @if(isset($config) && $config['status'])
                                    @php($pay_method_count++)
                                    <label class="pay-opt" data-pay="flutterwave">
                                        <input type="radio" name="selected_pay_method" value="flutterwave">
                                        <span class="pay-radio"></span>
                                        <span class="pay-icon-wrap">
                                            <img src="{{asset('assets/front-end/img/fluterwave.png')}}" alt="Flutterwave">
                                        </span>
                                        <span class="pay-info">
                                            <span class="pay-title">Flutterwave</span>
                                            <span class="pay-desc">{{\App\CPU\translate('Pay_securely_online')}}</span>
                                        </span>
                                        <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                    </label>
                                @endif

                                {{-- PhonePe --}}
                                @php($config=\App\CPU\Helpers::get_business_settings('phone_pe'))
                                @if(isset($config) && $config['status'])
                                    @php($pay_method_count++)
                                    <label class="pay-opt" data-pay="phonepe">
                                        <input type="radio" name="selected_pay_method" value="phonepe">
                                        <span class="pay-radio"></span>
                                        <span class="pay-icon-wrap">
                                            <img src="{{asset('assets/back-end/img/phonepe-1.svg')}}" alt="PhonePe" style="max-height:26px;">
                                        </span>
                                        <span class="pay-info">
                                            <span class="pay-title">PhonePe</span>
                                            <span class="pay-desc">{{\App\CPU\translate('Pay_with_phonepe')}}</span>
                                        </span>
                                        <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                    </label>
                                @endif

                                {{-- Paytm --}}
                                @php($config=\App\CPU\Helpers::get_business_settings('paytm'))
                                @if(isset($config) && $config['status'])
                                    @php($pay_method_count++)
                                    <label class="pay-opt" data-pay="paytm">
                                        <input type="radio" name="selected_pay_method" value="paytm">
                                        <span class="pay-radio"></span>
                                        <span class="pay-icon-wrap">
                                            <img src="{{asset('assets/front-end/img/paytm.png')}}" alt="Paytm">
                                        </span>
                                        <span class="pay-info">
                                            <span class="pay-title">Paytm</span>
                                            <span class="pay-desc">{{\App\CPU\translate('Pay_with_paytm')}}</span>
                                        </span>
                                        <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                    </label>
                                @endif

                                {{-- Liqpay --}}
                                @php($config=\App\CPU\Helpers::get_business_settings('liqpay'))
                                @if(isset($config) && $config['status'])
                                    @php($pay_method_count++)
                                    <label class="pay-opt" data-pay="liqpay">
                                        <input type="radio" name="selected_pay_method" value="liqpay">
                                        <span class="pay-radio"></span>
                                        <span class="pay-icon-wrap">
                                            <img src="{{asset('assets/front-end/img/liqpay4.png')}}" alt="Liqpay">
                                        </span>
                                        <span class="pay-info">
                                            <span class="pay-title">Liqpay</span>
                                            <span class="pay-desc">{{\App\CPU\translate('Pay_securely_online')}}</span>
                                        </span>
                                        <span class="pay-badge">{{\App\CPU\translate('Selected')}}</span>
                                    </label>
                                @endif
                            @endif
                        </div>

                        <div class="pay-actions">
                            <a class="btn btn-back" href="{{route('checkout-details')}}">
                                <i class="fa fa-arrow-left mr-1"></i>
                                <span class="d-none d-sm-inline">{{\App\CPU\translate('Back to Shipping')}}</span>
                                <span class="d-inline d-sm-none">{{\App\CPU\translate('Back')}}</span>
                            </a>
                            <button type="button" class="btn btn-pay" id="pay-continue-btn">
                                <i class="fa fa-lock mr-1"></i>
                                {{\App\CPU\translate('Proceed_to_Pay')}}
                            </button>
                        </div>

                        <div class="pay-secure">
                            <span><i class="fa fa-shield"></i> {{\App\CPU\translate('100%_secure_payments')}}</span>
                            <span><i class="fa fa-lock"></i> {{\App\CPU\translate('SSL_encrypted')}}</span>
                            <span><i class="fa fa-undo"></i> {{\App\CPU\translate('Easy_returns')}}</span>
                        </div>
                    </div>

                    {{-- Hidden forms / gateway actions --}}
                    <div class="pay-forms" id="pay-forms">
                        {{-- COD --}}
                        @if(!$cod_not_show && \App\CPU\Helpers::get_business_settings('cash_on_delivery')['status'])
                            <form action="{{route('checkout-complete')}}" method="get" id="form-cod">
                                <input type="hidden" name="payment_method" value="cash_on_delivery">
                            </form>
                        @endif

                        @php($config=\App\CPU\Helpers::get_business_settings('digital_payment'))
                        @if ($config['status']==1)
                            {{-- Offline --}}
                            @php($config=\App\CPU\Helpers::get_business_settings('offline_payment'))
                            @if(isset($config) && $config['status'])
                                <form action="{{route('offline-payment-checkout-complete')}}" method="get" id="form-offline">
                                    <input type="hidden" name="payment_method" value="offline_payment">
                                </form>
                            @endif

                            {{-- SSLCommerz --}}
                            @php($config=\App\CPU\Helpers::get_business_settings('ssl_commerz_payment'))
                            @if(isset($config) && $config['status'])
                                <form action="{{ url('/pay-ssl') }}" method="POST" id="form-sslcommerz">
                                    <input type="hidden" value="{{ csrf_token() }}" name="_token"/>
                                </form>
                            @endif

                            {{-- PayPal --}}
                            @php($config=\App\CPU\Helpers::get_business_settings('paypal'))
                            @if($config['status'])
                                <form method="POST" id="form-paypal" action="{{route('pay-paypal')}}">
                                    {{ csrf_field() }}
                                </form>
                            @endif

                            {{-- Stripe --}}
                            @php($config=\App\CPU\Helpers::get_business_settings('stripe'))
                            @if($config['status'])
                                <button type="button" id="checkout-button" style="display:none"></button>
                                <script type="text/javascript">
                                    var stripe = Stripe(@json($config['published_key']));
                                    var checkoutButton = document.getElementById("checkout-button");
                                    checkoutButton.addEventListener("click", function () {
                                        fetch(@json(route('pay-stripe')), {
                                            method: "GET",
                                        }).then(function (response) {
                                            return response.text();
                                        }).then(function (session) {
                                            return stripe.redirectToCheckout({sessionId: JSON.parse(session).id});
                                        }).then(function (result) {
                                            if (result.error) {
                                                alert(result.error.message);
                                            }
                                        }).catch(function (error) {
                                            console.error(@json(\App\CPU\translate('Error')), error);
                                        });
                                    });
                                </script>
                            @endif

                            {{-- Razorpay --}}
                            @php($config=\App\CPU\Helpers::get_business_settings('razor_pay'))
                            @php($inr=\App\Model\Currency::where(['symbol'=>'₹'])->first())
                            @php($usd=\App\Model\Currency::where(['code'=>'INR'])->first())
                            @if(isset($inr) && isset($usd) && $config['status'])
                                <form action="{!!route('payment-razor')!!}" method="POST" id="form-razorpay">
                                    @csrf
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                            data-key="{{ \Illuminate\Support\Facades\Config::get('razor.razor_key') }}"
                                            data-amount="{{(round(\App\CPU\Convert::usdToinr($amount)))*100}}"
                                            data-buttontext="Pay {{(\App\CPU\Convert::usdToinr($amount))*100}} INR"
                                            data-name="{{\App\Model\BusinessSetting::where(['type'=>'company_name'])->first()->value}}"
                                            data-description=""
                                            data-image="{{asset(config('app.public_storage_path').'/company/'.\App\Model\BusinessSetting::where(['type'=>'company_web_logo'])->first()->value)}}"
                                            data-prefill.name="{{auth('customer')->user()->f_name}}"
                                            data-prefill.email="{{auth('customer')->user()->email}}"
                                            data-theme.color="#168A3A">
                                    </script>
                                </form>
                            @endif

                            {{-- Paystack --}}
                            @php($config=\App\CPU\Helpers::get_business_settings('paystack'))
                            @if($config['status'])
                                <form method="POST" action="{{ route('paystack-pay') }}" accept-charset="UTF-8" id="form-paystack" role="form">
                                    @csrf
                                    <input type="hidden" name="email" value="{{auth('customer')->user()->email}}">
                                    <input type="hidden" name="orderID" value="{{session('cart_group_id')}}">
                                    <input type="hidden" name="amount" value="{{\App\CPU\Convert::usdTozar($amount*100)}}">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="currency" value="{{\App\CPU\Helpers::currency_code()}}">
                                    <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}">
                                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                                    <button class="paystack-payment-button" style="display: none" type="submit" value="Pay Now!"></button>
                                </form>
                            @endif

                            {{-- SenangPay --}}
                            @php($myr=\App\Model\Currency::where(['code'=>'MYR'])->first())
                            @php($usd=\App\Model\Currency::where(['code'=>'inr'])->first())
                            @php($config=\App\CPU\Helpers::get_business_settings('senang_pay'))
                            @if(isset($myr) && isset($usd) && $config['status'])
                                @php($user=auth('customer')->user())
                                @php($secretkey = $config['secret_key'])
                                @php($data = new \stdClass())
                                @php($data->merchantId = $config['merchant_id'])
                                @php($data->detail = 'payment')
                                @php($data->order_id = session('cart_group_id'))
                                @php($data->amount = \App\CPU\Convert::usdTomyr($amount))
                                @php($data->name = $user->f_name.' '.$user->l_name)
                                @php($data->email = $user->email)
                                @php($data->phone = $user->phone)
                                @php($data->hashed_string = md5($secretkey . urldecode($data->detail) . urldecode($data->amount) . urldecode($data->order_id)))
                                <form name="order" method="post" id="form-senangpay"
                                    action="https://{{env('APP_MODE')=='live'?'app.senangpay.my':'sandbox.senangpay.my'}}/payment/{{$config['merchant_id']}}">
                                    <input type="hidden" name="detail" value="{{$data->detail}}">
                                    <input type="hidden" name="amount" value="{{$data->amount}}">
                                    <input type="hidden" name="order_id" value="{{$data->order_id}}">
                                    <input type="hidden" name="name" value="{{$data->name}}">
                                    <input type="hidden" name="email" value="{{$data->email}}">
                                    <input type="hidden" name="phone" value="{{$data->phone}}">
                                    <input type="hidden" name="hash" value="{{$data->hashed_string}}">
                                </form>
                            @endif

                            {{-- Paymob --}}
                            @php($config=\App\CPU\Helpers::get_business_settings('paymob_accept'))
                            @if($config['status'])
                                <form method="POST" id="form-paymob" action="{{route('paymob-credit')}}">
                                    {{ csrf_field() }}
                                </form>
                            @endif

                            {{-- bKash --}}
                            @php($config=\App\CPU\Helpers::get_business_settings('bkash'))
                            @if(isset($config) && $config['status'])
                                <div id="form-bkash" data-href="{{route('bkash-make-payment')}}"></div>
                            @endif

                            {{-- Paytabs --}}
                            @php($config=\App\CPU\Helpers::get_business_settings('paytabs'))
                            @if(isset($config) && $config['status'])
                                <div id="form-paytabs" data-href="{{route('paytabs-payment')}}"></div>
                            @endif

                            {{-- MercadoPago --}}
                            @php($config=\App\CPU\Helpers::get_business_settings('mercadopago'))
                            @if(isset($config) && $config['status'])
                                <div id="form-mercadopago" data-href="{{route('mercadopago.index')}}"></div>
                            @endif

                            {{-- Flutterwave --}}
                            @php($config=\App\CPU\Helpers::get_business_settings('flutterwave'))
                            @if(isset($config) && $config['status'])
                                <form method="POST" action="{{ route('flutterwave_pay') }}" id="form-flutterwave">
                                    {{ csrf_field() }}
                                </form>
                            @endif

                            {{-- PhonePe --}}
                            @php($config=\App\CPU\Helpers::get_business_settings('phone_pe'))
                            @if(isset($config) && $config['status'])
                                <div id="form-phonepe" data-href="{{route('phonepe-payment')}}"></div>
                            @endif

                            {{-- Paytm --}}
                            @php($config=\App\CPU\Helpers::get_business_settings('paytm'))
                            @if(isset($config) && $config['status'])
                                <div id="form-paytm" data-href="{{route('paytm-payment')}}"></div>
                            @endif

                            {{-- Liqpay --}}
                            @php($config=\App\CPU\Helpers::get_business_settings('liqpay'))
                            @if(isset($config) && $config['status'])
                                <div id="form-liqpay" data-href="{{route('liqpay-payment')}}"></div>
                            @endif
                        @endif
                    </div>
                </div>
            </section>
            <!-- Sidebar-->
            @include('web-views.partials._order-summary')
        </div>
    </div>

    <!-- wallet modal -->
    <div class="modal fade" id="wallet_submit_button" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{\App\CPU\translate('wallet_payment')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @php($customer = auth('customer')->user())
                @php($customer_balance = $customer ? $customer->wallet_balance : 0)
                @php($remain_balance = $customer_balance - $amount)
                <form action="{{route('checkout-complete-wallet')}}" method="get" class="needs-validation">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="">{{\App\CPU\translate('your_current_balance')}}</label>
                                <input class="form-control" type="text" value="{{\App\CPU\Helpers::currency_converter($customer_balance)}}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="">{{\App\CPU\translate('order_amount')}}</label>
                                <input class="form-control" type="text" value="{{\App\CPU\Helpers::currency_converter($amount)}}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="">{{\App\CPU\translate('remaining_balance')}}</label>
                                <input class="form-control" type="text" value="{{\App\CPU\Helpers::currency_converter($remain_balance)}}" readonly>
                                @if ($remain_balance<0)
                                    <label class="__color-crimson">{{\App\CPU\translate('you do not have sufficient balance for pay this order!!')}}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{\App\CPU\translate('close')}}</button>
                        <button type="submit" class="btn btn--primary" {{$remain_balance>0? '':'disabled'}} style="background:#168A3A;border-color:#168A3A;">{{\App\CPU\translate('submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- offline payment modal -->
    <div class="modal fade" id="offline_payment_submit_button" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{\App\CPU\translate('offline_payment')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('offline-payment-checkout-complete')}}" method="post" class="needs-validation">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="">{{\App\CPU\translate('payment_by')}}</label>
                                <input class="form-control" type="text" name="payment_by" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="">{{\App\CPU\translate('transaction_ID')}}</label>
                                <input class="form-control" type="text" name="transaction_ref" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="">{{\App\CPU\translate('payment_note')}}</label>
                                <textarea name="payment_note" id="" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="offline_payment" name="payment_method">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{\App\CPU\translate('close')}}</button>
                        <button type="submit" class="btn btn--primary" style="background:#168A3A;border-color:#168A3A;">{{\App\CPU\translate('submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        setTimeout(function () {
            $('.stripe-button-el').hide();
            $('.razorpay-payment-button').hide();
            $('.paystack-payment-button').hide();
        }, 10);

        (function () {
            var $list = $('#pay-opt-list');
            var $btn = $('#pay-continue-btn');

            function selectedMethod() {
                return $list.find('input[name="selected_pay_method"]:checked').val() || null;
            }

            function syncSelection() {
                $list.find('.pay-opt').each(function () {
                    var on = $(this).find('input').is(':checked');
                    $(this).toggleClass('selected', on);
                });
                var m = selectedMethod();
                $btn.prop('disabled', !m);
            }

            $list.on('change', 'input[name="selected_pay_method"]', syncSelection);
            syncSelection();

            function showRedirecting() {
                $('#pay-select-ui').hide();
                $('#pay-redirecting').show();
            }

            function submitForm(id) {
                var $f = $(id);
                if (!$f.length) {
                    toastr.error('{{\App\CPU\translate('Error')}}');
                    return;
                }
                showRedirecting();
                $f.trigger('submit');
            }

            function navigateHref(id) {
                var $el = $(id);
                var href = $el.data('href');
                if (!href) {
                    toastr.error('{{\App\CPU\translate('Error')}}');
                    return;
                }
                showRedirecting();
                window.location.href = href;
            }

            $btn.on('click', function () {
                var m = selectedMethod();
                if (!m) {
                    toastr.warning('{{\App\CPU\translate('Please_select_a_payment_method')}}');
                    return;
                }

                switch (m) {
                    case 'cod':
                        submitForm('#form-cod');
                        break;
                    case 'wallet':
                        $('#wallet_submit_button').modal('show');
                        break;
                    case 'offline':
                        $('#offline_payment_submit_button').modal('show');
                        break;
                    case 'sslcommerz':
                        submitForm('#form-sslcommerz');
                        break;
                    case 'paypal':
                        submitForm('#form-paypal');
                        break;
                    case 'stripe':
                        showRedirecting();
                        $('#checkout-button').click();
                        break;
                    case 'razorpay':
                        showRedirecting();
                        $('.razorpay-payment-button').click();
                        break;
                    case 'paystack':
                        showRedirecting();
                        $('.paystack-payment-button').click();
                        break;
                    case 'senangpay':
                        if (document.order) {
                            showRedirecting();
                            document.order.submit();
                        }
                        break;
                    case 'paymob':
                        submitForm('#form-paymob');
                        break;
                    case 'bkash':
                        navigateHref('#form-bkash');
                        break;
                    case 'paytabs':
                        navigateHref('#form-paytabs');
                        break;
                    case 'mercadopago':
                        navigateHref('#form-mercadopago');
                        break;
                    case 'flutterwave':
                        submitForm('#form-flutterwave');
                        break;
                    case 'phonepe':
                        navigateHref('#form-phonepe');
                        break;
                    case 'paytm':
                        navigateHref('#form-paytm');
                        break;
                    case 'liqpay':
                        navigateHref('#form-liqpay');
                        break;
                    default:
                        toastr.error('{{\App\CPU\translate('Error')}}');
                }
            });

            // If only one method, keep it selected (already handled by checked/selected on first)
            var total = $list.find('.pay-opt').length;
            if (total === 1) {
                $list.find('.pay-opt input').prop('checked', true);
                syncSelection();
            }
        })();
    </script>
@endpush
