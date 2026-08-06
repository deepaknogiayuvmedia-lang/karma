@props(['url' => null, 'text' => null])

<div class="mb-3">
    <a href="{{ $url ?? url()->previous() }}" class="btn btn-outline-secondary btn-sm">
        <i class="tio-arrow-backward"></i> {{ $text ?? \App\CPU\translate('Back') }}
    </a>
</div>
