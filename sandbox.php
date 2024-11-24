<?php
/**
 * Plugin Name: Sandbox Logger
 * Plugin URI:  https://example.com/sandbox-logger
 * Description: A simple plugin to log messages to the WooCommerce debug log.
 * Version:     1.0.1
 * Author:      Bartech
 * Author URI:  https://example.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: sandbox
 *
 * @package sandbox
 */

namespace SandboxLogger;

use WC_Log_Levels;

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SANDBOX_LOGGER_VERSION', '1.0.1' );

/**
 * Description of what my_function does.
 *
 * @return void
 */
function my_function() {
	// Do stuff.
	$logger = wc_get_logger();
	$logger->log( WC_Log_Levels::INFO, 'This is an info message' );
}

function init() {

	if ( defined( 'DOING_AJAX' ) && \DOING_AJAX ) {
		return;
	}

	if ( ! isset( $_GET['logs'] ) ) {
		return;
	}

	// Code here.
}

// Example usage: log a message on the `init` hook.
add_action( 'init', __NAMESPACE__ . '\init' );
