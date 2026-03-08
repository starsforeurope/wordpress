<?php
/**
 * Template Name: Home Page
 *
 * @package Benevolent
 */

get_header(); 

    ?>
    <div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2><?php the_title(); ?></h2>
			    <div class="post-thumbnail">
		        	<?php the_post_thumbnail(); ?>
		        </div>
			    
			    <?php 
				while ( have_posts() ) : the_post(); ?> 
			        <div class="entry-content" itemprop="text">
			            <?php the_content(); ?> 
			        </div><!-- .entry-content -->
			    <?php endwhile; ?>
			</article><!-- #post-## -->

		</main><!-- #main -->
	</div>
    <?php
    
get_footer();