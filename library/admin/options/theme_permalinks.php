<?php
$msg = '';
if(isset($_POST['submit']) && $_POST['submit'] != ''){
	update_option( 'cabin_slug', $_POST['cabin_slug'] );
  update_option( 'producer_slug', $_POST['producer_slug'] );
  update_option( 'search_result_slug', $_POST['search_result_slug'] );
  update_option( 'login_slug', $_POST['login_slug'] );
  update_option( 'my_profile', $_POST['my_profile'] );
  update_option( 'my_cabins', $_POST['my_cabins'] );
  update_option( 'my_catalogue', $_POST['my_catalogue'] );

	$msg = __('Settings has been saved. Now you need to refresh all the permalinks for your changes to take place. Proceed to Settings tab in the left column of the Dashboard.', 'hytteguiden');
}

?>
<div id="wrap">
  <div class="wrap">
    <h2><img src="<?php echo get_template_directory_uri()."/library/admin/assets/images/theme_setting.png"; ?>">
			 <?php _e('Custom Post/Page URL Rewriting', 'hytteguiden'); ?></h2>
  </div>
<?php
  if(!empty($msg)){
    echo '<div class="wrap"><div id="message" class="updated" style="margin-left:0;">';
    echo '<p>'.$msg.'</p>';
    echo '</div></div>';
  }

?>
<p><?php _e('Sometimes you don’t want to use the default slugs for the posts, and that’s why you might need to change the slugs to your custom ones.', 'hytteguiden')?></p>

<form action="" class="custom_form" method="post" enctype="multipart/form-data">
  <table class="form-table">

      <tr valign="top">
          <th scope="row"><?php _e('Cabin', 'hytteguiden'); ?></th>
          <td><?php echo esc_url( home_url( '/' ) ); ?><input type="text" size="20" name="cabin_slug" placeholder="cabin" value="<?php echo esc_attr( get_option('cabin_slug') ); ?>" /></td>
      </tr>

			<tr valign="top">
					<th scope="row"><?php _e('Producers', 'hytteguiden'); ?></th>
					<td><?php echo esc_url( home_url( '/' ) ); ?><input type="text" size="20" placeholder="producer" name="producer_slug" value="<?php echo esc_attr( get_option('producer_slug') ); ?>" /></td>
			</tr>


			<tr valign="top">
					<th scope="row"><?php _e('Search Result Page', 'hytteguiden'); ?></th>
					<td><?php echo esc_url( home_url( '/' ) ); ?><input type="text" size="20" placeholder="finn" name="search_result_slug" value="<?php echo esc_attr( get_option('search_result_slug') ); ?>" /></td>
			</tr>

      <tr valign="top">
					<th scope="row"><?php _e('Login Page', 'hytteguiden'); ?></th>
					<td><?php echo esc_url( home_url( '/' ) ); ?><input type="text" size="20" placeholder="logg-inn" name="login_slug" value="<?php echo esc_attr( get_option('login_slug') ); ?>" /></td>
			</tr>

      <tr valign="top">
					<th scope="row"><?php _e('My Profile', 'hytteguiden'); ?></th>
					<td><?php echo esc_url( home_url( '/' ) ); ?><input type="text" size="20" placeholder="my-profile" name="my_profile" value="<?php echo esc_attr( get_option('my_profile') ); ?>" /></td>
      </tr>
      
      <tr valign="top">
					<th scope="row"><?php _e(' Mine Hytter', 'hytteguiden'); ?></th>
					<td><?php echo esc_url( home_url( '/' ) ); ?><input type="text" size="20" placeholder="mine-hytter" name="my_cabins" value="<?php echo esc_attr( get_option('my_cabins') ); ?>" /></td>
      </tr>
      
      <tr valign="top">
					<th scope="row"><?php _e('Mine Kataloger', 'hytteguiden'); ?></th>
					<td><?php echo esc_url( home_url( '/' ) ); ?><input type="text" size="20" placeholder="mine-kataloger" name="my_catalogue" value="<?php echo esc_attr( get_option('my_catalogue') ); ?>" /></td>
			</tr>

			  </table>

			  <?php submit_button(); ?>

</div>
