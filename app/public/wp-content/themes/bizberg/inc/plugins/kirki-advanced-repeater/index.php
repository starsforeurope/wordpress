<?php

/**
* Plugin Name: Kirki Advanced Repeater
* Author: Ravi Shakya
* Version: 0.4
* Requires WP: 4.9
* Requires PHP: 5.6
* Description: Advanced Repeater
*/

if( !defined( "BIZBERG_KAR_PLUGIN_DIR_URL" ) ){
	$kar_content_url  = untrailingslashit( dirname( dirname( get_stylesheet_directory_uri() ) ) );
	$kar_content_dir  = wp_normalize_path( untrailingslashit( WP_CONTENT_DIR ) );
	$kar_absolute_url = str_replace( $kar_content_dir, $kar_content_url, wp_normalize_path( dirname( __FILE__ ) ) ); 
	define( "BIZBERG_KAR_PLUGIN_DIR_URL", set_url_scheme( $kar_absolute_url ) );
}

add_action( 'init' , 'bizberg_kar_advanced_repeater_control' );
if( !function_exists( 'bizberg_kar_advanced_repeater_control' ) ){ 
	function bizberg_kar_advanced_repeater_control(){
		add_filter( 'kirki_control_types', function ( $controls ) {
			$controls['advanced-repeater'] = 'BIZBERG_KIRKI_ADVANCED_REPEATER';
			return $controls;
		});
	}
}

add_action( 'customize_register', 'bizberg_kar_customize_register' );

if( !function_exists( 'bizberg_kar_customize_register' ) ){

	function bizberg_kar_customize_register(){

		class BIZBERG_KIRKI_ADVANCED_REPEATER extends Kirki_Control_Base {

			public $type = 'kirki-advanced-repeater';

			public function enqueue() {
				wp_enqueue_script( 
					'bizberg-kirki-advanced-repeater-js', 
					BIZBERG_KAR_PLUGIN_DIR_URL . '/js/scripts.js', 
					array( 'jquery', 'jquery-ui-sortable', 'jquery-ui-datepicker' )
				);
				wp_enqueue_style( 
					'bizberg-kirki-advanced-repeater-css', 
					BIZBERG_KAR_PLUGIN_DIR_URL . '/css/style.css' 
				);
			}

			public function render_content() {

				if( is_array( $this->value() ) ){
					$default  = $this->value();
				} else {
					$default  = !empty( $this->value() ) ? json_decode( rawurldecode( $this->value() ) , true ) : array();
				}

				$row_label    = !empty( $this->choices['row_label']['value'] ) ? $this->choices['row_label']['value'] : 'Row';
				$button_label = !empty( $this->choices['button_label'] ) ? $this->choices['button_label'] : 'Add New';
				$limit        = !empty( $this->choices['limit'] ) ? $this->choices['limit'] : '0';
				$fields       = !empty( $this->choices['fields'] ) ? $this->choices['fields'] : array();
				$id           = 'content_' . $this->id; ?>

				<label class="kar_title_description_wrapper" id="<?php echo esc_attr($id); ?>">
					<span class="customize-control-title">
						<?php echo esc_html( $this->label ); ?>
					</span>
					<span class="customize-control-description">
						<?php echo wp_kses_post( $this->description ); ?>
					</span>
				</label>

				<div class="kar_wrapper" data-limit="<?php echo absint( $limit ); ?>">

					<?php 
					ob_start();

					if( !empty( $default ) ){
						for ( $i=0; $i < count( $default ); $i++ ) { 
							bizberg_kar_get_repeater_section( $row_label , $i , $fields , $default );					
						} 
					}

					echo ob_get_clean();
					printf(
					'<input type="hidden" class="kar_repeater_save_db" name="%s" value="%s" %s/>',
						esc_attr( $this->id ), esc_attr( json_encode( $this->value() ) ), $this->get_link()
					);
					?>
					
				</div>

				<div class="kar_new_repeater" style="display:none;">
					<?php 
					bizberg_kar_get_repeater_section( 
						$row_label, 
						$i = 0, 
						$fields, 
						$default = array(), 
						$extra_class = 'kar_hide', 
						$show_default_value_on_add_new_repeater = true 
					);
					?>
				</div>

				<?php 
				if( $limit > 0 ){ ?>
					<div class="kar_repeater_limit">
						<?php 
						printf( _n( 'Limit: %s row', 'Limit: %s rows', $limit , 'bizberg' ), $limit );
						?>
					</div>
					<?php
				} ?>

				<a href="javascript:void(0)" class="kar_add_new_section button">
					<?php 
					echo esc_attr( $button_label );
					?>
				</a>

				<?php
			}

		}

	}
}

