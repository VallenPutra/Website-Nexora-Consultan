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
    const startButton = startForm?.querySelector('button[type="submit"]');
    const isAuthenticated = root.dataset.authenticated === "true";
    const chatCopy = {
        handledBy: root.dataset.chatHandledBy || "This chat is being handled by :name",
        typing: root.dataset.chatTyping || "Admin is typing",
        start: root.dataset.chatStart || "Start consultation",
        starting: root.dataset.chatStarting || "Starting...",
    };
    let token = null;
    let pollingInterval;

    const render = (items, handlerName = null, isTyping = false, notice = null) => {
        messages.innerHTML = items
            .map(
                (item) =>
                    `<div class="max-w-[85%] rounded-lg px-3 py-2 ${item.sender === "visitor" ? "self-end bg-navy text-white" : "self-start bg-surface text-charcoal"}"><p>${escapeHtml(item.body)}</p><span class="mt-1 block text-[10px] opacity-60">${item.time}</span></div>`,
            )
            .join("");
        if (notice) {
            messages.insertAdjacentHTML(
                "afterbegin",
                '<div class="mb-2 rounded-lg border border-amber-200 bg-amber-50 px-3 py-2 text-center text-xs leading-relaxed text-amber-800">' +
                    escapeHtml(notice) +
                    "</div>",
            );
        }
        if (handlerName) {
            messages.insertAdjacentHTML(
                "afterbegin",
                '<div class="text-center text-xs text-muted">' +
                    escapeHtml(chatCopy.handledBy.replace(":name", handlerName)) +
                    "</div>",
            );
        }
        if (isTyping) {
            messages.insertAdjacentHTML(
                "beforeend",
                '<div class="flex items-center gap-1 self-start rounded-lg bg-surface px-3 py-2 text-xs text-muted"><span>' +
                    escapeHtml(chatCopy.typing) +
                    '</span><span class="flex gap-0.5"><span class="animate-bounce">.</span><span class="animate-bounce [animation-delay:150ms]">.</span><span class="animate-bounce [animation-delay:300ms]">.</span></span></div>',
            );
        }
        messages.scrollTop = messages.scrollHeight;
    };
    const load = async () => {
        if (!token) return;
        const response = await fetch(`/consultation-chat/${token}/messages`);
        if (response.ok) {
            const data = await response.json();
            render(data.messages, data.handler_name, data.is_typing, data.notice);
        }
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
    if (!isAuthenticated) return;

    const loadCurrent = async () => {
        const response = await fetch("/consultation-chat/current");
        if (!response.ok) return;

        const data = await response.json();
        token = data.token;

        if (!token) {
            window.localStorage.removeItem("nexora_chat_token");
            startForm.classList.remove("hidden");
            replyForm.classList.add("hidden");
            messages.innerHTML = "";
            return;
        }

        window.localStorage.setItem("nexora_chat_token", token);
        startForm.classList.add("hidden");
        replyForm.classList.remove("hidden");
        render(data.messages, data.handler_name, data.is_typing, data.notice);
        startPolling();
    };
    startForm.addEventListener("submit", async (event) => {
        event.preventDefault();
        if (startButton?.disabled) return;

        if (startButton) {
            startButton.disabled = true;
            startButton.textContent = chatCopy.starting;
        }

        const response = await fetch("/consultation-chat/start", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN":
                    document.querySelector('meta[name="csrf-token"]')
                        ?.content || "",
            },
            body: JSON.stringify({
                message: new FormData(startForm).get("message"),
            }),
        });
        if (!response.ok) {
            if (startButton) {
                startButton.disabled = false;
                startButton.textContent = chatCopy.start;
            }
            return;
        }
        const data = await response.json();
        token = data.token;
        window.localStorage.setItem("nexora_chat_token", token);
        startForm.classList.add("hidden");
        replyForm.classList.remove("hidden");
        render(data.messages, data.handler_name, data.is_typing, data.notice);
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
    loadCurrent();
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
