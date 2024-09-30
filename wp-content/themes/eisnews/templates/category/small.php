<div class="bg-white rounded-lg shadow w-full">
  <a href="<?php the_permalink(); ?>" class="block h-36">
    <?php the_post_thumbnail('', ['class' => 'w-full h-full mb-2 rounded-tl rounded-tr', 'alt' => 'news Image']); ?>
  </a>
  <p class="text-sm text-white mb-2 p-2 bg-black/30"><?php echo get_the_date('j F, Y h:i:s'); ?></p>
  <h4 class="font-medium p-2">
    <a href="<?php the_permalink(); ?>" class="text-base hover:text-blue-600"><?php the_title(); ?></a>
  </h4>
</div>


<!-- <p class="text-sm text-gray-600 mb-4">
  <?php
  // echo $location ? $location : ''; 
  ?>
</p> -->