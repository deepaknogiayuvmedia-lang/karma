@extends('delivery-man-views.layouts.app')

@section('title', \App\CPU\translate('earning'))

@section('content')
<div class="mb-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
    <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
        <img width="20" src="{{asset('assets/back-end/img/earning.png')}}" alt="">
        {{\App\CPU\translate('earning_statement')}}
    </h2>
    @if(($withdrawable ?? 0) > 0)
    <a href="{{ route('delivery-man.withdraw.form') }}" class="btn btn--primary">
        <i class="tio-send mr-1"></i> Withdraw Request
    </a>
    @endif
</div>

<!-- Wallet Overview -->
<div class="row g-2 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="business-analytics">
            <div class="business-analytics__icon" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <i class="fas fa-wallet"></i>
            </div>
            <h2 class="business-analytics__title">{{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($totalEarning ?? 0)) }}</h2>
            <h5 class="business-analytics__subtitle">{{\App\CPU\translate('total_earned')}}</h5>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="business-analytics">
            <div class="business-analytics__icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <h2 class="business-analytics__title">{{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($wallet->cash_in_hand ?? 0)) }}</h2>
            <h5 class="business-analytics__subtitle">{{\App\CPU\translate('cash_in_hand')}}</h5>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="business-analytics">
            <div class="business-analytics__icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <h2 class="business-analytics__title">{{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($wallet->pending_withdraw ?? 0)) }}</h2>
            <h5 class="business-analytics__subtitle">{{\App\CPU\translate('pending_withdraw')}}</h5>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="business-analytics">
            <div class="business-analytics__icon" style="background: linear-gradient(135deg, #f5af19 0%, #f12711 100%);">
                <i class="fas fa-check-double"></i>
            </div>
            <h2 class="business-analytics__title">{{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($wallet->total_withdraw ?? 0)) }}</h2>
            <h5 class="business-analytics__subtitle">{{\App\CPU\translate('total_withdrawn')}}</h5>
        </div>
    </div>
</div>

<!-- Transactions -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="tio-list-numbered"></i> {{\App\CPU\translate('transaction_history')}}</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{\App\CPU\translate('date')}}</th>
                        <th>{{\App\CPU\translate('type')}}</th>
                        <th>{{\App\CPU\translate('credit')}}</th>
                        <th>{{\App\CPU\translate('debit')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $key => $tx)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $tx->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            @if($tx->transaction_type == 'deliveryman_charge')
                                <span class="badge badge-success">Delivery Charge</span>
                            @elseif($tx->transaction_type == 'cash_in_hand')
                                <span class="badge badge-warning">Cash Collected</span>
                            @else
                                <span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $tx->transaction_type)) }}</span>
                            @endif
                        </td>
                        <td class="text-success">
                            @if($tx->credit > 0)
                                +{{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($tx->credit)) }}
                            @endif
                        </td>
                        <td class="text-danger">
                            @if($tx->debit > 0)
                                -{{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($tx->debit)) }}
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <img class="mb-3 w-160" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg" alt="">
                            <p class="mb-0">{{\App\CPU\translate('no_data_to_show')}}</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $transactions->links() }}
    </div>
</div>
@endsection
