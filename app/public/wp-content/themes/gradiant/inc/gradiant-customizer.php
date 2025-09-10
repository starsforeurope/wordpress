<?php
/**
 * Gradiant Theme Customizer.
 *
 * @package Gradiant
 */

 if ( ! class_exists( 'Gradiant_Customizer' ) ) {

	/**
	 * Customizer Loader
	 *
	 * @since 1.0.0
	 */
	class Gradiant_Customizer {

		/**
		 * Instance
		 *
		 * @access private
		 * @var object
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			/**
			 * Customizer
			 */
			add_action( 'customize_preview_init',                  array( $this, 'gradiant_customize_preview_js' ) );
			add_action( 'customize_controls_enqueue_scripts', 	   array( $this, 'gradiant_customizer_script' ) );
			add_action( 'customize_register',                      array( $this, 'gradiant_customizer_register' ) );
			add_action( 'after_setup_theme',                       array( $this, 'gradiant_customizer_settings' ) );
		}
		
		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		function gradiant_customizer_register( $wp_customize ) {
			
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
			$wp_customize->get_setting('custom_logo')->transport = 'refresh';

			/**
			 * Helper files
			 */
			require GRADIANT_PARENT_INC_DIR . '/custom-controls/font-control.php';
			require GRADIANT_PARENT_INC_DIR . '/sanitization.php';
		}

		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		function gradiant_customize_preview_js() {
			wp_enqueue_script( 'gradiant-customizer', GRADIANT_PARENT_URI . '/assets/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
		}
		
		function gradiant_customizer_script() {
			 wp_enqueue_script( 'gradiant-customizer-section', GRADIANT_PARENT_URI .'/assets/js/customizer-section.js', array("jquery"),'', true  );	
		}

		// Include customizer customizer settings.
			
		function gradiant_customizer_settings() {
				require GRADIANT_PARENT_INC_DIR . '/customize/gradiant-header.php';
				require GRADIANT_PARENT_INC_DIR . '/customize/gradiant-blog.php';
				require GRADIANT_PARENT_INC_DIR . '/customize/gradiant-footer.php';
				require GRADIANT_PARENT_INC_DIR . '/customize/gradiant-general.php';
				require GRADIANT_PARENT_INC_DIR . '/customize/gradiant-premium.php';
				require GRADIANT_PARENT_INC_DIR . '/customize/customizer_recommended_plugin.php';
				require GRADIANT_PARENT_INC_DIR . '/customize/customizer_import_data.php';
		}

	}
}// End if().

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Gradiant_Customizer::get_instance();