<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gradiant
 */

get_header();
?>
<section id="post-section" class="post-section av-py-default">
	<div class="av-container">
		<div class="av-columns-area">	
			 <div id="av-primary-content" class="<?php esc_attr(gradiant_post_layout()); ?>">
			
				<?php if( have_posts() ): ?>
				
					<?php while( have_posts() ) : the_post();
					
							get_template_part('template-parts/content/content','page'); 
							
					endwhile; ?>
					
				<?php else: ?>
				
					<?php get_template_part('template-parts/content/content','none'); ?>
					
				<?php endif; ?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