if( !function_exists( 'bizberg_kar_get_repeater_section' ) ){

	function bizberg_kar_get_repeater_section( $row_label, $i, $fields, $default, $extra_class = '', $show_default_value_on_add_new_repeater = false ){ ?>

		<div class="kar_repeater_section">
			<a href="javascript:void(0)" class="kar_label_wrapper">
				<span class="label">
					<span class="count"><?php echo absint($i+1); ?></span>
					<?php echo esc_attr( $row_label ); ?></span>
				<span class="icon"></span>
			</a>
			<div class="kar_fields_wrapper" style="display:none;">

				<?php
				foreach ( $fields as $key => $field ) {

					$default_value = !empty( $default[$i][$key] ) ? $default[$i][$key] : '';
					
					$type = !empty( $fields[$key]['type'] ) ? $fields[$key]['type'] : '';

					switch ( $type ) {
						
						case 'heading':
							bizberg_kar_get_heading_field( $field , $key );
							break;

						case 'number':
							bizberg_kar_get_number_field( $field , $default_value , $key , $show_default_value_on_add_new_repeater );
							break;

						case 'text':
							bizberg_kar_get_text_field( $field , $default_value , $key , $show_default_value_on_add_new_repeater );
							break;

						case 'textarea':
							bizberg_kar_get_textarea_field( $field , $default_value , $key , $show_default_value_on_add_new_repeater );
							break;

						case 'select':
							bizberg_kar_get_select_field( $field , $default_value , $key , $extra_class, $show_default_value_on_add_new_repeater );
							break;

						case 'fontawesome':
							bizberg_kar_get_icon_field( $field , $default_value , $key , $extra_class, $show_default_value_on_add_new_repeater );
							break;

						case 'color':
							bizberg_kar_get_color_field( $field , $default_value , $key , $extra_class, $show_default_value_on_add_new_repeater );
							break;

						case 'image':
							bizberg_kar_get_image_field( $field , $default_value , $key , $show_default_value_on_add_new_repeater );
							break;

						case 'radio':
							bizberg_kar_get_radio_field( $field , $default_value , $key , $show_default_value_on_add_new_repeater );
							break;

						case 'checkbox':
							bizberg_kar_get_checkbox_field( $field , $default_value , $key , $show_default_value_on_add_new_repeater );
							break;

						case 'date':
							bizberg_kar_get_date_field( $field , $default_value , $key , $extra_class, $show_default_value_on_add_new_repeater );
							break;

						case 'time':
							$default_value = is_array( $default_value ) ? $default_value : array();
							bizberg_kar_get_time_field( $field , $default_value , $key , $extra_class, $show_default_value_on_add_new_repeater );
							break;
						
						default:
							// code...
							break;
					}

				} ?>

				<a class="kar_remove_section" href="javascript:void(0)">Remove</a>

			</div>

		</div>

		<?php
	}

}

if( !function_exists( 'bizberg_kar_get_hours' ) ){

	function bizberg_kar_get_hours( $selected = '' ){

		for ( $i = 1; $i <= 24; $i++ ) { 
		    $num = sprintf( "%02d", $i ); ?>
			<option value="<?php echo esc_attr( $num ); ?>" <?php selected( $num, $selected ); ?>>
				<?php echo esc_attr( $num ); ?>
			</option>
			<?php
		}

	}

}

