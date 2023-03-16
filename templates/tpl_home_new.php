<?php
/**
 * The main template file
 *  Template Name:  New Home - Page Builder
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
$tax_query_meta = array();
$meta_query = array();

$posts_per_page = 6;
$posts_per_page_check = get_theme_mod( 'search_posts_per_page' );
if( isset( $posts_per_page_check ) && !empty( $posts_per_page_check ) ) {
  $posts_per_page = get_theme_mod( 'search_posts_per_page' );
}

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
  'post_type' 	 => 'cabin',
  'posts_per_page' 	=> $posts_per_page,
  'paged' 			=> $paged,
  'orderby' 		=> 'meta_value_num',
  'meta_key' 		=> 'cabin_price_turnkey',
  'order' 		    => 'desc',
);

if(isset($_REQUEST['s']) && !empty($_REQUEST['s'])){
	$args['s'] = $_REQUEST['s'];
}

 // Sorting cabins
 $selected_sorting = '';
 if(isset($_REQUEST['sorting']) && !empty($_REQUEST['sorting']) ){
	$selected_sorting = str_replace("size","cabin_utility_area", $_REQUEST['sorting']);
	$selected_sorting = str_replace("price","cabin_price_turnkey", $selected_sorting);

	$sorting_data = explode('-', $selected_sorting);
	$args['order'] = $sorting_data[1];
	$args['meta_key'] = $sorting_data[0];	
 }

 // Taxonomies for cabin style
 if(!empty($_REQUEST['cabin_style']) ){
	$cabin_style_slugs = explode(',',$_REQUEST['cabin_style']);
	$tax_query_meta[] = array(
													'taxonomy' => 'cabin_style',
													'field'    => 'slug',
													'terms'    => $cabin_style_slugs,
											);

}
// Taxonomies for cabin type
if(!empty($_REQUEST['cabin_type']) ){
	$cabin_type_slugs = explode(',',$_REQUEST['cabin_type']);
	$tax_query_meta[] = array(
													'taxonomy' => 'cabin_type',
													'field'    => 'slug',
													'terms'    => $cabin_type_slugs,
											);

}

// Taxonomies for cabin amenitty
if(!empty($_REQUEST['cabin_amenity']) ){
	$cabin_amenity_slugs = explode(',',$_REQUEST['cabin_amenity']);
	$tax_query_meta[] = array(
													'taxonomy' => 'cabin_amenity',
													'field'    => 'slug',
													'terms'    => $cabin_amenity_slugs,
											);

}

// Taxonomies for cabin method
if(!empty($_REQUEST['cabin_method']) ){
	$cabin_method_slugs = explode(',',$_REQUEST['cabin_method']);
	$tax_query_meta[] = array(
													'taxonomy' => 'cabin_method',
													'field'    => 'slug',
													'terms'    => $cabin_method_slugs,
											);

}

if($tax_query_meta){
	$args['tax_query'] = array(
												'relation' => 'AND',
												$tax_query_meta,
											);
}

/* Meta querry Filter */
// price range
if(isset($_REQUEST['min_price']) && !empty($_REQUEST['max_price'])){
	$meta_query[] = array(
												'key' => 'cabin_price_turnkey',
												'value' => array($_REQUEST['min_price'], $_REQUEST['max_price']),
												'type' => 'numeric',
												'compare' => 'BETWEEN'
											);

}

// size range
if(isset($_REQUEST['min_size']) && !empty($_REQUEST['max_size'])){
	$meta_query[] = array(
												'key' => 'cabin_utility_area',
												'value' => array($_REQUEST['filter_min_size'], $_REQUEST['max_size']),
												'type' => 'numeric',
												'compare' => 'BETWEEN'
											);

}

// Bedrooms
if(!empty($_REQUEST['bedrooms'])){
	$meta_query[] = array(
						'key' => 'cabin_bedroom',
						'value' => explode(',',$_REQUEST['bedrooms']),
						'type' => 'text',
						'compare' => 'IN'
					);

}


