<?php

namespace Eis\ThemeOption\Admin;

class ThemeOptions
{
  private $options_data = [];

  public function __construct()
  {
    error_log('EIS Theme Options: ThemeOptions class instantiated at ' . date('Y-m-d H:i:s'));
    $this->load_options();
  }

  public function plugin_page(): void
  {
    // Always log when the admin page loads
    error_log('EIS Theme Options: plugin_page() called at ' . date('Y-m-d H:i:s'));
    error_log('EIS Theme Options: REQUEST_METHOD = ' . $_SERVER['REQUEST_METHOD']);
    error_log('EIS Theme Options: Current page = ' . (isset($_GET['page']) ? $_GET['page'] : 'unknown'));

    include_once __DIR__ . '/views/options/options.php';
  }

  /**
   * Load all options from database
   */
  private function load_options(): void
  {
    global $wpdb;
    $table = $wpdb->prefix . 'eis_dp_options';

    $results = $wpdb->get_results("SELECT * FROM {$table}");

    foreach ($results as $row) {
      if ($row->is_serialized) {
        $this->options_data[$row->option_group] = maybe_unserialize($row->option_value);
      } else {
        if ($row->option_group === 'general') {
          $this->options_data[$row->option_key] = $row->option_value;
        } else {
          $this->options_data[$row->option_group][$row->option_key] = $row->option_value;
        }
      }
    }
  }

  /**
   * Get option value
   */
  public function get_option($key, $group = 'general', $default = '')
  {
    if ($group === 'general') {
      return isset($this->options_data[$key]) ? $this->options_data[$key] : $default;
    }

    return isset($this->options_data[$group][$key]) ? $this->options_data[$group][$key] : $default;
  }

  /**
   * Get array option (like salat times)
   */
  public function get_array_option($group, $default = [])
  {
    return isset($this->options_data[$group]) ? $this->options_data[$group] : $default;
  }

  /**
   * Save theme options with proper validation
   */
  public function dp_save_all_theme_options($post_data, $files_data = [])
  {
    global $wpdb;
    $table = $wpdb->prefix . 'eis_dp_options';
    $ignore_keys = ['_wpnonce', '_wp_http_referer', 'submit_options'];

    $filtered_array = array_filter(
      $post_data,
      fn($key) => !in_array($key, $ignore_keys),
      ARRAY_FILTER_USE_KEY
    );

    // Handle file uploads
    if (!empty($files_data['epaper']) && $files_data['epaper']['error'] === UPLOAD_ERR_OK) {
      $upload_result = $this->handle_file_upload($files_data['epaper']);
      if ($upload_result) {
        $filtered_array['epaper_url'] = $upload_result['url'];
        $filtered_array['epaper_id'] = $upload_result['id'];
      }
    }

    foreach ($filtered_array as $group => $fields) {
      $sanitized_group = sanitize_key($group);

      if (!is_array($fields)) {
        $sanitized_value = $this->sanitize_field($fields, $group);

        $wpdb->replace($table, [
          'option_group'  => 'general',
          'option_key'    => sanitize_key($group),
          'option_value'  => $sanitized_value,
          'is_serialized' => 0,
        ], ['%s', '%s', '%s', '%d']);
        continue;
      }

      if (is_array($fields)) {
        $sanitized_fields = $this->sanitize_array_fields($fields, $group);

        $wpdb->replace($table, [
          'option_group'  => $sanitized_group,
          'option_key'    => '__full_array__',
          'option_value'  => serialize($sanitized_fields),
          'is_serialized' => 1,
        ], ['%s', '%s', '%s', '%d']);
      }
    }

    return true;
  }

  /**
   * Handle file upload
   */
  private function handle_file_upload($file)
  {
    if (!function_exists('wp_handle_upload')) {
      require_once(ABSPATH . 'wp-admin/includes/file.php');
    }

    $upload_overrides = ['test_form' => false];
    $movefile = wp_handle_upload($file, $upload_overrides);

    if ($movefile && !isset($movefile['error'])) {
      // Create attachment
      $attachment = [
        'guid'           => $movefile['url'],
        'post_mime_type' => $movefile['type'],
        'post_title'     => preg_replace('/\.[^.]+$/', '', basename($movefile['file'])),
        'post_content'   => '',
        'post_status'    => 'inherit'
      ];

      $attach_id = wp_insert_attachment($attachment, $movefile['file']);

      if (!is_wp_error($attach_id)) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata($attach_id, $movefile['file']);
        wp_update_attachment_metadata($attach_id, $attach_data);

        return [
          'url' => $movefile['url'],
          'id' => $attach_id
        ];
      }
    }

