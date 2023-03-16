<?php
/**
 * The main template file
 *  Template Name: Kataloger
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

get_header();?>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section class="section">
                    <div class="container">
                        <div class="vc_row wpb_row vc_row-fluid">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner">
                                    <div class="wpb_wrapper">
                                        <div class="section-heading">
                                            <h2 class="sectiontitle"><span> Våre produsenters kataloger</span></h2></div>
                                    </div>
                                    <?php 
                                    $valsearch = '';
                                    if(isset($_GET['search'])){                                        
                                          $valsearch = $_GET['search'];
                                          global $wpdb;
                                          $producers = $wpdb->get_results( 
                                                      $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type = 'producer' AND post_title 
                                                      LIKE '%s'", '%'. $wpdb->esc_like( $valsearch ) .'%') );                                                     
                                                      $katalogers_ids = [];
                                                      foreach ($producers as $key => $producer) { 
                                                         $katalogers_datas = $wpdb->get_results( 
                                                          "SELECT * FROM $wpdb->postmeta WHERE meta_key = '_catalogs_producer_id' AND 
                                                          meta_value = ".$producer->ID);
                                                          foreach ($katalogers_datas as $key => $kataloger_id) {
                                                            $katalogers_ids[] = $kataloger_id->post_id;                                                           
                                                          }                                           
                                                      }
                                        }                           


                                      ?>
                                
                                    <form method="get">
                                      
                                      <div class="form-group">
                                        <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $valsearch; ?>">
                                      </div>

                                      <button type="submit" class="btn btn-block btn-theme1 d-none">Submit</button>
                                     
                                    
                                  
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section">
                    <div class="container">
                        <div class="vc_row wpb_row vc_row-fluid">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner">
                                    <div class="wpb_wrapper">
                                    <div class="row">
                                        <?php 
                                        $args = array(
                                            'post_type' => 'kataloger',                                      
                                            
                                        );

                                        if(!empty($katalogers_ids)){
                                          $args['post__in'] = $katalogers_ids;                                         
                                        }
                                        

                                        // The Query
                                        $kataloger = new WP_Query( $args );
                                        
                                        // The Loop
                                        if ( $kataloger->have_posts() ) {                                           
                                            while ( $kataloger->have_posts() ) {
                                                $kataloger->the_post();
                                               ?>

                                                <div class="col-md-4">
                                                    <div class="asideblock producerinfo">
                                                        <div class="producerlogo"><a href="<?php the_permalink(); ?>">
                                                        <?php echo get_the_post_thumbnail(  $kataloger->ID, 'full','', array( "class" => "img-fluid" ) ); ?></a></div>
                                                        <h4 class="subtitle"><span><a href="<?php the_permalink(); ?>" class="grid-producer-title"><?php the_title(); ?></a></span></h4>
                                                        <ul>
                                                        <?php  
                                                          $producer_website = get_post_meta( $kataloger->ID, 'producer_website', true);
                                                        if(isset($producer_website) && !empty($producer_website)){
                                                            echo '<li>'.__('Nettside', 'wpbe').'</li><li><a href="'.$producer_website.'" target="_blank">'.$producer_website.'</a></li>';
                                                        }

                                                        $_catalogs_producer_id = get_post_meta($kataloger->ID, '_catalogs_producer_id', true);
                                                        echo '<li>'.__('Produsent', 'wpbe').'</li><li><a href="'.get_permalink( $_catalogs_producer_id).'" target="_blank">'.get_the_title($_catalogs_producer_id).'</a></li>';
                                                        echo  '<div class="grid-button-producer"><a href="#" class="btn btn-block btn-lg btn-theme1">'.__('Bestill', 'hytteguiden').'</a></div>';
                                                    
                                                        ?>
                                                        </ul>
                                                      </div>
                                                </div>

                                        <?php    }
                                            
                                        } else {
                                            // no posts found
                                        }
                                        /* Restore original Post Data */
                                        wp_reset_postdata();
                                        ?>
                                            
                                        
                                               
                                               
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<?php
	
get_footer();
