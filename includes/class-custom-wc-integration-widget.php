<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Custom_Wc_Integration_Widget extends WP_Widget {
	public function __construct() {
        parent::__construct( 'custom_wc_integration_widget', __( 'Custom Wc Integration Widget', 'custom-wc-integration' ), array('description' => 'Displays data based on user preferences.' ) );

    }

	/**
	 * Return Custom_WC_Integration_Api class instance.
	 */
	public function api() {
		$api = new Custom_WC_Integration_Api();
		return $api;
	}

    public function register_widget() {
        register_widget( 'Custom_Wc_Integration_Widget' );
    }

    public function widget( $args, $instance ) {
        // Retrieve user preferences and make API requests
        $user_id = get_current_user_id();
        $transient_key = 'custom_wc_integration_data_' . $user_id;
		$cached_data = get_transient( $transient_key );

		if ( $cached_data ) {
			$data = $cached_data;
		} else {
			$user_preferences = get_user_meta( $user_id, 'custom-wc-integration_preferences', true );
			// Make API request using user preferences
			$request = $this->api()->get_request( $user_preferences );

			if ( wp_remote_retrieve_response_code( $request ) === 200 ) {
				$request_body = json_decode( $request['body'] );
				$data = unserialize( $request_body->data );
				set_transient( $transient_key, $data, HOUR_IN_SECONDS ); 
			} else {
				echo 'Request error, no data given!';
				return;
			}
		}

		if ( $data ) { ?>
			<table class="custom-preferences-table">
                <tr>
                    <th>Fetched Data</th>
                </tr>
                <?php foreach ( $data as $item ) { ?>
                    <tr>
                        <td><?php echo esc_html($item); ?></td>
					</tr>
                <?php } ?>
            </table>
		<?php }

    }
}