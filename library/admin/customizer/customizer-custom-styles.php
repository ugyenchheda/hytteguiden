<?php
/**
 * Hytteguiden Theme Customizer CSS.
 *
 * @package Hytteguiden
 */
class Hytteguiden_Customizer_Styles {

	public function __construct() {

		echo '<style type="text/css" id="customizer-styles">';
			echo $this->hytteguiden_home_banner_title_styles();
			echo $this->hytteguiden_home_banner_subtitle_styles();
			echo $this->hytteguiden_home_banner_pretitle_styles();
		echo '</style>';
	}

	public function hytteguiden_font_name( $val ) {
		$return_val = '';
		if( ! empty( $val ) ) {
			$font 		 = str_replace( "+", " ", $val );
			$return_val .= 'font-family: "' . $font . '", Helvetica,Arial,sans-serif;';
		}
		return $return_val;
	}

	public function hytteguiden_font_variation( $val ) {
		$return_val   = '';
		$variant 	  = '';
		$exploded_val = explode( ":", $val );
		if( ! empty( $exploded_val ) && isset( $exploded_val[1] ) ) {
            $arr = preg_split( '/(?<=[0-9])(?=[a-z]+)/i', $exploded_val[1] );
            foreach( $arr as $values ) {
                if( is_numeric( $values ) ) {
                    $variant .= 'font-weight:' . $values . ';';
                }
                else {
                    if( "regular" == strtolower( $values ) ) {
                        $variant .= 'font-weight:normal;';
                    }
                    else {
                        $variant .= 'font-style:italic;';
                    }
                }
            }
        }
		return $variant;
	}

	public function hytteguiden_rgb_colour( $val, $opacity = 100 ) {
		list( $val_r, $val_g, $val_b ) = sscanf( $val, "#%02x%02x%02x" );

		$return_val = '';
		if( ! empty( $val ) ) {
			$transparency = $opacity / 100;
			$return_val  .= 'rgba( ' . $val_r . ',' . $val_g . ',' . $val_b . ',' . $transparency .' )';
		}
		return $return_val;
	}

	/* Typography for home banner title */
	public function hytteguiden_home_banner_title_styles() {
		$style = '';
		$block_style = array();
		$title_block_style = array();

		$home_banner_title_font 		 = get_theme_mod( 'home_banner_title_font' );
		$home_banner_title_font_variant  = get_theme_mod( 'home_banner_title_font_variant' );
		$home_banner_title_font_size  	 = get_theme_mod( 'home_banner_title_font_size' );
		$home_banner_title_line_height 	 = get_theme_mod( 'home_banner_title_line_height' );
		$home_banner_title_colour 		 = get_theme_mod( 'home_banner_title_colour' );
		$home_banner_title_block_color	 = get_theme_mod( 'home_banner_title_block_color' );
		

		if( ! empty( $home_banner_title_font ) ) {
			$font = $this->hytteguiden_font_name( $home_banner_title_font );
			$block_style[] = $font;
		}

		if( ! empty( $home_banner_title_font_variant ) ) {
			$variant = $this->hytteguiden_font_variation( $home_banner_title_font_variant );
			$block_style[] = $variant;
		}

		if( ! empty( $home_banner_title_block_color ) && '#000000' != $home_banner_title_block_color ) {
			$title_block_style[] = 'background:'. $this->hytteguiden_rgb_colour($home_banner_title_block_color, 50)  .' !important;';
		}

		if( ! empty( $home_banner_title_colour ) && '#ffffff' != $home_banner_title_colour ) {
			$block_style[] = 'color:'. $home_banner_title_colour .';';
		}

		if( !empty( $home_banner_title_font_size ) && '25' != $home_banner_title_font_size ) {
			$block_style[] = 'font-size:'. $home_banner_title_font_size.'px;';
		}

		if( !empty( $home_banner_title_line_height ) && '25' != $home_banner_title_line_height ) {
			$block_style[] = 'line-height:'. $home_banner_title_line_height.'px;';
		}

		if( $block_style ){
			$separated_block_style = implode(" ", $block_style);						
			$style .= '.banner_title_wrap h2 { ' . $separated_block_style . ' }';
		}
		if($title_block_style){
			$separated_title_block_style = implode(" ", $title_block_style);						
			$style .= '.banner_title_wrap { ' . $separated_title_block_style . ' }';
		}

		return $style;
	}

