<?php

class MainNews extends WP_Widget
{

    public function __construct()
    {
        // actual widget processes
        $options = array(
            'classname'   => 'main_news_widgets',
            'description' => 'Main News Widget Descriptions',
        );
        parent::__construct('eis_main_news_widget', 'Main News Widget', $options);
        $this->init();
    }

    public function init()
    {
        add_action('widgets_init', function () {
            register_widget(__CLASS__);
        });
    }

    public function form($instance)
    {
        if (!isset($instance['category']) && empty($instance['category'])) {
            $selected_category = "main-news";
        } else {
            $selected_category = $instance['category'];
        }
        $categories = get_categories();

        printf('<p>');
        printf('<label for="%s">Select a Category:</label>', $this->get_field_id('category'));
        printf('<select class="widefat" id="%s" name="%s">', esc_attr($this->get_field_id('category')), esc_attr($this->get_field_name('category')));
        foreach ($categories as $category) :
            printf('<option value="%s" %s>', esc_attr($category->slug), selected($selected_category, $category->slug));
            echo esc_html($category->name);
            printf('</option>');
        endforeach;
        printf('</select>');
        printf('</p>');
    }

    public function widget($args, $instance)
    {
        if (!isset($instance['category']) && empty($instance['category'])) {
            $category = "main-news";
        } else {
            $category = $instance['category'];
        }

        $sticky_posts = get_option('sticky_posts');
        $latest_sticky_post_id = array_pop($sticky_posts);
        // wp_die();
        $tax_query = array(
            "relation" => "or",
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $category,
            ),
            array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => 'post-format-sticky',
            ),
        );
        $current_date = date_i18n('Y-m-d');
        $yesterday_date = date_i18n('Y-m-d', strtotime('-1 day'));

        $date_query = array(
            'relation' => 'or',
            array(
                'after' => $current_date,
                'inclusive' => true,
            ),
            array(
                'after' => $yesterday_date,
                'inclusive' => true,
            ),
        );
        $q = new WP_Query(
            array(
                "post_type"         => 'post',
                "posts_per_page"    => 7,
                "no_found_rows" => true,
                "cache_results" => false,
                "update_post_meta_cache" => true,
                "update_post_term_cache" => true,
                "fields" => "ids",
                'tax_query' => $tax_query,
                // 'date_query' => $date_query,
                'orderby' => 'date',
                'order' => 'DESC',
            )
        );

        ?>
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
                while ($q->have_posts()) : $q->the_post();
                    if (is_sticky() && $latest_sticky_post_id === get_the_ID()) {
                        get_template_part('templates/main-news-template/large', 'news');
                    } else {
                        get_template_part('templates/main-news-template/small', 'news');
                    }
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
<?php
    }
}

new MainNews();
