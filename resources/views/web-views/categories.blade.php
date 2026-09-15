@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('All Categories'))

@push('css_or_js')
    <meta property="og:image" content="{{asset(config('app.public_storage_path').'/company')}}/{{$web_config['web_logo']}}"/>
    <meta property="og:title" content="Categories of {{$web_config['name']}}"/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset(config('app.public_storage_path').'/company')}}/{{$web_config['web_logo']}}"/>
    <meta property="twitter:title" content="Categories of {{$web_config['name']}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <style>
        .cat-page-header {
            background: linear-gradient(135deg, var(--bh-dark-green) 0%, var(--bh-primary) 100%);
            padding: 2rem 0;
        }
        .cat-page-header h2 {
            color: #fff;
            font-weight: 700;
            margin: 0;
        }
        .cat-page-header p {
            color: rgba(255,255,255,0.8);
            margin: 0.3rem 0 0;
            font-size: 0.9rem;
        }

        .cat-parent-card {
            background: var(--bh-surface);
            border: 2px solid var(--bh-border);
            border-radius: var(--bh-radius-lg);
            padding: 1.5rem 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }
        .cat-parent-card:hover {
            border-color: var(--bh-primary);
            box-shadow: var(--bh-shadow-hover);
            transform: translateY(-3px);
        }
        .cat-parent-card.active {
            border-color: var(--bh-primary);
            background: var(--bh-light-green);
            box-shadow: var(--bh-shadow-hover);
        }
        .cat-parent-card .cat-icon {
            width: 64px;
            height: 64px;
            object-fit: contain;
            border-radius: 50%;
            background: var(--bh-light-green);
            padding: 10px;
            margin: 0 auto 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .cat-parent-card.active .cat-icon {
            background: #fff;
        }
        .cat-parent-card .cat-icon img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }
        .cat-parent-card .cat-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--bh-text-primary);
            line-height: 1.3;
        }
        .cat-parent-card .cat-count {
            font-size: 0.75rem;
            color: var(--bh-text-secondary);
            margin-top: 0.25rem;
        }
        .cat-parent-card .cat-arrow {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: var(--bh-light-green);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            color: var(--bh-primary);
            transition: all 0.25s ease;
        }
        .cat-parent-card.active .cat-arrow {
            background: var(--bh-primary);
            color: #fff;
            transform: rotate(90deg);
        }

        .subcat-panel {
            background: var(--bh-surface);
            border: 1px solid var(--bh-border);
            border-radius: var(--bh-radius-lg);
            padding: 1.5rem;
            margin-top: 1.5rem;
            box-shadow: var(--bh-shadow-subtle);
        }
        .subcat-panel .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--bh-border);
            margin-bottom: 1rem;
        }
        .subcat-panel .panel-header h5 {
            font-weight: 700;
            color: var(--bh-dark-green);
            margin: 0;
            font-size: 1.1rem;
        }
        .subcat-panel .panel-header .badge {
            background: var(--bh-primary);
            color: #fff;
            font-weight: 500;
            padding: 4px 12px;
            border-radius: var(--bh-radius-pill);
            font-size: 0.75rem;
        }

        .subcat-card {
            background: var(--bh-bg);
            border: 1px solid var(--bh-border);
            border-radius: var(--bh-radius-md);
            padding: 1rem 1.25rem;
            margin-bottom: 0.75rem;
            transition: all 0.2s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            color: var(--bh-text-primary);
        }
        .subcat-card:hover {
            border-color: var(--bh-primary);
            background: var(--bh-light-green);
            text-decoration: none;
            color: var(--bh-text-primary);
            box-shadow: var(--bh-shadow-subtle);
        }
        .subcat-card .subcat-name {
            font-weight: 600;
            font-size: 0.95rem;
        }
        .subcat-card .subcat-arrow {
            color: var(--bh-primary);
            font-size: 1.1rem;
            transition: transform 0.2s ease;
        }
        .subcat-card:hover .subcat-arrow {
            transform: translateX(4px);
        }

        .sub-subcat-list {
            padding-left: 1.5rem;
            margin-top: 0.5rem;
        }
        .sub-subcat-item {
            display: inline-block;
            background: #fff;
            border: 1px solid var(--bh-border);
            border-radius: var(--bh-radius-pill);
            padding: 4px 14px;
            margin: 3px 4px;
            font-size: 0.82rem;
            color: var(--bh-text-secondary);
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .sub-subcat-item:hover {
            background: var(--bh-primary);
            color: #fff;
            border-color: var(--bh-primary);
            text-decoration: none;
        }

        .cat-empty-state {
            text-align: center;
            padding: 4rem 1rem;
            color: var(--bh-text-secondary);
        }
        .cat-empty-state i {
            font-size: 3rem;
            color: var(--bh-border);
            margin-bottom: 1rem;
        }
        .cat-empty-state h5 {
            color: var(--bh-text-primary);
            font-weight: 600;
        }

        .cat-loading {
            text-align: center;
            padding: 3rem;
        }
        .cat-loading .spinner-border {
            color: var(--bh-primary);
            width: 2.5rem;
            height: 2.5rem;
        }

        @media (max-width: 767.98px) {
            .cat-parent-card { padding: 1rem 0.75rem; }
            .cat-parent-card .cat-icon { width: 50px; height: 50px; }
            .cat-parent-card .cat-icon img { width: 32px; height: 32px; }
            .subcat-panel { padding: 1rem; }
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="cat-page-header">
        <div class="container">
            <h2><i class="fa fa-th-large mr-2"></i> {{\App\CPU\translate('All Categories')}}</h2>
            <p>{{\App\CPU\translate('Browse categories and find what you need')}}</p>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container py-4" style="text-align: {{Session::get('direction') === 'rtl' ? 'right' : 'left'}};">
        <div class="row" id="categories-row">
            @php($parents = \App\CPU\CategoryManager::parents())
            @foreach($parents as $index => $category)
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 mb-3">
                    <div class="cat-parent-card" data-cat-id="{{$category['id']}}" data-cat-name="{{ addslashes($category['name']) }}">
                        <div class="cat-arrow">
                            <i class="fa fa-chevron-right"></i>
                        </div>
                        <div class="cat-icon">
                            <img src="{{asset('storage/category/'.$category->icon)}}"
                                 onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                 alt="{{$category['name']}}">
                        </div>
                        <div class="cat-name">{{$category['name']}}</div>
                        @if($category->childes->count() > 0)
                            <div class="cat-count">{{$category->childes->count()}} {{\App\CPU\translate('subcategories')}}</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Subcategory Panel -->
        <div id="subcategory-panel"></div>
    </div>
@endsection

@push('script')
    <script>
        var activeCatId = null;
        var txtLoading = '{!! \App\CPU\translate("Loading subcategories") !!}';
        var txtFailed = '{!! \App\CPU\translate("Failed to load subcategories") !!}';
        var txtTryAgain = '{!! \App\CPU\translate("Please try again") !!}';

        $(document).on('click', '.cat-parent-card', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var catId = $(this).data('cat-id');
            var catName = $(this).data('cat-name');
            loadSubcategories(catId, catName);
        });

        function loadSubcategories(catId, catName) {
            if (activeCatId === catId) {
                $('#subcategory-panel').slideUp(300, function() { $(this).empty(); });
                $('.cat-parent-card').removeClass('active');
                activeCatId = null;
                return;
            }

            $('.cat-parent-card').removeClass('active');
            $('#cat-card-' + catId).addClass('active');
            $('#cat-card-' + catId).length || $('[data-cat-id="'+catId+'"]').addClass('active');
            activeCatId = catId;

            $('#subcategory-panel').html(
                '<div class="cat-loading"><div class="spinner-border" role="status"></div><p class="mt-2 text-muted">' +
                txtLoading + '...</p></div>'
            ).slideDown(300);

            $('html, body').animate({ scrollTop: $('#subcategory-panel').offset().top - 80 }, 400);

            $.ajax({
                url: '/category-ajax/' + catId,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    var html = '<div class="subcat-panel">' +
                        '<div class="panel-header">' +
                        '<h5><i class="fa fa-folder-open mr-1"></i> ' + catName + '</h5>' +
                        '<button class="btn btn-sm" onclick="closeSubcatPanel()" style="background: var(--bh-bg); border: 1px solid var(--bh-border); border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; padding: 0;">' +
                        '<i class="fa fa-times" style="color: var(--bh-text-secondary); font-size: 0.75rem;"></i></button>' +
                        '</div>' +
                        '<div id="subcat-content">' + response.view + '</div>' +
                        '</div>';

                    $('#subcategory-panel').html(html).hide().fadeIn(300);
                },
                error: function() {
                    $('#subcategory-panel').html(
                        '<div class="subcat-panel"><div class="cat-empty-state">' +
                        '<i class="fa fa-exclamation-triangle"></i>' +
                        '<h5>' + txtFailed + '</h5>' +
                        '<p class="text-muted">' + txtTryAgain + '</p>' +
                        '</div></div>'
                    ).show();
                }
            });
        }

        function closeSubcatPanel() {
            $('#subcategory-panel').slideUp(300, function() { $(this).empty(); });
            $('.cat-parent-card').removeClass('active');
            activeCatId = null;
        }
    </script>
@endpush
