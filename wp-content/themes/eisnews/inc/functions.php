<?php
/*
=======================================================
|| Query and Cache Breaking News data;
=======================================================
*/
function display_breaking_news()
{
  $cache_key = 'breaking_news';
  $cahced_breaking_news = wp_cache_get($cache_key);

  if ($cahced_breaking_news === false) {
    $breaking_news = new WP_Query(
      [
        "post_type"     => "post",
        "posts_per_page" => 10
      ]
    );
    if ($breaking_news->have_posts()) {
      $html = '<ul id="news-ticker-wrap" class="h-full flex gap-2">';
      while ($breaking_news->have_posts()) {
        $breaking_news->the_post();
        $html .= sprintf(
          '<li class="h-full flex flex-shrink-0">
          <a class="flex items-center font-normal text-base font-kalpurush h-full gap-1 flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
            </svg><span>%s</span>
          </a>
        </li>',
          get_the_title()
        );
      }
      $html .= '</ul>';
    }
    wp_reset_postdata();
    if (wp_cache_add($cache_key, $html, '', DAY_IN_SECONDS)) {
      return $html;
    } else {
      throw new Exception("The $cache_key is alreay exist", 1);
    }
  } else {
    return $cahced_breaking_news;
  }
}

/*
=======================================================
|| Query and Cache Main News data;
=======================================================
*/
function display_main_news()
{
  $cache_key = 'main_news';
  $cached_news = wp_cache_get($cache_key);
  if (!$cached_news) {
    $args = array(
      'post_type' => 'post', // Adjust if using a custom post type for news
      'category_name' => 'main-news', // Use slug instead of name
      'orderby' => array('post_date' => 'DESC', 'sticky' => 'DESC'),
      'posts_per_page' => 7,
      'ignore_sticky_posts' => false,
    );
    $mainNews = new WP_Query($args);

    $html = '<div>';
    $html .= eis_main_news_section_title();
    $html .= '<div class="grid md:grid-cols-4 sm:grid-cols-3 grid-cols-2 sm:grid-rows-3 gap-4">';
    while ($mainNews->have_posts()) {
      $mainNews->the_post();
      if (is_sticky()) {
        $html .= get_template_part_as_string('/templates/news/large/main');
      } else {
        $html .= get_template_part_as_string('/templates/news/small/main');
      }
    }
    $html .= '</div>';
    $html .= '</div>';
    wp_reset_postdata();
    $cache_added = wp_cache_add($cache_key, $html, '', DAY_IN_SECONDS);

    if ($cache_added) {
      return $html;
    } else {
      wp_cache_replace($cache_key, $html, '', DAY_IN_SECONDS);
      return $html;
    }
  } else {
    return $cached_news;
  }
}

/*
=======================================================
|| Query and Cache Single Row News data;
=======================================================
*/
function display_news_by_category(string $category_slug, string $bgColor = 'bg-red-50', string $catBgColor = 'bg-primary', string $borderColor = 'border-b-primary', int $perPage = 4)
{
  $cache_key = $category_slug;
  $cached_news = wp_cache_get($cache_key);

  if (!$cached_news) {
    $news_query = new WP_Query([
      'category_name' => $category_slug,
      'posts_per_page' => $perPage,
      'orderby' => array('post_date' => 'DESC'),
    ]);

    if ($news_query->have_posts()) {
      $html = '<div class="my-10">';
      $html .= eis_news_section_title($category_slug, $borderColor, $catBgColor);
      $html .= '<div class="grid md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-4">';
      while ($news_query->have_posts()) {
        $news_query->the_post();
        $html .= get_template_part_as_string('templates/news/news', null, ['bgColor' => $bgColor, 'borderColor' => $borderColor]);
      }
      $html .= '</div>';
      $html .= '</div>';
      wp_reset_postdata();

      if (wp_cache_add($cache_key, $html, '', DAY_IN_SECONDS)) {
        wp_cache_replace($cache_key, $html, '', DAY_IN_SECONDS);
        return $html;
      } else {
        return $html;
      }
    }
  } else {
    return $cached_news;
  }
}


/*
=======================================================
|| Query and Cache Double Rows News data;
=======================================================
*/
function display_two_rows_news(string $category_slug, string $bgColor = 'bg-red-50', string $catBgColor = 'bg-primary', string $borderColor = 'border-b-primary', int $perPage = 4)
{
  $cache_key = $category_slug;
  $cached_news = wp_cache_get($cache_key);

  if (!$cached_news) {
    $news_query = new WP_Query([
      'category_name' => $category_slug,
      'posts_per_page' => $perPage,
      'orderby' => array('post_date' => 'DESC'),
    ]);

    if ($news_query->have_posts()) {
      $html = '<div class="my-10">';
      $html .= eis_news_section_title($category_slug, $borderColor, $catBgColor);
      $html .= '<div class="grid md:grid-cols-2 sm:grid-cols-3 grid-cols-2 grid-rows-2 gap-4 h-full">';
      while ($news_query->have_posts()) {
        $news_query->the_post();
        $html .= get_template_part_as_string('templates/news/news', null, ['bgColor' => $bgColor, 'borderColor' => $borderColor]);
      }
      $html .= '</div>';
      $html .= '</div>';
      wp_reset_postdata();

      if (wp_cache_add($cache_key, $html, '', DAY_IN_SECONDS)) {
        wp_cache_replace($cache_key, $html, '', DAY_IN_SECONDS);
        return $html;
      } else {
        return $html;
      }
    }
  } else {
    return $cached_news;
  }
}

