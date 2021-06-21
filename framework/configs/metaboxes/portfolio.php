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
function zuka_metaboxes_section_portfolio( $sections )
{
    $sections['portfolio'] = array(
        'name'      => 'portfolio',
        'title'     => esc_html_x('Portfolio', 'admin-view', 'zuka'),
        'icon'      => 'laicon-file',
        'fields'    => array(
            array(
                'id'        => 'short_description',
                'type'      => 'textarea',
                'title'     => esc_html_x('Short Description', 'admin-view', 'zuka')
            ),
            array(
                'id'        => 'portfolio_design',
                'type'      => 'select',
                'title'     => esc_html_x('Portfolio Single Design', 'admin-view', 'zuka'),
                'options'    => array(
                    'inherit' => esc_html_x('Inherit', 'admin-view', 'zuka'),
                    '1' => esc_html_x('Design 01', 'admin-view', 'zuka'),
                    '2' => esc_html_x('Design 02', 'admin-view', 'zuka'),
                    'use_vc' => esc_html_x('Show only post content', 'admin-view', 'zuka')
                )
            ),
            array(
                'id'        => 'gallery',
                'type'      => 'gallery',
                'title'     => esc_html_x('Gallery', 'admin-view', 'zuka')
            ),
            array(
                'id'        => 'client',
                'type'      => 'text',
                'title'     => esc_html_x('Client Name', 'admin-view', 'zuka')
            ),
            array(
                'id'        => 'timeline',
                'type'      => 'text',
                'title'     => esc_html_x('Timeline', 'admin-view', 'zuka')
            ),
            array(
                'id'        => 'location',
                'type'      => 'text',
                'title'     => esc_html_x('Location', 'admin-view', 'zuka')
            ),
            array(
                'id'        => 'website',
                'type'      => 'text',
                'title'     => esc_html_x('Website', 'admin-view', 'zuka')
            )
        )
    );
    return $sections;
}