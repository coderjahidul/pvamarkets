<?php
define('WP_CACHE', true); // Added by WP Rocket
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
define( 'DB_NAME', 'accountsseller_954' );

/** MySQL database username */
define( 'DB_USER', 'accountsseller_954' );

/** MySQL database password */
define( 'DB_PASSWORD', '](@eB6pea7t8S0]!' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '2hbck4hadqzjqecn9shfa29h5fhrsgms7b5xlf1lbyh0159gneuvly7txzuafw4s' );
define( 'SECURE_AUTH_KEY',  'ibn28gajqu7djlrnoibgsfr1qexihf2idnydjbwtjc7ridvplke2p6esaj7ihxjn' );
define( 'LOGGED_IN_KEY',    'calhtahdnkyhubczat03chp1lfuzzosjuj7hhcq7qiuz8mhgu4syrpwhu0gx3hak' );
define( 'NONCE_KEY',        'qkiadx7wkc9rnkcqltq9r6qeoaszh4naz4a12dfpvmykhswdabm3gudgwz7uo4vw' );
define( 'AUTH_SALT',        '8bv40ckidduep5shq5xxdncpyipfuhfaurvqukxhvxmjop8vqbgmgxb52zhqresi' );
define( 'SECURE_AUTH_SALT', 'flh1ka5779blqd6mel0nzyd57ydx1fhuryo85qmy9fcndafnxiatziite60xknwu' );
define( 'LOGGED_IN_SALT',   'epskx8pjxspbgcsnx0kdoxzwsr2zacmmbym3axedhihkfdf0rawwhulzopfsr0pb' );
define( 'NONCE_SALT',       '4jfco2t29zhgqvbryxlj536zvi1fjhn2sxtc1uzqn9fv3rf804m5ctjwjfvbsrq8' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpnb_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
