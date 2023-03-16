<?php
function hytteguiden_admin_script() {
    	wp_enqueue_style( 'hytte_style', get_template_directory_uri() . '/library/admin/assets/css/hytte_style.css', array(), '1.8' );
      wp_register_script( 'admin_script', get_template_directory_uri() . '/library/admin/assets/js/admin_script.js', array(), '20190105', true );
      wp_enqueue_script('admin_script');

      $hytte_admin_params = array(
            'admin_ajax_url' => admin_url( 'admin-ajax.php' ),
      );
      wp_localize_script( 'admin_script', 'hytte_admin_params', $hytte_admin_params	);

}
add_action( 'admin_enqueue_scripts', 'hytteguiden_admin_script' );

if ( ! function_exists( 'hytteguiden_init' ) ) {
  function hytteguiden_init( ) {

    $GLOBALS['route_defaults'] = array(
      'search_page' => 'finn',
      'login_page' => 'logg-inn',
      'producerlogin_page' => 'produsent-logginn',
      'myprofile_page' => 'min-side',
      'mycabins_page' => 'mine-hytter',
      'mycatalogue_page' => 'mine-kataloger',
      'mydashboard_page' => 'mine-dashboard',
      'producerprofile_page' => 'produsent-profile',  
      'producerhytter_page' => 'produsent-hytter',
      'producerkataloger_page' => 'produsent-kataloger',
      'producerrequest_page' => 'produsent-forespørsler',
      'producerupdatehytte_page' => 'hytte-oppdater',
      'producerupdatekataloger_page' => 'kataloger-oppdater',
      );  

    $GLOBALS['slider_defaults'] = array(
      'slider_min_price' => '0',
      'slider_max_price' => '5000000',
      'slider_min_size' => '0',
      'slider_max_size' => '300',
      'slider_min_beds' => '0',
      'slider_max_beds' => '15',
    );

    $route_defaults_data = get_option('route_defaults');
    if(isset($route_defaults_data) && !empty($route_defaults_data)){
      $GLOBALS['route_defaults'] = $route_defaults_data;
    }

    $slider_defaults_data = get_option('slider_defaults');
    if(isset($slider_defaults_data) && !empty($slider_defaults_data)){
      $GLOBALS['slider_defaults'] = $slider_defaults_data;
    }

    hytteguiden_guest_id();
       
  }
}

add_action( 'init', 'hytteguiden_init' );

function hytteguiden_guest_id() {
    $content = '';
    if(!isset($_COOKIE['guest_auth_token'])) {
      $user_auth =  hytte_random_keygen();
      setcookie( 'guest_auth_token', $user_auth, time() + 78436438, '/' );
      $content = $user_auth;
    } else{
      $content = $_COOKIE['guest_auth_token'];
    }

    return $content;
}


//***** Routing for Cabin Search ****//
function hytteguiden_locations_rewrite_rule() {
  
    $route_defaults = $GLOBALS['route_defaults'];
    
    if($route_defaults){
      foreach($route_defaults as $key => $value){
        add_rewrite_rule('^'. $value.'/?([^/]*)/?','index.php?'. $key .'=true','top');
      }
    }

}
function hytteguiden_register_query_var( $vars ) {

    $route_defaults = $GLOBALS['route_defaults'];
    
    if($route_defaults){
      foreach($route_defaults as $key => $value){
        $vars[] = $key;
      }
    }

    return $vars;
}

function hytteguiden_url_rewrite_templates() {

  if ( get_query_var( 'search_page' ) ) {
      add_filter( 'template_include', function() {          
          return get_template_directory() . '/templates/search_page.php';
      });
  }

  if ( get_query_var( 'login_page' ) ) {
    add_filter( 'template_include', function() {          
        return get_template_directory() . '/templates/login_page.php';
    });
  }

  if ( get_query_var( 'myprofile_page' ) ) {
    add_filter( 'template_include', function() {          
        return get_template_directory() . '/templates/myprofile_page.php';
    });
  }


  if ( get_query_var( 'mycabins_page' ) ) {
    add_filter( 'template_include', function() {          
        return get_template_directory() . '/templates/mycabins_page.php';
    });
  }


  if ( get_query_var( 'mycatalogue_page' ) ) {
    add_filter( 'template_include', function() {          
        return get_template_directory() . '/templates/mycatalogue_page.php';
    });
  }


  if ( get_query_var( 'mydashboard_page' ) ) {
    add_filter( 'template_include', function() {          
        return get_template_directory() . '/templates/mydashboard_page.php';
    });
  }

  if ( get_query_var( 'producerlogin_page' ) ) {
    add_filter( 'template_include', function() {          
        return get_template_directory() . '/templates/producer/producerlogin_page.php';
    });
  }

  if ( get_query_var( 'producerprofile_page' ) ) {
    add_filter( 'template_include', function() {          
        return get_template_directory() . '/templates/producer/producerprofile_page.php';
    });
  }

  if ( get_query_var( 'producerrequest_page' ) ) {
    add_filter( 'template_include', function() {          
        return get_template_directory() . '/templates/producer/producerrequest_page.php';
    });
  }

  if ( get_query_var( 'producerhytter_page' ) ) {
    add_filter( 'template_include', function() {          
        return get_template_directory() . '/templates/producer/producerhytter_page.php';
    });
  }

  if ( get_query_var( 'producerkataloger_page' ) ) {
    add_filter( 'template_include', function() {          
        return get_template_directory() . '/templates/producer/producerkataloger_page.php';
    });
  }

  if ( get_query_var( 'producerupdatehytte_page' ) ) {
    add_filter( 'template_include', function() {          
        return get_template_directory() . '/templates/producer/producerupdatehytte_page.php';
    });
  }

  if ( get_query_var( 'producerupdatekataloger_page' ) ) {
    add_filter( 'template_include', function() {          
        return get_template_directory() . '/templates/producer/producerupdatekataloger_page.php';
    });
  }


}


add_action( 'template_redirect', 'hytteguiden_url_rewrite_templates' );
add_filter( 'query_vars', 'hytteguiden_register_query_var' );
add_action( 'init', 'hytteguiden_locations_rewrite_rule' );

/* Search Result Page Title
.................................. */
if ( ! function_exists( 'hytteguiden_filter_the_title' ) ) {
  function hytteguiden_filter_the_title( $title_parts ) {
    if ( get_query_var( 'cabins' ) ) {
      $title_parts['title'] = __('Search Result', 'hytteguiden');
    }
    return $title_parts;
  }
}

add_filter( 'document_title_parts', 'hytteguiden_filter_the_title');

