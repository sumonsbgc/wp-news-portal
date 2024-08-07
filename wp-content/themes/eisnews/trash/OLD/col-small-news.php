<div class="news_container small_news_height mb-3">
    <div class="news_thumb small_news_thumb_height">
        <?php
        the_post_thumbnail("thumbnail", ["class" => "img-fluid img"])
        ?>
    </div>
    <div class="news_meta">
        <div class="news_date">
            <?php
            printf(
                '<span class="date"><i class="far fa-clock"></i> %s </span>',
                get_the_date('M j, Y')
            );

            printf(
                '<span class="time">%s</span>',
                get_the_date('H:i')
            );

            ?>
        </div>
    </div>
    <div class="news_title_container">
        <?php
        printf(
            '<h4 class="title">
            <a href="%s">%s</a>
            </h4>',
            get_the_permalink(),
            get_the_title()
        );
        ?>
    </div>
</div>
