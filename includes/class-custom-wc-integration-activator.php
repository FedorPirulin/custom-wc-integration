<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.linkedin.com/in/fedor-pirulin/
 * @since      1.0.0
 *
 * @package    Custom_Wc_Integration
 * @subpackage Custom_Wc_Integration/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Custom_Wc_Integration
 * @subpackage Custom_Wc_Integration/includes
 * @author     Fedor Pirulin <fedya.lol123@gmail.com>
 */
class Custom_Wc_Integration_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if ( ! class_exists( 'WooCommerce' ) ) {
        	deactivate_plugins( plugin_basename( __FILE__ ) );
			wp_die('<div class="error"><p><strong>' . sprintf( esc_html__( 'Custom WooCommerce Integration plugin requires the WooCommerce plugin to be installed and active. You can download %s here.', 'custom-wc-integration' ), '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a>' ) . '</strong></p></div>');
		}

		add_rewrite_endpoint( 'custom-wc-integration', EP_ROOT | EP_PAGES );
		flush_rewrite_rules( false );
	}
}
