<?php
define('WP_USE_THEMES', false);
require_once('./wp-load.php');

global $wpdb;
$table = $wpdb->prefix . 'eis_dp_options';

// Check if table exists
$result = $wpdb->get_results("SHOW TABLES LIKE '$table'");
if (empty($result)) {
    echo "Table $table does NOT exist\n";
} else {
    echo "Table $table exists\n";
    $count = $wpdb->get_var("SELECT COUNT(*) FROM $table");
    echo "Records in table: $count\n";
    
    // Show some sample data
    $sample_data = $wpdb->get_results("SELECT * FROM $table LIMIT 5");
    echo "Sample data:\n";
    foreach ($sample_data as $row) {
        echo "Group: {$row->option_group}, Key: {$row->option_key}, Value: " . substr($row->option_value, 0, 50) . "\n";
    }
}

// Also check WordPress debug log
if (defined('WP_DEBUG_LOG') && WP_DEBUG_LOG) {
    echo "WordPress debug logging is enabled\n";
} else {
    echo "WordPress debug logging is disabled\n";
}
?>