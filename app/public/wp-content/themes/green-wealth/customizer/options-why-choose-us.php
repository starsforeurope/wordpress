<?php

add_action( 'init' , 'green_wealth_why_choose' );
function green_wealth_why_choose(){

	Kirki::add_section( 'green_wealth_process_section', array(
        'title'   => esc_html__( 'Why Choose Us', 'green-wealth' ),
        'section' => 'homepage'
    ) );

    Kirki::add_field( 'bizberg', [
        'type'        => 'checkbox',
        'settings'    => 'green_wealth_process_status',
        'label'       => esc_html__( 'Enable / Disable', 'green-wealth' ),
        'section'     => 'green_wealth_process_section',
        'default'     => false,
    ] );

    Kirki::add_field( 'bizberg', [
        'type'     => 'text',
        'settings' => 'green_wealth_process_subtitle',
        'label'    => esc_html__( 'Subtitle', 'green-wealth' ),
        'section'  => 'green_wealth_process_section',
        'default'  => esc_html__( 'WHY CHOOSE US', 'green-wealth' ),
        'active_callback' => [
            [
                'setting'  => 'green_wealth_process_status',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ] );

    Kirki::add_field( 'bizberg', [
        'type'     => 'text',
        'settings' => 'green_wealth_process_title',
        'label'    => esc_html__( 'Title', 'green-wealth' ),
        'section'  => 'green_wealth_process_section',
        'default'  => esc_html__( 'Advantages of Wind Energy Power', 'green-wealth' ),
        'active_callback' => [
            [
                'setting'  => 'green_wealth_process_status',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ] );

    Kirki::add_field( 'bizberg', array(
        'type'        => 'advanced-repeater',
        'label'       => esc_html__( 'Why Choose Us', 'green-wealth' ),
        'section'     => 'green_wealth_process_section',
        'settings'    => 'green_wealth_process_repeater',
        'choices' => [
            'limit' => 4,
            'button_label' => esc_html__( 'Add Why Choose Us', 'green-wealth' ),
            'row_label' => [
                'value' => esc_html__( 'Why Choose Us', 'green-wealth' ),
            ],
            'fields' => [
                'icon'  => [
                    'type'        => 'fontawesome',
                    'label'       => esc_html__( 'Icon', 'green-wealth' ),
                    'default'     => 'fab fa-accusoft',
                    'choices'     => bizberg_get_fontawesome_options(),
                ],
                'process'  => [
                    'type'        => 'select',
                    'label'       => esc_html__( 'Select Page', 'green-wealth' ),
                    'choices'     => bizberg_get_all_pages(),
                ],
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'green_wealth_process_status',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ) );

}