<?php

function eis_newsTicker($atts, $content)
{

    $defaults = array(
        'type' => 'post',
        'per_page' => -1,
        'order' => 'DESC',
    );

    $data = shortcode_atts($defaults, $atts, 'newsticker');
    date_default_timezone_set("Asia/Dhaka");
    $today = getdate();

    $q = new WP_Query(array(
        "post_type"         => $data['type'],
        "posts_per_page"    => $data['per_page'],
        "no_found_rows" => true,
        "cache_results" => false,
        "update_post_meta_cache" => false,
        "update_post_term_cache" => false,
        "orderby" => "date",
        "order" => "DSC",
        "fields" => "ids",
        "meta_query" => array(
            array(
                "key"     => "_dpkone_post_type",
                "value"   => "breaking_news",
            ),
        ),
        "date_query" => array(
            array(
                "year"  => $today['year'],
                "month" => $today['mon'],
                "day"   => $today['mday'],
            ),
        ),
    ));

    $html = '';
    $html .= '<div class="dpkone_newsTicker">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="newsticker_container fix">';

    $html .= '<div class="newsticker_title float-left">';
    $html .= sprintf('<h3 class="headline">%s</h3>', 'সর্বশেষ:');
    $html .= '</div>';
    $html .= '<div class="newsticker_content float-left">';
    $html .= '<div class="TickerNews" id="T1">
                                    <div class="ti_wrapper">
                                        <div class="ti_slide">
                                            <div class="ti_content">';
    while ($q->have_posts()) : $q->the_post();
        $id = get_the_ID();
        $html .= sprintf('<div class="ti_news"><a href="%s"><i class="icofont-rounded-double-right"></i> %s</a></div>', esc_url(get_permalink()), esc_html(get_the_title()));
    endwhile;

    $html .= '</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>';



    wp_reset_postdata();

    return $html;
}
add_shortcode('newsticker', 'eis_newsTicker');

