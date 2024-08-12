<?php

namespace Eis\ThemeOption\Admin;

use Eis\ThemeOption\Admin\ThemeOptions;

class Menu
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    public function admin_menu(): void
    {
        $parent_slug = 'dp-theme-options';
        $capability = 'manage_options';

        add_menu_page(
            __('DP Theme Options', 'eis'),
            __('Theme Options', 'eis'),
            $capability,
            $parent_slug,
            [$this, 'theme_options_page'],
            'dashicons-screenoptions'
        );

        add_submenu_page($parent_slug, __('Add Options', 'eis'), __('Add Options', 'eis'), $capability, $parent_slug, [$this, 'theme_options_page']);
        add_submenu_page($parent_slug, __('Ad Section', 'eis'), __('Ad Section', 'eis'), $capability, 'dp-ad-section', [$this, 'ad_section_page']);
    }

    public function theme_options_page(): void
    {
        $theme_options = new ThemeOptions();
        $theme_options->plugin_page();
    }

    public function ad_section_page(): void
    {
        echo 'Ad Section Page';
    }
}
