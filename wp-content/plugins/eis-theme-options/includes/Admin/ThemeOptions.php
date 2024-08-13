<?php

namespace Eis\ThemeOption\Admin;

class ThemeOptions
{
  public function plugin_page(): void
  {
    include_once __DIR__ . '/views/theme-options.php';
  }
}