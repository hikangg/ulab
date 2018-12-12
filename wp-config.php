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
define('DB_NAME', 'zadmin_ulabcom');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'abc123');

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

define('AUTH_KEY',         'Fe8FGv2DN@BfS*BmOaX2RVHVyw#Iwo,dlz=)-1A[oV@Tt5lb@QT{aHdmFnpNS Dv');
define('SECURE_AUTH_KEY',  '^?M]m2bczq@|jS eA-=&DwQIx<b|ag:t/)yKK`Wcy%NC_@v+[|OOJa@Y$j:ppF--');
define('LOGGED_IN_KEY',    '2S#W+D%Mpys{XN[L-lg!3:([mv~d^(3+N)E]}+6G1C8=^s=Tx8I5ZANP-{QAn^+ ');
define('NONCE_KEY',        'D9Y#c<F/)`gw{1i04kH0;,oF./SN_a?`G=NZj+OE6|$G!:+%_}_s8Fgy8*S}cpTU');
define('AUTH_SALT',        'o7Q+_}2p.[X>`sLnk/sKT!PB,!M,(gt5YG.zm/q(e(j=tzy$g|x*K=rOtobZ |JT');
define('SECURE_AUTH_SALT', '^g+}lOWwKyXP!-.yp6[4|f-Q&^V<m+tC Ley-Nr|^A{c]L6KH&(y-0uT`i_(-c&U');
define('LOGGED_IN_SALT',   '09Kqra+&_df!3SVz-BR?8]DecCETy/rq9+Z]&+(/M1+%DT@.|]P6.)/Xn_#8J4CH');
define('NONCE_SALT',       '8<8evFwKL/cgM#a%+)rojFHJI-J5{8XK/e5-~{soT5{kuF$pJxs<,K?sD.*{C]f-');
	

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ulab_';

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
