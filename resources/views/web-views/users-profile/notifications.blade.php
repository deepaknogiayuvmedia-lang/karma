@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('My Notifications'))

@section('content')

    <div class="container text-center">
        <h3 class="headerTitle my-3">{{\App\CPU\translate('my_notifications')}}</h3>
    </div>

    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 mt-3 rtl"
         style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="row">
            <!-- Sidebar-->
        @include('web-views.partials._profile-aside')
        <!-- Content  -->
            <section class="col-lg-9 col-md-9">
                <div class="col-lg-10 mx-auto card __card shadow-0">
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @foreach($notifications as $notification)
                                <div class="list-group-item d-flex align-items-center py-3 cursor-pointer" 
                                     onclick="openNotificationModal({{ $notification->id }})"
                                     style="transition: all 0.3s ease; border-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 5px solid {{ $notification->read_at ? 'transparent' : $web_config['primary_color'] }}; background-color: {{ $notification->read_at ? 'transparent' : $web_config['primary_color'].'08' }};">
                                    <div class="flex-shrink-0">
                                        <div class="position-relative">
                                            <img width="80" height="80" 
                                                 src="{{asset(config('app.public_storage_path').'/notification')}}/{{$notification['image']}}"
                                                 onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                                 class="rounded-lg shadow-sm" alt="{{$notification['title']}}"
                                                 style="object-fit: cover;">
                                            @if(!$notification->read_at)
                                            <span class="position-absolute border border-white rounded-circle" style="top: -5px; right: -5px; width: 16px; height: 16px; background-color: {{$web_config['primary_color']}};"></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="{{Session::get('direction') === "rtl" ? 'mr-4' : 'ml-4'}} flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5 class="mb-0 {{ $notification->read_at ? 'text-dark' : 'font-weight-bold' }}" style="color: {{ $notification->read_at ? '#333' : $web_config['primary_color'] }};">
                                                {{ $notification['title'] }}
                                            </h5>
                                            <small class="text-muted"><i class="czi-time mr-1"></i> {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-0 text-muted" style="line-height: 1.5;">{{ \Illuminate\Support\Str::limit($notification['description'], 100) }}</p>
                                        <div class="mt-2 text-right">
                                            <small class="text-accent" style="cursor: pointer; font-weight: 500;">
                                                {{\App\CPU\translate('view_details')}} <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} ml-1 font-size-xs"></i>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            @if($notifications->count()==0)
                                <div class="text-center py-5">
                                    <div class="mb-3" style="font-size: 4rem; opacity: 0.2;">
                                        <i class="czi-bell"></i>
                                    </div>
                                    <h5 class="text-muted">{{\App\CPU\translate('no_notifications_found')}}</h5>
                                    <p class="text-muted font-size-sm">{{\App\CPU\translate('We will notify you when something important happens.')}}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

