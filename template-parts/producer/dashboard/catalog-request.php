<?php $current_producer_id =  $GLOBALS['current_producer_id'];
// Retrive my cabins ids
$cabin_ids = array();
global $post;
global $wpdb;


if( isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'status' ){    
    hytte_update_field( 'kataloger_orders', 'order_status', 'Sent', 'id', $_REQUEST[pid]);
    $msg = __('Bestillingsstatus er oppdatert.', 'hytteguiden');
} 

 ?>
<div class="dboardblock">
    <div class="dboardtitle">
        <h5 class="titletype"><?php _e('Kataloger Forespørsler', 'hytteguiden'); ?></h5>
    </div>
    <div class="dboardcontent nopad">
    <?php 

$sql_prev = 'SELECT kodr.id AS id, kodr.kataloger_id AS kataloger_id, kodr.producer_id AS producer_id, kodr.order_status AS order_status, kodr.order_date AS order_date, kodr.tracking_code AS tracking_code, kodr.contact_producer AS contact_producer, adr.address AS catalog_address, adr.full_name AS full_name, adr.postal_name AS postal_name, adr.city AS city, adr.zip_code AS zip_code, adr.country_code AS country_code, adr.phone_number AS phone_number, adr.email_address AS email_address  FROM ' . $wpdb->prefix . 'kataloger_orders as kodr inner join ' . $wpdb->prefix . 'address as adr on kodr.address_id = adr.id WHERE ';  
			
$sql_prev .= ' kodr.producer_id = '. $current_producer_id; 

