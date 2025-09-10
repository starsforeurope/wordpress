<?php 
	$gradiant_hs_breadcrumb			= get_theme_mod('hs_breadcrumb','1');
	$gradiant_bread_effect_enable	= get_theme_mod('breadcrumb_effect_enable','1');
	
if($gradiant_hs_breadcrumb == '1') {	
?>
<section id="breadcrumb-section" class="breadcrumb-area breadcrumb-left <?php if($gradiant_bread_effect_enable=='1'): echo esc_attr_e('breadcrumb-effect-active','gradiant'); endif; ?>">
	<div class="av-container">
		<div class="av-columns-area">
			<div class="av-column-12">
				<div class="breadcrumb-content">
					<div class="breadcrumb-heading wow fadeInLeft">
						<h2>
							<?php 
								if ( is_home() || is_front_page()):
								single_post_title();
						
							elseif ( is_day() ) :
							
								printf( __( 'Daily Archives: %s', 'mega-mart' ), get_the_date() );
							
							elseif ( is_month() ) :
							
								printf( __( 'Monthly Archives: %s', 'mega-mart' ), (get_the_date( 'F Y' ) ));
								
							elseif ( is_year() ) :
							
								printf( __( 'Yearly Archives: %s', 'mega-mart' ), (get_the_date( 'Y' ) ) );
								
							elseif ( is_category() ) :
							
								printf( __( 'Category Archives: %s', 'mega-mart' ), (single_cat_title( '', false ) ));
							elseif ( is_tag() ) :
							
								printf( __( 'Tag Archives: %s', 'mega-mart' ), (single_tag_title( '', false ) ));
								
							elseif ( is_404() ) :
								printf( __( 'Error 404', 'mega-mart' ));
								
							elseif ( is_author() ) :
							
								printf( __( 'Author: %s', 'mega-mart' ), (get_the_author( '', false ) ));		
							
							elseif ( is_tax( 'portfolio_categories' ) ) :
								printf( __( 'Portfolio Categories: %s', 'mega-mart' ), (single_term_title( '', false ) ));	
								
							elseif ( is_tax( 'pricing_categories' ) ) :
								printf( __( 'Pricing Categories: %s', 'mega-mart' ), (single_term_title( '', false ) ));	
								
							elseif ( class_exists( 'woocommerce' ) ) :
								
								if ( is_shop() ) {
									woocommerce_page_title();
								}
								
								elseif ( is_cart() ) {
									the_title();
								}
								
								elseif ( is_checkout() ) {
									the_title();
								}
								
								elseif ( is_product_category() ) {
									$term = get_queried_object();
									if ( $term && ! is_wp_error( $term ) ) {
										echo $term->name;
									}
								}
								
								else {
									the_title();
								}
							else :
									the_title();
									
							endif;
									
							?>
						</h2>	
					</div>
					<ol class="breadcrumb-list wow fadeInRight">
						<?php if (function_exists('gradiant_breadcrumbs')) gradiant_breadcrumbs();?>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>	