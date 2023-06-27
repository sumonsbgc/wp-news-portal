<?php
get_header();

while (have_posts()) {
    the_post();
    if (has_post_thumbnail()) {
        printf(
            '<div>
                %s
                <div class="caption">%s</div>
            </div>',
            get_the_post_thumbnail(null, 'large', ["class" => "img-fluid img"]),
            get_the_post_thumbnail_caption()
        );
    }
    the_title('<h2>', '</h2>');
    the_content();
}

get_footer();