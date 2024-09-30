<?php get_header(); ?>
<main class="content-area">
  <div class="news-sections">
    <?php echo do_shortcode('[main_news]') ?>
    <?php
    echo do_shortcode('
      [two_cat_news]
        [two_rows_news slug="chattogram" bg_color="bg-tile/20" cat_bg_color="bg-tile" border_color="border-b-tile" ]
        [two_rows_news slug="national" bg_color="bg-coal/20" cat_bg_color="bg-coal" border_color="border-b-coal" ]
      [/two_cat_news]');
    ?>

    <?php echo do_shortcode('[one_row_news slug="zila-upazila-gram" bg_color="bg-blue/5" cat_bg_color="bg-blue" border_color="border-b-blue" ]') ?>

    <?php
    echo do_shortcode('
      [two_cat_news]
        [two_rows_news slug="international" bg_color="bg-olive/20" cat_bg_color="bg-olive" border_color="border-b-olive" ]
        [two_rows_news slug="finance-trade" bg_color="bg-carrot/5" cat_bg_color="bg-carrot" border_color="border-b-carrot" ]
      [/two_cat_news]');
    ?>

    <?php echo do_shortcode('[one_row_news slug="sports" bg_color="bg-blue/5" cat_bg_color="bg-blue" border_color="border-b-blue" ]') ?>

    <?php echo create_ajax_tabs(get_tab_two_data()); ?>

  </div>
  <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>