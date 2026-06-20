<style>
    .product {
        background-color: #fcfcfc;
        border: 2px solid #efefef;
        margin-bottom: 10px;
    }

    .product_pic {
        width: 40%;
    }

    .product_details {
        width: 60%;
        padding: 5px;
    }

    .image_center {
        height: 126px;
    }

    .image_center img {
        min-width: 100px;
        vertical-align: middle;
    }

    .product-title {
        position: relative;
    }

    .product-title>a {
        color: #373f50;
    }

    .star-rating>i {
        font-size: 8px !important;
    }

    .ptr1 {
        position: relative;
        display: inline-block;
        word-wrap: break-word;
        overflow: hidden;
        max-height: 2.4em;
        line-height: 1.2em;
    }

    .ptr {
        font-weight: 600;
        font-size: 16px !important;
    }

    .inline_product_image {
        height: 100px;
    }

    .ptp {
        font-weight: 700;
        font-size: 16px !important;
    }

    .star-rating .sr-star {
        margin: 0 !important;
    }

    @media (max-width: 768px) {
        .product_pic {
            width: 200px !important;
        }

        .product {
            margin-right: 16px;
        }

        .product_details {
            width: 100% !important;
        }
    }

    .stock-out-side {
        position: absolute;
        left: 47% !important;
        top: 83% !important;
        color: white !important;
        font-weight: 900;
        font-size: 15px;
    }

    .stock-card {
        filter: contrast(0.8) !important;
    }
</style>
@php
    $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);
    $variations = json_decode($product->variation, true);
@endphp
<div class="d-flex product justify-content-between inline_product" style="cursor: pointer;"
    data-href="{{route('product',$product->slug)}}">
    <div class="product_pic d-flex align-items-center justify-content-center" style=" text-align: center;">
        <a href="{{route('product',$product->slug)}}" class="image_center">
            <img class="inline_product_image"
                onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                width="100%" style="height: 100%;">
        </a>
    </div>
    <div class="product_details {{$product['current_stock']==0?'stock-card':''}}">
        <h3 class="product-title">
            <a class="ptr ptr1" href="{{route('product',$product->slug)}}">{{$product['name']}}</a>
        </h3>
        <h6 class="ptr">
            @for($inc=0;$inc<5;$inc++)
                @if($inc<$overallRating[0])
                <i class="sr-star czi-star-filled active" style="color: gold"></i>
                @else
                <i class="sr-star czi-star active"></i>
                @endif
                @endfor
        </h6>
        <div class="product-price">
            <span class="text-accent ptp">
                {{\App\CPU\Helpers::currency_converter(
            $product->unit_price-(\App\CPU\Helpers::get_product_discount($product,$product->unit_price))
            )}}
            </span>
            @if($product->discount > 0)
            <strike style="font-size: 12px!important;color: #E96A6A!important;">
                {{\App\CPU\Helpers::currency_converter($product->unit_price)}}
            </strike>
            @endif
        </div>
        @if($product->discount > 0)
        <div class="__text-12px" style="color: #4eaa6f;">
            <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.665 3.04a4 4 0 0 0-5.33 0l-.242.216a2 2 0 0 1-1.22.506l-.324.018a4 4 0 0 0-3.77 3.77l-.017.323a2 2 0 0 1-.506 1.22l-.216.242a4 4 0 0 0 0 5.33l.216.242a2 2 0 0 1 .506 1.22l.018.324a4 4 0 0 0 3.769 3.769l.324.018a2 2 0 0 1 1.22.506l.242.216a4 4 0 0 0 5.33 0l.242-.216a2 2 0 0 1 1.22-.506l.324-.018a4 4 0 0 0 3.769-3.77l.018-.323a2 2 0 0 1 .505-1.22l.216-.242a4 4 0 0 0 0-5.33l-.216-.242a2 2 0 0 1-.505-1.22l-.018-.324a4 4 0 0 0-3.77-3.769l-.323-.018a2 2 0 0 1-1.22-.506l-.242-.216Zm1.042 5.253a1 1 0 0 1 0 1.414l-6 6a1 1 0 0 1-1.414-1.414l6-6a1 1 0 0 1 1.414 0ZM16 14.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0ZM9.5 11a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" fill="#4eaa6f"></path>
            </svg>
            save {{\App\CPU\Helpers::currency_converter(
                            (\App\CPU\Helpers::get_product_discount($product,$product->unit_price))
                        )}}
        </div>
        @endif
        @if($product['current_stock']<=0)
            <label class="badge badge-danger stock-out-side">{{\App\CPU\translate('Stock Out')}}</label>
            @endif
    </div>
</div>

