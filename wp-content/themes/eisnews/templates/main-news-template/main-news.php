<div class="main_news_container">
    <article class="main_large_news">
        <div class="large_news_thumb">
            <?php
            the_post_thumbnail(array(640, 430), ["class" => "img-fluid large_img"]);
            ?>
        </div>
        <div class="large_news_content">
            <?php
            echo sprintf(
                '<h2 class="large_title"><a href="%s">%s</a></h2>',
                get_the_permalink(),
                get_the_title()
            );
            ?>
            <div class="large_news_meta">
                <?php
                echo sprintf('<span class="date"><i class="far fa-clock"></i> %s </span>', get_the_date('M j, Y'));
                echo sprintf('<span class="cat">%s</span>', the_category(' '));
                ?>
            </div>
        </div>
    </article>
    <!-- small news in main news section -->
    <article class="news_container">
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
    </article>
</div>