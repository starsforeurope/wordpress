<?php
function gradiant_general_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'gradiant_general', array(
			'priority' => 31,
			'title' => esc_html__( 'General', 'gradiant' ),
		)
	);
	
	
	/*=========================================
	Background Elements
	=========================================*/
	$wp_customize->add_section(
		'bg_elements', array(
			'title' => esc_html__( 'Background Elements', 'gradiant' ),
			'priority' => 1,
			'panel' => 'gradiant_general',
		)
	);
	
	$wp_customize->add_setting( 
		'hs_bg_elements' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gradiant_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'hs_bg_elements', 
		array(
			'label'	      => esc_html__( 'Hide / Show Background Elements', 'gradiant' ),
			'section'     => 'bg_elements',
			'type'        => 'checkbox'
		) 
	);
	
	/*=========================================
	Scroller
	=========================================*/
	$wp_customize->add_section(
		'top_scroller', array(
			'title' => esc_html__( 'Scroller', 'gradiant' ),
			'priority' => 4,
			'panel' => 'gradiant_general',
		)
	);
	
	$wp_customize->add_setting( 
		'hs_scroller' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gradiant_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'hs_scroller', 
		array(
			'label'	      => esc_html__( 'Hide / Show Scroller', 'gradiant' ),
			'section'     => 'top_scroller',
			'type'        => 'checkbox'
		) 
	);
	
	/*=========================================
	Breadcrumb  Section
	=========================================*/
	$wp_customize->add_section(
		'breadcrumb_setting', array(
			'title' => esc_html__( 'Breadcrumb', 'gradiant' ),
			'priority' => 12,
			'panel' => 'gradiant_general',
		)
	);
	
	// Settings
	$wp_customize->add_setting(
		'breadcrumb_settings'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'breadcrumb_settings',
		array(
			'type' => 'hidden',
			'label' => __('Settings','gradiant'),
			'section' => 'breadcrumb_setting',
		)
	);
	
	// Breadcrumb Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'hs_breadcrumb' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gradiant_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'hs_breadcrumb', 
		array(
			'label'	      => esc_html__( 'Hide / Show Section', 'gradiant' ),
			'section'     => 'breadcrumb_setting',
			'type'        => 'checkbox'
		) 
	);
	
	// enable Effect
	$wp_customize->add_setting(
		'breadcrumb_effect_enable'
			,array(
			'default' => '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'breadcrumb_effect_enable',
		array(
			'type' => 'checkbox',
			'label' => __('Enable Water Effect on Breadcrumb?','gradiant'),
			'section' => 'breadcrumb_setting',
		)
	);
	
	// Breadcrumb Content Section // 
	$wp_customize->add_setting(
		'breadcrumb_contents'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_text',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
	'breadcrumb_contents',
		array(
			'type' => 'hidden',
			'label' => __('Content','gradiant'),
			'section' => 'breadcrumb_setting',
		)
	);
	
	// Content size // 
	if ( class_exists( 'Cleverfox_Customizer_Range_Slider_Control' ) ) {
		$wp_customize->add_setting(
			'breadcrumb_min_height',
			array(
				'default' => 246,
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'gradiant_sanitize_range_value',
				'transport'         => 'postMessage',
				'priority' => 8,
			)
		);
		$wp_customize->add_control( 
			new Cleverfox_Customizer_Range_Slider_Control( $wp_customize, 'breadcrumb_min_height', 
				array(
					'label'      => __( 'Min Height', 'gradiant'),
					'section'  => 'breadcrumb_setting',
					'input_attrs' => array(
						'min'    => 1,
						'max'    => 1000,
						'step'   => 1,
						//'suffix' => 'px', //optional suffix
					),
				) ) 
			);
	}	
		
	// Background // 
	$wp_customize->add_setting(
		'breadcrumb_bg_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_text',
			'priority' => 9,
		)
	);

	$wp_customize->add_control(
	'breadcrumb_bg_head',
		array(
			'type' => 'hidden',
			'label' => __('Background','gradiant'),
			'section' => 'breadcrumb_setting',
		)
	);
	
	// Background Image // 
    $wp_customize->add_setting( 
    	'breadcrumb_bg_img' , 
    	array(
			'default' 			=> esc_url(get_template_directory_uri() .'/assets/images/breadcrumb/breadcrumb.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_url',	
			'priority' => 10,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'breadcrumb_bg_img' ,
		array(
			'label'          => esc_html__( 'Background Image', 'gradiant'),
			'section'        => 'breadcrumb_setting',
		) 
	));
	
	// Background Attachment // 
	$wp_customize->add_setting( 
		'breadcrumb_back_attach' , 
			array(
			'default' => 'scroll',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_select',
			'priority'  => 10,
		) 
	);
	
	$wp_customize->add_control(
	'breadcrumb_back_attach' , 
		array(
			'label'          => __( 'Background Attachment', 'gradiant' ),
			'section'        => 'breadcrumb_setting',
			'type'           => 'select',
			'choices'        => 
			array(
				'inherit' => __( 'Inherit', 'gradiant' ),
				'scroll' => __( 'Scroll', 'gradiant' ),
				'fixed'   => __( 'Fixed', 'gradiant' )
			) 
		) 
	);
	
	/*=========================================
	Gradiant Container
	=========================================*/
	$wp_customize->add_section(
        'gradiant_container',
        array(
        	'priority'      => 2,
            'title' 		=> __('Container','gradiant'),
			'panel'  		=> 'gradiant_general',
		)
    );
	
	if ( class_exists( 'Cleverfox_Customizer_Range_Slider_Control' ) ) {
		//container width
		$wp_customize->add_setting(
			'gradiant_site_cntnr_width',
			array(
				'default'			=> '1200',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'gradiant_sanitize_range_value',
				'transport'         => 'postMessage',
				'priority'      => 1,
			)
		);
		$wp_customize->add_control( 
		new Cleverfox_Customizer_Range_Slider_Control( $wp_customize, 'gradiant_site_cntnr_width', 
			array(
				'label'      => __( 'Container Width', 'gradiant' ),
				'section'  => 'gradiant_container',
				'input_attrs' => array(
					 'min'           => 768,
					'max'           => 2000,
					'step'          => 1,
					//'suffix' => 'px', //optional suffix
				),
			) ) 
		);
		
	}
}

add_action( 'customize_register', 'gradiant_general_setting' );
