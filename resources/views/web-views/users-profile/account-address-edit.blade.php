@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('My Address'))

@push('css_or_js')
    <link rel="stylesheet" media="screen"
          href="{{asset('assets/front-end')}}/vendor/nouislider/distribute/nouislider.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        .cz-sidebar-body h3:hover + .divider-role {
            border-bottom: 3px solid {{$web_config['primary_color']}} !important;
        }
        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            background-color: {{$web_config['primary_color']}};
        }

        .iconHad {
            color: {{$web_config['primary_color']}};
        }
        .namHad {
            padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 13px;
        }
        .donate-now li {
            margin: {{Session::get('direction') === "rtl" ? '0 0 0 5px' : '0 5px 0 0'}};
        }
        .donate-now input[type="radio"]:checked + label,
        .Checked + label {
            background: {{$web_config['primary_color']}};
        }

        .btn-light + .dropdown-menu{
            transform: none !important;
            top: 41px !important;
        }

        /* ===== Premium Address Form ===== */
        .address-form-box {
            border: 1px solid #E5E9F0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(17, 24, 39, .06);
            background: #FFFFFF;
            max-width: 1100px;
            margin: 0 auto;
        }
        .address-form-box .card-header {
            background: #FFFFFF;
            border-bottom: 1px solid #EEF1F6;
            padding: 22px 28px 18px;
            color: #1F2937;
        }
        .address-form-box .card-header .form-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            color: #111827;
            letter-spacing: -.01em;
        }
        .address-form-box .card-header .form-title i {
            color: {{$web_config['primary_color']}};
            font-size: 1rem;
        }
        .address-form-box .card-header .form-sub {
            font-size: .8rem;
            color: #6B7280;
            margin: 4px 0 0;
            font-weight: 400;
        }
        .address-form-box .card-body {
            padding: 28px;
        }
        .address-form-box form {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        /* Labels */
        .address-form-box .form-group > label {
            display: block;
            font-size: 13.5px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 7px;
            line-height: 1.4;
            letter-spacing: -.01em;
        }

        /* Inputs */
        .address-form-box .form-control {
            display: block;
            width: 100%;
            height: 50px;
            padding: 0 16px;
            font-size: 14.5px;
            font-weight: 400;
            line-height: 1.5;
            color: #1F2937;
            background-color: #FFFFFF;
            border: 1px solid #D9DEE7;
            border-radius: 11px;
            box-shadow: none;
            transition: border-color 180ms ease, box-shadow 180ms ease;
            -webkit-appearance: none;
            appearance: none;
        }
        .address-form-box .form-control::placeholder {
            color: #9CA3AF;
        }
        .address-form-box .form-control:hover:not(:disabled):not(.disabled) {
            border-color: #B8C0CC;
        }
        .address-form-box .form-control:focus,
        .address-form-box .form-control:focus-visible {
            outline: none;
            border-color: {{$web_config['primary_color']}};
            box-shadow: 0 0 0 3px rgba(17, 24, 39, .08);
            background-color: #FFFFFF;
        }
        .address-form-box .form-control:disabled,
        .address-form-box .form-control[readonly] {
            background-color: #F9FAFB;
            color: #6B7280;
        }
        .address-form-box .form-control.is-invalid,
        .address-form-box .form-control:invalid:not(:placeholder-shown):not(:focus) {
            border-color: #DC2626;
            box-shadow: none;
        }
        .address-form-box .form-control.is-valid {
            border-color: #16A34A;
        }

        /* Icon-adorned inputs */
        .address-form-box .input-icon-wrap {
            position: relative;
        }
        .address-form-box .input-icon-wrap > i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 15px;
            color: #9CA3AF;
            z-index: 3;
            pointer-events: none;
            transition: color 180ms ease;
        }
        .address-form-box .input-icon-wrap .form-control {
            padding-left: 42px;
        }
        .address-form-box .input-icon-wrap:focus-within > i {
            color: {{$web_config['primary_color']}};
        }

        /* Simple native select — same look as text inputs */
        .address-form-box select.form-control {
            height: 50px;
            padding: 0 40px 0 42px;
            font-size: 14.5px;
            color: #1F2937;
            background-color: #FFFFFF;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8' fill='none'%3E%3Cpath d='M1 1.5L6 6.5L11 1.5' stroke='%239CA3AF' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 12px 8px;
            border: 1px solid #D9DEE7;
            border-radius: 11px;
            box-shadow: none;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
            transition: border-color 180ms ease, box-shadow 180ms ease;
        }
        .address-form-box select.form-control:hover {
            border-color: #B8C0CC;
        }
        .address-form-box select.form-control:focus,
        .address-form-box select.form-control:focus-visible {
            outline: none;
            border-color: {{$web_config['primary_color']}};
            box-shadow: 0 0 0 3px rgba(17, 24, 39, .08);
            background-color: #FFFFFF;
        }
        .address-form-box select.form-control option {
            color: #1F2937;
            background: #FFFFFF;
            padding: 8px;
        }
        /* No icon variant (right padding only) */
        .address-form-box .form-group > select.form-control:not([class*="input-icon"]) {
            padding-left: 16px;
        }

        /* Textarea */
        .address-form-box textarea.form-control {
            min-height: 110px;
            height: auto;
            padding: 14px 16px;
            resize: vertical;
            line-height: 1.6;
        }

        /* Section labels (radio pills) */
        .address-form-box .form-section-label {
            font-size: 12.5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: #6B7280;
            margin-bottom: 10px;
        }

        /* Radio pill groups */
        .address-form-box .pill-group {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .address-form-box .pill-group li {
            margin: 0 !important;
        }
        .address-form-box .pill-group input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }
        .address-form-box .pill-group .component,
        .address-form-box .pill-group label.component {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 0 20px;
            font-size: 13.5px;
            font-weight: 500;
            border: 1px solid #D9DEE7;
            border-radius: 10px;
            background: #FFFFFF;
            color: #4B5563;
            cursor: pointer;
            transition: border-color 150ms ease, background 150ms ease, color 150ms ease, box-shadow 150ms ease;
            margin: 0 !important;
        }
        .address-form-box .pill-group .component:hover {
            border-color: #B8C0CC;
            color: #111827;
        }
        .address-form-box .pill-group input[type="radio"]:checked + .component {
            background: #111827 !important;
            border-color: #111827 !important;
            color: #FFFFFF !important;
            box-shadow: none;
        }
        .address-form-box .pill-group input[type="radio"]:focus-visible + .component {
            box-shadow: 0 0 0 3px rgba(17, 24, 39, .15);
        }

        .address-form-box .pill-divider {
            border: 0;
            border-top: 1px solid #EEF1F6;
            margin: 22px 0;
        }

        /* Country field — same as other fields, no nested box */
        .address-form-box .country-field {
            background: transparent;
            border: none;
            padding: 0;
            margin-bottom: 0;
            position: static;
        }
        .address-form-box .country-field label i {
            color: #9CA3AF;
            font-size: 13px;
            margin-right: 4px;
        }
        .address-form-box .country-field .field-icon {
            left: 15px !important;
            top: 50% !important;
            bottom: auto !important;
            transform: translateY(-50%);
            font-size: 14px;
            color: #9CA3AF;
            z-index: 4;
            pointer-events: none;
        }

        /* Form actions */
        .address-form-box .form-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            padding-top: 24px;
            margin-top: 4px;
            border-top: 1px solid #EEF1F6;
        }
        .address-form-box .form-actions .btn {
            height: 48px;
            border-radius: 11px;
            padding: 0 28px;
            font-size: 14.5px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background 150ms ease, border-color 150ms ease, box-shadow 150ms ease, color 150ms ease;
            letter-spacing: -.01em;
        }
        .address-form-box .form-actions .btn:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px rgba(17, 24, 39, .15);
        }
        .address-form-box .form-actions .btn--primary {
            background: {{$web_config['primary_color']}};
            border: 1px solid {{$web_config['primary_color']}};
            color: #FFFFFF;
        }
        .address-form-box .form-actions .btn--primary:hover {
            filter: brightness(.94);
            color: #FFFFFF;
        }
        .address-form-box .form-actions .btn-secondary {
            background: #FFFFFF;
            border: 1px solid #D9DEE7;
            color: #374151;
        }
        .address-form-box .form-actions .btn-secondary:hover {
            background: #F9FAFB;
            border-color: #B8C0CC;
            color: #111827;
        }

        /* Form grid responsive */
        .address-form-box .form-row {
            margin-left: -12px;
            margin-right: -12px;
        }
        .address-form-box .form-row .form-group {
            padding-left: 12px;
            padding-right: 12px;
            margin-bottom: 20px;
        }

        @media (max-width: 991.98px) {
            .address-form-box .card-body { padding: 24px 20px; }
            .address-form-box .card-header { padding: 18px 20px 14px; }
        }
        @media (max-width: 767.98px) {
            .address-form-box {
                border-radius: 14px;
                max-width: 100%;
            }
            .address-form-box .card-body { padding: 20px 16px; }
            .address-form-box .card-header { padding: 16px 16px 12px; }
            .address-form-box .form-row .form-group {
                padding-left: 0;
                padding-right: 0;
                margin-bottom: 18px;
            }
            .address-form-box .form-row .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
                width: 100%;
            }
            .address-form-box .form-actions {
                flex-direction: column-reverse;
                gap: 10px;
            }
            .address-form-box .form-actions .btn {
                width: 100%;
            }
            .address-form-box .pill-group {
                width: 100%;
            }
            .address-form-box .pill-group .component {
                flex: 1 1 auto;
                min-width: 0;
            }
        }
    </style>
