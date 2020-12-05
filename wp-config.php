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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp-college' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'myg.sCfN9}zH.?&LjBCDP@hH(X@fw f;q9)g IH`aX:3[dV,Rli..vH*b![u/TCs' );
define( 'SECURE_AUTH_KEY',  '?3MyV/$]wmuA[?u.r?N=FDxAVf:+.Z%`;~8OV?VYFzol<~`yUG3g9oGw(Et)eA<O' );
define( 'LOGGED_IN_KEY',    '>aECi*5/?V6@Un$1CJ&b8/i;M!a4PzOQ6lTe kHtAx 9p*z>CQH?V8YL.NFkW4~.' );
define( 'NONCE_KEY',        's&gCe`h>1:Aj6K#Cs*HEyy,%,+hfwstY3YC)rQW^G41U:~aE)RG*2[>Ac8|AsKZ|' );
define( 'AUTH_SALT',        '^FG+{[={`jVSMlxMj5|8B=^j+6nGn.7VydU!78Mm6y!|biy*t+D(.A0q*_TD<7nb' );
define( 'SECURE_AUTH_SALT', 'fj*Bb4D==h9f^4aI#Z>+NaJ@$n!^{+aXfe5%L_??wQ%vOWDx^ess6?;o{h>LQJ?f' );
define( 'LOGGED_IN_SALT',   'm=F*Xq~5| hx#xge9@|D,o&Lv%,Yu7}Oi`b6OX9)j4b&%1hO[~FCv&+75cu1WZkZ' );
define( 'NONCE_SALT',       'n>{I)`pw81gcH]!vMgpR~kh+n0iCh>Na2Tjsd^Vh&L6.ud{%q]#d@{AS.;F>t<8)' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
