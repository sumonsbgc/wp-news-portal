<?php

class EIS_Theme_Options
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action( 'admin_post_eis_save_theme_options', array( $this, 'save_theme_options' ) );
        add_action('admin_init', [$this, 'register_settings']);
    }

    public function add_admin_menu()
    {
        add_menu_page('EIS Theme Options', 'EIS Theme Options', 'manage_options', 'eis-theme-options', [$this, 'render_options_page']);
    }

    public function register_settings()
    {
        register_setting('eis_theme_options', 'eis_template_name');
        register_setting('eis_theme_options', 'eis_categories');
    }

    public function save_theme_options() {
        // wp_die($_POST['eis_options']);
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Unauthorized user' );
        }
    
        check_admin_referer( 'eis_theme_options_nonce' );
    
        if ( isset( $_POST['eis_options'] ) ) {
            $options = $_POST['eis_options'];
    
            // Sanitize and validate the data as needed
            // ...
    
            update_option( 'eis_options', $options );
    
            // Redirect back to the options page after saving
            wp_redirect( add_query_arg( 'updated', 'true', admin_url( 'admin.php?page=eis_theme_options' ) ) );
            exit;
        }
    
        // Redirect back to the options page if no data was submitted
        wp_redirect( admin_url( 'admin.php?page=eis_theme_options' ) );
        exit;
    }

    public function render_options_page()
    {
?>
        <div class="wrap">
            <h1>EIS Theme Options</h1>
            <form method="post" action="admin-post.php">
                <?php settings_fields('eis_theme_options'); ?>
                <?php do_settings_sections('eis_theme_options'); ?>
                <!-- <?php wp_nonce_field( 'eis_theme_options_nonce' ); ?> -->

                <table class="form-table" id="eis-options-table">
                    <tbody>
                        <?php
                        $options = get_option('eis_options', []);
                        print_r($options);
                        if (!empty($options)) {
                            foreach ($options as $index => $option) {
                                $this->render_options_row($index, $option);
                            }
                        } else {
                            // Render default option row
                            $this->render_options_row(0, array('template_name' => '', 'categories' => []));
                        }
                        ?>
                    </tbody>
                </table>
                <button type="button" id="eis-add-option" class="button">Add Option</button>
                <script>
                    jQuery(document).ready(function($) {
                        function initializeSelect2(element) {
                            element.select2();
                        }

                        $('.select2').each(function() {
                            initializeSelect2($(this));
                        });

                        var table = $('#eis-options-table');
                        var addButton = $('#eis-add-option');
                        var optionIndex = <?php echo count($options) > 0 ? count($options) : 1; ?>;
                        addButton.on("click", function(e) {
                            e.preventDefault();
                            optionIndex++;
                            console.log(optionIndex);
                            var optionRow = $('<tr></tr>').attr('id', 'eis-option-row-' + optionIndex);
                            optionRow.html('<?php $this->render_option_row_js(); ?>');
                            console.log(optionRow);
                            table.find('tbody').append(optionRow);
                            $('.select2').each(function() {
                                initializeSelect2($(this));
                            });
                        });
                    });
                </script>
                <?php submit_button(); ?>
            </form>
        </div>
    <?php
    }

    private function render_options_row(int $index, array $option)
    {
        $categories = get_categories();
        $selectedCats = isset($option['categories']) ? $option['categories'] : [];
    ?>
        <tr>
            <th scope="row">Option <?php echo esc_html($index + 1); ?></th>
            <td>
                <input class="widefat" type="text" name="eis_options[<?php echo esc_attr($index); ?>][template_name]" value="<?php echo esc_attr($option['template_name']); ?>" placeholder="Template Name" />
            </td>
            <td>
                <select class="widefat select2" name="eis_options[<?php echo esc_attr($index); ?>][categories][]" id="eis_options_categories_<?php echo esc_attr($index); ?>" multiple="multiple">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo esc_attr($category->term_id); ?>" <?php selected(in_array($category->term_id, $selectedCats), true); ?>>
                            <?php echo esc_html($category->name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <button type="button" class="eis-remove-option button">Remove</button>
            </td>
        </tr>
    <?php
    }

    private function render_option_row_js()
    {
        ob_start();
    ?>
        <th scope="row">Option '+ optionIndex +'</th>
        <td>
            <input class="widefat" type="text" name="eis_options['+ optionIndex +'][template_name]" placeholder="Template Name" />
        </td>
        <td>
            <select class="widefat select2" name="eis_options['+ optionIndex +'][categories][]" multiple="multiple" style="height: 150px;" id="eis_options_categories_'+ optionIndex +'">
                <?php
                $categories = get_categories();
                foreach ($categories as $category) {
                    echo '<option value="' . esc_attr($category->term_id) . '">' . esc_html($category->name) . '</option>';
                }
                ?>
            </select>
        </td>
        <td>
            <button type="button" class="eis-remove-option button">Remove</button>
        </td>
<?php
        $template = ob_get_clean();
        echo $template !== null ? json_encode($template) : '';
        // $decoded_template = $template !== null ? htmlspecialchars_decode(json_decode($template)) : '';
        // echo $decoded_template;
        // echo json_decode($template);
        // echo htmlspecialchars_decode(json_decode($template));
    }
}

$eis_theme_options = new EIS_Theme_Options;
