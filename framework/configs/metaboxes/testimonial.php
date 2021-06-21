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
function zuka_metaboxes_section_testimonial( $sections )
{
    $sections['testimonial'] = array(
        'name'      => 'testimonial',
        'title'     => esc_html_x('Information', 'admin-view', 'zuka'),
        'icon'      => 'laicon-file',
        'fields'    => array(
            array(
                'id'    => 'role',
                'type'  => 'text',
                'title' => esc_html_x('Role', 'admin-view', 'zuka'),
            ),
            array(
                'id'    => 'content',
                'type'  => 'textarea',
                'title' => esc_html_x('Content', 'admin-view', 'zuka'),
            ),
            array(
                'id'    => 'avatar',
                'type'  => 'image',
                'title' => esc_html_x('Avatar', 'admin-view', 'zuka'),
            ),
            array(
                'id'        => 'rating',
                'type'      => 'slider',
                'default'    => 10,
                'title'     => esc_html_x( 'Rating', 'admin-view', 'zuka' ),
                'options'   => array(
                    'step'    => 1,
                    'min'     => 0,
                    'max'     => 10
                )
            )
        )
    );
    return $sections;
}