/* ajax function for filter cabin
.................................. */
if ( ! function_exists( 'hytteguiden_filter_cabin' ) ) {
  function hytteguiden_filter_cabin() {
    $response_arr = array();
    $content = '';
    $record_count = '';
    $tax_query_meta = array();
    $meta_query = array();

    $paged = $_POST['paged']; 
    if( isset($_POST['opt_mode']) && $_POST['opt_mode'] == 'filter'){
      $paged = 1;
    }

    $args = array(
         'post_type' 	 => 'cabin',
         'posts_per_page' 	=> $_POST['posts_per_page'],
         'paged' 			=> $paged,
    );

    /* Search via producer/ query string */ 
    
    if(isset($_POST['s']) && !empty($_POST['s'])){
      $query_text = $_POST['s'];
      $producer_data = get_page_by_title( $query_text, OBJECT, 'producer' );
      if ( ! empty( $producer_data ) && ! is_wp_error( $producer_data ) ) {
    
        $meta_query[] = array(
          'key' => 'cabin_producer_id',
          'value' => $producer_data->ID,
          'type' => 'numeric',
          'compare' => '='
        );
    
      } else{
        $args['s'] = $query_text;
      }
        
    }

    if(!empty($_POST['filter_sort_cabins']) ){
      $filter_sort_cabins = explode("-",$_POST['filter_sort_cabins']);
      $args['meta_key'] = $filter_sort_cabins[0];
      $args['order'] = $filter_sort_cabins[1];
      $args['orderby'] = 'meta_value_num';
    }

    // Taxonomies for cabin style
    if(!empty($_POST['cabin_style']) ){
      $cabin_style_slugs = explode(',',$_POST['cabin_style']);
      $tax_query_meta[] = array(
                              'taxonomy' => 'cabin_style',
                              'field'    => 'slug',
                              'terms'    => $cabin_style_slugs,
                          );

    }
    // Taxonomies for cabin type
    if(!empty($_POST['cabin_type']) ){
      $cabin_type_slugs = explode(',',$_POST['cabin_type']);
      $tax_query_meta[] = array(
                              'taxonomy' => 'cabin_type',
                              'field'    => 'slug',
                              'terms'    => $cabin_type_slugs,
                          );

    }

    // Taxonomies for cabin amenitty
    if(!empty($_POST['cabin_amenity']) ){
      $cabin_amenity_slugs = explode(',',$_POST['cabin_amenity']);
      $tax_query_meta[] = array(
                              'taxonomy' => 'cabin_amenity',
                              'field'    => 'slug',
                              'terms'    => $cabin_amenity_slugs,
                          );

    }

    // Taxonomies for cabin method
    if(!empty($_POST['cabin_method']) ){
      $cabin_method_slugs = explode(',',$_POST['cabin_method']);
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
    if(isset($_POST['filter_min_price']) && !empty($_POST['filter_max_price'])){
      $meta_query[] = array(
                            'key' => 'cabin_price_turnkey',
                      			'value' => array($_POST['filter_min_price'], $_POST['filter_max_price']),
                      			'type' => 'numeric',
                      			'compare' => 'BETWEEN'
                          );
    }

    // size range
    if(isset($_POST['filter_min_size']) && !empty($_POST['filter_max_size'])){
      $meta_query[] = array(
                            'key' => 'cabin_utility_area',
                            'value' => array($_POST['filter_min_size'], $_POST['filter_max_size']),
                            'type' => 'numeric',
                            'compare' => 'BETWEEN'
                          );

    }

    // No of Beds in Range 
    if(isset($_POST['filter_min_beds']) && !empty($_POST['filter_max_beds'])){
      $meta_query[] = array(
                            'key' => 'cabin_beds',
                      			'value' => array($_POST['filter_min_beds'], $_POST['filter_max_beds']),
                      			'type' => 'numeric',
                      			'compare' => 'BETWEEN'
                          );
    }

    // Bedrooms
    if(!empty($_POST['filter_bedrooms'])){

        $bedrooms_request_arr = explode(',',$_REQUEST['filter_bedrooms']);
        if (in_array("6*", $bedrooms_request_arr)){
          $meta_query[] = array(
            'key' => 'cabin_bedroom',
            'value' => 6,
            'type' => 'numeric',
            'compare' => '>='
          );
      
        } else{
          $meta_query[] = array(
            'key' => 'cabin_bedroom',
            'value' => explode(',',$_REQUEST['filter_bedrooms']),
            'type' => 'text',
            'compare' => 'IN'
          );
        }

    }

    // Bathroom
    if(!empty($_POST['filter_bathrooms'])){
        $bathrooms_request_arr = explode(',',$_REQUEST['filter_bathrooms']);
        if (in_array("6*", $bathrooms_request_arr)){
          $meta_query[] = array(
            'key' => 'cabin_bathroom',
            'value' => 6,
            'type' => 'numeric',
            'compare' => '>='
          );
      
        } else{
          $meta_query[] = array(
            'key' => 'cabin_bathroom',
            'value' => explode(',',$_REQUEST['filter_bathrooms']),
            'type' => 'text',
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
    $load_more_record = $total_record - $_POST['posts_per_page'] * $paged;
    if($load_more_record <= 0){
      $load_more_record = 0;
    }

    //print_r($args);


    if ( $cabinpost->have_posts() ) {
      
      while ( $cabinpost->have_posts() ) : $cabinpost->the_post();

      $cabin_price_kit = get_post_meta( get_the_ID(), 'cabin_price_kit', true);
      $cabin_price_turnkey = get_post_meta( get_the_ID(), 'cabin_price_turnkey', true);
      $cabin_bedroom = get_post_meta( get_the_ID(), 'cabin_bedroom', true);
      $cabin_utility_area = get_post_meta( get_the_ID(), 'cabin_utility_area', true);
      $cabin_beds = get_post_meta( get_the_ID(), 'cabin_beds', true);

       
$content .= '<div class="col-12 col-sm-6 col-lg-4 item" itemscope itemtype="http://schema.org/product">
<div class="cabinmodule"><a href="'. get_permalink().'"><figure class="cabinimg" itemprop="image">';

if ( has_post_thumbnail() ) {
   $content .= get_the_post_thumbnail( get_the_ID(), 'post_image_s', array( 'class' => 'cabImg img-fluid' ) );
}
else {
    $content .=  '<img src="'. plugins_url('/assets/img/no_image.png', dirname(__FILE__) ) .'" class="img-fluid"  itemprop="image"/>';
}

$content .= '</figure></a><div class="cabindetails">
    <div class="cabintitle">
      <span  itemprop="brand">'. hytteguiden_producer_name(get_the_ID()) .'</span>
      <h3 itemprop="name" ><a href="'. get_permalink().'">'. get_the_title().'</a></h3>
    </div>
    <div class="cabininfo">
      <ul>';


        $content .= '<li><span class="icon"><span class="icon-tag"></span></span>'. hytteguiden_price($cabin_price_turnkey).' kr</li>';

        $content .= '<li><span class="icon"><span class="icon-scale"></span></span>'. hytteguiden_formate_number($cabin_utility_area).' m <sup>2</sup></li>';

        $content .= '<li><span class="icon"><span class="icon-bed"></span></span>'. $cabin_bedroom.' soverom</li>';

      $content .= '</ul>
    </div>
    <a href="'. get_permalink().' " class="btn btn-block btn-line-theme1" " itemprop="url">'.__( 'Les mer', 'hytteguiden').' <i class="fa fa-long-arrow-alt-right"></i></a>
  </div>
</div>
</div>';

      endwhile;
    }
    $record_message = sprintf( esc_html( _n( '%d CABIN MATCHES YOUR SEARCH CRITERIA', '%d CABINS MATCH YOUR SEARCH CRITERIA', $record_count, 'hytteguiden' ) ), $record_count );
    $response_arr['content'] = $content;
    $response_arr['record_count'] = $record_message;
    $response_arr['total_record'] = $total_record;
    $response_arr['load_more_text'] = __('Last mer', 'hytteguiden') . '('.$load_more_record . ')';

  	echo json_encode($response_arr);
  	exit;

  }
}

add_action( 'wp_ajax_hytteguiden_filter_cabin','hytteguiden_filter_cabin');
add_action( 'wp_ajax_nopriv_hytteguiden_filter_cabin','hytteguiden_filter_cabin');

// Hytteguiden Post Terms
if ( ! function_exists( 'hytteguiden_post_terms' ) ) {
  function hytteguiden_post_terms($post_id, $taxonomy = 'category') {
    $term_data = array();
    $terms = wp_get_post_terms( $post_id, $taxonomy, array( 'fields' => 'all' ) );
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
      foreach ( $terms as $term ) {
        $term_data[] = array(
                    'term_id' => $term->term_id,
                    'name' => $term->name,
                    'slug' => $term->slug,
                        );
      }

    }
    return $term_data;
  }
}

// Hytteguiden Post Terms
if ( ! function_exists( 'hytteguiden_single_post_terms' ) ) {
  function hytteguiden_single_post_terms($post_id, $taxonomy = 'category', $anchor_class = '') {
    $return_tax = '';
    $tax_cnt = '';
    $term_data = hytteguiden_post_terms($post_id, $taxonomy);
    shuffle($term_data);
    if ( ! empty( $term_data ) && ! is_wp_error( $term_data ) ) {

      $return_tax = '<a href="'.get_term_link( $term_data[0]['term_id'] ).'" class="'. $anchor_class .'">'.$term_data[0]['name'].'</a>';
    }
    return $return_tax;
  }
}

// Hytteguiden Retrive custom image src
if ( ! function_exists( 'hytteguiden_custom_image_src' ) ) {
  function hytteguiden_custom_image_src($image_url, $thumbnail = 'thumbnail') {
    global $wpdb;
    $custom_img_url = '';

    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
    if($attachment){
      $image_id =  $attachment[0];
      $image_thumb = wp_get_attachment_image_src($image_id, $thumbnail);
      if($image_thumb){
        return $image_thumb[0];
      }

    }
    return $image_url;

  }
}

// Hytteguiden Loadmore taxonomy data
if ( ! function_exists( 'hytteguiden_taxonomy_loadmore' ) ) {
  function hytteguiden_taxonomy_loadmore() {
    global $wpdb;
    $data_content = '';
    $data = array(
        'status' => 'error',
        'content' => '',
     );

    $args = array(
        'post_type' => 'cabin',
        'orderby' => 'date',
        'order' => 'desc',
        'posts_per_page' 	=> $_POST['posts_per_page'],
        'paged' 	=> $_POST['paged'],
        'tax_query' 	=> array(
																array(
																	'taxonomy'  => $_POST['taxonomy'],
																	'field'     => 'id',
																	'terms'     => array( $_POST['tax_id'])
      													)
      											),
      );

      $loop = new WP_Query( $args );

      if ( $loop->have_posts() ) {
         while ( $loop->have_posts() ) : $loop->the_post();

         $cabin_price_kit = get_post_meta( get_the_ID(), 'cabin_price_kit', true);
         $cabin_price_turnkey = get_post_meta( get_the_ID(), 'cabin_price_turnkey', true);
         $cabin_bedroom = get_post_meta( get_the_ID(), 'cabin_bedroom', true);
         $cabin_utility_area = get_post_meta( get_the_ID(), 'cabin_utility_area', true);
         $cabin_beds = get_post_meta( get_the_ID(), 'cabin_beds', true);

         $data_content .= '<div class="col-md-4 item" itemscope="" itemtype="http://schema.org/product">
         	<div class="cabinmodule"><figure class="cabinimg">';

         	if ( has_post_thumbnail() ) {
         		 $data_content .= get_the_post_thumbnail( get_the_ID(), array( 265, 176), array( 'class' => 'img-fluid' ) );
         	}
         	else {
         			$data_content .=  '<img src="'. plugins_url('/assets/img/no_image.png', dirname(__FILE__) ) .'" class="img-fluid" itemprop="image"/>';
         	}

         $data_content .= '</figure><div class="cabindetails">
         <div class="cabintitle"><span  itemprop="brand">
           '. hytteguiden_producer_name(get_the_ID()) .'</span>
           <h3 itemprop="name"><a href="'. get_permalink().'">'. get_the_title().'</a></h3>
         </div>
         			<div class="cabininfo">
         				<ul>';

                  if(!empty($cabin_price_turnkey)){
                    $data_content .= '<li><span class="icon">'. hytteguiden_icon( 'tag.svg', $alt = 'Hytte Pris' ).'</span>'. hytteguiden_price($cabin_price_turnkey).' kr</li>';
                  }
                  $data_content .= '<li><span class="icon">'. hytteguiden_icon( 'scale.svg', $alt = 'Hytte Pris' ).'</span>'. hytteguiden_price($cabin_utility_area).' ft <sup>2</sup></li>';

         					$data_content .= '<li><span class="icon">'. hytteguiden_icon( 'bed.svg', $alt = 'Hytte Pris' ).'</span>'. $cabin_bedroom.' soverom</li>';

         				$data_content .= '</ul>
         			</div>
         			<a href="'. get_permalink().' " class="btn btn-block btn-line-theme1" itemprop="url">'. __('Les mer', 'hytteguiden').' <i class="fa fa-long-arrow-alt-right"></i></a>
         		</div>
         	</div>
         </div>';

         endwhile;

         $data['status'] = 'success';
         $data['content'] = $data_content;
    }

    echo json_encode($data, true);
    exit;

  }
}

add_action( 'wp_ajax_hytteguiden_taxonomy_loadmore', 'hytteguiden_taxonomy_loadmore');
add_action( 'wp_ajax_nopriv_hytteguiden_taxonomy_loadmore', 'hytteguiden_taxonomy_loadmore');


// Hytteguiden Loadmore taxonomy data
if ( ! function_exists( 'hytteguiden_custom_breadcrumbs' ) ) {
	function hytteguiden_custom_breadcrumbs() {
        $breadcrumbs_content = '';

				$showOnHome = 0;
				$delimiter = '';
				$home = __('Home', 'hytteguiden');
				$showCurrent = 1;
				$before = '<li>';
				$after = '</li>';
				global $post;
				$homeLink = esc_url( home_url( '/' ) );
				if (is_home() || is_front_page()) {
					if ($showOnHome == 1){
						$breadcrumbs_content .=  '<ul><li><a href="' . $homeLink . '">' . $home . '</a></li></ul>';
					}
				}
				else {
					$breadcrumbs_content .=  '<ul><li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';
					if ( is_category() ) {
						$thisCat = get_category(get_query_var('cat'), false);
						if ($thisCat->parent != 0) {
							$breadcrumbs_content .=  '<li>' .get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
						}
						$breadcrumbs_content .=  $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
					}
					else if ( is_tax() ){
						$thisterm 	= get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
						$thisparent = $thisterm->parent;
						while ($thisparent):
							$thisparents[] 	= $thisparent;
							$new_parent 	= get_term_by( 'id', $thisparent, get_query_var( 'taxonomy' ));
							$thisparent 	= $new_parent->parent;
						endwhile;
						if(!empty($thisparents)):
							$thisparents = array_reverse($thisparents);
							$woocommerce_permalinks_arr = array();
							foreach ($thisparents as $parent):
								$taxonomy_slug = get_query_var( 'taxonomy' );
								$item 	= get_term_by( 'id', $parent, $taxonomy_slug);
								$category_base = $item->taxonomy;
								$woocommerce_permalinks = get_option( 'woocommerce_permalinks' );

								$url = get_term_link( $item->term_id, $taxonomy_slug );

								if( !empty( $woocommerce_permaitem->term_idlinks ) && $taxonomy_slug != 'destination'){
									$woocommerce_permalinks_arr = maybe_unserialize( $woocommerce_permalinks );
									$category_base = $woocommerce_permalinks_arr['category_base'];
									$url = esc_url( home_url( '/' ) ) .$category_base.'/'.$item->slug;
								}

								$breadcrumbs_content .=  '<li><a href="'.$url.'">'.$item->name.'</a></li>';
							endforeach;
						endif;
						$breadcrumbs_content .=  '<li>'.$thisterm->name.'</li>';
					}
					else if ( is_search() ) {
						$breadcrumbs_content .=  $before . 'Search results for "' . get_search_query() . '"' . $after;
					}
					else if ( is_day() ) {
						$breadcrumbs_content .=  '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
						$breadcrumbs_content .=  '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
						$breadcrumbs_content .=  $before . get_the_time('d') . $after;
					}
					else if ( is_month() ) {
						$breadcrumbs_content .=  '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
						$breadcrumbs_content .=  $before . get_the_time('F') . $after;
					}
					else if ( is_year() ) {
						$breadcrumbs_content .=  $before . get_the_time('Y') . $after;
					}
					else if ( is_single() && !is_attachment() ) {
						if ( get_post_type() != 'post' ) {
							$post_type 	= get_post_type_object(get_post_type());
							$slug 		= $post_type->rewrite;
							$breadcrumbs_content .=  '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
							if ( $showCurrent == 1 ){
								$breadcrumbs_content .=  ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
							}
						}
						else {
							$cat 	= get_the_category(); $cat = $cat[0];
							$cats 	= get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
							if ($showCurrent == 0){
								$cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
							}
							$breadcrumbs_content .=  $before . $cats. $after;
							if ($showCurrent == 1){
								$breadcrumbs_content .=  $before . get_the_title() . $after;
							}
						}
					}
					else if ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
						if ( is_tax( 'product_cat' ) ) {
							$breadcrumbs_content .=  $before . single_cat_title('', false) . $after;
						}
						else {
						  	$post_type = get_post_type_object(get_post_type());
						  	$breadcrumbs_content .=  $before . $post_type->labels->singular_name . $after;
						}
					}
					else if ( is_attachment() ) {
						$parent = get_post($post->post_parent);
						$cat 	= get_the_category($parent->ID); $cat = $cat[0];
						$breadcrumbs_content .=  get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
						$breadcrumbs_content .=  '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
						if ($showCurrent == 1) {
							$breadcrumbs_content .=  ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
						}
					}
					else if ( is_page() && !$post->post_parent ) {
						if ($showCurrent == 1){
							$breadcrumbs_content .=  $before . get_the_title() . $after;
						}
					}
					else if ( is_page() && $post->post_parent ) {
						$parent_id  	= $post->post_parent;
						$breadcrumbs 	= array();
						while ($parent_id) {
							$page 			= get_page($parent_id);
							$breadcrumbs[] 	= '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
							$parent_id  	= $page->post_parent;
						}
						$breadcrumbs = array_reverse($breadcrumbs);
						for ($i = 0; $i < count($breadcrumbs); $i++) {
							$breadcrumbs_content .=  $breadcrumbs[$i];
							if ($i != count($breadcrumbs)-1){
								$breadcrumbs_content .=  ' ' . $delimiter . ' ';
							}
						}
						if ($showCurrent == 1){
							$breadcrumbs_content .=  ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
						}
					}
					else if ( is_tag() ) {
						$breadcrumbs_content .=  $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
					}
					else if ( is_author() ) {
						global $author;
						$userdata = get_userdata($author);
						$breadcrumbs_content .=  $before . 'Articles posted by ' . $userdata->display_name . $after;
					}
					else if ( is_404() ) {
						$breadcrumbs_content .=  $before . 'Error 404' . $after;
					}
					if ( get_query_var('paged') ) {
						if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ){
							$breadcrumbs_content .=  ' (';
						}
						$breadcrumbs_content .=  __('Page', 'hytteguiden') . ' ' . get_query_var('paged');
						if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
							$breadcrumbs_content .=  ')';
						}
					}
					$breadcrumbs_content .= '</ul>';
				}

     return $breadcrumbs_content;
	}
}

