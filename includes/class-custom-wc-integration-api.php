<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Custom_WC_Integration_Api {

	/**
	 * API url.
	 *
	 * @var      Custom_WC_Integration_Api    $url_api    API url.
	 */
	private $url = 'https://httpbin.org/post';

	/**
	 * Returns default set of HTTP request headers used for API.
	 *
	 * @return array An associative array of headers.
	 */
	private function default_headers() {
		$headers = array(
			'Content-Type' => 'application/json',
		);

		return $headers;
	}
	
	public function get_request( $user_preferences ) {
		$args = array(
			'body' => serialize( $user_preferences ),
			'headers' => $this->default_headers(),
		);

		$response = wp_remote_post( $this->url, $args );
		
		return $response;
	}
}
