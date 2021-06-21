<?php if ( ! defined( 'ABSPATH' ) ) { die; }

add_filter('LaStudio_Builder/option_builder_name', 'zuka_set_option_builder_name');
if(!function_exists('zuka_set_option_builder_name')){
    function zuka_set_option_builder_name( $var = ''){
        return 'zuka';
    }
}

add_filter('LaStudio_Builder/option_builder_key', 'zuka_set_option_builder_key');
if(!function_exists('zuka_set_option_builder_key')){
    function zuka_set_option_builder_key( $var = ''){
        return 'labuider_for_zuka';
    }
}

add_filter('LaStudio/global_loop_variable', 'zuka_set_loop_variable');
if(!function_exists('zuka_set_loop_variable')){
    function zuka_set_loop_variable( $var = ''){
        return 'zuka_loop';
    }
}

add_filter('LaStudio/core/google_map_api', 'zuka_add_googlemap_api');
if(!function_exists('zuka_add_googlemap_api')){
    function zuka_add_googlemap_api( $key = '' ){
        return Zuka()->settings()->get('google_key', $key);
    }
}

add_filter('zuka/filter/page_title', 'zuka_override_page_title_bar_title', 10, 2);
if(!function_exists('zuka_override_page_title_bar_title')){
    function zuka_override_page_title_bar_title( $title, $args ){

        $context = (array) Zuka()->get_current_context();

        if(in_array('is_singular', $context)){
            $custom_title = Zuka()->settings()->get_post_meta( get_queried_object_id(), 'page_title_custom');
            if(!empty( $custom_title) ){
                return sprintf($args['page_title_format'], $custom_title);
            }
        }

        if(in_array('is_tax', $context) || in_array('is_category', $context) || in_array('is_tag', $context)){
            $custom_title = Zuka()->settings()->get_term_meta( get_queried_object_id(), 'page_title_custom');
            if(!empty( $custom_title) ){
                return sprintf($args['page_title_format'], $custom_title);
            }
        }

        if(in_array('is_shop', $context) && function_exists('wc_get_page_id') && ($shop_page_id = wc_get_page_id('shop')) && $shop_page_id){
            $custom_title = Zuka()->settings()->get_post_meta( $shop_page_id, 'page_title_custom');
            if(!empty( $custom_title) ){
                return sprintf($args['page_title_format'], $custom_title);
            }
        }

        return $title;
    }
}

add_action( 'pre_get_posts', 'zuka_set_posts_per_page_for_portfolio_cpt' );
if(!function_exists('zuka_set_posts_per_page_for_portfolio_cpt')){
    function zuka_set_posts_per_page_for_portfolio_cpt( $query ) {
        if ( !is_admin() && $query->is_main_query() ) {
            if( post_type_exists('la_portfolio') && ( is_post_type_archive( 'la_portfolio' ) || is_tax(get_object_taxonomies( 'la_portfolio' )) ) ){
                $pf_per_page = (int) Zuka()->settings()->get('portfolio_per_page', 9);
                $query->set( 'posts_per_page', $pf_per_page );
            }
        }
    }
}

add_filter('yith_wc_social_login_icon', 'zuka_override_yith_wc_social_login_icon', 10, 3);
if(!function_exists('zuka_override_yith_wc_social_login_icon')){
    function zuka_override_yith_wc_social_login_icon($social, $key, $args){
        if(!is_admin()){
            $social = sprintf(
                '<a class="%s" href="%s">%s</a>',
                'social_login ywsl-' . esc_attr($key) . ' social_login-' . esc_attr($key),
                $args['url'],
                isset( $args['value']['label'] ) ? $args['value']['label'] : $args['value']
            );
        }
        return $social;
    }
}