// Hytteguiden Loadmore taxonomy data
if ( ! function_exists( 'hytteguiden_page_titles' ) ) {
	function hytteguiden_page_titles() {
       $page_title = '';
       $sub_title = '';

        if (is_home() || is_front_page()) {
          $page_title = get_bloginfo('name');
        } else if ( is_category() ) {
          $page_title = single_cat_title('', false);
        } else if ( is_tax() ){
          $cate = get_queried_object();
          $page_title = $cate->name;
        } else if ( is_search() ) {
          $page_title = __('Search results', 'hytteguiden');
        }

        $page_titles = array(
          'title' => $page_title,
          'sub_title' => $sub_title,
        );

        return $page_titles;
  }
}

// Hytteguiden Loadmore taxonomy data
if ( ! function_exists( 'hytteguiden_post_types_slug' ) ) {
    function hytteguiden_post_types_slug( $args, $post_type ) {

       $cabin_slug = get_option('cabin_slug');
       $producer_slug = get_option('producer_slug');
       /*item post type slug*/
       if ( isset($cabin_slug) && !empty($cabin_slug) && 'cabin' === $post_type ) {
          $args['rewrite']['slug'] = $cabin_slug;
       }

       if ( isset($producer_slug) && !empty($producer_slug) && 'producer' === $post_type ) {
          $args['rewrite']['slug'] = $producer_slug;
       }

       return $args;
    }
}
add_filter( 'register_post_type_args', 'hytteguiden_post_types_slug', 10, 2 );

// Get producers name
if ( ! function_exists( 'hytteguiden_producer_name' ) ) {
    function hytteguiden_producer_name($post_id) {
      $content = '';
      $cabin_producer_id = get_post_meta($post_id, 'cabin_producer_id', true);
      if(isset($cabin_producer_id) && !empty($cabin_producer_id)){
        $content = '<a href="'.get_permalink($cabin_producer_id).'"> '.get_the_title($cabin_producer_id).'</a>';
      }
      return $content;

    }
}

// Get price
if ( ! function_exists( 'hytteguiden_price' ) ) {
    function hytteguiden_price($price) {

    if(!empty($price)){
      $price = number_format($price, 2, '.', ' ');
      $parts = explode('.', $price);
      $price = str_replace(","," ",$parts[0]);
    }
      return $price;
    }
  }

  // Get price
if ( ! function_exists( 'hytteguiden_formate_number' ) ) {
  function hytteguiden_formate_number($number) {
    return $number;
  }
}

  // Get search result page URL  
if ( ! function_exists( 'hytteguiden_search_result_url' ) ) {
  function hytteguiden_search_result_url() {

    $search_result_url = esc_url( home_url( '/' )  . $GLOBALS['route_defaults']['search_page'] . '/?' );

    return $search_result_url;
  }
}

  // Image Icons for Grid Block
  if ( ! function_exists( 'hytteguiden_icon' ) ) {
    function hytteguiden_icon( $icon_name, $alt = '' ) {

      if($alt == ''){
        $alt = get_bloginfo('name');
      }

      if(!empty($icon_name)){
        $icon_url = get_template_directory_uri(). '/library/admin/assets/images/'. $icon_name;
        return '<img src="'. $icon_url .'" alt="'.$alt.'">';
      }

      return '';
    }
  }

