<?php

function eis_main_news_section_title($title = "Main News", $title_class = null, $cat_class = null)
{
    printf(
        '<div class="main_section_title %2$s">
                <span class="main_section_cat %3$s">%1$s</span>
        </div>',
        strtoupper($title),
        $title_class,
        $cat_class
    );
}

function eis_news_section_title($title = "Category One", $section_class = null, $cat_class = null, $link_class = null)
{
    printf(
        '<div class="section_title %2$s">
            <a href="%5$s" class="section_cat %3$s">%1$s</a>
            <a href="%5$s" class="section_link %4$s">
                আরোও <i class="fas fa-angle-double-right"></i>
            </a>
        </div>',
        strtoupper(eis_get_category_name($title)),
        $section_class,
        $cat_class,
        $link_class,
        eis_get_category_link($title)
    );
}

function eis_display_border($size = 2)
{
    printf('<div class="border-top my-%s"></div>', $size);
}

function eis_section_title($template = null)
{
    if (!is_null($template) && "main_news" === $template) {
        eis_main_news_section_title();
    } else {
        eis_news_section_title();
    }
}

//function query_cache()
//{
//    return [
//        "no_found_rows"          => true,
//        "cache_results"          => false,
//        "update_post_meta_cache" => false,
//        "update_post_term_cache" => false,
//        "orderby"                => "date",
//        "order"                  => "DSC",
//        "fields"                 => "ids",
//    ];
//}

function eis_get_category_name($slug)
{
    $term = get_category_by_slug($slug);
    return $term->name;
}

function eis_get_category_link($slug)
{
    $term = get_category_by_slug($slug);
    return get_category_link($term);
}


function dd($args)
{
    echo "<pre>";
    print_r($args);
    echo "</pre>";
    wp_die();
}
