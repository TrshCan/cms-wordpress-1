<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'wordpress' );

/** Database hostname */
define( 'DB_HOST', 'db' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '~X2U^2_x(m[6~zJ-7T%s{8d:HzW$sU^X*w q?$:P#*z~VW:U=%fM,Tbx<T&FVum]' );
define( 'SECURE_AUTH_KEY',  's%{>*BIb:EED.0s7-_uTH }HJpg<>Eb3Qt|n[IuMKY@u>v/radz?q?.3JYXKPJrr' );
define( 'LOGGED_IN_KEY',    'x^?2k5aezMMGMR?1I&23u4B@P&uxRIW%(1_o4qC[i[JnyG>Jh&P5VGl.d}>|9`R8' );
define( 'NONCE_KEY',        ';?~)n@B.%d>I+T1eOhWPI[K[6qQk5OhoY_&Z;,UD,D:.vC!e)hxDo>Wyj}n->ZPP' );
define( 'AUTH_SALT',        'XzYwe3x f8B[.8+nCL8Q3(8[nWN=Jp.=< za1[N>5fuh],bEGl(v:C2TS]zg1wAo' );
define( 'SECURE_AUTH_SALT', 'x&OszSHPH`$jj@i{EoE33J:BW$ggn,cO4{LiLDfBz[jLMek^wOIrW/(2dj#U1^~s' );
define( 'LOGGED_IN_SALT',   'm)F_z_3`d2c-j(zQJ0_}vsI=|ZlLOlc1RC=CZX6=qdcXMq@#Z_O?VoHgJ=$HTUI?' );
define( 'NONCE_SALT',       '#]Ca0Kh:j-]kQ_A.qhAnGEY#z(iF},4dz9ZJhr5^*gRS~zgwz*z}*j}sgFL07cmr' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
