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
          echo '<a href="'.hytteguiden_search_result_url().'cabin_style='.$cabin_style['slug'].'"><span class="info-icon">'.wp_get_attachment_image( $image_id, 'large', '', array( "class" => "img-fluid", "alt" => $cabin_style['name'] )  ).'</a></span>';
        } ?>
        <p><?php echo $cabin_style['name']; ?></p>
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
          echo '<a href="'.hytteguiden_search_result_url().'cabin_type='.$cabin_type['slug'].'"><span class="info-icon">'.wp_get_attachment_image( $image_id, 'large', '', array( "class" => "img-fluid", "alt" => $cabin_type['name'] )  ).'</a></span>';
        } ?>
        <p><?php echo $cabin_type['name']; ?></p>
      </li>
    <?php } ?>
    <?php } ?>
    <?php $cabin_methods = hytteguiden_post_terms(get_the_ID(), $taxonomy = 'cabin_method');
     if ( ! empty( $cabin_methods ) && ! is_wp_error( $cabin_methods ) ) {
     ?>
      <?php foreach ( $cabin_methods as $cabin_method ) {
        $image_id = get_term_meta( $cabin_method['term_id'],'cabin_method_image_id', true );
       ?>
      <li>
        <?php if(isset($image_id) && !empty($image_id)){
          echo '<a href="'.hytteguiden_search_result_url().'cabin_method='.$cabin_method['slug'].'"><span class="info-icon">'.wp_get_attachment_image( $image_id, 'large', '', array( "class" => "img-fluid", "alt" => $cabin_method['name'] )  ).'</a></span>';
        } ?>
        <p><?php echo $cabin_method['name']; ?></p>
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
            echo '<li>'.__('Pris', 'hytteguiden').'<li> : '.hytteguiden_price($cabin_price_kit).'kr</li>';
          }
          $cabin_price_turnkey = get_post_meta( get_the_ID(), 'cabin_price_turnkey', true);
          if(isset($cabin_price_turnkey) && !empty($cabin_price_turnkey)){
            echo '<li>'.__('Byggesett', 'hytteguiden').'<li> : '.hytteguiden_price($cabin_price_turnkey).'kr</li>';
          }

          $cabin_build_area = get_post_meta( get_the_ID(), 'cabin_build_area', true);
          if(isset($cabin_build_area) && !empty($cabin_build_area)){
            echo '<li>'.__('Bra', 'hytteguiden').'<li> : '.hytteguiden_price($cabin_build_area).'m<sup>2</sup></span></li>';
          }

          $cabin_gross_area = get_post_meta( get_the_ID(), 'cabin_gross_area', true);
          if(isset($cabin_gross_area) && !empty($cabin_gross_area)){
            echo '<li>'.__('Bya', 'hytteguiden').'<li> : '.hytteguiden_price($cabin_gross_area).'m<sup>2</sup></span></li>';
          }

          $cabin_width = get_post_meta( get_the_ID(), 'cabin_width', true);
          if(isset($cabin_width) && !empty($cabin_width)){
            echo '<li>'.__('Største bredde', 'hytteguiden').'<li> : '.hytteguiden_price($cabin_width).'m<sup>2</sup></span></li>';
          }

          $cabin_length_width = get_post_meta( get_the_ID(), 'cabin_length_width', true);
          if(isset($cabin_length_width) && !empty($cabin_length_width)){
            echo '<li>'.__('Største lengede', 'hytteguiden').'<li> : '.hytteguiden_price($cabin_length_width).'m<sup>2</sup></span></li>';
          }

          $cabin_bedroom = get_post_meta( get_the_ID(), 'cabin_bedroom', true);
          if(isset($cabin_bedroom) && !empty($cabin_bedroom)){
            echo '<li>'.__('Antall soverom', 'hytteguiden').'<li> : '.$cabin_bedroom.'</li>';
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
        <h5><?php _e( 'PRIS', 'hytteguiden') ?> <i class="fa fa-question showinfo" data-toggle="tooltip" data-placement="top" title="PRIS"></i></h5>
        <div class="infowrap">
          <?php
           $cabin_price_kit = get_post_meta( get_the_ID(), 'cabin_price_kit', true);
          if(isset($cabin_price_kit) && !empty($cabin_price_kit)){
            echo '<p><strong>'.__('Nøkkelferdig', 'hytteguiden').'</strong> <span class="value"> : '.hytteguiden_price($cabin_price_kit).'kr</span></p>';
          }

          $cabin_price_turnkey = get_post_meta( get_the_ID(), 'cabin_price_turnkey', true);
          if(isset($cabin_price_turnkey) && !empty($cabin_price_turnkey)){
            echo '<p><strong>'.__('Byggesett', 'hytteguiden').'</strong> <span class="value"> : '.hytteguiden_price($cabin_price_turnkey).'kr</span></p>';
          }

           ?>
        </div>
      </div>
    </div>
    <div class="cabinfo-item">
      <span class="infoimg"><img src="<?php echo get_template_directory_uri()?>/images/scale.svg" alt="" class="img-fluid"></span>
      <div class="infodtl">
        <h5><?php _e( 'STØRRELSE', 'hytteguiden') ?> <i class="fa fa-question showinfo" data-toggle="tooltip" data-placement="top" title="STØRRELSE"></i></h5>
        <div class="infowrap">
         <?php
           $cabin_build_area = get_post_meta( get_the_ID(), 'cabin_build_area', true);
          if(isset($cabin_build_area) && !empty($cabin_build_area)){
            echo '<p><strong>'.__('BRA', 'hytteguiden').'</strong> <span class="value"> : '.hytteguiden_price($cabin_build_area).'m<sup>2</sup></span></p>';
          }

          $cabin_gross_area = get_post_meta( get_the_ID(), 'cabin_gross_area', true);
          if(isset($cabin_gross_area) && !empty($cabin_gross_area)){
            echo '<p><strong>'.__('BYA', 'hytteguiden').'</strong><span class="value"> : '.hytteguiden_price($cabin_gross_area).'m<sup>2</sup></span></p>';
          }
          $cabin_width = get_post_meta( get_the_ID(), 'cabin_width', true);
          if(isset($cabin_width) && !empty($cabin_width)){
            echo '<p><strong>'.__('Største bredde', 'hytteguiden').'</strong> : <span class="value">'.hytteguiden_price($cabin_width).'m</span></p>';
          }
          $cabin_length_width = get_post_meta( get_the_ID(), 'cabin_length_width', true);
          if(isset($cabin_length_width) && !empty($cabin_length_width)){
            echo '<p><strong>'.__('Største lengede', 'hytteguiden').'</strong> : <span class="value">'.hytteguiden_price($cabin_length_width).'m</span></p>';
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
            echo '<p><strong>'.__('Soverom', 'hytteguiden').' </strong> : <span class="value">'.$cabin_bedroom.'</span></p>';
          }

          $cabin_beds = get_post_meta( get_the_ID(), 'cabin_beds', true);
          if(isset($cabin_beds) && !empty($cabin_beds)){
            echo '<p><strong>'.__('Sengeplasser', 'hytteguiden').' </strong> : <span class="value">'.$cabin_beds.'</span></p>';
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
       ?>
      <div class="col-6 col-sm-4 col-md-3 col-xl-2">
        <div class="amnities-item">
          <div class="amnities-img">
            <?php if(isset($image_id) && !empty($image_id)){
              echo  wp_get_attachment_image( $image_id, 'post_image_m', '', array( "class" => "img-fluid", "alt" => $cabin_amenity['name'] )  );
            } ?>
            </div>
          <p><?php echo $cabin_amenity['name']; ?></p>
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
  <?php $cabin_images_galleries = get_post_meta( get_the_ID(), 'cabin_images_galleries', true);
    if(isset($cabin_images_galleries) && !empty($cabin_images_galleries)){
      ?>
    <div class="cabdetail">
      <h4 class="subtitle"><span><?php _e( 'Bilder', 'hytteguiden') ?></span></h4>
      <div class="row gutter10x">
        <?php foreach($cabin_images_galleries as $key => $cabin_images_gallery) {
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