/* Get IP Address  */
function hytteguiden_ip_addr(){
    $ip = 'n/a';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

/* Contact to Producer */
if ( ! function_exists( 'hytteguiden_contact_producer' ) ) {
  function hytteguiden_contact_producer() {
    global $wpdb; 
    $response_arr = array();

    // Send email to producer / admin user
    $contact_emails = array();

    if(!empty($_POST['cabin_id'])){
      $producer_id = get_post_meta($_POST['cabin_id'], 'cabin_producer_id', true); 
      if(!empty($producer_id)){
        $producer_email = get_post_meta($producer_id, 'producer_email', true); 
        if(!empty($producer_email)){
          $contact_emails[] = $producer_email;
        }
      }
    }
    // Admin Email
    $contact_emails[] = get_bloginfo('admin_email');  
    
    if($contact_emails){
        foreach($contact_emails as $email ){

          $subject = 'Interesse via Hyttaguiden';

          $body = '';
          $body .= '<br />En besøkende på Hytteguiden viste interesse for en av deres hyttemodeller.
          Kontaktinformasjon ligger under: ';
          $body .= '<br />Navn: '. $_POST['con_name'] ;
          $body .= '<br />Epost: '. $_POST['con_email'] ;
          $body .= '<br />Telefon: '. $_POST['con_phone'] ;
          $body .= '<br />Message: '. $_POST['con_message'] ;
          $body .= '<br />Hyttemodell: '. get_the_title($_POST['cabin_id']);
          $body .= '<br /><br />med vennlig hilsen<br />
          Oss i Hytteguiden';

          $headers[] = 'Content-Type: text/html; charset=UTF-8';
          $headers[] = 'From: '. $_POST['con_name'] .' <'. $_POST['con_email'] .'>';
          
          wp_mail( $email, $subject, $body, $headers );

        }

        // Add to cabin log 
        $ip = hytteguiden_ip_addr();
        $wpdb->insert($wpdb->prefix.'contact_producer',
        array(
              'con_name'     => $_POST['con_name'],
              'con_email'    => $_POST['con_email'],
              'con_phone'    => $_POST['con_phone'],
              'con_message'  => $_POST['con_message'],
              'post_id'      => $_POST['cabin_id'],
              'ip_address'   => $ip
              )
          );

      $response_arr['status'] = 'success';   
      $response_arr['message'] = __('Din melding har nå blitt sendt. Produsenten vil kontakte deg snart.', 'hytteguiden');

    } else{
      $response_arr['status'] = 'error';   
      $response_arr['message'] = __('Error occured!', 'hytteguiden');
    }

    echo json_encode($response_arr);
    exit;

  }
}

add_action( 'wp_ajax_hytteguiden_contact_producer', 'hytteguiden_contact_producer');
add_action( 'wp_ajax_nopriv_hytteguiden_contact_producer', 'hytteguiden_contact_producer');

/* Front Page Login
............................ */
if ( ! function_exists( 'hytteguiden_login' ) ) {
	function hytteguiden_login() {
		global $wpdb;
		global $error;
		$response_arr 	= array();
		$email 			= $_POST['login_username'];
		$login_password = $_POST['login_password'];
		$remember_me = 1;
		if ( is_email( $email ) ) {
			$querystr = "SELECT * FROM ".$wpdb->prefix."users WHERE user_email = '$email' ";
			$userinfo = $wpdb->get_row($querystr);
			if(count($userinfo) > 0) {
				$user_name = $userinfo->user_login;
			}
			else {
				$user_name = '';
			}
		}
		else {
		  	$user_name = $email;
		}
		$user = wp_signon( array( 'user_login' => $user_name, 'user_password' => trim($login_password), 'remember' => $remember_me ), false );
    
    if ( is_wp_error($user) ){
			echo '[{"response":"error","msg":"'. __('<strong>FEIL</strong>: Ugyldig brukernavn eller passord', 'hytteguiden') .'"}]';
			exit;
		}
		else{

      $dashboard_url = esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['myprofile_page'] . '/';

      $GLOBALS['current_producer_id'] = '';
      $current_producer_id = get_user_meta( $user->ID, 'producer_id', true );

      if(isset($current_producer_id) && !empty($current_producer_id)){
        $GLOBALS['current_producer_id'] = $current_producer_id;
        $dashboard_url = esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['mydashboard_page'] . '/';
 
      }
    
			echo '[{"dashboard_url":"'. $dashboard_url .'", "response":"success","msg":"'. __('<strong>Logg inn suksess!</strong> Vennligst vent mens siden blir omdirigert...', 'hytteguiden') .'"}]';
			exit;
		}
	}
}
add_action('wp_ajax_hytteguiden_login', 'hytteguiden_login');
add_action('wp_ajax_nopriv_hytteguiden_login', 'hytteguiden_login');

/* Minside menu tab
............................ */
if ( ! function_exists( 'hytteguiden_minside_tab' ) ) {
	function hytteguiden_minside_tab($active_module = 'profile') {

    $content = '';
    $route_defaults = $GLOBALS['route_defaults'];
    $menu_tabs = array();

    
      $menu_tabs[] = array( 
            'tab_module' => 'profile',
            'icon_class' => 'far fa-user',
            'tab_text' => 'Min Profil',
            'tab_link' =>  home_url( '/' ). $GLOBALS['route_defaults']['myprofile_page'],
        );

    $menu_tabs[] = array( 
      'tab_module' => 'my_cabins',
      'icon_class' => 'far fa-heart',
      'tab_text' => 'Mine hytter',
      'tab_link' =>  home_url( '/' ). $GLOBALS['route_defaults']['mycabins_page'],
    );

    $menu_tabs[] = array( 
      'tab_module' => 'my_catalog',
      'icon_class' => 'far fa-file-alt',
      'tab_text' => 'Mine Kataloger',
      'tab_link' =>  home_url( '/' ) . $GLOBALS['route_defaults']['mycatalogue_page'],
    );

    if(is_user_logged_in()){
      $menu_tabs[] = array( 
          'tab_module' => 'logout',
          'icon_class' => 'fa fa-sign-out-alt',
          'tab_text' => 'Logg ut',
          'tab_link' => wp_logout_url( home_url() ),
        );
    }


    if($menu_tabs){ 
      $content .= '<ul class="nav">';
        foreach ($menu_tabs as $value){

          $content .= '<li class="nav-item">'; 
          $content .= '<a href="'. $value['tab_link'] .'" class="nav-link';
          if (array_key_exists("tab_module",$value) && $value['tab_module'] == $active_module ){
            $content .= ' active';
          }
          $content .= '"><i class="'. $value['icon_class'] .'"></i>';

          $content .= $value['tab_text'] . '</a></li>'; 
          
        }
        $content .= '</ul>';  
    }

    return $content;
  }
}

/* Producer's dashboard menu tab
............................ */
if ( ! function_exists( 'hytteguiden_producer_dashboard_tab' ) ) {
	function hytteguiden_producer_dashboard_tab($active_module = 'home') {

    $content = '';
    $route_defaults = $GLOBALS['route_defaults'];

    $menu_tabs = array(
        array( 
          'tab_module' => 'home',
          'icon_class' => 'fa fa-home',
          'tab_text' => __( 'Home', 'hytteguiden' ),
          'tab_link' =>  home_url( '/' ). $GLOBALS['route_defaults']['mydashboard_page'],
        ),
        array( 
            'tab_module' => 'profile',
            'icon_class' => 'far fa-user',
            'tab_text' => __( 'Profil', 'hytteguiden' ),
            'tab_link' =>  home_url( '/' ). $GLOBALS['route_defaults']['producerprofile_page'],
          ),

        array( 
            'tab_module' => 'producer_hytter',
            'icon_class' => 'far fa-heart',
            'tab_text' => __( 'Mine Hytter', 'hytteguiden' ),
            'tab_link' =>  home_url( '/' ). $GLOBALS['route_defaults']['producerhytter_page'],
                ),
         array( 
          'tab_module' => 'producer_kataloger',
          'icon_class' => 'far fa-file-alt',
          'tab_text' => __( 'Mine Kataloger', 'hytteguiden' ),
          'tab_link' =>  home_url( '/' ) . $GLOBALS['route_defaults']['producerkataloger_page'],
          ),
        array( 
            'tab_module' => 'producer_request',
            'icon_class' => 'fas fa-hand-point-up',
            'tab_text' => __( 'Forespørsler', 'hytteguiden' ),
            'tab_link' =>  home_url( '/' ) . $GLOBALS['route_defaults']['producerrequest_page'],
            ),
        array( 
          'tab_module' => 'logout',
          'icon_class' => 'fa fa-sign-out-alt',
          'tab_text' => 'Logg ut',
          'tab_link' => wp_logout_url( home_url() ),
        )
    );

    if($menu_tabs){ 
      $content .= '<ul class="nav">';
        foreach ($menu_tabs as $value){

          $content .= '<li class="nav-item">'; 
          $content .= '<a href="'. $value['tab_link'] .'" class="nav-link';
          if (array_key_exists("tab_module",$value) && $value['tab_module'] == $active_module ){
            $content .= ' active';
          }
          $content .= '"><i class="'. $value['icon_class'] .'"></i>';

          $content .= $value['tab_text'] . '</a></li>'; 
          
        }
        $content .= '</ul>';  
    }

    return $content;
  }
}

/*  Edit User profile */
if ( ! function_exists( 'hytteguiden_edit_user_profile' ) ) {
  function hytteguiden_edit_user_profile() {
    global $wpdb;
    $response_arr 	= array();
    $guest_id = hytteguiden_guest_id();

    $update_data = array(
      'full_name' => $_POST['first_name'],
      'phone_number' => $_POST['user_phone'],
      'address' => $_POST['user_address'],
      'postal_name' => $_POST['user_postal_number'],
      'city' => $_POST['user_city'],
      // 'zip_code' => $_POST['zip_code'],
      // 'country_code' => $_POST['country_code'],
      'guest_id' => $guest_id,
    );

    if ( is_user_logged_in() ) {
      $current_user = wp_get_current_user();

      wp_update_user( array( 'ID' => $current_user->ID, 'first_name' => $_POST['first_name'] ) );
    
      update_user_meta( $current_user->ID, 'user_phone', $_POST['user_phone'] );
      update_user_meta( $current_user->ID, 'user_address', $_POST['user_address'] );
      update_user_meta( $current_user->ID, 'user_postal_number', $_POST['user_postal_number'] );
      update_user_meta( $current_user->ID, 'user_city', $_POST['user_city'] );
      // update_user_meta( $current_user->ID, 'zip_code', $_POST['zip_code'] );
      // update_user_meta( $current_user->ID, 'country_code', $_POST['country_code'] );

      $update_data['email_address'] = $current_user->user_email;
      $update_data['user_id'] = $current_user->ID;

      hytteguiden_update_address($update_data, $guest_id, $current_user->ID);

      $response_arr['status'] = 'success';   
      $response_arr['message'] = __('Suksess! Din profil har blitt oppdatert.', 'hytteguiden');

    } else{
      $update_data['email_address'] = $_POST['user_email'];
      $update_data['user_id'] = '';

      hytteguiden_update_address($update_data,$guest_id, '');
      $response_arr['status'] = 'success';   
      $response_arr['message'] = __('Suksess! Din adresse er oppdatert.', 'hytteguiden');
    }

    echo json_encode($response_arr);
    exit;

  }
}

add_action( 'wp_ajax_hytteguiden_edit_user_profile', 'hytteguiden_edit_user_profile');
add_action( 'wp_ajax_nopriv_hytteguiden_edit_user_profile', 'hytteguiden_edit_user_profile');

/* Update data on address table */
if ( ! function_exists( 'hytteguiden_update_address' ) ) {
  function hytteguiden_update_address($update_data, $guest_id, $user_id = '') {
      global $wpdb;

      if(is_user_logged_in()){
        $current_user = wp_get_current_user();  
        $cond .= ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';    
      }else {
        $cond .= ' AND guest_id = "'. $guest_id . '"';  
      }

      $total_records = hytte_record_count('address', $cond); 
      $row_data = hytte_row_from_table('address', $cond );

      if($total_records <= 0){
        $wpdb->insert($wpdb->prefix.'address', $update_data );
      } else{
        $wpdb->update($wpdb->prefix.'address', $update_data, array('id'=> $row_data->id) );
      }

  }
}

/*  Get wishlist status */
if ( ! function_exists( 'hytteguiden_wishlist_status' ) ) {
  function hytteguiden_wishlist_status($post_id) {
    global $wpdb;
    $content = '';

    $cond = ' AND post_id = '. $post_id;   
    $guest_id = hytteguiden_guest_id();

    if(is_user_logged_in()){
      $current_user = wp_get_current_user();  
      $cond .= ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';   
    }else {
      $cond .= ' AND guest_id = "'. $guest_id . '"'; 
    }

    $total_records = hytte_record_count('wishlists', $cond);  
    if($total_records > 0){          
      $content .= '<a href="javascript:void();" class="btn btn-light btn-xs add_to_wishlist selected"><i class="far fa-heart"></i> '. __('Lagret', 'hytteguiden') .'</a>';
    } else {
      $content .= '<a href="javascript:void();" class="btn btn-light btn-xs add_to_wishlist"><i class="far fa-heart"></i> '. __('Lagre', 'hytteguiden') .'</a>';
    }  

    return $content;
  }
}

/*  Save wishlist */
if ( ! function_exists( 'hytteguiden_save_wishlist' ) ) {
  function hytteguiden_save_wishlist() {
    global $wpdb;
    $response_arr 	= array();

    $cond = ' AND post_id = '. $_POST['cabin_id'];   
    $guest_id = hytteguiden_guest_id();

    $insert_data =  array(
      'guest_id' => $guest_id,
      'post_id' => $_POST['cabin_id'],
    );

    if(is_user_logged_in()){
      $current_user = wp_get_current_user();  
      $insert_data['user_id'] = $current_user->ID;
      $cond .= ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';   
      $cond_cnt = ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';  
    }else {
      $cond .= ' AND guest_id = "'. $guest_id . '"'; 
      $cond_cnt = ' AND guest_id = "'. $guest_id . '"'; 
    }
  
    $total_records = hytte_record_count('wishlists', $cond);     

    if($total_records > 0){
      hytte_delete_cond_data( 'wishlists', $cond);
      
      $response_arr['status'] = 'removed';
      $response_arr['message'] = __('<i class="far fa-heart"></i> Lagre', 'hytteguiden');
    }else{

      $wpdb->insert($wpdb->prefix.'wishlists', $insert_data );
      $response_arr['status'] = 'added';
      $response_arr['message'] = __('<i class="far fa-heart"></i> Lagret', 'hytteguiden');
    }

    $total_records = hytte_record_count('wishlists', $cond_cnt); 
    $response_arr['cabin_count'] = $total_records;

    echo json_encode($response_arr);
    exit;
    
  }
}

add_action( 'wp_ajax_hytteguiden_save_wishlist', 'hytteguiden_save_wishlist');
add_action( 'wp_ajax_nopriv_hytteguiden_save_wishlist', 'hytteguiden_save_wishlist');

/*  Check loggin access  */
if ( ! function_exists( 'hytteguiden_login_access' ) ) {
  function hytteguiden_login_access() {
    if(! is_user_logged_in()){
      echo '<script> window.location = "'. esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['login_page'] .'"; </script>';
      exit;
    }
  }
}

/* Save Kataloger for Cabin in wp-admin  */
if ( ! function_exists( 'hytteguiden_assign_kataloger' ) ) {
  function hytteguiden_assign_kataloger() {
    global $wpdb;
    if(isset($_POST['kataloger_id']) && !empty($_POST['kataloger_id'])){
      update_post_meta($_POST['cabin_id'], 'cabin_kataloger',  $_POST['kataloger_id']);
    } else{
      delete_post_meta($_POST['cabin_id'], 'cabin_kataloger', '');
    }   
    exit;
  }
}

add_action( 'wp_ajax_hytteguiden_assign_kataloger', 'hytteguiden_assign_kataloger');
add_action( 'wp_ajax_nopriv_hytteguiden_assign_kataloger', 'hytteguiden_assign_kataloger');

/* Save Order Kataloger for frontend  */
if ( ! function_exists( 'hytteguiden_save_kataloger' ) ) {
  function hytteguiden_save_kataloger() {
    global $wpdb;
    $response_arr 	= array();
    $guest_id = hytteguiden_guest_id();

    $insert_data = array(
      'producer_id' => $_POST['cabin_producer_id'],
      'status' => 'Ordered',
    );

    if(is_user_logged_in()){
      $current_user = wp_get_current_user();
      $insert_data['user_id'] = $current_user->ID;  
      $cond_cnt = ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")'; 
    } else{
      $cond_cnt = ' AND guest_id = "'. $guest_id . '"'; 
    }

    $insert_data['guest_id'] = $guest_id; 

    $current_user = wp_get_current_user();

    $selected_kataloger = explode(",",$_POST['selected_kataloger']);
    if($selected_kataloger){
      foreach($selected_kataloger as $katlog_id){

        $insert_data['kataloger_id'] = $katlog_id;
        $insert_id = $wpdb->insert($wpdb->prefix.'kataloger', $insert_data );
      }
    }

    if($insert_id) {
      $response_arr['status'] = 'success';   
      // $response_arr['message'] = __('Utvalgt kataloger er bestilt.', 'hytteguiden');
      $response_arr['message'] = __('Bestilt.', 'hytteguiden');
      
    } else{
      $response_arr['status'] = 'error';   
      $response_arr['message'] = __('Unnskyld! vennligst prøv senere.', 'hytteguiden');
    }


    $total_records = hytte_record_count('kataloger', $cond_cnt); 
    $response_arr['kataloger_count'] = $total_records;

    echo json_encode($response_arr);
    exit;
  }
}

add_action( 'wp_ajax_hytteguiden_save_kataloger', 'hytteguiden_save_kataloger');
add_action( 'wp_ajax_nopriv_hytteguiden_save_kataloger', 'hytteguiden_save_kataloger');

/* Format Phone number  */
if ( ! function_exists( 'hytteguiden_format_phone' ) ) {
  function hytteguiden_format_phone($phone = '') {
    if(empty($phone)){
      return $phone;
    } else{
      $phone =  chunk_split($phone, 2, ' ');
      return $phone;
    }
  }
}

/* remove Katalog Order for frontend  */
if ( ! function_exists( 'hytteguiden_remove_kataloger' ) ) {
  function hytteguiden_remove_kataloger() {
    global $wpdb;
    $response_arr 	= array();
    $kataloger = explode(",",$_POST['kataloger']);
    if($kataloger){
      foreach($kataloger as $katlog_id){
        hytte_delete_record( 'kataloger', 'id', $katlog_id);
      }
    }
    $response_arr['status'] = 'success';   
    $response_arr['message'] = __('Din bestilling er fjernet.', 'hytteguiden');

    echo json_encode($response_arr);
    exit;
  }
}

add_action( 'wp_ajax_hytteguiden_remove_kataloger', 'hytteguiden_remove_kataloger');
add_action( 'wp_ajax_nopriv_hytteguiden_remove_kataloger', 'hytteguiden_remove_kataloger');

/*  Get Katalog Button for producer */
if ( ! function_exists( 'hytteguiden_producer_kataloger_status' ) ) {
  function hytteguiden_producer_kataloger_status($cabin_producer_id) {
    global $wpdb;
    $content = '';
    
    $args = array(
      'post_type' => 'kataloger',
      'posts_per_page' => -1,
      'meta_query'=> array(
        array(
        'key' => '_catalogs_producer_id',
        'compare' => '=',
        'value' =>  $cabin_producer_id,
        )
      ),
    );
    $myposts = get_posts( $args );
    if($myposts){
      $content .= '<a href="#" class="btn btn-block btn-lg btn-theme1" data-toggle="modal" data-target="#catalog_order_form">' . __('Bestill katalog', 'hytteguiden') . '</a>';
    }  
    return $content;
  }
}

/*  Get count for saved list */
if ( ! function_exists( 'hytteguiden_saved_count' ) ) {
  function hytteguiden_saved_count( $tbl_name = 'kataloger') {
      global $wpdb;    
      $guest_id = hytteguiden_guest_id();

      if(is_user_logged_in()){
        $current_user = wp_get_current_user();  
        $cond = ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';   
      }else {
        $cond = ' AND guest_id = "'. $guest_id . '"'; 
      } 
      $total_records = hytte_record_count( $tbl_name, $cond); 
      return $total_records;

  }
}

/*  Get Katalog Button for cabin */
if ( ! function_exists( 'hytteguiden_cabin_kataloger_status' ) ) {
  function hytteguiden_cabin_kataloger_status($kataloger_id = '', $cabin_producer_id = '') {
    global $wpdb;
    $content = '';      
    $guest_id = hytteguiden_guest_id();

    if($kataloger_id == ''){
      //return '<a href="javascript:void();" class="btn btn-block btn-lg btn-theme1">' . __('Katalog ikke tildelt', 'hytteguiden') . '</a>';
      return '';
    }

    $cond = ' AND kataloger_id = '. $kataloger_id; 
    if(is_user_logged_in()){
      $current_user = wp_get_current_user();  
      $cond .= ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';   
    }else {
      $cond .= ' AND guest_id = "'. $guest_id . '"'; 
    } 
     
    $total_records = hytte_record_count('kataloger', $cond);  
    if($total_records > 0){
        $content .= '<a href="#" class="btn btn-block btn-lg btn-theme1">' . __('Katalog bestilt allerede', 'hytteguiden') . '</a>';
    } else {
        $content .= '<input type="hidden" id="kataloger_id" value="'. $kataloger_id.'">';
        $content .= '<input type="hidden" id="cabin_producer_id" value="'. $cabin_producer_id.'">';
        $content .= '<a href="javascript:void(0);" id="btn_cabin_kataloger" class="btn btn-block btn-lg btn-theme1 btn_cabin_kataloger">'. __('Bestill katalog', 'hytteguiden') .'</a>';
    }  
  
    return $content;
  }
}

/* Front Post Status
............................ */
if ( ! function_exists( 'hytteguiden_post_status' ) ) {
	function hytteguiden_post_status($post_id) {
      global $wpdb;
      $content = '';
      $post_status = get_post_status( $post_id );

      switch ($post_status) {
        case "publish":
          $content .= '<i class="fa fa-circle text-theme1 tablestatus"></i>'. __('Aktiv', 'hytteguiden');            
            break;
        case "private":
            $content .= '<i class="fa fa-circle text-warning tablestatus"></i>'. __('Privat', 'hytteguiden');
            break;
        default:
            $content .= '<i class="fa fa-circle text-danger tablestatus"></i>'. __('Utkast', 'hytteguiden');
      }

      return $content;
  }
}

/* SPID Login / Create new user with email */
if ( ! function_exists( 'hytteguiden_spid_login_register' ) ) {
  function hytteguiden_spid_login_register($user_email) {
    global $wpdb;

    $querystr = "SELECT * FROM ".$wpdb->prefix."users WHERE user_email = '$email' ";
    $userinfo = $wpdb->get_row($querystr);
    if(count($userinfo) < 1) {
        $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
        $user_name_arr = explode("@",$user_email);
        $user_name = $user_name_arr[0]. '_'. rand();
        $user_id = wp_create_user( $user_name, $random_password, $user_email );

    } else{
        $user = get_user_by( 'email', $user_email );
        $user_id = $user->ID;
    }

    wp_set_auth_cookie( $user_id, true);
      
  }
}

/* Dashboard Add/update Kataloger  */
if ( ! function_exists( 'hytte_update_kataloger' ) ) {
  function hytte_update_kataloger() {
    global $wpdb;
    $response_arr 	= array();
    $current_user = wp_get_current_user(); 
    $current_producer_id = get_user_meta( $current_user->ID, 'producer_id', true );

    $post_data = array(
      'post_title'   => $_POST['kataloger_title'],
      'post_content' => $_POST['post_content'],
      'post_status' => $_POST['status_id'],
    );

    if(isset($_POST['post_id']) && !empty($_POST['post_id'])){
        $post_id = $_POST['post_id'];
        $post_data['ID'] = $post_id;             
        wp_update_post( $post_data );

    } else{
       $post_data['post_type'] = 'kataloger'; 
       $post_data['post_author'] = $current_user->ID; 
       $post_id = wp_insert_post( $post_data );

    }  
    
    //Set featured Image 
    if(isset($_POST['img_attach_id']) && !empty($_POST['img_attach_id'])){
      set_post_thumbnail( $post_id, $_POST['img_attach_id'] );
    }

    update_post_meta($post_id, '_catalogs_helthjem', $_POST['helthjem_id']);
    update_post_meta($post_id, '_catalogs_producer_id', $current_producer_id);

    $response_arr['status'] = 'success';  
    $response_arr['redir'] = esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['producerkataloger_page'];  
    $response_arr['message'] = __('Ditt innlegg har blitt lagret.', 'hytteguiden');


    echo json_encode($response_arr);
    exit;
  }
}

add_action( 'wp_ajax_hytte_update_kataloger', 'hytte_update_kataloger');
add_action( 'wp_ajax_nopriv_hytte_update_kataloger', 'hytte_update_kataloger');

/* Dashboard Add/update Hytter  */
if ( ! function_exists( 'hytte_update_hytter' ) ) {
  function hytte_update_hytter() {
    global $wpdb;
    $response_arr 	= array();
    $current_user = wp_get_current_user(); 
    $current_producer_id = get_user_meta( $current_user->ID, 'producer_id', true );

    $post_data = array(
      'post_title'   => $_POST['post_title'],
      'post_content' => $_POST['post_content'],
      'post_status' => $_POST['status_id'],
    );

    if(isset($_POST['post_id']) && !empty($_POST['post_id'])){
        $post_id = $_POST['post_id'];
        $post_data['ID'] = $post_id;             
        wp_update_post( $post_data );

    } else{
       $post_data['post_type'] = 'cabin'; 
       $post_data['post_author'] = $current_user->ID; 
       $post_id = wp_insert_post( $post_data );

    }  
    
    //Set featured Image 
    if(isset($_POST['img_attach_id']) && !empty($_POST['img_attach_id'])){
      set_post_thumbnail( $post_id, $_POST['img_attach_id'] );
    }

    update_post_meta($post_id, 'cabin_producer_id', $current_producer_id);
    update_post_meta($post_id, 'cabin_base_area', $_POST['base_area']);
    update_post_meta($post_id, 'cabin_utility_area', $_POST['utility_area']);
    update_post_meta($post_id, 'cabin_build_area', $_POST['built_area']);
    update_post_meta($post_id, 'cabin_gross_area', $_POST['gross_area']);
    update_post_meta($post_id, 'cabin_length_width', $_POST['length']);
    update_post_meta($post_id, 'cabin_width', $_POST['main_width']);
    update_post_meta($post_id, 'cabin_moon_height', $_POST['moon_light']);
    update_post_meta($post_id, 'cabin_bedroom', $_POST['bedroom']);
    update_post_meta($post_id, 'cabin_bathroom', $_POST['bathroom']);
    update_post_meta($post_id, 'cabin_beds', $_POST['beds']);
    update_post_meta($post_id, 'cabin_price_kit', $_POST['price_kit']);
    update_post_meta($post_id, 'cabin_price_turnkey', $_POST['price_turnkey']);
    update_post_meta($post_id, 'cabin_hems', $_POST['hems']);
    update_post_meta($post_id, 'cabin_rise', $_POST['rise']);
    update_post_meta($post_id, 'cabin_bod', $_POST['bod']);
    update_post_meta($post_id, 'cabin_youtube_link', $_POST['youtube_link']);

    /* Cabin Images */
    if($_POST['cabin_images']){
      $image_value =  ( hytte_json_to_array_images(wp_unslash($_POST['cabin_images'])));  
      update_post_meta($post_id, 'cabin_images_galleries', $image_value);     
    
    }   

      /* Floor Plan Images */
      if($_POST['cabin_floor_plan_json']){
        $image_value_floor =  ( hytte_json_to_array_images(wp_unslash($_POST['cabin_floor_plan_json'])));  
        update_post_meta($post_id, 'cabin_floor_plan_galleries', $image_value_floor);     
      
      } 

    /* Assign Cabin_amenity for Hytte */
    if($_POST['cabin_amenity_data']){

      $cabin_amenity_data = array_map( 'intval', $_POST['cabin_amenity_data'] );
      $cabin_amenity_data = array_unique( $cabin_amenity_data );
      
      wp_set_object_terms( $post_id, $cabin_amenity_data, 'cabin_amenity', false );
    }


    /* Assign Cabin_style for Hytte */
    if($_POST['cabin_style']){
      $cabin_style = array_map( 'intval', $_POST['cabin_style'] );
      $cabin_style = array_unique( $cabin_style );
      wp_set_object_terms( $post_id, $cabin_style, 'cabin_style' );
    }

  

    $response_arr['status'] = 'success';  
    $response_arr['redir'] = esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['producerhytter_page'];  
    $response_arr['message'] = __('Ditt innlegg har blitt lagret.', 'hytteguiden');

    echo json_encode($response_arr);
    exit;
  }
}

add_action( 'wp_ajax_hytte_update_hytter', 'hytte_update_hytter');
add_action( 'wp_ajax_nopriv_hytte_update_hytter', 'hytte_update_hytter');

/* Upload Image Action
............................ */

if ( ! function_exists( 'hytte_upload_image_action' ) ) {

  function hytte_upload_image_action(){
        $posted_data =  isset( $_POST ) ? $_POST : array();
        $file_data = isset( $_FILES ) ? $_FILES : array();

        $data = array_merge( $posted_data, $file_data );
        $response = array();

        $file_return = wp_handle_upload($data['img'], array('test_form' => false));
        if(isset($file_return['error']) || isset($file_return['upload_error_handler'])){
          return false;
        }else{
          $filename = $file_return['file'];
          $attachment = array(
            'post_mime_type' => $file_return['type'],
            'post_content' => '',
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'guid' => $file_return['url']
          );
          if($title){
            $attachment['post_title'] ='Hytte';
          }
          $attachment_id = wp_insert_attachment( $attachment, $filename );   
          $image_attr = wp_get_attachment_image_src($attachment_id, 'thumbnail');  
          
          $content = 	'<img src="'. $image_attr[0] .'" class="img-fluid">';
          $content .= '<input type="hidden" id="img_attach_id" class="img_attach_id" value="'. $attachment_id.'">';

          $response_arr['status'] = 'success';   
          $response_arr['message'] = $content;

          echo json_encode($response_arr);	
          wp_die();
        
        }

   }
}

add_action( 'wp_ajax_hytte_upload_image_action', 'hytte_upload_image_action');
add_action( 'wp_ajax_nopriv_hytte_upload_image_action', 'hytte_upload_image_action');

/* Upload Galleries
............................ */

if ( ! function_exists( 'hytte_upload_galleries_action' ) ) {
  function hytte_upload_galleries_action(){
    $response_arr 	= array();
    $content = '';

    $attachment_ids = array();
    $files = hytte_array_files($_FILES['files']);
    $continue = false;
    if ( !empty($_FILES['files']) ) {
        foreach( $files as $file ){
          if( is_array($file) ){
            $attachment_id = upload_user_file( $file, false );

            if ( is_numeric($attachment_id) ) {
              $img_thumb = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
              $response_arr['status'] = 'success';

              $content .= '<div class="image_wrapper">
              <div class="image_holder">
                    <img src="'. $img_thumb[0] .'" alt="" class="img-fluid">
                    <div class="overlay">
                      <a href="javascript:void(0)" class="cab_img icon" title="User Profile">
                      <i class="fa fa-times"></i>
                      </a>
                    </div>
                    <input type="hidden" class="cabin_images_galleries" name="cabin_images_galleries[]" id="filelist-164" 
                    value="'. $img_thumb[0] .'" 
                    data-id="'. $attachment_id .'">
              </div>
            </div>';                
            }

          }
          $i++;
        }
    }

    $response_arr['message'] = $content;
    echo json_encode($response_arr);	
    wp_die();

  }
}
add_action( 'wp_ajax_hytte_upload_galleries_action', 'hytte_upload_galleries_action');
add_action( 'wp_ajax_nopriv_hytte_upload_galleries_action', 'hytte_upload_galleries_action');


/* Upload Floor Plan
............................ */

if ( ! function_exists( 'hytte_upload_floor_plan_action' ) ) {
  function hytte_upload_floor_plan_action(){
    $response_arr 	= array();
    $content = '';

    $attachment_ids = array();
    $files = hytte_array_files($_FILES['files']);
    $continue = false;
    if ( !empty($_FILES['files']) ) {
        foreach( $files as $file ){
          if( is_array($file) ){
            $attachment_id = upload_user_file( $file, false );

            if ( is_numeric($attachment_id) ) {
              $img_thumb = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
              $response_arr['status'] = 'success';

              $content .= '<div class="image_wrapper floor-plan">
              <div class="image_holder">
                    <img src="'. $img_thumb[0] .'" alt="" class="img-fluid">
                    <div class="overlay">
                      <a href="javascript:void(0)" class="floor_plan icon" title="User Profile">
                      <i class="fa fa-times"></i>
                      </a>
                    </div>
                    <input type="hidden" class="cabin_floor_plan_galleries" name="cabin_floor_plan_galleries[]" id="filelist-164" 
                    value="'. $img_thumb[0] .'" 
                    data-id="'. $attachment_id .'">
              </div>
            </div>';  
             
            }

          }
          $i++;
        }
    }

    $response_arr['message'] = $content;
    echo json_encode($response_arr);	
    wp_die();

  }
}
add_action( 'wp_ajax_hytte_upload_floor_plan_action', 'hytte_upload_floor_plan_action');
add_action( 'wp_ajax_nopriv_hytte_upload_floor_plan_action', 'hytte_upload_floor_plan_action');

/* Random Key Generate */
if ( ! function_exists( 'hytte_random_keygen' ) ) {
  function hytte_random_keygen($n = 20) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 

    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 

    return $randomString; 
  } 
}

  /** Files arrray **/
  if ( ! function_exists( 'hytte_array_files' ) ) :
  	function hytte_array_files(&$file_post) {
  	    $file_ary = array();
  	    $file_count = count($file_post['name']);
  	    $file_keys = array_keys($file_post);
  	    for ($i=0; $i<$file_count; $i++) {
  	        foreach ($file_keys as $key) {
  	            $file_ary[$i][$key] = $file_post[$key][$i];
  	        }
  	    }
  	    return $file_ary;
  	}
  endif;


  if ( ! function_exists( 'upload_user_file' ) ) :
  	function upload_user_file( $file = array(), $title = false ) {
  		require_once ABSPATH.'wp-admin/includes/admin.php';
  		$file_return = wp_handle_upload($file, array('test_form' => false));
  		if(isset($file_return['error']) || isset($file_return['upload_error_handler'])){
  			return false;
  		}else{
  			$filename = $file_return['file'];
  			$attachment = array(
  				'post_mime_type' => $file_return['type'],
  				'post_content' => '',
  				'post_type' => 'attachment',
  				'post_status' => 'inherit',
  				'guid' => $file_return['url']
  			);
  			if($title){
  				$attachment['post_title'] = $title;
  			}
  			$attachment_id = wp_insert_attachment( $attachment, $filename );
  			require_once(ABSPATH . 'wp-admin/includes/image.php');

  			$attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
  			wp_update_attachment_metadata( $attachment_id, $attachment_data );
  			if( 0 < intval( $attachment_id ) ) {
  				return $attachment_id;
  			}
  		}
  		return false;
  	}
  endif;

