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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'gXO.:P*&RyFl5vlxs3s_8X{^7++u#F4#1M&y fV23BlF*X: -i%DA@SOn_r%,Y-]');
define('SECURE_AUTH_KEY',  'oOH]i6VV&2[gN_,a3FZ%A2.Yt!EO%$l?F>D 7G;.CQ^-yEok!1rI32Aw+yXw<;0e');
define('LOGGED_IN_KEY',    'n-p/{eWBPjTiJIh59c`hvCF!vXH462sP)dh>qn2>0)%A<;,>6eSi=%S3y?sW%ihk');
define('NONCE_KEY',        'A~Ua2VF~pQBnH`z;+^g`qR!ropuo_Zb6}eQ3$G%PJxHr sH*Y}:3HFro2Pw)K5R:');
define('AUTH_SALT',        '(mEy@k`:Q$w~FQ.lIlU,tigHE-eIs<yfoC{nG<30B%n8s%:mP;mMHscT2#ptZT$P');
define('SECURE_AUTH_SALT', ',wYW|g128m.=j)KB#`-i}:oqpagLq=mLPF8|;QE`7(3n-[5l/HaJE)8vM LO5SH(');
define('LOGGED_IN_SALT',   'T}DojRWQOZh{uVaiz9GCVHytPhDH02TUsXOk ~;poHLRbv@b^cp^Yo]I>9m?^6kP');
define('NONCE_SALT',       '$~!>j!kmsVB~*[}V->uo 2<h>k=piFh$$rk6(n6IdiV%XhVt8(Kaz>hM6LtW-Xpw');

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
