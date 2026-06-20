@if(isset($product))
@php($overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews))
<div class="flash_deal_product rtl" onclick="location.href='{{route('product',$product->slug)}}'">
    @if($product->discount > 0)
    <span class="for-discoutn-value p-1 pl-2 pr-2">
        @if ($product->discount_type == 'percent')
        {{round($product->discount,(!empty($decimal_point_settings) ? $decimal_point_settings: 0))}}%
        @elseif($product->discount_type =='flat')
        {{\App\CPU\Helpers::currency_converter($product->discount)}}
        @endif {{\App\CPU\translate('off')}}
    </span>
    @endif
    <div class=" d-flex">
        <div class="d-flex align-items-center justify-content-center"
            style="padding-{{Session::get('direction') === "rtl" ?'right:12px':'left:12px'}};padding-top:12px;">
            <div class="flash-deals-background-image">
                <img class="__img-125px"
                    src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                    onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'" />
            </div>
        </div>
        <div class="flash_deal_product_details pl-3 pr-3 pr-1 d-flex align-items-center">
            <div>
                <div>
                    <span class="flash-product-title __text-12px" style="font-weight: 600;">
                        {{$product['name']}}
                    </span>
                </div>
                <div class="flash-product-price __text-12px" style="font-size: 15px">
                {{\App\CPU\Helpers::currency_converter($product->unit_price-\App\CPU\Helpers::get_product_discount($product,$product->unit_price))}}
                  
                     @if($product->discount > 0)
                    <strike
                        style="font-size: 12px!important;color: #E96A6A!important;">
                        {{\App\CPU\Helpers::currency_converter($product->unit_price)}}
                    </strike>
                    @endif
                </div>
                @if($product->discount > 0)
                <div class="__text-14px" style="color: #4eaa6f;">
                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.665 3.04a4 4 0 0 0-5.33 0l-.242.216a2 2 0 0 1-1.22.506l-.324.018a4 4 0 0 0-3.77 3.77l-.017.323a2 2 0 0 1-.506 1.22l-.216.242a4 4 0 0 0 0 5.33l.216.242a2 2 0 0 1 .506 1.22l.018.324a4 4 0 0 0 3.769 3.769l.324.018a2 2 0 0 1 1.22.506l.242.216a4 4 0 0 0 5.33 0l.242-.216a2 2 0 0 1 1.22-.506l.324-.018a4 4 0 0 0 3.769-3.77l.018-.323a2 2 0 0 1 .505-1.22l.216-.242a4 4 0 0 0 0-5.33l-.216-.242a2 2 0 0 1-.505-1.22l-.018-.324a4 4 0 0 0-3.77-3.769l-.323-.018a2 2 0 0 1-1.22-.506l-.242-.216Zm1.042 5.253a1 1 0 0 1 0 1.414l-6 6a1 1 0 0 1-1.414-1.414l6-6a1 1 0 0 1 1.414 0ZM16 14.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0ZM9.5 11a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" fill="#4eaa6f"></path>
                    </svg>
                    save  {{\App\CPU\Helpers::currency_converter(\App\CPU\Helpers::get_product_discount($product,$product->unit_price))}}
                  
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
