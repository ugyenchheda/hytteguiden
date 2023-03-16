<?php
/* Manage column */
add_filter( 'manage_cabin_posts_columns', 'hytteguiden_cabin_columns' );
function hytteguiden_cabin_columns( $columns ) {

    $columns = array(
      'cb'                   => $columns['cb'],
      'featured_image'       => __( 'Images', 'hytteguiden' ),
      'title'                => __( 'Title', 'hytteguiden' ),
      'producer_name'        => __( 'Producers', 'hytteguiden' ),
      'cabin_price_kit'      => __( 'Price Kit', 'hytteguiden' ),
      'cabin_price_turnkey'  => __( 'Price Turnkey', 'hytteguiden' ),
      'cabin_utility_area'  => __( 'Størrelse', 'hytteguiden' ),
      'cabin_bedroom'        => __( 'Soverom', 'hytteguiden' ),
      'cabin_bathroom'       => __( 'Bad', 'hytteguiden' ),
      'cabin_beds'           => __( 'Senger', 'hytteguiden' ),
      'cabin_kataloger'      => __( 'Kataloger', 'hytteguiden' ),
      'date'                 => __( 'Date', 'hytteguiden' ),
    );

  return $columns;
}

add_action( 'manage_cabin_posts_custom_column', 'hytteguiden_cabin_column', 10, 2);
function hytteguiden_cabin_column( $column, $post_id ) {

  // Image column
  if ( 'featured_image' === $column ) {
    echo '<a href="'. get_edit_post_link($post_id).'">';
    if ( has_post_thumbnail() ) {
        the_post_thumbnail('thumbnail');
    } else{
      echo '<img src="'. get_template_directory_uri() .'/library/admin/assets/images/no_image.png">';
    }
    echo '</a>';
  }

    // Producer Name
    if ( 'producer_name' === $column ) {
        $cabin_producer_id = get_post_meta($post_id, 'cabin_producer_id', true);
        if(isset($cabin_producer_id) && !empty($cabin_producer_id)){
          echo get_the_title($cabin_producer_id);
        } else{
          echo '---';
        }
    }

    // Price kit
    if ( 'cabin_price_kit' === $column ) {
        $cabin_price_kit = get_post_meta($post_id, 'cabin_price_kit', true);
        if(isset($cabin_price_kit) && !empty($cabin_price_kit)){
          echo 'Kr'.$cabin_price_kit;
        } else{
          echo '---';
        }
    }

    // Price kit
    if ( 'cabin_price_turnkey' === $column ) {
        $cabin_price_turnkey = get_post_meta($post_id, 'cabin_price_turnkey', true);
        if(isset($cabin_price_turnkey) && !empty($cabin_price_turnkey)){
          echo 'Kr'.$cabin_price_turnkey;
        } else{
          echo '---';
        }
    }

    // Size
    if ( 'cabin_utility_area' === $column ) {
      $cabin_utility_area = get_post_meta($post_id, 'cabin_utility_area', true);
      if(isset($cabin_utility_area) && !empty($cabin_utility_area)){
        echo $cabin_utility_area;
      } else{
        echo '---';
      }
    }

    // Bedrooms
    if ( 'cabin_bedroom' === $column ) {
        $cabin_bedroom = get_post_meta($post_id, 'cabin_bedroom', true);
        if(isset($cabin_bedroom) && !empty($cabin_bedroom)){
          echo $cabin_bedroom;
        } else{
          echo '---';
        }
    }

    // Bathroom
    if ( 'cabin_bathroom' === $column ) {
        $cabin_bathroom = get_post_meta($post_id, 'cabin_bathroom', true);
        if(isset($cabin_bathroom) && !empty($cabin_bathroom)){
          echo $cabin_bathroom;
        } else{
          echo '---';
        }
    }

      // cabin_beds
      if ( 'cabin_beds' === $column ) {
          $cabin_beds = get_post_meta($post_id, 'cabin_beds', true);
          if(isset($cabin_beds) && !empty($cabin_beds)){
            echo $cabin_beds;
          } else{
            echo '---';
          }
      }

    // Kataloger
    if ( 'cabin_kataloger' === $column ) {
      global $post;
      $cabin_producer_id = get_post_meta($post_id, 'cabin_producer_id', true);
      $cabin_kataloger = get_post_meta($post_id, 'cabin_kataloger', true);

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
        echo '<div class="kataloger_box"><input type="hidden" class="cabin_post_val" value="'. $post_id .'">';
        echo '<select class="asign_kataloger">';
        echo '<option value="">'. __( 'Velg Kataloger', 'hytteguiden' ) .'</option>';
        if($myposts){
          foreach( $myposts as $post ) :
            setup_postdata($post);
            echo '<option value="'.  $post->ID.'"';
            if( isset($cabin_kataloger) && $cabin_kataloger == $post->ID ){
              echo ' selected="selected"';
            }

            echo '>';
            echo get_the_title( $post->ID );
            echo '</option>';
          endforeach;
        }
        wp_reset_postdata();
        echo '</select></div>';

  }

}

