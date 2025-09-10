<?php
 /**
 * Enqueue scripts and styles.
 */
function gradiant_scripts() {
	
	// Styles	
	wp_enqueue_style('owl-carousel-min',get_template_directory_uri().'/assets/css/owl.carousel.min.css');
	
	wp_enqueue_style('font-awesome',get_template_directory_uri().'/assets/css/fonts/font-awesome/css/font-awesome.min.css');
	
	wp_enqueue_style('gradiant-editor-style',get_template_directory_uri().'/assets/css/editor-style.css');

	wp_enqueue_style('gradiant-default', get_template_directory_uri() . '/assets/css/color/default.css');

	wp_enqueue_style('gradiant-theme-css',get_template_directory_uri().'/assets/css/theme.css');

	wp_enqueue_style('gradiant-meanmenu', get_template_directory_uri() . '/assets/css/meanmenu.css');

	wp_enqueue_style('gradiant-widgets',get_template_directory_uri().'/assets/css/widgets.css');

	wp_enqueue_style('gradiant-main', get_template_directory_uri() . '/assets/css/main.css');
	
	wp_enqueue_style('gradiant-media-query', get_template_directory_uri() . '/assets/css/responsive.css');

	wp_enqueue_style('gradiant-woocommerce',get_template_directory_uri().'/assets/css/woo.css');
	
	wp_enqueue_style( 'gradiant-style', get_stylesheet_uri() );
	
	// Scripts
	wp_enqueue_script( 'jquery' );
	
	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), true);

	wp_enqueue_script('jquery-ripples', get_template_directory_uri() . '/assets/js/jquery.ripples.min.js', array('jquery'),false, true);
	
	wp_enqueue_script('anime-min', get_template_directory_uri() . '/assets/js/anime.min.js', array('jquery'), false, true);
	
	wp_enqueue_script('wow-min', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), false, true);
	
	wp_enqueue_script('mo', get_template_directory_uri() . '/assets/js/mo.min.js', array('jquery'), false, true);
	
	wp_enqueue_script('gradiant-theme', get_template_directory_uri() . '/assets/js/theme.min.js', array('jquery'), false, true);

	wp_enqueue_script('gradiant-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), false, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gradiant_scripts' );

//Admin Enqueue for Admin
function gradiant_admin_enqueue_scripts(){
	wp_enqueue_style('gradiant-admin-style', get_template_directory_uri() . '/assets/css/admin.css');
	wp_enqueue_script( 'gradiant-admin-script', get_template_directory_uri() . '/assets/js/gradiant-admin-script.js', array( 'jquery' ), '', true );
    wp_localize_script( 'gradiant-admin-script', 'gradiant_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
add_action( 'admin_enqueue_scripts', 'gradiant_admin_enqueue_scripts' );
?>