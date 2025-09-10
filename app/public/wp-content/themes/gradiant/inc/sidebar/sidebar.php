<?php	
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gradiant
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function gradiant_widgets_init() {	
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'gradiant' ),
		'id' => 'gradiant-sidebar-primary',
		'description' => __( 'The Primary Widget Area', 'gradiant' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title"><span></span>',
		'after_title' => '</h5>',
	) );
	

	register_sidebar( array(
		'name' => __( 'Footer 1', 'gradiant' ),
		'id' => 'gradiant-footer-1',
		'description' => __( 'The Footer Widget Area 1', 'gradiant' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer 2', 'gradiant' ),
		'id' => 'gradiant-footer-2',
		'description' => __( 'The Footer Widget Area 2', 'gradiant' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer 3', 'gradiant' ),
		'id' => 'gradiant-footer-3',
		'description' => __( 'The Footer Widget Area 3', 'gradiant' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => __( 'WooCommerce Widget Area', 'gradiant' ),
		'id' => 'gradiant-woocommerce-sidebar',
		'description' => __( 'This Widget area for WooCommerce Widget', 'gradiant' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Info Widget Area', 'gradiant' ),
		'id' => 'gradiant-info-sidebar',
		'description' => __( 'This Widget area for Info', 'gradiant' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
}
add_action( 'widgets_init', 'gradiant_widgets_init' );
?>