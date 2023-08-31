<?php get_header(); ?>

<div class="row content_area">
    <div class="col-9 border-right">
        <div class="row" id="main_news">
            <!-- <div class="col-12 py-2">
                <div class="main_section_title bg_black">
                    <div class="main_section_cat bg_secondary_red clip">
                        প্রধান খবর
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="main_news_container">
                    <?php
                    $q = new WP_Query(
                        array(
                            "posts_per_page"    => 7,
                            "post_type"         => 'post',
                            "no_found_rows" => true,
                            "cache_results" => false,
                            "update_post_meta_cache" => false,
                            "update_post_term_cache" => false,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'ignore_sticky_posts' => 0,
                            // "fields" => "ids",
                            // 'category_name' => 'প্রধান খবর',
                            'category_name' => 'main-news',
                            "meta_query" => array(
                                array(
                                    "key"     => "_dpkone_post_type",
                                    "value"   => "main_news",
                                ),
                            ),
                        )
                    );

                    while ($q->have_posts()) : $q->the_post();
                        // dd($q);
                        if ($q->current_post === 0) {
                            get_template_part('templates/large', 'news');
                        } else {
                            get_template_part('templates/small', 'news');
                        }
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div> -->
            <?php
                dynamic_sidebar('main-news');
            ?>
        </div>
        <div class="row">
        <?php
            dynamic_sidebar('two-column-news');
        ?>
        </div>
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

    </div>

    <div class="col-3">
        <?php get_sidebar(); ?>
    </div>

</div>

<?php get_footer(); ?>