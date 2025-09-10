<?php

Kirki::add_field( 'bizberg', [
    'type'        => 'checkbox',
    'settings'    => 'homepage_blog_status',
    'label'       => esc_html__( 'Hide Homepage Blog', 'bizberg' ),
    'section'     => 'homepage',
    'default'     => apply_filters( 'bizberg_homepage_blog_status', false )
] );

Kirki::add_field( 'bizberg', [
    'type'        => 'select',
    'settings'    => 'homepage_latest_posts_category',
    'label'       => esc_html__( 'Category', 'bizberg' ),
    'section'     => 'homepage',
    'default'     => apply_filters( 'bizberg_homepage_latest_posts_category', '' ),
    'multiple'    => 1,
    'choices'     => bizberg_get_post_categories(),
    'active_callback' => [
        [
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        ]
    ],
] );

Kirki::add_field( 'bizberg', [
    'type'        => 'select',
    'settings'    => 'homepage_latest_posts_limit',
    'label'       => esc_html__( 'Post Limit', 'bizberg' ),
    'section'     => 'homepage',
    'default'     => apply_filters( 'bizberg_homepage_latest_posts_limit', 'all' ),
    'multiple'    => 1,
    'active_callback' => [
        [
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        ]
    ],
    'choices'     => array(
        'all'  => esc_html__( 'Show All Posts', 'bizberg' ),
        '1'   => '1',
        '2'   => '2',
        '3'   => '3',
        '4'   => '4',
        '5'   => '5',
        '6'   => '6',
        '7'   => '7',
        '8'   => '8',
        '9'   => '9',
        '10'  => '10',
        '11'  => '11',
        '12'  => '12',
        '13'  => '13',
        '14'  => '14',
        '15'  => '15'
    )
] );

Kirki::add_field( 'bizberg', [
    'type'        => 'checkbox',
    'settings'    => 'homepage_ignore_sticky_posts',
    'label'       => esc_html__( 'Ignore Sticky Posts', 'bizberg' ),
    'section'     => 'homepage',
    'active_callback' => [
        [
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        ]
    ],
    'default'     => apply_filters( 'bizberg_homepage_ignore_sticky_posts', false )
] );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'homepage_blog_title_label',
    'section'     => 'homepage',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Title Settings', 'bizberg' ) . '</div>',
    'active_callback' => [
        [
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        ]
    ],
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'text',
	'settings'    => 'homepage_blog_title',
	'label'       => esc_html__( 'Label', 'bizberg' ),
	'section'     => 'homepage',
	'default'     => apply_filters( 'bizberg_homepage_blog_title', '' ),
    'active_callback' => [
        [
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        ]
    ],
) );

