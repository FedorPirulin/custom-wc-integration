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

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CUSTOM_WC_INTEGRATION_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-custom-wc-integration-activator.php
 */
function activate_custom_wc_integration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-wc-integration-activator.php';
	Custom_Wc_Integration_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-custom-wc-integration-deactivator.php
 */
function deactivate_custom_wc_integration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-wc-integration-deactivator.php';
	Custom_Wc_Integration_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_custom_wc_integration' );
register_deactivation_hook( __FILE__, 'deactivate_custom_wc_integration' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-custom-wc-integration.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_custom_wc_integration() {

	$plugin = new Custom_Wc_Integration();
	$plugin->run();

}
run_custom_wc_integration();