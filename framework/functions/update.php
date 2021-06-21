<?php

add_filter( 'LAHFB/get_dynamic_styles', 'zuka_override_builder_dynamic_style' );
function zuka_override_builder_dynamic_style( $styles ){
    if(!isset($_GET['lastudio_header_builder'])){
        $header_layout = Zuka()->layout()->get_header_layout();
        if(!empty($header_layout) && $header_layout != 'inherit' && LAHFB_Helper::is_prebuild_header_exists($header_layout)){
            $styles = LAHFB_Helper::get_dynamic_styles($header_layout);
        }
    }
    return $styles;
}

if(!function_exists('zuka_override_yikes_mailchimp_page_data')){
    function zuka_override_yikes_mailchimp_page_data($page_data, $form_id){
        $new_data = new stdClass();
        if(isset($page_data->ID)){
            $new_data->ID = $page_data->ID;
        }
        return $new_data;
    }
    add_filter('yikes-mailchimp-page-data', 'zuka_override_yikes_mailchimp_page_data', 10, 2);
}

if(!function_exists('zuka_override_theme_default')){
    function zuka_override_theme_default(){
        $header_layout = Zuka()->layout()->get_header_layout();
        $title_layout = Zuka()->layout()->get_page_title_bar_layout();
        if($header_layout == 'default' && (empty($title_layout) || $title_layout == 'hide') && !is_404()) :
            ?>
            <div class="page-title-section">
                <?php
                echo Zuka()->breadcrumbs()->get_title();
                do_action('zuka/action/breadcrumbs/render_html');
                ?>
            </div>
            <?php
        endif;
    }
    add_action('zuka/action/before_render_main_inner', 'zuka_override_theme_default');
}

if(!function_exists('zuka_override_dokan_main_query')){
    function zuka_override_dokan_main_query( $query ) {
        if(function_exists('dokan_is_store_page') && dokan_is_store_page() && isset($query->query['term_section'])){
            $query->set('posts_per_page', 0);
            WC()->query->product_query( $query );
        }
    }
    add_action('pre_get_posts', 'zuka_override_dokan_main_query', 11);
}


if(!function_exists('zuka_dokan_dashboard_wrap_before')){
    function zuka_dokan_dashboard_wrap_before(){
        echo '<div id="main" class="site-main"><div class="container"><div class="row"><main id="site-content" class="col-md-12 col-xs-12 site-content">';
    }
    add_filter('dokan_dashboard_wrap_before', 'zuka_dokan_dashboard_wrap_before');
}

if(!function_exists('zuka_dokan_dashboard_wrap_after')){
    function zuka_dokan_dashboard_wrap_after(){
        echo '</main></div></div></div>';
    }
    add_filter('dokan_dashboard_wrap_after', 'zuka_dokan_dashboard_wrap_after');
}


/**
 * @desc: adding the custom badges to product
 * @since: 1.0.3
 */

if(!function_exists('zuka_add_custom_badge_for_product')){
    function zuka_add_custom_badge_for_product(){
        global $product;
        $product_badges = Zuka()->settings()->get_post_meta( $product->get_id(), 'product_badges' );
        if(empty($product_badges)){
            return;
        }
        $_tmp_badges = array();
        foreach($product_badges as $badge){
            if(!empty($badge['text'])){
                $_tmp_badges[] = $badge;
            }
        }
        if(empty($_tmp_badges)){
            return;
        }
        foreach($_tmp_badges as $i => $badge){
            $attribute = array();
            if(!empty($badge['bg'])){
                $attribute[] = 'background-color:' . esc_attr($badge['bg']);
            }
            if(!empty($badge['color'])){
                $attribute[] = 'color:' . esc_attr($badge['color']);
            }
            $el_class = ($i%2==0) ? 'odd' : 'even';
            if(!empty($badge['el_class'])){
                $el_class .= ' ';
                $el_class .= $badge['el_class'];
            }

            echo sprintf(
                '<span class="la-custom-badge %1$s" style="%3$s"><span>%2$s</span></span>',
                esc_attr($el_class),
                esc_html($badge['text']),
                (!empty($attribute) ? esc_attr(implode(';', $attribute)) : '')
            );
        }
    }
    add_action( 'woocommerce_before_shop_loop_item_title', 'zuka_add_custom_badge_for_product', 9 );
    add_action( 'woocommerce_before_single_product_summary', 'zuka_add_custom_badge_for_product', 9 );
}

