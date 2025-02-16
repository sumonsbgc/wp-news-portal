<?php
defined( 'ABSPATH' )or die( 'Stop! You can not do this!' );

add_action( 'widgets_init', function() {
	register_widget( 'Widget_Bangla_Date_Display' );
});

class Widget_Bangla_Date_Display extends WP_Widget {
	function __construct() {
		parent::__construct(
			'bangla_date_display',
			'Bangla Date Display',
			array(
				'description' => __( 'Displays Bangla, Gregorian & Hijri date, time, day and season name.' )
			)
		);
	}
	
	public $args = array(
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
		'before_widget' => '<div class="widget-wrap">',
		'after_widget'  => '</div></div>',
	);

	function widget( $args, $instance ) {

        $boolKeys = ['day', 'time', 'en_date', 'hijri_date', 'bn_date', 'season'];
        foreach($boolKeys as $key) {
            if ( empty( $instance[$key] ) ) {
                $instance[$key] = '';
            }
        }

        //-
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		echo '<div class="textwidget">';
            echo "<ul>";
                if ( $instance[ 'day' ] == "1" || $instance[ 'time' ] == "1" ) {
                    echo "<li>";
                }
                if ( $instance[ 'day' ] == "1" ) {
                    echo render_bangla_day();
                }
                if ( $instance[ 'time' ] == "1" ) {
                    echo " (";
                    echo render_bangla_clock();
                    echo ")";
                }
                if ( $instance[ 'day' ] == "1" || $instance[ 'time' ] == "1" ) {
                    echo "</li>";
                }
                if ( $instance[ 'en_date' ] == "1" ) {
                    echo "<li>";
                    echo render_gregorian_date();
                    echo "</li>";
                }
                if ( $instance[ 'hijri_date' ] == "1" ) {
                    echo "<li>";
                    echo render_hijri_date();
                    echo "</li>";
                }
                if ( $instance[ 'bn_date' ] == "1" || $instance[ 'season' ] == "1" ) {
                    echo "<li>";
                }
                if ( $instance[ 'bn_date' ] == "1" ) {
                    echo render_bangla_date();
                }
                if ( $instance[ 'season' ] == "1" ) {
                    echo " (";
                    echo bddp_bn_season();
                    echo ")";
                }
                if ( $instance[ 'bn_date' ] == "1" || $instance[ 'season' ] == "1" ) {
                    echo "</li>";
                }
            echo "</ul>";
		echo '</div>';
		echo $args['after_widget'];
	}
	
	public function getAttr($instance, $key) {
		return [
			'value' => ! empty( $instance[$key] ) ? $instance[$key] : esc_html__( '', 'bddp' ),
			'id' => esc_attr( $this->get_field_id( $key ) ),
			'name' => esc_attr( $this->get_field_name( $key ) )
		];
	}

	function form( $instance ) {
		$title = $this->getAttr($instance, 'title');
		$day = $this->getAttr($instance, 'day');
		$time = $this->getAttr($instance, 'time');
		$en_date = $this->getAttr($instance, 'en_date');
		$hijri_date = $this->getAttr($instance, 'hijri_date');
		$bn_date = $this->getAttr($instance, 'bn_date');
		$season = $this->getAttr($instance, 'season');
		?>
		<p>
			<label for="<?= $title['id'] ?>"><?php echo esc_html__( 'Title:', 'bddp' ); ?></label>
			<input class="widefat" id="<?= $title['id'] ?>" name="<?= $title['name'] ?>" type="text" value="<?= $title['value'] ?>">
		</p>
        <p>
            <label for="<?= $day['id'] ?>"><input type="checkbox" id="<?= $day['id'] ?>" name="<?= $day['name'] ?>" value="1"<?= ($day['value']=='1'?' checked':'') ?>/>Day</label>
        </p>
        <p>
            <label for="<?= $time['id'] ?>"><input type="checkbox" id="<?= $time['id'] ?>" name="<?= $time['name'] ?>" value="1"<?= ($time['value']=='1'?' checked':'') ?>/>Time</label>
        </p>
        <p>
            <label for="<?= $en_date['id'] ?>"><input type="checkbox" id="<?= $en_date['id'] ?>" name="<?= $en_date['name'] ?>" value="1"<?= ($en_date['value']=='1'?' checked':'') ?>/>Gregorian Date</label>
        </p>
        <p>
            <label for="<?= $hijri_date['id'] ?>"><input type="checkbox" id="<?= $hijri_date['id'] ?>" name="<?= $hijri_date['name'] ?>" value="1"<?= ($hijri_date['value']=='1'?' checked':'') ?>/>Hijri Date</label>
        </p>
        <p>
            <label for="<?= $bn_date['id'] ?>"><input type="checkbox" id="<?= $bn_date['id'] ?>" name="<?= $bn_date['name'] ?>" value="1"<?= ($bn_date['value']=='1'?' checked':'') ?>/>Bangla Date</label>
        </p>
        <p>
            <label for="<?= $season['id'] ?>"><input type="checkbox" id="<?= $season['id'] ?>" name="<?= $season['name'] ?>" value="1"<?= ($season['value']=='1'?' checked':'') ?>/>Season Name</label>
        </p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : 'আজকের দিন-তারিখ';
		$instance['day'] = ( ! empty( $new_instance['day'] ) ) ? strip_tags( $new_instance['day'] ) : '0';
		$instance['time'] = ( ! empty( $new_instance['time'] ) ) ? strip_tags( $new_instance['time'] ) : '0';
		$instance['en_date'] = ( ! empty( $new_instance['en_date'] ) ) ? strip_tags( $new_instance['en_date'] ) : '0';
		$instance['hijri_date'] = ( ! empty( $new_instance['hijri_date'] ) ) ? strip_tags( $new_instance['hijri_date'] ) : '0';
		$instance['bn_date'] = ( ! empty( $new_instance['bn_date'] ) ) ? strip_tags( $new_instance['bn_date'] ) : '0';
		$instance['season'] = ( ! empty( $new_instance['season'] ) ) ? strip_tags( $new_instance['season'] ) : '0';
		return $instance;
	}
}

?>