$result_prev = $wpdb->get_results( $sql_prev );

        if($result_prev) {
            $cnt = 1; 
    ?>
        <div class="table-responsive">
            <table class="table table-borderless table-dboard">
                <thead class="thead-light">
                <tr>
						<th>#</th>
						<th><?php _e( 'Produsent', 'hytteguiden' ); ?></th>
						<th><?php _e( 'Kataloger', 'hytteguiden' ); ?></th>
						<th><?php _e( 'Sporingskode', 'hytteguiden' ); ?></th>	
                        <th><?php _e( 'Ordre Status', 'hytteguiden' ); ?></th>                        				
                        <th><?php _e( 'Dato ', 'hytteguiden' ); ?><span class="bestilt_remove"><?php _e( 'bestilt', 'hytteguiden' ); ?></span></th>
                        <th><?php _e( 'Handling', 'hytteguiden' ); ?></th> 
					</tr>
                </thead>
                <tbody>
                <?php foreach( $result_prev as $entry_prev ) {
					$kataloger_id = $entry_prev->kataloger_id;
					$producer_id = get_post_meta($kataloger_id, '_catalogs_producer_id', true);
					?>
					<tr>
					<td width="5%"><?php echo $cnt;  ?></td>
					<td><a href="<?php echo get_permalink($producer_id); ?>"><?php echo get_the_title($producer_id); ?></a></td>
					<td><?php echo get_the_title($kataloger_id); ?></td>
					<td><?php echo $entry_prev->tracking_code; ?></td>
                    <td><?php echo $entry_prev->order_status; ?></td>                    
					<td><?php echo date("d/m/Y", strtotime($entry_prev->order_date)); ?></td>
                    <td> <button type="button" class="btn btn-primary cat_btn" data-toggle="modal" data-target="#dboardmodel"><?php _e( 'Utsikt', 'hytteguiden' ); ?></button> | <a href="<?php echo esc_url( home_url( '/' ) ); ?><?php echo $GLOBALS['route_defaults']['mydashboard_page']; ?>/?pid=<?php echo $entry_prev->id;?>&mode=status" 
                        onclick="return confirm('Er du sikker på at du vil endre status?')"><?php _e( 'Endre status', 'hytteguiden' ); ?>  </a>                       
                    </td>
					</tr>
                <?php $cnt++;  } ?>
                   
                </tbody>
            </table>          

            <!-- Modal -->
            <div class="modal fade" id="dboardmodel" tabindex="-1" role="dialog" aria-labelledby="dboardmodelLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dboardmodelLabel"><?php _e( 'Bestillingsdetaljer', 'hytteguiden' ); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <h6><?php _e( 'Kataloger Bestilling', 'hytteguiden' ); ?></h6>
                    <hr>
                    <?php 
                        if(!empty($entry_prev->kataloger_id)){  ?>
                        <p>
                        <?php _e( 'Kataloger Navn', 'hytteguiden' ); ?> :- <strong><?php echo get_the_title($entry_prev->kataloger_id); ?></strong>
                        </p>
                        <?php }
                    ?>      
                    
                    <?php 
                        if(!empty($entry_prev->producer_id)){  ?>
                        <p>
                        <?php _e( 'Produsenter', 'hytteguiden' ); ?> :- <strong><?php echo get_the_title($entry_prev->producer_id); ?> </strong>      
                        </p>
                        <?php }        
                    ?>     
                    
                    <?php 
                        if(!empty($entry_prev->tracking_code)){  ?>
                        <p>
                        <?php _e( 'Sporingskode', 'hytteguiden' ); ?> :- <strong><?php echo $entry_prev->tracking_code; ?> </strong>       
                        </p>
                        <?php }
                    ?>     
                    
                    <?php 
                        if(!empty($entry_prev->order_status)){  ?>
                        <p>
                        <?php _e( 'Ordre Status', 'hytteguiden' ); ?> :- <strong><?php echo $entry_prev->order_status; ?></strong>
                        </p>
                        <?php }
                    ?>      
                    
                    <?php 
                        if(!empty($entry_prev->order_date)){  ?>
                        <p>
                        <?php _e( 'Bestilling Dato', 'hytteguiden' ); ?> :- <strong><?php echo stripslashes($entry_prev->order_date); ?></strong>
                        </p>
                        <?php }
                    ?>     
                    
                    <?php 
                        if(!empty($entry_prev->contact_producers)){  ?>
                        <p>
                        <?php _e( 'kontakt til brukeren', 'hytteguiden' ); ?> :- <strong><?php echo $entry_prev->contact_producer; ?></strong>
                        </p>
                        <?php }
                    ?>     

                    <h6><?php _e( 'Kataloger Adresse', 'hytteguiden' ); ?></h6>
                    <hr>
                    
                    <?php 
                        if(!empty($entry_prev->full_name)){  ?>
                        <p>
                        <?php _e( 'Navn', 'hytteguiden' ); ?> :- <strong><?php echo $entry_prev->full_name; ?></strong>
                        </p>
                        <?php }
                    ?>     
                    
                    <?php 
                        if(!empty($entry_prev->postal_name)){  ?>
                        <p>
                        <?php _e( 'Postnavn', 'hytteguiden' ); ?> :- <strong><?php echo $entry_prev->postal_name; ?></strong>
                        </p>
                        <?php }
                    ?> 
                    <?php 
                        if(!empty($entry_prev->city)){  ?>
                        <p>
                        <?php _e( 'By', 'hytteguiden' ); ?> :- <strong><?php echo $entry_prev->city; ?></strong>
                        </p>
                        <?php }
                    ?>       
                    
                    <?php 
                        if(!empty($entry_prev->zip_code)){  ?>
                        <p>
                        <?php _e( 'Post Kode', 'hytteguiden' ); ?> :- <strong><?php echo $entry_prev->zip_code; ?> </strong>    
                        </p>  
                        <?php }
                    ?>

                    <?php 
                        if(!empty($entry_prev->catalog_address)){  ?>
                        <p> 
                        <?php _e( 'Kataloger Adresse', 'hytteguiden' ); ?> :- <strong><?php echo $entry_prev->catalog_address; ?> </strong>     
                        </p>
                        <?php }
                    ?> 
                    
                    
                    <?php 
                        if(!empty($entry_prev->phone_number)){  ?>
                        <p>
                        <?php _e( 'Telefonnummer', 'hytteguiden' ); ?> :- <strong><?php echo $entry_prev->phone_number; ?></strong>
                        </p>
                        <?php }
                    ?>
                    
                    
                    <?php 
                        if(!empty($entry_prev->email_address)){  ?>
                        <p> 
                        <?php _e( 'Epostadresse', 'hytteguiden' ); ?> :- <strong><?php echo $entry_prev->email_address; ?></strong>
                        </p>
                        <?php }
                    ?> 
                    </div>     
                    </div>
                </div>
            </div>
        </div>
    <?php
        }
 ?>    
    </div>
</div>