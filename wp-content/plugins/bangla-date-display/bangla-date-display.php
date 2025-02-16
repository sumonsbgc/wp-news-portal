<?php
/*
Plugin Name: Bangla Date Display
Plugin URI: https://imran.link
Description: Displays Bangla, Gregorian and Hijri date in bangla language via widgets and shortcodes! Options for displaying post/page's time, date, comment count, archive calendar etc in Bangla language.
Author: ALI IMRAN
Version: 9.4
Author URI: https://imran.link
*/

/*
This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or ( at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of ERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA. Online: http://www.gnu.org/licenses/gpl.txt;
*/

// Bismillah...

defined( 'ABSPATH' )or die( 'Stop! You can not do this!' );

$bddp_options = get_option( "bddp_options" );
if ( !is_array( $bddp_options ) ) {
	$bddp_options = array(
		'cal_wgt' => '0',
		'trans_dt' => '0',
		'trans_cmnt' => '0',
		'trans_num' => '0',
		'trans_cal' => '0' 
	);
}

require 'translator.php';
require 'class.banglaDate.php';
require 'ajax-archive-calendar.php';

if (!class_exists('uCal')) {
	include_once('uCal.php');
}

add_shortcode('bangla_time', 'render_bangla_clock');
function render_bangla_clock() {

	$bddp_options = get_option( "bddp_options" );

	$offset = isset($bddp_options['en_tz']) ? $bddp_options['en_tz']*60*60 : 21600;
	$hour = gmdate("G", time()+$offset);
	
	if ( $hour >= 5 && $hour <= 5 ) {
		$event = "ভোর ";
	} else if ( $hour >= 6 && $hour <= 11 ) {
		$event = "সকাল ";
	} else if ( $hour >= 12 && $hour <= 14 ) {
		$event = "দুপুর ";
	} else if ( $hour >= 15 && $hour <= 17 ) {
		$event = "বিকাল ";
	} else if ( $hour >= 18 && $hour <= 19 ) {
		$event = "সন্ধ্যা ";
	} else {
		$event = "রাত ";
	}

	ob_start(); // begin output buffering

	echo $event.en_to_bn(gmdate("g:i", time()+$offset));

	$output = ob_get_contents(); // end output buffering
	ob_end_clean(); // grab the buffer contents and empty the buffer
	return $output;
}

add_shortcode('bangla_day', 'render_bangla_day');
function render_bangla_day() {
	ob_start(); // begin output buffering
	
	$bddp_options = get_option( "bddp_options" );
	
	$offset = isset($bddp_options['en_tz']) ? $bddp_options['en_tz']*60*60 : 21600;

	echo en_to_bn(gmdate("l", time()+$offset));
	
	$output = ob_get_contents(); // end output buffering
	ob_end_clean(); // grab the buffer contents and empty the buffer
	return $output;
}

