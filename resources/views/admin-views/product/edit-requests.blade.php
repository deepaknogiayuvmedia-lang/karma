@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Product Edit Requests'))

@section('content')
    <div class="content container-fluid">
        <div class="mb-4">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img width="20" src="{{ asset('assets/back-end/img/products.png') }}" alt="">
                {{ \App\CPU\translate('Product Edit Requests') }}
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $requests->total() }}</span>
            </h2>
        </div>

        <!-- Status Filter -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.product.edit-requests') }}" method="GET">
                            <div class="row align-items-end gap-3">
                                <div class="col-md-3">
                                    <label>{{ \App\CPU\translate('Status') }}</label>
                                    <select name="status" class="form-control">
                                        <option value="">{{ \App\CPU\translate('All') }}</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ \App\CPU\translate('Pending') }}</option>
                                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>{{ \App\CPU\translate('Approved') }}</option>
                                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>{{ \App\CPU\translate('Rejected') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn--primary">{{ \App\CPU\translate('Filter') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                                    <th>{{ \App\CPU\translate('Seller') }}</th>
                                    <th>{{ \App\CPU\translate('Status') }}</th>
                                    <th>{{ \App\CPU\translate('Seller Note') }}</th>
                                    <th>{{ \App\CPU\translate('Admin Note') }}</th>
                                    <th>{{ \App\CPU\translate('Date') }}</th>
                                    <th>{{ \App\CPU\translate('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $k => $req)
                                    <tr>
                                        <th scope="row">{{ $requests->firstitem() + $k }}</th>
                                        <td>
                                            @if($req->product)
                                                <a href="{{ route('admin.product.view', [$req->product_id]) }}">
                                                    {{ \Illuminate\Support\Str::limit($req->product->name, 40) }}
                                                </a>
                                            @else
                                                <span class="text-muted">Product Deleted</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($req->seller)
                                                {{ $req->seller->f_name }} {{ $req->seller->l_name }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($req->status == 'pending')
                                                <label class="badge badge-soft-warning">{{ \App\CPU\translate('Pending') }}</label>
                                            @elseif($req->status == 'approved')
                                                <label class="badge badge-soft-success">{{ \App\CPU\translate('Approved') }}</label>
                                            @elseif($req->status == 'rejected')
                                                <label class="badge badge-soft-danger">{{ \App\CPU\translate('Rejected') }}</label>
                                            @elseif($req->status == 'used')
                                                <label class="badge badge-soft-info">{{ \App\CPU\translate('Used') }}</label>
                                            @endif
                                        </td>
                                        <td>{{ $req->seller_note ?? '-' }}</td>
                                        <td>{{ $req->admin_note ?? '-' }}</td>
                                        <td>{{ $req->created_at->format('d M Y, h:i A') }}</td>
                                        <td>
                                            @if($req->status == 'pending')
                                                <div class="d-flex gap-10">
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveModal{{ $req->id }}">
                                                        <i class="tio-checkmark-circle"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rejectModal{{ $req->id }}">
                                                        <i class="tio-clear-circle"></i>
                                                    </button>
                                                </div>

                                                <!-- Approve Modal -->
                                                <div class="modal fade" id="approveModal{{ $req->id }}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <form action="{{ route('admin.product.approve-edit-request') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $req->id }}">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">{{ \App\CPU\translate('Approve Edit Request') }}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>{{ \App\CPU\translate('Admin Note') }} (Optional)</label>
                                                                        <textarea name="admin_note" class="form-control" rows="3"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ \App\CPU\translate('Cancel') }}</button>
                                                                    <button type="submit" class="btn btn-success">{{ \App\CPU\translate('Approve') }}</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <!-- Reject Modal -->
                                                <div class="modal fade" id="rejectModal{{ $req->id }}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <form action="{{ route('admin.product.reject-edit-request') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $req->id }}">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">{{ \App\CPU\translate('Reject Edit Request') }}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>{{ \App\CPU\translate('Admin Note') }} *</label>
                                                                        <textarea name="admin_note" class="form-control" rows="3" required></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ \App\CPU\translate('Cancel') }}</button>
                                                                    <button type="submit" class="btn btn-danger">{{ \App\CPU\translate('Reject') }}</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
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
