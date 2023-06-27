<?php get_header(); ?>

<div class="row content_area">
    <div class="col-9 border-right">
        <div class="row" id="main_news">
            <div class="col-12 py-2">
                <div class="main_section_title bg_black">
                    <div class="main_section_cat bg_secondary_red clip">
                        প্রধান খবর
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="main_news_container">
                    <?php
                    $defaults = array(
                        'per_page' => 8,
                        'order'     => 'DESC',
                        'type'      => 'post',
                        'cat_name'  => 'প্রধান খবর',
                    );
                    $q = new WP_Query(
                        array(
                            "posts_per_page"    => 1,
                            "post_type"         => 'post',
                            "no_found_rows" => true,
                            "cache_results" => false,
                            "update_post_meta_cache" => false,
                            "update_post_term_cache" => false,
                            "orderby" => "date",
                            "order" => "DSC",
                            "fields" => "ids",
                            'category_name' => 'প্রধান খবর',
                            "meta_query" => array(
                                array(
                                    "key"     => "_dpkone_post_type",
                                    "value"   => "main_news",
                                ),
                            ),
                        )
                    );
                    while ($q->have_posts()) : $q->the_post();
                        if ($q->current_post === 0) {
                            get_template_part('templates/large', 'news');
                        } else {
                            get_template_part('templates/small', 'news');
                        }
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>

        <!-- <div class="row" id="category_news">
            <?php
                dynamic_sidebar('one-column-news');
            ?>
        </div>

        <div class="row">
            <?php
            dynamic_sidebar('two-column-news');
            ?>
        </div>


        <div class="row">
            <div class="tab_news_container">
                <ul class="tab_filter">
                    <li>
                        <a href="javascript:void(0)" data-target="cat_one" data-filter="chattogram" data-nonce="<?php echo wp_create_nonce("tabnews"); ?>" class="link filter_pink_bg">চট্টগ্রাম</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" data-target="cat_two" data-filter="national" data-nonce="<?php echo wp_create_nonce("tabnews"); ?>" class="link">জাতীয়</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" data-target="cat_three" data-filter="international" data-nonce="<?php echo wp_create_nonce("tabnews"); ?>" class="link">আন্তর্জাতিক</a>
                    </li>
                </ul>
                <div class="tab_content_area">

                    <div id="cat_one" class="active tab_content bd_top_pink">
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
                        <a href="<?php echo eis_get_category_link("chattogram"); ?>" class="more">আরোও <i class="fas fa-angle-double-right"></i></a>
                    </div>

                    <div id="cat_two" class="tab_content bd_top_yellow">
                    </div>
                    <div id="cat_three" class="tab_content bd_top_green">
                    </div>
                </div>
            </div>
        </div> -->

    </div>

    <div class="col-3">
        <?php get_sidebar(); ?>
    </div>

</div>

<?php get_footer(); ?>