<?php
/**
 * Plugin Name: Bugsnag Frontend Error Monitoring
 * Description: Automatically detects issues from browser on site and notifies by email, chat or ticket system via Bugsnag.
 * Version: 1.1.0
 * Author: Innocode
 * Author URI: https://innocode.com
 * Tested up to: 6.0.1
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

use Innocode\BugsnagFE;

if ( ! defined( 'BUGSNAG_FE_API_KEY' ) ) {
	return;
}

$GLOBALS['innocode_bugsnag_fe'] = new BugsnagFE\Plugin( BUGSNAG_FE_API_KEY );

if ( defined( 'BUGSNAG_FE_DOMAIN' ) ) {
	$GLOBALS['innocode_bugsnag_fe']->set_domain( BUGSNAG_FE_DOMAIN );
}

if ( defined( 'BUGSNAG_FE_VERSION' ) ) {
	$GLOBALS['innocode_bugsnag_fe']->set_version( BUGSNAG_FE_VERSION );
}

$GLOBALS['innocode_bugsnag_fe']->run();

if ( ! function_exists( 'innocode_bugsnag_fe' ) ) {
	/**
	 * @return BugsnagFE\Plugin|null
	 */
	function innocode_bugsnag_fe() : ?BugsnagFE\Plugin {
		global $innocode_bugsnag_fe;

		if ( null === $innocode_bugsnag_fe ) {
			trigger_error(
				'Missing required constants',
				E_USER_ERROR
			);
		}

		return $GLOBALS['innocode_bugsnag_fe'];
	}
}
