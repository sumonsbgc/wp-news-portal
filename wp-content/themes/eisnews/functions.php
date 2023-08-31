<?php
require_once 'inc/functions.php';
require_once 'inc/shortcodes.php';
require_once 'inc/theme_options/EIS_Theme_Options.php';
require_once 'inc/widgets/QueryNewsWidget.php';
require_once 'inc/widgets/MainNewsWidget.php';

define("VERSION", time());

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
    wp_enqueue_style('main_css', get_theme_file_uri('style.css'), null, VERSION, "all");
    wp_enqueue_script('propper', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('breaking_news', get_theme_file_uri('assets/js/jquery.webticker.min.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('custom-js', get_theme_file_uri('assets/custom.js'), array('jquery'), VERSION, true);
    wp_localize_script('custom-js', 'eis_ajax', ['url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('tabnews')]);
}
add_action('wp_enqueue_scripts', 'integrate_assets');

function enqueue_select2() {
    wp_enqueue_script( 'select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', array( 'jquery' ), '4.0.13', true );
    wp_enqueue_style( 'select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', array(), '4.0.13' );
}
add_action( 'admin_enqueue_scripts', 'enqueue_select2' );

function modify_excerpt_length($length)
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

function delete_cache()
{
    delete_transient('breaking_news');
    delete_transient('eis_header_menu');
}

add_action("save_post", "delete_cache");
add_action("delete_post", "delete_cache");

function eis_widget_register()
{
    register_sidebar(array(
        'name'          => __('Main News', 'eis'),
        'id'            => 'main-news',
        'description'   => __('Widgets in this area will be shown on all posts and pages.', 'eis'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => __('One Column News', 'eis'),
        'id'            => 'one-column-news',
        'description'   => __('Widgets in this area will be shown on all posts and pages.', 'eis'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => __('Two Column News', 'eis'),
        'id'            => 'two-column-news',
        'description'   => __('Widgets in this area will be shown on all posts and pages.', 'eis'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'eis_widget_register');
