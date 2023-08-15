<?php
/**
 * The file that defines the core plugin class
 *
 * @since      1.0.0
 *
 * @package    Custom_WC_Integration_Plugin
 * @subpackage Custom_WC_Integration_Plugin/includes
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Custom_Wc_Integration
 * @subpackage Custom_Wc_Integration/includes
 * @author     Fedor Pirulin <fedya.lol123@gmail.com>
 */
class Custom_Wc_Integration {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Custom_Wc_Integration_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'CUSTOM_WC_INTEGRATION_VERSION' ) ) {
			$this->version = CUSTOM_WC_INTEGRATION_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'custom-wc-integration';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_wc_account_hooks();
		$this->define_wc_widget_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Custom_Wc_Integration_Loader. Orchestrates the hooks of the plugin.
	 * - Custom_Wc_Integration_i18n. Defines internationalization functionality.
	 * - Custom_Wc_Integration_Admin. Defines all hooks for the admin area.
	 * - Custom_Wc_Integration_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-custom-wc-integration-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-custom-wc-integration-i18n.php';

		/**
		 * The class responsible for defining WooCommerce Acount section
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-custom-wc-integration-account.php';

		/**
		 * The class responsible for defining API functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-custom-wc-integration-api.php';

		/**
		 * The class responsible for defining widget functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-custom-wc-integration-widget.php';

		$this->loader = new Custom_Wc_Integration_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Custom_Wc_Integration_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Custom_Wc_Integration_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the WooCommerce account area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_wc_account_hooks() {

		$plugin_wc_account = new Custom_Wc_Integration_Account( $this->get_plugin_name() );

		$this->loader->add_action( 'init', $plugin_wc_account, 'add_endpoint' );
		$this->loader->add_action( 'template_redirect', $plugin_wc_account, 'save_user_preferences' );
		$this->loader->add_action( 'woocommerce_account_' . $this->get_plugin_name() . '_endpoint', $plugin_wc_account, 'render_settings_ui' );
		$this->loader->add_filter( 'woocommerce_account_menu_items', $plugin_wc_account, 'add_menu_item' );

	}

	/**
	 * Register all of the hooks related to the Widget area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_wc_widget_hooks() {

		$plugin_wc_widget = new Custom_Wc_Integration_Widget( $this->get_plugin_name() );

		$this->loader->add_action( 'widgets_init', $plugin_wc_widget, 'register_widget' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Custom_Wc_Integration_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

