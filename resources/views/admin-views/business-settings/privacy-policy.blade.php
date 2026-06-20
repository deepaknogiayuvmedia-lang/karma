@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Privacy policy'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="{{asset('/public/assets/back-end/img/Pages.png')}}" width="20" alt="">
                {{\App\CPU\translate('pages')}}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Inlile Menu -->
        @include('admin-views.business-settings.pages-inline-menu')
        <!-- End Inlile Menu -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{\App\CPU\translate('privacy_policy')}}</h5>
                    </div>

                    <form action="{{route('admin.business-settings.privacy-policy')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <textarea class="form-control textarea editor-textarea ckeditor"  name="value">{{$privacy_policy->value}}</textarea>
                            </div>
                            <div class="form-group">
                                <input class="form-control btn--primary" type="submit" name="btn">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
   {{--ck editor--}}
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        $('.textarea').ckeditor({
            contentsLangDirection : '{{Session::get('direction')}}',
        });
    </script>
    {{--ck editor--}}
@endpush


