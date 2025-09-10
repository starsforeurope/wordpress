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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '3g[:ED,TAUn!pibI!WoKq?]gzJyO)Dh+:1=V88VBX-zsn;X[b6$.`;,UU}#X+<xh' );
define( 'SECURE_AUTH_KEY',   '.=LXe|&qx+# X;I:c7{sE&TKVS|.QGJr1|4.lnd^bww2:(|gk-0o`Sv]9ixw}^Mt' );
define( 'LOGGED_IN_KEY',     '6ylX>S-?e.qY8k-3V.cqPh^2c@(q{USZUhA9IJ9-.5~MmdHEG#pJ[SZDG 2>QfvI' );
define( 'NONCE_KEY',         'l7 5<M{e5f|ADr>xo.8trzW{0(x)QTFo]H8:xtr8z[2vl*6CcHmR5!:R 2JJ7GYB' );
define( 'AUTH_SALT',         'pAa`2ZZ#3EJ$r;[$dsRZa^;%@_-po?+h[Ek.R-!#H[pVNqZz+*t5 `p,q@$U-6YD' );
define( 'SECURE_AUTH_SALT',  'h)?6yO#p,)weqmM/]H@2c{*%*)U#D2/`-~$.l_-0z;9&ed[AGbzn-[G|vpA^mDj)' );
define( 'LOGGED_IN_SALT',    '~F/eI/}`ytD.U5J*fifJY`<3iK%)o_b7s5ywOL*X c4-sbEzN@z.L}f!9?EDd3HI' );
define( 'NONCE_SALT',        'Os>9&?IUhsz@KD+t+QEsR9,y2$G$,*s`yM,rT?FNE|FG&m{3UC=l3~QUFomk{+>E' );
define( 'WP_CACHE_KEY_SALT', '^/Pka5P<MQ0d`KK[7moFla2nYtI;5*>RK_%x{i~d3GA3 *ODD/N!?4ROvw*}ew#%' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
