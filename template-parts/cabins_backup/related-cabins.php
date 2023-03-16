    <?php
      global $post;
      $args = array( 'numberposts' => 7, 'post_type' => 'cabin', 'post__not_in' => array( get_the_ID() ), );
      $myposts = get_posts( $args );
      if($myposts){
    ?>

<div class="relatedcabs">
  <h2 class="sectiontitle"><span><?php _e('LIKNENDE HYTTER', 'hytteguiden'); ?></span></h2>
  <div class="owl-carousel owl-carousel-1 hasstage">
  <?php
  foreach( $myposts as $post ) :
    setup_postdata($post);
    ?>
    <div class="item">
      <div class="cabinmodule">
              <?php
          if ( has_post_thumbnail( $post->ID ) ) {
              echo '<figure class="cabinimg">';
              echo '<a href="'.get_permalink().'">';
              echo get_the_post_thumbnail( $post->ID, 'post_image_m','', array( "class" => "img-fluid" ) );
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
              $cabin_price_kit = get_post_meta( $post->ID, 'cabin_price_kit', true);
                if(isset($cabin_price_kit) && !empty($cabin_price_kit)){
                echo '<ul><li><span class="icon">'. hytteguiden_icon( 'tag.svg', $alt = 'Hytte Pris' ).'</span>'.hytteguiden_price($cabin_price_kit).'kr</li></ul>';
               }
            ?>
            <ul>
             <?php

                /*Cabin Area*/
                $cabin_build_area = get_post_meta( $post->ID, 'cabin_build_area', true);
                  if(isset($cabin_build_area) && !empty($cabin_build_area)){
                  echo '<ul><li><span class="icon">'. hytteguiden_icon( 'scale.svg', $alt = 'Hytte STØRRELSE ' ).'</span>'.hytteguiden_price($cabin_build_area).'m<sup>2</sup></li>';
                 }
                /*Cabin Bedrooms*/
                $cabin_bedroom = get_post_meta( $post->ID, 'cabin_bedroom', true);
                  if(isset($cabin_bedroom) && !empty($cabin_bedroom)){
                  echo '<ul><li><span class="icon">'. hytteguiden_icon( 'room-key.svg', $alt = 'Hytte Soverom' ).'</span>'.$cabin_bedroom.' soverom</li>';
                 }
                /*Cabin Beds*/
                $cabin_beds = get_post_meta( $post->ID, 'cabin_beds', true);
                  if(isset($cabin_beds) && !empty($cabin_beds)){
                  echo '<ul><li><span class="icon">'. hytteguiden_icon( 'bed.svg', $alt = 'Hytte Sengeplasser' ).'</span>'.$cabin_beds.' senger</li>';
                 }
              ?>
            </ul>
          </div>
          <a href="<?php the_permalink(); ?>" class="btn btn-block btn-line-theme1">Les mer <i class="fa fa-long-arrow-alt-right"></i></a>
        </div>
      </div>
    </div>
<?php endforeach;
wp_reset_postdata(); ?>

  </div>
</div>
<?php } ?>