if( !function_exists( 'bizberg_kar_get_min' ) ){

	function bizberg_kar_get_min( $selected = '' ){

		for ( $i = 1; $i <= 60; $i++ ) { 
			$num = sprintf( "%02d", $i );  ?>
			<option value="<?php echo esc_attr( $num ); ?>" <?php selected( $num, $selected ); ?>>
				<?php echo esc_attr( $num ); ?>
			</option>
			<?php
		}

	}

}

if( !function_exists( 'bizberg_kar_get_time_field' ) ){

	function bizberg_kar_get_time_field( $field, $default_value, $key, $extra_class, $show_default_value_on_add_new_repeater ){

		$title           = !empty( $field['label'] ) ? $field['label'] : '';
		$description     = !empty( $field['description'] ) ? $field['description'] : '';
		$hour            = !empty( $field['default']['h'] ) ? $field['default']['h'] : '1';
		$min             = !empty( $field['default']['m'] ) ? $field['default']['m'] : '1';
		$active_callback = !empty( $field['active_callback'] ) ? 'data-active-callback=' . json_encode( $field['active_callback'] ) : '';

		// Show this default value for hidden field
		if( $show_default_value_on_add_new_repeater == true ){
		 	$default_value['h'] = $hour;
		 	$default_value['m'] = $min;
		}

		if( empty( $default_value['h'] ) ){
			$default_value['h'] = 1;
		}

		if( empty( $default_value['m'] ) ){
			$default_value['m'] = 1;
		} ?>

		<div 
		class="fields" 
		data-type="time" 
		data-key="<?php echo esc_attr( $key ); ?>" 
		<?php echo esc_attr( $active_callback ); ?>>

			<label class="title">
				<?php echo esc_html( $title ); ?>
			</label>
			<p class="description">
				<?php echo wp_kses_post( $description ); ?>
			</p>

			<div class="kar_timepicker_wrapper">
				<select class="kar_time_hr <?php echo esc_attr( $extra_class ); ?>">
					<?php bizberg_kar_get_hours( $default_value['h'] ); ?>
				</select>
				<span class="kar_divider">:</span>
				<select class="kar_time_min <?php echo esc_attr( $extra_class ); ?>">
					<?php bizberg_kar_get_min( $default_value['m'] ); ?>
				</select>
			</div>

		</div>

		<?php
	}

}

if( !function_exists( 'bizberg_kar_get_heading_field' ) ){

	function bizberg_kar_get_heading_field( $field, $key ){

		$title           = !empty( $field['label'] ) ? $field['label'] : '';
		$background      = !empty( $field['choices']['background'] ) ? $field['choices']['background'] : '#e91e63';
		$name            = 'checkbox_' . $key;
		$active_callback = !empty( $field['active_callback'] ) ? 'data-active-callback=' . json_encode( $field['active_callback'] ) : '';  ?>

		<div 
		class="fields heading_field" 
		data-type="heading" 
		data-key="<?php echo esc_attr( $key ); ?>" 
		<?php echo esc_attr( $active_callback ); ?>>
			<span style="background: <?php echo esc_attr( $background ); ?>"><?php echo esc_html( $title ); ?></span>
		</div>

		<?php
	}

}

