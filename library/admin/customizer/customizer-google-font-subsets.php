<?php
if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return NULL;
}
/**
 * A class to create a dropdown for all google fonts
 */
class Hytte_Google_Font_Subsets extends WP_Customize_Control {
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
				$api_url = 'https://developers.google.com/fonts/docs/developer_api';
				echo __( 'If you want to set up an integration with Google Fonts, you\'ll need to generate API Key.', 'hytteguiden' );
				echo ' <a href="' . esc_url( $api_url ) . '" target="_blank">' . __( 'Get API Key', 'hytteguiden' ) . '</a>';
				echo ' ' . __( 'and set it via customizer.', 'hytteguiden' );
			echo '</label>';
		}
		else {
	    	$subsets_lists 		= $this->get_font_subsets( $google_api );
			$this_field_id 		= $this->id;
			$field_exploded 	= explode( '_subset', $this_field_id );
			$related_font_field = $field_exploded[0];
			$font_updated_value = $this->value();

			$multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value();

	        if( ! empty( $font_updated_value ) ) {
				$font = get_theme_mod( $related_font_field );
	        }
			else {
				$font = 'Montserrat';
			}
			?>
			<label>
				<?php if ( !empty( $this->label ) ) : ?>
		            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		        <?php endif; ?>

		        <?php if ( !empty( $this->description ) ) : ?>
		            <span class="description customize-control-description"><?php echo $this->description; ?></span>
		        <?php endif; ?>

		        <ul class="hytteguiden_google_subset_check">
		            <?php
		            if( is_array( $subsets_lists ) && ! empty( $subsets_lists ) && ! empty( $font ) ) {
		            	$subsets = $subsets_lists[$font]['subsets'];
		            	asort( $subsets );
						foreach( $subsets as $id => $subset ) :
							$exploded    = explode( '-', $subset );
							$first_text  = ( isset( $exploded[0] ) ? ucfirst( $exploded[0] ) : ucfirst( $subset ) );
							$second_text = ( isset( $exploded[1] ) ? 'Extended' : '' );
							$show_text 	 = $first_text . ' ' . $second_text;

							$checked = ( 'latin' == $subset ) ? 'checked="checked" disabled="disabled"' : checked( in_array( $subset, $multi_values ), true, false ); ?>

			                <li>
			                    <label>
			                        <input type="checkbox" value="<?php echo esc_attr( $subset ); ?>" <?php echo $checked; ?> />
			                        <?php echo esc_html( $show_text ); ?>
			                    </label>
			                </li>

		            <?php
		            	endforeach;
		            } ?>
		        </ul>
		        <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" id="hytteguiden_font_subsets" />
	        </label>

<?php
		}
    }

    public function get_font_subsets( $google_api ) {
    	$subset_lists = array();
		$subset_lists = get_transient( 'google_fonts_variant_lists' );

		return $subset_lists;
    }
} ?>
