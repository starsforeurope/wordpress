<?php
/**
 * Title: Contact
 * Slug: gutentools/contact
 * Categories: gutentools
 * Keywords: contact
 * Block Types: core/post-content
 * Post Types: page, wp_template
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"right":"20px","left":"20px","top":"100px","bottom":"100px"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"tertiary","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-tertiary-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:100px;padding-right:20px;padding-bottom:100px;padding-left:20px"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"className":"contact-form","layout":{"type":"constrained"}} -->
<div class="wp-block-group contact-form"><!-- wp:heading {"style":{"layout":{"selfStretch":"fixed","flexSize":"500px"}}} -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Contact Us', 'gutentools' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|10"}}}} -->
<p style="padding-bottom:var(--wp--preset--spacing--10)"><?php echo esc_html__( 'We are glad that you want to get in touch with us. If you have any questions comments or feedbacks please fill free to contact.', 'gutentools' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo esc_html__( 'Add Yours From Shortcode', 'gutentools' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() );?>/assets/images/faq.jpg","id":759,"dimRatio":0,"customOverlayColor":"#7c6a52","isUserOverlayColor":true,"minHeight":650,"minHeightUnit":"px","isDark":false,"style":{"border":{"radius":"10px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light" style="border-radius:10px;min-height:650px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim" style="background-color:#7c6a52"></span><img class="wp-block-cover__image-background wp-image-759" alt="" src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/faq.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size"></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->