add_action('wp', 'zuka_hook_maintenance');
if(!function_exists('zuka_hook_maintenance')){
    function zuka_hook_maintenance(){
        wp_reset_postdata();
        $enable_private = Zuka()->settings()->get('enable_maintenance', 'no');
        if($enable_private == 'yes'){
            if(!is_user_logged_in()){
                $page_id = Zuka()->settings()->get('maintenance_page');
                if(empty($page_id)){
                    wp_redirect(wp_login_url());
                    exit;
                }
                else{
                    $page_id = absint($page_id);
                    if(!is_page($page_id)){
                        wp_redirect(get_permalink($page_id));
                        exit;
                    }
                }
            }
        }
    }
}

add_filter('widget_archives_args', 'zuka_modify_widget_archives_args');
if(!function_exists('zuka_modify_widget_archives_args')){
    function zuka_modify_widget_archives_args( $args ){
        if(isset($args['show_post_count'])){
            unset($args['show_post_count']);
        }
        return $args;
    }
}
if(isset($_GET['la_doing_ajax'])){
    remove_action('template_redirect', 'redirect_canonical');
}
add_filter('woocommerce_redirect_single_search_result', '__return_false');


add_filter('zuka/filter/breadcrumbs/items', 'zuka_theme_setup_breadcrumbs_for_dokan', 10, 2);
if(!function_exists('zuka_theme_setup_breadcrumbs_for_dokan')){
    function zuka_theme_setup_breadcrumbs_for_dokan( $items, $args ){
        if (  function_exists('dokan_is_store_page') && dokan_is_store_page() ) {
            $store_user   = dokan()->vendor->get( get_query_var( 'author' ) );
            if( count($items) > 1 ){
                unset($items[(count($items) - 1)]);
            }
            $items[] = sprintf(
                '<div class="la-breadcrumb-item"><span class="%2$s">%1$s</span></div>',
                esc_attr($store_user->get_shop_name()),
                'la-breadcrumb-item-link'
            );
        }

        return $items;
    }
}


add_filter('zuka/filter/show_page_title', 'zuka_filter_show_page_title', 10, 1 );
add_filter('zuka/filter/show_breadcrumbs', 'zuka_filter_show_breadcrumbs', 10, 1 );

if(!function_exists('zuka_filter_show_page_title')){
    function zuka_filter_show_page_title( $show ){
        $context = Zuka()->get_current_context();
        if( in_array( 'is_product', $context ) && Zuka()->settings()->get('product_single_hide_page_title', 'no') == 'yes' ){
            return false;
        }
        return $show;
    }
}

if(!function_exists('zuka_filter_show_breadcrumbs')){
    function zuka_filter_show_breadcrumbs( $show ){
        $context = Zuka()->get_current_context();
        if( in_array( 'is_product', $context ) && Zuka()->settings()->get('product_single_hide_breadcrumb', 'no') == 'yes'){
            return false;
        }
        return $show;
    }
}


add_filter('LaStudio/swatches/args/show_option_none', 'zuka_allow_translate_woo_text_in_swatches', 10, 1);
if(!function_exists('zuka_allow_translate_woo_text_in_swatches')){
    function zuka_allow_translate_woo_text_in_swatches( $text ){
        return esc_html_x( 'Choose an option', 'front-view', 'zuka' );
    }
}

add_filter('LaStudio/swatches/get_attribute_thumbnail_src', 'zuka_allow_resize_image_url_in_swatches', 10, 4);

if(!function_exists('zuka_allow_resize_image_url_in_swatches')){
    function zuka_allow_resize_image_url_in_swatches( $image_url, $image_id, $size_name, $instance ) {
        if($size_name == 'la_swatches_image_size'){
            $width = $instance->get_width();
            $height = $instance->get_height();
            $image_url = Zuka()->images()->get_attachment_image_url($image_id, array( $width, $height ));
            return $image_url;
        }
        return $image_url;
    }
}

