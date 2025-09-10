<?php
/**
 * Title: Featured Banner
 * Slug: gutentools-shop/banner
 * Categories: gutentools-shop
 * Keywords: banner
 * Block Types: core/post-content
 * Post Types: page, wp_template
 */
?>
<!-- wp:cover {"url":"<?php echo esc_url( get_stylesheet_directory_uri() );?>/assets/images/banner.jpg","id":1376,"dimRatio":20,"customOverlayColor":"#edf5fd","isUserOverlayColor":true,"minHeight":650,"contentPosition":"center center","isDark":false,"sizeSlug":"full","metadata":{"name":"Banner"},"style":{"spacing":{"padding":{"top":"80px","bottom":"80px","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
<div class="wp-block-cover is-light" style="margin-top:0;margin-bottom:0;padding-top:80px;padding-right:0;padding-bottom:80px;padding-left:0;min-height:650px"><img class="wp-block-cover__image-background wp-image-1376 size-full" alt="" src="<?php echo esc_url( get_stylesheet_directory_uri() );?>/assets/images/banner.jpg" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-20 has-background-dim" style="background-color:#edf5fd"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"0"}}},"layout":{"type":"constrained","contentSize":"","justifyContent":"center"}} -->
<main class="wp-block-group" style="padding-top:0"><!-- wp:paragraph {"style":{"color":{"text":"#017a50"},"elements":{"link":{"color":{"text":"#017a50"}}}}} -->
<p class="has-text-color has-link-color" style="color:#017a50"><strong><?php echo esc_html__( 'ORDER FROM OUR SUPERMARKET', 'gutentools-shop' ); ?></strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"left","style":{"typography":{"fontSize":"84px","lineHeight":"1"}},"fontFamily":"body"} -->
<h2 class="wp-block-heading has-text-align-left has-body-font-family" style="font-size:84px;line-height:1"><?php echo esc_html__( 'Fresh Fruits And', 'gutentools-shop' ); ?><br><?php echo esc_html__( 'Vegetables', 'gutentools-shop' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained","contentSize":"600px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"left","style":{"typography":{"fontSize":"15px"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}}} -->
<p class="has-text-align-left" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--20);font-size:15px"><?php echo esc_html__( 'Fusce egestas elit eget lorem. Praesent nec nisl a purus blandit viverra. Praesent egestas neque eu enim. In ac felis quis tortor malesuada pretium.', 'gutentools-shop' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"style":{"spacing":{"padding":{"left":"46px","right":"46px"}}}} -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" style="padding-right:46px;padding-left:46px"><?php echo esc_html__( 'Shop Now', 'gutentools-shop' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></main>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->