<?php
/**
 * Custom Settings Form
 *
 * @package Custom_WC_Integration_Plugin\Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 

$user_id = get_current_user_id();
$user_preferences = get_user_meta( $user_id, 'custom_wc_integration_preferences', true );
?>

<h2>Custom Integration Settings</h2>
<form class="woocommerce-form" method="post" action="">
    <?php wp_nonce_field( 'custom-wc-integration-settings', 'custom-wc-integration-settings-nonce' ); ?>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="custom_preferences">Enter your preferences (comma-separated):</label>
        <input type="text" id="custom_preferences" name="custom_preferences" value="">
    </p>
    <input type="submit" name="save_custom_preferences" value="Save Preferences" class="woocommerce-Button button">
</form>
