<?php
class gradiant_import_dummy_data {

	private static $instance;

	public static function init( ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof gradiant_import_dummy_data ) ) {
			self::$instance = new gradiant_import_dummy_data;
			self::$instance->gradiant_setup_actions();
		}

	}

	/**
	 * Setup the class props based on the config array.
	 */
	

	/**
	 * Setup the actions used for this class.
	 */
	public function gradiant_setup_actions() {

		// Enqueue scripts
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'gradiant_import_customize_scripts' ), 0 );

	}
	
	

	public function gradiant_import_customize_scripts() {

	wp_enqueue_script( 'gradiant-import-customizer-js', get_template_directory_uri() . '/assets/js/gradiant-import-customizer.js', array( 'customize-controls' ) );
	}
}

$gradiant_import_customizers = array(

		'import_data' => array(
			'recommended' => true,
			
		),
);
gradiant_import_dummy_data::init( apply_filters( 'gradiant_import_customizer', $gradiant_import_customizers ) );