/*
=======================================================
|| Query and Cache Tripple Column News data;
=======================================================
*/
function get_three_cols_news()
{
}

/*
=======================================================
|| Query and Cache Tab News data;
=======================================================
*/

function tab_news(array $filter_tab_list, string $cache_key)
{
  $filter_list = wp_cache_get($cache_key);

  if (!$filter_list) {
    $tabs = $filter_tab_list;

    $filters = '<ul class="flex ml-4">';
    foreach ($tabs as $tab) {
      $filters .= sprintf(
        '<li>
            <a href="javascript:void" class="link px-[10px] py-[7px] flex" data-filter="%2$s" data-bg="%3$s" data-border="%4$s">%1$s</a>
          </li>',
        $tab['name'],
        $tab['slug'],
        $tab['bg_color'],
        $tab['border_color'],
      );
    }
    $filters .= '</ul>';

    $html = '<div class="relative my-6">';
    $html .= $filters;
    $html .=  '<div class="bg-gray-light relative">
        <div class="tab_content px-2 py-2 grid gap-4 grid-cols-4 grid-rows-2 border-y-2"></div>
      </div>
    </div>';
    wp_cache_add($cache_key, $html);
    return $html;
  } else {
    return $filter_list;
  }
}

function create_ajax_tabs($filters = [])
{
  if (empty($filters)) {
    return;
  }

  wp_enqueue_script('ajax-tabs-script', get_template_directory_uri() . '/src/js/ajax-tab.js', array('jquery'), '1.0.0', true);
  wp_enqueue_style('ajax-tabs-style', get_template_directory_uri() . '/src/tab.css');

  $output = '<div class="tab-wrapper">';
  $output .= '<ul class="tab-filters ml-4">';
  foreach ($filters as $key => $filter) {
    $output .= sprintf(
      '<li 
          class="filter %4$s %2$s"
          data-tab="%3$s"
          data-active-bg="%2$s"
          data-border-color="%5$s"
        >%1$s</li>',
      $filter['name'],
      $filter['bg_color'],
      $filter['slug'],
      $key === 0 ? 'active' : 'filter-inactive',
      $filter['border_color']
    );
  }
  $output .= '</ul>';

  $output .= '<div class="tab-contents">';
  foreach ($filters as $key => $filter) {
    if ($key === 0) {
      $output .= sprintf('<div class="tab-content__wrapper relative tab-content border-y-2 p-4 active %3$s" id="%1$s">%2$s</div>', $filter['slug'], do_shortcode('[tab_news_shortcode category="' . $filter['slug'] . '" border_color="' . $filter['border_color'] . '" bg_color="' . $filter['bg_color'] . '" ]'), $filter['border_color']);
    } else {
      $output .= sprintf('<div class="tab-content__wrapper relative tab-content border-y-2 p-4 hidden %2$s" id="%1$s"></div>', $filter['slug'], $filter['border_color']);
    }
  }

  $output .= '</div>';
  $output .= '</div>';

  // Pass data to the JavaScript using wp_localize_script
  wp_localize_script('ajax-tabs-script', 'ajaxTabData', array(
    'ajaxUrl'     => admin_url('admin-ajax.php'),
    'activeTab'   => $filters[0]['slug'],
    'categories'  => $filters,
    'nonce' => wp_create_nonce('tabnews')
  ));

  return $output;
}

function get_category_news($atts)
{
  $category = isset($atts['category']) ? sanitize_text_field($atts['category']) : '';
  $borderColor = isset($atts['category']) ? sanitize_text_field($atts['border_color']) : '';
  $bgColor = isset($atts['category']) ? sanitize_text_field($atts['bg_color']) : '';

  $cache_key = $category;
  $cached_postsHTML = wp_cache_get($cache_key);

  if ($cached_postsHTML !== false) {
    return $cached_postsHTML;
  }

  $query_args = [
    'category_name' => $category,
    'posts_per_page' => 5,
    'orderby' => array('post_date' => 'DESC'),
  ];

  $query = new WP_Query($query_args);

  $postsHTML = '';

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $template = $query->current_post === 0 ? "templates/news/large/tab" : "templates/news/news";
      $postsHTML .= get_template_part_as_string($template, false, ['bgColor' => 'bg-white', 'borderColor' => $borderColor]);
    }
    $link = eis_get_category_link($category);
    $postsHTML .= sprintf('<a href="%s" class="more active %s"><span>আরোও</span> %s</a>', $link, $bgColor, get_svg_icon('right-angle'));
    wp_reset_postdata();
  } else {
    $postsHTML = 'No posts found for the selected category.';
  }

  if (wp_cache_add($cache_key, $postsHTML, '', DAY_IN_SECONDS)) {
    wp_cache_replace($cache_key, $postsHTML, '', DAY_IN_SECONDS);
    return $postsHTML;
  } else {
    return $postsHTML;
  }
}
add_shortcode('tab_news_shortcode', 'get_category_news');
