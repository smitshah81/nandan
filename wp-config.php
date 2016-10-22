<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
 //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/srv/disk8/2089399/www/nandanpestcontrol.in/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', '2089399_0441');

/** MySQL database username */
define('DB_USER', '2089399_0441');

/** MySQL database password */
define('DB_PASSWORD', '4bCTzLMd');

/** MySQL hostname */
define('DB_HOST', 'fdb2.runhosting.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'BZ!1eD<-9nFH`lfbM|^-=I~Q-dyt]eTy3|0mAUsp_$#1b#Z/FWfO]|q|J#g)~-#2');
define('SECURE_AUTH_KEY',  ',^x+=d+.y5Hf[n;8jE0p~G-r+%qK8tEVT>V3xx^,R&jt4A|40.|qvp-e$q?x1y5_');
define('LOGGED_IN_KEY',    '@]xS+i-!cYw$q C]>4q;c7z9xwRVl+:]sh6A(*a+{eY}ym_C2l/yNjP)&9Pb$UBu');
define('NONCE_KEY',        'Q2ys4=8=231rt?f.FJXv 94dd|(Js&K+pCxm<4|)vit+OWO/cV+r>R-iErd3!^Lv');
define('AUTH_SALT',        '|(ITrgjuy|.hKqe:& DK%rceSh4KGp=Sm<Y!:H+|%c]A+s1a8/yw3f6H8fNiw:1G');
define('SECURE_AUTH_SALT', '|o3GB{F4}[>N_Qp>V=QB,6@LrFZbkQCx,zGb|MAL0]=2W=abG4sJ?C<j!U:@g^T3');
define('LOGGED_IN_SALT',   '!>wa$un9v>Ol t4VC+4t#|)@{QxqDpYa~>[w={]}Ni>e53VEDoalOE@8}bx:gf-2');
define('NONCE_SALT',       'h/A;s3-(]noR:j4xO+D|RLN&0lL(C5g-WAxic.oyU8[u{d<EY>|-/1Bxt8@2<SDA');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
