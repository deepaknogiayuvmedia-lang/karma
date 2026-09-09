@extends('layouts.back-end.app-seller')

@section('title',\App\CPU\translate('Product List'))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">

    <!-- Page Title -->
    <div class="mb-4 d-flex flex-wrap gap-3 justify-content-between align-items-center">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <img width="20" src="{{asset('assets/back-end/img/products.png')}}" alt="">
            {{\App\CPU\translate('Winning Bidding List ')}}
            <span class="badge badge-soft-dark radius-50 fz-14 ml-1"></span>
        </h2>

    </div>
    <!-- End Page Title -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="px-3 py-4">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <h1>{{\App\CPU\translate('Self Biddings')}}</h1>
                        </div>
                        <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">
                            <form action="{{ url()->current() }}" method="GET">
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-custom">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tio-search"></i>
                                        </div>
                                    </div>
                                    <input id="datatableSearch_" type="search" name="search" class="form-control"
                                        placeholder="{{\App\CPU\translate('Search by Product Name')}}" aria-label="Search orders" value="" required>
                                    <button type="submit" class="btn btn--primary">{{\App\CPU\translate('search')}}</button>
                                </div>
                                <!-- End Search -->
                            </form>

                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="datatable" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                        class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                        <thead class="thead-light thead-50 text-capitalize">
                            <tr>
                                <th>{{\App\CPU\translate('SL')}}</th>
                                <th>{{\App\CPU\translate('Product Name')}}</th>
                                <th>Product Quantity</th>
                                <th>Bid Amount</th>
                                <th>{{\App\CPU\translate('Description')}}</th>
                                <th>{{\App\CPU\translate('status')}}</th>
                                <th>{{\App\CPU\translate('vander Invoice')}}</th>
                                <th class="text-center __w-5px">{{\App\CPU\translate('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($biddings as $key=>$product)
                            @php
                            $bidders = json_decode($product->bedders); // default: stdClass objects [web:23]
                            $bidprice = 0;

                            if (is_array($bidders) || $bidders instanceof Traversable) {
                            foreach ($bidders as $key => $bid) {
                            if (is_object($bid) && isset($bid->done) && $bid->done == 1 && isset($bid->price) &&  $bid->vendor_id == auth('seller')->id()) {
                            $bidprice = $bid->price;
                            }
                            }
                            }
                            @endphp

                            @if($bidprice != 0)

                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->product_qty}}</td>
                                <td>
                                    {{ $bidprice }}
                                </td>
                                <td>{{ $product->details }}</td>

                                <td>
                                    <button class="btn btn-warning btn-sm " data-id="{{$product->id}}">
                                        Win
                                    </button>
                                </td>
                                <td>
                                    <input type="file" name="file" id="" class="pdf-file form-control"  accept=".pdf,application/pdf" required>
                                     <small class="form-text text-muted">Only PDF files are accepted (Max: 10MB)</small>
                                      <span class=" error-msg"></span>
                                </td>
                                <td class="text-center __w-5px">
                                    <button class="btn btn-outline--primary btn-sm edit-btn pdf-form" data-id="{{ $product->id }}">
                                        <i class="tio-edit"></i> Submit
                                    </button>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive mt-4">
                    <div class="px-4 d-flex justify-content-lg-end">
                        <!-- Pagination -->
                        {{$biddings->links()}}
                    </div>
                </div>
                @if ($biddings->isEmpty())
                <div class="text-center p-4">
                    <img class="mb-3 w-160" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description">
                    <p class="mb-0">{{\App\CPU\translate('No data to show')}}</p>
                </div>
                @endif


            </div>
        </div>

    </div>
</div>
@endsection

@push('script')

<script>

    // Validate and handle PDF file on submit button click
    $('.pdf-form').on('click', function(e) {
        e.preventDefault();

        const $btn = $(this);
        const $tr = $btn.closest('tr');
        const $fileInput = $tr.find('.pdf-file');
        const file = $fileInput[0] ? $fileInput[0].files[0] : null;
        const $errorMsg = $tr.find('.error-msg');

        $errorMsg.text('');

        if (!file) {
            $errorMsg.css('color', 'red').text('Please select a PDF file');
            return;
        }

        // Check file type (some browsers may not provide accurate mime, so check extension too)
        const isPdf = file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf');
        if (!isPdf) {
            $errorMsg.css('color', 'red').text('Only PDF files are allowed');
            $fileInput.val('');
            return;
        }

        // Check file size (10MB)
        const maxSize = 10 * 1024 * 1024; // 10MB
        if (file.size > maxSize) {
            $errorMsg.css('color', 'red').text(`File size must be less than 10MB <br> (Your file: ${(file.size / 1024 / 1024).toFixed(2)}MB)`);
            $fileInput.val('');
            return;
        }

        // If validation passes, indicate ready state. Integration (upload) can be added here.
        $errorMsg.css('color', 'green').text(`Ready to upload: ${file.name} (${(file.size / 1024).toFixed(2)} KB)`);

        // Optional: trigger a custom event so other scripts can perform the actual upload
        $tr.trigger('pdf:validated', [file, $btn.data('id')]);
    });

    // Real-time file validation on change
    $('.pdf-file').on('change', function() {
        const file = this.files[0];
        const $tr = $(this).closest('tr');
        const $errorMsg = $tr.find('.error-msg');

        $errorMsg.text('');
        if (!file) return;

        if (file.type !== 'application/pdf' && !file.name.toLowerCase().endsWith('.pdf')) {
            $errorMsg.css('color', 'red').text('❌ Invalid file type. Only PDF allowed');
            this.value = '';
            return;
        }

        const maxSize = 10 * 1024 * 1024;
        if (file.size > maxSize) {
            $errorMsg.css('color', 'red').text(`❌ File too large: ${(file.size / 1024 / 1024).toFixed(2)}MB (Max: 10MB)`);
            this.value = '';
            return;
        }

        $errorMsg.css('color', 'green').text(`✅ ${file.name} (${(file.size / 1024).toFixed(2)} KB)`);
    });

    // Handle validated PDF and upload via AJAX
    $(document).on('pdf:validated', function(e, file, biddingId) {
        const $tr = $(e.target).is('tr') ? $(e.target) : $(document).find(`button[data-id="${biddingId}"]`).closest('tr');
        const $errorMsg = $tr.find('.error-msg');
        const $btn = $tr.find('.pdf-form');
        const $fileInput = $tr.find('.pdf-file');

        if (!file || !biddingId) {
            $errorMsg.css('color', 'red').text('Missing file or bidding id');
            return;
        }

        const formData = new FormData();
        formData.append('invoice', file);
        formData.append('bidding_id', biddingId);

        $btn.prop('disabled', true).text('Uploading...');

        $.ajax({
            url: '{{ route('seller.product.upload_invoice') }}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.status === 'success') {
                    $errorMsg.css('color', 'green').html('Upload successful');
                    // Optionally disable file input to prevent re-upload
                    $fileInput.prop('disabled', true);
                    $btn.html('<i class="tio-check"></i> Uploaded');
                } else {
                    $errorMsg.css('color', 'red').text(res.message || 'Upload failed');
                    $btn.prop('disabled', false).text('Submit');
                }
            },
            error: function(xhr) {
                const msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Upload failed';
                $errorMsg.css('color', 'red').text(msg);
                $btn.prop('disabled', false).text('Submit');
            }
        });
    });

</script>
@endpush
