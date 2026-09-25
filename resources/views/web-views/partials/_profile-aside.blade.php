<div class="col-lg-3 col-md-4 mb-4 mb-md-0">
    <style>
        .nav-link.d-flex.align-items-center {
            color: #4b566b !important;
        }
        .nav-link.d-flex.align-items-center i{
            margin-right: 10px;
        }
        .nav-link.d-flex.align-items-center.text-danger{
           color: #f34770 !important;
        }
    </style>
    <div class="card border shadow-sm rounded-lg p-3" style="background-color: var(--bh-surface, #ffffff);">
        <div class="text-center pb-3 mb-3 border-bottom">
            <div class="mb-2">
                <img src="{{ asset(config('app.public_storage_path').'/profile/'.auth('customer')->user()->image) }}"
                    onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                    class="rounded-circle border" width="70" height="70" style="object-fit: cover;">
            </div>
            <h6 class="font-weight-bold mb-0" style="color: var(--bh-text-primary, #1B1F1D);">
                {{ auth('customer')->user()->f_name }} {{ auth('customer')->user()->l_name }}
            </h6>
            <small class="text-muted">{{ auth('customer')->user()->phone ?? auth('customer')->user()->email }}</small>
        </div>

        <div class="nav flex-column nav-pills" style="gap: 4px; font-size: 0.88rem;">
            <a class="nav-link d-flex align-items-center gap-2 py-2 px-3 {{ Request::is('account-oder*') || Request::is('account-order-details*') ? 'active bg-success text-white' : 'text-dark' }}"
               href="{{ route('account-oder') }}" style="border-radius: var(--bh-radius-sm);">
                <i class="fa fa-shopping-bag w-20"></i> {{\App\CPU\translate('My Orders')}}
            </a>
            
            <a class="nav-link d-flex align-items-center gap-2 py-2 px-3 {{ Request::is('wishlists*') ? 'active bg-success text-white' : 'text-dark' }}"
               href="{{ route('wishlists') }}" style="border-radius: var(--bh-radius-sm);">
                <i class="fa fa-heart w-20"></i> {{\App\CPU\translate('Wishlist')}}
            </a>

            <a class="nav-link d-flex align-items-center gap-2 py-2 px-3 {{ Request::is('track-order*') ? 'active bg-success text-white' : 'text-dark' }}"
               href="{{ route('track-order.index') }}" style="border-radius: var(--bh-radius-sm);">
                <i class="fa fa-map-marker w-20"></i> {{\App\CPU\translate('Track Order')}}
            </a>

            @if (\App\CPU\Helpers::get_business_settings('loyalty_point_status') == 1)
                <a class="nav-link d-flex align-items-center gap-2 py-2 px-3 {{ Request::is('wallet') ? 'active bg-success text-white' : 'text-dark' }}"
                   href="{{ route('wallet') }}" style="border-radius: var(--bh-radius-sm);">
                    <i class="czi-wallet w-20"></i> {{\App\CPU\translate('my_wallet')}}
                </a>
            @endif

            <a class="nav-link d-flex align-items-center gap-2 py-2 px-3 {{ Request::is('user-account*') ? 'active bg-success text-white' : 'text-dark' }}"
               href="{{ route('user-account') }}" style="border-radius: var(--bh-radius-sm);">
                <i class="fa fa-user w-20"></i> {{\App\CPU\translate('Profile Info')}}
            </a>

            <a class="nav-link d-flex align-items-center gap-2 py-2 px-3 {{ Request::is('account-address*') ? 'active bg-success text-white' : 'text-dark' }}"
               href="{{ route('account-address') }}" style="border-radius: var(--bh-radius-sm);">
                <i class="fa fa-address-book w-20"></i> {{\App\CPU\translate('Saved Addresses')}}
            </a>

            <a class="nav-link d-flex align-items-center gap-2 py-2 px-3 {{ (Request::is('account-ticket*') || Request::is('support-ticket*')) ? 'active bg-success text-white' : 'text-dark' }}"
               href="{{ route('account-tickets') }}" style="border-radius: var(--bh-radius-sm);">
                <i class="czi-support w-20"></i> {{\App\CPU\translate('Support Tickets')}}
            </a>

            <hr class="my-2">

            <a class="nav-link d-flex align-items-center gap-2 py-2 px-3 text-danger" href="{{ route('customer.auth.logout') }}">
                <i class="fa fa-sign-out w-20"></i> {{\App\CPU\translate('Logout')}}
            </a>
        </div>
    </div>
</div>
