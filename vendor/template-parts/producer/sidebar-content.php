  <aside class="aside">
    <div class="row">

  <?php $cabin_producer_id = get_post_meta( get_the_ID(), 'cabin_producer_id', true);
    if(isset($cabin_producer_id) && !empty($cabin_producer_id)){
      ?>
            
      <div class="col-12 col-md-6 col-lg-12">
        <div class="asideblock sellercontact">
          <?php
            if ( has_post_thumbnail( $cabin_producer_id ) ) {
                echo '<div class="producerlogo">';
                echo '<a href="'.get_permalink($cabin_producer_id).'">';
                echo get_the_post_thumbnail( $cabin_producer_id, 'full','', array( "class" => "img-fluid" ) );
                echo '</a>';
                echo '</div>';
              }
          ?>
          <h4 class="subtitle"><span><?php _e( 'Kontakt Oss', 'hytteguiden') ?></span></h4>
          <ul>
              <?php
                /* website Phone*/
                $producer_website = get_post_meta( $cabin_producer_id, 'producer_website', true);
                if(isset($producer_website) && !empty($producer_website)){
                  echo '<li>'.__('Nettside', 'hytteguiden').'</li>
                  <li><a href="'.$producer_website.'">'.$producer_website.'</a></li>';
                  }

                /* Producer Phone*/
                $producer_contact_phone_1 = get_post_meta( $cabin_producer_id, 'producer_contact_phone_1', true);
                if(isset($producer_contact_phone_1) && !empty($producer_contact_phone_1)){
                  echo '<li>'.__('Telefon', 'hytteguiden').'</li>
                  <li><a href="tel:'. hytteguiden_format_phone($producer_contact_phone_1).'">'. hytteguiden_format_phone($producer_contact_phone_1).'</a></li>';
                  }

                /* Producer Email*/
                $producer_email = get_post_meta( $cabin_producer_id, 'producer_email', true);
                if(isset($producer_email) && !empty($producer_email)){
                  echo '<li>'.__('E-post', 'hytteguiden').'</li>
                  <li><a href="mailto:'.$producer_email.'">'.$producer_email.'</a></li>';
                  }
              ?>
          </ul>

          <?php
           $cabin_kataloger = get_post_meta(get_the_ID(), 'cabin_kataloger', true);
           echo hytteguiden_cabin_kataloger_status($cabin_kataloger, $cabin_producer_id); ?>         

        </div>
      </div>
    <?php } ?>
            <div class="col-12 col-md-6 col-lg-12">
              <div class="asideblock sellercontactform">
              <?php
               // if ( has_post_thumbnail( $cabin_producer_id ) ) {
                  //  echo '<div class="producerlogo">';
                  //  echo '<a href="'.get_permalink($cabin_producer_id).'">';
                  //  echo get_the_post_thumbnail( $cabin_producer_id, 'full','', array( "class" => "img-fluid" ) );
                  //  echo '</a>';
                  //  echo '</div>';
                 // }
             // ?>
                  <div class="forminfo">
                  <h4 class="subtitle"><span><?php _e( 'KONTAKT PRODUSENTEN', 'hytteguiden') ?></span></h4>
                    <!-- <p><?php //_e( 'Lorem ipsum dolor sit amet.', 'hytteguiden') ?></p> -->
                    </div>
                        <?php get_template_part( 'template-parts/cabins/cabin', 'contact_form' ); ?>
                        <?php get_template_part( 'template-parts/cabins/catalog', 'form' ); ?>

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
 'posts_per_page' => 3,
 'post_type' => 'cabin',
  'post__not_in' => array( get_the_ID() ),
  );

$myposts = get_posts( $args );
if($myposts){

?>

      <div class="col-12 col-md-12 col-lg-12">
        <div class="asideblock">
        <h4 class="subtitle"><span><?php _e( 'PRODUSENTENS ANDRE HYTTER', 'hytteguiden') ?></span></h4>
         
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
                        $cabin_price_turnkey = get_post_meta( get_the_ID(), 'cabin_price_turnkey', true);
                        if(isset($cabin_price_turnkey) && !empty($cabin_price_turnkey)){
                        echo '<li><span class="icon"><span class="icon-tag"></span></span>'.hytteguiden_price($cabin_price_turnkey).'kr</li>';
                      }
                        $cabin_build_area = get_post_meta( get_the_ID(), 'cabin_build_area', true);
                        if(isset($cabin_build_area) && !empty($cabin_build_area)){
                        echo '<li><span class="icon"><span class="icon-scale"></span></span></span>'.hytteguiden_price($cabin_build_area).'m<sup>2</sup></li>';
                      }

                      ?>
                  </ul>
                </div>
              </div>
            </div>
          <?php endforeach;
          wp_reset_postdata(); ?>

          </div>
          <div class="se_flere">
            <a href="<?php echo get_permalink($cabin_producer_id).'#related_pro';?>"><?php _e('Se flere', 'hytteguiden')?></a>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
  </aside>
