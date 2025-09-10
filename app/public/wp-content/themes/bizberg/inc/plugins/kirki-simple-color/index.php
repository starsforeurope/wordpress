<?php

/**
* Plugin Name: Kirki Simple Color
* Author: Ravi Shakya
* Version: 0.3
* Requires WP: 4.9
* Requires PHP: 5.6
* Description: Simple colorpicker wrapped in modal
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( !defined( "BIZBERG_KSC_PLUGIN_DIR_URL" ) ){
	$ksc_content_url  = untrailingslashit( dirname( dirname( get_stylesheet_directory_uri() ) ) );
	$ksc_content_dir  = wp_normalize_path( untrailingslashit( WP_CONTENT_DIR ) );
	$ksc_absolute_url = str_replace( $ksc_content_dir, $ksc_content_url, wp_normalize_path( dirname( __FILE__ ) ) ); 
	define( "BIZBERG_KSC_PLUGIN_DIR_URL", set_url_scheme( $ksc_absolute_url ) );
}

add_action( 'init' , 'bizberg_kirki_simple_color_control_register' );

if( !function_exists( 'bizberg_kirki_simple_color_control_register' ) ){

	function bizberg_kirki_simple_color_control_register(){
		add_filter( 'kirki_control_types', function ( $controls ) {
				$controls['simple-color'] = 'BIZBERG_KIRKI_SIMPLE_COLOR';
				return $controls;
			}
		);
	}

}

add_action( 'customize_register', 'bizberg_kirki_simple_color_customize_register' );

if( !function_exists( 'bizberg_kirki_simple_color_customize_register' ) ){

	function bizberg_kirki_simple_color_customize_register(){

		class BIZBERG_KIRKI_SIMPLE_COLOR extends Kirki_Control_Base {

			public $type = 'kirki-simple-color';

			public function enqueue() {
				wp_enqueue_script( 
					'bizberg-simple-color-js', 
					BIZBERG_KSC_PLUGIN_DIR_URL . '/js/scripts.js', 
					array( 'jquery' )
				);
				wp_enqueue_style( 
					'bizberg-simple-color-css', 
					BIZBERG_KSC_PLUGIN_DIR_URL . '/css/style.css' 
				);
			}

			public function render_content() {

				$alpha = !empty( $this->choices['alpha'] ) ? 'true' : 'false'; ?>

				<div class="ksc-color-tabs-wrapper">
					<div class="ksc-toggle-desc-wrap">
						<label class="customizer-text">
							<span class="titledesc_wrapper">
								<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
								<span class="description customize-control-description">
									<?php echo wp_kses_post( $this->description ); ?>
								</span>
							</span>
							<span class="ksc-adv-toggle-icon dashicons"></span>
						</label>
					</div>

					<div class="ksc-field-settings-wrap" style="display: none;">
						<div class="ksc-field-settings-modal <?php echo ( empty( $this->description ) ? '' : 'has_description' ); ?>">
							<ul class="ksc-fields-wrap">
								<li>
									<label class="customize-control-title"><?php echo esc_html( $this->label ); ?></label>
								</li>
								<li>
									<input 
									type="text" 
									data-alpha="<?php echo esc_attr( $alpha ); ?>"
									value="<?php echo esc_attr( $this->value() ); ?>" 
									class="ksc_color" 
									data-default-color="<?php echo esc_attr( $this->value() ); ?>" />
								</li>
							</ul>
						</div>
					</div>
					<?php 
					printf(
					'<input type="hidden" class="ksc-save-data-json" name="%s" value="%s" %s/>',
						esc_attr( $this->id ), esc_attr( $this->value() ), $this->get_link()
					);				
					?>
				</div>

				<?php

			}

		}

	}

}