if( !function_exists( 'bizberg_kar_get_checkbox_field' ) ){

	function bizberg_kar_get_checkbox_field( $field, $default_value, $key, $show_default_value_on_add_new_repeater ){

		$title           = !empty( $field['label'] ) ? $field['label'] : '';
		$description     = !empty( $field['description'] ) ? $field['description'] : '';
		$default         = !empty( $field['default'] ) ? $field['default'] : ''; 
		$name            = 'checkbox_' . $key;
		$active_callback = !empty( $field['active_callback'] ) ? 'data-active-callback=' . json_encode( $field['active_callback'] ) : '';

		if( $show_default_value_on_add_new_repeater == true ){
			$default_value = $default;
		} 

		$default_value = (boolean) json_decode( $default_value ); // change to boolean ?>

		<div 
		class="fields checkbox_field" 
		data-type="checkbox" 
		data-key="<?php echo esc_attr( $key ); ?>" 
		<?php echo esc_attr( $active_callback ); ?>>

			<label class="title">
				<input 
				class="kar_checkbox" 
				type="checkbox" 
				name="<?php echo esc_attr( $name ); ?>" 
				<?php echo ( empty( $default_value ) ? '' : 'checked' ); ?>>
				<?php echo esc_html( $title ); ?>
			</label>

			<p class="description">
				<?php echo wp_kses_post( $description ); ?>
			</p>

		</div>

		<?php
	}

}

if( !function_exists( 'bizberg_kar_get_radio_field' ) ){

	function bizberg_kar_get_radio_field( $field, $default_value, $key, $show_default_value_on_add_new_repeater ){

		$title           = !empty( $field['label'] ) ? $field['label'] : '';
		$description     = !empty( $field['description'] ) ? $field['description'] : '';
		$default         = !empty( $field['default'] ) ? $field['default'] : ''; 
		$choices         = !empty( $field['choices'] ) ? $field['choices'] : array();
		$active_callback = !empty( $field['active_callback'] ) ? 'data-active-callback=' . json_encode( $field['active_callback'] ) : '';

		if( $show_default_value_on_add_new_repeater == true ){
			$default_value = $default;
		} ?>

		<div 
		class="fields radio_fields" 
		data-type="radio" 
		data-key="<?php echo esc_attr( $key ); ?>" 
		<?php echo esc_attr( $active_callback ); ?>>
			<label class="title">
				<?php echo esc_html( $title ); ?>
			</label>
			<p class="description">
				<?php echo wp_kses_post( $description ); ?>
			</p>

			<?php

			if( !empty( $choices ) && is_array( $choices ) ){

				$name = 'radio_' . $key . '_'. wp_generate_password( 6, false, false );

				echo '<div class="radio_buttons_wrapper">';

				foreach ( $choices as $key2 => $value ) { ?>
					
					<label>
						<input 
						type="radio" 
						class="kar_radio" 
						value="<?php echo esc_attr( $key2 ); ?>" 
						<?php checked( $key2, $default_value ); ?> 
						name="<?php echo esc_attr( $name ); ?>">
						<?php echo esc_attr( $value ); ?>
					</label>

					<?php
				}

				echo '</div>';

			} ?>

		</div>

		<?php
	}

}

if( !function_exists( 'bizberg_kar_get_image_field' ) ){

	function bizberg_kar_get_image_field( $field, $default_value, $key, $show_default_value_on_add_new_repeater ){

		$title           = !empty( $field['label'] ) ? $field['label'] : '';
		$description     = !empty( $field['description'] ) ? $field['description'] : '';
		$default         = !empty( $field['default'] ) ? $field['default'] : '';
		$active_callback = !empty( $field['active_callback'] ) ? 'data-active-callback=' . json_encode( $field['active_callback'] ) : '';

		if( $show_default_value_on_add_new_repeater == true ){
			$default_value = $default;
		} ?>

		<div 
		class="fields" 
		data-type="image" 
		data-key="<?php echo esc_attr( $key ); ?>" 
		<?php echo esc_attr( $active_callback ); ?>>
			<label class="title">
				<?php echo esc_html( $title ); ?>
			</label>
			<p class="description">
				<?php echo wp_kses_post( $description ); ?>
			</p>

			<div 
			style="display: <?php echo empty( $default_value ) ? 'block' : 'none'; ?>"  
			class="kar_image_preview">No image selected</div>

			<?php
			$url = ''; 
			if( !empty( $default_value ) && is_numeric( $default_value ) ){ // Check number
				$image_arr = wp_get_attachment_image_src( $default_value, 'medium_large' );
				$url = !empty( $image_arr[0] ) ? $image_arr[0] : '';
			} elseif ( filter_var( $default_value, FILTER_VALIDATE_URL ) !== false ){ // Check link
				$url = $default_value;
			}
			?>

			<img src="<?php echo esc_url( $url ); ?>" 
			style="display:<?php echo !empty( $default_value ) ? 'block' : 'none'; ?>;">

			<input 
			type="hidden" 
			class="kar_image" 
			value="<?php echo esc_attr( $default_value ); ?>">

			<div class="kar_buttons_wrapper">
				<a href="javascript:void(0)" class="button kar_select_image">Select Image</a>
				<a 
				style="display:<?php echo !empty( $default_value ) ? 'block' : 'none'; ?>;" 
				href="javascript:void(0)" 
				class="button kar_remove_image">Remove Image</a>
			</div>

		</div>
		<?php
	}

}

