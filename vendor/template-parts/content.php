<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hytteguiden
 */

?>
<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="post-grid">
		<div class="feature-image">
		<a href="<?php echo get_permalink(get_the_ID()); ?>" class="blog-title">
			<?php
				echo get_the_post_thumbnail( $post_id, '', array( 'class' => 'img-fluid' ) );
			?>
			</a>
			</div>
			<h3 class="text-center"><a href="<?php echo get_permalink(get_the_ID()); ?>" class="blog-title"><?php the_title();?></a></h3>
			
			<span class="post_info_date">
				<?php the_time( get_option( 'date_format' ) ); ?>
			</span>
			<div class="blog-content">
			<?php
				echo wp_trim_words( get_the_content(), 30, '...' );
			?>
			<div class="blog-link">
				<a href="<?php echo get_permalink(get_the_ID()); ?>" class="excerpt-readmore"><?php _e('Les Mer', 'hytteguiden'); ?> <i class="fa fa-long-arrow-alt-right"></i></a>
			</div>
		</div>
	</div>
</div>
