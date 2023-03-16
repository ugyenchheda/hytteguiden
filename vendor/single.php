<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Hytteguiden
 */

get_header();
while ( have_posts() ) : the_post();
?>
<?php
  $page_banner_image = get_theme_mod( 'page_banner_image', get_template_directory_uri(). '/images/bannerbg.jpg');
  $page_title = get_post_meta(get_the_ID(), 'page_title', true);
  $page_sub_title = get_post_meta(get_the_ID(), 'page_sub_title', true);

  if ( has_post_thumbnail() ) {
	
	$image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full' );
	$page_banner_image = $image_attributes[0];

  }

?>
<div class="pagetitle-featured" style="background-image: url('<?php echo $page_banner_image; ?>'); background-size: cover;">
	<div class="container">
		<div class="page-title">
			<?php 

				if(!empty($page_title)){
					echo '<h1>'. $page_title . '</h1>';
				}else {
					echo '<h1>'. get_the_title(get_the_ID()) . '</h1>';
				}
				//echo hytteguiden_custom_breadcrumbs();

			?>
		</div>
	</div>
</div>
<section class="section">

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<?php the_content(); ?>
			</div>
			<div class="col-md-4">
				<?php
				get_sidebar();
				?>
			</div>
		</div>
	</div>
</section>

<?php
endwhile; 
get_footer();