	/* Typography for home banner subtitle */
	public function hytteguiden_home_banner_subtitle_styles() {
		$style = '';
		$block_style 		  	 = array();

		$home_banner_subtitle_font 		 = get_theme_mod( 'home_banner_subtitle_font' );
		$home_banner_subtitle_font_variant  = get_theme_mod( 'home_banner_subtitle_font_variant' );
		$home_banner_subtitle_font_size  	 = get_theme_mod( 'home_banner_subtitle_font_size' );
		$home_banner_subtitle_line_height 	 = get_theme_mod( 'home_banner_subtitle_line_height' );
		$home_banner_subtitle_colour 		 = get_theme_mod( 'home_banner_subtitle_colour' );

		if( ! empty( $home_banner_subtitle_font ) ) {
			$font = $this->hytteguiden_font_name( $home_banner_subtitle_font );
			$block_style[] = $font;
		}

		if( ! empty( $home_banner_subtitle_font_variant ) ) {
			$variant = $this->hytteguiden_font_variation( $home_banner_subtitle_font_variant );
			$block_style[] = $variant;
		}

		if( ! empty( $home_banner_subtitle_colour ) && '#ffffff' != $home_banner_subtitle_colour ) {
			$block_style[] = 'color:'. $home_banner_subtitle_colour .';';
		}

		if( !empty( $home_banner_subtitle_font_size ) && '16' != $home_banner_subtitle_font_size ) {
			$block_style[] = 'font-size:'. $home_banner_subtitle_font_size.'px;';
		}

		if( !empty( $home_banner_subtitle_line_height ) && '16' != $home_banner_subtitle_line_height ) {
			$block_style[] = 'line-height:'. $home_banner_subtitle_line_height.'px;';
		}

		if( $block_style ){
			$separated_block_style = implode(" ", $block_style);
			$style .= '.banner_title_wrap .sub_title { ' . $separated_block_style . ' }';
		}

		return $style;
	}

	/* Typography for home banner pretitle */
	public function hytteguiden_home_banner_pretitle_styles() {
		$style = '';
		$block_style 		  	 = array();

		$home_banner_pretitle_font 		 = get_theme_mod( 'home_banner_pretitle_font' );
		$home_banner_pretitle_font_variant  = get_theme_mod( 'home_banner_pretitle_font_variant' );
		$home_banner_pretitle_font_size  	 = get_theme_mod( 'home_banner_pretitle_font_size' );
		$home_banner_pretitle_line_height 	 = get_theme_mod( 'home_banner_pretitle_line_height' );
		$home_banner_pretitle_colour 		 = get_theme_mod( 'home_banner_pretitle_colour' );

		if( ! empty( $home_banner_pretitle_font ) ) {
			$font = $this->hytteguiden_font_name( $home_banner_pretitle_font );
			$block_style[] = $font;
		}

		if( ! empty( $home_banner_pretitle_font_variant ) ) {
			$variant = $this->hytteguiden_font_variation( $home_banner_pretitle_font_variant );
			$block_style[] = $variant;
		}

		if( ! empty( $home_banner_pretitle_colour ) && '#ffffff' != $home_banner_pretitle_colour ) {
			$block_style[] = 'color:'. $home_banner_pretitle_colour .';';
		}

		if( !empty( $home_banner_pretitle_font_size ) && '16' != $home_banner_pretitle_font_size ) {
			$block_style[] = 'font-size:'. $home_banner_pretitle_font_size.'px;';
		}

		if( !empty( $home_banner_pretitle_line_height ) && '16' != $home_banner_pretitle_line_height ) {
			$block_style[] = 'line-height:'. $home_banner_pretitle_line_height.'px;';
		}

		if( $block_style ){
			$separated_block_style = implode(" ", $block_style);
			$style .= '.banner_title_wrap .pre_title { ' . $separated_block_style . ' }';
		}

		return $style;
	}


}

$hytteguiden_customizer_style = new Hytteguiden_Customizer_Styles();

?>