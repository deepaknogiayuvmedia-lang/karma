@if($category->childes->count() > 0)
    @foreach($category->childes as $c)
        <div class="subcat-card" onclick="location.href='{{route('products',['id'=> $c['id'],'data_from'=>'category','page'=>1])}}'">
            <div>
                <div class="subcat-name">{{$c['name']}}</div>
                @if($c->childes->count() > 0)
                    <div class="sub-subcat-list">
                        @foreach($c->childes as $child)
                            <a href="{{route('products',['id'=> $child['id'],'data_from'=>'category','page'=>1])}}"
                               class="sub-subcat-item"
                               onclick="event.stopPropagation();">
                                {{$child['name']}}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
            <span class="subcat-arrow"><i class="fa fa-arrow-right"></i></span>
        </div>
    @endforeach
@else
    <div style="text-align: center; padding: 2rem;">
        <a href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}"
           class="btn btn-bh-primary" style="padding: 10px 30px; font-weight: 600;">
            <i class="fa fa-shopping-bag mr-1"></i> {{\App\CPU\translate('View Products')}}
        </a>
    </div>
@endif
