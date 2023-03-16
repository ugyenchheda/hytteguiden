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

get_header();

  $guest_id = hytteguiden_guest_id();

  if ( is_user_logged_in() ) {
	$current_user = wp_get_current_user();

	$user_email = $current_user->user_email;
	$user_phone = get_user_meta( $current_user->ID, 'user_phone', true );
	$first_name = get_user_meta( $current_user->ID, 'first_name', true );
	$user_address = get_user_meta( $current_user->ID, 'user_address', true );
	$user_postal_number = get_user_meta( $current_user->ID, 'user_postal_number', true );
	$user_city = get_user_meta( $current_user->ID, 'user_city', true );
	// $zip_code = get_user_meta( $current_user->ID, 'zip_code', true );
	// $country_code = get_user_meta( $current_user->ID, 'country_code', true );	

	$page_title = __( 'Min Side', 'hytteguiden' );
	$page_description = __( 'Du kan gjøre endringer i profilen din herfra.', 'hytteguiden' );

} else{
	$cond = ' AND guest_id = "'.$guest_id . '"';
	$row_data = hytte_row_from_table('address', $cond );

	$user_email = ($row_data->email_address ? $row_data->email_address : '');
	$user_phone = ($row_data->phone_number ? $row_data->phone_number : ''); 
	$first_name = ($row_data->full_name ? $row_data->full_name : ''); 
	$user_address = ($row_data->address ? $row_data->address : ''); 
	$user_postal_number = ($row_data->postal_name ? $row_data->postal_name : ''); 
	$user_city = ($row_data->city ? $row_data->city : '');
	// $zip_code = ($row_data->zip_code ? $row_data->zip_code : ''); 
	// $country_code = ($row_data->country_code ? $row_data->country_code : ''); 

	$page_title = __( 'Min Adresse', 'hytteguiden' );
	$page_description = __( 'Du kan legge til adressen din herfra.', 'hytteguiden' );

	 
}

  ?>
<section class="section personalpage">
	<div class="container">
		<h2 class="sectiontitle" style="text-align: center;"><span><?php echo $page_title; ?></span></h2>
		<p class="login-text"><?php echo $page_description; ?></p>
			<div class="container">
		
			<nav class="ppagenav">
				<?php echo hytteguiden_minside_tab();?>
				</nav>
				<!-- //ppagenav -->
				<form action="" id="edit_user_info">
					<div class="col-md-6">
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-pen"></i></span>
							</div>
							<input type="text" class="form-control" name="first_name" id="first_name" placeholder="Navn" value="<?php echo $first_name; ?>">
						</div>
						<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-envelope"></i></span>
									</div>
									<input type="text" class="form-control" name="user_email" id="user_email" placeholder="Epost" value="<?php echo $user_email; ?>" >
						</div>
						<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-phone"></i></span>
									</div>
									<input type="text" class="form-control" name="user_phone" id="user_phone" placeholder="Telefon" value="<?php echo $user_phone; ?>">
						</div>
						<!-- <div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-flag"></i></span>
							</div>
							<input type="text" class="form-control" name="country_code" id="country_code" placeholder="landskode " value="<?php echo $country_code; ?>">
						</div> -->
					</div>
						
					<div class="col-md-6">     
							<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
								</div>
								<input type="text" class="form-control" name="user_address" id="user_address" placeholder="Gateadresse " value="<?php echo $user_address; ?>">
							</div>
										
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-address-book"></i></span>
									</div>
									<input type="text" class="form-control" name="user_postal_number" id="user_postal_number"  placeholder="Postnummer " value="<?php echo $user_postal_number; ?>">
								</div>							
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-address-card"></i></span>
									</div>
									<input type="text" class="form-control" name="user_city" id="user_city"   placeholder="Poststed " value="<?php echo $user_city; ?>">
								</div>
								<!-- <div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-map-pin"></i></span>
									</div>
									<input type="text" class="form-control" name="zip_code" id="zip_code"  placeholder="Zipcode " value="<?php echo $zip_code; ?>">
								</div> -->
					</div>
					
					<div class="form-group text-center">
						<input type="submit" name="login" value="Oppdater" class="btn login_btn">
					</div>

					<div id="error_msg"></div>
			</form>
  </div>
</section>

<!-- //personalpage -->
<?php

get_footer();
