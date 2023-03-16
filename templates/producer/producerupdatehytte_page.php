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

/* Request Data */
$mode = isset($_REQUEST['mode'])?$_REQUEST['mode']:'';
$post_id = isset($_REQUEST['id'])?$_REQUEST['id']:'';

if($mode == 'edit'){
	$label = __('Oppdater Kataloger', 'hytteguiden');
} else{
	$label = __('Legg til Kataloger', 'hytteguiden');
}

get_header();

?>
<section class="section userdashboard">
	<div class="container">
		<div class="section-heading">
		<h3 class="sectiontitle-alt"><?php echo $label; ?></h3>
		</div>
		<div class="row gutter20x">
		
		    <nav class="ppagenav">
				<?php echo hytteguiden_producer_dashboard_tab('producer_hytter'); ?>			
			</nav>
			<div class="profile-wrapper">
				<section class="section personalpage">
					<div class="container">
								
						<form action="" id="update_form" class="user_dashboard">
								<div class="row">
									<div class="col-md-9">
											<div class="marbtm">
												<input type="text" class="form-control" name="post_title" id="post_title" placeholder="Navn" value="<?php if($mode == 'edit'){ echo get_the_title($post_id); } ?>">
												<input type="hidden" name="post_id" id="post_id" value="<?php echo $post_id;?>">
											</div>
											
											<div id="froala-editor" class="marbtm">
											<?php
												$content = '';
												$settings = array( 'media_buttons' => false, 'width' => '100%', );
												if($mode == 'edit'){
													$post = get_post( $post_id, OBJECT, 'edit' );
													$content = $post->post_content;
												}
												wp_editor( $content, 'post_content', $settings );
												?>
											</div>

											<div class="asideblock asideblock_layout-1">
												<h3 class="asideblock_title">
												<?php _e('Hytte Ytterligere Meta', 'hytteguiden'); ?>
												</h3>

												<div class="row">
														<div class="col-md-6 col-12">
															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('Utvalgte varer', 'hytteguiden'); ?></label>
																	<input type="checkbox" id="featured" name="featured" checked="" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_feature_item', true); } ?>">
																	<span class="sub_title"><?php _e('Ja', 'hytteguiden'); ?></span>
															</div>

															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('Basisområde', 'hytteguiden'); ?></label>
																	<input type="text" id="base_area" name="base_area" class="form-control" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_base_area', true); } ?>">
																	<span class="sub_title martop"><?php _e('Legg til baseområde for hytte (Sq Ft).', 'hytteguiden'); ?></span>
															</div>

															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('Utility Area', 'hytteguiden'); ?></label>
																	<input type="text" id="utility_area" name="utility_area" class="form-control" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_utility_area', true); } ?>">
																	<span class="sub_title martop"><?php _e('Legg til verktøyområde for hytte (Sq Ft).', 'hytteguiden'); ?></span>
															</div>

															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('Bygget område', 'hytteguiden'); ?></label>
																	<input type="text" id="built_area" name="built_area" class="form-control" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_build_area', true); } ?>">
																	<span class="sub_title martop"><?php _e('Legg til innebygd område for hytte (Sq Ft).', 'hytteguiden'); ?></span>
															</div>

															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('Bruttoareal', 'hytteguiden'); ?></label>
																	<input type="text" id="gross_area"  name="gross_area" class="form-control" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_gross_area', true); } ?>">
																	<span class="sub_title martop"><?php _e('Legg til bruttoareal for hytte (Sq Ft).', 'hytteguiden'); ?></span>
															</div>

															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('Lengde bredde', 'hytteguiden'); ?></label>
																	<input type="text" id="length" name="length" class="form-control" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_length_width', true); } ?>">
																	<span class="sub_title martop"><?php _e('Legg lengde (bredde) for hytte (Ft).', 'hytteguiden'); ?></span>
															</div>

															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('Bredde', 'hytteguiden'); ?></label>
																	<input type="text" id="main_width" name="main_width" class="form-control" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_width', true); } ?>">
																	<span class="sub_title martop"><?php _e(' Legg bredde for hytte (Ft)', 'hytteguiden'); ?></span>
															</div>

															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('Månens høyde', 'hytteguiden'); ?></label>
																	<input type="text" id="moon_light"  name="moon_light" class="form-control" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_moon_height', true); } ?>">
																	<span class="sub_title martop"><?php _e('Legg til månens høyde for hytte (Ft).', 'hytteguiden'); ?></span>
															</div>

															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('Status', 'hytteguiden'); ?></label>
																	<select class="form-control valid" name="status_id" id="status_id">
																	<?php 
																	$statuses = get_post_statuses();
																	$post_status = get_post_status( $post_id );
																	if($statuses){
																		foreach($statuses as $key => $s){
																			echo '<option value="'. $key.'"';
																			if($post_status == $key){
																				echo ' selected="selected"';
																			}
																			echo '>'. $s.'</option>';
																		}
																	}

																	?>
																</select>
															</div>

														</div>

														<div class="col-md-6 col-12">
															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('Antall Soverom', 'hytteguiden'); ?></label>
																	<input type="text" id="bedroom" name="bedroom" class="form-control" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_bedroom', true); } ?>">
																	<span class="sub_title martop"><?php _e('Legg til antall soverom for hytte.', 'hytteguiden'); ?></span>
															</div>

															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('Antall Bad', 'hytteguiden'); ?></label>
																	<input type="text" id="bathroom" name="bathroom" class="form-control" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_bathroom', true); } ?>">
																	<span class="sub_title martop"><?php _e('Legg til antall bad i hytta.', 'hytteguiden'); ?></span>
															</div>

															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('Antall Senger', 'hytteguiden'); ?></label>
																	<input type="text" id="beds" name="beds" class="form-control" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_beds', true); } ?>">
																	<span class="sub_title martop"><?php _e('Legg til antall senger i hytta.', 'hytteguiden'); ?></span>
															</div>

															<div class="asideblock_content kr_price">
																	<label class="font_bold"><?php _e('Pris Kit', 'hytteguiden'); ?></label>
																	<span class="kr_price_label">kr</span>
																	<input type="text" id="price_kit" name="price_kit" class="form-control price_width" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_price_kit', true); } ?>">
																	<span class="sub_title martop"><?php _e('Legg til pris for bare byggeklosser.', 'hytteguiden'); ?></span>
															</div>

															<div class="asideblock_content kr_price">
																	<label class="font_bold"><?php _e('Pris Nøkkelferdige', 'hytteguiden'); ?></label>
																	<span class="kr_price_label">kr</span>
																	<input type="text" id="price_turnkey" name="price_turnkey" class="form-control price_width" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_price_turnkey', true); } ?>">
																	<span class="sub_title martop"><?php _e('Legg til pris for å sette opp hytta.', 'hytteguiden'); ?></span>
															</div>

															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('Hems', 'hytteguiden'); ?></label>
																	<input type="text" id="hems" name="hems" class="form-control" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_hems', true); } ?>">
																	<span class="sub_title martop"><?php _e('Legg til Hems for hytte (kvm).', 'hytteguiden'); ?></span>
															</div>

															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('Rise (Kvm)', 'hytteguiden'); ?></label>
																	<input type="text" name="rise"  id="rise"class="form-control" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_rise', true); } ?>">
																	<span class="sub_title martop"><?php _e('Legg til Rise (Kvm).', 'hytteguiden'); ?></span>
															</div>

															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('BOD (Kvm)', 'hytteguiden'); ?></label>
																	<input type="text" id="bod" name="bod" class="form-control" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_bod', true); } ?>">
																	<span class="sub_title martop"><?php _e('Legg til BOD for hytte (kvm).', 'hytteguiden'); ?></span>
															</div>

															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('Youtube Link', 'hytteguiden'); ?></label>
																	<input type="url" id="youtube_link" name="youtube_link" class="form-control" value="<?php if($mode == 'edit'){ echo get_post_meta($post_id, 'cabin_youtube_link', true); } ?>">
															</div>
														</div>
												</div>
											</div>
											<div class="asideblock asideblock_layout-1">
												<h3 class="asideblock_title">
														Attached Posts
												</h3>

												<div class="row">
														<div class="col-md-6"></div>
												</div>

											</div>

									</div>
									<div class="col-md-3">
										<div class="asideblock asideblock_layout-1">
											<h3 class="asideblock_title"><?php _e('Hytter Stil', 'hytteguiden'); ?></h3>
											<div class="asideblock_content">
													<?php
													$selected_cabin_styles = wp_get_post_terms($post_id, 'cabin_style', array("fields" => "ids"));
													$cabin_terms = get_terms( 'cabin_style', array('hide_empty' => 0) );
													if ( ! empty( $cabin_terms ) && ! is_wp_error( $cabin_terms ) ) {
															echo '<ul>';
														foreach ( $cabin_terms as $term ) {
															if(array_key_exists('term_id', $term) ) {
															?>
															<?php echo '<li>'; ?>
															<input type="radio" <?php if(isset($selected_cabin_styles) && in_array($term->term_id, $selected_cabin_styles) ) { echo ' checked="checked"'; }?> class="custom-control-input update_cabin_style"  name="cabin_style[]" value="<?php echo $term->term_id; ?>"  id="<?php echo $term->slug; ?>">
															<label class="custom-control-label" for="<?php echo $term->slug; ?>"><?php echo $term->name; ?></label>
															<?php echo '</li>'; ?>
															<?php
															}
														}
														echo '</ul>';
													}
												?>
											</div>
									</div>

									<div class="asideblock asideblock_layout-1">
											<h3 class="asideblock_title"><?php _e('Hytter Tillegg', 'hytteguiden'); ?></h3>
											<div class="asideblock_content">
													<?php
													$selected_cabin_amenities = wp_get_post_terms($post_id, 'cabin_amenity', array("fields" => "ids"));
													$cabin_terms = get_terms( 'cabin_amenity', array('hide_empty' => 0) );
													if ( ! empty( $cabin_terms ) && ! is_wp_error( $cabin_terms ) ) {
															echo '<ul>';
														foreach ( $cabin_terms as $term ) {
															if(array_key_exists('term_id', $term) ) {
															?>
															<?php echo '<li>'; ?>
															<input type="checkbox" <?php if(isset($selected_cabin_amenities) && in_array($term->term_id, $selected_cabin_amenities) ) { echo ' checked="checked"'; }?> class="custom-control-input update_cabin_amenity"  name="cabin_amenity[]" value="<?php echo $term->term_id; ?>"  id="<?php echo $term->slug; ?>">
															<label class="custom-control-label" for="<?php echo $term->slug; ?>"><?php echo $term->name; ?></label>
															<?php echo '</li>'; ?>
															<?php
															}
														}
														echo '</ul>';
													}
												?>
											</div>
									</div>

											<div class="asideblock asideblock_layout-1">
												<h3 class="asideblock_title">
												<?php _e('Feature Image', 'hytteguiden'); ?>
												</h3> 
												<div class="asideblock_content">
														<div class="hytte_upload_image_holder img-holder">
														<?php if ( has_post_thumbnail( $post_id ) ) {
																the_post_thumbnail( $post_id, 'post-thumbnails', array( 'class' => 'img-fluid' ) );
															} 
															?>
														</div>
														<p class="fontitalic">
															<div class="upload">
																<label class="fileContainer">
																<?php _e('Upload Feature Image', 'hytteguiden'); ?>
																<input type="file" class="upload_section" name="hytte_upload_image" id="hytte_upload_image" accept="image/x-png,image/gif,image/jpeg">
																<?php wp_nonce_field('hytte_upload_image', 'hytte_upload_image_nonce');?>
																</label>
														</div>	
														</p> 
												</div> 
											</div>
											<div class="asideblock asideblock_layout-1">
												<h3 class="asideblock_title">
												<?php _e('Planløsning', 'hytteguiden'); ?>
												</h3>
												<div class="row">
														<div class="col-md-12">
															<div class="asideblock_content">
																	<label class="font_bold"><?php _e('Gulvplan Bildegalleri', 'hytteguiden'); ?></label>
																	
														<p class="fontitalic">
															<div class="upload">
																<label class="fileContainer">
																<?php _e('Upload Galleries', 'hytteguiden'); ?>
																<input type="file" class="upload_section" name="hytte_upload_galleries" id="hytte_upload_galleries" accept="image/x-png,image/gif,image/jpeg" multiple>
																<?php wp_nonce_field('hytte_upload_galleries', 'hytte_upload_galleries_nonce');?>
																</label>
																<div id="loading-screen">	<?php _e('Uploading Gallery...', 'hytteguiden'); ?></div>
														</div>	
														</p> 
														<span class="sub_title martop"><?php _e('Last opp eller legg til flere bilder.', 'hytteguiden'); ?></span>
															</div>
														</div>
												</div>
												
												<div class="asideblock_content cabin_images_galleries_wrapper clearfix">
												<?php $cabin_images_galleries = get_post_meta( $post_id, 'cabin_images_galleries', true);
													if(isset($cabin_images_galleries) && !empty($cabin_images_galleries)){													
														?>
															<?php foreach($cabin_images_galleries as $key =>  $cabin_floor_plan_gallery) { ?>
															<div class="image_wrapper">
																<div class="image_holder">
																			<img src="<?php echo $cabin_floor_plan_gallery; ?>" alt="" class="img-fluid">
																			<div class="overlay">
																				<a href="javascript:void(0)" class="cab_img icon" title="User Profile">
																				<i class="fa fa-times"></i>
																				</a>
																			</div>
																			<input type="hidden" class="cabin_images_galleries" name="cabin_images_galleries[]" id="filelist-164" 
																			value="<?php echo $cabin_floor_plan_gallery; ?>" 
																			data-id="<?php echo $key; ?>">
																</div>
															</div>
															<?php } ?>
													<?php } ?>
												</div>
											</div>
											<div class="asideblock asideblock_layout-1">
												<h3 class="asideblock_title">
														<?php _e('Bilde Galleri', 'hytteguiden'); ?>
												</h3>
												<div class="row">
														<div class="col-md-12">
															<div class="asideblock_content">
																<p class="fontitalic">
																	<div class="upload">
																		<label class="fileContainer">
																		<?php _e('Upload Floor Plan', 'hytteguiden'); ?>
																				<input type="file" class="upload_section" name="hytte_upload_floor_plan" id="hytte_upload_floor_plan" accept="image/x-png,image/gif,image/jpeg" multiple>
																				<?php wp_nonce_field('hytte_upload_floor_plan', 'hytte_upload_floor_plan_nonce');?>
																		</label>
																</div>
																<div id="floor-plan">	<?php _e('Uploading Floor Plan..', 'hytteguiden'); ?></div>
																</p> 
																	<span class="sub_title martop"><?php _e('Last opp eller legg til flere bilder.', 'hytteguiden'); ?></span>
															</div>
														</div>
												</div>
												
												<div class="asideblock_content cabin_floor_plan_galleries_wrapper clearfix">
												<?php $cabin_floor_plan_galleries = get_post_meta( get_the_ID(), 'cabin_floor_plan_galleries', true);
													if(isset($cabin_floor_plan_galleries) && !empty($cabin_floor_plan_galleries)){
														?>
															<?php foreach($cabin_floor_plan_galleries as $key => $cabin_floor_plan_gallery) { ?>
																<div class="image_wrapper floor-plan">
																<div class="image_holder">
																			<img src="<?php echo $cabin_floor_plan_gallery; ?>" alt="" class="img-fluid">
																			<div class="overlay">
																				<a href="javascript:void(0)" class="floor_plan icon" title="User Profile">
																				<i class="fa fa-times"></i>
																				</a>
																			</div>
																			<input type="hidden" class="cabin_floor_plan_galleries" name="cabin_floor_plan_galleries[]" id="filelist-164" 
																			value="<?php echo $cabin_floor_plan_gallery; ?>" 
																			data-id="<?php echo $key; ?>">
																</div>
															</div>
															<?php } ?>
													<?php } ?>
												</div>
											</div>
									</div>
								</div>
								<input type="button" id="btn_save_hytter" name="btn_save_hytter" value="Lagre" class="btn login_btn">
						
								<div class="alert_msg"></div>
						</form>

					</div>
				</section>
			</div>
	
		</div>
	</div>
</section>
<!-- //personalpage -->
<?php

get_footer();
