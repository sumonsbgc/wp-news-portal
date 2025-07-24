<?php
$theme_options = new \Eis\ThemeOption\Admin\ThemeOptions();

// Handle status messages
$status_message = '';
$status_class = '';

if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
            $status_message = __('Options saved successfully!', 'eis');
            $status_class = 'notice-success';
            break;
        case 'error':
            $status_message = __('An error occurred while saving options. Please try again.', 'eis');
            $status_class = 'notice-error';
            break;
    }
}

// Get existing values
$salat_times = $theme_options->get_array_option('salat', [
    'zohor' => '',
    'asor' => '',
    'margib' => '',
    'isha' => '',
    'fazar' => '',
    'sunrise' => ''
]);

$sports_data = $theme_options->get_array_option('sports', [
    ['sports_name' => '', 'sports_news' => '']
]);

$playlist_ids = $theme_options->get_array_option('ytd_playlist_id', ['']);
?>

<div class="wrap eis-theme-options">
    <?php if ($status_message): ?>
        <div class="notice <?php echo esc_attr($status_class); ?> is-dismissible">
            <p><?php echo esc_html($status_message); ?></p>
        </div>
    <?php endif; ?>

    <div class="eis-header">
        <h1 class="wp-heading-inline">
            <span class="dashicons dashicons-admin-settings"></span>
            <?php _e('Theme Options', 'eis'); ?>
        </h1>
        <p class="description"><?php _e('Configure your theme settings below', 'eis'); ?></p>
    </div>

    <form action="<?php echo admin_url('admin.php?page=dp-theme-options'); ?>" method="post" enctype="multipart/form-data" class="eis-options-form">
        <div class="eis-form-sections">

            <!-- Prayer Times Section -->
            <div class="eis-section">
                <div class="eis-section-header">
                    <h2><span class="dashicons dashicons-clock"></span> <?php _e('নামাজের সময়সূচি', 'eis'); ?></h2>
                </div>
                <div class="eis-section-content">
                    <div class="salat-grid">
                        <div class="salat-time-input">
                            <label for="salat_zohor"><?php _e('যোহর', 'eis'); ?></label>
                            <input name="salat[zohor]" type="time" id="salat_zohor"
                                value="<?php echo esc_attr($salat_times['zohor']); ?>" />
                        </div>
                        <div class="salat-time-input">
                            <label for="salat_asor"><?php _e('আছর', 'eis'); ?></label>
                            <input name="salat[asor]" type="time" id="salat_asor"
                                value="<?php echo esc_attr($salat_times['asor']); ?>" />
                        </div>
                        <div class="salat-time-input">
                            <label for="salat_margib"><?php _e('মাগরিব', 'eis'); ?></label>
                            <input name="salat[margib]" type="time" id="salat_margib"
                                value="<?php echo esc_attr($salat_times['margib']); ?>" />
                        </div>
                        <div class="salat-time-input">
                            <label for="salat_isha"><?php _e('এশার', 'eis'); ?></label>
                            <input name="salat[isha]" type="time" id="salat_isha"
                                value="<?php echo esc_attr($salat_times['isha']); ?>" />
                        </div>
                        <div class="salat-time-input">
                            <label for="salat_fazar"><?php _e('ফজর', 'eis'); ?></label>
                            <input name="salat[fazar]" type="time" id="salat_fazar"
                                value="<?php echo esc_attr($salat_times['fazar']); ?>" />
                        </div>
                        <div class="salat-time-input">
                            <label for="salat_sunrise"><?php _e('সুর্যোদয়', 'eis'); ?></label>
                            <input name="salat[sunrise]" type="time" id="salat_sunrise"
                                value="<?php echo esc_attr($salat_times['sunrise']); ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- General Information Section -->
            <div class="eis-section">
                <div class="eis-section-header">
                    <h2><span class="dashicons dashicons-admin-users"></span> <?php _e('General Information', 'eis'); ?></h2>
                </div>
                <div class="eis-section-content">
                    <div class="eis-form-row">
                        <label for="editor_name"><?php _e('Editor Name', 'eis'); ?></label>
                        <input name="editor_name" type="text" id="editor_name"
                            value="<?php echo esc_attr($theme_options->get_option('editor_name')); ?>" class="regular-text"
                            placeholder="<?php _e('Enter editor name', 'eis'); ?>" />
                    </div>

                    <div class="eis-form-row">
                        <label for="publisher_name"><?php _e('Publisher Name', 'eis'); ?></label>
                        <input name="publisher_name" type="text" id="publisher_name"
                            value="<?php echo esc_attr($theme_options->get_option('publisher_name')); ?>" class="regular-text"
                            placeholder="<?php _e('Enter publisher name', 'eis'); ?>" />
                    </div>

                    <div class="eis-form-row">
                        <label for="online_poll"><?php _e('অনলাইন জরিপ', 'eis'); ?></label>
                        <input name="online_poll" type="text" id="online_poll" class="regular-text"
                            value="<?php echo esc_attr($theme_options->get_option('online_poll')); ?>"
                            placeholder="<?php _e('Enter online poll content', 'eis'); ?>" />
                    </div>
                </div>
            </div>

            <!-- YouTube Configuration Section -->
            <div class="eis-section">
                <div class="eis-section-header">
                    <h2><span class="dashicons dashicons-video-alt3"></span> <?php _e('YouTube Configuration', 'eis'); ?></h2>
                </div>
                <div class="eis-section-content">
                    <div class="eis-form-row">
                        <label for="ytd_api_key"><?php _e('YouTube API Key', 'eis'); ?></label>
                        <input name="ytd_api_key" type="text" id="ytd_api_key"
                            value="<?php echo esc_attr($theme_options->get_option('ytd_api_key')); ?>" class="regular-text"
                            placeholder="<?php _e('Enter YouTube API Key', 'eis'); ?>" />
                        <p class="description"><?php _e('Get your API key from Google Developer Console', 'eis'); ?></p>
                    </div>

                    <div class="eis-form-row">
                        <label for="ytd_channel_id"><?php _e('YouTube Channel ID', 'eis'); ?></label>
                        <input name="ytd_channel_id" type="text" id="ytd_channel_id"
                            value="<?php echo esc_attr($theme_options->get_option('ytd_channel_id')); ?>" class="regular-text"
                            placeholder="<?php _e('Enter YouTube Channel ID', 'eis'); ?>" />
                    </div>

                    <div class="eis-form-row">
                        <label><?php _e('YouTube Playlist IDs', 'eis'); ?></label>
                        <div id="youtube-playlist-container" class="dynamic-fields">
                            <?php foreach ($playlist_ids as $index => $playlist_id): ?>
                                <div class="dynamic-field-row">
                                    <input name="ytd_playlist_id[]" type="text" value="<?php echo esc_attr($playlist_id); ?>"
                                        class="regular-text" placeholder="<?php _e('Enter Playlist ID', 'eis'); ?>" />
                                    <?php if ($index > 0): ?>
                                        <button type="button" class="button-secondary remove-field">
                                            <span class="dashicons dashicons-dismiss"></span>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" id="add-youtube-playlist" class="button-secondary">
                            <span class="dashicons dashicons-plus-alt"></span> <?php _e('Add Playlist', 'eis'); ?>
                        </button>
                    </div>
                </div>
            </div>

            <!-- E-Paper Section -->
            <div class="eis-section">
                <div class="eis-section-header">
                    <h2><span class="dashicons dashicons-media-document"></span> <?php _e('ই-পেপার', 'eis'); ?></h2>
                </div>
                <div class="eis-section-content">
                    <div class="eis-form-row">
                        <label><?php _e('Upload E-Paper', 'eis'); ?></label>
                        <div class="image-upload-container">
                            <div class="image-preview" id="imagePreview">
                                <?php
                                $epaper_url = $theme_options->get_option('epaper_url');
                                if ($epaper_url): ?>
                                    <img src="<?php echo esc_url($epaper_url); ?>" class="preview-image" />
                                <?php endif; ?>
                            </div>
                            <div class="upload-controls">
                                <input type="file" id="imageInput" name="epaper" accept="image/*" style="display: none;" />
                                <button type="button" id="uploadBtn" class="button-secondary">
                                    <span class="dashicons dashicons-upload"></span> <?php _e('Upload Image', 'eis'); ?>
                                </button>
                                <button type="button" id="removeBtn" class="button-secondary"
                                    style="<?php echo $epaper_url ? '' : 'display: none;'; ?>">
                                    <span class="dashicons dashicons-trash"></span> <?php _e('Remove', 'eis'); ?>
                                </button>
                            </div>
                            <p class="description"><?php _e('Upload an image file for the e-paper section.', 'eis'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sports News Section -->
            <div class="eis-section">
                <div class="eis-section-header">
                    <h2><span class="dashicons dashicons-awards"></span> <?php _e('Sports News', 'eis'); ?></h2>
                </div>
                <div class="eis-section-content">
                    <div id="sports-container" class="dynamic-fields">
                        <?php foreach ($sports_data as $index => $sport): ?>
                            <div class="sports-row dynamic-field-row">
                                <div class="sports-inputs">
                                    <div class="input-group">
                                        <label><?php _e('Sports Name', 'eis'); ?></label>
                                        <input type="text" name="sports[<?php echo $index; ?>][sports_name]"
                                            value="<?php echo esc_attr($sport['sports_name']); ?>" class="regular-text"
                                            placeholder="<?php _e('Enter sports name', 'eis'); ?>" />
                                    </div>
                                    <div class="input-group">
                                        <label><?php _e('Sports News', 'eis'); ?></label>
                                        <textarea name="sports[<?php echo $index; ?>][sports_news]" rows="1" class="large-text"
                                            placeholder="<?php _e('Enter sports news', 'eis'); ?>"><?php echo esc_textarea($sport['sports_news']); ?></textarea>
                                    </div>
                                </div>
                                <?php if ($index > 0): ?>
                                    <button type="button" class="button-secondary remove-sports">
                                        <span class="dashicons dashicons-dismiss"></span> <?php _e('Remove', 'eis'); ?>
                                    </button>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" id="add-sports-news" class="button-secondary">
                        <span class="dashicons dashicons-plus-alt"></span> <?php _e('Add Sports News', 'eis'); ?>
                    </button>
                </div>
            </div>

        </div>

        <?php wp_nonce_field('dpkone-options'); ?>

        <div class="eis-form-footer">
            <?php submit_button(__('Save All Options', 'eis'), 'primary large', 'submit_options'); ?>
        </div>
    </form>
</div>