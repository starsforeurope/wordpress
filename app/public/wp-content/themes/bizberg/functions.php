<?php
/**
 * Bizberg functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bizberg
 */

if ( ! function_exists( 'bizberg_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bizberg_setup() {

	    load_theme_textdomain( 'bizberg', get_template_directory() . '/languages' );
		
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );
		
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_post_type_support( 'page', 'excerpt' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-formats' , array( 'aside', 'gallery' , 'standard', 'link', 'image' , 'quote', 'status', 'video', 'audio' , 'chat' ));

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'bizberg' ),
			'footer' => esc_html__( 'Footer', 'bizberg' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'flex-width'  => true,
			'flex-height' => true,
			'height'      => '300',
 			'width'       => '500'
		) );

		add_image_size( 'bizberg_medium', 300, 300, true );
		add_image_size( 'bizberg_gallery', 500, 400, true );
		add_image_size( 'bizberg_blog_list', 368, 240, true );
		add_image_size( 'bizberg_detail_image', 825, 400, true );
		add_image_size( 'bizberg_detail_image_no_sidebar', 920, 400, true );
		add_image_size( 'bizberg_portfolio_homepage', 600, 400, true );
		add_image_size( 'bizberg_blog_list_no_sidebar_1', 220, 190, true );
	}
endif;
add_action( 'after_setup_theme', 'bizberg_setup' );

add_filter( 'elegant_blocks_bootstrap', 'bizberg_bootstrap' );
function bizberg_bootstrap(){
	return true;
}

add_filter( 'elegant_blocks_fontawesome', 'bizberg_fontawesome' );
function bizberg_fontawesome(){
	return true;
}


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bizberg_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bizberg_content_width', 640 );
}
add_action( 'after_setup_theme', 'bizberg_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bizberg_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bizberg' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'bizberg' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Right Header', 'bizberg' ),
		'id'            => 'bizberg_header',
		'description'   => esc_html__( 'Add widgets here.', 'bizberg' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Left Header', 'bizberg' ),
		'id'            => 'bizberg_header_left',
		'description'   => esc_html__( 'Add widgets here.', 'bizberg' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'bizberg_widgets_init' );

/**
 * Enqueue scripts and styles backend.
 */

add_action( 'admin_enqueue_scripts', 'bizberg_custom_wp_admin_style' );
function bizberg_custom_wp_admin_style() {
    wp_enqueue_style( 'font-awesome-5', get_template_directory_uri() . '/assets/icons/font-awesome-5/css/all.css' );
    wp_enqueue_script( 'bizberg-install-recommended-plugins', get_template_directory_uri() . '/inc/install-recommended-plugins/admin.js', array( 'jquery' ), false, false );
}

function bizberg_google_fonts(){

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	$query_args = array(
   		'family' => 'Lato:wght@300;400;700;900&display=swap'
 	);

 	wp_register_style( 
   		'bizberg-google-fonts', 
   		wptt_get_webfont_url( add_query_arg( $query_args, 'https://fonts.googleapis.com/css2' ) ),
   		array(),
   		null 
 	);
 	
 	wp_enqueue_style( 'bizberg-google-fonts' );

}

/**
 * Enqueue scripts and styles.
 */
function bizberg_scripts() {

	$my_theme = wp_get_theme();
	$current_version = $my_theme->get( 'Version' ); // Get theme Current Version

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', array(), $current_version );
	wp_enqueue_style( 'font-awesome-5', get_template_directory_uri() . '/assets/icons/font-awesome-5/css/all.css', array(), $current_version );
	wp_enqueue_style( 'bizberg-main', get_template_directory_uri() . '/assets/css/main.css', array(), $current_version );
	wp_enqueue_style( 'bizberg-component', get_template_directory_uri() . '/assets/css/component.css', array(), $current_version );

	wp_enqueue_style( 'bizberg-style2', get_template_directory_uri() . '/assets/css/style.css' , array(), $current_version);
	wp_enqueue_style( 'bizberg-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), $current_version );
	wp_enqueue_style( 'bizberg-style', get_stylesheet_uri() );

	bizberg_google_fonts();

	$scripts = array(
		array(
			'id' => 'bootstrap',
			'url' => get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js',
			'footer' => false
		),
		array(
			'id' => 'mousescroll',
			'url' => get_template_directory_uri() . '/assets/js/jquery.mousewheel.min.js',
			'footer' => true
		),
		array(
			'id' => 'inview',
			'url' => get_template_directory_uri() . '/assets/js/jquery.inview.min.js',
			'footer' => true
		),
		array(
			'id' => 'slicknav',
			'url' => get_template_directory_uri() . '/assets/js/jquery.slicknav.min.js',
			'footer' => true
		),
		array(
			'id' => 'matchHeight',
			'url' => get_template_directory_uri() . '/assets/js/jquery.matchHeight-min.js',
			'footer' => true
		),
		array(
			'id' => 'swiper',
			'url' => get_template_directory_uri() . '/assets/js/swiper.js',
			'footer' => true
		),
		array(
			'id' => 'prognroll',
			'url' => get_template_directory_uri() . '/assets/js/prognroll.js',
			'footer' => true
		),
		array(
			'id' => 'theia-sticky-sidebar',
			'url' => get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.js',
			'footer' => true
		),
	);

	wp_enqueue_script('masonry');

	/** 
	* @since 4.1.6
	* If true then enqueue slick slider js
	* This is for the child theme. In child theme there are sliders that uses slick 
	*/

	if( apply_filters( 'bizberg_slick_slider_status', false ) ){
		wp_enqueue_script( 'slick' , get_template_directory_uri() . '/assets/js/slick.js' , array('jquery') , $current_version , true );
	}

	bizberg_add_scripts( $scripts , $current_version );

	wp_register_script( 'bizberg-custom' , get_template_directory_uri() . '/assets/js/custom.js' , array('jquery') , $current_version , true );

	$translation_array = array(
	   'admin_bar_status' => is_admin_bar_showing(),
	   'slider_loop' => bizberg_get_theme_mod( 'slider_loop_status' ),
	   'slider_speed' => bizberg_get_theme_mod( 'slider_speed' ),
	   'autoplay_delay' => bizberg_get_theme_mod( 'autoplay_delay' ),
	   'slider_grab_n_slider' => bizberg_get_theme_mod( 'slider_grab_n_slider' ),
	   'header_menu_color_hover' => bizberg_check_transparent_header() ? bizberg_get_theme_mod( 'transparent_header_menu_color_hover' ) : bizberg_get_theme_mod( 'header_menu_color_hover' ),
	   'header_menu_color_hover_sticky' => bizberg_get_theme_mod( 'header_menu_color_hover_sticky_menu' ),
	   'is_transparent_header' => bizberg_check_transparent_header() ? 'true' : 'false',
	   'primary_header_layout' => bizberg_get_theme_mod( 'primary_header_layout' ),
	   'slide_in_animation' => bizberg_get_theme_mod( 'header_menu_slide_in_animation' ),
	   'sticky_header_status' => apply_filters( 'bizberg_sticky_header_status', 'true' ),
	   'sticky_sidebar_margin_top_status' => apply_filters( 'bizberg_sticky_sidebar_margin_top_status', 110 ),
	   'sticky_sidebar_margin_bottom_status' => apply_filters( 'bizberg_sticky_sidebar_margin_bottom_status', 10 ),
	   'sticky_sidebar_status' => bizberg_get_theme_mod( 'sticky_content_sidebar' ),
	   'rtl' => is_rtl() ? true : false
	);
	wp_localize_script( 'bizberg-custom', 'bizberg_object', apply_filters( 'bizberg_localize_scripts', $translation_array ) );
	 
	// Enqueued script with localized data.
	wp_enqueue_script( 'bizberg-custom' );

    wp_add_inline_style( 'bizberg-style', bizberg_inline_style() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function bizberg_check_transparent_header(){

	if( bizberg_get_theme_mod( 'transparent_header_homepage' ) && ( is_home() || is_front_page() ) ){
		return true;
	}

	$pages = bizberg_get_transparent_header_page_ids();

	if( empty( $pages ) ){
		return false;
	}

	if( is_page( $pages ) ){
		return true;
	}

	return false;

}

add_action( 'wp_enqueue_scripts', 'bizberg_scripts' );

function bizberg_inline_style(){

	$detail_page_img_position = get_theme_mod( 'detail_page_img_position' , 'left' );
	$slider_banner_status = bizberg_get_theme_mod( 'slider_banner' );
	$inner_page_background_type = bizberg_set_inner_page_background_type();

	// Gradient Slider
	$slider_primary_color = bizberg_get_theme_mod( 'slider_gradient_primary_color' );
	$slider_gradient_secondary_color = bizberg_get_theme_mod( 'slider_gradient_secondary_color' );

	// Banner Text Position
	$banner_text_position = bizberg_get_theme_mod( 'banner_text_position' );

	// Homepage Banner Overlay Color
   	$banner_opacity_primary_color = bizberg_get_theme_mod( 'banner_opacity_primary_color' );
   	$banner_opacity_secondary_color = bizberg_get_theme_mod( 'banner_opacity_secondary_color' );

   	// Inner Page Banner Overlay Color
   	$inner_pages_banner_opacity_primary_color = bizberg_get_theme_mod( 'inner_pages_banner_opacity_primary_color' );
   	$inner_pages_banner_opacity_secondary_color = bizberg_get_theme_mod( 'inner_pages_banner_opacity_secondary_color' );

	// Banner Spacing
	$banner_spacing = bizberg_get_theme_mod( 'banner_spacing' );

	// Arrow Style
	$arrow_style = bizberg_get_theme_mod( 'arrow_style' );

	// Background Image and Color
	$body_background_image = bizberg_get_theme_mod( 'body_background_image' );

	// Header Background Image and Color
	$header_background_image = bizberg_get_theme_mod( 'header_background_image' );

	// Top Bar Background Colors
	$top_bar_background_1 = bizberg_get_theme_mod( 'top_bar_background_1' );
	$top_bar_background_2 = bizberg_get_theme_mod( 'top_bar_background_2' );

	// Navbar Background Colors
	$header_navbar_background_1 = bizberg_get_theme_mod( 'header_navbar_background_1' );
	$header_navbar_background_2 = bizberg_get_theme_mod( 'header_navbar_background_2' );

	// Navbar Background Colors Sticky Header
	$header_navbar_background_1_sticky_menu = bizberg_get_theme_mod( 'header_navbar_background_1_sticky_menu' );
	$header_navbar_background_2_sticky_menu = bizberg_get_theme_mod( 'header_navbar_background_2_sticky_menu' );

	// Read More Button Colors
	$read_more_background_color = bizberg_get_theme_mod( 'read_more_background_color' );
	$read_more_background_color_2 = bizberg_get_theme_mod( 'read_more_background_color_2' );

	$inline_css = '';
	if( $detail_page_img_position == 'center' ){
		$inline_css .= "
        .detail-content.single_page img {
			display: block;
			margin-left: auto;
			margin-right: auto;
			text-align: center;
		}";
	}

	if( $slider_banner_status == 'none' ){
		$inline_css .= 'body.home header#masthead {
		    border-bottom: 1px solid #eee;
		}';
	}

	if( $inner_page_background_type == 'none' ){
		$inline_css .= 'body:not(.home) header#masthead {
		    border-bottom: 1px solid #eee;
		}';
	}

	$inline_css .= '.banner .slider .overlay {
	   background: linear-gradient(-90deg, ' . esc_attr( $slider_primary_color ) . ', ' . esc_attr( $slider_gradient_secondary_color ) . ');
	}';

	$banner_spacing_attr = array();
	foreach ( $banner_spacing as $key => $value ) {
		$banner_spacing_attr[] = $key . ':' . $value;
	}

	$inline_css .= '.breadcrumb-wrapper .section-title{ text-align:' . esc_attr( $banner_text_position ) . ';' . implode( '; ', $banner_spacing_attr ) . ' }';

	$inline_css .= 'body.home .breadcrumb-wrapper.homepage_banner .overlay {
	  	background: linear-gradient(-90deg, ' . esc_attr( $banner_opacity_primary_color ) . ', ' . esc_attr( $banner_opacity_secondary_color ) . ');
	}';

	$inline_css .= 'body:not(.home) .breadcrumb-wrapper .overlay {
	  	background: linear-gradient(-90deg, ' . esc_attr( $inner_pages_banner_opacity_primary_color ) . ', ' . esc_attr( $inner_pages_banner_opacity_secondary_color ) . ');
	}';

	$inline_css .= bizberg_arrow_style_slider( $arrow_style );

	$inline_css .= bizberg_theme_background_image( $body_background_image, $placement = 'body' );

	$inline_css .= bizberg_theme_background_image( $header_background_image, $placement = '.primary_header_2_wrapper' );

	$inline_css .= bizberg_theme_get_gradient_color( $top_bar_background_1, $top_bar_background_2 , 'body:not(.page-template-page-fullwidth-transparent-header) header#masthead #top-bar' );

	$inline_css .= bizberg_theme_get_gradient_color( $header_navbar_background_1, $header_navbar_background_2 , '.navbar-default' );

	$inline_css .= bizberg_theme_get_gradient_color( $header_navbar_background_1_sticky_menu, $header_navbar_background_2_sticky_menu, '.navbar.sticky' );

	$inline_css .= bizberg_theme_get_gradient_color( $read_more_background_color, $read_more_background_color_2, 'a.slider_btn' );

	return apply_filters( 'bizberg_inline_style', $inline_css );

} 

function bizberg_theme_get_gradient_color( $color_1, $color_2, $selector ){

	return "$selector { background: $color_1;
    background: -moz-linear-gradient(90deg, $color_1 0%, $color_2 100%);
    background: -webkit-linear-gradient(90deg, $color_1 0%, $color_2 100%);
    background: linear-gradient(90deg, $color_1 0%, $color_2 100%);
    filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='$color_1', endColorstr='$color_1', GradientType=1); }";

}

function bizberg_theme_background_image( $body_background_image, $placement ){

	$color = !empty( $body_background_image['background-color'] ) ? $body_background_image['background-color'] : 'rgba(255,255,255,0)';
	$image = !empty( $body_background_image['background-image'] ) ? $body_background_image['background-image'] : '';
	$background_repeat = !empty( $body_background_image['background-repeat'] ) ? $body_background_image['background-repeat'] : '';
	$background_position = !empty( $body_background_image['background-position'] ) ? $body_background_image['background-position'] : '';
	$background_size = !empty( $body_background_image['background-size'] ) ? $body_background_image['background-size'] : '';
	$background_attachment = !empty( $body_background_image['background-attachment'] ) ? $body_background_image['background-attachment'] : '';

	return "$placement{ background-image: linear-gradient(to right," . $color . "," . $color . "),url( ". $image ." ); 
	background-repeat : " . $background_repeat . ";" . "
	background-position : " . $background_position . ";" . "
	background-size : " . $background_size . ";" . "
	background-attachment : " . $background_attachment . ";}";
}

function bizberg_arrow_style_slider( $arrow_style ){

	switch ( $arrow_style ) {

		case 'square':
			return '.banner .slider .swiper-button-next, .banner .slider .swiper-button-prev { border-radius: 0px; }';
			break;

		case 'diamond':
			return '.banner .slider .swiper-button-next, .banner .slider .swiper-button-prev { border-radius: 0px; transform: rotate(45deg); } .banner .slider .swiper-button-next:after, .banner .slider .swiper-button-prev:after{ transform: rotate(-45deg); }';
			break;
		
		default:
			# code...
			break;
	}

}

