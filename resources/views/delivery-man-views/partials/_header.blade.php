<div id="headerMain" class="d-none">
    <header id="header" class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-flush navbar-container navbar-bordered">
        <div class="navbar-nav-wrap">
            <div class="navbar-brand-wrapper">
                <!-- Logo -->
                @php($e_commerce_logo=\App\Model\BusinessSetting::where(['type'=>'company_web_logo'])->first()->value)
                <a class="navbar-brand" href="{{route('delivery-man.dashboard')}}" aria-label="">
                    <img class="navbar-brand-logo"
                        onerror="this.src='{{asset('assets/back-end/img/900x400/img1.jpg')}}'"
                        src="{{asset(config('app.public_storage_path').'/company/'.$e_commerce_logo)}}" alt="Logo" height="40">
                    <img class="navbar-brand-logo-mini"
                        onerror="this.src='{{asset('assets/back-end/img/900x400/img1.jpg')}}'"
                        src="{{asset(config('app.public_storage_path').'/company/'.$e_commerce_logo)}}" alt="Logo" height="40">
                </a>
                <!-- End Logo -->
            </div>

            <div class="navbar-nav-wrap-content-left">
                <!-- Navbar Vertical Toggle -->
                <button type="button" class="js-navbar-vertical-aside-toggle-invoker close mr-3 d-xl-none">
                    <i class="tio-first-page navbar-vertical-aside-toggle-short-align" data-toggle="tooltip"
                        data-placement="right" title="Collapse"></i>
                    <i class="tio-last-page navbar-vertical-aside-toggle-full-align"
                        data-template='<div class="tooltip d-none d-sm-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                        data-toggle="tooltip" data-placement="right" title="Expand"></i>
                </button>
                <!-- End Navbar Vertical Toggle -->
            </div>

            <!-- Secondary Content -->
            <div class="navbar-nav-wrap-content-right"
                style="{{Session::get('direction') === 'rtl' ? 'margin-left:unset; margin-right: auto' : 'margin-right:unset; margin-left: auto'}}">
                <!-- Navbar -->
                <ul class="navbar-nav align-items-center flex-row">
                    <!-- Website Home -->
                    <li class="nav-item d-none d-md-inline-block">
                        <div class="hs-unfold">
                            <a title="Website Home"
                                class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                                href="{{route('home')}}" target="_blank">
                                <i class="tio-globe"></i>
                            </a>
                        </div>
                    </li>

                    <!-- Account Dropdown -->
                    <li class="nav-item">
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker media align-items-center gap-3 navbar-dropdown-account-wrapper dropdown-toggle dropdown-toggle-left-arrow" href="javascript:;"
                                data-hs-unfold-options='{
                                    "target": "#accountNavbarDropdown",
                                    "type": "css-animation"
                                }'>
                                <div class="d-none d-md-block media-body text-right">
                                    <h5 class="profile-name mb-0">{{auth('delivery_man')->user()->f_name}} {{auth('delivery_man')->user()->l_name}}</h5>
                                    <span class="fz-12">{{auth('delivery_man')->user()->email}}</span>
                                </div>
                                <div class="avatar avatar-sm avatar-circle">
                                    <img class="avatar-img"
                                        onerror="this.src='{{asset('assets/back-end/img/160x160/img1.jpg')}}'"
                                        src="{{asset('storage/delivery-man/'.(auth('delivery_man')->user()->image ?? 'def.png'))}}"
                                        alt="Image Description">
                                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                </div>
                            </a>

                            <div id="accountNavbarDropdown"
                                class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account __w-16rem">
                                <div class="dropdown-item-text">
                                    <div class="media align-items-center text-break">
                                        <div class="avatar avatar-sm avatar-circle mr-2">
                                            <img class="avatar-img"
                                                onerror="this.src='{{asset('assets/back-end/img/160x160/img1.jpg')}}'"
                                                src="{{asset('storage/delivery-man/'.(auth('delivery_man')->user()->image ?? 'def.png'))}}"
                                                alt="Image Description">
                                        </div>
                                        <div class="media-body">
                                            <span class="card-title h5">{{auth('delivery_man')->user()->f_name}} {{auth('delivery_man')->user()->l_name}}</span>
                                            <span class="card-text">{{auth('delivery_man')->user()->email}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{route('delivery-man.profile')}}">
                                    <span class="text-truncate pr-2" title="Profile">{{\App\CPU\translate('Profile')}}</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="javascript:" onclick="Swal.fire({
                                    title: '{{\App\CPU\translate('Do you want to logout')}}?',
                                    showDenyButton: true,
                                    showCancelButton: true,
                                    confirmButtonColor: '#377dff',
                                    cancelButtonColor: '#363636',
                                    confirmButtonText: `Yes`,
                                    denyButtonText: `Don't Logout`,
                                    }).then((result) => {
                                    if (result.value) {
                                        location.href='{{route('delivery-man.auth.logout')}}';
                                    } else {
                                        Swal.fire('Canceled', '', 'info')
                                    }
                                    })">
                                    <span class="text-truncate pr-2" title="Sign out">{{\App\CPU\translate('Sign out')}}</span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- End Navbar -->
            </div>
            <!-- End Secondary Content -->
        </div>
    </header>
</div>
<div id="headerFluid"></div>
<div id="headerDouble"></div>