function eis_main_news_content($atts, $content)
{
    $defaults = array(
        'per_page' => 8,
        'order'     => 'DESC',
        'type'      => 'post',
        'cat_name'  => 'প্রধান খবর',
    );

    $data = shortcode_atts($defaults, $atts, 'main_news');

    $today = getdate();

    $q = new WP_Query(
        array(
            "posts_per_page"    => $data['per_page'],
            "post_type"         => $data['type'],
            "no_found_rows" => true,
            "cache_results" => false,
            "update_post_meta_cache" => false,
            "update_post_term_cache" => false,
            "orderby" => "date",
            "order" => "DSC",
            "fields" => "ids",
            "meta_query" => array(
                array(
                    "key"     => "_dpkone_post_type",
                    "value"   => "main_news",
                ),
            ),
            // 'date_query' => array(
            //     array(
            //         'year'  => $today['year'],
            //         'month' => $today['mon'],
            //         'day'   => $today['mday'],
            //     ),
            // ),
        )
    );

    $slug = get_category_by_slug($data["cat_name"]);
    $html = '';

    $html .= '<div class="row mb-2">
        <div class="col-lg-12">
            <div class="news_category_head main_news_head fix">
                <a class="float-left" href="#">
                    ' . $slug->name . '
                </a>                                    
            </div>
        </div>
    </div>
    
    <div class="row">';
    while ($q->have_posts()) : $q->the_post();
        $id = get_the_ID();
        $cats = get_the_category($id);
        $cat_name = $cats[0]->cat_name;
        $cat_id = get_cat_ID($cat_name);
        $cat_link = get_category_link($cat_id);
        $title = get_the_title($id);
        $meta = get_post_meta($id, '_dpkone_post_type');
        // print_r(in_array('pin_post', $meta)  ? 'PIN POST': 'OTHER');
        $img = get_the_post_thumbnail($id, 'full', array("class" => "img-fluid", 'alt' => $title));

        if (0 == $q->current_post) :
            $html .= '<div class="col-lg-9">                                                                 
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="main_news main_news_relative ">                                    
                            <div class="main_news_thumb main_news_overlay">';
            $html .=              sprintf($img);
            $html .=        '</div><div class="main_news_content">';
            $html .=         sprintf('<h3 class="%s"><a href="%s">%s</a></h3>', esc_attr('main_news_title'), esc_url(get_permalink()), $title);

            $html .=        '<p>';
            $html .=            sprintf('<span class="news_date"><i class="icofont-clock-time"></i> %s</span> ', esc_html(get_the_date()));
            $html .=            '<span class="float-right">';
            $html .=                sprintf('<a href="%s">%s</a>', $cat_link, $cat_name);
            $html .=            '</span>
                            </p>
                        </div>
                        </div>                                
                    </div>';

        elseif ($q->current_post > 0 && $q->current_post < 4) :
            $html .=   '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="main_news main_cat_news">
                            <div class="main_news_thumb main_news_small_thumb">';
            $html .=            '<div class="main_small_img">';
            $html .=                sprintf($img);
            $html .=            '</div>';
            $html .=            '<span class="cat">';
            $html .=                sprintf('<a href="%s">%s</a>', $cat_link, $cat_name);
            $html .=            '</span>';
            $html .=        '</div>
                            <div class="main_news_content">';
            // $html .=        '<p>';
            // $html .=            sprintf('<span class="news_date">%s</span> ', esc_html(get_the_date()) );
            // $html .=        '</p>';
            $html .=         sprintf('<h4 class="%s"><a href="%s">%s</a></h4>', esc_attr('main_news_title'), esc_url(get_permalink()), $title);
            $html .=      '</div>
                        </div>                                
                    </div>';
        elseif (4 == $q->current_post) :
            $html .= '</div>
                    </div>
                <div class="col-lg-3">
                <div class="row">';
        elseif ($q->current_post > 3 && $q->current_post > 3) :
            $html .=   '<div class="col-lg-12 col-md-4 col-sm-4 col-xs-12 mb-3">
                        <div class="main_news main_cat_news">
                            <div class="main_news_thumb main_news_small_thumb">';
            $html .=            '<div class="main_small_img">';
            $html .=                sprintf('%s', $img);
            $html .=            '</div>';
            $html .=            '<span class="cat">';
            $html .=                sprintf('<a href="%s">%s</a>', $cat_link, $cat_name);
            $html .=            '</span>';
            $html .=        '</div>
                            <div class="main_news_content">';
            // $html .=        '<p>';
            // $html .=            sprintf('<span class="news_date">%s</span> ', esc_html(get_the_date()) );
            // $html .=                    '</p>';
            $html .=         sprintf('<h4 class="%s"><a href="%s">%s</a></h4>', esc_attr('main_news_title'), esc_url(get_permalink()), $title);
            $html .=      '</div>
                        </div>                                
                    </div>';

        endif;
        wp_reset_postdata();
    endwhile;

    $html .= '</div>
            </div>
        </div>';
    return $html;
}
add_shortcode('main_news', 'eis_main_news_content');

