<?php
// echo $_ENV['DB_HOST'];
define('WP_CACHE', $_ENV['WP_CACHE']);
define('WP_HOME', $_ENV['WP_HOME']);
define('WP_SITEURL', $_ENV['WP_SITEURL']);
define('WP_DEBUG',  $_ENV['WP_DEBUG']);

define('DB_HOST', $_ENV['DB_HOST']);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);

$table_prefix = $_ENV['TABLE_PREFIX'];

define('DB_CHARSET',  $_ENV['DB_CHARSET']);
define('DB_COLLATE', $_ENV['DB_COLLATE']);
define('FS_METHOD', $_ENV['FS_METHOD']);
define('IMAGE_EDIT_OVERWRITE', $_ENV['IMAGE_EDIT_OVERWRITE']);
define('WP_POST_REVISIONS', $_ENV['WP_POST_REVISIONS']);
define('DISABLE_WP_CRON', $_ENV['DISABLE_WP_CRON']);
define('EMPTY_TRASH_DAYS', $_ENV['EMPTY_TRASH_DAYS']);

if (!defined('SAVEQUERIES')) {
  define('SAVEQUERIES', $_ENV['SAVEQUERIES']);
}

define('AUTH_KEY',         $_ENV['AUTH_KEY']);
define('SECURE_AUTH_KEY',  $_ENV['SECURE_AUTH_KEY']);
define('LOGGED_IN_KEY',    $_ENV['LOGGED_IN_KEY']);
define('NONCE_KEY',        $_ENV['NONCE_KEY']);
define('AUTH_SALT',        $_ENV['AUTH_SALT']);
define('SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT']);
define('LOGGED_IN_SALT',   $_ENV['LOGGED_IN_SALT']);
define('NONCE_SALT',       $_ENV['NONCE_SALT']);
