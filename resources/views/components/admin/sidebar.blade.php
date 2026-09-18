@php
    $current = request()->route()?->getName();
    $currentModule = request()->route('module');

    $isActive = function (?string $routeName, ?string $module = null) use ($current, $currentModule) {
        if ($module !== null) {
            return $current === 'admin.placeholder' && $currentModule === $module;
        }
        return $current === $routeName;
    };

    $sections = [
        'OVERVIEW' => [
            ['label' => 'Dashboard', 'icon' => 'dashboard', 'href' => route('admin.dashboard'), 'active' => $isActive('admin.dashboard')],
        ],
        'BUSINESS MANAGEMENT' => [
            ['label' => 'Projects', 'icon' => 'projects', 'href' => route('admin.placeholder', 'projects'), 'active' => $isActive(null, 'projects')],
            ['label' => 'Services', 'icon' => 'services', 'href' => route('admin.placeholder', 'services'), 'active' => $isActive(null, 'services')],
            ['label' => 'Clients', 'icon' => 'clients', 'href' => route('admin.placeholder', 'clients'), 'active' => $isActive(null, 'clients')],
            ['label' => 'Team', 'icon' => 'team', 'href' => route('admin.placeholder', 'team'), 'active' => $isActive(null, 'team')],
        ],
        'CONTENT' => [
            ['label' => 'Insights', 'icon' => 'insights', 'href' => route('admin.placeholder', 'insights'), 'active' => $isActive(null, 'insights')],
            ['label' => 'Media Library', 'icon' => 'media', 'href' => route('admin.placeholder', 'media-library'), 'active' => $isActive(null, 'media-library')],
        ],
        'COMMUNICATION' => [
            ['label' => 'Consultation Requests', 'icon' => 'requests', 'href' => route('admin.placeholder', 'consultation-requests'), 'active' => $isActive(null, 'consultation-requests')],
            ['label' => 'Messages', 'icon' => 'messages', 'href' => route('admin.placeholder', 'messages'), 'active' => $isActive(null, 'messages')],
        ],
        'REPORTS' => [
            ['label' => 'Reports', 'icon' => 'reports', 'href' => route('admin.placeholder', 'reports'), 'active' => $isActive(null, 'reports')],
            ['label' => 'Revenue', 'icon' => 'revenue', 'href' => route('admin.placeholder', 'revenue'), 'active' => $isActive(null, 'revenue')],
        ],
        'SYSTEM' => [
            ['label' => 'Settings', 'icon' => 'settings', 'href' => route('admin.placeholder', 'settings'), 'active' => $isActive(null, 'settings')],
        ],
    ];
@endphp

{{-- Mobile drawer overlay --}}
<div data-admin-drawer-overlay class="fixed inset-0 z-40 hidden bg-navy/50 lg:hidden"></div>

<aside
    data-admin-sidebar
    class="fixed inset-y-0 left-0 z-50 flex w-[270px] -translate-x-full flex-col bg-navy transition-transform duration-200 lg:sticky lg:top-0 lg:h-screen lg:translate-x-0"
>
    <div class="flex h-20 shrink-0 items-center justify-between px-5 border-b border-white/10">
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col leading-none admin-sidebar-brand">
            <span class="text-lg font-bold tracking-tight text-white">NEXORA</span>
            <span class="text-[10px] font-semibold uppercase tracking-[0.16em] text-white/45">IT Consulting Management</span>
        </a>
        <button type="button" data-admin-drawer-toggle aria-expanded="false" aria-label="Close menu" class="lg:hidden text-white/70 hover:text-white p-1">
            <x-admin.icon name="close" class="w-5 h-5" />
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-6" aria-label="Admin">
        @foreach ($sections as $sectionLabel => $items)
            <div>
                <p class="admin-sidebar-section-label admin-sidebar-label-text">{{ $sectionLabel }}</p>
                <div class="mt-2 space-y-1">
                    @foreach ($items as $item)
                        <a
                            href="{{ $item['href'] }}"
                            data-active="{{ $item['active'] ? 'true' : 'false' }}"
                            class="admin-sidebar-link"
                            @if ($item['active']) aria-current="page" @endif
                        >
                            <x-admin.icon :name="$item['icon']" class="w-[18px] h-[18px] shrink-0" />
                            <span class="admin-sidebar-label-text truncate">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </nav>

    <div class="shrink-0 border-t border-white/10 p-3">
        <button
            type="button"
            data-admin-collapse-toggle
            aria-pressed="false"
            class="hidden lg:flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-white/60 hover:bg-white/5 hover:text-white transition-colors"
        >
            <x-admin.icon name="collapse" class="w-[18px] h-[18px] shrink-0" />
            <span class="admin-sidebar-label-text">Collapse sidebar</span>
        </button>
    </div>
</aside>
