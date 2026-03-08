<?php

Kirki::add_section( 'woocommerce_floating_menu', array(
    'title'          => esc_html__( 'Floating Menu', 'bizberg' ),
    'panel'          => 'woocommerce',
	'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'checkbox',
	'settings'    => 'woocommerce_floating_menu_status',
	'label'       => esc_html__( 'Enable / Disable', 'bizberg' ),
	'section'     => 'woocommerce_floating_menu',
	'default'     => apply_filters( 'bizberg_woocommerce_floating_menu_status', false )
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'select',
	'settings'    => 'floating_menu_content',
	'label'       => esc_html__( 'Content', 'bizberg' ),
	'section'     => 'woocommerce_floating_menu',
	'default'     => apply_filters( 'bizberg_floating_menu_content', array( 'cart' , 'wishlist' , 'compare' ) ),
	'multiple'    => 3,
	'choices'     => [
		'cart'     => esc_html__( 'Cart', 'bizberg' ),
		'wishlist' => esc_html__( 'Wishlist', 'bizberg' ),
		'compare'  => esc_html__( 'Compare', 'bizberg' )
	],
	'active_callback' => [
		[
			'setting'  => 'woocommerce_floating_menu_status',
			'operator' => '==',
			'value'    => true,
		]
	]
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'simple-color',
	'settings'    => 'floating_menu_background_color',
	'label'       => esc_html__( 'Title Background Color', 'bizberg' ),
	'section'     => 'woocommerce_floating_menu',
	'default'     => apply_filters( 'bizberg_floating_menu_background_color', '#162241' ),
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.header_sidemenu_in .woocommerce_cart_sidebar .title',
			'property' => 'background',
		)
	),
	'active_callback' => [
		[
			'setting'  => 'woocommerce_floating_menu_status',
			'operator' => '==',
			'value'    => true,
		]
	]
] );