add_filter('LaStudio/swatches/get_product_variation_image_url_by_attribute', 'zuka_allow_resize_variation_image_url_by_attribute_in_swatches', 10, 2);
if(!function_exists('zuka_allow_resize_variation_image_url_by_attribute_in_swatches')){
    function zuka_allow_resize_variation_image_url_by_attribute_in_swatches( $image_url, $image_id ) {
        global $precise_loop;
        if(isset($precise_loop['image_size'])){
            return Zuka()->images()->get_attachment_image_url($image_id, $precise_loop['image_size'] );
        }
        return $image_url;
    }
}

if(!function_exists('zuka_get_relative_url')){
    function zuka_get_relative_url( $url ) {
        return zuka_is_external_resource( $url ) ? $url : str_replace( array( 'http://', 'https://' ), '//', $url );
    }
}
if(!function_exists('zuka_is_external_resource')){
    function zuka_is_external_resource( $url ) {
        $wp_base = str_replace( array( 'http://', 'https://' ), '//', get_home_url( null, '/', 'http' ) );
        return strstr( $url, '://' ) && strstr( $wp_base, $url );
    }
}

if (!function_exists('zuka_wpml_object_id')) {
    function zuka_wpml_object_id( $element_id, $element_type = 'post', $return_original_if_missing = false, $ulanguage_code = null ) {
        if ( function_exists( 'wpml_object_id_filter' ) ) {
            return wpml_object_id_filter( $element_id, $element_type, $return_original_if_missing, $ulanguage_code );
        } elseif ( function_exists( 'icl_object_id' ) ) {
            return icl_object_id( $element_id, $element_type, $return_original_if_missing, $ulanguage_code );
        } else {
            return $element_id;
        }
    }
}

/**
 * Override page title bar from global settings
 * What we need to do now is
 * 1. checking in single content types
 *  1.1) post
 *  1.2) product
 *  1.3) portfolio
 * 2. checking in archives
 *  2.1) shop
 *  2.2) portfolio
 *
 * TIPS: List functions will be use to check
 * `is_product`, `is_single_la_portfolio`, `is_shop`, `is_woocommerce`, `is_product_taxonomy`, `is_archive_la_portfolio`, `is_tax_la_portfolio`
 */

