@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Membership Plan'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="{{asset('/public/assets/back-end/img/coupon_setup.png')}}" alt="">
                {{\App\CPU\translate('Membership_Plan_Setup')}}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="{{route('admin.membership-plan.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="form-group">
                                        <label class="title-color">{{\App\CPU\translate('Plan_Name')}}</label>
                                        <input type="text" name="name" class="form-control" placeholder="{{\App\CPU\translate('Ex: Basic')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="form-group">
                                        <label class="title-color">{{\App\CPU\translate('Price')}}</label>
                                        <input type="number" step="0.01" name="price" class="form-control" placeholder="{{\App\CPU\translate('Ex: 500')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="form-group">
                                        <label class="title-color">{{\App\CPU\translate('User_Type')}}</label>
                                        <select name="user_type" class="form-control" required>
                                            <option value="customer">{{\App\CPU\translate('Customer')}}</option>
                                            <option value="seller">{{\App\CPU\translate('Seller')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-12 col-12">
                                    <div class="form-group">
                                        <label class="title-color">{{\App\CPU\translate('Duration')}}</label>
                                        <div class="input-group">
                                            <input type="number" name="duration" class="form-control" placeholder="{{\App\CPU\translate('Ex: 1')}}" required>
                                            <select name="duration_type" class="form-control">
                                                <option value="day">{{\App\CPU\translate('Day')}}</option>
                                                <option value="month" selected>{{\App\CPU\translate('Month')}}</option>
                                                <option value="year">{{\App\CPU\translate('Year')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="title-color">{{\App\CPU\translate('Features')}}</label>
                                        <div id="feature-list">
                                            <div class="d-flex mb-2 gap-2">
                                                <input type="text" name="features[]" class="form-control" placeholder="{{\App\CPU\translate('Feature_Description')}}">
                                                <button type="button" class="btn btn-primary btn-sm add-feature"><i class="tio-add"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-3">
                                <button type="reset" class="btn btn-secondary px-4">{{\App\CPU\translate('reset')}}</button>
                                <button type="submit" class="btn btn--primary btn-primary px-4">{{\App\CPU\translate('submit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-20">
            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                <h5 class="mb-0 text-capitalize d-flex gap-2">
                                    {{\App\CPU\translate('Plan_List')}}
                                    <span class="badge badge-soft-dark radius-50 fsz-12">{{$plans->total()}}</span>
                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{\App\CPU\translate('SL')}}</th>
                                    <th>{{\App\CPU\translate('Name')}}</th>
                                    <th>{{\App\CPU\translate('User_Type')}}</th>
                                    <th>{{\App\CPU\translate('Price')}}</th>
                                    <th>{{\App\CPU\translate('Duration')}}</th>
                                    <th>{{\App\CPU\translate('Status')}}</th>
                                    <th class="text-center">{{\App\CPU\translate('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($plans as $key => $plan)
                                <tr>
                                    <td>{{$plans->firstItem() + $key}}</td>
                                    <td>{{$plan->name}}</td>
                                    <td>{{ucfirst($plan->user_type)}}</td>
                                    <td>{{ $plan->price }}</td>
                                    <td>{{$plan->duration}} {{ucfirst($plan->duration_type)}}(s)</td>
                                    <td>
                                        <label class="switcher mx-auto">
                                            <input type="checkbox" class="switcher_input status-change"
                                                   data-id="{{$plan->id}}" {{$plan->status == 1 ? 'checked' : ''}}>
                                            <span class="switcher_control"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-outline--primary btn-sm edit"
                                               title="{{\App\CPU\translate('Edit')}}"
                                               href="{{route('admin.membership-plan.edit', [$plan->id])}}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <a class="btn btn-outline-danger btn-sm delete"
                                               title="{{\App\CPU\translate('Delete')}}"
                                               href="javascript:"
                                               onclick="form_alert('plan-{{$plan->id}}', 'Want to delete this plan ?')">
                                                <i class="tio-delete"></i>
                                            </a>
                                            <form action="{{route('admin.membership-plan.delete', [$plan->id])}}"
                                                  method="GET" id="plan-{{$plan->id}}">
                                                @csrf
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-4">
                        <div class="px-4 d-flex justify-content-lg-end">
                            {{$plans->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).on('click', '.add-feature', function () {
            $('#feature-list').append(`
                <div class="d-flex mb-2 gap-2">
                    <input type="text" name="features[]" class="form-control" placeholder="{{\App\CPU\translate('Feature_Description')}}">
                    <button type="button" class="btn btn-danger btn-sm remove-feature"><i class="tio-delete"></i></button>
                </div>
            `);
        });

        $(document).on('click', '.remove-feature', function () {
            $(this).parent().remove();
        });

        $(document).on('change', '.status-change', function () {
            let id = $(this).data('id');
            let status = $(this).prop('checked') ? 1 : 0;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
                url: "{{route('admin.membership-plan.status-update')}}",
                data: {
                    id: id,
                    status: status
                },
                success: function (data) {
                    toastr.success(data.message);
                }
            });
        });
    </script>
@endpush
