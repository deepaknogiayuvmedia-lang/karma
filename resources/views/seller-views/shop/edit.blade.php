@extends('layouts.back-end.app-seller')
@section('title', \App\CPU\translate('Shop Edit'))
@push('css_or_js')
<!-- Custom styles for this page -->
<link href="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Custom styles for this page -->
<link href="{{asset('public/assets/back-end/css/croppie.css')}}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
<!-- Content Row -->
<div class="content container-fluid">

    <!-- Page Title -->
    <div class="mb-3">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <img width="20" src="{{asset('/public/assets/back-end/img/shop-info.png')}}" alt="">
            {{\App\CPU\translate('Edit_Shop_Info')}}
        </h2>
    </div>
    <!-- End Page Title -->

    <div class="row gap-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 ">{{\App\CPU\translate('Edit_Shop_Info')}}</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('seller.shop.update',[$shop->id])}}" method="post"
                        style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{\App\CPU\translate('Shop Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{$shop->name}}" class="form-control" id="name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="title-color">{{\App\CPU\translate('Contact')}} <span class="text-info">( * {{\App\CPU\translate('country_code_is_must')}} {{\App\CPU\translate('like_for_BD_880')}} )</span></label>
                                    <input type="number" name="contact" value="{{$shop->contact}}" class="form-control" id="contact"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="title-color">{{\App\CPU\translate('Address')}} <span class="text-danger">*</span></label>
                                    <textarea type="text" rows="4" name="address" value="" class="form-control" id="address"
                                        required>{{$shop->address}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{\App\CPU\translate('Upload')}} {{\App\CPU\translate('image')}}</label>
                                    <div class="custom-file text-left">
                                        <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileUpload">{{\App\CPU\translate('choose')}} {{\App\CPU\translate('file')}}</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <img class="upload-img-view" id="viewer"
                                        onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                        src="{{asset(env('PUBLIC_STORAGE_PATH').'/shop/'.$shop->image)}}" alt="Product thumbnail" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 mt-2">
                                <div class="form-group">
                                    <div class="flex-start">
                                        <label for="name" class="title-color">{{\App\CPU\translate('Upload')}} {{\App\CPU\translate('Banner')}} </label>
                                        <div class="mx-1" for="ratio">
                                            <span class="text-info">{{\App\CPU\translate('Ratio')}} : ( 6:1 )</span>
                                        </div>
                                    </div>
                                    <div class="custom-file text-left">
                                        <input type="file" name="banner" id="BannerUpload" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="BannerUpload">{{\App\CPU\translate('choose')}} {{\App\CPU\translate('file')}}</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <img class="upload-img-view" id="viewerBanner"
                                        onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                        src="{{asset(env('PUBLIC_STORAGE_PATH').'/shop/banner/'.$shop->banner)}}" alt="Product thumbnail" />
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a class="btn btn-danger" href="{{route('seller.shop.view')}}">{{\App\CPU\translate('Cancel')}}</a>
                            <button type="submit" class="btn btn--primary" id="btn_update">{{\App\CPU\translate('Update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{ \App\CPU\translate('Shop More Details') }}</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('seller.shop.save-address',[$shop->id]) }}" method="post"
                        enctype="multipart/form-data"
                        style="text-align: {{ Session::get('direction') === "rtl" ? 'right' : 'left' }};">
                        @csrf

                        <div class="row">

                            {{-- WhatsApp Number --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="title-color">
                                        {{ \App\CPU\translate('WhatsApp Number') }}
                                    </label>
                                    <input type="text" name="whatsapp_number"
                                        class="form-control"
                                        placeholder="91XXXXXXXXXX"
                                        value="{{ $shop->whatsapp_no ?? '' }}">
                                </div>
                            </div>

                            {{-- GST Number --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="title-color">
                                        {{ \App\CPU\translate('GST Number') }}
                                    </label>
                                    <input type="text" name="gst_number"
                                        class="form-control"
                                        placeholder="22AAAAA0000A1Z5"
                                        value="{{ $shop->gst_no ?? '' }}">
                                </div>
                            </div>
                            {{-- GST Certificate PDF --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between >
                                    <label class=" title-color">
                                        {{ \App\CPU\translate('Upload GST Certificate (PDF)') }}
                                        </label>
                                        @if($shop->gst_doc)
                                        <a href="{{ asset('storage/document/'.$shop->gst_doc) }}"
                                            target="_blank"
                                            class="text-decoration-underline">
                                            View GST Certificate Pdf
                                        </a>
                                        @endif
                                    </div>
                                    <div class="custom-file text-left">
                                        <input type="file" name="gst_certificate" id="gstCertificateUpload" class="custom-file-input"
                                            accept=".pdf">
                                        <label class="custom-file-label" for="gstCertificateUpload">{{\App\CPU\translate('choose')}} {{\App\CPU\translate('file')}}</label>
                                    </div>
                                </div>
                            </div>

                            {{-- PAN Number --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="title-color">
                                        {{ \App\CPU\translate('PAN Number') }}
                                    </label>
                                    <input type="text" name="pan_number"
                                        class="form-control"
                                        placeholder="ABCDE1234F"
                                        value="{{ $shop->pen_no ?? '' }}">
                                </div>
                            </div>

                            {{-- PAN Card PDF --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between >
                                     <label class=" title-color">
                                        {{ \App\CPU\translate('Upload PAN Card (PDF)') }}
                                        </label>
                                        @if($shop->pen_doc)
                                        <a href="{{ asset('storage/document/'.$shop->gst_doc) }}"
                                            target="_blank"
                                            class="text-decoration-underline">
                                            View Pen Card Pdf
                                        </a>
                                        @endif
                                    </div>
                                    <div class="custom-file text-left">
                                        <input type="file" name="pan_card" id="panCardUpload" class="custom-file-input"
                                            accept=".pdf">
                                        <label class="custom-file-label" for="panCardUpload">{{\App\CPU\translate('choose')}} {{\App\CPU\translate('file')}}</label>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $business_address = json_decode($shop->business_address, true);
                            $warehouse_address = json_decode($shop->wherehouse, true);
                            ?> {{-- Business Address --}}
                            <div class="col-md-6">
                                <div class="form-group">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="border-bottom pb-2 mb-3 text-capitalize">
                                                {{ \App\CPU\translate('Business Address') }}
                                            </h5>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="title-color">{{ \App\CPU\translate('Address') }}</label>
                                                <input type="text" name="business_address_line1" placeholder="Enter Address Name"
                                                    class="form-control"
                                                    value="{{ $business_address['address_line1'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="title-color">{{ \App\CPU\translate('City') }}</label>
                                                <input type="text" name="business_city" placeholder="Enter City"
                                                    class="form-control"
                                                    value="{{ $business_address['city'] ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="title-color">{{ \App\CPU\translate('State') }}</label>
                                                <input type="text" name="business_state" placeholder="Enter State"
                                                    class="form-control"
                                                    value="{{ $business_address['state'] ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="title-color">{{ \App\CPU\translate('PIN Code') }}</label>
                                                <input type="text" name="business_pincode" placeholder="Enter Pin Code"
                                                    class="form-control"
                                                    value="{{ $business_address['pincode'] ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="title-color">{{ \App\CPU\translate('Country') }}</label>
                                                <input type="text" name="business_country" placeholder="Enter Country"
                                                    class="form-control"
                                                    value="{{ $business_address['country'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Warehouse Address --}}
                            <div class="col-md-6">
                                <div class="form-group">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="border-bottom  mb-3 d-flex justify-content-between">
                                                <h5 class=" text-capitalize">{{ \App\CPU\translate('Warehouse Address') }}</h5>
                                                <div class=""> <input class="form-check-input"
                                                        type="checkbox"
                                                        id="sameAddressCheckbox">
                                                    <label class="form-check-label title-color fw-normal" for="sameAddressCheckbox">
                                                        {{ \App\CPU\translate('Warehouse address same as business address') }}
                                                    </label>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="title-color">{{ \App\CPU\translate('Address ') }}</label>
                                                <input type="text" name="warehouse_address_line1" placeholder="Enter Address"
                                                    class="form-control"
                                                    value="{{ $warehouse_address['address_line1'] ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="title-color">{{ \App\CPU\translate('City') }}</label>
                                                <input type="text" name="warehouse_city" placeholder="Enter City"
                                                    class="form-control"
                                                    value="{{ $warehouse_address['city'] ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="title-color">{{ \App\CPU\translate('State') }}</label>
                                                <input type="text" name="warehouse_state" placeholder="Enter State"
                                                    class="form-control"
                                                    value="{{ $warehouse_address['state'] ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="title-color">{{ \App\CPU\translate('PIN Code') }}</label>
                                                <input type="text" name="warehouse_pincode" placeholder="Enter Pin Code"
                                                    class="form-control"
                                                    value="{{ $warehouse_address['pincode'] ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="title-color">{{ \App\CPU\translate('Country') }}</label>
                                                <input type="text" name="warehouse_country" placeholder="Enter Country"
                                                    class="form-control"
                                                    value="{{ $warehouse_address['country'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end gap-2 ">
                            <button type="submit" class="btn btn--primary">
                                {{ \App\CPU\translate('Save More Details') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        {{-- ================= BUSINESS ADDRESS ================= --}}


        {{-- ================= WAREHOUSE ADDRESS ================= --}}



    </div>
</div>
<!-- End Content Row -->

@endsection

@push('script')

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#viewer').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function readBannerURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#viewerBanner').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#customFileUpload").change(function() {
        readURL(this);
    });

    $("#BannerUpload").change(function() {
        readBannerURL(this);
    });
    document.getElementById('sameAddressCheckbox').addEventListener('change', function() {

        const mapFields = [
            ['business_address_line1', 'warehouse_address_line1'],
            ['business_city', 'warehouse_city'],
            ['business_state', 'warehouse_state'],
            ['business_country', 'warehouse_country'],
            ['business_pincode', 'warehouse_pincode'],
        ];

        mapFields.forEach(([business, warehouse]) => {
            const businessField = document.querySelector(`[name="${business}"]`);
            const warehouseField = document.querySelector(`[name="${warehouse}"]`);

            if (this.checked) {
                warehouseField.value = businessField.value;
                warehouseField.setAttribute('readonly', true);

            } else {
                warehouseField.value = '';
                warehouseField.removeAttribute('readonly');
            }

        });

    });
</script>

@endpush