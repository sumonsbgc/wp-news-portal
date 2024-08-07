<article class="border-b-2 border-primary bg-red-50 shadow-md">
  <div class="relative">
    <?php the_post_thumbnail(array(640, 430), ["class" => "w-full h-full object-cover"]); ?>
    <span class="absolute bottom-0 left-1 bg-red-secondary px-1 pt-1 mb-1 rounded-md text-white text-sm">
      <?php the_category(' '); ?>
    </span>
  </div>
  <div class="">
    <h4 class="py-2 px-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
  </div>
</article>