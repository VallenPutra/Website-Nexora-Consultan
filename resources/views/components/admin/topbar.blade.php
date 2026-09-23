@props(['title' => 'Dashboard', 'adminName' => null])

<header class="sticky top-0 z-30 flex h-[72px] shrink-0 items-center gap-4 border-b border-navy/10 bg-white/95 px-4 backdrop-blur sm:px-6">

    <button type="button" data-admin-drawer-toggle aria-expanded="false" aria-label="Open menu" class="lg:hidden -ml-1 p-2 text-charcoal">
        <x-admin.icon name="menu" class="w-5 h-5" />
    </button>

    <h1 class="text-lg font-semibold text-navy shrink-0">{{ $title }}</h1>

    <div class="hidden md:flex flex-1 max-w-md">
        <label class="relative w-full">
            <span class="sr-only">Search</span>
            <x-admin.icon name="search" class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted" />
            <input
                type="search"
                placeholder="Search projects, clients, messages..."
                class="w-full rounded-lg border border-navy/10 bg-surface py-2.5 pl-10 pr-4 text-sm text-charcoal placeholder:text-muted focus:border-accent focus:bg-white focus:outline-none focus:ring-2 focus:ring-accent/20"
            >
        </label>
    </div>

    <div class="ml-auto flex items-center gap-2 sm:gap-3">
        <div class="relative" data-admin-notifications data-notifications-url="{{ route('admin.notifications.index') }}">
            <button type="button" data-admin-notifications-toggle aria-label="Notifications" aria-haspopup="true" aria-expanded="false" class="relative p-2 rounded-lg text-charcoal/70 hover:bg-surface hover:text-navy transition-colors">
            <x-admin.icon name="bell" class="w-5 h-5" />
                <span data-admin-notifications-dot class="hidden absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-accent" aria-hidden="true"></span>
                <span data-admin-notifications-count class="hidden absolute -right-1 -top-1 min-w-5 rounded-full bg-accent px-1 text-center text-[10px] font-semibold leading-5 text-navy" aria-hidden="true"></span>
                <span class="sr-only">Open notifications</span>
            </button>

            <div data-admin-notifications-menu class="hidden absolute right-0 z-40 mt-2 w-80 max-w-[calc(100vw-2rem)] overflow-hidden rounded-xl border border-navy/10 bg-white shadow-xl" role="menu">
                <div class="flex items-center justify-between border-b border-navy/10 px-4 py-3">
                    <p class="text-sm font-semibold text-navy">New requests</p>
                    <span data-admin-notifications-menu-count class="text-xs text-muted">0</span>
                </div>
                <div data-admin-notifications-list class="max-h-80 overflow-y-auto p-2">
                    <p class="px-2 py-4 text-center text-sm text-muted">No new requests.</p>
                </div>
            </div>
        </div>

        <a href="{{ route('home') }}" target="_blank" rel="noopener" class="admin-btn-secondary hidden sm:inline-flex !py-2 !px-3.5 text-sm">
            <x-admin.icon name="external" class="w-4 h-4" />
            <span>View Website</span>
        </a>

        <div class="relative">
            <button
                type="button"
                data-admin-profile-trigger
                aria-haspopup="true"
                aria-expanded="false"
                class="flex items-center gap-2 rounded-lg p-1.5 pr-2 hover:bg-surface transition-colors"
            >
                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-navy text-sm font-semibold text-white" aria-hidden="true">
                    {{ strtoupper(substr($adminName ?? 'A', 0, 1)) }}
                </span>
                <span class="hidden sm:block text-left">
                    <span class="block text-sm font-medium text-navy leading-tight">{{ $adminName ?? 'Admin' }}</span>
                    <span class="block text-xs text-muted leading-tight">Administrator</span>
                </span>
                <x-admin.icon name="chevron-down" class="hidden sm:block w-4 h-4 text-muted" />
            </button>

            <div
                data-admin-profile-menu
                class="hidden absolute right-0 mt-2 w-56 rounded-xl border border-navy/10 bg-white p-2 shadow-xl"
                role="menu"
            >
                <div class="px-3 py-2 border-b border-navy/10 mb-1">
                    <p class="text-sm font-medium text-navy">{{ $adminName ?? 'Admin' }}</p>
                    <p class="text-xs text-muted">Administrator</p>
                </div>
                <a href="{{ route('admin.settings.index') }}" role="menuitem" class="block rounded-lg px-3 py-2 text-sm text-charcoal hover:bg-surface">Account Settings</a>
                <a href="{{ route('home') }}" target="_blank" rel="noopener" role="menuitem" class="block rounded-lg px-3 py-2 text-sm text-charcoal hover:bg-surface">View Public Website</a>
                <div class="my-1 border-t border-navy/10"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" role="menuitem" class="block w-full text-left rounded-lg px-3 py-2 text-sm text-red-600 hover:bg-red-50">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
