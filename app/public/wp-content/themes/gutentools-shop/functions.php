<?php


/**
 * Gutentools Shop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @subpackage Gutentools Shop
 * @since Gutentools Shop 1.0
 */

 function Gutentools_Shop_block_assets(){
    // Enqueue theme stylesheet for the front-end.
    wp_enqueue_style( 'gutentools-style', get_stylesheet_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_script('gutentools-main-script', get_stylesheet_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0.0', true);
}

add_action('enqueue_block_assets', 'Gutentools_Shop_block_assets');

// register own theme pattern

function Gutentools_Shop_register_pattern_category() {

	$patterns = array();

	$block_pattern_categories = array(
		'gutentools-shop' => array( 'label' => __( 'Gutentools Shop', 'gutentools-shop' ) )
	);

	$block_pattern_categories = apply_filters( 'Gutentools_Shop_block_pattern_categories', $block_pattern_categories );

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}
}

add_action( 'init', 'Gutentools_Shop_register_pattern_category');

//recommend plugins
require get_theme_file_path( '/inc/tgm-plugin/tgmpa-hook.php' );