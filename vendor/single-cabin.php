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

			// Cabin banner
			get_template_part( 'template-parts/cabins/cabin', 'banner' );

			?>

			<section class="section cabprofile">
				<div class="container">
					<div class="row">
						<div class="col-12 col-lg-8"  itemscope itemtype="http://schema.org/Product">
							<?php get_template_part( 'template-parts/cabins/main', 'content' ); ?>
						</div>

						<div class="col-12 col-lg-4 hide-sm-down">
								<?php get_template_part( 'template-parts/cabins/sidebar', 'content' ); ?>
						  </div>
					</div>
					<div class="mob_producer">
					<?php get_template_part( 'template-parts/cabins/related', 'producer' ); ?>
					</div>
					<?php get_template_part( 'template-parts/cabins/related', 'cabins' ); ?>
				</div>
			</section>

			<div class="stickyfoot">
				<div class="stickywrap">
			  		<div class="stickyinfo">
						<a href="#" class="btn btn-theme1" data-toggle="modal" data-target="#producercontactform"><?php _e('Kontakt', 'hytteguiden'); ?></a>
					</div>
					
					<div class="styckycta">
						<?php
						$cabin_kataloger = get_post_meta(get_the_ID(), 'cabin_kataloger', true);
						echo hytteguiden_cabin_kataloger_status($cabin_kataloger, $cabin_producer_id); ?> 
					</div>
				</div>
			</div>


			<?php get_template_part( 'template-parts/cabins/cabin', 'contact' ); ?>
			<?php get_template_part( 'template-parts/cabins/catalog', 'form' ); ?>
			<?php get_template_part( 'template-parts/global/login', 'prompt' ); ?>	
			<?php


		endwhile; // End of the loop.
		?>

<?php
get_footer();
