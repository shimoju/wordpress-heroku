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

if ( getenv('CLEARDB_DATABASE_URL') ) {
	$db_url = parse_url(getenv('CLEARDB_DATABASE_URL'));
} else {
	$db_url = parse_url(getenv('DATABASE_URL'));
}

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', trim($db_url['path'], '/'));

/** MySQL database username */
define('DB_USER', $db_url['user']);

/** MySQL database password */
define('DB_PASSWORD', $db_url['pass']);

/** MySQL hostname */
define('DB_HOST', $db_url['host']);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', 'utf8mb4_general_ci');

/** MySQL options */
if ( getenv('DB_SSL') === 'false' ) {
	define('MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_COMPRESS);
} else {
	define('MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_COMPRESS | MYSQLI_CLIENT_SSL);
}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         getenv('AUTH_KEY'));
define('SECURE_AUTH_KEY',  getenv('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY',    getenv('LOGGED_IN_KEY'));
define('NONCE_KEY',        getenv('NONCE_KEY'));
define('AUTH_SALT',        getenv('AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT',   getenv('LOGGED_IN_SALT'));
define('NONCE_SALT',       getenv('NONCE_SALT'));

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', getenv('WP_DEBUG') === 'true' ? true : false);

/** Enable cache (include 'wp-content/advanced-cache.php') */
define('WP_CACHE', getenv('WP_CACHE') === 'true' ? true : false);

/** Disable plugin and theme update and installation */
define('DISALLOW_FILE_MODS', getenv('DISALLOW_FILE_MODS') === 'false' ? false : true);

/** Require SSL for admin and logins */
define('FORCE_SSL_ADMIN', getenv('FORCE_SSL_ADMIN') === 'false' ? false : true);

/** Disable WordPress auto updates */
define('AUTOMATIC_UPDATER_DISABLED', getenv('AUTOMATIC_UPDATER_DISABLED') === 'false' ? false : true);

/**
 * Check 'HTTP_X_FORWARDED_PROTO' header
 * because is_ssl() won't work when WordPress is behind a reverse proxy.
 * http://codex.wordpress.org/Administration_Over_SSL
 */
if ( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' )
	$_SERVER['HTTPS'] = 'on';

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/public/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
