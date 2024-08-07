<?php get_header();?>

<div class="row content-area">
    <div class="col-9 border-right">
        <?php
            $sections = array(
                array(
                    "template"      => "main_news",
                    "section_class" => "main_news_section",
                    "cat"           => "main-news",
                    "title"         => "Main News",
                    "title_class"   => "bg_black",
                    "cat_class"     => "bg_red clip",
                    "per_page"      => 7,
                ),
                array(
                    "template"      => "col-three",
                    "section_class" => "main_news_section",
                    "cat"           => "international",
                    "title"         => "International",
                    "title_class"   => "bg_black",
                    "cat_class"     => "bg_red clip",
                    "per_page"      => 4,
                ),

                array(
                    "template"      => "col-six",
                    "section_class" => "main_news_section",
                    "cat"           => ["national", "chattogram"],
                    "title"         => ["National", "Chattogram"],
                    "title_class"   => "bg_black",
                    "cat_class"     => "bg_red clip",
                    "per_page"      => 4,
                ),
                array(
                    "template"      => "col-twelve",
                    "section_class" => "main_news_section",
                    "cat"           => ["national", "chattogram", "international"],
                    "title"         => ["National", "Chattogram", "International"],
                    "title_class"   => "bg_black",
                    "cat_class"     => "bg_red clip",
                    "per_page"      => 4,
                ),
            );
        ?>

        <?php
            foreach ( $sections as $section ):
                if ( !is_array( $section["cat"] ) ):
            ?>
	                <div class="row<?php echo $section['section_class'] ?>">
	                    <div class="col-md-12">
	                        <?php
                                    if ( $section["template"] === "main_news" ) {
                                        eis_main_news_section_title( $section['title'], $section['title_class'], $section['cat_class'] );
                                    } else {
                                        eis_news_section_title( $section['title'], $section["section_class"], $section['title_class'] );
                                    }
                                ?>
	                    </div>

	                    <div class="col-md-12">
	                        <div class="row">
	                            <?php
                                        $args = array(
                                            'category_name'  => $section["cat"],
                                            'posts_per_page' => $section["per_page"],
                                        );
                                        $q = new WP_Query( $args );
                                        while ( $q->have_posts() ) {
                                            $q->the_post();
                                            if ( $section["template"] === "main_news" && $q->current_post === 0 ) {
                                                get_template_part( 'templates/large-news' );
                                            } else {
                                                get_template_part( 'templates/' . $section['template'] );
                                            }
                                        }
                                    ?>
	                        </div>
	                    </div>
	                </div>

	            <?php else: ?>
                <div class="row">
                    <?php
                        $count = count( $section["cat"] );
                        $i     = 0;
                    foreach ( $section["cat"] as $cat ): ?>
                        <div class="col-md-<?php echo 12 / $count; ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php eis_news_section_title( $section['title'][$i], $section["section_class"], $section['title_class'] );?>
                                </div>
                                <?php
                                    $args = array(
                                        'category_name'  => $cat,
                                        'posts_per_page' => $section["per_page"],
                                    );

                                    $q = new WP_Query( $args );

                                    while ( $q->have_posts() ) {
                                        $q->the_post();
                                        get_template_part( 'templates/' . $section['template'] );
                                    }
                                ?>
                            </div>
                        </div>
                    <?php $i++;
                    endforeach;?>
                </div>
        <?php
            endif;
            endforeach;
        ?>
    </div>
    <div class="col-3">
        <?php get_sidebar();?>
    </div>
</div>

<?php get_footer();?>