<?php 

add_action( 'bizberg_before_homepage_blog', 'green_wealth_homepage_why_choose_us' );
function green_wealth_homepage_why_choose_us(){ 

	$status = bizberg_get_theme_mod( 'green_wealth_process_status' );

	if( empty( $status ) ){
		return;
	}

	$subtitle = bizberg_get_theme_mod( 'green_wealth_process_subtitle' );
	$title    = bizberg_get_theme_mod( 'green_wealth_process_title' );

	$data    = bizberg_get_theme_mod( 'green_wealth_process_repeater' );
	$data    = json_decode($data,true); ?>

	<div class="why_choose_us">
		<div class="container">
			<div class="row">
				<div class="col-md-12 why_choose_us_title_wrapper">
					<h4><?php echo esc_html( $subtitle ); ?></h4>
					<h3><?php echo esc_html( $title ); ?></h3>
				</div>	

				<?php 
				if( !empty($data) ){ ?>
					<div class="why_choose_us_wrapper">
						<?php 
						foreach ( $data as $value ) {

							$icon    = !empty( $value['icon'] ) ? $value['icon'] : '';
							$process = !empty( $value['process'] ) ? $value['process'] : '';

							$page_obj    = get_post( $process ); ?>
						 	
							<div class="item">
								<i class="<?php echo esc_attr( $icon ); ?>"></i>
								<h3><?php echo esc_html( $page_obj->post_title ); ?></h3>
								<p><?php echo esc_html( wp_trim_words( sanitize_text_field( $page_obj->post_content ), 20, null ) ); ?></p>
								<a href="<?php echo esc_url( get_permalink( $process ) ); ?>" class="read_more">
									<i class="far fa-arrow-alt-circle-right"></i>
								</a>
							</div>

						 	<?php
						} ?>
						
					</div>
					<?php 
				} ?>
			</div>
		</div>
	</div>

	<?php
}