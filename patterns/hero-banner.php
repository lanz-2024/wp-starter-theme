<?php
/**
 * Title: Hero Banner
 * Slug: wp-starter-theme/hero-banner
 * Categories: featured, banner
 * Block Types: core/cover
 * Description: Full-width hero section with headline, subheading, and CTA buttons.
 * Viewport Width: 1280
 */

?>
<!-- wp:cover {"url":"","dimRatio":50,"overlayColor":"neutral-900","isUserOverlayColor":true,"minHeight":600,"minHeightUnit":"px","isDark":true,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|3xl","bottom":"var:preset|spacing|3xl"}}}} -->
<div class="wp-block-cover alignfull is-dark" style="min-height:600px;padding-top:var(--wp--preset--spacing--3xl);padding-bottom:var(--wp--preset--spacing--3xl)">
    <span aria-hidden="true" class="wp-block-cover__background has-neutral-900-background-color has-background-dim"></span>
    <div class="wp-block-cover__inner-container">

        <!-- wp:group {"layout":{"type":"constrained"},"textAlign":"center"} -->
        <div class="wp-block-group has-text-align-center">

            <!-- wp:heading {"level":1,"textAlign":"center","style":{"typography":{"fontSize":"var:preset|font-size|3xl","fontWeight":"800","lineHeight":"1.1"},"color":{"text":"var:preset|color|white"},"spacing":{"margin":{"bottom":"var:preset|spacing|md"}}}} -->
            <h1 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="font-size:var(--wp--preset--font-size--3xl);font-weight:800;line-height:1.1;margin-bottom:var(--wp--preset--spacing--md)">Build Something Beautiful</h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"var:preset|font-size|xl","lineHeight":"1.6"},"color":{"text":"var:preset|color|neutral-100"},"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
            <p class="has-text-align-center has-neutral-100-color has-text-color" style="font-size:var(--wp--preset--font-size--xl);line-height:1.6;margin-bottom:var(--wp--preset--spacing--xl)">A modern WordPress block theme showcasing the full power of Full Site Editing, theme.json v3, and a clean PSR-4 architecture.</p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|md"}}} -->
            <div class="wp-block-buttons">

                <!-- wp:button {"backgroundColor":"primary","textColor":"white","style":{"border":{"radius":"6px"},"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|base"},"spacing":{"padding":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|sm","left":"var:preset|spacing|lg","right":"var:preset|spacing|lg"}}}} -->
                <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button" href="/portfolio" style="border-radius:6px;padding-top:var(--wp--preset--spacing--sm);padding-bottom:var(--wp--preset--spacing--sm);padding-left:var(--wp--preset--spacing--lg);padding-right:var(--wp--preset--spacing--lg);font-size:var(--wp--preset--font-size--base);font-weight:600">View My Work</a></div>
                <!-- /wp:button -->

                <!-- wp:button {"className":"is-style-outline","style":{"border":{"radius":"6px","color":"var:preset|color|white","width":"2px"},"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|base"},"spacing":{"padding":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|sm","left":"var:preset|spacing|lg","right":"var:preset|spacing|lg"}},"color":{"text":"var:preset|color|white"}}} -->
                <div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-white-color has-text-color wp-element-button" href="/contact" style="border-radius:6px;border-width:2px;border-color:var(--wp--preset--color--white);padding-top:var(--wp--preset--spacing--sm);padding-bottom:var(--wp--preset--spacing--sm);padding-left:var(--wp--preset--spacing--lg);padding-right:var(--wp--preset--spacing--lg);font-size:var(--wp--preset--font-size--base);font-weight:600">Get In Touch</a></div>
                <!-- /wp:button -->

            </div>
            <!-- /wp:buttons -->

        </div>
        <!-- /wp:group -->

    </div>
</div>
<!-- /wp:cover -->
