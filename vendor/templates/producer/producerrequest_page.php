<?php
/**
 * The main template file
 *  Template Name: Login Form
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Maya_Journeys
 */
hytteguiden_login_access();
$current_user = wp_get_current_user();   

$current_producer_id = get_user_meta( $current_user->ID, 'producer_id', true );
if(isset($current_producer_id) && !empty($current_producer_id)){
	$GLOBALS['current_producer_id'] = $current_producer_id;
} else{
	
	echo '<script> window.location = "'. esc_url( home_url( '/' ) ) .'"; </script>';
	exit;
}



get_header();

?>
<section class="section userdashboard">
	<div class="container">
		<div class="section-heading">
			<h3 class="sectiontitle-alt"><?php _e('Forespørsler', 'hytteguiden'); ?></h3>
		</div>
		<div class="row gutter20x">
			<nav class="ppagenav">
				<?php echo hytteguiden_producer_dashboard_tab('producer_request'); ?>			
			</nav>

		<?php
		// Retrive my cabins ids
		$cabin_ids = array();
		global $post;
		global $wpdb;
		$args = array(
			'meta_query'=> array(
				array(
				'key' => 'cabin_producer_id',
				'compare' => '=',
				'value' =>  $current_producer_id,
				)
			),
			'numberposts' => -1,
			'post_type' => 'cabin',
			'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'),
		);

		$mycabins = get_posts( $args );
		if($mycabins){
			foreach( $mycabins as $post ) :
				setup_postdata($post);
				$cabin_ids[] = $post->ID;
			endforeach;
			wp_reset_postdata();
		}
				
		?>
<div class="profile-wrapper">
<div class="main-producer-wrapper">
    <?php 
    if($cabin_ids){ 
        $sql = 'SELECT * FROM ' . $wpdb->prefix . 'contact_producer WHERE 1= 1'; 

        $cabin_ids_comma_sep =  implode(",",$cabin_ids);

        $sql .= ' AND post_id IN ('. $cabin_ids_comma_sep . ')';

        $result = $wpdb->get_results( $sql );
        if($result) {
    ?>
        <div class="table-responsive">
            <table class="table table-borderless table-dboard">
                <thead class="thead-light">
                    <tr>
                        <th><?php _e( 'Navn', 'hytteguiden' ); ?> </th>
                        <th><?php _e( 'Epost', 'hytteguiden' ); ?></th>
                        <th><?php _e( 'Hytte', 'hytteguiden' ); ?></th>
                        <th><?php _e( 'Dato', 'hytteguiden' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach( $result as $entry ) { ?>
                    <tr>
                        <td><?php echo stripslashes($entry->con_name); ?></td> 
                        <td><?php echo stripslashes($entry->con_email); ?></td> 
                        <td><?php 
                            if(!empty($entry->post_id)){
                                echo get_the_title($entry->post_id);
                            }
                        ?></td> 
                        <td><?php echo stripslashes($entry->con_date); ?></td> 
                    </tr>
                <?php } ?>
                   
                </tbody>
            </table>
        </div>
    <?php
        }
} ?>   
</div> 
    </div>
	
		</div>
	</div>
</section>
<!-- //personalpage -->
<?php

get_footer();
