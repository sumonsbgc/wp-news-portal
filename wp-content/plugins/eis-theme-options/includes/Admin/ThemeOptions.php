<?php

namespace Eis\ThemeOption\Admin;

class ThemeOptions
{
  public function plugin_page(): void
  {
    include_once __DIR__ . '/views/options/options.php';
  }

  public function dp_save_all_theme_options($post_data)
  {
    global $wpdb;
    $table = $wpdb->prefix . 'eis_dp_options';
    $ignore_keys = ['_wpnonce', '_wp_http_referer', 'submit_options'];

    $filtered_array = array_filter(
      $post_data,
      fn($key) => !in_array($key, $ignore_keys),
      ARRAY_FILTER_USE_KEY
    );

    foreach ($filtered_array as $group => $fields) {
      $sanitized_group = sanitize_key($group);

      if (!is_array($fields)) {
        $wpdb->replace($table, [
          'option_group'  => 'general',
          'option_key'    => sanitize_key($group),
          'option_value'  => sanitize_text_field($fields),
          'is_serialized' => 0,
        ], ['%s', '%s', '%s', '%d']);
        continue;
      }

      if (is_array($fields)) {
        $wpdb->replace($table, [
          'option_group'  => $sanitized_group,
          'option_key'    => '__full_array__',
          'option_value'  => serialize($fields),
          'is_serialized' => 1,
        ], ['%s', '%s', '%s', '%d']);
      }
    }
  }

  public function form_handler(): void
  {
    if (!isset($_POST['submit_options'])) {
      return;
    }

    if (!wp_verify_nonce($_POST['_wpnonce'], 'dpkone-options')) {
      wp_die('Are you cheating');
    }

    if (!current_user_can('manage_options')) {
      wp_die('Are you cheating');
    }

    print_r($_FILES['epaper']);

    die('Form submitted!');
    $this->dp_save_all_theme_options($_POST);
    $redirect_url = admin_url('admin.php?page=dp-theme-options&status=success');
    wp_redirect($redirect_url);
    exit;
  }
}
