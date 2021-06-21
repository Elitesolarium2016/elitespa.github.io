<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * MetaBox
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function zuka_metaboxes_section_fullpage( $sections )
{
    $sections['fullpage'] = array(
        'name'      => 'fullpage',
        'title'     => esc_html_x('FullPageJS', 'admin-view', 'zuka'),
        'icon'      => 'laicon-anchor',
        'fields'    => array(
            array(
                'id'            => 'enable_fp',
                'type'          => 'radio',
                'default'       => 'no',
                'class'         => 'la-radio-style la_enable_fp_fields',
                'title'         => esc_html_x('Enable One Page', 'admin-view', 'zuka'),
                'desc'          => esc_html_x('This option just apply for page layout 1 column', 'admin-view', 'zuka'),
                'options'       => Zuka_Options::get_config_radio_opts(false)
            ),
            array(
                'id'            => 'fp_section_nav',
                'type'          => 'fieldset',
                'title'         => esc_html_x('Navigation', 'admin-view', 'zuka'),
                'dependency'    => array( 'enable_fp_yes', '==', 'true' ),
                'wrap_class'    => 'la-fieldset-toggle',
                'un_array'      => true,
                'fields'        => array(
                    array(
                        'id'            => 'fp_navigation',
                        'type'          => 'select',
                        'title'         => esc_html_x('Section Navigation', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter determines the position of navigation bar.', 'admin-view', 'zuka'),
                        'default'       => 'off',
                        'options'       => array(
                            'off' => esc_html_x('Off', 'admin-view', 'zuka'),
                            'left' => esc_html_x('Left', 'admin-view', 'zuka'),
                            'right' => esc_html_x('Right', 'admin-view', 'zuka')
                        )
                    ),
                    array(
                        'id'            => 'fp_sectionnavigationstyle',
                        'type'          => 'select',
                        'title'         => esc_html_x('Section Navigation Style', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter determines section navigation style.', 'admin-view', 'zuka'),
                        'default'       => 'default',
                        'options'       => array(
                            'default' => esc_html_x('Default', 'admin-view', 'zuka'),
                            'number' => esc_html_x('Number', 'admin-view', 'zuka'),
                            'circles' => esc_html_x('Circles', 'admin-view', 'zuka'),
                            'circles-inverted' => esc_html_x('Circles Inverted', 'admin-view', 'zuka'),
                            'expanding-circles' => esc_html_x('Expanding Circles', 'admin-view', 'zuka'),
                            'filled-circles' => esc_html_x('Filled Circles', 'admin-view', 'zuka'),
                            'filled-circle-within' => esc_html_x('Filled Circles Within', 'admin-view', 'zuka'),
                            'multiple-circles' => esc_html_x('Multiple Circles', 'admin-view', 'zuka'),
                            'rotating-circles' => esc_html_x('Rotating Circles', 'admin-view', 'zuka'),
                            'rotating-circles2' => esc_html_x('Rotating Circles 2', 'admin-view', 'zuka'),
                            'squares' => esc_html_x('Squares', 'admin-view', 'zuka'),
                            'squares-border' => esc_html_x('Squares Border', 'admin-view', 'zuka'),
                            'expanding-squares' => esc_html_x('Expanding Squares', 'admin-view', 'zuka'),
                            'filled-squares' => esc_html_x('Filled Squares', 'admin-view', 'zuka'),
                            'multiple-squares' => esc_html_x('Multiple Squares', 'admin-view', 'zuka'),
                            'squares-to-rombs' => esc_html_x('Squares to Rombs', 'admin-view', 'zuka'),
                            'multiple-squares-to-rombs' => esc_html_x('Multiple Squares to Rombs', 'admin-view', 'zuka'),
                            'filled-rombs' => esc_html_x('Filled Rombs', 'admin-view', 'zuka'),
                            'filled-bars' => esc_html_x('Filled Bars', 'admin-view', 'zuka'),
                            'story-telling' => esc_html_x('Story Telling', 'admin-view', 'zuka'),
                            'crazy-text-effect' => esc_html_x('Crazy Text Effect', 'admin-view', 'zuka')
                        ),
                        'dependency'    => array( 'fp_navigation', '!=', 'off' )
                    ),
                    array(
                        'id'            => 'fp_slidenavigation',
                        'type'          => 'select',
                        'title'         => esc_html_x('Slides Navigation', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter determines the position of landscape navigation bar for sliders.', 'admin-view', 'zuka'),
                        'default'       => 'off',
                        'options'       => array(
                            'off'   => esc_html_x('Off', 'admin-view', 'zuka'),
                            'left'  => esc_html_x('Top', 'admin-view', 'zuka'),
                            'bottom'   => esc_html_x('Bottom', 'admin-view', 'zuka')
                        )
                    ),
                    array(
                        'id'            => 'fp_slidenavigationstyle',
                        'type'          => 'select',
                        'title'         => esc_html_x('Slide Navigation Style', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter determines section navigation style.', 'admin-view', 'zuka'),
                        'default'       => 'default',
                        'options'       => array(
                            'section_nav' => esc_html_x('Same with Section Navigation Style', 'admin-view', 'zuka'),
                            'default' => esc_html_x('Default', 'admin-view', 'zuka'),
                            'circles' => esc_html_x('Circles', 'admin-view', 'zuka'),
                            'circles-inverted' => esc_html_x('Circles Inverted', 'admin-view', 'zuka'),
                            'expanding-circles' => esc_html_x('Expanding Circles', 'admin-view', 'zuka'),
                            'filled-circles' => esc_html_x('Filled Circles', 'admin-view', 'zuka'),
                            'filled-circle-within' => esc_html_x('Filled Circles Within', 'admin-view', 'zuka'),
                            'multiple-circles' => esc_html_x('Multiple Circles', 'admin-view', 'zuka'),
                            'rotating-circles' => esc_html_x('Rotating Circles', 'admin-view', 'zuka'),
                            'rotating-circles2' => esc_html_x('Rotating Circles 2', 'admin-view', 'zuka'),
                            'squares' => esc_html_x('Squares', 'admin-view', 'zuka'),
                            'squares-border' => esc_html_x('Squares Border', 'admin-view', 'zuka'),
                            'expanding-squares' => esc_html_x('Expanding Squares', 'admin-view', 'zuka'),
                            'filled-squares' => esc_html_x('Filled Squares', 'admin-view', 'zuka'),
                            'multiple-squares' => esc_html_x('Multiple Squares', 'admin-view', 'zuka'),
                            'squares-to-rombs' => esc_html_x('Squares to Rombs', 'admin-view', 'zuka'),
                            'multiple-squares-to-rombs' => esc_html_x('Multiple Squares to Rombs', 'admin-view', 'zuka'),
                            'filled-rombs' => esc_html_x('Filled Rombs', 'admin-view', 'zuka'),
                            'filled-bars' => esc_html_x('Filled Bars', 'admin-view', 'zuka'),
                            'story-telling' => esc_html_x('Story Telling', 'admin-view', 'zuka'),
                            'crazy-text-effect' => esc_html_x('Crazy Text Effect', 'admin-view', 'zuka')
                        ),
                        'dependency'    => array( 'fp_slidenavigation', '!=', 'off' )
                    ),

                    array(
                        'id'            => 'fp_lockanchors',
                        'type'          => 'radio',
                        'default'       => 'yes',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html_x('Lock Anchors', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter determines whether anchors in the URL will have any effect.', 'admin-view', 'zuka'),
                        'options'       => Zuka_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_animateanchor',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html_x('Animate Anchor', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter defines whether the load of the site when given anchor (#) will scroll with animation to its destination.', 'admin-view', 'zuka'),
                        'options'       => Zuka_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_keyboardscrolling',
                        'type'          => 'radio',
                        'default'       => 'yes',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html_x('Keyboard Scrolling', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter defines if the content can be navigated using the keyboard.', 'admin-view', 'zuka'),
                        'options'       => Zuka_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_recordhistory',
                        'type'          => 'radio',
                        'default'       => 'yes',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html_x('Record History', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter defines whether to push the state of the site to the browsers history, so back button will work on section navigation.', 'admin-view', 'zuka'),
                        'options'       => Zuka_Options::get_config_radio_opts(false)
                    )
                ),
            ),
            array(
                'id'            => 'fp_section_scroll',
                'type'          => 'fieldset',
                'title'         => esc_html_x('Scrolling', 'admin-view', 'zuka'),
                'dependency'    => array( 'enable_fp_yes', '==', 'true' ),
                'wrap_class'    => 'la-fieldset-toggle',
                'un_array'      => true,
                'fields'        => array(
                    array(
                        'id'            => 'fp_autoscrolling',
                        'type'          => 'radio',
                        'default'       => 'yes',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html_x('Auto Scrolling', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter defines whether to use the automatic scrolling or the normal one.', 'admin-view', 'zuka'),
                        'options'       => Zuka_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_fittosection',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html_x('Fit To Section', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter determines whether or not to fit sections to the viewport or not.', 'admin-view', 'zuka'),
                        'options'       => Zuka_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_fittosectiondelay',
                        'type'          => 'number',
                        'default'       => 1000,
                        'title'         => esc_html_x('Fit To Section Delay', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('The delay in miliseconds for section fitting.', 'admin-view', 'zuka'),
                        'dependency'    => array( 'fp_fittosection_yes', '==', 'true' )
                    ),
                    array(
                        'id'            => 'fp_scrollbar',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html_x('Scroll Bar', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter determines whether to use the scrollbar for the site or not.', 'admin-view', 'zuka'),
                        'options'       => Zuka_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_scrolloverflow',
                        'type'          => 'radio',
                        'default'       => 'yes',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html_x('Scroll Overflow', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter defines whether or not to create a scroll for the section in case the content is bigger than the height of it.', 'admin-view', 'zuka'),
                        'options'       => Zuka_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_hidescrollbars',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html_x('Hide Scrollbars', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter hides scrollbar even if the scrolling is enabled inside the sections.', 'admin-view', 'zuka'),
                        'options'       => Zuka_Options::get_config_radio_opts(false),
                        'dependency'    => array( 'fp_scrolloverflow_yes', '==', 'true' )
                    ),
                    array(
                        'id'            => 'fp_fadescrollbars',
                        'type'          => 'radio',
                        'default'       => 'yes',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html_x('Fade Scrollbars', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter fades scrollbar when unused.', 'admin-view', 'zuka'),
                        'options'       => Zuka_Options::get_config_radio_opts(false),
                        'dependency'    => array( 'fp_scrolloverflow_yes', '==', 'true' )
                    ),
                    array(
                        'id'            => 'fp_interactivescrollbars',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html_x('Interactive Scrollbars', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter makes scrollbar draggable and user can interact with it.', 'admin-view', 'zuka'),
                        'options'       => Zuka_Options::get_config_radio_opts(false),
                        'dependency'    => array( 'fp_scrolloverflow_yes', '==', 'true' )
                    ),
                    array(
                        'id'            => 'fp_bigsectionsdestination',
                        'type'          => 'select',
                        'title'         => esc_html_x('Big Sections Destination', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter defines how to scroll to a section which size is bigger than the viewport.', 'admin-view', 'zuka'),
                        'default'       => 'default',
                        'options'       => array(
                            'default'   => esc_html_x('Default', 'admin-view', 'zuka'),
                            'top'       => esc_html_x('Top', 'admin-view', 'zuka'),
                            'bottom'    => esc_html_x('Bottom', 'admin-view', 'zuka')
                        )
                    ),
                    array(
                        'id'            => 'fp_contvertical',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html_x('Continuous Vertical', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter determines vertical scrolling is continuous.', 'admin-view', 'zuka'),
                        'options'       => Zuka_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_loopbottom',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html_x('Loop Bottom', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter determines whether to use the scrollbar for the site or not.', 'admin-view', 'zuka'),
                        'options'       => Zuka_Options::get_config_radio_opts(false),
                        'dependency'    => array( 'fp_contvertical_no', '==', 'true' )
                    ),
                    array(
                        'id'            => 'fp_looptop',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html_x('Loop Top', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter determines whether to use the scrollbar for the site or not.', 'admin-view', 'zuka'),
                        'options'       => Zuka_Options::get_config_radio_opts(false),
                        'dependency'    => array( 'fp_contvertical_no', '==', 'true' )
                    ),
                    array(
                        'id'            => 'fp_loophorizontal',
                        'type'          => 'radio',
                        'default'       => 'yes',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html_x('Loop Slides', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter defines whether horizontal sliders will loop after reaching the last or previous slide or not.', 'admin-view', 'zuka'),
                        'options'       => Zuka_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_easing',
                        'type'          => 'select',
                        'title'         => esc_html_x('Easing', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter determines the transition effect.', 'admin-view', 'zuka'),
                        'default'       => 'css3_ease',
                        'options'       => array(
                            'css3_ease'             => esc_html_x('CSS3 - Ease', 'admin-view', 'zuka'),
                            'css3_linear'           => esc_html_x('CSS3 - Linear', 'admin-view', 'zuka'),
                            'css3_ease-in'          => esc_html_x('CSS3 - Ease In', 'admin-view', 'zuka'),
                            'css3_ease-out'         => esc_html_x('CSS3 - Ease Out', 'admin-view', 'zuka'),
                            'css3_ease-in-out'      => esc_html_x('CSS3 - Ease In Out', 'admin-view', 'zuka'),
                            'js_linear'             => esc_html_x('Linear', 'admin-view', 'zuka'),
                            'js_swing'              => esc_html_x('Swing', 'admin-view', 'zuka'),
                            'js_easeInQuad'         => esc_html_x('Ease In Quad', 'admin-view', 'zuka'),
                            'js_easeOutQuad'        => esc_html_x('Ease Out Quad', 'admin-view', 'zuka'),
                            'js_easeInOutQuad'      => esc_html_x('Ease In Out Quad', 'admin-view', 'zuka'),
                            'js_easeInCubic'        => esc_html_x('Ease In Cubic', 'admin-view', 'zuka'),
                            'js_easeOutCubic'       => esc_html_x('Ease Out Cubic', 'admin-view', 'zuka'),
                            'js_easeInOutCubic'     => esc_html_x('Ease In Out Cubic', 'admin-view', 'zuka'),
                            'js_easeInQuart'        => esc_html_x('Ease In Quart', 'admin-view', 'zuka'),
                            'js_easeOutQuart'       => esc_html_x('Ease Out Quart', 'admin-view', 'zuka'),
                            'js_easeInOutQuart'     => esc_html_x('Ease In Out Quart', 'admin-view', 'zuka'),
                            'js_easeInQuint'        => esc_html_x('Ease In Quint', 'admin-view', 'zuka'),
                            'js_easeOutQuint'       => esc_html_x('Ease Out Quint', 'admin-view', 'zuka'),
                            'js_easeInOutQuint'     => esc_html_x('Ease In Out Quint', 'admin-view', 'zuka'),
                            'js_easeInExpo'         => esc_html_x('Ease In Expo', 'admin-view', 'zuka'),
                            'js_easeOutExpo'        => esc_html_x('Ease Out Expo', 'admin-view', 'zuka'),
                            'js_easeInOutExpo'      => esc_html_x('Ease In Out Expo', 'admin-view', 'zuka'),
                            'js_easeInSine'         => esc_html_x('Ease In Sine', 'admin-view', 'zuka'),
                            'js_easeOutSine'        => esc_html_x('Ease Out Sine', 'admin-view', 'zuka'),
                            'js_easeInOutSine'      => esc_html_x('Ease In Out Sine', 'admin-view', 'zuka'),
                            'js_easeInCirc'         => esc_html_x('Ease In Circ', 'admin-view', 'zuka'),
                            'js_easeOutCirc'        => esc_html_x('Ease Out Circ', 'admin-view', 'zuka'),
                            'js_easeInOutCirc'      => esc_html_x('Ease In Out Circ', 'admin-view', 'zuka'),
                            'js_easeInElastic'      => esc_html_x('Ease In Elastic', 'admin-view', 'zuka'),
                            'js_easeOutElastic'     => esc_html_x('Ease Out Elastic', 'admin-view', 'zuka'),
                            'js_easeInOutElastic'   => esc_html_x('Ease In Out Elastic', 'admin-view', 'zuka'),
                            'js_easeInBack'         => esc_html_x('Ease In Back', 'admin-view', 'zuka'),
                            'js_easeOutBack'        => esc_html_x('Ease Out Back', 'admin-view', 'zuka'),
                            'js_easeInOutBack'      => esc_html_x('Ease In Out Back', 'admin-view', 'zuka'),
                            'js_easeInBounce'       => esc_html_x('Ease In Bounce', 'admin-view', 'zuka'),
                            'js_easeOutBounce'      => esc_html_x('Ease Out Bounce', 'admin-view', 'zuka'),
                            'js_easeInOutBounce'    => esc_html_x('Ease In Out Bounce', 'admin-view', 'zuka')
                        )
                    ),
                    array(
                        'id'            => 'fp_scrollingspeed',
                        'type'          => 'number',
                        'default'       => 700,
                        'title'         => esc_html_x('Scrolling Speed', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('Speed in miliseconds for the scrolling transitions.', 'admin-view', 'zuka')
                    )
                )
            ),
            array(
                'id'            => 'fp_section_design',
                'type'          => 'fieldset',
                'title'         => esc_html_x('Design', 'admin-view', 'zuka'),
                'dependency'    => array( 'enable_fp_yes', '==', 'true' ),
                'wrap_class'    => 'la-fieldset-toggle',
                'un_array'      => true,
                'fields'        => array(
                    array(
                        'id'            => 'fp_section_effect',
                        'type'          => 'select',
                        'title'         => esc_html_x('Scrolling Sections Effect', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter working only when "Auto Scrolling" is "NO".', 'admin-view', 'zuka'),
                        'default'       => 'default',
                        'options'       => array(
                            'default'       => esc_html_x('Default', 'admin-view', 'zuka'),
                            'gallery'       => esc_html_x('Gallery', 'admin-view', 'zuka'),
                            'scaledown'     => esc_html_x('ScaleDown', 'admin-view', 'zuka'),
                            'rotate'        => esc_html_x('Rotate', 'admin-view', 'zuka'),
                            'opacity'       => esc_html_x('Opacity', 'admin-view', 'zuka')
                        )
                    ),
                    array(
                        'id'            => 'fp_verticalcentered',
                        'type'          => 'radio',
                        'default'       => 'yes',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html_x('Vertically Centered', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('This parameter determines whether to center the content vertically.', 'admin-view', 'zuka'),
                        'options'       => Zuka_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'        => 'fp_respwidth',
                        'type'      => 'slider',
                        'default'   => 0,
                        'title'     => esc_html_x('Responsive Width', 'admin-view', 'zuka' ),
                        'desc'      => esc_html_x('Normal scroll will be used under the defined width in pixels. (autoScrolling: false)', 'admin-view', 'zuka'),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 0,
                            'max'     => 1920,
                            'unit'    => 'px'
                        )
                    ),
                    array(
                        'id'        => 'fp_respheight',
                        'type'      => 'slider',
                        'default'   => 0,
                        'title'     => esc_html_x('Responsive Height	', 'admin-view', 'zuka' ),
                        'desc'      => esc_html_x('Normal scroll will be used under the defined height in pixels. (autoScrolling: false)', 'admin-view', 'zuka'),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 0,
                            'max'     => 5000,
                            'unit'    => 'px'
                        )
                    ),
                    array(
                        'id'        => 'fp_padding',
                        'type'      => 'spacing',
                        'title'     => esc_html_x('Padding', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('Defines top/bottom padding for each section. Useful in case of using fixed header/footer', 'admin-view', 'zuka'),
                        'unit' 	    => 'px',
                        'default'   => array(
                            'top' => 0,
                            'bottom' => 0
                        )
                    )
                )
            )
        )
    );
    return $sections;
}