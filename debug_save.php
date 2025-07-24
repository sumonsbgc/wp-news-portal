<?php
define('WP_USE_THEMES', false);
require_once('./wp-load.php');

// Create a simple debug log entry
error_log('EIS Debug Test: This is a test log entry at ' . date('Y-m-d H:i:s'));

// Check if we can write to the database
global $wpdb;
$table = $wpdb->prefix . 'eis_dp_options';

// Test a simple insert
$test_result = $wpdb->replace($table, [
  'option_group'  => 'test',
  'option_key'    => 'debug_test',
  'option_value'  => 'Debug test at ' . date('Y-m-d H:i:s'),
  'is_serialized' => 0,
], ['%s', '%s', '%s', '%d']);

if ($test_result) {
  echo "Database write test: SUCCESS\n";
  error_log('EIS Debug: Database write test successful');
} else {
  echo "Database write test: FAILED\n";
  error_log('EIS Debug: Database write test failed: ' . $wpdb->last_error);
}

// Check current user capabilities (if logged in)
if (is_user_logged_in()) {
  echo "User is logged in\n";
  if (current_user_can('manage_options')) {
    echo "User can manage options: YES\n";
  } else {
    echo "User can manage options: NO\n";
  }
} else {
  echo "No user logged in\n";
}

// Show the WordPress debug log location
if (defined('WP_DEBUG_LOG') && WP_DEBUG_LOG) {
  $log_file = WP_CONTENT_DIR . '/debug.log';
  echo "Debug log should be at: $log_file\n";
  if (file_exists($log_file)) {
    echo "Debug log file exists\n";
    echo "Log file size: " . filesize($log_file) . " bytes\n";
  } else {
    echo "Debug log file does not exist\n";
  }
}
