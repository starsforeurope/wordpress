<?php
/**
 * Title: Latest News
 * Slug: wildfern/latest-news
 * Categories: wildfern, latest-news
 */
?>

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"60px","bottom":"60px","left":"20px","right":"20px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:60px;padding-right:20px;padding-bottom:60px;padding-left:20px"><!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"padding":{"top":"5px","bottom":"5px","left":"20px","right":"20px"}},"border":{"radius":"60px"}},"backgroundColor":"primary","layout":{"type":"default"}} -->
<div class="wp-block-group has-primary-background-color has-background" style="border-radius:60px;padding-top:5px;padding-right:20px;padding-bottom:5px;padding-left:20px"><!-- wp:heading {"level":4,"style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"typography":{"textTransform":"uppercase","letterSpacing":"1px"}},"textColor":"white","fontSize":"body-text"} -->
<h4 class="wp-block-heading has-white-color has-text-color has-link-color has-body-text-font-size" style="letter-spacing:1px;text-transform:uppercase"><?php esc_html_e('Latest Blog!','wildfern'); ?></h4>
<!-- /wp:heading --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"fontSize":"section-title"} -->
<h2 class="wp-block-heading has-section-title-font-size" style="margin-top:var(--wp--preset--spacing--30);font-style:normal;font-weight:700"><?php esc_html_e('Latest News & Articles','wildfern'); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e('Suspendisse ut interdum libero. Aenean convallis blandit ante, a consectetur tortor hendrerit ac. Interdum et','wildfern'); ?><br><?php esc_html_e('malesuada fames ac ante ipsum primis in faucibus. Curabitur ut laoreet odio, eget ornare tellus.','wildfern'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:spacer {"height":"20px"} -->
<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:query {"queryId":35,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false},"metadata":{"categories":["posts"],"patternName":"core/query-standard-posts","name":"Standard"}} -->
<div class="wp-block-query"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
<!-- wp:group {"className":"shadow","style":{"border":{"radius":"32px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group shadow" style="border-radius:32px"><!-- wp:group {"className":"pos-relative","layout":{"type":"constrained"}} -->
<div class="wp-block-group pos-relative"><!-- wp:post-featured-image {"isLink":true,"align":"wide","style":{"border":{"radius":{"topLeft":"12px","topRight":"12px"}}}} /-->

<!-- wp:group {"className":"ln-post-date","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group ln-post-date" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"padding":{"top":"5px","bottom":"5px","left":"15px","right":"15px"}},"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"border":{"radius":"60px"},"typography":{"letterSpacing":"0.5px"}},"backgroundColor":"primary","textColor":"white","fontSize":"small","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-white-color has-primary-background-color has-text-color has-background has-link-color has-small-font-size" style="border-radius:60px;padding-top:5px;padding-right:15px;padding-bottom:5px;padding-left:15px;letter-spacing:0.5px"><!-- wp:post-date {"textAlign":"center","format":"j","style":{"typography":{"fontSize":"24px","fontStyle":"normal","fontWeight":"700"}}} /-->

<!-- wp:post-date {"textAlign":"center","format":"M","style":{"spacing":{"margin":{"top":"0"}},"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600"}},"fontSize":"body-text"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"1.8rem","bottom":"1.8rem","left":"1.8rem","right":"1.8rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:1.8rem;padding-right:1.8rem;padding-bottom:1.8rem;padding-left:1.8rem"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group"><!-- wp:post-terms {"term":"category"} /-->

<!-- wp:post-author {"showAvatar":false,"isLink":true} /--></div>
<!-- /wp:group -->

<!-- wp:post-title {"isLink":true,"style":{"typography":{"fontSize":"20px","letterSpacing":"1px","lineHeight":"1.4","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} /-->

<!-- wp:post-excerpt {"excerptLength":16,"style":{"typography":{"lineHeight":"1.8"}}} /-->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"style":{"border":{"radius":"50px"},"spacing":{"padding":{"left":"18px","right":"18px","top":"8px","bottom":"8px"}},"typography":{"fontStyle":"normal","fontWeight":"500","textTransform":"uppercase","letterSpacing":"1px"}},"fontSize":"small"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-small-font-size has-custom-font-size wp-element-button" style="border-radius:50px;padding-top:8px;padding-right:18px;padding-bottom:8px;padding-left:18px;font-style:normal;font-weight:500;letter-spacing:1px;text-transform:uppercase"><?php esc_html_e('Read More','wildfern'); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->