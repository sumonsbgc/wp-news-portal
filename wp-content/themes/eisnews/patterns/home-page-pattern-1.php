<?php
register_block_pattern(
  'newsportal/home-layout-1',
  array(
    'title'       => __('Homepage Layout 1', 'newsportal'),
    'description' => __('A featured news section with a grid layout.', 'newsportal'),
    'categories'  => array('news'),
    'content'     => '<!-- wp:columns -->
        <div class="wp-block-columns">
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:post-featured-image /-->
                <!-- wp:post-title /-->
                <!-- wp:post-excerpt /-->
            </div>
            <!-- /wp:column -->
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:latest-posts {"postsToShow":4,"displayPostDate":true} /-->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->'
  )
);
