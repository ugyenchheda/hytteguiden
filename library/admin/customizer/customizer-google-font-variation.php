<?php
if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return NULL;
}
/**
 * A class to create a dropdown for all google fonts
 */
class Hytte_Google_Font_Variation extends WP_Customize_Control {
    private $fonts = false;

    public function __construct( $manager, $id, $args = array(), $options = array() ) {
        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content() {
    	$font 		   		 = '';
    	$font_updated_value  = '';
    	$this_field_id 		 = '';
    	$selected_font 		 = '';
    	$variant_lists 		 = array();
    	$google_api 		 = get_option( 'google_font_api' ); //AIzaSyAjlVAd7y3z2Q-clTeHzkLuA_QskrZjzYo

		if ( empty( $google_api ) ) {
			delete_transient( 'google_fonts_variant_lists' );
			echo '<label>';
				echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
				$api_url = esc_url( 'https://developers.google.com/fonts/docs/developer_api' );
			echo __( 'If you want to set up an integration with Google Fonts, you\'ll need to generate API Key.', 'hytteguiden' );
				echo ' <a href="' . $api_url . '" target="_blank">' . __( 'Get API Key', 'hytteguiden' ) . '</a>';
				echo ' ' . __( 'and set it via customizer.', 'hytteguiden' );
			echo '</label>';
		}
		else {
	    	$variant_lists 		= $this->get_font_variants( $google_api );
			$this_field_id 		= $this->id;
			$field_exploded 	= explode( '_variant', $this_field_id );
			$related_font_field = $field_exploded[0];
			$font_updated_value = $this->value();

	        if( ! empty( $font_updated_value ) ) {
				$exploded_vals 	= explode( ':', $font_updated_value );
				$select 		= $exploded_vals[1];
				$font 			= $exploded_vals[0];
				$selected_font  = get_theme_mod( $related_font_field );
				if( $font != $selected_font ) {
					$font = $selected_font;
					$font_updated_value = $font . ':regular';
				}
	        }
			else {
				$font = 'Montserrat';
				if( ! empty( $related_font_field ) ) {
					$font = get_theme_mod( $related_font_field );
				}
				$font_updated_value = $font . ':regular';
			}
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php echo $this->link(); ?>>
					<?php
					$option_label = '';
					$option_value = '';
					if( is_array( $variant_lists ) && ! empty( $variant_lists ) && ! empty( $font ) ) {
						$variants = $variant_lists[$font]['variants'];

						foreach( $variants as $v ) {
                            if( 'italic' == $v ) {
                                $option_label = 'Italic';
                                $option_value = $font . ':400i';
                            }
                            else if( strpos( $v, 'italic' ) ) {
                                $exp_val = explode( 'italic', $v );
                                if( isset( $exp_val[0] ) && ! empty( $exp_val[0] ) ) {
                                	$option_label = $exp_val[0] . ' Italic';
                                	$option_value = $font . ':' . $exp_val[0] . "i";
                                }
                            }
                            else {
                                $option_label = $v;
                                $option_value = $font . ':' . $v;
                            }
							printf( '<option value="%s" %s>%s</option>', $option_value, selected( $font_updated_value, $option_value, false ), $option_label );
						}
					} ?>
				</select>
			</label>
<?php
		}
    }

    public function get_font_variants( $google_api ) {
    	$variant_lists = array();
		$variant_lists = get_transient( 'google_fonts_variant_lists' );

		return $variant_lists;
    }
} ?>
