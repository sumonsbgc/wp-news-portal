<?php

define( 'DB_NAME', 'purbokone' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'password' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('FS_METHOD', 'direct');

define('IMAGE_EDIT_OVERWRITE', true);

define('WP_POST_REVISIONS', 0);

define('WP_CACHE', true);

define('DISABLE_WP_CRON', true);

define('EMPTY_TRASH_DAYS', 0); // Zero days

if (!defined('SAVEQUERIES')) {
	define('SAVEQUERIES', true);
}

define('WP_HOME', 'http://eisnews.test');
define('WP_SITEURL', 'http://eisnews.test');

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
define( 'AUTH_KEY',         '-b=+?`7T}.z9?<}M.:G_7HsdNzxH$4sFOWZ!iBVNJS8DI&>$FP85poV@.93OdMHH' );
define( 'SECURE_AUTH_KEY',  'Eam?Bs tT~4-^`iY*Mwe0qX3+]_-#bB0DDz{Z>6D0g*ZNdB]#;!~qI:HzYvEmS<t' );
define( 'LOGGED_IN_KEY',    'YS6;GV}gS+;h9}YYWa4cr60/A$P|&>9n&JmKV94;2)<N#}4a7BU:dN/A6[6,xX6j' );
define( 'NONCE_KEY',        '(bm,=Xk2;B/5C82W&FKFw]il/}mg>q={LcfSz+u([E9ote0oCk3GD#g_mID4Unbc' );
define( 'AUTH_SALT',        'T3>7aik:[*Ht@GQ*EH.Hy,&)}Axwnj(``M?hKu0/.Zu~do0w R,)&-,r,N8{T}<?' );
define( 'SECURE_AUTH_SALT', '<@j2jp<L#^4^wBF!Tf/At.99X6S*e#W|<lmnSOrl(i2=wUI<IU`ZR}|kV O((knU' );
define( 'LOGGED_IN_SALT',   '*1ACh<EfgXVn5u8`^]TjDEw=L!r;$9pRb9?[jT/q9R)3LEvqu=gfe-F~q6YuShi;' );
define( 'NONCE_SALT',       'y^^;4hNN+~0qo,5_0;tZ}Av!Oj>yWo/r4iz|vJ|k.iM])1:9~:Qax{Md,KvCe;Kl' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

