<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'tgmpa_register', 'zuka_register_required_plugins' );

if(!function_exists('lasf_get_plugin_source')){
    function lasf_get_plugin_source( $new, $initial, $plugin_name, $type = 'source'){
        if(isset($new[$plugin_name], $new[$plugin_name][$type]) && version_compare($initial[$plugin_name]['version'], $new[$plugin_name]['version']) < 0 ){
            return $new[$plugin_name][$type];
        }
        else{
            return $initial[$plugin_name][$type];
        }
    }
}

if(!function_exists('zuka_register_required_plugins')){

	function zuka_register_required_plugins() {

        $initial_required = array(
            'lastudio' => array(
                'source'    => 'https://la-studioweb.com/file-resouces/zuka/plugins/lastudio/1.1.2/lastudio.zip',
                'version'   => '1.1.2'
            ),
            'lastudio-header-footer-builders' => array(
                'source'    => 'https://la-studioweb.com/file-resouces/zuka/plugins/lastudio-header-footer-builders/1.0.5/lastudio-header-footer-builders.zip',
                'version'   => '1.0.5'
            ),
            'zuka-demo-data' => array(
                'source'    => 'https://la-studioweb.com/file-resouces/zuka/plugins/zuka-demo-data/1.0.0/zuka-demo-data.zip',
                'version'   => '1.0.0'
            ),
            'revslider' => array(
                'source'    => 'https://la-studioweb.com/file-resouces/shared/plugins/revslider_v6.4.11.zip',
                'version'   => '6.4.11'
            ),
            'js_composer' => array(
                'source'    => 'https://la-studioweb.com/file-resouces/shared/plugins/js_composer_v6.6.0.zip',
                'version'   => '6.6.0'
            )
        );

        $from_option = get_option('zuka_required_plugins_list', $initial_required);

		$plugins = array();

		$plugins[] = array(
			'name'					=> esc_html_x('WPBakery Visual Composer', 'admin-view', 'zuka'),
			'slug'					=> 'js_composer',
            'source'				=> lasf_get_plugin_source($from_option, $initial_required, 'js_composer'),
            'required'				=> true,
            'version'				=> lasf_get_plugin_source($from_option, $initial_required, 'js_composer', 'version')
		);

		$plugins[] = array(
			'name'					=> esc_html_x('LA-Studio Core', 'admin-view', 'zuka'),
			'slug'					=> 'lastudio',
            'source'				=> lasf_get_plugin_source($from_option, $initial_required, 'lastudio'),
            'required'				=> true,
            'version'				=> lasf_get_plugin_source($from_option, $initial_required, 'lastudio', 'version')
		);

		$plugins[] = array(
			'name'					=> esc_html_x('LA-Studio Header Builder', 'admin-view', 'zuka'),
			'slug'					=> 'lastudio-header-footer-builders',
            'source'				=> lasf_get_plugin_source($from_option, $initial_required, 'lastudio-header-footer-builders'),
            'required'				=> true,
            'version'				=> lasf_get_plugin_source($from_option, $initial_required, 'lastudio-header-footer-builders', 'version')
		);

		$plugins[] = array(
			'name'     				=> esc_html_x('WooCommerce', 'admin-view', 'zuka'),
			'slug'     				=> 'woocommerce',
			'version'				=> '5.2.2',
			'required' 				=> false
		);

		$plugins[] = array(
			'name'     				=> esc_html_x('Envato Market', 'admin-view', 'zuka'),
			'slug'     				=> 'envato-market',
			'source'   				=> 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
			'required' 				=> false,
			'version' 				=> '2.0.6'
		);

        $plugins[] = array(
            'name'					=> esc_html_x('Zuka Package Demo Data', 'admin-view', 'zuka'),
            'slug'					=> 'zuka-demo-data',
            'source'				=> lasf_get_plugin_source($from_option, $initial_required, 'zuka-demo-data'),
            'required'				=> true,
            'version'				=> lasf_get_plugin_source($from_option, $initial_required, 'zuka-demo-data', 'version')
        );

		$plugins[] = array(
			'name' 					=> esc_html_x('Contact Form 7', 'admin-view', 'zuka'),
			'slug' 					=> 'contact-form-7',
			'required' 				=> false
		);

		$plugins[] = array(
			'name' 					=> esc_html_x('Easy Forms for MailChimp', 'admin-view', 'zuka'),
			'slug' 					=> 'yikes-inc-easy-mailchimp-extender',
			'required' 				=> false
		);

		$plugins[] = array(
			'name'					=> esc_html_x('Slider Revolution', 'admin-view', 'zuka'),
			'slug'					=> 'revslider',
            'source'				=> lasf_get_plugin_source($from_option, $initial_required, 'revslider'),
            'required'				=> false,
            'version'				=> lasf_get_plugin_source($from_option, $initial_required, 'revslider', 'version')
		);

		$config = array(
			'id'           				=> 'zuka',
			'default_path' 				=> '',
			'menu'         				=> 'tgmpa-install-plugins',
			'has_notices'  				=> true,
			'dismissable'  				=> true,
			'dismiss_msg'  				=> '',
			'is_automatic' 				=> false,
			'message'      				=> ''
		);

		tgmpa( $plugins, $config );

	}

}
