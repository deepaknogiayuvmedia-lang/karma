@extends('layouts.back-end.sale_app')

@section('title', \App\CPU\translate('customer_edit'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-1 text-capitalize d-flex align-items-center gap-2">
                <img width="20" src="{{ asset('/public/assets/back-end/img/banner.png') }}" alt="">
                {{ \App\CPU\translate('customer_update_form') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row" style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('sale.customer_update', [$query['id']]) }}" method="post"
                            enctype="multipart/form-data" class="banner_form">
                            @csrf
                            @method('put')
                            <div class="row g-2">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="hidden" id="id" name="id">
                                        <label for="name"
                                            class="title-color text-capitalize">{{ \App\CPU\translate('Name') }}</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $query['name'] }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="email">Product:</label>
                                    <select class="form-control" name="products">
                                        @foreach ($products as $row)
                                            <option value="{{ $row->id }}"
                                                {{ $row->id == $query['product_id'] ? 'selected' : '' }}>
                                                {{ $row->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="mobile"
                                            class="title-color text-capitalize">{{ \App\CPU\translate('Mobile') }}</label>
                                        <input type="text" name="mobile" class="form-control"
                                            value="{{ $query['mobile'] }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">


                                    <div class="form-group">
                                        <label for="email"
                                            class="title-color text-capitalize">{{ \App\CPU\translate('email') }}</label>
                                        <input type="text" name="email" class="form-control" value="{{ $query['email'] }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="email">Channel:</label>
                                    <select class="form-control" name="chanals">
                                        @foreach ($chanals as $row)
                                            <option value="{{ $row->id }}"
                                                {{ $row->id == $query['chanal_id'] ? 'selected' : '' }}>
                                                {{ $row->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="Address"
                                            class="title-color text-capitalize">{{ \App\CPU\translate('Pincode') }}</label>
                                        <input type="number" name="address" class="form-control" value="{{ $query['address'] }}" required>

                                    </div>
                                </div>

                                <div class="col-md-12 d-flex justify-content-end gap-3">
                                    <button type="reset"
                                        class="btn btn-secondary px-4">{{ \App\CPU\translate('reset') }}</button>
                                    <button type="submit"
                                        class="btn btn--primary px-4">{{ \App\CPU\translate('update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

