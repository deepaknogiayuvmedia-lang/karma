@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('Shipping Address Choose'))

@push('css_or_js')
    <link rel="stylesheet" href="{{ asset('assets/front-end/css/bootstrap-select.min.css') }}">

    <style>
        .btn-outline {
            border-color: {{$web_config['primary_color']}} ;
        }

        .btn-outline {
            border-color: {{$web_config['primary_color']}}    !important;
        }

        .btn-outline:hover {
            background: {{$web_config['primary_color']}};

        }

        .btn-outline:focus {
            border-color: {{$web_config['primary_color']}}    !important;
        }

        /*#location_map_canvas {*/
        /*    height: 100%;*/
        /*}*/

        .filter-option{
            display: block;
            width: 100%;
            height: calc(1.5em + 1.25rem + 2px);
            padding: 0.625rem 1rem;
            font-size: .9375rem;
            font-weight: 400;
            line-height: 1.5;
            color: #4b566b;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #dae1e7;
            border-radius: 0.3125rem;
            box-shadow: 0 0 0 0 transparent;
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .btn-light + .dropdown-menu{
            transform: none !important;
            top: 41px !important;
        }

        .checkout-address-form {
            border: 0;
            background: transparent;
            box-shadow: none;
        }

        .checkout-address-section-head {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 2rem 0 1rem;
        }

        .checkout-address-section-icon {
            display: flex;
            flex: 0 0 42px;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #edf7ef;
            color: #168a3a;
            font-size: 18px;
        }

        .checkout-address-section-head h2 {
            margin: 0 0 3px;
            color: #1b1f1d;
            font-size: 1.15rem;
            font-weight: 700;
        }

        .checkout-address-section-head p {
            margin: 0;
            color: #66706a;
            font-size: .83rem;
        }

        .checkout-billing-section-head {
            margin-top: 1.75rem;
        }

        .checkout-same-address {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0 0 12px;
            padding: 14px 16px;
            border: 1px solid #dce8df;
            border-radius: 11px;
            background: #f5fbf6;
            cursor: pointer;
        }

        .checkout-same-address input {
            flex: 0 0 18px;
            width: 18px;
            height: 18px;
            margin: 0;
            accent-color: #168a3a;
        }

        .checkout-same-address-copy {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .checkout-same-address-copy strong {
            color: #1b1f1d;
            font-size: 14px;
        }

        .checkout-same-address-copy span {
            color: #66706a;
            font-size: 12px;
        }

        .checkout-billing-form {
            margin-bottom: 0;
        }

        .checkout-address-list {
            display: grid;
            gap: 12px;
            padding: 14px;
            margin: 0;
            list-style: none;
            background: #f7f9f8;
            border-radius: 14px;
        }

        .checkout-address-option {
            position: relative;
            padding: 18px 54px 18px 18px;
            border: 1px solid #e4e9e6;
            border-radius: 12px;
            background: #fff;
            cursor: pointer;
            transition: border-color .18s ease, box-shadow .18s ease, background .18s ease;
        }

        .checkout-address-option:hover {
            border-color: #9ac9a8;
            box-shadow: 0 5px 16px rgba(22, 138, 58, .08);
        }

        .checkout-address-option.is-selected,
        .checkout-new-address.is-selected {
            border-color: #168a3a;
            background: #f5fbf6;
            box-shadow: 0 0 0 2px rgba(22, 138, 58, .1);
        }

        .checkout-address-radio {
            position: absolute;
            top: 20px;
            inset-inline-end: 18px;
            width: 18px;
            height: 18px;
            accent-color: #168a3a;
            cursor: pointer;
        }

        .checkout-address-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 12px;
        }

        .checkout-address-type {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 10px;
            border-radius: 999px;
            background: #edf7ef;
            color: #176b32;
            font-size: 12px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .checkout-address-edit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: #f1f4f2;
            color: #45534a;
        }

        .checkout-address-edit:hover {
            background: #168a3a;
            color: #fff;
        }

        .checkout-address-name {
            margin-bottom: 5px;
            color: #1b1f1d;
            font-size: 15px;
            font-weight: 700;
        }

        .checkout-address-phone {
            margin-bottom: 9px;
            color: #66706a;
            font-size: 13px;
        }

        .checkout-address-location {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            color: #48534c;
            font-size: 13px;
            line-height: 1.55;
        }

        .checkout-address-location i {
            margin-top: 3px;
            color: #168a3a;
        }

        .checkout-new-address {
            position: relative;
            padding: 14px;
            border: 1px dashed #aebbb2;
            border-radius: 12px;
            background: #fff;
        }

        .checkout-new-address-toggle {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #168a3a;
            border-radius: 9px;
            background: #fff;
            color: #168a3a;
            font-weight: 700;
            text-align: left;
        }

        .checkout-new-address-toggle:hover,
        .checkout-new-address-toggle:focus {
            background: #f2faf4;
            color: #126d2e;
        }

        .checkout-new-address .card-body {
            padding: 18px 4px 4px;
        }

        @media (max-width: 575.98px) {
            .checkout-address-list {
                gap: 9px;
                padding: 10px;
            }

            .checkout-address-option {
                padding: 15px 45px 15px 14px;
            }

            .checkout-address-radio {
                top: 17px;
                inset-inline-end: 14px;
            }
        }

        /*@media only screen and (max-width: 768px) {*/
        /*    !* For mobile phones: *!*/
        /*    #location_map_canvas {*/
        /*        height: 200px;*/
        /*    }*/
        /*}*/
    </style>
@endpush

@section('content')
@php($billing_input_by_customer=\App\CPU\Helpers::get_business_settings('billing_input_by_customer'))
@php($checkout_customer=auth('customer')->user())
    <div class="container pb-5 mb-2 mb-md-4 rtl __inline-56"
         style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="row">
            <div class="col-md-12 mb-5 pt-5">
                <div class="feature_header">
                    <span>{{ \App\CPU\translate('shipping')}} {{$billing_input_by_customer==1?\App\CPU\translate('and').' '.\App\CPU\translate('billing'):' '}} {{\App\CPU\translate('address')}}</span>
                </div>
            </div>
            <section class="col-lg-8">
               
                <div class="checkout_details">
                    <!-- Steps-->
                    @include('web-views.partials._checkout-steps',['step'=>2])
                    @php($default_location=\App\CPU\Helpers::get_business_settings('default_location'))
                    <input type="hidden" id="physical_product" name="physical_product" value="{{ $physical_product_view ? 'yes':'no'}}">

                    <!-- Shipping methods table-->
                    @if($physical_product_view)
                        <div class="checkout-address-section-head">
                            <span class="checkout-address-section-icon"><i class="fa fa-map-marker"></i></span>
                            <div>
                                <h2>{{ \App\CPU\translate('choose_shipping_address')}}</h2>
                                <p>{{ \App\CPU\translate('Select where you would like your order delivered')}}</p>
                            </div>
                        </div>
                        @php($shipping_addresses=\App\Model\ShippingAddress::where('customer_id',auth('customer')->id())->where('is_billing',0)->get())

                        <div class="d-none" aria-hidden="true">
                            <input type="hidden" id="checkout_pincode_input"
                                   value="{{ session('delhivery_pincode') ?? ($shipping_addresses->first()->zip ?? '') }}">
                            <button type="button" id="checkout_calc_shipping_btn"></button>
                            <div id="checkout_shipping_result"
                                 data-serviceable="{{ session()->has('delhivery_shipping_cost') ? '1' : '0' }}"
                                 data-pincode="{{ session('delhivery_pincode') ?? '' }}"></div>
                        </div>

                        <form method="post" class="card __card checkout-address-form" id="address-form">
                                <ul class="checkout-address-list">
                                    @foreach($shipping_addresses as $key=>$address)
                                        <li class="checkout-address-option {{$key==0?'is-selected':''}}" onclick="$('#sh-{{$address['id']}}').prop('checked', true).trigger('change')">
                                            <input class="checkout-address-radio" type="radio" name="shipping_method_id"
                                                   id="sh-{{$address['id']}}"
                                                   value="{{$address['id']}}" data-pincode="{{$address['zip']}}"
                                                   {{$key==0?'checked':''}}>
                                            <div class="checkout-address-content">
                                                <div class="checkout-address-head">
                                                    <span class="checkout-address-type">
                                                        <i class="fa fa-{{ strtolower($address['address_type']) === 'home' ? 'home' : 'briefcase' }}"></i>
                                                        {{$address['address_type']}}
                                                    </span>
                                                    <a href="{{ route('address-edit', ['id' => $address->id]) }}"
                                                       title="{{ \App\CPU\translate('edit_address') }}"
                                                       class="checkout-address-edit"
                                                       onclick="event.stopPropagation()">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </div>
                                                <div class="checkout-address-name">{{$address['contact_person_name']}}</div>
                                                <div class="checkout-address-phone"><i class="fa fa-phone mr-1"></i>{{$address['phone']}}</div>
                                                <div class="checkout-address-location">
                                                    <i class="fa fa-map-marker"></i>
                                                    <span>{{$address['address']}}, {{$address['city']}}, {{$address['state']}}, {{$address['zip']}}, {{$address['country']}}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                    <li class="checkout-new-address {{$shipping_addresses->count()==0?'is-selected':''}}">
                                        <input class="checkout-address-radio" type="radio" name="shipping_method_id"
                                               id="sh-0" value="0" data-pincode=""
                                               {{$shipping_addresses->count()==0?'checked':''}}>

                                        <button type="button" class="checkout-new-address-toggle" onclick="anotherAddress()" data-toggle="collapse"
                                                data-target="#collapseThree"><i class="fa fa-plus-circle mr-2"></i>{{ \App\CPU\translate('Another')}} {{ \App\CPU\translate('address')}}
                                        </button>
                                        <div id="accordion">
                                            <div id="collapseThree"
                                                 class="collapse {{$shipping_addresses->count()==0?'show':''}}"
                                                 aria-labelledby="headingThree"
                                                 data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="exampleInputEmail1">{{ \App\CPU\translate('contact_person_name')}}
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                                name="contact_person_name"
                                                                value="{{ old('contact_person_name', trim(($checkout_customer->f_name ?? '') . ' ' . ($checkout_customer->l_name ?? ''))) }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">{{ \App\CPU\translate('Phone')}}
                                                            <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                                name="phone"
                                                                value="{{ old('phone', $checkout_customer->phone ?? '') }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="exampleInputPassword1">{{ \App\CPU\translate('address')}} {{ \App\CPU\translate('Type')}}</label>
                                                        <select class="form-control" name="address_type">
                                                            
                                                            <option value="home">{{ \App\CPU\translate('Home')}}</option>
                                                            <option
                                                                value="others">{{ \App\CPU\translate('Others')}}</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">{{ \App\CPU\translate('City')}}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                               name="city">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">{{ \App\CPU\translate('State')}}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                               name="state">
                                                    </div>

                                                     <div class="form-group col-md-6">
                                                        <label
                                                            for="exampleInputEmail1">{{ \App\CPU\translate('zip_code')}}
                                                            <span
                                                                class="text-danger">*</span></label>
                                                        @if($zip_restrict_status == 1)
                                                            <select name="zip" class="form-control selectpicker" data-live-search="true">
                                                                @forelse($zip_codes as $code)
                                                                <option value="{{ $code->zipcode }}">{{ $code->zipcode }}</option>
                                                                @empty
                                                                    <option value="">{{ \App\CPU\translate('No_zip_to_deliver') }}</option>
                                                                @endforelse
                                                            </select>
                                                         @else
                                                         <div class="input-group">
                                                             <input type="text" class="form-control"
                                                                    name="zip"
                                                                    maxlength="6"
                                                                    placeholder="{{ \App\CPU\translate('Enter pincode') }}"
                                                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                                                    >
                                                         </div>
                                                         @endif
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="exampleInputEmail1">{{ \App\CPU\translate('Country')}}
                                                            <span
                                                                style="color: red">*</span></label>
                                                        <select name="country" id="" class="form-control selectpicker" data-live-search="true">
                                                            @forelse($countries as $country)
                                                                <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                                            @empty
                                                                <option value="">{{ \App\CPU\translate('No_country_to_deliver') }}</option>
                                                            @endforelse
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-12">
                                                        <label
                                                            for="exampleInputEmail1">{{ \App\CPU\translate('address')}}<span
                                                                class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="address"
                                                                  type="text"
                                                                  name="address">{{ old('address', $checkout_customer->farm_address ?? '') }}</textarea>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <input type="hidden" id="pac-input">
                                                        <div class="__h-200px" id="location_map_canvas"></div>
                                                    </div>
                                                     <div class="form-check col-12" style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 1.25rem;">
                                                        <input type="checkbox" name="save_address" class="form-check-input"
                                                               id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1" style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 1.09rem">
                                                            {{ \App\CPU\translate('save_this_address')}}
                                                        </label>
                                                    </div>
                                                    <input type="hidden" id="latitude"
                                                           name="latitude" class="form-control d-inline"
                                                           placeholder="Ex : -94.22213"
                                                           value="{{$default_location?$default_location['lat']:0}}">
                                                    <input type="hidden"
                                                           name="longitude" class="form-control"
                                                           placeholder="Ex : 103.344322" id="longitude"
                                                           value="{{$default_location?$default_location['lng']:0}}">

                                                    <button type="submit" class="btn btn--primary" style="display: none"
                                                            id="address_submit"></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    @endif

                    <div style="display: {{$billing_input_by_customer?'':'none'}}">
                        <!-- billing methods table-->
                        <div class="checkout-address-section-head checkout-billing-section-head">
                            <span class="checkout-address-section-icon"><i class="fa fa-file-text-o"></i></span>
                            <div>
                                <h2>{{ \App\CPU\translate('choose_billing_address')}}</h2>
                                <p>{{ \App\CPU\translate('Choose a billing address or use your shipping address')}}</p>
                            </div>
                        </div>

                        @php($billing_addresses=\App\Model\ShippingAddress::where('customer_id',auth('customer')->id())->where('is_billing',1)->get())
                        @if($physical_product_view)
                            <label class="checkout-same-address" for="same_as_shipping_address">
                                <input type="checkbox" checked id="same_as_shipping_address" onclick="hide_billingAddress()"
                                    name="same_as_shipping_address" {{$billing_input_by_customer==1?'':'checked'}}>
                                <span class="checkout-same-address-copy">
                                    <strong>{{ \App\CPU\translate('same_as_shipping_address')}}</strong>
                                    <span>{{ \App\CPU\translate('Use the selected delivery address for billing')}}</span>
                                </span>
                            </label>
                        @endif
                        <form method="post" class="card __card checkout-address-form checkout-billing-form" id="billing-address-form">
                            <div id="hide_billing_address" style="display: none;">
                                <ul class="checkout-address-list">
                                    @foreach($billing_addresses as $key=>$address)

                                        <li class="checkout-address-option" onclick="$('#bh-{{$address['id']}}').prop('checked', true).trigger('change')">
                                            <input class="checkout-address-radio" type="radio" name="billing_method_id"
                                                id="bh-{{$address['id']}}"
                                                value="{{$address['id']}}">
                                            <div class="checkout-address-content">
                                                <div class="checkout-address-head">
                                                    <span class="checkout-address-type">
                                                        <i class="fa fa-{{ strtolower($address['address_type']) === 'home' ? 'home' : 'briefcase' }}"></i>
                                                        {{$address['address_type']}}
                                                    </span>
                                                    <a href="{{ route('address-edit', ['id' => $address->id]) }}"
                                                       title="{{ \App\CPU\translate('edit_address') }}"
                                                       class="checkout-address-edit"
                                                       onclick="event.stopPropagation()">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </div>
                                                <div class="checkout-address-name">{{$address['contact_person_name']}}</div>
                                                <div class="checkout-address-phone"><i class="fa fa-phone mr-1"></i>{{$address['phone']}}</div>
                                                <div class="checkout-address-location">
                                                    <i class="fa fa-map-marker"></i>
                                                    <span>{{$address['address']}}, {{$address['city']}}, {{$address['state']}}, {{$address['zip']}}, {{$address['country']}}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                    <li class="checkout-new-address {{$billing_addresses->count()==0?'is-selected':''}}">
                                        <input class="checkout-address-radio" type="radio" name="billing_method_id"
                                            id="bh-0" value="0" checked>

                                        <button type="button" class="checkout-new-address-toggle" onclick="billingAddress()" data-toggle="collapse"
                                                data-target="#billing_model"><i class="fa fa-plus-circle mr-2"></i>{{ \App\CPU\translate('Another')}} {{ \App\CPU\translate('address')}}
                                        </button>
                                        <div id="accordion">
                                            <div id="billing_model"
                                                class="collapse {{$billing_addresses->count()==0?'show':''}}"
                                                aria-labelledby="headingThree"
                                                data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="exampleInputEmail1">{{ \App\CPU\translate('contact_person_name')}}
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                        name="billing_contact_person_name"
                                                        value="{{ old('billing_contact_person_name', trim(($checkout_customer->f_name ?? '') . ' ' . ($checkout_customer->l_name ?? ''))) }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">{{ \App\CPU\translate('Phone')}}
                                                            <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="billing_phone"
                                                            value="{{ old('billing_phone', $checkout_customer->phone ?? '') }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="exampleInputPassword1">{{ \App\CPU\translate('address')}} {{ \App\CPU\translate('Type')}}</label>
                                                        <select class="form-control" name="billing_address_type">
                                                            
                                                            <option value="home">{{ \App\CPU\translate('Home')}}</option>
                                                            <option
                                                                value="others">{{ \App\CPU\translate('Others')}}</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">{{ \App\CPU\translate('City')}}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="billing_city">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">{{ \App\CPU\translate('State')}}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="billing_state">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="exampleInputEmail1">{{ \App\CPU\translate('zip_code')}}
                                                            <span class="text-danger">*</span></label>
                                                        @if($zip_restrict_status)
                                                            <select name="billing_zip" id="" class="form-control selectpicker" data-live-search="true">
                                                                @foreach($zip_codes as $code)
                                                                    <option value="{{ $code->zipcode }}">{{ $code->zipcode }}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <input type="text" class="form-control"
                                                                   name="billing_zip">
                                                        @endif

                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="exampleInputEmail1">{{ \App\CPU\translate('Country')}}
                                                            <span style="color: red">*</span></label>
                                                        <select name="billing_country" id="" class="form-control selectpicker" data-live-search="true">
                                                            @foreach($countries as $country)
                                                                <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-12">
                                                        <label
                                                            for="exampleInputEmail1">{{ \App\CPU\translate('address')}}<span
                                                                class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="billing_address"
                                                                type="billing_text"
                                                                name="billing_address">{{ old('billing_address', $checkout_customer->farm_address ?? '') }}</textarea>
                                                    </div>

                                                    <div class="form-group col-12">
                                                        <input type="hidden" id="pac-input-billing">
                                                        <div class="__h-200px" id="location_map_canvas_billing"></div>
                                                    </div>
                                                    <div class="form-check col-12" style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 1.25rem;">
                                                        <input type="checkbox" name="save_address_billing" class="form-check-input"
                                                            id="save_address_billing">
                                                        <label class="form-check-label" for="save_address_billing" style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 1.09rem">
                                                            {{ \App\CPU\translate('save_this_address')}}
                                                        </label>
                                                    </div>
                                                    <input type="hidden" id="billing_latitude"
                                                        name="billing_latitude" class="form-control d-inline"
                                                        placeholder="Ex : -94.22213"
                                                        value="{{$default_location?$default_location['lat']:0}}"
                                                        readonly>
                                                    <input type="hidden"
                                                        name="billing_longitude" class="form-control"
                                                        placeholder="Ex : 103.344322" id="billing_longitude"
                                                        value="{{$default_location?$default_location['lng']:0}}"
                                                        readonly>

                                                    <button type="submit" class="btn btn--primary" style="display: none"
                                                            id="address_submit"></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>




                    <!-- Navigation (desktop)-->
                    <div class="row mt-3">
                        <div class="col-6">
                            <a class="btn btn-secondary btn-block" href="{{route('shop-cart')}}">
                                <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'right' : 'left'}} mt-sm-0 mx-1"></i>
                                <span class="d-none d-sm-inline">{{ \App\CPU\translate('shop_cart')}}</span>
                                <span class="d-inline d-sm-none">{{ \App\CPU\translate('shop_cart')}}</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn--primary btn-block" href="javascript:" onclick="proceed_to_next()">
                                <span class="d-none d-sm-inline">{{ \App\CPU\translate('proceed_payment')}}</span>
                                <span class="d-inline d-sm-none">{{ \App\CPU\translate('Next')}}</span>
                                <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} mt-sm-0 mx-1"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Sidebar-->
                
            </section>
            @include('web-views.partials._order-summary')
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/front-end/js/bootstrap-select.min.js') }}"></script>
    <script>
        function anotherAddress() {
            $('#sh-0').prop('checked', true).trigger('change');
        }

        function billingAddress() {
            $('#bh-0').prop('checked', true).trigger('change');
        }

    </script>
    <script>
        function hide_billingAddress() {
            let check_same_as_shippping = $('#same_as_shipping_address').is(":checked");
            console.log(check_same_as_shippping);
            if (check_same_as_shippping) {
                $('#hide_billing_address').hide();
            } else {
                $('#hide_billing_address').show();
            }
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{\App\CPU\Helpers::get_business_settings('map_api_key')}}&libraries=places&v=3.49" defer></script>
    <script>
        function initAutocomplete() {
            var myLatLng = {
                lat: {{$default_location?$default_location['lat']:'-33.8688'}},
                lng: {{$default_location?$default_location['lng']:'151.2195'}}
            };

            const map = new google.maps.Map(document.getElementById("location_map_canvas"), {
                center: {
                    lat: {{$default_location?$default_location['lat']:'-33.8688'}},
                    lng: {{$default_location?$default_location['lng']:'151.2195'}}
                },
                zoom: 13,
                mapTypeId: "roadmap",
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
            });

            marker.setMap(map);
            var geocoder = geocoder = new google.maps.Geocoder();
            google.maps.event.addListener(map, 'click', function (mapsMouseEvent) {
                var coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                var coordinates = JSON.parse(coordinates);
                var latlng = new google.maps.LatLng(coordinates['lat'], coordinates['lng']);
                marker.setPosition(latlng);
                map.panTo(latlng);

                document.getElementById('latitude').value = coordinates['lat'];
                document.getElementById('longitude').value = coordinates['lng'];

                geocoder.geocode({'latLng': latlng}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[1]) {
                            document.getElementById('address').value = results[1].formatted_address;
                            console.log(results[1].formatted_address);
                        }
                    }
                });
            });

            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });
            let markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var mrkr = new google.maps.Marker({
                        map,
                        title: place.name,
                        position: place.geometry.location,
                    });

                    google.maps.event.addListener(mrkr, "click", function (event) {
                        document.getElementById('latitude').value = this.position.lat();
                        document.getElementById('longitude').value = this.position.lng();

                    });

                    markers.push(mrkr);

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        };
        $(document).on('ready', function () {
            initAutocomplete();

        });

        $(document).on("keydown", "input", function (e) {
            if (e.which == 13) e.preventDefault();
        });
    </script>

    <script>
        function initAutocompleteBilling() {
            var myLatLng = {
                lat: {{$default_location?$default_location['lat']:'-33.8688'}},
                lng: {{$default_location?$default_location['lng']:'151.2195'}}
            };

            const map = new google.maps.Map(document.getElementById("location_map_canvas_billing"), {
                center: {
                    lat: {{$default_location?$default_location['lat']:'-33.8688'}},
                    lng: {{$default_location?$default_location['lng']:'151.2195'}}
                },
                zoom: 13,
                mapTypeId: "roadmap",
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
            });

            marker.setMap(map);
            var geocoder = geocoder = new google.maps.Geocoder();
            google.maps.event.addListener(map, 'click', function (mapsMouseEvent) {
                var coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                var coordinates = JSON.parse(coordinates);
                var latlng = new google.maps.LatLng(coordinates['lat'], coordinates['lng']);
                marker.setPosition(latlng);
                map.panTo(latlng);

                document.getElementById('billing_latitude').value = coordinates['lat'];
                document.getElementById('billing_longitude').value = coordinates['lng'];

                geocoder.geocode({'latLng': latlng}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[1]) {
                            document.getElementById('billing_address').value = results[1].formatted_address;
                            console.log(results[1].formatted_address);
                        }
                    }
                });
            });

            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input-billing");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });
            let markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var mrkr = new google.maps.Marker({
                        map,
                        title: place.name,
                        position: place.geometry.location,
                    });

                    google.maps.event.addListener(mrkr, "click", function (event) {
                        document.getElementById('billing_latitude').value = this.position.lat();
                        document.getElementById('billing_longitude').value = this.position.lng();

                    });

                    markers.push(mrkr);

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        };
        $(document).on('ready', function () {
            initAutocompleteBilling();

        });

        $(document).on("keydown", "input", function (e) {
            if (e.which == 13) e.preventDefault();
        });
    </script>
    <script>
        var shippingAddressFields = [
            '[name="contact_person_name"]',
            '[name="phone"]',
            '[name="city"]',
            '[name="state"]',
            '[name="zip"]',
            '[name="country"]',
            '[name="address"]'
        ];
        var billingAddressFields = [
            '[name="billing_contact_person_name"]',
            '[name="billing_phone"]',
            '[name="billing_city"]',
            '[name="billing_state"]',
            '[name="billing_zip"]',
            '[name="billing_country"]',
            '[name="billing_address"]'
        ];

        function updateAddressRequirements(formSelector, fields, required) {
            fields.forEach(function(selector) {
                $(formSelector).find(selector).prop('required', required);
            });
        }

        function validateAddressFields(formSelector, fields) {
            var $invalid = $();
            fields.some(function(selector) {
                var $field = $(formSelector).find(selector);
                if (!$field.length || !$field.val() || !$field.val().toString().trim()) {
                    $invalid = $field;
                    return true;
                }
                return false;
            });

            if (!$invalid.length) return true;

            var $collapse = $invalid.closest('.collapse');
            if ($collapse.length) $collapse.collapse('show');
            toastr.warning('{{ \App\CPU\translate("Please fill all required address fields") }}');
            window.setTimeout(function() {
                $invalid.trigger('focus');
            }, 250);
            return false;
        }

        function updateCheckoutAddressRequirements() {
            var useNewShippingAddress = $('#address-form input[name="shipping_method_id"]:checked').val() === '0';
            updateAddressRequirements('#address-form', shippingAddressFields, useNewShippingAddress);

            var useNewBillingAddress = !$('#same_as_shipping_address').is(':checked')
                && $('#billing-address-form input[name="billing_method_id"]:checked').val() === '0';
            updateAddressRequirements('#billing-address-form', billingAddressFields, useNewBillingAddress);
        }

        function proceed_to_next() {
            let physical_product = $('#physical_product').val();

            if(physical_product === 'yes') {
                var selectedShippingAddress = $('#address-form input[name="shipping_method_id"]:checked');
                var useNewShippingAddress = selectedShippingAddress.val() === '0';
                var billing_addresss_same_shipping = $('#same_as_shipping_address').is(":checked");

                updateCheckoutAddressRequirements();

                if (!selectedShippingAddress.length
                    || (useNewShippingAddress && !validateAddressFields('#address-form', shippingAddressFields))) {
                    return;
                }

                if (!billing_addresss_same_shipping
                    && $('#billing-address-form input[name="billing_method_id"]:checked').val() === '0'
                    && !validateAddressFields('#billing-address-form', billingAddressFields)) {
                    return;
                }

                var addressPincode = selectedShippingAddress.val() === '0'
                    ? ($('#address-form [name="zip"]').val() || '').trim()
                    : String(selectedShippingAddress.data('pincode') || '').trim();

                if ($('#checkout_shipping_result').attr('data-serviceable') !== '1'
                    || $('#checkout_pincode_input').val().trim() !== $('#checkout_shipping_result').attr('data-pincode')
                    || $('#checkout_pincode_input').val().trim() !== addressPincode) {
                    toastr.warning('{{ \App\CPU\translate("Please check shipping cost for your pincode first") }}');
                    return;
                }

            }else {
                var billing_addresss_same_shipping = false;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('customer.choose-shipping-address')}}',
                data: {
                    physical_product: physical_product,
                    shipping: physical_product === 'yes' ? $('#address-form').serialize() : null,
                    billing: $('#billing-address-form').serialize(),
                    billing_addresss_same_shipping: billing_addresss_same_shipping
                },

                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    if (data.errors) {
                        var errorMessage = Array.isArray(data.errors)
                            ? data.errors.map(function(error) { return error.message || error; }).join('<br>')
                            : data.errors;
                        toastr.error(errorMessage, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    } else {
                        location.href = '{{route('checkout-payment')}}';
                    }
                },
                complete: function () {
                    $('#loading').hide();
                },
                error: function (data) {
                    let error_msg = data.responseJSON && data.responseJSON.errors
                        ? data.responseJSON.errors
                        : '{{ \App\CPU\translate("Unable to validate address. Please check the entered details.") }}';
                    if (typeof error_msg === 'object') {
                        error_msg = Object.values(error_msg).flat().join('<br>');
                    }
                    toastr.error(error_msg, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });


        }
    </script>

    <script>
        // Calculate Shipping on Checkout
        $('#checkout_calc_shipping_btn').on('click', function() {
            let pincode = $('#checkout_pincode_input').val().trim();
            if (pincode === '' || pincode.length !== 6) {
                toastr.warning('{{ \App\CPU\translate("Please enter a valid 6-digit pincode") }}');
                return;
            }
            let $btn = $(this);
            $btn.attr('disabled', true).html('<i class="fa fa-spinner fa-spin mr-1"></i> {{ \App\CPU\translate("Checking...") }}');
            $('#checkout_shipping_result').hide();

            $.ajax({
                type: "POST",
                url: '{{ route("calculate-shipping") }}',
                headers: {'Cache-Control': 'no-cache'},
                data: {
                    _token: '{{ csrf_token() }}',
                    pincode: pincode
                },
                success: function(response) {
                    $btn.removeAttr('disabled').html('<i class="fa fa-truck mr-1"></i> {{ \App\CPU\translate("Check") }}');
                    if ($('#checkout_pincode_input').val().trim() !== pincode) return;
                    if (response.status === 'success' && response.serviceable) {
                        $('#checkout_shipping_result')
                            .attr('data-serviceable', '1')
                            .attr('data-pincode', pincode);
                        let codBadge = response.cod_available
                            ? '<div style="display:flex; align-items:center; justify-content:space-between;">'
                            + '<span style="font-size:12px; color:#66706A;">{{ \App\CPU\translate("Cash on Delivery") }}</span>'
                            + '<span style="font-size:12px; font-weight:600; color:#168A3A;"><i class="fa fa-check-circle mr-1"></i>{{ \App\CPU\translate("Available") }}</span>'
                            + '</div>'
                            : '<div style="display:flex; align-items:center; justify-content:space-between;">'
                            + '<span style="font-size:12px; color:#66706A;">{{ \App\CPU\translate("Cash on Delivery") }}</span>'
                            + '<span style="font-size:12px; font-weight:600; color:#dc2626;"><i class="fa fa-times-circle mr-1"></i>{{ \App\CPU\translate("Not Available") }}</span>'
                            + '</div>';

                        let html = '<div style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:8px; padding:12px;">'
                            + '<div style="display:flex; align-items:center; gap:6px; margin-bottom:8px;">'
                            + '<i class="fa fa-check-circle" style="color:#16a34a; font-size:14px;"></i>'
                            + '<span style="font-size:12px; font-weight:600; color:#16a34a;">{{ \App\CPU\translate("Delivery Available") }}</span>'
                            + '</div>'
                            + '<div style="display:flex; flex-direction:column; gap:6px;">'
                            + '<div style="display:flex; align-items:center; justify-content:space-between;">'
                            + '<span style="font-size:12px; color:#66706A;">{{ \App\CPU\translate("Estimated Delivery") }}</span>'
                            + '<span style="font-size:12px; font-weight:600; color:#1c252e;">' + response.estimated_delivery + '</span>'
                            + '</div>'
                            + '<div style="display:flex; align-items:center; justify-content:space-between;">'
                            + '<span style="font-size:12px; color:#66706A;">{{ \App\CPU\translate("Shipping Cost") }}</span>'
                            + '<span style="font-size:12px; font-weight:600; color:#168A3A;">' + response.delivery_cost_text + '</span>'
                            + '</div>'
                            + codBadge
                            + '</div>'
                            + '</div>';
                        $('#checkout_shipping_result').html(html);
                    } else {
                        $('#checkout_shipping_result').attr('data-serviceable', '0');
                        let html = '<div style="background:#fef2f2; border:1px solid #fecaca; border-radius:8px; padding:12px; display:flex; align-items:center; gap:8px;">'
                            + '<i class="fa fa-times-circle" style="color:#dc2626; font-size:14px;"></i>'
                            + '<span style="font-size:12px; font-weight:600; color:#dc2626;">' + (response.message || '{{ \App\CPU\translate("Delivery not available for this pincode") }}') + '</span>'
                            + '</div>';
                        $('#checkout_shipping_result').html(html);
                    }
                    $('#checkout_shipping_result').show();

                    // Refresh order summary shipping + total
                    $.get('{{ route('checkout-details') }}', function(html) {
                        var $tmp = $('<div>').append($.parseHTML(html));
                        var shipRow = $tmp.find('#order-summary-shipping');
                        var totalRow = $tmp.find('#order-summary-total');
                        if (shipRow.length) $('#order-summary-shipping').text(shipRow.text());
                        if (totalRow.length) $('#order-summary-total').text(totalRow.text());
                    });
                },
                error: function(xhr) {
                    $btn.removeAttr('disabled').html('<i class="fa fa-truck mr-1"></i> {{ \App\CPU\translate("Check") }}');
                    if ($('#checkout_pincode_input').val().trim() !== pincode) return;
                    $('#checkout_shipping_result').attr('data-serviceable', '0');
                    var msg = (xhr.responseJSON && xhr.responseJSON.message)
                        ? xhr.responseJSON.message
                        : '{{ \App\CPU\translate("Error checking shipping. Please try again.") }}';
                    toastr.error(msg);
                }
            });
        });

        // Allow Enter key
        $('#checkout_pincode_input').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#checkout_calc_shipping_btn').click();
            }
        });

        $('#checkout_pincode_input').on('input', function() {
            $('#checkout_shipping_result').attr('data-serviceable', '0').hide();
        });

        $('#checkout_calc_shipping_btn').on('click', function() {
            $('#checkout_shipping_result').attr('data-serviceable', '0');
        });

        $('#address-form input[name="shipping_method_id"]').on('change', function() {
            $('.checkout-address-option, .checkout-new-address').removeClass('is-selected');
            $(this).closest('.checkout-address-option, .checkout-new-address').addClass('is-selected');
        });

        $('#billing-address-form input[name="billing_method_id"]').on('change', function() {
            $('#billing-address-form .checkout-address-option, #billing-address-form .checkout-new-address')
                .removeClass('is-selected');
            $(this).closest('.checkout-address-option, .checkout-new-address').addClass('is-selected');
        });

        $('#address-form input[name="shipping_method_id"]').on('change', function() {
            var pincode = $(this).val() === '0'
                ? ($('#address-form [name="zip"]').val() || '')
                : ($(this).data('pincode') || '');
            $('#checkout_pincode_input').val(pincode).trigger('input');
            if (/^\d{6}$/.test($.trim(pincode))) {
                $('#checkout_calc_shipping_btn').trigger('click');
            }
        });

        $('#address-form [name="zip"]').on('input change', function() {
            if ($('#sh-0').is(':checked')) {
                var pincode = $(this).val() || '';
                $('#checkout_pincode_input').val(pincode).trigger('input');
                if (/^\d{6}$/.test($.trim(pincode))) {
                    $('#checkout_calc_shipping_btn').trigger('click');
                }
            }
        });

        $('#address-form input[name="shipping_method_id"], #billing-address-form input[name="billing_method_id"], #same_as_shipping_address')
            .on('change', updateCheckoutAddressRequirements);

        updateCheckoutAddressRequirements();

        var $selectedShippingAddress = $('#address-form input[name="shipping_method_id"]:checked');
        if ($selectedShippingAddress.length) {
            var initialPincode = $selectedShippingAddress.val() === '0'
                ? ($('#address-form [name="zip"]').val() || '')
                : ($selectedShippingAddress.data('pincode') || '');
            $('#checkout_pincode_input').val(initialPincode);
            if (/^\d{6}$/.test($.trim(initialPincode))) {
                $('#checkout_calc_shipping_btn').trigger('click');
            }
        }
    </script>
@endpush
