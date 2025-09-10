<?php
function gradiant_blog_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Blog  Section
	=========================================*/
	$wp_customize->add_section(
		'blog_setting', array(
			'title' => esc_html__( 'Blog Section', 'gradiant' ),
			'priority' => 10,
			'panel' => 'gradiant_frontpage_sections',
		)
	);

	// Setting Head
	$wp_customize->add_setting(
		'blog_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'blog_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Setting','gradiant'),
			'section' => 'blog_setting',
		)
	);
	
	// Hide / Show 
	$wp_customize->add_setting(
		'blog_hs'
			,array(
			'default'     	=> '1',	
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'blog_hs',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','gradiant'),
			'section' => 'blog_setting',
		)
	);
	
	// Blog Header Section // 
	$wp_customize->add_setting(
		'blog_headings'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'blog_headings',
		array(
			'type' => 'hidden',
			'label' => __('Header','gradiant'),
			'section' => 'blog_setting',
		)
	);
	
	// Blog Title // 
	$wp_customize->add_setting(
    	'blog_title',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'blog_title',
		array(
		    'label'   => __('Title','gradiant'),
		    'section' => 'blog_setting',
			'type'           => 'text',
		)  
	);
	
	// Blog Description // 
	$wp_customize->add_setting(
    	'blog_description',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'blog_description',
		array(
		    'label'   => __('Description','gradiant'),
		    'section' => 'blog_setting',
			'type'           => 'textarea',
		)  
	);

	// Blog content Section // 
	
	$wp_customize->add_setting(
		'blog_content_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'blog_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Content','gradiant'),
			'section' => 'blog_setting',
		)
	);
	
	// blog_display_num
	if ( class_exists( 'Cleverfox_Customizer_Range_Slider_Control' ) ) {
		$wp_customize->add_setting(
			'blog_display_num',
			array(
				'default' => '5',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'gradiant_sanitize_range_value',
				'priority' => 8,
			)
		);
		$wp_customize->add_control( 
		new Cleverfox_Customizer_Range_Slider_Control( $wp_customize, 'blog_display_num', 
			array(
				'label'      => __( 'No of Posts Display', 'gradiant' ),
				'section'  => 'blog_setting',
				 'input_attrs' => array(
					'min'    => 1,
					'max'    => 500,
					'step'   => 1,
					//'suffix' => 'px', //optional suffix
				),
			) ) 
		);
	}
}

add_action( 'customize_register', 'gradiant_blog_setting' );

// blog selective refresh
function gradiant_home_blog_section_partials( $wp_customize ){	
	// blog title
	$wp_customize->selective_refresh->add_partial( 'blog_title', array(
		'selector'            => '.blog-home .heading-default h3',
		'settings'            => 'blog_title',
		'render_callback'  => 'gradiant_blog_title_render_callback',
	) );
	
	// blog description
	$wp_customize->selective_refresh->add_partial( 'blog_description', array(
		'selector'            => '.blog-home .heading-default p',
		'settings'            => 'blog_description',
		'render_callback'  => 'gradiant_blog_desc_render_callback',
	) );
	
	}

add_action( 'customize_register', 'gradiant_home_blog_section_partials' );

// blog title
function gradiant_blog_title_render_callback() {
	return get_theme_mod( 'blog_title' );
}

// blog description
function gradiant_blog_desc_render_callback() {
	return get_theme_mod( 'blog_description' );
}