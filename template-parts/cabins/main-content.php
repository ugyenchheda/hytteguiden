  <p class="display-none" itemprop="url"><?php echo get_permalink();?></p>
  <?php echo wp_get_attachment_url(); ?>
  <img class="display-none" itemprop="image" src="<?php the_post_thumbnail_url(); ?>"/>
  <div class="cabdetail cabtitle">
    <div class="cabname">
      <h4><?php echo hytteguiden_producer_name(get_the_ID()) ; ?></h4>
      <h1 itemprop="name"><?php the_title();?></h1>
    </div>
    <ul class="cabinfo">
    <?php $cabin_styles = hytteguiden_post_terms(get_the_ID(), $taxonomy = 'cabin_style');
     if ( ! empty( $cabin_styles ) && ! is_wp_error( $cabin_styles ) ) {
     ?>
      <?php foreach ( $cabin_styles as $cabin_style ) {
        $image_id = get_term_meta( $cabin_style['term_id'],'cabin_style_image_id', true );
       ?>
      <li>
        <?php if(isset($image_id) && !empty($image_id)){
          echo '<a href="'. hytteguiden_search_result_url() . 'cabin_style='. $cabin_style['slug'] .'">';
          echo '<span class="info-icon">'.wp_get_attachment_image( $image_id, 'large', '', array( "class" => "img-fluid", "alt" => $cabin_style['name'] )  ).'</span>';
          echo '</a>';
        } ?>
        <p><?php 
        echo '<a href="'. hytteguiden_search_result_url() . 'cabin_style='. $cabin_style['slug'] .'">';
        echo $cabin_style['name']; 
        echo '</a>'; ?></p>
      </li>
    <?php } ?>
    <?php } ?>
    <?php $cabin_types = hytteguiden_post_terms(get_the_ID(), $taxonomy = 'cabin_type');
     if ( ! empty( $cabin_types ) && ! is_wp_error( $cabin_types ) ) {
     ?>
      <?php foreach ( $cabin_types as $cabin_type ) {
        $image_id = get_term_meta( $cabin_type['term_id'],'cabin_type_image_id', true );
       ?>
      <li>
        <?php if(isset($image_id) && !empty($image_id)){
          echo '<a href="'. hytteguiden_search_result_url() . 'cabin_type='. $cabin_type['slug'] .'">';
          echo '<span class="info-icon">'.wp_get_attachment_image( $image_id, 'large', '', array( "class" => "img-fluid", "alt" => $cabin_type['name'] )  ).'</span>';
          echo '</a>';
       } ?>
        <p><?php
         echo '<a href="'. hytteguiden_search_result_url() . 'cabin_type='. $cabin_type['slug'] .'">';
        echo $cabin_type['name'];
        echo '</a>';
        ?></p>
      </li>
    <?php } ?>
    <?php } ?>
    
    </ul>
  
  </div>

  <div class="cabdetail cabdetail-mob">
    <div class="cabinfo-list">
      <ul>
        <?php
           $cabin_price_kit = get_post_meta( get_the_ID(), 'cabin_price_kit', true);
          if(isset($cabin_price_kit) && !empty($cabin_price_kit)){
            echo '<li data-toggle="tooltip" title="Hyttas deler leveres til avtalt sted.">'.__('Pris Byggesett', 'hytteguiden').'<li> : '.hytteguiden_price($cabin_price_kit).'kr</li>';
          }
          $cabin_price_turnkey = get_post_meta( get_the_ID(), 'cabin_price_turnkey', true);
          if(isset($cabin_price_turnkey) && !empty($cabin_price_turnkey)){
            echo '<li data-toggle="tooltip" title="Hytta leveres klar til innflytting.">'.__('Pris Nøkkelferdig', 'hytteguiden').'<li> : '.hytteguiden_price($cabin_price_turnkey).'kr</li>';
          }

          $cabin_utility_area = get_post_meta( get_the_ID(), 'cabin_utility_area', true);
          if(isset($cabin_utility_area) && !empty($cabin_utility_area)){
            echo '<li data-toggle="tooltip" title="Bruksareal.">'.__('BRA', 'hytteguiden').'<li> : '.hytteguiden_price($cabin_utility_area).'m<sup>2</sup></span></li>';
          }

          $cabin_base_area = get_post_meta( get_the_ID(), 'cabin_base_area', true);
          if(isset($cabin_base_area) && !empty($cabin_base_area)){
            echo '<li data-toggle="tooltip" title="Bebygd Areal.">'.__('BYA', 'hytteguiden').'<li> : '.hytteguiden_price($cabin_base_area).'m<sup>2</sup></span></li>';
          }

          $cabin_build_area = get_post_meta( get_the_ID(), 'cabin_build_area', true);
          if(isset($cabin_build_area) && !empty($cabin_build_area)){
            echo '<li data-toggle="tooltip" title="Bruttoareal.">'.__('BTA', 'hytteguiden').'<li> : '.hytteguiden_price($cabin_build_area).'m<sup>2</sup></span></li>';
          }

          $cabin_gross_area = get_post_meta( get_the_ID(), 'cabin_gross_area', true);
          if(isset($cabin_gross_area) && !empty($cabin_gross_area)){
            echo '<li data-toggle="tooltip" title="Primærrom.">'.__('P-ROM', 'hytteguiden').'<li> : '.hytteguiden_price($cabin_gross_area).'m<sup>2</sup></span></li>';
          }

          $cabin_width = get_post_meta( get_the_ID(), 'cabin_width', true);
          if(isset($cabin_width) && !empty($cabin_width)){
            echo '<li>'.__('Bredde', 'hytteguiden').'<li> : '.$cabin_width.'m</span></li>';
          }

          $cabin_length_width = get_post_meta( get_the_ID(), 'cabin_length_width', true);
          if(isset($cabin_length_width) && !empty($cabin_length_width)){
            echo '<li>'.__('Lengede', 'hytteguiden').'<li> : '. $cabin_length_width.'m</span></li>';
          }

          $cabin_bedroom = get_post_meta( get_the_ID(), 'cabin_bedroom', true);
          if(isset($cabin_bedroom) && !empty($cabin_bedroom)){
            echo '<li>'.__('Antall Soverom', 'hytteguiden').'<li> : '.$cabin_bedroom.'</li>';
          }
          $cabin_beds = get_post_meta( get_the_ID(), 'cabin_beds', true);
          if(isset($cabin_beds) && !empty($cabin_beds)){
            echo '<li>'.__('Antall sengeplasser', 'hytteguiden').'<li> : '.$cabin_beds.'</li>';
          }

          $cabin_bathroom = get_post_meta( get_the_ID(), 'cabin_bathroom', true);
          if(isset($cabin_bathroom) && !empty($cabin_bathroom)){
            echo '<li>'.__('Antall Bad', 'hytteguiden').'<li> : '.$cabin_bathroom.'</li>';
          }

         ?>
      </ul>
    </div>
  </div>

  <div class="cabdetail cabdetail-mob-up">
    <div class="cabinfo-item">
      <span class="infoimg"><img src="<?php echo get_template_directory_uri()?>/images/tag.svg" alt="" class="img-fluid"></span>
      <div class="infodtl">
        <h5><?php _e( 'PRIS', 'hytteguiden') ?> <i class="fa fa-question showinfo" data-toggle="tooltip" data-placement="top" title="Nøkkelferdig = Hytta er ferdig og klar til bruk. Utarbeidelse og innsending av byggesøknad uten dispensasjoner, samt ferdigattest inngår i prisen. Byggesett = Utvendig og innvendig materialpakke levert på byggeplass i henhold til tekniske spesifikasjoner og generelle betingelser."></i></h5>
        <div class="infowrap">
          <?php

          $cabin_price_turnkey = get_post_meta( get_the_ID(), 'cabin_price_turnkey', true);
          if(isset($cabin_price_turnkey) && !empty($cabin_price_turnkey)){
            echo '<p><strong data-toggle="tooltip" title="Hytta er ferdig og klar til bruk. Utarbeidelse og innsending av byggesøknad uten dispensasjoner, samt ferdigattest inngår i prisen.">'.__('Nøkkelferdig', 'hytteguiden').':</strong> <span class="value">  '.hytteguiden_price($cabin_price_turnkey).'kr</span></p>';
          } else {
            echo '<p><strong data-toggle="tooltip" title="Hytta er ferdig og klar til bruk. Utarbeidelse og innsending av byggesøknad uten dispensasjoner, samt ferdigattest inngår i prisen.">'.__('Nøkkelferdig', 'hytteguiden').':</strong> <span class="value">  '.__( 'Pris på forespørsel', 'hytteguiden').'</span></p>';
          }
           $cabin_price_kit = get_post_meta( get_the_ID(), 'cabin_price_kit', true);
          if(isset($cabin_price_kit) && !empty($cabin_price_kit)){
            echo '<p><strong data-toggle="tooltip" title="Utvendig og innvendig materialpakke levert på byggeplass i henhold til tekniske spesifikasjoner og generelle betingelser.">'.__('Byggesett', 'hytteguiden').': </strong> <span class="value"> '.hytteguiden_price($cabin_price_kit).'kr</span></p>';
          }

           ?>
        </div>
      </div>
    </div>
    <div class="cabinfo-item">
      <span class="infoimg"><img src="<?php echo get_template_directory_uri()?>/images/scale.svg" alt="" class="img-fluid"></span>
      <div class="infodtl">
        <h5><?php _e( 'STØRRELSE', 'hytteguiden') ?> <i class="fa fa-question showinfo" data-toggle="tooltip" data-placement="top" title="BYA = Bebygd areal; hele omrisset av hytten, sett ovenfra. BRA = Bruksareal; innvendig i hytten, innenfor omsluttende vegger. BTA = Bruttoareal; hele arealet til hytten, inkl. yttervegger. P-ROM = Oppholdsrom, inkl. trapp mellom primærrommene."></i></h5>
        <div class="infowrap">
         <?php
         
         $cabin_base_area = get_post_meta( get_the_ID(), 'cabin_base_area', true);
        if(isset($cabin_base_area) && !empty($cabin_base_area)){
          echo '<p><strong data-toggle="tooltip" data-placement="top" title="Bebygd areal; hele omrisset av hytten, sett ovenfra.">'.__('BYA', 'hytteguiden').':</strong> <span class="value">  '.hytteguiden_formate_number($cabin_base_area).'m<sup>2</sup></span></p>';
        }
         
           $cabin_utility_area = get_post_meta( get_the_ID(), 'cabin_utility_area', true);
          if(isset($cabin_utility_area) && !empty($cabin_utility_area)){
            echo '<p><strong data-toggle="tooltip" data-placement="top" title="Bruksareal; innvendig i hytten, innenfor omsluttende vegger.">'.__('BRA', 'hytteguiden').':</strong> <span class="value">  '.hytteguiden_formate_number($cabin_utility_area).'m<sup>2</sup></span></p>';
          }

          $cabin_build_area = get_post_meta( get_the_ID(), 'cabin_build_area', true);
          if(isset($cabin_build_area) && !empty($cabin_build_area)){
            echo '<p><strong data-toggle="tooltip" data-placement="top" title="Bruttoareal; hele arealet til hytten, inkl. yttervegger. ">'.__('BTA', 'hytteguiden').':</strong><span class="value">  '.hytteguiden_formate_number($cabin_build_area).'m<sup>2</sup></span></p>';
          }

          $cabin_gross_area = get_post_meta( get_the_ID(), 'cabin_gross_area', true);
          if(isset($cabin_gross_area) && !empty($cabin_gross_area)){
            echo '<p><strong data-toggle="tooltip" data-placement="top" title="Oppholdsrom, inkl. trapp mellom primærrommene.">'.__('P-ROM', 'hytteguiden').':</strong><span class="value">  '.hytteguiden_formate_number($cabin_gross_area).'m<sup>2</sup></span></p>';
          }
          $cabin_width = get_post_meta( get_the_ID(), 'cabin_width', true);
          if(isset($cabin_width) && !empty($cabin_width)){
            echo '<p><strong>'.__('Bredde', 'hytteguiden').':</strong>  <span class="value">'.$cabin_width .'m</span></p>';
          }
          $cabin_length_width = get_post_meta( get_the_ID(), 'cabin_length_width', true);
          if(isset($cabin_length_width) && !empty($cabin_length_width)){
            echo '<p><strong>'.__('Lengde', 'hytteguiden').':</strong>  <span class="value">'.$cabin_length_width.'m</span></p>';
          }
           ?>
        </div>
      </div>
    </div>
    <div class="cabinfo-item">
      <span class="infoimg"><img src="<?php echo get_template_directory_uri()?>/images/bed.svg" alt="" class="img-fluid"></span>
      <div class="infodtl">
        <h5><?php _e( 'SOVEROM', 'hytteguiden') ?> <i class="fa fa-question showinfo" data-toggle="tooltip" data-placement="top" title="SOVEROM"></i></h5>
        <div class="infowrap">
         <?php
           $cabin_bedroom = get_post_meta( get_the_ID(), 'cabin_bedroom', true);
          if(isset($cabin_bedroom) && !empty($cabin_bedroom)){
            echo '<p><strong>'.__('Antall soverom', 'hytteguiden').' :</strong>  <span class="value">'.$cabin_bedroom.'</span></p>';
          }

          $cabin_beds = get_post_meta( get_the_ID(), 'cabin_beds', true);
          if(isset($cabin_beds) && !empty($cabin_beds)){
            echo '<p><strong>'.__('Antall sengeplasser', 'hytteguiden').' :</strong>  <span class="value">'.$cabin_beds.'</span></p>';
          }

          $cabin_bathroom = get_post_meta( get_the_ID(), 'cabin_bathroom', true);
          if(isset($cabin_bathroom) && !empty($cabin_bathroom)){
            echo '<p><strong>'.__('Antall Bad', 'hytteguiden').': </strong>  <span class="value">'.$cabin_bathroom.'</span></p>';
          }
           ?>
        </div>
      </div>
    </div>
  </div>
    <?php $cabin_amenities = hytteguiden_post_terms(get_the_ID(), $taxonomy = 'cabin_amenity');
     if ( ! empty( $cabin_amenities ) && ! is_wp_error( $cabin_amenities ) ) {
     ?>
  <div class="cabdetail">
    <h4 class="subtitle"><span><?php _e( 'Annet', 'hytteguiden') ?></span></h4>
    <div class="row gutter10x">
       <?php foreach ( $cabin_amenities as $cabin_amenity ) {
        $image_id = get_term_meta( $cabin_amenity['term_id'],'cabin_amenity_image_id', true );
        $cabin_hems = get_post_meta( get_the_ID(),'cabin_hems', true );
        $cabin_rise = get_post_meta( get_the_ID(),'cabin_rise', true );
        $cabin_bod = get_post_meta( get_the_ID(),'cabin_bod', true );
       ?>
      <div class="amenities-block">
        <div class="amnities-item">
          <div class="amnities-img">
            <?php if(isset($image_id) && !empty($image_id) ){
              echo  wp_get_attachment_image( $image_id, 'post_image_m', '', array( "class" => "img-fluid", "alt" => $cabin_amenity['name'] )  );
            } ?>
            </div>
          <p>            
            <?php 
            
            
            switch ($cabin_amenity['name']) {
              case "HEMS":
                echo $cabin_amenity['name'];
                if (!empty($cabin_hems)) {
                  echo ' <br><span>(' . $cabin_hems. 'm<sup>2</sup>)</span>';
                }                 
                break;
              case "OPPSTUGU":
                echo $cabin_amenity['name'];
                if (!empty($cabin_rise)) {
                  echo ' <br><span>(' . $cabin_rise. 'm<sup>2</sup>)</span>';
                } 
                break;
              case "SPORTSBOD":
                echo $cabin_amenity['name'];
                if (!empty($cabin_bod)) {
                  echo ' <br><span>(' . $cabin_bod. 'm<sup>2</sup>)</span>';
                }   
                break;
              default:
                // don't do anything
                echo $cabin_amenity['name'];
          }


            ?>
          </p>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
<?php } ?>
  <div class="cabdetail">
    <h4 class="subtitle"><span><?php _e( 'Om hytta', 'hytteguiden') ?></span></h4>
    <div class="description" itemprop="description">
						<?php the_content(); ?>
		</div>
  </div>
  <?php $cabin_images_galleries_data = array();  
  
   $cabin_images_galleries = get_post_meta( get_the_ID(), 'cabin_images_galleries', true);

  if ( has_post_thumbnail()) : 
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
    $cabin_images_galleries_data[get_post_thumbnail_id()] = $large_image_url[0];
  endif;

  if(isset($cabin_images_galleries) && !empty($cabin_images_galleries)){
    $cabin_images_galleries_data = $cabin_images_galleries_data + $cabin_images_galleries;
  }
   
    
    if(isset($cabin_images_galleries_data) && !empty($cabin_images_galleries_data)){
      ?>
    <div class="cabdetail">
      <h4 class="subtitle"><span><?php _e( 'Bilder', 'hytteguiden') ?></span></h4>
      <div class="row gutter10x">
        
          <?php foreach($cabin_images_galleries_data as $key => $cabin_images_gallery) {
            $cabin_small_image_gallery = hytteguiden_custom_image_src($cabin_images_gallery, 'full');
          ?>  
          <div class="col-6 col-sm-4">        
            <div class="gallery-item">
              <a data-fancybox="photogallery" href="<?php echo $cabin_images_gallery; ?>" data-caption="Caption for image">
                <?php
                echo wp_get_attachment_image( $key, "post_image_xl", "", array( "class" => "img-fluid" ) );
                ?>
              </a>
            </div>
          </div>
          <?php } ?>
        
      </div>
    </div>
  <?php } ?>
  <?php $cabin_floor_plan_galleries = get_post_meta( get_the_ID(), 'cabin_floor_plan_galleries', true);
    if(isset($cabin_floor_plan_galleries) && !empty($cabin_floor_plan_galleries)){
      ?>
    <div class="cabdetail floorplan">
      <h4 class="subtitle"><span><?php _e( 'Plantegninger', 'hytteguiden') ?></span></h4>
      <div class="row gutter10x">
         <?php foreach($cabin_floor_plan_galleries as $cabin_floor_plan_gallery) { ?>
        <div class="col-6 col-sm-4">
          <div class="gallery-item">
            <a data-fancybox="photogallery" href="<?php echo $cabin_floor_plan_gallery; ?>" data-caption="Caption for image">
              <img src="<?php echo $cabin_floor_plan_gallery; ?>" alt="" class="img-fluid">
            </a>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
      <?php } ?>


