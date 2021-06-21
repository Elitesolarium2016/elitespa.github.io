<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

$shortcode_params = array(
    array(
        'type' => 'attach_image',
        'heading' => __('Upload the banner image', 'zuka'),
        'param_name' => 'banner_id'
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Height Mode','zuka'),
        'param_name' => 'height_mode',
        'value' => array(
            __('1:1','zuka') => '1-1',
            __('Original','zuka') => 'original',
            __('4:3','zuka') => '4-3',
            __('3:4','zuka') => '3-4',
            __('16:9','zuka') => '16-9',
            __('9:16','zuka') => '9-16',
            __('Custom','zuka') => 'custom',
        ),
        'std' => 'original',
        'description' => __('Sizing proportions for height and width. Select "Original" to scale image without cropping.', 'zuka')
    ),
    array(
        'type' 			=> 'textfield',
        'heading' 		=> __('Height', 'zuka'),
        'param_name' 	=> 'height',
        'value'			=> '',
        'description' 	=> __('Enter custom height.', 'zuka'),
        'dependency' => array(
            'element'   => 'height_mode',
            'value'     => array('custom')
        )
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Design','zuka'),
        'param_name' => 'style',
        'value' => array(
            __('Style Right','zuka') => '1',
            __('Style Left','zuka') => '2',
            __('Style Bottom Left','zuka') => '3',
            __('Style Center Center','zuka') => '4',
            __('Style Left Center','zuka') => '5',
            __('Style Right Center','zuka') => '12',
            __('Style Bottom Left 2','zuka') => '6',
            __('Style Bottom Center','zuka') => '7',
            __('Style Bottom Center 2','zuka') => '8',
        ),
        'std' => '1'
    ),

    array(
        'type' => 'vc_link',
        'heading' => __('Banner Link', 'zuka'),
        'param_name' => 'banner_link',
        'description' => __('Add link / select existing page to link to this banner', 'zuka')
    ),


    array(
        'type' => 'textfield',
        'heading' => __( 'Banner Title 1', 'zuka' ),
        'param_name' => 'title_1',
        'admin_label' => true
    ),

    array(
        'type' => 'textfield',
        'heading' => __( 'Banner Title 2', 'zuka' ),
        'param_name' => 'title_2',
        'admin_label' => true//,
        // 'dependency' => array(
        //     'element' => 'style',
        //     'value' => array('1','2','3','6','7','8','9','10','11')
        // ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __( 'Banner Title 3', 'zuka' ),
        'param_name' => 'title_3',
        'admin_label' => true//,
        // 'dependency' => array(
        //     'element' => 'style',
        //     'value' => array('3','7','8','10')
        // ),
    ),

    LaStudio_Shortcodes_Helper::fieldElementID(array(
        'param_name' 	=> 'el_id'
    )),

    LaStudio_Shortcodes_Helper::fieldExtraClass(),
    LaStudio_Shortcodes_Helper::fieldExtraClass(array(
        'heading' 		=> __('Extra class name for title 1', 'zuka'),
        'param_name' 	=> 'el_class1',
    )),
    LaStudio_Shortcodes_Helper::fieldExtraClass(array(
        'heading' 		=> __('Extra class name for title 2', 'zuka'),
        'param_name' 	=> 'el_class2',
        // 'dependency' => array(
        //     'element' => 'style',
        //     'value' => array('1','3','2','6','7','8','9','11')
        // )
    )),
    LaStudio_Shortcodes_Helper::fieldExtraClass(array(
        'heading' 		=> __('Extra class name for title 3', 'zuka'),
        'param_name' 	=> 'el_class3',
        // 'dependency' => array(
        //     'element' => 'style',
        //     'value' => array('3','7', '8','10')
        // )
    )),
//    array(
//        'type' 			=> 'colorpicker',
//        'param_name' 	=> 'overlay_bg_color',
//        'heading' 		=> __('Overlay background color', 'zuka'),
//        'group' 		=> 'Design'
//    ),
//    array(
//        'type' 			=> 'colorpicker',
//        'param_name' 	=> 'overlay_hover_bg_color',
//        'heading' 		=> __('Overlay hover background color', 'zuka'),
//        'group' 		=> 'Design'
//    ),
//    array(
//        'type' 			=> 'colorpicker',
//        'param_name' 	=> 'btn_color',
//        'heading' 		=> __('Button Color', 'zuka'),
//        'group' 		=> 'Design'
//    ),
//    array(
//        'type' 			=> 'colorpicker',
//        'param_name' 	=> 'btn_bg_color',
//        'heading' 		=> __('Button Background Color', 'zuka'),
//        'group' 		=> 'Design'
//    ),
//    array(
//        'type' 			=> 'colorpicker',
//        'param_name' 	=> 'btn_hover_color',
//        'heading' 		=> __('Button Hover Color', 'zuka'),
//        'group' 		=> 'Design'
//    ),
//    array(
//        'type' 			=> 'colorpicker',
//        'param_name' 	=> 'btn_hover_bg_color',
//        'heading' 		=> __('Button Hover Background Color', 'zuka'),
//        'group' 		=> 'Design'
//    ),
);

$param_fonts_title1 = LaStudio_Shortcodes_Helper::fieldTitleGFont('title_1', __('Title 1', 'zuka'));
$param_fonts_title2 = LaStudio_Shortcodes_Helper::fieldTitleGFont('title_2', __('Title 2', 'zuka'));
// $param_fonts_title1 = LaStudio_Shortcodes_Helper::fieldTitleGFont('title_1', __('Title 1', 'zuka'));
// $param_fonts_title2 = LaStudio_Shortcodes_Helper::fieldTitleGFont('title_2', __('Title 2', 'zuka'), array(
//     'element' => 'style',
//     'value' => array('1','3','2','6','7','8','9','10', '11')
// ));
$param_fonts_title3 = LaStudio_Shortcodes_Helper::fieldTitleGFont('title_3', __('Title 3', 'zuka'));
/*$param_fonts_title3 = LaStudio_Shortcodes_Helper::fieldTitleGFont('title_3', __('Title 3', 'zuka'), array(
    'element' => 'style',
    'value' => array('3','7','8', '10')
));*/


$shortcode_params = array_merge( $shortcode_params, $param_fonts_title1, $param_fonts_title2, $param_fonts_title3);

return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name'			=> __('Banner Box', 'zuka'),
        'base'			=> 'la_banner',
        'icon'          => 'la-wpb-icon la_banner',
        'category'  	=> __('La Studio', 'zuka'),
        'description'   => __('Displays the banner image with Information', 'zuka'),
        'params' 		=> $shortcode_params
    ),
    'la_banner'
);