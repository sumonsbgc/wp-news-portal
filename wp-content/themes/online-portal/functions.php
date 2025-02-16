<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

define('VERSION', ($_ENV['WP_ENVIRONMENT'] !== 'DEVELOPMENT') ? 1 : time());

add_action('after_setup_theme', function () {
  load_theme_textdomain("dpkone", get_theme_file_path('/languages'));
  $locations = array(
    'header'    => __('Desktop Header Menu', 'eis'),
    'footer'    => __('Footer Menu', 'eis'),
    'mobile'    => __('Mobile Header Menu', 'eis'),
  );

  if (function_exists('register_nav_menus')) {
    register_nav_menus($locations);
  }

  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption'
  ));

  add_theme_support('custom-logo');

  add_theme_support('post-formats', array(
    'standard',
    'aside',
    'image',
    'video',
    'quote',
    'gallery',
  ));

  add_theme_support('post-thumbnails');
  add_theme_support("title-tag");

  add_theme_support('custom-header');
  add_theme_support('custom-background');
  // add_image_size('small_news_thumb', 220, 130);
});



function integrate_assets(): void
{
  wp_enqueue_style('main_css', get_theme_file_uri('style.css'), null, VERSION, "all");
  wp_enqueue_script('custom-js', get_theme_file_uri('src/js/eis-main.js'), array('jquery'), VERSION, true);

  // wp_localize_script('custom-js', 'eis_ajax', ['url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('tabnews')]);
}
add_action('wp_enqueue_scripts', 'integrate_assets');
