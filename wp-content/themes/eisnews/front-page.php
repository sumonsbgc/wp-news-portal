<?php get_header(); ?>

<main class="content-area">
  <div class="news-sections">
    <div class="grid grid-cols-4 grid-rows-3 gap-4">
      <?php get_template_part('templates/news/large/main'); ?>
      <?php get_template_part('templates/news/small/main'); ?>
      <?php get_template_part('templates/news/small/main'); ?>
      <?php get_template_part('templates/news/small/main'); ?>
      <?php get_template_part('templates/news/small/main'); ?>
      <?php get_template_part('templates/news/small/main'); ?>
      <?php get_template_part('templates/news/small/main'); ?>
    </div>
     
    <div class="grid grid-cols-4 gap-4 my-10">
      <?php for($i=0; $i<4; $i++) : ?>
      <?php get_template_part('templates/news/news', null, ['bgColor' => 'bg-red-50', 'borderColor' => 'border-primary']); ?>
      <?php endfor; ?>
    </div>
  </div>
  <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>