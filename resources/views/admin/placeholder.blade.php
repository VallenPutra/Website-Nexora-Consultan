<x-admin.layout :title="$label">

    <div class="mx-auto max-w-3xl">
        <nav aria-label="Breadcrumb" class="text-sm text-muted mb-6">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-accent">Dashboard</a>
            <span class="mx-1.5">/</span>
            <span class="text-navy font-medium">{{ $label }}</span>
        </nav>

        <x-admin.empty-state
            :title="$label.' — Coming Soon'"
            :description="$moduleDescription"
            icon="clock"
        >
            <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('admin.dashboard') }}" class="admin-btn-primary">Back to Dashboard</a>
                <a href="{{ route('home') }}" target="_blank" rel="noopener" class="admin-btn-secondary">
                    <x-admin.icon name="external" class="w-4 h-4" /> View Public Website
                </a>
            </div>
        </x-admin.empty-state>

        <p class="mt-6 text-center text-xs text-muted">
            This module isn't built yet — no data is stored here. It will become a full page once its database model and controller are implemented.
        </p>
    </div>

</x-admin.layout>
