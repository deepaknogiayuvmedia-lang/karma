
@if($wishlists->count()>0)
    @foreach($wishlists as $wishlist)
        @php($product = $wishlist->product_full_info)
        @if( $wishlist->product_full_info)
            <div class="wl-item">
                <div class="row g-0">
                    <div class="wl-img col-md-3 col-xl-2 col-lg-3 col-sm-4">
                        <a href="{{route('product',$product->slug)}}">
                            <img src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                            onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'" alt="wishlist">
                        </a>
                    </div>
                    <div class="wl-body col-sm-8 col-md-9 col-xl-10 col-lg-9">
                        <div class="wl-name">
                            <a href="{{route('product',$product['slug'])}}">{{$product['name']}}</a>
                        </div>
                        @if(!empty($brand_setting))
                            <span class="wl-brand">{{\App\CPU\translate('Brand')}} : {{$product->brand?$product->brand['name']:''}}</span>
                        @endif

                        <div class="wl-prices">
                            @if($product->discount > 0)
                                <span class="wl-price-old">{{\App\CPU\Helpers::currency_converter($product->unit_price)}}</span>
                            @endif
                            <span class="wl-price">{{\App\CPU\Helpers::get_price_range($product) }}</span>
                        </div>
                    </div>
                </div>
                <a href="javascript:" class="wl-remove" title="{{\App\CPU\translate('remove')}}">
                    <i class="czi-close" onclick="removeWishlist('{{$product['id']}}')"></i>
                </a>
            </div>
        @else
            <span class="badge badge-danger wl-empty-badge">{{\App\CPU\translate('item_removed')}}</span>
        @endif
    @endforeach
@else
    <div class="wl-empty">
        <i class="czi-heart"></i>
        <h6>{{\App\CPU\translate('No data found')}}.</h6>
    </div>
@endif

