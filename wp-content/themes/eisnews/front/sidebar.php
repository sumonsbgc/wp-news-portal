<?php
$namaz_routine = get_option('my_theme_settings');
$id = isset($namaz_routine['_dpkone_epaper']) ? $namaz_routine['_dpkone_epaper'] : '';
$epapers = isset($id) ? wp_get_attachment_image_src($id[0], 'full') : '';
$zohor = isset($namaz_routine['_dpkone_namaz_routine']['_dpkone_zohor']) ? $namaz_routine['_dpkone_namaz_routine']['_dpkone_zohor'] : '';
$asor = isset($namaz_routine['_dpkone_namaz_routine']['_dpkone_asor']) ? $namaz_routine['_dpkone_namaz_routine']['_dpkone_asor'] : '';
$magrib = isset($namaz_routine['_dpkone_namaz_routine']['_dpkone_magrib']) ? $namaz_routine['_dpkone_namaz_routine']['_dpkone_magrib'] : '';
$esa = isset($namaz_routine['_dpkone_namaz_routine']['_dpkone_esa']) ? $namaz_routine['_dpkone_namaz_routine']['_dpkone_esa'] : '';
$fozor = isset($namaz_routine['_dpkone_namaz_routine']['_dpkone_fozor']) ? $namaz_routine['_dpkone_namaz_routine']['_dpkone_fozor'] : '';
$sunrise = isset($namaz_routine['_dpkone_namaz_routine']['_dpkone_sunrise']) ? $namaz_routine['_dpkone_namaz_routine']['_dpkone_sunrise'] : '';


$poll = isset($namaz_routine['_dpkone_poll']) ? $namaz_routine['_dpkone_poll'] : '';
?>
<div class="col-lg-3 sidebar divider-left eis-col-lg-3">
    <div class="theiaStickySidebar">

        <!-- Advertise-1 Section start -->
        <?php adsforwp_the_ad(341238) ?>
        <!-- Advertise Section End Here -->

        <div class="purbokon-live-tv">
            <div class="title live-tv-title">
                <h3>পূর্বকোণ ভিডিও</h3>
            </div>
            <div class="live-tv-video-area mb-2">
                <?php dynamic_sidebar("purbokone_live"); ?>
            </div>
        </div>

        <!-- Advertise-2 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
            <?php adsforwp_the_ad(341239) ?>
        </div>
        <!-- Advertise Section End Here -->

        <?php showEpaperThumb($epapers[0]); ?>

        <!-- Advertise-3 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
            <?php adsforwp_the_ad(341240) ?>
        </div>
        <!-- Advertise Section End Here -->

        <div style="text-align: center;">
            <?php showSocialShareOption(); ?>
        </div>

        <!-- Advertise-4 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
            <?php adsforwp_the_ad(341241) ?>
        </div>
        <!-- Advertise Section End Here -->

        <?php echo do_shortcode('[recent_popular_post]') ?>

        <!-- Advertise-5 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
            <?php adsforwp_the_ad(341242) ?>
        </div>
        <!-- Advertise Section End Here -->

        <?php showOnlineSurvey($poll); ?>
        <br><br>

        <?php showNamazTime($zohor, $asor, $magrib, $esa, $fozor, $sunrise); ?>

        <!-- Advertise-6 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
            <?php adsforwp_the_ad(341244) ?>
        </div>
        <!-- Advertise Section End Here -->

        <div class="archive">
            <div class="title archive-title">
                <h3>আর্কাইভ</h3>
            </div>
            <div class="archive-content">
                <form action="" method="post" enctype="multipart/form-data" id="dpkone_archive_filter">
                    <div class="single-archive-content">
                        <?php wp_nonce_field('date_archive', 'af'); ?>
                    </div>
                    <div class="single-archive-content">
                        <select class="form-control form-control-sm" name="archive-year" id="archive-year">
                            <option value="">বছর</option>
                            <?php
                            $currentYear = date("Y");
                            $numYears = 5; // Number of previous years to include
                            for ($i = $currentYear; $i >= $currentYear - $numYears; $i--) {
                                $y = LanguageConverter::en2bn($i);
                                echo "<option value='$i'>$y</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="single-archive-content">
                        <select name="archive-month" id="archive-month" class="form-control form-control-sm">
                            <option value="">মাস</option>
                            <option value="1">জানুয়ারি</option>
                            <option value="2">ফেব্রুয়ারি</option>
                            <option value="3">মার্চ</option>
                            <option value="4">এপ্রিল</option>
                            <option value="5">মে</option>
                            <option value="6">জুন</option>
                            <option value="7">জুলাই</option>
                            <option value="8">অগাস্ট</option>
                            <option value="9">সেপ্টেম্বর</option>
                            <option value="10">অক্টোবর</option>
                            <option value="11">নভেম্বর</option>
                            <option value="12">ডিসেম্বর</optionn>
                        </select>
                    </div>
                    <div class="single-archive-content">
                        <select class="form-control form-control-sm" name="archive-day" id="archive-day">
                            <option value="">দিন</option>
                            <option value="01">০১</option>
                            <option value="02">০২</option>
                            <option value="03">০৩</option>
                            <option value="04">০৪</option>
                            <option value="05">০৫</option>
                            <option value="06">০৬</option>
                            <option value="07">০৭</option>
                            <option value="08">০৮</option>
                            <option value="09">০৯</option>
                            <option value="10">১০</option>
                            <option value="11">১১</option>
                            <option value="12">১২</option>
                            <option value="13">১৩</option>
                            <option value="14">১৪</option>
                            <option value="15">১৫</option>
                            <option value="16">১৬</option>
                            <option value="17">১৭</option>
                            <option value="18">১৮</option>
                            <option value="19">১৯</option>
                            <option value="20">২০</option>
                            <option value="21">২১</option>
                            <option value="22">২২</option>
                            <option value="23">২৩</option>
                            <option value="24">২৪</option>
                            <option value="25">২৫</option>
                            <option value="26">২৬</option>
                            <option value="27">২৭</option>
                            <option value="28">২৮</option>
                            <option value="29">২৯</option>
                            <option value="30">৩০</option>
                            <option value="31">৩১</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-outline-secondary archive-btn" id="af_btn" value="দেখান">
                </form>
            </div>
        </div>

        <!-- Advertise-7 Section start -->
        <div style="text-align: center; margin-bottom: 10px;">
            <?php adsforwp_the_ad(341245) ?>
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
            </div><br />

            <!-- Advertise-8 Section start -->
            <div style="text-align: center; margin-bottom: 10px;">
                <?php adsforwp_the_ad(341340) ?>
            </div>
            <!-- Advertise Section End Here -->

            <!-- Advertise-9 Section start -->
            <div style="text-align: center; margin-bottom: 10px;">
                <?php adsforwp_the_ad(341342) ?>
            </div>
            <!-- Advertise Section End Here -->

            <!-- Advertise-10 Section start -->
            <div style="text-align: center; margin-bottom: 10px;">
                <?php adsforwp_the_ad(341343) ?>
            </div>
            <!-- Advertise Section End Here -->

            <!-- Advertise-11 Section start -->
            <div style="text-align: center; margin-bottom: 10px;">
                <?php adsforwp_the_ad(341345) ?>
            </div>
            <!-- Advertise Section End Here -->

            <!-- Advertise-12 Section start -->
            <div style="text-align: center; margin-bottom: 10px;">
                <?php adsforwp_the_ad(341346) ?>
                <!-- Advertise Section End Here -->
            <?php endif; ?><br>
            </div>
    </div>
</div>