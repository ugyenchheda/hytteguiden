<?php
/**
 * The main template file
 *  Template Name: Home - Page Builder
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

while ( have_posts() ) :
  the_post();
?>
<?php get_template_part( 'template-parts/search', 'box' ); ?>

<?php the_content(); ?>
<?php
		endwhile;
get_footer();
