@php
    $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);
    $variations = json_decode($product->variation, true);
@endphp

<div class="product-single-hover">
    <div class="overflow-hidden position-relative ">
        <div class="inline_product clickable rtl " style="background:#fff;">
            @if($product->discount > 0)
                <span class="for-discoutn-value p-1 pl-2 pr-2">
                    @if ($product->discount_type == 'percent')
                        {{round($product->discount,(!empty($decimal_point_settings) ? $decimal_point_settings: 0))}}%
                    @elseif($product->discount_type =='flat')
                        {{\App\CPU\Helpers::currency_converter($product->discount)}}
                    @endif
                    {{\App\CPU\translate('off')}}
                </span>
            @else
                <span class="for-discoutn-value-null"></span>
            @endif
            <img class="mx-auto"
                src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                >
        </div>
        <div class="single-product-details">
            <div class="text-{{Session::get('direction') === 'rtl' ? 'right ' : 'left'}} px-2">
                <a href="{{route('product',$product->slug)}}">
                    {{$product['name']}}
                </a>
            </div>
            <div class="justify-content-between px-2 te xt-center">
                <div class="product-price te xt-center">
                    <span class="text-accent">
                        {{\App\CPU\Helpers::currency_converter(
                            $product->unit_price-(\App\CPU\Helpers::get_product_discount($product,$product->unit_price))
                        )}}
                    </span>
                    @if($product->discount > 0)
                        <strike style="font-size: 11px!important;color: #E96A6A!important; padding-left:5px">
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
            </div>
            <div class="text-center d-flex justify-content-between align-items-center px-2 quick-view1">
                @if(Request::is('product/*'))
                    <a class="btn btn-primary btn-sm" href="{{route('product',$product->slug)}}">
                        <i class="czi-forward align-middle {{Session::get('direction') === 'rtl' ? 'ml-1' : 'mr-1'}}"></i>
                        {{\App\CPU\translate('View')}}
                    </a>
                @else
                    <span class="__text-12px">Size</span>
                    <a class="border rounded-2 btn-sm d-flex justify-content-between align-items-center gap-4 w-75"
                        href="javascript:" onclick="quickView('{{$product->id}}')">
                        <span class="__text-12px">{{$variations[0]['type'] ?? ''}}</span>
                        <i class="czi-arrow-down align-middle {{Session::get('direction') === 'rtl' ? 'ml-1' : 'mr-1'}}"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

