@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Technical Name'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                <img src="{{asset('/public/assets/back-end/img/brand-setup.png')}}" alt="">
                {{\App\CPU\translate('Technical Name')}} {{\App\CPU\translate('Setup')}}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                        <form action="{{route('admin.sub-sub-category.store')}}" method="POST">
                            @csrf
                            @php($language=\App\Model\BusinessSetting::where('type','pnc_language')->first())
                            @php($language = $language->value ?? null)
                            @php($default_lang = 'en')
                            @if($language)
                                @php($default_lang = json_decode($language)[0])
                                <ul class="nav nav-tabs w-fit-content mb-4">
                                    @foreach(json_decode($language) as $lang)
                                        <li class="nav-item text-capitalize">
                                            <a class="nav-link lang_link {{$lang == $default_lang? 'active':''}}" href="#"
                                               id="{{$lang}}-link">{{ucfirst(\App\CPU\Helpers::get_language_name($lang)).'('.strtoupper($lang).')'}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="row">
                                    @foreach(json_decode($language) as $lang)
                                        <div
                                            class="col-12 form-group {{$lang != $default_lang ? 'd-none':''}} lang_form"
                                            id="{{$lang}}-form">
                                            <label class="title-color"
                                                   for="exampleFormControlInput1">{{\App\CPU\translate('Technical Name')}} {{\App\CPU\translate('name')}}<span class="text-danger">*</span>
                                                ({{strtoupper($lang)}})</label>
                                            <input type="text" name="name[]" class="form-control"
                                                   placeholder="{{\App\CPU\translate('New_Technical_Name')}}" {{$lang == $default_lang? 'required':''}}>
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{$lang}}">
                                    @endforeach
                                    @else
                                        <div class="col-12">
                                            <div class="form-group lang_form" id="{{$default_lang}}-form">
                                                <label
                                                    class="title-color">{{\App\CPU\translate('Technical Name')}} {{\App\CPU\translate('name')}}<span class="text-danger">*</span>
                                                    ({{strtoupper($default_lang)}})</label>
                                                <input type="text" name="name[]" class="form-control"
                                                       placeholder="{{\App\CPU\translate('New_Technical_Name')}}" required>
                                            </div>
                                            <input type="hidden" name="lang[]" value="{{$default_lang}}">
                                        </div>
                                    @endif

                                    <div class="col-12">
                                        <div class="d-flex flex-wrap gap-2 justify-content-end">
                                            <button type="reset" class="btn btn-secondary">{{\App\CPU\translate('reset')}}</button>
                                            <button type="submit" class="btn btn--primary">{{\App\CPU\translate('submit')}}</button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-20" id="cate-table">
            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-sm-5 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                <h5 class="text-capitalize d-flex gap-2">
                                    {{ \App\CPU\translate('technical_name_list')}}
                                    <span class="badge badge-soft-dark radius-50 fz-12">{{ $categories->total() }}</span>
                                </h5>
                            </div>
                            <div class="col-sm-7 col-md-6 col-lg-4">
                                <!-- Search -->
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-custom input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="{{\App\CPU\translate('Search_by_Technical_Name')}}" aria-label="Search orders" value="{{ $search }}" required>
                                        <button type="submit" class="btn btn--primary">{{\App\CPU\translate('search')}}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                            <tr>
                                <th>{{ \App\CPU\translate('SL')}}</th>
                                <th>{{ \App\CPU\translate('technical_name')}}</th>
                                <th class="text-center">{{ \App\CPU\translate('action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key=>$category)
                                <tr>
                                    <td>{{$category['id']}}</td>
                                    <td>{{$category['name']}}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-outline-info btn-sm square-btn"
                                                title="{{ \App\CPU\translate('Edit')}}"
                                                href="{{route('admin.category.edit',[$category['id']])}}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                title="{{ \App\CPU\translate('Delete')}}"
                                                id="{{$category['id']}}">
                                                <i class="tio-delete"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-4">
                        <div class="d-flex justify-content-lg-end">
                            <!-- Pagination -->
                            {{$categories->links()}}
                        </div>
                    </div>

                    @if(count($categories)==0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description">
                            <p class="mb-0">{{\App\CPU\translate('No_data_to_show')}}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{asset('assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
        $(".lang_link").click(function (e) {
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            console.log(lang);
            $("#" + lang + "-form").removeClass('d-none');
            if (lang == '{{$default_lang}}') {
                $(".from_part_2").removeClass('d-none');
            } else {
                $(".from_part_2").addClass('d-none');
            }
        });

        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>

    <script>
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            Swal.fire({
                title: '{{\App\CPU\translate('Are_you_sure_to_delete_this?')}}',
                text: "{{\App\CPU\translate('You_wont_be_able_to_revert_this!')}}",
                showCancelButton: true,
                type: 'warning',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{\App\CPU\translate('Yes')}}, {{\App\CPU\translate('delete_it')}}!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('admin.sub-sub-category.delete')}}",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('{{\App\CPU\translate('Technical_Name_Deleted_Successfully')}}.');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