if(!function_exists('zuka_override_page_title_bar_from_context')){
    function zuka_override_page_title_bar_from_context( $value, $key, $context ){

        $array_key_allow = array(
            'page_title_bar_style',
            'page_title_bar_layout',
            'page_title_font_size',
            'page_title_bar_background',
            'page_title_bar_heading_color',
            'page_title_bar_text_color',
            'page_title_bar_link_color',
            'page_title_bar_link_hover_color',
            'page_title_bar_spacing',
            'page_title_bar_spacing_desktop_small',
            'page_title_bar_spacing_tablet',
            'page_title_bar_spacing_mobile'
        );

        $array_key_alternative = array(
            'page_title_font_size',
            'page_title_bar_background',
            'page_title_bar_heading_color',
            'page_title_bar_text_color',
            'page_title_bar_link_color',
            'page_title_bar_link_hover_color',
            'page_title_bar_spacing',
            'page_title_bar_spacing_desktop_small',
            'page_title_bar_spacing_tablet',
            'page_title_bar_spacing_mobile'
        );

        /**
         * Firstly, we need to check the `$key` input
         */
        if( !in_array($key, $array_key_allow) ){
            return $value;
        }

        /**
         * Secondary, we need to check the `$context` input
         */
        if( !in_array('is_singular', $context) && !in_array('is_woocommerce', $context) && !in_array('is_archive_la_portfolio', $context) && !in_array('is_tax_la_portfolio', $context)){
            return $value;
        }

        if( !is_singular(array('product', 'post', 'la_portfolio')) && !in_array('is_product_taxonomy', $context) && !in_array('is_shop', $context) ) {
            return $value;
        }


        $func_name = 'get_post_meta';
        $queried_object_id = get_queried_object_id();

        if( in_array('is_product_taxonomy', $context) || in_array('is_tax_la_portfolio', $context) ){
            $func_name = 'get_term_meta';
        }

        if(in_array('is_shop', $context)){
            $queried_object_id = Zuka_WooCommerce::$shop_page_id;
        }

        if ( 'page_title_bar_layout' == $key ) {
            $page_title_bar_layout = Zuka()->settings()->$func_name($queried_object_id, $key);
            if($page_title_bar_layout && $page_title_bar_layout != 'inherit'){
                return $page_title_bar_layout;
            }
        }

        if( 'yes' == Zuka()->settings()->$func_name($queried_object_id, 'page_title_bar_style') && in_array($key, $array_key_alternative) ){
            return $value;
        }

        $key_override = $new_key = false;

        if( in_array('is_product', $context) ){
            $key_override = 'single_product_override_page_title_bar';
            $new_key = 'single_product_' . $key;
        }
        elseif( in_array('is_single_la_portfolio', $context) ) {
            $key_override = 'single_portfolio_override_page_title_bar';
            $new_key = 'single_portfolio_' . $key;
        }
        elseif( is_singular('post') ) {
            $key_override = 'single_post_override_page_title_bar';
            $new_key = 'single_post_' . $key;
        }
        elseif( in_array('is_single_la_portfolio', $context) ) {
            $key_override = 'single_portfolio_override_page_title_bar';
            $new_key = 'single_portfolio_' . $key;
        }
        elseif ( in_array('is_shop', $context) || in_array('is_product_taxonomy', $context) ) {
            $key_override = 'woo_override_page_title_bar';
            $new_key = 'woo_' . $key;
        }
        elseif ( in_array('is_archive_la_portfolio', $context) || in_array('is_tax_la_portfolio', $context) ) {
            $key_override = 'archive_portfolio_override_page_title_bar';
            $new_key = 'archive_portfolio_' . $key;
        }

        if(false != $key_override){
            if( 'on' == Zuka()->settings()->get($key_override, 'off') ){
                return Zuka()->settings()->get($new_key, $value);
            }
        }

        return $value;
    }

    add_filter('zuka/setting/get_setting_by_context', 'zuka_override_page_title_bar_from_context', 10, 3);
}

/**
 * This function allow get property of `woocommerce_loop` inside the loop
 * @since 1.0.0
 * @param string $prop Prop to get.
 * @param string $default Default if the prop does not exist.
 * @return mixed
 */

if(!function_exists('zuka_get_wc_loop_prop')){
    function zuka_get_wc_loop_prop( $prop, $default = ''){
        return isset( $GLOBALS['woocommerce_loop'], $GLOBALS['woocommerce_loop'][ $prop ] ) ? $GLOBALS['woocommerce_loop'][ $prop ] : $default;
    }
}

/**
 * This function allow set property of `woocommerce_loop`
 * @since 1.0.0
 * @param string $prop Prop to set.
 * @param string $value Value to set.
 */

if(!function_exists('zuka_set_wc_loop_prop')){
    function zuka_set_wc_loop_prop( $prop, $value = ''){
        if(isset($GLOBALS['woocommerce_loop'])){
            $GLOBALS['woocommerce_loop'][ $prop ] = $value;
        }
    }
}

/**
 * This function allow get property of `zuka_loop` inside the loop
 * @since 1.0.0
 * @param string $prop Prop to get.
 * @param string $default Default if the prop does not exist.
 * @return mixed
 */

if(!function_exists('zuka_get_theme_loop_prop')){
    function zuka_get_theme_loop_prop( $prop, $default = ''){
        return isset( $GLOBALS['zuka_loop'], $GLOBALS['zuka_loop'][ $prop ] ) ? $GLOBALS['zuka_loop'][ $prop ] : $default;
    }
}