function eis_two_sides_cat_news($attr, $content)
{
    $defaults = array(
        'per_page'  => 4,
        'type'      => 'post',
        'cat_one'   => 'চট্টগ্রাম',
        'cat_two'   => 'জাতীয়',
        "class_one" => "category_one",
        "class_two" => "category_two",
    );

    $data = shortcode_atts($defaults, $attr, 'two_sides_news');

    $q = new WP_Query(array(
        "posts_per_page"    => $data['per_page'],
        "post_type"         => $data['type'],
        "category_name"     => $data['cat_one'],
        "no_found_rows" => true,
        "cache_results" => false,
        "update_post_meta_cache" => false,
        "update_post_term_cache" => false,
        "orderby" => "date",
        "order" => "DSC",
        "fields" => "ids",
    ));

    $slug = get_category_by_slug($data["cat_one"]);

    $cat_id = get_cat_ID($slug->name);
    $cat_link = get_category_link($cat_id);

    $html = '';
    $html .= '<div class="row mb-3">
                    <div class="col-lg-6">
                        <div class="row my-2">
                            <div class="col-lg-12 fix">
                                <div class="news_category_head ' . $data['class_one'] . '_link fix">
                                    <a class="float-left" href="' . $cat_link . '">' . $slug->name . '</a>
                                    <a class="float-right" href="' . $cat_link . '"> আরোও <i class="icofont-rounded-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row ' . $data['class_one'] . '_section">';
    while ($q->have_posts()) : $q->the_post();
        $id = get_the_ID();
        $cats = get_the_category($id);
        $cat_name = $cats[0]->cat_name;
        $cat_id = get_cat_ID($cat_name);
        $cat_link = get_category_link($cat_id);


        $title = get_the_title($id);

        $img = get_the_post_thumbnail($id, 'full', array("class" => "img-fluid", 'alt' => $title));



        $html .= '<div class="col-lg-6 col-md-4 col-sm-6 mb-4">

                                <div class="main_news cat_news ">

                                    <div class="main_news_thumb">'
            . $img;
        $html .=        '</div>

                                    <div class="main_news_content">                                       

                                    <p class="fix px-2">';

        $html .=          sprintf('<span class="float-left"><i class="far fa-clock mr-1"></i>%s</span> <span class="float-right">%s</span>', esc_html(get_the_date()), esc_html(get_the_date('g:i a')));

        $html .=        '</p>';

        $html .=            sprintf('<h4 class="%s"><a href="%s">%s</a></h4>', esc_attr("main_news_title"), esc_url(get_permalink()), $title);
        $html .=        '</div>
                                </div>
                            </div>';
    endwhile;
    wp_reset_postdata();
    $html .= '</div>
                </div>';

    $qn = new WP_Query(array(
        "posts_per_page"    => $data['per_page'],
        "post_type"         => $data['type'],
        "category_name"     => $data['cat_two'],
        "no_found_rows" => true,
        "cache_results" => false,
        "update_post_meta_cache" => false,
        "update_post_term_cache" => false,
        "orderby" => "date",
        "order" => "DSC",
        "fields" => "ids",
    ));

    $slug = get_category_by_slug($data["cat_two"]);
    $cat_id_two = get_cat_ID($slug->name);
    $cat_link_two = get_category_link($cat_id_two);

    $html .= '<div class="col-lg-6">
                    <div class="row my-2">
                        <div class="col-lg-12">
                            <div class="news_category_head ' . $data['class_two'] . '_link fix">
                                <a class="float-left" href="' . $cat_link_two . '">' . $slug->name . '</a>
                                <a class="float-right" href="' . $cat_link_two . '"> আরোও <i class="icofont-rounded-double-right"></i></a>
                            </div>
                        </div>
                    </div>                        

                    <div class="row ' . $data['class_two'] . '_section">';
    while ($qn->have_posts()) : $qn->the_post();
        $id = get_the_ID();
        $cats = get_the_category($id);
        $cat_name = $cats[0]->cat_name;
        $cat_id = get_cat_ID($cat_name);
        $cat_link = get_category_link($cat_id);

        $title = get_the_title($id);

        $img = get_the_post_thumbnail($id, 'full', array("class" => "img-fluid", 'alt' => $title));

        $html .= '<div class="col-lg-6 col-md-4 col-sm-6 mb-4">
                        <div class="main_news cat_news">
                            <div class="main_news_thumb">';
        $html .=         $img;
        $html .=       '</div>

                            <div class="main_news_content">                                        

                            <p class="fix px-2">';

        $html .=                sprintf('<span class="float-left"><i class="far fa-clock mr-1"></i>%s</span> <span class="float-right">%s</span>', esc_html(get_the_date()), esc_html(get_the_date('g:i a')));

        $html .=        '</p>';

        $html .=            sprintf('<h4 class="%s"><a href="%s">%s</a></h4>', esc_attr("main_news_title"), esc_url(get_permalink()), $title);

        $html .=   '</div>

                    </div>

                </div>';

    endwhile;



    wp_reset_postdata();

    $html .= '</div>

            </div>

        </div>';

    return $html;
}
add_shortcode('two_sides_news', 'eis_two_sides_cat_news');


