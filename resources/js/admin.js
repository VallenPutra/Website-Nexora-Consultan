// NEXORA Admin Dashboard – interactions
// Mobile sidebar drawer, desktop collapse, and the profile dropdown.

document.addEventListener('DOMContentLoaded', () => {
    initSidebarDrawer();
    initSidebarCollapse();
    initProfileDropdown();
    initConsultationTyping();
    initAdminNotifications();
});

function initAdminNotifications() {
    const root = document.querySelector('[data-admin-notifications]');
    const toggle = root?.querySelector('[data-admin-notifications-toggle]');
    const menu = root?.querySelector('[data-admin-notifications-menu]');
    const list = root?.querySelector('[data-admin-notifications-list]');
    const count = root?.querySelector('[data-admin-notifications-count]');
    const dot = root?.querySelector('[data-admin-notifications-dot]');
    const menuCount = root?.querySelector('[data-admin-notifications-menu-count]');
    const url = root?.dataset.notificationsUrl;

    if (!root || !toggle || !menu || !list || !count || !dot || !menuCount || !url) return;

    const escapeHtml = (value) => String(value ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
    const seenStorageKey = 'nexora_admin_seen_request_notifications';
    const readStorageKey = 'nexora_admin_read_request_notifications';
    let seenIds = new Set();
    let readIds = new Set();
    let latestNotifications = [];
    let toast = null;
    let toastTimer = null;
    const toastDuration = 5000;

    try {
        seenIds = new Set(JSON.parse(window.localStorage.getItem(seenStorageKey) || '[]'));
        readIds = new Set(JSON.parse(window.localStorage.getItem(readStorageKey) || '[]'));
    } catch (error) {
        seenIds = new Set();
        readIds = new Set();
    }

    const saveSeenIds = () => {
        try {
            window.localStorage.setItem(seenStorageKey, JSON.stringify([...seenIds].slice(-50)));
        } catch (error) {
            // Storage may be unavailable in private browsing.
        }
    };

    const saveReadIds = () => {
        try {
            window.localStorage.setItem(readStorageKey, JSON.stringify([...readIds].slice(-100)));
        } catch (error) {
            // Storage may be unavailable in private browsing.
        }
    };

    const updateUnreadBadge = () => {
        const unreadCount = latestNotifications.filter((notification) => !readIds.has(notification.id)).length;
        menuCount.textContent = String(latestNotifications.length);
        count.textContent = String(unreadCount);
        count.classList.toggle('hidden', unreadCount === 0);
        dot.classList.toggle('hidden', unreadCount === 0);
    };

    const closeToast = () => {
        window.clearTimeout(toastTimer);
        toastTimer = null;
        if (!toast) return;

        const closingToast = toast;
        if (closingToast.dataset.closing === 'true') return;
        closingToast.dataset.closing = 'true';
        closingToast.animate(
            [
                { opacity: 1, transform: 'translateY(0) scale(1)' },
                { opacity: 0, transform: 'translateY(-12px) scale(0.97)' },
            ],
            { duration: 220, easing: 'cubic-bezier(.4,0,1,1)', fill: 'forwards' },
        ).finished.finally(() => {
            closingToast.remove();
            if (toast === closingToast) toast = null;
        });
    };

    const showToast = (notification) => {
        closeToast();
        toast = document.createElement('div');
        toast.className = 'fixed right-4 top-20 z-[60] w-[min(24rem,calc(100vw-2rem))] overflow-hidden rounded-xl bg-navy text-white shadow-2xl ring-1 ring-white/10';
        toast.setAttribute('role', 'alert');
        toast.innerHTML = `
            <div class="flex items-start gap-3 p-4">
                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-accent text-navy" aria-hidden="true">i</span>
                <a href="${escapeHtml(notification.url)}" class="min-w-0 flex-1 hover:text-accent">
                    <p class="text-xs font-medium uppercase tracking-wide text-accent">${notification.type === 'message' ? 'New chat message' : 'New consultation request'}</p>
                    <p class="mt-1 truncate text-sm font-semibold">${escapeHtml(notification.name)}</p>
                    <p class="mt-0.5 truncate text-xs text-white/70">${escapeHtml(notification.company)}</p>
                </a>
                <button type="button" data-notification-close aria-label="Close notification" class="shrink-0 text-xl leading-none text-white/60 hover:text-white">&times;</button>
            </div>
            <div aria-hidden="true" style="height:6px;background:#ffffff"><div data-notification-progress style="width:100%;height:6px;background:#f59e0b;transition:width 5000ms cubic-bezier(.4,0,.2,1)"></div></div>`;
        document.body.appendChild(toast);
        const currentToast = toast;
        currentToast.animate(
            [
                { opacity: 0, transform: 'translateY(-16px) scale(0.97)' },
                { opacity: 1, transform: 'translateY(0) scale(1)' },
            ],
            { duration: 280, easing: 'cubic-bezier(0,0,.2,1)', fill: 'both' },
        );
        toast.addEventListener('click', (event) => event.stopPropagation());
        toast.querySelector('[data-notification-close]').addEventListener('click', closeToast);

        window.requestAnimationFrame(() => window.requestAnimationFrame(() => {
            const progress = currentToast.querySelector('[data-notification-progress]');
            if (progress) progress.style.width = '0%';
        }));
        toastTimer = window.setTimeout(() => {
            if (toast === currentToast) closeToast();
        }, toastDuration);
    };

    const render = (payload) => {
        const notifications = payload.notifications || [];
        latestNotifications = notifications;
        updateUnreadBadge();

        list.innerHTML = notifications.length
            ? notifications.map((notification) => `
                <a href="${escapeHtml(notification.url)}" role="menuitem" class="block rounded-lg px-3 py-2.5 hover:bg-surface">
                    <p class="truncate text-sm font-medium text-navy">${escapeHtml(notification.name)}</p>
                    <p class="truncate text-xs text-charcoal/70">${escapeHtml(notification.company)}</p>
                    <p class="mt-1 text-[11px] text-muted">${escapeHtml(notification.time)}</p>
                </a>`).join('')
            : '<p class="px-2 py-4 text-center text-sm text-muted">No new requests.</p>';

        const unseen = notifications.find((notification) => !seenIds.has(notification.id));
        if (unseen) {
            seenIds.add(unseen.id);
            saveSeenIds();
            showToast(unseen);
        }
    };

    const load = () => fetch(url, { credentials: 'same-origin', headers: { Accept: 'application/json' } })
        .then((response) => response.ok ? response.json() : Promise.reject(response))
        .then(render)
        .catch(() => {});

    toggle.addEventListener('click', (event) => {
        event.stopPropagation();
        const isHidden = menu.classList.toggle('hidden');
        toggle.setAttribute('aria-expanded', String(!isHidden));

        if (isHidden || !latestNotifications.length) return;

        latestNotifications.forEach((notification) => readIds.add(notification.id));
        saveReadIds();
        updateUnreadBadge();
    });
    document.addEventListener('click', (event) => {
        if (!menu.contains(event.target) && event.target !== toggle) {
            menu.classList.add('hidden');
            toggle.setAttribute('aria-expanded', 'false');
        }
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            menu.classList.add('hidden');
            toggle.setAttribute('aria-expanded', 'false');
            closeToast();
        }
    });

    load();
    window.setInterval(load, 2000);
}

