<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Gradiant
 */

if ( ! function_exists( 'gradiant_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function gradiant_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'gradiant' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'gradiant' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'gradiant_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function gradiant_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'gradiant' ) );
		if ( $categories_list && gradiant_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'gradiant' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'gradiant' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'gradiant' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'gradiant' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'gradiant' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function gradiant_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'gradiant_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'gradiant_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so gradiant_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so gradiant_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in gradiant_categorized_blog.
 */
function gradiant_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'gradiant_categories' );
}
add_action( 'edit_category', 'gradiant_category_transient_flusher' );
add_action( 'save_post',     'gradiant_category_transient_flusher' );

/**
 * Function that returns if the menu is sticky
 */
if (!function_exists('gradiant_sticky_menu')):
    function gradiant_sticky_menu()
    {
        $is_sticky = get_theme_mod('hide_show_sticky','1');

        if ($is_sticky == '1'):
            return 'sticky-nav ';
        else:
            return 'not-sticky';
        endif;
    }
endif;


/**
 * Register Google fonts for gradiant.
 */
function gradiant_google_font() {
	
    $get_fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900');
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $get_fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return $get_fonts_url;
}

function gradiant_scripts_styles() {
    wp_enqueue_style( 'gradiant-fonts', gradiant_google_font(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'gradiant_scripts_styles' );


/**
 * Register Breadcrumb for Multiple Variation
 */
function gradiant_breadcrumbs_style() {
	get_template_part('./template-parts/sections/section','breadcrumb');			
}


/**
 * This Function Check whether Sidebar active or Not
 */
if(!function_exists( 'gradiant_post_layout' )) :
function gradiant_post_layout(){
	if(is_active_sidebar('gradiant-sidebar-primary'))
		{ echo 'av-column-8'; } 
	else 
		{ echo 'av-column-10 mx-auto'; }  
} endif;



if( ! function_exists( 'gradiant_dynamic_style' ) ):
    function gradiant_dynamic_style() {

		$output_css = '';
		
			
		 /**
		 *  Breadcrumb Style
		 */
		$breadcrumb_min_height			= get_theme_mod('breadcrumb_min_height','246');	
		
		if($breadcrumb_min_height !== '') { 
				$output_css .=".breadcrumb-content {
					min-height: " .esc_attr($breadcrumb_min_height). "px;
				}\n";
			}
		
		$breadcrumb_bg_img			= get_theme_mod('breadcrumb_bg_img',esc_url(get_template_directory_uri() .'/assets/images/breadcrumb/breadcrumb.jpg')); 
		$breadcrumb_back_attach		= get_theme_mod('breadcrumb_back_attach','scroll'); 

		if($breadcrumb_bg_img !== '') { 
			$output_css .=".breadcrumb-area {
					background-image: url(" .esc_url($breadcrumb_bg_img). ");
					background-attachment: " .esc_attr($breadcrumb_back_attach). ";
				}\n";
		}else{
			$output_css .=".breadcrumb-area {
				 background: var(--sp-gradient2);
			}\n";
		}
		
		
		$gradiant_site_cntnr_width 			 = get_theme_mod('gradiant_site_cntnr_width','1170');
			if($gradiant_site_cntnr_width >=768 && $gradiant_site_cntnr_width <=2000){
				$output_css .=".av-container {
						max-width: " .esc_attr($gradiant_site_cntnr_width). "px;
					}\n";
			}

		$footer_effect_enable	= get_theme_mod('footer_effect_enable','1');
		$footer_bg_img			= get_theme_mod('footer_bg_img',esc_url(get_template_directory_uri() .'/assets/images/footer/footer_bg.jpg'));
		
		if($footer_effect_enable=='1'){
			if(!empty($footer_bg_img)):
				 $output_css .=".footer-section.footer-one{ 
					background-image: url(".esc_url($footer_bg_img).");
					background-blend-mode: multiply;
				}.footer-section.footer-one:after{
					content: '';
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
					opacity: 0.75;
					background: #000000 none repeat scroll 0 0;
					z-index: -1;
				}\n";
			endif;
		}else{
			if(!empty($footer_bg_img)):
				 $output_css .=".footer-section.footer-one{ 
					background: url(".esc_url($footer_bg_img).") no-repeat scroll center center / cover rgba(0, 0, 0, 0.75);
					background-blend-mode: multiply;
				}\n";
			endif;
		}
		
			
		/**
		 *  Background Elements
		 */
		$hs_bg_elements	= get_theme_mod('hs_bg_elements','1');	
		
		if($hs_bg_elements ==''):
			 $output_css .=".bg-elements { 
					   display:none;
				}\n";	
		endif; 	
		
		
		/**
		 *  Parallax
		 */
		$footer_parallax_enable	= get_theme_mod('footer_parallax_enable','1');	
		$footer_parallax_margin	= get_theme_mod('footer_parallax_margin','775');	
		
		if($footer_parallax_enable =='1'):
			 $output_css .="@media (min-width: 992px){.footer-parallax .gradiant-content { 
					 margin-bottom: ".esc_attr($footer_parallax_margin)."px;
			 }}\n";	
		endif; 	
        wp_add_inline_style( 'gradiant-style', $output_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'gradiant_dynamic_style' );