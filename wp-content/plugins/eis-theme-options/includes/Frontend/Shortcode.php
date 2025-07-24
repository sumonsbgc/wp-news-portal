<?php

namespace Eis\ThemeOption\Frontend;

use Eis\ThemeOption\OptionsHelper;

class Shortcode
{
    public function __construct()
    {
        add_shortcode('eis_prayer_times', [$this, 'prayer_times_shortcode']);
        add_shortcode('eis_sports_news', [$this, 'sports_news_shortcode']);
        add_shortcode('eis_epaper', [$this, 'epaper_shortcode']);
        add_shortcode('eis_publication_info', [$this, 'publication_info_shortcode']);

        // Legacy shortcode
        add_shortcode('dp-theme-options', [$this, 'render_shortcode']);
    }

    /**
     * Legacy shortcode
     */
    public function render_shortcode($atts, $content = '')
    {
        return $this->publication_info_shortcode($atts);
    }

    /**
     * Prayer times shortcode
     * Usage: [eis_prayer_times]
     */
    public function prayer_times_shortcode($atts = [])
    {
        $atts = shortcode_atts([
            'class' => 'eis-prayer-times',
            'title' => __('Prayer Times', 'eis')
        ], $atts);

        $helper = OptionsHelper::getInstance();
        $prayer_times = $helper->get_salat_times();

        if (empty(array_filter($prayer_times))) {
            return '';
        }

        $output = '<div class="' . esc_attr($atts['class']) . '">';

        if ($atts['title']) {
            $output .= '<h3>' . esc_html($atts['title']) . '</h3>';
        }

        $output .= '<ul class="prayer-times-list">';

        $prayer_labels = [
            'fazar' => __('ফজর', 'eis'),
            'sunrise' => __('সুর্যোদয়', 'eis'),
            'zohor' => __('যোহর', 'eis'),
            'asor' => __('আছর', 'eis'),
            'margib' => __('মাগরিব', 'eis'),
            'isha' => __('এশার', 'eis')
        ];

        foreach ($prayer_labels as $key => $label) {
            if (!empty($prayer_times[$key])) {
                $formatted_time = date('g:i A', strtotime($prayer_times[$key]));
                $output .= '<li class="prayer-time-item">';
                $output .= '<span class="prayer-name">' . esc_html($label) . '</span>';
                $output .= '<span class="prayer-time">' . esc_html($formatted_time) . '</span>';
                $output .= '</li>';
            }
        }

        $output .= '</ul></div>';

        return $output;
    }

    /**
     * Sports news shortcode
     * Usage: [eis_sports_news limit="5"]
     */
    public function sports_news_shortcode($atts = [])
    {
        $atts = shortcode_atts([
            'limit' => -1,
            'class' => 'eis-sports-news',
            'title' => __('Sports News', 'eis')
        ], $atts);

        $helper = OptionsHelper::getInstance();
        $sports_news = $helper->get_sports_news();

        if (empty($sports_news)) {
            return '';
        }

        if ($atts['limit'] > 0) {
            $sports_news = array_slice($sports_news, 0, $atts['limit']);
        }

        $output = '<div class="' . esc_attr($atts['class']) . '">';

        if ($atts['title']) {
            $output .= '<h3>' . esc_html($atts['title']) . '</h3>';
        }

        $output .= '<div class="sports-news-list">';

        foreach ($sports_news as $sport) {
            if (!empty($sport['sports_name']) && !empty($sport['sports_news'])) {
                $output .= '<div class="sports-news-item">';
                $output .= '<h4 class="sports-name">' . esc_html($sport['sports_name']) . '</h4>';
                $output .= '<p class="sports-news">' . esc_html($sport['sports_news']) . '</p>';
                $output .= '</div>';
            }
        }

        $output .= '</div></div>';

        return $output;
    }

    /**
     * E-paper shortcode
     * Usage: [eis_epaper]
     */
    public function epaper_shortcode($atts = [])
    {
        $atts = shortcode_atts([
            'class' => 'eis-epaper',
            'title' => __('E-Paper', 'eis'),
            'width' => '100%',
            'height' => 'auto'
        ], $atts);

        $helper = OptionsHelper::getInstance();
        $epaper_info = $helper->get_epaper_info();

        if (empty($epaper_info['url'])) {
            return '';
        }

        $output = '<div class="' . esc_attr($atts['class']) . '">';

        if ($atts['title']) {
            $output .= '<h3>' . esc_html($atts['title']) . '</h3>';
        }

        $output .= '<div class="epaper-container">';
        $output .= '<img src="' . esc_url($epaper_info['url']) . '" ';
        $output .= 'alt="' . esc_attr($atts['title']) . '" ';
        $output .= 'style="width: ' . esc_attr($atts['width']) . '; height: ' . esc_attr($atts['height']) . '; max-width: 100%;" />';
        $output .= '</div></div>';

        return $output;
    }

    /**
     * Publication info shortcode
     * Usage: [eis_publication_info type="editor"]
     */
    public function publication_info_shortcode($atts = [])
    {
        $atts = shortcode_atts([
            'type' => 'all', // editor, publisher, poll, all
            'class' => 'eis-publication-info'
        ], $atts);

        $helper = OptionsHelper::getInstance();
        $pub_info = $helper->get_publication_info();

        $output = '<div class="' . esc_attr($atts['class']) . '">';

        switch ($atts['type']) {
            case 'editor':
                if (!empty($pub_info['editor_name'])) {
                    $output .= '<span class="editor-info">';
                    $output .= __('Editor: ', 'eis') . esc_html($pub_info['editor_name']);
                    $output .= '</span>';
                }
                break;

            case 'publisher':
                if (!empty($pub_info['publisher_name'])) {
                    $output .= '<span class="publisher-info">';
                    $output .= __('Publisher: ', 'eis') . esc_html($pub_info['publisher_name']);
                    $output .= '</span>';
                }
                break;

            case 'poll':
                if (!empty($pub_info['online_poll'])) {
                    $output .= '<div class="online-poll">';
                    $output .= '<h4>' . __('Online Poll', 'eis') . '</h4>';
                    $output .= '<p>' . esc_html($pub_info['online_poll']) . '</p>';
                    $output .= '</div>';
                }
                break;

            default: // all
                if (!empty($pub_info['editor_name'])) {
                    $output .= '<p class="editor-info">';
                    $output .= '<strong>' . __('Editor: ', 'eis') . '</strong>' . esc_html($pub_info['editor_name']);
                    $output .= '</p>';
                }

                if (!empty($pub_info['publisher_name'])) {
                    $output .= '<p class="publisher-info">';
                    $output .= '<strong>' . __('Publisher: ', 'eis') . '</strong>' . esc_html($pub_info['publisher_name']);
                    $output .= '</p>';
                }

                if (!empty($pub_info['online_poll'])) {
                    $output .= '<div class="online-poll">';
                    $output .= '<h4>' . __('Online Poll', 'eis') . '</h4>';
                    $output .= '<p>' . esc_html($pub_info['online_poll']) . '</p>';
                    $output .= '</div>';
                }
                break;
        }

        $output .= '</div>';

        return $output;
    }
}