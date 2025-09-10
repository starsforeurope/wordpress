<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Gradiant
 */

get_header();
?>
<section id="section404" class="section404 shapes-section">
	<div class="av-container">
		<div class="av-columns-area wow fadeInUp">
			<div class="av-column-6 text-center mx-auto">
				<div class="card404">	
						<h1><?php esc_html_e('4','gradiant'); ?><span class="card404icon"><i class="fa fa-wrench"></i></span><?php esc_html_e('4','gradiant'); ?></h1>  
						<h4><?php esc_html_e('Page Not Found','gradiant'); ?></h4>  
						<p><?php esc_html_e('Oups! We can’t find the page you’re looking for…','gradiant'); ?></p> 
					
					<div class="card404-btn mt-3">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="av-btn av-btn-primary av-btn-bubble"> <?php esc_html_e('Go To Home','gradiant'); ?> <i class="fa fa-arrow-right"></i> <span class="bubble_effect"><span class="circle top-left"></span> <span class="circle top-left"></span> <span class="circle top-left"></span> <span class="button effect-button"></span> <span class="circle bottom-right"></span> <span class="circle bottom-right"></span> <span class="circle bottom-right"></span></span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="shape24 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/page404/img01.png" alt="image"></div>
	<div class="shape25 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/page404/img02.png" alt="image"></div>
	<div class="shape26 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/page404/img03.png" alt="image"></div>
	<div class="shape27 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/page404/img04.png" alt="image"></div>
	<div class="shape28 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/page404/img05.png" alt="image"></div>
	<div class="shape29 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/page404/img06.png" alt="image"></div>
	<div class="shape30 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/page404/img07.png" alt="image"></div>
	<div class="shape31 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/page404/img08.png" alt="image"></div>
	<div class="shape32 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/page404/img09.png" alt="image"></div>
	<div class="shape33 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/page404/img10.png" alt="image"></div>
	<div class="shape34 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/page404/img11.png" alt="image"></div>
	<div class="shape35 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/page404/img12.png" alt="image"></div>
	<div class="shape36 bg-elements"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/page404/img13.png" alt="image"></div>
</section>
<?php get_footer(); ?>
