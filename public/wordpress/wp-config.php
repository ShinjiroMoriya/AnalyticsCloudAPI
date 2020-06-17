<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         't2K6TZ/Cvf+7MHixZ4T3vpJqxQzuYC+sJ65inV/GcG6dW8G5kxHD+zcg4GjNbiL7AeG/UO/30LidQADMJNlq8Q==');
define('SECURE_AUTH_KEY',  'emiHUQi5cnRS1AkPgb7Op4yhpjbuFL6NoG5iwjG0Ef8O5AWnlb53Oc5pa2ej2Yau5/9vaZcho/LV3WnV5GfHUg==');
define('LOGGED_IN_KEY',    '7TUsvnc0gXyu2LrURmLyH9f9Dqain6rPGkXUYbQ++/ZXG+QHNFFiAk+cokmp9YdAOCfY7ZpxI5lgqKyxxM+z6Q==');
define('NONCE_KEY',        'tNB+thT5/ojCG44nmImQlybf3kgdaOs7S3bah8ABYpec7VYeNrCW3CPvh+n4Il81L0XhlL8F5qFtV6SkJnj+Bw==');
define('AUTH_SALT',        'YfZTUi6cTXRdiAidKQGhfWzeqNMqW1Lo6UiWtvNz0kw8YMPW3r2Q5Wg17eFYlv+KffRGRJP9I1oI6jXJlVHaAw==');
define('SECURE_AUTH_SALT', 'FpdaecB7ogt1Uwq7WLyOJJsqTcDOMJC3WMLDA8hjA5niYzHS1jNDSYyc995TzMzq0tcdH9NUYlVoUB18B3rw2w==');
define('LOGGED_IN_SALT',   'gOHPocpZ2ctzkv1olkJYcNwU8F+dE6QL7XbkQeKBNBnmcDlPhSNumDWPfrsh05FXLy9oaFhzhOFluCpprs83Vg==');
define('NONCE_SALT',       't4paW5Vj2Rb4ojtmFj7ROhxrzIMfkML4+bd273NlNFT2ibPZCMomIw2R3pC3mSB8JX21tWI5gUNS87JgDxjHUA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
