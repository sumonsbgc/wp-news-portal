<?php

namespace Eis\ThemeOption\Admin;

class ThemeOptions
{
  public function plugin_page(): void
  {
      include_once __DIR__ . '/views/options/options.php';
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
    echo "<pre>";
    print_r($_POST);
    exit;
  }
}
