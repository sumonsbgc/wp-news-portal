<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <title>দৈনিক পূর্বকোণ | বাংলাদেশে আধুনিক সংবাদপত্রের পথিকৃৎ</title>
    <meta property="fb:pages" content="378770192305372" />
    <meta name="Description" content="The online edition of the Daily Purbokone remains one of the most well read newspapers in Bangladesh for its investigative and objective journalism and incisive analysis in pursuit of the truth." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#FFFFFF" />
    <meta name="google-site-verification" content="iLHkc8MxcRMfPlD3E4Qik9N5N1GY5Jx411uMHo7HOZI" />
    <meta name="keywords" content="azadi, suprobhat, suprovat, purbodesh, ctg, protidin, Dainik Purbokone, daily newspaper, Daily Purbokone, Purbokun, all bangla newspaper, Purbokon, current News, Chittagong, online paper, Newspaper, Chattogram, Chottogram, ctg, bangla news,  bangla newspaper, bangladesh newspaper, bangladeshi newspaper, bangla news paper, bangladesh newspapers, newspaper, all bangla news paper, bd news paper, news paper, bangladesh news paper, daily, bangla newspaper, daily news paper, bangladeshi news paper, bangla paper, bangladesh news, আজাদী, সুপ্রভাত, পূর্বদেশ, প্রতিদিন, পূর্বকোণ, পূর্বকোন, দৈনিক, অনলাইন, পত্রিকা, বাংলাদেশ, চট্টগ্রাম, আজকের পত্রিকা, জাতীয়, আন্তর্জাতিক, অর্থ-বাণিজ্য, অর্থনীতি, খেলা, বিনোদন, ফিচার, পাতা, বিজ্ঞান, প্রযুক্তি, তথ্য, চলচ্চিত্র, ঢালিউড, বলিউড, হলিউড, বাংলা গান, মঞ্চ, নাটক, টেলিভিশন, কি কোথায়, নাগরদোলা, সাহিত্য, রেসিপি, কলরোল, টুকিটাকি, রমনীয়, রাশিফল, শহর থেকে দুরে, রাশি, স্বাস্থ্য, চাকরী, চাকরি, প্রবাস, শিক্ষা, সম্পাদকীয়, কম্পিউটার, মোবাইল ফোন, ভ্রমণ, অটোমোবাইল, মহাকাশ, ভিডিও, লাইভ, কারিগর, গেমস, মাল্টিমিডিয়া, রাজনীতি, পুলিশ, সরকার, অপরাধ, আইন ও বিচার, সরকার, পরিবেশ, দুর্ঘটনা, সংসদ, রাজধানী, নগরী, শেয়ার বাজার, বাণিজ্য, পোশাক শিল্প, ক্রিকেট, ফুটবল, লাইভ স্কোর" />

    <?php wp_head(); ?>
</head>

<body>
    <div class="wrapper">
        <div class="row headerTopBar">
            <div class="col-md-4">
                <i class="fas fa-map-marker-alt"></i> চট্টগ্রাম
                <i class="fas fa-calendar-alt"></i> <?php echo date_i18n("l, d F, Y", strtotime('now')); ?>
            </div>
            <div class="col-md-4 text-center">
                <a class="old-site" target="_blank" href="http://dainikpurbokone.net/">পুরনো সাইট</a>
                <a class="ad_price" target="_blank" href="/advertisement-rate/">বিজ্ঞাপন মূল্য</a>
            </div>
            <div class="col-md-4">
                <ul class="top_social_bar">
                    <?php
                    $si = get_transient("social_img");
                    if (false === $si) {
                        $si = [
                            "fb"        => "https://i0.wp.com/dainikpurbokone.net/wp-content/themes/dainikpurbokone/assets/img/social/f.png",
                            "twit"   => "https://i0.wp.com/dainikpurbokone.net/wp-content/themes/dainikpurbokone/assets/img/social/t.png",
                            "insta"     => "https://i0.wp.com/dainikpurbokone.net/wp-content/themes/dainikpurbokone/assets/img/social/i.png",
                            "yt"   => "https://i0.wp.com/dainikpurbokone.net/wp-content/themes/dainikpurbokone/assets/img/social/y.png",
                        ];
                        set_transient("social_img", $si);
                    }
                    ?>
                    <li><a class="yt" href="//youtube.com/c/DailyPurbokoneOfficial" target="_blank"><img src="<?php echo $si["yt"]; ?>"></a></li>
                    <li><a class="insta" href="//instagram.com/dailypurbokone/" target="_blank"><img src="<?php echo $si["insta"]; ?>"></a></li>
                    <li><a class="twit" href="//twitter.com/dailypurbokone" target="_blank"><img src="<?php echo $si["twit"]; ?>"></a></li>
                    <li><a class="fb" href="//facebook.com/DailyPurbokone/" target="_blank"><img src="<?php echo $si["fb"]; ?>"></a></li>
                </ul>
            </div>
        </div>
        <div class="row py-2 logo_area">
            <div class="col-md-4">
                <?php
                if (has_custom_logo()) {
                    echo get_custom_logo();
                } else {
                    printf("<a class=\"d-inline-block\" href=\"%s\"><img class=\"img-fluid\" src=\"%s\"></a>", esc_url(site_url('/')), esc_url(get_theme_file_uri('assets/images/logo.png')));
                }
                ?>
            </div>
            <div class="col-md-8">
                <img src="<?php echo get_theme_file_uri("assets/images/Ad.webp"); ?>" style="width: 100%; height: 90px;" />
            </div>
        </div>

        <div class="row breaking_news">
            <div class="col-sm-12">
                <span class="headline">সর্বশেষ:</span>
                <?php
                    echo do_shortcode("[breaking_news]");
                ?>
            </div>
        </div>

        <div class="row navarea mt-1">
            <?php
            if (has_nav_menu('header')) {
                $menu = wp_nav_menu(
                    array(
                        'theme_location' => 'header',
                        'container' => 'nav',
                        'container_class' => 'nav_container',
                        'menu_class' => 'menu_container',
                        'echo' => false
                    )
                );
                
                echo $menu;
            }
            ?>
        </div>