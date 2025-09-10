<div class="single_post_layout_2 detail-content single_page">

	<div class="single_header">
		<?php 
		$category =  bizberg_post_categories( $post,1,false,false );
		?>
		<div class="<?php echo ( has_post_thumbnail() ? 'col-xs-12 col-md-5' : 'col-xs-12 text-center no_image' ) ?>">                        
			<div class="cover-content">

				<?php 
				if( !empty( $category ) ){ ?>
			    	<div class="single-category">                                      	
			      		<span>
			        		<?php echo wp_kses_post( $category ); ?>
			      		</span>		                                
			    	</div>
			    	<?php
			    } ?>

		        <h1><?php the_title(); ?></h1>
		        <div class="author-detail">                                
					<a href="<?php echo esc_url( get_author_posts_url( $post->post_author ) ); ?>">
						<i class="far fa-user"></i>
						<?php echo esc_html( bizberg_get_display_name( $post ) ); ?>		
					</a>                
					<a href="<?php echo esc_url( home_url() ); ?>/<?php echo esc_attr( date( 'Y/m' , strtotime( get_the_date() ) ) ); ?>">
						<i class="far fa-clock"></i>
						<?php echo esc_html( get_the_date() ); ?>		
					</a>
					<a href="<?php the_permalink(); ?>#respond">
						<i class="far fa-comments"></i>
						<?php echo absint( get_comments_number() ); ?>
					</a>		
					<a class="reading-time" href="javascript:void(0)">
				    	<i class="far fa-hourglass"></i>
				    	<span class="read_time"><?php bizberg_blog_read_time( $post ); ?></span>
				    </a>
				</div>
			</div>
		</div>

		<?php 
		$imageID = get_post_thumbnail_id(); 
		$image   = wp_get_attachment_image_src($imageID,'medium_large');
		
		if( has_post_thumbnail() ){ ?>
			<div class="col-xs-12 col-md-7 single_page_image_wrapper">
				<div 
				class="single_page_image full-width" 
				style="background-image: url( <?php echo esc_url( !empty($image[0]) ? $image[0] : '' ); ?> );"></div>
			</div>
			<?php 
		} ?>

	</div>

	<div class="item-content">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="item-wrapper" id="content">
                <div class="item-detail">
                    <?php the_content(); ?>
                </div>
                <div class="item-tags">
                    <?php 
                    if( has_tag() ){
						echo '<div class="tag-cloud-wrapper clearfix mb-40">
							<div class="tag-cloud-heading">' . esc_html__( 'Tags :' , 'bizberg' ) . ' </div>
							<div class="tagcloud tags clearfix mt-5">';
							the_tags('','','');
							echo '</div>
						</div>';
					}
                    ?> 
                </div> 

                <!-- Author Section -->

                <div class="post_author2">
                	<div class="col-xs-12 col-sm-2 image_wrapper">
                		<div class="profile-image">
                			<?php echo wp_kses_post( get_avatar( get_the_author_meta('ID'), 250 ) ); ?>
                		</div>
                	</div>
                	<div class="col-xs-12 col-sm-10 content_wrapper">
                		<div class="profile-content">					    	
					    	<?php 
					    	$authorID    = get_post_field( 'post_author',get_the_ID()); 
					    	$description = get_the_author_meta('description',$authorID);
					    	?>
					    	<div class="heading_wrapper <?php echo ( empty( $description ) ? 'no_description_author' : '' ); ?>">
						    	<h4>
						    		<?php echo esc_html(get_the_author_meta('display_name',$authorID));  ?>	
						    	</h4>				    		
					    		<a href="<?php echo esc_url(get_author_posts_url($authorID)); ?>">
						    		<?php esc_html_e( 'View More Posts', 'bizberg' ); ?>
						    	</a>
					    	</div>

					    	<?php 
					    	if( !empty( $description ) ){ ?>
					    		<p><?php echo esc_html( $description ); ?></p>
					    		<?php 
					    	} ?>

					  	</div>
                	</div>
                </div>

                <!-- Previous / Next Post -->

                <?php 
                $previous_post_id = bizberg_get_previous_post_id( $post->ID );
                $next_post_id     = bizberg_get_next_post_id( $post->ID );
                
                if( !empty( $previous_post_id ) || !empty( $next_post_id ) ){ ?>

	                <div class="next_previous_post <?php echo ( empty( $previous_post_id ) ? 'no_prev_post' : '' ); ?>"> 

	                	<?php 
	                	if( !empty( $previous_post_id ) ){  ?>              	
		            		<div class="previous_post nav-left"> 
		            			<a href="<?php echo esc_url( get_permalink( $previous_post_id ) ); ?>"> 
		            				
		            				<span class="nav-inner"> 
		            					<?php 
		            					if( has_post_thumbnail( $previous_post_id ) ){
		            						$prev_image = get_the_post_thumbnail_url( $previous_post_id , 'thumbnail' ); ?>
		            						<img src="<?php echo esc_url( $prev_image ); ?>">
		            						<?php 
		            					} ?>
		            					<span class="nav-title p-url">
		            						<span class="nav-label">
				            					<i class="fas fa-angle-left"></i>
				            					<span>
				            						<?php esc_html_e( 'Previous Article', 'bizberg' ); ?>
				            					</span>
				            				</span> 
		            						<?php echo esc_html( get_the_title( $previous_post_id ) ); ?>
		            					</span> 
		            				</span> 
		            			</a>
		            		</div>
		            		<?php 
		            	} 

		            	if( !empty( $next_post_id ) ){  ?>
		            		<div class="next_post nav-right"> 
		            			<a href="<?php echo esc_url( get_permalink( $next_post_id ) ); ?>"> 
		            				
		            				<span class="nav-inner"> 
		            					<?php 
		            					if( has_post_thumbnail( $next_post_id ) ){
		            						$next_image = get_the_post_thumbnail_url( $next_post_id , 'thumbnail' ); ?>
		            						<img src="<?php echo esc_url( $next_image ); ?>">
		            						<?php 
		            					} ?>

		            					<span class="nav-title p-url">
		            						<span class="nav-label">
				            					<span>
				            						<?php esc_html_e( 'Next Article', 'bizberg' ); ?>
				            					</span>
				            					<i class="fas fa-angle-right"></i>
				            				</span> 
		            						<?php echo esc_html( get_the_title( $next_post_id ) ); ?>
		            					</span> 
		            				</span> 
		            			</a>
		            		</div>
		            		<?php 
		            	} ?>

	                </div>

	                <?php 
	            }

                if ( comments_open() || get_comments_number() ) : 
                    comments_template(); 
                endif; 
                ?>
            </div>
        </div>
    </div>

    <?php 
    $post_id = get_the_ID();
    $cat_ids = array();
    $categories = get_the_category( $post_id );

    if(!empty($categories) && !is_wp_error($categories)):
        foreach ($categories as $category):
            array_push($cat_ids, $category->term_id);
        endforeach;
    endif;

    $query_args = array( 
        'category__in'   => $cat_ids,
        'post_type'      => 'post',
        'post__not_in'   => array($post_id),
        'posts_per_page' => '4',
        'orderby'        => 'rand'
     );

    $related_cats_post = new WP_Query( $query_args );

    if($related_cats_post->have_posts()):

    	echo '<div class="related_posts_wrapper">';

        while($related_cats_post->have_posts()): $related_cats_post->the_post();

        	global $post;
        	$imageID = get_post_thumbnail_id(); 
			$image   = wp_get_attachment_image_src($imageID,'medium_large'); ?>

        	<div class="related_posts <?php echo (has_post_thumbnail() ? 'has_image' : 'noimage'); ?>">
        		
        		<div class="<?php echo (has_post_thumbnail() ? 'col-md-6' : 'col-md-12'); ?> content-col">
        			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        			<?php the_excerpt(); ?>
        			<div class="author-detail">              
						<a href="<?php echo esc_url( home_url() ); ?>/<?php echo esc_attr( date( 'Y/m' , strtotime( get_the_date() ) ) ); ?>">
							<i class="far fa-clock"></i>
							<?php echo esc_html( get_the_date() ); ?>		
						</a>
						<a href="<?php the_permalink(); ?>#respond">
							<i class="far fa-comments"></i>
							<?php echo absint( get_comments_number() ); ?>
						</a>		
						<a class="reading-time" href="javascript:void(0)">
					    	<i class="far fa-hourglass"></i>
					    	<span class="read_time"><?php bizberg_blog_read_time( $post ); ?></span>
					    </a>
					</div>
        		</div>

        		<?php 
        		if( has_post_thumbnail() ){ ?>
	        		<div class="col-md-6 image-col">
	        			<a href="<?php the_permalink(); ?>">
	        				<div class="related_image" style="background-image:url( <?php echo esc_url( !empty($image[0]) ? $image[0] : '' ); ?> )"></div>
	        			</a>
	        		</div>
	        		<?php 
	        	} ?>

        	</div>

        	<?php

        endwhile;

        echo '</div>';

    endif;

    wp_reset_postdata();

    ?>

</div>