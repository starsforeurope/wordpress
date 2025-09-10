<?php

add_action( 'init' , 'green_wealth_services' );
function green_wealth_services(){

	Kirki::add_section( 'green_wealth_services_section', array(
        'title'   => esc_html__( 'Services', 'green-wealth' ),
        'section' => 'homepage'
    ) );

    Kirki::add_field( 'bizberg', [
        'type'        => 'checkbox',
        'settings'    => 'green_wealth_services_status',
        'label'       => esc_html__( 'Enable / Disable', 'green-wealth' ),
        'section'     => 'green_wealth_services_section',
        'default'     => false,
    ] );

    Kirki::add_field( 'bizberg', [
        'type'     => 'text',
        'settings' => 'green_wealth_services_subtitle',
        'label'    => esc_html__( 'Subtitle', 'green-wealth' ),
        'section'  => 'green_wealth_services_section',
        'default'  => esc_html__( "THAT'S WHAT WE DO", 'green-wealth' ),
        'active_callback' => [
            [
                'setting'  => 'green_wealth_services_status',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ] );

    Kirki::add_field( 'bizberg', [
        'type'     => 'text',
        'settings' => 'green_wealth_services_title',
        'label'    => esc_html__( 'Title', 'green-wealth' ),
        'section'  => 'green_wealth_services_section',
        'default'  => esc_html__( "Some Of Our Services", 'green-wealth' ),
        'active_callback' => [
            [
                'setting'  => 'green_wealth_services_status',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ] );

    Kirki::add_field( 'bizberg', array(
        'type'        => 'advanced-repeater',
        'label'       => esc_html__( 'Services', 'green-wealth' ),
        'section'     => 'green_wealth_services_section',
        'settings'    => 'green_wealth_services_repeater',
        'choices' => [
            'limit' => 3,
            'button_label' => esc_html__( 'Add Services', 'green-wealth' ),
            'row_label' => [
                'value' => esc_html__( 'Services', 'green-wealth' ),
            ],
            'fields' => [
            	'icon'  => [
	                'type'        => 'fontawesome',
	                'label'       => esc_html__( 'Icon', 'green-wealth' ),
	                'default'     => 'fab fa-accusoft',
	                'choices'     => bizberg_get_fontawesome_options(),
	            ],
                'services_id'  => [
                    'type'        => 'select',
                    'label'       => esc_html__( 'Select Page', 'green-wealth' ),
                    'choices'     => bizberg_get_all_pages(),
                ],
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'green_wealth_services_status',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ) );

}