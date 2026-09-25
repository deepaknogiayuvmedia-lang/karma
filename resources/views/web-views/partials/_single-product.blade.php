@php
    $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);
    $variations = json_decode($product->variation, true);
    $discountAmount = \App\CPU\Helpers::get_product_discount($product, $product->unit_price);
    $sellingPrice = $product->unit_price - $discountAmount;
    $discountPercent = ($product->discount > 0 && $product->discount_type == 'percent')
        ? round($product->discount, !empty($decimal_point_settings) ? $decimal_point_settings : 0)
        : ($product->unit_price > 0 && $discountAmount > 0 ? round(($discountAmount / $product->unit_price) * 100, 0) : 0);
@endphp

<div class="bh-pc-card">
    {{-- Discount Badge --}}
    @if ($product->discount > 0)
        <span class="bh-pc-badge">
            {{ $discountPercent }}% OFF
        </span>
    @endif

    {{-- Wishlist Button --}}
    @php($inWishlist = auth('customer')->check() && in_array((int) $product->id, array_map('intval', (array) session('wish_list', []))))
    <button type="button" class="bh-pc-wishlist {{ $inWishlist ? 'active' : '' }}"
        data-wishlist-product="{{ $product->id }}"
        onclick="toggleWishlist('{{ $product->id }}')"
        title="{{ $inWishlist ? \App\CPU\translate('Remove from Wishlist') : \App\CPU\translate('Add to Wishlist') }}">
        <i class="fa {{ $inWishlist ? 'fa-heart' : 'fa-heart-o' }}"></i>
    </button>

    {{-- Product Image --}}
    <a href="{{ route('product', $product->slug) }}" class="bh-pc-img-wrap d-block">
        <img class="bh-pc-img"
            src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $product['thumbnail'] }}"
            onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
            alt="{{ $product['name'] }}" loading="lazy">

        {{-- Rating Badge over image --}}
        @if(isset($overallRating[0]) && $overallRating[0] > 0)
            <span class="bh-pc-rating-badge">
                {{ number_format($overallRating[0], 1) }}
                <i class="fa fa-star"></i>
                <span class="bh-pc-rating-sep">|</span>
                {{ $overallRating[1] ?? 0 }}
            </span>
        @endif
    </a>

    {{-- Card Body --}}
    <div class="bh-pc-body">
        {{-- Product Name --}}
        <a href="{{ route('product', $product->slug) }}" class="bh-pc-name" title="{{ $product['name'] }}">
            {{ $product['name'] }}
        </a>

        {{-- Brand --}}
        @if(!empty($product->brand->name))
            <div class="bh-pc-brand">{{ $product->brand->name }}</div>
        @endif

        {{-- Price Row --}}
        <div class="bh-pc-price-row">
            <span class="bh-pc-selling">
                {{ \App\CPU\Helpers::currency_converter($sellingPrice) }}
            </span>
            @if ($product->discount > 0)
                <span class="bh-pc-mrp">
                    {{ \App\CPU\Helpers::currency_converter($product->unit_price) }}
                </span>
            @endif
        </div>

        {{-- Save Badge --}}
        @if ($product->discount > 0)
            <div class="bh-pc-save">
                <svg width="13" height="13" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="vertical-align:-1px;"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.665 3.04a4 4 0 0 0-5.33 0l-.242.216a2 2 0 0 1-1.22.506l-.324.018a4 4 0 0 0-3.77 3.77l-.017.323a2 2 0 0 1-.506 1.22l-.216.242a4 4 0 0 0 0 5.33l.216.242a2 2 0 0 1 .506 1.22l.018.324a4 4 0 0 0 3.769 3.769l.324.018a2 2 0 0 1 1.22.506l.242.216a4 4 0 0 0 5.33 0l.242-.216a2 2 0 0 1 1.22-.506l.324-.018a4 4 0 0 0 3.769-3.77l.018-.323a2 2 0 0 1 .505-1.22l.216-.242a4 4 0 0 0 0-5.33l-.216-.242a2 2 0 0 1-.505-1.22l-.018-.324a4 4 0 0 0-3.77-3.769l-.323-.018a2 2 0 0 1-1.22-.506l-.242-.216Z" fill="#168A3A"/></svg>
                Save {{ \App\CPU\Helpers::currency_converter($discountAmount) }}
            </div>
        @else
            <div class="bh-pc-save bh-pc-save-empty">&nbsp;</div>
        @endif

        {{-- Size / Variant Selector --}}
        <div class="bh-pc-size-row">
            <span class="bh-pc-size-label">Size</span>
            <a class="bh-pc-size-btn" href="javascript:" onclick="quickView('{{ $product->id }}')">
                <span>{{ $variations[0]['type'] ?? 'Select' }}</span>
                <i class="czi-arrow-down"></i>
            </a>
        </div>
    </div>
</div>
