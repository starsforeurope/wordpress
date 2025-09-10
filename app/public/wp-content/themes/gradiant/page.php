<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gradiant
 */

get_header();
?>
<section id="post-section" class="post-section av-py-default">
	<div class="av-container">
		<div class="av-columns-area">
			
			 <?php 
				if ( class_exists( 'woocommerce' ) ){
						
					if( is_account_page() || is_cart() || is_checkout() ) {
							echo '<div id="av-primary-content" class="av-column-'.( !is_active_sidebar( "gradiant-woocommerce-sidebar" ) ?"12" :"8" ).'">'; 
					}
					else{ 
				
					echo '<div id="av-primary-content" class="av-column-'.( !is_active_sidebar( "gradiant-sidebar-primary" ) ?"12" :"8" ).'">'; 
					
					}
				}
				else
				{ 
					echo '<div id="av-primary-content" class="av-column-'.( !is_active_sidebar( "gradiant-sidebar-primary" ) ?"12" :"8" ).' ">';
				} 			 
					if( have_posts()) :  the_post();
					
					the_content(); 
					endif;
					
					if( $post->comment_status == 'open' ) { 
						 comments_template( '', true ); // show comments 
					}
				?>
			</div>
			<?php 
				//get_sidebar();
				if ( class_exists( 'WooCommerce' ) ) {
					if( is_account_page() || is_cart() || is_checkout() ) {
						get_sidebar('woocommerce');
					}
					else{ 
						get_sidebar();
					}
				}
				else{ 
					get_sidebar();
				}
			?>
		</div>
	</div>
</section>
<?php get_footer(); ?>