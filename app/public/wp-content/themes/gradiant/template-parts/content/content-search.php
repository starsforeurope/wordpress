<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gradiant
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-items mb-6'); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
		<figure class="post-image post-image-absolute">
			<div class="featured-image">
				<a href="<?php echo esc_url(get_permalink()); ?>" class="post-hover">
					<?php the_post_thumbnail(); ?>
				</a>
			</div>
		</figure>
	<?php } ?>
	<div class="post-content">
		<span class="post-date"> <a href="<?php echo esc_url(the_date('Y/m/d')); ?>"><span><?php echo esc_html(get_the_date('j')); ?></span><?php echo esc_html(get_the_date('M, Y')); ?></a> </span>
		<?php     
			if ( is_single() ) :
			
			the_title('<h5 class="post-title">', '</h5>' );
			
			else:
			
			the_title( sprintf( '<h5 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
			
			endif; 
		?> 
		<div class="post-footer">
			<?php 
				the_content( 
					sprintf( 
						__( 'Read More', 'gradiant' ), 
						'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
					) 
				);	
			  ?>
		</div>
	</div>
</article>