@props(['eyebrow' => null, 'title', 'description' => null, 'align' => 'left'])

<div class="{{ $align === 'center' ? 'mx-auto max-w-2xl text-center' : 'max-w-2xl' }}">
    @if ($eyebrow)
        <p class="eyebrow">{{ $eyebrow }}</p>
    @endif
    <h2 class="mt-2 text-2xl font-bold text-navy sm:text-3xl">{{ $title }}</h2>
    @if ($description)
        <p class="mt-3 text-sm text-muted sm:text-base">{{ $description }}</p>
    @endif
</div>
