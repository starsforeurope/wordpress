<?php
/**
 * Custom Customizer Controls.
 *
 * @package bizberg
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Upsell customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Bizberg_Customize_Section extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'upsell';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { 

		$pro_link = $this->get_pro_link(); 

		if( !empty( $pro_link ) ){ ?>

			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

				<a href="<?php echo esc_url( $pro_link ); ?>" class="button button-secondary alignright button-red" target="_blank">
					<?php esc_html_e( 'Upgrade To PRO', 'bizberg' ); ?>	
				</a>

			</li>

			<?php 			
		
		}

		$this->get_recommended_plugins();

	}

	public function get_recommended_plugins(){

		// Show only if activated from child theme
		if( apply_filters( 'bizberg_show_recommended_plugins_on_customizer', false ) == false ){
			return;
		}

		$status = get_option( 'bizberg_disable_recommended_plugins_status', false );

		// If user close the recommended box dont show it next time
		if( $status ){
			return;
		}

		// If plugin is already installed donot run the below code
		if( defined( 'CDI_PLUGIN_DIR_PATH' ) ){
			return;
		} ?>

		<li 
		id="accordion-section-recommended-plugins-customizer" 
		class="accordion-section control-section control-section-recommended-plugins-customizer cannot-expand recommended-plugins-customizer">
				
			<h3 class="accordion-section-title">
				<?php esc_html_e( 'Recommended Plugins', 'bizberg' ); ?>
				<a href="javascript:void(0)" class="bizberg_remove_install_notice"><span class="dashicons dashicons-dismiss"></span></a>
			</h3>

			<div class="tb_recommended_plugins_wrapper">
				<ul>

					<?php 
					if( !defined( 'CDI_PLUGIN_DIR_PATH' ) ){ ?>
						<li id="cyclone-demo-importer">
							<a href="https://wordpress.org/plugins/cyclone-demo-importer/" target="blank">
								<?php esc_html_e( 'Cyclone Demo Importer', 'bizberg' ); ?>		
							</a>
						</li>
						<?php 
					} 

					if( !class_exists( 'OCDI_Plugin' ) ){ ?>
						<li id="one-click-demo-import">
							<a href="https://wordpress.org/plugins/one-click-demo-import/" target="blank">
								<?php esc_html_e( 'One Click Demo Import', 'bizberg' ); ?>		
							</a>
						</li>
						<?php 
					} 

					if( !class_exists( 'WPCF7' ) ){ ?>
						<li id="contact-form-7">
							<a href="https://wordpress.org/plugins/contact-form-7/" target="blank">
								<?php esc_html_e( 'Contact Form 7', 'bizberg' ); ?>		
							</a>
						</li>
						<?php
					} ?>

				</ul>
				<p><?php esc_html_e( 'If you want to take full advantage of the options this theme has to offer, please install and activate all the recommended plugins.', 'bizberg' ); ?></p>

				<a href="javascript:void(0)" class="button install_activate_recommended_plugins" data-nonce="<?php echo esc_attr( wp_create_nonce("bizberg_install_plugins_from_customizer") ); ?>">
					<span class="bizberg_spinner"><img src="<?php echo esc_url( admin_url( '/images/spinner.gif' ) ); ?>"></span>
					<span class="text"><?php esc_html_e( 'Install & Activate', 'bizberg' ); ?></span>
				</a>

			</div>

		</li>

		<?php
	}

	function get_pro_link(){
		return bizberg_get_pro_link();
	}

}
