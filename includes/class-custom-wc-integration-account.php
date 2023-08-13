<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Custom_WC_Integration_Account {

    // TODO replace custom-wc-integration with variable.
    public function __construct() {
        add_action( 'init', array( $this, 'add_endpoint' ) );
        add_action( 'template_redirect', array( $this, 'save_user_preferences' ) );
        add_action( 'woocommerce_account_custom-wc-integration_endpoint', array( $this, 'render_settings_ui' ) );
        add_filter( 'woocommerce_account_menu_items', array( $this, 'add_menu_item' ) );
    }

    // Add endpoint
    public function add_endpoint() {
        add_rewrite_endpoint( 'custom-wc-integration', EP_ROOT | EP_PAGES );
    }

    // Add new menu item before 'Log Out' button.
    public function add_menu_item( $items ) {
        $logout = $items[ 'customer-logout' ];
        unset( $items[ 'customer-logout' ] );
        $items[ 'custom-wc-integration' ] = __( 'Settings', 'custom-wc-integration' );
        $items[ 'customer-logout' ] = $logout;
        return $items;
    }

    public function render_settings_ui() {
        include plugin_dir_path( __DIR__ ) . 'templates/form-account-custom-settings.php';
    }

    // TODO replace custom_integration_preferences with variable.
    public function save_user_preferences() {
        if ( isset( $_POST['save_custom_preferences'] ) && isset( $_POST[ 'custom-wc-integration-settings-nonce' ] ) && wp_verify_nonce( $_POST[ 'custom-wc-integration-settings-nonce' ], 'custom-wc-integration-settings' ) ) {
            $raw_preferences = sanitize_text_field( $_POST['custom_preferences'] );
            $preferences_array = array_map( 'sanitize_text_field', explode( ',', $raw_preferences) );
            
            $user_id = get_current_user_id();
            update_user_meta( $user_id, 'custom_wc_integration_preferences', $preferences_array );
            echo '<p>Preferences saved successfully!</p>';
        }
    }
}