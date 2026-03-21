    @extends('layouts.back-end.app-seller')

@section('title', \App\CPU\translate('Account Software(Tally)'))

@section('content')
    <div class="content container-fluid">

        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <i class="tio-settings"></i>
                {{ \App\CPU\translate('Account Software(Tally)') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h5 class="card-title mb-0">
                            {{ \App\CPU\translate('Companies in Tally') }}
                        </h5>
                        <div class="d-flex align-items-center gap-2 mt-2 mt-sm-0">
                            <h5 class="mb-0">{{ \App\CPU\translate('Enable Tally Sync') }}</h5>
                            <form action="{{ route('seller.shop.tally-companies.toggle-sync') }}" method="POST" id="tally_sync_form">
                                @csrf
                                <label class="switcher mx-auto">
                                    <input type="checkbox" class="switcher_input" name="tally_sync" value="1" {{ auth('seller')->user()->tally_sync ? 'checked' : '' }} onchange="document.getElementById('tally_sync_form').submit()">
                                    <span class="switcher_control"></span>
                                </label>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">

                        @if(auth('seller')->user()->tally_sync)
                           

                            <div class="table-responsive">
                                <table class="table table-hover table-borderless table-thead-bordered table-align-middle card-table w-100">
                                    <thead class="thead-light thead-50 text-capitalize">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ \App\CPU\translate('Company Name') }}</th>
                                            <th>{{ \App\CPU\translate('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($companies as $k => $company)
                                            <tr class="{{ $active_company == $company->company_name ? 'bg-soft-primary' : '' }}">
                                                <td>{{ $k + 1 }}</td>
                                                <td>
                                                    <span class="d-flex align-items-center gap-2">
                                                        <i class="tio-building-keystone text-primary"></i>
                                                        {{ $company->company_name }}
                                                        @if($active_company == $company->company_name)
                                                            <span class="badge badge-soft-success ml-2">{{ \App\CPU\translate('Active') }}</span>
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($active_company == $company->company_name)
                                                        <button class="btn btn-success btn-sm" disabled>
                                                            <i class="tio-checkmark-circle"></i> {{ \App\CPU\translate('Selected') }}
                                                        </button>
                                                    @else
                                                        <a href="{{ route('seller.shop.tally-companies.select-company', $company->company_name) }}"
                                                            class="btn btn--primary btn-sm">
                                                            {{ \App\CPU\translate('Select') }}
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center p-5">
                                <img class="mb-3 w-160"
                                    src="{{ asset('public/assets/back-end/svg/illustrations/sorry.svg') }}"
                                    alt="No Tally Connection">
                                <h5 class="text-muted">{{ \App\CPU\translate('Could not connect to Tally') }}</h5>
                                <p class="mb-0 text-muted">
                                    {{ \App\CPU\translate('Please make sure Tally is running and the URL is configured correctly.') }}
                                </p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