function bizberg_add_scripts( $scripts, $current_version ){

	foreach ( $scripts as $key => $value ) {

		wp_enqueue_script( 
			$value['id'], 
			$value['url'], 
			array( 'jquery' ), 
			$current_version, 
			$value['footer'] 
		);

	}

}

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * WP Comment Walker
 */
require get_template_directory() . '/wp-comment-walker.php';

/**
 * Walker Nav Menu
 */
require get_template_directory() . '/wp-menu-walker.php';

require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

require get_template_directory() . '/inc/fontawesome-5-icons.php';

require get_template_directory() . '/inc/plugins/kirki/kirki.php';

require get_template_directory() . '/inc/plugins/advanced-kirki/index.php';

require get_template_directory() . '/inc/install-recommended-plugins/index.php';

/**
 * Extend Kirki
 */

require get_template_directory() . '/inc/plugins/kirki-fontawesome-6-icons-control/index.php';
require get_template_directory() . '/inc/plugins/kirki-simple-color/index.php';
require get_template_directory() . '/inc/plugins/kirki-advanced-repeater/index.php';
require get_template_directory() . '/inc/plugins/kirki-simple-gradient/index.php';

if( class_exists( 'WooCommerce' ) ){
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
* Displays the author name
*/

function bizberg_get_display_name( $post ){
	
	$user_id = $post->post_author;
	if( empty( $user_id ) ){
		return;
	}

	$user_info = get_userdata( $user_id );
	echo esc_html( $user_info->display_name );
}

function bizberg_post_categories( $post , $limit = false , $plain_text = false , $echo = true ){
	
	$post_categories = wp_get_post_categories( $post->ID );
	$cats = array();

	foreach($post_categories as $key =>  $c){

		if( $key === $limit ){
			break;
		}

	    $cat = get_category( $c );
	    if( $plain_text == true ){
	    	$cats[] = esc_html( $cat->name );
	    } else {
	    	if( $limit == 1 ){
	    		$cats[] = '<a href="' . esc_url( get_category_link( $cat ) ) . '"><i class="far fa-folder"></i> ' . esc_html( $cat->name ) . '</a>';	
	    	} else {
	    		$cats[] = '<a href="' . esc_url( get_category_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a>';	 
	    	}	    	
	    }   
	}
	
	if( empty( $cats ) ){
		return false;
	} else{
		if( $echo == true ){
			echo wp_kses_post( implode( ' , ' , $cats ) );	
		} else{			
			return implode( ' , ' , $cats );			
		}
	
	}
	
}

function bizberg_numbered_pagination(){

	if( !paginate_links() ){
		return;
	}

	echo '<div class="result-paging-wrapper">';
	the_posts_pagination( 
		array(
			'mid_size' 	=> 1,
			'prev_text' => esc_html__( '&laquo;', 'bizberg' ),
			'next_text' => esc_html__( '&raquo;', 'bizberg' ),
		) 
	);
	echo '</div>';

}

if( !function_exists( 'bizberg_get_custom_logo_link' ) ){

	function bizberg_get_custom_logo_link(){

		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

		if ( has_custom_logo() ) {
	        return $logo[0];
		} 

		return;       

	}

}

function bizberg_get_slider_title_design( $title ){

	$slider_title_layout = bizberg_get_theme_mod( 'slider_title_layout' );
	$slider_text_align = bizberg_get_theme_mod( 'slider_text_align' );

	switch ( $slider_title_layout ) {
		case '2':
			return '<h1 class="slider_title_layout_' . $slider_title_layout . ' ' . $slider_text_align . '">' . esc_html( $title ) . '</h1>';
			break;

		case '3':
			$title = explode( " ", $title );
			return '<h1 class="slider_title_layout_' . $slider_title_layout . ' ' . $slider_text_align . '">' .  '<span class="firstword">'.$title[0].'</span>'.substr(implode(" ", $title), strlen($title[0])) . '</h1>';
			break;

		case '4':
			$title = explode( " ", $title );
			$last_space_position = strrpos( implode(" ", $title) , ' ' );
			return '<h1 class="slider_title_layout_' . $slider_title_layout . ' ' . $slider_text_align . '">' . substr( implode(" ", $title) , 0, $last_space_position ) . ' <span class="lastword">'. array_pop( $title ) .'</span>' . '</h1>';
			break;
		
		default:
			return '<h1>' . esc_html( $title ) . '</h1>';
			break;
	}

}

function bizberg_get_all_pages(){

	$args = array(
		'post_type' => 'page',
		'posts_per_page' => -1,
		'post_status' => 'publish',
	);

	$page_query = new WP_Query( $args );
	$pages = array();
	$pages[0] = esc_html__( 'None' , 'bizberg' );

	if( $page_query->have_posts() ):

		while( $page_query->have_posts() ): $page_query->the_post();

			global $post;
			$pages[$post->ID] = get_the_title();

		endwhile;

	endif;

	wp_reset_postdata();

	return $pages;
}

function bizberg_get_slider_page_ids( $data ){
	$page_ids = array();
	foreach ( $data as $key => $value ) {
		$page_ids[] = $value['page_id'];
	}
	return $page_ids;
}

function bizberg_get_read_more_link( $slider_pages ){
	$read_more_links = array();
	foreach ( $slider_pages as $key => $value ) {
		$page_id = $value['page_id'];
		$read_more_link = $value['read_more_link'];
		$read_more_links[$page_id] = $read_more_link;
	}
	return $read_more_links;
}

function bizberg_get_slider_1(){ 

	// Display from slider / pages
	$slider_cat_pages_status = bizberg_get_theme_mod( 'slider_cat_pages' );

	// Get slider pages
	$slider_pages = bizberg_get_theme_mod( 'slider_pages' );
	$slider_pages = is_array( $slider_pages ) ? $slider_pages : json_decode( urldecode( $slider_pages ), true );
	
	$slider_page_ids = bizberg_get_slider_page_ids( $slider_pages );
	$slider_page_ids = array_filter( $slider_page_ids );

	// Get read more link of slider pages
	$read_more_links =  bizberg_get_read_more_link( $slider_pages );
	$read_more_links =  array_filter( $read_more_links );

	$args = array(
		'posts_per_page' => 2,
		'post_status' => 'publish'
	);

	// Include pages
	if( $slider_cat_pages_status == 'page' ){
		$args['post__in'] = empty( $slider_page_ids ) ? array( 'none' ) : $slider_page_ids;
		$args['post_type'] = 'page';
		$args['orderby'] = 'post__in';
	} else {
		// Includes category
		$args['cat'] = bizberg_get_theme_mod( 'slider_category' , '0' );
		$args['post_type'] = 'post';
	}

	$query = new WP_Query( $args );
	$count = 0;

	if( $query->have_posts() ): ?>
	
	    <!-- banner starts -->
	    <section class="banner">

	        <div class="slider">

	            <div dir="<?php echo ( is_rtl() ? 'rtl' : 'ltr' ) ?>" class="swiper-container-bizberg swiper-container">	            	

	                <div class="swiper-wrapper">

	                	<?php 
		            	while( $query->have_posts() ): $query->the_post(); 

		            		global $post;

		            		$thumbnail_id = get_post_thumbnail_id(); 

		            		// If page is selected for slider, check the custom link
		            		$custom_link = '';
		            		if( $slider_cat_pages_status == 'page' && array_key_exists( $post->ID , $read_more_links ) ){
		            			$custom_link = $read_more_links[$post->ID];
		            		} ?>

		                    <div class="swiper-slide">

		                        <div class="slide-inner">

		                           <div class="slide-image" style="background-image:url(<?php echo esc_url( bizberg_get_image_link_by_id( $thumbnail_id , 'full' ) ); ?>)"></div>

		                           	<div class="swiper-content swiper-content-bizberg">
		                                	
	                                		<?php 

	                                		// Display Title
	                                		echo wp_kses_post(
	                                			bizberg_get_slider_title_design( 
	                                				get_the_title() 
	                                			)
	                                		);  

	                                		// Display Content
	                                		if( has_excerpt() ){

	                                			the_excerpt();

	                                		} else {

	                                			echo '<p class="mar-bottom-20">';
		                                		echo wp_trim_words( 
		                                			sanitize_text_field( get_the_content() ), 
		                                			bizberg_get_theme_mod( 'slider_content_length' ), 
		                                			' [...]'
		                                		);
		                                		echo '</p>';

		                                	} 

		                                	// Display Read More Button

		                                	$slider_read_more_status = bizberg_get_theme_mod( 'slider_read_more_status' );
		                                	
		                                	if( !$slider_read_more_status ){ ?>

			                                	<a 
												href="<?php echo esc_url( $custom_link ? $custom_link : get_permalink() ); ?>" 
												class="slider_btn">
													<span class="slider_btn_text_wrapper">
														<?php 
														echo bizberg_get_slider_read_more_btn();
														?>
													</span>
												</a>

			                                	<?php 

			                                } ?>

		                            </div> 
		                            <div class="overlay"></div>
		                        </div> 
		                    </div>

		                 	<?php

		                endwhile;
		                ?>

	                </div>
	                <!-- Add Arrows -->
	                <div class="swiper-button-next"></div>
	                <div class="swiper-button-prev"></div>
	                <div class="swiper-pagination"></div>	            

	            </div>
	            
	        </div>

	        <div class="bizberg_shape_divider_slider_homepage_wrapper">
	        	<?php echo wp_kses_post( bizberg_get_shape_divider() ); ?>
	        </div>
	        
	    </section>
    	<!-- banner ends -->

		<?php

	endif;

	wp_reset_postdata();
}

function bizberg_get_slider_read_more_btn(){
	return esc_html( bizberg_get_theme_mod( 'slider_read_more_text' ) );
}

function bizberg_get_shape_divider(){

	$shape_divider_bottom = bizberg_get_theme_mod('shape_divider_bottom');
	$shape_divider_flip_horizontal = bizberg_get_theme_mod('shape_divider_flip_horizontal');
	$shape_divider_flip_horizontal_class = $shape_divider_flip_horizontal ? 'shape_divider_flip_horizontal' : '';

	if( $shape_divider_bottom != 'none' ){
		
		return '<div class="bizberg_shape_divider_slider_homepage ' . $shape_divider_flip_horizontal_class . ' "><img src="' . esc_url( get_template_directory_uri() . '/assets/images/shape-divider/' . $shape_divider_bottom ) . '" ></div>';

	}

	return '';

}

function bizberg_get_image_link_by_id( $image_id , $size ){
	$image_attributes = wp_get_attachment_image_src( $image_id , $size );
	if( !empty( $image_attributes[0] ) ){
		return $image_attributes[0];
	}
	return;
}

function bizberg_get_all_posts( $post_type = 'post' ){

	$args = array(
		'post_type' => $post_type,
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'orderby' => 'name',
		'order' => 'ASC'
	);

	$query = new WP_Query($args);
	$data = array();

	if( $query->have_posts() ):

		while( $query->have_posts() ): $query->the_post();

			global $post;
			$data[$post->ID] = esc_html( get_the_title() );

		endwhile;

		wp_reset_postdata();

	endif;

	return $data;
}

function bizberg_get_post_categories(){

	$terms = get_terms( array(
	    'taxonomy' => 'category',
	    'hide_empty' => false,
	) );

	if( empty($terms) || !is_array( $terms ) ){
		return array();
	}

	$data = array();
	foreach ( $terms as $key => $value) {
		$term_id = absint( $value->term_id );
		$data[$term_id] =  esc_html( $value->name );
	}
	$data[0] = esc_html__( 'None' , 'bizberg' );
	return $data;

}

function bizberg_sidebar_position(){

	$position =  bizberg_get_theme_mod( 'sidebar_settings' , apply_filters( 'bizberg_sidebar_settings', '1' ) );

	switch ( $position ) {
		case 1:
			return 'blog-rightsidebar';
			break;
		
		case 2:
			return 'blog-leftsidebar';
			break;

		case 3:
			return 'blog-nosidebar';
			break;

		case 5:
			return 'blog-grid-view';
			break;

		case 6:
			return 'blog-list-view';
			break;

		default:
			return 'blog-nosidebar-1';
			break;
	}

}

function bizberg_excerpt_length( $length ) {
	$excerpt_length = bizberg_get_theme_mod( 'excerpt_length' );
	return $excerpt_length;
}
add_filter( 'excerpt_length', 'bizberg_excerpt_length', 999 );

function bizberg_icon( $post_id ){

	$format = get_post_format( $post_id );

	$custom_icon = get_post_meta( $post_id, 'listing_icon', true );

	if( !empty( $custom_icon ) ){
		return $custom_icon;
	}

	switch ( $format ) {
		case 'aside':
			return 'fas fa-file-alt';
			break;

		case 'gallery':
			return 'fas fa-images';
			break;
		
		case 'link':
			return 'fas fa-link';
			break;	

		case 'image':
			return 'fas fa-camera-retro';
			break;	

		case 'quote':
			return 'fas fa-quote-right';
			break;	

		case 'status':
			return 'fas fa-thermometer-three-quarters';
			break;	

		case 'video':
			return 'fas fa-video';
			break;	

		case 'audio':
			return 'fas fa-volume-up';
			break;	

		case 'chat':
			return 'fas fa-comments';
			break;		

		default:
			return 'fas fa-thumbtack';
			break;
	}

}

add_filter( 'get_search_form', 'bizberg_search_form', 100 );
function bizberg_search_form( $form ) {
    $form = '<form role="search" method="get" id="search-form" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
    	<label for="s">
    		<input placeholder="' . esc_attr__( 'Search ...' , 'bizberg' ) . '" type="text" value="' . esc_attr( get_search_query() ) . '" name="s" id="s" class="search-field" />
    		<input class="search-submit" type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' , 'bizberg' ) .'" />
    	</label>    	
    </form>';

    return $form;
}

function bizberg_get_banner_image_properties(){

	$banner_image = bizberg_get_theme_mod( 'banner_image' );

	if( !empty( $banner_image ) && is_array( $banner_image ) ){

		$style = array();
		foreach ( $banner_image as $key => $value ) {

			if( $key == 'background-image' ){
				$style[] = $key  .': url('. $value . ')';
			} else {
				$style[] = $key  .':'. $value;
			}

		}

		return implode( '; ' , $style );
	}

	if( is_string( $banner_image ) ){
		return 'background-image:url(' . $banner_image . ')';
	}

	return false;
	
}

function bizberg_get_video(){

	$video_url = bizberg_get_theme_mod( 'frontpage_video_url' );

	if( empty( $video_url ) ){
		return;
	} ?>

	<div class="bizberg_frontpage_video_wrapper">
		<div class="bizberg_gradient_video"></div>
		<video autoplay muted loop>
		  	<source src="<?php echo esc_url( $video_url ); ?>">
		</video>
	</div>

	<?php

}

function bizberg_get_banner(){ 

	$banner_image_attr = bizberg_get_banner_image_properties(); ?>

	<div 
	class="breadcrumb-wrapper homepage_banner"
	style="<?php echo esc_attr( $banner_image_attr ); ?>">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="section-title">
						<h1 class="banner_title">
							<?php 
							$banner_title = bizberg_get_theme_mod( 'banner_title' );
							echo esc_html( $banner_title ); ?>
						</h1>
						<p class="banner_subtitle">
							<?php 
							$banner_subtitle = bizberg_get_theme_mod( 'banner_subtitle' );
							echo wp_kses_post( nl2br( $banner_subtitle ) ); 
							?> 
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="overlay"></div>
	</div>

	<?php
}

function bizberg_get_banner_title(){
	return esc_html( bizberg_get_theme_mod( 'banner_title' ) );
}

function bizberg_get_banner_subtitle(){
	return wp_kses_post( nl2br( bizberg_get_theme_mod( 'banner_subtitle' ) ) );
}

function bizberg_set_inner_page_background_type(){

	if( class_exists( 'WooCommerce' ) && is_product() ){
		return 'none';
	}

	if( is_search() ){

		$breadcrumb_search_page = bizberg_get_theme_mod( 'breadcrumb_search_page' );
		if( $breadcrumb_search_page ){
			return 'none';
		}

	}

	if( is_archive() ){

		$breadcrumb_archive_page = bizberg_get_theme_mod( 'breadcrumb_archive_page' );
		if( $breadcrumb_archive_page ){
			return 'none';
		}

	}

	if( is_page() ){

		$breadcrumb_single_page = bizberg_get_theme_mod( 'breadcrumb_single_page' );
		if( $breadcrumb_single_page ){
			return 'none';
		}
		
	}

	if( is_single() ){

		$breadcrumb_single_post = bizberg_get_theme_mod( 'breadcrumb_single_post' );
		if( $breadcrumb_single_post ){
			return 'none';
		}
		
	}

	return false;

}

function bizberg_get_breadcrums(){

	$inner_page_background_type = bizberg_set_inner_page_background_type();

	if( $inner_page_background_type == 'none' ){
		return;
	} ?>

	<div 
	class="breadcrumb-wrapper not-home">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="section-title">
						<h1><?php bizberg_get_breadcrum_title(); ?></h1>
						<ol class="breadcrumb">
							<?php bizberg_custom_breadcrumbs(); ?>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="overlay"></div>
	</div>
	<?php
}

function bizberg_get_breadcrum_title(){

	if( is_single() || is_page() ){
		the_title();
	} elseif( is_search() ){
		$search_title = explode( ',' , get_search_query() );
		printf(
			esc_html__( 'Search Results for: %s' , 'bizberg' ),
			esc_html( $search_title[0] )
		);
	} elseif( is_404() ){
		echo esc_html__( 'Error 404' , 'bizberg' );
	} elseif( class_exists( 'WooCommerce' ) && is_shop() ){
		echo esc_html__( 'Shop' , 'bizberg' );
	} else {
		the_archive_title( '', '' );
	}

}

function bizberg_custom_breadcrumbs() {
       
    // Settings
    $separator          = '/';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = esc_html__( 'Home' , 'bizberg' );
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'destinations';
       
    // Get the query & post information
    global $post,$wp_query;

    if( class_exists( 'WooCommerce' ) && ( is_shop() || is_product() ) ){
        // Don't display breadcrumb
    } elseif ( !is_front_page() ) { // Do not display on the homepage
           
        // Home page
        echo '<li class="item-home cyclone-blog-home"><a class="bread-link bread-home" href="' . esc_url( home_url() ) . '">' . esc_html( $home_title ) . '</a></li>';
        
        if ( is_single() ) {
              
            // Get post category info
            $category = get_the_category();

            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = array_slice($category, -1);
                $last_category = array_pop( $last_category );
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'. wp_kses_post( $parents ) .'</li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );

                if( !empty( $taxonomy_terms ) && is_array( $taxonomy_terms ) ){

                	$cat_id         = $taxonomy_terms[0]->term_id;
	                $cat_nicename   = $taxonomy_terms[0]->slug;
	                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
	                $cat_name       = $taxonomy_terms[0]->name;

                }
                
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {

                $allowed_html = array(
                	'li' => array(
                		'class' => array()
                	),
                	'a' => array(
                		'href' => array()
                	)
                );

                echo wp_kses( $cat_display , $allowed_html );
                echo '<li class="item-current"><span class="bread-current active">' . esc_html( get_the_title() ) . '</span></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat"><a class="bread-cat" href="' . esc_url( $cat_link ) . '">' . esc_html( $cat_name ) . '</a></li>';

                echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_title() ) . '</span></li>';
              
            } else {
                  
                echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_title() ) . '</span></li>';
                  
            }
              
        } elseif ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><span class="active bread-current bread-cat">' . single_cat_title('', false) . '</span></li>';
               
        } elseif ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                $parents = '';
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent"><a class="bread-parent" href="' . esc_url( get_permalink($ancestor) ) . '">' . esc_html( get_the_title($ancestor) ) . '</a></li>';
                }
                   
                // Display parent pages

                echo wp_kses( 
                	$parents, 
                	array(
                		'li' => array(
                			'class' => array()
                		),
                		'a' => array(
                			'class' => array(),
                			'href' => array(),
                			'title' => array()
                		),
                	)
                );
                   
                // Current page
                echo '<li class="item-current"><span class="active"> ' . esc_html( get_the_title() ) . '</span></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_title() ) . '</span></li>';
                   
            }
               
        } elseif ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current"><span class="active">' . esc_html( $get_term_name ) . '</span></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year"><a class="bread-year" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a></li>';
               
            // Month link
            echo '<li class="item-month"><a class="bread-month" href="' . esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ) . '">' . esc_html( get_the_time('M') ) . '</a></li>';
               
            // Day display
            echo '<li class="item-current"><span class="active bread-current"> ' . esc_html( get_the_time('jS') ) . ' ' . esc_html( get_the_time('M') ) . '</span></li>';
               
        } elseif ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year"><a class="bread-year" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a></li>';
               
            // Month display
            echo '<li class="item-month"><span class="active bread-month">' . esc_html( get_the_time('M') ) . '</span></li>';
               
        } elseif ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_time('Y') ) . ' </span></li>';
               
        } elseif ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );

            /* translators: %s is replaced with "string". It will display the author name */
            echo '<li class="item-current"><span class="active bread-current">' . sprintf( esc_html__( 'Author: %s', 'bizberg' ) , esc_html( $userdata->display_name ) ) . '</span></li>';
           
        } elseif ( is_search() ) {
           
           $search_title = explode( ',' , get_search_query() );

            /* translators: %s is replaced with "string". It will display the search title */
            echo '<li class="item-current"><span class="active bread-current">' . sprintf( esc_html__( 'Search results for: %s' , 'bizberg' ) , esc_html( $search_title[0] ) ) . '</span></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li class="active">' . esc_html__( 'Error 404' , 'bizberg' ) . '</li>';
        } elseif( is_tax() ){

        	$term = get_term_by("slug", get_query_var("term"), get_query_var("taxonomy") );

	        $tmpTerm = $term;
	        $tmpCrumbs = array();
	        while ($tmpTerm->parent > 0){
	            $tmpTerm = get_term($tmpTerm->parent, get_query_var("taxonomy"));
	            $crumb = '<li><a href="' . esc_url( get_term_link($tmpTerm, get_query_var('taxonomy')) ) . '">' . esc_html( $tmpTerm->name ) . '</a></li>';
	            array_push($tmpCrumbs, $crumb);
	        }
	        echo implode('', array_reverse($tmpCrumbs));
	        echo '<li class="item-current item-cat"><span class="active bread-current bread-cat">' . esc_html( $term->name ) . '</span></li>';

        }
                  
    }
       
}

