<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Hytteguiden
 */

get_header();
?>


		<?php
		while ( have_posts() ) :
			the_post();

			$GLOBALS['this_producer_id'] = get_the_ID();
			// Producer banner
			get_template_part( 'template-parts/producer/producer', 'banner' );

			?>
			<section class="section">
				<div class="container">
					<div class="row">
						<div class="col-12 col-lg-8">							
							<?php get_template_part( 'template-parts/producer/producer', 'profile' ); ?>
							<div id="related_pro">
								<?php get_template_part( 'template-parts/producer/producer', 'cabins' ); ?>
							</div>
						</div>
						<div class="col-12 col-lg-4">
						<?php get_template_part( 'template-parts/producer/producer', 'sidebar' ); ?>
							
						</div>
					</div>

					<?php get_template_part( 'template-parts/producer/related', 'news' ); ?>
				</div>
			</section>
			<div class="stickyfoot">
				<div class="stickywrap">
					
			<?php
				// echo '<p class="stickyinfo">';
				// /* Producer Phone*/
				// $producer_contact = '';
				// $cabin_producer_id = get_post_meta( get_the_ID(), 'cabin_producer_id', true);
				// if(isset($cabin_producer_id) && !empty($cabin_producer_id)){
				// 	/* Producer Email*/
				// 	$producer_email = get_post_meta( $cabin_producer_id, 'producer_email', true);
				// 	if(isset($producer_email) && !empty($producer_email)){
				// 		$producer_contact .= '<a href="mailto:'.$producer_email.'">'.$producer_email.'</a><br>';
				// 	}

				// 	$producer_contact_phone_1 = get_post_meta( $cabin_producer_id, 'producer_contact_phone_1', true);
				// 	if(isset($producer_contact_phone_1) && !empty($producer_contact_phone_1)){
				// 		$producer_contact .= $producer_contact_phone_1;
				// 	}
					
				// 	if(!empty($producer_contact)){
				// 		_e('For mer informasjon', 'hytteguiden');
				// 		echo '<br>'.$producer_contact;
				// 	} else{
				// 		$content_post = get_post($cabin_producer_id);
				// 		$content = $content_post->post_content;
				// 		$content = apply_filters('the_content', $content);
				// 		$content = str_replace(']]>', ']]&gt;', $content);
				// 		echo wp_trim_words( $content, 40, '...' );
				// 	}
				// }
				// echo '</p>';

			  ?>
			  		<div class="stickyinfo">
						<a href="#" class="btn btn-theme1" data-toggle="modal" data-target="#producercontactform"><?php _e('Kontakt', 'hytteguiden'); ?></a>
					</div>
					
					<div class="styckycta">
					<a href="#" class="btn btn-theme1" data-toggle="modal" data-target="#catalog_order_form"><?php _e('Bestill katalog', 'hytteguiden'); ?></a>
					</div>
				</div>
			</div>
			<?php get_template_part( 'template-parts/cabins/cabin', 'contact' ); ?>
			<?php get_template_part( 'template-parts/cabins/catalog', 'form' ); ?>
			<?php


		endwhile; // End of the loop.
		?>

<?php
get_footer();