function eis_single_cat_news($attr, $content)
{
    $defaults = array(
        'per_page'  => 4,
        'type'      => 'post',
        'cat'   => 'খেলাধুলা',
        'class_one' => 'category_five'
    );

    $data = shortcode_atts($defaults, $attr, 'single_row_cat');

    $q = new WP_Query(array(
        "posts_per_page"    => $data['per_page'],
        "post_type"         => $data['type'],
        "category_name"     => $data['cat'],
        "no_found_rows" => true,
        "cache_results" => false,
        "update_post_meta_cache" => false,
        "update_post_term_cache" => false,
        "orderby" => "date",
        "order" => "DSC",
        "fields" => "ids",
    ));

    $slug = get_category_by_slug($data["cat"]);
    $cat_id = get_cat_ID($slug->name);
    $cat_link = get_category_link($cat_id);
    $html = '';
    if ('বিনোদন ও শিল্পকলা' == $data['cat']) :
        $html .= '<div class="row mb-3 tech-slideshow">
                <div class="col-lg-12 mover-1 overflow">';
    else :
        $html .= '<div class="row mb-3">
                <div class="col-lg-12">';
    endif;

    $html .=     '<div class="row mt-2">
                        <div class="col-lg-12 fix">                                
                            <div class="news_category_head ' . $data['class_one'] . '_link fix">
                                <a class="float-left" href="' . $cat_link . '">' . $slug->name . '</a>
                                <a class="float-right" href="' . $cat_link . '"> আরোও <i class="icofont-rounded-double-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row ' . $data['class_one'] . '_section pt-4">';

    while ($q->have_posts()) : $q->the_post();
        $id = get_the_ID();
        $cats = get_the_category($id);

        $cat_name = $cats[0]->cat_name;

        $cat_id = get_cat_ID($cat_name);

        $cat_link = get_category_link($cat_id);



        $title = get_the_title($id);

        $img = get_the_post_thumbnail($id, 'medium', array("class" => "img-fluid", 'alt' => $title));



        $html .= '<div class="col-md-3 col-sm-6 mb-4">

                                <div class="main_news cat_news ">

                                    <div class="main_news_thumb">';

        $html .=           sprintf($img);

        $html .=        '</div>

                        <div class="main_news_content">                                       

                            <p class="fix px-2">';

        $html .=                sprintf('<span class="float-left"><i class="far fa-clock mr-1"></i>%s</span> <span class="float-right">%s</span>', esc_html(get_the_date()), esc_html(get_the_date('g:i a')));

        $html .=            '</p>';

        $html .=            sprintf('<h4 class="%s"><a href="%s">%s</a></h4>', esc_attr("main_news_title"), esc_url(get_permalink()), $title);

        $html .=        '</div>

                                </div>

                            </div>';

    endwhile;

    wp_reset_postdata();

    $html .= '</div>
                </div>

                </div>';

    return $html;
}
add_shortcode('single_row_cat', 'eis_single_cat_news');


