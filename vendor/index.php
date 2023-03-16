<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hytteguiden
 */

get_header();
?>
<?php get_template_part( 'template-parts/search', 'box' ); ?>
<!-- //sectionsearch -->

<section class="section sectioncat">
	<div class="container">
		<h2 class="sectiontitle-alt">Planer om å kjøpe hytte?</h2>
		<?php
		$args = array(
							 'hide_empty' => 0
						);
		$terms = get_terms( 'cabin_style', $args );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		?>

		<div class="row">
			<?php foreach ( $terms as $term ) {
				$image_id = get_term_meta ( $term->term_id, 'cabin_style_image_id', true );
			 ?>

			<div class="col-6 col-md-3">
				<div class="catblock">
					<a href="<?php echo get_term_link($term->term_id, 'cabin_style'); ?>">

							<?php
							if(isset($image_id) && !empty($image_id)){
								 echo '<figure class="catimg">';
								 echo wp_get_attachment_image( $image_id, 'large', '', array( "class" => "img-fluid", "alt" => $term->name )  );
								 echo '</figure>';
							}
							 ?>

						<h4 class="catname"> <?php echo $term->name; ?></h4>
					</a>
				</div>
			</div>
		  <?php } ?>

		</div>
	<?php } ?>

	</div>
</section>
<!-- //sectioncat -->

<section class="section">
	<div class="container">
		<h2 class="sectiontitle"><span>Laftet</span></h2>
		<div class="row">
			<div class="col-12 col-sm-6 col-lg-3">
				<div class="cabinmodule">
					<figure class="cabinimg">
						<img src="<?php echo get_template_directory_uri(); ?>/images/cabin-img01.jpg" alt="Vinterhytta" class="img-fluid">
					</figure>
					<div class="cabindetails">
						<div class="cabintitle">
							<a href="#" class="cabinsubtitle">Røroshytta</a>
							<h4><a href="#">Vinterhytta</a></h4>
						</div>
						<div class="cabininfo">
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/tag.svg" alt=""></span> 1.900.000 (Byggesett)<br>2.850.000 (Nøkkelferdig)</li>
							</ul>
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/scale.svg" alt=""></span> 124 kvm</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/room-key.svg" alt=""></span> 3 soverom</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/bed.svg" alt=""></span> 8 senger</li>
							</ul>
						</div>
						<a href="#" class="btn btn-block btn-line-theme1">View Details <i class="fa fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-lg-3">
				<div class="cabinmodule">
					<figure class="cabinimg">
						<img src="<?php echo get_template_directory_uri(); ?>/images/cabin-img02.jpg" alt="Vinterhytta" class="img-fluid">
					</figure>
					<div class="cabindetails">
						<div class="cabintitle">
							<a href="#" class="cabinsubtitle">Røroshytta</a>
							<h4><a href="#">Vinterhytta</a></h4>
						</div>
						<div class="cabininfo">
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/tag.svg" alt=""></span> 1.900.000 (Byggesett)<br>2.850.000 (Nøkkelferdig)</li>
							</ul>
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/scale.svg" alt=""></span> 124 kvm</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/room-key.svg" alt=""></span> 3 soverom</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/bed.svg" alt=""></span> 8 senger</li>
							</ul>
						</div>
						<a href="#" class="btn btn-block btn-line-theme1">View Details <i class="fa fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-lg-3">
				<div class="cabinmodule">
					<figure class="cabinimg">
						<img src="<?php echo get_template_directory_uri(); ?>/images/cabin-img03.jpg" alt="Vinterhytta" class="img-fluid">
					</figure>
					<div class="cabindetails">
						<div class="cabintitle">
							<a href="#" class="cabinsubtitle">Røroshytta</a>
							<h4><a href="#">Vinterhytta</a></h4>
						</div>
						<div class="cabininfo">
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/tag.svg" alt=""></span> 1.900.000 (Byggesett)<br>2.850.000 (Nøkkelferdig)</li>
							</ul>
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/scale.svg" alt=""></span> 124 kvm</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/room-key.svg" alt=""></span> 3 soverom</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/bed.svg" alt=""></span> 8 senger</li>
							</ul>
						</div>
						<a href="#" class="btn btn-block btn-line-theme1">View Details <i class="fa fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-lg-3">
				<div class="cabinmodule">
					<figure class="cabinimg">
						<img src="<?php echo get_template_directory_uri(); ?>/images/cabin-img04.jpg" alt="Vinterhytta" class="img-fluid">
					</figure>
					<div class="cabindetails">
						<div class="cabintitle">
							<a href="#" class="cabinsubtitle">Røroshytta</a>
							<h4><a href="#">Vinterhytta</a></h4>
						</div>
						<div class="cabininfo">
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/tag.svg" alt=""></span> 1.900.000 (Byggesett)<br>2.850.000 (Nøkkelferdig)</li>
							</ul>
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/scale.svg" alt=""></span> 124 kvm</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/room-key.svg" alt=""></span> 3 soverom</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/bed.svg" alt=""></span> 8 senger</li>
							</ul>
						</div>
						<a href="#" class="btn btn-block btn-line-theme1">View Details <i class="fa fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //section -->

