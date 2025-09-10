<?php
/**
 * Benevolent functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Benevolent
 */

$benevolent_theme_data = wp_get_theme();
if( ! defined( 'BENEVOLENT_THEME_VERSION' ) ) define( 'BENEVOLENT_THEME_VERSION', $benevolent_theme_data->get( 'Version' ) );
if( ! defined( 'BENEVOLENT_THEME_NAME' ) ) define( 'BENEVOLENT_THEME_NAME', $benevolent_theme_data->get( 'Name' ) );
if( ! defined( 'BENEVOLENT_THEME_TEXTDOMAIN' ) ) define( 'BENEVOLENT_THEME_TEXTDOMAIN', $benevolent_theme_data->get( 'TextDomain' ) );

if ( ! function_exists( 'benevolent_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function benevolent_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Benevolent, use a find and replace
	 * to change 'benevolent' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'benevolent', get_template_directory() . '/languages' );
    
    // Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'   => esc_html__( 'Primary', 'benevolent' ),
        'secondary' => esc_html__( 'Secondary', 'benevolent' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',        
		'image',
		'video',
		'quote',
		'link',
        'gallery',
        'status',
        'audio', 
        'chat'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'benevolent_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    
    // Custom Image Size
    add_image_size( 'benevolent-slider', 1920, 967, true );
    add_image_size( 'benevolent-community', 960, 450, true );
    add_image_size( 'benevolent-blog', 350, 196, true );
    add_image_size( 'benevolent-with-sidebar', 780, 437, true );
    add_image_size( 'benevolent-without-sidebar', 1200, 437, true );
    add_image_size( 'benevolent-featured-post', 275, 275, true );
    add_image_size( 'benevolent-recent-post', 75, 75, true );
    
    /* Custom Logo */
    add_theme_support( 'custom-logo', array(
    	'header-text' => array( 'site-title', 'site-description' ),
    ) );

    add_theme_support( 'woocommerce' );

	remove_theme_support( 'widgets-block-editor' );
    
}
endif;
add_action( 'after_setup_theme', 'benevolent_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function benevolent_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'benevolent_content_width', 780 );
}
add_action( 'after_setup_theme', 'benevolent_content_width', 0 );

/**
* Adjust content_width value according to template.
*
* @return void
*/
function benevolent_template_redirect_content_width() {

	// Full Width in the absence of sidebar.
	if( is_page() ){
	   $sidebar_layout = benevolent_sidebar_layout();
       if( ( $sidebar_layout == 'no-sidebar' ) || ! ( is_active_sidebar( 'right-sidebar' ) ) ) $GLOBALS['content_width'] = 1200;
        
	}elseif ( ! ( is_active_sidebar( 'right-sidebar' ) ) ) {
		$GLOBALS['content_width'] = 1200;
	}

}
add_action( 'template_redirect', 'benevolent_template_redirect_content_width' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function benevolent_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'benevolent' ),
		'id'            => 'right-sidebar',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'benevolent' ),
		'id'            => 'footer-one',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'benevolent' ),
		'id'            => 'footer-two',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'benevolent' ),
		'id'            => 'footer-three',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Four', 'benevolent' ),
		'id'            => 'footer-four',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'benevolent_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function benevolent_scripts() {	
	$build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	
	if( get_theme_mod( 'ed_localgoogle_fonts',false ) && ! is_customize_preview() && ! is_admin() ){
        if ( get_theme_mod( 'ed_preload_local_fonts',false ) ) {
			benevolent_load_preload_local_fonts( benevolent_get_webfont_url( benevolent_fonts_url() ) );
        }
        wp_enqueue_style( 'benevolent-google-fonts', benevolent_get_webfont_url( benevolent_fonts_url() ) );
    }else{
    	wp_enqueue_style( 'benevolent-google-fonts', benevolent_fonts_url() );
	}
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css' . $build . '/owl.carousel' . $suffix . '.css', '', '2.2.1' );
    wp_enqueue_style( 'benevolent-style', get_stylesheet_uri() );
    
    wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '6.1.1', true );
    wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery' ), '6.1.1', false );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js' . $build . '/owl.carousel' . $suffix . '.js', array('jquery'), '2.2.1', true );
    wp_enqueue_script( 'owlcarousel2-a11ylayer', get_template_directory_uri() . '/js' . $build . '/owlcarousel2-a11ylayer' . $suffix . '.js', array('owl-carousel'), '0.2.1', true );
    wp_enqueue_script( 'waypoint', get_template_directory_uri() . '/js' . $build . '/waypoint' . $suffix . '.js', array('jquery'), '1.6.2', true );
    wp_enqueue_script( 'counterup', get_template_directory_uri() . '/js' . $build . '/jquery.counterup' . $suffix . '.js', array('jquery', 'waypoint'), '1.0', true );
    wp_enqueue_script( 'benevolent-modal-accessibility', get_template_directory_uri() . '/js' . $build . '/modal-accessibility' . $suffix . '.js', array( 'jquery' ), BENEVOLENT_THEME_VERSION, true );
    wp_register_script( 'benevolent-custom', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array('jquery'), BENEVOLENT_THEME_VERSION, true );
    
	$benevolent_slider_auto      = get_theme_mod( 'benevolent_slider_auto', '1' );
	$benevolent_slider_loop      = get_theme_mod( 'benevolent_slider_loop', '1' );
	$benevolent_slider_pager     = get_theme_mod( 'benevolent_slider_pager', '1' );    
	$benevolent_slider_animation = get_theme_mod( 'benevolent_slider_animation', 'slide' );
	$benevolent_slider_speed     = get_theme_mod( 'benevolent_slider_speed', '7000' );
	$benevolent_animation_speed  = get_theme_mod( 'benevolent_animation_speed', '600' );
    
    $benevolent_array = array(
		'auto'      => esc_attr( $benevolent_slider_auto ),
		'loop'      => esc_attr( $benevolent_slider_loop ),
		'pager'     => esc_attr( $benevolent_slider_pager ),
		'animation' => esc_attr( $benevolent_slider_animation ),
		'speed'     => absint( $benevolent_slider_speed ),
		'a_speed'   => absint( $benevolent_animation_speed ),
		'rtl'       => is_rtl(),
    );
    
    wp_localize_script( 'benevolent-custom', 'benevolent_data', $benevolent_array );
    wp_enqueue_script( 'benevolent-custom' );
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'benevolent_scripts' );

