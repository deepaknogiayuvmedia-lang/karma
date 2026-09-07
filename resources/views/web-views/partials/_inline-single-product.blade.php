<style>
    .inline-product-card {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 10px;
        margin-bottom: 12px;
        transition: all 0.25s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none !important;
        position: relative;
        overflow: hidden;
    }

    .inline-product-card:hover {
        border-color: var(--pd-primary, #2563eb);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.08);
    }

    .inline-product-img-box {
        width: 85px;
        height: 85px;
        min-width: 85px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 6px;
        overflow: hidden;
    }

    .inline-product-img-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .inline-product-card:hover .inline-product-img-box img {
        transform: scale(1.06);
    }

    .inline-product-details {
        flex: 1;
        min-width: 0;
    }

    .inline-product-title {
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.35;
        margin-bottom: 4px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .inline-product-rating {
        display: flex;
        align-items: center;
        gap: 3px;
        margin-bottom: 4px;
        font-size: 11px;
    }

    .inline-product-price-row {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
        margin-bottom: 3px;
    }

    .inline-product-price {
        font-size: 15px;
        font-weight: 800;
        color: #0f172a;
    }

    .inline-product-old-price {
        font-size: 11px;
        color: #94a3b8;
        text-decoration: line-through;
        font-weight: 500;
    }

    .inline-product-save-badge {
        display: inline-flex;
        align-items: center;
        gap: 3px;
        background: #dcfce7;
        color: #15803d;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 6px;
    }

    .inline-stock-out-badge {
        position: absolute;
        top: 8px;
        right: 8px;
        background: #ef4444;
        color: #ffffff;
        font-size: 9px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 4px;
        text-transform: uppercase;
    }
</style>

@php
    $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);
    $discount = \App\CPU\Helpers::get_product_discount($product, $product->unit_price);
@endphp

<a href="{{ route('product', $product->slug) }}" class="inline-product-card">
    @if ($product['current_stock'] <= 0)
        <span class="inline-stock-out-badge">{{ \App\CPU\translate('Stock Out') }}</span>
    @endif

    <div class="inline-product-img-box">
        <img onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
            src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $product['thumbnail'] }}"
            alt="{{ $product['name'] }}">
    </div>

    <div class="inline-product-details">
        <div class="inline-product-title" title="{{ $product['name'] }}">
            {{ $product['name'] }}
        </div>

      

        <div class="inline-product-price-row">
            <span class="inline-product-price">
                {{ \App\CPU\Helpers::currency_converter($product->unit_price - $discount) }}
            </span>
            @if ($product->discount > 0)
                <span class="inline-product-old-price">
                    {{ \App\CPU\Helpers::currency_converter($product->unit_price) }}
                </span>
            @endif
        </div>

        @if ($discount > 0)
            <div>
                <span class="inline-product-save-badge">
                    <i class="fa fa-tag"></i>
                    {{ \App\CPU\translate('save') }} {{ \App\CPU\Helpers::currency_converter($discount) }}
                </span>
            </div>
        @endif
    </div>
</a>
