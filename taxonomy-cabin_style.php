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

$taxonomy  = 'cabin_style';
$taxonomy_request = get_query_var( 'taxonomy' );
if(isset($taxonomy_request) && !empty($taxonomy_request)){
	 $taxonomy  = get_query_var( 'taxonomy' );
}

$cate = get_queried_object();

$t_id = $cate->term_id;

$posts_per_page = 6;
$posts_per_page_check = get_theme_mod( 'search_posts_per_page' );
if( isset( $posts_per_page_check ) && !empty( $posts_per_page_check ) ) {
	$posts_per_page = get_theme_mod( 'search_posts_per_page' );
}

$args = array(
		'posts_per_page' 	=> $posts_per_page,
		'paged' 	=> 1,
		'post_type' 		=> 'cabin',
		'tax_query'     	=> array(
								array(
									'taxonomy'  =>  $taxonomy,
									'field'     => 'id',
									'terms'     => array($t_id)
								)
							)
	);
$loop = new WP_Query( $args );

get_header();
?>
<?php get_template_part( 'template-parts/page', 'banner' ); ?>
<?php if ( $loop->have_posts() ) { ?>
<section class="section">
  <div class="container">
    <div id="cabin_data_wrapper" class="row">
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <?php get_template_part( 'template-parts/cabin', 'block' ); ?>
			<?php endwhile; ?>
  </div>
</section>

<section class="section">
  <div class="container">
		<input type="hidden" id="posts_per_page" value="<?php echo $posts_per_page?>">
		<input type="hidden" id="paged" value="2">
		<input type="hidden" id="tax_id" value="<?php echo $t_id; ?>">
		<input type="hidden" id="taxonomy" value="<?php echo $taxonomy; ?>">
		<button class="btn btn-block btn-theme1" id="btn_taxonomy_loadmore"><i class="fa fa-plus" style="padding-right: 10px;"></i><?php _e('Les mer', 'hytteguiden'); ?></button>

  </div>
</section>
<?php } else {
	echo '<div class="row"><div class="col-md-12 col-xs-12"> <p> No record found. </p></div></div>';

} ?>
<?php

get_footer();
