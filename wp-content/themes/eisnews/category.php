<?php
get_header();
$qb = get_queried_object();
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$cache_key = 'category_posts_' . $qb->term_id . '_page_' . $paged;
$cached_posts = wp_cache_get($cache_key);

if ($cached_posts === false) {
  ob_start();
  $args = [
    'post_type' => 'post',
    'cat' => $qb->term_id,
    'paged' => $paged,
  ];

  $query = new WP_Query($args);
  if ($query->have_posts()) {
    $post_count = 0;
    while ($query->have_posts()) : $query->the_post();
      $post_count++;
      if ($post_count == 1) {
        get_template_part('templates/category/large', null, ['location' => $location]);
      } else {
        get_template_part('templates/category/small', null, ['location' => $location]);
      }
    endwhile;
    dpkone_pagination();
  } else {
    echo "<h3>There is no content in this category</h3>";
  }

  wp_reset_postdata();

  $cached_posts = ob_get_clean();
  wp_cache_set($cache_key, $cached_posts, '', 12 * HOUR_IN_SECONDS);
};
?>

<main class="content-area">
  <div class="news-sections">
    <div><?php echo eis_news_single_title(); ?></div>
    <div class="category-news-wrapper">
      <div class="grid grid-cols-3 gap-6">
        <?php echo $cached_posts; ?>
      </div>
    </div>
  </div>
  <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>