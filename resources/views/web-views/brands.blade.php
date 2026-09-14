@extends('layouts.front-end.app')

@section('title', \App\CPU\translate('All Brands Page'))

@push('css_or_js')
    <meta property="og:image" content="{{ asset(config('app.public_storage_path') . '/company/') }}/{{ $web_config['web_logo']->value }}"/>
    <meta property="og:title" content="Brands of {{ $web_config['name']->value }}"/>
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:description" content="{!! substr($web_config['about']->value, 0, 100) !!}">

    <meta property="twitter:card" content="{{ asset(config('app.public_storage_path') . '/company/') }}/{{ $web_config['web_logo']->value }}"/>
    <meta property="twitter:title" content="Brands of {{ $web_config['name']->value }}"/>
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value, 0, 100) !!}">
@endpush

@section('content')
    <!-- Page Header & Breadcrumb -->
    <div class="py-3 mb-4" style="background: var(--bh-light-green); border-bottom: 1px solid var(--bh-border);">
        <div class="container text-left">
            <h4 class="font-weight-bold mb-1" style="color: var(--bh-dark-green);">
                <i class="fa fa-briefcase text-success mr-2"></i> {{ \App\CPU\translate('Featured Agri Brands') }}
            </h4>
            <div style="font-size: 0.82rem; color: var(--bh-text-secondary);">
                <a href="{{ route('home') }}" style="color: var(--bh-primary);">{{ \App\CPU\translate('Home') }}</a> / 
                <span>{{ \App\CPU\translate('Brands') }}</span>
            </div>
        </div>
    </div>

    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 rtl" style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
        <div class="row g-3">
            @foreach($brands as $brand)
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                    <a href="{{ route('products', ['id' => $brand['id'], 'data_from' => 'brand', 'page' => 1]) }}" class="bh-brand-card d-block text-center text-decoration-none">
                        <img class="bh-brand-img"
                            src="{{ asset(config('app.public_storage_path') . '/brand/' . $brand->image) }}"
                            onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                            alt="{{ $brand->name }}">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="row mt-4">
            <div class="col-md-12 d-flex justify-content-center">
                {!! $brands->links() !!}
            </div>
        </div>
    </div>
@endsection