function eis_category_tab_news($atts, $content)
{

    $data = shortcode_atts(
        array(
            'per_page'  => 15,
            'type'      => 'post',
            'cats'      => 'প্রবাস, ভ্রমণ, রাশি',
            'order'     => 'DESC'
        ),
        $atts,
        'tab_news'
    );

    $cats_name = explode(', ', $data['cats']);
    $cats_id = [];

    foreach ($cats_name as $cat) {
        array_push($cats_id, get_cat_ID($cat));
    }

    $html = '';
    $html .= '<div class="row py-5">
                <div id="tabs">
                    <ul class="title-before">';
    foreach ($cats_name as $name) :
        $slug = get_category_by_slug($name);
        $html .= '<li><a href="#nav-cat-' . get_cat_ID($slug->name) . '">' . $slug->name . '</a></li>';
    endforeach;
    $html .= '</ul>';

    foreach ($cats_name as $name) :
        $slug = get_category_by_slug($name);
        $html .= '<div id="nav-cat-' . get_cat_ID($slug->name) . '">
                            <a class="tab_cat_more" href="' . get_category_link(get_cat_ID($slug->name)) . '"> আরোও <i class="icofont-rounded-double-right"></i></a>
                            <div class="row my-2">';

        $q = new WP_Query(array(
            "post_type"         => esc_html($data['type']),
            "posts_per_page"    => 5,
            "category_name"      => $name,
            "no_found_rows" => true,
            "cache_results" => false,
            "update_post_meta_cache" => false,
            "update_post_term_cache" => false,
            "orderby" => "date",
            "order" => "DSC",
            "fields" => "ids",
        ));

        while ($q->have_posts()) : $q->the_post();
            $id     = get_the_ID();
            $title  = get_the_title($id);
            $img    = get_the_post_thumbnail($id, '', array('class' => 'img-fluid', 'alt' => $title));
            $link   = get_permalink();
            $date   = get_the_date("F j, Y | g:i a ");
            if ($q->current_post % 2 == 0) {
                $pd = "pl-1";
            } else {
                $pd = "pr-1";
            }

            if (0 == $q->current_post) :
                $html .= '<div class="col-lg-6 mb-3 tab-left-padding">
                                    <div class="left-feed-content">
                                        <div class="left-news-feed-thumb">
                                            <div class="overlay"></div>
                                            <a href="' . $link . '">
                                                ' . $img . '
                                            </a>
                                        </div>

                                        <div class="left-news-feed-content">
                                            <h2 class="m-3">
                                                <a href="' . $link . '">' . $title . '</a>
                                            </h2>';
                $html .=  sprintf('<span class="float-left"><i class="far fa-clock mr-1"></i>%s</span> <span class="float-right">%s</span>', esc_html(get_the_date()), esc_html(get_the_date('g:i a')));
                $html .=    '</div>
                                    </div>
                                </div>';

            elseif (1 == $q->current_post) :
                $html .= '<div class="col-lg-6 col-md-12 tab-right-padding">
                                    <div class="right-feed-content">
                                        <div class="row">';
                $html .= '<div class="col-lg-6 col-md-4 col-sm-6 mb-3 col-6 ' . $pd . '">
                                                <div class="cat-tab-item box_shadow">
                                                    <div class="right-news-feed-thumb">
                                                        <a href="' . $link . '">
                                                            ' . $img . '
                                                        </a>
                                                    </div>
                                                    <div class="right-news-feed-content">
                                                        <p class="fix px-1">';
                $html .= sprintf('<span class="float-left"><i class="far fa-clock mr-1"></i>%s</span> <span class="float-right">%s</span>', esc_html(get_the_date()), esc_html(get_the_date('g:i a')));
                $html .= '</p>
                                                        <h3 class="mt-1">
                                                            <a href="' . $link . '">' . $title . '</a>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>';
            elseif ($q->current_post >= 1 && $q->current_post <= 5) :
                $html .= '<div class="col-lg-6 col-md-4 col-sm-6 mb-3 col-6 ' . $pd . '">
                                                <div class="cat-tab-item box_shadow">
                                                    <div class="right-news-feed-thumb">
                                                        <a href="' . $link . '">
                                                            ' . $img . '
                                                        </a>
                                                    </div>
                                                    <div class="right-news-feed-content">
                                                        <p class="fix px-1">';
                $html .= sprintf('<span class="float-left"><i class="far fa-clock mr-1"></i>%s</span> <span class="float-right">%s</span>', esc_html(get_the_date()), esc_html(get_the_date('g:i a')));
                $html .= '</p>
                                                        <h3 class="mt-1">
                                                            <a href="' . $link . '">' . $title . '</a>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>';
            endif;
        endwhile;
        wp_reset_postdata();
        $html   .= '</div>
                                 </div>
                            </div></div>
                        </div>';
    endforeach;
    $html .= '</div>
                </div>';
    return $html;
}
add_shortcode('tab_news', 'eis_category_tab_news');

