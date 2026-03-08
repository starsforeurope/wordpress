<?php
/**
 * Title: CTA
 * Slug: gutentools/cta
 * Categories: gutentools
 * Keywords: cta
 * Block Types: core/post-content
 * Post Types: page, wp_template
 */
?>
<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() );?>/assets/images/services.jpg","id":27,"dimRatio":80,"overlayColor":"black","isUserOverlayColor":true,"minHeight":500,"className":"wow animate__animated animate__fadeIn","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"right":"20px","left":"20px","top":"100px","bottom":"100px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover wow animate__animated animate__fadeIn" style="margin-top:0;margin-bottom:0;padding-top:100px;padding-right:20px;padding-bottom:100px;padding-left:20px;min-height:500px"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-80 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-27" alt="" src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/services.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","style":{"typography":{"lineHeight":"1.2","textTransform":"capitalize"}}} -->
<h2 class="wp-block-heading has-text-align-center" style="line-height:1.2;text-transform:capitalize"><?php echo esc_html__( 'Start Your Journey with Us', 'gutentools' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"banner-subdescription","style":{"spacing":{"padding":{"right":"25%","left":"25%","top":"15px","bottom":"20px"}}},"fontSize":"medium"} -->
<p class="has-text-align-center banner-subdescription has-medium-font-size" style="padding-top:15px;padding-right:25%;padding-bottom:20px;padding-left:25%"><?php echo esc_html__( 'Vitae lectus pellentesque nostra malesuada leo nibh dui pretium himenaeos. Aliquam quisque nunc magna potenti ullamcorper. Blandit metus aliquet luctus imperdiet', 'gutentools' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Start Project', 'gutentools' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->