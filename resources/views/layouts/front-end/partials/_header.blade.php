<style>
    :root {
        --primary_color : {
                {
                $web_config['primary_color']
            }
        }

        ;
    }

    .for-count-value {
        color: var(--primary_color);
    }

    .count-value {
        color: var(--primary_color);
    }

    @media (min-width: 768px) {
        /* .navbar-stuck-menu {
            background-color: var(--primary_color);
        } */

    }

    @media (max-width: 767px) {
        .search_button .input-group-text i {
            color: var(--primary_color) !important;
        }

        .navbar-expand-md .dropdown-menu>.dropdown>.dropdown-toggle {
            padding- {
                    {
                    Session: :get('direction')==="rtl" ? 'left': 'right'
                }
            }

            : 1.95rem;
        }

        .mega-nav1 {
            color: var(--primary_color) !important;
        }

        .mega-nav1 .nav-link {
            color: var(--primary_color) !important;
        }
    }

    @media (max-width: 471px) {
        .mega-nav1 {
            color: var(--primary_color) !important;
        }

        .mega-nav1 .nav-link {
            color: var(--primary_color) !important;
        }
    }
</style>
@php($announcement=\App\CPU\Helpers::get_business_settings('announcement'))
@if (isset($announcement) && $announcement['status']==1)
<div class="text-center position-relative  px-4 py-1" id="anouncement" style="background-color: {{ $announcement['color'] }};color:{{$announcement['text_color']}}">
    <span>{{ $announcement['announcement'] }} </span>
    <!-- <span class="__close-anouncement" onclick="myFunction()">X</span> -->