// Bathroom
if(!empty($_REQUEST['bathrooms'])){
	$meta_query[] = array(
						'key' => 'cabin_bathroom',
						'value' => explode(',',$_REQUEST['bathrooms']),
						'type' => 'text',
						'compare' => 'IN'
					);

	}

     // No of Beds in cabin
	 if(!empty($_REQUEST['beds'])){
		$beds = $_REQUEST['beds'];

		if($beds == '9+'){
		  $meta_query[] = array(
								'key' => 'cabin_beds',
								'value' => $beds,
								'type' => 'numeric',
								'compare' => '>='
							  );
		} else{
		  $meta_query[] = array(
								'key' => 'cabin_beds',
								'value' => explode('-',$beds),
								'compare' => 'IN'
							  );
		}
  }

if($meta_query){
	//$meta_query['relation'] = 'AND';
	$args['meta_query'] =  array(
												'relation' => 'AND',
												$meta_query,
											);
}


$cabinpost = new WP_Query( $args );
$total_record = $cabinpost->found_posts;
$load_more_record = $total_record - $posts_per_page;
if($load_more_record <= 0){
	$load_more_record = 0;
}


while ( have_posts() ) :
  the_post();
?>
<?php get_template_part( 'template-parts/search', 'box' ); ?>

<?php the_content(); ?>

<section class="section searchresult">
	<div class="container">
		<div class="searchcontrol">
			<div class="searchcount"><?php _e('Hytter:', 'hytteguiden'); ?> <span class="text-theme1" id="total_record"><?php echo $total_record; ?></span></div>
			<div class="searchsort">
				<select id="filter_sort_cabins" class="custom-select">
				<?php 
				$sorting_options = array(
					"cabin_price_turnkey-desc" => __( 'Pris synkende', 'hytteguiden' ),
					"cabin_price_turnkey-asc" => __( 'Pris stigende', 'hytteguiden' ),
					"cabin_utility_area-desc" => __( 'Størrelse synkende', 'hytteguiden' ),
					"cabin_utility_area-asc" => __( 'Størrelse stigende', 'hytteguiden' ),					
				);
				if($sorting_options){
					foreach ($sorting_options as $key => $sorting_option){
						echo '<option value="'. $key.'"';
						if(!empty($selected_sorting) && $selected_sorting == $key){
							echo ' selected="selected"';
						}
						echo '>'.$sorting_option .'</option>';
					}
				}
				?>
				
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-4 col-lg-3 ">
      <?php get_template_part( 'template-parts/filter', 'options' ); ?>
      </div>
      
			<div class="col-12 col-md-8 col-lg-9">
				<div class="searchlist">
					<div class="row gutter20x" id="cabin_data_wrapper">

						<?php 
							if ( $cabinpost->have_posts() ) {
								while ( $cabinpost->have_posts() ) : $cabinpost->the_post();

								get_template_part( 'template-parts/cabin', 'block' );

								endwhile;
							} else{ ?>
							<p><?php esc_html_e( 'Oops! no result found.', 'hytteguiden' ); ?></p>
							<?php 	}              
						?>
					</div>

					<div class="loadmore text-center">
					<input type="hidden" id="posts_per_page" name="posts_per_page" value="<?php echo $posts_per_page; ?>" />
          			<input type="hidden" id="paged" name="paged" value="2" />
						<button type="button" id="btn_load_more" class="btn btn-block btn-line-theme1"><?php _e('Last mer', 'hytteguiden'); ?><?php echo '('. $load_more_record .')';?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="stickyfiltertrigger">
	<span class="trigger" data-toggle="modal" data-target="#searchfilter">
		<img src="<?php echo get_template_directory_uri() ; ?>/images/controls.svg" alt="" class="img-fluid">
	</span>
</div>
</section>


<?php
		endwhile;
get_footer();
