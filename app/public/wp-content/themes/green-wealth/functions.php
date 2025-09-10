<?php

require get_stylesheet_directory() . '/sections/services.php';
require get_stylesheet_directory() . '/sections/why-choose-us.php';
require get_stylesheet_directory() . '/customizer/options-services.php';
require get_stylesheet_directory() . '/customizer/options-why-choose-us.php';

add_action( 'wp_enqueue_scripts', 'green_wealth_chld_thm_parent_css' );
function green_wealth_chld_thm_parent_css() {

    wp_enqueue_style( 
    	'green_wealth_chld_css', 
    	trailingslashit( get_template_directory_uri() ) . 'style.css', 
    	array( 
    		'bootstrap',
    		'font-awesome-5',
    		'bizberg-main',
    		'bizberg-component',
    		'bizberg-style2',
    		'bizberg-responsive' 
    	) 
    );

    if ( is_rtl() ) {
        wp_enqueue_style( 
            'green_wealth_parent_rtl',
            trailingslashit( get_template_directory_uri() ) . 'rtl.css'
        );
    }

    wp_enqueue_script( 'green_wealth_scripts', get_stylesheet_directory_uri() . '/script.js', array('jquery') );
    
}

add_filter( 'bizberg_sidebar_settings', 'green_wealth_sidebar_settings' );
function green_wealth_sidebar_settings(){
	return '4';
}

/**
* Change the theme color
*/
add_filter( 'bizberg_theme_color', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_header_menu_color_hover_sticky_menu', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_header_button_color_sticky_menu', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_header_button_color_hover_sticky_menu', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_header_menu_color_hover', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_header_button_color', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_header_button_color_hover', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_slider_title_box_highlight_color', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_slider_arrow_background_color', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_slider_dot_active_color', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_read_more_background_color', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_read_more_background_color_2', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_link_color', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_link_color_hover', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_blog_listing_pagination_active_hover_color', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_sidebar_widget_link_color_hover', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_sidebar_widget_title_color', 'green_wealth_change_theme_color' );
add_filter( 'bizberg_footer_social_icon_background', 'green_wealth_change_theme_color' );
function green_wealth_change_theme_color(){
    return '#6ab43e';
}

add_filter( 'bizberg_header_button_border_color', 'green_wealth_btn_border_color' );
add_filter( 'bizberg_header_button_border_color_sticky_menu', 'green_wealth_btn_border_color' );
function green_wealth_btn_border_color(){
    return '#478a41';
}

add_filter( 'bizberg_slider_gradient_primary_color', 'green_wealth_slider_gradient_primary_color' );
function green_wealth_slider_gradient_primary_color(){
    return 'rgba(106,180,62,0.65)';
}

add_filter( 'bizberg_footer_social_icon_color', 'green_wealth_footer_social_icon_color' );
function green_wealth_footer_social_icon_color(){
    return '#fff';
}

add_filter( 'bizberg_banner_title', 'green_wealth_banner_title' );
function green_wealth_banner_title(){
    return esc_html__( 'Time to change by planting trees' , 'green-wealth' );
}

add_action( 'after_setup_theme', 'green_wealth_setup_theme' );
function green_wealth_setup_theme() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
}

add_filter( 'bizberg_banner_image', 'green_wealth_banner_image' );
function green_wealth_banner_image(){
    return [
        'background-color'      => 'rgba(20,20,20,.8)',
        'background-image'      => get_stylesheet_directory_uri() . '/assets/images/landscape-tree-nature-forest-outdoor-wilderness-839604-pxhere.com.jpg',
        'background-repeat'     => 'repeat',
        'background-position'   => 'center center',
        'background-size'       => 'cover',
        'background-attachment' => 'scroll',
    ];
}

add_filter( 'bizberg_footer_social_links' , 'green_wealth_footer_social_links' );
function green_wealth_footer_social_links(){
    return [];
}

add_filter( 'bizberg_theme_output_css', 'green_wealth_theme_output_css' );
function green_wealth_theme_output_css( $css ){
    $css[] = array(
        'element'       => '.give-form input[type="submit"], .give-donor__load_more, .nacep-ee-list .event-content input[type="submit"], .nacep-form .em-tickets-form button[type=button], .nacep-form button[type="submit"], .nacep-form input[type="submit"],.nacep-form button[type="submit"]:hover, .nacep-form button[type="submit"]:focus, .give-form input[type="submit"]:hover, .give-form input[type="submit"]:focus, .give-donor__load_more:hover, .give-donor__load_more:focus, .nacep-ee-list .event-content input[type="submit"]:hover, .nacep-ee-list .event-content input[type="submit"]:focus, .nacep-form .em-tickets-form button[type=button]:hover, .nacep-form .em-tickets-form button[type=button]:focus, .nacep-form input[type="submit"]:hover, .nacep-form input[type="submit"]:focus',
        'property'      => 'background',
        'value_pattern' => '$'
    );
    return $css;
}

add_filter( 'bizberg_recommended_plugins', 'green_wealth_recommended_plugins' );
function green_wealth_recommended_plugins( $plugins ){

    array_push( $plugins , array(
        'name'     => esc_html__( 'Charity Addon for Elementor', 'green-wealth' ),
        'slug'     => 'charity-addon-for-elementor',
        'required' => false,
    ));

    array_push( $plugins , array(
        'name'     => esc_html__( 'GiveWP – Donation Plugin and Fundraising Platform', 'green-wealth' ),
        'slug'     => 'give',
        'required' => false,
    ));

    return $plugins;

}

add_filter( 'bizberg_getting_started_screenshot', 'green_wealth_getting_started_screenshot' );
function green_wealth_getting_started_screenshot(){
    return true;
}

add_action( 'after_switch_theme', 'green_wealth_switch_theme' );
function green_wealth_switch_theme() {

    $flag = get_theme_mod( 'green_wealth_copy_settings', false );

    if ( true === $flag ) {
        return;
    }

    foreach( Kirki::$fields as $field ) {
        set_theme_mod( $field["settings"],$field["default"] );
    }

    //Set flag
    set_theme_mod( 'green_wealth_copy_settings', true );
    
}