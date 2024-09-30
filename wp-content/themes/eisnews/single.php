<?php get_header(); ?>

<main class="content-area">
    <div class="news-sections">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post(); ?>
                <div>
                    <?php the_post_thumbnail();  ?>
                </div>
                <h1><?php the_title(); ?></h1>
                <div><?php the_content(); ?></div>
                <p>Post ID: <?php the_ID(); ?></p>
        <?php
            endwhile;
        else :
            echo '<p>No content found</p>';
        endif;
        ?>
    </div>
    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>