if(!function_exists('zuka_set_theme_loop_prop')){
    function zuka_set_theme_loop_prop( $prop, $value = '', $force = false){
        if($force && !isset($GLOBALS['zuka_loop'])){
            $GLOBALS['zuka_loop'] = array();
        }
        if(isset($GLOBALS['zuka_loop'])){
            $GLOBALS['zuka_loop'][ $prop ] = $value;
        }
    }
}

if(!function_exists('zuka_convert_legacy_responsive_column')){
    function zuka_convert_legacy_responsive_column( $columns = array() ) {
        $legacy = array(
            'xlg'	=> '',
            'lg' 	=> '',
            'md' 	=> '',
            'sm' 	=> '',
            'xs' 	=> '',
            'mb' 	=> 1
        );
        $new_key = array(
            'mb'    =>  'xs',
            'xs'    =>  'sm',
            'sm'    =>  'md',
            'md'    =>  'lg',
            'lg'    =>  'xl',
            'xlg'   =>  'xxl'
        );
        if(empty($columns)){
            $columns = $legacy;
        }
        $new_columns = array();
        foreach($columns as $k => $v){
            if(isset($new_key[$k])){
                $new_columns[$new_key[$k]] = $v;
            }
        }
        if(empty($new_columns['xs'])){
            $new_columns['xs'] = 1;
        }
        return $new_columns;
    }
}

if(!function_exists('zuka_render_grid_css_class_from_columns')){
    function zuka_render_grid_css_class_from_columns( $columns, $merge = true ) {
        if($merge){
            $columns = zuka_convert_legacy_responsive_column( $columns );
        }
        $classes = array();
        foreach($columns as $k => $v){
            if(empty($v)){
                continue;
            }
            if($k == 'xs'){
                $classes[] = 'block-grid-' . $v;
            }
            else{
                $classes[] = $k . '-block-grid-' . $v;
            }
        }
        return join(' ', $classes);
    }
}

if(!function_exists('zuka_add_ajax_cart_btn_into_single_product')){
    function zuka_add_ajax_cart_btn_into_single_product(){
        global $product;
        if($product->is_type('simple')){
            echo '<input type="hidden" name="add-to-cart" value="'.$product->get_id().'"/>';
        }
    }
    add_action('woocommerce_after_add_to_cart_button', 'zuka_add_ajax_cart_btn_into_single_product');
}

if(!function_exists('zuka_get_the_excerpt')){
    function zuka_get_the_excerpt($length = null){
        ob_start();

        $length = absint($length);

        if(!empty($length)){
            zuka_deactive_filter('get_the_excerpt', 'wp_trim_excerpt');
            add_filter('excerpt_length', function() use ($length) {
                return $length;
            }, 1012);
        }

        the_excerpt();

        if(!empty($length)) {
            remove_all_filters('excerpt_length', 1012);
        }
        $output = ob_get_clean();

        $output = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $output);

        $output = strip_tags( $output );

        if(!empty($output)){
            $output = sprintf('<p>%s</p>', $output);
        }

        return $output;
    }
}


if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
    function woocommerce_template_loop_product_title() {
        the_title( sprintf( '<h3 class="product_item--title"><a href="%s">', esc_url( get_the_permalink() ) ), '</a></h3>' );
    }
}

if( !function_exists('zuka_allow_shortcode_text_in_component_text') ) {
    function zuka_allow_shortcode_text_in_component_text( $text ){
        return do_shortcode($text);
    }
    add_filter('zuka/filter/component/text', 'zuka_allow_shortcode_text_in_component_text');
}

if(!function_exists('zuka_override_woothumbnail_size_name')){
    function zuka_override_woothumbnail_size_name( ) {
        return 'shop_thumbnail';
    }
    add_filter('woocommerce_gallery_thumbnail_size', 'zuka_override_woothumbnail_size_name', 0);
}

