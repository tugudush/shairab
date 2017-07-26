<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bubospec_shairab');

/** MySQL database username */
define('DB_USER', 'bubospec_jerz');

/** MySQL database password */
define('DB_PASSWORD', 'accessdenied123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'Y}9-E+Kmh+s1K-#/xFyshe8G+Ql8J&$8SyJZi*t5u7yk Tw#<&)n>6o=fqVVdp{-');
define('SECURE_AUTH_KEY',  '4Bpk8weKKy*wmV?]L~pK~[>?[w|Vy`D0mW!6x``Vz4{KD@?5+:{o5-?@E+0&Ayu_');
define('LOGGED_IN_KEY',    'l-V=tK`hCevTb+NDrj{@NEK5tcN7 srkTBgUUuFPjs~7@m22Hp>SA|?L(Kr+f{by');
define('NONCE_KEY',        'lVa}bd+I,,X)z`r|pB-Mk}R5;p|$BC;tecIF=X-zG%sWOPqUwmdn&,U.GeIEEKk4');
define('AUTH_SALT',        'S$(Z%$_^.O%GZ!`#DN=#bz#atu/I1RU2aD%tIz*-Hqs!51=)qe[mSPA1N:|-[J+*');
define('SECURE_AUTH_SALT', 'J)7zH@5Djk+/ %Lrxi#iaV=Z(c;Qz+)qrS:Ae#-/X_e<W(j#0$zZ+ NFKiH,U9S)');
define('LOGGED_IN_SALT',   'd65W0R.a:kF(yUN=7<_g+i;^sLz,y1ANc`Vo1/~o4*@rWI_}sQCy.Lg}l1e6F$2B');
define('NONCE_SALT',       ' .C2ElySh m)-K|9!(3lBO+@_`F_v&6!>>BFWTQ;[lddk%>Q@^-9< o3i)HvN+(n');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

define( 'AUTOSAVE_INTERVAL', 300 );
define( 'WP_POST_REVISIONS', 5 );
define( 'EMPTY_TRASH_DAYS', 7 );
define( 'WP_CRON_LOCK_TIMEOUT', 120 );
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