/**
 * @desc: kick-off the function when theme has new version
 * @since: 1.0.0
 */
if(!function_exists('zuka_hook_update_the_theme')){
    function zuka_hook_update_the_theme(){
        $current_version = get_option('zuka_opts_db_version', false);
        if( class_exists('LaStudio_Cache_Helper') && version_compare( '1.0.0', $current_version) > 0 ) {
            LaStudio_Cache_Helper::get_transient_version('icon_library', true);
            $current_version = '1.0.0';
            update_option('zuka_opts_db_version', $current_version);
        }
    }
    add_action( 'after_setup_theme', 'zuka_hook_update_the_theme', 0 );
}

/*
 * @desc: custom block after add-to-cart on single product page
 * @since: 1.0.0
 */
if(!function_exists('zuka_custom_block_after_add_cart_form_on_single_product')){
    function zuka_custom_block_after_add_cart_form_on_single_product(){
        if(is_active_sidebar('s-p-after-add-cart')){
            echo '<div class="extradiv-after-frm-cart">';
            dynamic_sidebar('s-p-after-add-cart');
            echo '</div>';
            echo '<div class="clearfix"></div>';
        }
    }
    add_action('woocommerce_single_product_summary', 'zuka_custom_block_after_add_cart_form_on_single_product', 51);
}

if(!function_exists('zuka_override_portfolio_content_type_args')){
    function zuka_override_portfolio_content_type_args( $args, $post_type_name ) {
        if($post_type_name == 'la_portfolio'){
            $label = esc_html(Zuka()->settings()->get('portfolio_custom_name'));
            $label2 = esc_html(Zuka()->settings()->get('portfolio_custom_name2'));
            $slug = sanitize_title(Zuka()->settings()->get('portfolio_custom_slug'));
            if(!empty($label)){
                $args['label'] = $label;
                $args['labels']['name'] = $label;
            }
            if(!empty($label2)){
                $args['labels']['singular_name'] = $label2;
            }
            if(!empty($slug)){
                if(!empty($args['rewrite'])){
                    $args['rewrite']['slug'] = $slug;
                }
                else{
                    $args['rewrite'] = array( 'slug' => $slug );
                }
            }
        }

        return $args;
    }
    add_filter('register_post_type_args', 'zuka_override_portfolio_content_type_args', 99, 2);
}

if(!function_exists('zuka_override_portfolio_tax_type_args')){
    function zuka_override_portfolio_tax_type_args( $args, $tax_name ) {

        if( $tax_name == 'la_portfolio_category' ) {
            $label = esc_html(Zuka()->settings()->get('portfolio_cat_custom_name'));
            $label2 = esc_html(Zuka()->settings()->get('portfolio_cat_custom_name2'));
            $slug = sanitize_title(Zuka()->settings()->get('portfolio_cat_custom_slug'));
            if(!empty($label)){
                $args['labels']['name'] = $label;
            }
            if(!empty($label2)){
                $args['labels']['singular_name'] = $label2;
            }
            if(!empty($slug)){
                if(!empty($args['rewrite'])){
                    $args['rewrite']['slug'] = $slug;
                }
                else{
                    $args['rewrite'] = array( 'slug' => $slug );
                }
            }
        }
        else if( $tax_name == 'la_portfolio_skill' ) {
            $label = esc_html(Zuka()->settings()->get('portfolio_skill_custom_name'));
            $label2 = esc_html(Zuka()->settings()->get('portfolio_skill_custom_name2'));
            $slug = sanitize_title(Zuka()->settings()->get('portfolio_skill_custom_slug'));
            if(!empty($label)){
                $args['labels']['name'] = $label;
            }
            if(!empty($label2)){
                $args['labels']['singular_name'] = $label2;
            }
            if(!empty($slug)){
                if(!empty($args['rewrite'])){
                    $args['rewrite']['slug'] = $slug;
                }
                else{
                    $args['rewrite'] = array( 'slug' => $slug );
                }
            }
        }

        return $args;
    }
    add_filter('register_taxonomy_args', 'zuka_override_portfolio_tax_type_args', 99, 2);
}



/*
 * @desc: Ensure that a specific theme is never updated. This works by removing the theme from the list of available updates.
 * @since: 1.0.1
 */

