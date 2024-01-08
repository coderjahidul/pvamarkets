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
define( 'DB_NAME', "pvamarkets" );
/** MySQL database username */
define( 'DB_USER', "root" );
/** MySQL database password */
define( 'DB_PASSWORD', "" );
/** MySQL hostname */
define( 'DB_HOST', "localhost" );
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
define( 'AUTH_KEY',         'nad6h5u3juukmuzyhlj4qtczkln18cirucdpnmslny9v5px3bfgvohyyffidqlcu' );
define( 'SECURE_AUTH_KEY',  'ho3axwvscikwibddhmnuqobepf1wxcmbhjc7k6waey4nkmdbyz7rls3qx6yxi0z7' );
define( 'LOGGED_IN_KEY',    '3g76rjf9toxcl3iqxjf5peldnkajiissrxlofyegz4zoogy3bcjepgl7wvimbl8x' );
define( 'NONCE_KEY',        'ateaxmcodp0svrihbvgw5rofihvvtgdx0qaqfdxwqxctk4tsl4f4zjhfikfsbnnn' );
define( 'AUTH_SALT',        'vsyrx7vh1tqlwk8uyvogt0vjp1pqo2xnxiji9xoyuqh3tdy6an56h4xz68mlsfdx' );
define( 'SECURE_AUTH_SALT', 'fs5mdx8xzbr7vtble5xmepxzlz3x3p7gmmuz8gxdvp9byamz5ql23iuaoxafc17w' );
define( 'LOGGED_IN_SALT',   'e36r6jllnqpq63xbxjct8y6rjjhaazr7pzlmw0cxp4ndsjgnxdhpfxvodmjvponr' );
define( 'NONCE_SALT',       'bmumeywtfvsimuqlxw7muv1lun8nny88zjemcxas24gjzwfmsielztuoxtfdzm42' );



define( 'SMTP_username', 'info@fluffydivacakes.com.ng' );  
define( 'SMTP_password', 'Amie@2021' );   
define( 'SMTP_server', 'fluffydivacakes.com.ng' );    
define( 'SMTP_FROM', 'info@fluffydivacakes.com.ng' );   
define( 'SMTP_NAME', 'SEO Neurons' );   
define( 'SMTP_PORT', '465' );     
define( 'SMTP_SECURE', 'tls' );   
define( 'SMTP_AUTH', true );  
define( 'SMTP_DEBUG',   0 ); 


/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpkn_';
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
define( 'DUPLICATOR_AUTH_KEY', 'FIv<of>Y?D,M[Y7jOg0^9b(rd23c=uP]SHgRlPNE2<3}YI(qo_dU 8yA4AdLInu6' );
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}
/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );