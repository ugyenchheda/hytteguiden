<?php
/**
 * The main template file
 *  Template Name: Login Form
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Maya_Journeys
 */
hytteguiden_login_access();
$current_user = wp_get_current_user();   

$current_producer_id = get_user_meta( $current_user->ID, 'producer_id', true );
if(isset($current_producer_id) && !empty($current_producer_id)){
	$GLOBALS['current_producer_id'] = $current_producer_id;
} else{
	
	echo '<script> window.location = "'. esc_url( home_url( '/' ) ) .'"; </script>';
	exit;
}



get_header();

?>
<section class="section userdashboard">
	<div class="container">
		<div class="section-heading">
			<h3 class="sectiontitle-alt"><?php _e('Mine Dashboard', 'hytteguiden'); ?></h3>
		</div>
		<div class="row gutter20x">
		<?php get_template_part( 'template-parts/producer/dashboard/producer', 'profilenav' ); ?>
		
			<div class="col-12 col-md-6 col-xl-7">
				<?php get_template_part( 'template-parts/producer/dashboard/my', 'profile' ); ?>
			</div>
			<div class="col-12 col-md-6 col-xl-5">
				<?php get_template_part( 'template-parts/producer/dashboard/my', 'catalogs' ); ?>
			</div>
			<div class="col-12">
				<?php get_template_part( 'template-parts/producer/dashboard/my', 'cabins' ); ?>
			</div>
			<div class="col-12">
				<?php get_template_part( 'template-parts/producer/dashboard/contact', 'producer' ); ?>
			</div>

			<div class="col-12">
				<?php get_template_part( 'template-parts/producer/dashboard/catalog', 'request' ); ?>
			</div>

			
		</div>
	</div>
</section>
<!-- //personalpage -->
<?php

get_footer();
