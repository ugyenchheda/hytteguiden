<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hytteguiden
 */

?>

<footer class="footer">
	<div class="container">
		<div class="footertop">
			<div class="row">
			<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Tilbake til toppen" data-toggle="tooltip" data-placement="left" ><i class="fas fa-arrow-alt-circle-up"></i></a>
				<?php dynamic_sidebar( 'footer_widget_area' ); ?>
			</div>
		</div>
		<?php
			$btm_footer_text = get_theme_mod( 'btm_footer_text', '&copy; 2018 <a href="/">Hytteguiden</a>. All Rights Reserved.');

			if(isset($btm_footer_text) && !empty($btm_footer_text)){
				echo '<div class="footerbtm"><p>'.$btm_footer_text . '</p></div>';
			}
			?>

	</div>
</footer>
<!-- //footer -->
<?php get_template_part( 'template-parts/filter', 'main' ); ?>
<!-- //searchfiltermodal -->
<?php wp_footer(); ?>

</body>
</html>
