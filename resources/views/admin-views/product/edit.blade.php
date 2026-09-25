@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Product Edit'))

@push('css_or_js')
    <link href="{{ asset('assets/back-end/css/tags-input.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                <img src="{{ asset('/assets/back-end/img/inhouse-product-list.png') }}" alt="">
                {{ \App\CPU\translate('Product') }} {{ \App\CPU\translate('Edit') }}
            </h2>
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <form class="product-form" action="{{ route('admin.product.update', $product->id) }}" method="post"
                    style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};"
                    enctype="multipart/form-data" id="product_form">
                    @csrf

                    <div class="card">
                        <div class="px-4 pt-3">
                            @php($language = \App\Model\BusinessSetting::where('type', 'pnc_language')->first())
                            @php($language = $language->value ?? null)
                            @php($default_lang = 'en')

                            @php($default_lang = json_decode($language)[0])
                            @if (isset($language_status) && $language_status == 1)
                                <ul class="nav nav-tabs w-fit-content mb-4">
                                    @foreach (json_decode($language) as $lang)
                                        <li class="nav-item text-capitalize">
                                            <a class="nav-link lang_link {{ $lang == $default_lang ? 'active' : '' }}"
                                                href="#"
                                                id="{{ $lang }}-link">{{ \App\CPU\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="card-body">
                            @if (isset($language_status) && $language_status == 1)
                                @foreach (json_decode($language) as $lang)
                                    <?php
                                    if (count($product['translations'])) {
                                        $translate = [];
                                        foreach ($product['translations'] as $t) {
                                            if ($t->locale == $lang && $t->key == 'name') {
                                                $translate[$lang]['name'] = $t->value;
                                            }
                                            if ($t->locale == $lang && $t->key == 'detail') {
                                                $translate[$lang]['detail'] = $t->value;
                                            }
                                            if ($t->locale == $lang && $t->key == 'technical_name') {
                                                $translate[$lang]['technical_name'] = $t->value;
                                            }
                                            if ($t->locale == $lang && $t->key == 'tally_name') {
                                                $translate[$lang]['tally_name'] = $t->value;
                                            }
                                        }
                                    }
                                    ?>
                                    <div class="{{ $lang != 'en' ? 'd-none' : '' }} lang_form"
                                        id="{{ $lang }}-form">

                                        <div class="row">
                                            <div class="col-md-4 form-group">
                                                <label class="title-color"
                                                    for="{{ $lang }}_name">{{ \App\CPU\translate('name') }}<span
                                                        class="text-danger">*</span>
                                                    ({{ strtoupper($lang) }})
                                                </label>
                                                <input type="text" {{ $lang == 'en' ? 'required' : '' }} name="name[]"
                                                    id="{{ $lang }}_name"
                                                    value="{{ $translate[$lang]['name'] ?? $product['name'] }}"
                                                    class="form-control"
                                                    placeholder="{{ \App\CPU\translate('New Product') }}" required>
                                                <input type="hidden" name="lang[]" value="{{ $lang }}">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="title-color"
                                                    for="{{ $lang }}_technical_name">{{ \App\CPU\translate('Technical Name') }}</label>
                                                <div style="position:relative;" class="tech-wrapper">
                                                    <input type="text" name="technical_name[]"
                                                        id="{{ $lang }}_technical_name" class="form-control"
                                                        value="{{ old('technical_name')[$loop->index] ?? ($translate[$lang]['technical_name'] ?? ($product->technical_name ?? '')) }}"
                                                        placeholder="{{ \App\CPU\translate('Technical Name') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="title-color"
                                                    for="{{ $lang }}_name">{{ \App\CPU\translate('Product Register Name') }}<span
                                                        class="text-danger">*</span>
                                                    ({{ strtoupper($lang) }})</label>
                                                <input type="text" {{ $lang == 'en' ? 'required' : '' }} name="prn[]"
                                                    id="prn_name"
                                                    value="{{ $translate[$lang]['tally_name'] ?? ($product->tally_name ?? '') }}"
                                                    class="form-control"
                                                    placeholder="{{ \App\CPU\translate('Product Register Name') }}"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="form-group pt-4">
                                            <label class="title-color">{{ \App\CPU\translate('description') }}
                                                ({{ strtoupper($lang) }})</label>
                                            <div style="position:relative;">
                                                <textarea name="description[]" class="tiny-editor w-100" rows="10">{!! $translate[$lang]['description'] ?? $product['details'] !!}</textarea>
                                                <div id="editor-loading" class="text-center border rounded"
                                                    style="display:none; position:absolute; top:0; left:0; right:0; bottom:0; z-index:10; background:#fff; align-items:center; justify-content:center; flex-direction:column;">
                                                    <div class="spinner-border text-primary" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                    <p class="mt-2 text-muted">Editor loading...</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <?php
                                $translate = [];
                                if (count($product['translations'])) {
                                    foreach ($product['translations'] as $t) {
                                        if ($t->locale == 'en' && $t->key == 'name') {
                                            $translate['name'] = $t->value;
                                        }
                                        if ($t->locale == 'en' && $t->key == 'description') {
                                            $translate['description'] = $t->value;
                                        }
                                        if ($t->locale == 'en' && $t->key == 'technical_name') {
                                            $translate['technical_name'] = $t->value;
                                        }
                                        if ($t->locale == 'en' && $t->key == 'tally_name') {
                                            $translate['tally_name'] = $t->value;
                                        }
                                    }
                                }
                                ?>
                                <div class="lang_form" id="en-form">
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label class="title-color" for="en_name">{{ \App\CPU\translate('name') }}<span
                                                    class="text-danger">*</span>

                                            </label>
                                            <input type="text" required name="name[]" id="en_name"
                                                value="{{ $translate['name'] ?? $product['name'] }}" class="form-control"
                                                placeholder="{{ \App\CPU\translate('New Product') }}" required>
                                            <input type="hidden" name="lang[]" value="en">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="title-color"
                                                for="en_technical_name">{{ \App\CPU\translate('Technical Name') }}</label>
                                            <div style="position:relative;" class="tech-wrapper">
                                                <input type="text" name="technical_name[]" class="form-control"
                                                    value="{{ $translate['technical_name'] ?? ($product->technical_name ?? '') }}"
                                                    placeholder="{{ \App\CPU\translate('Technical Name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="title-color"
                                                for="en_name">{{ \App\CPU\translate('Product Register Name') }}<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="prn[]" id="prn_name"
                                                value="{{ $translate['tally_name'] ?? ($product->tally_name ?? '') }}"
                                                class="form-control"
                                                placeholder="{{ \App\CPU\translate('Product Register Name') }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group pt-4">
                                        <label class="title-color">{{ \App\CPU\translate('description') }}
                                        </label>
                                        <div style="position:relative;">
                                            <textarea name="description[]" class="tiny-editor w-100" rows="10">{!! $translate['description'] ?? $product['details'] !!}</textarea>
                                            <div id="editor-loading" class="text-center border rounded"
                                                style="display:none; position:absolute; top:0; left:0; right:0; bottom:0; z-index:10; background:#fff; align-items:center; justify-content:center; flex-direction:column;">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                <p class="mt-2 text-muted">Editor loading...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4 class="mb-0">{{ \App\CPU\translate('General Info') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="product_type" id="product_type" value="physical">
                                <div class="col-md-4" id="digital_product_type_show" style="display: none;">
                                    <label for="digital_product_type"
                                        class="title-color">{{ \App\CPU\translate('digital_product_type') }}</label>
                                    <select name="digital_product_type" id="digital_product_type" class="form-control">
                                        <option value="{{ old('category_id') }}"
                                            {{ !$product->digital_product_type ? 'selected' : '' }} disabled>---Select---
                                        </option>
                                        <option value="ready_after_sell"
                                            {{ $product->digital_product_type == 'ready_after_sell' ? 'selected' : '' }}>
                                            {{ \App\CPU\translate('Ready After Sell') }}</option>
                                        <option value="ready_product"
                                            {{ $product->digital_product_type == 'ready_product' ? 'selected' : '' }}>
                                            {{ \App\CPU\translate('Ready Product') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4" id="digital_file_ready_show" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="digital_file_ready"
                                                class="title-color">{{ \App\CPU\translate('ready_product_upload') }}</label>
                                            <input type="file" name="digital_file_ready" id="digital_file_ready"
                                                class="form-control">
                                            <div class="mt-1 text-info">File type: jpg, jpeg, png, gif, zip, pdf</div>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="h-100 mt-5">
                                                <a href="{{ asset(config('app.public_storage_path') . "/product/digital-product/$product->digital_file_ready") }}"
                                                    target="_blank">{{ $product->digital_file_ready }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="name"
                                        class="title-color">{{ \App\CPU\translate('Category') }}</label>
                                    <select class="js-example-basic-multiple js-states js-example-responsive form-control"
                                        name="category_id" id="category_id"
                                        onchange="getRequest('{{ url('/') }}/admin/product/get-categories?parent_id='+this.value,'sub-category-select','select')">
                                        <option value="0" selected disabled>---{{ \App\CPU\translate('Select') }}---
                                        </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category['id'] }}"
                                                {{ $category->id == $product_category[0]->id ? 'selected' : '' }}>
                                                {{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4" id="sub-category-select-div"
                                    style="{{ count($product_category) >= 2 ? '' : 'display: none;' }}">
                                    <label for="name"
                                        class="title-color">{{ \App\CPU\translate('Sub Category') }}</label>
                                    <select class="js-example-basic-multiple js-states js-example-responsive form-control"
                                        name="sub_category_id" id="sub-category-select"
                                        data-id="{{ count($product_category) >= 2 ? $product_category[1]->id : '' }}">
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="title-color"
                                            for="exampleFormControlInput1">{{ \App\CPU\translate('product_code_sku') }}
                                            <span class="text-danger">*</span>
                                            <a class="style-one-pro cursor-pointer"
                                                onclick="document.getElementById('generate_number').value = getRndInteger()">{{ \App\CPU\translate('generate') }}
                                                {{ \App\CPU\translate('code') }}</a></label>
                                        <input type="text" id="generate_number" name="code" class="form-control"
                                            value="{{ $product->code }}" required>
                                    </div>
                                </div>
                                @if ($brand_setting)
                                    <div class="col-md-4">
                                        <label for="name"
                                            class="title-color">{{ \App\CPU\translate('Brand') }}</label>
                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control"
                                            name="brand_id">
                                            <option value="{{ null }}" selected disabled>
                                                ---{{ \App\CPU\translate('Select') }}---</option>
                                            @foreach ($br as $b)
                                                <option value="{{ $b['id'] }}"
                                                    {{ $b->id == $product->brand_id ? 'selected' : '' }}>
                                                    {{ $b['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div class="col-md-4 physical_product_show">
                                    <div class="form-group">
                                        <label for="name"
                                            class="title-color">{{ \App\CPU\translate('Unit') }}</label>
                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control"
                                            name="unit">
                                            @foreach (\App\CPU\Helpers::units() as $x)
                                                <option value={{ $x }}
                                                    {{ $product->unit == $x ? 'selected' : '' }}>{{ $x }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2 rest-part physical_product_show">
                        <div class="card-header">
                            <h4 class="mb-0">{{ \App\CPU\translate('Variation') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-end">
                                <div class="col-md-6">
                                    <div class="mb-3 d-flex align-items-center gap-2">
                                        <label class="mb-0 title-color" for="switcher">
                                            {{ \App\CPU\translate('Colors') }} :
                                        </label>
                                        <label class="switcher title-color">
                                            <input type="checkbox" class="switcher_input" id="color_switcher"
                                                name="colors_active" {{ count($product['colors']) > 0 ? 'checked' : '' }}>
                                            <span class="switcher_control"></span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select"
                                            name="colors[]" multiple="multiple" id="colors-selector"
                                            {{ count($product['colors']) > 0 ? '' : 'disabled' }}>
                                            @foreach (\App\Model\Color::orderBy('name', 'asc')->get() as $key => $color)
                                                <option value={{ $color->code }}
                                                    {{ in_array($color->code, $product['colors']) ? 'selected' : '' }}>
                                                    {{ $color['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="attributes" class="pb-1 title-color">
                                        {{ \App\CPU\translate('Attributes') }} :
                                    </label>
                                    <select class="js-example-basic-multiple js-states js-example-responsive form-control"
                                        name="choice_attributes[]" id="choice_attributes" multiple="multiple">
                                        @foreach (\App\Model\Attribute::orderBy('name', 'asc')->get() as $key => $a)
                                            @if ($product['attributes'] != 'null')
                                                <option value="{{ $a['id'] }}"
                                                    {{ in_array($a->id, json_decode($product['attributes'], true)) ? 'selected' : '' }}>
                                                    {{ $a['name'] }}
                                                </option>
                                            @else
                                                <option value="{{ $a['id'] }}">{{ $a['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 mt-2 mb-2">
                                    <div class="customer_choice_options" id="customer_choice_options">
                                        @include('admin-views.product.partials._choices', [
                                            'choice_no' => json_decode($product['attributes']),
                                            'choice_options' => json_decode($product['choice_options'], true),
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4 class="mb-0">{{ \App\CPU\translate('Product price & stock') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-end">
                                <div class="col-md-6 form-group">
                                    <label class="title-color">{{ \App\CPU\translate('Market price') }}</label>
                                    <input type="number" min="0" step="0.01"
                                        placeholder="{{ \App\CPU\translate('Unit price') }}" name="unit_price"
                                        class="form-control" value={{ \App\CPU\Convert::default($product->unit_price) }}
                                        required>
                                    <small id="tax-price-note" class="text-muted font-italic"><i
                                            class="fa fa-info-circle"></i>
                                        {{ \App\CPU\translate('Price should be tax inclusive') }}</small>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="title-color">{{ \App\CPU\translate('Purchese price') }}</label>
                                    <input type="number" min="0" step="0.01"
                                        placeholder="{{ \App\CPU\translate('Purchase price') }}" name="purchase_price"
                                        class="form-control"
                                        value={{ \App\CPU\Convert::default($product->purchase_price) }} required>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="title-color">{{ \App\CPU\translate('Admin Commission') }}
                                        ({{ \App\CPU\translate('optional') }})</label>
                                    <input type="number" min="0" step="0.01"
                                        placeholder="{{ \App\CPU\translate('Commission') }}"
                                        value="{{ $product->admin_commission }}" name="admin_commission"
                                        class="form-control">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="title-color">{{ \App\CPU\translate('Commission Type') }}</label>
                                    <select name="admin_commission_type" class="form-control">
                                        <option value="percentage"
                                            {{ $product->admin_commission_type == 'percentage' ? 'selected' : '' }}>
                                            {{ \App\CPU\translate('Percentage') }} (%)</option>
                                        <option value="fixed"
                                            {{ $product->admin_commission_type == 'fixed' ? 'selected' : '' }}>
                                            {{ \App\CPU\translate('Fixed') }} ({{ \App\CPU\translate('INR') }})</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="title-color">{{ \App\CPU\translate('Tax') }}</label>
                                    <label class="text-info title-color">{{ \App\CPU\translate('Percent') }} ( %
                                        )</label>
                                    <input type="number" min="0" value={{ $product->tax }} step="0.01"
                                        placeholder="{{ \App\CPU\translate('Tax') }}" name="tax"
                                        class="form-control" required>
                                    <input name="tax_type" value="percent" class="d-none">
                                </div>

                                <div class="col-md-2 form-group" style="display: none;">
                                    <label class="title-color">{{ \App\CPU\translate('Tax_Model') }}</label>
                                    <select name="tax_model" id="tax_model" class="form-control" required>
                                        <option value="include" {{ $product->tax_model == 'include' ? 'selected' : '' }}>
                                            {{ \App\CPU\translate('include') }}</option>
                                        <option value="exclude" {{ $product->tax_model == 'exclude' ? 'selected' : '' }}>
                                            {{ \App\CPU\translate('exclude') }}</option>
                                    </select>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label class="title-color">{{ \App\CPU\translate('Discount') }}</label>
                                    <input type="number" min="0"
                                        value={{ $product->discount_type == 'flat' ? \App\CPU\Convert::default($product->discount) : $product->discount }}
                                        step="0.01" placeholder="{{ \App\CPU\translate('Discount') }}"
                                        name="discount" class="form-control" required>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label class="title-color">{{ \App\CPU\translate('discount_type') }} </label>
                                    <select class="form-control" name="discount_type">
                                        <option value="percent"
                                            {{ $product['discount_type'] == 'percent' ? 'selected' : '' }}>
                                            {{ \App\CPU\translate('Percent') }}</option>
                                        <option value="flat"
                                            {{ $product['discount_type'] == 'flat' ? 'selected' : '' }}>
                                            {{ \App\CPU\translate('Flat') }}</option>

                                    </select>
                                </div>
                                <div class="col-12 sku_combination table-responsive form-group" id="sku_combination">
                                    @include('admin-views.product.partials._edit_sku_combinations', [
                                        'combinations' => json_decode($product['variation'], true),
                                    ])
                                </div>
                                <div class="col-md-3 form-group physical_product_show" id="quantity">
                                    <label class="title-color">{{ \App\CPU\translate('total') }}
                                        {{ \App\CPU\translate('Quantity') }}</label>
                                    <input type="number" min="0" value={{ $product->current_stock }}
                                        step="1" placeholder="{{ \App\CPU\translate('Quantity') }}"
                                        name="current_stock" class="form-control" required>
                                </div>
                                <div class="col-md-3 form-group" id="minimum_order_qty">
                                    <label class="title-color">{{ \App\CPU\translate('minimum_order_quantity') }}</label>
                                    <input type="number" min="1" value={{ $product->minimum_order_qty }}
                                        step="1" placeholder="{{ \App\CPU\translate('minimum_order_quantity') }}"
                                        name="minimum_order_qty" class="form-control" required>
                                </div>
                                <div class="col-md-3 form-group physical_product_show" id="shipping_cost">
                                    <label class="title-color">{{ \App\CPU\translate('shipping_cost') }} </label>
                                    <input type="number" min="0"
                                        value="{{ \App\CPU\Convert::default($product->shipping_cost) }}" step="1"
                                        placeholder="{{ \App\CPU\translate('shipping_cost') }}" name="shipping_cost"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-3 form-group physical_product_show" id="shipping_cost">
                                    <label
                                        class="title-color">{{ \App\CPU\translate('shipping_cost_multiply_with_quantity') }}
                                    </label>
                                    <label class="switcher title-color">
                                        <input class="switcher_input" type="checkbox" name="multiplyQTY" id=""
                                            {{ $product->multiply_qty == 1 ? 'checked' : '' }}>
                                        <span class="switcher_control"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2 mb-2 rest-part">
                        <div class="card-header">
                            <h5 class="card-title">
                                <span class="card-header-icon"><i class="tio-label"></i></span>
                                <span>{{ \App\CPU\translate('tags') }}</span>
                            </h5>
                        </div>
                        <div class="card-body pb-0">
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="title-color">{{ \App\CPU\translate('search_tags') }}</label>
                                        <input type="text" class="form-control" name="tags"
                                            value="@foreach ($product->tags as $c) {{ $c->tag . ',' }} @endforeach"
                                            data-role="tagsinput">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2 mb-2 rest-part">
                        <div class="card-header">
                            <h4 class="mb-0">{{ \App\CPU\translate('seo_section') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="title-color">{{ \App\CPU\translate('Meta Title') }}</label>
                                    <input type="text" name="meta_title" value="{{ $product['meta_title'] }}"
                                        placeholder="" class="form-control">
                                </div>

                                <div class="col-md-8 form-group">
                                    <label class="title-color">{{ \App\CPU\translate('Meta Description') }}</label>
                                    <textarea rows="10" type="text" name="meta_description" class="form-control">{{ $product['meta_description'] }}</textarea>
                                </div>
                                <!-- {{ dump($product) }} -->
                                <div class="col-md-4 form-group">
                                    <div class="">
                                        <label class="title-color">{{ \App\CPU\translate('Meta Image') }}</label>
                                    </div>
                                    <div class="__coba-aspect">
                                        <div class="row g-2" id="meta_img">
                                            <div class="col-sm-6 col-md-12 col-lg-6">
                                                <img class="w-100" height="auto"
                                                    onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                    src="{{ asset(config('app.public_storage_path') . '/product/meta') }}/{{ $product['meta_image'] }}"
                                                    alt="Meta image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2 rest-part __coba-aspect">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <div class="mb-2">
                                        <label
                                            class="title-color mb-0">{{ \App\CPU\translate('Youtube video link') }}</label>
                                        <span class="text-info"> (
                                            {{ \App\CPU\translate('optional, please provide embed link not direct link') }}.
                                            )</span>
                                    </div>
                                    <input type="text" value="{{ $product['video_url'] }}" name="video_link"
                                        placeholder="{{ \App\CPU\translate('EX') }} : https://www.youtube.com/embed/5R06LRdUCSE"
                                        class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label
                                            class="title-color">{{ \App\CPU\translate('Upload product images') }}</label>
                                        <span class="text-info"><span class="text-danger">*</span> (
                                            {{ \App\CPU\translate('ratio') }} 1:1 )</span>
                                    </div>
                                    <div id="color_wise_image" class="row g-2 mb-4">
                                        <div class="col-12">
                                            <div class="row g-2" id="color_wise_existing_image"></div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row" id="color_wise_image_field"></div>
                                        </div>
                                    </div>
                                    <div class="coba-area">
                                        <div class="row g-2" id="coba">
                                            @if (count($product->colors) == 0)
                                                @foreach (json_decode($product->images) as $key => $photo)
                                                    <div class="col-6 col-lg-6 col-xl-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <img class="w-100" height="auto"
                                                                    onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                                    src="{{ asset(config('app.public_storage_path') . "/product/$photo") }}"
                                                                    alt="Product image">
                                                                <a href="{{ route('admin.product.remove-image', ['id' => $product['id'], 'name' => $photo]) }}"
                                                                    class="btn btn-danger btn-block">{{ \App\CPU\translate('Remove') }}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                @if ($product->color_image)
                                                    @foreach (json_decode($product->color_image) as $photo)
                                                        @if ($photo->color == null)
                                                            <div class="col-6 col-lg-6 col-xl-6">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <img class="w-100" height="auto"
                                                                            onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                                            src="{{ asset(config('app.public_storage_path') . "/product/$photo->image_name") }}"
                                                                            alt="Product image">
                                                                        <a href="{{ route('admin.product.remove-image', ['id' => $product['id'], 'name' => $photo->image_name, 'color' => 'null']) }}"
                                                                            class="btn btn-danger btn-block">{{ \App\CPU\translate('Remove') }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach (json_decode($product->images) as $key => $photo)
                                                        <div class="col-6 col-lg-6 col-xl-6">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <img class="w-100" height="auto"
                                                                        onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                                        alt="Product image">
                                                                    <a href="{{ route('admin.product.remove-image', ['id' => $product['id'], 'name' => $photo]) }}"
                                                                        class="btn btn-danger btn-block">{{ \App\CPU\translate('Remove') }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="name"
                                            class="title-color">{{ \App\CPU\translate('Upload thumbnail') }}</label>
                                        <span class="text-info"><span class="text-danger">*</span> (
                                            {{ \App\CPU\translate('ratio') }} 1:1 )</span>
                                    </div>

                                    <div class="row gy-3" id="thumbnail">
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <img class="w-100" height="auto"
                                                src="{{ asset(config('app.public_storage_path') . '/product/thumbnail') }}/{{ $product['thumbnail'] }}"
                                                alt="Product image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end pt-3">
                                @if ($product->request_status == 2)
                                    <button type="button" onclick="check()"
                                        class="btn btn--primary">{{ \App\CPU\translate('Update & Publish') }}</button>
                                @else
                                    <button type="button" onclick="check()"
                                        class="btn btn--primary">{{ \App\CPU\translate('Update') }}</button>
                                @endif
                            </div>

                            <input type="hidden" id="color_image" value="{{ $product->color_image }}">
                            <input type="hidden" id="images" value="{{ $product->images }}">
                            <input type="hidden" id="product_id" value="{{ $product->id }}">
                            <input type="hidden" id="remove_url" value="{{ route('admin.product.remove-image') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script src="{{ asset('assets/back-end') }}/js/tags-input.min.js"></script>
    <script src="{{ asset('assets/back-end/js/spartan-multi-image-picker.js') }}"></script>

    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var loading = document.getElementById('editor-loading');
            if (loading) loading.style.display = 'flex';
            tinymce.init({
                selector: '.tiny-editor',
                plugins: 'print preview paste searchreplace autolink directionality visualblocks visualchars fullscreen link media charmap codesample table hr pagebreak nonbreaking anchor insertdatetime lists textpattern image',
                toolbar: 'undo redo | formatselect fontselect fontsizeselect lineheight | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | removeformat | code fullscreen',
                fontsize_formats: '8px 10px 12px 14px 16px 18px 20px 24px 28px 32px 36px 48px 72px',
                font_formats: 'Arial=arial;Arial Black=arial black;Comic Sans MS=comic sans ms;Courier New=courier new;Georgia=georgia;Helvetica=helvetica;Impact=impact;Lucida Console=lucida console;Lucida Sans Unicode=lucida sans unicode;Microsoft Sans Serif=microsoft sans serif;Palatino Linotype=palatino linotype;Tahoma=tahoma;Times New Roman=times new roman;Trebuchet MS=trebuchet ms;Verdana=verdana',
                lineheight_formats: '1 1.2 1.5 1.75 2 2.5 3',
                height: 400,
                menubar: 'file edit view insert format tools table',
                init_instance_callback: function(editor) {
                    var loading = document.getElementById('editor-loading');
                    if (loading) loading.style.display = 'none';
                },
                setup: function(editor) {
                    editor.on('change', function() {
                        editor.save();
                    });
                }
            });
        });
    </script>
    <script>
        var colors = {{ count($product->colors) }};
        var imageCount = {{ 10 - count(json_decode($product->images)) }};
        var thumbnail =
            '{{ \App\CPU\ProductManager::product_image_path('thumbnail') . '/' . $product->thumbnail ?? asset('assets/back-end/img/400x400/img2.jpg') }}';
        $(function() {
            if (imageCount > 0) {
                $("#coba").spartanMultiImagePicker({
                    fieldName: 'images[]',
                    maxCount: colors === 0 ? 10 : imageCount,
                    rowHeight: 'auto',
                    groupClassName: 'col-6 col-lg-6 col-xl-6',
                    maxFileSize: '',
                    placeholderImage: {
                        image: '{{ asset('assets/back-end/img/400x400/img2.jpg') }}',
                        width: '100%',
                    },
                    dropFileLabel: "Drop Here",
                    onAddRow: function(index, file) {

                    },
                    onRenderedPreview: function(index) {

                    },
                    onRemoveRow: function(index) {

                    },
                    onExtensionErr: function(index, file) {
                        toastr.error(
                            '{{ \App\CPU\translate('Please only input png or jpg type file') }}', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                    },
                    onSizeErr: function(index, file) {
                        toastr.error('{{ \App\CPU\translate('File size too big') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                });
            }

            $("#thumbnail").spartanMultiImagePicker({
                fieldName: 'image',
                maxCount: 1,
                rowHeight: 'auto',
                groupClassName: 'col-6',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{ asset('assets/back-end/img/400x400/img2.jpg') }}',
                    width: '100%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function(index, file) {

                },
                onRenderedPreview: function(index) {

                },
                onRemoveRow: function(index) {

                },
                onExtensionErr: function(index, file) {
                    toastr.error(
                        '{{ \App\CPU\translate('Please only input png or jpg type file') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                },
                onSizeErr: function(index, file) {
                    toastr.error('{{ \App\CPU\translate('File size too big') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });

            $("#meta_img").spartanMultiImagePicker({
                fieldName: 'meta_image',
                maxCount: 1,
                rowHeight: 'auto',
                groupClassName: 'col-6',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{ asset('assets/back-end/img/400x400/img2.jpg') }}',
                    width: '100%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function(index, file) {

                },
                onRenderedPreview: function(index) {

                },
                onRemoveRow: function(index) {

                },
                onExtensionErr: function(index, file) {
                    toastr.error(
                        '{{ \App\CPU\translate('Please only input png or jpg type file') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                },
                onSizeErr: function(index, file) {
                    toastr.error('{{ \App\CPU\translate('File size too big') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });

        $('#color_switcher').click(function() {
            let checkBoxes = $("#color_switcher");
            if ($('#color_switcher').prop('checked')) {
                $('#color_wise_image').show();
            } else {
                $('#color_wise_image').hide();
            }
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function() {
            readURL(this);
        });

        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });
    </script>

    <script>
        function getRequest(route, id, type) {
            $.get({
                url: route,
                dataType: 'json',
                success: function(data) {
                    if (type == 'select') {
                        let divId = id + '-div';
                        if (data.count && data.count > 0) {
                            $('#' + id).empty().append(data.select_tag);
                            $('#' + divId).show();
                        } else {
                            $('#' + id).empty();
                            $('#' + divId).hide();
                        }
                    }
                },
            });
        }

        $('input[name="colors_active"]').on('change', function() {
            if (!$('input[name="colors_active"]').is(':checked')) {
                $('#colors-selector').prop('disabled', true);
            } else {
                $('#colors-selector').prop('disabled', false);
            }
        });

        $('#choice_attributes').on('change', function() {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function() {
                //console.log($(this).val());
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
        });

        function add_more_customer_choice_option(i, name) {
            let n = name.split(' ').join('');
            $('#customer_choice_options').append(
                '<div class="row"><div class="col-md-3"><input type="hidden" name="choice_no[]" value="' + i +
                '"><input type="text" class="form-control" name="choice[]" value="' + n +
                '" placeholder="{{ \App\CPU\translate('Choice Title') }}" readonly></div><div class="col-lg-9"><input type="text" class="form-control" name="choice_options_' +
                i +
                '[]" placeholder="{{ \App\CPU\translate('Enter choice values') }}" data-role="tagsinput" onchange="update_sku()"></div></div>'
            );
            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }

        setTimeout(function() {
            $('.call-update-sku').on('change', function() {
                update_sku();
            });
        }, 2000)

        $('#colors-selector').on('change', function() {
            update_sku();
            let checkBoxes = $("#color_switcher");
            if ($('#color_switcher').prop('checked')) {
                $('#color_wise_image').show();
                color_wise_image($('#colors-selector'));
            } else {
                $('#color_wise_image').hide();
            }
        });

        $('input[name="unit_price"]').on('keyup', function() {
            let product_type = $('#product_type').val() || 'physical';
            if (product_type === 'physical') {
                update_sku();
            }
        });

        function update_sku() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: '{{ route('admin.product.sku-combination') }}',
                data: $('#product_form').serialize(),
                success: function(data) {
                    $('#sku_combination').html(data.view);
                    update_qty();
                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }

        function color_wise_image(t) {
            let colors = t.val();
            let color_image = $('#color_image').val() ? $.parseJSON($('#color_image').val()) : [];
            let images = $.parseJSON($('#images').val());
            var product_id = $('#product_id').val();
            let remove_url = $('#remove_url').val();

            let color_image_value = $.map(color_image, function(item) {
                return item.color;
            });

            $('#color_wise_existing_image').html('')
            $('#color_wise_image_field').html('')

            $.each(colors, function(key, value) {
                let value_id = value.replace('#', '');
                let in_array_image = $.inArray(value_id, color_image_value);
                let input_image_name = "color_image_" + value_id;

                $.each(color_image, function(color_key, color_value) {
                    if ((in_array_image !== -1) && (color_value['color'] === value_id)) {
                        let image_name = color_value['image_name'];
                        let exist_image_html = `
                            <div class="col-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                    <span class="upload--icon" style="background: #${color_value['color']} ">
                                    <i class="tio-done"></i>
                                    </span>
                                        <img class="w-100" height="auto"
                                             onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                             src="{{ asset(config('app.public_storage_path') . '/product/`+image_name+`') }}"
                                             alt="Product image">
                                        <a href="` + remove_url + `?id=` + product_id + `&name=` + image_name +
                            `&color=` + color_value['color'] + `"
                                           class="btn btn-danger btn-block">{{ \App\CPU\translate('Remove') }}</a>
                                    </div>
                                </div>
                            </div>`;
                        $('#color_wise_existing_image').append(exist_image_html)
                    }
                });
            });

            $.each(colors, function(key, value) {
                let value_id = value.replace('#', '');
                let in_array_image = $.inArray(value_id, color_image_value);
                let input_image_name = "color_image_" + value_id;

                if (in_array_image === -1) {
                    let html = ` <div class='col-6 col-md-6'> <label style='border: 2px dashed #ddd; border-radius: 3px; cursor: pointer; text-align: center; overflow: hidden; padding: 5px; margin-top: 5px; margin-bottom : 5px; position : relative; display: flex; align-items: center; margin: auto; justify-content: center; flex-direction: column;'>
                            <span class="upload--icon" style="background: ${value}">
                            <i class="tio-edit"></i>
                                <input type="file" name="` + input_image_name + `" id="` + value_id + `" class="d-none" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff, .webp|image/*" required="">
                            </span>
                            <img src="{{ asset('assets/back-end/img/400x400/img2.jpg') }}" style="object-fit: cover;aspect-ratio:1"  alt="public/img">
                          </label> </div>`;
                    $('#color_wise_image_field').append(html)

                    $("#color_wise_image input[type='file']").each(function() {

                        var $this = $(this).closest('label');

                        function proPicURL(input) {
                            if (input.files && input.files[0]) {
                                var uploadedFile = new FileReader();
                                uploadedFile.onload = function(e) {
                                    $this.find('img').attr('src', e.target.result);
                                    $this.fadeIn(300);
                                };
                                uploadedFile.readAsDataURL(input.files[0]);
                            }
                        }

                        $(this)
                            .on("change", function() {
                                proPicURL(this);
                            });
                    });
                }
            });
        }

        $(document).ready(function() {
            setTimeout(function() {
                let category = $("#category_id").val();
                let sub_category = $("#sub-category-select").attr("data-id");
                getRequest('{{ url('/') }}/admin/product/get-categories?parent_id=' + category +
                    '&sub_category=' + sub_category, 'sub-category-select', 'select');
            }, 100)
            // color select select2
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function(m) {
                    return m;
                }
            });


            let checkBoxes = $("#color_switcher");
            if ($('#color_switcher').prop('checked')) {
                $('#color_wise_image').show();
                color_wise_image($('#colors-selector'));
            } else {
                $('#color_wise_image').hide();
            }

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state
                    .text;
            }
        });
    </script>

    <script>
        function check() {
            tinymce.triggerSave();
            var formData = new FormData(document.getElementById('product_form'));
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{ route('admin.product.update', $product->id) }}',
                data: formData,

                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.errors) {
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else {
                        toastr.success('product updated successfully!', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        $('#product_form').submit();
                    }
                }
            });
        };
    </script>

    <script>
        update_qty();

        function update_qty() {
            var total_qty = 0;
            var qty_elements = $('input[name^="qty_"]');
            for (var i = 0; i < qty_elements.length; i++) {
                total_qty += parseInt(qty_elements.eq(i).val());
            }
            if (qty_elements.length > 0) {

                $('input[name="current_stock"]').attr("readonly", true);
                $('input[name="current_stock"]').val(total_qty);
            } else {
                $('input[name="current_stock"]').attr("readonly", false);
            }
        }

        $('input[name^="qty_"]').on('keyup', function() {
            var total_qty = 0;
            var qty_elements = $('input[name^="qty_"]');
            for (var i = 0; i < qty_elements.length; i++) {
                total_qty += parseInt(qty_elements.eq(i).val());
            }
            $('input[name="current_stock"]').val(total_qty);
        });
    </script>

    <script>
        $(".lang_link").click(function(e) {
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            console.log(lang);
            $("#" + lang + "-form").removeClass('d-none');
            if (lang == '{{ $default_lang }}') {
                $(".rest-part").removeClass('d-none');
            } else {
                $(".rest-part").addClass('d-none');
            }
        })

        $(document).ready(function() {
            product_type();
            digital_product_type();

            $('#product_type').change(function() {
                product_type();
            });

            $('#digital_product_type').change(function() {
                digital_product_type();
            });
        });

        function product_type() {
            let product_type = $('#product_type').val() || 'physical';

            if (product_type === 'physical') {
                $('#digital_product_type_show').hide();
                $('#digital_file_ready_show').hide();
                $('.physical_product_show').show();
                $("#digital_product_type").val($("#digital_product_type option:first").val());
                $("#digital_file_ready").val('');
            } else if (product_type === 'digital') {
                $('#digital_product_type_show').show();
                $('.physical_product_show').hide();

            }
        }

        function digital_product_type() {
            let digital_product_type = $('#digital_product_type').val();
            if (digital_product_type === 'ready_product') {
                $('#digital_file_ready_show').show();
            } else if (digital_product_type === 'ready_after_sell') {
                $('#digital_file_ready_show').hide();
                $("#digital_file_ready").val('');
            }
        }

        // Technical name oninput → category suggestions
        $(document).on('input', 'input[name="technical_name[]"]', function() {
            let input = $(this);
            let val = input.val();
            let $wrapper = input.closest('.tech-wrapper');
            let $list = $wrapper.find('.tech-suggestions');
            if (!$list.length) {
                $list = $(
                    '<div class="tech-suggestions list-group" style="position:absolute;z-index:9999;width:100%;background:#fff;border:1px solid #ddd;display:none;max-height:200px;overflow-y:auto;"></div>'
                    );
                $wrapper.append($list);
            }
            if (val.length < 2) {
                $list.hide();
                return;
            }
            $.get('{{ url('/') }}/admin/product/search-categories', {
                q: val
            }, function(data) {
                $list.empty();
                if (data.length > 0) {
                    data.forEach(function(item) {
                        $list.append(
                            '<button type="button" class="list-group-item list-group-item-action tech-suggestion-item" style="cursor:pointer;font-size:13px;">' +
                            item + '</button>');
                    });
                    $list.show();
                } else {
                    $list.hide();
                }
            });
        });

        $(document).on('click', '.tech-suggestion-item', function(e) {
            e.preventDefault();
            let val = $(this).text();
            $(this).closest('.tech-wrapper').find('input[name="technical_name[]"]').val(val);
            $(this).closest('.tech-suggestions').hide();
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.tech-wrapper').length) {
                $('.tech-suggestions').hide();
            }
        });

        $('#tax_model').on('change', function() {
            var val = $(this).val();
            var note = val === 'include' ?
                '{!! \App\CPU\translate('Price should be tax inclusive') !!}' :
                '{!! \App\CPU\translate('Price should be tax exclusive') !!}';
            $('#tax-price-note').html('<i class="fa fa-info-circle"></i> ' + note);
        });

        // Set initial note based on selected tax_model
        if ($('#tax_model').val() === 'exclude') {
            $('#tax-price-note').html('<i class="fa fa-info-circle"></i> {!! \App\CPU\translate('Price should be tax exclusive') !!}');
        }
    </script>



    {{-- ck editor --}}
@endpush
