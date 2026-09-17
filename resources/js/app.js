// NEXORA IT Consulting – site interactions
// Mobile navigation, mega menus, and the contact form demo handler.

document.addEventListener('DOMContentLoaded', () => {
    initMobileMenu();
    initMegaMenus();
    initContactForm();
});

function initMobileMenu() {
    const toggle = document.querySelector('[data-mobile-menu-toggle]');
    const panel = document.querySelector('[data-mobile-menu-panel]');

    if (!toggle || !panel) return;

    toggle.addEventListener('click', () => {
        const isOpen = panel.classList.toggle('hidden') === false;
        toggle.setAttribute('aria-expanded', String(isOpen));
        document.body.classList.toggle('overflow-hidden', isOpen);
    });

    // Mobile accordions for each menu group
    panel.querySelectorAll('[data-accordion-trigger]').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const content = trigger.nextElementSibling;
            const isOpen = content.classList.toggle('hidden') === false;
            trigger.setAttribute('aria-expanded', String(isOpen));
            trigger.querySelector('[data-accordion-icon]')?.classList.toggle('rotate-180', isOpen);
        });
    });
}

function initMegaMenus() {
    const items = document.querySelectorAll('[data-mega-menu-item]');

    items.forEach((item) => {
        const trigger = item.querySelector('[data-mega-menu-trigger]');
        const panel = item.querySelector('[data-mega-menu-panel]');
        if (!trigger || !panel) return;

        const open = () => {
            panel.classList.remove('hidden', 'opacity-0', '-translate-y-1');
            trigger.setAttribute('aria-expanded', 'true');
        };
        const close = () => {
            panel.classList.add('opacity-0', '-translate-y-1');
            trigger.setAttribute('aria-expanded', 'false');
            window.setTimeout(() => panel.classList.add('hidden'), 150);
        };

        item.addEventListener('mouseenter', open);
        item.addEventListener('mouseleave', close);
        trigger.addEventListener('click', (event) => {
            event.preventDefault();
            panel.classList.contains('hidden') ? open() : close();
        });
    });

    // Close mega menus when clicking outside of them
    document.addEventListener('click', (event) => {
        items.forEach((item) => {
            if (!item.contains(event.target)) {
                const panel = item.querySelector('[data-mega-menu-panel]');
                panel?.classList.add('hidden', 'opacity-0', '-translate-y-1');
            }
        });
    });
}

function initContactForm() {
    const form = document.querySelector('[data-contact-form]');
    if (!form) return;

    form.addEventListener('submit', (event) => {
        const requiredFields = form.querySelectorAll('[required]');
        let hasError = false;

        requiredFields.forEach((field) => {
            const errorEl = field.closest('[data-field]')?.querySelector('[data-field-error]');
            if (!field.value.trim()) {
                hasError = true;
                errorEl?.classList.remove('hidden');
                field.classList.add('border-red-400');
            } else {
                errorEl?.classList.add('hidden');
                field.classList.remove('border-red-400');
            }
        });

        if (hasError) {
            event.preventDefault();
        }
    });
}
