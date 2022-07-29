# Bugsnag Frontend Error Monitoring

### Description

Automatically detects issues from browser on site and notifies by email, chat or ticket system via Bugsnag.

### Install

- Preferable way is to use [Composer](https://getcomposer.org/):

		````
		composer require innocode-digital/wp-bugsnag-fe
		````

	By default, it will be installed as [Must Use Plugin](https://codex.wordpress.org/Must_Use_Plugins).
	It's possible to control with `extra.installer-paths` in `composer.json`.

- Alternate way is to clone this repo to `wp-content/mu-plugins/` or `wp-content/plugins/`:

		````
		cd wp-content/plugins/
		git clone git@github.com:innocode-digital/wp-bugsnag-fe.git
		cd wp-bugsnag-fe/
		composer install
		````

If plugin was installed as regular plugin then activate **AWS Lambda Prerender** from Plugins page
or [WP-CLI](https://make.wordpress.org/cli/handbook/): `wp plugin activate wp-bugsnag-fe`.

### Configuration

Add the following constants to `wp-config.php`:

````
define( 'BUGSNAG_FE_API_KEY', '' );
// Optionally, it's possible to change Bugsnag domain and/or version of library via `wp-config.php`:
define( 'BUGSNAG_FE_DOMAIN', '' );
define( 'BUGSNAG_FE_VERSION', 'v6' );
````

### Usage

By default, library will be loaded with higher priority that `wp_enqueue_scripts` hook with attribute `defer` but
it's possible to control through `innocode_bugsnag_fe_deferred` hook:

````
add_action( 'innocode_bugsnag_fe_deferred', '__return_false' );
````
