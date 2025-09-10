<?php
/**
 * Title: CTA
 * Slug: gutentools-shop/cta
 * Categories: gutentools-shop
 * Keywords: cta
 * Block Types: core/post-content
 * Post Types: page, wp_template
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"right":"20px","left":"20px","top":"100px","bottom":"100px"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-white-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:100px;padding-right:20px;padding-bottom:100px;padding-left:20px"><!-- wp:cover {"url":"<?php echo esc_url( get_stylesheet_directory_uri() );?>/assets/images/cat-1.jpg","id":1376,"dimRatio":10,"overlayColor":"link-color","isUserOverlayColor":true,"minHeight":460,"isDark":false,"sizeSlug":"full","style":{"border":{"radius":"10px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light" style="border-radius:10px;min-height:460px"><img class="wp-block-cover__image-background wp-image-1376 size-full" alt="" src="<?php echo esc_url( get_stylesheet_directory_uri() );?>/assets/images/cat-1.jpg" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-link-color-background-color has-background-dim-10 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","style":{"typography":{"fontSize":"48px"}}} -->
<p class="has-text-align-center" style="font-size:48px"><?php echo esc_html__( 'Get up to 25% Off in all products.', 'gutentools-shop' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Check out what sort of new products have arrived here.', 'gutentools-shop' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30)"><!-- wp:button {"style":{"spacing":{"padding":{"left":"40px","right":"40px"}}}} -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" style="padding-right:40px;padding-left:40px"><?php echo esc_html__( 'Shop Now', 'gutentools-shop' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->