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
 * This has been slightly modified (to read environment variables) for use in Docker.
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// IMPORTANT: this file needs to stay in-sync with https://github.com/WordPress/WordPress/blob/master/wp-config-sample.php
// (it gets parsed by the upstream wizard in https://github.com/WordPress/WordPress/blob/f27cb65e1ef25d11b535695a660e7282b98eb742/wp-admin/setup-config.php#L356-L392)

// a helper function to lookup "env_FILE", "env", then fallback
//if (!function_exists('getenv_docker')) {
//	// https://github.com/docker-library/wordpress/issues/588 (WP-CLI will load this file 2x)
//	function getenv_docker($env, $default) {
//		if ($fileEnv = getenv($env . '_FILE')) {
//			return rtrim(file_get_contents($fileEnv), "\r\n");
//		}
//		else if (($val = getenv($env)) !== false) {
///			return $val;
//		}
//		else {
//			return $default;
//		}
//	}
//}

// ** Database settings - You can get this info from your web host ** //a
// I need to work over getenv_docker() to more reliabilty
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'flmastor' );

/** Database password */
define( 'DB_PASSWORD', 'password12345' );

/**
 * Docker image fallback values above are sourced from the official WordPress installation wizard:
 * https://github.com/WordPress/WordPress/blob/f9cc35ebad82753e9c86de322ea5c76a9001c7e2/wp-admin/setup-config.php#L216-L230
 * (However, using "example username" and "example password" in your database is strongly discouraged.  Please use strong, random credentials!)
 */

/** Database hostname */
define( 'DB_HOST', 'mariadb' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '');

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
define('AUTH_KEY',         'nmYa<WedM-68mqikGLhx8Z;ejuC7(3oZnb]~dfSi+JQv+`U]c~D16g>Kg?681NG-');
define('SECURE_AUTH_KEY',  'uk%aJK*L; o3`z,7m50fnZeyBeFUs4/2$WF:N|E57Cr j&0a3FI,L6ygi~N1z+]T');
define('LOGGED_IN_KEY',    'n/*R+S6G0s};%s?sStDB;?m8N,;H.ZmG?yg>Qs%S7,%3)q,mUwmNb+wThgx,P@1A');
define('NONCE_KEY',        'N|{53u96+@+*)kZ$=ma/JgK<kerk[p6cE$4pw;or,g+|SA?InB8>+g??Ex{(HD-1');
define('AUTH_SALT',        'vTtd2w,P5A~|t|Zoo]pFJ&b{idH_rQ~ilop3I$V0>irg3(wU|>)MpUg9VV}|.-aH');
define('SECURE_AUTH_SALT', '5g6Od>b,yChn[Y5uVfK7:TN|Sm/VO<-xzY|<6}>t<`PwB&bnfm!@C[K$U-B~[{K4');
define('LOGGED_IN_SALT',   '?C[}ugwZ% m-<$`UHKHjLr<^%_t-B$Hd)U- ->P(vd,tPlL6H6N6PLNKG4d{=yg-');
define('NONCE_SALT',       'cKDKe2,nOgfK=lgzbx*N;d|6!|l&E$0gmA]fJ79Eu:`t/V)a0dzeJO[>dA*[,6=K');
// (See also https://wordpress.stackexchange.com/a/152905/199287)

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */

// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also https://wordpress.org/support/article/administration-over-ssl/#using-a-reverse-proxy
#if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
#	$_SERVER['HTTPS'] = 'on';
}
// (we include this by default because reverse proxying is extremely common in container environments)

# if ($configExtra = getenv_docker('WORDPRESS_CONFIG_EXTRA', '')) {
#	eval($configExtra);
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