if( !function_exists( 'bizberg_kar_get_color_field' ) ){

	function bizberg_kar_get_color_field( $field, $default_value, $key, $extra_class, $show_default_value_on_add_new_repeater ){

		$title           = !empty( $field['label'] ) ? $field['label'] : '';
		$description     = !empty( $field['description'] ) ? $field['description'] : ''; 
		$default         = !empty( $field['default'] ) ? $field['default'] : '';
		$active_callback = !empty( $field['active_callback'] ) ? 'data-active-callback=' . json_encode( $field['active_callback'] ) : '';

		if( $show_default_value_on_add_new_repeater == true ){
			$default_value = $default;
		}

		?>
		<div 
		class="fields" 
		data-type="color" 
		data-key="<?php echo esc_attr( $key ); ?>" 
		<?php echo esc_attr( $active_callback ); ?>>
			<label class="title">
				<?php echo esc_html( $title ); ?>
			</label>
			<p class="description">
				<?php echo wp_kses_post( $description ); ?>
			</p>
			<input 
			type="text" 
			data-alpha="true" 
			data-default-color="<?php echo esc_attr( $default_value ); ?>" 
			class="kar_color <?php echo esc_attr( $extra_class ); ?>" 
			value="<?php echo esc_attr( $default_value ); ?>">
		</div>
		<?php
	}

}

if( !function_exists( 'bizberg_kar_get_select_options' ) ){

	function bizberg_kar_get_select_options( $data, $default_value ){

		foreach ( $data as $key => $value ) {

			echo '<option ';

			if( !is_array( $default_value ) ){
				selected( $key, $default_value );
			} elseif( in_array( $key, $default_value ) ) {
				echo ' selected ';			
			}
			
			echo ' value="' . esc_attr( $key ) . '">' . esc_html( $value ) . '</option>';

		}

	}

}

if( !function_exists( 'bizberg_kar_get_icon_options' ) ){

	function bizberg_kar_get_icon_options( $data, $default_value ){

		foreach ( $data as $key => $value ) {
			echo '<option ';
			selected( $key, $default_value );
			echo ' value="' . esc_attr( $key ) . '">' . esc_html( $value ) . '</option>';
		}

	}

}

