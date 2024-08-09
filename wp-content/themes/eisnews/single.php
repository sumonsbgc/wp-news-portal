<?php get_header(); ?>

<main class="content-area">
    <div class="news-sections">
        <?php while (have_posts()) : the_post(); ?>
            <!-- <?php if (has_post_thumbnail()) : ?> -->
            <div>
                <?php the_post_thumbnail(); ?>
            </div>
            <div class="caption">
                <?php the_post_thumbnail_caption(); ?>
            </div>
            <!-- <?php endif; ?> -->
            <?php the_title('<h2>', '</h2>'); ?>
            <div>
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    </div>
    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>