<div id="post-<?php the_ID(); ?>" <?php post_class('col-sm-12 col-xs-12 blog-listing blog_listing_grid_two_column'); ?>>
	<main id="main" class="site-main">
		<article class="">
			<?php 
			if( has_post_thumbnail() ){ ?>    
	        	<figure class="post-thumbnail">
	        		<a href="<?php the_permalink(); ?>" class="post-thumbnail">
	        			<?php the_post_thumbnail( 'medium_large'); ?>       			
	        		</a>
	        	</figure>
	        	<?php 
	        } 

        	$category =  bizberg_post_categories( $post,2,false,false );
        	?>

        	<header class="entry-header <?php echo ( empty( $category ) ? 'no_category_post' : '' ); ?>">
            	<div class="entry-meta">
            		<span class="posted-on">
            			<?php esc_html_e( 'Added on' , 'bizberg' ); ?>  
	            		<a href="<?php echo esc_url( home_url() ); ?>/<?php echo esc_attr( date( 'Y/m' , strtotime( get_the_date() ) ) ); ?>">
	            			<time class="entry-date published"><?php echo esc_html( get_the_date() ); ?></time>
	            		</a>
	            	</span>
	            	<span class="category">
	            		<?php echo wp_kses_post( $category ); ?>
	            	</span>
	            </div>
	            <h2 class="entry-title">
	            	<a href="<?php the_permalink(); ?>">
	            		<?php the_title(); ?>
	            	</a>
	            </h2>        
	        </header> 
        	<div class="content-wrap">
        		<div class="entry-content">
        			<?php the_excerpt(); ?>
				</div>
			</div>
			<div class="entry-footer">
				<div class="button-wrap">
					<a href="<?php the_permalink(); ?>" class="btn-readmore">
						<?php esc_html_e( 'Read More' , 'bizberg' ); ?>  						
						<svg xmlns="http://www.w3.org/2000/svg" width="12" height="24" viewBox="0 0 12 24"><path d="M0,12,12,0,5.564,12,12,24Z" transform="translate(12 24) rotate(180)" fill="#121212"></path></svg>
					</a>
				</div>
			</div>
		</article>
	</main>
</div>