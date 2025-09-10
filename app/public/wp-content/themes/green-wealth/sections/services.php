<?php 

add_action( 'bizberg_before_homepage_blog', 'green_wealth_homepage_services' );
function green_wealth_homepage_services(){ 

	$status = bizberg_get_theme_mod('green_wealth_services_status');

	if( empty( $status ) ){
		return;
	} 

	$subtitle = bizberg_get_theme_mod('green_wealth_services_subtitle');
	$title    = bizberg_get_theme_mod('green_wealth_services_title'); ?>

	<div class="services">
		<div class="container">
			<div class="row clearfix">	

				<div class="col-md-12 services_title_wrapper">
					<h4><?php echo esc_html( $subtitle ); ?></h4>
					<h3><?php echo esc_html( $title ); ?></h3>
				</div>	

				<?php 
				$data = bizberg_get_theme_mod('green_wealth_services_repeater'); 
				$data = json_decode($data,true);

				foreach ( $data as $value ) {

					$icon        = !empty( $value['icon'] ) ? $value['icon'] : '';
					$services_id = !empty( $value['services_id'] ) ? $value['services_id'] : '';

					$page_obj    = get_post( $services_id ); ?>
					
					<div class="service-one__single col-lg-4 col-md-12 col-sm-12">
			            <div class="service-one__single-inner">
			                <i class="<?php echo esc_attr( $icon ); ?>"></i>
			                <h3 class="service-one__title">
			                	<a href="<?php echo esc_url( get_permalink( $services_id ) ); ?>">
			                		<?php echo esc_html( $page_obj->post_title ); ?>		
			                	</a>
			                </h3>
			                <div class="service-one__text">
			                	<?php echo esc_html( wp_trim_words( sanitize_text_field( $page_obj->post_content ), 20, null ) ); ?>
			                </div>
			                <a href="<?php echo esc_url( get_permalink( $services_id ) ); ?>" class="service-one__read-more"><?php esc_html_e( 'Read More', 'green-wealth' ); ?></a>
			            </div>
			        </div>

					<?php
				} ?>        
		        
		    </div>
		</div>
	</div>

	<?php 
}