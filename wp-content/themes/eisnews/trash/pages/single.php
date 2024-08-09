<?php

get_header();
$term = get_the_terms($post->ID, 'category');
?>
<?php
if (wp_is_mobile()) {
    echo do_shortcode('[advertise position="placement-mp1"]');
} else {
}
?>
<div class="single-page">
  <div class="row pt-2">
    <!-- main content -->
    <div class="col-lg-9 divider-right eis-col-lg-9">
      <div class="row">
        <div class="col-lg-12">

          <div class="single-page-news">

            <?php

                        if (have_posts()) :
                            while (have_posts()) : the_post();
                                $id = get_the_ID();
                                customSetPostViews(get_the_ID()); //single.php
                                // <!-- mfunc customSetPostViews(get_the_ID()); --><!-- /mfunc -->
                                $reporter = get_post_meta($id, 'dp_reporter_name', true);
                                $top_header_title = get_post_meta($id, 'dp_top_sub_title', true);
                                $bottom_header_title = get_post_meta($id, 'dp_bottom_sub_title', true);
                                $converter = new LanguageConverter();
                                $date = $converter->en2bn(get_the_date('j F, Y | g:i a'));
                        ?>

            <div class="news-content">
              <div class="news-content-thumb">
                <style>
                iframe {
                  width: 100%;
                  height: 100%;
                  overflow: hidden;
                  margin: 0;
                  padding: 0;
                }

                video {
                  width: 100%;
                  height: 100%;
                  margin: 0;
                  padding: 0;
                  overflow: hidden;
                }

                .news-content-thumb {
                  position: relative;
                }

                .caption {
                  background: rgba(0, 0, 0, .5);
                  position: absolute;
                  width: 100%;
                  min-height: 25px;
                  bottom: 55px;
                  color: #fff;
                  line-height: 20px;
                  padding-left: 10px;
                  opacity: 0;
                  transition: all .4s linear;
                }

                .news-content-thumb:hover .caption {
                  opacity: 1;
                  transition: all .4s linear;
                }
                </style>
                <?php
                                        if (has_post_format('video')) :
                                            if (get_post_meta($id, 'video_news_thumb', true)) :
                                                printf('<video controls src="%s" poster="%s"></video>', esc_url(get_post_meta($id, 'video_news_thumb', true)), esc_url('http://dainikpurbokone.net/wp-content/uploads/2019/10/common_purbokone-28-65-42.jpg'));
                                            elseif (get_post_meta($id, 'video_news_url', true)) :
                                                printf('<iframe src="https://www.youtube.com/embed/%s" scrolling="no" target="_parent" frameborder="0" allowfullscreen></iframe>', get_post_meta($id, 'video_news_url', true));
                                            endif;
                                        else :
                                            the_post_thumbnail();
                                        endif;
                                        $caption = get_the_post_thumbnail_caption();
                                        if (!empty($caption) && "" !== $caption) :
                                        ?>
                <div class="caption">
                  <?php echo get_the_post_thumbnail_caption(); ?>
                </div>
                <?php endif; ?>
                <div class="img-date-repoter">
                  <p class="date-time"><?php echo $date ?></p>
                  <p class="repoter"><?php echo $reporter; ?></p>
                </div>
              </div>

              <div class="single_news_titles mt-5">
                <?php
                                        if (isset($top_header_title)) :
                                            printf('<h3 class="sub_title">%s</h3>', $top_header_title);
                                        endif;
                                        ?>
                <h2><?php the_title(); ?></h2>
                <?php
                                        if (isset($bottom_header_title)) :
                                            printf('<h3 class="sub_title">%s</h3>', $bottom_header_title);
                                        endif;
                                        ?>
              </div>
              <p>
                <?php
                                        the_content();

                                        ?>
              </p>
            </div>
            <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            _e("no posts found");
                        endif;
                        ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">

          <?php
                    if (wp_is_mobile()) {
                        echo do_shortcode('[adsforwp id="230219"]');
                    } else {
                        echo do_shortcode('[adsforwp id="230220"]');
                    }
                    ?>

          <div class="social-medias">
            <!-- <h4>শেয়ার করুন : </h4>-->

            <?php echo do_shortcode(''); ?>

            <h4>মন্তব্য দিন : </h4>

            <?php echo do_shortcode('[gs-fb-comments]'); ?>
          </div>

        </div>
      </div>
    </div>

    <!-- side bar -->
    <?php get_sidebar(); ?>
  </div>
  <!-- related post -->
  <div class="row mt-3">
    <div class="col-lg-12">

      <div class="related-post">

        <div class="row">

          <div class="col-lg-12">

            <div class="related-post-title">

              <h4>সম্পর্কিত পোস্ট</h4>

            </div>

          </div>

        </div>

        <div class="row">

          <div class="col-lg-12">
            <div id="all_related_posts" class="owl-carousel owl-theme">
              <?php
                            // date_default_timezone_set("Asia/Dhaka");
                            $args = array(
                                "post_type" => "post",
                                "status" => "publish",
                                "category_name" => $term[0]->slug,
                                "posts_per_page" => -1,
                                "order" => "DESC",
                                "date_query" => array(
                                    array(
                                        'after' => '2 days ago',
                                    ),
                                ),
                            );
                            $q = new WP_Query($args);

                            if ($q->have_posts()) :
                                while ($q->have_posts()) : $q->the_post();
                            ?>
              <div class="single-news">
                <div class="single-news-img">
                  <a href="<?php esc_url(the_permalink()); ?>">
                    <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid news-img"
                      alt="<?php get_bloginfo('name'); ?>">
                  </a>
                  <div class="single-news-img-date-time">
                    <?php
                                                printf('<span class="float-left" style="color: #fff; font-size: 13px; padding-left: 4px;"><i class="far fa-clock mr-1"></i>%s</span> <span class="float-right" style="color: #fff; font-size: 13px; padding-right: 4px;">%s</span>', esc_html(get_the_date('j M, Y')), esc_html(get_the_date('g:i a')));
                                                ?>
                    <!-- <p class="single-date-time"><?php echo get_the_date('j F, Y | g:i a'); ?></p> -->
                    <p class="single-division"><?php get_post_meta(get_the_ID(), 'dp_w_location', true); ?></p>
                  </div>
                </div>
                <div class="single-news-heding">
                  <a href="<?php esc_url(the_permalink()); ?>">
                    <h6><?php the_title() ?></h6>
                  </a>
                </div>
              </div>
              <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                                _e("<h2>no posts found</h2>");
                            endif;

                            ?>
            </div>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

<?php get_footer(); ?>