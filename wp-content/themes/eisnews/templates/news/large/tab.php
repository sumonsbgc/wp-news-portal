<?php $classes = $args['bgColor'] . ' ' . $args['borderColor']; ?>

<div class="col-start-1 col-span-2 row-span-2 border-b-2 <?php echo $classes; ?>">
  <div class="news_thumb tab_large_news_thumb">
    <?php
    the_post_thumbnail("medium", ["class" => "img-fluid img"])
    ?>
  </div>
  <div class="news_meta">
    <div class="news_date">
      <?php
      printf(
        '<span class="date"><i class="far fa-clock"></i> %s </span>',
        get_the_date('M j, Y')
      );

      printf(
        '<span class="time">%s</span>',
        get_the_date('H:i')
      );

      ?>
    </div>
  </div>
  <div class="news_title_container">
    <?php
    printf(
      '<h4 class="title">
            <a href="%s">%s</a>
            </h4>',
      get_the_permalink(),
      get_the_title()
    );
    ?>
  </div>
</div>