function eis_second_category_tab_news($atts, $content)
{

    $data = shortcode_atts(
        array(
            'type'      => 'post',
            'cats'      => 'প্রবাস, ভ্রমণ, রাশি',
            'order'     => 'DESC'
        ),
        $atts,
        'second_tab_news'
    );

    $cats_name = explode(', ', $data['cats']);
    $cats_id = [];

    foreach ($cats_name as $cat) {
        array_push($cats_id, get_cat_ID($cat));
    }

    $html = '';
    $html .= '<div class="row py-5">
                <div id="tabs-2">
                    <ul class="title-before">';
    foreach ($cats_name as $name) :
        $slug = get_category_by_slug($name);
        $html .= '<li><a href="#nav-cat-' . get_cat_ID($slug->name) . '">' . $slug->name . '</a></li>';
    endforeach;
    $html .= '</ul>';

    foreach ($cats_name as $name) :
        $slug = get_category_by_slug($name);
        $html .= '<div id="nav-cat-' . get_cat_ID($slug->name) . '">
                            <a class="tab_cat_more" href="' . get_category_link(get_cat_ID($slug->name)) . '"> আরোও <i class="icofont-rounded-double-right"></i></a>
                            <div class="row my-2">';

        $q = new WP_Query(array(
            "post_type"         => esc_html($data['type']),
            "posts_per_page"    => 5,
            "category_name"      => $name,
            "no_found_rows" => true,
            "cache_results" => false,
            "update_post_meta_cache" => false,
            "update_post_term_cache" => false,
            "orderby" => "date",
            "order" => "DSC",
            "fields" => "ids",            
        ));

        while ($q->have_posts()) : $q->the_post();
            $id     = get_the_ID();
            $title  = get_the_title($id);
            $img    = get_the_post_thumbnail($id, '', array('class' => 'img-fluid', 'alt' => $title));
            $link   = get_permalink();
            $date   = get_the_date("F j, Y | g:i a ");
            if (0 == $q->current_post) :
                $html .= '<div class="col-lg-6 mb-3 tab-left-padding">
                                    <div class="left-feed-content">
                                        <div class="left-news-feed-thumb">
                                            <div class="overlay"></div>
                                            <a href="' . $link . '">
                                                ' . $img . '
                                            </a>
                                        </div>
                                        
                                        <div class="left-news-feed-content">
                                            <h2 class="m-3">
                                                <a href="' . $link . '">' . $title . '</a>
                                            </h2>';
                $html .=  sprintf('<span class="float-left"><i class="far fa-clock mr-1"></i>%s</span> <span class="float-right">%s</span>', esc_html(get_the_date()), esc_html(get_the_date('g:i a')));
                $html .=    '</div>
                                    </div>
                                </div>';

            elseif ($q->current_post > 0 && 1 == $q->current_post) :
                $html .= '<div class="col-lg-6 col-md-6 col-sm-12 tab-right-padding">
                                    <div class="right-feed-content">
                                        <div class="row">';
                $html .= '<div class="col-lg-6 col-md-4 col-sm-6 mb-3">
                                        <div class="cat-tab-item box_shadow">
                                            <div class="right-news-feed-thumb">
                                                <a href="' . $link . '">
                                                    ' . $img . '
                                                </a>
                                            </div>
                                            <div class="right-news-feed-content">
                                                <p class="fix px-1">';
                $html .= sprintf('<span class="float-left"><i class="far fa-clock mr-1"></i>%s</span> <span class="float-right">%s</span>', esc_html(get_the_date()), esc_html(get_the_date('g:i a')));
                $html .= '</p>
                                                <h3 class="mt-1">
                                                    <a href="' . $link . '">' . $title . '</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>';
            elseif ($q->current_post >= 1 && $q->current_post <= 5) :
                $html .= '<div class="col-lg-6 col-md-4 col-sm-6 mb-3">
                            <div class="cat-tab-item box_shadow">
                                <div class="right-news-feed-thumb">
                                    <a href="' . $link . '">
                                        ' . $img . '
                                    </a>
                                </div>
                                <div class="right-news-feed-content">
                                    <p class="fix px-1">';
                $html .= sprintf('<span class="float-left"><i class="far fa-clock mr-1"></i>%s</span> <span class="float-right">%s</span>', esc_html(get_the_date()), esc_html(get_the_date('g:i a')));
                $html .= '</p>
                                    <h3 class="mt-1">
                                        <a href="' . $link . '">' . $title . '</a>
                                    </h3>
                                </div>
                            </div>
                        </div>';
            endif;
        endwhile;
        wp_reset_postdata();
        $html   .= '</div>
                                 </div>
                            </div></div>
                        </div>';
    endforeach;
    $html .= '</div>
                </div>';
    return $html;
}
add_shortcode('second_tab_news', 'eis_second_category_tab_news');

function eis_create_border_bottom($atts, $content)
{

    $defaults = array(

        'class' => 'main_new_bl',

        'id'    => 'main_new_bl',

        'style' => ''

    );

    $data = shortcode_atts($defaults, $atts, 'bl');



    $html = sprintf('<div class="%s" id="%s" style="%s"> </div>', $data['class'], $data['id'], $data['style']);

    return $html;
}
add_shortcode('bl', 'eis_create_border_bottom');

