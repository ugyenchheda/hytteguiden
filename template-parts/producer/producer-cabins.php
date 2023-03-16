   
    <div class="profiledetail">
        <h4 class="subtitle"><span><?php _e('Hytter', 'hytteguiden')?></span></h4>
        <?php
            global $post;

            $args = array(
            'meta_query'=> array(
                array(
                'key' => 'cabin_producer_id',
                'compare' => '=',
                'value' =>  get_the_ID(),
                )
            ),
            'numberposts' => -1,
            'post_type' => 'cabin',
            );

            $myposts = get_posts( $args );
            if($myposts){

        ?>

        <div class="owl-carousel owl-carousel-2 hasstage">
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
                                echo '<li><span class="icon"><span class="icon-scale"></span></span>'.hytteguiden_price($cabin_build_area).'m<sup>2</sup></li>';
                            }
                                /*Cabin Bedrooms*/
                                $cabin_bedroom = get_post_meta( $post->ID, 'cabin_bedroom', true);
                                  if(isset($cabin_bedroom) && !empty($cabin_bedroom)){
                                  echo '<li><span class="icon"><span class="icon-bed"></span></span>'.$cabin_bedroom.' soverom</li>';
                                 }

                            ?>
                        </ul>
                        </div>
                         <a href="<?php the_permalink(); ?>" class="btn btn-block btn-line-theme1"><?php _e('Les mer ', 'hytteguiden')?> <i class="fa fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
            
            <?php endforeach;
          wp_reset_postdata(); ?>
          
        </div>
        <?php } ?>
    </div>
  