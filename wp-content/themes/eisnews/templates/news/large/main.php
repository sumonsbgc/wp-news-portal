<article class="col-start-1 row-start-1	sm:col-span-3 col-span-2 row-span-2 relative shadow-md">
  <div class="w-full h-full overflow-hidden">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="w-full h-full block">
      <?php the_post_thumbnail(array(640, 430), ["class" => "w-full h-full object-cover hover:scale-110 duration-500"]); ?>
    </a>
  </div>
  <div class="absolute flex gap-1 bottom-0 flex-col w-full p-6 bg-gradient-to-b bg-blend-color-burn" style="background: linear-gradient(180deg, rgba(1,2,3, .5), transparent);">
    <h2 class="text-white">
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
      </a>
    </h2>
    <div class="flex justify-between text-white">
      <span><?php the_date('M j, Y') ?></span>
      <span><?php the_category(' ') ?></span>
    </div>
  </div>
</article>