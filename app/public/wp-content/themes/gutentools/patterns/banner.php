<?php
/**
 * Title: Featured Banner
 * Slug: gutentools/banner
 * Categories: gutentools
 * Keywords: banner
 * Block Types: core/post-content
 * Post Types: page, wp_template
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"right":"20px","left":"20px","top":"0","bottom":"100px"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:20px;padding-bottom:100px;padding-left:20px"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"right":"20px","left":"20px","top":"60px","bottom":"60px"}}},"layout":{"type":"constrained","contentSize":"900px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:60px;padding-right:20px;padding-bottom:60px;padding-left:20px"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"72px"}}} -->
<h1 class="wp-block-heading has-text-align-center" style="font-size:72px"><?php echo esc_html__( 'Innovative Solutions For Your Brands', 'gutentools' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"40px"}}}} -->
<p class="has-text-align-center" style="margin-top:40px"><?php echo esc_html__( 'Felis ridiculus viverra phasellus dictum curae vitae purus dictumst eu imperdiet iaculis fringilla sapien ultricies aptent velit diam ultrices eget conubia turpis sociosqu convallis mattis si quam fusce ipsum natoque', 'gutentools' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() );?>/assets/images/banner.jpg","id":1182,"dimRatio":0,"isUserOverlayColor":true,"minHeight":600,"isDark":false,"className":"hoverImageWrapper","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"border":{"radius":"20px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light hoverImageWrapper" style="border-radius:20px;margin-top:0;margin-bottom:0;min-height:600px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-1182" alt="" src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/banner.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size"></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->