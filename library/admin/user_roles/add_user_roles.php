<?php

add_role('producer', __( 'Produsenter'),
   array(
       'read'            => true, // Allows a user to read
       'create_posts'      => true, // Allows user to create new posts
       'edit_posts'        => true, // Allows user to edit their own posts
       'edit_others_posts' => true, // Allows user to edit others posts too
       'publish_posts' => true, // Allows the user to publish posts
       'manage_categories' => true, // Allows user to manage post categories
       )
);

// Add custom meta user to assign to Produsenter
add_action('show_user_profile', 'hytteguiden_user_profile_fields');
add_action('edit_user_profile', 'hytteguiden_user_profile_fields');

// @param WP_User $user
function hytteguiden_user_profile_fields( $user ) {
    
    $producer_id = get_the_author_meta( 'producer_id', $user->ID );
    $user_phone = get_the_author_meta( 'user_phone', $user->ID );
    $user_address = get_the_author_meta( 'user_address', $user->ID );
    $user_postal_number = get_the_author_meta( 'user_postal_number', $user->ID );
    $user_city = get_the_author_meta( 'user_city', $user->ID );
    $zip_code = get_the_author_meta( 'zip_code', $user->ID );
    $country_code = get_the_author_meta( 'country_code', $user->ID );

    $args = array(
        'post_type' 	 => 'producer',
        'posts_per_page' => -1,
      );
?>
    <table class="form-table">
        <tr>
            <th>
                <label for="producer_id"><?php _e( 'Produsenter', 'hytteguiden' ); ?></label>
            </th>
            <td>
            <select  name="producer_id" id="producer_id" class="regular-text code">
                <option value=""><?php _e( 'Choose Produsenter', 'hytteguiden' ); ?> </option>
                <?php 
                $producer_post = new WP_Query( $args );
                if ( $producer_post->have_posts() ) {
                    while( $producer_post->have_posts() ) :
                         $producer_post->the_post();
                    echo '<option value="'. get_the_ID().'" ';

                    if(isset($producer_id) && $producer_id == get_the_ID()){
                        echo ' selected="selected"';
                    }

                    echo '>'. get_the_title().'</option>';
                    endwhile;
                }

                wp_reset_query();
                ?>
            </select>
              
            </td>
        </tr>
        <tr>
            <th>
                <label for="producer_id"><?php _e( 'Phone Number', 'hytteguiden' ); ?></label>
            </th>
            <td><input type="text" placeholder="<?php esc_attr_e('Enter Phone Number', 'hytteguiden' )?>" name="user_phone" value="<?php echo $user_phone; ?>" class="regular-text code">
            <?php 

                  ?>
            </td>
        </tr>
        <tr>    
        <th>
                <label for="producer_id"><?php _e( 'Address', 'hytteguiden' ); ?></label>
            </th>
            <td><input type="text" placeholder="<?php esc_attr_e('Enter Address', 'hytteguiden' )?>" name="user_address" value="<?php echo $user_address; ?>" class="regular-text code">
            <?php 

                  ?>
            </td>
        </tr>    
        <tr>    
        <th>
                <label for="producer_id"><?php _e( 'Postal Number', 'hytteguiden' ); ?></label>
            </th>
            <td><input type="text" placeholder="<?php esc_attr_e('Enter Postal Number', 'hytteguiden' )?>" name="user_postal_number" value="<?php echo $user_postal_number; ?>" class="regular-text code">
            <?php 

                  ?>
            </td>
        </tr>   
        <tr>    
        <th>
                <label for="producer_id"><?php _e( 'City', 'hytteguiden' ); ?></label>
            </th>
            <td><input type="text" placeholder="<?php esc_attr_e('Enter City Name', 'hytteguiden' )?>" name="user_city" value="<?php echo $user_city; ?>" class="regular-text code">
            <?php 

                  ?>
            </td>
        </tr>
        <tr>    
        <th>
                <label for="producer_id"><?php _e( 'Zipcode', 'hytteguiden' ); ?></label>
            </th>
            <td><input type="text" placeholder="<?php esc_attr_e('Enter Zipcode', 'hytteguiden' )?>" name="zip_code" value="<?php echo $zip_code; ?>" class="regular-text code">
            <?php 

                  ?>
            </td>
        </tr>   
        <tr>    
        <th>
                <label for="producer_id"><?php _e( 'Country Code', 'hytteguiden' ); ?></label>
            </th>
            <td><input type="text" placeholder="<?php esc_attr_e('Enter Country Code', 'hytteguiden' )?>" name="country_code" value="<?php echo $country_code; ?>" class="regular-text code">
            <?php 

                  ?>
            </td>
        </tr>   
    </table>
<?php
}

add_action( 'personal_options_update', 'hytteguiden_update_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'hytteguiden_update_extra_profile_fields' );

function hytteguiden_update_extra_profile_fields( $user_id ) {
    if ( current_user_can( 'edit_user', $user_id ) ){
        update_user_meta( $user_id, 'producer_id', $_POST['producer_id'] );
        update_user_meta( $user_id, 'user_phone', $_POST['user_phone'] );
        update_user_meta( $user_id, 'user_address', $_POST['user_address'] );
        update_user_meta( $user_id, 'user_postal_number', $_POST['user_postal_number'] );
        update_user_meta( $user_id, 'user_city', $_POST['user_city'] );
        update_user_meta( $user_id, 'zip_code', $_POST['zip_code'] );
        update_user_meta( $user_id, 'country_code', $_POST['country_code'] );
    }       
}


?>
