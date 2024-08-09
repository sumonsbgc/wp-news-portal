<?php get_header(); ?>



<div class="home-page">
    <div class="date_archive_container">
        <div class="row pt-2">
            <div class="col-lg-9">
                <div class="category-news px-3">
                    <div class="row mb-2">
                        <div class="col-lg-12">
                        <h2 class="display-5">
                            সংবাদ আর্কাইভ : 
                            <?php 
                                $converter = new LanguageConverter();
                                if(is_year()){
                                    $year = get_query_var('year');
                                    echo $converter->en2bn($year);
                                } elseif(is_month()){
                                    $month = get_query_var('monthnum');
                                    $dateObj = DateTime::createFromFormat("!m", $month);
                                    $monthName = $dateObj->format("F");
                                    echo $converter->en2bn($monthName) ." ". $converter->en2bn($year);
                                }elseif(is_day()){
                                    $year = get_query_var('year');
                                    $month = get_query_var('monthnum');
                                    $day = get_query_var('day');
                                    $dateObj = DateTime::createFromFormat("!m", $month);
                                    $monthName = $dateObj->format("F");
                                    echo $converter->en2bn($monthName) ." ". $converter->en2bn($day).", ". $converter->en2bn($year);
                                }
                            ?>
                        </h2>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            if( isset($day) && isset($month) && isset($year) ):
                            echo do_shortcode("[archive_news year='{$year}' month='{$month}' day='{$day}']");
                            elseif (isset($month) && isset($year)) :
                                echo do_shortcode("[archive_news year='{$year}' month='{$month}']");
                            elseif (isset($year)):
                                echo do_shortcode("[archive_news year='{$year}']");
                            endif;
                        ?>
                    </div>    
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>




<?php get_footer(); ?>