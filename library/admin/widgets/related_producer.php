<?php
/**
 * Widget API: WP_Nav_Menu_Widget class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */
/**
 * Core class used to implement the Custom Menu widget.
 *
 * @since 3.0.0
 *
 * @see WP_Widget
 */
 class HytteGuiden_Related_Producer_Widget extends WP_Widget {
	/**
	 * Sets up a new Custom Menu widget instance.
	 *
	 * @since 3.0.0
	 * @access public
	 */
   public function __construct() {
       parent::__construct(
           'hytteguiden_related_producer',
           __( 'HytteGuiden Related Producer', 'hytteguiden' ),
           array(
               'classname'   => 'hytteguiden_related_producer',
               'description' => __( 'Add related producer to news.', 'hytteguiden' )
               )
       );
   }
	/**
	 * Outputs the content for the current Custom Menu widget instance.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Custom Menu widget instance.
	 */
	public function widget( $args, $instance ) {

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		echo $args['before_widget'];

    if ( !empty($instance['title']) ) {
      echo $args['before_title'] . $instance['title'] . $args['after_title'];
    }

        $post_producer_id = get_post_meta( get_the_ID(), 'post_producer_id', true);
				if(isset($post_producer_id) && !empty($post_producer_id)){
          echo '<div class="news-producer-logo">';
							echo '<a href="'.get_permalink($post_producer_id).'">';
							echo get_the_post_thumbnail( $post_producer_id, 'full','', array( "class" => "img-fluid" ) );
							echo '</a>';
							echo '</div>';
        }

		  echo $args['after_widget'];
	}
	/**
	 * Handles updating settings for the current Custom Menu widget instance.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
      $instance                     = $old_instance;
      $instance['title']            = strip_tags( $new_instance['title'] );

      return $instance;
	}
	/**
	 * Outputs the settings form for the Custom Menu widget.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
    $title       = isset($instance['title']) ? esc_attr( $instance['title'] ) : '';
     ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title *', 'hytteguiden' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

		<?php
	}
}

add_action( 'widgets_init', function(){
    register_widget( 'HytteGuiden_Related_Producer_Widget' );
});

?>
