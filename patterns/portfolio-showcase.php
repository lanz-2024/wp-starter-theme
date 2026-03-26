<?php
/**
 * Title: Portfolio Showcase
 * Slug: wp-starter-theme/portfolio-showcase
 * Categories: portfolio
 * Description: Portfolio showcase with heading and a three-column query grid for portfolio CPT.
 * Viewport Width: 1280
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|3xl","bottom":"var:preset|spacing|3xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--3xl);padding-bottom:var(--wp--preset--spacing--3xl)">

    <!-- wp:group {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|2xl"}}}} -->
    <div class="wp-block-group has-text-align-center">

        <!-- wp:heading {"level":2,"textAlign":"center","style":{"typography":{"fontSize":"var:preset|font-size|3xl","fontWeight":"700"},"spacing":{"margin":{"bottom":"var:preset|spacing|md"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="font-size:var(--wp--preset--font-size--3xl);font-weight:700;margin-bottom:var(--wp--preset--spacing--md)">Selected Work</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"var:preset|font-size|lg"},"color":{"text":"var:preset|color|neutral-900"}}} -->
        <p class="has-text-align-center has-neutral-900-color has-text-color" style="font-size:var(--wp--preset--font-size--lg)">A curated selection of projects that showcase my approach to design and development.</p>
        <!-- /wp:paragraph -->

    </div>
    <!-- /wp:group -->

    <!-- wp:query {"queryId":1,"query":{"perPage":6,"offset":0,"postType":"portfolio","order":"desc","orderBy":"date","inherit":false},"displayLayout":{"type":"flex","columns":3}} -->
    <div class="wp-block-query">

        <!-- wp:post-template {"layout":{"type":"grid","columnCount":3},"style":{"spacing":{"blockGap":"var:preset|spacing|lg"}}} -->

            <!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}},"overflow":"hidden"},"backgroundColor":"white","layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-white-background-color has-background" style="border-radius:8px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">

                <!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","style":{"spacing":{"margin":{"bottom":"0"}},"border":{"radius":"8px 8px 0 0"}}} /-->

                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|md","right":"var:preset|spacing|md","bottom":"var:preset|spacing|md","left":"var:preset|spacing|md"}}}} -->
                <div class="wp-block-group">
                    <!-- wp:post-terms {"term":"portfolio_type","style":{"typography":{"fontSize":"var:preset|font-size|xs","fontWeight":"600","textTransform":"uppercase","letterSpacing":"0.08em"},"color":{"text":"var:preset|color|primary"},"spacing":{"margin":{"bottom":"var:preset|spacing|xs"}}}} /-->
                    <!-- wp:post-title {"isLink":true,"level":3,"style":{"typography":{"fontSize":"var:preset|font-size|xl","fontWeight":"700"},"spacing":{"margin":{"bottom":"var:preset|spacing|xs","top":"0"}}}} /-->
                    <!-- wp:post-excerpt {"moreText":"View Project","style":{"typography":{"fontSize":"var:preset|font-size|sm"}}} /-->
                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

        <!-- /wp:post-template -->

        <!-- wp:query-no-results -->
            <!-- wp:paragraph {"align":"center"} -->
            <p class="has-text-align-center">No portfolio items found. Add some portfolio posts to showcase your work.</p>
            <!-- /wp:paragraph -->
        <!-- /wp:query-no-results -->

    </div>
    <!-- /wp:query -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|2xl"}}}} -->
    <div class="wp-block-buttons">
        <!-- wp:button {"className":"is-style-outline","style":{"border":{"radius":"6px","color":"var:preset|color|primary","width":"2px"},"color":{"text":"var:preset|color|primary"},"typography":{"fontWeight":"600"}}} -->
        <div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-primary-color has-text-color wp-element-button" href="/portfolio" style="border-radius:6px;border-width:2px;border-color:var(--wp--preset--color--primary);font-weight:600">View All Projects</a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->

</div>
<!-- /wp:group -->
