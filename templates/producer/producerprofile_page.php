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
		
		    <nav class="ppagenav">
				<?php echo hytteguiden_producer_dashboard_tab('profile'); ?>			
			</nav>

			<div class="col-md-12">
			<form action="" id="" class="producer-form">
				<div class="dboardblock">
					<div class="row">
						<div class="col-md-6">
							<div class="dboardtitle">
								<h5 class="titletype">BEDRIFTSINFO</h5> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="profile-logo">
							<form name="upload_form" id="upload_form" method="POST" enctype="multipart/form-data">
								<input type="file" name="images" id="images" accept="image/x-png,image/gif,image/jpeg" multiple>
											<i class="fa fa-plus"></i><span>Slect Image</span>
								<?php wp_nonce_field('image_upload', 'image_upload_nonce');?>
							</form>
						
								<img width="150" id = "producer_display_image" height="64" src="<?php echo get_the_post_thumbnail_url($current_producer_id,'producer_address', true); ?>" class="attachment-thumbnail size-thumbnail wp-post-image" alt="">
						
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group form-group bmd-form-group is-filled">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-pen"></i></span>
								</div>
								<input type="text" class="form-control valid" name="producer_name" id="producer_name" placeholder="Navn" value="<?php echo get_the_title($current_producer_id); ?>">

								<input type="hidden" id="producer_id" value="<?php echo $current_producer_id; ?>">
							</div>
							<div class="input-group form-group bmd-form-group is-filled">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
								</div>
								<input type="text" class="form-control valid" name="producer_address" id="producer_address" placeholder="<?php echo get_post_meta($current_producer_id,'producer_address', true); ?>" value="<?php echo get_post_meta($current_producer_id,'producer_address', true); ?>">
							</div>
							<div class="input-group form-group bmd-form-group is-filled">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-globe"></i></span>
								</div>
								<input type="text" class="form-control valid" name="producer_web" id="producer_web" placeholder="<?php echo get_post_meta($current_producer_id,'producer_website', true); ?>" value="<?php echo get_post_meta($current_producer_id,'producer_website', true); ?>">
							</div>
						</div>
						<div class="col-md-6">  
							<div class="input-group form-group bmd-form-group is-filled">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-envelope"></i></span>
								</div>
								<input type="text" class="form-control" name="user_email" id="user_email" placeholder="Epost" value="<?php echo get_post_meta($current_producer_id,'producer_email', true); ?>" disabled="">
							</div>
							<div class="input-group form-group bmd-form-group is-filled">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-phone"></i></span>
								</div>
								<input type="text" class="form-control valid" name="user_phone" id="user_phone" placeholder="Telefon1" value="<?php echo get_post_meta($current_producer_id,'producer_contact_phone_1', true); ?>">
							</div>  
							<div class="input-group form-group bmd-form-group is-filled">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-phone"></i></span>
								</div>
								<input type="text" class="form-control valid" name="user_phone2" id="user_phone2" placeholder="Telefon2" value="<?php echo get_post_meta($current_producer_id,'producer_contact_phone_2', true); ?>">
							</div>  
						</div>
					</div>
					<div class="form-group text-center">
						<input type="button" name="login" id="producer_submit" value="Oppdater" class="btn login_btn">
						</div>

						<div id="error_msg"></div>
				</div>
			</form>
			</div>
		</div>
	</div>
</section>
<!-- //personalpage -->
<?php

get_footer();
