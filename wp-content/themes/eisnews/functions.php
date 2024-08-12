<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Dhaka');
define("VERSION", time());

require_once 'inc/helpers.php';
require_once 'inc/tab_news.php';
require_once 'inc/functions.php';
require_once 'inc/shortcodes.php';
require_once 'inc/theme_options/EIS_Theme_Options.php';

function register_menu()
{
    $locations = array(
        'header'    => __('Desktop Header Menu', 'eis'),
        'footer'    => __('Footer Menu', 'eis'),
        'mobile'    => __('Mobile Header Menu', 'eis'),
    );

    if (function_exists('register_nav_menus')) {
        register_nav_menus(array(
            'header'    => __('Desktop Header Menu', 'eis'),
            'footer'    => __('Footer Menu', 'eis'),
            'mobile'    => __('Mobile Header Menu', 'eis'),
        ));
    }
}
add_action("init", "register_menu");

function init_theme()
{
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));
    add_theme_support('custom-logo');
    add_theme_support('post-formats', array(
        'aside', 'image', 'video', 'quote', 'gallery',
    ));
    add_theme_support('post-thumbnails');
    add_theme_support("title-tag");
}
add_action("after_setup_theme", "init_theme");

function integrate_assets()
{
    wp_enqueue_script('breaking_news', get_theme_file_uri('assets/js/jquery.webticker.min.js'), array('jquery'), '1.0');
    wp_enqueue_script('custom-js', get_theme_file_uri('assets/js/custom.js'), array('jquery'), VERSION, true);
    // wp_localize_script('custom-js', 'eis_ajax', ['url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('tabnews')]);
}
add_action('wp_enqueue_scripts', 'integrate_assets');

function admin_integrate_assets(): void
{
    wp_enqueue_style('main_css', get_theme_file_uri('style.css'), null, VERSION, "all");
}
add_action('admin_enqueue_scripts', 'admin_integrate_assets');

function modify_excerpt_length(int $length): int
{
    $length = 8;
    return $length;
}
add_filter("excerpt_length", "modify_excerpt_length");

function modify_excerpt_more()
{
    return '';
}
add_filter("excerpt_more", "modify_excerpt_more");

add_action("pre_get_posts", function ($query) {
    if (!is_admin()) {
        if ($query->get('post_type') !== 'nav_menu_item') {
            $query->set('post_type', 'post');
            $query->set('post_status', 'publish');
            $query->set('no_found_rows', true);
            $query->set('cache_results', true);
            $query->set('update_post_meta_cache', true);
            $query->set('update_post_term_cache', true);
            $query->set('orderby', 'date');
            $query->set('order', 'DSC');
            $query->set('fields', 'ids');
        }

        if ($query->is_main_query()) {
            $query->set('posts_per_page', 1);
        }
    }
});

function delete_cache($post_id)
{
    wp_cache_delete('breaking_news');
    wp_cache_delete('sports');
    $cats = get_the_category($post_id);
    foreach ($cats as $cat) {
        switch ($cat->slug) {
            case 'main-news':
                wp_cache_delete('main_news');
                break;
            case 'chattogram':
                wp_cache_delete('chattogram');
                break;
            case 'national':
                wp_cache_delete('national');
                break;
            case 'international':
                wp_cache_delete('international');
                break;
            case 'finance-trade':
                wp_cache_delete('finance-trade');
                break;
            case 'finance-trade':
                wp_cache_delete('finance-trade');
                break;
            case 'zila-upazila-gram':
                wp_cache_delete('zila-upazila-gram');
                break;
            case 'sports':
                wp_cache_delete('sports');
                break;
            default:
                return null;
        }
    }
}
add_action("save_post", "delete_cache", 10, 1);
add_action("delete_post", "delete_cache");

function remove_sticky_from_other_posts($post_id)
{
    if (is_admin() && current_user_can('edit_posts') && isset($_POST['sticky']) && $_POST['sticky'] === 'sticky') {
        update_option('sticky_posts', array($post_id));
    }
}
add_action("save_post", "remove_sticky_from_other_posts", 9, 1);

// Add custom fields below the title and above the content editor
function add_custom_fields_to_editor()
{
    global $post;

    // Subheading 1
    $subheading_1 = get_post_meta($post->ID, 'subheading_1', true);
    echo '<label for="subheading_1">Subheading 1:</label>';
    echo '<input type="text" name="subheading_1" id="subheading_1" value="' . esc_attr($subheading_1) . '" class="widefat">';

    // Subheading 2
    $subheading_2 = get_post_meta($post->ID, 'subheading_2', true);
    echo '<label for="subheading_2">Subheading 2:</label>';
    echo '<input type="text" name="subheading_2" id="subheading_2" value="' . esc_attr($subheading_2) . '" class="widefat">';
}
add_action('edit_form_after_title', 'add_custom_fields_to_editor');

function save_custom_meta_boxes($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['subheading_1'])) {
        update_post_meta($post_id, 'subheading_1', sanitize_text_field($_POST['subheading_1']));
    }

    if (isset($_POST['subheading_2'])) {
        update_post_meta($post_id, 'subheading_2', sanitize_text_field($_POST['subheading_2']));
    }
}
add_action('save_post', 'save_custom_meta_boxes');