<section class="section">
	<div class="container">
		<h2 class="sectiontitle"><span>VED SJØEN</span></h2>
		<div class="row">
			<div class="col-12 col-sm-6 col-lg-3">
				<div class="cabinmodule">
					<figure class="cabinimg">
						<img src="<?php echo get_template_directory_uri(); ?>/images/cabin-img01.jpg" alt="Vinterhytta" class="img-fluid">
					</figure>
					<div class="cabindetails">
						<div class="cabintitle">
							<a href="#" class="cabinsubtitle">Røroshytta</a>
							<h4><a href="#">Vinterhytta</a></h4>
						</div>
						<div class="cabininfo">
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/tag.svg" alt=""></span> 1.900.000 (Byggesett)<br>2.850.000 (Nøkkelferdig)</li>
							</ul>
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/scale.svg" alt=""></span> 124 kvm</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/room-key.svg" alt=""></span> 3 soverom</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/bed.svg" alt=""></span> 8 senger</li>
							</ul>
						</div>
						<a href="#" class="btn btn-block btn-line-theme1">View Details <i class="fa fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-lg-3">
				<div class="cabinmodule">
					<figure class="cabinimg">
						<img src="<?php echo get_template_directory_uri(); ?>/images/cabin-img02.jpg" alt="Vinterhytta" class="img-fluid">
					</figure>
					<div class="cabindetails">
						<div class="cabintitle">
							<a href="#" class="cabinsubtitle">Røroshytta</a>
							<h4><a href="#">Vinterhytta</a></h4>
						</div>
						<div class="cabininfo">
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/tag.svg" alt=""></span> 1.900.000 (Byggesett)<br>2.850.000 (Nøkkelferdig)</li>
							</ul>
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/scale.svg" alt=""></span> 124 kvm</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/room-key.svg" alt=""></span> 3 soverom</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/bed.svg" alt=""></span> 8 senger</li>
							</ul>
						</div>
						<a href="#" class="btn btn-block btn-line-theme1">View Details <i class="fa fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-lg-3">
				<div class="cabinmodule">
					<figure class="cabinimg">
						<img src="<?php echo get_template_directory_uri(); ?>/images/cabin-img03.jpg" alt="Vinterhytta" class="img-fluid">
					</figure>
					<div class="cabindetails">
						<div class="cabintitle">
							<a href="#" class="cabinsubtitle">Røroshytta</a>
							<h4><a href="#">Vinterhytta</a></h4>
						</div>
						<div class="cabininfo">
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/tag.svg" alt=""></span> 1.900.000 (Byggesett)<br>2.850.000 (Nøkkelferdig)</li>
							</ul>
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/scale.svg" alt=""></span> 124 kvm</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/room-key.svg" alt=""></span> 3 soverom</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/bed.svg" alt=""></span> 8 senger</li>
							</ul>
						</div>
						<a href="#" class="btn btn-block btn-line-theme1">View Details <i class="fa fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-lg-3">
				<div class="cabinmodule">
					<figure class="cabinimg">
						<img src="<?php echo get_template_directory_uri(); ?>/images/cabin-img04.jpg" alt="Vinterhytta" class="img-fluid">
					</figure>
					<div class="cabindetails">
						<div class="cabintitle">
							<a href="#" class="cabinsubtitle">Røroshytta</a>
							<h4><a href="#">Vinterhytta</a></h4>
						</div>
						<div class="cabininfo">
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/tag.svg" alt=""></span> 1.900.000 (Byggesett)<br>2.850.000 (Nøkkelferdig)</li>
							</ul>
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/scale.svg" alt=""></span> 124 kvm</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/room-key.svg" alt=""></span> 3 soverom</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/bed.svg" alt=""></span> 8 senger</li>
							</ul>
						</div>
						<a href="#" class="btn btn-block btn-line-theme1">View Details <i class="fa fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //section -->

