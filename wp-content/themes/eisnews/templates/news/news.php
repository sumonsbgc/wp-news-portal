<?php $classes = $args['bgColor'] . ' ' . $args['borderColor']; ?>

<article class="border-b-2 shadow-md <?php echo $classes; ?>">
  <div class="relative">
    <!-- <img src="https://dainikpurbokone.net/wp-content/uploads/2020/04/moon-2304-1.jpg" alt="" class="w-full h-full object-cover" /> -->
    <?php the_post_thumbnail(array(640, 430), ["class" => "w-full h-full object-cover"]); ?>
  </div>
  <div class="">
    <div class="flex justify-between border-black/20 border-b py-1 px-1">
      <div class="text-blue flex gap-1 items-center">
        <?php echo get_svg_icon('clock'); ?>
        <span><?php echo get_the_date('M j, Y'); ?></span>
      </div>
      <span class="text-blue"><?php echo get_the_date('H:i a'); ?></span>
<!-- ৩:৪১ অপরাহ্ণ -->
    </div>
    <h4 class="py-2 px-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
  </div>
</article>