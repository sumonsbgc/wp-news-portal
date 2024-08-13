<?php

namespace Eis\ThemeOption;

use Eis\ThemeOption\Admin\ThemeOptions;

class Admin
{
    public function __construct(){
        $this->dispatch_actions();
        new Admin\Menu();
    }

    public function dispatch_actions (): void
    {
        $themeOptions = new ThemeOptions();
        add_action('admin_init', [$themeOptions, 'form_handler']);
    }
}