add_filter('http_request_args', 'zuka_hidden_theme_update_from_repository', 10, 2);
if(!function_exists('zuka_hidden_theme_update_from_repository')){
    function zuka_hidden_theme_update_from_repository( $response, $url ){
        $pos = strpos($url, '//api.wordpress.org/themes/update-check');
        if($pos === 5 || $pos === 6){
            $themes = json_decode( $response['body']['themes'], true );
            if(isset($themes['themes']['zuka'])){
                unset($themes['themes']['zuka']);
            }
            if(isset($themes['themes']['zuka-child'])){
                unset($themes['themes']['zuka-child']);
            }
            $response['body']['themes'] = json_encode( $themes );
        }
        return $response;
    }
}


if(!function_exists('zuka_wc_add_qty_control_plus')){
    function zuka_wc_add_qty_control_plus(){
        echo '<span class="qty-plus">+</span>';
    }
}

if(!function_exists('zuka_wc_add_qty_control_minus')){
    function zuka_wc_add_qty_control_minus(){
        echo '<span class="qty-minus">-</span>';
    }
}

add_action('woocommerce_after_quantity_input_field', 'zuka_wc_add_qty_control_plus');
add_action('woocommerce_before_quantity_input_field', 'zuka_wc_add_qty_control_minus');

add_action( 'wp_ajax_lastudio_ig_feed', 'zuka_ajax_get_ig_feed' );
add_action( 'wp_ajax_nopriv_lastudio_ig_feed', 'zuka_ajax_get_ig_feed' );

if(!function_exists('zuka_ajax_get_ig_feed')){
    function zuka_ajax_get_ig_feed(){
        // check token first;
        $token = Zuka()->settings()->get('instagram_token', '');
        if(empty($token)){
            wp_send_json_error(['msg' => __('Invalid Token', 'zuka')]);
        }
        $life_time = get_transient('lastudio_ig_token');
        if(empty($life_time)){
            $ig_refresh_token_url = add_query_arg([
                'grant_type' => 'ig_refresh_token',
                'access_token' => $token
            ], 'https://graph.instagram.com/refresh_access_token');
            $response = wp_remote_get($ig_refresh_token_url);
            // request failed
            if ( is_wp_error( $response ) ) {
                wp_send_json_error(['msg' => __('Invalid Token [1]', 'zuka')]);
            }
            $code = (int) wp_remote_retrieve_response_code( $response );
            if ( $code !== 200 ) {
                wp_send_json_error(['msg' => __('Invalid Token [2]', 'zuka')]);
            }
            $body = wp_remote_retrieve_body($response);
            $body = json_decode($body, true);
            $expires_in = (int) $body['expires_in'] - DAY_IN_SECONDS;
            if($expires_in > 0){
                $token = $body['access_token'];
                $all_option = get_option(Zuka::get_option_name(), []);
                $all_option['instagram_token'] = $token;
                update_option(Zuka::get_option_name(), $all_option);
                set_transient('lastudio_ig_token', $body , $expires_in);
            }
            else{
                wp_send_json_error(['msg' => __('Token Expired [3]', 'zuka')]);
            }
        }

        $cache = get_transient('lastudio_ig_feed');
        if(empty($cache)){
            $ig_feed_url = add_query_arg([
                'fields'        => 'caption,media_type,media_url,thumbnail_url,permalink,timestamp',
                'access_token'  => $token,
                'limit'         => 20
            ], 'https://graph.instagram.com/me/media');

            $response = wp_remote_get($ig_feed_url);
            if ( is_wp_error( $response ) ) {
                wp_send_json_error(['msg' => __('Invalid Token [4]', 'zuka')]);
            }
            $code = (int) wp_remote_retrieve_response_code( $response );
            if ( $code !== 200 ) {
                wp_send_json_error(['msg' => __('Invalid Token [5]', 'zuka')]);
            }
            $data = wp_remote_retrieve_body($response);
            $data = json_decode($data, true);
            $cache = $data['data'];
            set_transient('lastudio_ig_feed', $cache, HOUR_IN_SECONDS * 12);
        }
        if(empty($cache)){
            wp_send_json_error(['msg' => __('Invalid Token [6]', 'zuka')]);
        }
        else{
            wp_send_json_success($cache);
        }
    }
}