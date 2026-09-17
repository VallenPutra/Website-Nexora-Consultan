@props(['items' => []])

<nav aria-label="Breadcrumb" class="border-b border-navy/10 bg-surface">
    <div class="container-nexora flex items-center gap-2 py-3 text-xs text-muted">
        <a href="{{ route('home') }}" class="hover:text-navy">Home</a>
        @foreach ($items as $item)
            <span aria-hidden="true">/</span>
            @if (!empty($item['url']) && !$loop->last)
                <a href="{{ $item['url'] }}" class="hover:text-navy">{{ $item['label'] }}</a>
            @else
                <span class="font-medium text-navy" aria-current="page">{{ $item['label'] }}</span>
            @endif
        @endforeach
    </div>
</nav>
