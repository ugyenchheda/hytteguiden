<?php
$msg = '';
if(isset($_POST['submit']) && $_POST['submit'] != ''){
	update_option( 'cabin_slug', $_POST['cabin_slug'] );
  update_option( 'producer_slug', $_POST['producer_slug'] );
  update_option( 'google_map_api', $_POST['google_map_api'] );
  update_option( 'google_font_api', $_POST['google_font_api'] );
  update_option( 'facebook_appId', $_POST['facebook_appId'] );  

	$msg = __('Settings has been saved. Now you need to refresh all the permalinks for your changes to take place. Proceed to Settings tab in the left column of the Dashboard.', 'hytteguiden');
}

?>
<div id="wrap">
  <div class="wrap">
    <h2><img src="<?php echo get_template_directory_uri()."/library/admin/assets/images/theme_setting.png"; ?>">
			 <?php _e('Google Map API', 'hytteguiden'); ?></h2>
  </div>
<?php
  if(!empty($msg)){
    echo '<div class="wrap"><div id="message" class="updated" style="margin-left:0;">';
    echo '<p>'.$msg.'</p>';
    echo '</div></div>';
  }

  require get_template_directory() . '/library/admin/options/admin-nav.php';

?>

<form action="" method="post" enctype="multipart/form-data">
  <table class="form-table">


      <tr valign="top">
          <th scope="row"><?php _e('Cabin', 'hytteguiden'); ?></th>
          <td><input type="text" size="20" name="cabin_slug" placeholder="cabin" value="<?php echo esc_attr( get_option('cabin_slug') ); ?>" /></td>
      </tr>

			<tr valign="top">
					<th scope="row"><?php _e('Producers', 'hytteguiden'); ?></th>
					<td><input type="text" size="20" placeholder="producer" name="producer_slug" value="<?php echo esc_attr( get_option('producer_slug') ); ?>" /></td>
			</tr>


      <tr valign="top">
          <th scope="row"><?php _e('Google Map API Key', 'hytteguiden'); ?></th>
          <td ><input type="text" size="40" class="option-height" name="google_map_api" placeholder="Enter your Google Map API key" value="<?php echo esc_attr( get_option('google_map_api') ); ?>" />
          
          <p><?php
      $api_url = esc_url( 'https://developers.google.com/maps/documentation/embed/get-api-key' );
      echo __( "If you don't have Google Map API key, then", 'hytteguiden' );

      echo ' <a href="' . $api_url . '" target="_blank">' . __( 'click here', 'hytteguiden' ) . '</a>.';
      ?>
      </p>
          </td>
      </tr>

      <tr valign="top">
          <th scope="row"><?php _e('Google Font API Key', 'hytteguiden'); ?></th>
          <td ><input type="text" size="40" class="option-height" name="google_font_api" placeholder="Enter your Google Font API key" value="<?php echo esc_attr( get_option('google_font_api') ); ?>" />
          
          <p><?php
      $api_url = esc_url( 'https://developers.google.com/fonts/docs/developer_api' );
      echo __( "If you don't have Google Font API key, then", 'hytteguiden' );

      echo ' <a href="' . $api_url . '" target="_blank">' . __( 'click here', 'hytteguiden' ) . '</a>.';
      ?>
      </p>
          </td>
      </tr>


      <tr valign="top">
          <th scope="row"><?php _e('Facebook App Id', 'hytteguiden'); ?></th>
          <td ><input type="text" size="40" class="option-height" name="facebook_appId" placeholder="Enter your Facebook App Id" value="<?php echo esc_attr( get_option('facebook_appId') ); ?>" /></td>
      </tr>


			  </table>
        
			  <?php submit_button(); ?>

</div>