if(!function_exists('zuka_override_woothumbnail_size')){
    function zuka_override_woothumbnail_size( $size ) {
        if(!function_exists('wc_get_theme_support')){
            return $size;
        }
        $size['width'] = absint( wc_get_theme_support( 'gallery_thumbnail_image_width', 180 ) );
        $cropping      = get_option( 'woocommerce_thumbnail_cropping', '1:1' );

        if ( 'uncropped' === $cropping ) {
            $size['height'] = 0;
            $size['crop']   = 0;
        }
        elseif ( 'custom' === $cropping ) {
            $width          = max( 1, get_option( 'woocommerce_thumbnail_cropping_custom_width', '4' ) );
            $height         = max( 1, get_option( 'woocommerce_thumbnail_cropping_custom_height', '3' ) );
            $size['height'] = absint( round( ( $size['width'] / $width ) * $height ) );
            $size['crop']   = 1;
        }
        else {
            $cropping_split = explode( ':', $cropping );
            $width          = max( 1, current( $cropping_split ) );
            $height         = max( 1, end( $cropping_split ) );
            $size['height'] = absint( round( ( $size['width'] / $width ) * $height ) );
            $size['crop']   = 1;
        }

        return $size;
    }
    add_filter('woocommerce_get_image_size_gallery_thumbnail', 'zuka_override_woothumbnail_size');
}

if(!function_exists('zuka_override_woothumbnail_single')){
    function zuka_override_woothumbnail_single( $size ) {
        if(!function_exists('wc_get_theme_support')){
            return $size;
        }
        $size['width'] = absint( wc_get_theme_support( 'single_image_width', get_option( 'woocommerce_single_image_width', 600 ) ) );
        $cropping      = get_option( 'woocommerce_thumbnail_cropping', '1:1' );

        if ( 'uncropped' === $cropping ) {
            $size['height'] = 0;
            $size['crop']   = 0;
        }
        elseif ( 'custom' === $cropping ) {
            $width          = max( 1, get_option( 'woocommerce_thumbnail_cropping_custom_width', '4' ) );
            $height         = max( 1, get_option( 'woocommerce_thumbnail_cropping_custom_height', '3' ) );
            $size['height'] = absint( round( ( $size['width'] / $width ) * $height ) );
            $size['crop']   = 1;
        }
        else {
            $cropping_split = explode( ':', $cropping );
            $width          = max( 1, current( $cropping_split ) );
            $height         = max( 1, end( $cropping_split ) );
            $size['height'] = absint( round( ( $size['width'] / $width ) * $height ) );
            $size['crop']   = 1;
        }

        return $size;
    }
    add_filter('woocommerce_get_image_size_single', 'zuka_override_woothumbnail_single', 0);
}


if(!function_exists('zuka_override_filter_woocommerce_format_content')){
    function zuka_override_filter_woocommerce_format_content( $format, $raw_string ){
        $format = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $raw_string);
        return apply_filters( 'woocommerce_short_description', $format );
    }
}

add_action('woocommerce_checkout_terms_and_conditions', 'zuka_override_wc_format_content_in_terms', 1);
add_action('woocommerce_checkout_terms_and_conditions', 'zuka_remove_override_wc_format_content_in_terms', 999);
if(!function_exists('zuka_override_wc_format_content_in_terms')){
    function zuka_override_wc_format_content_in_terms(){
        add_filter('woocommerce_format_content', 'zuka_override_filter_woocommerce_format_content', 99, 2);
    }
}
if(!function_exists('zuka_remove_override_wc_format_content_in_terms')){
    function zuka_remove_override_wc_format_content_in_terms(){
        zuka_deactive_filter('woocommerce_format_content', 'zuka_override_filter_woocommerce_format_content', 99);
    }
}


if(!function_exists('zuka_wc_product_loop')){
    function zuka_wc_product_loop(){
        if(!function_exists('WC')){
            return false;
        }
        return have_posts() || 'products' !== woocommerce_get_loop_display_mode();
    }
}