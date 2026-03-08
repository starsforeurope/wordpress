<?php
/* Notifications in customizer */


require get_template_directory() . '/inc/customizer-notify/gradiant-customizer-notify.php';
$gradiant_config_customizer = array(
	'recommended_plugins'       => array(
		'clever-fox' => array(
			'recommended' => true,
			'description' => sprintf(__('Install and activate <strong>Cleverfox</strong> plugin for taking full advantage of all the features this theme has to offer.', 'gradiant')),
		),
	),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'gradiant' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'gradiant' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'gradiant' ),
	'activate_button_label'     => esc_html__( 'Activate', 'gradiant' ),
	'gradiant_deactivate_button_label'   => esc_html__( 'Deactivate', 'gradiant' ),
);
Gradiant_Customizer_Notify::init( apply_filters( 'gradiant_customizer_notify_array', $gradiant_config_customizer ) );
?>