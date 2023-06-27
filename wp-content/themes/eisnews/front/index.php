<?php 
get_header();

$namaz_routine = get_option('my_theme_settings');
$id = isset($namaz_routine['_dpkone_epaper']) ? $namaz_routine['_dpkone_epaper'] : '';
$epapers = isset($id) ? wp_get_attachment_image_src($id[0], 'full') : '';
$zohor = isset($namaz_routine['_dpkone_namaz_routine']['_dpkone_zohor']) ? $namaz_routine['_dpkone_namaz_routine']['_dpkone_zohor'] : '';
$asor = isset($namaz_routine['_dpkone_namaz_routine']['_dpkone_asor']) ? $namaz_routine['_dpkone_namaz_routine']['_dpkone_asor'] : '';
$magrib = isset($namaz_routine['_dpkone_namaz_routine']['_dpkone_magrib']) ? $namaz_routine['_dpkone_namaz_routine']['_dpkone_magrib'] : '';
$esa = isset($namaz_routine['_dpkone_namaz_routine']['_dpkone_esa']) ? $namaz_routine['_dpkone_namaz_routine']['_dpkone_esa'] : '';
$fozor = isset($namaz_routine['_dpkone_namaz_routine']['_dpkone_fozor']) ? $namaz_routine['_dpkone_namaz_routine']['_dpkone_fozor'] : '';
$poll = isset($namaz_routine['_dpkone_poll']) ? $namaz_routine['_dpkone_poll'] : '';

$apiKey = isset($namaz_routine['_dpkone_api_key']) ? $namaz_routine['_dpkone_api_key'] : 'AIzaSyBJvfsHIf_2m0TuIhJenW1DVc6aVh_Xfo4';

$channelID = isset($namaz_routine['_dpkone_channel_id']) ? $namaz_routine['_dpkone_channel_id'] : 'UCPczt8v8G_NtXh8vbTUOh6Q';
$allPlaylists = isset($namaz_routine['_dpkone_playlist']) ? $namaz_routine['_dpkone_playlist'] : array();
$maxResult = 1;

?>

