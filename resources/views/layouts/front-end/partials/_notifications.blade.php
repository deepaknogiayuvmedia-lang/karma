
@if($notifications->count() > 0)
    @foreach($notifications as $notification)
        <div class="d-flex align-items-center py-3 px-3 border-bottom cursor-pointer" 
             onclick="openNotificationModal({{ $notification->id }})"
             style="transition: all 0.3s ease; border-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 4px solid {{ $notification->read_at ? 'transparent' : $web_config['primary_color'] }}; background-color: {{ $notification->read_at ? 'transparent' : $web_config['primary_color'].'10' }};">
            <div class="flex-shrink-0">
                <div class="position-relative">
                    <img width="50" height="50" 
                         src="{{asset(config('app.public_storage_path').'/notification')}}/{{$notification['image']}}"
                         onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                         class="rounded-circle shadow-sm" alt="{{$notification['title']}}">
                    @if(!$notification->read_at)
                    <span class="position-absolute border border-white rounded-circle" style="top: 0; right: 0; width: 12px; height: 12px; background-color: {{$web_config['primary_color']}};"></span>
                    @endif
                </div>
            </div>
            <div class="{{Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'}} w-100">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h6 class="font-size-sm mb-0 {{ $notification->read_at ? 'text-dark' : 'font-weight-bold' }}" style="color: {{ $notification->read_at ? '' : $web_config['primary_color'] }};">
                        {{ Str::limit($notification['title'], 35) }}
                    </h6>
                    <small class="text-muted" style="font-size: 10px;">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                </div>
                <p class="font-size-xs text-muted mb-0 lh-sm">{{ Str::limit($notification['description'], 70) }}</p>
            </div>
        </div>
    @endforeach
@else
    <div class="text-center py-5 px-3">
        <i class="czi-bell text-muted mb-3 d-block" style="font-size: 2rem; opacity: 0.3;"></i>
        <p class="text-muted font-size-xs mb-0">{{\App\CPU\translate('No Notifications Yet')}}</p>
    </div>
@endif


