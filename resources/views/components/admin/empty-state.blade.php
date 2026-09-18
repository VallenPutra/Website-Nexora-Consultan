@props(['title' => 'Nothing here yet', 'description' => null, 'icon' => 'dot'])

<div class="flex flex-col items-center justify-center rounded-xl border border-dashed border-navy/15 bg-surface/60 px-6 py-14 text-center">
    <span class="flex h-12 w-12 items-center justify-center rounded-full bg-white text-navy shadow-sm">
        <x-admin.icon :name="$icon" class="w-5 h-5" />
    </span>
    <h3 class="mt-4 text-base font-semibold text-navy">{{ $title }}</h3>
    @if ($description)
        <p class="mt-1.5 max-w-sm text-sm text-muted">{{ $description }}</p>
    @endif
    {{ $slot ?? '' }}
</div>
