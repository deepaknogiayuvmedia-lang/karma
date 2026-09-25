@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Update Membership Plan'))

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="{{ asset('/assets/back-end/img/coupon_setup.png') }}" alt="">
                {{ \App\CPU\translate('Update_Membership_Plan') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="{{ route('admin.membership-plan.update', [$plan->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $plan->id }}">
                            <div class="row">
                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="form-group">
                                        <label class="title-color">{{ \App\CPU\translate('Plan_Name') }}</label>
                                        <input type="text" name="name" value="{{ $plan->name }}"
                                            class="form-control" placeholder="{{ \App\CPU\translate('Ex: Basic') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="form-group">
                                        <label class="title-color">{{ \App\CPU\translate('Price') }}</label>
                                        <input type="number" step="0.01" name="price" value="{{ $plan->price }}"
                                            class="form-control" placeholder="{{ \App\CPU\translate('Ex: 500') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="form-group">
                                        <label class="title-color">{{ \App\CPU\translate('User_Type') }}</label>
                                        <select name="user_type" class="form-control" required>
                                            <option value="customer"
                                                {{ $plan->user_type == 'customer' ? 'selected' : '' }}>
                                                {{ \App\CPU\translate('Customer') }}</option>
                                            <option value="seller" {{ $plan->user_type == 'seller' ? 'selected' : '' }}>
                                                {{ \App\CPU\translate('Seller') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="form-group">
                                        <label class="title-color">{{ \App\CPU\translate('Duration') }}</label>
                                        <div class="input-group">
                                            <input type="number" name="duration" value="{{ $plan->duration }}"
                                                class="form-control" placeholder="{{ \App\CPU\translate('Ex: 1') }}"
                                                required>
                                            <select name="duration_type" class="form-control">
                                                <option value="day"
                                                    {{ $plan->duration_type == 'day' ? 'selected' : '' }}>
                                                    {{ \App\CPU\translate('Day') }}</option>
                                                <option value="month"
                                                    {{ $plan->duration_type == 'month' ? 'selected' : '' }}>
                                                    {{ \App\CPU\translate('Month') }}</option>
                                                <option value="year"
                                                    {{ $plan->duration_type == 'year' ? 'selected' : '' }}>
                                                    {{ \App\CPU\translate('Year') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="title-color">{{ \App\CPU\translate('Features') }}</label>
                                        <div id="feature-list">
                                            @if ($plan->features && is_array($plan->features))
                                                @foreach ($plan->features as $key => $feature)
                                                    <div class="d-flex mb-2 gap-2">
                                                        <input type="text" name="features[]" value="{{ $feature }}"
                                                            class="form-control"
                                                            placeholder="{{ \App\CPU\translate('Feature_Description') }}">
                                                        @if ($key == 0)
                                                            <button type="button"
                                                                class="btn btn-primary btn-sm add-feature"><i
                                                                    class="tio-add"></i></button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm remove-feature"><i
                                                                    class="tio-delete"></i></button>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="d-flex mb-2 gap-2">
                                                    <input type="text" name="features[]" class="form-control"
                                                        placeholder="{{ \App\CPU\translate('Feature_Description') }}">
                                                    <button type="button" class="btn btn-primary btn-sm add-feature"><i
                                                            class="tio-add"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-3">
                                <button type="reset"
                                    class="btn btn-secondary px-4">{{ \App\CPU\translate('reset') }}</button>
                                <button type="submit"
                                    class="btn btn--primary btn-primary px-4">{{ \App\CPU\translate('update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).on('click', '.add-feature', function() {
            $('#feature-list').append(`
                <div class="d-flex mb-2 gap-2">
                    <input type="text" name="features[]" class="form-control" placeholder="{{ \App\CPU\translate('Feature_Description') }}">
                    <button type="button" class="btn btn-danger btn-sm remove-feature"><i class="tio-delete"></i></button>
                </div>
            `);
        });

        $(document).on('click', '.remove-feature', function() {
            $(this).parent().remove();
        });
    </script>
@endpush
