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

    /* Phase 3: Mobile Top Header Fix */
    .topbar {
        min-height: 40px;
        max-height: 45px;
    }

    .topbar .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        padding: 0 1rem;
    }

    .topbar > div {
        display: flex;
        align-items: center;
    }

    .topbar .topbar-link {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        line-height: 1;
        white-space: nowrap;
    }

    .topbar .topbar-link i {
        font-size: 0.8rem;
    }

    @media (max-width: 767px) {
        .topbar {
            min-height: 38px;
            padding: 0.15rem 0;
        }

        .topbar .container {
            padding: 0 0.75rem;
        }

        .topbar .topbar-link {
            font-size: 0.8rem;
            padding: 0.2rem 0;
        }

        .topbar .topbar-link i {
            font-size: 0.75rem;
        }

        .topbar img {
            width: 18px;
            height: 13px;
        }
    }

    /* Phase 4: Language Selector Redesign */
    .__language-bar {
        position: relative;
    }

    .__language-bar .dropdown-toggle::after {
        display: none;
    }

    .__language-bar .dropdown-menu {
        min-width: 200px;
        max-height: 320px;
        overflow-y: auto;
        border: 1px solid rgba(0,0,0,0.08);
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        padding: 0.5rem 0;
        margin-top: 0.5rem;
        animation: langDropdownFade 0.2s ease;
    }

    @keyframes langDropdownFade {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .__language-bar .dropdown-menu .dropdown-item {
        padding: 0.45rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        transition: background-color 0.15s;
    }

    .__language-bar .dropdown-menu .dropdown-item:hover {
        background-color: rgba(0,0,0,0.04);
    }

    .__language-bar .dropdown-menu .dropdown-item img {
        width: 20px;
        height: 14px;
        object-fit: cover;
        border-radius: 2px;
    }

    .lang-search-box {
        padding: 0.4rem 0.75rem;
        border-bottom: 1px solid rgba(0,0,0,0.06);
        margin-bottom: 0.25rem;
    }

    .lang-search-box input {
        width: 100%;
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 4px;
        padding: 0.3rem 0.5rem;
        font-size: 0.8rem;
        outline: none;
    }

    .lang-search-box input:focus {
        border-color: var(--primary_color);
    }

    .lang-active-indicator {
        margin-left: auto;
        color: var(--primary_color);
        font-size: 0.75rem;
    }
/* Mobile permanent search bar row */
.mobile-search-row {
    display: none;
    padding: 8px 12px 10px;
    background: #fff;
    border-top: 1px solid #eee;
}
@media (max-width: 767px) {
    .mobile-search-row { display: block; }
}
.mobile-search-row .input-group {
    position: relative;
}
.mobile-search-row .form-control {
    border-radius: 25px 0 0 25px;
    border: 1.5px solid var(--primary_color);
    padding-left: 16px;
    height: 40px;
    font-size: 0.9rem;
    box-shadow: none;
}
.mobile-search-row .search-btn {
    border-radius: 0 25px 25px 0;
    background: var(--primary_color);
    border: none;
    color: #fff;
    padding: 0 16px;
    height: 40px;
    cursor: pointer;
}

#mobileSuggestionBox {
    position: absolute;
    left: 0;
    right: 0;
    top: 100%;
    z-index: 9999;
    background: #fff;
    border-radius: 0 0 10px 10px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    max-height: 320px;
    overflow-y: auto;
    display: none;
}
#mobileSuggestionBox .suggestion-item {
    display: block !important;
    padding: 10px 16px;
    color: #333;
    border-bottom: 1px solid #f1f1f1;
    text-decoration: none;
    font-size: 0.88rem;
    cursor: pointer;
}
#mobileSuggestionBox .suggestion-item:hover {
    background: #f7f7f7;
}
/* Desktop suggestion box fix */
#desktopSearchOverlay {
    position: absolute;
    left: 0;
    right: 0;
    top: 100%;
    z-index: 9999;
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
<style>
    @media(width < 576px){
        header.box-shadow-sm.rtl.__inline-10{
                position: sticky !important;
                top: 0;
                z-index: 99;
        }
        header.box-shadow-sm.rtl.__inline-10 .navbar-stuck{
            position: static;
            animation: none;
        }
    }
