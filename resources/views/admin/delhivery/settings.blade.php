@extends('layouts.back-end.app')

@section('title', 'Delhivery Settings')

@section('content')
    <div class="content container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Delhivery Settings</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.delhivery.settings.save') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Enable Delhivery</label>
                        <input type="checkbox" name="is_enabled" value="1" {{ ($settings->is_enabled ?? false) ? 'checked' : '' }}>
                    </div>
                    <div class="form-group">
                        <label>Environment</label>
                        <select class="form-control" name="environment">
                            @php($env = strtolower((string) ($settings->environment ?? 'test')))
                            <option value="test" {{ in_array($env, ['test', 'staging'], true) ? 'selected' : '' }}>Test</option>
                            <option value="live" {{ in_array($env, ['live', 'production'], true) ? 'selected' : '' }}>Live</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Base URL</label>
                        <input type="url" class="form-control" name="base_url" value="{{ $settings->base_url ?? 'https://staging-express.delhivery.com' }}">
                    </div>
                    <div class="form-group">
                        <label>API Token</label>
                        <input type="text" class="form-control" name="api_token" value="" placeholder="Leave blank to keep current token">
                    </div>
                    <div class="form-group">
                        <label>Pickup Location</label>
                        <input type="text" class="form-control" name="pickup_location" value="{{ $settings->pickup_location ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Settings</button>
                </form>
            </div>
        </div>
    </div>
@endsection