if( !function_exists( 'bizberg_kar_get_icon_field' ) ){

	function bizberg_kar_get_icon_field( $field, $default_value, $key, $extra_class, $show_default_value_on_add_new_repeater ){

		$title           = !empty( $field['label'] ) ? $field['label'] : '';
		$description     = !empty( $field['description'] ) ? $field['description'] : '';
		$default         = !empty( $field['default'] ) ? $field['default'] : '';
		$active_callback = !empty( $field['active_callback'] ) ? 'data-active-callback=' . json_encode( $field['active_callback'] ) : '';

		// Show this default value for hidden field
		if( $show_default_value_on_add_new_repeater == true && !empty( $default ) ){
			$default_value = $default;
		} ?>

		<div 
		class="fields" 
		data-type="fontawesome" 
		data-key="<?php echo esc_attr( $key ); ?>" 
		<?php echo esc_attr( $active_callback ); ?>>
			<label class="title">
				<?php echo esc_html( $title ); ?>
			</label>
			<p class="description">
				<?php echo wp_kses_post( $description ); ?>
			</p>
			<select 
			class="kar_fontawesome <?php echo esc_attr( $extra_class ); ?>">
				<?php 
				$choices = !empty( $field['choices'] ) ? $field['choices'] : array();
				bizberg_kar_get_icon_options( $choices, $default_value );
				?>
			</select>
		</div>
		<?php
	}

}

if( !function_exists( 'bizberg_kar_get_select_field' ) ){

	function bizberg_kar_get_select_field( $field, $default_value, $key, $extra_class, $show_default_value_on_add_new_repeater ){

		$title           = !empty( $field['label'] ) ? $field['label'] : '';
		$description     = !empty( $field['description'] ) ? $field['description'] : '';
		$default         = !empty( $field['default'] ) ? $field['default'] : '';
		$active_callback = !empty( $field['active_callback'] ) ? 'data-active-callback=' . json_encode( $field['active_callback'] ) : '';

		// Show this default value for hidden field
		if( $show_default_value_on_add_new_repeater == true && !empty( $default ) ){
			$default_value = $default;
		} ?>

		<div 
		class="fields" 
		data-type="select" 
		data-key="<?php echo esc_attr( $key ); ?>" 
		<?php echo esc_attr( $active_callback ); ?>>
			<label class="title">
				<?php echo esc_html( $title ); ?>
			</label>
			<p class="description">
				<?php echo wp_kses_post( $description ); ?>
			</p>
			<select 
			class="kar_select <?php echo esc_attr( $extra_class ); ?>"
			<?php echo (!empty( $field['multiple'] ) ? 'multiple' : '') ?>>
				<?php 
				$choices = !empty( $field['choices'] ) ? $field['choices'] : array();
				bizberg_kar_get_select_options( $choices, $default_value );
				?>
			</select>
		</div>

		<?php
	}

}

if( !function_exists( 'bizberg_kar_get_textarea_field' ) ){

	function bizberg_kar_get_textarea_field( $field, $default_value, $key, $show_default_value_on_add_new_repeater ){

		$title           = !empty( $field['label'] ) ? $field['label'] : '';
		$description     = !empty( $field['description'] ) ? $field['description'] : '';
		$default         = !empty( $field['default'] ) ? $field['default'] : '';
		$active_callback = !empty( $field['active_callback'] ) ? 'data-active-callback=' . json_encode( $field['active_callback'] ) : ''; ?>

		<div 
		class="fields" 
		data-type="textarea" 
		data-key="<?php echo esc_attr( $key ); ?>" 
		<?php echo esc_attr( $active_callback ); ?>>
			<label class="title">
				<?php echo esc_html( $title ); ?>
			</label>
			<p class="description">
				<?php echo wp_kses_post( $description ); ?>
			</p>
			<?php 
			// For hidden input show another default value
			if( $show_default_value_on_add_new_repeater == true ){ ?>
				<textarea class="kar_textarea"><?php echo esc_html( $default ); ?></textarea>
				<?php
			} else { ?>
				<textarea class="kar_textarea"><?php echo esc_html( $default_value ); ?></textarea>
				<?php
			} ?>
			
		</div>

		<?php
	}

}

