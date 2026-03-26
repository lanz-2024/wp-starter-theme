/**
 * Navigation — mobile menu toggle and keyboard accessibility.
 *
 * Responsibilities:
 * - Toggle the mobile/hamburger menu open/closed.
 * - Manage aria-expanded on the toggle button.
 * - Close the menu when Escape is pressed.
 * - Trap focus within the open menu (basic implementation).
 * - Close the menu when a click lands outside it.
 *
 * @package WPStarterTheme
 */

(function (): void {
    'use strict';

    // -------------------------------------------------------------------------
    // Selectors — update these if the HTML structure changes.
    // -------------------------------------------------------------------------
    const TOGGLE_SELECTOR = '.wp-block-navigation__responsive-container-open';
    const CLOSE_SELECTOR  = '.wp-block-navigation__responsive-container-close';
    const CONTAINER_SELECTOR = '.wp-block-navigation__responsive-container';
    const FOCUSABLE_SELECTOR = [
        'a[href]',
        'button:not([disabled])',
        'input:not([disabled])',
        'select:not([disabled])',
        'textarea:not([disabled])',
        '[tabindex]:not([tabindex="-1"])',
    ].join(', ');

    // -------------------------------------------------------------------------
    // State
    // -------------------------------------------------------------------------
    let isMenuOpen = false;
    let previouslyFocused: HTMLElement | null = null;

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    function getToggle(): HTMLButtonElement | null {
        return document.querySelector<HTMLButtonElement>(TOGGLE_SELECTOR);
    }

    function getContainer(): HTMLElement | null {
        return document.querySelector<HTMLElement>(CONTAINER_SELECTOR);
    }

    function getFocusableElements(): HTMLElement[] {
        const container = getContainer();
        if (!container) return [];
        return Array.from(container.querySelectorAll<HTMLElement>(FOCUSABLE_SELECTOR)).filter(
            (el) => !el.closest('[hidden]') && !el.closest('[aria-hidden="true"]')
        );
    }

    function openMenu(): void {
        const toggle    = getToggle();
        const container = getContainer();
        if (!toggle || !container) return;

        isMenuOpen = true;
        previouslyFocused = document.activeElement as HTMLElement;

        toggle.setAttribute('aria-expanded', 'true');
        container.classList.add('is-menu-open');
        container.removeAttribute('hidden');
        document.documentElement.classList.add('menu-open');

        // Move focus into the menu.
        const focusable = getFocusableElements();
        if (focusable.length > 0) {
            focusable[0].focus();
        }
    }

    function closeMenu(): void {
        const toggle    = getToggle();
        const container = getContainer();
        if (!toggle || !container) return;

        isMenuOpen = false;

        toggle.setAttribute('aria-expanded', 'false');
        container.classList.remove('is-menu-open');
        document.documentElement.classList.remove('menu-open');

        // Return focus to the element that triggered the menu open.
        if (previouslyFocused) {
            previouslyFocused.focus();
            previouslyFocused = null;
        }
    }

    function trapFocus(event: KeyboardEvent): void {
        if (!isMenuOpen) return;

        const focusable = getFocusableElements();
        if (focusable.length === 0) return;

        const first = focusable[0];
        const last  = focusable[focusable.length - 1];

        if (event.key === 'Tab') {
            if (event.shiftKey) {
                // Shift + Tab: going backward.
                if (document.activeElement === first) {
                    event.preventDefault();
                    last.focus();
                }
            } else {
                // Tab: going forward.
                if (document.activeElement === last) {
                    event.preventDefault();
                    first.focus();
                }
            }
        }
    }

    // -------------------------------------------------------------------------
    // Dropdown keyboard navigation (desktop)
    // -------------------------------------------------------------------------

    function handleDropdownKeyboard(event: KeyboardEvent): void {
        const target = event.target as HTMLElement;
        const menuItem = target.closest<HTMLElement>('.has-dropdown');
        if (!menuItem) return;

        const dropdown = menuItem.querySelector<HTMLElement>('.dropdown-menu');
        if (!dropdown) return;

        if (event.key === 'Enter' || event.key === ' ') {
            const isExpanded = target.getAttribute('aria-expanded') === 'true';
            if (isExpanded) {
                target.setAttribute('aria-expanded', 'false');
                dropdown.hidden = true;
            } else {
                // Close all other open dropdowns first.
                document.querySelectorAll<HTMLElement>('[aria-expanded="true"]').forEach((el) => {
                    if (el !== target) {
                        el.setAttribute('aria-expanded', 'false');
                        const d = el.closest('.has-dropdown')?.querySelector<HTMLElement>('.dropdown-menu');
                        if (d) d.hidden = true;
                    }
                });
                target.setAttribute('aria-expanded', 'true');
                dropdown.hidden = false;

                // Focus the first item in the dropdown.
                const firstItem = dropdown.querySelector<HTMLElement>('a');
                firstItem?.focus();
                event.preventDefault();
            }
        }

        if (event.key === 'Escape') {
            target.setAttribute('aria-expanded', 'false');
            dropdown.hidden = true;
            target.focus();
        }
    }

    // -------------------------------------------------------------------------
    // Event listeners
    // -------------------------------------------------------------------------

    function init(): void {
        const toggle = getToggle();
        const container = getContainer();

        if (toggle) {
            toggle.addEventListener('click', () => {
                if (isMenuOpen) {
                    closeMenu();
                } else {
                    openMenu();
                }
            });
        }

        // Close button inside the responsive container.
        document.querySelectorAll<HTMLButtonElement>(CLOSE_SELECTOR).forEach((btn) => {
            btn.addEventListener('click', closeMenu);
        });

        // Keyboard: Escape closes the menu.
        document.addEventListener('keydown', (event: KeyboardEvent) => {
            if (event.key === 'Escape' && isMenuOpen) {
                closeMenu();
            }
            trapFocus(event);
            handleDropdownKeyboard(event);
        });

        // Click outside closes the menu.
        document.addEventListener('click', (event: MouseEvent) => {
            if (!isMenuOpen) return;
            const nav = document.querySelector<HTMLElement>('.wp-block-navigation');
            if (nav && !nav.contains(event.target as Node)) {
                closeMenu();
            }
        });

        // Close all dropdowns when clicking outside a nav.
        document.addEventListener('click', (event: MouseEvent) => {
            const target = event.target as HTMLElement;
            if (!target.closest('.wp-block-navigation')) {
                document.querySelectorAll<HTMLElement>('[aria-expanded="true"]').forEach((el) => {
                    el.setAttribute('aria-expanded', 'false');
                });
            }
        });

        // Accessibility: make menu toggle visible to assistive tech if it lacks a label.
        if (toggle && !toggle.getAttribute('aria-label')) {
            toggle.setAttribute('aria-label', 'Open menu');
        }
    }

    // -------------------------------------------------------------------------
    // Bootstrap
    // -------------------------------------------------------------------------

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
