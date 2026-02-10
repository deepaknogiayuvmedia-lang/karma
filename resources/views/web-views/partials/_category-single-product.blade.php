@php($overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews))


<div class="product-single-hover">
    <div class="overflow-hidden position-relative ">
        <div class=" inline_product clickable d-flex justify-content-center"
            style="background:#fff;">
            @if($product->discount > 0)
            <div class="d-flex">
                <span class="for-discoutn-value p-1 pl-2 pr-2">
                    @if ($product->discount_type == 'percent')
                    {{round($product->discount,(!empty($decimal_point_settings) ? $decimal_point_settings: 0))}}%
                    @elseif($product->discount_type =='flat')
                    {{\App\CPU\Helpers::currency_converter($product->discount)}}
                    @endif
                    {{\App\CPU\translate('off')}}
                </span>
            </div>
            @else
            <div class="d-flex justify-content-end for-dicount-div-null">
                <span class="for-discoutn-value-null"></span>
            </div>
            @endif
            <div class="d-flex d-block justify-content-center">

                <img src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                    onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'">

            </div>
            <div class="text-center d-flex justify-content-center align-items-center quick-view1 position-absolute h-100 w-100      ">
                @if(Request::is('product/*'))
                <a class="btn btn--primary btn-sm" href="{{route('product',$product->slug)}}">
                    <i class="czi-forward align-middle {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                    {{\App\CPU\translate('View')}}
                </a>
                @else
                <a class="btn btn--primary btn-sm"
                    style="margin-top:0px;padding-top:5px;padding-bottom:5px;padding-left:10px;padding-right:10px;" href="javascript:"
                    onclick="quickView('{{$product->id}}')">
                    <i class="czi-eye align-middle {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                    {{\App\CPU\translate('Quick')}} {{\App\CPU\translate('View')}}
                </a>
                @endif
            </div>
        </div>
        <div class="single-product-details">
            <div class="te xt-center px-3">
                <a href="{{route('product',$product->slug)}}" style="font-weight: 400;
                    font-size: 20px; ">
                    {{ Str::limit($product['name'], 50) }}
                </a>
            </div>
            <!-- <div class="rating-show justify-content-between text-center">
                <span class="d-inline-block font-size-sm text-body" style="font-weight: 400;
                font-size: 10px;">
                    @for($inc=0;$inc<5;$inc++)
                        @if($inc<$overallRating[0])
                        <i class="sr-star czi-star-filled active"></i>
                        @else
                        <i class="sr-star czi-star" style="color:#fea569 !important"></i>
                        @endif
                        @endfor
                        <label class="badge-style">( {{$product->reviews_count}} )</label>
                </span>
            </div> -->
            <div class="justify-content-between px-3  te xt-center">
                <div class="product-price py-1 te xt-center">

                    <span class="text-accent">
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
                <div class="__text-14px" style="color: #4eaa6f;">
                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.665 3.04a4 4 0 0 0-5.33 0l-.242.216a2 2 0 0 1-1.22.506l-.324.018a4 4 0 0 0-3.77 3.77l-.017.323a2 2 0 0 1-.506 1.22l-.216.242a4 4 0 0 0 0 5.33l.216.242a2 2 0 0 1 .506 1.22l.018.324a4 4 0 0 0 3.769 3.769l.324.018a2 2 0 0 1 1.22.506l.242.216a4 4 0 0 0 5.33 0l.242-.216a2 2 0 0 1 1.22-.506l.324-.018a4 4 0 0 0 3.769-3.77l.018-.323a2 2 0 0 1 .505-1.22l.216-.242a4 4 0 0 0 0-5.33l-.216-.242a2 2 0 0 1-.505-1.22l-.018-.324a4 4 0 0 0-3.77-3.769l-.323-.018a2 2 0 0 1-1.22-.506l-.242-.216Zm1.042 5.253a1 1 0 0 1 0 1.414l-6 6a1 1 0 0 1-1.414-1.414l6-6a1 1 0 0 1 1.414 0ZM16 14.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0ZM9.5 11a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" fill="#4eaa6f"></path>
                    </svg>
                    save {{\App\CPU\Helpers::currency_converter(
                            (\App\CPU\Helpers::get_product_discount($product,$product->unit_price))
                        )}}
                </div>
                @endif
            </div>

        </div>

    </div>
</div>
