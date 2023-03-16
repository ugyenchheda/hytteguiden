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

global $wpdb;
$per_page = 5;
$page_number = 1; 
$guest_id = hytteguiden_guest_id();

get_header();

?>
<section class="section personalpage">
	<div class="container">
		<h2 class="sectiontitle" style="text-align: center;"><span>  <?php _e('Mine Kataloger', 'hytteguiden'); ?></span></h2>
			<div class="">
				<nav class="ppagenav">
					<?php echo hytteguiden_minside_tab('my_catalog');?>
				</nav>
				<!-- //ppagenav -->
		<?php
		$sql = 'SELECT * FROM ' . $wpdb->prefix . 'kataloger WHERE 1= 1';

		if(is_user_logged_in()){
			$current_user = wp_get_current_user();  
			$sql .= ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';   
		}else {
			$sql .= ' AND guest_id = "'. $guest_id . '"'; 
		}

 
		$result = $wpdb->get_results( $sql );
		
		?>	
		<div class="loader_message"> </div>	
		<div class="table-responsive ordertable currentorder">
		<?php if( $result ) {
			$count = 1; ?>
			<div class="ordertableoption optiontop">
				<div class="row">
					<div class="col-12 col-sm-6 col-md-7">
						<div class="section-heading">
							<h4 class="sectiontitle-alt"><?php _e( 'Kataloger klare til bestilling', 'hytteguiden' ); ?></h4>
							<div class="contact_request_wrapper">
							<div class="input-wrapper">
								<input type="checkbox" name="contact_request" id="contact_request">
							</div>	
						<?php _e('Ja takk, jeg vil kontaktes av produsent ', 'hytteguiden'); ?>
						<span class="mob_nonetext"><?php 
						  _e('etter at bestillingen er mottatt.', 'hytteguiden'); ?></span>						
						</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-5">
						<div class="btnwrap">
						  <a href="javascript:void(0);" class="btn btn-theme1 btn-lg healthjem_order"><?php _e( 'Bestill', 'hytteguiden' ); ?></a>
							<a href="javascript:void(0);" class="btn btn-light btn-lg clear_all_katalog"><?php _e( 'Tøm', 'hytteguiden' ); ?></a>
						</div>
					</div>
				</div>
				<div class="alert_msg"></div>
			</div>
			<table class="table table_katalog">
				<thead>
					<tr>
						<th># </th>
						<th><?php _e( 'Produsent', 'hytteguiden' ); ?></th>
						<th><?php _e( 'Katalog', 'hytteguiden' ); ?></th>
						<th><?php _e( 'Lagt til', 'hytteguiden' ); ?></th>
						<th><?php _e( 'Handling', 'hytteguiden' ); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach( $result as $entry ) { ?>
					<tr class="katalog_row_<?php echo $entry->id;?>">
						<td> 
							<?php echo $count; ?>
						<input type="hidden" value="<?php echo $entry->kataloger_id;?>" class="checkItem"> </td>
						<td><a href="<?php echo get_permalink($entry->producer_id); ?>"><?php echo get_the_title($entry->producer_id); ?></a></td>
						<td><?php echo get_the_title($entry->kataloger_id); ?></td>
						<td><?php echo date("d/m/Y", strtotime($entry->created_date)); ?></td>
						<td class="kataloger_remove_block">
						<input type="hidden" name="katalogers[]" class="kataloger_val" value="<?php echo $entry->id; ?>" >
						<span class="btn btn-dark1 remove_kataloger btn-xs"><i class="fa fa-times"></i><span class="hide-sm-down"> <?php _e( 'Fjern', 'hytteguiden' ); ?></span></span></td>
					</tr>
				<?php $count++; } ?>	
				</tbody>
			</table>
			<div class="ordertableoption optionbtm">
				<div class="btnwrap">
					<a href="javascript:void(0);" class="btn btn-theme1 btn-lg healthjem_order"><?php _e( 'Bestill', 'hytteguiden' ); ?></a>
					<a href="javascript:void(0);" class="btn btn-light btn-lg clear_all_katalog"><?php _e( 'Tøm', 'hytteguiden' ); ?></a>
				</div>
			</div>
		<?php } else { 
			_e( 'Du har ingen nybestilling.', 'hytteguiden' );
			}?>	
		</div>

		<!-- //ordertable -->
		
		<div class="table-responsive ordertable your_order">
			<div class="ordertableoption optiontop">
				<div class="section-heading">
					<h4 class="sectiontitle-alt"><span class="dine_remove"><?php _e( 'Dine ', 'hytteguiden' ); ?></span><?php _e( 'tidligere bestillinger', 'hytteguiden' ); ?></h4>
				</div>
			</div>

			<?php 
			
			$sql_prev = 'SELECT kodr.kataloger_id AS kataloger_id, kodr.order_date AS order_date, kodr.tracking_code AS tracking_code  FROM ' . $wpdb->prefix . 'kataloger_orders as kodr inner join ' . $wpdb->prefix . 'address as adr on kodr.address_id = adr.id WHERE ';  
			
			if(is_user_logged_in()){
				$current_user = wp_get_current_user();  
				$sql_prev .= ' ( adr.user_id ='. $current_user->ID . ' OR adr.guest_id = "'. $guest_id . '")';   
			}else {
				$sql_prev .= ' adr.guest_id = "'. $guest_id . '"'; 
			}

			
			$result_prev = $wpdb->get_results( $sql_prev );
			if($result_prev) {
				$count = 1;
		   ?>

			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th><?php _e( 'Produsent', 'hytteguiden' ); ?></th>
						<th><?php _e( 'Kataloger', 'hytteguiden' ); ?></th>
						<th><?php _e( 'Sporingskode', 'hytteguiden' ); ?></th>					
						<th><?php _e( 'Dato ', 'hytteguiden' ); ?><span class="bestilt_remove"><?php _e( 'bestilt', 'hytteguiden' ); ?></span></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach( $result_prev as $entry_prev ) {
					$kataloger_id = $entry_prev->kataloger_id;
					$producer_id = get_post_meta($kataloger_id, '_catalogs_producer_id', true);
					?>
					<tr>
					<td><?php echo $count;  ?></td>
					<td><a href="<?php echo get_permalink($producer_id); ?>"><?php echo get_the_title($producer_id); ?></a></td>
					<td><?php echo get_the_title($kataloger_id); ?></td>
					<td><?php echo $entry_prev->tracking_code; ?></td>
					<td><?php echo date("d/m/Y", strtotime($entry_prev->order_date)); ?></td>
					</tr>
					<?php $count++; } ?>

				</tbody>
			</table>
			<?php } else {
				_e( 'Du har ingen gamle ordre.', 'hytteguiden' );
			}?>
		</div>
		<!-- //ordertable -->
		    </div>
  </div>
</section>
<!-- //personalpage -->
<?php

get_footer();
