<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'prasidch_demonetwrk');

/** MySQL database username */
define('DB_USER', 'prasidch_superus');

/** MySQL database password */
define('DB_PASSWORD', 'LqH,yaOtiNm[');

/** This is for local server **/
//define('DB_NAME', 'netwrkdemo');

/** MySQL database username */
//define('DB_USER', 'root');

/** MySQL database password */
//define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'ZdIs!]%7yJI!7W3d#r6E69+w]RX;xXPvXG-GoQ[E&7p02t4g@2b+|goDFCD<=V>0');
define('SECURE_AUTH_KEY',  'J&*_3Newu~~{YxFy*Lq)FZ75|)AH<e<w!v38;o{]QSVeLo)Ij#_:!L69@[BGX]<+');
define('LOGGED_IN_KEY',    'ZDb~9EMLO|`+3JUc.|,Z-#HB98[T-MoFH!Bk/+L1h3>V74c>R<9b{QB?sAM%flQ6');
define('NONCE_KEY',        '$2op4KvMTVd#,u0?xQ6[:KT)GV$Iqq.-LK9Td}f-EM63uS+8QLe6]|bSnbNU>;zK');
define('AUTH_SALT',        'el.[tSH h7dBhGB`VBsI=jqr<p6s*-Pk.fMpS>qm46}i^&>Q-@{FcIH5jAD3s#Bl');
define('SECURE_AUTH_SALT', 'r%8++6$+wN$:A<~s]/RK4y8 bu`-!|3l+>aB {~OTVz%9<tPdi4ZG+nh!:N(B3V.');
define('LOGGED_IN_SALT',   '_Zz)+/|I{N!Hn{uzFWc?}DxtIDnV#qS+&WW$)CO#P2|D;-,Cz|.[NNY +[+_kY$`');
define('NONCE_SALT',       'B}b@Y#(zR0jVJ|&`[rMsv#GwgA=Gg$qEp<v>Y@E| y7|AS?R&P)3#|)d7/,d6|fL');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'nrk_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define( 'AUTOMATIC_UPDATER_DISABLED', true );
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
