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
    ),
    array(
        "template"      => "international",
        "section_class" => "main_news_section",
        "cat"           => "international",
        "title"         => "International",
        "title_class"   => "bg_black",
        "cat_class"     => "bg_red clip",
    ),

    array(
        "template"      => "international",
        "section_class" => "main_news_section",
        "cat"           => ["national","chattogram"],
        "title"         => ["National","Chattogram"],
        "title_class"   => "bg_black",
        "cat_class"     => "bg_red clip",
    ),
);

foreach ( $sections as $section ):
?>
            <div class="row <?php echo $section['section_class'] ?>">
                <div class="col-12">
                <?php
                    if ( $section["template"] === "main-news" ) {
                        eis_main_news_section_title( $section['title'], $section['title_class'], $section['cat_class'] );
                    } else {
                        eis_news_section_title( $section['title'], $section["section_class"], $section['title_class'] );
                    }
                ?>

                </div>
                <div class="col-12">
                    <div class="row">
                        <?php

                            $args = array(
                                'post_type'      => 'post',
                                'category_name'  => $section["cat"],
                                'posts_per_page' => 7,
                            );

                            $q = new WP_Query( $args );

                            while ( $q->have_posts() ) {
                                $q->the_post();
                                if ( $section["template"] === "main-news" ) {
                                    get_template_part( 'templates/' . $section['template'] );
                                } else {

                                    if( is_array($section['cat'])){
                                        
                                        $count = count($section["cat"]);

                                        foreach ($section['template'] as $template ) {
                                            printf(
                                                '<div class="col-md-{12/%s}">
                                                    <div class="row">
                                                        %s
                                                    </div>
                                                </div>', 
                                                $count, get_template_part('templates/'. $template)
                                            );
                                        } 
                                                                               
                                    }else{
                                        get_template_part( 'templates/' . $section['template'] );
                                    }

                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
    <div class="col-3">
        <?php get_sidebar();?>
    </div>
</div>

<?php get_footer();?>