if( !function_exists( 'bizberg_kar_get_text_field' ) ){

	function bizberg_kar_get_text_field( $field, $default_value, $key, $show_default_value_on_add_new_repeater ){

		$title           = !empty( $field['label'] ) ? $field['label'] : '';
		$description     = !empty( $field['description'] ) ? $field['description'] : '';
		$default         = !empty( $field['default'] ) ? $field['default'] : '';
		$active_callback = !empty( $field['active_callback'] ) ? 'data-active-callback=' . json_encode( $field['active_callback'] ) : ''; ?>

		<div 
		class="fields" 
		data-type="text" 
		data-key="<?php echo esc_attr( $key ); ?>" 
		<?php echo esc_attr( $active_callback ); ?>>
			<label class="title">
				<?php echo esc_html( $title ); ?>
			</label>
			<p class="description">
				<?php echo wp_kses_post( $description ); ?>
			</p>

			<?php 
			// For hidden input show another default value
			if( $show_default_value_on_add_new_repeater == true ){ ?>
				<input type="text" class="kar_text" value="<?php echo esc_attr( $default ); ?>">
				<?php
			} else { ?>
				<input type="text" class="kar_text" value="<?php echo esc_attr( $default_value ); ?>">
				<?php 
			} ?>
		</div>

		<?php
	}

}

if( !function_exists( 'bizberg_kar_get_number_field' ) ){

	function bizberg_kar_get_number_field( $field, $default_value, $key, $show_default_value_on_add_new_repeater ){

		$title           = !empty( $field['label'] ) ? $field['label'] : '';
		$description     = !empty( $field['description'] ) ? $field['description'] : '';
		$default         = !empty( $field['default'] ) ? $field['default'] : '';
		$active_callback = !empty( $field['active_callback'] ) ? 'data-active-callback=' . json_encode( $field['active_callback'] ) : ''; 

		$min  = !empty( $field['choices']['min'] ) ? $field['choices']['min'] : 0;
		$max  = !empty( $field['choices']['max'] ) ? $field['choices']['max'] : '';
		$step = !empty( $field['choices']['step'] ) ? $field['choices']['step'] : 1;

		// Show this default value for hidden field
		if( $show_default_value_on_add_new_repeater == true ){
			$default_value = $default;
		} ?>

		<div 
		class="fields" 
		data-type="number" 
		data-key="<?php echo esc_attr( $key ); ?>" 
		<?php echo esc_attr( $active_callback ); ?>>
			<label class="title">
				<?php echo esc_html( $title ); ?>
			</label>
			<p class="description">
				<?php echo wp_kses_post( $description ); ?>
			</p>

			<input 
			type="number" 
			class="kar_number" 
			min="<?php echo esc_attr( $min ); ?>" 
			max="<?php echo esc_attr( $max ); ?>" 
			step="<?php echo absint( $step ); ?>" 
			value="<?php echo esc_attr( $default_value ); ?>">
				
		</div>

		<?php
	}

}

if( !function_exists( 'bizberg_kar_get_date_field' ) ){

	function bizberg_kar_get_date_field( $field, $default_value, $key, $extra_class, $show_default_value_on_add_new_repeater ){

		$title           = !empty( $field['label'] ) ? $field['label'] : '';
		$description     = !empty( $field['description'] ) ? $field['description'] : '';
		$default         = !empty( $field['default'] ) ? $field['default'] : '';
		$active_callback = !empty( $field['active_callback'] ) ? 'data-active-callback=' . json_encode( $field['active_callback'] ) : '';

		// Show this default value for hidden field
		if( $show_default_value_on_add_new_repeater == true ){
			$default_value = $default;
		} ?>

		<div 
		class="fields" 
		data-type="date" 
		data-key="<?php echo esc_attr( $key ); ?>" 
		<?php echo esc_attr( $active_callback ); ?>>

			<label class="title">
				<?php echo esc_html( $title ); ?>
			</label>
			<p class="description">
				<?php echo wp_kses_post( $description ); ?>
			</p>

			<input 
			type="text" 
			class="kar_date datepicker <?php echo esc_attr( $extra_class ); ?>" 
			value="<?php echo esc_attr( $default_value ); ?>" 
			data-value="<?php echo esc_attr( $default_value ); ?>">

		</div>

		<?php
	}

}