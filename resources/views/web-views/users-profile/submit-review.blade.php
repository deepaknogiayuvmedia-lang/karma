@extends('layouts.front-end.app')

@section('title', \App\CPU\translate('submit_a_review'))

@section('content')

    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 mt-2 rtl"
        style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
        <div class="row">
            <!-- Sidebar-->
            @include('web-views.partials._profile-aside')
            <section class="col-lg-9  col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="__ml-20">{{ \App\CPU\translate('submit_a_review') }}</h5>
                    </div>
                    <div class="card-body">
                        <style>
                            /* .star-rating input[type="radio"] {
                                        display: none;
                                    } */

                            .star-rating label {
                                color: #d3d3d3;
                                font-size: 24px;
                                padding: 0 5px;
                                cursor: pointer;
                            }
                        </style>
                        @if (!isset($reting_details))
                            <form action="{{ route('review.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                        @endif
                        <div class="modal-body">

                            <div class="p-4 rounded border mb-4" style="background-color: #f9f9f9;">
                                <h5 class="mb-4 font-weight-bold">{{ \App\CPU\translate('Rate_Your_Experience') }}</h5>

                                <div class="form-group d-flex align-items-center justify-content-between mb-3">
                                    <label
                                        class="mb-0 font-weight-bold">{{ \App\CPU\translate('product_package_rating') }}</label>
                                    <div class="d-flex flex-row-reverse star-rating">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="pkg{{ $i }}" name="product_package"
                                                value="{{ $i }}"
                                                {{ isset($reting_details) && $reting_details->product_package == $i ? 'checked' : '' }}
                                                {{ isset($reting_details) ? 'disabled' : '' }}>
                                            <label for="pkg{{ $i }}"
                                                class="{{ isset($reting_details) && $reting_details->product_package >= $i ? 'czi-star-filled' : 'czi-star' }}"
                                                style="color: {{ isset($reting_details) && $reting_details->product_package >= $i ? '#f2b01e' : '#d3d3d3' }};"></label>
                                        @endfor
                                    </div>
                                </div>

                                <div class="form-group d-flex align-items-center justify-content-between mb-3">
                                    <label
                                        class="mb-0 font-weight-bold">{{ \App\CPU\translate('product_delivery_rating') }}</label>
                                    <div class="d-flex flex-row-reverse star-rating">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="del{{ $i }}" name="product_delivery"
                                                value="{{ $i }}"
                                                {{ isset($reting_details) && $reting_details->product_delivery == $i ? 'checked' : '' }}
                                                {{ isset($reting_details) ? 'disabled' : '' }}>
                                            <label for="del{{ $i }}"
                                                class="{{ isset($reting_details) && $reting_details->product_delivery >= $i ? 'czi-star-filled' : 'czi-star' }}"
                                                style="color: {{ isset($reting_details) && $reting_details->product_delivery >= $i ? '#f2b01e' : '#d3d3d3' }};"></label>
                                        @endfor
                                    </div>
                                </div>

                                <div class="form-group d-flex align-items-center justify-content-between mb-0">
                                    <label
                                        class="mb-0 font-weight-bold">{{ \App\CPU\translate('product_quality_rating') }}</label>
                                    <div class="d-flex flex-row-reverse star-rating">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="qual{{ $i }}" name="product_quality"
                                                value="{{ $i }}"
                                                {{ isset($reting_details) && $reting_details->product_quality == $i ? 'checked' : '' }}
                                                {{ isset($reting_details) ? 'disabled' : '' }}>
                                            <label for="qual{{ $i }}"
                                                class="{{ isset($reting_details) && $reting_details->product_quality >= $i ? 'czi-star-filled' : 'czi-star' }}"
                                                style="color: {{ isset($reting_details) && $reting_details->product_quality >= $i ? '#f2b01e' : '#d3d3d3' }};"></label>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">{{ \App\CPU\translate('comment') }}</label>
                                <input name="product_id" value="{{ $order_details->product_id }}" hidden>
                                <input name="order_id" value="{{ $order_details->order_id }}" hidden>
                                <textarea class="form-control" name="comment" rows="4"
                                    placeholder="{{ \App\CPU\translate('Leave_your_review_here...') }}"
                                    {{ isset($reting_details) ? 'readonly' : '' }}>{{ $reting_details->comment ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                @if (isset($reting_details) && $reting_details->attachment)
                                    <label
                                        class="font-weight-bold mb-2">{{ \App\CPU\translate('attached_images') }}</label>
                                    <div class="d-flex flex-wrap" style="gap: 10px;">
                                        @foreach (json_decode($reting_details->attachment, true) ?: [] as $attachment)
                                            <img src="{{ asset('storage/review/' . $attachment) }}" alt="Review Image"
                                                class="border rounded object-cover" width="100" height="100">
                                        @endforeach
                                    </div>
                                @else
                                    <label class="font-weight-bold">{{ \App\CPU\translate('attachment') }}</label>
                                    <div class="row coba"></div>
                                    <div class="mt-2 text-muted">
                                        <small>{{ \App\CPU\translate('File type: jpg, jpeg, png. Maximum size: 2MB') }}</small>
                                    </div>
                                @endif
                            </div>

                        </div>
                        @if (!isset($reting_details))
                            <div class="modal-footer">
                                <a href="{{ URL::previous() }}"
                                    class="btn btn-secondary">{{ \App\CPU\translate('back') }}</a>

                                <button type="submit" class="btn btn--primary">{{ \App\CPU\translate('submit') }}</button>
                            </div>


                            </form>
                        @endif
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection

@push('script')
    <script src="{{ asset('public/assets/front-end/js/spartan-multi-image-picker.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $(".coba").spartanMultiImagePicker({
                fieldName: 'fileUpload[]',
                maxCount: 5,
                rowHeight: '150px',
                groupClassName: 'col-md-4',
                placeholderImage: {
                    image: '{{ asset('public/assets/front-end/img/image-place-holder.png') }}',
                    width: '100%'
                },
                dropFileLabel: "{{ \App\CPU\translate('drop_here') }}",
                onAddRow: function(index, file) {

                },
                onRenderedPreview: function(index) {

                },
                onRemoveRow: function(index) {

                },
                onExtensionErr: function(index, file) {
                    toastr.error('{{ \App\CPU\translate('input_png_or_jpg') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function(index, file) {
                    toastr.error('{{ \App\CPU\translate('file_size_too_big') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });


            // reting star

            $('.star-rating input[type="radio"]').click(function() {
                var rating = $(this).val();

                var parent = $(this).closest('.star-rating');
                parent.find('label').removeClass('czi-star-filled').addClass('czi-star').css('color',
                    '#d3d3d3');

                parent.find('input[type="radio"]').each(function() {
                    if ($(this).val() <= rating) {
                        $(this).next('label').removeClass('czi-star').addClass('czi-star-filled')
                            .css('color', '#f2b01e');
                    }
                });
                $(this).attr('checked', true);

            });
        });
    </script>
@endpush