</div>
@endif
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NJ6N83BN"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<header class="box-shadow-sm rtl __inline-10">
    <!-- Topbar-->
    <div class="topbar">
        <div class="container px-5">

            <div>
                <div class="topbar-text dropdown d-md-none {{Session::get('direction') === "rtl" ? 'mr-auto' : 'ml-auto'}}">
                    <a class="topbar-link" href="tel: {{$web_config['phone']->value}}">
                        <i class="fa fa-phone"></i> {{$web_config['phone']->value}}
                    </a>
                </div>
                <div class="d-none d-md-block {{Session::get('direction') === "rtl" ? 'mr-2' : 'mr-2'}} text-nowrap">
                    <a class="topbar-link d-none d-md-inline-block" href="tel:{{$web_config['phone']->value}}">
                        <i class="fa fa-phone"></i> {{$web_config['phone']->value}}
                    </a>
                </div>
            </div>

            <div>
                @php($currency_model = \App\CPU\Helpers::get_business_settings('currency_model'))
                @if($currency_model=='multi_currency')
                <div class="topbar-text dropdown disable-autohide {{Session::get('direction') === "rtl" ? 'mr-4' : 'mr-4'}}">
                    <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <span>{{session('currency_code')}} {{session('currency_symbol')}}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}"
                        style="min-width: 160px!important;text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                        @foreach (\App\Model\Currency::where('status', 1)->get() as $key => $currency)
                        <li class="dropdown-item cursor-pointer"
                            onclick="currency_change('{{$currency['code']}}')">
                            {{ $currency->name }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @php( $local = \App\CPU\Helpers::default_lang())
                <div
                    class="topbar-text dropdown disable-autohide  __language-bar text-capitalize">
                    <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">
                        @foreach(json_decode($language['value'],true) as $data)
                        @if($data['code']==$local)
                        <img class="{{Session::get('direction') === "rtl" ? 'mr-2' : 'mr-2'}}" width="20"
                            src="{{asset('assets/front-end')}}/img/flags/{{$data['code']}}.png"
                            alt="Eng">
                        {{$data['name']}}
                        @endif
                        @endforeach
                    </a>
                    <ul class="dropdown-menu dropdown-menu-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}"
                        style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                        @foreach(json_decode($language['value'],true) as $key =>$data)
                        @if($data['status']==1)
                        <li>
                            <a class="dropdown-item pb-1" href="{{route('lang',[$data['code']])}}">
                                <img class="{{Session::get('direction') === "rtl" ? 'mr-2' : 'mr-2'}}"
                                    width="20"
                                    src="{{asset('assets/front-end')}}/img/flags/{{$data['code']}}.png"
                                    alt="{{$data['name']}}" />
                                <span style="text-transform: capitalize">{{$data['name']}}</span>
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="navbar-sticky bg-light mobile-head">
        <div class="navbar px-3 navbar-expand-md navbar-light">
            <div class="container ">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand d-none d-sm-block {{Session::get('direction') === "rtl" ? 'mr-3' : 'mr-3'}} flex-shrink-0 __min-w-7rem" href="{{route('home')}}">
                    <img class="__inline-11"
                        src="{{asset(env('PUBLIC_STORAGE_PATH')."/company")."/".$web_config['web_logo']->value}}"
                        onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                        alt="{{$web_config['name']->value}}" />
                </a>
                <a class="navbar-brand d-sm-none {{Session::get('direction') === "rtl" ? 'mr-2' : 'mr-2'}}"
                    href="{{route('home')}}">
                    <img class="mobile-logo-img __inline-12"
                        src="{{asset(env('PUBLIC_STORAGE_PATH')."/company")."/".$web_config['mob_logo']->value}}"
                        onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                        alt="{{$web_config['name']->value}}" />
                </a>
                <!-- Search-->
                <div class="input-group-overlay d-none d-md-block mx-4"
                    style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}}">
                    <form action="{{route('products')}}" type="submit" class="search_form">
                        <input class="form-control appended-form-control search-bar-input" type="text"
                            autocomplete="off"
                            placeholder="{{\App\CPU\translate('Search here ...')}}"
                            name="name">
                        <button class="input-group-append-overlay search_button" type="submit"
                            style="border-radius: {{Session::get('direction') === "rtl" ? '7px 0px 0px 7px; right: unset; left: 0' : '0px 7px 7px 0px; left: unset; right: 0'}};top:0">
                            <span class="input-group-text __text-20px">
                                <i class="czi-search text-white"></i>
                            </span>
                        </button>
                                           
                        <input name="page" value="1" hidden>
                        <diV class="card search-card __inline-13">
                            <div class="card-body search-result-box __h-400px overflow-x-hidden overflow-y-auto"></div>
                        </diV>
                    </form>
                </div>
                <!-- Toolbar-->
                <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
                    <a class="navbar-tool navbar-stuck-toggler" href="#">
                        <span class="navbar-tool-tooltip">{{\App\CPU\translate('Expand Menu')}}</span>
                        <div class="navbar-tool-icon-box">
                            <i class="navbar-tool-icon czi-menu open-icon"></i>
                            <i class="navbar-tool-icon czi-close close-icon"></i>
                        </div>
                    </a>
                    <div class="navbar-tool dropdown {{Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'}}">
                        <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{route('wishlists')}}">
                            <span class="navbar-tool-label">
                                <span
                                    class="countWishlist">{{session()->has('wish_list')?count(session('wish_list')):0}}</span>
                            </span>
                            <i class="navbar-tool-icon czi-heart"></i>
                        </a>
                    </div>
                    @if(auth('customer')->check())
                    <div class="navbar-tool dropdown {{Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'}}">
                        <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="javascript:" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="notification_icon">
                            <span class="navbar-tool-label">
                                <span class="countNotification">0</span>
                            </span>
                            <i class="navbar-tool-icon czi-bell"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}" style="width: 330px; padding: 0;">
                            <div class="widget widget-cart px-3 pt-3 pb-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="font-size-sm mb-0">{{\App\CPU\translate('Notifications')}}</h5>
                                </div>
                                <div id="notification-list" style="max-height: 20rem; overflow-y: auto;">
                                    <p class="text-center font-size-xs text-muted py-3 mb-0">{{\App\CPU\translate('Loading...')}}</p>
                                </div>
                                <div class="dropdown-divider my-2"></div>
                                <a class="btn btn--primary btn-sm btn-block" href="{{route('notifications')}}">
                                    {{\App\CPU\translate('View All')}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="navbar-tool ml-3" type="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="navbar-tool-icon-box bg-secondary">
                                <div class="navbar-tool-icon-box bg-secondary">
                                    <img src="{{asset(env('PUBLIC_STORAGE_PATH').'/profile/'.auth('customer')->user()->image)}}"
                                        onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                        class="img-profile rounded-circle __inline-14">
                                </div>
                            </div>
                            <div class="navbar-tool-text">
                                <small>{{\App\CPU\translate('hello')}}, {{auth('customer')->user()->f_name}}</small>
                                {{\App\CPU\translate('dashboard')}}
                            </div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item"
                                href="{{route('account-oder')}}"> {{ \App\CPU\translate('my_order')}} </a>
                            <a class="dropdown-item"
                                href="{{route('user-account')}}"> {{ \App\CPU\translate('my_profile')}}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                                href="{{route('customer.auth.logout')}}">{{ \App\CPU\translate('logout')}}</a>
                        </div>
                    </div>
                    @else

                    <div class="dropdown">
                        <a class="navbar-tool {{Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'}}"
                            type="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="navbar-tool-icon-box bg-secondary">
                                <div class="navbar-tool-icon-box bg-secondary">
                                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.25 4.41675C4.25 6.48425 5.9325 8.16675 8 8.16675C10.0675 8.16675 11.75 6.48425 11.75 4.41675C11.75 2.34925 10.0675 0.666748 8 0.666748C5.9325 0.666748 4.25 2.34925 4.25 4.41675ZM14.6667 16.5001H15.5V15.6667C15.5 12.4509 12.8825 9.83341 9.66667 9.83341H6.33333C3.11667 9.83341 0.5 12.4509 0.5 15.6667V16.5001H14.6667Z" fill="#1B7FED" />
                                    </svg>

                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu __auth-dropdown dropdown-menu-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}" aria-labelledby="dropdownMenuButton"
                            style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                            <a class="dropdown-item" href="{{route('customer.auth.login')}}">
                                <i class="fa fa-sign-in {{Session::get('direction') === "rtl" ? 'mr-2' : 'mr-2'}}"></i> {{\App\CPU\translate('sign_in')}}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('customer.auth.sign-up')}}">
                                <i class="fa fa-user-circle {{Session::get('direction') === "rtl" ? 'mr-2' : 'mr-2'}}"></i>{{\App\CPU\translate('sign_up')}}
                            </a>
                        </div>
                    </div>
                    @endif
                    <div id="cart_items">
                        @include('layouts.front-end.partials.cart')
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-expand-md navbar-stuck-menu">
            <div class="container px-10px">
                <div class="collapse navbar-collapse" id="navbarCollapse"
                    style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}}; ">

                    <!-- Search-->
                    <div class="input-group-overlay d-md-none my-3">
                        <form action="{{route('products')}}" type="submit" class="search_form">
                            <input class="form-control appended-form-control search-bar-input-mobile" type="text"
                                autocomplete="off"
                                placeholder="{{\App\CPU\translate('search')}}" name="name">
                            <input name="data_from" value="search" hidden>
                            <input name="page" value="1" hidden>
                            <button class="input-group-append-overlay search_button" type="submit"
                                style="border-radius: {{Session::get('direction') === "rtl" ? '7px 0px 0px 7px; right: unset; left: 0' : '0px 7px 7px 0px; left: unset; right: 0'}};">
                                <span class="input-group-text __text-20px">
                                    <i class="czi-search text-white"></i>
                                </span>
                            </button>
                            <diV class="card search-card __inline-13">
                                <div class="card-body search-result-box" id=""
                                    style="overflow:scroll; height:400px;overflow-x: hidden"></div>
                            </diV>
                        </form>
                    </div>

                    @php($categories=\App\Model\Category::with(['childes.childes'])->where('position', 0)->priority()->paginate(11))
                    <ul class="navbar-nav mega-nav pr-2 pl-2 {{Session::get('direction') === "rtl" ? 'mr-2' : 'mr-2'}} d-none d-xl-block __mega-nav">
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle {{Session::get('direction') === "rtl" ? 'pr-0' : 'pl-0'}}"
                                href="#" data-toggle="dropdown">
                                <i class="czi-menu align-middle mt-n1 {{Session::get('direction') === "rtl" ? 'mr-2' : 'mr-2'}}"></i>
                                <span
                                    style="margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 30px !important;margin-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 30px">
                                    {{ \App\CPU\translate('categories')}}
                                </span>
                            </a>

                            <ul class="dropdown-menu __dropdown-menu-2"
                                style="right: 0; text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                                @foreach($categories as $category)
                                <li class="dropdown">
                                    <a class="dropdown-item flex-between <?php if ($category->childes->count() > 0) echo "data-toggle='dropdown" ?> "
                                        <?php if ($category->childes->count() > 0) echo "data-toggle='dropdown'" ?> href="javascript:"
                                        onclick="location.href='{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}'">
                                        <div class="d-flex">
                                            <img src="{{asset(env('PUBLIC_STORAGE_PATH')."/category/$category->icon")}}"

                                                class="__img-18">
                                            <span
                                                class="w-0 flex-grow-1 {{Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'}}">{{$category['name']}}</span>
                                        </div>
                                        @if ($category->childes->count() > 0)
                                        <div>
                                            <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} __inline-15"></i>
                                        </div>
                                        @endif
                                    </a>
                                    @if($category->childes->count()>0)
                                    <ul class="dropdown-menu __r-100"
                                        style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                                        @foreach($category['childes'] as $subCategory)
                                        <li class="dropdown">
                                            <a class="dropdown-item flex-between <?php if ($subCategory->childes->count() > 0) echo "data-toggle='dropdown" ?> "
                                                <?php if ($subCategory->childes->count() > 0) echo "data-toggle='dropdown'" ?> href="javascript:"
                                                onclick="location.href='{{route('products',['id'=> $subCategory['id'],'data_from'=>'category','page'=>1])}}'">
                                                <div>
                                                    <span
                                                        class="{{Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'}}">{{$subCategory['name']}}</span>
                                                </div>
                                                @if ($subCategory->childes->count() > 0)
                                                <div>
                                                    <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} __inline-15"></i>
                                                </div>
                                                @endif
                                            </a>
                                            @if($subCategory->childes->count()>0)
                                            <ul class="dropdown-menu __r-100"
                                                style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                                                @foreach($subCategory['childes'] as $subSubCategory)
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{route('products',['id'=> $subSubCategory['id'],'data_from'=>'category','page'=>1])}}">{{$subSubCategory['name']}}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                                <li class="dropdown">
                                    <a class="dropdown-item d-block text-center" href="{{route('categories')}}"
                                        style="color: var(--primary_color) !important;">
                                        {{\App\CPU\translate('view_more')}}

                                        <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} __text-8px" style="background:none !important;color:var(--primary_color) !important;"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="navbar-nav mega-nav1 pr-2 pl-2 d-block d-xl-none"><!--mobile-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{Session::get('direction') === "rtl" ? 'pr-0' : 'pl-0'}}"
                                href="#" data-toggle="dropdown">
                                <i class="czi-menu align-middle mt-n1 {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}"></i>
                                <span
                                    style="margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 20px !important;">{{ \App\CPU\translate('categories')}}</span>
                            </a>
                            <ul class="dropdown-menu __dropdown-menu-2"
                                style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                                @foreach($categories as $category)
                                <li class="dropdown">

                                    <a <?php if ($category->childes->count() > 0) echo "" ?>
                                        href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">
                                        <img src="{{asset(env('PUBLIC_STORAGE_PATH')."/category/$category->icon")}}"
                                            onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                            class="__img-18">
                                        <span
                                            class="{{Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'}}">{{$category['name']}}</span>

                                    </a>
                                    @if ($category->childes->count() > 0)
                                    <a data-toggle='dropdown' class='__ml-50px'>
                                        <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} __inline-16"></i>
                                    </a>
                                    @endif

                                    @if($category->childes->count()>0)
                                    <ul class="dropdown-menu"
                                        style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                                        @foreach($category['childes'] as $subCategory)
                                        <li class="dropdown">
                                            <a href="{{route('products',['id'=> $subCategory['id'],'data_from'=>'category','page'=>1])}}">
                                                <span
                                                    class="{{Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'}}">{{$subCategory['name']}}</span>
                                            </a>

                                            @if($subCategory->childes->count()>0)
                                            <a style="font-family:  sans-serif !important;font-size: 1rem;
                                                            font-weight: 300;line-height: 1.5;margin-left:50px;" data-toggle='dropdown'>
                                                <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} __inline-16"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                @foreach($subCategory['childes'] as $subSubCategory)
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{route('products',['id'=> $subSubCategory['id'],'data_from'=>'category','page'=>1])}}">{{$subSubCategory['name']}}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                    <!-- Primary menu-->
                    <ul class="navbar-nav" style="{{Session::get('direction') === "rtl" ? 'padding-right: 0px' : ''}}">
                        <li class="nav-item dropdown {{request()->is('/')?'active':''}}">
                            <a class="nav-link" href="{{route('home')}}">{{ \App\CPU\translate('Home')}}</a>
                        </li>

                        @if(\App\Model\BusinessSetting::where(['type'=>'product_brand'])->first()->value)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#"
                                data-toggle="dropdown">{{ \App\CPU\translate('brand') }}</a>
                            <ul class="dropdown-menu __dropdown-menu-sizing dropdown-menu-{{Session::get('direction') === "rtl" ? 'right' : 'left'}} scroll-bar"
                                style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                                @foreach(\App\CPU\BrandManager::get_active_brands() as $brand)
                                <li class="__inline-17">
                                    <div>
                                        <a class="dropdown-item"
                                            href="{{route('products',['id'=> $brand['id'],'data_from'=>'brand','page'=>1])}}">
                                            {{$brand['name']}}
                                        </a>
                                    </div>
                                    <div class="align-baseline">
                                        @if($brand['brand_products_count'] > 0 )
                                        <span class="count-value px-2">( {{ $brand['brand_products_count'] }} )</span>
                                        @endif
                                    </div>
                                </li>
                                @endforeach
                                <li class="__inline-17">
                                    <div>
                                        <a class="dropdown-item" href="{{route('brands')}}"
                                            style="color: var(--primary_color) !important;">
                                            {{ \App\CPU\translate('View_more') }}
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @php($discount_product = App\Model\Product::with(['reviews'])->active()->where('discount', '!=', 0)->count())
                        @if ($discount_product>0)
                        <li class="nav-item dropdown {{request()->is('/')?'active':''}}">
                            <a class="nav-link text-capitalize" href="{{route('products',['data_from'=>'discounted','page'=>1])}}">{{ \App\CPU\translate('discounted_products')}}</a>
                        </li>
                        @endif

                        @php($business_mode=\App\CPU\Helpers::get_business_settings('business_mode'))
                        @if ($business_mode == 'multi')
                        <!-- <li class="nav-item dropdown {{request()->is('/')?'active':''}}">
                                <a class="nav-link" href="{{route('sellers')}}">{{ \App\CPU\translate('Sellers')}}</a>
                            </li> -->

                        @php($seller_registration=\App\Model\BusinessSetting::where(['type'=>'seller_registration'])->first()->value)
                        @if($seller_registration)
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 0">
                                    {{ \App\CPU\translate('Seller')}} {{ \App\CPU\translate('zone')}}
                                </button>
                                <div class="dropdown-menu __dropdown-menu-3 __min-w-165px" aria-labelledby="dropdownMenuButton"
                                    style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                                    <a class="dropdown-item" href="{{route('shop.apply')}}">
                                        {{ \App\CPU\translate('Become a')}} {{ \App\CPU\translate('Seller')}}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('seller.auth.login')}}">
                                        {{ \App\CPU\translate('Seller')}} {{ \App\CPU\translate('login')}}
                                    </a>
                                </div>
                            </div>
                        </li>
                        @endif
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <button type="button" class="close {{Session::get('direction') === "rtl" ? 'ml-0 mr-auto' : ''}}" data-dismiss="modal" aria-label="Close" style="background: #f8f9fa; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; opacity: 1; transition: all 0.2s;">
                    <span aria-hidden="true" style="font-size: 20px; color: #333;">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 pb-5 text-center">
                <div id="notif-image-container" class="mb-4">
                    <img id="notif-image" src="" alt="" class="img-fluid rounded-lg shadow-sm" style="max-height: 250px; width: 100%; object-fit: cover; border-radius: 15px;">
                </div>
                <h4 id="notif-title" class="mb-3 font-weight-bold" style="color: {{$web_config['primary_color']}};"></h4>
                <div class="px-2">
                    <p id="notif-description" class="text-muted font-size-md mb-0 text-justify" style="line-height: 1.6; white-space: pre-wrap;"></p>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-secondary px-5" data-dismiss="modal" style="border-radius: 10px;">{{ \App\CPU\translate('Close') }}</button>
            </div>
        </div>
    </div>
