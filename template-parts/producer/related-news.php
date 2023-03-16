    <?php $producer_id = get_the_ID();
 
      global $post;      

      $link_post =  get_post_meta($producer_id,'link_post',true);
      $args = array('post__in' =>  $link_post);
      $myposts = get_posts( $args );
      if($myposts){
    ?>
    <div class="relatedcabs">
      <h2 class="sectiontitle"><span><?php _e('Relaterte Nyheter', 'hytteguiden'); ?></span></h2>
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
                <div class="row"> 
                  <div class="col-12 col-md-8">
                    <h3 class="rel_new_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  </div>
                  <div class="col-12 col-md-4">
                  <?php 
                    
                    $featured_img_url = get_the_post_thumbnail_url($GLOBALS['this_producer_id'], 'full');    
                                 
                    //echo ($featured_img_url);
                  ?>
                  <div class="img-related">                    
                    <img src="<?php echo $featured_img_url; ?>" class="img-fluid">                     
                  </div>                 
                  </div>                
                </div>
                <div class="relate-excerpt">									
                  <?php echo wp_trim_words( get_the_excerpt(), 12, '...' );  ?>
								</div>
               
              </div>
              
              <div class="cabininfo">
                <?php
                  $cabin_price_turnkey = get_post_meta( $post->ID, 'cabin_price_turnkey', true);
                    if(isset($cabin_price_turnkey) && !empty($cabin_price_turnkey)){
                    echo '<ul><li><span class="icon">'. hytteguiden_icon( 'tag.svg', $alt = 'Hytte Pris' ).'</span>'.hytteguiden_price($cabin_price_turnkey).'kr</li></ul>';
                  }else {
                    echo '<ul><li><span class="icon">'. hytteguiden_icon( 'tag.svg', $alt = 'Hytte Pris' ).'</span>'.__( 'Pris på forespørsel', 'hytteguiden').'</li></ul>';
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
                      echo '<ul><li><span class="icon">'. hytteguiden_icon( 'bed.svg', $alt = 'Hytte Soverom' ).'</span>'.$cabin_bedroom.' soverom</li>';
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
