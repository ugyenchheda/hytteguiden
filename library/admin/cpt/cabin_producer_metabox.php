<?php add_action('add_meta_boxes', 'hytteguiden_add_custom_post_meta' );

function hytteguiden_add_custom_post_meta(){
    add_meta_box('tr_cpt_id','Hyttemodeller', 'hytteguiden_cabin_list_data' ,'producer','normal','high');
}

function hytteguiden_cabin_list_data( $post ){
  $post_id = $post->ID;
  $args = array(
       'post_type' 	=> 'cabin',
       'showposts'   => -1,
       'meta_query'  => array(
                             array(
                               'key'     => 'cabin_producer_id',
                               'value'   => $post_id,
                             ),
                           ),
     );


 $myposts = get_posts( $args );
 ?><div style="width:100%;">
   <table cellpadding="0" class="cabin_row_table" cellspacing="6" border="0" width="100%">
     <?php 	if ( $myposts ) { ?>
     <thead class="text-center thead-bg">
       <tr class="tr-background">
         <th class="table-head"><?php _e('Cabin Name', 'hytteguiden');?></th>
         <th class="table-head"><?php _e('Nøkkelferdig', 'hytteguiden');?></th>
         <th class="table-head"><?php _e('Byggesett', 'hytteguiden');?></th>
         <th class="table-head"><?php _e('BRA', 'hytteguiden');?></th>
         <th class="table-head"><?php _e('BYA', 'hytteguiden');?></th>
       </tr>
     </thead>

     <tbody>
       <?php foreach( $myposts as $post ) :
              setup_postdata($post); ?>
         <tr class="meta-table">
           <td><?php edit_post_link(get_the_title($post->ID), '<p>', '</p>'); ?></td>
           <td>
             <?php
              $cabin_price_kit = get_post_meta( $post->ID, 'cabin_price_kit', true);
              if(isset($cabin_price_kit) && !empty($cabin_price_kit)){
                  echo '<p><span class="value">'.$cabin_price_kit.'kr</span></p>';
              }
            ?>
        </td>
        <td>
          <?php
           $cabin_price_turnkey = get_post_meta( $post->ID, 'cabin_price_turnkey', true);
           if(isset($cabin_price_turnkey) && !empty($cabin_price_turnkey)){
             echo '<p><span class="value">'.$cabin_price_turnkey.'kr</span></p>';
           }
          ?>
        </td>
           <td>
             <?php
             $cabin_build_area = get_post_meta( $post->ID, 'cabin_build_area', true);
            if(isset($cabin_build_area) && !empty($cabin_build_area)){
              echo '<p><span class="value">'.$cabin_build_area.'m<sup>2</sup></span></p>';
            }
             ?>
           </td>
           <td>
             <?php
             $cabin_gross_area = get_post_meta( $post->ID, 'cabin_gross_area', true);
             if(isset($cabin_gross_area) && !empty($cabin_gross_area)){
               echo '<p><span class="value">'.$cabin_gross_area.'m<sup>2</sup></span></p>';
             }
             ?>
           </td>

           <?php endforeach; ?>
         </tbody>

         <?php } else {
         echo '<tr><td clospan="5">No Trade Interest found for this post.</td></tr>';
         }
         wp_reset_postdata();

         ?>
         </table>
         </div>
<?php } ?>
