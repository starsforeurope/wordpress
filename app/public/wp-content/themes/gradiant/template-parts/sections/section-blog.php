<?php  
	$gradiant_blog_hs 			= get_theme_mod('blog_hs','1');
	$gradiant_blog_title 		= get_theme_mod('blog_title');
	$gradiant_blog_desc			= get_theme_mod('blog_description');  
	$gradiant_blog_display_num	= get_theme_mod('blog_display_num','3'); 
	if($gradiant_blog_hs=='1'){
?>	
<section id="post-section" class="post-section av-py-default blog-home shapes-section">
	<div class="av-container">
		<?php if(!empty($gradiant_blog_title)  || !empty($gradiant_blog_desc)): ?>
			<div class="av-columns-area">
				<div class="av-column-12">
					<div class="heading-default text-center wow fadeInUp">
						<?php if(!empty($gradiant_blog_title)): ?>
							<h3><?php echo wp_kses_post($gradiant_blog_title); ?></h3>
							<span class="separator"><span><span></span></span></span>
						<?php endif; ?>
						<?php if(!empty($gradiant_blog_desc)): ?>
							<p><?php echo wp_kses_post($gradiant_blog_desc); ?></p>
						<?php endif; ?>	
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="av-columns-area">
			<div class="av-column-12">
				<div class="post-carousel owl-carousel owl-theme">
					<?php 
					$gradiant_blog_args = array( 'post_type' => 'post', 'posts_per_page' => $gradiant_blog_display_num,'post__not_in'=>get_option("sticky_posts")) ; 	
					
				$gradiant_wp_query = new WP_Query($gradiant_blog_args);
					if($gradiant_wp_query)
					{	
					 $post_count=0;
					while($gradiant_wp_query->have_posts()):$gradiant_wp_query->the_post();
					
					?>
						<article class="post-items">
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
								<span class="post-date"> <a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>"><span><?php echo esc_html(get_the_date('j')); ?></span><?php echo esc_html(get_the_date('M, Y')); ?></a> </span>
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
									<span class="post-count">
										<?php
											if($post_count<9):
												$post_count=$post_count + 1;
												echo sprintf(esc_html('0 %s','gradiant'), $post_count);
											else:		
												echo esc_html($post_count + 1);
											endif;
										?>
									</span>
								</div>
							</div>
						</article>
					<?php 
						endwhile; 
						}
						wp_reset_postdata();
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="shape20 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blog/clipArt/shape20.png" alt="image"></div>
	<div class="shape21 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blog/clipArt/shape21.png" alt="image"></div>
	<div class="shape22 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blog/clipArt/shape22.png" alt="image"></div>
	<div class="shape23 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blog/clipArt/shape23.png" alt="image"></div>
</section>
<?php } ?>