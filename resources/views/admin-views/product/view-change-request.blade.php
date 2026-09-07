@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Change Request Details'))

@section('content')
    <div class="content container-fluid">
        <div class="mb-4">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img width="20" src="{{ asset('assets/back-end/img/products.png') }}" alt="">
                {{ \App\CPU\translate('Change Request Details') }}
            </h2>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">{{ \App\CPU\translate('Request Information') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>{{ \App\CPU\translate('Product') }}:</strong>
                                    @if ($changeRequest->product)
                                        <a href="{{ route('admin.product.view', [$changeRequest->product_id]) }}">
                                            {{ $changeRequest->product->name }}
                                        </a>
                                    @else
                                        <span class="text-muted">Deleted</span>
                                    @endif
                                </p>
                                <p><strong>{{ \App\CPU\translate('Seller') }}:</strong>
                                    @if ($changeRequest->seller)
                                        {{ $changeRequest->seller->f_name }} {{ $changeRequest->seller->l_name }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>{{ \App\CPU\translate('Status') }}:</strong>
                                    @if ($changeRequest->status == 'pending')
                                        <label class="badge badge-soft-warning">{{ \App\CPU\translate('Pending') }}</label>
                                    @elseif($changeRequest->status == 'approved')
                                        <label
                                            class="badge badge-soft-success">{{ \App\CPU\translate('Approved') }}</label>
                                    @elseif($changeRequest->status == 'rejected')
                                        <label class="badge badge-soft-danger">{{ \App\CPU\translate('Rejected') }}</label>
                                    @endif
                                </p>
                                <p><strong>{{ \App\CPU\translate('Date') }}:</strong>
                                    {{ $changeRequest->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Changes Comparison -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">{{ \App\CPU\translate('Changes Comparison') }}</h5>
                    </div>
                    <div class="card-body">
                        @if($changeRequest->old_data && $changeRequest->new_data)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ \App\CPU\translate('Field') }}</th>
                                            <th class="text-danger">{{ \App\CPU\translate('Old Value') }}</th>
                                            <th class="text-success">{{ \App\CPU\translate('New Value') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($changeRequest->new_data as $key => $newVal)

                                            @php
                                                $oldVal = $changeRequest->old_data[$key] ?? '';
                                                $newVal = $newVal;
                                                $maps = [
                                                    'brandMap' => $brandMap ?? [],
                                                    'categoryMap' => $categoryMap ?? [],
                                                    'attributeMap' => $attributeMap ?? [],
                                                    'choiceAttrMap' => $choiceAttrMap ?? [],
                                                    'colorMap' => $colorMap ?? [],
                                                ];
                                                $oldDisplay = \App\Helpers\ChangeRequestFormatter::format($key, $oldVal, $maps);
                                                $newDisplay = \App\Helpers\ChangeRequestFormatter::format($key, $newVal, $maps);
                                            @endphp
                                            @if($oldDisplay != $newDisplay)
                                                <tr>
                                                    <td><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}</strong></td>
                                                    <td class="text-danger">
                                                        @php
                                                            $oldDisplayStr = is_array($oldDisplay) ? json_encode($oldDisplay) : (string)$oldDisplay;
                                                            $isHtml = str_contains($oldDisplayStr, '<table') || str_contains($oldDisplayStr, '<div');
                                                        @endphp
                                                        @if($isHtml)
                                                            {!! \Illuminate\Support\Str::limit($oldDisplayStr, 500) !!}
                                                        @else
                                                            {{ \Illuminate\Support\Str::limit($oldDisplayStr, 100) }}
                                                        @endif
                                                    </td>
                                                    <td class="text-success">
                                                        @php
                                                            $newDisplayStr = is_array($newDisplay) ? json_encode($newDisplay) : (string)$newDisplay;
                                                            $isHtml = str_contains($newDisplayStr, '<table') || str_contains($newDisplayStr, '<div');
                                                        @endphp
                                                        @if($isHtml)
                                                            {!! \Illuminate\Support\Str::limit($newDisplayStr, 500) !!}
                                                        @else
                                                            {{ \Illuminate\Support\Str::limit($newDisplayStr, 100) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">{{ \App\CPU\translate('No change data available') }}</p>
                        @endif
                    </div>
                </div>


                <!-- Uploaded Images Preview -->
                @php $tempImages = $changeRequest->new_data['temp_images'] ?? []; @endphp
                @if (!empty($tempImages))
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">{{ \App\CPU\translate('Uploaded Images') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if (!empty($tempImages['thumbnail']))
                                    <div class="col-md-3 mb-3">
                                        <label>{{ \App\CPU\translate('Thumbnail') }}</label>
                                        <img src="{{ asset('storage/temp/product_images/' . $tempImages['thumbnail']) }}"
                                            class="img-fluid rounded border" alt="Thumbnail">
                                    </div>
                                @endif
                                @if (!empty($tempImages['images']))
                                    @foreach ($tempImages['images'] as $img)
                                        <div class="col-md-3 mb-3">
                                            <label>{{ \App\CPU\translate('Image') }} {{ $loop->iteration }}</label>
                                            <img src="{{ asset('storage/temp/product_images/' . $img) }}"
                                                class="img-fluid rounded border" alt="Product Image">
                                        </div>
                                    @endforeach
                                @endif
                                @if (!empty($tempImages['meta_image']))
                                    <div class="col-md-3 mb-3">
                                        <label>{{ \App\CPU\translate('Meta Image') }}</label>
                                        <img src="{{ asset('storage/temp/product_images/' . $tempImages['meta_image']) }}"
                                            class="img-fluid rounded border" alt="Meta Image">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-4">
                <!-- Action Panel -->
                @if ($changeRequest->status == 'pending')
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">{{ \App\CPU\translate('Actions') }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product.approve-change-request') }}" method="POST"
                                class="mb-3">
                                @csrf
                                <input type="hidden" name="id" value="{{ $changeRequest->id }}">
                                <div class="form-group">
                                    <label>{{ \App\CPU\translate('Admin Note') }} (Optional)</label>
                                    <textarea name="admin_note" class="form-control" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="tio-checkmark-circle"></i>
                                    {{ \App\CPU\translate('Approve & Apply Changes') }}
                                </button>
                            </form>

                            <hr>

                            <form action="{{ route('admin.product.reject-change-request') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $changeRequest->id }}">
                                <div class="form-group">
                                    <label>{{ \App\CPU\translate('Admin Note') }} *</label>
                                    <textarea name="admin_note" class="form-control" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-danger btn-block">
                                    <i class="tio-clear-circle"></i> {{ \App\CPU\translate('Reject Changes') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                <!-- Current Product Info -->
                @if ($changeRequest->product)
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">{{ \App\CPU\translate('Current Product') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $changeRequest->product->thumbnail }}"
                                    class="img-fluid rounded border" style="max-height: 150px;" alt="">
                            </div>
                            <p><strong>{{ \App\CPU\translate('Name') }}:</strong> {{ $changeRequest->product->name }}</p>
                            <p><strong>{{ \App\CPU\translate('Price') }}:</strong>
                                {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($changeRequest->product->unit_price)) }}
                            </p>
                            <p><strong>{{ \App\CPU\translate('Status') }}:</strong>
                                @if ($changeRequest->product->approval_status == 'approved')
                                    <label class="badge badge-soft-success">{{ \App\CPU\translate('Approved') }}</label>
                                @elseif($changeRequest->product->approval_status == 'pending_edit')
                                    <label
                                        class="badge badge-soft-warning">{{ \App\CPU\translate('Pending Edit') }}</label>
                                @else
                                    <label
                                        class="badge badge-soft-secondary">{{ $changeRequest->product->approval_status }}</label>
                                @endif
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


@section('title', \App\CPU\translate('Change Request Details'))

@section('content')
    <div class="content container-fluid">
        <div class="mb-4">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img width="20" src="{{ asset('assets/back-end/img/products.png') }}" alt="">
                {{ \App\CPU\translate('Change Request Details') }}
            </h2>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">{{ \App\CPU\translate('Request Information') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>{{ \App\CPU\translate('Product') }}:</strong>
                                    @if ($changeRequest->product)
                                        <a href="{{ route('admin.product.view', [$changeRequest->product_id]) }}">
                                            {{ $changeRequest->product->name }}
                                        </a>
                                    @else
                                        <span class="text-muted">Deleted</span>
                                    @endif
                                </p>
                                <p><strong>{{ \App\CPU\translate('Seller') }}:</strong>
                                    @if ($changeRequest->seller)
                                        {{ $changeRequest->seller->f_name }} {{ $changeRequest->seller->l_name }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>{{ \App\CPU\translate('Status') }}:</strong>
                                    @if ($changeRequest->status == 'pending')
                                        <label
                                            class="badge badge-soft-warning">{{ \App\CPU\translate('Pending') }}</label>
                                    @elseif($changeRequest->status == 'approved')
                                        <label
                                            class="badge badge-soft-success">{{ \App\CPU\translate('Approved') }}</label>
                                    @elseif($changeRequest->status == 'rejected')
                                        <label
                                            class="badge badge-soft-danger">{{ \App\CPU\translate('Rejected') }}</label>
                                    @endif
                                </p>
                                <p><strong>{{ \App\CPU\translate('Date') }}:</strong>
                                    {{ $changeRequest->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Changes Comparison -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">{{ \App\CPU\translate('Changes Comparison') }}</h5>
                    </div>
                    <div class="card-body">
                        @if ($changeRequest->old_data && $changeRequest->new_data)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ \App\CPU\translate('Field') }}</th>
                                            <th class="text-danger">{{ \App\CPU\translate('Old Value') }}</th>
                                            <th class="text-success">{{ \App\CPU\translate('New Value') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($changeRequest->new_data as $key => $newVal)
                                            @php
                                                $oldVal = $changeRequest->old_data[$key] ?? '';
                                                $newVal = $newVal;
                                                $maps = [
                                                    'brandMap' => $brandMap ?? [],
                                                    'categoryMap' => $categoryMap ?? [],
                                                    'attributeMap' => $attributeMap ?? [],
                                                    'choiceAttrMap' => $choiceAttrMap ?? [],
                                                ];
                                                $oldDisplay = \App\Helpers\ChangeRequestFormatter::format(
                                                    $key,
                                                    $oldVal,
                                                    $maps,
                                                );
                                                $newDisplay = \App\Helpers\ChangeRequestFormatter::format(
                                                    $key,
                                                    $newVal,
                                                    $maps,
                                                );
                                            @endphp
                                            @if ($oldDisplay != $newDisplay)
                                                <tr>
                                                    <td><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}</strong></td>
                                                    <td class="text-danger">
                                                        @php
                                                            $oldDisplayStr = is_array($oldDisplay) ? json_encode($oldDisplay) : (string)$oldDisplay;
                                                            $isHtml = str_contains($oldDisplayStr, '<table') || str_contains($oldDisplayStr, '<div');
                                                        @endphp
                                                        @if($isHtml)
                                                            {!! \Illuminate\Support\Str::limit($oldDisplayStr, 500) !!}
                                                        @else
                                                            {{ \Illuminate\Support\Str::limit($oldDisplayStr, 100) }}
                                                        @endif
                                                    </td>
                                                    <td class="text-success">
                                                        @php
                                                            $newDisplayStr = is_array($newDisplay) ? json_encode($newDisplay) : (string)$newDisplay;
                                                            $isHtml = str_contains($newDisplayStr, '<table') || str_contains($newDisplayStr, '<div');
                                                        @endphp
                                                        @if($isHtml)
                                                            {!! \Illuminate\Support\Str::limit($newDisplayStr, 500) !!}
                                                        @else
                                                            {{ \Illuminate\Support\Str::limit($newDisplayStr, 100) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">{{ \App\CPU\translate('No change data available') }}</p>
                        @endif
                    </div>
                </div>

                <!-- Uploaded Images Preview -->
                @php $tempImages = $changeRequest->new_data['temp_images'] ?? []; @endphp
                @if (!empty($tempImages))
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">{{ \App\CPU\translate('Uploaded Images') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if (!empty($tempImages['thumbnail']))
                                    <div class="col-md-3 mb-3">
                                        <label>{{ \App\CPU\translate('Thumbnail') }}</label>
                                        <img src="{{ asset('storage/temp/product_images/' . $tempImages['thumbnail']) }}"
                                            class="img-fluid rounded border" alt="Thumbnail">
                                    </div>
                                @endif
                                @if (!empty($tempImages['images']))
                                    @foreach ($tempImages['images'] as $img)
                                        <div class="col-md-3 mb-3">
                                            <label>{{ \App\CPU\translate('Image') }} {{ $loop->iteration }}</label>
                                            <img src="{{ asset('storage/temp/product_images/' . $img) }}"
                                                class="img-fluid rounded border" alt="Product Image">
                                        </div>
                                    @endforeach
                                @endif
                                @if (!empty($tempImages['meta_image']))
                                    <div class="col-md-3 mb-3">
                                        <label>{{ \App\CPU\translate('Meta Image') }}</label>
                                        <img src="{{ asset('storage/temp/product_images/' . $tempImages['meta_image']) }}"
                                            class="img-fluid rounded border" alt="Meta Image">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-4">
                <!-- Action Panel -->
                @if ($changeRequest->status == 'pending')
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">{{ \App\CPU\translate('Actions') }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product.approve-change-request') }}" method="POST"
                                class="mb-3">
                                @csrf
                                <input type="hidden" name="id" value="{{ $changeRequest->id }}">
                                <div class="form-group">
                                    <label>{{ \App\CPU\translate('Admin Note') }} (Optional)</label>
                                    <textarea name="admin_note" class="form-control" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="tio-checkmark-circle"></i>
                                    {{ \App\CPU\translate('Approve & Apply Changes') }}
                                </button>
                            </form>

                            <hr>

                            <form action="{{ route('admin.product.reject-change-request') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $changeRequest->id }}">
                                <div class="form-group">
                                    <label>{{ \App\CPU\translate('Admin Note') }} *</label>
                                    <textarea name="admin_note" class="form-control" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-danger btn-block">
                                    <i class="tio-clear-circle"></i> {{ \App\CPU\translate('Reject Changes') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                <!-- Current Product Info -->
                @if ($changeRequest->product)
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">{{ \App\CPU\translate('Current Product') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $changeRequest->product->thumbnail }}"
                                    class="img-fluid rounded border" style="max-height: 150px;" alt="">
                            </div>
                            <p><strong>{{ \App\CPU\translate('Name') }}:</strong> {{ $changeRequest->product->name }}</p>
                            <p><strong>{{ \App\CPU\translate('Price') }}:</strong>
                                {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($changeRequest->product->unit_price)) }}
                            </p>
                            <p><strong>{{ \App\CPU\translate('Status') }}:</strong>
                                @if ($changeRequest->product->approval_status == 'approved')
                                    <label class="badge badge-soft-success">{{ \App\CPU\translate('Approved') }}</label>
                                @elseif($changeRequest->product->approval_status == 'pending_edit')
                                    <label
                                        class="badge badge-soft-warning">{{ \App\CPU\translate('Pending Edit') }}</label>
                                @else
                                    <label
                                        class="badge badge-soft-secondary">{{ $changeRequest->product->approval_status }}</label>
                                @endif
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
