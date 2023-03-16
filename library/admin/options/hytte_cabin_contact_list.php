<?php
global $wpdb; 
$msg = '';
$page = isset($_REQUEST['page'])?$_REQUEST['page']:'';
$mode = isset($_REQUEST['mode'])?$_REQUEST['mode']:'';

if( $mode == 'delete' ){
    
    hytte_delete_record( 'contact_producer', 'id', $_REQUEST[pid]);
    $msg = __('Record has been deleted.', 'hytteguiden');
} 

?>
<div id="wrap">
  <div class="wrap">
    <h2><img src="<?php echo get_template_directory_uri()."/library/admin/assets/images/theme_setting.png"; ?>">
			 <?php _e('Hytte Kontakt', 'hytteguiden'); ?></h2>
  </div>

<?php
  if(!empty($msg)){
    echo '<div class="wrap"><div id="message" class="updated" style="margin-left:0;">';
    echo '<p>'.$msg.'</p>';
    echo '</div></div>';
  }

  require get_template_directory() . '/library/admin/options/admin-nav.php';

  // Global settings 
  $per_page = 5;
  $page_number = 1; 
  
  if ( ! empty( $_REQUEST['page_number'] ) ) {
    $page_number = $_REQUEST['page_number'];
  }


  $cond = '';
  if ( ! empty( $_REQUEST['cabin_id'] ) ) {
       $cond .= ' AND post_id = ' . esc_sql( $_REQUEST['cabin_id'] );
  }

  if ( ! empty( $_REQUEST['q'] ) ) {
    $cond .= ' AND (con_name LIKE "%' . esc_sql( $_REQUEST['q'] ).'%" OR con_email LIKE "%' . esc_sql( $_REQUEST['q'] ).'%")';
}

  ?>
    <div class="wrap">

    <p class="search-box">
    <form class="hytte_admin_search" action="" method="get">
    <input type="hidden" id="page" name="page" value="<?php echo $page;?>">
	<input type="search" id="post-search-input" name="q" value="<?php if ( ! empty( $_REQUEST['q'] ) ) { echo $_REQUEST['q']; } ?>" placeholder="E-post eller Navn ">    

    <select name="cabin_id">
    <option value=""><?php _e( 'Alle Hytter', 'hytteguiden' ); ?></option>
    <?php 
    global $post;

    $args = array(
     'numberposts' => -1,
     'post_type' => 'cabin'
      );
    
    $myposts = get_posts( $args );
    if($myposts){
        foreach( $myposts as $post ) :
            setup_postdata($post);
        
            echo '<option value="'. $post->ID.'"';

            if( isset( $_REQUEST['cabin_id']) && $_REQUEST['cabin_id'] == $post->ID){
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
                <th width="13%">#</th>
                <th width="15%"><?php _e( 'Navn', 'hytteguiden' ); ?> </th>
                <th width="20%"><?php _e( 'Epost', 'hytteguiden' ); ?></th>
                <th width="15%"><?php _e( 'Hytte', 'hytteguiden' ); ?></th>
                <th width="15%"><?php _e( 'Dato', 'hytteguiden' ); ?></th>
                <th width="22%"><?php _e( 'Action', 'hytteguiden' ); ?></th>
            </tr>
        </thead>
        <tbody>

  <?php  
  $result = hytte_all_data( 'contact_producer', $cond, $per_page, $page_number);

  if( $result ) {
    $count = 1;
    $class = '';
    foreach( $result as $entry ) {
        $class = ($count%2 == 1 ? 'class="alternate "' : ''); 
        $thickbox_title = $entry->con_name .' on '. get_the_title($entry->post_id);
    ?>
    <tr <?php echo $class; ?>>
        <td><?php echo $count;  ?></td>
        <td><?php echo stripslashes($entry->con_name); ?></td> 
        <td><?php echo stripslashes($entry->con_email); ?></td> 
        <td><?php 
            if(!empty($entry->post_id)){
                echo get_the_title($entry->post_id);
            }
         ?></td> 
        <td><?php echo stripslashes($entry->con_date); ?></td> 
        
        <td> <a  href="#TB_inline?width=600&height=550&inlineId=thickbox_<?php echo $entry->post_id; ?>" title="<?php echo $thickbox_title; ?>" class="thickbox">View</a> | 
        <a href="<?php echo $_SERVER["PHP_SELF"]?>?page=<?php echo $page;?>&pid=<?php echo $entry->id;?>&mode=delete" onclick="return confirm('Are you sure you want to delete?')">Delete </a></td>
    </tr> 

    <div id="thickbox_<?php echo $entry->post_id;  ?>" style="display:none;">
    <p> <strong><?php _e( 'Navn', 'hytteguiden' ); ?> : </strong>  <?php echo stripslashes($entry->con_name); ?></p> 
    <p> <strong><?php _e( 'Epost', 'hytteguiden' ); ?> : </strong>  <?php echo stripslashes($entry->con_email); ?></p> 
    <p> <strong><?php _e( 'Telefon', 'hytteguiden' ); ?> : </strong>  <?php echo stripslashes($entry->con_phone); ?></p> 
    <p> <strong><?php _e( 'SpØrsmal', 'hytteguiden' ); ?> : </strong>  <?php echo stripslashes($entry->con_message); ?></p> 
    <p> <strong><?php _e( 'Hytte', 'hytteguiden' ); ?> : </strong>  <?php echo get_the_title($entry->post_id); ?></p> 
    <p> <strong><?php _e( 'IP Address', 'hytteguiden' ); ?> : </strong>  <?php echo stripslashes($entry->ip_address); ?></p> 
    <p> <strong><?php _e( 'Dato', 'hytteguiden' ); ?> : </strong>  <?php echo stripslashes($entry->con_date); ?></p> 


    </div>
    <?php $count++;
    }

  } else{
    _e( '<tr><td colspan="6"><p>No data avaliable.</p></td></tr>', 'hytteguiden' );
  }

?>
            </tbody>
            <tfoot>
                <tr>
                <th width="13%">#</th>
                <th width="15%"><?php _e( 'Navn', 'hytteguiden' ); ?> </th>
                <th width="20%"><?php _e( 'Epost', 'hytteguiden' ); ?></th>
                <th width="15%"><?php _e( 'Hytte', 'hytteguiden' ); ?></th>
                <th width="15%"><?php _e( 'Dato', 'hytteguiden' ); ?></th>
                <th width="22%"><?php _e( 'Action', 'hytteguiden' ); ?></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <?php  
  
$total_records = hytte_record_count('contact_producer', $cond);  
$total_pages = ceil($total_records / $per_page);  
$pagLink = "<div class='hytte_pagination'><ul>";  
for ($i=1; $i<=$total_pages; $i++) {  
             $pagLink .= "<li><a href='" .  $_SERVER["PHP_SELF"] . "?page=".  $page . "&page_number=".$i."'>".$i."</a></li>";  
};  
echo  $pagLink;
echo "</ul></div>";  
?>


</div>
