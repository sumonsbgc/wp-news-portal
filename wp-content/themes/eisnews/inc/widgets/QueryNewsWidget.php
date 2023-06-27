<?php

class QueryNewsWidget extends WP_Widget
{

    public function __construct()
    {
        // actual widget processes
        $options = array(
            'classname'   => 'query_news_widgets',
            'description' => 'Query News Widget Descriptions',
        );
        parent::__construct('eis_widget', 'Query News Widget', $options);
        $this->init();
    }

    public function init()
    {
        add_action('widgets_init', function () {
            register_widget(__CLASS__);
        });
    }

    public function form($instance)
    {
        // $selected_category = ! empty( $instance['category'] ) ? $instance['category'] : '';
        // $template = ! empty( $instance['template'] ) ? $instance['template'] : '';    
        // Output the form HTML
        if (!isset($instance['category']) && empty($instance['category'])) {
            $selected_category = "main-news";
        } else {
            $selected_category = $instance['category'];
        }

        if (!isset($instance['template']) && empty($instance['template'])) {
            $template = "col-three";
        } else {
            $template = $instance['template'];
        }

        // printf("<p>");
        // printf('<label for="%s">%s</label>', esc_attr($this->get_field_id('category')), esc_html("Select Your Category"));
        // printf(
        //     '<input class="widefat" type="text" name="%s" id="%s" value="%s">',
        //     esc_attr($this->get_field_name('category')),
        //     esc_attr($this->get_field_id('category')),
        //     esc_attr($category)
        // );
        // printf("</p>");

        // Retrieve the list of categories
        $categories = get_categories();
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>">Select a Category:</label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" multiple>
                <?php foreach ( $categories as $category ) : ?>
                    <option value="<?php echo esc_attr( $category->slug ); ?>" <?php selected( $selected_category, $category->slug ); ?>>
                        <?php echo esc_html( $category->name ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <?php

        printf("<p>");
        printf('<label for="%s">%s</label>', esc_attr($this->get_field_id('template')), esc_html("Select Your template"));
        printf(
            '<input class="widefat" type="text" name="%s" id="%s" value="%s">',
            esc_attr($this->get_field_name('template')),
            esc_attr($this->get_field_id('template')),
            esc_attr($template)
        );
        printf("</p>");
    }

    public function widget($args, $instance)
    {
        // dd($instance);
        // $categories = explode(",", rtrim($instance["category"], ", "));
        $categories = $instance["category"];
        $count = is_array($categories) ? count($categories) : 1;
        $col = 12 / $count;
        $col = 12;
        // foreach ($categories as $cat) {
            $q = new WP_Query([
                "post_type"      => "post",
                "posts_per_page" => 4,
                "category_slug" => $instance["category"]
            ]);
            if (1 < $count && 1 !== $count) :

                printf('<div class="col-%s">', $col);
                printf('<div class="row main-news">');

                printf('<div class="col-12 pb-2 pt-3">');
                eis_news_section_title($cat, 'section_title', 'bg_black');
                printf('</div>');

                while ($q->have_posts()) {
                    $q->the_post();
                    get_template_part("templates/{$instance['template']}");
                }

                printf('</div>');
                printf('</div>');
            else :
                printf('<div class="col-12 pb-2 pt-3">');
                eis_news_section_title($cat, 'section_title', 'bg_black');
                printf('</div>');
                while ($q->have_posts()) {
                    $q->the_post();
                    get_template_part('templates/col-three');
                }
            endif;
        // }
    }
}

new QueryNewsWidget();
