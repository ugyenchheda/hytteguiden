<?php $current_producer_id =  $GLOBALS['current_producer_id']; ?>
<div class="dboardblock">
    <div class="dboardtitle">
        <h5 class="titletype"><?php _e('BEDRIFTSINFO', 'hytteguiden'); ?></h5> 
        <div class="dboardcontrol">
            <a href="<?php echo esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['producerprofile_page']; ?>" class="btn btn-xs"><i class="far fa-edit"></i> Edit</a>
        </div>
    </div>
    <div class="dboardcontent">
        <div class="cprofile">
            <div class="row">
                <div class="col-12 col-lg-4 order-lg-last">
                    <?php 
                      if ( has_post_thumbnail( $current_producer_id ) ) {
                        echo '<div class="profile-logo">'.get_the_post_thumbnail( $current_producer_id, 'thumbnail','', array( "class" => "img-fluid" ) ).'</div>';

                      }
                    ?>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="profile-info">
                        <ul>
                            <li><?php _e('Navn', 'hytteguiden'); ?></li>
                            <li><?php echo get_the_title($current_producer_id); ?></li>
                            <?php

                            // Address
                            $producer_address = get_post_meta( $current_producer_id, 'producer_address', true );
                            if ( ! empty( $producer_address ) ) {
                                echo '<li>'. __('Adresse', 'hytteguiden').'</li>';
                                echo '<li>'.$producer_address.'</a></li>';
                            }

                            // Website
                            $producer_website = get_post_meta( $current_producer_id, 'producer_website', true );
                            if ( ! empty( $producer_website ) ) {
                                echo '<li>'. __('Web', 'hytteguiden').'</li>';
                                echo '<li><a href="'.$producer_website.'" target="_blank">'.$producer_website.'</a></li>';
                            }

                            // Email
                            $producer_email = get_post_meta( $current_producer_id, 'producer_email', true );
                            if ( ! empty( $producer_email ) ) {
                                echo '<li>'. __('Epost', 'hytteguiden').'</li>';
                                echo '<li><a href="mailto:'.$producer_email.'" target="_blank">'.$producer_email.'</a></li>';
                            }

                            // Phone 1
                            $producer_contact_phone_1 = get_post_meta( $current_producer_id, 'producer_contact_phone_1', true );
                            if ( ! empty( $producer_contact_phone_1 ) ) {
                                
                                echo '<li>'. __('Telefon 1', 'hytteguiden').'</li>';
                                echo '<li>'. hytteguiden_format_phone( $producer_contact_phone_1 ) .'</a></li>';
                            }

                            // Phone 2
                            $producer_contact_phone_2 = get_post_meta( $current_producer_id, 'producer_contact_phone_2', true );
                            if ( ! empty( $producer_contact_phone_2 ) ) {
                                
                                echo '<li>'. __('Telefon 2', 'hytteguiden').'</li>';
                                echo '<li>'. hytteguiden_format_phone( $producer_contact_phone_2 ).'</a></li>';
                            }

                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>