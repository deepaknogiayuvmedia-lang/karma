<!-- Header -->
<div class="card-header gap-10">
    <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
        <img width="20" src="{{asset('/public/assets/back-end/img/shop-info.png')}}" alt="">
        {{\App\CPU\translate('top_sellers_fast_delivery')}}
    </h4>
</div>
<!-- End Header -->

<!-- Body -->
<div class="card-body">
    <div class="grid-item-wrap">
        @if($top_sellers_fast_delivery && count($top_sellers_fast_delivery) > 0)
            @foreach($top_sellers_fast_delivery as $key=>$item)
                @php($shop=\App\Model\Shop::where('seller_id',$item['seller_id'])->first())
                @if(isset($shop))
                    <div class="cursor-pointer"
                         onclick="location.href='{{route('admin.sellers.view',$item['seller_id'])}}'">
                        <div class="grid-item">
                            <div class="d-flex align-items-center gap-10">
                                <img class="avatar rounded-circle avatar-sm"
                                     onerror="this.src='{{asset('assets/back-end/img/160x160/img1.jpg')}}'"
                                     src="{{asset(config('app.public_storage_path').'/shop/'.$shop->image??'')}}">

                                <h5 class="shop-name">{{$shop['name']??'Not exist'}}</h5>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="d-flex flex-column">
                                    <small class="text-muted">{{\App\CPU\translate('avg_delivery_days')}}</small>
                                    <span class="shop-sell" style="color: #2dce89;">{{round($item['avg_delivery_days'], 1)}} {{\App\CPU\translate('days')}}</span>
                                </div>
                                <img src="{{asset('/public/assets/back-end/img/delivered.png')}}" alt="" style="width: 20px;">
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <div class="text-center">
                <p class="text-muted">{{\App\CPU\translate('No_data_found')}}</p>
                <img class="w-75" src="{{asset('/public/assets/back-end/img/no-data.png')}}" alt="">
            </div>
        @endif
    </div>
</div>
<!-- End Body -->

