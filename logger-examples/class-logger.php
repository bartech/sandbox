<?php
namespace SandboxLogger;

use WC_Log_Levels;

/**
 * Class Logger
 *
 * Handles logging functionality for the SandboxLogger.
 */
class Logger {

	/**
	 * Logs a message with the specified level.
	 *
	 * @param string $level   Log level.
	 * @param string $message Message to log.
	 * @param array  $context Log context.
	 */
	public static function log( $level, $message, $context = array() ) {
		static $logger = null;
		if ( null === $logger ) {
			$logger = wc_get_logger();
		}

		// Do custom stuff with $message and $context.

		$logger->log( $level, $message, $context );
	}

	/**
	 * Adds an emergency level message.
	 *
	 * System is unusable.
	 *
	 * @see WC_Logger::log
	 *
	 * @param string $message Message to log.
	 * @param array  $context Log context.
	 */
	public static function emergency( $message, $context = array() ) {
		self::log( WC_Log_Levels::EMERGENCY, $message, $context );
	}

	/**
	 * Adds an alert level message.
	 *
	 * Action must be taken immediately.
	 * Example: Entire website down, database unavailable, etc.
	 *
	 * @see WC_Logger::log
	 *
	 * @param string $message Message to log.
	 * @param array  $context Log context.
	 */
	public static function alert( $message, $context = array() ) {
		self::log( WC_Log_Levels::ALERT, $message, $context );
	}

	/**
	 * Adds a critical level message.
	 *
	 * Critical conditions.
	 * Example: Application component unavailable, unexpected exception.
	 *
	 * @see WC_Logger::log
	 *
	 * @param string $message Message to log.
	 * @param array  $context Log context.
	 */
	public static function critical( $message, $context = array() ) {
		self::log( WC_Log_Levels::CRITICAL, $message, $context );
	}

	/**
	 * Adds an error level message.
	 *
	 * Runtime errors that do not require immediate action but should typically be logged
	 * and monitored.
	 *
	 * @see WC_Logger::log
	 *
	 * @param string $message Message to log.
	 * @param array  $context Log context.
	 */
	public static function error( $message, $context = array() ) {
		self::log( WC_Log_Levels::ERROR, $message, $context );
	}

	/**
	 * Adds a warning level message.
	 *
	 * Exceptional occurrences that are not errors.
	 *
	 * Example: Use of deprecated APIs, poor use of an API, undesirable things that are not
	 * necessarily wrong.
	 *
	 * @see WC_Logger::log
	 *
	 * @param string $message Message to log.
	 * @param array  $context Log context.
	 */
	public static function warning( $message, $context = array() ) {
		self::log( WC_Log_Levels::WARNING, $message, $context );
	}

	/**
	 * Adds a notice level message.
	 *
	 * Normal but significant events.
	 *
	 * @see WC_Logger::log
	 *
	 * @param string $message Message to log.
	 * @param array  $context Log context.
	 */
	public static function notice( $message, $context = array() ) {
		self::log( WC_Log_Levels::NOTICE, $message, $context );
	}

	/**
	 * Adds a info level message.
	 *
	 * Interesting events.
	 * Example: User logs in, SQL logs.
	 *
	 * @see WC_Logger::log
	 *
	 * @param string $message Message to log.
	 * @param array  $context Log context.
	 */
	public static function info( $message, $context = array() ) {
		self::log( WC_Log_Levels::INFO, $message, $context );
	}

	/**
	 * Adds a debug level message.
	 *
	 * Detailed debug information.
	 *
	 * @see WC_Logger::log
	 *
	 * @param string $message Message to log.
	 * @param array  $context Log context.
	 */
	public static function debug( $message, $context = array() ) {
		self::log( WC_Log_Levels::DEBUG, $message, $context );
	}
}
