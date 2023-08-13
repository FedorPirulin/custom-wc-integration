<?php
/**
 * The plugin bootstrap file
 *
 * @link              https://https://www.linkedin.com/in/fedor-pirulin/
 * @since             1.0.0
 * @package           Custom_WC_Integration_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Custom WooCommerce Integration Plugin
 * Plugin URI:        https://github.com/FedorPirulin/custom-wc-integration
 * Description:       This is a description of the plugin.
 * Version:           1.0.0
 * Author:            Fedor Pirulin
 * Author URI:        https://https://www.linkedin.com/in/fedor-pirulin/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       custom-wc-integration
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include the main plugin class
require_once plugin_dir_path(__FILE__) . 'includes/class-custom-wc-integration.php';
