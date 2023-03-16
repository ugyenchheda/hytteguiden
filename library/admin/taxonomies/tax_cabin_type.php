<?php

if ( ! class_exists( 'HytteguidenCabinType' ) ) {

class HytteguidenCabinType {

  public function __construct() {
    //
  }

 /*
  * Initialize the class and start calling our hooks and filters
  * @since 1.0.0
 */
 public function init() {
   add_action( 'cabin_type_add_form_fields', array ( $this, 'add_cabin_type_image' ), 10, 2 );
   add_action( 'created_cabin_type', array ( $this, 'save_cabin_type_image' ), 10, 2 );
   add_action( 'cabin_type_edit_form_fields', array ( $this, 'update_cabin_type_image' ), 10, 2 );
   add_action( 'edited_cabin_type', array ( $this, 'updated_cabin_type_image' ), 10, 2 );
   add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
   add_action( 'admin_footer', array ( $this, 'add_script' ) );
 }

 public function load_media() {
   if( ! isset( $_GET['taxonomy'] ) || $_GET['taxonomy'] != 'cabin_type' ) {
     return;
   }
   wp_enqueue_media();
 }
 /*
  * Add a form field in the new cabin_type page
  * @since 1.0.0
 */
 public function add_cabin_type_image ( $taxonomy ) { ?>
   <div class="form-field term-group">
     <label for="cabin_type_image_id"><?php _e('Image', 'hero-theme'); ?></label>
     <input type="hidden" id="cabin_type_image_id" name="cabin_type_image_id" class="custom_media_url" value="">
     <div id="cabin_type-image-wrapper"></div>
     <p>
       <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
       <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
    </p>
   </div>
 <?php
 }

 /*
  * Save the form field
  * @since 1.0.0
 */
 public function save_cabin_type_image ( $term_id, $tt_id ) {
   if( isset( $_POST['cabin_type_image_id'] ) && '' !== $_POST['cabin_type_image_id'] ){
     $image = $_POST['cabin_type_image_id'];
     add_term_meta( $term_id, 'cabin_type_image_id', $image, true );
   }
 }

 /*
  * Edit the form field
  * @since 1.0.0
 */
 public function update_cabin_type_image ( $term, $taxonomy ) { ?>
   <tr class="form-field term-group-wrap">
     <th scope="row">
       <label for="cabin_type_image_id"><?php _e( 'Image', 'hero-theme' ); ?></label>
     </th>
     <td>
       <?php $image_id = get_term_meta ( $term -> term_id, 'cabin_type_image_id', true ); ?>
       <input type="hidden" id="cabin_type_image_id" name="cabin_type_image_id" value="<?php echo $image_id; ?>">
       <div id="cabin_type-image-wrapper">
         <?php if ( $image_id ) { ?>
           <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
         <?php } ?>
       </div>
       <p>
         <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
         <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
       </p>
     </td>
   </tr>
 <?php
 }

/*
 * Update the form field value
 * @since 1.0.0
 */
 public function updated_cabin_type_image ( $term_id, $tt_id ) {
   if( isset( $_POST['cabin_type_image_id'] ) && '' !== $_POST['cabin_type_image_id'] ){
     $image = $_POST['cabin_type_image_id'];
     update_term_meta ( $term_id, 'cabin_type_image_id', $image );
   } else {
     update_term_meta ( $term_id, 'cabin_type_image_id', '' );
   }
 }

/*
 * Add script
 * @since 1.0.0
 */
 public function add_script() {
   if( ! isset( $_GET['taxonomy'] ) || $_GET['taxonomy'] != 'cabin_type' ) {
    return;
  }
    ?>
   <script>
     jQuery(document).ready( function($) {
       function ct_media_upload(button_class) {
         var _custom_media = true,
         _orig_send_attachment = wp.media.editor.send.attachment;
         $('body').on('click', button_class, function(e) {
           var button_id = '#'+$(this).attr('id');
           var send_attachment_bkp = wp.media.editor.send.attachment;
           var button = $(button_id);
           _custom_media = true;
           wp.media.editor.send.attachment = function(props, attachment){
             if ( _custom_media ) {
               $('#cabin_type_image_id').val(attachment.id);
               $('#cabin_type-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
               $('#cabin_type-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
             } else {
               return _orig_send_attachment.apply( button_id, [props, attachment] );
             }
            }
         wp.media.editor.open(button);
         return false;
       });
     }
     ct_media_upload('.ct_tax_media_button.button');
     $('body').on('click','.ct_tax_media_remove',function(){
       $('#cabin_type_image_id').val('');
       $('#cabin_type-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
     });

     $(document).ajaxComplete(function(event, xhr, settings) {
       var queryStringArr = settings.data.split('&');
       if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
         var xml = xhr.responseXML;
         $response = $(xml).find('term_id').text();
         if($response!=""){
           // Clear the thumb image
           $('#cabin_type-image-wrapper').html('');
         }
       }
     });
   });
 </script>
 <?php }

  }

$hytteguiden_ct_cabin_type = new HytteguidenCabinType();
$hytteguiden_ct_cabin_type->init();

}

?>