/* Header User Navigation icon */
if ( ! function_exists( 'hytte_user_login_nav' ) ) {
  function hytte_user_login_nav() {
    $content = '';
    $login_menu_text = (is_user_logged_in() ? __('Minside', 'hytteguiden') : __('Logg Inn', 'hytteguiden') );

    if(is_user_logged_in()){

        $current_user = wp_get_current_user(); 
        $current_producer_id = get_user_meta( $current_user->ID, 'producer_id', true );

        $content .= '<li class="dropdown loggedin">
        <a href="#" class="dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="far fa-user"></i> <span class="navtext">'. $current_user->user_login .'</span>
        </a><div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">';

        if(isset( $current_producer_id ) && !empty( $current_producer_id )){
          $content .= '<a class="dropdown-item" href="'. esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['mydashboard_page'] .'">'. __('Dashboard', 'hytteguiden') .'</a>';
          $content .= '<a class="dropdown-item" href="'. esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['producerprofile_page'] .'">'. __('Profil', 'hytteguiden') .'</a>';
          $content .= '<a class="dropdown-item" href="'. esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['producerhytter_page'] .'">'. __('Mine Hytter', 'hytteguiden') .'</a>';
          $content .= '<a class="dropdown-item" href="'. esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['producerkataloger_page'] .'">'. __('Mine Kataloger', 'hytteguiden') .'</a>';
          $content .= '<a class="dropdown-item" href="'. esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['producerrequest_page'] .'">'. __('Forespørsler', 'hytteguiden') .'</a>';
        } else{

          $content .= '<a class="dropdown-item" href="'. esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['myprofile_page'] .'">'. __('Profil', 'hytteguiden') .'</a>';
          $content .= '<a class="dropdown-item" href="'. esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['mycatalogue_page'] .'">'. __('Kataloger', 'hytteguiden') .'</a>';
          $content .= '<a class="dropdown-item" href="'. esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['mycabins_page'] .'">'. __('Favoritter', 'hytteguiden') .'</a>';
        }

        $content .= '<div class="dropdown-divider"></div>
            <a class="dropdown-item signout" href="'. wp_logout_url( home_url() ).'">'. __('Logg ut', 'hytteguiden').' <i class="fa fa-sign-out-alt"></i></a>
          </div>
        </li>';

    }else{
      $content = '<li><a href="'. esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['login_page'] .'"><i class="far fa-user"></i> <span class="navtext">'. $login_menu_text.'</span></a></li>';
    }

    return $content;
  }
}

