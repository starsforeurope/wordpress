<?php
/**
 * Title: Latest Posts
 * Slug: gutentools/latest-posts
 * Categories: gutentools
 * Keywords: latest-posts
 * Block Types: core/post-content
 * Post Types: page, wp_template
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"right":"20px","left":"20px","top":"100px","bottom":"100px"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"tertiary","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-tertiary-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:100px;padding-right:20px;padding-bottom:100px;padding-left:20px"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"bottom":"60px"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-bottom:60px"><!-- wp:heading {"style":{"layout":{"selfStretch":"fixed","flexSize":"500px"}}} -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Our Latest Blog for Branding', 'gutentools' ); ?> &amp; <?php echo esc_html__( 'Marketing', 'gutentools' ); ?> </h2>
<!-- /wp:heading -->

<!-- wp:buttons {"className":"right-arrow-btn","style":{"spacing":{"padding":{"right":"0","left":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-buttons right-arrow-btn" style="padding-right:0;padding-left:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'See All Post', 'gutentools' ); ?><img class="wp-image-1228" style="width: 18px;" src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/arrow-right-long.png" alt=""></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"grid","columnCount":null,"minimumColumnWidth":"20rem"}} -->
<!-- wp:group {"style":{"border":{"radius":"10px","width":"0px","style":"none"},"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20","right":"var:preset|spacing|20"}}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-white-background-color has-background" style="border-style:none;border-width:0px;border-radius:10px;padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)"><!-- wp:post-featured-image {"isLink":true,"style":{"border":{"radius":"10px"}}} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"0","left":"0","bottom":"0","top":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:post-date /-->

<!-- wp:post-title {"isLink":true,"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"mdm-large"} /-->

<!-- wp:post-excerpt {"moreText":"","excerptLength":16} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->