<?php

$msg = '';
$route_defaults = array(
  'search_page' => 'finn',
  'login_page' => 'logg-inn',
  'producerlogin_page' => 'produsent-logginn',
  'myprofile_page' => 'min-side',
  'mycabins_page' => 'mine-hytter',
  'mycatalogue_page' => 'mine-kataloger',
  'mydashboard_page' => 'mine-dashboard',
  'producerprofile_page' => 'produsent-profile',  
  'producerhytter_page' => 'produsent-hytter',
  'producerkataloger_page' => 'produsent-kataloger',
  'producerrequest_page' => 'produsent-forespørsler',
  'producerupdatehytte_page' => 'hytte-oppdater',
  'producerupdatekataloger_page' => 'kataloger-oppdater',
); 

$hytte_routes = array(

          array( 
              'label' => __('Slug for Search Result ', 'hytteguiden' ),
              'id' => 'search_page',
              'placeholder' => __('Enter the slug for search result page.', 'hytteguiden' ),
            ),
          array( 
            'label' => __('Slug for Login Page', 'hytteguiden' ),
            'id' => 'login_page',
            'placeholder' => __('Enter the slug for login-page.', 'hytteguiden' ),
          ),

          array( 
            'label' => __('Slug for Profile Page', 'hytteguiden' ),
            'id' => 'myprofile_page',
            'placeholder' => __('Enter the slug for profile page.', 'hytteguiden' ),
          ),
          array( 
            'label' => __('Slug for Cabin Page', 'hytteguiden' ),
            'id' => 'mycabins_page',
            'placeholder' => __('Enter the slug for cabin page.', 'hytteguiden' ),
          ),
          array( 
            'label' => __('Slug for Catalogue', 'hytteguiden' ),
            'id' => 'mycatalogue_page',
            'placeholder' => __('Enter the slug for catelogue.', 'hytteguiden' ),
          ),
          array( 
            'label' => __("Slug for Producer's Dashboard", "hytteguiden" ),
            'id' => 'mydashboard_page',
            'placeholder' => __("Enter the slug for Producer's Dashboard.", "hytteguiden" ),
          ),
          array( 
            'label' => __("Slug for Producer's Login", "hytteguiden" ),
            'id' => 'producerlogin_page',
            'placeholder' => __("Enter the slug for Producer's Login.", "hytteguiden" ),
          ),
          array( 
            'label' => __("Slug for Producer's Profile", "hytteguiden" ),
            'id' => 'producerprofile_page',
            'placeholder' => __("Enter the slug for Producer's Profile.", "hytteguiden" ),
          ),
          array( 
            'label' => __("Slug for Producer's Hytter", "hytteguiden" ),
            'id' => 'producerhytter_page',
            'placeholder' => __("Enter the slug for Producer's Hytter.", "hytteguiden" ),
          ),
          array( 
            'label' => __("Slug for Producer's Kataloger", "hytteguiden" ),
            'id' => 'producerkataloger_page',
            'placeholder' => __("Enter the slug for Producer's Kataloger.", "hytteguiden" ),
          ),
          array( 
            'label' => __("Slug for Producer's Request", "hytteguiden" ),
            'id' => 'producerrequest_page',
            'placeholder' => __("Enter the slug for Producer's Request.", "hytteguiden" ),
          ),
          array( 
            'label' => __("Slug for Hytte Update", "hytteguiden" ),
            'id' => 'producerupdatehytte_page',
            'placeholder' => __("Enter the slug for hytte update.", "hytteguiden" ),
          ),
          array( 
            'label' => __("Slug for Kataloger Update", "hytteguiden" ),
            'id' => 'producerupdatekataloger_page',
            'placeholder' => __("Enter the slug for kataloger update.", "hytteguiden" ),
          )
); 

if(isset($_POST['submit']) && $_POST['submit'] != ''){
  
  if($route_defaults){
    foreach($route_defaults as $key => $route_default ){
      $route_default[$key] = $_POST[$key];
    }
  }
	update_option( 'route_defaults', $route_defaults);

	$msg = __('Settings has been saved. Proceed to Settings tab in the left column of the Dashboard.', 'hytteguiden');
}

$route_defaults_data = get_option('route_defaults');
if(isset($route_defaults_data) && !empty($route_defaults_data)){
  $route_defaults = $route_defaults_data;
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
 <h2><?php _e('Template Endpoints', 'hytteguiden'); ?></h2>
<?php  if( $hytte_routes ) { ?>
<form action="" method="post" enctype="multipart/form-data">
  <table class="form-table">


    <?php 

      foreach ($hytte_routes as $route ) {
        $id = $route['id'];
    ?>
      <tr valign="top">
          <th scope="row"><?php echo $route['label']; ?></th>
          <td ><?php echo esc_url( home_url( '/' ) ); ?><input type="text" size="40" class="option-height" name="<?php echo $route['id']; ?>" placeholder="<?php echo $route['placeholder']; ?>" value="<?php echo $route_defaults[$id];?>" /></td>
      </tr>

      <?php } ?>


			  </table>

			  <?php submit_button(); ?>

</form>

<?php } ?>

</div>
