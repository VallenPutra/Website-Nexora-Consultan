// NEXORA IT Consulting – site interactions
// Mobile navigation, mega menus, and the contact form demo handler.

document.addEventListener("DOMContentLoaded", () => {
    initMobileMenu();
    initMegaMenus();
    initContactForm();
    initConsultationChat();
});

function initMobileMenu() {
    const toggle = document.querySelector("[data-mobile-menu-toggle]");
    const panel = document.querySelector("[data-mobile-menu-panel]");

    if (!toggle || !panel) return;

    toggle.addEventListener("click", () => {
        const isOpen = panel.classList.toggle("hidden") === false;
        toggle.setAttribute("aria-expanded", String(isOpen));
        document.body.classList.toggle("overflow-hidden", isOpen);
    });

    // Mobile accordions for each menu group
    panel.querySelectorAll("[data-accordion-trigger]").forEach((trigger) => {
        trigger.addEventListener("click", () => {
            const content = trigger.nextElementSibling;
            const isOpen = content.classList.toggle("hidden") === false;
            trigger.setAttribute("aria-expanded", String(isOpen));
            trigger
                .querySelector("[data-accordion-icon]")
                ?.classList.toggle("rotate-180", isOpen);
        });
    });
}

function initConsultationChat() {
    const root = document.querySelector("[data-consultation-chat]");
    if (!root) return;

    const panel = root.querySelector("[data-chat-panel]");
    const messages = root.querySelector("[data-chat-messages]");
    const startForm = root.querySelector("[data-chat-start-form]");
    const replyForm = root.querySelector("[data-chat-reply-form]");
    let token = window.localStorage.getItem("nexora_chat_token");
    let pollingInterval;

    const render = (items) => {
        messages.innerHTML = items
            .map(
                (item) =>
                    `<div class="max-w-[85%] rounded-lg px-3 py-2 ${item.sender === "visitor" ? "self-end bg-navy text-white" : "self-start bg-surface text-charcoal"}"><p>${escapeHtml(item.body)}</p><span class="mt-1 block text-[10px] opacity-60">${item.time}</span></div>`,
            )
            .join("");
        messages.scrollTop = messages.scrollHeight;
    };
    const load = async () => {
        if (!token) return;
        const response = await fetch(`/consultation-chat/${token}/messages`);
        if (response.ok) render((await response.json()).messages);
    };
    const startPolling = () => {
        if (!token || pollingInterval) return;

        load();
        pollingInterval = window.setInterval(load, 5000);
    };
    const escapeHtml = (value) =>
        value.replace(
            /[&<>'"]/g,
            (character) =>
                ({
                    "&": "&amp;",
                    "<": "&lt;",
                    ">": "&gt;",
                    "'": "&#039;",
                    '"': "&quot;",
                })[character],
        );

    root.querySelector("[data-chat-toggle]").addEventListener("click", () => {
        panel.classList.toggle("hidden");
        if (token) load();
    });
    root.querySelector("[data-chat-close]").addEventListener("click", () =>
        panel.classList.add("hidden"),
    );
    startForm.addEventListener("submit", async (event) => {
        event.preventDefault();
        const response = await fetch("/consultation-chat/start", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN":
                    document.querySelector('meta[name="csrf-token"]')
                        ?.content || "",
            },
            body: JSON.stringify(Object.fromEntries(new FormData(startForm))),
        });
        if (!response.ok) return;
        const data = await response.json();
        token = data.token;
        window.localStorage.setItem("nexora_chat_token", token);
        startForm.classList.add("hidden");
        replyForm.classList.remove("hidden");
        render(data.messages);
        startPolling();
    });
    replyForm.addEventListener("submit", async (event) => {
        event.preventDefault();
        const response = await fetch(`/consultation-chat/${token}/messages`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN":
                    document.querySelector('meta[name="csrf-token"]')
                        ?.content || "",
            },
            body: JSON.stringify({ body: new FormData(replyForm).get("body") }),
        });
        if (response.ok) {
            replyForm.reset();
            load();
        }
    });
    if (token) {
        startForm.classList.add("hidden");
        replyForm.classList.remove("hidden");
        startPolling();
    }
}

function initMegaMenus() {
    const items = document.querySelectorAll("[data-mega-menu-item]");

    items.forEach((item) => {
        const trigger = item.querySelector("[data-mega-menu-trigger]");
        const panel = item.querySelector("[data-mega-menu-panel]");
        if (!trigger || !panel) return;

        const open = () => {
            panel.classList.remove("hidden", "opacity-0", "-translate-y-1");
            trigger.setAttribute("aria-expanded", "true");
        };
        const close = () => {
            panel.classList.add("opacity-0", "-translate-y-1");
            trigger.setAttribute("aria-expanded", "false");
            window.setTimeout(() => panel.classList.add("hidden"), 150);
        };

        item.addEventListener("mouseenter", open);
        item.addEventListener("mouseleave", close);
        trigger.addEventListener("click", (event) => {
            event.preventDefault();
            panel.classList.contains("hidden") ? open() : close();
        });
    });

    // Close mega menus when clicking outside of them
    document.addEventListener("click", (event) => {
        items.forEach((item) => {
            if (!item.contains(event.target)) {
                const panel = item.querySelector("[data-mega-menu-panel]");
                panel?.classList.add("hidden", "opacity-0", "-translate-y-1");
            }
        });
    });
}

function initContactForm() {
    const form = document.querySelector("[data-contact-form]");
    if (!form) return;

    form.addEventListener("submit", (event) => {
        const requiredFields = form.querySelectorAll("[required]");
        let hasError = false;

        requiredFields.forEach((field) => {
            const errorEl = field
                .closest("[data-field]")
                ?.querySelector("[data-field-error]");
            if (!field.value.trim()) {
                hasError = true;
                errorEl?.classList.remove("hidden");
                field.classList.add("border-red-400");
            } else {
                errorEl?.classList.add("hidden");
                field.classList.remove("border-red-400");
            }
        });

        if (hasError) {
            event.preventDefault();
        }
    });
}
