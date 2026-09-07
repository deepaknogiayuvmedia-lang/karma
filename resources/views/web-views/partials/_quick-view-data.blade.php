@php
    $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);
    $cartItems = \App\CPU\CartManager::get_cart();
    $productCartItems = $cartItems ? $cartItems->where('product_id', $product->id) : collect();

    $rawVariations = json_decode($product->variation, true) ?? [];
    $choiceOptions = json_decode($product->choice_options, true) ?? [];
    $colors = json_decode($product->colors, true) ?? [];

    $firstChoiceName = !empty($choiceOptions) ? $choiceOptions[0]['name'] : null;
    $firstChoiceTitle = !empty($choiceOptions) ? $choiceOptions[0]['title'] : \App\CPU\translate('Choose a Size');
    $firstColor = !empty($colors) ? $colors[0] : null;

    $brandName = $product->brand ? $product->brand->name : ($product->seller && isset($product->seller->shop) ? $product->seller->shop->name : '');

    $variationsList = [];

    if (!empty($rawVariations) && count($rawVariations) > 0) {
        foreach ($rawVariations as $var) {
            $variantType = $var['type'];
            $basePrice = $var['price'];
            $stock = $var['qty'];

            $discountAmount = 0;
            if ($product->discount > 0) {
                if ($product->discount_type == 'percent') {
                    $discountAmount = ($basePrice * $product->discount) / 100;
                } else {
                    $discountAmount = $product->discount;
                }
            }
            $salePrice = max(0, $basePrice - $discountAmount);
            $saveAmount = $discountAmount;

            $discountPct = 0;
            if ($basePrice > 0 && $discountAmount > 0) {
                $discountPct = round(($discountAmount / $basePrice) * 100);
            }

            // Check if this variant is in cart
            $inCartItem = $productCartItems->where('variant', $variantType)->first();

            $variationsList[] = [
                'type' => $variantType,
                'sale_price' => $salePrice,
                'original_price' => $basePrice,
                'discount_amount' => $discountAmount,
                'discount_pct' => $discountPct,
                'save_amount' => $saveAmount,
                'stock' => $stock,
                'in_cart_item' => $inCartItem
            ];
        }
    } else {
        // Single product without variations
        $basePrice = $product->unit_price;
        $discountAmount = \App\CPU\Helpers::get_product_discount($product, $basePrice);
        $salePrice = max(0, $basePrice - $discountAmount);
        $discountPct = 0;
        if ($basePrice > 0 && $discountAmount > 0) {
            $discountPct = round(($discountAmount / $basePrice) * 100);
        }
        $inCartItem = $productCartItems->first();

        $variationsList[] = [
            'type' => $product->name,
            'sale_price' => $salePrice,
            'original_price' => $basePrice,
            'discount_amount' => $discountAmount,
            'discount_pct' => $discountPct,
            'save_amount' => $discountAmount,
            'stock' => $product->current_stock,
            'in_cart_item' => $inCartItem
        ];
    }
@endphp

<style>
    /* Quick View Compact 300px UI Styling */
    .qv-modal-card {
        border-radius: 20px !important;
        border: none !important;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
        overflow: hidden !important;
        background: #ffffff !important;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
        position: relative;
        padding: 16px !important;
        width: 450px !important;
        max-width: 450px !important;
        margin: 0 auto;
    }

 
    .qv-close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: transparent;
        border: none;
        color: #1e293b;
        display: inline-flex;
        align-items: center;
        justify-content: center;
