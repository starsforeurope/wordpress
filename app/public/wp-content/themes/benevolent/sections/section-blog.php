<?php
/**
 * Blog Section
 * 
 * @package Benevolent
 */
 
$ed_blog_date          = get_theme_mod( 'benevolent_ed_blog_date', '1' );
$blog_section_title    = get_theme_mod( 'benevolent_blog_section_title' );
$blog_section_content  = get_theme_mod( 'benevolent_blog_section_content' );
$blog_section_readmore = get_theme_mod( 'benevolent_blog_section_readmore', __( 'Read More', 'benevolent' ) );
 
if( $blog_section_title || $blog_section_content ){
?>
<header class="header">
	<div class="container">
		<div class="text">
			<?php 
                if( $blog_section_title ) echo '<h2 class="main-title">' . esc_html( $blog_section_title ) . '</h2>';
                if( $blog_section_content ) echo wpautop( esc_html( $blog_section_content ) );
            ?>
		</div>
	</div>
</header>
<?php } 
    
    $blog_qry = new WP_Query( array( 
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'posts_per_page'      => 3,
        'ignore_sticky_posts' => true    
    ) );
    if( $blog_qry->have_posts() ){
    ?>    
    <div class="blog-holder">
    	<div class="container">
    		<div class="row">
    			<?php
                while( $blog_qry->have_posts() ){
                    $blog_qry->the_post();
                ?>
                <div class="columns-3">
    				<div class="post">
    					<a href="<?php the_permalink(); ?>" class="post-thumbnail">
                        <?php 
                            if( has_post_thumbnail() ){ 
                                the_post_thumbnail( 'benevolent-blog', array( 'itemprop' => 'image' ) ); 
                            }else{
                               benevolent_get_fallback_svg( 'benevolent-blog' );
                            }
                        ?>
                        </a>
    					<div class="text-holder">
    						<header class="entry-header">
    							<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    							<?php if( $ed_blog_date ){ ?>
                                <div class="entry-meta">
    								<span class="posted-on"><span class="fa fa-calendar-o"></span><a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_date() ); ?></a></span>
    							</div>
                                <?php } ?>
    						</header>
    						<div class="entry-content">
    							<?php
                                    if( has_excerpt() ){
                                        the_excerpt();
                                    }else{ 
                                        echo wpautop( wp_kses_post( wp_trim_words( get_the_content(),10,'...' ) ) );
                                    }      
                                ?>                                
    						</div>
    						<a href="<?php the_permalink(); ?>" class="readmore"><?php echo esc_html( $blog_section_readmore ); ?></a>
    					</div>
    				</div>
    			</div>
    			<?php
                }
                wp_reset_postdata();
                ?>    			
    		</div>
    	</div>
    </div>
    <?php }