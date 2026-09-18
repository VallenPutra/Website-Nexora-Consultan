// NEXORA Admin Dashboard – interactions
// Mobile sidebar drawer, desktop collapse, and the profile dropdown.

document.addEventListener('DOMContentLoaded', () => {
    initSidebarDrawer();
    initSidebarCollapse();
    initProfileDropdown();
});

function initSidebarDrawer() {
    const toggle = document.querySelector('[data-admin-drawer-toggle]');
    const sidebar = document.querySelector('[data-admin-sidebar]');
    const overlay = document.querySelector('[data-admin-drawer-overlay]');

    if (!toggle || !sidebar || !overlay) return;

    const open = () => {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        toggle.setAttribute('aria-expanded', 'true');
    };
    const close = () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        toggle.setAttribute('aria-expanded', 'false');
    };

    toggle.addEventListener('click', () => {
        sidebar.classList.contains('-translate-x-full') ? open() : close();
    });
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
