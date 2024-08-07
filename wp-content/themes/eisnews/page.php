<?php get_header();

while (have_posts()) : the_post();
    the_title("<h2>", "</h2>");
    printf("<div class=\"single-page-content\">%s</div>", get_the_content());
endwhile;

get_footer();
