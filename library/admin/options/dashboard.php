<?php global $wpdb;
$msg = '';
$slider_defaults = array(
  'slider_min_price' => '0',
  'slider_max_price' => '5000000',
  'slider_min_size' => '0',
  'slider_max_size' => '10000',
  'slider_min_beds' => '0',
  'slider_max_beds' => '15',
); 

$hytte_form_slider_ranges = array(
          array( 
                'label' => __('Pris(min)', 'hytteguiden' ),
                'id' => 'slider_min_price',
                'placeholder' => __('Enter min value for price range', 'hytteguiden' ),
            ),
          array( 
                'label' => __('Pris(max)', 'hytteguiden' ),
                'id' => 'slider_max_price',
                'placeholder' => __('Enter max value for price range', 'hytteguiden' ),
            ),

          array( 
              'label' => __('StØrrelse(min)', 'hytteguiden' ),
              'id' => 'slider_min_size',
              'placeholder' => __('Enter min value for size range', 'hytteguiden' ),
            ),
          array( 
            'label' => __('StØrrelse(max)', 'hytteguiden' ),
            'id' => 'slider_max_size',
            'placeholder' => __('Enter max value for size range', 'hytteguiden' ),
          ),

          array( 
            'label' => __('Sengeplasser(min)', 'hytteguiden' ),
            'id' => 'slider_min_beds',
            'placeholder' => __('Enter min value for beds range', 'hytteguiden' ),
          ),
          array( 
            'label' => __('Sengeplasser(max)', 'hytteguiden' ),
            'id' => 'slider_max_beds',
            'placeholder' => __('Enter max value for size range', 'hytteguiden' ),
          )
); 

if(isset($_POST['submit']) && $_POST['submit'] != ''){
  
  if($slider_defaults){
    foreach($slider_defaults as $key => $slider_default ){
      $slider_defaults[$key] = $_POST[$key];
    }
  }
	update_option( 'slider_defaults', $slider_defaults);

	$msg = __('Settings has been saved. Proceed to Settings tab in the left column of the Dashboard.', 'hytteguiden');
}

if(isset($_POST['btn_set_default_value']) && $_POST['btn_set_default_value'] != ''){
  
// Get Min & Max Price 
$slider_defaults_data = array(
  'slider_min_price' => hytte_postmeta_mm_value('cabin_price_turnkey', 'min'),
  'slider_max_price' => hytte_postmeta_mm_value('cabin_price_turnkey', 'max'),
  'slider_min_size' => hytte_postmeta_mm_value('cabin_utility_area', 'min'),
  'slider_max_size' => hytte_postmeta_mm_value('cabin_utility_area', 'max'),
  'slider_min_beds' => hytte_postmeta_mm_value('cabin_beds', 'min'),
  'slider_max_beds' => hytte_postmeta_mm_value('cabin_beds', 'max'),
); 

update_option( 'slider_defaults', $slider_defaults_data);

	$msg = __('Default settings has been saved. Proceed to Settings tab in the left column of the Dashboard.', 'hytteguiden');
}


$slider_defaults_data = get_option('slider_defaults');
if(isset($slider_defaults_data) && !empty($slider_defaults_data)){
  $slider_defaults = $slider_defaults_data;
}


?>
<div id="wrap">
  <div class="wrap">
    <h2><img src="<?php echo get_template_directory_uri()."/library/admin/assets/images/theme_setting.png"; ?>">
			 <?php _e('Filter Slider Settings', 'hytteguiden'); ?></h2>
  </div>
<?php
  if(!empty($msg)){
    echo '<div class="wrap"><div id="message" class="updated" style="margin-left:0;">';
    echo '<p>'.$msg.'</p>';
    echo '</div></div>';
  }

  require get_template_directory() . '/library/admin/options/admin-nav.php';


?>

<h2><?php _e('Filter Slider Settings', 'hytteguiden'); ?></h2>

<?php  if( $hytte_form_slider_ranges ) { ?>
<form action="" method="post" enctype="multipart/form-data">
  <table class="form-table">


    <?php 

      foreach ($hytte_form_slider_ranges as $hytte_slider_range ) {
        $id = $hytte_slider_range['id'];
    ?>
      <tr valign="top">
          <th scope="row"><?php echo $hytte_slider_range['label']; ?></th>
          <td ><input type="text" size="40" class="option-height" name="<?php echo $hytte_slider_range['id']; ?>" placeholder="<?php echo $hytte_slider_range['placeholder']; ?>" value="<?php echo $slider_defaults[$id];?>" /></td>
      </tr>

      <?php } ?>


			  </table>

        <p>
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
        
        <input type="submit" name="btn_set_default_value" id="btn_set_default_value" class="button button-primary" value="Sett standard">

      </p>

</form>

<?php } ?>

</div>
