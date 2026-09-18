@props(['description', 'time', 'icon' => 'dot', 'tone' => 'neutral'])

@php
    $toneClasses = match ($tone) {
        'accent' => 'bg-accent-soft text-amber-700',
        'success' => 'bg-emerald-50 text-emerald-700',
        'info' => 'bg-blue-50 text-blue-700',
        default => 'bg-surface text-charcoal',
    };
@endphp

<li class="flex items-start gap-3">
    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full {{ $toneClasses }}">
        <x-admin.icon :name="$icon" class="w-4 h-4" />
    </span>
    <div class="min-w-0">
        <p class="text-sm text-charcoal leading-snug">{{ $description }}</p>
        <p class="text-xs text-muted mt-0.5">{{ $time }}</p>
    </div>
</li>
