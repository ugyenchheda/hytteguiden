<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hytteguiden
 */

get_header();
?>
<?php
	while ( have_posts() ) :
		the_post();
?>
<?php
  $page_banner_image = get_theme_mod( 'page_banner_image', get_template_directory_uri(). '/images/bannerbg.jpg');
  $page_title = get_post_meta(get_the_ID(), 'page_title', true);
  $page_sub_title = get_post_meta(get_the_ID(), 'page_sub_title', true);
  $attachment_id = get_post_meta(get_the_ID(), 'page_banner_id', true);
  if(!empty($attachment_id)){
	$image_attributes = wp_get_attachment_image_src( $attachment_id, 'full' );
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
				if(!empty($page_sub_title)){
					echo '<h5>'. $page_sub_title . '</h5>';
				}
			?>
		</div>
	</div>
</div>
<!-- //profile-feature -->

<section class="section">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-12">
				<?php the_content();?>
			</div>
		</div>
	</div>
</section>

<?php
endwhile; 
get_footer();
?>