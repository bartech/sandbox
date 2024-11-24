<?php

namespace SandboxLogger;

use WC_Log_Levels;

add_action( 'update_option', __NAMESPACE__ . '\log_on_option_update', 10, 3 );

/**
 * Logs when an option is updated.
 *
 * @param string $option    Name of the option.
 * @param mixed  $old_value The old option value.
 * @param mixed  $value     The new option value.
 */
function log_on_option_update( $option, $old_value, $value ) {

	// Skip some options.
	if ( in_array( $option, array( 'cron', 'woocommerce_queue_flush_rewrite_rules' ), true ) ) {
		return;
	}
	// Skip transients.
	if ( false !== strpos( $option, 'transient' ) ) {
		return;
	}

	// Skip when number value is the same even if type is different.
	// For example 2 and '2'.
	// phpcs:ignore Universal.Operators.StrictComparisons.LooseEqual
	if ( is_numeric( $old_value ) && is_numeric( $value ) && $old_value == $value ) {
		return;
	}

	// Skip when $old_value and $value is equal.
	// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.serialize_serialize
	if ( serialize( $old_value ) === serialize( $value ) ) {
		return;
	}

	// If $old_value is a valid JSON string, decode it to array.
	if ( is_string( $old_value ) && false !== strpos( $old_value, '{' ) ) {
		$old_value_data = json_decode( $old_value, true );
		if ( json_last_error() === JSON_ERROR_NONE ) {
			$old_value = $old_value_data;
		}
	}

	// If $value is a valid JSON string, decode it to array.
	if ( is_string( $value ) && false !== strpos( $old_value, '{' ) ) {
		$value_data = json_decode( $value, true );
		if ( json_last_error() === JSON_ERROR_NONE ) {
			$value = $value_data;
		}
	}

	$data = array(
		'new_value' => $value,
		'old_value' => $old_value,
	);

	log( WC_Log_Levels::INFO, 'Option updated: ' . $option, $data, array( 'source' => 'sandbox-logger-options' ) );
}
