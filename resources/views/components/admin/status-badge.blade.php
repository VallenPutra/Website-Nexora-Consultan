@props(['status'])

@php
    $map = [
        // Project statuses
        'Planning' => 'neutral',
        'In Progress' => 'info',
        'On Review' => 'warning',
        'Completed' => 'success',
        'Cancelled' => 'danger',
        // Consultation request statuses
        'New' => 'info',
        'In Review' => 'warning',
        'Contacted' => 'neutral',
        'Converted' => 'success',
        'Closed' => 'neutral',
    ];

    $tone = $map[$status] ?? 'neutral';
@endphp

<span class="admin-badge admin-badge-{{ $tone }}">
    <span class="w-1.5 h-1.5 rounded-full bg-current" aria-hidden="true"></span>
    {{ $status }}
</span>
