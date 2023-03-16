<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Hytteguiden
 */

get_header();
?>

<section class="section page404">
	<div class="container">
		<div class="pagecontent">
			<img src="<?php echo get_template_directory_uri(); ?>/images/404-image.png" alt="" class="img-fluid">
			<h6><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'hytteguiden' ); ?></h6>
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'hytteguiden' ); ?><br>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">homepage</a>.</p>
		</div>
	</div>
</section>


<?php
get_footer();
