@extends('layouts.back-end.app-seller')

@section('title', \App\CPU\translate('Change Requests'))

@section('content')
    <div class="content container-fluid">
        <div class="mb-4">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img width="20" src="{{ asset('assets/back-end/img/products.png') }}" alt="">
                {{ \App\CPU\translate('Change Requests') }}
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $requests->total() }}</span>
            </h2>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{ \App\CPU\translate('SL') }}</th>
                                    <th>{{ \App\CPU\translate('Product Name') }}</th>
                                    <th>{{ \App\CPU\translate('Action') }}</th>
                                    <th>{{ \App\CPU\translate('Status') }}</th>
                                    <th>{{ \App\CPU\translate('Changes Summary') }}</th>
                                    <th>{{ \App\CPU\translate('Admin Note') }}</th>
                                    <th>{{ \App\CPU\translate('Date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $k => $req)
                                    <tr>
                                        <th scope="row">{{ $requests->firstitem() + $k }}</th>
                                        <td>
                                            @if($req->product)
                                                <a href="{{ route('seller.product.view', [$req->product_id]) }}">
                                                    {{ \Illuminate\Support\Str::limit($req->product->name, 40) }}
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('seller.product.view-change-request', [$req->id]) }}" class="btn btn-sm btn-outline-primary">
                                                {{ \App\CPU\translate('View') }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($req->status == 'pending')
                                                <label class="badge badge-soft-warning">{{ \App\CPU\translate('Pending') }}</label>
                                            @elseif($req->status == 'approved')
                                                <label class="badge badge-soft-success">{{ \App\CPU\translate('Approved') }}</label>
                                            @elseif($req->status == 'rejected')
                                                <label class="badge badge-soft-danger">{{ \App\CPU\translate('Rejected') }}</label>
                                            @endif
                                        </td>
                                        <td>
                                            @if($req->new_data && $req->old_data)
                                                @php
                                                    $changes = [];
                                                    foreach($req->new_data as $key => $val) {
                                                        if($key == 'temp_images') continue;
                                                        $old = $req->old_data[$key] ?? '';
                                                        if($old != $val) {
                                                            $changes[] = str_replace('_', ' ', $key);
                                                        }
                                                    }
                                                @endphp
                                                {{ implode(', ', array_slice($changes, 0, 5)) }}
                                                {{ count($changes) > 5 ? '...' : '' }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $req->admin_note ?? '-' }}</td>
                                        <td>{{ $req->created_at->format('d M Y, h:i A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-4">
                        <div class="px-4 d-flex justify-content-lg-end">
                            {{ $requests->links() }}
                        </div>
                    </div>

                    @if (count($requests) == 0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160" src="{{ asset('assets/back-end') }}/svg/illustrations/sorry.svg" alt="Image Description">
                            <p class="mb-0">{{ \App\CPU\translate('No data to show') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