/* JSON to seralize for Images */

if( !function_exists( 'hytte_json_to_array_images' ) ){
  function hytte_json_to_array_images($cabin_images){
    $final_data = [];
      foreach (json_decode($cabin_images) as $key => $image) {
        $final_data[$image->id] = $image->image_url; 
      } 
    return ($final_data);
  }
}

/* Share the post */
if( !function_exists( 'hytte_sharethis_nav' ) ){
  function hytte_sharethis_nav($post_id){
    global $wpdb;
    $content = '';
		$share_img 		= '';
		$share_title 	= get_the_title( $post_id );
		$share_url 		= get_permalink( $post_id );
		$hytte_post 	= get_post( $post_id );
		$share_txt 		= wp_trim_words( strip_tags($hytte_post->post_content), 40, '' );
		if (has_post_thumbnail( $post_id ) ):
			$image 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
			$share_img 	= $image[0];
    endif;

    $content .= '<span class="btn btn-light btn-xs share-links"><i class="fa fa-share-alt"></i> '. __('Share', 'hytteguiden');
    $content .= '<ul class="social-hover">';
    $content .= '<li class="facebook-bg"><a href="javascript:void(null);" class="facebook" onClick = "fb_callout(&quot;'.$share_url.'&quot;, &quot;'.$share_img.'&quot;, &quot;'.$share_title.'&quot;, &quot;'.$share_txt.'&quot;);"><span class="share-icons face-book"><i class="fab fa-facebook-f"></i></span> Share</a></li>';
    $content .= '<li class="tweeter-bg"><a href="javascript:void(null);" class="twitter" onClick ="share_on_twitter(&quot;'.$share_url.'&quot;, &quot;'.$share_title.'&quot;);"><span class="share-icons twitter"><i class="fab fa-twitter"></i></span> Tweet</a></li>';
    $content .= '<li class="google-bg"><a href="javascript:void(null);" class="google" onClick = "google_plus(&quot;'.$share_url.'&quot;);"><span class="share-icons google"><i class="fab fa-google-plus-g"></i></span> +1 </a></li>';
    $content .= '<li class="pin-bg"><a href="javascript:void(null);" class="pin" onClick = "pin_it_now(&quot;'.$share_url.'&quot;, &quot;'.$share_img.'&quot;, &quot;'.$share_title.'&quot;);"><span class="share-icons google"><i class="fab fa-pinterest-p"></i></span> Pin it</a></li>';
    $content .= '</ul></span>';

    return $content;
    
  }
}

