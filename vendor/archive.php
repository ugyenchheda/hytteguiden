<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hytteguiden
 */

get_header();
?>
<header class="archive-header">
	<div class="container">
		<?php
		the_archive_title( '<h2>', '</h2>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
		?>
	</div>
</header>
<section class="section">
	<div class="container">
		<div class="row">

			<?php if ( have_posts() ) : ?>
							<?php
							while ( have_posts() ) :
								the_post();
								get_template_part( 'template-parts/content', get_post_type() );

							endwhile;

							the_posts_navigation();

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>
		</div>
	</div>
</section>

<?php
get_footer();
