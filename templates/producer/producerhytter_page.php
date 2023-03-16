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

/* Request Data */
$msg = '';
$mode = isset($_REQUEST['mode'])?$_REQUEST['mode']:'';
$post_id = isset($_REQUEST['id'])?$_REQUEST['id']:'';

if($mode == 'delete'){
    wp_delete_post($post_id);
    $msg = __('Opptaket er slettet', 'hytteguiden');
}


get_header();

?>
<section class="section userdashboard">
	<div class="container">
		<div class="section-heading">
			<h3 class="sectiontitle-alt"><?php _e('Mine Hytter', 'hytteguiden'); ?></h3>
		</div>
		<div class="row gutter20x">
		
		    <nav class="ppagenav">
				<?php echo hytteguiden_producer_dashboard_tab('producer_hytter'); ?>			
            </nav>
            
            <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <?php 
                                if(!empty($msg)){
                                    echo '<div class="alert alert-success">'. $msg . '</div>';
                                }        
                                ?>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="button-area">
                                <div class="add-cataloger">
                                <a href="<?php echo esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['producerupdatehytte_page']. '/?mode=add'; ?>" class="btn btn-secondary btn-xs"><?php _e('Legg til hytta', 'hytteguiden' ); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="profile-wrapper">
			<div class="main-producer-wrapper">
            <?php   global $post;
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
        
        ?>
        <div class="table-responsive">
            <table class="table table-borderless table-dboard">
                <thead class="thead-light">
                    <tr>
                    <th><?php _e('Navn', 'hytteguiden'); ?></th>
                    <th><?php _e('Størrelse', 'hytteguiden'); ?></th>
                    <th><?php _e('Soverom', 'hytteguiden'); ?></th>
                    <th><?php _e('Sengeplasser', 'hytteguiden'); ?></th>
                    <th><?php _e('Pris', 'hytteguiden'); ?></th>
                    <th><?php _e('Status', 'hytteguiden'); ?></th>
                    <th class="action2"><?php _e('Handling', 'hytteguiden'); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach( $mycabins as $post ) :
                setup_postdata($post);
              ?>
                    <tr>
                        <td><a href="<?php echo get_permalink($post->ID); ?>" target="_blank"><?php echo get_the_title($post->ID); ?></a></td>
                        <td>
                        <?php   $cabin_utility_area = get_post_meta( $post->ID, 'cabin_utility_area', true);
                                if(isset($cabin_utility_area) && !empty($cabin_utility_area)){
                                    echo hytteguiden_price($cabin_utility_area) . 'm<sup>2</sup>';
                                }
                        ?></td>
                        <td>
                        <?php   $cabin_bedroom = get_post_meta( $post->ID, 'cabin_bedroom', true);
                                if(isset($cabin_bedroom) && !empty($cabin_bedroom)){
                                    echo hytteguiden_price($cabin_bedroom) ;
                                }
                        ?></td>
                        <td>
                        <?php   $cabin_beds = get_post_meta( $post->ID, 'cabin_beds', true);
                                if(isset($cabin_beds) && !empty($cabin_beds)){
                                    echo hytteguiden_price($cabin_beds) ;
                                }
                        ?></td>
                        <td><?php
								$cabin_price_turnkey = get_post_meta( $post->ID, 'cabin_price_turnkey', true);
								if(isset($cabin_price_turnkey) && !empty($cabin_price_turnkey)){
								    echo hytteguiden_price($cabin_price_turnkey) . 'kr';
							    }
							?></td>
                        <td><?php echo hytteguiden_post_status( $post->ID ); ?></td>
                        <td>
                            <a href="<?php echo esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['producerupdatehytte_page']. '/?mode=edit&id='. $post->ID; ?>" >
                            <span class="btn btn-secondary btn-xs"><i class="far fa-edit"></i><span class="hide-sm-down"> <?php _e('Redigere', 'hytteguiden'); ?></span></span> </a>
                            
                            <a href="<?php echo esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['producerhytter_page']. '/?mode=delete&id='. $post->ID; ?>" onclick="return confirm('Er du sikker på at du vil slette?')">
                            <span class="btn btn-danger btn-xs"><i class="fa fa-times"></i><span class="hide-sm-down"> <?php _e('Slett', 'hytteguiden'); ?></span></span> </a>
                        </td>
                    </tr>
                <?php endforeach;
                wp_reset_postdata(); ?>

                    
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>
                            </div>
		</div>
	</div>
</section>
<!-- //personalpage -->
<?php

get_footer();
