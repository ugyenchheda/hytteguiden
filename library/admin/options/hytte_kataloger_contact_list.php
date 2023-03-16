<?php
global $wpdb; 
$msg = '';
$page = isset($_REQUEST['page'])?$_REQUEST['page']:'';
$mode = isset($_REQUEST['mode'])?$_REQUEST['mode']:'';

if( $mode == 'delete' ){    
    hytte_delete_record( 'kataloger_orders', 'id', $_REQUEST[pid]);
    $msg = __('Opptaket er slettet.', 'hytteguiden');
} 

if( $mode == 'status' ){    
    hytte_update_field( 'kataloger_orders', 'order_status', 'Sent', 'id', $_REQUEST[pid]);
    $msg = __('Bestillingsstatus er oppdatert.', 'hytteguiden');
} 

?>
<div id="wrap">
  <div class="wrap">
    <h2><img src="<?php echo get_template_directory_uri()."/library/admin/assets/images/theme_setting.png"; ?>">
			 <?php _e('Kataloger Bestilling', 'hytteguiden'); ?></h2>
  </div>

<?php
  if(!empty($msg)){
    echo '<div class="wrap"><div id="message" class="updated" style="margin-left:0;">';
    echo '<p>'.$msg.'</p>';
    echo '</div></div>';
  }

  require get_template_directory() . '/library/admin/options/admin-nav.php';

  // Global settings 
  $per_page = 10;
  $page_number = 1; 
  
  if ( ! empty( $_REQUEST['page_number'] ) ) {
    $page_number = $_REQUEST['page_number'];
  }


  $cond = '';
  if ( ! empty( $_REQUEST['producer_id'] ) ) {
       $cond .= ' AND producer_id = ' . esc_sql( $_REQUEST['producer_id'] );
  }


  ?>
    <div class="wrap">

    <p class="search-box">
    <form class="hytte_admin_search" action="" method="get">
    <input type="hidden" id="page" name="page" value="<?php echo $page;?>">
	
    <select name="producer_id">
    <option value=""><?php _e( 'Alle Produsenter', 'hytteguiden' ); ?></option>
    <?php 
    global $post;

    $args = array(
     'numberposts' => -1,
     'post_type' => 'producer'
      );
    
    $myposts = get_posts( $args );
    if($myposts){
        foreach( $myposts as $post ) :
            setup_postdata($post);
        
            echo '<option value="'. $post->ID.'"';

            if( isset( $_REQUEST['producer_id']) && $_REQUEST['producer_id'] == $post->ID){
                echo ' selected="selected"';
            }

            echo '>'. get_the_title($post->ID).'</option>';

        endforeach;
    }
    ?>
    </select>
	<input type="submit" id="search-submit" class="button" value="Search">
    </form>
    </p>

    <table width="100%" class="wp-list-table widefat fixed striped pages">
        <thead>
            <tr>
                <th width="8%">#</th>
                <th width="15%"><?php _e( 'Kataloger Navn', 'hytteguiden' ); ?> </th>  
                <th width="20%"><?php _e( 'Produsenter', 'hytteguiden' ); ?> </th>             
                <th width="20%"><?php _e( 'Sporingskode', 'hytteguiden' ); ?></th>               
                <th width="15%"><?php _e( 'Ordre Status', 'hytteguiden' ); ?></th>
                <th width="15%"><?php _e( 'Bestilling Dato', 'hytteguiden' ); ?></th>
                <th width="10%"><?php _e( 'kontakt til brukeren', 'hytteguiden' ); ?></th>
                <th width="15%"><?php _e( 'Action', 'hytteguiden' ); ?></th>
            </tr>
        </thead>
        <tbody>

  <?php  