<section class="section">
	<div class="container">
		<h2 class="sectiontitle"><span>UNDER 3 MILLIONER</span></h2>
		<div class="row">
			<div class="col-12 col-sm-6 col-lg-3">
				<div class="cabinmodule">
					<figure class="cabinimg">
						<img src="<?php echo get_template_directory_uri(); ?>/images/cabin-img01.jpg" alt="Vinterhytta" class="img-fluid">
					</figure>
					<div class="cabindetails">
						<div class="cabintitle">
							<a href="#" class="cabinsubtitle">Røroshytta</a>
							<h4><a href="#">Vinterhytta</a></h4>
						</div>
						<div class="cabininfo">
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/tag.svg" alt=""></span> 1.900.000 (Byggesett)<br>2.850.000 (Nøkkelferdig)</li>
							</ul>
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/scale.svg" alt=""></span> 124 kvm</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/room-key.svg" alt=""></span> 3 soverom</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/bed.svg" alt=""></span> 8 senger</li>
							</ul>
						</div>
						<a href="#" class="btn btn-block btn-line-theme1">View Details <i class="fa fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-lg-3">
				<div class="cabinmodule">
					<figure class="cabinimg">
						<img src="<?php echo get_template_directory_uri(); ?>/images/cabin-img02.jpg" alt="Vinterhytta" class="img-fluid">
					</figure>
					<div class="cabindetails">
						<div class="cabintitle">
							<a href="#" class="cabinsubtitle">Røroshytta</a>
							<h4><a href="#">Vinterhytta</a></h4>
						</div>
						<div class="cabininfo">
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/tag.svg" alt=""></span> 1.900.000 (Byggesett)<br>2.850.000 (Nøkkelferdig)</li>
							</ul>
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/scale.svg" alt=""></span> 124 kvm</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/room-key.svg" alt=""></span> 3 soverom</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/bed.svg" alt=""></span> 8 senger</li>
							</ul>
						</div>
						<a href="#" class="btn btn-block btn-line-theme1">View Details <i class="fa fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-lg-3">
				<div class="cabinmodule">
					<figure class="cabinimg">
						<img src="<?php echo get_template_directory_uri(); ?>/images/cabin-img03.jpg" alt="Vinterhytta" class="img-fluid">
					</figure>
					<div class="cabindetails">
						<div class="cabintitle">
							<a href="#" class="cabinsubtitle">Røroshytta</a>
							<h4><a href="#">Vinterhytta</a></h4>
						</div>
						<div class="cabininfo">
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/tag.svg" alt=""></span> 1.900.000 (Byggesett)<br>2.850.000 (Nøkkelferdig)</li>
							</ul>
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/scale.svg" alt=""></span> 124 kvm</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/room-key.svg" alt=""></span> 3 soverom</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/bed.svg" alt=""></span> 8 senger</li>
							</ul>
						</div>
						<a href="#" class="btn btn-block btn-line-theme1">View Details <i class="fa fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-lg-3">
				<div class="cabinmodule">
					<figure class="cabinimg">
						<img src="<?php echo get_template_directory_uri(); ?>/images/cabin-img04.jpg" alt="Vinterhytta" class="img-fluid">
					</figure>
					<div class="cabindetails">
						<div class="cabintitle">
							<a href="#" class="cabinsubtitle">Røroshytta</a>
							<h4><a href="#">Vinterhytta</a></h4>
						</div>
						<div class="cabininfo">
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/tag.svg" alt=""></span> 1.900.000 (Byggesett)<br>2.850.000 (Nøkkelferdig)</li>
							</ul>
							<ul>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/scale.svg" alt=""></span> 124 kvm</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/room-key.svg" alt=""></span> 3 soverom</li>
								<li><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/bed.svg" alt=""></span> 8 senger</li>
							</ul>
						</div>
						<a href="#" class="btn btn-block btn-line-theme1">View Details <i class="fa fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //section -->
<?php

get_footer();
