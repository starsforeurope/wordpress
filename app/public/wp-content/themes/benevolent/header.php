<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Benevolent
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head itemtype="https://schema.org/WebSite">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
<?php wp_body_open(); ?>
<div id="page" class="site">	
    <a class="skip-link screen-reader-text" href="#acc-content"><?php esc_html_e( 'Skip to content (Press Enter)', 'benevolent' ); ?></a>
    <div class="mobile-header">
        <div class="container">
            <?php 
                $site_title = get_bloginfo( 'name' );
                $description = get_bloginfo( 'description', 'display' );
                
                if( has_custom_logo() && ( $site_title || $description ) ) {
                    $add_class = 'logo-text';
                }else{
                    $add_class = '';
                }?>
                <div class="site-branding <?php echo esc_attr( $add_class ); ?>" itemscope itemtype="https://schema.org/Organization">
                
                    <?php if( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
                        echo '<div class="site-logo">';
                        the_custom_logo();
                        echo '</div>';
                    }?>
                    <div class="site-title-wrap">
                        <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                        <?php  
                    
                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) : ?>
                            <p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                        <?php endif; ?>
                    </div>
                </div><!-- .site-branding -->
            <div class="btn-donate">
                <?php 
                    $button_text = get_theme_mod( 'benevolent_button_text', __( 'Donate Now', 'benevolent' ) );
                    $button_url = get_theme_mod( 'benevolent_button_url' );
                    if( $button_text && $button_url ) echo '<a href="' . esc_url( $button_url ). '">' . esc_html( $button_text ) . '</a>';
                ?>
            </div>
            <button class="menu-opener" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div> <!-- container -->
        <div class="mobile-menu">
            <nav id="mobile-site-navigation" class="primary-menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
                    <button class="btn-menu-close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
                    <div class="mobile-menu-title" aria-label="<?php esc_attr_e( 'Mobile', 'benevolent' ); ?>">
                        <?php 
                        wp_nav_menu( array( 
                            'theme_location' => 'primary', 
                            'menu_id'        => 'mobile-primary-menu',
                            'menu_class'     => 'nav-menu main-menu-modal',
                        ) );
                        ?>
                    </div>
                    <?php
                        if( has_nav_menu( 'secondary' ) ) {  
                            wp_nav_menu( array( 
                                'theme_location' => 'secondary', 
                                'container'      => false,
                                'menu_id'        => 'secondary-menu', 
                                'fallback_cb'    => false 
                            ) );  
                        } ?>
                    <?php if( get_theme_mod( 'benevolent_ed_social_header' ) ) do_action( 'benevolent_social_links' ); ?>
                </div>
            </nav><!-- #site-navigation -->
        </div>
    </div> <!-- mobile-header -->
    
    <?php benevolent_header(); 

    $ed_breadcrumb    = get_theme_mod( 'benevolent_ed_breadcrumb' );
    $enabled_sections = benevolent_get_sections();
    
    if( ( is_front_page() || is_page_template( 'template-home.php' ) ) && get_theme_mod( 'benevolent_ed_slider' ) ) do_action( 'benevolent_slider' );
    echo '<div id="acc-content"><!-- done for accessibility reasons -->';
    if( is_home() || ! $enabled_sections || !( is_front_page() || is_page_template( 'template-home.php' ) ) ) echo '<div class="container">';
    
    //BreadCrumbs
    if( !( is_front_page() || is_page_template( 'template-home.php' ) ) && !is_404() && $ed_breadcrumb ) do_action( 'benevolent_breadcrumbs' ); 
        
   	if( is_home() || ! $enabled_sections || !( is_front_page() || is_page_template( 'template-home.php' ) ) ) echo '<div id="content" class="site-content"><div class="row">';