<?php if ( wp_is_mobile() ) : ?>
    <div class="forMobileViewContainer">
        
        <!-- Advertise-1 Section start -->
        <?php adsforwp_the_ad( 341377 ) ?>
        <!-- Advertise Section End Here -->
        
        <?php echo do_shortcode('[main_news_mobile cat_name="main-news"]'); ?>
        
        <!-- Advertise-2 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341383 ) ?>
        </div>
        <!-- Advertise Section End Here -->

        <div class="youtubeLive">
            <div class="title live-tv-title">
                <h5>পূর্বকোণ ভিডিও</h5>
	        </div>
	            <?php dynamic_sidebar("purbokone_live"); ?>
	    </div>
	    <br>

        <?php echo do_shortcode('[single_column_news_mobile cat_name="chattogram" class="category_one"]'); ?>
    
        <!-- Advertise-3 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341386 ) ?>
        </div>
        <!-- Advertise Section End Here -->
        
        <?php echo do_shortcode('[two_column_news_mobile cat="national" class="category_two"]'); ?>
    
        <!-- Advertise-4 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341389 ) ?>
        </div>
        <!-- Advertise Section End Here -->
            
        <?php echo do_shortcode('[two_column_news_mobile cat="zila-upazila-gram" class="category_five"]'); ?>

        <!-- Advertise-5 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341410 ) ?>
        </div>
        <!-- Advertise Section End Here -->
    
        <?php echo do_shortcode('[single_column_news_mobile cat_name="international" class="category_three"]'); ?>
        
        <!-- Advertise-6 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341414 ) ?>
        </div>
        <!-- Advertise Section End Here -->
        
        <?php echo do_shortcode('[two_column_news_mobile cat="finance-trade" class="category_four"]'); ?>
        
        <!-- Advertise-7 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341415 ) ?>
        </div>
        <!-- Advertise Section End Here -->
  
        <?php showEpaperThumb($epapers[0]); ?>

        <!-- Advertise-8 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341416 ) ?>
        </div>
        <!-- Advertise Section End Here -->

        <div class="rencent_popular_post">
            <?php echo do_shortcode('[recent_popular_post]'); ?>
        </div>
        
        <!-- Advertise-9 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341421 ) ?>
        </div>
        <!-- Advertise Section End Here -->
        
        <?php echo do_shortcode('[two_column_news_mobile cat="sports" class="category_five"]'); ?>
        
        <!-- Advertise-10 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341422 ) ?>
        </div>
        <!-- Advertise Section End Here -->
        
        <?php showOnlineSurvey($poll); ?>
        <br><br>
            
        <!-- Advertise-11 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341425 ) ?>
        </div>
        <!-- Advertise Section End Here -->
            
        <?php if (isset($namaz_routine['_dpkone_cricket_score']) || !empty($namaz_routine['_dpkone_cricket_score'])) : ?>
            <div class="sports-time">
                <div class="sports-time-header">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/time/Time.png" alt="time" class="img-fluid">
                </div>
                <div class="sports-time-content">
                    <?php
                    foreach ($namaz_routine['_dpkone_cricket_score'] as $items) {
                        ?>
                        <div class="sports-schedule text-right">
                            <h5>
                                <?php
                                echo $items['_dpkone_score_name'];
                                ?>
                            </h5>
                            <p>
                                <?php
                                echo $items['_dpkone_score_news'];
                                ?>
                            </p>
                        </div>
                    <?php } ?>
                </div>
                <div class="sports-time-footer">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/time/Ghori.png" alt="ghori" class="img-fluid">
                </div>
            </div>
            <!-- Advertise-12 Section start -->
            <div style="text-align: center; margin-bottom: 10px;">
		    <?php adsforwp_the_ad( 341426 ) ?>
		    </div>
            <!-- Advertise Section End Here -->
        <?php endif; ?>
        <?php echo do_shortcode('[mobile_tab_news cats="literature-and-culture, editorial, op-editorial"]'); ?>
        
            <!-- Advertise-13 Section start -->
            <div style="text-align: center; margin-bottom: 10px;">
		    <?php adsforwp_the_ad( 341427 ) ?>
		    </div>
            <!-- Advertise Section End Here -->
        
        <?php echo do_shortcode('[two_column_news_mobile cat="entertainment-art" class="category_eight"]'); ?>
        
        <!-- Advertise-14 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341428 ) ?>
        </div>
        <!-- Advertise Section End Here -->
        
        <?php echo do_shortcode('[col_three cats="education"]'); ?>
        
        <!-- Advertise-15 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341429 ) ?>
        </div>
        <!-- Advertise Section End Here -->
        
        <?php echo do_shortcode('[col_three cats="health"]'); ?>

        <!-- Advertise-16 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341431 ) ?>
        </div>
        <!-- Advertise Section End Here -->
      
        <?php echo do_shortcode('[col_three cats="information-technology"]'); ?>
        
        <!-- Advertise-17 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341432 ) ?>
        </div>
        <!-- Advertise Section End Here -->
        
        <div class="row mb-3 tech-slideshow">
            <div class="col-lg-12 mover-1 overflow">
                <div class="row my-2">
                    <div class="col-lg-12 fix">
                        <div class="news_category_head fix">
                            <a class="disabled float-left" style="color: #fff">ফিচার</a>
                            <a class="float-right disabled"></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-4 col-6">
                        <a href="category/nagordola">
                            <div class="category-image">
                                <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/img/nagordola.png') ?>" alt="<?php echo bloginfo('name'); ?>">
                            </div>

                        </a>
                    </div>
                    <div class="col-md-3 mb-4 col-6">
                        <a href="category/kolorol">
                            <div class="category-image">
                                <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/img/kolorol.png') ?>" alt="<?php echo bloginfo('name'); ?>">
                            </div>

                        </a>
                    </div>

                    <div class="col-md-3 mb-4 col-6">
                        <a href="category/tukitaki">
                            <div class="category-image">
                                <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/img/tukitaki.png') ?>" alt="<?php echo bloginfo('name'); ?>">
                            </div>

                        </a>
                    </div>

                    <div class="col-md-3 mb-4 col-6">
                        <a href="category/environment-science">
                            <div class="category-image">
                                <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/img/science.png') ?>" alt="<?php echo bloginfo('name'); ?>">
                            </div>

                        </a>
                    </div>

                    <div class="col-md-3 mb-4 col-6">
                        <a href="category/travel">
                            <div class="category-image">
                                <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/img/vromon.png') ?>" alt="<?php echo bloginfo('name'); ?>">
                            </div>

                        </a>
                    </div>

                    <div class="col-md-3 mb-4 col-6">
                        <a href="category/romoniyo">
                            <div class="category-image">
                                <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/img/romonio.png') ?>" alt="<?php echo bloginfo('name'); ?>">
                            </div>

                        </a>
                    </div>

                    <div class="col-md-3 mb-4 col-6">
                        <a href="category/zodiac">
                            <div class="category-image">
                                <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/img/rashi.png') ?>" alt="<?php echo bloginfo('name'); ?>">
                            </div>

                        </a>
                    </div>

                    <div class="col-md-3 mb-4 col-6">
                        <a href="category/sohor-theke-dure">
                            <div class="category-image">
                                <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/img/sohor.png') ?>" alt="<?php echo bloginfo('name'); ?>">
                            </div>

                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <ul class="top_social_bar">
                    <li><a class="yt" href="<?php echo esc_url("https://www.youtube.com/channel/UCPczt8v8G_NtXh8vbTUOh6Q"); ?>" target="_blank"><img src="<?php echo get_theme_file_uri('assets/img/social/y.png'); ?>"></a></li>
                    <li><a class="insta" href="<?php echo esc_url("https://www.instagram.com/dailypurbokone/"); ?>" target="_blank"><img src="<?php echo get_theme_file_uri('assets/img/social/i.png'); ?>"></a></li>
                    <li><a class="twit" href="<?php echo esc_url("https://twitter.com/dailypurbokone"); ?>" target="_blank"><img src="<?php echo get_theme_file_uri('assets/img/social/t.png'); ?>"></a></li>
                    <li><a class="fb" href="<?php echo esc_url("https://www.facebook.com/DailyPurbokone/"); ?>" target="_blank"><img src="<?php echo get_theme_file_uri('assets/img/social/f.png'); ?>"></a></li>
                </ul>        
            </div>
        </div>
        
        <!-- Advertise-18 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341433 ) ?>
        </div>
        <!-- Advertise Section End Here -->
        
        <?php echo do_shortcode('[second_tab_news_mobile cats="emigrant, weather, job"]'); ?>
        
        <!-- Advertise-19 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341434 ) ?>
        </div>
        <!-- Advertise Section End Here -->
        
        <!-- Advertise-20 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
        <?php adsforwp_the_ad( 341435 ) ?>
        </div>
        <!-- Advertise Section End Here -->
        
    </div>
