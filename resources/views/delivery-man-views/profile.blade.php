@extends('delivery-man-views.layouts.app')

@section('title', \App\CPU\translate('profile'))

@section('content')
<div class="mb-4">
    <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
        <img width="20" src="{{asset('assets/back-end/img/profile.png')}}" alt="">
        {{\App\CPU\translate('profile')}}
    </h2>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">{{\App\CPU\translate('personal_info')}}</h5>
            </div>
            <div class="card-body">
                <form action="{{route('delivery-man.profile.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{\App\CPU\translate('first_name')}} *</label>
                                <input type="text" class="form-control" name="f_name" value="{{ $deliveryMan->f_name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{\App\CPU\translate('last_name')}} *</label>
                                <input type="text" class="form-control" name="l_name" value="{{ $deliveryMan->l_name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{\App\CPU\translate('email')}} *</label>
                                <input type="email" class="form-control" name="email" value="{{ $deliveryMan->email }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{\App\CPU\translate('phone')}} *</label>
                                <input type="text" class="form-control" name="phone" value="{{ $deliveryMan->phone }}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{\App\CPU\translate('address')}}</label>
                                <textarea class="form-control" name="address" rows="2">{{ $deliveryMan->address }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{\App\CPU\translate('profile_image')}}</label>
                                <input type="file" class="form-control" name="image" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn--primary">{{\App\CPU\translate('update_profile')}}</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="{{ asset('storage/delivery-man/' . ($deliveryMan->image ?? 'def.png')) }}"
                     class="rounded-circle mb-3" width="120" height="120"
                     onerror="this.src='{{asset('assets/back-end/img/400x400/img2.jpg')}}'" alt="">
                <h5>{{ $deliveryMan->f_name }} {{ $deliveryMan->l_name }}</h5>
                <p class="text-muted">{{ $deliveryMan->phone }}</p>
                <p class="text-muted">{{ $deliveryMan->email }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{\App\CPU\translate('change_password')}}</h5>
            </div>
            <div class="card-body">
                <form action="{{route('delivery-man.profile.update-password')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>{{\App\CPU\translate('current_password')}}</label>
                        <input type="password" class="form-control" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label>{{\App\CPU\translate('new_password')}}</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>{{\App\CPU\translate('confirm_password')}}</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn--primary btn-block">{{\App\CPU\translate('change_password')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
