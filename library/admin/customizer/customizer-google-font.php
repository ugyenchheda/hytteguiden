<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return NULL;
}
/**
 * A class to create a dropdown for all google fonts
 */
class Hytte_Google_Font extends WP_Customize_Control {
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
    	$fonts_list = array();
		$google_api = get_option( 'google_font_api' );

		if ( empty( $google_api ) ) {
			delete_transient( 'google_fonts_variant_lists' );
    		echo '<label>';
				echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
				$api_url =  'https://developers.google.com/fonts/docs/developer_api';
				echo __( 'If you want to set up an integration with Google Fonts, you\'ll need to generate API Key.', 'hytteguiden' );
				echo ' <a href="' . esc_url( $api_url ) . '" target="_blank">' . __( 'Get API Key', 'hytteguiden' ) . '</a>';
				echo ' ' . __( 'and set it via customizer.', 'hytteguiden' );
			echo '</label>';
    	}
        else {
        	$fonts_list = $this->get_fonts( $google_api ); ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?> class="hytteguiden_google_font_select" >
					<option value=""><?php _e('Default', 'hytteguiden'); ?></option>
				<?php
					foreach( $fonts_list as $v => $i ) {
						printf( '<option value="%s" %s>%s</option>', $v, selected( $this->value(), $v, false ), str_replace( "+", " ", $v ) );
					} ?>
				</select>
			</label>
	<?php
        }
    }

    /**
     * Get the google fonts from the API or in the cache
     *
     * @param  integer $amount
     *
     * @return String
     */
    public function get_fonts( $google_api ) {
		$all_fonts  = array();

		if ( false === ( $special_query_results = get_transient( 'google_fonts_variant_lists' ) ) ) {
			$googleApi 	 = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=alpha&key=' . $google_api;
			$fontContent = wp_remote_get( $googleApi, array('sslverify'   => false) );

			//print_r($fontContent);

			if ( is_array( $fontContent ) && ! is_wp_error( $fontContent ) && isset( $fontContent['response']['code'] ) && $fontContent['response']['code'] != 400 ) {
				$content = json_decode( $fontContent['body'] );

				$fonts = $content->items;
				if( !empty( $fonts ) ) {
					foreach ( $fonts as $k => $v ) {
						$family = str_replace( " ", "+", $v->family );
						$all_fonts[$family]['variants'] = $v->variants;
						$all_fonts[$family]['subsets']  = $v->subsets;
					}

					if ( ! empty( $all_fonts ) && count( $all_fonts ) > 0 ) {
                        set_transient( 'google_fonts_variant_lists', $all_fonts, 14 * DAY_IN_SECONDS );
                    }
				}
			}

			return $all_fonts;
		}
		else {
			$variant_lists = get_transient( 'google_fonts_variant_lists' );
			return $variant_lists;
		}
    }

} ?>
