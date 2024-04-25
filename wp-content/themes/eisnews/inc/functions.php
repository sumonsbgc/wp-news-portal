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

    $html = '<ul id="news-ticker-wrap" class="h-full">';
    while ($breaking_news->have_posts()) {
      $breaking_news->the_post();
      $html .= sprintf(
        '<li class="h-full">
        <a class="flex items-center font-normal text-base font-kalpurush h-full gap-1">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
          </svg><span>%s</span>
        </a>
      </li>',
        get_the_title()
      );
    }
    $html .= '</ul>';

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
    $html .= '<div class="grid grid-cols-4 grid-rows-3 gap-4">';
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
      'orderby' => array('post_date' => 'DESC', 'sticky' => 'DESC'),
    ]);

    if ($news_query->have_posts()) {
      $html = '<div class="my-10">';
      $html .= eis_news_section_title($category_slug, $borderColor, $catBgColor);
      $html .= '<div class="grid grid-cols-4 gap-4">';
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
      'orderby' => array('post_date' => 'DESC', 'sticky' => 'DESC'),
    ]);

    if ($news_query->have_posts()) {
      $html = '<div class="my-10">';
      $html .= eis_news_section_title($category_slug, $borderColor, $catBgColor);
      $html .= '<div class="grid grid-cols-2 gap-4">';
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
function display_tab_news(string $slug)
{
  $filters_list_one = [
    [
      'name' => 'সাহিত্য ও সংস্কৃতি',
      'slug' => 'literature-and-culture',
      'bg_color' => 'bg-pink',
      'border_color' => 'border-pink'
    ],
    [
      'name' => 'সম্পাদকীয়',
      'slug' => 'editorial',
      'bg_color' => 'bg-yellow',
      'border_color' => 'border-yellow',
    ],
    [
      'name' => 'উপ-সম্পাদকীয়',
      'slug' => 'op-editorial',
      'bg_color' => 'bg-green',
      'border_color' => 'border-green'
    ],
  ];

  $filters = '<ul class="flex ml-4">';
  foreach ($filters_list_one as $filter) {
    $filters .= sprintf(
      '<li>
          <a href="javascript:void" class="link px-[10px] py-[7px] flex" data-filter="%2$s" data-bg="%3$s" data-border="%4$s">%1$s</a>
        </li>',
      $filter['name'],
      $filter['slug'],
      $filter['bg_color'],
      $filter['border_color'],
    );
  }
  $filters .= '</ul>';

  $html = '<div class="relative my-6">';
  $html .= $filters;
  $html .=  '<div class="bg-gray-light relative">
      <div class="tab_content px-2 py-2 grid gap-4 grid-cols-4 grid-rows-2 border-y-2"></div>
    </div>
  </div>';

  return $html;
}
