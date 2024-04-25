<article class="col-start-1 row-start-1	col-span-3 row-span-2 relative shadow-md">
  <div class="w-full h-full overflow-hidden">
    <!-- <img src="https://dainikpurbokone.net/wp-content/uploads/2020/04/moon-2304-1.jpg" alt="" class="w-full h-full object-cover hover:scale-110 duration-500" /> -->
    <?php the_post_thumbnail(array(640, 430), ["class" => "w-full h-full object-cover hover:scale-110 duration-500"]); ?>
  </div>
  <div class="absolute flex gap-1 bottom-0 flex-col w-full p-6">
    <h2 class="text-white"><?php the_title() ?></h2>
    <div class="flex justify-between text-white">
      <span><?php the_date('M j, Y') ?></span>
      <span><?php the_category(' ') ?></span>
    </div>
  </div>
</article>