<?php else : ?>
    <div class="forDesktopContainer">
        <div class="row pt-2">
            <div class="col-lg-9 divider-right eis-col-lg-9">
            
                <!-- Advertise Section start -->
                <div style="text-align: center; margin-bottom: 10px;">
                <?php adsforwp_the_ad( 341221 ) ?>
                </div>
                <!-- Advertise Section End Here -->

                <?php echo do_shortcode('[main_news cat_name="main-news"]'); ?>
                    
                <!-- Advertise Section start -->
                <div style="text-align: center; margin-bottom: 10px;">
                <?php adsforwp_the_ad( 341223 ) ?>
                </div>
                <!-- Advertise Section End Here -->
                            
                <?php echo do_shortcode('[two_sides_news class_one="category_one" class_two="category_two" cat_one="chattogram" cat_two="national"]'); ?>

                <!-- Advertise Section start -->
                <?php adsforwp_the_ad( 341226 ) ?>
                <!-- Advertise Section End Here -->
                
                <?php echo do_shortcode('[single_row_cat cat="zila-upazila-gram" class_one="category_five"]'); ?>
        
                <!-- Advertise Section start -->
                <?php adsforwp_the_ad( 341228 ) ?>
                <!-- Advertise Section End Here -->
                    
                <?php echo do_shortcode('[two_sides_news cat_one="international" cat_two="finance-trade" class_one="category_three" class_two="category_four"]'); ?>
                    
                <!-- Advertise Section start -->
                <?php adsforwp_the_ad( 341230 ) ?>
                <!-- Advertise Section End Here -->
                
                <?php echo do_shortcode('[single_row_cat cat="sports" class_one="category_five"]'); ?>

                <!-- Advertise Section start -->
                <?php adsforwp_the_ad( 341231 ) ?>
                <!-- Advertise Section End Here -->

                <?php echo do_shortcode('[tab_news cats="literature-and-culture, editorial, op-editorial"]'); ?>
                    
                <!-- Advertise Section start -->
                <?php adsforwp_the_ad( 341233 ) ?>
                <!-- Advertise Section End Here -->
                
                <!-- Google Ad Manager Placement-D7 -->

                <?php echo do_shortcode('[single_row_cat cat="entertainment-art" class_one="category_eight"]'); ?>

                <!-- Advertise Section start -->
                <?php adsforwp_the_ad( 341234 ) ?>
                <!-- Advertise Section End Here -->

                <?php echo do_shortcode('[col_three cats="education,health,information-technology"]'); ?>
                    
                <!-- Advertise Section start -->
                <?php adsforwp_the_ad( 341235 ) ?>
                <!-- Advertise Section End Here --> 

                <div class="row mb-3 tech-slideshow">
                    <div class="col-lg-12 mover-1 overflow">                        
                        <div class="row my-2">
                            <div class="col-lg-12 fix">
                                <div class="news_category_head fix">
                                    <a class="disabled float-left" style="color: #fff">ফিচার</a>
                                    <a class="float-right disabled"></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <a href="category/nagordola">
                                    <div class="category-image">
                                        <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/img/nagordola.png') ?>" alt="<?php echo bloginfo('name'); ?>">
                                    </div>
                                </a>

                            </div>
                            <div class="col-md-3 mb-4">
                                <a href="category/kolorol">
                                    <div class="category-image">
                                        <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/img/kolorol.png') ?>" alt="<?php echo bloginfo('name'); ?>">
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 mb-4">
                                <a href="category/tukitaki">
                                    <div class="category-image">
                                        <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/img/tukitaki.png') ?>" alt="<?php echo bloginfo('name'); ?>">
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 mb-4">
                                <a href="category/environment-science">
                                    <div class="category-image">
                                        <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/img/science.png') ?>" alt="<?php echo bloginfo('name'); ?>">
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 mb-4">
                                <a href="category/travel">
                                    <div class="category-image">
                                        <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/img/vromon.png') ?>" alt="<?php echo bloginfo('name'); ?>">
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 mb-4">

                                <a href="category/romoniyo">
                                    <div class="category-image">
                                        <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/img/romonio.png') ?>" alt="<?php echo bloginfo('name'); ?>">
                                    </div>

                                </a>

                            </div>
                            <div class="col-md-3 mb-4">

                                <a href="category/zodiac">
                                    <div class="category-image">
                                        <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/img/rashi.png') ?>" alt="<?php echo bloginfo('name'); ?>">
                                    </div>

                                </a>

                            </div>
                            <div class="col-md-3 mb-4">

                                <a href="category/sohor-theke-dure">
                                    <div class="category-image">
                                        <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/img/sohor.png') ?>" alt="<?php echo bloginfo('name'); ?>">
                                    </div>

                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Advertise Section start -->
                <?php adsforwp_the_ad( 341236 ) ?>
                <!-- Advertise Section End Here --> 

                <?php echo do_shortcode('[second_tab_news cats="emigrant, weather, job"]'); ?>

                <!-- Advertise Section start -->
                <?php adsforwp_the_ad( 341237 ) ?>
                <!-- Advertise Section End Here -->
                
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
<?php endif; ?>
    <!--+++++++++++++++++++++++++++++++++++ Image Gallary With Tab HTML Start From Here +++++++++++++++++++++++++++++++-->
    <!--+++++++++++++++++++++++++++++++++++++ Video Gallary With Tab Start From Here +++++++++++++++++++++++++++++++++-->
    <!--+++++++++++++++++++++++++++++++++++++ Video Gallary With Tab End Here +++++++++++++++++++++++++++++++++ -->
</div>
<?php get_footer(); ?>