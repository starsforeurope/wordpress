<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Benevolent
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function benevolent_body_classes( $classes ) {
  
    global $post;
    
    // Adds a class of group-blog to blogs with more than 1 published author.
  if ( is_multi_author() ) {
    $classes[] = 'group-blog';
  }

  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }
    
    // Adds a class of custom-background-image to sites with a custom background image.
  if ( get_background_image() ) {
    $classes[] = 'custom-background-image';
  }
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
    $classes[] = 'custom-background-color';
  }
    
    if( !( is_active_sidebar( 'right-sidebar' )) || is_page_template( 'template-home.php' ) || is_search() ) {
    $classes[] = 'full-width';  
  }
    
    if( is_page() ){
    $sidebar_layout = get_post_meta( $post->ID, 'benevolent_sidebar_layout', true );
        if( $sidebar_layout == 'no-sidebar' )
    $classes[] = 'full-width';
  }
    
    if( get_theme_mod( 'benevolent_ed_slider' ) ){
     $classes[] = 'has-slider';
  }
    
  return $classes;
}
add_filter( 'body_class', 'benevolent_body_classes' );

/**
 * Custom Bread Crumb
 *
 * @link https://www.qualitytuts.com/wordpress-custom-breadcrumbs-without-plugin/
 */
function benevolent_breadcrumbs_cb() {    
    global $post;
    
    $post_page   = get_option( 'page_for_posts' ); //The ID of the page that displays posts.
    $show_front  = get_option( 'show_on_front' ); //What to show on the front page
    $showCurrent = get_theme_mod( 'benevolent_ed_current', '1' ); // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $delimiter   = get_theme_mod( 'benevolent_breadcrumb_separator', __( '>', 'benevolent' ) ); // delimiter between crumbs
    $home        = get_theme_mod( 'benevolent_breadcrumb_home_text', __( 'Home', 'benevolent' ) ); // text for the 'Home' link
    $before      = '<span class="current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">'; // tag before the current crumb
    $after       = '</span>'; // tag after the current crumb
      
    $depth = 1;    
    echo '<div id="crumbs" itemscope itemtype="https://schema.org/BreadcrumbList"><span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( home_url() ) . '" class="home_crumb"><span itemprop="name">' . esc_html( $home ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
        if( is_home() && ! is_front_page() ){            
            $depth = 2;
            if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( single_post_title( '', false ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;          
        }elseif( is_category() ){            
            $depth = 2;
            $thisCat = get_category( get_query_var( 'cat' ), false );
            if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                $p = get_post( $post_page );
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( $post_page ) ) . '"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth ++;  
            }

            if ( $thisCat->parent != 0 ) {
                $parent_categories = get_category_parents( $thisCat->parent, false, ',' );
                $parent_categories = explode( ',', $parent_categories );

                foreach ( $parent_categories as $parent_term ) {
                    $parent_obj = get_term_by( 'name', $parent_term, 'category' );
                    if( is_object( $parent_obj ) ){
                        $term_url    = get_term_link( $parent_obj->term_id );
                        $term_name   = $parent_obj->name;
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                        $depth ++;
                    }
                }
            }

            if( $showCurrent ) echo $before . '<span itemprop="name">' .  esc_html( single_cat_title( '', false ) ) . '</span><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;

        }elseif( is_tag() ){            
            $queried_object = get_queried_object();
            $depth = 2;

            if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( single_tag_title( '', false ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;    
        }elseif( is_author() ){            
            $depth = 2;
            global $author;
            $userdata = get_userdata( $author );
            if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $userdata->display_name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;  
        }elseif( is_day() ){            
            $depth = 2;
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'benevolent' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'benevolent' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
            $depth ++;
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'benevolent' ) ), get_the_time( __( 'm', 'benevolent' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'F', 'benevolent' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
            $depth ++;
            if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'd', 'benevolent' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
             
        }elseif( is_month() ){            
            $depth = 2;
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'benevolent' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'benevolent' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
            $depth++;
            if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'F', 'benevolent' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
        }elseif( is_year() ){            
            $depth = 2;
            if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'Y', 'benevolent' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 
        }elseif( is_single() && !is_attachment() ) {           
             
            //For Post                
            $cat_object       = get_the_category();
            $potential_parent = 0;
            $depth            = 2;
            
            if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                $p = get_post( $post_page );
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $post_page ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';  
                $depth++;
            }
            
            if( is_array( $cat_object ) ){ //Getting category hierarchy if any
    
                //Now try to find the deepest term of those that we know of
                $use_term = key( $cat_object );
                foreach( $cat_object as $key => $object ){
                    //Can't use the next($cat_object) trick since order is unknown
                    if( $object->parent > 0  && ( $potential_parent === 0 || $object->parent === $potential_parent ) ){
                        $use_term = $key;
                        $potential_parent = $object->term_id;
                    }
                }
                
                $cat = $cat_object[$use_term];
                
                if( $cat ){
                    $cats = get_category_parents( $cat, false, ',' );
                    $cats = explode( ',', $cats );

                    foreach ( $cats as $cat ) {
                        $cat_obj = get_term_by( 'name', $cat, 'category' );
                        if( is_object( $cat_obj ) ){
                            $term_url    = get_term_link( $cat_obj->term_id );
                            $term_name   = $cat_obj->name;
                            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                            $depth ++;
                        }
                    }
                }
            }

            if ( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;        
        }elseif( is_page() ){            
            $depth = 2;
            if( $post->post_parent ){            
                global $post;
                $depth = 2;
                $parent_id  = $post->post_parent;
                $breadcrumbs = array();
                
                while( $parent_id ){
                    $current_page  = get_post( $parent_id );
                    $breadcrumbs[] = $current_page->ID;
                    $parent_id     = $current_page->post_parent;
                }
                $breadcrumbs = array_reverse( $breadcrumbs );
                for ( $i = 0; $i < count( $breadcrumbs); $i++ ){
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $breadcrumbs[$i] ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $breadcrumbs[$i] ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></span>';
                    if ( $i != count( $breadcrumbs ) - 1 ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ';
                    $depth++;
                }

                if ( $showCurrent ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' . $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" /></span>'. $after;      
            }else{
                if ( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 
            }
        }elseif( is_search() ){            
            $depth = 2;
            if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html__( 'Search Results for "', 'benevolent' ) . esc_html( get_search_query() ) . esc_html__( '"', 'benevolent' ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
        }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {            
            $depth = 2;
            $post_type = get_post_type_object(get_post_type());
            if( get_query_var('paged') ){
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $post_type->label ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />';
                echo ' <span class="separator">' . $delimiter . '</span></span> ' . $before . sprintf( __('Page %s', 'benevolent'), get_query_var('paged') ) . $after;
            }elseif( is_archive() ){
                echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            }else{
                echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            }              
        }elseif( is_attachment() ){            
            $depth  = 2;
            $parent = get_post( $post->post_parent );
            $cat    = get_the_category( $parent->ID );
            if( $cat ){
                $cat = $cat[0];
                echo get_category_parents( $cat, TRUE, ' <span class="separator">' . $delimiter . '</span> ');
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $parent ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $parent->post_title ) . '<span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . ' <span class="separator">' . $delimiter . '</span></span>';
            }
            if( $showCurrent ) echo $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;   
        }elseif ( is_404() ){
            if( $showCurrent ) echo $before . esc_html__( '404 Error - Page not Found', 'benevolent' ) . $after;
        }
        if( get_query_var('paged') ) echo __( ' (Page', 'benevolent' ) . ' ' . get_query_var('paged') . __( ')', 'benevolent' );        
        echo '</div>';
} // end benevolent_breadcrumbs()
add_action( 'benevolent_breadcrumbs', 'benevolent_breadcrumbs_cb' );

/**
 * Social Links Callback 
 */
function benevolent_social_links_cb(){
    
    $facebook  = get_theme_mod( 'benevolent_facebook' );
    $twitter   = get_theme_mod( 'benevolent_twitter' );
    $pinterest = get_theme_mod( 'benevolent_pinterest' );
    $linkedin  = get_theme_mod( 'benevolent_linkedin' );
    $instagram = get_theme_mod( 'benevolent_instagram' );
    $youtube   = get_theme_mod( 'benevolent_youtube' );
    $tiktok    = get_theme_mod( 'benevolent_tiktok' );
    
    if( $facebook || $twitter || $pinterest || $linkedin || $instagram || $youtube || $tiktok ){ ?>
    <ul class="social-networks">
        <?php if( $facebook ){ ?>
            <li><a href="<?php echo esc_url( $facebook ); ?>" target="_blank" title="<?php esc_attr_e( 'Facebook', 'benevolent' );?>"><i class="fa fa-facebook" ></i></a></li>
        <?php } if( $twitter ){ ?>
            <li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank" title="<?php esc_attr_e( 'Twitter', 'benevolent' );?>"><i class="fab fa-x-twitter" ></i></a></li>
            <?php } if( $pinterest ){ ?>
            <li><a href="<?php echo esc_url( $pinterest ); ?>" target="_blank" title="<?php esc_attr_e( 'Pinterest', 'benevolent' );?>"><i class="fa fa-pinterest" ></i></a></li>
        <?php } if( $linkedin ){ ?>
            <li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" title="<?php esc_attr_e( 'LinkedIn', 'benevolent' );?>"><i class="fa fa-linkedin" ></i></a></li>
        <?php } if( $instagram ){ ?>
            <li><a href="<?php echo esc_url( $instagram ); ?>" target="_blank" title="<?php esc_attr_e( 'Instagram', 'benevolent' );?>"><i class="fa fa-instagram" ></i></a></li>
        <?php } if( $youtube ){ ?>
            <li><a href="<?php echo esc_url( $youtube ); ?>" target="_blank" title="<?php esc_attr_e( 'YouTube', 'benevolent' );?>"><i class="fa fa-youtube-play" ></i></a></li>
        <?php } if( $tiktok ){ ?>
            <li><a href="<?php echo esc_url( $tiktok ); ?>" target="_blank" title="<?php esc_attr_e( 'Tiktok', 'benevolent' );?>"><i class="fab fa-tiktok" ></i></a></li>
        <?php } ?>
    </ul>
    <?php 
    }
}
add_action( 'benevolent_social_links' , 'benevolent_social_links_cb' );

/**
 * Callback function for Comment List *
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
function benevolent_theme_comment($comment, $args, $depth){
  if ( 'div' == $args['style'] ) {
    $tag = 'div';
    $add_below = 'comment';
  } else {
    $tag = 'li';
    $add_below = 'div-comment';
  }
?>
  <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
  <?php if ( 'div' != $args['style'] ) : ?>
  <div id="div-comment-<?php comment_ID() ?>" class="comment-body" itemscope itemtype="https://schema.org/UserComments">
  <?php endif; ?>
  
    <footer class="comment-meta">
    
        <div class="comment-author vcard">
      <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
      <?php printf( __( '<b class="fn" itemprop="creator" itemscope itemtype="https://schema.org/Person">%s</b>', 'benevolent' ), get_comment_author_link() ); ?>
      </div>
      <?php if ( $comment->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'benevolent' ); ?></em>
        <br />
      <?php endif; ?>
    
      <div class="comment-metadata commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
        <time datetime="<?php comment_date(); ?>">
        <?php echo get_comment_date(); ?></time></a><?php edit_comment_link( __( '(Edit)', 'benevolent' ), '  ', '' );
        ?>
      </div>
    </footer>
    
    <div class="comment-content"><?php comment_text(); ?></div>

  <div class="reply">
  <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
  </div>
  <?php if ( 'div' != $args['style'] ) : ?>
  </div>
  <?php endif; ?>
<?php
}

/**
 * Fuction to get Sections 
 */
function benevolent_get_sections(){ 
    $sections = array( 
        'intro-section' => array(
            'class' => 'intro',
            'id'    => 'intro'    
        ),
        'community-section' => array(
            'class' => 'our-community',
            'id'    => 'community'
        ),
        'stats-section' => array(
            'class' => 'stats',
            'id'    => 'stats'
        ),
        'blog-section' => array(
            'class' => 'blog-section',
            'id'    => 'blog'
        ),
        'sponsor-section' => array(
            'class' => 'sponsors',
            'id'    => 'sponsor'
        )              
    );
        
    $enabled_section = array();
    foreach ( $sections as $section ) {
        
        if ( esc_attr( get_theme_mod( 'benevolent_ed_' . $section['id'] . '_section' ) ) == 1 ){
            $enabled_section[] = array(
                'id' => $section['id'],
                'class' => $section['class']
            );
        }
    }
    return $enabled_section;
}
 
/**
 * Callback for Banner Slider 
 */
function benevolent_slider_cb(){

    $slider_caption  = get_theme_mod( 'benevolent_slider_caption', '1' );
    $slider_readmore = get_theme_mod( 'benevolent_slider_readmore', __( 'Learn More', 'benevolent' ) );
    $slider_cat      = get_theme_mod( 'benevolent_slider_cat' );
    
    if( $slider_cat ){
        $slider_qry = new WP_Query( array( 
            'post_type'             => 'post', 
            'post_status'           => 'publish',
            'posts_per_page'        => -1,                    
            'cat'                   => $slider_cat,
            'ignore_sticky_posts'   => true
        ) );
        if( $slider_qry->have_posts() ){
            echo '<div class="banner"><ul id="banner-slider" class="owl-carousel">';            
                while( $slider_qry->have_posts()) {
                    $slider_qry->the_post();
                    if( has_post_thumbnail() ){ ?>
                        <li>
                            <?php 
                            the_post_thumbnail( 'benevolent-slider', array( 'itemprop' => 'image' ) ); 
                            if( $slider_caption ){ ?>
                                <div class="banner-text">
                                    <div class="container">
                                        <div class="text">
                                          <h2 class="main-title"><?php the_title(); ?></h2>
                                          <?php 
                                            if( has_excerpt() ) the_excerpt(); 

                                            if ( $slider_readmore ) echo '<a href="'. get_the_permalink() .'" class="btn-learn">'. esc_html( $slider_readmore ) .'</a>';
                                                
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </li>
                    <?php }
                } 
            echo '</ul></div>';
            wp_reset_postdata(); 
        }
    }   
}
add_action( 'benevolent_slider', 'benevolent_slider_cb' );
 
/**
 * Callback Function for Promotional Block 
 */
function benevolent_promotional_cb(){

    $ed_promotional_section    = get_theme_mod( 'benevolent_ed_promotional_section' );
    $promotional_section_title = get_theme_mod( 'benevolent_promotional_section_title' );
    $promotional_button_text   = get_theme_mod( 'benevolent_promotional_button_text' );
    $promotional_button_url    = get_theme_mod( 'benevolent_promotional_button_url' );
    $promotional_section_bg    = get_theme_mod( 'benevolent_promotional_section_bg' );
    
    if( $ed_promotional_section ){
    ?>
    <div class="promotional-block" <?php if( $promotional_section_bg ) echo 'style="background: url(' . esc_url( $promotional_section_bg ) . '); background-size: cover; background-repeat: no-repeat; background-position: center;"';?>>
        <div class="container">
            <div class="text">
            <?php 
                if( $promotional_section_title ) echo '<h3 class="title">' . esc_html( $promotional_section_title ) . '</h3>';
                if( $promotional_button_url && $promotional_button_text ) echo '<a href="' . esc_url( $promotional_button_url ) . '" class="btn-donate" target="_blank">' . esc_html( $promotional_button_text ) . '</a>';
            ?>
            </div>
        </div>
    </div>
    <?php
    }
}
add_action( 'benevolent_promotional', 'benevolent_promotional_cb' );

/**
 * Helper function for listing Intro section
*/
function benevolent_intro_helper( $image, $logo, $title, $link, $url, $ed_new_tab ){
    
    if( $image ){
        $img = wp_get_attachment_image_src( $image, 'full' );
        $log = wp_get_attachment_image_src( $logo, 'full' );
        
        echo '<div class="columns-3">';
        echo '<div class="img-holder"><img src="' . esc_url( $img[0] ) . '" alt="' . esc_attr( $title ) . '" /></div>';
        
        if( $logo ) echo '<div class="icon-holder"><img src="' . esc_url( $log[0] ) .'" alt="' . esc_attr( $title ) . '" /></div>';
        
        if( $title || $url ){ 
          $target = $ed_new_tab ? ' target="_blank"' : '';
          echo '<div class="text-holder">';
          if( $title ) echo '<strong class="title">' . esc_html( $title ) . '</strong>'; 
          if( $url && $link ) echo '<a class="btn" href="' . esc_url( $url ) . '"'. $target .'>' . esc_html( $link ) . '<span class="fa fa-angle-right"></span></a>';
                echo '</div>';
        } 
        echo '</div>';
    }
    
}

/**
 * Helper function for listing sponsor 
*/
function benevolent_sponsor_helper( $logo, $url ){
    
    if( $url ) echo '<a href="' . esc_url( $url ) . '" target="_blank">'; 
    if( $logo ) echo '<div class="columns-5"><img src="' . esc_url( $logo ) . '" alt=""></div>';
    if( $url ) echo '</a>';
     
}

/**
 * Helper function for listing stat counter
*/
function benevolent_stat_helper( $title, $counter ){
    if( $counter ){ ?>
        <div class="columns-4">
      <strong class="number"><?php echo absint( $counter );?></strong>
      <?php if( $title ) echo '<span>' . esc_html( $title ) . '</span>'; ?>
    </div>
    <?php }
}

/**
 * Custom CSS
*/
if ( function_exists( 'wp_update_custom_css_post' ) ) {
    // Migrate any existing theme CSS to the core option added in WordPress 4.7.
    $css = get_theme_mod( 'benevolent_custom_css' );
    if ( $css ) {
        $core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
        $return = wp_update_custom_css_post( $core_css . $css );
        if ( ! is_wp_error( $return ) ) {
            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
            remove_theme_mod( 'benevolent_custom_css' );
        }
    }
} else {
    // Back-compat for WordPress < 4.7.
      function benevolent_custom_css(){
      $custom_css = get_theme_mod( 'benevolent_custom_css' );
      if( !empty( $custom_css ) ){
        echo '<style type="text/css">';
        echo wp_strip_all_tags( $custom_css );
        echo '</style>';
      }
    }
    add_action( 'wp_head', 'benevolent_custom_css', 100 );
}


if ( ! function_exists( 'benevolent_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function benevolent_excerpt_more( $more ) {
  return is_admin() ? $more : ' &hellip; ';
}
add_filter( 'excerpt_more', 'benevolent_excerpt_more' );
endif;

if ( ! function_exists( 'benevolent_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function benevolent_excerpt_length( $length ) {
  return is_admin() ? $length : 60;
}
add_filter( 'excerpt_length', 'benevolent_excerpt_length', 999 );
endif;

if( ! function_exists( 'benevolent_footer_credit' ) ) :
/**
 * Footer Credits 
*/
function benevolent_footer_credit(){
    $copyright_text = get_theme_mod( 'benevolent_footer_copyright_text' );
    $text  = '<div class="site-info"><div class="container">';
    $text .= '<span class="copyright">';
      if( $copyright_text ){
        $text .=  wp_kses_post( $copyright_text );
      }else{
        $text .=  esc_html__( '&copy; ', 'benevolent' ) . date_i18n( esc_html__( 'Y', 'benevolent' ) ); 
        $text .= ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
      }
    $text .= '.</span>';
    if ( function_exists( 'the_privacy_policy_link' ) ) {
       $text .= get_the_privacy_policy_link();
   }
    $text .= '<span class="by">';
    $text .= esc_html__( 'Benevolent | Developed By ', 'benevolent' );
    $text .= '<a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Rara Themes', 'benevolent' ) . '</a>. ';
    $text .= sprintf( esc_html__( 'Powered by %s', 'benevolent' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'benevolent' ) ) .'" target="_blank">WordPress</a>.' );
    $text .= '</span></div></div>';
    echo apply_filters( 'benevolent_footer_text', $text );    
}
endif;
add_action( 'benevolent_footer', 'benevolent_footer_credit' );

/**
 * Return sidebar layouts for pages
*/
function benevolent_sidebar_layout(){
    global $post;
    
    if( get_post_meta( $post->ID, 'benevolent_sidebar_layout', true ) ){
        return get_post_meta( $post->ID, 'benevolent_sidebar_layout', true );    
    }else{
        return 'right-sidebar';
    }
}

/**
 * Strip specific tags from string
 * @link https://www.altafweb.com/2011/12/remove-specific-tag-from-php-string.html
*/
function benevolent_strip_single( $tag, $string ){
    $string = preg_replace('/<'.$tag.'[^>]*>/i', '', $string);
    $string = preg_replace('/<\/'.$tag.'>/i', '', $string);
    return $string;
} 


if( ! function_exists( 'benevolent_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function benevolent_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'benevolent_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function benevolent_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $required = ( $req ? " required" : '' );
    $author   = ( $req ? __( 'Name*', 'benevolent' ) : __( 'Name', 'benevolent' ) );
    $email    = ( $req ? __( 'Email*', 'benevolent' ) : __( 'Email', 'benevolent' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'benevolent' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $author ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'benevolent' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $email ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'benevolent' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'benevolent' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'benevolent_change_comment_form_default_fields' );

if( ! function_exists( 'benevolent_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function benevolent_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'benevolent' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'benevolent' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'benevolent_change_comment_form_defaults' );

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
	/**
	 * Triggered after the opening <body> tag.
    */
	do_action( 'wp_body_open' );
}
endif;

if( ! function_exists( 'benevolent_get_image_sizes' ) ) :
/**
 * Get information about available image sizes
 */
function benevolent_get_image_sizes( $size = '' ) {
 
    global $_wp_additional_image_sizes;
 
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
 
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array( 
                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    } 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
endif;

if ( ! function_exists( 'benevolent_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function benevolent_get_fallback_svg( $post_thumbnail ) {
    if( ! $post_thumbnail ){
        return;
    }
    
    $image_size = benevolent_get_image_sizes( $post_thumbnail );
     
    if( $image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:#d0cfcf;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

if( ! function_exists( 'benevolent_fonts_url' ) ) :
/**
 * Register custom fonts.
 */
function benevolent_fonts_url() {
    $fonts_url = '';

    /*
    * translators: If there are characters in your language that are not supported
    * by Raleway, translate this to 'off'. Do not translate into your own language.
    */
    $raleway = _x( 'on', 'Raleway font: on or off', 'benevolent' );

    if ( 'off' !== $raleway ) {
        $font_families = array();

        $font_families[] = 'Raleway:400,500,600,700';

        $query_args = array(
            'family'  => urlencode( implode( '|', $font_families ) ),
            'display' => urlencode( 'fallback' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url( $fonts_url );
}
endif;

if( ! function_exists( 'benevolent_load_preload_local_fonts') ) :
/**
 * Get the file preloads.
 *
 * @param string $url    The URL of the remote webfont.
 * @param string $format The font-format. If you need to support IE, change this to "woff".
 */
function benevolent_load_preload_local_fonts( $url, $format = 'woff2' ) {

    // Check if cached font files data preset present or not. Basically avoiding 'benevolent_WebFont_Loader' class rendering.
    $local_font_files = get_site_option( 'benevolent_local_font_files', false );

    if ( is_array( $local_font_files ) && ! empty( $local_font_files ) ) {
        $font_format = apply_filters( 'benevolent_local_google_fonts_format', $format );
        foreach ( $local_font_files as $key => $local_font ) {
            if ( $local_font ) {
                echo '<link rel="preload" href="' . esc_url( $local_font ) . '" as="font" type="font/' . esc_attr( $font_format ) . '" crossorigin>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }	
        }
        return;
    }

    // Now preload font data after processing it, as we didn't get stored data.
    $font = benevolent_webfont_loader_instance( $url );
    $font->set_font_format( $format );
    $font->preload_local_fonts();
}
endif;

if( ! function_exists( 'benevolent_flush_local_google_fonts' ) ){
    /**
     * Ajax Callback for flushing the local font
     */
    function benevolent_flush_local_google_fonts() {
        $WebFontLoader = new Benevolent_WebFont_Loader();
        //deleting the fonts folder using ajax
        $WebFontLoader->delete_fonts_folder();
    die();
    }
}
add_action( 'wp_ajax_flush_local_google_fonts', 'benevolent_flush_local_google_fonts' );
add_action( 'wp_ajax_nopriv_flush_local_google_fonts', 'benevolent_flush_local_google_fonts' );

/**
 * Function to exclude posts in blog index page
 */
function benevolent_exclude_posts_for_blogpage( $query ) {
    $show_on_front   = get_option( 'show_on_front' );
    $ed_slider       = get_theme_mod( 'benevolent_ed_slider' );
	$slider_category = get_theme_mod( 'benevolent_slider_cat' );

    if ( ! is_admin() && $query->is_home() && $query->is_main_query() && $ed_slider && 'posts' == $show_on_front ) {
        if( $slider_category ){
            $query->set( 'category__not_in', $slider_category );
        }
    }
}
add_action( 'pre_get_posts', 'benevolent_exclude_posts_for_blogpage' );

if( ! function_exists( 'benevolent_header' ) ) :
/**
 *  Benevolent Header
 */
function benevolent_header() { ?>
	<header id="masthead" class="site-header" role="banner" itemscope itemtype="https://schema.org/WPHeader">
        <?php if( has_nav_menu( 'secondary' ) || get_theme_mod( 'benevolent_ed_social_header' ) ){ ?>
            <div class="header-top">
                <div class="container">
                    
                    <?php if( has_nav_menu( 'secondary' ) ) { ?>
                    <div id="secondary-mobile-header">
                        <a id="responsive-secondary-menu-button" href="javascript:void(0);"><?php esc_html_e( 'Menu', 'benevolent' ); ?></a>
                    </div>
                    
                    <nav id="top-navigation" class="secondary-navigation" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                        <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'fallback_cb' => false ) ); ?>
                    </nav><!-- #site-navigation -->
                    <?php } ?>
                    <?php if( get_theme_mod( 'benevolent_ed_social_header' ) ) do_action( 'benevolent_social_links' ); ?>
                </div>
            </div>
        <?php } ?>
        
        <div class="header-bottom">
            
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
                        <?php if ( is_front_page() ) : ?>
                            <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php else : ?>
                            <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                        <?php endif;  
                    
                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) : ?>
                            <p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                        <?php endif; ?>
                    </div>
        		</div><!-- .site-branding -->
                
                <div class="right-panel">
                    <nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                    </nav><!-- #site-navigation -->

                    <?php 
                        $button_text = get_theme_mod( 'benevolent_button_text', __( 'Donate Now', 'benevolent' ) );
                        $button_url = get_theme_mod( 'benevolent_button_url' );
                        if( $button_text && $button_url ) echo '<a href="' . esc_url( $button_url ). '" class="btn-donate">' . esc_html( $button_text ) . '</a>';
                    ?>
                </div>
                
                <div id="mobile-header">
    			    <a id="responsive-menu-button" href="javascript:void(0);"><?php esc_html_e( 'Menu', 'benevolent' ); ?></a>
    			</div>
                
            </div>
            
        </div>
    </header><!-- #masthead -->
<?php }
endif;