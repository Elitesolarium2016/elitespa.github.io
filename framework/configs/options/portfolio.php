<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Portfolio settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function zuka_options_section_portfolio( $sections )
{
    $sections['portfolio'] = array(
        'name' => 'portfolio_panel',
        'title' => esc_html_x('Portfolio', 'admin-view', 'zuka'),
        'icon' => 'fa fa-th',
        'sections' => array(
            array(
                'name'      => 'portfolio_label_section',
                'title'     => esc_html_x('Label Setting', 'admin-view', 'zuka'),
                'icon'      => 'fa fa-check',
                'fields'    => array(
                    array(
                        'id'        => 'portfolio_custom_name',
                        'type'      => 'text',
                        'default'   => 'Portfolios',
                        'title'     => esc_html_x('Portfolio Name', 'admin-view', 'zuka'),
                    ),
                    array(
                        'id'        => 'portfolio_custom_name2',
                        'type'      => 'text',
                        'default'   => 'Portfolio',
                        'title'     => esc_html_x('Portfolio Singular Name', 'admin-view', 'zuka'),
                    ),
                    array(
                        'id'        => 'portfolio_custom_slug',
                        'type'      => 'text',
                        'default'   => 'portfolio',
                        'title'     => esc_html_x('Portfolio Slug', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('When you change the portfolio slug, please remember go to Setting -> Permalinks and click to Save Changes button once again', 'admin-view', 'zuka'),
                    ),

                    array(
                        'id'        => 'portfolio_cat_custom_name',
                        'type'      => 'text',
                        'default'   => 'Portfolio Categories',
                        'title'     => esc_html_x('Portfolio Category Name', 'admin-view', 'zuka'),
                    ),

                    array(
                        'id'        => 'portfolio_cat_custom_name2',
                        'type'      => 'text',
                        'default'   => 'Portfolio Category',
                        'title'     => esc_html_x('Portfolio Category Singular Name', 'admin-view', 'zuka'),
                    ),
                    array(
                        'id'        => 'portfolio_cat_custom_slug',
                        'type'      => 'text',
                        'default'   => 'portfolio-category',
                        'title'     => esc_html_x('Portfolio Category Slug', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('When you change the portfolio slug, please remember go to Setting -> Permalinks and click to Save Changes button once again', 'admin-view', 'zuka'),
                    ),

                    array(
                        'id'        => 'portfolio_skill_custom_name',
                        'type'      => 'text',
                        'default'   => 'Portfolio Skills',
                        'title'     => esc_html_x('Portfolio Skill Name', 'admin-view', 'zuka'),
                    ),
                    array(
                        'id'        => 'portfolio_skill_custom_name2',
                        'type'      => 'text',
                        'default'   => 'Portfolio Skill',
                        'title'     => esc_html_x('Portfolio Skill Singular Name', 'admin-view', 'zuka'),
                    ),
                    array(
                        'id'        => 'portfolio_skill_custom_slug',
                        'type'      => 'text',
                        'default'   => 'portfolio-skill',
                        'title'     => esc_html_x('Portfolio Skill Slug', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('When you change the portfolio slug, please remember go to Setting -> Permalinks and click to Save Changes button once again', 'admin-view', 'zuka'),
                    )
                )
            ),
            array(
                'name'      => 'portfolio_general_section',
                'title'     => esc_html_x('General Setting', 'admin-view', 'zuka'),
                'icon'      => 'fa fa-check',
                'fields'    => array(
                    array(
                        'id'        => 'layout_archive_portfolio',
                        'type'      => 'image_select',
                        'title'     => esc_html_x('Archive Portfolio Layout', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('Controls the layout of archive portfolio page', 'admin-view', 'zuka'),
                        'default'   => 'col-1c',
                        'radio'     => true,
                        'options'   => Zuka_Options::get_config_main_layout_opts(true, false)
                    ),
                    array(
                        'id'        => 'main_full_width_archive_portfolio',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'inherit',
                        'title'     => esc_html_x('100% Main Width', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('[Portfolio] Turn on to have the main area display at 100% width according to the window size. Turn off to follow site width.', 'admin-view', 'zuka'),
                        'options'   => Zuka_Options::get_config_radio_opts()
                    ),
                    array(
                        'id'            => 'main_space_archive_portfolio',
                        'type'          => 'spacing',
                        'title'         => esc_html_x('Custom Main Space', 'admin-view', 'zuka'),
                        'desc'          => esc_html_x('[Portfolio]Leave empty if you not need', 'admin-view', 'zuka'),
                        'unit' 	        => 'px'
                    ),
                    array(
                        'id'        => 'portfolio_display_type',
                        'default'   => 'grid',
                        'title'     => esc_html_x('Display Type as', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('Controls the type display of portfolio for the archive page', 'admin-view', 'zuka'),
                        'type'      => 'select',
                        'options'   => array(
                            'grid'           => esc_html_x('Grid', 'admin-view', 'zuka'),
                            'masonry'        => esc_html_x('Masonry', 'admin-view', 'zuka')
                        )
                    ),
                    array(
                        'id'        => 'portfolio_thumbnail_height_mode',
                        'default'   => 'original',
                        'title'     => esc_html_x('Portfolio Image Height Mode', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('Sizing proportions for height and width. Select "Original" to scale image without cropping.', 'admin-view', 'zuka'),
                        'type'      => 'select',
                        'options'   => array(
                            '1-1'       => esc_html_x('1-1', 'admin-view', 'zuka'),
                            'original'  => esc_html_x('Original', 'admin-view', 'zuka'),
                            '4-3'       => esc_html_x('4:3', 'admin-view', 'zuka'),
                            '3-4'       => esc_html_x('3:4', 'admin-view', 'zuka'),
                            '16-9'      => esc_html_x('16:9', 'admin-view', 'zuka'),
                            '9-16'      => esc_html_x('9:16', 'admin-view', 'zuka'),
                            'custom'    => esc_html_x('Custom', 'admin-view', 'zuka')
                        )
                    ),

                    array(
                        'id'        => 'portfolio_thumbnail_height_custom',
                        'type'      => 'text',
                        'default'   => '70%',
                        'title'     => esc_html_x('Portfolio Image Height Custom', 'admin-view', 'zuka'),
                        'dependency'=> array('portfolio_thumbnail_height_mode', '==', 'custom'),
                        'desc'      => esc_html_x('Enter custom height.', 'admin-view', 'zuka')
                    ),
                    array(
                        'id'        => 'portfolio_item_space',
                        'default'   => '0',
                        'title'     => esc_html_x('Item Padding', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('Select gap between item in grids', 'admin-view', 'zuka'),
                        'type'      => 'select',
                        'options'   => array(
                            '0'         => esc_html_x('0px', 'admin-view', 'zuka'),
                            '5'          => esc_html_x('5px', 'admin-view', 'zuka'),
                            '10'         => esc_html_x('10px', 'admin-view', 'zuka'),
                            '15'         => esc_html_x('15px', 'admin-view', 'zuka'),
                            '20'         => esc_html_x('20px', 'admin-view', 'zuka'),
                            '25'         => esc_html_x('25px', 'admin-view', 'zuka'),
                            '30'         => esc_html_x('30px', 'admin-view', 'zuka'),
                            '35'         => esc_html_x('35px', 'admin-view', 'zuka'),
                            '40'         => esc_html_x('40px', 'admin-view', 'zuka'),
                            '45'         => esc_html_x('45px', 'admin-view', 'zuka'),
                            '50'         => esc_html_x('50px', 'admin-view', 'zuka'),
                            '55'         => esc_html_x('55px', 'admin-view', 'zuka'),
                            '60'         => esc_html_x('60px', 'admin-view', 'zuka'),
                            '65'         => esc_html_x('65px', 'admin-view', 'zuka'),
                            '70'         => esc_html_x('70px', 'admin-view', 'zuka'),
                            '75'         => esc_html_x('75px', 'admin-view', 'zuka'),
                            '80'         => esc_html_x('80px', 'admin-view', 'zuka'),
                        )
                    ),
                    array(
                        'id'        => 'portfolio_display_style',
                        'default'   => '1',
                        'title'     => esc_html_x('Select Style', 'admin-view', 'zuka'),
                        'type'      => 'select',
                        'options'   => array(
                            '1'           => esc_html_x('Style 01', 'admin-view', 'zuka'),
                            '2'           => esc_html_x('Style 02', 'admin-view', 'zuka'),
                            '3'           => esc_html_x('Style 03', 'admin-view', 'zuka'),
                            '4'           => esc_html_x('Style 04', 'admin-view', 'zuka'),
                            '5'           => esc_html_x('Style 05', 'admin-view', 'zuka'),
                            '6'           => esc_html_x('Style 06', 'admin-view', 'zuka'),
                            '7'           => esc_html_x('Style 07', 'admin-view', 'zuka'),
                            '8'           => esc_html_x('Style 08', 'admin-view', 'zuka')
                        )
                    ),
                    array(
                        'id'        => 'portfolio_column',
                        'type'      => 'column_responsive',
                        'title'     => esc_html_x('Portfolio Column', 'admin-view', 'zuka'),
                        'default'   => array(
                            'xlg' => 3,
                            'lg' => 3,
                            'md' => 2,
                            'sm' => 2,
                            'xs' => 1,
                            'mb' => 1
                        )
                    ),
                    array(
                        'id'        => 'portfolio_per_page',
                        'type'      => 'number',
                        'default'   => 10,
                        'attributes'=> array(
                            'min' => 1,
                            'max' => 100
                        ),
                        'title'     => esc_html_x('Total Portfolio will be display in a page', 'admin-view', 'zuka')
                    ),
                    array(
                        'id'        => 'portfolio_thumbnail_size',
                        'type'      => 'text',
                        'default'   => 'full',
                        'title'     => esc_html_x('Portfolio Thumbnail size', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'admin-view', 'zuka')
                    )
                )
            ),
            array(
                'name'      => 'single_portfolio_general_section',
                'title'     => esc_html_x('Portfolio Single', 'admin-view', 'zuka'),
                'icon'      => 'fa fa-check',
                'fields'    => array(
                    array(
                        'id'        => 'layout_single_portfolio',
                        'type'      => 'image_select',
                        'title'     => esc_html_x('Single Portfolio Layout', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('Controls the layout of portfolio detail page', 'admin-view', 'zuka'),
                        'default'   => 'col-1c',
                        'radio'     => true,
                        'options'   => Zuka_Options::get_config_main_layout_opts(true, false)
                    ),
                    array(
                        'id'        => 'single_portfolio_nextprev',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'on',
                        'title'     => esc_html_x('Show Next / Previous Portfolio', 'admin-view', 'zuka'),
                        'desc'      => esc_html_x('Turn on to display next/previous portfolio', 'admin-view', 'zuka'),
                        'options'   => Zuka_Options::get_config_radio_onoff(false)
                    )
                )
            )
        )
    );
    return $sections;
}