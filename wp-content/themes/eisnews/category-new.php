<?php
get_header();
$qb = get_queried_object();
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$cache_key = 'category_posts_' . $qb->slug . '_page_' . $paged;
$cached_posts = wp_cache_get($cache_key);

if (false === $cached_posts):
    ob_start();
    if (have_posts()) :
        $post_count = 0;
        while (have_posts()):
            the_post();
            $post_count++;
            $location = get_post_meta(get_the_ID(), 'dp_w_location', true);
            if ($post_count == 1):
                get_template_part('templates/category/large', null, ['location' => $location]);
            else:
                get_template_part('templates/category/small', null, ['location' => $location]);
            endif;
        endwhile;
    endif;
    $cached_posts = ob_get_clean();
    wp_cache_set($cache_key, $cached_posts);
endif;
?>
<main class="content-area">
  <div class="news-sections">
    <div><?php echo eis_news_single_title(); ?></div>
    <div class="category-news-wrapper">
      <div class="flex gap-6">
        <?php echo $cached_posts; ?>
        <?php dpkone_pagination(); ?>
      </div>
    </div>
  </div>
  <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>