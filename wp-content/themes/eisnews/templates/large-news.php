<div class="main_large_news">
    <div class="large_news_thumb">
        <?php
        the_post_thumbnail(array(640, 430), ["class" => "img-fluid large_img"]);
        ?>
    </div>

    <div class="large_news_content">
        <div class="large_news_title">
            <?php
            printf(
                '<h2 class="large_title">
                <a href="%s">%s</a>
            </h2>',
                get_the_permalink(),
                get_the_title()
            );
            ?>
        </div>
        <div class="large_news_meta">
            <div class="news_date">
                <?php
                printf(
                    '<span class="date"><i class="far fa-clock"></i> %s </span>',
                    get_the_date('M j, Y')
                );
                printf('<span class="cat">');
                the_category(' ');
                printf('</span>');
                ?>
            </div>
        </div>
    </div>
</div>