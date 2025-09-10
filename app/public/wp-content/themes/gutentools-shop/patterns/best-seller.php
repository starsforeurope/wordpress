<?php
/**
 * Title: Best Seller
 * Slug: gutentools-shop/best-seller
 * Categories: gutentools-shop
 * Keywords: best-seller
 * Block Types: core/post-content
 * Post Types: page, wp_template
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"right":"20px","left":"20px","top":"100px","bottom":"100px"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-white-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:100px;padding-right:20px;padding-bottom:100px;padding-left:20px"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"bottom":"60px"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained","contentSize":"800px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-bottom:60px"><!-- wp:paragraph {"align":"center","style":{"color":{"text":"#017a50"},"elements":{"link":{"color":{"text":"#017a50"}}},"typography":{"textTransform":"uppercase"}}} -->
<p class="has-text-align-center has-text-color has-link-color" style="color:#017a50;text-transform:uppercase"><strong><?php echo esc_html__( 'our popular products', 'gutentools-shop' ); ?></strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontSize":"42px","lineHeight":"1.1","fontStyle":"normal","fontWeight":"400","letterSpacing":"2px"}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0;font-size:42px;font-style:normal;font-weight:400;letter-spacing:2px;line-height:1.1"><?php echo esc_html__( 'Best Sellers', 'gutentools-shop' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php echo esc_html__( 'Cras dictum id pharetra suspendisse adipiscing', 'gutentools-shop' ); ?>  </p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":3,"query":{"perPage":4,"pages":0,"offset":0,"postType":"product","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[],"format":[]}} -->
<div class="wp-block-query"><!-- wp:post-template {"layout":{"type":"grid","columnCount":null,"minimumColumnWidth":"16rem"}} -->
<!-- wp:post-featured-image {"isLink":true,"style":{"border":{"radius":{"topLeft":"8px","topRight":"8px","bottomLeft":"0px","bottomRight":"0px"}},"spacing":{"margin":{"top":"0","bottom":"0"}}}} /-->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"18px","bottom":"18px","left":"18px","right":"18px"},"blockGap":"var:preset|spacing|20"},"border":{"radius":{"bottomLeft":"8px","bottomRight":"8px","topRight":"0px","topLeft":"0px"}},"color":{"background":"#f2f6f7"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-left-radius:8px;border-bottom-right-radius:8px;background-color:#f2f6f7;margin-top:0;margin-bottom:0;padding-top:18px;padding-right:18px;padding-bottom:18px;padding-left:18px"><!-- wp:post-terms {"term":"category","textAlign":"center"} /-->

<!-- wp:post-title {"textAlign":"center","isLink":true,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontStyle":"normal","fontWeight":"400"}},"fontSize":"mdm-large"} /-->

<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true,"textAlign":"center","style":{"spacing":{"margin":{"top":"8px","bottom":"0"}}}} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"align":"center","placeholder":"Add text or blocks that will display when a query returns no results."} -->
<p class="has-text-align-center"><?php echo esc_html__( 'No Products Found', 'gutentools-shop' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->