</div>

@push('script')
{{-- <script src="{{ asset('firebase-messaging-sw.js') }}"></script> --}}
<script>
    function myFunction() {
        $('#anouncement').slideUp(300)
    }

    $(document).ready(function() {
        @if(auth('customer')->check())
            fetchNotifications();
        @endif
    });

    function fetchNotifications() {
        $.get({
            url: "{{route('get-notifications')}}",
            dataType: 'json',
            success: function (data) {
                $('#notification-list').html(data.view);
                if(data.count > 0){
                    $('.countNotification').text(data.count).show();
                    $('.countNotification').parent().addClass('animate__animated animate__pulse animate__infinite');
                } else {
                    // $('.countNotification').hide();
                    $('.countNotification').parent().removeClass('animate__animated animate__pulse animate__infinite');
                }
            },
        });
    }

    function openNotificationModal(id) {
        $.get({
            url: "{{route('read-notification')}}",
            data: { id: id },
            dataType: 'json',
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                $('#notif-title').text(data.title);
                $('#notif-description').text(data.description);
                if (data.image && !data.image.includes('placeholder')) {
                    $('#notif-image').attr('src', data.image).show();
                    $('#notif-image-container').show();
                } else {
                    $('#notif-image-container').hide();
                }
                $('#notificationModal').modal('show');
                fetchNotifications(); // Refresh to update unread count and read status in dropdown
            },
            complete: function () {
                $('#loading').hide();
            }
        });
    }

messaging.onMessage((payload) => {
    console.log(payload);   
    // show popup
    new Notification(payload.notification.title, {
        body: payload.notification.body
    });

    // reload bell data
    fetchNotifications();
});
    $(document).on('click', '#notification_icon', function() {
        fetchNotifications();
    });
</script>
@endpush