</style>
<header class="box-shadow-sm rtl __inline-10" style="position:relative;">
         @if(isset($language_status) && $language_status == 1)
    <!-- Topbar-->
    <div class="topbar">
        <div class="container px-5">

            <div>
                <div class="topbar-text d-md-none {{Session::get('direction') === "rtl" ? 'mr-auto' : 'ml-auto'}}">
                    <a class="topbar-link" href="tel: {{$web_config['phone']->value}}">
                        <i class="fa fa-phone"></i> {{\App\CPU\translate('Call')}}
                    </a>
                </div>
                <div class="d-none d-md-flex {{Session::get('direction') === "rtl" ? 'mr-2' : 'mr-2'}} text-nowrap">
                    <a class="topbar-link" href="tel:{{$web_config['phone']->value}}">
                        <i class="fa fa-phone"></i> {{$web_config['phone']->value}}
                    </a>
                </div>
            </div>

       
            <div>
                @php( $local = \App\CPU\Helpers::default_lang())
                <div class="topbar-text dropdown disable-autohide __language-bar text-capitalize">
                    <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                        @foreach(json_decode($language['value'],true) as $data)
                        @if($data['code']==$local)
                        <img class="{{Session::get('direction') === "rtl" ? 'mr-2' : 'mr-2'}}" width="20"
                            src="{{asset('assets/front-end')}}/img/flags/{{$data['code']}}.png"
                            alt="{{$data['name']}}">
                        <span class="d-none d-sm-inline">{{$data['name']}}</span>
                        @endif
                        @endforeach
                        <i class="fa fa-chevron-down ml-1" style="font-size:0.6rem;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}">
                        <div class="lang-search-box">
                            <input type="text" id="langSearchInput" placeholder="{{\App\CPU\translate('Search language...')}}" autocomplete="off">
                        </div>
                        <div id="langList">
                        @foreach(json_decode($language['value'],true) as $key =>$data)
                        @if($data['status']==1)
                        <a class="dropdown-item lang-item" href="{{route('lang',[$data['code']])}}" data-name="{{strtolower($data['name'])}}">
                            <img src="{{asset('assets/front-end')}}/img/flags/{{$data['code']}}.png"
                                alt="{{$data['name']}}" />
                            <span>{{$data['name']}}</span>
                            @if($data['code']==$local)
                            <span class="lang-active-indicator"><i class="fa fa-check"></i></span>
                            @endif
                        </a>
                        @endif
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
  @endif

    <div class="navbar-sticky bg-light mobile-head">
       
        <div class="navbar px-3 navbar-expand-md navbar-light">
            <div class="container ">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand d-none d-sm-block {{Session::get('direction') === "rtl" ? 'mr-3' : 'mr-3'}} flex-shrink-0 __min-w-7rem" href="{{route('home')}}">
                    <img class="__inline-11"
                        src="{{asset(config('app.public_storage_path')."/company")."/".$web_config['web_logo']->value}}"
                        onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                        alt="{{$web_config['name']->value}}" />
                </a>
                <a class="navbar-brand d-sm-none {{Session::get('direction') === "rtl" ? 'mr-2' : 'mr-2'}}"
                    href="{{route('home')}}">
                    <img class="mobile-logo-img __inline-12"
                        src="{{asset(config('app.public_storage_path')."/company")."/".$web_config['mob_logo']->value}}"
                        onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                        alt="{{$web_config['name']->value}}" />
                </a>
                <!-- Search - Desktop-->
                <div class="input-group-overlay d-none d-md-block mx-4"
                    style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}}">
                    <form action="{{route('products')}}" type="submit" class="search_form">
                        <input class="form-control appended-form-control search-bar-input bh-search-input" type="text"
                            autocomplete="off"
                            placeholder="{{\App\CPU\translate('Search for seeds, fertilizers, pesticides...')}}"
                            name="name">
                        <button class="input-group-append-overlay search_button" type="submit"
                            style="border-radius: {{Session::get('direction') === "rtl" ? '7px 0px 0px 7px; right: unset; left: 0' : '0px 7px 7px 0px; left: unset; right: 0'}};top:0;  border: none; color: #fff; font-size: 16px; font-weight: 600; padding: 0 16px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                            <i class="fa fa-search"></i>
                        </button>
                        <input name="page" value="1" hidden>
                        <div class="card search-card __inline-13" id="desktopSearchOverlay" style="display:none;">
                            <div class="card-body search-result-box __h-400px overflow-x-hidden overflow-y-auto"></div>
                        </div>
                    </form>
                </div>

                <!-- Technical Names Button -->
                <div class="d-none d-md-flex align-items-center mx-2">
                    <a href="{{ route('technical-names') }}" class="btn btn-outline-primary btn-sm" style="border-radius: 20px; white-space: nowrap; font-size: 0.85rem; padding: 6px 16px;">
                        <i class="fa fa-tags mr-1"></i> {{ \App\CPU\translate('Technical Names') }}
                    </a>
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
                    {{-- <div class="navbar-tool dropdown {{Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'}}">
                        <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{route('wishlists')}}">
                            <span class="navbar-tool-label">
                                <span
                                    class="countWishlist">{{session()->has('wish_list')?count(session('wish_list')):0}}</span>
                            </span>
                            <i class="navbar-tool-icon czi-heart"></i>
                        </a>
                    </div> --}}
                    @if(auth('customer')->check())
                    {{-- <div class="navbar-tool dropdown {{Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'}}">
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
                    </div> --}}
                    <div class="dropdown">
                        <a class="navbar-tool ml-3" type="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="navbar-tool-icon-box bg-secondary">
                                <div class="navbar-tool-icon-box bg-secondary">
                                    <img src="{{asset(config('app.public_storage_path').'/profile/'.auth('customer')->user()->image)}}"
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

                    <!-- Search-- removed from here, now in main navbar -->

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
                                            <img src="{{asset(config('app.public_storage_path')."/category/$category->icon")}}"

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
                                        <img src="{{asset(config('app.public_storage_path')."/category/$category->icon")}}"
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
        <!-- Mobile Search Overlay -->
        <div id="mobileSearchOverlay" class="d-md-none" style="background:#fff; padding:10px 15px; box-shadow:0 4px 12px rgba(0,0,0,0.15); border-top:1px solid #eee;">
            <form action="{{route('products')}}" method="GET" id="mobileSearchForm">
                <input name="data_from" value="search" hidden>
                <input name="page" value="1" hidden>
                <div class="input-group position-relative">
                    <input class="form-control" type="text" autocomplete="off" value="{{ request()->name ?? '' }}"
                        placeholder="{{\App\CPU\translate('Search for products...')}}"
                        name="name" id="mobileSearchInput">
                    <button class="btn btn--primary" type="submit" style="flex-shrink:0; padding: 0 16px; font-size: 14px; font-weight: 500;">
                        <i class="fa fa-search"></i>
                    </button>
                    <div class="card search-card" style="display:none; position:absolute; left:0; right:0; top:100%; z-index:9999; box-shadow:0 4px 12px rgba(0,0,0,0.15);">
                        <div class="card-body search-result-box" style="overflow:auto; max-height:400px; overflow-x:hidden;"></div>
                    </div>
                </div>
            </form>
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
<script>
    jQuery(document).ready(function($) {
        function myFunction() {
            $('#anouncement').slideUp(300)
        }

        @if(auth('customer')->check())
            fetchNotifications();
        @endif

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
                    fetchNotifications();
                },
                complete: function () {
                    $('#loading').hide();
                }
            });
        }

        // Safe Firebase message listener
        try {
            if (typeof messaging !== 'undefined' && messaging) {
                messaging.onMessage((payload) => {
                    console.log(payload);
                    new Notification(payload.notification.title, {
                        body: payload.notification.body
                    });
                    fetchNotifications();
                });
            }
        } catch(e) {
            console.warn('Firebase messaging not available:', e);
        }

        // ==================== Search Suggestion ====================
        function debounce(fn, delay) {
            let timeout;
            return function () {
                clearTimeout(timeout);
                timeout = setTimeout(() => fn.apply(this, arguments), delay);
            };
        }

        function fetchSuggestions(query, $box) {
            if (!query || query.length < 2) {
                $box.hide().empty();
                return;
            }
            $.ajax({
                url: '{{ route("search-suggestions") }}',
                method: 'GET',
                data: { name: query },
                dataType: 'json',
                success: function(data) {
                    if (data && data.suggestions && data.suggestions.length > 0) {
                        var html = '';
                        $.each(data.suggestions, function(i, name) {
                            var safeName = $('<div>').text(name).html();
                            html += '<a class="suggestion-item" href="javascript:void(0)" data-name="' + safeName + '" style="display:block;padding:8px 12px;border-bottom:1px solid #eee;text-decoration:none;color:#333;">' + safeName + '</a>';
                        });
                        $box.html(html).show();
                    } else {
                        $box.hide().empty();
                    }
                },
                error: function(xhr, status, err) {
                    console.error('Suggestion AJAX error:', status, err);
                    $box.hide().empty();
                }
            });
        }

        // Desktop search input
        $(document).on('input', '.search-bar-input', debounce(function() {
            var q = $(this).val().trim();
            var $card = $(this).closest('.input-group-overlay').find('.search-card');
            var $box = $card.find('.search-result-box');
            if (!q || q.length < 2) { $card.hide(); return; }
            $card.css('display', 'block');
            fetchSuggestions(q, $box);
        }, 350));

        // Mobile search input
        $(document).on('input', '#mobileSearchInput', debounce(function() {
            var q = $(this).val().trim();
            var $card = $('#mobileSearchOverlay1 .search-card');
            var $box = $('#mobileSearchOverlay1 .search-result-box');
            if (!q || q.length < 2) { $card.hide(); return; }
            $card.css('display', 'block');
            fetchSuggestions(q, $box);
        }, 350));

        // Clicking a suggestion item
        $(document).on('click', '.suggestion-item', function(e) {
            e.preventDefault();
            var name = $(this).data('name') || $(this).text().trim();
            if ($(this).closest('#mobileSearchOverlay1').length) {
                $('#mobileSearchInput').val(name);
                
                $('#mobileSearchOverlay1').closest('form').submit();
            } else {
                $('.search-bar-input').val(name);
               
                $('.search_form').submit();
            }
        });

        // Close search suggestions on click outside (only hide dropdown, not search bar)
        $(document).on('mousedown', function(e) {
            if (!$(e.target).closest('.search-bar-input').length && 
                !$(e.target).closest('#mobileSearchInput').length &&
                !$(e.target).closest('.search-card').length) {
                
            }
        });

        // Also close on Escape key
        $(document).on('keyup', function(e) {
            if (e.key === 'Escape') {
                $('.search-bar-input, #mobileSearchInput').blur();
            }
        });

      

        $(document).on('click', '#notification_icon', function() {
            fetchNotifications();
        });

    });
</script>
@endpush
