<?php $current_producer_id =  $GLOBALS['current_producer_id'];
// Retrive my cabins ids
$cabin_ids = array();
global $post;
global $wpdb;
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
    foreach( $mycabins as $post ) :
        setup_postdata($post);
        $cabin_ids[] = $post->ID;
    endforeach;
    wp_reset_postdata();
}

 ?>
<div class="dboardblock">
    <div class="dboardtitle">
        <h5 class="titletype"><?php _e('Kontakt Produsenter', 'hytteguiden'); ?></h5>
    </div>
    <div class="dboardcontent nopad">
    <?php 
    if($cabin_ids){ 
        $sql = 'SELECT * FROM ' . $wpdb->prefix . 'contact_producer WHERE 1= 1'; 

        $cabin_ids_comma_sep =  implode(",",$cabin_ids);

        $sql .= ' AND post_id IN ('. $cabin_ids_comma_sep . ')';

        $result = $wpdb->get_results( $sql );
        if($result) {
    ?>
        <div class="table-responsive">
            <table class="table table-borderless table-dboard">
                <thead class="thead-light">
                    <tr>
                        <th><?php _e( 'Navn', 'hytteguiden' ); ?> </th>
                        <th><?php _e( 'Epost', 'hytteguiden' ); ?></th>
                        <th><?php _e( 'Hytte', 'hytteguiden' ); ?></th>
                        <th><?php _e( 'Dato', 'hytteguiden' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach( $result as $entry ) { ?>
                    <tr>
                        <td><?php echo stripslashes($entry->con_name); ?></td> 
                        <td><?php echo stripslashes($entry->con_email); ?></td> 
                        <td><?php 
                            if(!empty($entry->post_id)){
                                echo get_the_title($entry->post_id);
                            }
                        ?></td> 
                        <td><?php echo stripslashes($entry->con_date); ?></td> 
                    </tr>
                <?php } ?>
                   
                </tbody>
            </table>
        </div>
    <?php
        }
} ?>    
    </div>
</div>