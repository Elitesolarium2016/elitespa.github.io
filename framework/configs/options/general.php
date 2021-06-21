<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * General settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function zuka_options_section_general( $sections ) {

    $header_logo_opts = array();

    if(class_exists('LAHFB')){
        $header_logo_opts[] = array(
            'type'    => 'content',
            'class'   => 'info',
            'content' => sprintf(
                '<a class="button button-primary" href="%s"><i class="dashicons dashicons-external"></i>%s</a>',
                admin_url('themes.php?page=lastudio_header_builder_setting'),
                esc_html__('Open Header Builder', 'zuka')
            )
        );
    }
    else{
        $header_logo_opts[] = array(
            'id'        => 'logo',
            'type'      => 'image',
            'title'     => esc_html_x('Default Logo', 'admin-view', 'zuka'),
            'desc'      => esc_html_x('Select an image file for your logo.', 'admin-view', 'zuka')
        );

        $header_logo_opts[] = array(
            'id'        => 'logo_transparency',
            'type'      => 'image',
            'title'     => esc_html_x('Transparency Header Logo', 'admin-view', 'zuka'),
            'desc'      => esc_html_x('Select an image file for your transparency header logo.', 'admin-view', 'zuka')
        );
    }

    $sections['general'] = array(
        'name'          => 'general_panel',
        'title'         => esc_html_x('General', 'admin-view', 'zuka'),
        'icon'          => 'fa fa-tachometer',
        'sections' => array(
            array(
                'name'      => 'general_sections',
                'title'     => esc_html_x('General', 'admin-view', 'zuka'),
                'icon'      => 'fa fa-check',
                'fields'    => array(
                    array(
                        'id'        => 'layout',
                        'title'     => esc_html_x('Global Layout', 'admin-view', 'zuka'),
                        'type'      => 'image_select',
                        'radio'     => true,
                        'default'   => 'col-1c',
                        'desc'      => esc_html_x('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'admin-view', 'zuka'),
                        'options'   => Zuka_Options::get_config_main_layout_opts(true, false)
                    ),
                    array(
                        'id'        => 'body_boxed',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('Enable Layout Boxed', 'admin-view', 'zuka'),
                        'options'   => Zuka_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'        => 'body_max_width',
                        'type'      => 'slider',
                        'default'    => 1230,
                        'title'     => esc_html_x( 'Body Max Width', 'admin-view', 'zuka' ),
                        'dependency' => array('body_boxed_yes', '==', 'true'),
                        'options'   => array(
                            'step'    => 5,
                            'min'     => 900,
                            'max'     => 2000,
                            'unit'    => 'px'
                        )
                    ),
                    array(
                        'id'        => 'main_full_width',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('100% Main Width', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('Turn on to have the main area display at 100% width according to the window size. Turn off to follow site width.', 'admin-view', 'zuka'),
                        'options'   => Zuka_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'main_space',
                        'type'          => 'spacing',
                        'title'         => esc_html_x('Custom Main Space', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('Leave empty if you not need', 'admin-view', 'zuka'),
                        'unit' 	        => 'px',
                        'default'       => array(
                            'top'       => '70',
                            'bottom'    => '30'
                        )
                    ),

                    array(
                        'id'        => 'backtotop_btn',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('"Back to top" Button', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('Turn on to show "Back to top" button', 'admin-view', 'zuka'),
                        'options'   => Zuka_Options::get_config_radio_opts(false)
                    )
                )
            ),
            array(
                'name'      => 'favicon_sections',
                'title'     => esc_html_x('Custom Favicon', 'admin-view', 'zuka'),
                'icon'      => 'fa fa-check',
                'fields'    => array(
                    array(
                        'id'        => 'favicon',
                        'type'      => 'image',
                        'title'     => esc_html_x('Favicon', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('Favicon for your website at 16px x 16px.', 'admin-view', 'zuka')
                    ),
                    array(
                        'id'        => 'favicon_iphone',
                        'type'      => 'image',
                        'title'     => esc_html_x('Apple iPhone Icon Upload', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('Favicon for Apple iPhone at 57px x 57px.', 'admin-view', 'zuka')
                    ),
                    array(
                        'id'        => 'favicon_ipad',
                        'type'      => 'image',
                        'title'     => esc_html_x('Apple iPad Icon Upload', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('Favicon for Apple iPad at 72px x 72px.', 'admin-view', 'zuka')
                    )
                )
            ),
            array(
                'name'      => 'logo_sections',
                'title'     => esc_html_x('Logo', 'admin-view', 'zuka'),
                'icon'      => 'fa fa-check',
                'fields'    => $header_logo_opts
            ),
            array(
                'name'      => 'color_sections',
                'title'     => esc_html_x('Colors', 'admin-view', 'zuka'),
                'icon'      => 'fa fa-paint-brush',
                'fields'    => array(
                    array(
                        'id'        => 'body_background',
                        'type'      => 'background',
                        'title'     => esc_html_x('Body Background', 'admin-view', 'zuka')
                    ),
                    array(
                        'id'        => 'body_boxed_background',
                        'type'      => 'background',
                        'title'     => esc_html_x('Body Boxed Background', 'admin-view', 'zuka'),
                        'dependency' => array('body_boxed_yes', '==', 'true'),
                    ),
                    array(
                        'id'        => 'text_color',
                        'default'   => Zuka_Options::get_color_default('text_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Text Color', 'admin-view', 'zuka')
                    ),
                    array(
                        'id'        => 'heading_color',
                        'default'   => Zuka_Options::get_color_default('heading_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Heading Color', 'admin-view', 'zuka')
                    ),
                    array(
                        'id'        => 'primary_color',
                        'default'   => Zuka_Options::get_color_default('primary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Primary Color', 'admin-view', 'zuka')
                    ),
                    array(
                        'id'        => 'secondary_color',
                        'default'   => Zuka_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Secondary Color', 'admin-view', 'zuka')
                    ),
                    array(
                        'id'        => 'three_color',
                        'default'   => Zuka_Options::get_color_default('three_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Three Color', 'admin-view', 'zuka')
                    ),
                    array(
                        'id'        => 'border_color',
                        'default'   => Zuka_Options::get_color_default('border_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Border Color', 'admin-view', 'zuka')
                    )
                )
            ),
            array(
                'name'      => 'loading_sections',
                'title'     => esc_html_x('Page Preload', 'admin-view', 'zuka'),
                'icon'      => 'fa fa-refresh fa-spin',
                'fields'    => array(
                    array(
                        'id'        => 'page_loading_animation',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'off',
                        'title'     => esc_html_x('Page Preload Animation', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('Turn on to show the icon/images loading animation before view site', 'admin-view', 'zuka'),
                        'options'   => Zuka_Options::get_config_radio_onoff(false)
                    ),
                    array(
                        'id'        => 'page_loading_style',
                        'type'      => 'select',
                        'default'   => '1',
                        'title'     => esc_html_x('Select Preload Style', 'admin-view', 'zuka'),
                        'options'   => array(
                            '1'         => esc_html_x('Style 1', 'admin-view', 'zuka'),
                            '2'         => esc_html_x('Style 2', 'admin-view', 'zuka'),
                            '3'         => esc_html_x('Style 3', 'admin-view', 'zuka'),
                            '4'         => esc_html_x('Style 4', 'admin-view', 'zuka'),
                            '5'         => esc_html_x('Style 5', 'admin-view', 'zuka'),
                            'custom'    => esc_html_x('Custom image', 'admin-view', 'zuka')
                        ),
                        'dependency' => array('page_loading_animation_on', '==', 'true'),
                    ),
                    array(
                        'id'        => 'page_loading_custom',
                        'type'      => 'image',
                        'title'     => esc_html_x('Custom Page Loading Image', 'admin-view', 'zuka'),
                        'add_title' => esc_html_x('Add Image', 'admin-view', 'zuka'),
                        'dependency'=> array('page_loading_animation_on|page_loading_style', '==|==', 'true|custom'),
                    )
                )
            )
        )
    );
    return $sections;
}