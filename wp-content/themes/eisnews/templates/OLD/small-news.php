<div class="news_container">
    <div class="news_thumb small_news_thumb_height">
        <?php
        the_post_thumbnail("thumbnail", ["class" => "img-fluid img"])
        ?>
        <div class="cat_box">
            <?php
            the_category(' ')
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