<?php  $post_id = get_the_ID(); 
wp_reset_query();
$meta_query = array();

$cabin_curr_size = get_post_meta($post_id, 'cabin_utility_area', true);
$cabin_curr_price = get_post_meta($post_id, 'cabin_price_turnkey', true);

      global $post;

      $args = array( 'numberposts' => 16,
            'post_type' => 'cabin',
            'post__not_in' => array( $post_id )
       );

       // Relative Cabin size
       if( isset($cabin_curr_size) && !empty($cabin_curr_size) ){
            $min_rel_size = (int) ($cabin_curr_size - $cabin_curr_size * 0.10 ); 
            $max_rel_size = (int) ( $cabin_curr_size + $cabin_curr_size * 0.10 ); 

            $meta_query[] = array(
              'key' => 'cabin_utility_area',
              'value' => array($min_rel_size, $max_rel_size),
              'type' => 'numeric',
              'compare' => 'BETWEEN'
            );
       } 

        // Relative Cabin Price
        if( isset($cabin_curr_price) && !empty($cabin_curr_price) ){
          $min_rel_price = (int) ($cabin_curr_price - $cabin_curr_price * 0.15) ; 
          $max_rel_price = (int) ( $cabin_curr_price + $cabin_curr_price * 0.15 ); 

          $meta_query[] = array(
            'key' => 'cabin_price_turnkey',
            'value' => array($min_rel_price, $max_rel_price),
            'type' => 'numeric',
            'compare' => 'BETWEEN'
          );
        } 

        

        if($meta_query){
          //$meta_query['relation'] = 'AND';
          $args['meta_query'] =  array(
                                'relation' => 'AND',
                                $meta_query,
                              );
        }

        // echo '<pre>';
        // print_r($args);
        // echo '</pre>'; 

        $cabinpost = new WP_Query( $args );

        // $myposts = get_posts( $args );
        if ( $cabinpost->have_posts() ) {
    ?>

<div class="relatedcabs">
  <h2 class="sectiontitle"><span><?php _e('LIKNENDE HYTTER', 'hytteguiden'); ?></span></h2>
  <div class="owl-carousel owl-carousel-1 hasstage">
  <?php
  while ( $cabinpost->have_posts() ) : $cabinpost->the_post();
    ?>
    <div class="item">
      <div class="cabinmodule">
              <?php
          if ( has_post_thumbnail( $cabinpost->ID ) ) {
              echo '<figure class="cabinimg">';
              echo '<a href="'.get_permalink().'">';
              echo get_the_post_thumbnail( $cabinpost->ID, 'post_image_m','', array( "class" => "img-fluid" ) );
              echo '</a></figure>';
            }
          ?>

        <div class="cabindetails">
          <div class="cabintitle">
            <h4><?php echo hytteguiden_producer_name(get_the_ID()); ?></h4>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          </div>
          <div class="cabininfo">
            <?php
              $cabin_price_turnkey = get_post_meta( get_the_ID(), 'cabin_price_turnkey', true);
                if(isset($cabin_price_turnkey) && !empty($cabin_price_turnkey)){
                echo '<ul><li><span class="icon"><span class="icon-tag"></span></span>'.hytteguiden_price($cabin_price_turnkey).'kr</li></ul>';
               }
            ?>
            <ul>
             <?php

                /*Cabin Area*/
                $cabin_build_area = get_post_meta( get_the_ID(), 'cabin_build_area', true);
                  if(isset($cabin_build_area) && !empty($cabin_build_area)){
                  echo '<ul><li><span class="icon"><span class="icon-scale"></span>'.hytteguiden_price($cabin_build_area).'m<sup>2</sup></li>';
                 }
                /*Cabin Bedrooms*/
                $cabin_bedroom = get_post_meta( get_the_ID(), 'cabin_bedroom', true);
                  if(isset($cabin_bedroom) && !empty($cabin_bedroom)){
                  echo '<ul><li><span class="icon"><span class="icon-bed"></span></span></span>'.$cabin_bedroom.' soverom</li>';
                 }
              ?>
            </ul>
          </div>
          <a href="<?php the_permalink(); ?>" class="btn btn-block btn-line-theme1">Les mer <i class="fa fa-long-arrow-alt-right"></i></a>
        </div>
      </div>
    </div>
                <?php endwhile;
          //wp_reset_postdata(); ?>

  </div>
</div>
<?php } ?>
