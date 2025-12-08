@extends('layouts.back-end.app')
@section('title', \App\CPU\translate('Chanal'))
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="{{asset('/public/assets/back-end/img/social media.png')}}" width="20" alt="">
                {{\App\CPU\translate('Chanal')}}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ \App\CPU\translate('Chanal form')}}</h5>
                    </div>
                    <div class="card-body">
                        <form style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="name" class="title-color">{{\App\CPU\translate('name')}}</label>
                                       <input type="text" name="name" class="form-control" id="name"
                                               placeholder="{{\App\CPU\translate('Enter Chanal Name')}}" required>
                                    </div>
                                   
                                    <div class="col-md-12">
                                        <input type="hidden" id="id">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-10 justify-content-end flex-wrap">
                                <a id="add" class="btn btn--primary px-4">{{ \App\CPU\translate('save')}}</a>
                                <a id="update" class="btn btn--primary px-4 d--none">{{ \App\CPU\translate('update')}}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <h5 class="mb-0 d-flex">{{ \App\CPU\translate('Chanal Table')}}</h5>
                    </div>
                    <div class="pb-3">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100" id="dataTable" cellspacing="0"
                                   style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th>{{ \App\CPU\translate('sl')}}</th>
                                        <th>{{ \App\CPU\translate('name')}}</th>
                                       
                                        <th>{{ \App\CPU\translate('status')}}</th>
                                       
                                        <th>{{ \App\CPU\translate('action')}}</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        fetch_chanal();

        function fetch_chanal() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.business-settings.chanal-fetch')}}",
                method: 'GET',
                success: function (data) {
console.log(data);
                    if (data.length != 0) {
                        var html = '';
                        for (var count = 0; count < data.length; count++) {
                            html += '<tr>';
                            html += '<td class="column_name" data-column_name="sl" data-id="' + data[count].id + '">' + (count + 1) + '</td>';
                            html += '<td class="column_name" data-column_name="name" data-id="' + data[count].id + '">' + data[count].name + '</td>';
                          
                            html += `<td class="column_name" data-column_name="status" data-id="${data[count].id}">
                                <label class="switcher">
                                    <input type="checkbox" class="switcher_input status" id="${data[count].id}" ${data[count].status == 1 ? "checked" : ""} >
                                    <span class="switcher_control"></span>
                                </label>
                            </td>`;
                            // html += '<td><a type="button" class="btn btn--primary btn-xs edit" id="' + data[count].id + '"><i class="fa fa-edit text-white"></i></a> <a type="button" class="btn btn-danger btn-xs delete" id="' + data[count].id + '"><i class="fa fa-trash text-white"></i></a></td></tr>';
                            html += '<td><a type="button" class="btn btn-outline--primary btn-xs edit square-btn" id="' + data[count].id + '"><i class="tio-edit"></i></a> </td></tr>';
                        }
                        $('tbody').html(html);
                    }
                }
            });
        }

        $('#add').on('click', function () {
            $('#add').attr("disabled", true);
            var name = $('#name').val();
          
            if (name == "") {
                toastr.error('{{\App\CPU\translate('Chanal Name Is Requeired')}}.');
                return false;
            }
          
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.business-settings.chanal-store')}}",
                method: 'POST',
                data: {
                    name: name,
                   
                },
                success: function (response) {
                    if (response.error == 1) {
                        toastr.error('{{\App\CPU\translate('Chanal Already taken')}}');
                    } else {
                        toastr.success('{{\App\CPU\translate('Chanal inserted Successfully')}}.');
                    }
                    $('#name').val('');
                
                    fetch_chanal();
                }
            });
        });
        $('#update').on('click', function () {
            $('#update').attr("disabled", true);
            var id = $('#id').val();
            var name = $('#name').val();
           if (name == "") {
                toastr.error('{{\App\CPU\translate('Chanal Name Is Requeired')}}.');
                return false;
            }
          
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.business-settings.chanal-update')}}",
                method: 'POST',
                data: {
                    id: id,
                    name: name,
                  
                },
                success: function (data) {
                    $('#name').val('');
                  
                    toastr.success('{{\App\CPU\translate('Chanal info updated Successfully')}}.');
                    $('#update').hide();
                    $('#add').show();
                    fetch_chanal();

                }
            });
            $('#save').hide();
        });
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            if (confirm("{{\App\CPU\translate('Are you sure delete this Chanal')}}?")) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('admin.business-settings.chanal-delete')}}",
                    method: 'POST',
                    data: {id: id},
                    success: function (data) {
                        fetch_chanal();
                        toastr.success('{{\App\CPU\translate('Social media deleted Successfully')}}.');
                    }
                });
            }
        });
        $(document).on('click', '.edit', function () {
            $('#update').show();
            $('#add').hide();
            var id = $(this).attr("id");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.business-settings.chanal-edit')}}",
                method: 'POST',
                data: {id: id},
                success: function (data) {
                    $(window).scrollTop(0);
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                   
                    fetch_chanal()
                }
            });
        });
        $(document).on('change', '.status', function () {
            var id = $(this).attr("id");
            if ($(this).prop("checked") == true) {
                var status = 1;
            } else if ($(this).prop("checked") == false) {
                var status = 0;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.business-settings.chanal-status-update')}}",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function () {
                    toastr.success('{{\App\CPU\translate('Status updated successfully')}}');
                }
            });
        });
    </script>
@endpush
