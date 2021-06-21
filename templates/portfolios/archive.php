<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $zuka_loop;

$tmp = $zuka_loop;
$zuka_loop = array();

$loop_layout = Zuka()->settings()->get('portfolio_display_type', 'grid');
$loop_style = Zuka()->settings()->get('portfolio_display_style', '1');

$height_mode        = zuka_get_theme_loop_prop('height_mode', 'original');
$thumb_custom_height= zuka_get_theme_loop_prop('height', '');

zuka_set_theme_loop_prop('is_main_loop', true, true);
zuka_set_theme_loop_prop('loop_layout', $loop_layout);
zuka_set_theme_loop_prop('loop_style', $loop_style);
zuka_set_theme_loop_prop('responsive_column', Zuka()->settings()->get('portfolio_column', array('xlg'=> 1, 'lg'=> 1,'md'=> 1,'sm'=> 1,'xs'=> 1)));
zuka_set_theme_loop_prop('image_size', Zuka_Helper::get_image_size_from_string(Zuka()->settings()->get('portfolio_thumbnail_size', 'full'),'full'));
zuka_set_theme_loop_prop('title_tag', 'h4');
zuka_set_theme_loop_prop('excerpt_length', '15');
zuka_set_theme_loop_prop('item_space', Zuka()->settings()->get('portfolio_item_space', 'default'));
zuka_set_theme_loop_prop('height_mode', Zuka()->settings()->get('portfolio_thumbnail_height_mode', 'original'));
zuka_set_theme_loop_prop('height', Zuka()->settings()->get('portfolio_thumbnail_height_custom', ''));

echo '<div id="archive_portfolio_listing" class="la-portfolio-listing">';

if( have_posts() ){

    get_template_part("templates/portfolios/start", $loop_style);

    while( have_posts() ){

        the_post();

        get_template_part("templates/portfolios/loop", $loop_style);

    }

    get_template_part("templates/portfolios/end", $loop_style);

}

echo '</div>';
/**
 * Display pagination and reset loop
 */

zuka_the_pagination();

wp_reset_postdata();

$zuka_loop = $tmp;