add_action( 'restrict_manage_posts' , 'hytteguiden_modify_producer_filters' );

function hytteguiden_modify_producer_filters() {
    // Only apply the filter to our specific post type
    global $typenow;
    global $pagenow;
    if( $pagenow == 'edit.php' && $typenow == 'cabin')
    {
       $args = array(
          'post_type' => 'producer',
          'posts_per_page' => -1,
       );
       $query = new WP_Query( $args );
       if ($query->have_posts()) {
        $producers_options =
        $producers_options = '<select name="filter_producer">';
        $producers_options .= '<option value="">All Producers</option>';
        while ( $query->have_posts() ) : $query->the_post();
          $producers_options .= '<option value="'. get_the_ID().'">'. get_the_title().'</option>';
        endwhile;
        $producers_options .= '</select>';

        echo $producers_options;
      }

    }
}

add_filter( 'parse_query', 'hytteguiden_modify_filter_producer' );
function hytteguiden_modify_filter_producer( $query ) {
    global $typenow;
    global $pagenow;

    if( $pagenow == 'edit.php' && $typenow == 'cabin' && $_REQUEST['filter_producer'] )
    {
        $query->query_vars[ 'meta_key' ] = 'cabin_producer_id';
        $query->query_vars[ 'meta_value' ] = (int)$_REQUEST['filter_producer'];
    }
}


/* Manage Department column */
add_filter( 'manage_avdeling_posts_columns', 'hytteguiden_avdeling_columns' );
function hytteguiden_avdeling_columns( $columns ) {

    $columns = array(
      'cb'                   => $columns['cb'],
      'title'                => __( 'Title', 'hytteguiden' ),
      'phone'                => __( 'Phone', 'hytteguiden' ),
      'email_address'        => __( 'Email', 'hytteguiden' ),
      'address'              => __( 'Address', 'hytteguiden' ),
      'date'                 => __( 'Date', 'hytteguiden' ),
    );

  return $columns;
}

add_action( 'manage_avdeling_posts_custom_column', 'hytteguiden_avdeling_column', 10, 2);
function hytteguiden_avdeling_column( $column, $post_id ) {

    // Phone
    if ( 'phone' === $column ) {
        $department_contact_phone = get_post_meta($post_id, 'department_contact_phone', true);
        if(isset($department_contact_phone) && !empty($department_contact_phone)){
          echo $department_contact_phone;
        } else{
          echo '---';
        }
    }

    // Email
    if ( 'email_address' === $column ) {
        $department_email = get_post_meta($post_id, 'department_email', true);
        if(isset($department_email) && !empty($department_email)){
          echo $department_email;
        } else{
          echo '---';
        }
    }

        // address
        if ( 'address' === $column ) {
          $department_address = get_post_meta($post_id, 'department_address', true);
          if(isset($department_address) && !empty($department_address)){
            echo $department_address;
          } else{
            echo '---';
          }
      }



}



?>