/* Healthjem >> Order kataloger */
if( !function_exists( 'hytte_order_kataloger' ) ){
  function hytte_order_kataloger(){
    global $wpdb;
    $response_arr 	= array();
    $response_arr['redir'] = '';
    $kataloger_ids = $_POST['kataloger_ids'];
 
    $guest_id = hytteguiden_guest_id();

    if(is_user_logged_in()){
      $current_user = wp_get_current_user();  
      $cond .= ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';    
    }else {
      $cond .= ' AND guest_id = "'. $guest_id . '"';  
    }
  
    $total_records = hytte_record_count('address', $cond);  
    if($total_records <= 0){
      $response_arr['status'] = 'error';   
      $response_arr['message'] = __('Vennligst fyll inn din personlige informasjon og adresse før bestilling.', 'hytteguiden');
      $response_arr['redir'] = home_url( '/' ). $GLOBALS['route_defaults']['myprofile_page']; 
    } else{

      $row_data = hytte_row_from_table('address', $cond );
      
      /*  Healthjem authnicate api call */
     
      if($kataloger_ids){
      
        $data = array(
          'username' => 'wsHytteguiden',
          'password' => '55tkc3e6gvam14f3ikaq7dq96i'
        );

        $auth_da = call_api_using_CURL( $data, 'https://ws.di.no/ws/json/auth/v-2/login' ); 

        foreach($kataloger_ids as $kataloger_id){

          $producer_id = get_post_meta($kataloger_id, '_catalogs_producer_id', true);
          $producer_zip_code = get_post_meta($producer_id, 'producer_zip_code', true);
          $producer_country_code = get_post_meta($producer_id, 'producer_country_code', true);

          if(isset($producer_id) && !empty($producer_id)){

              $booking_args = [
                "shopId" => 374,
                "transportSolutionId" => 18,
                "parties" => [
                  [
                    "type" => "consignee",
                    "name" => $row_data->full_name,
                    "countryCode" => $row_data->country_code,
                    "postalName" => $row_data->postal_name,
                    "zipCode" => $row_data->zip_code,
                    "address" => $row_data->address,
                    "phone1" => $row_data->phone_number,
                    "email" => $row_data->email_address
                  ],
                  [
                    "type" => "consignor",
                    "name" => get_the_title($producer_id),
                    "countryCode" => $producer_country_code,
                    "zipCode" => $producer_zip_code
                  ]],
                  "items" => [[
                    "itemNumber" => 1,
                    "weight" => 400,
                    "contents" => get_the_title($kataloger_id)
                    ]]
                
                  ];
    
              $booking_resp = call_api_using_CURL( $booking_args, 'https://ws.di.no/ws/json/parcel/booking/v-1/book', $auth_da->token);          
    
              $wpdb->insert($wpdb->prefix.'kataloger_orders',
              array(
                    'address_id'       => $row_data->id,
                    'kataloger_id'     => $kataloger_id,
                    'producer_id'      => $producer_id,
                    'contact_producer' => $_POST['contact_request'],
                    'order_status'     => 'Ordered',
                    'tracking_code'    => $booking_resp->items[0]->trackingReference
                    )
                );
              // Delete from wishlist 
              hytte_delete_cond_data( 'kataloger', $cond . ' AND kataloger_id = '.$kataloger_id);
          
          } 
          

        }


      $response_arr['status'] = 'success';   
      $response_arr['message'] = __('Din katalog har blitt bestilt på bestilling.', 'hytteguiden');
      $response_arr['redir'] = home_url( '/' ). $GLOBALS['route_defaults']['mycatalogue_page']; 

      }
     
    }

    echo json_encode($response_arr);
    exit;
    
  }
}

