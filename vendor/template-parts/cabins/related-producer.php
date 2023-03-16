    <?php
     global $post;
     $cabin_producer_id = get_post_meta( get_the_ID(), 'cabin_producer_id', true);
     $args = array(
       'meta_query'=> array(
         array(
           'key' => 'cabin_producer_id',
           'compare' => '=',
           'value' => $cabin_producer_id,
         )
       ),
      'numberposts' => 5,
      'post_type' => 'cabin',
       'post__not_in' => array( get_the_ID() ),
       );
     
     $myposts = get_posts( $args );
     if($myposts){
    ?>

<div class="relatedcabs">
  <h2 class="sectiontitle"><span><?php _e('PRODUSENTENS ANDRE HYTTER', 'hytteguiden'); ?></span></h2>
  <div class="owl-carousel owl-carousel-producer hasstage">
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
                echo get_the_post_thumbnail( $post->ID, 'post_image_m', array( "class" => "img-fluid" ) );
                echo '</a></figure>';
            }
        ?>       

        <div class="cabindetails">
            <div class="cabintitle">
                <h4><?php echo hytteguiden_producer_name(get_the_ID()); ?></h4>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            </div>
            <div class="cabininfo">
                  <ul>
                  <?php
                        $cabin_price_turnkey = get_post_meta( get_the_ID(), 'cabin_price_turnkey', true);
                        if(isset($cabin_price_turnkey) && !empty($cabin_price_turnkey)){
                        echo '<li><span class="icon">'. hytteguiden_icon( 'tag.svg', $alt = 'Hytte Pris' ).'</span>'.hytteguiden_price($cabin_price_turnkey).'kr</li>';
                      }
                        $cabin_build_area = get_post_meta( get_the_ID(), 'cabin_build_area', true);
                        if(isset($cabin_build_area) && !empty($cabin_build_area)){
                        echo '<li><span class="icon">'. hytteguiden_icon( 'scale.svg', $alt = 'Hytte STØRRELSE ' ).'</span>'.hytteguiden_price($cabin_build_area).'m<sup>2</sup></li>';
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
