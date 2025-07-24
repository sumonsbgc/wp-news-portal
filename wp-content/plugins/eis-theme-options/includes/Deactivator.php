<?php

namespace Eis\ThemeOption;

class Deactivator
{
  /**
   * Run deactivation process
   * @param bool $backup_data Whether to backup data before deletion
   */
  public function run($backup_data = false)
  {
    // Backup data if requested
    if ($backup_data) {
      $this->backup_data();
    }

    $this->drop_tables();
    $this->remove_options();
    $this->clear_cache();

    // Log completion
    error_log("EIS Theme Options: Plugin deactivation completed successfully" . ($backup_data ? " (with backup)" : ""));
  }

  /**
   * Drop the plugin database table
   */
  public function drop_tables()
  {
    global $wpdb;

    $table_name = $wpdb->prefix . 'eis_dp_options';

    // Check if table exists before attempting to drop
    $table_exists = $wpdb->get_var($wpdb->prepare(
      "SHOW TABLES LIKE %s",
      $table_name
    ));

    if ($table_exists) {
      // Drop the table
      $result = $wpdb->query("DROP TABLE IF EXISTS `{$table_name}`");

      if ($result !== false) {
        error_log("EIS Theme Options: Table '{$table_name}' successfully dropped during deactivation");
      } else {
        error_log("EIS Theme Options: Failed to drop table '{$table_name}' - " . $wpdb->last_error);
      }
    } else {
      error_log("EIS Theme Options: Table '{$table_name}' does not exist, skipping drop");
    }
  }

  /**
   * Remove plugin options from WordPress options table
   */
  public function remove_options()
  {
    $options_to_remove = [
      'eis-theme-options-installed',
      'eis-theme-options-version'
    ];

    $removed_count = 0;
    foreach ($options_to_remove as $option) {
      if (delete_option($option)) {
        $removed_count++;
      }
    }

    error_log("EIS Theme Options: {$removed_count} plugin options removed during deactivation");
  }

  /**
   * Clear any cached data
   */
  public function clear_cache()
  {
    // Clear WordPress object cache
    wp_cache_flush();

    // Clear any plugin-specific transients
    global $wpdb;
    $wpdb->query(
      "DELETE FROM {$wpdb->options} 
             WHERE option_name LIKE '_transient_eis_%' 
             OR option_name LIKE '_transient_timeout_eis_%'"
    );

    error_log("EIS Theme Options: Cache and transients cleared during deactivation");
  }

  /**
   * Backup data before deletion (optional)
   * Uncomment the call in run() method to enable this feature
   */
  public function backup_data()
  {
    global $wpdb;

    $table_name = $wpdb->prefix . 'eis_dp_options';

    // Check if table exists
    $table_exists = $wpdb->get_var($wpdb->prepare(
      "SHOW TABLES LIKE %s",
      $table_name
    ));

    if (!$table_exists) {
      error_log("EIS Theme Options: No table to backup, skipping backup");
      return;
    }

    $backup_data = $wpdb->get_results("SELECT * FROM `{$table_name}`", ARRAY_A);

    if (!empty($backup_data)) {
      $backup_dir = WP_CONTENT_DIR . '/eis-backups';

      // Create backup directory if it doesn't exist
      if (!file_exists($backup_dir)) {
        wp_mkdir_p($backup_dir);
      }

      $backup_file = $backup_dir . '/eis-theme-options-backup-' . date('Y-m-d-H-i-s') . '.json';
      $backup_success = file_put_contents($backup_file, json_encode($backup_data, JSON_PRETTY_PRINT));

      if ($backup_success !== false) {
        error_log("EIS Theme Options: Data backed up to {$backup_file}");
      } else {
        error_log("EIS Theme Options: Failed to create backup file");
      }
    } else {
      error_log("EIS Theme Options: No data found to backup");
    }
  }

  /**
   * Show admin notice before deactivation (optional)
   * This would need to be hooked into admin_notices if you want to warn users
   */
  public static function deactivation_notice()
  {
?>
<div class="notice notice-warning is-dismissible">
  <p>
    <strong>EIS Theme Options:</strong>
    Deactivating this plugin will permanently delete all theme options data from the database.
    This action cannot be undone.
  </p>
</div>
<?php
  }
}