<?php get_header(); ?>


    <!-- +++++++++++++++++++++++++++ HTML Code Start From Here ++++++++++++++++++++++++++++++++++ -->
    <div class="row py-4">
        <div class="col-lg-12 text-center">
            <?php
                while(have_posts()) : the_post();
                    the_content();
                endwhile;
            ?>
        </div>

        </div>
    </div>


<?php get_footer(); ?>