@endpush

@section('content')
<div class="container py-5  rtl __account-address" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
  
    <div class="row">
        <!-- Sidebar-->
    @include('web-views.partials._profile-aside')
    <section class="col-lg-9 col-md-9">

            <div class="card address-form-box">
                <div class="card-header d-flex align-items-center">
                    <div>
                        <div class="form-title"><i class="fa fa-map-marker mr-2"></i>{{\App\CPU\translate('UPDATE_ADDRESSES')}}</div>
                        <div class="form-sub">{{\App\CPU\translate('address')}} #{{$shippingAddress->id}}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-12 p-0">
                        <form action="{{route('address-update')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$shippingAddress->id}}">
                            <div class="row pb-1">
                                <div class="col-md-6">
                                    <div class="form-section-label">{{\App\CPU\translate('address_type')}}</div>
                                    <ul class="pill-group">
                                        <li class="address_type_li">
                                            <input type="radio" class="address_type" id="a25" name="addressAs" value="permanent"  {{ $shippingAddress->address_type == 'permanent' ? 'checked' : ''}} />
                                            <label for="a25" class="component">{{\App\CPU\translate('permanent')}}</label>
                                        </li>
                                        <li class="address_type_li">
                                            <input type="radio" class="address_type" id="a50" name="addressAs" value="home" {{ $shippingAddress->address_type == 'home' ? 'checked' : ''}} />
                                            <label for="a50" class="component">{{\App\CPU\translate('Home')}}</label>
                                        </li>
                                        <li class="address_type_li">
                                            <input type="radio" class="address_type" id="a75" name="addressAs" value="office" {{ $shippingAddress->address_type == 'office' ? 'checked' : ''}}/>
                                            <label for="a75" class="component">{{\App\CPU\translate('Office')}}</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-section-label">{{\App\CPU\translate('address_usage')}}</div>
                                    <ul class="pill-group">
                                        <li class="address_type_bl">
                                            <input type="radio" class="bill_type" id="b25" name="is_billing" value="0"  {{ $shippingAddress->is_billing == '0' ? 'checked' : ''}} />
                                            <label for="b25" class="component">{{\App\CPU\translate('shipping')}}</label>
                                        </li>
                                        <li class="address_type_bl">
                                            <input type="radio" class="bill_type" id="b50" name="is_billing" value="1" {{ $shippingAddress->is_billing == '1' ? 'checked' : ''}} />
                                            <label for="b50" class="component">{{\App\CPU\translate('billing')}}</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <hr class="pill-divider">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="person_name">{{\App\CPU\translate('contact_person_name')}}</label>
                                    <div class="input-icon-wrap">
                                        <i class="fa fa-user"></i>
                                        <input class="form-control" type="text" id="person_name"
                                            name="name"
                                            value="{{$shippingAddress->contact_person_name}}"
                                            placeholder="{{\App\CPU\translate('contact_person_name')}}"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="own_phone">{{\App\CPU\translate('Phone')}}</label>
                                    <div class="input-icon-wrap">
                                        <i class="fa fa-phone"></i>
                                        <input class="form-control" type="text" id="own_phone" name="phone" value="{{$shippingAddress->phone}}" placeholder="{{\App\CPU\translate('Phone')}}" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="city">{{\App\CPU\translate('City')}}</label>
                                    <div class="input-icon-wrap">
                                        <i class="fa fa-building-o"></i>
                                        <input class="form-control" type="text" id="city" name="city" value="{{$shippingAddress->city}}" placeholder="{{\App\CPU\translate('City')}}" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="zip_code">{{\App\CPU\translate('zip_code')}}</label>
                                    @if($zip_restrict_status)
                                        <div class="input-icon-wrap">
                                            <i class="fa fa-hashtag"></i>
                                            <select name="zip" class="form-control" id="zip_code" required>
                                                @foreach($delivery_zipcodes as $zip)
                                                    <option value="{{ $zip->zipcode }}" {{ $zip->zipcode == $shippingAddress->zip? 'selected' : ''}}>{{ $zip->zipcode }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <div class="input-icon-wrap">
                                            <i class="fa fa-hashtag"></i>
                                            <input class="form-control" type="text" id="zip_code" name="zip" value="{{$shippingAddress->zip}}" placeholder="{{\App\CPU\translate('zip_code')}}" required>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12 country-field">
                                    <label for="country_select"><i class="fa fa-globe"></i>{{\App\CPU\translate('Country')}}</label>
                                    <div class="input-icon-wrap">
                                        <i class="fa fa-map-marker field-icon"></i>
                                        <select name="country" id="country_select" class="form-control" required>
                                            @if($country_restrict_status)
                                                @foreach($delivery_countries as $country)
                                                    <option value="{{$country['name']}}" {{ $country['name'] == $shippingAddress->country? 'selected' : ''}}>{{$country['name']}}</option>
                                                @endforeach
                                            @else
                                                @foreach(COUNTRIES as $country)
                                                    <option value="{{ $country['name'] }}" {{ $shippingAddress->country == $country['name']? 'selected' : '' }}>{{ $country['name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="address">{{\App\CPU\translate('address')}}</label>
                                    <textarea class="form-control" id="address"
                                        name="address" placeholder="{{\App\CPU\translate('address')}}" required>{{$shippingAddress->address}}</textarea>
                                </div>
                            </div>
                            @php($shipping_latitude=$shippingAddress->latitude)
                            @php($shipping_longitude=$shippingAddress->longitude)
                            <input type="hidden" id="latitude"
                                name="latitude" class="form-control d-inline"
                                placeholder="Ex : -94.22213" value="{{$shipping_latitude??0}}" required readonly>
                            <input type="hidden"
                                name="longitude" class="form-control"
                                placeholder="Ex : 103.344322" id="longitude" value="{{$shipping_longitude??0}}" required readonly>
                            <div class="form-actions">
                                <a href="{{ route('account-address') }}" class="closeB btn btn-secondary">{{\App\CPU\translate('close')}}</a>
                                <button type="submit" class="btn btn--primary">{{\App\CPU\translate('update')}}  </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    </section>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).on("keydown", "input", function(e) {
      if (e.which==13) e.preventDefault();
    });
</script>
@endpush

