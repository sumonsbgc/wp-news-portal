<?php
if (isset($_GET['status']) && $_GET['status'] === 'success') {
  echo '<div class="notice notice-success is-dismissible">
            <p>Options saved successfully.</p>
          </div>';
}

?>
<div class="wrap">
  <h1 class="wp-heading-inline">Theme Options</h1>
  <form action="" method="post">
    <table class="form-table" role="presentation">
      <tbody>
        <tr>
          <th scope="row"><label for=""><?php _e('নামাজের সময়সূচি', 'eis'); ?></label></th>
          <td>
            <div class="grid-cols-3">
              <div class="input-group">
                <label for=""><?php _e('যোহর ', 'eis'); ?></label>
                <input name="salat[zohor]" type="text" id="salat_routine" value="" class="w-full" />
              </div>

              <div class="input-group">
                <label for=""><?php _e('আছর', 'eis'); ?></label>
                <input name="salat[asor]" type="text" id="salat_routine" value="" class="w-full" />
              </div>

              <div class="input-group">
                <label for=""><?php _e('মাগরিব ', 'eis'); ?></label>
                <input name="salat[margib]" type="text" id="salat_routine" value="" class="w-full" />
              </div>

              <div class="input-group">
                <label for=""><?php _e('এশার', 'eis'); ?></label>
                <input name="salat[isha]" type="text" id="salat_routine" value="" class="w-full" />
              </div>

              <div class="input-group">
                <label for=""><?php _e('ফজর', 'eis'); ?></label>
                <input name="salat[fazar]" type="text" id="salat_routine" value="" class="w-full" />
              </div>

              <div class="input-group">
                <label for=""><?php _e('সুর্যোদয়', 'eis'); ?></label>
                <input name="salat[sunrise]" type="text" id="salat_routine" value="" class="w-full" />
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for=""><?php _e('Editor Name', 'eis'); ?></label></th>
          <td>
            <input name="editor_name" type="text" id="editor_name" value="" class="regular-text" />
          </td>
        </tr>
        <tr>
          <th><label><?php _e('Publisher Name', 'eis'); ?></label></th>
          <td>
            <input name="publisher_name" type="text" id="publisher_name" value="" class="regular-text" />
          </td>
        </tr>
        <tr>
          <th><label><?php _e('অনলাইন জরিপ', 'eis'); ?></label></th>
          <td>
            <input name="online_poll" type="text" id="online_poll" value="" class="regular-text" />
          </td>
        </tr>
        <tr>
          <th><label><?php _e('Youtube API Key', 'eis'); ?></label></th>
          <td>
            <input name="ytd_api_key" type="text" id="ytd_api_key" value="" class="regular-text" />
          </td>
        </tr>
        <tr>
          <th><label><?php _e('Youtube Channel ID', 'eis'); ?></label></th>
          <td>
            <input name="ytd_channel_id" type="text" id="ytd_channel_id" value="" class="regular-text" />
          </td>
        </tr>
        <tr>
          <th><label><?php _e('Youtube Playlist ID', 'eis'); ?></label></th>
          <td>
            <div>
              <input name="ytd_playlist_id[]" type="text" id="salat_routine" value="" class="regular-text" />
            </div>

            <div>
              <input name="ytd_playlist_id[]" type="text" id="salat_routine" value="" class="regular-text" />
            </div>
          </td>
        </tr>
        <tr>
          <th><label><?php _e('ই-পেপার', 'eis'); ?></label></th>
          <td>
            <input type="file" name="epaper" />
          </td>
        </tr>
        <tr>
          <th><label><?php _e('Sports News', 'eis'); ?></label></th>
          <td>
            <div id="sports-container" class="">
              <div class="flex">
                <div class="input-group ">
                  <label for="">Sports Name</label>
                  <input type="text" class="regular-text" name="sports[0][sports_name]" value=""
                    style="border: 1px solid gray" />
                </div>
                <div class="input-group">
                  <label for="">Sports News</label>
                  <textarea name="sports[0][sports_news]" id="" rows="2" class="regular-text resize"></textarea>
                </div>
              </div>
            </div>
            <div class="flex ">
              <button type="button" id="add-sports-news" class="add-sports-news"><span
                  class="dashicons dashicons-plus-alt"></span> Add New Field</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <?php wp_nonce_field('dpkone-options'); ?>
    <?php submit_button('Save Options', 'primary', 'submit_options',); ?>
  </form>
</div>