<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.linkedin.com/in/fedor-pirulin/
 * @since      1.0.0
 *
 * @package    Custom_Wc_Integration
 * @subpackage Custom_Wc_Integration/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Custom_Wc_Integration
 * @subpackage Custom_Wc_Integration/includes
 * @author     Fedor Pirulin <fedya.lol123@gmail.com>
 */
class Custom_Wc_Integration_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}

}
