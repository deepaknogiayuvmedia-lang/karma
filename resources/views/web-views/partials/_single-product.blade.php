@php
    $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);
    $variations = json_decode($product->variation, true);
    $discountAmount = \App\CPU\Helpers::get_product_discount($product, $product->unit_price);
    $sellingPrice = $product->unit_price - $discountAmount;
@endphp

<div class="bh-product-card">
    @if ($product->discount > 0)
        <span class="bh-card-badge">
            @if ($product->discount_type == 'percent')
                -{{ round($product->discount, !empty($decimal_point_settings) ? $decimal_point_settings : 0) }}%
            @elseif($product->discount_type == 'flat')
                OFF {{ \App\CPU\Helpers::currency_converter($product->discount) }}
            @endif
        </span>
    @endif

    <button type="button" class="bh-wishlist-btn" onclick="addWishlist('{{ $product->id }}')" title="{{ \App\CPU\translate('Add to Wishlist') }}">
        <i class="fa fa-heart-o"></i>
    </button>

    <a href="{{ route('product', $product->slug) }}" class="bh-product-img-wrapper d-block">
        <img class="bh-product-img"
            src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $product['thumbnail'] }}"
            onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
            alt="{{ $product['name'] }}">
    </a>

    <div class="bh-product-body">
        @if(isset($overallRating[0]) && $overallRating[0] > 0)
            <div class="bh-product-rating">
                <i class="fa fa-star"></i> {{ number_format($overallRating[0], 1) }}
                <span class="count">({{ $overallRating[1] ?? 0 }})</span>
            </div>
        @endif

        @if(!empty($product->brand->name))
            <div class="bh-product-brand">{{ $product->brand->name }}</div>
        @endif

        <a href="{{ route('product', $product->slug) }}" class="bh-product-title" title="{{ $product['name'] }}">
            {{ $product['name'] }}
        </a>

        @if(!empty($variations[0]['type']))
            <div class="bh-product-variant">
                <i class="fa fa-tag mr-1"></i> {{ $variations[0]['type'] }}
            </div>
        @endif

        <div class="bh-price-row">
            <span class="bh-price-selling">
                {{ \App\CPU\Helpers::currency_converter($sellingPrice) }}
            </span>
            @if ($product->discount > 0)
                <span class="bh-price-mrp">
                    {{ \App\CPU\Helpers::currency_converter($product->unit_price) }}
                </span>
                <span class="bh-price-savings">
                    Save {{ \App\CPU\Helpers::currency_converter($discountAmount) }}
                </span>
            @endif
        </div>

        <button class="btn bh-add-cart-btn mt-2" onclick="quickView('{{ $product->id }}')">
            <i class="fa fa-shopping-cart mr-1"></i> {{ \App\CPU\translate('ADD TO CART') }}
        </button>
    </div>
</div>
