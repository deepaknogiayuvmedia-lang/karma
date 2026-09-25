@php($decimal_point_settings = \App\CPU\Helpers::get_business_settings('decimal_point_settings'))
<div class="row g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-3 row-cols-md-2 row-cols-2" id="ajax-products">
@foreach($products as $product)
    @if(!empty($product['product_id']))
        @php($product=$product->product)
    @endif
    <div class="col-lg-2-4 col-md-4 col-sm-4 col-6 mb-3 px-2">
        @if(!empty($product))
            @include('web-views.partials._filter-single-product',['p'=>$product,'decimal_point_settings'=>$decimal_point_settings])
        @endif
    </div>
@endforeach
</div>
@if(($show_pagination ?? true) && method_exists($products, 'links') && $products->hasPages())
<div class="col-12">
    <nav class="d-flex justify-content-center pt-2" aria-label="Page navigation"
         id="paginator-ajax">
        {!! $products->links() !!}
    </nav>
</div>
@endif