font-weight: 400;
        }

        @media (max-width: 768px) {
            .qv-modal-card {
                width: 80% !important;
                max-width: 80% !important;
                padding: 12px !important;
                margin: 0 auto !important;
            }
         
            .qv-product-thumb-box {
                width: 120px;
                height: 120px;
            }
            .qv-btn-go-cart {
                width: 100%;
                justify-content: center;
            }
        }        cursor: pointer;
        transition: all 0.2s ease;
        z-index: 10;
        line-height: 1;
        padding: 0;
    }

    .qv-close-btn:hover {
        color: #ef4444;
        transform: scale(1.1);
    }

    /* Top Product Card */
    .qv-top-card {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 12px;
        padding-right: 20px;
    }

    .qv-product-thumb-box {
        width: 70px;
        height: 70px;
        min-width: 70px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    }

    .qv-product-thumb-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .qv-top-info {
        flex: 1;
        min-width: 0;
    }

    .qv-product-title-ref {
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.3;
        margin-bottom: 2px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-decoration: none !important;
    }

    .qv-brand-subtext {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 500;
        margin-bottom: 6px;
        display: block;
    }

    .qv-btn-go-cart {
        background: #2e7d32;
        color: #ffffff !important;
        font-weight: 600;
        font-size: 12px;
        padding: 5px 14px;
        border-radius: 6px;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        transition: background 0.2s ease, transform 0.15s ease;
        box-shadow: 0 2px 5px rgba(46, 125, 50, 0.2);
    }

    .qv-btn-go-cart:hover {
        background: #1b5e20;
        color: #ffffff !important;
    }

    /* Section Title */
    .qv-section-title {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
        margin-top: 6px;
        margin-bottom: 8px;
    }

    /* Variant List Rows */
    .qv-variant-list {
        display: flex;
        flex-direction: column;
        max-height: 340px;
        overflow-y: auto;
        padding-right: 2px;
    }

    .qv-variant-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
        gap: 8px;
    }

    .qv-variant-row:last-child {
        border-bottom: none;
    }

    .qv-var-left {
        flex: 1;
        min-width: 0;
    }

    .qv-var-name {
        font-size: 20px;
        font-weight: 500;
        color: #0f172a;
        margin-bottom: 2px;
        line-height: 1.25;
    }

    .qv-var-price-line {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 4px;
        margin-bottom: 2px;
    }

    .qv-var-price {
        font-size: 14px;
        font-weight: 400;
        color: #0f172a;
    }

    .qv-var-old-price {
        font-size: 11px;
        color: #94a3b8;
        text-decoration: line-through;
        font-weight: 500;
    }

    .qv-var-badge {
        background: #ff9800;
        color: #ffffff;
        font-size: 10px;
        font-weight: 700;
        padding: 1px 5px;
        border-radius: 4px;
    }

    .qv-var-save {
        font-size: 11px;
        font-weight: 600;
        color: #16a34a;
        display: flex;
        align-items: center;
        gap: 4px;
        margin-top: 1px;
    }

    .qv-save-badge-icon {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #dcfce7;
        color: #16a34a;
        font-size: 9px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* Action Control (Right Column) */
    .qv-btn-add-var {
        background: #ff9800;
        color: #ffffff !important;
        border: none;
        padding: 7px 14px;
        font-size: 12px;
        font-weight: 700;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 5px rgba(255, 152, 0, 0.25);
        white-space: nowrap;
    }

    .qv-btn-add-var:hover {
        background: #f57c00;
    }

    .qv-btn-add-var:disabled {
        background: #cbd5e1;
        cursor: not-allowed;
        box-shadow: none;
    }

    /* Stepper Control [ 🗑 | Qty | + ] */
    .qv-stepper-box {
        display: inline-flex;
        align-items: center;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        overflow: hidden;
        background: #ffffff;
        height: 32px;
    }

    .qv-stepper-btn-trash {
        width: 28px;
        height: 32px;
        border: none;
        background: #ffffff;
        color: #ff9800;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border-right: 1px solid #e2e8f0;
        padding: 0;
    }

    .qv-stepper-btn-trash:hover {
        background: #fff7ed;
        color: #ef4444;
    }

    .qv-stepper-count {
        width: 32px;
        height: 32px;
        background: #2e7d32;
        color: #ffffff;
        font-weight: 700;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qv-stepper-btn-plus {
        width: 28px;
        height: 32px;
        border: none;
        background: #ffffff;
        color: #0f172a;
        font-weight: 700;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border-left: 1px solid #e2e8f0;
        padding: 0;
    }

    .qv-stepper-btn-plus:hover {
        background: #f8fafc;
        color: #2e7d32;
    }
</style>

<!-- Close Button -->
<button class="qv-close-btn call-when-done" type="button" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>

<!-- Top Product Summary Card -->
<div class="qv-top-card">
    <div class="qv-product-thumb-box">
        <img onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
             src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
             alt="{{$product['name']}}">
    </div>

    <div class="qv-top-info">
        <a href="{{route('product',$product->slug)}}" class="qv-product-title-ref" title="{{$product['name']}}">
            {{$product['name']}}
        </a>

        @if(!empty($brandName))
            <span class="qv-brand-subtext">{{$brandName}}</span>
        @endif

        <a href="{{route('shop-cart')}}" class="qv-btn-go-cart">
            {{\App\CPU\translate('Go to Cart')}}
        </a>
    </div>
</div>

<!-- Section Heading -->
<div class="qv-section-title">
    {{ $firstChoiceTitle ?? \App\CPU\translate('Choose a Size') }}
</div>

<!-- Variant List Rows -->
<div class="qv-variant-list">
    @foreach ($variationsList as $varItem)
        <div class="qv-variant-row">
            <!-- Left Info -->
            <div class="qv-var-left">
                <div class="qv-var-name">{{ $varItem['type'] }}</div>
                
                <div class="qv-var-price-line">
                    <span class="qv-var-price">{{\App\CPU\Helpers::currency_converter($varItem['sale_price'])}}</span>

                    @if ($varItem['discount_amount'] > 0)
                        <span class="qv-var-old-price">{{\App\CPU\Helpers::currency_converter($varItem['original_price'])}}</span>
                        
                        @if ($varItem['discount_pct'] > 0)
                            <span class="qv-var-badge">{{ $varItem['discount_pct'] }}% OFF</span>
                        @endif
                    @endif
                </div>

                @if ($varItem['save_amount'] > 0)
                    <div class="qv-var-save">
                        <span class="qv-save-badge-icon">%</span>
                        {{\App\CPU\translate('Save')}} {{\App\CPU\Helpers::currency_converter($varItem['save_amount'])}}
                    </div>
                @endif
            </div>

            <!-- Right Action / Stepper -->
            <div class="qv-var-right">
                @if (!empty($varItem['in_cart_item']))
                    <!-- Stepper Control: [ 🗑 | Qty | + ] -->
                    <div class="qv-stepper-box">
                        <button type="button" class="qv-stepper-btn-trash" title="Remove"
                                onclick="quickRemoveFromCart('{{ $varItem['in_cart_item']['id'] }}', '{{ $product->id }}')">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        
                        <div class="qv-stepper-count">
                            {{ $varItem['in_cart_item']['quantity'] }}
                        </div>

                        <button type="button" class="qv-stepper-btn-plus" title="Add More"
                                onclick="quickUpdateCartQty('{{ $varItem['in_cart_item']['id'] }}', {{ $varItem['in_cart_item']['quantity'] + 1 }}, '{{ $product->id }}')">
                            +
                        </button>
                    </div>
                @else
                    <!-- Add to Cart Button -->
                    @if ($varItem['stock'] > 0)
                        <button type="button" class="qv-btn-add-var"
                                onclick="quickAddVariant('{{ $product->id }}', '{{ $firstChoiceName }}', '{{ $varItem['type'] }}', '{{ $firstColor }}')">
                            {{\App\CPU\translate('Add to Cart')}}
                        </button>
                    @else
                        <button type="button" class="qv-btn-add-var" disabled>
                            {{\App\CPU\translate('Stock Out')}}
                        </button>
                    @endif
                @endif
            </div>
        </div>
    @endforeach
</div>

<script type="text/javascript">
    function quickAddVariant(productId, choiceName, choiceValue, colorValue) {
        var formData = {
            _token: '{{ csrf_token() }}',
            id: productId,
            quantity: 1
        };
        if (choiceName && choiceValue) {
            formData[choiceName] = choiceValue;
        }
        if (colorValue) {
            formData['color'] = colorValue;
        }

        $.ajax({
            url: '{{ route("cart.add") }}',
            type: 'POST',
            data: formData,
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(response) {
                if (response.status == 1) {
                    updateNavCart();
                    toastr.success(response.message);
                    quickView(productId);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Cart',
                        text: response.message
                    });
                }
            },
            complete: function() {
                $('#loading').hide();
            }
        });
    }

    function quickRemoveFromCart(cartKey, productId) {
        $.post('{{ route("cart.remove") }}', {
            _token: '{{ csrf_token() }}',
            key: cartKey
        }, function(response) {
            updateNavCart();
            toastr.info('{{ \App\CPU\translate("Item has been removed from cart") }}');
            quickView(productId);
        });
    }

    function quickUpdateCartQty(cartKey, newQty, productId) {
        if (newQty < 1) {
            quickRemoveFromCart(cartKey, productId);
            return;
        }
        $.post('{{ route("cart.updateQuantity") }}', {
            _token: '{{ csrf_token() }}',
            key: cartKey,
            quantity: newQty
        }, function(response) {
            if (response.status == 0) {
                toastr.error(response.message);
            } else {
                updateNavCart();
                quickView(productId);
            }
        });
    }
</script>