add_shortcode('bangla_date', 'render_bangla_date');
function render_bangla_date() {
	
	$day_number = array( "১" => "১লা", "২" => "২রা", "৩" => "৩রা", "৪" => "৪ঠা", "৫" => "৫ই", "৬" => "৬ই", "৭" => "৭ই", "৮" => "৮ই", "৯" => "৯ই", "১০" => "১০ই", "১১" => "১১ই", "১২" => "১২ই", "১৩" => "১৩ই", "১৪" => "১৪ই", "১৫" => "১৫ই", "১৬" => "১৬ই", "১৭" => "১৭ই", "১৮" => "১৮ই", "১৯" => "১৯শে", "২০" => "২০শে", "২১" => "২১শে", "২২" => "২২শে", "২৩" => "২৩শে", "২৪" => "২৪শে", "২৫" => "২৫শে", "২৬" => "২৬শে", "২৭" => "২৭শে", "২৮" => "২৮শে", "২৯" => "২৯শে", "৩০" => "৩০শে", "৩১" => "৩১শে" );

	$bddp_options = get_option("bddp_options");
	if (!is_array($bddp_options)) {
		$bddp_options = array(
			'separator' => ', ',
			'last_word' => '1',
			'ord_suffix' => '1'
		);
	}
	
	$dt_change = isset($bddp_options['dt_change']) ? $bddp_options['dt_change'] : 0;
	$separator = isset($bddp_options['separator']) ? $bddp_options['separator'] : ', ';
	$last_word = isset($bddp_options['last_word']) ? " বঙ্গাব্দ" : "";
	
	$offset = isset($bddp_options['bangla_tz']) ? $bddp_options['bangla_tz']*60*60 : 21600;
	$timestamp = time()+$offset;
	$banglaDate = new BanglaDate($timestamp, $dt_change);
	$the_date = $banglaDate->get_date();

	$day = isset($bddp_options['ord_suffix']) ? $day_number[$the_date[0]] : $the_date[0];
	$month_year = $the_date[1].$separator.$the_date[2];

	ob_start(); // begin output buffering

	echo $day.' '.$month_year.$last_word;

	$output = ob_get_contents(); // end output buffering
	ob_end_clean(); // grab the buffer contents and empty the buffer
	return $output;
}

add_shortcode('bangla_season', 'bddp_bn_season');
function bddp_bn_season() {
	ob_start(); // begin output buffering
	
	$bddp_options = get_option( "bddp_options" );

	$offset = isset($bddp_options['bangla_tz']) ? $bddp_options['bangla_tz']*60*60 : 21600;
	$banglaDate = new BanglaDate(time()+$offset, 0);
	$month = $banglaDate->get_date()[1];

	$seasons = [
		"বৈশাখ" => "গ্রীষ্মকাল",
		"জ্যৈষ্ঠ" => "গ্রীষ্মকাল",
		"আষাঢ়" => "বর্ষাকাল",
		"শ্রাবণ" => "বর্ষাকাল",
		"ভাদ্র" => "শরৎকাল",
		"আশ্বিন" => "শরৎকাল",
		"কার্তিক" => "হেমন্তকাল",
		"অগ্রহায়ণ" => "হেমন্তকাল",
		"পৌষ" => "শীতকাল",
		"মাঘ" => "শীতকাল",
		"ফাল্গুন" => "বসন্তকাল",
		"চৈত্র" => "বসন্তকাল"
	];
	
	echo $seasons[$month];
	
	$output = ob_get_contents(); // end output buffering
	ob_end_clean(); // grab the buffer contents and empty the buffer
	return $output;
}

add_shortcode('english_date', 'render_gregorian_date');
function render_gregorian_date() {

	$bddp_options = get_option("bddp_options");
	$bddp_options = get_option("bddp_options");
	if (!is_array($bddp_options)) {
		$bddp_options = array(
			'separator' => ', ',
			'last_word' => '1',
			'ord_suffix' => '1'
		);
	}

	$separator = isset($bddp_options['separator']) ? $bddp_options['separator'] : ', ';
	$last_word = isset($bddp_options['last_word']) ? " খ্রিস্টাব্দ" : "";

	$day_number = array( "1" => "১লা", "2" => "২রা", "3" => "৩রা", "4" => "৪ঠা", "5" => "৫ই", "6" => "৬ই", "7" => "৭ই", "8" => "৮ই", "9" => "৯ই", "10" => "১০ই", "11" => "১১ই", "12" => "১২ই", "13" => "১৩ই", "14" => "১৪ই", "15" => "১৫ই", "16" => "১৬ই", "17" => "১৭ই", "18" => "১৮ই", "19" => "১৯শে", "20" => "২০শে", "21" => "২১শে", "22" => "২২শে", "23" => "২৩শে", "24" => "২৪শে", "25" => "২৫শে", "26" => "২৬শে", "27" => "২৭শে", "28" => "২৮শে", "29" => "২৯শে", "30" => "৩০শে", "31" => "৩১শে" );

	ob_start(); // begin output buffering

	$offset = isset($bddp_options['en_tz']) ? $bddp_options['en_tz']*60*60 : 21600;
	$date = explode(' ', gmdate( "j F Y", time()+$offset ));
	
	$day = isset($bddp_options['ord_suffix']) ? $day_number[$date[0]] : en_to_bn($date[0]);
	$month_year = en_to_bn($date[1].$separator.$date[2]);
	
	echo $day.' '.$month_year.$last_word;

	$output = ob_get_contents(); // end output buffering
	ob_end_clean(); // grab the buffer contents and empty the buffer
	return $output;
}

