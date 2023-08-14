<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.linkedin.com/in/fedor-pirulin/
 * @since      1.0.0
 *
 * @package    Custom_Wc_Integration
 * @subpackage Custom_Wc_Integration/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Custom_Wc_Integration
 * @subpackage Custom_Wc_Integration/includes
 * @author     Fedor Pirulin <fedya.lol123@gmail.com>
 */
class Custom_Wc_Integration_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'custom-wc-integration',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
