@props(['dismissible' => true])

<div
    data-demo-notice
    class="flex items-start gap-3 rounded-xl border border-accent/30 bg-accent-soft px-4 py-3 text-sm text-amber-900"
    role="status"
>
    <x-admin.icon name="clock" class="w-4 h-4 shrink-0 mt-0.5 text-amber-700" />
    <p class="flex-1">
        <strong class="font-semibold">Demo data is currently being displayed.</strong>
        Connect your business models to show real company data.
    </p>
    @if ($dismissible)
        <button
            type="button"
            onclick="this.closest('[data-demo-notice]').remove()"
            aria-label="Dismiss demo data notice"
            class="shrink-0 text-amber-700 hover:text-amber-900 p-1 -m-1"
        >
            <x-admin.icon name="close" class="w-4 h-4" />
        </button>
    @endif
</div>
