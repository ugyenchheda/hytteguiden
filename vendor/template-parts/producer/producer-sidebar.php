<aside class="aside">
        <div class="row">
            <div class="col-12">
                <div class="asideblock producerinfo">                
                <?php
                    $producer_website = get_post_meta( get_the_ID(), 'producer_website', true );
                    if ( has_post_thumbnail( ) ) {
                        echo '<div class="producerlogo"><a href="'.$producer_website.'" target="_blank"><img src="'.get_the_post_thumbnail_url( get_the_ID(), 'full').'" class="img-fluid"></a></div>';

                        }

                        ?>
                    <h4 class="subtitle"><span><?php _e('Kontakt', 'hytteguiden');?></span></h4>
                    <ul>
                       <?php
                        $producer_website = get_post_meta( get_the_ID(), 'producer_website', true );
                        // Check if the custom field has a value.
                        if ( ! empty( $producer_website ) ) {
                            echo '<li>'. __('Web', 'hytteguiden').'</li>';
                            echo '<li><a href="'.$producer_website.'" target="_blank">'.$producer_website.'</a></li>';
                        }
                        ?>

                       <?php
                        $producer_email = get_post_meta( get_the_ID(), 'producer_email', true );
                        // Check if the custom field has a value.
                        if ( ! empty( $producer_email ) ) {
                            echo '<li>'. __('Epost', 'hytteguiden').'</li>';
                            echo '<li><a href="mailto:'.$producer_email.'" target="_blank">'.$producer_email.'</a></li>';
                        }
                        ?>
                        
                       <?php
                        $producer_address = get_post_meta( get_the_ID(), 'producer_address', true );
                        // Check if the custom field has a value.
                        if ( ! empty( $producer_address ) ) {
                            echo '<li>'. __('Adresse', 'hytteguiden').'</li>';
                            echo '<li>'.str_replace(',', " , <br>", $producer_address).'</a></li>';
                        }
                        ?>
                        
                      
                       <?php
                        $producer_contact_phone_1 = get_post_meta( get_the_ID(), 'producer_contact_phone_1', true );
                        // Check if the custom field has a value.
                        if ( ! empty( $producer_contact_phone_1 ) ) {
                            
                            echo '<li>'. __('Telefon', 'hytteguiden').'</li>';
                            echo '<li><a href="tel:'.hytteguiden_format_phone( $producer_contact_phone_1 ).'" target="_blank">'. hytteguiden_format_phone( $producer_contact_phone_1 ) .'</a></li>';
                        }
                        ?>
                        
                       <?php
                        $producer_contact_phone_2 = get_post_meta( get_the_ID(), 'producer_contact_phone_2', true );
                        // Check if the custom field has a value.
                        if ( ! empty( $producer_contact_phone_2 ) ) {
                            
                            echo '<li>'. __('Telefon', 'hytteguiden').'</li>';
                            echo '<li><a href="tel:'.hytteguiden_format_phone( $producer_contact_phone_2 ).'" target="_blank">'. hytteguiden_format_phone( $producer_contact_phone_2 ).'</a></li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="asideblock unwrapped">
                    <?php echo hytteguiden_producer_kataloger_status( get_the_ID() ); ?>
                </div>
                <?php get_template_part( 'template-parts/cabins/catalog', 'form' ); ?>
            </div>
            <?php 
            $producer_avdelingers = '';
            $producer_avdelingers = get_post_meta(get_the_ID() , 'link_avdeling', true);    
            if($producer_avdelingers):                
            ?>

            <div class="col-12 col-md-6 col-lg-12">
                <div class="asideblock producerdept">
                <h4 class="subtitle"><span><?php _e('Avdelinger', 'hytteguiden');?></span></h4>
                        <?php 
                                               
                            $args = array('post_type' => 'avdeling','post__in' =>  $producer_avdelingers);                               

                            $myposts = get_posts( $args );
                            if($myposts){

                                foreach( $myposts as $post ) :
                                    setup_postdata($post);

                                    $address = get_post_meta($post->ID, "department_address", true);
                                    $phone = get_post_meta($post->ID, "department_contact_phone", true);
                                    $email = get_post_meta($post->ID, "department_email", true);
                                    $employee_data = get_post_meta($post->ID, "avdelinger_producer_avdelinger", true);


                                    echo '<div class="deptitem">';
                                    echo '<h6>' .get_the_title(). '</h6>';
                                    echo '<ul class="fa-ul">';
                                    if ( !empty($address) ) {
                                        echo '<li><span class="fa-li"><i class="fa fa-map-marker-alt"></i></span>' .$address . '</li>';
                                    }
                                    if ( !empty($phone) ) {
                                        echo ' <li><a href="tel:'.$phone.'"><span class="fa-li"><i class="fa fa-phone"></i></span>' . $phone . '</a></li>';
                                    }
                                    if ( !empty($email) ) {
                                        echo ' <li><a href="mailto:'.$email.'" target="_blank"><span class="fa-li"><i class="fa fa-envelope-open"></i></span> ' .$email . '</a></li>';
                                    }

                                    if($employee_data){
                                       // echo '<div class="header-employee"><strong>Avdeling Ansatte</strong></div>';
                                        foreach($employee_data as $edata){
                                            echo '<div class="employee-details"><div class="cabinmodule-alt employee-wrapper">';
                                            //echo '<figure class="cabinimg employeeimage"><img src="'.$edata['avdelinger_banner'] .'" class="img-fluid"></figure>';
                                            echo '<div class="cabindetails">';
                                            echo '<div class="cabintitle">';
                                            echo '<li><ul class="employee-main">';
                                            if (array_key_exists("name",$edata) && !empty($edata['name'])){
                                                echo '<li><h6>' .$edata['name'] . '</h6></li>';
                                            }
                                            if (array_key_exists("title",$edata) && !empty($edata['title'])){
                                                echo '<li><i class="fas fa-user-tie"></i>' .$edata['title'] . '</li>';
                                            }
                                            if (array_key_exists("phone",$edata) && !empty($edata['phone'])){
                                                echo '<li><i class="fa fa-phone"></i>' .hytteguiden_format_phone( $edata['phone']) . '</li>';
                                            }
                                            if (array_key_exists("email",$edata) && !empty($edata['email'])){
                                                echo '<li><i class="fa fa-envelope"></i>' .$edata['email'] . '</li>';
                                            }
                                            echo '</ul></li></div></div></div></div>';
                                        }
                                    }
                                    echo '</ul></div>';
                                endforeach;
                            }
                       

                       
                               

                        ?>
                </div>
            </div>

            <?php  endif; ?>

            
        </div>
    </aside>
    