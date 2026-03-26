<?php
/**
 * Title: Call to Action
 * Slug: wp-starter-theme/call-to-action
 * Categories: call-to-action
 * Description: Centered CTA section with heading, supporting text, and a prominent button.
 * Viewport Width: 1280
 */

?>
<!-- wp:group {"align":"full","backgroundColor":"primary","textColor":"white","style":{"spacing":{"padding":{"top":"var:preset|spacing|3xl","bottom":"var:preset|spacing|3xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-white-color has-primary-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--3xl);padding-bottom:var(--wp--preset--spacing--3xl)">

    <!-- wp:group {"layout":{"type":"constrained","contentSize":"640px"},"textAlign":"center"} -->
    <div class="wp-block-group has-text-align-center">

        <!-- wp:heading {"level":2,"textAlign":"center","style":{"typography":{"fontSize":"var:preset|font-size|3xl","fontWeight":"700","lineHeight":"1.2"},"color":{"text":"var:preset|color|white"},"spacing":{"margin":{"bottom":"var:preset|spacing|md"}}}} -->
        <h2 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="font-size:var(--wp--preset--font-size--3xl);font-weight:700;line-height:1.2;margin-bottom:var(--wp--preset--spacing--md)">Ready to Start Your Project?</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"var:preset|font-size|lg","lineHeight":"1.6"},"color":{"text":"var:preset|color|white"},"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <p class="has-text-align-center has-white-color has-text-color" style="font-size:var(--wp--preset--font-size--lg);line-height:1.6;margin-bottom:var(--wp--preset--spacing--xl)">Let's work together to create something remarkable. From concept to launch, I'll help you build a digital presence that stands out and delivers results.</p>
        <!-- /wp:paragraph -->

        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
        <div class="wp-block-buttons">
            <!-- wp:button {"style":{"border":{"radius":"6px"},"color":{"background":"var:preset|color|white","text":"var:preset|color|primary"},"typography":{"fontWeight":"700","fontSize":"var:preset|font-size|base"},"spacing":{"padding":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|sm","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}}}} -->
            <div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button" href="/contact" style="border-radius:6px;padding-top:var(--wp--preset--spacing--sm);padding-bottom:var(--wp--preset--spacing--sm);padding-left:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl);font-size:var(--wp--preset--font-size--base);font-weight:700">Start a Conversation</a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->

    </div>
    <!-- /wp:group -->

</div>
<!-- /wp:group -->