add_shortcode('hijri_date', 'render_hijri_date');
function render_hijri_date() {

	$bddp_options = get_option( "bddp_options" );
	if ( !is_array( $bddp_options ) ) {
		$bddp_options = array(
			'hijri_tz' => '6',
			'hijri_adjust' => '0',
			'separator' => ', ',
			'last_word' => '1',
			'ord_suffix' => '1' );
	}
	
	if(!array_key_exists('hijri_tz', $bddp_options)) {
		$bddp_options['hijri_tz'] = 6;
	}

	$last_word = isset($bddp_options['last_word']) ? " হিজরি" : "";

	$d = new uCal;

	$day_number = array( "1" => "১লা", "2" => "২রা", "3" => "৩রা", "4" => "৪ঠা", "5" => "৫ই", "6" => "৬ই", "7" => "৭ই", "8" => "৮ই", "9" => "৯ই", "10" => "১০ই", "11" => "১১ই", "12" => "১২ই", "13" => "১৩ই", "14" => "১৪ই", "15" => "১৫ই", "16" => "১৬ই", "17" => "১৭ই", "18" => "১৮ই", "19" => "১৯শে", "20" => "২০শে", "21" => "২১শে", "22" => "২২শে", "23" => "২৩শে", "24" => "২৪শে", "25" => "২৫শে", "26" => "২৬শে", "27" => "২৭শে", "28" => "২৮শে", "29" => "২৯শে", "30" => "৩০শে", "31" => "৩১শে" );

	$month_name = array( "Muh" => "মহর্‌রম", "Saf" => "সফর", "Rb1" => "রবিউল আউয়াল", "Rb2" => "রবিউস সানি", "Jm1" => "জমাদিউল আউয়াল", "Jm2" => "জমাদিউস সানি", "Raj" => "রজব", "Shb" => "শাবান", "Rmd" => "রমজান", "Shw" => "শাওয়াল", "DhQ" => "জিলকদ", "DhH" => "জিলহজ" );

	$separator = isset($bddp_options['separator']) ? $bddp_options['separator'] : ', ';
	$offset =  ($bddp_options['hijri_adjust']*60*60) + ($bddp_options['hijri_tz']*60*60);
	$timestamp = strtotime(gmdate('Y-m-d', time()+$offset));
	$date = explode(' ', $d->date( "j M Y", $timestamp));
	
	$day = isset($bddp_options['ord_suffix']) ? $day_number[$date[0]] : en_to_bn($date[0]);
	$month_year = $month_name[$date[1]].$separator.en_to_bn($date[2]);
	
	ob_start(); // begin output buffering
	
	echo $day.' '.$month_year.$last_word;

	$output = ob_get_contents(); // end output buffering
	ob_end_clean(); // grab the buffer contents and empty the buffer
	return $output;
}


//================== Widgets ========================
require __DIR__.'/widgets.php';

// ========== Action Links =================
function bddp_action_links( $links ) {
	$links[] = '<a href="' . get_admin_url( null, 'options-general.php?page=bangla-date-display' ) . '">Settings</a>';
	return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'bddp_action_links' );


// ============ Setings ========================
if (is_admin()) {
	include 'bddp_admin.php';
}

?>