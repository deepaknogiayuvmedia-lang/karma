@extends('delivery-man-views.layouts.app')

@section('title', 'Withdraw Request')

@section('content')

<div class="mb-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
    <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
        <i class="tio-wallet" style="font-size:24px; color:#377dff;"></i>
        Withdraw Request
    </h2>
    <a href="{{ route('delivery-man.earning') }}" class="btn btn-outline-secondary btn-sm">
        <i class="tio-arrow-left mr-1"></i> Back to Earning
    </a>
</div>

<div class="row g-3">

    {{-- LEFT: Withdraw Form --}}
    <div class="col-lg-7">

        <div class="card">
            <div class="card-header d-flex align-items-center gap-2 py-3">
                <i class="tio-money text--primary"></i>
                <h5 class="card-title mb-0">Submit Withdraw Request</h5>
            </div>
            <div class="card-body">

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="tio-warning"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="tio-checkmark-circle"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
                @endif

                {{-- Available Balance --}}
                <div class="text-center p-3 mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; color: white;">
                    <small style="font-size:12px; letter-spacing:1px; opacity:0.9;">AVAILABLE TO WITHDRAW</small>
                    <h2 class="mb-0 mt-1" style="font-size:32px; font-weight:700;">
                        {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($withdrawable)) }}
                    </h2>
                </div>

                <form id="withdrawForm" action="{{ route('delivery-man.withdraw.request') }}" method="POST">
                    @csrf

                    {{-- Amount --}}
                    <div class="form-group">
                        <label class="font-weight-bold">Amount <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold" style="font-size:16px;">&#x20B9;</span>
                            </div>
                            <input type="number" name="amount" class="form-control" id="withdrawAmount"
                                   min="1" max="{{ floor($withdrawable) }}"
                                   placeholder="Enter amount" required step="1"
                                   style="font-size:18px; font-weight:600; padding:12px;">
                        </div>
                        <small class="text-muted">Maximum: {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($withdrawable)) }}</small>
                        @error('amount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Quick Amount Buttons --}}
                    <div class="d-flex gap-2 mb-3 flex-wrap">
                        @php $max = floor($withdrawable); @endphp
                        @if($max >= 100)
                        <button type="button" class="btn btn-outline-secondary btn-sm quick-amt" data-amt="100">&#x20B9;100</button>
                        @endif
                        @if($max >= 500)
                        <button type="button" class="btn btn-outline-secondary btn-sm quick-amt" data-amt="500">&#x20B9;500</button>
                        @endif
                        @if($max >= 1000)
                        <button type="button" class="btn btn-outline-secondary btn-sm quick-amt" data-amt="1000">&#x20B9;1000</button>
                        @endif
                        @if($max >= 2000)
                        <button type="button" class="btn btn-outline-secondary btn-sm quick-amt" data-amt="2000">&#x20B9;2000</button>
                        @endif
                        @if($max > 0)
                        <button type="button" class="btn btn-outline-primary btn-sm" id="maxBtn">
                            <i class="tio-maximize-3"></i> Max
                        </button>
                        @endif
                    </div>

                    {{-- Payment Method --}}
                    <div class="form-group">
                        <label class="font-weight-bold">Payment Method <span class="text-danger">*</span></label>
                        <select name="payment_method" class="form-control" id="paymentMethod" required>
                            <option value="">-- Select Payment Method --</option>
                            <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>
                                Bank Transfer
                            </option>
                            <option value="bkash" {{ old('payment_method') == 'bkash' ? 'selected' : '' }}>
                                bKash
                            </option>
                            <option value="nagad" {{ old('payment_method') == 'nagad' ? 'selected' : '' }}>
                                Nagad
                            </option>
                            <option value="rocket" {{ old('payment_method') == 'rocket' ? 'selected' : '' }}>
                                Rocket
                            </option>
                            <option value="manual" {{ old('payment_method') == 'manual' ? 'selected' : '' }}>
                                Manual
                            </option>
                        </select>
                        @error('payment_method')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Account Number --}}
                    <div class="form-group">
                        <label class="font-weight-bold">Account / Phone Number <span class="text-danger">*</span></label>
                        <input type="text" name="account_number" class="form-control"
                               value="{{ old('account_number') }}"
                               placeholder="e.g. 01XXXXXXXXX or Account No" required>
                        @error('account_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Account Holder Name --}}
                    <div class="form-group">
                        <label class="font-weight-bold">Account Holder Name <small class="text-muted">(Optional)</small></label>
                        <input type="text" name="account_holder_name" class="form-control"
                               value="{{ old('account_holder_name') }}"
                               placeholder="Name as on account">
                        @error('account_holder_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Note --}}
                    <div class="form-group">
                        <label class="font-weight-bold">Note <small class="text-muted">(Optional)</small></label>
                        <textarea name="note" class="form-control" rows="2"
                                  placeholder="Any note for admin...">{{ old('note') }}</textarea>
                        @error('note')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn--primary btn-block" id="submitBtn"
                            {{ $withdrawable <= 0 ? 'disabled' : '' }}
                            style="padding:12px; font-size:16px; font-weight:600;">
                        <i class="tio-send mr-1"></i> Submit Withdraw Request
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- RIGHT: Withdraw History --}}
    <div class="col-lg-5">

        {{-- Withdraw Info --}}
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="business-analytics__icon" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); width:44px; height:44px; font-size:16px;">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block" style="font-size:11px;">Total Balance</small>
                        <span class="font-weight-bold" style="font-size:18px;">
                            {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($totalEarning)) }}
                        </span>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="business-analytics__icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); width:44px; height:44px; font-size:16px;">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block" style="font-size:11px;">Pending Withdraw</small>
                        <span class="font-weight-bold" style="font-size:18px;">
                            {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($wallet->pending_withdraw ?? 0)) }}
                        </span>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="business-analytics__icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); width:44px; height:44px; font-size:16px;">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block" style="font-size:11px;">Cash In Hand</small>
                        <span class="font-weight-bold" style="font-size:18px;">
                            {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($wallet->cash_in_hand ?? 0)) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Withdrawal History --}}
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2 py-3">
                <i class="tio-list-numbered text--primary"></i>
                <h5 class="card-title mb-0">Withdrawal History</h5>
            </div>
            <div class="card-body p-0">
                <?php $withdrawals = \App\Model\WithdrawRequest::where('delivery_man_id', $deliveryMan->id)->orderBy('id', 'desc')->take(10)->get(); ?>
                @forelse($withdrawals as $wd)
                <div class="d-flex align-items-center justify-content-between px-3 py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                    <div class="d-flex align-items-center gap-2">
                        @if($wd->approved == 1)
                            <span class="btn btn-xs btn-soft-success" style="border-radius:50%; width:32px; height:32px; padding:0; display:flex; align-items:center; justify-content:center;">
                                <i class="tio-checkmark"></i>
                            </span>
                        @elseif($wd->approved == 2)
                            <span class="btn btn-xs btn-soft-danger" style="border-radius:50%; width:32px; height:32px; padding:0; display:flex; align-items:center; justify-content:center;">
                                <i class="tio-clear"></i>
                            </span>
                        @else
                            <span class="btn btn-xs btn-soft-warning" style="border-radius:50%; width:32px; height:32px; padding:0; display:flex; align-items:center; justify-content:center;">
                                <i class="tio-clock"></i>
                            </span>
                        @endif
                        <div>
                            <div class="font-weight-bold" style="font-size:14px;">
                                {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($wd->amount)) }}
                            </div>
                            <small class="text-muted" style="font-size:11px;">
                                {{ $wd->created_at->format('d M Y') }}
                            </small>
                        </div>
                    </div>
                    <div>
                        @if($wd->approved == 1)
                            <span class="badge badge-soft-success">Approved</span>
                        @elseif($wd->approved == 2)
                            <span class="badge badge-soft-danger">Denied</span>
                        @else
                            <span class="badge badge-soft-warning">Pending</span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-4">
                    <i class="tio-inbox" style="font-size:36px; color:#ccc;"></i>
                    <p class="text-muted mt-2 mb-0">No withdrawal requests yet</p>
                </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