if( !function_exists( 'bizberg_get_copyright_section' ) ){

	function bizberg_get_copyright_section(){

		esc_html_e( 'Copyright &copy;', 'bizberg' ); 
		echo date_i18n( __( 'Y' , 'bizberg' ) ); ?> 
				
		<?php bloginfo( 'name' ); ?>

		<?php 

		esc_html_e( '. All rights reserved. ', 'bizberg' ); 

		echo '<span class="bizberg_copyright_inner">';

		printf( 
			esc_html__( 'Powered %1$s by %2$s', 'bizberg' ), 
			'', 
			'<a href="' . apply_filters( 'bizberg_powered_by_link', 'https://wordpress.org/' )  . '" target="_blank">WordPress</a>' 
		); 

		?>

	    <span class="sep"> &amp; </span>

	    <?php esc_html_e( 'Designed by', 'bizberg' ); ?> 

	    <a href="<?php echo esc_url( 'https://bizbergthemes.com/'); ?>" target="_blank">
	    	<?php esc_html_e( 'Bizberg Themes', 'bizberg' ); ?>
	    </a>

	    <?php

	    echo '</span>';

	}

}

function bizberg_get_comments_number( $post ){

	$no_of_comments = get_comments_number( $post->ID );

	echo '<a href="' . esc_url( get_comments_link() ) . '"><i class="far fa-comments"></i> ';
	echo absint( $no_of_comments );	
	echo '</a>';

}

add_action( 'admin_notices', 'bizberg_admin_notice_demo_data' );
function bizberg_admin_notice_demo_data() {

	// Hide bizberg admin message
	if( !empty( $_GET['status'] ) && $_GET['status'] == 'bizberg_hide_msg' ){
		update_option( 'bizberg_hide_msg', true );
	}

	$status = get_option( 'bizberg_hide_msg' );
	if( $status == true ){
		return;
	} 

	$recommended_plugins = apply_filters( 'bizberg_plugins', $plugins = array() );
	
	if( empty( $recommended_plugins ) ){
		return;
	}

	$my_theme = wp_get_theme();
	$theme_name = $my_theme->get( 'Name' );
	$nonce = wp_create_nonce("bizberg_install_plugins");

	?>

    <div class="theme-info-start notice notice-info" style="display: flex;align-items: center;">

    	<?php 
    	if( apply_filters( 'bizberg_getting_started_screenshot', false ) == true ){ ?>
	    	<div class="theme_screenshot" style="display: contents;">
	    		<img src="<?php echo get_stylesheet_directory_uri() . '/screenshot.jpg'; ?>" style="padding-right: 12px;">
	    	</div>
	    	<?php 
	    } ?>

    	<div class="theme-info-wrapper" style="padding: 20px 20px 20px 5px;">

	        <?php 
	        echo '<strong style="font-size: 20px; padding-bottom: 10px; display: block;">';
	        printf(
	        	esc_html__( 'Thank you for installing %1$s', 'bizberg' ),
	        	$theme_name
	        ); 
	        echo '</strong>';
	        echo '<p>' . esc_html__( "It comes with prebuild templates so that you don't have to build it from the start. Clicking the button below will install all the recommended plugins for this theme." , 'bizberg' ) . '</p>';
	        ?>

	        <div class="button_wrapper_theme" style="margin-top: 20px;">
		        <a 
		        href="javascript:void(0)" 
		        class="button button-primary button-hero bizberg_install_plugins" 
		        data-nonce="<?php echo esc_attr( $nonce ); ?>"
		        data-redirect="<?php echo apply_filters( 'bizberg_required_plugins_redirect_link', esc_url( admin_url( 'themes.php?page=one-click-demo-import' ) ) ); ?>"
		        >
		        <i class="fas fa-sync fa-spin" style="display: none;"></i>
		        <span><?php esc_html_e( 'Get Started', 'bizberg' ) ?></span>
		    	</a>

		        <a 
		        href="<?php echo esc_url( admin_url('/?status=bizberg_hide_msg') ); ?>" 
		        class="button button-default button-hero bizberg_dismiss" ><?php esc_html_e( 'Close', 'bizberg' ) ?></a>
	        </div>

        </div>
        
    </div>

    <style>
    	.theme_screenshot img {
			width: 19%;
		}
    	@media (min-width:1381px) { 
    		.theme_screenshot img {
    			width: 11%;
    		}
    	}    	
    </style>
    
    <?php
}

add_filter( 'bizberg_plugins', function(){

	$plugins = array(
		array(
			'slug' => 'one-click-demo-import/one-click-demo-import.php',
			'zip'  => 'one-click-demo-import'
		),
		array(
			'slug' => 'contact-form-7/wp-contact-form-7.php',
			'zip'  => 'contact-form-7'
		),
		array(
			'slug' => 'elementor/elementor.php',
			'zip'  => 'elementor'
		),
		array(
			'slug' => 'essential-addons-for-elementor-lite/essential_adons_elementor.php',
			'zip'  => 'essential-addons-for-elementor-lite'
		),	
		array(
			'slug' => 'cyclone-demo-importer/index.php',
			'zip'  => 'cyclone-demo-importer'
		)			
	);

	return $plugins;

});

