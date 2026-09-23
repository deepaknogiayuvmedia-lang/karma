@extends('layouts.front-end.app')

@section('title', \App\CPU\translate('Technical Names'))

@push('css_or_js')
<style>
    .tech-page-header {
        background: linear-gradient(135deg, var(--bh-dark-green) 0%, var(--bh-primary) 100%);
        padding: 2rem 0;
    }
    .tech-page-header h2 {
        color: #fff;
        font-weight: 700;
        margin: 0;
        font-size: 1.45rem;
    }
    .tech-page-header p {
        color: rgba(255,255,255,0.8);
        margin: 0.3rem 0 0;
        font-size: 0.9rem;
    }
    .tech-page-header a {
        color: rgba(255,255,255,0.85);
    }
    .tech-page-header a:hover {
        color: #fff;
    }

    .tech-search-wrap {
        max-width: 480px;
        margin: 0 auto 1.5rem;
    }
    .tech-search-input {
        width: 100%;
        border: 2px solid var(--bh-border);
        border-radius: var(--bh-radius-pill);
        padding: 0.65rem 1.25rem 0.65rem 2.75rem;
        font-size: 0.95rem;
        background: var(--bh-surface);
        color: var(--bh-text-primary);
        transition: border-color 0.2s ease;
    }
    .tech-search-input:focus {
        outline: none;
        border-color: var(--bh-primary);
        box-shadow: 0 0 0 3px rgba(22, 138, 58, 0.12);
    }
    .tech-search-wrap .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--bh-text-secondary);
        font-size: 0.9rem;
    }

    .tech-total-count {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: var(--bh-light-green);
        color: var(--bh-dark-green);
        font-size: 0.82rem;
        font-weight: 600;
        padding: 0.35rem 0.85rem;
        border-radius: var(--bh-radius-pill);
        margin-bottom: 1.25rem;
    }

    /* Accordion */
    .tech-accordion {
        border-radius: var(--bh-radius-md);
        overflow: hidden;
    }

    .tech-accordion-item {
        background: var(--bh-surface);
        border: 1px solid var(--bh-border);
        border-radius: var(--bh-radius-md);
        margin-bottom: 0.65rem;
        overflow: hidden;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .tech-accordion-item.open {
        border-color: var(--bh-primary);
        box-shadow: var(--bh-shadow-subtle);
    }

    .tech-accordion-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.85rem 1.1rem;
        cursor: pointer;
        user-select: none;
        transition: background 0.2s ease;
        text-decoration: none !important;
    }
    .tech-accordion-header:hover {
        background: var(--bh-bg);
    }

    .tech-alpha-circle {
        width: 38px;
        height: 38px;
        min-width: 38px;
        border-radius: 50%;
        background: var(--bh-primary);
        color: #fff;
        font-weight: 700;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(22, 138, 58, 0.25);
        transition: background 0.2s ease, transform 0.3s ease;
    }
    .tech-accordion-item.open .tech-alpha-circle {
        background: var(--bh-dark-green);
        transform: scale(1.05);
    }

    .tech-header-info {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .tech-header-info .letter-name {
        font-weight: 700;
        font-size: 1rem;
        color: var(--bh-text-primary);
    }
    .tech-header-info .tag-count {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--bh-primary);
        background: var(--bh-light-green);
        padding: 2px 8px;
        border-radius: var(--bh-radius-pill);
    }

    .tech-toggle-icon {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: var(--bh-bg);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .tech-toggle-icon i {
        font-size: 0.7rem;
        color: var(--bh-text-secondary);
        transition: transform 0.3s ease;
    }
    .tech-accordion-item.open .tech-toggle-icon {
        background: var(--bh-primary);
    }
    .tech-accordion-item.open .tech-toggle-icon i {
        color: #fff;
        transform: rotate(180deg);
    }

    .tech-accordion-body {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), padding 0.35s ease;
        padding: 0 1.1rem;
    }
    .tech-accordion-item.open .tech-accordion-body {
        max-height: 2000px;
        padding: 1.1rem 1.1rem;
    }

    .tech-tag-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        /* padding-top: 0.5rem; */
        /* border-top: 1px solid var(--bh-border); */
    }

    .tech-tag-item {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1.1rem;
        border-radius: var(--bh-radius-pill);
        background: var(--bh-surface);
        border: 1.5px solid var(--bh-border);
        color: var(--bh-text-primary);
        font-size: 0.88rem;
        font-weight: 500;
        text-decoration: none !important;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .tech-tag-item:hover {
        border-color: var(--bh-primary);
        background: var(--bh-light-green);
        color: var(--bh-primary);
        transform: translateY(-2px);
        box-shadow: var(--bh-shadow-subtle);
    }
    .tech-tag-item i {
        font-size: 0.7rem;
        color: var(--bh-primary);
        opacity: 0.7;
    }
    .tech-tag-item:hover i {
        opacity: 1;
    }

    /* Empty State */
    .tech-empty-state {
        text-align: center;
        padding: 4rem 1rem;
    }
    .tech-empty-state .empty-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--bh-light-green);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
    }
    .tech-empty-state .empty-icon i {
        font-size: 2rem;
        color: var(--bh-primary);
    }
    .tech-empty-state h5 {
        color: var(--bh-text-primary);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .tech-empty-state p {
        color: var(--bh-text-secondary);
        font-size: 0.9rem;
    }

    @media (max-width: 767px) {
        .tech-page-header { padding: 1.25rem 0; }
        .tech-page-header h2 { font-size: 1.15rem; }
        .tech-alpha-circle { width: 32px; height: 32px; min-width: 32px; font-size: 0.9rem; }
        .tech-accordion-header { padding: 0.7rem 0.85rem; gap: 0.6rem; }
        .tech-accordion-body { padding: 0 0.85rem; }
        .tech-accordion-item.open .tech-accordion-body { padding: 0.85rem 0.85rem; }
        .tech-tag-item { padding: 0.4rem 0.85rem; font-size: 0.82rem; }
    }
</style>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="tech-page-header">
        <div class="container">
            <h2><i class="fa fa-flask mr-2"></i> {{ \App\CPU\translate('Technical Names') }}</h2>
            <p>{{ \App\CPU\translate('Browse products by their technical/composition name') }}</p>
            <div style="font-size: 0.82rem; margin-top: 0.5rem;">
                <a href="{{ route('home') }}">{{ \App\CPU\translate('Home') }}</a>
                <span style="color: rgba(255,255,255,0.5);"> / </span>
                <span style="color: rgba(255,255,255,0.95);">{{ \App\CPU\translate('Technical Names') }}</span>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container py-4" style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
        @php($grouped = $technicalNames->groupBy(fn($name) => strtoupper(substr($name, 0, 1))))

        @if($technicalNames->isEmpty())
            <div class="tech-empty-state">
                <div class="empty-icon">
                    <i class="fa fa-flask"></i>
                </div>
                <h5>{{ \App\CPU\translate('No Technical Names Found') }}</h5>
                <p>{{ \App\CPU\translate('Technical names will appear here once products are added with technical names.') }}</p>
                <a href="{{ route('home') }}" class="btn btn-bh-primary mt-3">
                    <i class="fa fa-home mr-1"></i> {{ \App\CPU\translate('Back to Home') }}
                </a>
            </div>
        @else
            <!-- Search Box -->
            <div class="tech-search-wrap position-relative">
                <i class="fa fa-search search-icon"></i>
                <input type="text" class="tech-search-input" id="techSearch"
                       placeholder="{{ \App\CPU\translate('Search technical names...') }}">
            </div>

            <!-- Total Count -->
            <div class="tech-total-count">
                <i class="fa fa-tags"></i>
                {{ $technicalNames->count() }} {{ \App\CPU\translate('Technical Names Available') }}
            </div>

            <!-- Accordion List -->
            <div class="tech-accordion" id="techAccordion">
                @foreach($grouped as $letter => $names)
                    <div class="tech-accordion-item" data-letter="{{ $letter }}">
                        <div class="tech-accordion-header" data-toggle="accordion">
                            <div class="tech-alpha-circle">{{ $letter }}</div>
                            <div class="tech-header-info">
                               
                                <span class="tag-count">{{ $names->count() }}</span>
                            </div>
                            <div class="tech-toggle-icon">
                                <i class="fa fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="tech-accordion-body">
                            <div class="tech-tag-wrap">
                                @foreach($names as $name)
                                    <a href="{{ route('products', ['data_from' => 'technical_name', 'technical_name' => $name, 'page' => 1]) }}" class="tech-tag-item" data-name="{{ strtolower($name) }}">
                                        <i class="fa fa-atom"></i>
                                        {{ $name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- No Search Result -->
            <div id="tech-no-result" class="tech-empty-state" style="display: none;">
                <div class="empty-icon">
                    <i class="fa fa-search"></i>
                </div>
                <h5>{{ \App\CPU\translate('No matching technical names') }}</h5>
                <p>{{ \App\CPU\translate('Try a different search term.') }}</p>
            </div>
        @endif
    </div>
@endsection

@push('script')
<script>
    $(document).ready(function() {

        // Accordion toggle
        $(document).on('click', '[data-toggle="accordion"]', function() {
            var $item = $(this).closest('.tech-accordion-item');
            var $body = $item.find('.tech-accordion-body');
            var isOpen = $item.hasClass('open');

            // Close all others
            // $('.tech-accordion-item.open').not($item).removeClass('open')
            //     .find('.tech-accordion-body').css('max-height', '0');

            // Toggle current
            if (isOpen) {
                $item.removeClass('open');
               
            } else {
                $item.addClass('open');
                
            }
        });

        // Search filter
        $(document).on('keyup', '#techSearch', function() {
            var query = $(this).val().toLowerCase().trim();
            var hasResults = false;

            if (query === '') {
                $('.tech-accordion-item').show();
                $('.tech-tag-item').show();
                $('#tech-no-result').hide();
                // Re-sync open bodies
              
                return;
            }

            $('.tech-accordion-item').each(function() {
                var $item = $(this);
                var visibleTags = 0;

                $item.find('.tech-tag-item').each(function() {
                    var name = $(this).data('name').toString();
                    if (name.indexOf(query) !== -1) {
                        $(this).show();
                        visibleTags++;
                        hasResults = true;
                    } else {
                        $(this).hide();
                    }
                });

                if (visibleTags > 0) {
                    $item.show();
                    // Auto-open matching sections
                    if (!$item.hasClass('open')) {
                        $item.addClass('open');
                       
                    }
                    // Update count badge
                    $item.find('.tag-count').text(visibleTags);
                } else {
                    $item.hide();
                    $item.removeClass('open');
                }
            });

            if (hasResults) {
                $('#tech-no-result').hide();
            } else {
                $('#tech-no-result').show();
            }
        });
    });
</script>
@endpush