@endsection

@push('script')
<script>
    // Quick amount buttons
    document.querySelectorAll('.quick-amt').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.getElementById('withdrawAmount').value = this.dataset.amt;
        });
    });

    // Max button
    var maxBtn = document.getElementById('maxBtn');
    if (maxBtn) {
        maxBtn.addEventListener('click', function() {
            var maxVal = document.getElementById('withdrawAmount').getAttribute('max');
            document.getElementById('withdrawAmount').value = maxVal;
        });
    }

    // SweetAlert on submit
    var form = document.getElementById('withdrawForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            var amount = document.getElementById('withdrawAmount').value;
            var method = document.getElementById('paymentMethod').value;

            if (!amount || amount <= 0 || !method) return;

            e.preventDefault();

            var methodNames = {
                'bank_transfer': 'Bank Transfer',
                'bkash': 'bKash',
                'nagad': 'Nagad',
                'rocket': 'Rocket',
                'manual': 'Manual'
            };

            Swal.fire({
                title: 'Confirm Withdrawal?',
                html: '<p class="mb-1">Amount: <strong>' + amount + '</strong></p>' +
                      '<p class="mb-0">Method: <strong>' + (methodNames[method] || method) + '</strong></p>',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#377dff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Submit!',
                cancelButtonText: 'Cancel'
            }).then(function(result) {
                if (result.value) {
                    form.submit();
                }
            });
        });
    }
</script>
@endpush
