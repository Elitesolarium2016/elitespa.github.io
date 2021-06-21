<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Require plugins vendor
 */

require_once get_template_directory() . '/plugins/tgm-plugin-activation/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/plugins/plugins.php';

/**
 * Include the main class.
 */

include_once get_template_directory() . '/framework/classes/class-core.php';


Zuka::$template_dir_path   = get_template_directory();
Zuka::$template_dir_url    = get_template_directory_uri();
Zuka::$stylesheet_dir_path = get_stylesheet_directory();
Zuka::$stylesheet_dir_url  = get_stylesheet_directory_uri();

/**
 * Include the autoloader.
 */
include_once Zuka::$template_dir_path . '/framework/classes/class-autoload.php';

new Zuka_Autoload();

/**
 * load functions for later usage
 */

require_once Zuka::$template_dir_path . '/framework/functions/functions.php';

new Zuka_Multilingual();

if(!function_exists('Zuka')){
    function Zuka(){
        return Zuka::get_instance();
    }
}

new Zuka_Scripts();

new Zuka_Admin();

new Zuka_WooCommerce();

new Zuka_WooCommerce_Wishlist();

new Zuka_WooCommerce_Compare();

new Zuka_Visual_Composer();

/**
 * Set the $content_width global.
 */
global $content_width;
if ( ! is_admin() ) {
    if ( ! isset( $content_width ) || empty( $content_width ) ) {
        $content_width = (int) Zuka()->layout()->get_content_width();
    }
}

require_once Zuka::$template_dir_path . '/framework/functions/extra-functions.php';

require_once Zuka::$template_dir_path . '/framework/functions/update.php';