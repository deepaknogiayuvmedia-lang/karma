@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('My Payments'))

@push('css_or_js')
    <style>
        .tdBorder {
            border-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 1px solid #f7f0f0;
        }
        .marl {
            margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 7px;
        }
        #account-payments .pay-empty {
            border: 1.5px dashed #D9DEE7;
            border-radius: 16px;
            background: #FAFBFC;
            padding: 48px 24px;
            text-align: center;
        }
        #account-payments .pay-empty i {
            font-size: 40px;
            color: #D1D5DB;
            margin-bottom: 12px;
            display: block;
        }
        #account-payments .pay-empty h6 {
            font-size: 15px;
            font-weight: 500;
            color: #6B7280;
            margin: 0;
        }
        #account-payments .pay-badge {
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 999px;
            text-transform: capitalize;
            font-weight: 600;
        }
        #account-payments .pay-badge.paid,
        #account-payments .pay-badge.complete,
        #account-payments .pay-badge.success,
        #account-payments .pay-badge.paid_successfully {
            background: #ECFDF5;
            color: #047857;
        }
        #account-payments .pay-badge.failed,
        #account-payments .pay-badge.cancelled,
        #account-payments .pay-badge.canceled {
            background: #FEF2F2;
            color: #B91C1C;
        }
        #account-payments .pay-badge.pending {
            background: #FFFBEB;
            color: #B45309;
        }
        #account-payments .pay-amount {
            font-weight: 700;
            color: #111827;
        }
        #account-payments .pay-meta {
            font-size: 12.5px;
            color: #6B7280;
        }
    </style>
@endpush

@section('content')
    <div class="container text-center">
        <h3 class="headerTitle my-3">{{\App\CPU\translate('Payment History')}}</h3>
    </div>

    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 mt-3 rtl"
         style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="row">
            <!-- Sidebar-->
        @include('web-views.partials._profile-aside')
        <!-- Content  -->
            <section class="col-lg-9 col-md-9" id="account-payments">
                <div class="card __card shadow-0">
                    <div class="card-body p-0">
                        @if(count($transactions) > 0)
                            <div class="table-responsive">
                                <table class="table __table text-center">
                                    <thead class="thead-light">
                                    <tr>
                                        <td class="tdBorder">
                                            <div class="py-2"><span
                                                    class="d-block spandHeadO">{{\App\CPU\translate('Tranx')}} {{\App\CPU\translate('ID')}}</span>
                                            </div>
                                        </td>
                                        <td class="tdBorder">
                                            <div class="py-2"><span
                                                    class="d-block spandHeadO">{{\App\CPU\translate('payment_method')}}</span>
                                            </div>
                                        </td>
                                        <td class="tdBorder">
                                            <div class="py-2"><span
                                                    class="d-block spandHeadO">{{\App\CPU\translate('Status')}}</span>
                                            </div>
                                        </td>
                                        <td class="tdBorder">
                                            <div class="py-2"><span
                                                    class="d-block spandHeadO">{{\App\CPU\translate('Total')}}</span>
                                            </div>
                                        </td>
                                        <td class="tdBorder">
                                            <div class="py-2"><span
                                                    class="d-block spandHeadO">{{\App\CPU\translate('Date')}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td class="bodytr font-weight-bold">
                                                <span class="marl">{{ $transaction->id }}</span>
                                            </td>
                                            <td class="bodytr">
                                                <span class="text-capitalize">{{ $transaction->payment_method ?: '-' }}</span>
                                            </td>
                                            <td class="bodytr">
                                                @php($status = strtolower((string)($transaction->payment_status ?? 'pending')))
                                                <span class="pay-badge {{ $status }}">{{ $transaction->payment_status ?: '-' }}</span>
                                            </td>
                                            <td class="bodytr">
                                                <span class="pay-amount">{{ \App\CPU\Helpers::currency_converter($transaction->amount) }}</span>
                                            </td>
                                            <td class="bodytr">
                                                <span class="pay-meta">{{ $transaction->created_at }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer border-0">
                                {{ $transactions->links() }}
                            </div>
                        @else
                            <div class="pay-empty m-3">
                                <i class="fa fa-credit-card"></i>
                                <h6>{{\App\CPU\translate('No payment found')}}!</h6>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
