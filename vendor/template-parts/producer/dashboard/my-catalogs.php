<?php $current_producer_id =  $GLOBALS['current_producer_id']; ?>
<div class="dboardblock">
    <div class="dboardtitle">
        <h5 class="titletype"><?php _e('Kataloger', 'hytteguiden'); ?></h5>
        <div class="dboardcontrol">
            <a href="<?php echo esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['producerupdatekataloger_page']. '/?mode=add'; ?>" class="btn btn-xs"><i class="fa fa-plus"></i><?php _e('Legg til', 'hytteguiden'); ?></a>
        </div>
    </div>
    <div class="dboardcontent nopad">
        <div class="table-responsive">
        <?php 
            global $post;

            $args = array(
                'meta_query'=> array(
                    array(
                    'key' => '_catalogs_producer_id',
                    'compare' => '=',
                    'value' =>  $current_producer_id,
                    )
                ),
                'numberposts' => 3,
                'post_type' => 'kataloger',
                'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'),
            );

            $mykatalogers = get_posts( $args );
            if($mykatalogers){
            
        ?>
            <table class="table table-borderless table-dboard">
                <thead class="thead-light">
                    <tr>
                        <th><?php _e('Navn', 'hytteguiden'); ?></th>
                        <th><?php _e('Status', 'hytteguiden'); ?></th>
                        <th><?php _e('Bestillinger', 'hytteguiden'); ?></th>
                        <th class="action2"><?php _e('Handling', 'hytteguiden'); ?></th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach( $mykatalogers as $post ) :
                setup_postdata($post);
              ?>
                    <tr>
                        <td><a href="#"><?php echo get_the_title($post->ID); ?></a></td>
                        <td><?php echo hytteguiden_post_status( $post->ID ); ?></td>
                        <td>
                            <?php 
                            $cond .= " AND kataloger_id=". $post->ID;
                            $total_records = hytte_record_count('kataloger', $cond);  
                            echo $total_records;
                            ?>
                        </td>
                        <td>
                        <a href="<?php echo esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['producerupdatekataloger_page']. '/?mode=edit&id='. $post->ID; ?>" >
                            <span class="btn btn-secondary btn-xs"><i class="far fa-edit"></i><span class="hide-sm-down"></span></span> </a>
                            <a href="<?php echo esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['producerkataloger_page']. '/?mode=delete&id='. $post->ID; ?>" onclick="return confirm('Er du sikker på at du vil slette?')">
                            <span class="btn btn-danger btn-xs"><i class="fa fa-times"></i><span class="hide-sm-down"></span></span> </a>
                        </td>
                    </tr>
                <?php endforeach;
                wp_reset_postdata(); ?>
                </tbody>
            </table>
            <?php } ?>
        </div>
    </div>
</div>