<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$loop_id            = zuka_get_theme_loop_prop('loop_id', uniqid('la_testimonial_'));
$loop_style         = zuka_get_theme_loop_prop('loop_style', 1);
$responsive_column  = zuka_get_theme_loop_prop('responsive_column', array());
$slider_configs     = zuka_get_theme_loop_prop('slider_configs', '');
$item_space         = zuka_get_theme_loop_prop('item_space', 30);
$slider_css_class   = zuka_get_theme_loop_prop('slider_css_class', '');

$loopCssClass = array('la-loop','testimonial-loop la_testimonials');
$loopCssClass[] = 'loop-style-' . $loop_style;
$loopCssClass[] = 'la_testimonials--style-' . $loop_style;
$loopCssClass[] = 'grid-items';
$loopCssClass[] = 'grid-space-'. $item_space;

if(!empty($slider_configs)){
    $loopCssClass[] = 'js-el la-slick-slider' . $slider_css_class;
}
else{
    $loopCssClass[] = zuka_render_grid_css_class_from_columns($responsive_column);
}

printf(
    '<div class="%1$s"%2$s>',
    esc_attr(implode(' ', $loopCssClass)),
    (!empty($slider_configs) ? ' data-la_component="AutoCarousel" ' . $slider_configs : '')
);