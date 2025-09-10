<?php
/**
 * Title: Header
 * Slug: gutentools-shop/header
 * Categories: header, gutentools-shop
 * Keywords: header
 * Block Types: core/template-part/header
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"12px","bottom":"12px","left":"20px","right":"20px"}},"color":{"background":"#017a50"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="background-color:#017a50;padding-top:12px;padding-right:20px;padding-bottom:12px;padding-left:20px"><!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontSize":"small"} -->
<p class="has-white-color has-text-color has-link-color has-small-font-size"><?php echo esc_html__( 'Free shipping on all orders over $50', 'gutentools-shop' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:social-links {"iconColor":"white","iconColorValue":"#fff","className":"is-style-logos-only"} -->
<ul class="wp-block-social-links has-icon-color is-style-logos-only"><!-- wp:social-link {"url":"#","service":"facebook"} /-->

<!-- wp:social-link {"url":"#","service":"instagram"} /-->

<!-- wp:social-link {"url":"#","service":"twitter"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"tagName":"header","style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"20px","right":"20px"}}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
<header id="sticky-header" class="wp-block-group has-white-background-color has-background" style="padding-top:24px;padding-right:20px;padding-bottom:24px;padding-left:20px"><!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:site-title {"style":{"typography":{"fontSize":"32px"}}} /--></div>
<!-- /wp:group -->

<!-- wp:navigation {"textColor":"black","icon":"menu","overlayBackgroundColor":"white-text-color","overlayTextColor":"black","metadata":{"ignoredHookedBlocks":["woocommerce/customer-account","woocommerce/mini-cart"]},"style":{"spacing":{"blockGap":"40px"},"typography":{"fontStyle":"normal","fontWeight":"600"}}} /-->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:woocommerce/mini-cart {"hasHiddenPrice":false} /-->

<!-- wp:search {"label":"Search","showLabel":false,"placeholder":"Search products…","buttonText":"Search","buttonPosition":"button-only","buttonUseIcon":true,"query":{"post_type":"product"},"isSearchFieldHidden":true,"namespace":"woocommerce/product-search"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></header>
<!-- /wp:group -->