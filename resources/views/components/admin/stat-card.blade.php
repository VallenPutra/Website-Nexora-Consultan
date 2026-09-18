@props(['label', 'value', 'trend' => null, 'trendDirection' => 'neutral', 'icon' => 'dot'])

@php
    $trendColor = match ($trendDirection) {
        'up' => 'text-emerald-600',
        'attention' => 'text-amber-600',
        default => 'text-muted',
    };
@endphp

<div class="admin-stat-card">
    <div class="flex items-start justify-between">
        <span class="text-sm font-medium text-muted">{{ $label }}</span>
        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-accent-soft text-navy shrink-0">
            <x-admin.icon :name="$icon" class="w-[18px] h-[18px]" />
        </span>
    </div>
    <p class="text-3xl font-bold text-navy tracking-tight">{{ $value }}</p>
    @if ($trend)
        <p class="text-xs font-medium {{ $trendColor }}">{{ $trend }}</p>
    @endif
</div>