bizberg_kirki_dtm_options( 
    array(
        'display' => array(
            'desktop' => 'desktop',
            'tablet' => 'tablet',
            'mobile' => 'mobile'
        ),
        'field_id' => 'bizberg',
        'section' => 'homepage',
        'settings' => 'homepage_title_font_size',
        'global_active_callback'    => [
            [
                'setting'  => 'homepage_blog_status',
                'operator' => '==',
                'value'    => false,
            ]
        ],
        'fields' => array(
            'slider' => array(
                'desktop' => array(
                    'label' => esc_html__( 'Title Font Size ( Desktop )', 'bizberg' ),
                    'settings' => 'homepage_title_font_size_desktop',
                    'default' => apply_filters( 'bizberg_homepage_title_font_size_desktop', 40 ),
                    'choices'     => [
                        'min'  => 10,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    'transport' => 'auto',
                    'output' => array(
                        array(
                            'element'  => '.home h2.homepage_blog_title',
                            'property' => 'font-size',
                            'value_pattern' => '$px !important'
                        )
                    ),
                ),
                'tablet' => array(
                    'label' => esc_html__( 'Title Font Size ( Tablet )', 'bizberg' ),
                    'settings' => 'homepage_title_font_size_tablet',
                    'default' => apply_filters( 'bizberg_homepage_title_font_size_tablet', 35 ),
                    'choices'     => [
                        'min'  => 10,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    'transport' => 'auto',
                    'output' => array(
                        array(
                            'element'  => '.home h2.homepage_blog_title',
                            'property' => 'font-size',
                            'value_pattern' => '$px !important',
                            'media_query' => '@media (min-width: 481px) and (max-width: 1024px)'
                        )
                    ),
                ),
                'mobile' => array(
                    'label' => esc_html__( 'Title Font Size ( Mobile )', 'bizberg' ),
                    'settings' => 'homepage_title_font_size_mobile',
                    'default' => apply_filters( 'bizberg_homepage_title_font_size_mobile', 30 ),
                    'choices'     => [
                        'min'  => 10,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    'transport' => 'auto',
                    'output' => array(
                        array(
                            'element'  => '.home h2.homepage_blog_title',
                            'property' => 'font-size',
                            'value_pattern' => '$px !important',
                            'media_query' => '@media (min-width: 320px) and (max-width: 480px)'
                        )
                    ),
                )
            ),
        )
        
    ) 
);

Kirki::add_field( 'bizberg', array(
	'type'        => 'select',
	'settings'    => 'homepage_blog_title_font_weight',
	'label'       => esc_html__( 'Font Weight', 'bizberg' ),
	'section'     => 'homepage',
	'default'     => apply_filters( 'bizberg_homepage_blog_title_font_weight', '700' ),
	'choices'     => array(
		'100'   => '100',
		'300' => '300',
		'500'  => '500',
        '600'  => '600',
		'700'  => '700',
		'900'  => '900'
	),
	'multiple'    => 1,
    'active_callback' => [
        [
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        ]
    ],
	'transport' => 'auto',
	'output' => array(
        array(
            'element'  => '.home h2.homepage_blog_title',
            'property' => 'font-weight',
            'value_pattern' => '$'
        )
    ),
) );

bizberg_kirki_dtm_options( 
    array(
        'display' => array(
            'desktop' => 'desktop',
            'tablet' => 'tablet',
            'mobile' => 'mobile'
        ),
        'field_id' => 'bizberg',
        'section' => 'homepage',
        'settings' => 'homepage_top_bottom_spacing',
        'global_active_callback'    => [
            [
                'setting'  => 'homepage_blog_status',
                'operator' => '==',
                'value'    => false,
            ]
        ],
        'fields' => array(
            'dimensions' => array(
                'desktop' => array(
                    'label' => esc_html__( 'Spacing ( Desktop )', 'bizberg' ),
                    'settings' => 'homepage_top_bottom_spacing_desktop',
                    'default'     => apply_filters( 'bizberg_homepage_top_bottom_spacing_desktop', [
                        'padding-top'    => '30',
                        'padding-bottom' => '50'
                    ]),  
                    'choices'     => [
                        'labels' => [
                            'padding-top'  => esc_html__( 'Top', 'bizberg' ),
                            'padding-bottom'  => esc_html__( 'Bottom', 'bizberg' )
                        ],
                    ],
                    'transport' => 'postMessage',                      
                    'output' => array(
                        array(
                            'element'  => '.home h2.homepage_blog_title',
                            'value_pattern' => '$px'
                        )
                    ),
                    'js_vars' => array(
                        array(
                            'element'  => '.home h2.homepage_blog_title',
                            'value_pattern' => '$px'
                        )
                    ),
                ),
                'tablet' => array(
                    'label' => esc_html__( 'Spacing ( Tablet )', 'bizberg' ),
                    'settings' => 'homepage_top_bottom_spacing_tablet',
                    'default'     => apply_filters( 'bizberg_homepage_top_bottom_spacing_tablet', [
                        'padding-top'    => '30',
                        'padding-bottom' => '50'
                    ]),  
                    'choices'     => [
                        'labels' => [
                            'padding-top'  => esc_html__( 'Top', 'bizberg' ),
                            'padding-bottom'  => esc_html__( 'Bottom', 'bizberg' )
                        ],
                    ],  
                    'transport' => 'postMessage',                    
                    'output' => array(
                        array(
                            'element'  => '.home h2.homepage_blog_title',
                            'value_pattern' => '$px',
                            'media_query' => '@media (min-width: 481px) and (max-width: 1024px)'
                        )
                    ),
                    'js_vars' => array(
                        array(
                            'element'  => '.home h2.homepage_blog_title',
                            'value_pattern' => '$px',
                            'media_query' => '@media (min-width: 481px) and (max-width: 1024px)'
                        )
                    ),
                ),
                'mobile' => array(
                    'label' => esc_html__( 'Spacing ( Mobile )', 'bizberg' ),
                    'settings' => 'homepage_top_bottom_spacing_mobile',
                    'default'     => apply_filters( 'bizberg_homepage_top_bottom_spacing_mobile', [
                        'padding-top'    => '30',
                        'padding-bottom' => '30'
                    ]),  
                    'choices'     => [
                        'labels' => [
                            'padding-top'  => esc_html__( 'Top', 'bizberg' ),
                            'padding-bottom'  => esc_html__( 'Bottom', 'bizberg' )
                        ],
                    ], 
                    'transport' => 'postMessage',
                    'output' => array(
                        array(
                            'element'  => '.home h2.homepage_blog_title',
                            'value_pattern' => '$px',
                            'media_query' => '@media (min-width: 320px) and (max-width: 480px)'
                        )
                    ),
                    'js_vars' => array(
                        array(
                            'element'  => '.home h2.homepage_blog_title',
                            'value_pattern' => '$px',
                            'media_query' => '@media (min-width: 320px) and (max-width: 480px)'
                        )
                    ),
                )
            ),
        )
        
    ) 
);

Kirki::add_field( 'bizberg', array(
	'type'        => 'select',
	'settings'    => 'homepage_blog_title_align',
	'label'       => esc_html__( 'Align', 'bizberg' ),
	'section'     => 'homepage',
	'default'     => apply_filters( 'bizberg_homepage_blog_title_align', 'center' ),
	'choices'     => array(
		'center'   => esc_html__( 'Center', 'bizberg' ),
		'left' => esc_html__( 'Left', 'bizberg' ),
		'right'  => esc_html__( 'Right', 'bizberg' )
	),
	'multiple'    => 1,
    'active_callback' => [
        [
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        ]
    ],
	'transform' => 'auto',
	'output' => array(
        array(
            'element'  => '.home h2.homepage_blog_title',
            'property' => 'text-align',
            'value_pattern' => '$'
        )
    ),
) );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'homepage_blog_options',
    'section'     => 'homepage',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Other Settings', 'bizberg' ) . '</div>',
    'active_callback' => [
        [
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        ]
    ],
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'select',
	'settings'    => 'sidebar_settings',
	'label'       => esc_html__( 'Sidebar', 'bizberg' ),
	'section'     => 'homepage',
	'default'     => apply_filters( 'bizberg_sidebar_settings', '1' ),
	'choices'     => array(
		'1'  => esc_html__( 'Right Sidebar', 'bizberg' ),
		'2'  => esc_html__( 'Left Sidebar', 'bizberg' ),
		'3'  => esc_html__( 'No Sidebar ( Two Columns )', 'bizberg' ),
		'4'  => esc_html__( 'No Sidebar ( Three Columns )', 'bizberg' ),
        '5'  => esc_html__( 'Grid View ( Two Columns )', 'bizberg' ),
        '6'  => esc_html__( 'List View ( One Column )', 'bizberg' ),
	),
    'active_callback' => [
        [
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        ]
    ],
) );

Kirki::add_field( 'bizberg', array(
    'type'        => 'select',
    'settings'    => 'blog_listing_image_size',
    'label'       => esc_html__( 'Blog Listing Image Size', 'bizberg' ),
    'section'     => 'homepage',
    'default'     => apply_filters( 'bizberg_blog_listing_image_size', 'col-xs-6|col-xs-6' ),
    'choices'     => array(
        'col-xs-5|col-xs-7'   => esc_html__( 'Small', 'bizberg' ),
        'col-xs-6|col-xs-6'   => esc_html__( 'Large', 'bizberg' ),
    ),
    'active_callback' => array(
        array(
            array(
                'setting'  => 'sidebar_settings',
                'operator' => 'in',
                'value'    =>  array( '1', '2' )
            ),
        ),
        array(
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        )
    ),
) );

Kirki::add_field( 'bizberg', [
    'type'        => 'slider',
    'settings'    => 'three_col_listing_radius',
    'label'       => esc_html__( 'Border Radius', 'bizberg' ),
    'section'     => 'homepage',
    'default'     => apply_filters( 'bizberg_three_col_listing_radius', '15' ),
    'choices'     => [
        'min'  => 0,
        'max'  => 25,
        'step' => 1,
    ],
    'active_callback' => [
        [
            'setting'  => 'sidebar_settings',
            'operator' => '==',
            'value'    => 4
        ],
        [
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        ]
    ],
    'transport' => 'auto',
    'output' => array(
        array(
            'element'       => '.blog-nosidebar-1#blog .blog-post, .blog-nosidebar-1#blog .blog-post.blog-large .entry-thumbnail img',
            'property'      => 'border-radius',
            'value_pattern' => '$px'
        )
    )
] );

Kirki::add_field( 'bizberg', array(
    'type'        => 'toggle',
    'settings'    => 'sticky_content_sidebar',
    'label'       => esc_html__( 'Sticky Sidebar', 'bizberg' ),
    'section'     => 'homepage',
    'default'     => apply_filters( 'bizberg_sticky_content_sidebar' , true ),
    'active_callback' => [
        [
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        ]
    ],
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'text',
	'settings'    => 'excerpt_length',
	'label'       => esc_html__( 'Excerpt Length', 'bizberg' ),
	'description' => esc_html__( 'Enter number of words to display in excerpt', 'bizberg' ),
	'section'     => 'homepage',
	'default'     => apply_filters( 'bizberg_excerpt_length', 60 ),
    'active_callback' => [
        [
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        ]
    ],
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'toggle',
	'settings'    => 'hide_author',
	'label'       => esc_html__( 'Hide Author', 'bizberg' ),
	'section'     => 'homepage',
    'default'     => apply_filters( 'bizberg_hide_author' , true ),
    'active_callback' => array(
        array(
            array(
                'setting'  => 'sidebar_settings',
                'operator' => 'in',
                'value'    =>  array( '1','2','3','4' )
            ),
        ),
        array(
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        )
    ),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'toggle',
	'settings'    => 'hide_category',
	'label'       => esc_html__( 'Hide Category', 'bizberg' ),
	'section'     => 'homepage',
    'active_callback' => array(
        array(
            array(
                'setting'  => 'sidebar_settings',
                'operator' => 'in',
                'value'    =>  array( '1','2','3','4' )
            ),
        ),
        array(
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        )
    ),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'toggle',
	'settings'    => 'hide_comment',
	'label'       => esc_html__( 'Hide Comment', 'bizberg' ),
	'section'     => 'homepage',
	'default'     => false,
    'active_callback' => array(
        array(
            array(
                'setting'  => 'sidebar_settings',
                'operator' => 'in',
                'value'    =>  array( '1','2','3','4' )
            ),
        ),
        array(
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        )
    ),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'toggle',
	'settings'    => 'hide_post_date',
	'label'       => esc_html__( 'Hide Date', 'bizberg' ),
	'section'     => 'homepage',
	'default'     => false,
    'active_callback' => array(
        array(
            array(
                'setting'  => 'sidebar_settings',
                'operator' => 'in',
                'value'    =>  array( '1','2','3','4' )
            ),
        ),
        array(
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        )
    ),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'toggle',
	'settings'    => 'hide_read_time',
	'label'       => esc_html__( 'Hide Read Time', 'bizberg' ),
	'section'     => 'homepage',
	'default'     => false,
    'active_callback' => array(
        array(
            array(
                'setting'  => 'sidebar_settings',
                'operator' => 'in',
                'value'    =>  array( '1','2','3','4' )
            ),
        ),
        array(
            'setting'  => 'homepage_blog_status',
            'operator' => '==',
            'value'    => false,
        )
    ),
) );