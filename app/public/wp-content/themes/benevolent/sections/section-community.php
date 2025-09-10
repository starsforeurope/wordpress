<?php
/**
 * Community Section
 * 
 * @package Benevolent
 */
 
$community_section_title = get_theme_mod( 'benevolent_community_section_title' );
$community_post_one      = get_theme_mod( 'benevolent_community_post_one' );
$community_post_two      = get_theme_mod( 'benevolent_community_post_two' );
$community_post_three    = get_theme_mod( 'benevolent_community_post_three' );
$community_post_four     = get_theme_mod( 'benevolent_community_post_four' );
 
 if( $community_section_title ) echo '<header class="header"><h2 class="main-title">' . esc_html( $community_section_title ) . '</h2></header>'; 
 
 if( $community_post_one || $community_post_two || $community_post_three || $community_post_four ){
    $community_posts = array( $community_post_one, $community_post_two, $community_post_three, $community_post_four );
    $community_posts = array_diff( array_unique( $community_posts ), array('') );
    
    $community_qry = new WP_Query( array( 
        'post_type'           => 'post',
        'posts_per_page'      => -1,
        'post__in'            => $community_posts,
        'orderby'             => 'post__in',
        'ignore_sticky_posts' => true
    
    ) );
    if( $community_qry->have_posts() ){
        echo '<div class="community-holder">';
        while( $community_qry->have_posts() ){
            $community_qry->the_post();
            if( has_post_thumbnail() ){
            ?>
            <div class="columns-2">
				<?php the_post_thumbnail( 'benevolent-community', array( 'itemprop' => 'image' ) ); ?>
				<div class="text-holder">
                    <div class="table">
                        <div class="table-row">
                            <div class="table-cell">				
                            <strong class="title"><?php the_title(); ?></strong>
				            <?php 
                            if( has_excerpt() ){ 
				                the_excerpt();                                
                            }else{
                                echo wpautop( wp_kses_post( wp_trim_words( strip_shortcodes( get_the_content() ), 3, '.' ) ) );    
                            } ?>
                            </div>
                        </div>
                    </div>
                </div>
    			<div class="hover-state">
                    <div class="table">
                        <div class="table-row">
                            <div class="table-cell">
				                <strong class="title"><?php the_title(); ?></strong>
				                <?php 
                                if( has_excerpt() ){ 
    				                the_excerpt();
                                }else{
                                    echo wpautop( wp_kses_post( wp_trim_words( strip_shortcodes( get_the_content() ), 3, '&hellip;' ) ) );    
                                } ?>
				                <div class="btn-holder">
                                    <a href="<?php the_permalink(); ?>"><span class="fa fa-angle-right"></span></a>
                                </div>
				                <div class="text-content">
                                <?php 
                                    if( has_excerpt() ){
                                        the_excerpt();     
                                    }else{
                                        echo wpautop( wp_kses_post( wp_trim_words( strip_shortcodes( get_the_content() ), 20, '&hellip;' ) ) );
                                    }
                                ?>
                                </div>
				            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
        }
        wp_reset_postdata(); 
        echo '</div>';
    }
}			