<?php

namespace Innocode\BugsnagFE;

final class Plugin {

	/**
	 * Notifier API key.
	 *
	 * @var string
	 */
	private $api_key;
	/**
	 * Domain of library.
	 *
	 * @var string
	 */
	private $domain = 'd2wy8f7a9ursnm.cloudfront.net';
	/**
	 * Current latest version of library.
	 *
	 * @var string
	 */
	private $version = 'v7';

	/**
	 * Plugin constructor.
	 *
	 * @param string $api_key
	 */
	public function __construct( string $api_key ) {
		$this->api_key = $api_key;
	}

	/**
	 * Return notifier API key.
	 *
	 * @return string
	 */
	public function get_api_key() : string {
		return $this->api_key;
	}

	/**
	 * Set domain of library.
	 *
	 * @param string $domain
	 * @return void
	 */
	public function set_domain( string $domain ): void {
		$this->domain = $domain;
	}

	/**
	 * Return domain of library.
	 *
	 * @return string
	 */
	public function get_domain() : string {
		return $this->domain;
	}

	/**
	 * Set current latest version of library.
	 *
	 * @param string $version
	 * @return void
	 */
	public function set_version( string $version ): void {
		$this->version = $version;
	}

	/**
	 * Return current latest version of library.
	 *
	 * @return string
	 */
	public function get_version() : string {
		return $this->version;
	}

	/**
	 * Initialize plugin.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'wp_head', [ $this, 'enqueue_scripts' ], 0 );
	}

	/**
	 * Enqueue scripts.
	 *
	 * @return void
	 */
	public function enqueue_scripts(): void {
		printf(
			"<script src=\"%s\" onload=\"Bugsnag.start({apiKey:'%s'})\" %s></script>\n", // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript
			$this->get_url(),
			$this->get_api_key(),
			$this->is_deferred() ? 'defer' : ''
		);
	}

	/**
	 * Return URL of library.
	 *
	 * @return string
	 */
	public function get_url(): string {
		return sprintf(
			'//%s/%s/bugsnag.min.js',
			$this->get_domain(),
			$this->get_version()
		);
	}

	/**
	 * Return true if library should be loaded deferred.
	 *
	 * @return bool
	 */
	public function is_deferred(): bool {
		return apply_filters( 'innocode_bugsnag_fe_deferred', true );
	}
}
