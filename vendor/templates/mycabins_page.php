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

?>
<section class="section personalpage">
	<div class="container-fluid">
		<h2 class="sectiontitle text-center"><span><?php _e('Min Hytte', 'hytteguiden'); ?></span></h2>
			<nav class="ppagenav">
			<?php echo hytteguiden_minside_tab('my_cabins');?>					
			</nav>
				<!-- //ppagenav -->
				<div class="table-responsive favtable">
				<?php
					global $post;

					$guest_id = hytteguiden_guest_id();
					if(is_user_logged_in()){
						$current_user = wp_get_current_user();  
						$cond .= ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")'; 
					} else{
						$cond .= ' AND guest_id = "'. $guest_id . '"'; 
					}
					$result = hytte_all_data( 'wishlists', $cond, 10000 );

					$myposts = get_posts( $args );
					if( $result ) {

					?>
			<table id="datatable" class="display table table-striped table-hover" style="width:100%">
				<thead>
					<tr>
						<th></th>
						<th><?php _e('Hytte', 'hytteguiden'); ?></th>
						<th><?php _e('Produsent', 'hytteguiden'); ?></th>
						<th><?php _e('Pris (nøkkelferdig)', 'hytteguiden'); ?></th>
						<th><?php _e('Pris (sett)', 'hytteguiden'); ?></th>
						<th><?php _e('Størrelse', 'hytteguiden'); ?></th>
						<th><?php _e('Soverom', 'hytteguiden'); ?> </th>
						<th><?php _e('Antall Bad', 'hytteguiden'); ?> </th>
						<th><?php _e('Byggemåte', 'hytteguiden'); ?> </th>
						<th><?php _e('Tak', 'hytteguiden'); ?> </th>
						<th><?php _e('Stil', 'hytteguiden'); ?> </th>
						<th><?php _e('Sengeplasser', 'hytteguiden'); ?></th>
						<th><?php _e('Hems', 'hytteguiden'); ?></th>
						<th><?php _e('Bod', 'hytteguiden'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach( $result as $entry ) {
							$post_id = $entry->post_id;
						?>
					<tr>
						<td>
						<?php
							if ( has_post_thumbnail( $post_id ) ) {
								echo '<figure class="cabinimg">';
								echo '<a href="'.get_permalink( $post_id ).'">';
								echo get_the_post_thumbnail( $post_id, 'post_image_s', array( "class" => "img-fluid" ) );
								echo '</a></figure>';
								}
							?>

						</td>
						<td><?php
						 echo '<a href="'.get_permalink($post_id).'">';
						 echo get_the_title($post_id);
						 echo '</a>';?></td>
						 <td>
							<?php
								$cabin_producer_id = get_post_meta( $post_id, 'cabin_producer_id', true);
								if(isset($cabin_producer_id) && !empty($cabin_producer_id)){								
									echo '<a href="'.get_permalink($cabin_producer_id).'">' . get_the_title($cabin_producer_id). '</a>';
							    }
							?>
						</td>
						<td>
							<?php
								$cabin_price_kit = get_post_meta( $post_id, 'cabin_price_kit', true);
								if(isset($cabin_price_kit) && !empty($cabin_price_kit)){
								echo $cabin_price_kit . 'kr';
							}
							?>
							</td>
						<td>
							<?php 
								$cabin_price_turnkey = get_post_meta( $post_id, 'cabin_price_turnkey', true);
								if(isset($cabin_price_turnkey) && !empty($cabin_price_turnkey)){
								echo $cabin_price_turnkey . 'kr';
							}
							?>
					  	</td>
						<td>
							<?php 
								$cabin_base_area = get_post_meta( $post_id, 'cabin_base_area', true);
								if(isset($cabin_base_area) && !empty($cabin_base_area)){
								echo $cabin_base_area . 'm<sup>2</sup>';
								}
							?>
						</td>
						<td>
						<?php 
								$cabin_bedroom = get_post_meta( $post_id, 'cabin_bedroom', true);
								if(isset($cabin_bedroom) && !empty($cabin_bedroom)){
								echo $cabin_bedroom;
								}
							?>
						</td>
						<td>
							<?php 
								$cabin_bathroom = get_post_meta( $post_id, 'cabin_bathroom', true);
								if(isset($cabin_bathroom) && !empty($cabin_bathroom)){
								echo $cabin_bathroom;
								}
							?>
						</td>


						<td>
							<?php $cabin_methods = hytteguiden_post_terms($post_id, $taxonomy = 'cabin_method');
							foreach ( $cabin_methods as $cabin_method ) {
							echo $cabin_method['name'];
							}
							?>
							</td>
						<td>
							<?php $cabin_types = hytteguiden_post_terms($post_id, $taxonomy = 'cabin_type');
							foreach ( $cabin_types as $cabin_type ) {
							echo $cabin_type['name'];
							}
							?>
							</td>
						<td>
							<?php $cabin_styles = hytteguiden_post_terms($post_id, $taxonomy = 'cabin_style');
							foreach ( $cabin_styles as $cabin_style ) {
							echo $cabin_style['name'];
							}
							?>
							</td>
						<td>
						<?php 
								$cabin_beds = get_post_meta( $post_id, 'cabin_beds', true);
								if(isset($cabin_beds) && !empty($cabin_beds)){
								echo $cabin_beds ;
							}
							?>
						</td>
						<td>
							<?php 
								$cabin_hems = get_post_meta( $post_id, 'cabin_hems', true);
								if(isset($cabin_hems) && !empty($cabin_hems)){
								echo $cabin_hems . 'kvm' ;
							}
							?>
						</td>
						<td>
							<?php 
								$cabin_bod = get_post_meta( $post_id, 'cabin_bod', true);
								if(isset($cabin_bod) && !empty($cabin_bod)){
								echo $cabin_bod  . 'm<sup>2</sup>';
							}
							?>
						</td>
					</tr>
						<?php }
          				 ?>
				</tbody>
			</table>
			<?php }  ?>
  </div>
</section>
<!-- //personalpage -->
<?php

get_footer();
