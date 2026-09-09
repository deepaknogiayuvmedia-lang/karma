@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Product List'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid"> <!-- Page Heading -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ \App\CPU\translate('Dashboard') }}</a>
                </li>
                @if ($pro['data'] != null && $pro->first()->request_status == 0)
                    <li class="breadcrumb-item" aria-current="page">{{ \App\CPU\translate('New') }}
                        {{ \App\CPU\translate('Products') }}</li>
                @elseif($pro['data'] != null && $pro->first()->request_status == 1)
                    <li class="breadcrumb-item" aria-current="page">{{ \App\CPU\translate('Approved') }}
                        {{ \App\CPU\translate('Products') }}</li>
                @elseif($pro['data'] != null && $pro->first()->request_status == 2)
                    <li class="breadcrumb-item" aria-current="page">{{ \App\CPU\translate('Denied') }}
                        {{ \App\CPU\translate('Products') }}</li>
                @else
                    <li class="breadcrumb-item" aria-current="page">{{ \App\CPU\translate('Products') }} </li>
                @endif
            </ol>
        </nav>

        <div class="row __mt-20">
            <div class="col-md-12">
                <div class="card">
                    @if ($pro->first() != null && $pro->first()->added_by == 'in_house')
                        <div class="card-header">
                            <h5>{{ \App\CPU\translate('product_table') }}</h5>
                            <a href="{{ route('admin.product.add-new') }}" class="btn btn--primary  float-right">
                                <i class="tio-add-circle"></i>
                                <span class="text">{{ \App\CPU\translate('Add new product') }}</span>
                            </a>
                        </div>
                    @endif
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="datatable"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ \App\CPU\translate('SL') }}</th>
                                        <th>{{ \App\CPU\translate('Product Name') }}</th>
                                        <th>{{ \App\CPU\translate('purchase_price') }}</th>
                                        <th>{{ \App\CPU\translate('selling_price') }}</th>
                                        @if ($pro->first() != null && $pro->first()->request_status != 2)
                                            <th>{{ \App\CPU\translate('featured') }}</th>
                                            <th>{{ \App\CPU\translate('Active') }} {{ \App\CPU\translate('status') }}</th>
                                        @endif
                                        <th class="text-center __w-5px">{{ \App\CPU\translate('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pro as $k => $p)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <a href="{{ route('admin.product.view', [$p['id']]) }}">
                                                    {{ substr($p['name'], 0, 20) }}{{ strlen($p['name']) > 20 ? '...' : '' }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price'])) }}
                                            </td>
                                            <td>
                                                {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price'])) }}
                                            </td>
                                            @if ($p->request_status != 2)
                                                <td>
                                                    <label  class="mx-auto switcher">
                                                        <input class="switcher_input featured-toggle" type="checkbox"
                                                            data-id="{{ $p['id'] }}"
                                                            {{ $p->featured == 1 ? 'checked' : '' }}>
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label  class="mx-auto switcher">
                                                        <input type="checkbox" class="status switcher_input"
                                                            data-id="{{ $p['id'] }}"
                                                            {{ $p->status == 1 ? 'checked' : '' }}>
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </td>
                                            @endif
                                            <td>
                                                <a class="btn btn--primary btn-sm"
                                                    href="{{ route('admin.product.edit', [$p['id']]) }}">
                                                    <i class="tio-edit"></i>{{ \App\CPU\translate('Edit') }}
                                                </a>
                                                <a class="btn btn-danger btn-sm" href="javascript:"
                                                    onclick="form_alert('product-{{ $p['id'] }}','Want to delete this item ?')">
                                                    <i class="tio-add-to-trash"></i> {{ \App\CPU\translate('Delete') }}
                                                </a>
                                                <form action="{{ route('admin.product.delete', [$p['id']]) }}"
                                                    method="post" id="product-{{ $p['id'] }}">
                                                    @csrf @method('delete')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $pro->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/back-end') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script>
        // Featured Toggle
        $(document).on('change', '.featured-toggle', function() {
            var checkbox = $(this);
            var id = checkbox.data('id');
            var originalState = !checkbox.prop('checked');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.product.featured-status') }}",
                method: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response && response.success) {
                        toastr.success(
                            '{{ \App\CPU\translate('Featured status updated successfully') }}');
                    } else {
                        checkbox.prop('checked', originalState);
                        toastr.error('{{ \App\CPU\translate('Something went wrong') }}');
                    }
                },
                error: function() {
                    checkbox.prop('checked', originalState);
                    toastr.error('{{ \App\CPU\translate('Something went wrong') }}');
                }
            });
        });

        // Status Toggle
        $(document).on('change', '.status', function() {
            var checkbox = $(this);
            var id = checkbox.attr("id");
            var status = checkbox.prop("checked") ? 1 : 0;
            var originalState = !checkbox.prop("checked");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.product.status-update') }}",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function(data) {
                    if (data.success == true) {
                        toastr.success('{{ \App\CPU\translate('Status updated successfully') }}');
                    } else {
                        checkbox.prop('checked', originalState);
                        toastr.error(
                            '{{ \App\CPU\translate('Status updated failed. Product must be approved') }}'
                            );
                    }
                },
                error: function() {
                    checkbox.prop('checked', originalState);
                    toastr.error('{{ \App\CPU\translate('Something went wrong') }}');
                }
            });
        });
    </script>
@endpush
