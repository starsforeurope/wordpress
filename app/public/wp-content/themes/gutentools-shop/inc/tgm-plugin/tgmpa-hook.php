<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 */

// Include the TGM_Plugin_Activation class
require_once get_template_directory() . '/inc/tgm-plugin/class-tgm-plugin-activation.php';

if ( ! function_exists( 'gutentools_shop_register_required_plugins' ) ) {
	add_action( 'tgmpa_register', 'gutentools_shop_register_required_plugins' );

	/**
	 * Register the required plugins for this theme.
	 */
	function gutentools_shop_register_required_plugins() {
		$plugins = array(
			array(
				'name'     => esc_html__( 'Woocommerce', 'gutentools-shop' ),
				'slug'     => 'woocommerce',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Gutentools', 'gutentools-shop' ),
				'slug'     => 'gutentools',
				'required' => false,
			),
		);

		$config = array(
			'id'           => 'gutentools-shop',
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => '',
			'is_automatic' => false,
			'message'      => '',
		);

		tgmpa( $plugins, $config );
	}
}
