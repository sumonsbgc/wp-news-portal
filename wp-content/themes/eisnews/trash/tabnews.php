    <div class="row my-4">
      <div class="tab_news_container">
        <ul class="tab_filter">
          <li>
            <a href="javascript:void(0)" data-filter="chattogram" class="link filter_bg_pink active">চট্টগ্রাম</a>
          </li>
          <li>
            <a href="javascript:void(0)" data-filter="national" class="link filter_bg_yellow">জাতীয়</a>
          </li>
          <li>
            <a href="javascript:void(0)" data-filter="international" class="link filter_bg_green">আন্তর্জাতিক</a>
          </li>
        </ul>
        <div class="tab_content_area">

          <div id="chattogram" class="active tab_content bd_top_pink">
          <?php
            $q = new WP_Query(['posts_per_page' => 5, 'category_name' => 'chattogram']);
            while ($q->have_posts()) {
              $q->the_post();
              if (0 === $q->current_post) {
                get_template_part("templates/tab-large-news");
              } else {
                get_template_part("templates/tab-news");
              }
            }
            ?>
            <a href="<?php echo eis_get_category_link("chattogram"); ?>" class="more pink">আরোও <i class="fas fa-angle-double-right"></i></a>
          </div>

          <div id="national" class="tab_content bd_top_yellow">
          </div>
          <div id="international" class="tab_content bd_top_green">
          </div>
        </div>
      </div>
    </div>