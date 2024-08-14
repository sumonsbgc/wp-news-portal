<div class="mb-6 flex flex-col lg:flex-row col-span-3">
  <div class="lg:w-1/2 mb-4 lg:mb-0">
    <a href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail('', ['class' => 'w-full h-auto', 'alt' => 'news Image']); ?>
    </a>
  </div>
  <div class="lg:w-1/2 lg:pl-6">
    <h4 class="text-2xl font-bold mb-2">
      <a href="<?php the_permalink(); ?>" class="hover:text-blue-600"><?php the_title(); ?></a>
    </h4>
    <div class="text-base mb-4"><?php the_excerpt(); ?></div>
    <p class="text-black text-base font-medium">
      <?php echo get_the_date('j F, Y h:i:s'); ?>
    </p>
  </div>
</div>


<!-- <?php
      // echo $location ? $location : 'Unknown location'; 
      ?> -->