function three_column_content($atts)
{

    $data = shortcode_atts(
        array(
            'per_page'  => 5,
            'type'      => 'post',
            'cats'      => 'শিক্ষা, স্বাস্থ্য, তথ্য প্রযুক্তি',
            'order'     => 'DESC'
        ),
        $atts,
        'tab_news'
    );
    $cats = explode(',', $data['cats']);

    // $cats_id = [];
    // foreach($cats_name as $cat ){
    //     array_push($cats_id, get_cat_ID($cat));
    // }

    $html = '<div class="row justify-content-center">';
    $num = 1;
    foreach ($cats as $cat) :
        $slug = get_category_by_slug($cat);
        $cat_link = get_category_link(get_cat_ID($slug->name));
        $html .= '<div class="col-lg-4 col-md-4 col-sm-6 my-3">
                <div class="news_category_head tc-cat-' . $num . '-link fix mb-1">
                    <a class="float-left" href="' . $cat_link . '">' . $slug->name . '</a>
                    <a class="float-right" href="' . $cat_link . '"> আরোও <i class="icofont-rounded-double-right"></i></a>
                </div>
                <div class="col-news-body">';
        $num++;

        $q = new WP_Query(array(
            "posts_per_page" => $data['per_page'],
            "post_type" => $data['type'],
            "category_name" => $cat,
            "no_found_rows" => true,
            "cache_results" => false,
            "update_post_meta_cache" => false,
            "update_post_term_cache" => false,
            "orderby" => "date",
            "order" => "DSC",
            "fields" => "ids",
        ));

        while ($q->have_posts()) : $q->the_post();
            $id = get_the_ID();
            $thumb = get_the_post_thumbnail($id, 'thumbnail', array('class' => 'img-fluid', 'alt' => 'col-news-img'));
            $title = get_the_title();
            $link = get_the_permalink();

            if ($q->current_post == 0) :
                $html .= '<div class="col-top-news">
                <a href="' . $link . '">
                    <div class="top_news_thumb">
                    ' . $thumb . '
                    </div>
                    <div class="col-top-news-meta fix">
                        <p>' . get_the_date() . '</p>
                        <span>' . get_the_date('g:i a') . '</span>
                    </div>
                    <h4>' . $title . '</h4>
                </a>
            </div>';
            else :
                $html .= '<div class="col-news">
                <div class="row column-3-container">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 pr-1">
                        <a href="' . $link . '" class="col-img">
                            ' . $thumb . '
                        </a>
                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-8 col-8 pl-1">
                        <a href="' . $link . '">
                        <h4>' . $title . '</h4>
                        <div class="col-news-meta fix">
                            <p>' . get_the_date() . '</p>
                            <span>' . get_the_date('g:i a') . '</span>
                        </div>
                        </a>
                    </div>
                </div>
            </div>';
            endif;
        endwhile;

        $html .= '<a href="' . $cat_link . '" class="' . $cat . '-more-news">আরো পড়ুন</a>';
        $html .= '</div>
            </div>';
    endforeach;

    $html .= '</div>';

    wp_reset_postdata();

    return $html;
}
add_shortcode('col_three', 'three_column_content');



function displayAdvertise($atts)
{
    $defaults = [
        'post_type' => 'advertise',
        'per_page' => 1,
        'position' => '',
    ];

    $data = shortcode_atts($defaults, $atts, 'advertise');

    $q = new WP_Query([
        'post_type' => $data['post_type'],
        'posts_per_page' => $data['per_page'],
        'meta_query' => [
            [
                'key' => '_dpkone_ad_position',
                'value' => $data['position'],
            ]
        ]
    ]);
    $html = '';
    $html .= '<div class="row my-1">
                    <div class="col-lg-12">';
    while ($q->have_posts()) : $q->the_post();
        $ad_type = get_post_meta(get_the_ID(), '_dpkone_ad_type', true);
        if ($ad_type == 'local') :
            $html .= '<div class="addVertise">
                                ' . html_entity_decode(get_the_content()) . '
                            </div>';
        else :
            $html .= '<div class="addVertise">
                            ' . html_entity_decode(get_the_content()) . '
                        </div>';
        endif;
    endwhile;
    $html .= '</div>
    </div>';
    wp_reset_postdata();
    return $html;
}
add_shortcode('advertise', 'displayAdvertise');
