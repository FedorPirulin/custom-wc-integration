<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once plugin_dir_path(__FILE__) . 'class-custom-wc-integration-account.php';
require_once plugin_dir_path(__FILE__) . 'class-custom-wc-integration-api.php';
require_once plugin_dir_path(__FILE__) . 'class-custom-wc-integration-widget.php';

new Custom_WC_Integration_Account();