<?php
/**
 * @throws Exception
 */
function news_ticker($attr, $content)
{
  return display_breaking_news();
}
add_shortcode('breaking_news', 'news_ticker');

function get_main_news($attr, $content)
{
  return display_main_news();
}
add_shortcode('main_news', 'get_main_news');

function get_one_row_news($attr, $content)
{
  return display_news_by_category($attr['slug'], $attr['bg_color'], $attr['cat_bg_color'], $attr['border_color']);
}
add_shortcode('one_row_news', 'get_one_row_news');

function get_two_rows_news($attr, $content)
{
  return display_two_rows_news($attr['slug'], $attr['bg_color'], $attr['cat_bg_color'], $attr['border_color']);
}
add_shortcode('two_rows_news', 'get_two_rows_news');

function get_two_cats_news($attr, $content): string
{
  $html = '<div class="grid md:grid-cols-2 grid-cols-1 gap-4">';
  $html .= do_shortcode($content);
  $html .= '</div>';

  return $html;
}
add_shortcode('two_cat_news', 'get_two_cats_news');

/*
=======================================================
|| Tab News Query Through Ajax and Cached;
=======================================================
*/
add_action("wp_ajax_tabnews", "display_tabnews");
add_action("wp_ajax_nopriv_tabnews", "display_tabnews");

function display_tabnews(): void
{
  $category = filter_input(INPUT_POST, 'category');
  $borderColor = filter_input(INPUT_POST, 'borderColor');
  $bgColor = filter_input(INPUT_POST, 'bgColor');

  $cache_key = $category;
  $cached_postsHTML = wp_cache_get($cache_key);

  if ($cached_postsHTML !== false) {
    wp_send_json_success($cached_postsHTML);
    wp_die();
  }

  $nonce = $_POST['nonce'];
  $action = $_POST['action'];

  if (!isset($action)) {
    wp_send_json_error("Action not set");
    wp_die();
  }


  if (!wp_verify_nonce($nonce, $action)) {
    wp_send_json_error('Invalid nonce');
    wp_die();
  }

  check_ajax_referer('tabnews', 'nonce');

  $query_args = [
    'category_name' => $category,
    'posts_per_page' => 5,
    'orderby' => array('post_date' => 'DESC', 'sticky' => 'DESC'),
  ];

  $query = new WP_Query($query_args);
  $postsHTML = '';

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $template = $query->current_post === 0 ? "templates/news/large/tab" : "templates/news/news";
      $postsHTML .= get_template_part_as_string($template, false, ['bgColor' => 'bg-white', 'borderColor' => $borderColor]);
    }
    wp_reset_postdata();
    $link = eis_get_category_link($category);
    $more_link = sprintf('<a href="%s" class="more active %s"><span>আরোও</span> %s</a>', $link, $bgColor, get_svg_icon('right-angle'));
    $postsHTML .= $more_link;
  } else {
    $postsHTML = 'No posts found for the selected category.';
  }

  wp_cache_add($cache_key, $postsHTML);
  wp_send_json_success($postsHTML);
  wp_die();
}