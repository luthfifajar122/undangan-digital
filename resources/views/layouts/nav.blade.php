<nav class="fixed top-0 left-0 right-0 z-50 bg-[var(--color-surface)] border-b border-[var(--color-border)] shadow-sm">
    <div class="max-w-7xl mx-auto flex items-center justify-between h-16 sm:h-20 px-4">
        <!-- Logo / Brand -->
        <div class="flex items-center gap-2">
            <span class="text-[var(--color-primary)] font-semibold text-lg tracking-wider">Ruang Undang</span>
        </div>

        <!-- Desktop Navigation -->
        <div class="hidden md:block flex items-center gap-8">
            <a
                href="#templates"
                class="text-[var(--color-text-secondary)] hover:text-[var(--color-primary)] transition-colors text-sm"
            >
                Katalog Template
            </a>
            <a
                href="#how-it-works"
                class="text-[var(--color-text-secondary)] hover:text-[var(--color-primary)] transition-colors text-sm"
            >
                Cara Pesan
            </a>
            <a
                href="#contact"
                class="text-[var(--color-text-secondary)] hover:text-[var(--color-primary)] transition-colors text-sm"
            >
                Kontak
            </a>
        </div>

        <!-- Mobile Navigation / Hamburger -->
        <button
            class="md:hidden p-2 rounded-lg hover:bg-[var(--color-surface-elevated)] focus:outline-none focus:ring-2 focus:ring-offset-2"
            aria-label="Menu utama"
        >
            <svg
                class="w-6 h-6 stroke-current stroke-2"
                viewBox="0 0 24 24"
                fill="none"
                stroke-width="2"
                stroke-linecap="round"
            >
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu (initially hidden) -->
    <div class="hidden md:hidden bg-[var(--color-surface)] border-t border-[var(--color-border)]">
        <div class="max-w-7xl mx-auto px-4 pt-6">
            <div class="space-y-4">
                <a
                    href="#templates"
                    class="block px-4 py-2 rounded-lg hover:bg-[var(--color-surface-elevated)] transition-colors text-[var(--color-text)]"
                >
                    Katalog Template
                </a>
                <a
                    href="#how-it-works"
                    class="block px-4 py-2 rounded-lg hover:bg-[var(--color-surface-elevated)] transition-colors text-[var(--color-text)]"
                >
                    Cara Pesan
                </a>
                <a
                    href="#contact"
                    class="block px-4 py-2 rounded-lg hover:bg-[var(--color-surface-elevated)] transition-colors text-[var(--color-text)]"
                >
                    Kontak
                </a>
            </div>
        </div>
    </div>
</nav>