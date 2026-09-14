@if(isset($product))
@php
    $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);
    $discountAmount = \App\CPU\Helpers::get_product_discount($product, $product->unit_price);
    $sellingPrice = $product->unit_price - $discountAmount;
@endphp

<div class="bh-product-card p-2 cursor-pointer" onclick="location.href='{{route('product',$product->slug)}}'">
    @if($product->discount > 0)
        <span class="bh-card-badge">
            @if ($product->discount_type == 'percent')
                -{{ round($product->discount, !empty($decimal_point_settings) ? $decimal_point_settings : 0) }}%
            @elseif($product->discount_type == 'flat')
                OFF {{ \App\CPU\Helpers::currency_converter($product->discount) }}
            @endif
        </span>
    @endif

    <div class="d-flex align-items-center">
        <div style="width: 90px; height: 90px; flex-shrink: 0;" class="p-1">
            <img class="w-100 h-100" style="object-fit: contain;"
                src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $product['thumbnail'] }}"
                onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                alt="{{ $product['name'] }}" />
        </div>
        <div class="pl-3 pr-2 flex-grow-1">
            @if(!empty($product->brand->name))
                <div class="bh-product-brand" style="font-size: 0.68rem;">{{ $product->brand->name }}</div>
            @endif
            <div class="bh-product-title" style="height: auto; max-height: 2.4em; font-size: 0.82rem; margin-bottom: 4px;">
                {{ $product['name'] }}
            </div>
            <div class="d-flex align-items-baseline gap-2">
                <span class="bh-price-selling" style="font-size: 1rem;">
                    {{ \App\CPU\Helpers::currency_converter($sellingPrice) }}
                </span>
                @if($product->discount > 0)
                    <span class="bh-price-mrp" style="font-size: 0.78rem;">
                        {{ \App\CPU\Helpers::currency_converter($product->unit_price) }}
                    </span>
                @endif
            </div>
            @if($product->discount > 0)
                <div class="bh-price-savings" style="font-size: 0.7rem;">
                    Save {{ \App\CPU\Helpers::currency_converter($discountAmount) }}
                </div>
            @endif
        </div>
    </div>
</div>
@endif
