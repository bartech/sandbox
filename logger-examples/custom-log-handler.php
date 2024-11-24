<?php

add_filter( 'woocommerce_register_log_handlers', __NAMESPACE__ . '\add_log_handler' );

/**
 * Adds a custom email log handler to WooCommerce log handlers.
 *
 * @param array $handlers Existing log handlers.
 * @return array Modified log handlers.
 */
function add_log_handler( $handlers ) {
	$recipients = array( 'bartech@bartech.dev' ); // Send logs to multiple recipients.
	$threshold  = 'critical'; // Only send emails for logs of this level and higher.
	$handlers[] = new WC_Log_Handler_Email( $recipients, $threshold );

	return $handlers;
}
