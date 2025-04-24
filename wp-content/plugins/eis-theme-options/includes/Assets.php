<?php

namespace Eis\ThemeOption;

class Assets
{
  public function __construct()
  {
    add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
  }

  public function get_admin_scripts()
  {
    return [
      'eis-dp-options-script' => [
        'src' => EIS_THEME_OPTIONS_ASSETS . '/js/options.js',
        'version' => filemtime(EIS_THEME_OPTIONS_PATH . '/assets/js/options.js'),
      ],
    ];
  }

  public function get_admin_styles()
  {
    return [
      'eis-dp-options-style' => [
        'src' => EIS_THEME_OPTIONS_ASSETS . '/css/options.css',
        'version' => filemtime(EIS_THEME_OPTIONS_PATH . '/assets/css/options.css'),
      ],
    ];
  }

  public function enqueue_admin_assets()
  {
    $scripts = $this->get_admin_scripts();
    $styles = $this->get_admin_styles();

    foreach ($scripts as $handle => $script) {
      $deps = isset($script['deps']) ? $script['deps'] : false;
      wp_register_script($handle, $script['src'], $deps, $script['version'], true);
    }

    foreach ($styles as $handle => $style) {
      $deps = isset($style['deps']) ? $style['deps'] : false;
      wp_register_style($handle, $style['src'], $deps, $style['version']);
    }
  }

  public function enqueue_assets() {}
}
