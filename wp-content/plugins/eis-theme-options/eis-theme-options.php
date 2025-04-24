<?php

/**
 * Plugin Name
 *
 * @package           WordPress Plugin
 * @author            Mohammad Sumon
 * @copyright         2019 Mohammad Sumon or Encoder IT Solution
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       EIS Theme Options
 * Plugin URI:        https://github.com/sumonsbgc/wordpress/purbokone-theme-options
 * Description:       The plugin is related with theme options of Dainik Purbokone
 * Version:           1.0.0
 * Author:            Mohammad Sumon
 * Author URI:        https://github.com/sumonsbgc
 * Text Domain:       eis
 * Domain Path:       /languages
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

if (! defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

final class EIS_Theme_Options
{
    const version = '1.0';
    private function __construct()
    {
        $this->define_constants();
        register_activation_hook(__FILE__, [$this, 'activate']);
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    public function init_plugin(): void
    {
        new Eis\ThemeOption\Assets();
        if (is_admin()) {
            new Eis\ThemeOption\Admin();
        } else {
            new Eis\ThemeOption\Frontend();
        }
    }

    public static function init(): EIS_Theme_Options
    {
        static $instance = false;

        if (! $instance) {
            $instance = new self();
        }

        return $instance;
    }

    public function define_constants(): void
    {
        define('EIS_THEME_OPTIONS_VERSION', self::version);
        define('EIS_THEME_OPTIONS_FILE', __FILE__);
        define('EIS_THEME_OPTIONS_PATH', __DIR__);
        define('EIS_THEME_OPTIONS_URL', plugins_url('', EIS_THEME_OPTIONS_FILE));
        define('EIS_THEME_OPTIONS_ASSETS', EIS_THEME_OPTIONS_URL . '/assets');
    }

    public function activate(): void
    {
        $installer = new Eis\ThemeOption\Installer();
        $installer->run();
    }
}

function eis_theme_options(): EIS_Theme_Options
{
    return EIS_Theme_Options::init();
}

eis_theme_options();
