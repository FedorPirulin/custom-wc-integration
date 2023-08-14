<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Custom_WC_Integration_Account {

    /**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

    public function __construct( $plugin_name ) {

        $this->plugin_name = $plugin_name;

    }

    // Add endpoint
    public function add_endpoint() {
        add_rewrite_endpoint( $this->plugin_name, EP_ROOT | EP_PAGES );
    }

    // Add new menu item before 'Log Out' button.
    public function add_menu_item( $items ) {
        $logout = $items[ 'customer-logout' ];
        unset( $items[ 'customer-logout' ] );
        $items[ $this->plugin_name ] = __( 'Settings', $this->plugin_name );
        $items[ 'customer-logout' ] = $logout;
        return $items;
    }

    public function render_settings_ui() {
        include plugin_dir_path( __DIR__ ) . 'templates/form-account-custom-settings.php';
    }

    public function save_user_preferences() {
        if ( isset( $_POST['save_custom_preferences'] ) && isset( $_POST[ $this->plugin_name . '-settings-nonce' ] ) && wp_verify_nonce( $_POST[ $this->plugin_name . '-settings-nonce' ], $this->plugin_name . '-settings' ) ) {
            $raw_preferences = sanitize_text_field( $_POST['custom_preferences'] );
            $preferences_array = array_map( 'sanitize_text_field', explode( ',', $raw_preferences) );
            
            $user_id = get_current_user_id();
            update_user_meta( $user_id, $this->plugin_name . '_preferences', $preferences_array );
            echo '<p>Preferences saved successfully!</p>';
        }
    }
}