@props(['value' => 0, 'showLabel' => true])

@php $value = max(0, min(100, (int) $value)); @endphp

<div class="flex items-center gap-3">
    <div class="admin-progress-track flex-1" role="progressbar" aria-valuenow="{{ $value }}" aria-valuemin="0" aria-valuemax="100">
        <div class="admin-progress-fill" style="width: {{ $value }}%"></div>
    </div>
    @if ($showLabel)
        <span class="text-xs font-medium text-muted w-9 text-right shrink-0">{{ $value }}%</span>
    @endif
</div>