    return false;
  }

  /**
   * Sanitize individual field based on type
   */
  private function sanitize_field($value, $field_name)
  {
    switch ($field_name) {
      case 'editor_name':
      case 'publisher_name':
        return sanitize_text_field($value);

      case 'online_poll':
        return sanitize_textarea_field($value);

      case 'ytd_api_key':
      case 'ytd_channel_id':
        return sanitize_key($value);

      default:
        return sanitize_text_field($value);
    }
  }

  /**
   * Sanitize array fields
   */
  private function sanitize_array_fields($fields, $group)
  {
    $sanitized = [];

    switch ($group) {
      case 'salat':
        foreach ($fields as $key => $value) {
          $sanitized[sanitize_key($key)] = sanitize_text_field($value);
        }
        break;

      case 'sports':
        foreach ($fields as $index => $sport) {
          $sanitized[$index] = [
            'sports_name' => sanitize_text_field($sport['sports_name']),
            'sports_news' => sanitize_textarea_field($sport['sports_news'])
          ];
        }
        break;

      case 'ytd_playlist_id':
        foreach ($fields as $playlist_id) {
          if (!empty($playlist_id)) {
            $sanitized[] = sanitize_key($playlist_id);
          }
        }
        break;

      default:
        foreach ($fields as $key => $value) {
          if (is_array($value)) {
            $sanitized[sanitize_key($key)] = $this->sanitize_array_fields($value, $key);
          } else {
            $sanitized[sanitize_key($key)] = sanitize_text_field($value);
          }
        }
    }

    return $sanitized;
  }

  /**
   * Form handler with improved error handling
   */
  public function form_handler(): void
  {
    // Always log when this function is called, even without form submission
    error_log('EIS Theme Options: form_handler() called at ' . date('Y-m-d H:i:s'));

    // Log all POST data to see what we're getting
    if (!empty($_POST)) {
      error_log('EIS Theme Options: POST data received: ' . print_r($_POST, true));
      error_log('EIS Theme Options: POST keys: ' . implode(', ', array_keys($_POST)));
    } else {
      error_log('EIS Theme Options: No POST data received');
    }

    // Temporarily process any POST request to the options page, not just submit_options
    if (!empty($_POST) && isset($_GET['page']) && $_GET['page'] === 'dp-theme-options') {
      error_log('EIS Theme Options: Processing POST request to options page');

      // Check for nonce
      if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'dpkone-options')) {
        error_log('EIS Theme Options: Nonce verification failed');
        wp_die(__('Security verification failed. Please try again.', 'eis'));
      }

      if (!current_user_can('manage_options')) {
        error_log('EIS Theme Options: User does not have manage_options capability');
        wp_die(__('You do not have sufficient permissions to access this page.', 'eis'));
      }

      try {
        error_log('EIS Theme Options: Attempting to save options');
        $success = $this->dp_save_all_theme_options($_POST, $_FILES);
        error_log('EIS Theme Options: Save result: ' . ($success ? 'SUCCESS' : 'FAILED'));

        if ($success) {
          $redirect_url = admin_url('admin.php?page=dp-theme-options&status=success');
        } else {
          $redirect_url = admin_url('admin.php?page=dp-theme-options&status=error');
        }

        wp_redirect($redirect_url);
        exit;
      } catch (\Exception $e) {
        error_log('EIS Theme Options Error: ' . $e->getMessage());
        $redirect_url = admin_url('admin.php?page=dp-theme-options&status=error');
        wp_redirect($redirect_url);
        exit;
      }
    }

    if (!isset($_POST['submit_options'])) {
      error_log('EIS Theme Options: No submit_options in POST data');
      return;
    }

    // Debug logging
    error_log('EIS Theme Options: Form submission detected');
    error_log('POST data: ' . print_r($_POST, true));

    if (!wp_verify_nonce($_POST['_wpnonce'], 'dpkone-options')) {
      error_log('EIS Theme Options: Nonce verification failed');
      wp_die(__('Security verification failed. Please try again.', 'eis'));
    }

    if (!current_user_can('manage_options')) {
      error_log('EIS Theme Options: User does not have manage_options capability');
      wp_die(__('You do not have sufficient permissions to access this page.', 'eis'));
    }

    try {
      error_log('EIS Theme Options: Attempting to save options');
      $success = $this->dp_save_all_theme_options($_POST, $_FILES);
      error_log('EIS Theme Options: Save result: ' . ($success ? 'SUCCESS' : 'FAILED'));

      if ($success) {
        $redirect_url = admin_url('admin.php?page=dp-theme-options&status=success');
      } else {
        $redirect_url = admin_url('admin.php?page=dp-theme-options&status=error');
      }

      wp_redirect($redirect_url);
      exit;
    } catch (\Exception $e) {
      error_log('EIS Theme Options Error: ' . $e->getMessage());
      $redirect_url = admin_url('admin.php?page=dp-theme-options&status=error');
      wp_redirect($redirect_url);
      exit;
    }
  }
}
