<?php
/**
 * The base WordPress configuration file
 *
 * The purpose of this file is fourfold:
 *  1) Load the local configuration file
 *  2) Define constants that tell WordPress it is installed in the /wordpress subdirectory
 *  3) Define the custom wp-content directory
 *  4) Bootstrap WordPress itself
 *
 * Do not store any sensitive information in this file, as it is part of the shared repository. Place sensitive
 * information, such as database credentials, salts, and anything specific to an installation in wp-local-config.php.
 */

// Load the local configuration file.
if ( file_exists( dirname( __DIR__ ) . '/wp-local-config.php' ) ) {
	require_once( dirname( __DIR__ ) . '/wp-local-config.php' );
}

// Define the home and site URLs.
define( 'WP_HOME',    ( empty( $_SERVER['https'] ) ? 'http://' : 'https://' ) . ( isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : '' ) );
define( 'WP_SITEURL', WP_HOME . '/wordpress' );

// Define the wp-content directory.
define( 'WP_CONTENT_DIR', __DIR__ . '/wp-content' );
define( 'WP_CONTENT_URL', WP_HOME . '/wp-content' );

// Define ABSPATH and load WordPress.
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/wordpress/' );
}
require_once( ABSPATH . 'wp-settings.php' );
