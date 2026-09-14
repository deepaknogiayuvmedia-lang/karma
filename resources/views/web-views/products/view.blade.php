@extends('layouts.front-end.app')

@section('title',\App\CPU\translate($data['data_from']).' '.\App\CPU\translate('products'))

@push('css_or_js')
    <meta property="og:image" content="{{asset(config('app.public_storage_path').'/company')}}/{{$web_config['web_logo']}}"/>
    <meta property="og:title" content="Products of {{$web_config['name']}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset(config('app.public_storage_path').'/company')}}/{{$web_config['web_logo']}}"/>
    <meta property="twitter:title" content="Products of {{$web_config['name']}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <style>
        .for-count-value {

        {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 0.6875 rem;;
        }

        .for-count-value {

        {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 0.6875 rem;
        }

        .for-brand-hover:hover {
            color: {{$web_config['primary_color']}};
        }

        .for-hover-lable:hover {
            color: {{$web_config['primary_color']}}       !important;
        }

        .page-item.active .page-link {
            background-color: {{$web_config['primary_color']}}      !important;
        }

        .for-shoting {
            padding- {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 9px;
        }

        .sidepanel {
        {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 0;
        }
        .sidepanel .closebtn {
        {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 25 px;
        }
        @media (max-width: 360px) {
            .for-shoting-mobile {
                margin- {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 0% !important;
            }

            .for-mobile {

                margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10% !important;
            }

        }

        @media (max-width: 500px) {
            .for-mobile {

                margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 27%;
            }
        }

    </style>
@endpush

@section('content')

@php($decimal_point_settings = \App\CPU\Helpers::get_business_settings('decimal_point_settings'))
    <!-- Page Header & Breadcrumb -->
    <div class="py-3 mb-4" style="background: var(--bh-light-green); border-bottom: 1px solid var(--bh-border);">
        <div class="container text-left">
            <h4 class="font-weight-bold mb-1" style="color: var(--bh-dark-green);">
                @if($data['data_from'] == 'technical_name')
                    {{ \App\CPU\translate('Technical Name') }}: {{ $data['technical_name'] ?? '' }}
                @else
                    {{\App\CPU\translate(str_replace('_',' ',$data['data_from']))}} {{\App\CPU\translate('products')}} {{ isset($brand_name) ? '('.$brand_name.')' : ''}}
                @endif
            </h4>
            <div style="font-size: 0.82rem; color: var(--bh-text-secondary);">
                <a href="{{ route('home') }}" style="color: var(--bh-primary);">{{ \App\CPU\translate('Home') }}</a> / 
                <span>{{ \App\CPU\translate(str_replace('_',' ',$data['data_from'])) }}</span>
            </div>
        </div>
    </div>

    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="row">
            <!-- Sidebar Filters -->
            <aside class="col-lg-3 col-md-4 SearchParameters" id="SearchParameters">
                <div class="bh-filter-sidebar" id="shop-sidebar">
                    <div class="bh-filter-title d-flex justify-content-between align-items-center">
                        <span><i class="fa fa-filter text-success mr-1"></i> {{\App\CPU\translate('FILTERS')}}</span>
                    </div>

                    <!-- Filter by Collections -->
                    <div class="bh-filter-group">
                        <div class="bh-filter-group-title">{{\App\CPU\translate('Collection')}}</div>
                        <select class="form-control form-control-sm" id="searchByFilterValue" style="border-radius: var(--bh-radius-sm);">
                            <option selected disabled>{{\App\CPU\translate('Choose Collection')}}</option>
                            <option value="{{route('products',['id'=> $data['id'],'data_from'=>'best-selling','page'=>1])}}" {{isset($data['data_from'])!=null?$data['data_from']=='best-selling'?'selected':'':''}}>{{\App\CPU\translate('best_selling_product')}}</option>
                            <option value="{{route('products',['id'=> $data['id'],'data_from'=>'top-rated','page'=>1])}}" {{isset($data['data_from'])!=null?$data['data_from']=='top-rated'?'selected':'':''}}>{{\App\CPU\translate('top_rated')}}</option>
                            <option value="{{route('products',['id'=> $data['id'],'data_from'=>'most-favorite','page'=>1])}}" {{isset($data['data_from'])!=null?$data['data_from']=='most-favorite'?'selected':'':''}}>{{\App\CPU\translate('most_favorite')}}</option>
                            <option value="{{route('products',['id'=> $data['id'],'data_from'=>'featured_deal','page'=>1])}}" {{isset($data['data_from'])!=null?$data['data_from']=='featured_deal'?'selected':'':''}}>{{\App\CPU\translate('featured_deal')}}</option>
                        </select>
                    </div>

                    <!-- Filter by Price -->
                    <div class="bh-filter-group">
                        <div class="bh-filter-group-title">{{\App\CPU\translate('Price Range')}}</div>
                        <div class="d-flex align-items-center gap-2">
                            <input class="form-control form-control-sm" type="number" value="0" min="0" max="1000000" id="min_price" placeholder="Min" style="border-radius: var(--bh-radius-sm);">
                            <span class="text-muted font-weight-bold">-</span>
                            <input value="10000" min="10" max="1000000" class="form-control form-control-sm" type="number" id="max_price" placeholder="Max" style="border-radius: var(--bh-radius-sm);">
                            <button class="btn btn-bh-primary btn-sm ml-1" type="button" onclick="searchByPrice()" style="padding: 4px 10px !important;">
                                <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Filter by Brands -->
                    <div class="bh-filter-group">
                        <div class="bh-filter-group-title">{{\App\CPU\translate('Brands')}}</div>
                        <div class="input-group input-group-sm mb-2">
                            <input type="text" id="search-brand" class="form-control" placeholder="{{__('Search brand...')}}" style="border-radius: var(--bh-radius-sm);">
                        </div>
                        <div style="max-height: 180px; overflow-y: auto;">
                            <ul id="lista1" class="list-unstyled mb-0" style="font-size: 0.85rem;">
                                @foreach(\App\CPU\BrandManager::get_active_brands() as $brand)
                                    <li class="py-1 d-flex justify-content-between align-items-center cursor-pointer bh-brand-item"
                                        onclick="location.href='{{route('products',['id'=> $brand['id'],'data_from'=>'brand','page'=>1])}}'">
                                        <span style="color: var(--bh-text-primary);">{{ $brand['name'] }}</span>
                                        @if($brand['brand_products_count'] > 0 )
                                            <span class="badge badge-light border text-muted">{{ $brand['brand_products_count'] }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Filter by Categories -->
                    <div class="bh-filter-group mb-0">
                        <div class="bh-filter-group-title">{{\App\CPU\translate('Categories')}}</div>
                        @php($categories=\App\CPU\CategoryManager::parents())
                        <div class="accordion" id="shop-categories" style="font-size: 0.85rem;">
                            @foreach($categories as $category)
                                <div class="py-1 border-bottom">
                                    <div class="d-flex justify-content-between align-items-center cursor-pointer" onclick="location.href='{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}'">
                                        <span style="font-weight: 600; color: var(--bh-text-primary);">{{$category['name']}}</span>
                                        @if($category->childes->count() > 0)
                                            <i class="fa fa-angle-right text-muted"></i>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content Area -->
            <section class="col-lg-9 col-md-8">
                <!-- Top Toolbar: Count & Sorting -->
                <div class="d-flex flex-wrap align-items-center justify-content-between p-3 mb-3 bg-white rounded border box-shadow-sm">
                    <div>
                        <span id="price-filter-count" class="font-weight-bold" style="color: var(--bh-text-primary); font-size: 0.95rem;">
                            {{$products->total()}} {{\App\CPU\translate('items found')}}
                        </span>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="mr-2 mb-0 text-nowrap font-weight-bold" style="font-size: 0.85rem; color: var(--bh-text-secondary);" for="sorting">
                            {{\App\CPU\translate('Sort By')}}:
                        </label>
                        <select class="form-control form-control-sm" style="width: auto; border-radius: var(--bh-radius-sm);" onchange="filter(this.value)">
                            <option value="latest">{{\App\CPU\translate('Latest')}}</option>
                            <option value="low-high">{{\App\CPU\translate('Price: Low to High')}}</option>
                            <option value="high-low">{{\App\CPU\translate('Price: High to Low')}}</option>
                            <option value="a-z">{{\App\CPU\translate('Name: A to Z')}}</option>
                            <option value="z-a">{{\App\CPU\translate('Name: Z to A')}}</option>
                        </select>
                    </div>
                </div>

                <!-- Product Grid -->
                @if (count($products) > 0)
                    <div class="row g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-3 row-cols-md-2 row-cols-2" id="ajax-products">
                        @include('web-views.products._ajax-products',['products'=>$products,'decimal_point_settings'=>$decimal_point_settings])
                    </div>
                @else
                    <div class="text-center py-5 bg-white rounded border">
                        <i class="fa fa-search text-muted mb-3" style="font-size: 3rem;"></i>
                        <h4 class="font-weight-bold" style="color: var(--bh-text-primary);">{{\App\CPU\translate('No Products Found')}}</h4>
                        <p class="text-muted mb-0">{{\App\CPU\translate('Try another keyword or browse categories')}}</p>
                    </div>
                @endif
            </section>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function openNav() {
            document.getElementById("mySidepanel").style.width = "70%";
            document.getElementById("mySidepanel").style.height = "100vh";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }

        function filter(value) {
            $.get({
                url: '{{url('/')}}/products',
                data: {
                    id: '{{$data['id']}}',
                    name: '{{$data['name']}}',
                    data_from: '{{$data['data_from']}}',
                    min_price: '{{$data['min_price']}}',
                    max_price: '{{$data['max_price']}}',
                    sort_by: value
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (response) {
                    $('#ajax-products').html(response.view);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

        function searchByPrice() {
            let min = $('#min_price').val();
            let max = $('#max_price').val();
            $.get({
                url: '{{url('/')}}/products',
                data: {
                    id: '{{$data['id']}}',
                    name: '{{$data['name']}}',
                    data_from: '{{$data['data_from']}}',
                    sort_by: '{{$data['sort_by']}}',
                    min_price: min,
                    max_price: max,
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (response) {
                    $('#ajax-products').html(response.view);
                    $('#paginator-ajax').html(response.paginator);
                    console.log(response.total_product);
                    $('#price-filter-count').text(response.total_product + ' {{\App\CPU\translate('items found')}}')
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

        $('#searchByFilterValue, #searchByFilterValue-m').change(function () {
            var url = $(this).val();
            if (url) {
                window.location = url;
            }
            return false;
        });

        $("#search-brand").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#lista1 div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });
    </script>


@endpush

