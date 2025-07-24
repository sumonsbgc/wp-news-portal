<?php

namespace Eis\ThemeOption;

/**
 * Helper class for retrieving theme options
 */
class OptionsHelper
{
  private static $instance = null;
  private $options_cache = [];

  private function __construct()
  {
    $this->load_all_options();
  }

  public static function getInstance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  /**
   * Load all options from database into cache
   */
  private function load_all_options()
  {
    global $wpdb;
    $table = $wpdb->prefix . 'eis_dp_options';

    $results = $wpdb->get_results("SELECT * FROM {$table}");

    foreach ($results as $row) {
      if ($row->is_serialized) {
        $this->options_cache[$row->option_group] = maybe_unserialize($row->option_value);
      } else {
        if ($row->option_group === 'general') {
          $this->options_cache[$row->option_key] = $row->option_value;
        } else {
          $this->options_cache[$row->option_group][$row->option_key] = $row->option_value;
        }
      }
    }
  }

  /**
   * Get a single option value
   * 
   * @param string $key The option key
   * @param string $group The option group (default: 'general')
   * @param mixed $default Default value if option doesn't exist
   * @return mixed The option value
   */
  public function get_option($key, $group = 'general', $default = '')
  {
    if ($group === 'general') {
      return isset($this->options_cache[$key]) ? $this->options_cache[$key] : $default;
    }

    return isset($this->options_cache[$group][$key]) ? $this->options_cache[$group][$key] : $default;
  }

  /**
   * Get an array of options (like salat times or sports data)
   * 
   * @param string $group The option group
   * @param array $default Default value if group doesn't exist
   * @return array The options array
   */
  public function get_array_option($group, $default = [])
  {
    return isset($this->options_cache[$group]) ? $this->options_cache[$group] : $default;
  }

  /**
   * Get salat times
   * 
   * @return array Array of prayer times
   */
  public function get_salat_times()
  {
    return $this->get_array_option('salat', [
      'zohor' => '',
      'asor' => '',
      'margib' => '',
      'isha' => '',
      'fazar' => '',
      'sunrise' => ''
    ]);
  }

  /**
   * Get sports news data
   * 
   * @return array Array of sports news
   */
  public function get_sports_news()
  {
    return $this->get_array_option('sports', []);
  }

  /**
   * Get YouTube configuration
   * 
   * @return array YouTube configuration
   */
  public function get_youtube_config()
  {
    return [
      'api_key' => $this->get_option('ytd_api_key'),
      'channel_id' => $this->get_option('ytd_channel_id'),
      'playlist_ids' => $this->get_array_option('ytd_playlist_id', [])
    ];
  }

  /**
   * Get editor and publisher information
   * 
   * @return array Editor and publisher info
   */
  public function get_publication_info()
  {
    return [
      'editor_name' => $this->get_option('editor_name'),
      'publisher_name' => $this->get_option('publisher_name'),
      'online_poll' => $this->get_option('online_poll')
    ];
  }

  /**
   * Get e-paper information
   * 
   * @return array E-paper data
   */
  public function get_epaper_info()
  {
    return [
      'url' => $this->get_option('epaper_url'),
      'id' => $this->get_option('epaper_id')
    ];
  }

  /**
   * Clear options cache (useful after updates)
   */
  public function clear_cache()
  {
    $this->options_cache = [];
    $this->load_all_options();
  }
}

/**
 * Helper function to get theme options
 * 
 * @param string $key The option key
 * @param string $group The option group (default: 'general')
 * @param mixed $default Default value
 * @return mixed The option value
 */
function eis_get_option($key, $group = 'general', $default = '')
{
  return OptionsHelper::getInstance()->get_option($key, $group, $default);
}

/**
 * Helper function to get array options
 * 
 * @param string $group The option group
 * @param array $default Default value
 * @return array The options array
 */
function eis_get_array_option($group, $default = [])
{
  return OptionsHelper::getInstance()->get_array_option($group, $default);
}

/**
 * Get formatted prayer times for display
 * 
 * @return array Formatted prayer times
 */
function eis_get_prayer_times()
{
  return OptionsHelper::getInstance()->get_salat_times();
}

/**
 * Get sports news for display
 * 
 * @return array Sports news data
 */
function eis_get_sports_news()
{
  return OptionsHelper::getInstance()->get_sports_news();
}

/**
 * Get YouTube configuration
 * 
 * @return array YouTube configuration
 */
function eis_get_youtube_config()
{
  return OptionsHelper::getInstance()->get_youtube_config();
}