function initConsultationTyping() {
    const chat = document.querySelector("[data-admin-consultation-chat]");
    const input = chat?.querySelector("[data-admin-chat-input]");
    const form = chat?.querySelector("[data-admin-chat-form]");
    const typingUrl = chat?.dataset.typingUrl;

    if (!chat || !input || !form || !typingUrl) return;

    let stopTypingTimeout;
    const sendTypingState = (isTyping) => {
        fetch(typingUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN":
                    document.querySelector('meta[name="csrf-token"]')
                        ?.content || "",
            },
            body: JSON.stringify({ is_typing: isTyping }),
        }).catch(() => {});
    };
    const stopTyping = () => {
        window.clearTimeout(stopTypingTimeout);
        sendTypingState(false);
    };

    input.addEventListener("input", () => {
        window.clearTimeout(stopTypingTimeout);

        if (!input.value.trim()) {
            stopTyping();
            return;
        }

        sendTypingState(true);
        stopTypingTimeout = window.setTimeout(stopTyping, 2500);
    });
    input.addEventListener("blur", stopTyping);
    form.addEventListener("submit", stopTyping);
}

function initSidebarDrawer() {
    const toggles = document.querySelectorAll('[data-admin-drawer-toggle]');
    const sidebar = document.querySelector('[data-admin-sidebar]');
    const overlay = document.querySelector('[data-admin-drawer-overlay]');

    if (!toggles.length || !sidebar || !overlay) return;

    const open = () => {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        toggles.forEach((toggle) => toggle.setAttribute('aria-expanded', 'true'));
    };
    const close = () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        toggles.forEach((toggle) => toggle.setAttribute('aria-expanded', 'false'));
    };

    toggles.forEach((toggle) => toggle.addEventListener('click', () => {
        sidebar.classList.contains('-translate-x-full') ? open() : close();
    }));
    overlay.addEventListener('click', close);
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') close();
    });
}

function initSidebarCollapse() {
    const toggle = document.querySelector('[data-admin-collapse-toggle]');
    const shell = document.querySelector('[data-admin-shell]');

    if (!toggle || !shell) return;

    toggle.addEventListener('click', () => {
        const collapsed = shell.classList.toggle('admin-collapsed');
        toggle.setAttribute('aria-pressed', String(collapsed));
        try {
            window.localStorage.setItem('nexora_admin_sidebar_collapsed', collapsed ? '1' : '0');
        } catch (e) {
            // Storage unavailable (private browsing etc.) — safe to ignore.
        }
    });

    try {
        if (window.localStorage.getItem('nexora_admin_sidebar_collapsed') === '1') {
            shell.classList.add('admin-collapsed');
            toggle.setAttribute('aria-pressed', 'true');
        }
    } catch (e) {
        // Ignore.
    }
}

function initProfileDropdown() {
    const trigger = document.querySelector('[data-admin-profile-trigger]');
    const menu = document.querySelector('[data-admin-profile-menu]');

    if (!trigger || !menu) return;

    const close = () => {
        menu.classList.add('hidden');
        trigger.setAttribute('aria-expanded', 'false');
    };

    trigger.addEventListener('click', (event) => {
        event.stopPropagation();
        const isHidden = menu.classList.toggle('hidden');
        trigger.setAttribute('aria-expanded', String(!isHidden));
    });

    document.addEventListener('click', (event) => {
        if (!menu.contains(event.target) && event.target !== trigger) close();
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') close();
    });
}
