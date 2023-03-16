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

$_catalogs_helthjem = get_post_meta($post_id, '_catalogs_helthjem', true);

get_header();

?>
<section class="section userdashboard">
	<div class="container">
		<div class="section-heading">
			<h3 class="sectiontitle-alt"><?php echo $label; ?></h3>
		</div>
		<div class="row gutter20x">
		    <nav class="ppagenav">
				<?php echo hytteguiden_producer_dashboard_tab('producer_kataloger'); ?>			
			</nav>
			<div class="main-producer-wrapper">
			<div class="col-md-12">
			<form action="" id="update_form" class="producer-form" method="POST" enctype="multipart/form-data">
				<div class="profile-wrapper profile-block">
				<h5 class="titletype"><?php _e('Legg til / oppdater kataloginformasjon her.', 'hytteguiden'); ?></h5>
					<div class="row">
						<div class="col-md-12">
							<div class="input-group form-group bmd-form-group is-filled">
								<div class="label-holder"><label><?php _e('Title', 'hytteguiden'); ?></label></div>
								<input type="text" class="form-control valid" name="kataloger_title" id="kataloger_title" placeholder="Title" value="<?php if($mode == 'edit'){ echo get_the_title($post_id); } ?>">
								<input type="hidden" name="post_id" id="post_id" value="<?php echo $post_id;?>">
							</div>
						</div>					
						<div class="col-md-12">							
							<div class="input-group form-group bmd-form-group is-filled">
							    <div class="label-holder"><label><?php _e('Content', 'hytteguiden'); ?></label></div>
										<div class="custom-editor">
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
							  </div>
						</div>

						<div class="col-md-6">
							<div class="input-group form-group bmd-form-group is-filled">
								<div class="label-holder"><label><?php _e('Helthjem Id', 'hytteguiden'); ?></label></div>
								<input type="text" class="form-control valid" name="helthjem_id" id="helthjem_id" placeholder="Helthjem ID" value="<?php echo $_catalogs_helthjem; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group form-group bmd-form-group is-filled">
								<div class="label-holder"><label><?php _e('Status', 'hytteguiden'); ?></label></div>
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
						<div class="col-md-8">
							<div class="input-group form-group bmd-form-group is-filled">
								<div class="label-holder">
									<label><?php _e('Upload Feature Image', 'hytteguiden'); ?></label>
								</div>
								
								<input type="file" class="upload_section" name="hytte_upload_image" id="hytte_upload_image" accept="image/x-png,image/gif,image/jpeg">
								<?php wp_nonce_field('hytte_upload_image', 'hytte_upload_image_nonce');?>
							</div>
						</div>
					<div class="col-md-4">
						<div class="hytte_upload_image_holder form-group text-center">
							<?php if ( has_post_thumbnail( $post_id ) ) {
								echo get_the_post_thumbnail( $post_id, 'thumbnail', array( 'class' => 'img-fluid' ) );
							} 
							?>						
						</div>
					</div>
					</div>
					<div class="col-md-12">
							<input type="button" id="btn_save_kataloger" name="btn_save_kataloger" value="<?php esc_attr_e( 'Lagre', 'hytteguiden' ); ?>" class="btn login_btn">
					</div>
					<div class="alert_msg"></div>
				</div>
			</form>
			</div>
            </div>
	
		</div>
	</div>
</section>
<!-- //personalpage -->
<?php

get_footer();
