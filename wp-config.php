<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'qlnckh_sql' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '#Zp88~uTU7*boCQ3&x^MX?/Z*yO2l~=,6zp3<ei0xTnPo$V1{Vaw3^QmakI=(RBJ' );
define( 'SECURE_AUTH_KEY',  'A{@bc5Q/)(*hz,:>IVwb`?Kf+J.mQ0lKM!C=ne?XNfQ(RaEC!eyT9c4ZauZ(4?:+' );
define( 'LOGGED_IN_KEY',    '9/RGOQ<d4zJA-rNk6ZEWTq} la4wNnW[{,pp_&#5=J^4pk%oly+)p02v.`+}0pWD' );
define( 'NONCE_KEY',        '$pedo;:CiI(2QrLV(!_U6|>G_uZSO<[))8E;y/Fm&f2hLc1L_4QALuix;Eak_s!5' );
define( 'AUTH_SALT',        '{Rv_HG{tfYg5mk7VyLm/:Zq4g!3e|i[JoJ/p&oJIn2cm.AA=kPNNDj!J7/zW~j$O' );
define( 'SECURE_AUTH_SALT', '@<gUf*ACXZwz4kl_p11{T;u#r|k!-Tz^`+%LBzx}7C3$7)( =mC!17Z-@0SESU+2' );
define( 'LOGGED_IN_SALT',   '7oL:/S*F6fi_0}r<%ikX_+I=D@cu3#jq9;QHfI9YetbIjtC`ouqRf<K GU{u)[<~' );
define( 'NONCE_SALT',       '{2|1*XM1 :1LA+w,Q@gk^t0x.5}=2;[JMW7$D1hplh`,z([+FEz>Q<[rWK1V3$p!' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'realdev_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
