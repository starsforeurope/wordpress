<?php

/**
* Plugin Name: Kirki Simple Gradient
* Author: Ravi Shakya
* Version: 0.2
* Requires WP: 4.9
* Requires PHP: 5.3
* Description: Use this control to add gradient colors
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( !defined( "BIZBERG_KSG_PLUGIN_DIR_URL" ) ){
	$ksg_content_url  = untrailingslashit( dirname( dirname( get_stylesheet_directory_uri() ) ) );
	$ksg_content_dir  = wp_normalize_path( untrailingslashit( WP_CONTENT_DIR ) );
	$ksg_absolute_url = str_replace( $ksg_content_dir, $ksg_content_url, wp_normalize_path( dirname( __FILE__ ) ) ); 
	define( "BIZBERG_KSG_PLUGIN_DIR_URL", set_url_scheme( $ksg_absolute_url ) );
}

add_action( 'init' , 'bizberg_ksg_initialize_control' );
if( !function_exists( 'bizberg_ksg_initialize_control' ) ){
	function bizberg_ksg_initialize_control(){
		add_filter( 'kirki_control_types', function ( $controls ) {
				$controls['simple-gradient'] = 'BIZBERG_KIRKI_SIMPLE_GRADIENT';
				return $controls;
			}
		);
	}
}

add_action( 'customize_register', 'bizberg_kirki_simple_gradient_customize_register' );
if( !function_exists( 'bizberg_kirki_simple_gradient_customize_register' ) ){

	function bizberg_kirki_simple_gradient_customize_register(){

		class BIZBERG_KIRKI_SIMPLE_GRADIENT extends Kirki_Control_Base {

			public $type = 'kirki-simple-gradient';

			public function enqueue() {
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script( 
					'bizberg-kirki-simple-gradient-js', 
					BIZBERG_KSG_PLUGIN_DIR_URL . '/js/scripts.js', 
					array( 'jquery' )
				);
				wp_enqueue_style( 
					'bizberg-kirki-simple-gradient-css', 
					BIZBERG_KSG_PLUGIN_DIR_URL . '/css/style.css'
				);			
			}

			public function render_content() {

				$default = !empty( $this->value() ) ? $this->value() : 'linear-gradient( 291deg, #dd3333, #eeee22 )';

				$filtered_data = bizberg_ksg_get_defaults_in_array( $default );
				$gradient      = !empty( $filtered_data['gradient'] ) ? $filtered_data['gradient'] : '';
				$angle         = !empty( $filtered_data['elements'][0] ) ? $filtered_data['elements'][0] : '';
				$color_1       = !empty( $filtered_data['elements'][1] ) ? $filtered_data['elements'][1] : '';
				$color_2       = !empty( $filtered_data['elements'][2] ) ? $filtered_data['elements'][2] : ''; ?>

				<div class="ksg-color-tabs-wrapper">
					<div class="ksg-toggle-desc-wrap">
						<label class="customizer-text">
							<span class="titledesc_wrapper">
								<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
								<span class="description customize-control-description">
									<?php echo wp_kses_post( $this->description ); ?>
								</span>
							</span>
							<span class="ksg-adv-toggle-icon dashicons"></span>
						</label>
					</div>

					<div class="ksg-field-settings-wrap" style="display: none;">
						<div class="ksg-field-settings-modal">
							<ul class="ksg-fields-wrap">
								<div 
								style="background:<?php echo esc_attr($default); ?>" 
								class="gradient-preview"></div>
								<div class="ksg_colors_outer_wrapper">
									<div class="ksg_colors_wrapper">
										<div class="ksg_color_1">
											<input 
											type="text" 
											value="<?php echo esc_attr( $color_1 ); ?>" 
											class="ksg_color_1_<?php echo esc_attr($this->id); ?>" 
											data-default-color="<?php echo esc_attr( $color_1 ); ?>" />
										</div>
										<div class="ksg_color_2">
											<input 
											type="text" 
											value="<?php echo esc_attr( $color_2 ); ?>" 
											class="ksg_color_2_<?php echo esc_attr($this->id); ?>" 
											data-default-color="<?php echo esc_attr( $color_2 ); ?>" />
										</div>
									</div>
									<div class="ksg_colors_options">
										<select class="ksg_gradient_options">
											<option value="linear-gradient" <?php selected( $gradient, 'linear-gradient' ); ?>>Linear</option>
											<option value="radial-gradient" <?php selected( $gradient, 'radial-gradient' ); ?>>Radial</option>
										</select>
										<input 
										style="display: <?php echo ( $gradient == 'radial-gradient' ? 'none' : 'block' ); ?>"
										type="number" 
										class="ksg_anglerange ksg_angle_<?php echo esc_attr($this->id); ?>" min="0" 
										max="360" 
										value="<?php echo absint( $angle ); ?>">
									</div>
								</div>
							</ul>
						</div>

					</div>

					<?php 

					printf(
					'<input type="hidden" class="ksg-save-data-json" name="%s" value="%s" %s/>',
						esc_attr( $this->id ), esc_attr( $default ), $this->get_link()
					);
					
					?>

				</div>

				<script>
					jQuery(document).ready(function(){

						jQuery('.ksg_color_1_<?php echo esc_attr( $this->id ); ?>,.ksg_color_2_<?php echo esc_attr( $this->id ); ?>').wpColorPicker({
							clear: function() {
								var $this = jQuery(this);
								setTimeout(function(){ 
									ksg_get_gradient_color( $this ); 
								}, 10);							
							},
							change: function(event, ui) {
								var $this = jQuery(this);
								setTimeout(function(){ 
									ksg_get_gradient_color( $this ); 
								}, 10);
							}
						});

					});
				</script>

				<?php

			}

		}

	}

}

if( !function_exists( 'bizberg_ksg_get_defaults_in_array' ) ){

	function bizberg_ksg_get_defaults_in_array( $default ){

		$data = array();
		$value = str_replace( ' ', '', $default );
		if ( strpos( $value, 'linear-gradient' ) !== false ) {
		    $data['gradient'] = 'linear-gradient';
		} elseif( strpos( $value, 'radial-gradient' ) !== false ){
			$data['gradient'] = 'radial-gradient';
		}

		$value = str_replace( 'linear-gradient', '', $value );
		$value = str_replace( 'radial-gradient', '', $value );

		$value = substr( $value, 1, -1 ); // Remove first and last bracket from the string

		$to_array = explode( ',', $value ); // Convert into array

		$data['elements'] = $to_array;

		return $data;

	}

}