@extends('layouts.back-end.app-seller')

@section('title', \App\CPU\translate('Product Preview'))

@push('css_or_js')
    <style>
        .product-slider { position: relative; overflow: hidden; border-radius: 8px; }
        .product-slider .slider-main { width: 100%; height: 300px; display: flex; align-items: center; justify-content: center; background: #f8f9fa; border-radius: 8px; overflow: hidden; }
        .product-slider .slider-main img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .product-slider .slider-thumbs { display: flex; gap: 8px; margin-top: 10px; overflow-x: auto; padding-bottom: 5px; }
        .product-slider .slider-thumbs .thumb-item { width: 60px; height: 60px; min-width: 60px; border: 2px solid #ddd; border-radius: 6px; overflow: hidden; cursor: pointer; opacity: 0.6; transition: all 0.3s; }
        .product-slider .slider-thumbs .thumb-item.active { border-color: #007bff; opacity: 1; }
        .product-slider .slider-thumbs .thumb-item:hover { opacity: 1; }
        .product-slider .slider-thumbs .thumb-item img { width: 100%; height: 100%; object-fit: cover; }
        .product-slider .slider-nav { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.9); border: none; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 2; box-shadow: 0 2px 6px rgba(0,0,0,0.15); transition: all 0.3s; }
        .product-slider .slider-nav:hover { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.25); }
        .product-slider .slider-nav.prev { left: 10px; }
        .product-slider .slider-nav.next { right: 10px; }
        .product-slider .slider-counter { position: absolute; bottom: 10px; right: 10px; background: rgba(0,0,0,0.6); color: #fff; padding: 2px 10px; border-radius: 12px; font-size: 12px; }
    </style>
@endpush

@section('content')
    <div class="content container-fluid"
         style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <!-- Page Header -->
        <div class="page-header pb-0 mb-0 border-0">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-10 mb-3">
                <div class="">
                    <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                        <img width="20" onerror="this.src='{{asset('assets/back-end/img/160x160/img2.jpg')}}'"
                             src="{{asset('/assets/back-end/img/products.png')}}" alt="">
                        {{$product['name']}}
                    </h2>
                </div>
                <div class="d-flex justify-content-end flex-wrap gap-10">
                    <a href="{{url()->previous()}}" class="btn btn--primary">
                        <i class="tio-back-ui"></i> {{\App\CPU\translate('Back')}}
                    </a>
                    @if($product['request_status'] == 2 || ($product['approval_status'] ?? '') == 'rejected')
                        <a href="{{ route('seller.product.edit', [$product['id']]) }}" class="btn btn--primary">
                            <i class="tio-edit"></i> {{\App\CPU\translate('Edit & Resubmit')}}
                        </a>
                    @endif
                </div>
            </div>
            @if($product['request_status'] == 2 || ($product['approval_status'] ?? '') == 'rejected')
                <div class="card mb-3 mb-lg-5 mt-2 mt-lg-3 bg-warning">
                    <div class="card-body text-center">
                        <span class="text-dark fw-bold">{{\App\CPU\translate('denied_note')}}:</span>
                        <span class="text-dark">{{ $product['denied_note'] ?: \App\CPU\translate('No reason provided') }}</span>
                    </div>
                </div>
            @endif
        </div>

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- Basic Info -->
                <div class="card mb-3 mb-lg-5">
                    <div class="card-header">
                        <h5 class="mb-0">{{\App\CPU\translate('Basic Information')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <span class="text-muted">{{\App\CPU\translate('Product Name')}}:</span>
                                    <p class="mb-0 fw-bold">{{ $product->name }}</p>
                                </div>
                                @php
                                    $name_hi = $product->translations->where('locale','hi')->where('key','name')->first();
                                @endphp
                                @if($name_hi)
                                    <div class="mb-3">
                                        <span class="text-muted">{{\App\CPU\translate('Name')}} (HI):</span>
                                        <p class="mb-0">{{ $name_hi->value }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <span class="text-muted">{{\App\CPU\translate('Product Code')}}:</span>
                                    <p class="mb-0">{{ $product->code }}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <span class="text-muted">{{\App\CPU\translate('description')}}:</span>
                                    <div class="mt-1">{!! $product->details !!}</div>
                                </div>
                                @php
                                    $desc_hi = $product->translations->where('locale','hi')->where('key','description')->first();
                                @endphp
                                @if($desc_hi)
                                    <div class="mb-0 mt-3">
                                        <span class="text-muted">{{\App\CPU\translate('description')}} (HI):</span>
                                        <div class="mt-1">{!! $desc_hi->value !!}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pricing Info -->
                <div class="card mb-3 mb-lg-5">
                    <div class="card-header">
                        <h5 class="mb-0">{{\App\CPU\translate('Pricing & Tax')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <span class="text-muted d-block">{{\App\CPU\translate('Unit_price')}}</span>
                                <span class="fw-bold fs-5">{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($product['unit_price']))}}</span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <span class="text-muted d-block">{{\App\CPU\translate('Purchase_price')}}</span>
                                <span class="fw-bold fs-5">{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($product['purchase_price'] ?? 0))}}</span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <span class="text-muted d-block">{{\App\CPU\translate('Discount')}}</span>
                                <span class="fw-bold fs-5">
                                    @if($product->discount_type == 'flat')
                                        {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($product->discount))}}
                                    @else
                                        {{ $product->discount }}%
                                    @endif
                                </span>
                                <small class="d-block text-muted">({{ ucfirst($product->discount_type) }})</small>
                            </div>
                            <div class="col-md-3 mb-3">
                                <span class="text-muted d-block">{{\App\CPU\translate('Tax')}}</span>
                                <span class="fw-bold fs-5">{{ $product->tax }}%</span>
                                <small class="d-block text-muted">({{ $product->tax_model == 'include' ? \App\CPU\translate('Included') : \App\CPU\translate('Exclude') }})</small>
                            </div>
                            <div class="col-md-3 mb-3">
                                <span class="text-muted d-block">{{\App\CPU\translate('Minimum Order Qty')}}</span>
                                <span class="fw-bold">{{ $product->minimum_order_qty }}</span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <span class="text-muted d-block">{{\App\CPU\translate('Unit')}}</span>
                                <span class="fw-bold">{{ $product->unit }}</span>
                            </div>
                            @if($product->product_type == 'physical')
                                <div class="col-md-3 mb-3">
                                    <span class="text-muted d-block">{{\App\CPU\translate('shipping_cost')}}</span>
                                    <span class="fw-bold">{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($product['shipping_cost']))}}</span>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <span class="text-muted d-block">{{\App\CPU\translate('Multiply Qty')}}</span>
                                    <span class="fw-bold">{{ $product->multiply_qty ? \App\CPU\translate('Yes') : \App\CPU\translate('No') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Category & Brand -->
                <div class="card mb-3 mb-lg-5">
                    <div class="card-header">
                        <h5 class="mb-0">{{\App\CPU\translate('Category & Brand')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <span class="text-muted d-block mb-1">{{\App\CPU\translate('Categories')}}</span>
                                @php
                                    $catIds = json_decode($product->category_ids, true) ?? [];
                                @endphp
                                @if(count($catIds) > 0)
                                    @foreach($catIds as $catEntry)
                                        @php
                                            $catId = is_array($catEntry) ? ($catEntry['id'] ?? $catEntry) : $catEntry;
                                            $cat = \App\Model\Category::find($catId);
                                        @endphp
                                        @if($cat)
                                            <span class="badge badge-soft-primary mr-1 mb-1">{{ $cat->name }}</span>
                                        @endif
                                    @endforeach
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <span class="text-muted d-block mb-1">{{\App\CPU\translate('Brand')}}</span>
                                @if($product->brand_id)
                                    @php $brand = \App\Model\Brand::find($product->brand_id); @endphp
                                    @if($brand)
                                        <span class="badge badge-soft-primary">{{ $brand->name }}</span>
                                    @endif
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colors & Attributes -->
                <div class="card mb-3 mb-lg-5">
                    <div class="card-header">
                        <h5 class="mb-0">{{\App\CPU\translate('Colors & Attributes')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <span class="text-muted d-block mb-1">{{\App\CPU\translate('Available_Color')}}</span>
                                @php $colors = json_decode($product->colors); @endphp
                                @if(count($colors) > 0)
                                    <ul class="list-inline checkbox-color mb-0">
                                        @foreach ($colors as $key => $color)
                                            <li class="list-inline-item">
                                                <label style="background: {{ $color }}; width: 25px; height: 25px; border-radius: 50%; display: inline-block; border: 1px solid #ddd;"></label>
                                                <small class="ml-1">{{ $color }}</small>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">{{\App\CPU\translate('No colors')}}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <span class="text-muted d-block mb-1">{{\App\CPU\translate('Attributes')}}</span>
                                @php $attributes = json_decode($product->attributes); @endphp
                                @if(count($attributes) > 0)
                                    @foreach($attributes as $attr)
                                        <span class="badge badge-soft-secondary mr-1 mb-1">{{ $attr }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">{{\App\CPU\translate('No attributes')}}</span>
                                @endif
                            </div>
                                @php $choiceAttributes = json_decode($product->choice_attributes, true) ?? []; @endphp
                                @if(!empty($choiceAttributes))
                                <div class="col-md-12">
                                    <span class="text-muted d-block mb-1">{{\App\CPU\translate('Choice Attributes')}}</span>
                                    @foreach($choiceAttributes as $attr => $values)
                                        <div class="mb-1">
                                            <strong>{{ ucfirst(str_replace('_', ' ', $attr)) }}:</strong>
                                            @if(is_array($values))
                                                {{ implode(', ', $values) }}
                                            @else
                                                {{ $values }}
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- SEO -->
                <div class="card mb-3 mb-lg-5">
                    <div class="card-header">
                        <h5 class="mb-0">{{\App\CPU\translate('SEO')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <span class="text-muted d-block">{{\App\CPU\translate('Meta_Title')}}</span>
                                <p class="mb-0">{{ $product->meta_title ?? '-' }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <span class="text-muted d-block">{{\App\CPU\translate('Search Tags')}}</span>
                                @php $tags = $product->tags->pluck('tag')->implode(', '); @endphp
                                <p class="mb-0">{{ $tags ?: '-' }}</p>
                            </div>
                            <div class="col-md-12 mb-3">
                                <span class="text-muted d-block">{{\App\CPU\translate('Meta_Description')}}</span>
                                <p class="mb-0">{{ $product->meta_description ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video -->
                @if($product->video_url)
                    <div class="card mb-3 mb-lg-5">
                        <div class="card-header">
                            <h5 class="mb-0">{{\App\CPU\translate('Video')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <span class="text-muted d-block">{{\App\CPU\translate('Video Provider')}}</span>
                                    <p class="mb-0">{{ ucfirst($product->video_provider) }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <span class="text-muted d-block">{{\App\CPU\translate('Video URL')}}</span>
                                    <a href="{{ $product->video_url }}" target="_blank" class="mb-0">{{ \Illuminate\Support\Str::limit($product->video_url, 50) }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- SKU / Stock -->
                @if($product->product_type == 'physical')
                    <div class="card mb-3 mb-lg-5">
                        <div class="card-header">
                            <h5 class="mb-0">{{\App\CPU\translate('Stock & SKU')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <span class="text-muted d-block">{{\App\CPU\translate('Current Stock')}}</span>
                                    <span class="fw-bold fs-5 {{ $product->current_stock <= 0 ? 'text-danger' : 'text-success' }}">{{ $product->current_stock }}</span>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <span class="text-muted d-block">{{\App\CPU\translate('SKU')}}</span>
                                    <p class="mb-0">{{ $product->sku ?? '-' }}</p>
                                </div>
                            </div>
                                @php $stocks = json_decode($product->stocks, true) ?? []; @endphp
                                @if(!empty($stocks))
                                <div class="mt-3">
                                    <span class="text-muted d-block mb-2">Variants:</span>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Variant</th>
                                                    <th>Price</th>
                                                    <th>Stock</th>
                                                    <th>SKU</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($stocks as $variant)
                                                    <tr>
                                                        <td>{{ $variant['variant'] ?? '-' }}</td>
                                                        <td>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($variant['price'] ?? 0))}}</td>
                                                        <td>{{ $variant['qty'] ?? 0 }}</td>
                                                        <td>{{ $variant['sku'] ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Digital Product -->
                @if($product->product_type == 'digital')
                    <div class="card mb-3 mb-lg-5">
                        <div class="card-header">
                            <h5 class="mb-0">{{\App\CPU\translate('Digital Product')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <span class="text-muted d-block">{{\App\CPU\translate('Digital Product Type')}}</span>
                                    <span class="badge badge-soft-primary">{{ ucfirst(str_replace('_', ' ', $product->digital_product_type)) }}</span>
                                </div>
                                @if($product->digital_file_ready && $product->digital_product_type == 'ready_product')
                                    <div class="col-md-6 mb-3">
                                        <span class="text-muted d-block">{{\App\CPU\translate('Download')}}</span>
                                        <a href="{{asset(config('app.public_storage_path').'/product/digital-product/'.$product->digital_file_ready)}}" class="btn btn--primary btn-sm" download>
                                            <i class="tio-download"></i> {{\App\CPU\translate('download')}}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <!-- Product Images Slider -->
                <div class="card mb-3 mb-lg-5">
                    <div class="card-header">
                        <h5 class="mb-0">{{\App\CPU\translate('Product Images')}}</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $allImages = [];
                            $allImages[] = \App\CPU\ProductManager::product_image_path('thumbnail') . '/' . $product['thumbnail'];
                            foreach(json_decode($product->images) as $photo) {
                                $allImages[] = asset(config('app.public_storage_path') . '/product/' . $photo);
                            }
                        @endphp
                        @if(count($allImages) > 0)
                            <div class="product-slider" id="productSlider">
                                <div class="slider-main">
                                    <img id="sliderMainImg" src="{{ $allImages[0] }}" alt="Product image"
                                         onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'">
                                    @if(count($allImages) > 1)
                                        <button type="button" class="slider-nav prev" onclick="slidePrev()">
                                            <i class="tio-chevron-left"></i>
                                        </button>
                                        <button type="button" class="slider-nav next" onclick="slideNext()">
                                            <i class="tio-chevron-right"></i>
                                        </button>
                                        <span class="slider-counter" id="sliderCounter">1 / {{ count($allImages) }}</span>
                                    @endif
                                </div>
                                @if(count($allImages) > 1)
                                    <div class="slider-thumbs" id="sliderThumbs">
                                        @foreach($allImages as $idx => $img)
                                            <div class="thumb-item {{ $idx == 0 ? 'active' : '' }}" onclick="slideTo({{ $idx }})">
                                                <img src="{{ $img }}" alt="Thumb {{ $loop->iteration }}"
                                                     onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif

                        @if($product->meta_image)
                            <hr>
                            <span class="text-muted d-block mb-2">{{\App\CPU\translate('Meta Image')}}</span>
                            <img class="img-fluid rounded border"
                                 onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                 src="{{asset(config('app.public_storage_path').'/product/meta/'.$product->meta_image)}}"
                                 alt="Meta image">
                        @endif
                    </div>
                </div>

                <!-- Rating -->
                <div class="card mb-3 mb-lg-5">
                    <div class="card-header">
                        <h5 class="mb-0">{{\App\CPU\translate('Rating')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <h3 class="mb-0 mr-2">{{count($product->rating)>0?number_format($product->rating[0]->average, 2, '.', ' '):0}}</h3>
                            <div>
                                <small class="text-muted">of {{ $product->reviews->count() }} {{\App\CPU\translate('reviews')}}</small>
                            </div>
                        </div>
                        @php $total=$product->reviews->count(); @endphp
                        @foreach([5,4,3,2,1] as $star)
                            @php $count=\App\CPU\Helpers::rating_count($product['id'], $star); @endphp
                            <div class="d-flex align-items-center mb-1">
                                <span class="mr-2" style="width: 30px;">{{ $star }} <i class="tio-star"></i></span>
                                <div class="progress flex-grow-1" style="height: 6px;">
                                    <div class="progress-bar" role="progressbar"
                                         style="width: {{$total==0?0:($count/$total)*100}}%;"></div>
                                </div>
                                <span class="ml-2" style="width: 30px;">{{ $count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{\App\CPU\translate('Reviews')}}</h5>
            </div>
            <div class="table-responsive datatable-custom">
                <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                    style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                    <thead class="thead-light thead-50 text-capitalize">
                    <tr>
                        <th>{{\App\CPU\translate('Reviewer')}}</th>
                        <th>{{\App\CPU\translate('Review')}}</th>
                        <th>{{\App\CPU\translate('Date')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reviews as $review)
                        @if(isset($review->customer))
                            <tr>
                                <td>
                                    <div class="d-flex gap-3 flex-wrap align-items-center">
                                        <div class="avatar avatar-circle">
                                            <img class="avatar-img"
                                                onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                                src="{{asset(config('app.public_storage_path').'/profile/'.$review->customer->image??"")}}"
                                                alt="Image Description">
                                        </div>
                                        <div>
                                            <span class="d-block h5 text-hover-primary mb-0">
                                                {{$review->customer['f_name']??""}} {{$review->customer['l_name']??""}}
                                                <i class="tio-verified text-primary"></i>
                                            </span>
                                            <span class="d-block font-size-sm text-body">{{$review->customer->email??""}}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-wrap">
                                        <div class="d-flex mb-2">
                                            <label class="badge badge-soft-info">
                                                <span>{{$review->rating}} <i class="tio-star"></i></span>
                                            </label>
                                        </div>
                                        <p>{{$review['comment']}}</p>
                                        @if(json_decode($review->attachment) != null)
                                            @foreach (json_decode($review->attachment) as $img)
                                                <a class="float-left"
                                                   href="{{asset(config('app.public_storage_path').'/review')}}/{{$img}}"
                                                   data-lightbox="mygallery">
                                                    <img class="p-2" width="60" height="60"
                                                        onerror="this.src='{{asset('assets/back-end/img/160x160/img2.jpg')}}'"
                                                        src="{{asset(config('app.public_storage_path').'/review')}}/{{$img}}" alt="">
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                                <td>{{date('d M Y H:i:s', strtotime($review['updated_at']))}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if(count($reviews)==0)
                <div class="text-center p-4">
                    <img class="mb-3 w-160" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description">
                    <p class="mb-0">{{\App\CPU\translate('No data to show')}}</p>
                </div>
            @endif
            <div class="table-responsive mt-4">
                <div class="px-4 d-flex justify-content-lg-end">
                    {!! $reviews->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    var allImages = @json($allImages ?? []);
    var currentIndex = 0;

    function slideTo(index) {
        if (index < 0) index = allImages.length - 1;
        if (index >= allImages.length) index = 0;
        currentIndex = index;
        document.getElementById('sliderMainImg').src = allImages[currentIndex];
        document.getElementById('sliderCounter').textContent = (currentIndex + 1) + ' / ' + allImages.length;
        var thumbs = document.querySelectorAll('#sliderThumbs .thumb-item');
        thumbs.forEach(function(t, i) {
            t.classList.toggle('active', i === currentIndex);
        });
        var thumbContainer = document.getElementById('sliderThumbs');
        if (thumbs[currentIndex]) {
            thumbs[currentIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        }
    }

    function slideNext() { slideTo(currentIndex + 1); }
    function slidePrev() { slideTo(currentIndex - 1); }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') slidePrev();
        if (e.key === 'ArrowRight') slideNext();
    });
</script>
@endpush
