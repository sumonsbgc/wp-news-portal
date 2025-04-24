<?php

namespace Eis\ThemeOption;

class Installer
{
  public function run()
  {
    $this->add_version();
    $this->create_tables();
  }

  public function add_version()
  {
    $installed = get_option('eis-theme-options-installed');

    if (! $installed) {
      update_option('eis-theme-options-installed', time());
    }
    update_option('eis-theme-options-version', EIS_THEME_OPTIONS_VERSION);
  }

  public function create_tables()
  {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'eis_dp_options';

    $schema = "CREATE TABLE IF NOT EXISTS `{$table_name}` (
      `option_id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      `option_group` VARCHAR(255) NOT NULL,
      `option_key` VARCHAR(255) NOT NULL,
      `option_value` LONGTEXT NULL,
      `is_serialized` TINYINT(1) DEFAULT 0,
      `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      UNIQUE KEY `unique_option` (`option_group`, `option_key`)
    ) $charset_collate";

    if (!function_exists('dbDelta')) {
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    }

    dbDelta($schema);
  }
}