add_action( 'wp_ajax_hytte_order_kataloger', 'hytte_order_kataloger');
add_action( 'wp_ajax_nopriv_hytte_order_kataloger', 'hytte_order_kataloger');

function call_api_using_CURL($data = [], $url= '', $token = ''){        
    $payload = json_encode($data);      
    // Prepare new cURL resource
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
      
      // Set HTTP Header for POST request
      $args = array();
      if($token != ''){
        $args[] = 'Authorization: Bearer '. $token;
      }
      $args[] = 'Content-Type: application/json';
      $args[] = 'Content-Length: ' . strlen($payload);

    // print_r($args);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $args );
      
    // Submit the POST request
    $result = curl_exec($ch);
    // Close cURL session handle
    curl_close($ch);
    $api_data = json_decode($result);      
    return $api_data;  
  
}

/* Function to enqueue google fonts */
if ( ! function_exists( 'hytteguiden_google_fonts_url' ) ) {
	function hytteguiden_google_fonts_url() {

		$variants 		= array();
		$font_families 	= array();
		$selected_fonts = array();
		$subset_array   = array();
		$font_subsets	= array();
		$get_fonts      = array( 'home_banner_title_font', 'home_banner_subtitle_font', 'home_banner_pretitle_font' );
		$font 	  	   	= '';

		/* Default Theme Fonts */
		$font_families['Montserrat'][0] = '200';
		$font_families['Montserrat'][1] = '200i';
		$font_families['Montserrat'][2] = '300';
		$font_families['Montserrat'][3] = '300i';
		$font_families['Montserrat'][4] = '400';
		$font_families['Montserrat'][5] = '400i';
		$font_families['Montserrat'][8] = '600';
		$font_families['Montserrat'][9] = '600i';
		$font_families['Montserrat'][10] = '700';
		$font_families['Montserrat'][11] = '700i';
		$font_families['Montserrat'][12] = '800';
		$font_families['Montserrat'][13] = '800i';
		$font_families['Montserrat'][14] = '900';
		$font_families['Montserrat'][15] = '900i';
		$font_subsets[0] = 'latin-ext';
		$font_subsets[1] = 'vietnamese';

		if ( is_array( $get_fonts ) && ! empty( $get_fonts ) ) {
			foreach( $get_fonts as $font_field ) {
				$font 	  = get_theme_mod( $font_field, 'Montserrat' );
				$variants = get_theme_mod( $font_field . '_variant' );
				$subsets  = get_theme_mod( $font_field . '_subset' );
				if( ! empty( $font ) && ! empty( $variants ) ) {
					$selected_fonts[] = $font;
					$font_name 		  = str_replace( "+", " ", $font );
					$exp_val  		  = explode( ':', $variants );
					if( isset( $exp_val[1] ) && ! empty( $exp_val[1] ) ) {
						if( 'regular' == $exp_val[1] ) $exp_val[1] = 400;
						if( ! isset( $font_families[$font] ) ) $font_families[$font][] = $exp_val[1];
						else if( isset( $font_families[$font] ) && ! in_array( $exp_val[1], $font_families[$font] ) ) $font_families[$font][] = $exp_val[1];

				    }
				}
				if( ! empty( $subsets ) ) {
					$index = 2;
					$subset_array = explode( ',', $subsets );
					foreach( $subset_array as $a ) {
                        if( ! in_array( $a, $font_subsets ) && 'latin' != $a ) {
                            $font_subsets[$index] = $a;
                            $index++;
                        }
                    }
				}
			}
		}
	    if( ! empty( $font_families ) ) {

	    	$font_family = array();
			foreach( $font_families as $font => $variant ) {
                if( 1 == count( $variant ) && in_array( 400, $variant ) ) $font_family[] = $font;
                else $font_family[] = $font . ':' . implode( ',', $variant );
            }
			$subset = implode( ',', $font_subsets );
			$family = implode( '|', $font_family );
			$args   = ( ! empty( $subset ) ) ? $family . '&amp;subset=' . $subset : $family;

			//$fonts_args = urlencode( $args );
			$fonts_args = $args;

			$fonts_url = esc_url( '//fonts.googleapis.com/css?family=' . $fonts_args );

			return esc_url_raw( $fonts_url );
		}
	}
}

/* Hytteguiden Customizer Styles */
if( ! function_exists( 'hytteguiden_custom_head' ) ) {
	function hytteguiden_custom_head() {
    get_template_part( 'library/admin/customizer/customizer-custom-styles' );

  }
}

add_action( 'wp_head', 'hytteguiden_custom_head' );




?>
