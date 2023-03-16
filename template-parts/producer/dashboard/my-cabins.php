<?php $current_producer_id =  $GLOBALS['current_producer_id']; ?>
<div class="dboardblock">
    <div class="dboardtitle">
        <h5 class="titletype"><?php _e('Hytter', 'hytteguiden'); ?></h5>
        <div class="dboardcontrol">
            <a href="#" class="btn btn-xs"><i class="fa fa-plus"></i> Add</a>
        </div>
    </div>
    <div class="dboardcontent nopad">
        <?php   global $post;
                $args = array(
                    'meta_query'=> array(
                        array(
                        'key' => 'cabin_producer_id',
                        'compare' => '=',
                        'value' =>  $current_producer_id,
                        )
                    ),
                    'numberposts' => -1,
                    'post_type' => 'cabin',
                    'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'),
                );

                $mycabins = get_posts( $args );
                if($mycabins){
        
        ?>
        <div class="table-responsive">
            <table class="table table-borderless table-dboard">
                <thead class="thead-light">
                    <tr>
                    <th><?php _e('Navn', 'hytteguiden'); ?></th>
                    <th><?php _e('Størrelse', 'hytteguiden'); ?></th>
                    <th><?php _e('Pris', 'hytteguiden'); ?></th>
                    <th><?php _e('Status', 'hytteguiden'); ?></th>
                    <th class="action2"><?php _e('Handling', 'hytteguiden'); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach( $mycabins as $post ) :
                setup_postdata($post);
              ?>
                    <tr>
                        <td><a href="<?php echo get_permalink($post->ID); ?>" target="_blank"><?php echo get_the_title($post->ID); ?></a></td>
                        <td>
                        <?php   $cabin_utility_area = get_post_meta( $post->ID, 'cabin_utility_area', true);
                                if(isset($cabin_utility_area) && !empty($cabin_utility_area)){
                                    echo hytteguiden_price($cabin_utility_area) . 'm<sup>2</sup>';
                                }
                        ?></td>
                        <td><?php
								$cabin_price_turnkey = get_post_meta( $post->ID, 'cabin_price_turnkey', true);
								if(isset($cabin_price_turnkey) && !empty($cabin_price_turnkey)){
								    echo hytteguiden_price($cabin_price_turnkey) . 'kr';
							    }
							?></td>
                        <td><?php echo hytteguiden_post_status( $post->ID ); ?></td>
                        <td>
                        
                        <a href="<?php echo esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['producerupdatehytte_page']. '/?mode=edit&id='. $post->ID; ?>" >
                            <span class="btn btn-secondary btn-xs"><i class="far fa-edit"></i><span class="hide-sm-down"> <?php _e('Redigere', 'hytteguiden'); ?></span></span> </a>
                            
                            <a href="<?php echo esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['producerhytter_page']. '/?mode=delete&id='. $post->ID; ?>" onclick="return confirm('Er du sikker på at du vil slette?')">
                            <span class="btn btn-danger btn-xs"><i class="fa fa-times"></i><span class="hide-sm-down"> <?php _e('Slett', 'hytteguiden'); ?></span></span> </a>
         
                        </td>
                    </tr>
                <?php endforeach;
                wp_reset_postdata(); ?>

                    
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>
</div>