function benevolent_admin_scripts() {
	wp_enqueue_style( 'benevolent-admin-style',get_template_directory_uri().'/inc/css/admin.css','', BENEVOLENT_THEME_VERSION );
}
add_action( 'admin_enqueue_scripts', 'benevolent_admin_scripts' );

if( ! function_exists( 'benevolent_admin_notice' ) ) :
/**
 * Addmin notice for getting started page
*/
function benevolent_admin_notice(){
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'benevolent_admin_notice' );
    $name            = $theme_args->__get( 'Name' );
    $current_screen  = get_current_screen();
    $dismissnonce = wp_create_nonce( 'benevolent_admin_notice' );

    if( 'themes.php' == $pagenow && !$meta ){
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ){
            return;
        }

        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } ?>

        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'benevolent' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'benevolent' ), esc_html( $name ) ) ; ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=benevolent-dashboard' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the dashboard.', 'benevolent' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?benevolent_admin_notice=1&_wpnonce=<?php echo esc_attr( $dismissnonce ); ?>"><?php esc_html_e( 'Dismiss', 'benevolent' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'benevolent_admin_notice' );

if( ! function_exists( 'benevolent_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function benevolent_update_admin_notice(){
	if (!current_user_can('manage_options')) {
        return;
    }

    // Bail if the nonce doesn't check out
    if ( isset( $_GET['benevolent_admin_notice'] ) && $_GET['benevolent_admin_notice'] === '1' && wp_verify_nonce( $_GET['_wpnonce'], 'benevolent_admin_notice' ) ) {
        update_option( 'benevolent_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'benevolent_update_admin_notice' );

/**
 * Implement Local Font Method functions.
 */
require get_template_directory() . '/inc/class-webfont-loader.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Meta Box.
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Featured Post Widget
 */
require get_template_directory() . '/inc/widget-featured-post.php';

/**
 * Recent Post Widget
 */
require get_template_directory() . '/inc/widget-recent-post.php';

/**
 * Popular Post Widget
 */
require get_template_directory() . '/inc/widget-popular-post.php';

/**
 * Social Link Widget
 */
require get_template_directory() . '/inc/widget-social-links.php';

/**
 * Dashboard
*/
require get_template_directory() . '/inc/dashboard/dashboard.php';

/**
 * Theme Info
 */
require get_template_directory() . '/inc/info.php';

/**
* Recommended Plugins
*/
require_once get_template_directory() . '/inc/tgmpa/recommended-plugins.php';