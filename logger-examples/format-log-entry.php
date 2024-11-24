<?php
namespace SandboxLogger;

add_filter( 'woocommerce_format_log_entry', __NAMESPACE__ . '\format_log_entry' );

/**
 * Format the log entry by adding context information.
 *
 * @param string $message The original log message.
 * @return string The formatted log entry.
 */
function format_log_entry( $message ) {
	// Remove tabs from begining of new line.
	$message = preg_replace( '/(\r\n|\r|\n)\t+/', '$1', $message );
	// Replace new line with html break line symbol.
	return str_replace( array( "\r\n", "\n", "\r" ), '&#10;', $message );
}
