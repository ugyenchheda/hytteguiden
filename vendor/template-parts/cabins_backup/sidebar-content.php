  <aside class="aside">
    <div class="row">

  <?php $cabin_producer_id = get_post_meta( get_the_ID(), 'cabin_producer_id', true);
    if(isset($cabin_producer_id) && !empty($cabin_producer_id)){
      ?>
      <div class="col-12">
        <div class="asideblock unwrapped">
          <a href="#" class="btn btn-block btn-lg btn-theme1" data-toggle="modal" data-target="#producercontactform"><?php _e( 'Kontakt', 'hytteguiden') ?></a>
        </div>
      </div>
            
      <div class="col-12 col-md-6 col-lg-12">
        <div class="asideblock sellercontact">
          <h4><?php _e( 'Kontakt Oss', 'hytteguiden') ?></h4>
          <ul>
              <?php
                /* Producer Phone*/
                $producer_contact_phone_1 = get_post_meta( $cabin_producer_id, 'producer_contact_phone_1', true);
                if(isset($producer_contact_phone_1) && !empty($producer_contact_phone_1)){
                  echo '<li>'.__('Telefon', 'hytteguiden').'</li>
                  <li>'.$producer_contact_phone_1.'</li>';
                  }

                /* Producer Email*/
                $producer_email = get_post_meta( $cabin_producer_id, 'producer_email', true);
                if(isset($producer_email) && !empty($producer_email)){
                  echo '<li>'.__('E-post', 'hytteguiden').'</li>
                  <li>'.$producer_email.'</li>';
                  }
              ?>
          </ul>
          <a href="#" class="btn btn-block btn-light"><?php _e( 'Bestill Katalog', 'hytteguiden') ?></a>
        </div>
      </div>
    <?php } ?>

      <div class="col-12 col-md-6 col-lg-12">
        <div class="asideblock sellerinfo">
          <?php
          if ( has_post_thumbnail( $cabin_producer_id ) ) {
              echo '<div class="sellerlogo">';
              echo '<a href="'.get_permalink($cabin_producer_id).'">';
              echo get_the_post_thumbnail( $cabin_producer_id, 'full','', array( "class" => "img-fluid" ) );
              echo '</a>';
              echo '</div>';
            }
          ?>

          <div class="sellername">
            <h5><?php echo get_the_title($cabin_producer_id);?></h5>
                        <?php
              /* Producer Name*/
              $producer_tagling = get_post_meta( $cabin_producer_id, 'producer_tagling', true);
              if(isset($producer_tagling) && !empty($producer_tagling)){
                echo '<p>'.$producer_tagling.'</p>';
                }
                ?>
          </div>
          <p><?php
          $content_post = get_post($cabin_producer_id);
          $content = $content_post->post_content;
          $content = apply_filters('the_content', $content);
          $content = str_replace(']]>', ']]&gt;', $content);
          echo $content;
          ?></p>
        </div>
      </div>


      <?php
global $post;

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

      <div class="col-12 col-md-12 col-lg-12">
        <div class="asideblock">
          <h4 class="asidetitle"><?php _e( 'Produsentens andre hytter', 'hytteguiden') ?></h4>
          <div class="cabmodule-alt-stage">
            <?php
            foreach( $myposts as $post ) :
              setup_postdata($post);
              ?>
            <div class="cabinmodule-alt">
              <?php
          if ( has_post_thumbnail( $post->ID ) ) {
              echo '<figure class="cabinimg">';
              echo '<a href="'.get_permalink().'">';
              echo get_the_post_thumbnail( $post->ID, 'post_image_xl', array( "class" => "img-fluid" ) );
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
                        $cabin_price_kit = get_post_meta( get_the_ID(), 'cabin_price_kit', true);
                        if(isset($cabin_price_kit) && !empty($cabin_price_kit)){
                        echo '<li><span class="icon">'. hytteguiden_icon( 'tag.svg', $alt = 'Hytte Pris' ).'</span>'.hytteguiden_price($cabin_price_kit).'kr</li>';
                      }
                        $cabin_build_area = get_post_meta( get_the_ID(), 'cabin_build_area', true);
                        if(isset($cabin_build_area) && !empty($cabin_build_area)){
                        echo '<li><span class="icon">'. hytteguiden_icon( 'scale.svg', $alt = 'Hytte STØRRELSE ' ).'</span>'.hytteguiden_price($cabin_build_area).'m<sup>2</sup></li>';
                      }

                      ?>
                  </ul>
                </div>
              </div>
            </div>
          <?php endforeach;
          wp_reset_postdata(); ?>

          </div>
        </div>
      <?php } ?>
      </div>
    </div>
  </aside>
