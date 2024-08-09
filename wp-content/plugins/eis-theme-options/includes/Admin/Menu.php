<?php

namespace Eis\ThemeOption\Admin;
class Menu {
    public function __construct() {
        add_action( 'admin_menu', [$this, 'admin_menu'] );
    }

    public function admin_menu(): void
    {
        add_menu_page(
            __('DP Theme Options', 'eis'),
            __('Theme Options', 'eis'),
            'manage_options',
            'dp-theme-options',
            [$this, 'theme_options_page'],
            'dashicons-screenoptions'
        );
    }

    public function theme_options_page(): void
    {
        echo 'Theme Option Page';
    }
}