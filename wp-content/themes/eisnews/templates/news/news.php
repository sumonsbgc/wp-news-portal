<?php $classes = $args['bgColor'] . ' ' . $args['borderColor']; ?>

<article class="border-b-2 shadow-md <?php echo $classes; ?>">
  <div class="relative">
    <?php the_post_thumbnail(array(640, 430), ["class" => "w-full h-full object-cover"]); ?>
  </div>
  <div class="">
    <div class="flex justify-between border-black/20 border-b py-1 px-1">
      <div class="flex gap-1 items-center">
        <?php echo get_svg_icon('clock'); ?>
        <span class="text-sm text-blue"><?php echo get_the_date('M j, Y'); ?></span>
      </div>
      <span class="text-blue text-sm"><?php echo get_the_date('H:i a'); ?></span>
      <!-- ৩:৪১ অপরাহ্ণ -->
    </div>
    <h4 class="py-2 px-1"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo eis_short_title(get_the_title(), 20); ?></a></h4>
  </div>
</article>