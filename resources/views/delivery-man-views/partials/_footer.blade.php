<div class="container-fluid ">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6">
            <div class="d-none d-sm-flex align-items-center">
                <span class="text-capitalize">{{\App\CPU\translate('copyright')}} &copy; {{date('Y')}} <a href="{{route('home')}}" target="_blank" class="text-dark">{{\App\Model\BusinessSetting::where('type','company_name')->first()->value ?? config('app.name')}}</a></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-none d-sm-flex justify-content-md-end">
                <span class="text-capitalize">{{\App\CPU\translate('delivery_man')}} {{\App\CPU\translate('Panel')}}</span>
            </div>
        </div>
    </div>
</div>
