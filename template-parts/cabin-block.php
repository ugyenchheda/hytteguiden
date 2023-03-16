<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hytteguiden
 */


$cabin_price_kit = get_post_meta( get_the_ID(), 'cabin_price_kit', true);
$cabin_price_turnkey = get_post_meta( get_the_ID(), 'cabin_price_turnkey', true);
$cabin_bedroom = get_post_meta( get_the_ID(), 'cabin_bedroom', true);
$cabin_utility_area = get_post_meta( get_the_ID(), 'cabin_utility_area', true);
$cabin_beds = get_post_meta( get_the_ID(), 'cabin_beds', true);

$output .= '<div class="col-12 col-sm-6 col-lg-4 item" itemscope="" itemtype="http://schema.org/product">
	<div class="cabinmodule"><a href="'. get_permalink().'"><figure class="cabinimg" itemprop="image" >';

	if ( has_post_thumbnail() ) {
		 $output .= get_the_post_thumbnail( get_the_ID(), 'post_image_s', array( 'class' => 'img-fluid cabImg' ) );
	}
	else {
			$output .=  '<img src="'. plugins_url('/assets/img/no_image.png', dirname(__FILE__) ) .'" class="img-fluid" />';
	}

$output .= '</figure></a><div class="cabindetails">
			<div class="cabintitle">
				<span  itemprop="brand" >'. hytteguiden_producer_name(get_the_ID()) .'</span>
				<h3 itemprop="name"><a href="'. get_permalink().'">'. get_the_title().'</a></h3>
			</div>
			<div class="cabininfo">
				<ul>';
					if(!empty($cabin_price_turnkey)){
						$output .= '<li><span class="icon"><span class="icon-tag"></span></span>'. hytteguiden_price($cabin_price_turnkey).' kr</li>';
					}else {
						$output .= '<li><span class="icon"><span class="icon-tag"></span></span>'.__( 'Pris på forespørsel', 'hytteguiden').'</li>';	
					}
					$output .= '<li><span class="icon"><span class="icon-scale"></span></span>'. hytteguiden_formate_number($cabin_utility_area).' m <sup>2</sup></li>';

					$output .= '<li><span class="icon"><span class="icon-bed"></span></span>'. $cabin_bedroom.' soverom</li>';

				$output .= '</ul>
			</div>
			<a href="'. get_permalink().' " class="btn btn-block btn-line-theme1" itemprop="url">'.__( 'Les mer', 'hytteguiden').' <i class="fa fa-long-arrow-alt-right"></i></a>
		</div>
	</div>
</div>';

 echo $output;
?>