add_action( 'tgmpa_register', 'bizberg_register_required_plugins' );
function bizberg_register_required_plugins() {

	$plugins = array(

		array(
			'name' => esc_html__( 'One Click Demo Import', 'bizberg' ),
			'slug' => 'one-click-demo-import',
			'required'=> false,
		),
		array(
			'name' => esc_html__( 'Contact Form 7', 'bizberg' ),
			'slug' => 'contact-form-7',
			'required'=> false,
		),
		array(
            'name' => esc_html__( 'Elementor Page Builder', 'bizberg' ),
            'slug' => 'elementor',
            'required' => false
        ),
        array(
            'name' => esc_html__( 'Essential Addons for Elementor', 'bizberg' ),
            'slug' => 'essential-addons-for-elementor-lite',
            'required' => false
        ),
        array(
            'name' => esc_html__( 'Cyclone Demo Importer', 'bizberg' ),
            'slug' => 'cyclone-demo-importer',
            'required' => false
        ),

	);

	$plugins = apply_filters( 'bizberg_recommended_plugins', $plugins );

	$config = array(
		'id'           => 'bizberg_tgmpa',         // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => ''                   // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}

function bizberg_get_homepage_style_class(){

	if( is_page_template( 'page-templates/page-fullwidth-transparent-header.php' ) ){
		return 'page-fullwidth-transparent-header theme-sticky';
	} elseif( is_page_template( 'page-templates/page-fullwidth-transparent-header-border.php' ) ){
		return 'page-fullwidth-transparent-header-border';
	} elseif( is_page_template( 'page-templates/full-width.php' ) ){
		return 'page-fullwidth';
	}

}

add_filter('wp_nav_menu_items', 'bizberg_add_items_on_menus', 10, 2);
function bizberg_add_items_on_menus( $items, $args ) {

    if( $args->theme_location == 'menu-1' ){ 

    	$search_status = bizberg_get_theme_mod( 'header_search' );
    	$header_button = bizberg_get_theme_mod( 'header_button' );

    	ob_start(); 

    	/**
		* @param boolean $search_status
		* If true show the search icon
    	*/

    	if( empty( $search_status ) ){ ?>

	    	<li class="menu-item search_wrapper">
	    		<div class="header-search">
					<a href="#" class="search-icon"><i class="fa fa-search"></i></a>
				</div>
	    	</li>

	    	<?php 
	    } 

	    if( empty( $header_button ) ){ ?>

		    <li class="menu-item header_search_wrapper header_btn_wrapper">
		    	<?php bizberg_get_menu_btn(); ?>
		    </li>

	    	<?php
	    }

    	$content = ob_get_clean();
      	$items .= $content;
    }

    return $items;

}

/**
* @param boolean $header_button
* If true show the button
*/

function bizberg_get_menu_btn(){

	$header_button = get_theme_mod( 'header_button', false );
	if( !empty( $header_button ) ){
		return;
	}
	
    $header_button_label  = get_theme_mod( 'header_button_label', 'Buy Now' );
    $header_button_link   = get_theme_mod( 'header_button_link', '#' );
    $header_button_target = bizberg_get_theme_mod( 'header_button_target' ); ?>
    	
	<a 
	href="<?php echo esc_url( $header_button_link ); ?>" 
	class="btn btn-primary menu_custom_btn" 
	target="<?php echo ( $header_button_target ? '_blank' : '_self' ); ?>">
		<?php 
		echo esc_html( $header_button_label );
		?>
	</a>
        
    <?php

}

if( !function_exists( 'bizberg_get_footer' ) ){
	function bizberg_get_footer(){ 
		bizberg_get_footer_5();
	}
}

function bizberg_get_footer_social_links(){

	$social_icons = bizberg_get_theme_mod( 'footer_social_links' );
	$social_icons = is_array( $social_icons ) ? $social_icons : json_decode( urldecode( $social_icons ), true );
	$content = '';

    if( !empty( $social_icons ) && is_array( $social_icons ) ){

    	ob_start();

        echo '<ul class="social-net">';
        $count = 0.2;
        foreach( $social_icons as $value ){
            echo '<li class="wow fadeInUp animated" data-wow-delay="' . esc_attr( $count ) . 's" data-wow-offset="50"><a target="' . ( !empty( $value['target'] ) && $value['target'] == 'true' ? 'blank' : '' ) . '" href="' . esc_url( $value['link'] ) . '"><i class="' . esc_attr( $value['icon'] ) . '"></i></a></li>';
            $count = $count + 0.2;
        }
        echo '</ul>';

        $content = ob_get_clean();
        return $content;

    }

    return $content;

}

function bizberg_get_footer_5(){ 

	$social_icons = bizberg_get_footer_social_links(); ?>

	<footer 
	id="footer" 
	class="footer-style"
	style="<?php echo ( empty( $social_icons ) ? 'padding-top: 20px;' : '' ); ?>">

	    <div class="container">

	    	<?php 
	    	if( !empty( $social_icons ) ){ ?>
		    	<div class="footer_social_links">
			        <?php 
			        echo wp_kses_post( $social_icons );
			        ?>
		        </div>
		        <?php 
		    } ?>

	        <?php
	        wp_nav_menu( array(
	            'theme_location' => 'footer',
	            'menu_class'=>'inline-menu',
	            'container' => 'ul',
	            'depth' => 1
	        ) );
	        ?>

	        <p class="copyright">
	            <?php bizberg_get_copyright_section(); ?>
	        </p>
	    </div>
	</footer>

	<?php
}

if( !function_exists('bizberg_adjustBrightness') ){

	function bizberg_adjustBrightness( $hexCode, $adjustPercent = '-0.2' ) {

	  	$hexCode = ltrim($hexCode, '#');

	    if (strlen($hexCode) == 3) {
	        $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
	    }

	    $hexCode = array_map('hexdec', str_split($hexCode, 2));

	    foreach ($hexCode as & $color) {
	        $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
	        $adjustAmount = ceil($adjustableLimit * $adjustPercent);

	        $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
	    }

	    return '#' . implode($hexCode);

	}

}

add_filter( 'kirki_telemetry', '__return_false' );

function bizberg_check_sidebar_active_inactive_class(){

	if( is_active_sidebar( 'sidebar-2' ) || in_array( bizberg_sidebar_position() , array( 'blog-nosidebar-1' , 'blog-nosidebar'  ) ) ){

		return 'col-md-8 col-sm-12 content-wrapper bizberg_blog_content';
		
	}
	return 'col-sm-10 content-wrapper col-sm-offset-1 content-wrapper-no-sidebar';

}

function bizberg_check_blog_title_class(){

	if( is_active_sidebar( 'sidebar-2' ) || in_array( bizberg_sidebar_position() , array( 'blog-nosidebar-1' , 'blog-nosidebar' ) ) ){
		return 'col-sm-12';
	}

	return 'col-sm-10 col-sm-offset-1';

}

function bizberg_check_sidebar_active_inactive_class_home(){

	if( is_active_sidebar( 'sidebar-2' ) || in_array( bizberg_sidebar_position() , array( 'blog-nosidebar-1' , 'blog-nosidebar' ) ) ){
		return 'col-md-8 col-sm-12 content-wrapper bizberg_blog_content';
	}

	return 'col-sm-10 content-wrapper col-sm-offset-1 content-wrapper-no-sidebar';

}

function bizberg_check_sidebar_active_inactive_class_page(){

	if( class_exists( 'WooCommerce' ) ){

		if( is_cart() || is_checkout() || is_account_page() ){

			return 'col-sm-12 col-xs-12 content-wrapper';

		}

	}

	if( is_active_sidebar( 'sidebar-2' ) ){
		return 'col-md-8 col-sm-12 col-xs-12 content-wrapper bizberg_blog_content';
	}

	return 'col-sm-10 col-xs-12 content-wrapper col-sm-offset-1 content-wrapper-no-sidebar';

}

if ( ! function_exists( 'bizberg_get_theme_mod' ) ) {
  	function bizberg_get_theme_mod( $field_id, $default_value = '' ) {
    	if ( $field_id ) {
	      	if ( !$default_value ) {
	        		if ( class_exists( 'Kirki' ) ) {
	          			$default_value = Kirki::get_option( 'bizberg', $field_id );
	        		}
	      	}
	      	$value = get_theme_mod( $field_id, $default_value );
	      	return $value;
    	}
    	return false;
  	}
}

function bizberg_blog_read_time( $post ){

	echo wp_kses_post( '<i class="far fa-clock"></i> ' . bizberg_blog_convert_read_time( $post ) );

}

function bizberg_blog_convert_read_time( $post ){

	$est = '';
	$mycontent = $post->post_content;
	$word = str_word_count( strip_tags( $mycontent ) );
	$m = floor( $word / 200 );
	$s = floor( $word % 200 / (200 / 60) );

	if( $m > 0 ){
		$est .= $m . esc_html__( ' min read', 'bizberg' );
	} elseif( $s > 0 ){
		$est .= $s . esc_html__( ' sec read', 'bizberg' );
	}

	return $est;

}

function bizberg_get_primary_header_logo(){

	$logo_url = bizberg_get_theme_mod( 'logo_site_title_custom_url' );
	$logo_url = $logo_url ? $logo_url : home_url('/');
	
	$new_tab = bizberg_get_theme_mod( 'logo_site_title_custom_url_new_tab' ) ? '_blank' : '_self'; ?>

	<a 
    class="logo pull-left <?php echo ( has_custom_logo() || !empty( get_bloginfo( 'description' ) ) ? '' : 'bizberg_no_tagline' ); ?>" 
    href="<?php echo esc_url( $logo_url ); ?>" 
    target="<?php echo esc_attr( $new_tab ); ?>">

    	<?php 
    	$transparent_header_logo = bizberg_get_theme_mod( 'transparent_header_logo' );

    	/**
		* If transparent header is enabled on the page
    	*/

    	if ( bizberg_check_transparent_header() && !empty( $transparent_header_logo ) ) { ?>

        	<img 
        	src="<?php echo esc_url( bizberg_get_custom_logo_link() ); ?>" 
        	alt="<?php esc_attr_e( 'Logo', 'bizberg' ) ?>" 
        	class="site_logo transparent_header_logo_image1">
        	<?php 
        	do_action( 'bizberg_top_logo' );

        } elseif( has_custom_logo() ){ ?>

        	<img 
        	src="<?php echo esc_url( bizberg_get_custom_logo_link() ); ?>" 
        	alt="<?php esc_attr_e( 'Logo', 'bizberg' ) ?>" 
        	class="site_logo">

        	<?php

        } else {
        	echo '<h3 class="header_site_title">' . esc_html( get_bloginfo( 'name' ) ) . '</h3>';

        	if( !empty( get_bloginfo( 'description' ) ) ){
        		echo '<p class="header_site_description">' . esc_html( get_bloginfo( 'description' ) ) . '</p>';
        	}

        } ?>

    </a>

	<?php
}

add_action( 'bizberg_top_logo', 'bizberg_display_transparent_sticky_logo_on_menu' );
function bizberg_display_transparent_sticky_logo_on_menu(){

	// get sticky logo
	$sticky_transparent_header_logo = bizberg_get_theme_mod( 'sticky_transparent_header_logo' );

	// if no sticky logo, take the transparent header logo
	$sticky_transparent_header_logo = empty( $sticky_transparent_header_logo ) ? bizberg_get_custom_logo_link() : $sticky_transparent_header_logo;

	// Check if transparent header is active or not on the page
	$transparent_header_homepage = bizberg_get_theme_mod( 'transparent_header_homepage' );

	if( !empty( $sticky_transparent_header_logo ) && bizberg_check_transparent_header() ){
		echo '<img src="' . esc_url( $sticky_transparent_header_logo ) . '" alt="' . esc_attr__( 'Logo', 'bizberg' ) . '" class="transparent_sticky_logo_header" style="display:none;"/>';	
	}	
}

function bizberg_get_last_item_header(){

	$last_item_header = bizberg_get_theme_mod( 'last_item_header' );
	$last_item_html = bizberg_get_theme_mod('last_item_html');

	switch ( $last_item_header ) {

		case 'text':
			echo do_shortcode( $last_item_html );
			break;

		case 'widget':
			if( is_active_sidebar( 'bizberg_header' ) ){
				echo '<div class="header_widget_section">';
				dynamic_sidebar( 'bizberg_header' );
				echo '</div>';
			} else {
				if( current_user_can( 'administrator' ) ){
					echo '<a href="' . esc_url( admin_url( '/customize.php?autofocus[panel]=widgets' ) ) . '">' . esc_html__( 'ADD WIDGET', 'bizberg' ) . '</a>';
				}
			}		
			break;
		
		default:
			# code...
			break;
	}

}

function bizberg_get_last_item_header_logo_center(){

	$last_item_header = bizberg_get_theme_mod( 'last_item_header_logo_center' );
	$last_item_html = bizberg_get_theme_mod('last_item_html_logo_center');

	switch ( $last_item_header ) {

		case 'text':
			echo do_shortcode( $last_item_html );
			break;

		case 'widget':
			if( is_active_sidebar( 'bizberg_header' ) ){
				echo '<div class="header_widget_section">';
				dynamic_sidebar( 'bizberg_header' );
				echo '</div>';
			} else {
				if( current_user_can( 'administrator' ) ){
					echo '<a href="' . esc_url( admin_url( '/customize.php?autofocus[panel]=widgets' ) ) . '">' . esc_html__( 'ADD WIDGET', 'bizberg' ) . '</a>';
				}
			}		
			break;

		case 'social_icons':

			echo '<div class="bizberg_header_social_icon_right">';
			echo bizberg_get_header_social_icons( 'last_item_social_links' );
			echo '</div>';

			break;
		
		default:
			# code...
			break;
	}

}

function bizberg_get_first_item_header_logo_center(){

	$first_item_header = bizberg_get_theme_mod( 'first_item_header_logo_center' );
	$first_item_html = bizberg_get_theme_mod('first_item_html_logo_center');

	switch ( $first_item_header ) {

		case 'text':
			echo do_shortcode( $first_item_html );
			break;

		case 'widget':
			if( is_active_sidebar( 'bizberg_header_left' ) ){
				echo '<div class="header_widget_section">';
				dynamic_sidebar( 'bizberg_header_left' );
				echo '</div>';
			} else {
				if( current_user_can( 'administrator' ) ){
					echo '<a href="' . esc_url( admin_url( '/customize.php?autofocus[panel]=widgets' ) ) . '">' . esc_html__( 'ADD WIDGET', 'bizberg' ) . '</a>';
				}
			}		
			break;

		case 'social_icons':

			echo '<div class="bizberg_header_social_icon_left">';
			echo bizberg_get_header_social_icons( 'first_item_social_links' );
			echo '</div>';

			break;
		
		default:
			# code...
			break;
	}

}

function bizberg_get_header_social_icons( $name ){

	ob_start();

	$first_item_social_links = bizberg_get_theme_mod( $name );
	$first_item_social_links = is_array( $first_item_social_links ) ? $first_item_social_links : json_decode( urldecode( $first_item_social_links ), true );

	if( !empty( $first_item_social_links ) && is_array( $first_item_social_links ) ){

		foreach ( $first_item_social_links as $key => $value ) {

		 	$icon = !empty( $value['icon'] ) ? sanitize_text_field( $value['icon'] ) : '';
		 	$link_url = !empty( $value['link_url'] ) ? sanitize_text_field( $value['link_url'] ) : '#';
		 	$color = !empty( $value['color'] ) ? sanitize_text_field( $value['color'] ) : '#000'; ?>

			<a 
			href="<?php echo esc_url( $link_url ); ?>" 
			class="bizberg_header_icon"
			style="color: <?php echo esc_attr( $color ); ?>">
				<i class="<?php echo esc_attr( $icon ); ?>"></i>
			</a>

			<?php

		}

	}

	return ob_get_clean();

}

function bizberg_upgrade_msg( $msg = '', $btn_link = '#', $btn_label = '' ){

    ob_start();

    if( empty( $btn_label ) ){
        $btn_label = esc_html__( 'Upgrade to PRO' , 'bizberg' );
    } ?>

    <div class="upgrade_pro">        
        <p><?php echo esc_html( $msg ); ?></p>
        <a href="<?php echo esc_html( $btn_link ); ?>" target="_blank">
            <?php echo esc_html( $btn_label ); ?>        
        </a>
    </div>

    <?php

    return ob_get_clean();
}

add_action( 'bizberg_top_header', 'bizberg_top_header_pro' );
function bizberg_top_header_pro(){ 

	$top_header_status = bizberg_get_theme_mod( 'top_header_status' );
	$top_header_status_mobile = bizberg_get_theme_mod( 'top_header_status_mobile' );

	/**
	* @param $top_header_status (boolean)
	* if true, don't show the top header
	*/

	if( $top_header_status == true ){
		return;
	} ?>

	<div id="top-bar" class="<?php echo esc_attr( $top_header_status_mobile ? 'enable_top_bar_mobile' : '' ); ?>">
		<div class="container">
			<div class="row">
				<div class="top_bar_wrapper">
					<div class="col-sm-4 col-xs-12">

						<?php 
						bizberg_get_header_social_links();
						?>

					</div>
					<div class="col-sm-8 col-xs-12">
						<div class="top-bar-right">
		                   	<ul class="infobox_header_wrapper">	                   		
		                   		<?php 
		                   		bizberg_get_infobox_header();
		                   		?>
		                   	</ul>
	                    </div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
}

function bizberg_get_infobox_header(){

	$icon1 = get_theme_mod( 'top_header_fontawesome_1' , 'fas fa-mobile-alt' );
	$icon2 = get_theme_mod( 'top_header_fontawesome_2' , 'far fa-comment-alt' );
	$icon3 = get_theme_mod( 'top_header_fontawesome_3' , 'fas fa-map-marker' );

	$label1 = get_theme_mod( 'top_header_text_1' , '9849-xxx-xxx' );
	$label2 = get_theme_mod( 'top_header_text_2' , 'noreply@example.com' );
	$label3 = get_theme_mod( 'top_header_text_3' , esc_html__( 'Tyagal, Patan, Lalitpur' , 'bizberg' ) );

	$infobox1 = get_theme_mod( 'top_header_infobox_1', true );
	$infobox2 = get_theme_mod( 'top_header_infobox_2', true );
	$infobox3 = get_theme_mod( 'top_header_infobox_3', true ); 

	$url1 = get_theme_mod( 'infobox_link_1', '' ); 
	$url2 = get_theme_mod( 'infobox_link_2', '' ); 
	$url3 = get_theme_mod( 'infobox_link_3', '' ); 

	$target_1 = bizberg_get_theme_mod( 'open_in_new_tab_1' ); 
	$target_2 = bizberg_get_theme_mod( 'open_in_new_tab_2' ); 
	$target_3 = bizberg_get_theme_mod( 'open_in_new_tab_3' ); 

	if( !empty( $infobox1 ) ){ ?>
		<li>
			<?php 
			if( !empty( $url1 ) ){ ?>
				<a 
				target="<?php echo !empty( $target_1 ) ? '_blank' : ''; ?>"
				href="<?php echo esc_url( $url1 ); ?>">
				<?php
			}
			?>	

				<i class="<?php echo esc_attr( $icon1 ); ?>"></i> <?php echo esc_html( $label1 ); ?>

			<?php 
			if( !empty( $url1 ) ){ ?>
				</a>
				<?php
			}
			?>			
		</li>
		<?php 
	} 

	if( !empty( $infobox2 ) ){ ?>
		<li>
			<?php 
			if( !empty( $url2 ) ){ ?>
				<a 
				target="<?php echo !empty( $target_2 ) ? '_blank' : ''; ?>"
				href="<?php echo esc_url( $url2 ); ?>">
				<?php
			}
			?>

				<i class="<?php echo esc_attr( $icon2 ); ?>"></i> <?php echo esc_html( $label2 ); ?>

			<?php 
			if( !empty( $url2 ) ){ ?>
				</a>
				<?php
			}
			?>	
		</li>
		<?php 
	}  

	if( !empty( $infobox3 ) ){ ?>
		<li>
			<?php 
			if( !empty( $url3 ) ){ ?>
				<a 
				target="<?php echo !empty( $target_3 ) ? '_blank' : ''; ?>"
				href="<?php echo esc_url( $url3 ); ?>">
				<?php
			}
			?>
			
				<i class="<?php echo esc_attr( $icon3 ); ?>"></i> <?php echo esc_html( $label3 ); ?>

			<?php 
			if( !empty( $url3 ) ){ ?>
				</a>
				<?php
			}
			?>
		</li>
		<?php 
	} 

}

function bizberg_get_header_social_links(){
	
	$social_links_header = bizberg_get_theme_mod( 'header_social_links' );
	$social_links_header = is_array( $social_links_header ) ? $social_links_header : json_decode( urldecode( $social_links_header ), true );

	if( !empty( $social_links_header ) && is_array( $social_links_header ) ){ ?>

		<div id="top-social-left" class="header_social_links">

			<ul>
				<?php 
				foreach ($social_links_header as $key => $value) { ?>

				 	<li tabindex="0">
						<a 
						tabindex="-1" 
						href="<?php echo esc_url( $value['link'] ); ?>"
						class="<?php echo 'social_links_header_' . $key; ?>"
						target="<?php echo ( !empty( $value['target'] ) && $value['target'] == 'true' ? '_blank' : '_self' ); ?>">
							<span class="ts-icon">
								<i class="<?php echo esc_attr( $value['icon'] ); ?>"></i>
							</span>
							<span class="ts-text">
								<?php echo esc_html( $value['label'] ); ?>
							</span>
						</a>
					</li>	
					<style>
						#top-social-left li:hover a.<?php echo 'social_links_header_' . absint( $key ); ?>,
						#top-social-left li:focus a.<?php echo 'social_links_header_' . absint( $key ); ?> {
						    background: <?php echo esc_attr( $value['backgroundColor'] ); ?>;
						}
					</style>

				 	<?php
				} ?>								
			
			</ul>

		</div>

		<?php 
	} 

}

/**
* Transparent Header
*/

add_filter( 'body_class', 'bizberg_transparent_header_class' );
function bizberg_transparent_header_class( $classes ) {

	$transparent_header_homepage = bizberg_get_theme_mod( 'transparent_header_homepage' );

	if( $transparent_header_homepage && ( is_home() || is_front_page() ) ){
		$classes[] = 'bizberg_transparent_header';
		return $classes;
	}

	$pages = bizberg_get_transparent_header_page_ids();

	if( empty( $pages ) ){
		return $classes;
	}

    if ( is_page( $pages ) ) {
        $classes[] = 'bizberg_transparent_header';
    }

    return $classes;
}

function bizberg_get_transparent_header_page_ids(){

	$transparent_header_pages = bizberg_get_theme_mod('transparent_header_pages');
	$transparent_header_pages = is_array( $transparent_header_pages ) ? $transparent_header_pages : json_decode( urldecode( $transparent_header_pages ), true );
	
	if( empty( $transparent_header_pages ) ){
		return;
	}

	$pages = array();
	foreach ( $transparent_header_pages as $value ) {
		$pages[] = $value['page_id'];
	}

	return $pages;

}

add_filter( 'theme_mod_custom_logo', 'bizberg_set_page_options_custom_logo' , 999 );
function bizberg_set_page_options_custom_logo( $default ){
	return bizberg_get_page_options_header( 'transparent_header_logo' , $default );
}

function bizberg_get_page_options_header( $name , $default ){

	$transparent_header_homepage = bizberg_get_theme_mod( 'transparent_header_homepage' );
	$transparent_header_logo_id = bizberg_get_theme_mod( $name );

	if( $transparent_header_homepage && ( is_home() || is_front_page() ) ){
		if( empty( $transparent_header_logo_id ) ){
			return $default;
		} else {
			return $transparent_header_logo_id;
		}
	}

	$pages = bizberg_get_transparent_header_page_ids();

	if( empty( $pages ) ){
		return $default;
	}

	if( !is_page( $pages ) ){
		return $default;
	}

	if( empty( $transparent_header_logo_id ) ){
		return $default;
	}

	return $transparent_header_logo_id;

}

function bizberg_get_pro_link(){
	
	$theme = wp_get_theme();
	$textdomain = $theme->get( 'TextDomain' );

	switch ( $textdomain ) {

		case 'bizberg':
		case 'bizberg-agency':
		case 'bizberg-individual-consultant':
			return 'https://bizbergthemes.com/downloads/bizberg-pro/';
			break;

		case 'happy-wedding-day':
			return 'https://bizbergthemes.com/downloads/happy-wedding-day-pro/';
			break;

		case 'dr-life-saver':
		case 'smart-health-pharmacy':
		case 'medical-business':
			return 'https://bizbergthemes.com/downloads/dr-life-saver-pro/';
			break;

		case 'pizza-hub':
			return 'https://bizbergthemes.com/downloads/pizza-hub-pro/';
			break;

		case 'professional-education-consultancy':
			return 'https://bizbergthemes.com/downloads/professional-education-consultancy-pro/';
			break;

		case 'green-eco-planet':
		case 'planet-green':
		case 'fully-green':
		case 'green-globe':
		case 'green-wealth':
		case 'green-protection':
			return 'https://bizbergthemes.com/downloads/green-eco-planet-pro/';
			break;

		case 'education-business':
		case 'education-business-school':
		case 'higher-education-business':
		case 'education-shop':
		case 'get-education':
		case 'education-empowerment':
		case 'learn-education-business':
			return 'https://bizbergthemes.com/downloads/education-business-pro/';
			break;

		case 'building-construction-architecture':
		case 'construction-sewa':
		case 'creative-construction':
		case 'construction-master':
		case 'construction-solutions':
			return 'https://bizbergthemes.com/downloads/building-construction-architecture-pro/';
			break;

		case 'ngo-charity-fundraising':
		case 'clean-charity':
		case 'ngo-charity-hub':
		case 'ngo-charity-connection':
		case 'ngo-business':
			return 'https://bizbergthemes.com/downloads/ngo-charity-fundraising-pro/';
			break;

		case 'business-event':
		case 'business-event-conference':
		case 'epic-business-event':
		case 'business-conference':
			return 'https://bizbergthemes.com/downloads/business-event-pro/';
			break;

		case 'my-travel-blogs':
			return 'https://bizbergthemes.com/downloads/my-travel-blogs-pro/';
			break;

		case 'eye-catching-blog':
			return 'https://bizbergthemes.com/downloads/eye-catching-blog-pro/';
			break;

		case 'bizberg-consulting-dark':
		case 'business-consulting-dark':
			return 'https://bizbergthemes.com/downloads/bizberg-consulting-dark-pro/';
			break;

		case 'omg-blog':
			return 'https://bizbergthemes.com/downloads/omg-blog-pro/';
			break;

		case 'next-level-blog':
			return 'https://bizbergthemes.com/downloads/next-level-blog-pro/';
			break;

		case 'bizberg-shop':
			return 'https://bizbergthemes.com/downloads/bizberg-shop-pro/';
			break;

		case 'oh-my-blog':
			return 'https://bizbergthemes.com/downloads/oh-my-blog-pro/';
			break;

		case 'artistic-blog':
			return 'https://bizbergthemes.com/downloads/artistic-blog-pro/';
			break;

		case 'school-of-education':
			return 'https://bizbergthemes.com/downloads/school-of-education-pro/';
			break;

		case 'forever-young':
			return 'https://bizbergthemes.com/downloads/forever-young-pro/';
			break;

		case 'fashion-freak':
			return 'https://bizbergthemes.com/downloads/fashion-freak-pro-2/';
			break;

		case 'econsulting-agency':
			return 'https://bizbergthemes.com/downloads/econsulting-agency-pro/';
			break;

		case 'news-24x7':
			return 'https://bizbergthemes.com/downloads/news-24x7-pro/';
			break;
		
		default:
			return false;
			break;
	}

}

/**
* Dark Mode Class
*/

add_filter( 'body_class', 'bizberg_dark_mode_class' );
function bizberg_dark_mode_class( $classes ){

	if( apply_filters( 'bizberg_dark_mode_status', false ) == true ){
		$classes[] = 'bizberg_dark_mode';
		return $classes;
	}
	
	return $classes;

}

add_filter( 'bizberg_inline_style', function( $css ){

    // Background Image and Color
    $body_background_image = bizberg_get_theme_mod( 'body_background_image' );
    $background_color = $body_background_image['background-color'];

    $css .= '.bizberg_dark_mode .full-screen-search, .bizberg_dark_mode .full-screen-search label { background-color:' . esc_attr( $background_color ) . '}';

    return $css;

});

/**
* Import recommended plugins from customizer
*/

add_action( 'wp_ajax_bizberg_hide_install_plugins_notice', 'bizberg_hide_install_plugins_notice' );
function bizberg_hide_install_plugins_notice(){
	update_option( 'bizberg_disable_recommended_plugins_status', true );
	die;
}

add_action("wp_ajax_bizberg_install_plugins_customizer", "bizberg_install_plugins_customizer");
function bizberg_install_plugins_customizer(){

	if( !( current_user_can('install_plugins') && current_user_can('activate_plugins') ) ){
		die;
	}

	if ( !wp_verify_nonce( $_POST['nonce'], "bizberg_install_plugins_from_customizer" ) ) {
      	die;
   	}

	$install_activate_plugins = !empty( $_POST['to_install_activate_plugin'] ) ? json_decode( stripslashes( $_POST['to_install_activate_plugin'] ) ) : array();

	$recommended_plugins = array(
		'cyclone-demo-importer' => array(
			'slug' => 'cyclone-demo-importer/index.php',
			'zip' => 'https://downloads.wordpress.org/plugin/cyclone-demo-importer.latest-stable.zip'
		),
		'one-click-demo-import' => array(
			'slug' => 'one-click-demo-import/one-click-demo-import.php',
			'zip' => 'https://downloads.wordpress.org/plugin/one-click-demo-import.latest-stable.zip'
		),
		'contact-form-7' => array(
			'slug' => 'contact-form-7/wp-contact-form-7.php',
			'zip' => 'https://downloads.wordpress.org/plugin/contact-form-7.latest-stable.zip'
		)
	);

	// Install and activate recommended plugins
	foreach ( $recommended_plugins as $key => $value ) {
		
		if( in_array( $key, $install_activate_plugins ) ){

			if ( !bizberg_check_plugin_installed( $value['slug'] ) ) {
		    	bizberg_install_plugin_custom( $value['zip'] );
		  	}

		    activate_plugin( $value['slug'] );

		}

	}

	update_option( 'bizberg_disable_recommended_plugins_status', true );
	update_option( 'bizberg_hide_msg', true );

	die;

}

function bizberg_check_plugin_installed( $slug ) {

  	if ( ! function_exists( 'get_plugins' ) ) {
    	require_once ABSPATH . 'wp-admin/includes/plugin.php';
  	}

  	$all_plugins = get_plugins();
   
  	if ( !empty( $all_plugins[$slug] ) ) {
    	return true;
  	} else {
    	return false;
  	}

}
 
function bizberg_install_plugin_custom( $plugin_zip ) {

  	include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
  	wp_cache_flush();
   
  	$upgrader = new Plugin_Upgrader();
  	$installed = $upgrader->install( $plugin_zip );
 
  	return $installed;

}

/**
* Blog Layout Class
*/

add_filter( 'body_class', 'bizberg_blog_layout_class' );
function bizberg_blog_layout_class( $classes ){

	$layout = bizberg_get_theme_mod( 'sidebar_settings' );

	if( $layout == 5 ){
		$classes[] = 'bizberg_grid_mode_two_col';
		return $classes;
	} elseif( $layout == 6 ){
		$classes[] = 'bizberg_grid_mode_two_col';
		$classes[] = 'bizberg_list_mode';
		return $classes;
	}
	
	return $classes;

}

function bizberg_get_homepage_blog_layout(){

	if( bizberg_sidebar_position() == 'blog-list-view' || bizberg_sidebar_position() == 'blog-grid-view' ){
		get_template_part( 'template-parts/content', 'grid-two-column' );
	} elseif( bizberg_sidebar_position() != 'blog-nosidebar-1' ){
		get_template_part( 'template-parts/content', get_post_format() );
	} else {
		get_template_part( 'template-parts/content', 'nosidebar' );
	}

}

// Change the SVG color of read more button on hover
add_filter( 'bizberg_link_color_hover_output_css', function( $css ){
	$css[] = array(
		'element'       => '.blog_listing_grid_two_column .entry-footer .btn-readmore:hover > svg path',
		'property'      => 'fill',
		'value_pattern' => '$'
	);
	return $css;
});

// Change the SVG color of read more button
add_filter( 'bizberg_link_color_output_css', function( $css ){
	$css[] = array(
		'element'       => '.blog_listing_grid_two_column .entry-footer .btn-readmore > svg path',
		'property'      => 'fill',
		'value_pattern' => '$'
	);
	return $css;
});

add_filter( 'bizberg_theme_output_css', function( $css ){
	$css[] = array(
		'element'  => '.single_post_layout_2.detail-content.single_page .single-category > span > a',
		'property' => 'background-color'
	);
	return $css;
});

function bizberg_get_previous_post_id( $post_id ) {
    // Get a global post reference since get_adjacent_post() references it
    global $post;
    // Store the existing post object for later so we don't lose it
    $oldGlobal = $post;
    // Get the post object for the specified post and place it in the global variable
    $post = get_post( $post_id );
    // Get the post object for the previous post
    $previous_post = get_previous_post();
    // Reset our global object
    $post = $oldGlobal;
    if ( '' == $previous_post ) 
        return 0;
    return $previous_post->ID; 
} 

function bizberg_get_next_post_id( $post_id ) {
    // Get a global post reference since get_adjacent_post() references it
    global $post;
    // Store the existing post object for later so we don't lose it
    $oldGlobal = $post;
    // Get the post object for the specified post and place it in the global variable
    $post = get_post( $post_id );
    // Get the post object for the next post
    $next_post = get_next_post();
    // Reset our global object
    $post = $oldGlobal;
    if ( '' == $next_post ) 
        return 0;
    return $next_post->ID; 
} 

/**
* Check featured image on single post and add class on body tag
*/

add_filter( 'body_class', 'bizberg_check_single_post_featured_image' );
function bizberg_check_single_post_featured_image( $classes ){
	global $post;
	if( has_post_thumbnail( $post ) && is_single() ){
		$classes[] = 'has_single_page_image';	
	}
	return $classes;
}

add_filter( 'bizberg_fontawesome_css_link', function(){
	return get_template_directory_uri() . '/assets/icons/font-awesome-5/css/all.css';
});

add_filter( 'bizberg_font_awesome_6_icons', 'bizberg_font_awesome_5_icons_custom' );
function bizberg_font_awesome_5_icons_custom(){

	return [ "fab fa-500px", "fab fa-accessible-icon", "fab fa-accusoft", "fab fa-acquisitions-incorporated", "fas fa-ad", "fas fa-address-book", "far fa-address-book", "fas fa-address-card", "far fa-address-card", "fas fa-adjust", "fab fa-adn", "fab fa-adversal", "fab fa-affiliatetheme", "fas fa-air-freshener", "fab fa-airbnb", "fab fa-algolia", "fas fa-align-center", "fas fa-align-justify", "fas fa-align-left", "fas fa-align-right", "fab fa-alipay", "fas fa-allergies", "fab fa-amazon", "fab fa-amazon-pay", "fas fa-ambulance", "fas fa-american-sign-language-interpreting", "fab fa-amilia", "fas fa-anchor", "fab fa-android", "fab fa-angellist", "fas fa-angle-double-down", "fas fa-angle-double-left", "fas fa-angle-double-right", "fas fa-angle-double-up", "fas fa-angle-down", "fas fa-angle-left", "fas fa-angle-right", "fas fa-angle-up", "fas fa-angry", "far fa-angry", "fab fa-angrycreative", "fab fa-angular", "fas fa-ankh", "fab fa-app-store", "fab fa-app-store-ios", "fab fa-apper", "fab fa-apple", "fas fa-apple-alt", "fab fa-apple-pay", "fas fa-archive", "fas fa-archway", "fas fa-arrow-alt-circle-down", "far fa-arrow-alt-circle-down", "fas fa-arrow-alt-circle-left", "far fa-arrow-alt-circle-left", "fas fa-arrow-alt-circle-right", "far fa-arrow-alt-circle-right", "fas fa-arrow-alt-circle-up", "far fa-arrow-alt-circle-up", "fas fa-arrow-circle-down", "fas fa-arrow-circle-left", "fas fa-arrow-circle-right", "fas fa-arrow-circle-up", "fas fa-arrow-down", "fas fa-arrow-left", "fas fa-arrow-right", "fas fa-arrow-up", "fas fa-arrows-alt", "fas fa-arrows-alt-h", "fas fa-arrows-alt-v", "fab fa-artstation", "fas fa-assistive-listening-systems", "fas fa-asterisk", "fab fa-asymmetrik", "fas fa-at", "fas fa-atlas", "fab fa-atlassian", "fas fa-atom", "fab fa-audible", "fas fa-audio-description", "fab fa-autoprefixer", "fab fa-avianex", "fab fa-aviato", "fas fa-award", "fab fa-aws", "fas fa-baby", "fas fa-baby-carriage", "fas fa-backspace", "fas fa-backward", "fas fa-bacon", "fas fa-bacteria", "fas fa-bacterium", "fas fa-bahai", "fas fa-balance-scale", "fas fa-balance-scale-left", "fas fa-balance-scale-right", "fas fa-ban", "fas fa-band-aid", "fab fa-bandcamp", "fas fa-barcode", "fas fa-bars", "fas fa-baseball-ball", "fas fa-basketball-ball", "fas fa-bath", "fas fa-battery-empty", "fas fa-battery-full", "fas fa-battery-half", "fas fa-battery-quarter", "fas fa-battery-three-quarters", "fab fa-battle-net", "fas fa-bed", "fas fa-beer", "fab fa-behance", "fab fa-behance-square", "fas fa-bell", "far fa-bell", "fas fa-bell-slash", "far fa-bell-slash", "fas fa-bezier-curve", "fas fa-bible", "fas fa-bicycle", "fas fa-biking", "fab fa-bimobject", "fas fa-binoculars", "fas fa-biohazard", "fas fa-birthday-cake", "fab fa-bitbucket", "fab fa-bitcoin", "fab fa-bity", "fab fa-black-tie", "fab fa-blackberry", "fas fa-blender", "fas fa-blender-phone", "fas fa-blind", "fas fa-blog", "fab fa-blogger", "fab fa-blogger-b", "fab fa-bluetooth", "fab fa-bluetooth-b", "fas fa-bold", "fas fa-bolt", "fas fa-bomb", "fas fa-bone", "fas fa-bong", "fas fa-book", "fas fa-book-dead", "fas fa-book-medical", "fas fa-book-open", "fas fa-book-reader", "fas fa-bookmark", "far fa-bookmark", "fab fa-bootstrap", "fas fa-border-all", "fas fa-border-none", "fas fa-border-style", "fas fa-bowling-ball", "fas fa-box", "fas fa-box-open", "fas fa-box-tissue", "fas fa-boxes", "fas fa-braille", "fas fa-brain", "fas fa-bread-slice", "fas fa-briefcase", "fas fa-briefcase-medical", "fas fa-broadcast-tower", "fas fa-broom", "fas fa-brush", "fab fa-btc", "fab fa-buffer", "fas fa-bug", "fas fa-building", "far fa-building", "fas fa-bullhorn", "fas fa-bullseye", "fas fa-burn", "fab fa-buromobelexperte", "fas fa-bus", "fas fa-bus-alt", "fas fa-business-time", "fab fa-buy-n-large", "fab fa-buysellads", "fas fa-calculator", "fas fa-calendar", "far fa-calendar", "fas fa-calendar-alt", "far fa-calendar-alt", "fas fa-calendar-check", "far fa-calendar-check", "fas fa-calendar-day", "fas fa-calendar-minus", "far fa-calendar-minus", "fas fa-calendar-plus", "far fa-calendar-plus", "fas fa-calendar-times", "far fa-calendar-times", "fas fa-calendar-week", "fas fa-camera", "fas fa-camera-retro", "fas fa-campground", "fab fa-canadian-maple-leaf", "fas fa-candy-cane", "fas fa-cannabis", "fas fa-capsules", "fas fa-car", "fas fa-car-alt", "fas fa-car-battery", "fas fa-car-crash", "fas fa-car-side", "fas fa-caravan", "fas fa-caret-down", "fas fa-caret-left", "fas fa-caret-right", "fas fa-caret-square-down", "far fa-caret-square-down", "fas fa-caret-square-left", "far fa-caret-square-left", "fas fa-caret-square-right", "far fa-caret-square-right", "fas fa-caret-square-up", "far fa-caret-square-up", "fas fa-caret-up", "fas fa-carrot", "fas fa-cart-arrow-down", "fas fa-cart-plus", "fas fa-cash-register", "fas fa-cat", "fab fa-cc-amazon-pay", "fab fa-cc-amex", "fab fa-cc-apple-pay", "fab fa-cc-diners-club", "fab fa-cc-discover", "fab fa-cc-jcb", "fab fa-cc-mastercard", "fab fa-cc-paypal", "fab fa-cc-stripe", "fab fa-cc-visa", "fab fa-centercode", "fab fa-centos", "fas fa-certificate", "fas fa-chair", "fas fa-chalkboard", "fas fa-chalkboard-teacher", "fas fa-charging-station", "fas fa-chart-area", "fas fa-chart-bar", "far fa-chart-bar", "fas fa-chart-line", "fas fa-chart-pie", "fas fa-check", "fas fa-check-circle", "far fa-check-circle", "fas fa-check-double", "fas fa-check-square", "far fa-check-square", "fas fa-cheese", "fas fa-chess", "fas fa-chess-bishop", "fas fa-chess-board", "fas fa-chess-king", "fas fa-chess-knight", "fas fa-chess-pawn", "fas fa-chess-queen", "fas fa-chess-rook", "fas fa-chevron-circle-down", "fas fa-chevron-circle-left", "fas fa-chevron-circle-right", "fas fa-chevron-circle-up", "fas fa-chevron-down", "fas fa-chevron-left", "fas fa-chevron-right", "fas fa-chevron-up", "fas fa-child", "fab fa-chrome", "fab fa-chromecast", "fas fa-church", "fas fa-circle", "far fa-circle", "fas fa-circle-notch", "fas fa-city", "fas fa-clinic-medical", "fas fa-clipboard", "far fa-clipboard", "fas fa-clipboard-check", "fas fa-clipboard-list", "fas fa-clock", "far fa-clock", "fas fa-clone", "far fa-clone", "fas fa-closed-captioning", "far fa-closed-captioning", "fas fa-cloud", "fas fa-cloud-download-alt", "fas fa-cloud-meatball", "fas fa-cloud-moon", "fas fa-cloud-moon-rain", "fas fa-cloud-rain", "fas fa-cloud-showers-heavy", "fas fa-cloud-sun", "fas fa-cloud-sun-rain", "fas fa-cloud-upload-alt", "fab fa-cloudflare", "fab fa-cloudscale", "fab fa-cloudsmith", "fab fa-cloudversify", "fas fa-cocktail", "fas fa-code", "fas fa-code-branch", "fab fa-codepen", "fab fa-codiepie", "fas fa-coffee", "fas fa-cog", "fas fa-cogs", "fas fa-coins", "fas fa-columns", "fas fa-comment", "far fa-comment", "fas fa-comment-alt", "far fa-comment-alt", "fas fa-comment-dollar", "fas fa-comment-dots", "far fa-comment-dots", "fas fa-comment-medical", "fas fa-comment-slash", "fas fa-comments", "far fa-comments", "fas fa-comments-dollar", "fas fa-compact-disc", "fas fa-compass", "far fa-compass", "fas fa-compress", "fas fa-compress-alt", "fas fa-compress-arrows-alt", "fas fa-concierge-bell", "fab fa-confluence", "fab fa-connectdevelop", "fab fa-contao", "fas fa-cookie", "fas fa-cookie-bite", "fas fa-copy", "far fa-copy", "fas fa-copyright", "far fa-copyright", "fab fa-cotton-bureau", "fas fa-couch", "fab fa-cpanel", "fab fa-creative-commons", "fab fa-creative-commons-by", "fab fa-creative-commons-nc", "fab fa-creative-commons-nc-eu", "fab fa-creative-commons-nc-jp", "fab fa-creative-commons-nd", "fab fa-creative-commons-pd", "fab fa-creative-commons-pd-alt", "fab fa-creative-commons-remix", "fab fa-creative-commons-sa", "fab fa-creative-commons-sampling", "fab fa-creative-commons-sampling-plus", "fab fa-creative-commons-share", "fab fa-creative-commons-zero", "fas fa-credit-card", "far fa-credit-card", "fab fa-critical-role", "fas fa-crop", "fas fa-crop-alt", "fas fa-cross", "fas fa-crosshairs", "fas fa-crow", "fas fa-crown", "fas fa-crutch", "fab fa-css3", "fab fa-css3-alt", "fas fa-cube", "fas fa-cubes", "fas fa-cut", "fab fa-cuttlefish", "fab fa-d-and-d", "fab fa-d-and-d-beyond", "fab fa-dailymotion", "fab fa-dashcube", "fas fa-database", "fas fa-deaf", "fab fa-deezer", "fab fa-delicious", "fas fa-democrat", "fab fa-deploydog", "fab fa-deskpro", "fas fa-desktop", "fab fa-dev", "fab fa-deviantart", "fas fa-dharmachakra", "fab fa-dhl", "fas fa-diagnoses", "fab fa-diaspora", "fas fa-dice", "fas fa-dice-d20", "fas fa-dice-d6", "fas fa-dice-five", "fas fa-dice-four", "fas fa-dice-one", "fas fa-dice-six", "fas fa-dice-three", "fas fa-dice-two", "fab fa-digg", "fab fa-digital-ocean", "fas fa-digital-tachograph", "fas fa-directions", "fab fa-discord", "fab fa-discourse", "fas fa-disease", "fas fa-divide", "fas fa-dizzy", "far fa-dizzy", "fas fa-dna", "fab fa-dochub", "fab fa-docker", "fas fa-dog", "fas fa-dollar-sign", "fas fa-dolly", "fas fa-dolly-flatbed", "fas fa-donate", "fas fa-door-closed", "fas fa-door-open", "fas fa-dot-circle", "far fa-dot-circle", "fas fa-dove", "fas fa-download", "fab fa-draft2digital", "fas fa-drafting-compass", "fas fa-dragon", "fas fa-draw-polygon", "fab fa-dribbble", "fab fa-dribbble-square", "fab fa-dropbox", "fas fa-drum", "fas fa-drum-steelpan", "fas fa-drumstick-bite", "fab fa-drupal", "fas fa-dumbbell", "fas fa-dumpster", "fas fa-dumpster-fire", "fas fa-dungeon", "fab fa-dyalog", "fab fa-earlybirds", "fab fa-ebay", "fab fa-edge", "fab fa-edge-legacy", "fas fa-edit", "far fa-edit", "fas fa-egg", "fas fa-eject", "fab fa-elementor", "fas fa-ellipsis-h", "fas fa-ellipsis-v", "fab fa-ello", "fab fa-ember", "fab fa-empire", "fas fa-envelope", "far fa-envelope", "fas fa-envelope-open", "far fa-envelope-open", "fas fa-envelope-open-text", "fas fa-envelope-square", "fab fa-envira", "fas fa-equals", "fas fa-eraser", "fab fa-erlang", "fab fa-ethereum", "fas fa-ethernet", "fab fa-etsy", "fas fa-euro-sign", "fab fa-evernote", "fas fa-exchange-alt", "fas fa-exclamation", "fas fa-exclamation-circle", "fas fa-exclamation-triangle", "fas fa-expand", "fas fa-expand-alt", "fas fa-expand-arrows-alt", "fab fa-expeditedssl", "fas fa-external-link-alt", "fas fa-external-link-square-alt", "fas fa-eye", "far fa-eye", "fas fa-eye-dropper", "fas fa-eye-slash", "far fa-eye-slash", "fab fa-facebook", "fab fa-facebook-f", "fab fa-facebook-messenger", "fab fa-facebook-square", "fas fa-fan", "fab fa-fantasy-flight-games", "fas fa-fast-backward", "fas fa-fast-forward", "fas fa-faucet", "fas fa-fax", "fas fa-feather", "fas fa-feather-alt", "fab fa-fedex", "fab fa-fedora", "fas fa-female", "fas fa-fighter-jet", "fab fa-figma", "fas fa-file", "far fa-file", "fas fa-file-alt", "far fa-file-alt", "fas fa-file-archive", "far fa-file-archive", "fas fa-file-audio", "far fa-file-audio", "fas fa-file-code", "far fa-file-code", "fas fa-file-contract", "fas fa-file-csv", "fas fa-file-download", "fas fa-file-excel", "far fa-file-excel", "fas fa-file-export", "fas fa-file-image", "far fa-file-image", "fas fa-file-import", "fas fa-file-invoice", "fas fa-file-invoice-dollar", "fas fa-file-medical", "fas fa-file-medical-alt", "fas fa-file-pdf", "far fa-file-pdf", "fas fa-file-powerpoint", "far fa-file-powerpoint", "fas fa-file-prescription", "fas fa-file-signature", "fas fa-file-upload", "fas fa-file-video", "far fa-file-video", "fas fa-file-word", "far fa-file-word", "fas fa-fill", "fas fa-fill-drip", "fas fa-film", "fas fa-filter", "fas fa-fingerprint", "fas fa-fire", "fas fa-fire-alt", "fas fa-fire-extinguisher", "fab fa-firefox", "fab fa-firefox-browser", "fas fa-first-aid", "fab fa-first-order", "fab fa-first-order-alt", "fab fa-firstdraft", "fas fa-fish", "fas fa-fist-raised", "fas fa-flag", "far fa-flag", "fas fa-flag-checkered", "fas fa-flag-usa", "fas fa-flask", "fab fa-flickr", "fab fa-flipboard", "fas fa-flushed", "far fa-flushed", "fab fa-fly", "fas fa-folder", "far fa-folder", "fas fa-folder-minus", "fas fa-folder-open", "far fa-folder-open", "fas fa-folder-plus", "fas fa-font", "fab fa-font-awesome", "fab fa-font-awesome-alt", "fab fa-font-awesome-flag", "fab fa-fonticons", "fab fa-fonticons-fi", "fas fa-football-ball", "fab fa-fort-awesome", "fab fa-fort-awesome-alt", "fab fa-forumbee", "fas fa-forward", "fab fa-foursquare", "fab fa-free-code-camp", "fab fa-freebsd", "fas fa-frog", "fas fa-frown", "far fa-frown", "fas fa-frown-open", "far fa-frown-open", "fab fa-fulcrum", "fas fa-funnel-dollar", "fas fa-futbol", "far fa-futbol", "fab fa-galactic-republic", "fab fa-galactic-senate", "fas fa-gamepad", "fas fa-gas-pump", "fas fa-gavel", "fas fa-gem", "far fa-gem", "fas fa-genderless", "fab fa-get-pocket", "fab fa-gg", "fab fa-gg-circle", "fas fa-ghost", "fas fa-gift", "fas fa-gifts", "fab fa-git", "fab fa-git-alt", "fab fa-git-square", "fab fa-github", "fab fa-github-alt", "fab fa-github-square", "fab fa-gitkraken", "fab fa-gitlab", "fab fa-gitter", "fas fa-glass-cheers", "fas fa-glass-martini", "fas fa-glass-martini-alt", "fas fa-glass-whiskey", "fas fa-glasses", "fab fa-glide", "fab fa-glide-g", "fas fa-globe", "fas fa-globe-africa", "fas fa-globe-americas", "fas fa-globe-asia", "fas fa-globe-europe", "fab fa-gofore", "fas fa-golf-ball", "fab fa-goodreads", "fab fa-goodreads-g", "fab fa-google", "fab fa-google-drive", "fab fa-google-pay", "fab fa-google-play", "fab fa-google-plus", "fab fa-google-plus-g", "fab fa-google-plus-square", "fab fa-google-wallet", "fas fa-gopuram", "fas fa-graduation-cap", "fab fa-gratipay", "fab fa-grav", "fas fa-greater-than", "fas fa-greater-than-equal", "fas fa-grimace", "far fa-grimace", "fas fa-grin", "far fa-grin", "fas fa-grin-alt", "far fa-grin-alt", "fas fa-grin-beam", "far fa-grin-beam", "fas fa-grin-beam-sweat", "far fa-grin-beam-sweat", "fas fa-grin-hearts", "far fa-grin-hearts", "fas fa-grin-squint", "far fa-grin-squint", "fas fa-grin-squint-tears", "far fa-grin-squint-tears", "fas fa-grin-stars", "far fa-grin-stars", "fas fa-grin-tears", "far fa-grin-tears", "fas fa-grin-tongue", "far fa-grin-tongue", "fas fa-grin-tongue-squint", "far fa-grin-tongue-squint", "fas fa-grin-tongue-wink", "far fa-grin-tongue-wink", "fas fa-grin-wink", "far fa-grin-wink", "fas fa-grip-horizontal", "fas fa-grip-lines", "fas fa-grip-lines-vertical", "fas fa-grip-vertical", "fab fa-gripfire", "fab fa-grunt", "fab fa-guilded", "fas fa-guitar", "fab fa-gulp", "fas fa-h-square", "fab fa-hacker-news", "fab fa-hacker-news-square", "fab fa-hackerrank", "fas fa-hamburger", "fas fa-hammer", "fas fa-hamsa", "fas fa-hand-holding", "fas fa-hand-holding-heart", "fas fa-hand-holding-medical", "fas fa-hand-holding-usd", "fas fa-hand-holding-water", "fas fa-hand-lizard", "far fa-hand-lizard", "fas fa-hand-middle-finger", "fas fa-hand-paper", "far fa-hand-paper", "fas fa-hand-peace", "far fa-hand-peace", "fas fa-hand-point-down", "far fa-hand-point-down", "fas fa-hand-point-left", "far fa-hand-point-left", "fas fa-hand-point-right", "far fa-hand-point-right", "fas fa-hand-point-up", "far fa-hand-point-up", "fas fa-hand-pointer", "far fa-hand-pointer", "fas fa-hand-rock", "far fa-hand-rock", "fas fa-hand-scissors", "far fa-hand-scissors", "fas fa-hand-sparkles", "fas fa-hand-spock", "far fa-hand-spock", "fas fa-hands", "fas fa-hands-helping", "fas fa-hands-wash", "fas fa-handshake", "far fa-handshake", "fas fa-handshake-alt-slash", "fas fa-handshake-slash", "fas fa-hanukiah", "fas fa-hard-hat", "fas fa-hashtag", "fas fa-hat-cowboy", "fas fa-hat-cowboy-side", "fas fa-hat-wizard", "fas fa-hdd", "far fa-hdd", "fas fa-head-side-cough", "fas fa-head-side-cough-slash", "fas fa-head-side-mask", "fas fa-head-side-virus", "fas fa-heading", "fas fa-headphones", "fas fa-headphones-alt", "fas fa-headset", "fas fa-heart", "far fa-heart", "fas fa-heart-broken", "fas fa-heartbeat", "fas fa-helicopter", "fas fa-highlighter", "fas fa-hiking", "fas fa-hippo", "fab fa-hips", "fab fa-hire-a-helper", "fas fa-history", "fab fa-hive", "fas fa-hockey-puck", "fas fa-holly-berry", "fas fa-home", "fab fa-hooli", "fab fa-hornbill", "fas fa-horse", "fas fa-horse-head", "fas fa-hospital", "far fa-hospital", "fas fa-hospital-alt", "fas fa-hospital-symbol", "fas fa-hospital-user", "fas fa-hot-tub", "fas fa-hotdog", "fas fa-hotel", "fab fa-hotjar", "fas fa-hourglass", "far fa-hourglass", "fas fa-hourglass-end", "fas fa-hourglass-half", "fas fa-hourglass-start", "fas fa-house-damage", "fas fa-house-user", "fab fa-houzz", "fas fa-hryvnia", "fab fa-html5", "fab fa-hubspot", "fas fa-i-cursor", "fas fa-ice-cream", "fas fa-icicles", "fas fa-icons", "fas fa-id-badge", "far fa-id-badge", "fas fa-id-card", "far fa-id-card", "fas fa-id-card-alt", "fab fa-ideal", "fas fa-igloo", "fas fa-image", "far fa-image", "fas fa-images", "far fa-images", "fab fa-imdb", "fas fa-inbox", "fas fa-indent", "fas fa-industry", "fas fa-infinity", "fas fa-info", "fas fa-info-circle", "fab fa-innosoft", "fab fa-instagram", "fab fa-instagram-square", "fab fa-instalod", "fab fa-intercom", "fab fa-internet-explorer", "fab fa-invision", "fab fa-ioxhost", "fas fa-italic", "fab fa-itch-io", "fab fa-itunes", "fab fa-itunes-note", "fab fa-java", "fas fa-jedi", "fab fa-jedi-order", "fab fa-jenkins", "fab fa-jira", "fab fa-joget", "fas fa-joint", "fab fa-joomla", "fas fa-journal-whills", "fab fa-js", "fab fa-js-square", "fab fa-jsfiddle", "fas fa-kaaba", "fab fa-kaggle", "fas fa-key", "fab fa-keybase", "fas fa-keyboard", "far fa-keyboard", "fab fa-keycdn", "fas fa-khanda", "fab fa-kickstarter", "fab fa-kickstarter-k", "fas fa-kiss", "far fa-kiss", "fas fa-kiss-beam", "far fa-kiss-beam", "fas fa-kiss-wink-heart", "far fa-kiss-wink-heart", "fas fa-kiwi-bird", "fab fa-korvue", "fas fa-landmark", "fas fa-language", "fas fa-laptop", "fas fa-laptop-code", "fas fa-laptop-house", "fas fa-laptop-medical", "fab fa-laravel", "fab fa-lastfm", "fab fa-lastfm-square", "fas fa-laugh", "far fa-laugh", "fas fa-laugh-beam", "far fa-laugh-beam", "fas fa-laugh-squint", "far fa-laugh-squint", "fas fa-laugh-wink", "far fa-laugh-wink", "fas fa-layer-group", "fas fa-leaf", "fab fa-leanpub", "fas fa-lemon", "far fa-lemon", "fab fa-less", "fas fa-less-than", "fas fa-less-than-equal", "fas fa-level-down-alt", "fas fa-level-up-alt", "fas fa-life-ring", "far fa-life-ring", "fas fa-lightbulb", "far fa-lightbulb", "fab fa-line", "fas fa-link", "fab fa-linkedin", "fab fa-linkedin-in", "fab fa-linode", "fab fa-linux", "fas fa-lira-sign", "fas fa-list", "fas fa-list-alt", "far fa-list-alt", "fas fa-list-ol", "fas fa-list-ul", "fas fa-location-arrow", "fas fa-lock", "fas fa-lock-open", "fas fa-long-arrow-alt-down", "fas fa-long-arrow-alt-left", "fas fa-long-arrow-alt-right", "fas fa-long-arrow-alt-up", "fas fa-low-vision", "fas fa-luggage-cart", "fas fa-lungs", "fas fa-lungs-virus", "fab fa-lyft", "fab fa-magento", "fas fa-magic", "fas fa-magnet", "fas fa-mail-bulk", "fab fa-mailchimp", "fas fa-male", "fab fa-mandalorian", "fas fa-map", "far fa-map", "fas fa-map-marked", "fas fa-map-marked-alt", "fas fa-map-marker", "fas fa-map-marker-alt", "fas fa-map-pin", "fas fa-map-signs", "fab fa-markdown", "fas fa-marker", "fas fa-mars", "fas fa-mars-double", "fas fa-mars-stroke", "fas fa-mars-stroke-h", "fas fa-mars-stroke-v", "fas fa-mask", "fab fa-mastodon", "fab fa-maxcdn", "fab fa-mdb", "fas fa-medal", "fab fa-medapps", "fab fa-medium", "fab fa-medium-m", "fas fa-medkit", "fab fa-medrt", "fab fa-meetup", "fab fa-megaport", "fas fa-meh", "far fa-meh", "fas fa-meh-blank", "far fa-meh-blank", "fas fa-meh-rolling-eyes", "far fa-meh-rolling-eyes", "fas fa-memory", "fab fa-mendeley", "fas fa-menorah", "fas fa-mercury", "fas fa-meteor", "fab fa-microblog", "fas fa-microchip", "fas fa-microphone", "fas fa-microphone-alt", "fas fa-microphone-alt-slash", "fas fa-microphone-slash", "fas fa-microscope", "fab fa-microsoft", "fas fa-minus", "fas fa-minus-circle", "fas fa-minus-square", "far fa-minus-square", "fas fa-mitten", "fab fa-mix", "fab fa-mixcloud", "fab fa-mixer", "fab fa-mizuni", "fas fa-mobile", "fas fa-mobile-alt", "fab fa-modx", "fab fa-monero", "fas fa-money-bill", "fas fa-money-bill-alt", "far fa-money-bill-alt", "fas fa-money-bill-wave", "fas fa-money-bill-wave-alt", "fas fa-money-check", "fas fa-money-check-alt", "fas fa-monument", "fas fa-moon", "far fa-moon", "fas fa-mortar-pestle", "fas fa-mosque", "fas fa-motorcycle", "fas fa-mountain", "fas fa-mouse", "fas fa-mouse-pointer", "fas fa-mug-hot", "fas fa-music", "fab fa-napster", "fab fa-neos", "fas fa-network-wired", "fas fa-neuter", "fas fa-newspaper", "far fa-newspaper", "fab fa-nimblr", "fab fa-node", "fab fa-node-js", "fas fa-not-equal", "fas fa-notes-medical", "fab fa-npm", "fab fa-ns8", "fab fa-nutritionix", "fas fa-object-group", "far fa-object-group", "fas fa-object-ungroup", "far fa-object-ungroup", "fab fa-octopus-deploy", "fab fa-odnoklassniki", "fab fa-odnoklassniki-square", "fas fa-oil-can", "fab fa-old-republic", "fas fa-om", "fab fa-opencart", "fab fa-openid", "fab fa-opera", "fab fa-optin-monster", "fab fa-orcid", "fab fa-osi", "fas fa-otter", "fas fa-outdent", "fab fa-page4", "fab fa-pagelines", "fas fa-pager", "fas fa-paint-brush", "fas fa-paint-roller", "fas fa-palette", "fab fa-palfed", "fas fa-pallet", "fas fa-paper-plane", "far fa-paper-plane", "fas fa-paperclip", "fas fa-parachute-box", "fas fa-paragraph", "fas fa-parking", "fas fa-passport", "fas fa-pastafarianism", "fas fa-paste", "fab fa-patreon", "fas fa-pause", "fas fa-pause-circle", "far fa-pause-circle", "fas fa-paw", "fab fa-paypal", "fas fa-peace", "fas fa-pen", "fas fa-pen-alt", "fas fa-pen-fancy", "fas fa-pen-nib", "fas fa-pen-square", "fas fa-pencil-alt", "fas fa-pencil-ruler", "fab fa-penny-arcade", "fas fa-people-arrows", "fas fa-people-carry", "fas fa-pepper-hot", "fab fa-perbyte", "fas fa-percent", "fas fa-percentage", "fab fa-periscope", "fas fa-person-booth", "fab fa-phabricator", "fab fa-phoenix-framework", "fab fa-phoenix-squadron", "fas fa-phone", "fas fa-phone-alt", "fas fa-phone-slash", "fas fa-phone-square", "fas fa-phone-square-alt", "fas fa-phone-volume", "fas fa-photo-video", "fab fa-php", "fab fa-pied-piper", "fab fa-pied-piper-alt", "fab fa-pied-piper-hat", "fab fa-pied-piper-pp", "fab fa-pied-piper-square", "fas fa-piggy-bank", "fas fa-pills", "fab fa-pinterest", "fab fa-pinterest-p", "fab fa-pinterest-square", "fas fa-pizza-slice", "fas fa-place-of-worship", "fas fa-plane", "fas fa-plane-arrival", "fas fa-plane-departure", "fas fa-plane-slash", "fas fa-play", "fas fa-play-circle", "far fa-play-circle", "fab fa-playstation", "fas fa-plug", "fas fa-plus", "fas fa-plus-circle", "fas fa-plus-square", "far fa-plus-square", "fas fa-podcast", "fas fa-poll", "fas fa-poll-h", "fas fa-poo", "fas fa-poo-storm", "fas fa-poop", "fas fa-portrait", "fas fa-pound-sign", "fas fa-power-off", "fas fa-pray", "fas fa-praying-hands", "fas fa-prescription", "fas fa-prescription-bottle", "fas fa-prescription-bottle-alt", "fas fa-print", "fas fa-procedures", "fab fa-product-hunt", "fas fa-project-diagram", "fas fa-pump-medical", "fas fa-pump-soap", "fab fa-pushed", "fas fa-puzzle-piece", "fab fa-python", "fab fa-qq", "fas fa-qrcode", "fas fa-question", "fas fa-question-circle", "far fa-question-circle", "fas fa-quidditch", "fab fa-quinscape", "fab fa-quora", "fas fa-quote-left", "fas fa-quote-right", "fas fa-quran", "fab fa-r-project", "fas fa-radiation", "fas fa-radiation-alt", "fas fa-rainbow", "fas fa-random", "fab fa-raspberry-pi", "fab fa-ravelry", "fab fa-react", "fab fa-reacteurope", "fab fa-readme", "fab fa-rebel", "fas fa-receipt", "fas fa-record-vinyl", "fas fa-recycle", "fab fa-red-river", "fab fa-reddit", "fab fa-reddit-alien", "fab fa-reddit-square", "fab fa-redhat", "fas fa-redo", "fas fa-redo-alt", "fas fa-registered", "far fa-registered", "fas fa-remove-format", "fab fa-renren", "fas fa-reply", "fas fa-reply-all", "fab fa-replyd", "fas fa-republican", "fab fa-researchgate", "fab fa-resolving", "fas fa-restroom", "fas fa-retweet", "fab fa-rev", "fas fa-ribbon", "fas fa-ring", "fas fa-road", "fas fa-robot", "fas fa-rocket", "fab fa-rocketchat", "fab fa-rockrms", "fas fa-route", "fas fa-rss", "fas fa-rss-square", "fas fa-ruble-sign", "fas fa-ruler", "fas fa-ruler-combined", "fas fa-ruler-horizontal", "fas fa-ruler-vertical", "fas fa-running", "fas fa-rupee-sign", "fab fa-rust", "fas fa-sad-cry", "far fa-sad-cry", "fas fa-sad-tear", "far fa-sad-tear", "fab fa-safari", "fab fa-salesforce", "fab fa-sass", "fas fa-satellite", "fas fa-satellite-dish", "fas fa-save", "far fa-save", "fab fa-schlix", "fas fa-school", "fas fa-screwdriver", "fab fa-scribd", "fas fa-scroll", "fas fa-sd-card", "fas fa-search", "fas fa-search-dollar", "fas fa-search-location", "fas fa-search-minus", "fas fa-search-plus", "fab fa-searchengin", "fas fa-seedling", "fab fa-sellcast", "fab fa-sellsy", "fas fa-server", "fab fa-servicestack", "fas fa-shapes", "fas fa-share", "fas fa-share-alt", "fas fa-share-alt-square", "fas fa-share-square", "far fa-share-square", "fas fa-shekel-sign", "fas fa-shield-alt", "fas fa-shield-virus", "fas fa-ship", "fas fa-shipping-fast", "fab fa-shirtsinbulk", "fas fa-shoe-prints", "fab fa-shopify", "fas fa-shopping-bag", "fas fa-shopping-basket", "fas fa-shopping-cart", "fab fa-shopware", "fas fa-shower", "fas fa-shuttle-van", "fas fa-sign", "fas fa-sign-in-alt", "fas fa-sign-language", "fas fa-sign-out-alt", "fas fa-signal", "fas fa-signature", "fas fa-sim-card", "fab fa-simplybuilt", "fas fa-sink", "fab fa-sistrix", "fas fa-sitemap", "fab fa-sith", "fas fa-skating", "fab fa-sketch", "fas fa-skiing", "fas fa-skiing-nordic", "fas fa-skull", "fas fa-skull-crossbones", "fab fa-skyatlas", "fab fa-skype", "fab fa-slack", "fab fa-slack-hash", "fas fa-slash", "fas fa-sleigh", "fas fa-sliders-h", "fab fa-slideshare", "fas fa-smile", "far fa-smile", "fas fa-smile-beam", "far fa-smile-beam", "fas fa-smile-wink", "far fa-smile-wink", "fas fa-smog", "fas fa-smoking", "fas fa-smoking-ban", "fas fa-sms", "fab fa-snapchat", "fab fa-snapchat-ghost", "fab fa-snapchat-square", "fas fa-snowboarding", "fas fa-snowflake", "far fa-snowflake", "fas fa-snowman", "fas fa-snowplow", "fas fa-soap", "fas fa-socks", "fas fa-solar-panel", "fas fa-sort", "fas fa-sort-alpha-down", "fas fa-sort-alpha-down-alt", "fas fa-sort-alpha-up", "fas fa-sort-alpha-up-alt", "fas fa-sort-amount-down", "fas fa-sort-amount-down-alt", "fas fa-sort-amount-up", "fas fa-sort-amount-up-alt", "fas fa-sort-down", "fas fa-sort-numeric-down", "fas fa-sort-numeric-down-alt", "fas fa-sort-numeric-up", "fas fa-sort-numeric-up-alt", "fas fa-sort-up", "fab fa-soundcloud", "fab fa-sourcetree", "fas fa-spa", "fas fa-space-shuttle", "fab fa-speakap", "fab fa-speaker-deck", "fas fa-spell-check", "fas fa-spider", "fas fa-spinner", "fas fa-splotch", "fab fa-spotify", "fas fa-spray-can", "fas fa-square", "far fa-square", "fas fa-square-full", "fas fa-square-root-alt", "fab fa-squarespace", "fab fa-stack-exchange", "fab fa-stack-overflow", "fab fa-stackpath", "fas fa-stamp", "fas fa-star", "far fa-star", "fas fa-star-and-crescent", "fas fa-star-half", "far fa-star-half", "fas fa-star-half-alt", "fas fa-star-of-david", "fas fa-star-of-life", "fab fa-staylinked", "fab fa-steam", "fab fa-steam-square", "fab fa-steam-symbol", "fas fa-step-backward", "fas fa-step-forward", "fas fa-stethoscope", "fab fa-sticker-mule", "fas fa-sticky-note", "far fa-sticky-note", "fas fa-stop", "fas fa-stop-circle", "far fa-stop-circle", "fas fa-stopwatch", "fas fa-stopwatch-20", "fas fa-store", "fas fa-store-alt", "fas fa-store-alt-slash", "fas fa-store-slash", "fab fa-strava", "fas fa-stream", "fas fa-street-view", "fas fa-strikethrough", "fab fa-stripe", "fab fa-stripe-s", "fas fa-stroopwafel", "fab fa-studiovinari", "fab fa-stumbleupon", "fab fa-stumbleupon-circle", "fas fa-subscript", "fas fa-subway", "fas fa-suitcase", "fas fa-suitcase-rolling", "fas fa-sun", "far fa-sun", "fab fa-superpowers", "fas fa-superscript", "fab fa-supple", "fas fa-surprise", "far fa-surprise", "fab fa-suse", "fas fa-swatchbook", "fab fa-swift", "fas fa-swimmer", "fas fa-swimming-pool", "fab fa-symfony", "fas fa-synagogue", "fas fa-sync", "fas fa-sync-alt", "fas fa-syringe", "fas fa-table", "fas fa-table-tennis", "fas fa-tablet", "fas fa-tablet-alt", "fas fa-tablets", "fas fa-tachometer-alt", "fas fa-tag", "fas fa-tags", "fas fa-tape", "fas fa-tasks", "fas fa-taxi", "fab fa-teamspeak", "fas fa-teeth", "fas fa-teeth-open", "fab fa-telegram", "fab fa-telegram-plane", "fas fa-temperature-high", "fas fa-temperature-low", "fab fa-tencent-weibo", "fas fa-tenge", "fas fa-terminal", "fas fa-text-height", "fas fa-text-width", "fas fa-th", "fas fa-th-large", "fas fa-th-list", "fab fa-the-red-yeti", "fas fa-theater-masks", "fab fa-themeco", "fab fa-themeisle", "fas fa-thermometer", "fas fa-thermometer-empty", "fas fa-thermometer-full", "fas fa-thermometer-half", "fas fa-thermometer-quarter", "fas fa-thermometer-three-quarters", "fab fa-think-peaks", "fas fa-thumbs-down", "far fa-thumbs-down", "fas fa-thumbs-up", "far fa-thumbs-up", "fas fa-thumbtack", "fas fa-ticket-alt", "fab fa-tiktok", "fas fa-times", "fas fa-times-circle", "far fa-times-circle", "fas fa-tint", "fas fa-tint-slash", "fas fa-tired", "far fa-tired", "fas fa-toggle-off", "fas fa-toggle-on", "fas fa-toilet", "fas fa-toilet-paper", "fas fa-toilet-paper-slash", "fas fa-toolbox", "fas fa-tools", "fas fa-tooth", "fas fa-torah", "fas fa-torii-gate", "fas fa-tractor", "fab fa-trade-federation", "fas fa-trademark", "fas fa-traffic-light", "fas fa-trailer", "fas fa-train", "fas fa-tram", "fas fa-transgender", "fas fa-transgender-alt", "fas fa-trash", "fas fa-trash-alt", "far fa-trash-alt", "fas fa-trash-restore", "fas fa-trash-restore-alt", "fas fa-tree", "fab fa-trello", "fas fa-trophy", "fas fa-truck", "fas fa-truck-loading", "fas fa-truck-monster", "fas fa-truck-moving", "fas fa-truck-pickup", "fas fa-tshirt", "fas fa-tty", "fab fa-tumblr", "fab fa-tumblr-square", "fas fa-tv", "fab fa-twitch", "fab fa-twitter", "fab fa-twitter-square", "fab fa-typo3", "fab fa-uber", "fab fa-ubuntu", "fab fa-uikit", "fab fa-umbraco", "fas fa-umbrella", "fas fa-umbrella-beach", "fab fa-uncharted", "fas fa-underline", "fas fa-undo", "fas fa-undo-alt", "fab fa-uniregistry", "fab fa-unity", "fas fa-universal-access", "fas fa-university", "fas fa-unlink", "fas fa-unlock", "fas fa-unlock-alt", "fab fa-unsplash", "fab fa-untappd", "fas fa-upload", "fab fa-ups", "fab fa-usb", "fas fa-user", "far fa-user", "fas fa-user-alt", "fas fa-user-alt-slash", "fas fa-user-astronaut", "fas fa-user-check", "fas fa-user-circle", "far fa-user-circle", "fas fa-user-clock", "fas fa-user-cog", "fas fa-user-edit", "fas fa-user-friends", "fas fa-user-graduate", "fas fa-user-injured", "fas fa-user-lock", "fas fa-user-md", "fas fa-user-minus", "fas fa-user-ninja", "fas fa-user-nurse", "fas fa-user-plus", "fas fa-user-secret", "fas fa-user-shield", "fas fa-user-slash", "fas fa-user-tag", "fas fa-user-tie", "fas fa-user-times", "fas fa-users", "fas fa-users-cog", "fas fa-users-slash", "fab fa-usps", "fab fa-ussunnah", "fas fa-utensil-spoon", "fas fa-utensils", "fab fa-vaadin", "fas fa-vector-square", "fas fa-venus", "fas fa-venus-double", "fas fa-venus-mars", "fas fa-vest", "fas fa-vest-patches", "fab fa-viacoin", "fab fa-viadeo", "fab fa-viadeo-square", "fas fa-vial", "fas fa-vials", "fab fa-viber", "fas fa-video", "fas fa-video-slash", "fas fa-vihara", "fab fa-vimeo", "fab fa-vimeo-square", "fab fa-vimeo-v", "fab fa-vine", "fas fa-virus", "fas fa-virus-slash", "fas fa-viruses", "fab fa-vk", "fab fa-vnv", "fas fa-voicemail", "fas fa-volleyball-ball", "fas fa-volume-down", "fas fa-volume-mute", "fas fa-volume-off", "fas fa-volume-up", "fas fa-vote-yea", "fas fa-vr-cardboard", "fab fa-vuejs", "fas fa-walking", "fas fa-wallet", "fas fa-warehouse", "fab fa-watchman-monitoring", "fas fa-water", "fas fa-wave-square", "fab fa-waze", "fab fa-weebly", "fab fa-weibo", "fas fa-weight", "fas fa-weight-hanging", "fab fa-weixin", "fab fa-whatsapp", "fab fa-whatsapp-square", "fas fa-wheelchair", "fab fa-whmcs", "fas fa-wifi", "fab fa-wikipedia-w", "fas fa-wind", "fas fa-window-close", "far fa-window-close", "fas fa-window-maximize", "far fa-window-maximize", "fas fa-window-minimize", "far fa-window-minimize", "fas fa-window-restore", "far fa-window-restore", "fab fa-windows", "fas fa-wine-bottle", "fas fa-wine-glass", "fas fa-wine-glass-alt", "fab fa-wix", "fab fa-wizards-of-the-coast", "fab fa-wodu", "fab fa-wolf-pack-battalion", "fas fa-won-sign", "fab fa-wordpress", "fab fa-wordpress-simple", "fab fa-wpbeginner", "fab fa-wpexplorer", "fab fa-wpforms", "fab fa-wpressr", "fas fa-wrench", "fas fa-x-ray", "fab fa-xbox", "fab fa-xing", "fab fa-xing-square", "fab fa-y-combinator", "fab fa-yahoo", "fab fa-yammer", "fab fa-yandex", "fab fa-yandex-international", "fab fa-yarn", "fab fa-yelp", "fas fa-yen-sign", "fas fa-yin-yang", "fab fa-yoast", "fab fa-youtube", "fab fa-youtube-square", "fab fa-zhihu" ];

}

function bizberg_get_fontawesome_options(){

	$data = array();
	foreach ( bizberg_font_awesome_5_icons_custom() as $value ) {
		
		$label_explode = explode( ' ' , $value );
		$label         = str_replace( 'fa-' , '', $label_explode[1] );
		$label         = str_replace( '-' , ' ', $label );
		$data[$value]  = ucwords( $label );

	}
	return $data;

}

/**
* Single Layout 2 Class
*/

add_filter( 'body_class', 'bizberg_single_post_layout_body_class' );
function bizberg_single_post_layout_body_class( $classes ){

	if( apply_filters( 'bizberg_single_post_layout', 1 ) == 2 ){
		$classes[] = 'single_layout_2';
		return $classes;
	}
	
	return $classes;

}