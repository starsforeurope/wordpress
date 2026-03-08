<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Benevolent
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">            
            <div class="error-holder">
				<div class="icon-holder">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/images/img-error.png' ); ?>" alt="<?php esc_attr_e( 'Error 404', 'benevolent' ); ?>" />
                </div>
				<h1><?php esc_html_e( 'Error 404', 'benevolent' ); ?></h1>
				<h2><?php esc_html_e( 'Page Not Found', 'benevolent' ); ?></h2>
				<p><?php esc_html_e( 'This page could not be found on the server.', 'benevolent' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Return to Homepage', 'benevolent' ); ?></a>
			</div>            
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
