<?php
/**
 * Benevolent Theme Customizer.
 *
 * @package Benevolent
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function benevolent_customize_register( $wp_customize ) {
    
    /* Option list of all post */   
    $options_posts = array();
    $options_posts_obj = get_posts( 'posts_per_page=-1' );
    $options_posts[''] = __( 'Choose Post', 'benevolent' );
    foreach ( $options_posts_obj as $posts ) {
        $options_posts[$posts->ID] = $posts->post_title;
    }
    
    /* Option list of all categories */
    $args = array(
       'type'                     => 'post',
       'orderby'                  => 'name',
       'order'                    => 'ASC',
       'hide_empty'               => 1,
       'hierarchical'             => 1,
       'taxonomy'                 => 'category'
    ); 
    $option_categories = array();
    $category_lists = get_categories( $args );
    $option_categories[''] = __( 'Choose Category', 'benevolent' );
    foreach( $category_lists as $category ){
        $option_categories[$category->term_id] = $category->name;
    }
    
    /** Default Settings */    
    $wp_customize->add_panel( 
        'wp_default_panel',
         array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __( 'Default Settings', 'benevolent' ),
            'description' => __( 'Default section provided by WordPress customizer.', 'benevolent' ),
        ) 
    );

    $wp_customize->add_section(
        'benevolent_typography_section',
        array(
            'title' => __( 'Typography Settings', 'benevolent' ),
            'priority' => 80,
        )
    );

    $wp_customize->add_setting(
        'ed_localgoogle_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'ed_localgoogle_fonts',
        array(
            'label'   => __( 'Load Google Fonts Locally', 'benevolent' ),
            'section' => 'benevolent_typography_section',
            'type'    => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'ed_preload_local_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'ed_preload_local_fonts',
        array(
            'label'           => __( 'Preload Local Fonts', 'benevolent' ),
            'section'         => 'benevolent_typography_section',
            'type'            => 'checkbox',
            'active_callback' => 'benevolent_flush_fonts_callback'
        )
    );
    

    $wp_customize->add_setting(
        'flush_google_fonts',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses',
        )
    );

    $wp_customize->add_control(
        'flush_google_fonts',
        array(
            'label'       => __( 'Flush Local Fonts Cache', 'benevolent' ),
            'description' => __( 'Click the button to reset the local fonts cache.', 'benevolent' ),
            'type'        => 'button',
            'settings'    => array(),
            'section'     => 'benevolent_typography_section',
            'input_attrs' => array(
                'value' => __( 'Flush Local Fonts Cache', 'benevolent' ),
                'class' => 'button button-primary flush-it',
            ),
            'active_callback' => 'benevolent_flush_fonts_callback'
        )
    );
    
    $wp_customize->get_section( 'title_tagline' )->panel     = 'wp_default_panel';
    $wp_customize->get_section( 'colors' )->panel            = 'wp_default_panel';
    $wp_customize->get_section( 'background_image' )->panel  = 'wp_default_panel';
    $wp_customize->get_section( 'static_front_page' )->panel = 'wp_default_panel'; 
    $wp_customize->get_section( 'benevolent_typography_section' )->panel = 'wp_default_panel';
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'refresh';
    $wp_customize->get_setting( 'background_image' )->transport = 'refresh';
    /** Default Settings Ends */
    
    /** Donate Button */
    $wp_customize->add_section(
        'benevolent_donate_button',
        array(
            'title' => __( 'Donate Button', 'benevolent' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Button Text */
    $wp_customize->add_setting(
        'benevolent_button_text',
        array(
            'default' => __( 'Donate Now', 'benevolent' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_button_text',
        array(
            'label' => __( 'Button Text', 'benevolent' ),
            'section' => 'benevolent_donate_button',
            'type' => 'text',
        )
    );
    
    /** Button Url */
    $wp_customize->add_setting(
        'benevolent_button_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_button_url',
        array(
            'label' => __( 'Button Url', 'benevolent' ),
            'section' => 'benevolent_donate_button',
            'type' => 'text',
        )
    );
    /** Donate Button Ends */
    
    /** Slider Settings */
    $wp_customize->add_section(
        'benevolent_slider_settings',
        array(
            'title' => __( 'Slider Settings', 'benevolent' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable Slider */
    $wp_customize->add_setting(
        'benevolent_ed_slider',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_ed_slider',
        array(
            'label' => __( 'Enable Home Page Slider', 'benevolent' ),
            'section' => 'benevolent_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Auto Transition */
    $wp_customize->add_setting(
        'benevolent_slider_auto',
        array(
            'default' => '1',
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_slider_auto',
        array(
            'label' => __( 'Enable Slider Auto Transition', 'benevolent' ),
            'section' => 'benevolent_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Loop */
    $wp_customize->add_setting(
        'benevolent_slider_loop',
        array(
            'default' => '1',
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_slider_loop',
        array(
            'label' => __( 'Enable Slider Loop', 'benevolent' ),
            'section' => 'benevolent_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Pager */
    $wp_customize->add_setting(
        'benevolent_slider_pager',
        array(
            'default' => '1',
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_slider_pager',
        array(
            'label' => __( 'Enable Slider Pager', 'benevolent' ),
            'section' => 'benevolent_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Caption */
    $wp_customize->add_setting(
        'benevolent_slider_caption',
        array(
            'default' => '1',
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_slider_caption',
        array(
            'label' => __( 'Enable Slider Caption', 'benevolent' ),
            'section' => 'benevolent_slider_settings',
            'type' => 'checkbox',
        )
    );
        
    /** Slider Animation */
    $wp_customize->add_setting(
        'benevolent_slider_animation',
        array(
            'default' => 'slide',
            'sanitize_callback' => 'benevolent_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_slider_animation',
        array(
            'label' => __( 'Choose Slider Animation', 'benevolent' ),
            'section' => 'benevolent_slider_settings',
            'type' => 'select',
            'choices' => array(
                'fade' => __( 'Fade', 'benevolent' ),
                'slide' => __( 'Slide', 'benevolent' ),
            )
        )
    );
    
    /** Slider Speed */
    $wp_customize->add_setting(
        'benevolent_slider_speed',
        array(
            'default' => '7000',
            'sanitize_callback' => 'benevolent_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_slider_speed',
        array(
            'label' => __( 'Slider Speed', 'benevolent' ),
            'section' => 'benevolent_slider_settings',
            'type' => 'text',
        )
    );
    
    /** Animation Speed */
    $wp_customize->add_setting(
        'benevolent_animation_speed',
        array(
            'default' => '600',
            'sanitize_callback' => 'benevolent_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_animation_speed',
        array(
            'label' => __( 'Animation Speed', 'benevolent' ),
            'section' => 'benevolent_slider_settings',
            'type' => 'text',
        )
    );
    
    /** Slider Readmore */
    $wp_customize->add_setting(
        'benevolent_slider_readmore',
        array(
            'default' => __( 'Learn More', 'benevolent' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_slider_readmore',
        array(
            'label' => __( 'Readmore Text', 'benevolent' ),
            'section' => 'benevolent_slider_settings',
            'type' => 'text',
        )
    );
    
    /** Select Category */
    $wp_customize->add_setting(
        'benevolent_slider_cat',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_slider_cat',
        array(
            'label' => __( 'Choose Slider Category', 'benevolent' ),
            'section' => 'benevolent_slider_settings',
            'type' => 'select',
            'choices' => $option_categories,
        )
    );
    /** Slider Settings Ends */
    
    /** Home Page Settings */
    $wp_customize->add_panel( 
        'benevolent_home_page_settings',
         array(
            'priority' => 40,
            'capability' => 'edit_theme_options',
            'title' => __( 'Home Page Settings', 'benevolent' ),
            'description' => __( 'Customize Home Page Settings', 'benevolent' ),
        ) 
    );
    
    /** Intro Section */
    $wp_customize->add_section(
        'benevolent_intro_settings',
        array(
            'title' => __( 'Intro Section', 'benevolent' ),
            'priority' => 30,
            'panel' => 'benevolent_home_page_settings',
        )
    );
    
    /** Enable/Disable intro Section */
    $wp_customize->add_setting(
        'benevolent_ed_intro_section',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_ed_intro_section',
        array(
            'label' => __( 'Enable Intro Section', 'benevolent' ),
            'section' => 'benevolent_intro_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Intro Section Title */
    $wp_customize->add_setting(
        'benevolent_intro_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_intro_section_title',
        array(
            'label' => __( 'Intro Section Title', 'benevolent' ),
            'section' => 'benevolent_intro_settings',
            'type' => 'text',
        )
    );
    
    /** Intro Section Content */
    $wp_customize->add_setting(
        'benevolent_intro_section_content',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_intro_section_content',
        array(
            'label' => __( 'Intro Section Content', 'benevolent' ),
            'section' => 'benevolent_intro_settings',
            'type' => 'text',
        )
    );

    /** Open in new tab */
    $wp_customize->add_setting(
        'benevolent_intro_section_new_tab',
        array(
            'default' => '1',
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_intro_section_new_tab', 
        array(
            'label' => __( 'Open in new tab', 'benevolent' ),
            'section' => 'benevolent_intro_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Intro One Title */
    $wp_customize->add_setting(
        'benevolent_intro_one_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_intro_one_title',
        array(
            'label' => __( 'Intro One Title', 'benevolent' ),
            'section' => 'benevolent_intro_settings',
            'type' => 'text',
        )
    );
    
    /** Intro One Link Label */
    $wp_customize->add_setting(
        'benevolent_intro_one_link',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_intro_one_link',
        array(
            'label' => __( 'Intro One Link Label', 'benevolent' ),
            'section' => 'benevolent_intro_settings',
            'type' => 'text',
        )
    );
    
    /** Intro One Url */
    $wp_customize->add_setting(
        'benevolent_intro_one_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_intro_one_url',
        array(
            'label' => __( 'Intro One Url', 'benevolent' ),
            'section' => 'benevolent_intro_settings',
            'type' => 'text',
        )
    );
    
    /** Upload a Logo One */
    $wp_customize->add_setting(
        'benevolent_intro_one_logo',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Cropped_Image_Control(
           $wp_customize,
           'benevolent_intro_one_logo',
           array(
               'label'      => __( 'Upload a Logo One', 'benevolent' ),
               'section'    => 'benevolent_intro_settings',
               'width'       => 85,
               'height'      => 85,
           )
       )
    );
    
    /** Upload a Image One */
    $wp_customize->add_setting(
        'benevolent_intro_one_image',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Cropped_Image_Control(
           $wp_customize,
           'benevolent_intro_one_image',
           array(
               'label'      => __( 'Upload a Image One', 'benevolent' ),
               'section'    => 'benevolent_intro_settings',
               'width'       => 200,
               'height'      => 200,
           )
       )
    );
    
    /** Intro Two Title */
    $wp_customize->add_setting(
        'benevolent_intro_two_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_intro_two_title',
        array(
            'label' => __( 'Intro Two Title', 'benevolent' ),
            'section' => 'benevolent_intro_settings',
            'type' => 'text',
        )
    );
    
    /** Intro Two Link Label */
    $wp_customize->add_setting(
        'benevolent_intro_two_link',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_intro_two_link',
        array(
            'label' => __( 'Intro Two Link Label', 'benevolent' ),
            'section' => 'benevolent_intro_settings',
            'type' => 'text',
        )
    );
    
    /** Intro Two Url */
    $wp_customize->add_setting(
        'benevolent_intro_two_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_intro_two_url',
        array(
            'label' => __( 'Intro Two Url', 'benevolent' ),
            'section' => 'benevolent_intro_settings',
            'type' => 'text',
        )
    );
    
    /** Upload a Logo Two */
    $wp_customize->add_setting(
        'benevolent_intro_two_logo',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Cropped_Image_Control(
           $wp_customize,
           'benevolent_intro_two_logo',
           array(
               'label'      => __( 'Upload a Logo Two', 'benevolent' ),
               'section'    => 'benevolent_intro_settings',
               'width'       => 85,
               'height'      => 85,
           )
       )
    );
    
    /** Upload a Image Two */
    $wp_customize->add_setting(
        'benevolent_intro_two_image',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Cropped_Image_Control(
           $wp_customize,
           'benevolent_intro_two_image',
           array(
               'label'      => __( 'Upload a Image Two', 'benevolent' ),
               'section'    => 'benevolent_intro_settings',
               'width'       => 200,
               'height'      => 200,
           )
       )
    );
    
    /** Intro Three Title */
    $wp_customize->add_setting(
        'benevolent_intro_three_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_intro_three_title',
        array(
            'label' => __( 'Intro Three Title', 'benevolent' ),
            'section' => 'benevolent_intro_settings',
            'type' => 'text',
        )
    );
    
    /** Intro Three Link Label */
    $wp_customize->add_setting(
        'benevolent_intro_three_link',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_intro_three_link',
        array(
            'label' => __( 'Intro Three Link Label', 'benevolent' ),
            'section' => 'benevolent_intro_settings',
            'type' => 'text',
        )
    );
    
    /** Intro Three Url */
    $wp_customize->add_setting(
        'benevolent_intro_three_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_intro_three_url',
        array(
            'label' => __( 'Intro Three Url', 'benevolent' ),
            'section' => 'benevolent_intro_settings',
            'type' => 'text',
        )
    );
    
    /** Upload a Logo Three */
    $wp_customize->add_setting(
        'benevolent_intro_three_logo',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Cropped_Image_Control(
           $wp_customize,
           'benevolent_intro_three_logo',
           array(
               'label'      => __( 'Upload a Logo Three', 'benevolent' ),
               'section'    => 'benevolent_intro_settings',
               'width'       => 85,
               'height'      => 85,
           )
       )
    );
    
    /** Upload a Image Three */
    $wp_customize->add_setting(
        'benevolent_intro_three_image',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Cropped_Image_Control(
           $wp_customize,
           'benevolent_intro_three_image',
           array(
               'label'      => __( 'Upload a Image Three', 'benevolent' ),
               'section'    => 'benevolent_intro_settings',
               'width'       => 200,
               'height'      => 200,
           )
       )
    );
    /** Intro Section Ends */
    
    /** Community Section */
    $wp_customize->add_section(
        'benevolent_community_settings',
        array(
            'title' => __( 'Community Section', 'benevolent' ),
            'priority' => 40,
            'panel' => 'benevolent_home_page_settings',
        )
    );
    
    /** Enable/Disable Community Section */
    $wp_customize->add_setting(
        'benevolent_ed_community_section',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_ed_community_section',
        array(
            'label' => __( 'Enable Community Section', 'benevolent' ),
            'section' => 'benevolent_community_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Community Section Title */
    $wp_customize->add_setting(
        'benevolent_community_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_community_section_title',
        array(
            'label' => __( 'Community Section Title', 'benevolent' ),
            'section' => 'benevolent_community_settings',
            'type' => 'text',
        )
    );
    
    /** Community Post One */
    $wp_customize->add_setting(
        'benevolent_community_post_one',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_community_post_one',
        array(
            'label' => __( 'Select Post One', 'benevolent' ),
            'section' => 'benevolent_community_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Community Post Two */
    $wp_customize->add_setting(
        'benevolent_community_post_two',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_community_post_two',
        array(
            'label' => __( 'Select Post Two', 'benevolent' ),
            'section' => 'benevolent_community_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Community Post Three */
    $wp_customize->add_setting(
        'benevolent_community_post_three',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_community_post_three',
        array(
            'label' => __( 'Select Post Three', 'benevolent' ),
            'section' => 'benevolent_community_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Community Post Four */
    $wp_customize->add_setting(
        'benevolent_community_post_four',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_community_post_four',
        array(
            'label' => __( 'Select Post Four', 'benevolent' ),
            'section' => 'benevolent_community_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    /** Community Section Ends */
    
    /** Stat Counter Section */
    $wp_customize->add_section(
        'benevolent_stats_settings',
        array(
            'title' => __( 'Stat Counter Section', 'benevolent' ),
            'priority' => 50,
            'panel' => 'benevolent_home_page_settings',
        )
    );
    
    /** Enable/Disable Stat Counter Section */
    $wp_customize->add_setting(
        'benevolent_ed_stats_section',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_ed_stats_section',
        array(
            'label' => __( 'Enable Stat Counter Section', 'benevolent' ),
            'section' => 'benevolent_stats_settings',
            'type' => 'checkbox',
        )
    );
    
    /** First Stat Counter Number */
    $wp_customize->add_setting(
        'benevolent_first_stats_number',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_first_stats_number',
        array(
            'label' => __( 'First Stat Counter Number', 'benevolent' ),
            'section' => 'benevolent_stats_settings',
            'type' => 'text',
        )
    );
    
    /** First Stat Counter Title */
    $wp_customize->add_setting(
        'benevolent_first_stats_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_first_stats_title',
        array(
            'label' => __( 'First Stat Counter Title', 'benevolent' ),
            'section' => 'benevolent_stats_settings',
            'type' => 'text',
        )
    );
    
    /** Second Stat Counter Number */
    $wp_customize->add_setting(
        'benevolent_second_stats_number',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_second_stats_number',
        array(
            'label' => __( 'Second Stat Counter Number', 'benevolent' ),
            'section' => 'benevolent_stats_settings',
            'type' => 'text',
        )
    );
    
    /** Second Stat Counter Title */
    $wp_customize->add_setting(
        'benevolent_second_stats_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_second_stats_title',
        array(
            'label' => __( 'Second Stat Counter Title', 'benevolent' ),
            'section' => 'benevolent_stats_settings',
            'type' => 'text',
        )
    );
    
    /** Third Stat Counter Number */
    $wp_customize->add_setting(
        'benevolent_third_stats_number',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_third_stats_number',
        array(
            'label' => __( 'Third Stat Counter Number', 'benevolent' ),
            'section' => 'benevolent_stats_settings',
            'type' => 'text',
        )
    );
    
    /** Third Stat Counter Title */
    $wp_customize->add_setting(
        'benevolent_third_stats_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_third_stats_title',
        array(
            'label' => __( 'Third Stat Counter Title', 'benevolent' ),
            'section' => 'benevolent_stats_settings',
            'type' => 'text',
        )
    );
    
    /** Fourth Stat Counter Number */
    $wp_customize->add_setting(
        'benevolent_fourth_stats_number',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_fourth_stats_number',
        array(
            'label' => __( 'Fourth Stat Counter Number', 'benevolent' ),
            'section' => 'benevolent_stats_settings',
            'type' => 'text',
        )
    );
    
    /** Fourth Stat Counter Title */
    $wp_customize->add_setting(
        'benevolent_fourth_stats_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_fourth_stats_title',
        array(
            'label' => __( 'Fourth Stat Counter Title', 'benevolent' ),
            'section' => 'benevolent_stats_settings',
            'type' => 'text',
        )
    );
    /** Stat Section Ends */
    
    /** Blog Section */
    $wp_customize->add_section(
        'benevolent_blog_settings',
        array(
            'title' => __( 'Blog Section', 'benevolent' ),
            'priority' => 60,
            'panel' => 'benevolent_home_page_settings',
        )
    );
    
    /** Enable/Disable Blog Section */
    $wp_customize->add_setting(
        'benevolent_ed_blog_section',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_ed_blog_section',
        array(
            'label' => __( 'Enable Blog Section', 'benevolent' ),
            'section' => 'benevolent_blog_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Show/Hide Blog Date */
    $wp_customize->add_setting(
        'benevolent_ed_blog_date',
        array(
            'default' => '1',
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_ed_blog_date',
        array(
            'label' => __( 'Show Blog Date', 'benevolent' ),
            'section' => 'benevolent_blog_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Blog Section Title */
    $wp_customize->add_setting(
        'benevolent_blog_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_blog_section_title',
        array(
            'label' => __( 'Blog Section Title', 'benevolent' ),
            'section' => 'benevolent_blog_settings',
            'type' => 'text',
        )
    );
    
    /** Blog Section Content */
    $wp_customize->add_setting(
        'benevolent_blog_section_content',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_blog_section_content',
        array(
            'label' => __( 'Blog Section Content', 'benevolent' ),
            'section' => 'benevolent_blog_settings',
            'type' => 'text',
        )
    );
    
    /** Blog Section Read More Text */
    $wp_customize->add_setting(
        'benevolent_blog_section_readmore',
        array(
            'default' => __( 'Read More', 'benevolent' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_blog_section_readmore',
        array(
            'label' => __( 'Blog Section Read More Text', 'benevolent' ),
            'section' => 'benevolent_blog_settings',
            'type' => 'text',
        )
    );
    /** Blog Section Ends */
    
    /** Sponsor Section */
    $wp_customize->add_section(
        'benevolent_sponsor_settings',
        array(
            'title' => __( 'Sponsor Section', 'benevolent' ),
            'priority' => 70,
            'panel' => 'benevolent_home_page_settings',
        )
    );
    
    /** Enable/Disable Sponsor Section */
    $wp_customize->add_setting(
        'benevolent_ed_sponsor_section',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_ed_sponsor_section',
        array(
            'label' => __( 'Enable Sponsor Section', 'benevolent' ),
            'section' => 'benevolent_sponsor_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Sponsor Section Title */
    $wp_customize->add_setting(
        'benevolent_sponsor_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_sponsor_section_title',
        array(
            'label' => __( 'Sponsor Section Title', 'benevolent' ),
            'section' => 'benevolent_sponsor_settings',
            'type' => 'text',
        )
    );
    
    /** Logo One */
    $wp_customize->add_setting(
        'benevolent_sponsor_logo_one',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_image',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'benevolent_sponsor_logo_one',
           array(
               'label'      => __( 'Upload Logo One', 'benevolent' ),
               'section'    => 'benevolent_sponsor_settings'
           )
       )
    );
    
    /** Logo One Url */
    $wp_customize->add_setting(
        'benevolent_sponsor_logo_one_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_sponsor_logo_one_url',
        array(
            'label' => __( 'Logo One Url', 'benevolent' ),
            'section' => 'benevolent_sponsor_settings',
            'type' => 'text',
        )
    );
    
    /** Logo Two */
    $wp_customize->add_setting(
        'benevolent_sponsor_logo_two',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_image',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'benevolent_sponsor_logo_two',
           array(
               'label'      => __( 'Upload Logo Two', 'benevolent' ),
               'section'    => 'benevolent_sponsor_settings'
           )
       )
    );
    
    /** Logo Two Url */
    $wp_customize->add_setting(
        'benevolent_sponsor_logo_two_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_sponsor_logo_two_url',
        array(
            'label' => __( 'Logo Two Url', 'benevolent' ),
            'section' => 'benevolent_sponsor_settings',
            'type' => 'text',
        )
    );
    
    /** Logo Three */
    $wp_customize->add_setting(
        'benevolent_sponsor_logo_three',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_image',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'benevolent_sponsor_logo_three',
           array(
               'label'      => __( 'Upload Logo Three', 'benevolent' ),
               'section'    => 'benevolent_sponsor_settings'
           )
       )
    );
    
    /** Logo Three Url */
    $wp_customize->add_setting(
        'benevolent_sponsor_logo_three_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_sponsor_logo_three_url',
        array(
            'label' => __( 'Logo Three Url', 'benevolent' ),
            'section' => 'benevolent_sponsor_settings',
            'type' => 'text',
        )
    );
    
    /** Logo Four */
    $wp_customize->add_setting(
        'benevolent_sponsor_logo_four',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_image',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'benevolent_sponsor_logo_four',
           array(
               'label'      => __( 'Upload Logo Four', 'benevolent' ),
               'section'    => 'benevolent_sponsor_settings'
           )
       )
    );
    
    /** Logo Four Url */
    $wp_customize->add_setting(
        'benevolent_sponsor_logo_four_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_sponsor_logo_four_url',
        array(
            'label' => __( 'Logo Four Url', 'benevolent' ),
            'section' => 'benevolent_sponsor_settings',
            'type' => 'text',
        )
    );
    
    /** Logo Five */
    $wp_customize->add_setting(
        'benevolent_sponsor_logo_five',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_image',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'benevolent_sponsor_logo_five',
           array(
               'label'      => __( 'Upload Logo Five', 'benevolent' ),
               'section'    => 'benevolent_sponsor_settings'
           )
       )
    );
    
    /** Logo Five Url */
    $wp_customize->add_setting(
        'benevolent_sponsor_logo_five_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_sponsor_logo_five_url',
        array(
            'label' => __( 'Logo Five Url', 'benevolent' ),
            'section' => 'benevolent_sponsor_settings',
            'type' => 'text',
        )
    );
    /** Client Section Ends */
    
    /** Promotional Section */
    $wp_customize->add_section(
        'benevolent_promotional_settings',
        array(
            'title' => __( 'Promotional Section', 'benevolent' ),
            'priority' => 80,
            'panel' => 'benevolent_home_page_settings',
        )
    );
    
    /** Enable/Disable Sponsor Section */
    $wp_customize->add_setting(
        'benevolent_ed_promotional_section',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_ed_promotional_section',
        array(
            'label' => __( 'Enable Promotional Section', 'benevolent' ),
            'section' => 'benevolent_promotional_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Promotional Section Title */
    $wp_customize->add_setting(
        'benevolent_promotional_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_promotional_section_title',
        array(
            'label' => __( 'Promotional Section Title', 'benevolent' ),
            'section' => 'benevolent_promotional_settings',
            'type' => 'text',
        )
    );
    
    /** Button Text */
    $wp_customize->add_setting(
        'benevolent_promotional_button_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_promotional_button_text',
        array(
            'label' => __( 'Button Text', 'benevolent' ),
            'section' => 'benevolent_promotional_settings',
            'type' => 'text',
        )
    );
    
    /** Button Url */
    $wp_customize->add_setting(
        'benevolent_promotional_button_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_promotional_button_url',
        array(
            'label' => __( 'Button Url', 'benevolent' ),
            'section' => 'benevolent_promotional_settings',
            'type' => 'text',
        )
    );
    
    /** Background Image */
    $wp_customize->add_setting(
        'benevolent_promotional_section_bg',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_image',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'benevolent_promotional_section_bg',
           array(
               'label'      => __( 'Background Image', 'benevolent' ),
               'section'    => 'benevolent_promotional_settings'
           )
       )
    );
    /** Promotional Section Ends */
    
    /** Home Page Settings Ends */
    
    /** BreadCrumb Settings */
    $wp_customize->add_section(
        'benevolent_breadcrumb_settings',
        array(
            'title' => __( 'Breadcrumb Settings', 'benevolent' ),
            'priority' => 50,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable BreadCrumb */
    $wp_customize->add_setting(
        'benevolent_ed_breadcrumb',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_ed_breadcrumb',
        array(
            'label' => __( 'Enable Breadcrumb', 'benevolent' ),
            'section' => 'benevolent_breadcrumb_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Show/Hide Current */
    $wp_customize->add_setting(
        'benevolent_ed_current',
        array(
            'default' => '1',
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_ed_current',
        array(
            'label' => __( 'Show current', 'benevolent' ),
            'section' => 'benevolent_breadcrumb_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Home Text */
    $wp_customize->add_setting(
        'benevolent_breadcrumb_home_text',
        array(
            'default' => __( 'Home', 'benevolent' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_breadcrumb_home_text',
        array(
            'label' => __( 'Breadcrumb Home Text', 'benevolent' ),
            'section' => 'benevolent_breadcrumb_settings',
            'type' => 'text',
        )
    );
    
    /** Breadcrumb Separator */
    $wp_customize->add_setting(
        'benevolent_breadcrumb_separator',
        array(
            'default' => __( '>', 'benevolent' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_breadcrumb_separator',
        array(
            'label' => __( 'Breadcrumb Separator', 'benevolent' ),
            'section' => 'benevolent_breadcrumb_settings',
            'type' => 'text',
        )
    );
    /** BreadCrumb Settings Ends */
    
    /** Social Settings */
    $wp_customize->add_section(
        'benevolent_social_settings',
        array(
            'title' => __( 'Social Settings', 'benevolent' ),
            'description' => __( 'Leave blank if you do not want to show the social link.', 'benevolent' ),
            'priority' => 50,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable Social Icon in Header */
    $wp_customize->add_setting(
        'benevolent_ed_social_header',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_ed_social_header',
        array(
            'label' => __( 'Enable Social Icons in Header', 'benevolent' ),
            'section' => 'benevolent_social_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Facebook */
    $wp_customize->add_setting(
        'benevolent_facebook',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_facebook',
        array(
            'label' => __( 'Facebook', 'benevolent' ),
            'section' => 'benevolent_social_settings',
            'type' => 'text',
        )
    );

    /** Twitter */
    $wp_customize->add_setting(
        'benevolent_twitter',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_twitter',
        array(
            'label' => __( 'Twitter', 'benevolent' ),
            'section' => 'benevolent_social_settings',
            'type' => 'text',
        )
    );
    
    /** Pinterest */
    $wp_customize->add_setting(
        'benevolent_pinterest',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_pinterest',
        array(
            'label' => __( 'Pinterest', 'benevolent' ),
            'section' => 'benevolent_social_settings',
            'type' => 'text',
        )
    );
    
    /** LinkedIn */
    $wp_customize->add_setting(
        'benevolent_linkedin',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_linkedin',
        array(
            'label' => __( 'LinkedIn', 'benevolent' ),
            'section' => 'benevolent_social_settings',
            'type' => 'text',
        )
    );
    
    /** Instagram */
    $wp_customize->add_setting(
        'benevolent_instagram',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_instagram',
        array(
            'label' => __( 'Instagram', 'benevolent' ),
            'section' => 'benevolent_social_settings',
            'type' => 'text',
        )
    );
    
    /** YouTube */
    $wp_customize->add_setting(
        'benevolent_youtube',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_youtube',
        array(
            'label' => __( 'YouTube', 'benevolent' ),
            'section' => 'benevolent_social_settings',
            'type' => 'text',
        )
    );

    /** Tiktok */
    $wp_customize->add_setting(
        'benevolent_tiktok',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_tiktok',
        array(
            'label' => __( 'Tiktok', 'benevolent' ),
            'section' => 'benevolent_social_settings',
            'type' => 'text',
        )
    );
    /** Social Settings Ends */
     if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
    /** Custom CSS*/
    $wp_customize->add_section(
        'benevolent_custom_settings',
        array(
            'title' => __( 'Custom CSS Settings', 'benevolent' ),
            'priority' => 50,
            'capability' => 'edit_theme_options',
        )
    );
    
    $wp_customize->add_setting(
        'benevolent_custom_css',
        array(
            'default' => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'benevolent_sanitize_css'
            )
    );
    
    $wp_customize->add_control(
        'benevolent_custom_css',
        array(
            'label' => __( 'Custom Css', 'benevolent' ),
            'section' => 'benevolent_custom_settings',
            'description' => __( 'Put your custom CSS', 'benevolent' ),
            'type' => 'textarea',
        )
    );
    /** Custom CSS Ends */
   }

     /** Footer Section */
    $wp_customize->add_section(
        'benevolent_footer_section',
        array(
            'title' => __( 'Footer Settings', 'benevolent' ),
            'priority' => 70,
        )
    );
    
    /** Copyright Text */
    $wp_customize->add_setting(
        'benevolent_footer_copyright_text',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_footer_copyright_text',
        array(
            'label' => __( 'Copyright Info', 'benevolent' ),
            'section' => 'benevolent_footer_section',
            'type' => 'textarea',
        )
    );
 
    
    /**
     * Sanitization Functions
     * 
     * @link https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php 
     */
     function benevolent_sanitize_checkbox( $checked ){
        // Boolean check.
        return ( ( isset( $checked ) && true == $checked ) ? true : false );
     }
     
     function benevolent_sanitize_select( $input, $setting ){
        // Ensure input is a slug.
        $input = sanitize_key( $input );
        
        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;
        
        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
     }
         
     function benevolent_sanitize_number_absint( $number, $setting ) {
        // Ensure $number is an absolute integer (whole number, zero or greater).
        $number = absint( $number );
        
        // If the input is an absolute integer, return it; otherwise, return the default
        return ( $number ? $number : $setting->default );
     }
     
     function benevolent_sanitize_image( $image, $setting ) {
        /*
         * Array of valid image file types.
         *
         * The array includes image mime types that are included in wp_get_mime_types()
         */
        $mimes = array(
            'jpg|jpeg|jpe' => 'image/jpeg',
            'gif'          => 'image/gif',
            'png'          => 'image/png',
            'bmp'          => 'image/bmp',
            'tif|tiff'     => 'image/tiff',
            'ico'          => 'image/x-icon'
        );
        // Return an array with file extension and mime_type.
        $file = wp_check_filetype( $image, $mimes );
        // If $image has a valid mime_type, return it; otherwise, return the default.
        return ( $file['ext'] ? $image : $setting->default );
    }
    
    function benevolent_sanitize_css( $css ){
        return wp_strip_all_tags( $css );
    }

    if ( version_compare( get_bloginfo('version'),'4.9', '>=') ) {
        $wp_customize->get_section( 'static_front_page' )->title = __( 'Static Front Page', 'benevolent' );
    }
     
}
add_action( 'customize_register', 'benevolent_customize_register' );

function benevolent_flush_fonts_callback( $control ){
    $ed_localgoogle_fonts   = $control->manager->get_setting( 'ed_localgoogle_fonts' )->value();
    $control_id   = $control->id;
    
    if ( $control_id == 'flush_google_fonts' && $ed_localgoogle_fonts ) return true;
    if ( $control_id == 'ed_preload_local_fonts' && $ed_localgoogle_fonts ) return true;
    return false;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function benevolent_customize_preview_js() {
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    wp_enqueue_script( 'benevolent_customizer', get_template_directory_uri() . '/js' . $build . '/customizer' . $suffix . '.js', array( 'customize-preview' ), BENEVOLENT_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'benevolent_customize_preview_js' );

function benevolent_customizer_scripts(){
    $array = array( 
        'ajax_url'   => admin_url( 'admin-ajax.php' ),
        'flushit'    => __( 'Successfully Flushed!','benevolent' ),
        'nonce'      => wp_create_nonce('ajax-nonce')
    );
    wp_enqueue_script( 'benevolent-customizer', get_template_directory_uri().'/inc/js/customizer.js', array( 'jquery' ), BENEVOLENT_THEME_VERSION, true );
    wp_localize_script( 'benevolent-customizer', 'benevolent_cdata', $array );
}
add_action( 'customize_controls_enqueue_scripts', 'benevolent_customizer_scripts' );