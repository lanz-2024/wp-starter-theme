/**
 * Customizer live-preview handler.
 *
 * Listens to Customizer postMessage events and applies visual changes
 * instantly in the preview iframe without a full reload.
 *
 * All color settings are implemented as CSS custom property overrides on
 * the <html> element so they cascade naturally to every consumer.
 *
 * @package WPStarterTheme
 */

/// <reference types="@types/wordpress__customize-browser" />

(function (wp): void {
    'use strict';

    if (!wp?.customize) return;

    const { customize } = wp;

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /**
     * Set a CSS custom property on the document root.
     */
    function setCSSVar(property: string, value: string): void {
        document.documentElement.style.setProperty(property, value);
    }

    /**
     * Apply an inline style to all matching elements.
     */
    function applyStyle(selector: string, property: keyof CSSStyleDeclaration, value: string): void {
        document.querySelectorAll<HTMLElement>(selector).forEach((el) => {
            (el.style as Record<string, unknown>)[property as string] = value;
        });
    }

    // -------------------------------------------------------------------------
    // Header settings
    // -------------------------------------------------------------------------

    customize('header_bg_color', (value) => {
        value.bind((newVal: string) => {
            applyStyle('.site-header, .wp-block-template-part[data-area="header"]', 'backgroundColor', newVal);
            setCSSVar('--wp-starter-header-bg', newVal);
        });
    });

    customize('header_height', (value) => {
        value.bind((newVal: string | number) => {
            const px = typeof newVal === 'number' ? newVal : parseInt(newVal, 10);
            if (!isNaN(px)) {
                setCSSVar('--wp-starter-header-height', `${px}px`);
                applyStyle(
                    '.site-header, .wp-block-template-part[data-area="header"]',
                    'minHeight',
                    `${px}px`
                );
            }
        });
    });

    // -------------------------------------------------------------------------
    // Footer settings
    // -------------------------------------------------------------------------

    customize('footer_bg_color', (value) => {
        value.bind((newVal: string) => {
            applyStyle('.site-footer, .wp-block-template-part[data-area="footer"]', 'backgroundColor', newVal);
            setCSSVar('--wp-starter-footer-bg', newVal);
        });
    });

    customize('footer_copyright_text', (value) => {
        value.bind((newVal: string) => {
            document.querySelectorAll<HTMLElement>('.site-footer__copyright').forEach((el) => {
                el.innerHTML = newVal;
            });
        });
    });

    // -------------------------------------------------------------------------
    // Color settings — map to CSS custom properties so theme.json var()
    // references automatically pick up Customizer overrides.
    // -------------------------------------------------------------------------

    customize('primary_color', (value) => {
        value.bind((newVal: string) => {
            setCSSVar('--wp--preset--color--primary', newVal);
        });
    });

    customize('secondary_color', (value) => {
        value.bind((newVal: string) => {
            setCSSVar('--wp--preset--color--secondary', newVal);
        });
    });

})(window.wp as typeof window.wp);