$sql = 'SELECT kodr.id AS id, kodr.kataloger_id AS kataloger_id, kodr.producer_id AS producer_id, kodr.order_status AS order_status, kodr.order_date AS order_date, kodr.tracking_code AS tracking_code, kodr.contact_producer AS contact_producer, adr.address AS catalog_address, adr.full_name AS full_name, adr.postal_name AS postal_name, adr.city AS city, adr.zip_code AS zip_code, adr.country_code AS country_code, adr.phone_number AS phone_number, adr.email_address AS email_address
  FROM ' . $wpdb->prefix . 'kataloger_orders as kodr inner join ' . $wpdb->prefix . 'address as adr on kodr.address_id = adr.id WHERE 1 = 1 ';  

if(isset($_REQUEST['producer_id']) && !empty($_REQUEST['producer_id'])){
    $sql .= ' AND kodr.producer_id =' .  $_REQUEST['producer_id'];
    $cond = ' AND producer_id =' .  $_REQUEST['producer_id'];
}

$sql .= ' ORDER BY kodr.id desc';
$sql .= ' LIMIT '. $per_page;
$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;

//echo $sql;

$result = $wpdb->get_results( $sql );


  if( $result ) {
    $count = 1;
    $class = '';
    foreach( $result as $entry ) {
        $class = ($count%2 == 1 ? 'class="alternate "' : ''); 
        $thickbox_title = $entry->con_name .' on '. get_the_title($entry->post_id);
    ?>
    <tr <?php echo $class; ?>>
        <td><?php echo $count;  ?></td>
        <td><?php echo get_the_title($entry->kataloger_id); ?></td> 
        <td><?php echo get_the_title($entry->producer_id); ?></td>               
        <td><?php echo $entry->tracking_code; ?></td>         
        <td><?php echo $entry->order_status; ?></td> 
        <td><?php echo stripslashes($entry->order_date); ?></td> 
        <td><?php echo $entry->contact_producer; ?></td> 
        
        <td>
        <a href="#TB_inline?&width=350&height=500&inlineId=my-content-id" class="thickbox" title="Bestillingsdetaljer"><?php _e( 'Utsikt', 'hytteguiden' ); ?> </a>  |  
        <a href="<?php echo $_SERVER["PHP_SELF"]?>?page=<?php echo $page;?>&pid=<?php echo $entry->id;?>&mode=status" 
        onclick="return confirm('Er du sikker på at du vil endre status?')"><?php _e( 'Endre status', 'hytteguiden' ); ?>  </a> |
        <a href="<?php echo $_SERVER["PHP_SELF"]?>?page=<?php echo $page;?>&pid=<?php echo $entry->id;?>&mode=delete" onclick="return confirm('Er du sikker på at du vil slette?')"><?php _e( 'Slette', 'hytteguiden' ); ?> </a></td>
    </tr> 
    <div id="my-content-id" style="display:none;">
    <h3><?php _e( 'Kataloger Bestilling', 'hytteguiden' ); ?></h3>
      <hr>
      <p>
      <?php 
        if(!empty($entry->kataloger_id)){  ?>
        <p>
          <?php _e( 'Kataloger Navn', 'hytteguiden' ); ?> :- <strong><?php echo get_the_title($entry->kataloger_id); ?></strong>
        </p>
        <?php }
      ?>      
      
      <?php 
        if(!empty($entry->producer_id)){  ?>
        <p>
           <?php _e( 'Produsenter', 'hytteguiden' ); ?> :- <strong><?php echo get_the_title($entry->producer_id); ?> </strong>      
           </p>
        <?php }        
      ?>     
      
      <?php 
        if(!empty($entry->tracking_code)){  ?>
        <p>
           <?php _e( 'Sporingskode', 'hytteguiden' ); ?> :- <strong><?php echo $entry->tracking_code; ?> </strong>       
        </p>
        <?php }
      ?>     
      
      <?php 
        if(!empty($entry->order_status)){  ?>
        <p>
          <?php _e( 'Ordre Status', 'hytteguiden' ); ?> :- <strong><?php echo $entry->order_status; ?></strong>
          </p>
        <?php }
      ?>      
      
      <?php 
        if(!empty($entry->order_date)){  ?>
        <p>
         <?php _e( 'Bestilling Dato', 'hytteguiden' ); ?> :- <strong><?php echo stripslashes($entry->order_date); ?></strong>
        </p>
        <?php }
      ?>     
      
      <?php 
        if(!empty($entry->contact_producers)){  ?>
        <p>
         <?php _e( 'kontakt til brukeren', 'hytteguiden' ); ?> :- <strong><?php echo $entry->contact_producer; ?></strong>
         </p>
        <?php }
      ?>     

      <h3><?php _e( 'Kataloger Adresse', 'hytteguiden' ); ?></h3>
      <hr>
      
      <?php 
        if(!empty($entry->full_name)){  ?>
        <p>
          <?php _e( 'Navn', 'hytteguiden' ); ?> :- <strong><?php echo $entry->full_name; ?></strong>
        </p>
        <?php }
      ?>     
      
      <?php 
        if(!empty($entry->postal_name)){  ?>
        <p>
         <?php _e( 'Postnavn', 'hytteguiden' ); ?> :- <strong><?php echo $entry->postal_name; ?></strong>
        </p>
        <?php }
      ?> 
      <?php 
        if(!empty($entry->city)){  ?>
        <p>
         <?php _e( 'By', 'hytteguiden' ); ?> :- <strong><?php echo $entry->city; ?></strong>
         </p>
        <?php }
      ?>       
      
      <?php 
        if(!empty($entry->zip_code)){  ?>
        <p>
          <?php _e( 'Post Kode', 'hytteguiden' ); ?> :- <strong><?php echo $entry->zip_code; ?> </strong>    
        </p>  
        <?php }
      ?>

     <?php 
        if(!empty($entry->catalog_address)){  ?>
        <p> 
          <?php _e( 'Kataloger Adresse', 'hytteguiden' ); ?> :- <strong><?php echo $entry->catalog_address; ?> </strong>     
        </p>
        <?php }
      ?> 
      
      
      <?php 
        if(!empty($entry->phone_number)){  ?>
        <p>
          <?php _e( 'Telefonnummer', 'hytteguiden' ); ?> :- <strong><?php echo $entry->phone_number; ?></strong>
        </p>
        <?php }
      ?>
      
      
      <?php 
        if(!empty($entry->email_address)){  ?>
        <p> 
          <?php _e( 'Epostadresse', 'hytteguiden' ); ?> :- <strong><?php echo $entry->email_address; ?></strong>
        </p>
        <?php }
      ?> 
      
      
    </div>

    <?php $count++;
    }

  } else{
    _e( '<tr><td colspan="7"><p>Ingen data tilgjengelig.</p></td></tr>', 'hytteguiden' );
  }

