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
 class HytteGuiden_About_Widget extends WP_Widget {
	/**
	 * Sets up a new Custom Menu widget instance.
	 *
	 * @since 3.0.0
	 * @access public
	 */
   public function __construct() {
       parent::__construct(
           'hytteguiden_footer_about_widget',
           __( 'HytteGuiden About Section', 'hytteguiden' ),
           array(
               'classname'   => 'hytteguiden_footer_about_widget',
               'description' => __( 'Add about section for footer widget area.', 'hytteguiden' )
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

    $social_links = '';
    $hytte_logo    = isset($instance['hytte_logo']) ?  $instance['hytte_logo']  : '';
    $hytte_desc    = isset($instance['hytte_desc']) ?  $instance['hytte_desc']  : '';
    $hytteg_facebook_link    = isset($instance['hytteg_facebook_link']) ?  $instance['hytteg_facebook_link']  : '';
    $hytte_twitter_link      = isset($instance['hytte_twitter_link']) ?  $instance['hytte_twitter_link']  : '';
    $hytte_pinterest_link    = isset($instance['hytte_pinterest_link']) ?  $instance['hytte_pinterest_link']  : '';
    $hytte_instagram_link    = isset($instance['hytte_instagram_link']) ?  $instance['hytte_instagram_link']  : '';


    if(isset($hytte_logo) && !empty($hytte_logo)){
      echo '<div class="footlogo"><img src="'. $hytte_logo.'" alt=""></div>';
    } else if ( !empty($instance['title']) ) {
      echo $args['before_title'] . $instance['title'] . $args['after_title'];
    }

    if(isset($hytte_desc) && !empty($hytte_desc)){
      echo '<div class="foottext"><p> '. $hytte_desc .'</p></div>';
    }

    if(isset($hytteg_facebook_link) && !empty($hytteg_facebook_link)){
      $social_links .= '<li><a href="'. $hytteg_facebook_link .'" target="_blank"><i class="fab fa-facebook-f"></i></a></li>';
    }

    if(isset($hytte_twitter_link) && !empty($hytte_twitter_link)){
      $social_links .= '<li><a href="'. $hytte_twitter_link .'" target="_blank"><i class="fab fa-twitter"></i></a></li>';
    }

    if(isset($hytte_pinterest_link) && !empty($hytte_pinterest_link)){
      $social_links .= '<li><a href="'. $hytte_pinterest_link .'" target="_blank"><i class="fab fa-pinterest"></i></a></li>';
    }

    if(isset($hytte_instagram_link) && !empty($hytte_instagram_link)){
      $social_links .= '<li><a href="'. $hytte_instagram_link .'" target="_blank"><i class="fab fa-instagram"></i></a></li>';
    }

    if( isset($social_links) && !empty($social_links)){
        echo '<ul class="footsocial">'. $social_links . '</ul>';
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
      $instance['hytte_desc']  = strip_tags( $new_instance['hytte_desc'] );
      $instance['hytte_logo']    = strip_tags( $new_instance['hytte_logo'] );
      $instance['hytteg_facebook_link']    = strip_tags( $new_instance['hytteg_facebook_link'] );
      $instance['hytte_twitter_link']    = strip_tags( $new_instance['hytte_twitter_link'] );
      $instance['hytte_pinterest_link']    = strip_tags( $new_instance['hytte_pinterest_link'] );
      $instance['hytte_instagram_link']    = strip_tags( $new_instance['hytte_instagram_link'] );

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
    $hytte_desc  = isset($instance['hytte_desc']) ? esc_attr( $instance['hytte_desc'] ) : '';
    $hytte_logo    = isset($instance['hytte_logo']) ? esc_attr( $instance['hytte_logo'] ) : '';
    $hytteg_facebook_link    = isset($instance['hytteg_facebook_link']) ? esc_attr( $instance['hytteg_facebook_link'] ) : '';
    $hytte_twitter_link    = isset($instance['hytte_twitter_link']) ? esc_attr( $instance['hytte_twitter_link'] ) : '';
    $hytte_pinterest_link    = isset($instance['hytte_pinterest_link']) ? esc_attr( $instance['hytte_pinterest_link'] ) : '';
    $hytte_instagram_link    = isset($instance['hytte_instagram_link']) ? esc_attr( $instance['hytte_instagram_link'] ) : '';

     ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title *', 'hytteguiden' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('hytte_logo'); ?>"><?php _e( 'Logo Image Path', 'hytteguiden' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('hytte_logo'); ?>" name="<?php echo $this->get_field_name('hytte_logo'); ?>" type="text" value="<?php echo $hytte_logo; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('hytte_desc'); ?>"><?php _e( 'Short Description', 'hytteguiden' ); ?></label>
            <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('hytte_desc'); ?>" name="<?php echo $this->get_field_name('hytte_desc'); ?>"><?php echo $hytte_desc; ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('hytteg_facebook_link'); ?>"><?php _e( 'Facebook Link', 'hytteguiden' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('hytteg_facebook_link'); ?>" name="<?php echo $this->get_field_name('hytteg_facebook_link'); ?>" type="text" value="<?php echo $hytteg_facebook_link; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('hytte_twitter_link'); ?>"><?php _e( 'Twitter Link', 'hytteguiden' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('hytte_twitter_link'); ?>" name="<?php echo $this->get_field_name('hytte_twitter_link'); ?>" type="text" value="<?php echo $hytte_twitter_link; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('hytte_pinterest_link'); ?>"><?php _e( 'Pinterest Link', 'hytteguiden' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('hytte_pinterest_link'); ?>" name="<?php echo $this->get_field_name('hytte_pinterest_link'); ?>" type="text" value="<?php echo $hytte_pinterest_link; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('hytte_instagram_link'); ?>"><?php _e( 'Instagram Link', 'hytteguiden' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('hytte_instagram_link'); ?>" name="<?php echo $this->get_field_name('hytte_instagram_link'); ?>" type="text" value="<?php echo $hytte_instagram_link; ?>" />
        </p>

		<?php
	}
}

add_action( 'widgets_init', function(){
    register_widget( 'HytteGuiden_About_Widget' );
});

?>
