<?php
/**
 * Title: Testimonials Grid
 * Slug: wp-starter-theme/testimonials-grid
 * Categories: testimonials
 * Description: Three-column grid of testimonial cards with quote, author name, and role.
 * Viewport Width: 1280
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|3xl","bottom":"var:preset|spacing|3xl"}}},"backgroundColor":"neutral-100","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-neutral-100-background-color has-background" style="padding-top:var(--wp--preset--spacing--3xl);padding-bottom:var(--wp--preset--spacing--3xl)">

    <!-- wp:group {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|2xl"}}}} -->
    <div class="wp-block-group has-text-align-center">
        <!-- wp:heading {"level":2,"textAlign":"center","style":{"typography":{"fontSize":"var:preset|font-size|3xl","fontWeight":"700"}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="font-size:var(--wp--preset--font-size--3xl);font-weight:700">What Clients Say</h2>
        <!-- /wp:heading -->
        <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"var:preset|font-size|lg"},"color":{"text":"var:preset|color|neutral-900"}}} -->
        <p class="has-text-align-center has-neutral-900-color has-text-color" style="font-size:var(--wp--preset--font-size--lg)">Trusted by teams and individuals who value quality craftsmanship.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|lg","left":"var:preset|spacing|lg"}}}} -->
    <div class="wp-block-columns">

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"backgroundColor":"white","style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|xl","right":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl","left":"var:preset|spacing|xl"}},"shadow":"var:preset|shadow|medium"}} -->
            <div class="wp-block-group has-white-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl);padding-left:var(--wp--preset--spacing--xl)">

                <!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|2xl","lineHeight":"1"},"color":{"text":"var:preset|color|primary"},"spacing":{"margin":{"bottom":"var:preset|spacing|sm","top":"0"}}}} -->
                <p class="has-primary-color has-text-color" style="font-size:var(--wp--preset--font-size--2xl);line-height:1;margin-top:0;margin-bottom:var(--wp--preset--spacing--sm)">"</p>
                <!-- /wp:paragraph -->

                <!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|base","lineHeight":"1.7","fontStyle":"italic"},"spacing":{"margin":{"bottom":"var:preset|spacing|lg","top":"0"}}}} -->
                <p style="font-size:var(--wp--preset--font-size--base);line-height:1.7;font-style:italic;margin-top:0;margin-bottom:var(--wp--preset--spacing--lg)">Working with this team transformed our online presence completely. The attention to detail and technical expertise delivered a site that truly represents our brand and converts visitors into customers.</p>
                <!-- /wp:paragraph -->

                <!-- wp:separator {"backgroundColor":"neutral-100","className":"is-style-wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|md","top":"0"}}}} -->
                <hr class="wp-block-separator has-text-color has-neutral-100-color has-alpha-channel-opacity has-neutral-100-background-color has-background is-style-wide" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--md)"/>
                <!-- /wp:separator -->

                <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|sm"}}} -->
                <div class="wp-block-group">
                    <!-- wp:image {"width":48,"height":48,"style":{"border":{"radius":"50%"}}} -->
                    <figure class="wp-block-image is-resized" style="border-radius:50%"><img src="https://secure.gravatar.com/avatar/placeholder?s=48&d=mp" alt="Sarah Mitchell" width="48" height="48"/></figure>
                    <!-- /wp:image -->
                    <!-- wp:group {"layout":{"type":"constrained"}} -->
                    <div class="wp-block-group">
                        <!-- wp:paragraph {"style":{"typography":{"fontWeight":"700","fontSize":"var:preset|font-size|sm"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
                        <p style="font-size:var(--wp--preset--font-size--sm);font-weight:700;margin-top:0;margin-bottom:0">Sarah Mitchell</p>
                        <!-- /wp:paragraph -->
                        <!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|xs"},"color":{"text":"var:preset|color|neutral-900"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
                        <p class="has-neutral-900-color has-text-color" style="font-size:var(--wp--preset--font-size--xs);margin-top:0;margin-bottom:0">CEO, TechVentures</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"backgroundColor":"white","style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|xl","right":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl","left":"var:preset|spacing|xl"}},"shadow":"var:preset|shadow|medium"}} -->
            <div class="wp-block-group has-white-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl);padding-left:var(--wp--preset--spacing--xl)">

                <!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|2xl","lineHeight":"1"},"color":{"text":"var:preset|color|primary"},"spacing":{"margin":{"bottom":"var:preset|spacing|sm","top":"0"}}}} -->
                <p class="has-primary-color has-text-color" style="font-size:var(--wp--preset--font-size--2xl);line-height:1;margin-top:0;margin-bottom:var(--wp--preset--spacing--sm)">"</p>
                <!-- /wp:paragraph -->

                <!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|base","lineHeight":"1.7","fontStyle":"italic"},"spacing":{"margin":{"bottom":"var:preset|spacing|lg","top":"0"}}}} -->
                <p style="font-size:var(--wp--preset--font-size--base);line-height:1.7;font-style:italic;margin-top:0;margin-bottom:var(--wp--preset--spacing--lg)">The custom WordPress solution delivered was beyond our expectations. Performance scores are outstanding, the admin experience is intuitive, and the codebase is clean and maintainable.</p>
                <!-- /wp:paragraph -->

                <!-- wp:separator {"backgroundColor":"neutral-100","className":"is-style-wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|md","top":"0"}}}} -->
                <hr class="wp-block-separator has-text-color has-neutral-100-color has-alpha-channel-opacity has-neutral-100-background-color has-background is-style-wide" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--md)"/>
                <!-- /wp:separator -->

                <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|sm"}}} -->
                <div class="wp-block-group">
                    <!-- wp:image {"width":48,"height":48,"style":{"border":{"radius":"50%"}}} -->
                    <figure class="wp-block-image is-resized" style="border-radius:50%"><img src="https://secure.gravatar.com/avatar/placeholder?s=48&d=mp" alt="James Thornton" width="48" height="48"/></figure>
                    <!-- /wp:image -->
                    <!-- wp:group {"layout":{"type":"constrained"}} -->
                    <div class="wp-block-group">
                        <!-- wp:paragraph {"style":{"typography":{"fontWeight":"700","fontSize":"var:preset|font-size|sm"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
                        <p style="font-size:var(--wp--preset--font-size--sm);font-weight:700;margin-top:0;margin-bottom:0">James Thornton</p>
                        <!-- /wp:paragraph -->
                        <!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|xs"},"color":{"text":"var:preset|color|neutral-900"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
                        <p class="has-neutral-900-color has-text-color" style="font-size:var(--wp--preset--font-size--xs);margin-top:0;margin-bottom:0">Head of Product, Growthlab</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"backgroundColor":"white","style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|xl","right":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl","left":"var:preset|spacing|xl"}},"shadow":"var:preset|shadow|medium"}} -->
            <div class="wp-block-group has-white-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl);padding-left:var(--wp--preset--spacing--xl)">

                <!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|2xl","lineHeight":"1"},"color":{"text":"var:preset|color|primary"},"spacing":{"margin":{"bottom":"var:preset|spacing|sm","top":"0"}}}} -->
                <p class="has-primary-color has-text-color" style="font-size:var(--wp--preset--font-size--2xl);line-height:1;margin-top:0;margin-bottom:var(--wp--preset--spacing--sm)">"</p>
                <!-- /wp:paragraph -->

                <!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|base","lineHeight":"1.7","fontStyle":"italic"},"spacing":{"margin":{"bottom":"var:preset|spacing|lg","top":"0"}}}} -->
                <p style="font-size:var(--wp--preset--font-size--base);line-height:1.7;font-style:italic;margin-top:0;margin-bottom:var(--wp--preset--spacing--lg)">Exceptional work from start to finish. The FSE implementation with block patterns gave our content team complete flexibility without sacrificing consistency. Highly recommended.</p>
                <!-- /wp:paragraph -->

                <!-- wp:separator {"backgroundColor":"neutral-100","className":"is-style-wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|md","top":"0"}}}} -->
                <hr class="wp-block-separator has-text-color has-neutral-100-color has-alpha-channel-opacity has-neutral-100-background-color has-background is-style-wide" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--md)"/>
                <!-- /wp:separator -->

                <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|sm"}}} -->
                <div class="wp-block-group">
                    <!-- wp:image {"width":48,"height":48,"style":{"border":{"radius":"50%"}}} -->
                    <figure class="wp-block-image is-resized" style="border-radius:50%"><img src="https://secure.gravatar.com/avatar/placeholder?s=48&d=mp" alt="Priya Nair" width="48" height="48"/></figure>
                    <!-- /wp:image -->
                    <!-- wp:group {"layout":{"type":"constrained"}} -->
                    <div class="wp-block-group">
                        <!-- wp:paragraph {"style":{"typography":{"fontWeight":"700","fontSize":"var:preset|font-size|sm"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
                        <p style="font-size:var(--wp--preset--font-size--sm);font-weight:700;margin-top:0;margin-bottom:0">Priya Nair</p>
                        <!-- /wp:paragraph -->
                        <!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|xs"},"color":{"text":"var:preset|color|neutral-900"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
                        <p class="has-neutral-900-color has-text-color" style="font-size:var(--wp--preset--font-size--xs);margin-top:0;margin-bottom:0">Marketing Director, BrandStudio</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

</div>
<!-- /wp:group -->