?>
            </tbody>
            <tfoot>
                <tr>
                <th width="8%">#</th>
                <th width="15%"><?php _e( 'Kataloger Navn', 'hytteguiden' ); ?> </th>  
                <th width="20%"><?php _e( 'Produsenter', 'hytteguiden' ); ?> </th>             
                <th width="20%"><?php _e( 'Sporingskode', 'hytteguiden' ); ?></th>               
                <th width="15%"><?php _e( 'Ordre Status', 'hytteguiden' ); ?></th>
                <th width="15%"><?php _e( 'Bestilling Dato', 'hytteguiden' ); ?></th>
                <th width="10%"><?php _e( 'kontakt til brukeren', 'hytteguiden' ); ?></th>
                <th width="15%"><?php _e( 'Action', 'hytteguiden' ); ?></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <?php  
  
$total_records = hytte_record_count('kataloger_orders', $cond);  
$total_pages = ceil($total_records / $per_page);  
$pagLink = "<div class='hytte_pagination'><ul>";  
for ($i=1; $i<=$total_pages; $i++) {  
             $pagLink .= "<li><a href='" .  $_SERVER["PHP_SELF"] . "?page=".  $page . "&page_number=".$i."'>".$i."</a></li>";  
};  
echo  $pagLink;
echo "</ul></div>";  
?>


</div>
