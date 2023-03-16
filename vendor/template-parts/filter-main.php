<?php
$bedrooms_arr = array();
$bathrooms_arr = array();
$cabin_style_arr = array();
$cabin_type_arr = array();
$cabin_amenity_arr = array();
$cabin_method_arr = array();
if(isset($_REQUEST['bedrooms']) && !empty($_REQUEST['bedrooms']) ) { 
  $bedrooms_arr = explode(',', $_REQUEST['bedrooms']);
}
if(isset($_REQUEST['bathrooms']) && !empty($_REQUEST['bathrooms']) ) { 
  $bathrooms_arr = explode(',', $_REQUEST['bathrooms']);
}
if(isset($_REQUEST['cabin_style']) && !empty($_REQUEST['cabin_style']) ) { 
  $cabin_style_arr = explode(',', $_REQUEST['cabin_style']);
}
if(isset($_REQUEST['cabin_type']) && !empty($_REQUEST['cabin_type']) ) { 
  $cabin_type_arr = explode(',', $_REQUEST['cabin_type']);
}
if(isset($_REQUEST['cabin_amenity']) && !empty($_REQUEST['cabin_amenity']) ) { 
  $cabin_amenity_arr = explode(',', $_REQUEST['cabin_amenity']);
}
if(isset($_REQUEST['cabin_method']) && !empty($_REQUEST['cabin_method']) ) { 
  $cabin_method_arr = explode(',', $_REQUEST['cabin_method']);
}


?>

<div class="modal fade searchfiltermodal" id="searchfilter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true"><img src="<?php echo get_template_directory_uri(); ?>/images/cancel.svg" alt=""></span>
        <span class="filtertitle">Filters</span>
        <button type="reset" id="reset_search_filter" class="btn clearform">Fjern alle filter</button>
      </div>
      
      <div class="modal-body">
        <div class="formfilter">
        <button class="btn btn-block btn-theme1 btn_advanced_filter"><i class="fa fa-search"></i> <?php _e('Søk', 'hytteguiden'); ?></button>
            <div class="form-group rangeslider">
              <label class="fieldlabel">Pris</label>
              <div class="rangedisplay">
                <div class="rangevalue">Min: <span id="min_price">1.400.000</span></div>
                <div class="rangevalue">Max: <span id="max_price"> 1.950.000</span></div>
              </div>
              <div id="sliderDouble1" class="slider"></div>
            </div>

            <div class="form-group rangeslider">
              <label class="fieldlabel">STØRRELSE</label>
              <div class="rangedisplay">
                <div class="rangevalue">Min: <span id="min_size">1.400.000</span></div>
                <div class="rangevalue">Max: <span id="max_size"> 1.950.000</span></div>
              </div>
              <div id="sliderDouble2" class="slider"></div>
            </div>

            <div class="form-group">
              <label class="fieldlabel">Antall Soverom</label>
              <div class="checkselection" id="home_bedrooms_option">
                <input type="hidden" class="group_checkbox" name="bedrooms" id="bedrooms" value="">
              <?php 
                            $bedrooms_options = array(
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6+' => '6+',
                            );
                            if($bedrooms_options){
                                foreach($bedrooms_options as $key => $value) {
                                  $btn_more_value_mob = ($key == '6+' ? ' btn_more_value_mob' : '');
                                  $checkbox_more = ($key == '6+' ? ' checkbox_more' : ' checkbox_normal');
                            ?>
                <label class="customcheck">
                  <input type="checkbox" class="filter_count <?php echo $checkbox_more; ?>" name="bedrooms[]"  <?php if(isset($bedrooms_arr) && in_array($key, $bedrooms_arr) ) { echo ' checked="checked"'; }?> value="<?php echo $key; ?>">
                  <span class="checkme <?php echo $btn_more_value_mob; ?>"><?php echo $value; ?></span>
                </label>
                <?php } 
                }
                ?>
              </div>
            </div>

            <div class="form-group rangeslider">
              <label class="fieldlabel">ANTALL SENGEPLASSER</label>
              <div class="rangedisplay">
                <div class="rangevalue">Min: <span id="min_beds">1</span></div>
                <div class="rangevalue">Max: <span id="max_beds">15</span></div>
              </div>
              <div id="home_beds_slider" class="slider"></div>
            </div>

            
            <div class="form-group">
              <label class="fieldlabel">ANTALL BAD</label>
              <div class="checkselection" id="home_bathrooms_option">
                <input type="hidden" class="group_checkbox" name="bathrooms" id="bathrooms" value="">
              <?php 
                            $bathrooms_options = array(
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6+' => '6+',
                            );
                            if($bathrooms_options){
                                foreach($bathrooms_options as $key => $value) {
                                  $btn_more_value_mob = ($key == '6+' ? ' btn_more_value_mob' : '');
                                  $checkbox_more = ($key == '6+' ? ' checkbox_more' : ' checkbox_normal');
                            ?>
                <label class="customcheck">
                  <input type="checkbox" class="filter_count <?php echo $checkbox_more; ?>" name="bathrooms[]"  <?php if(isset($bathrooms_arr) && in_array($key, $bathrooms_arr) ) { echo ' checked="checked"'; }?> value="<?php echo $key; ?>">
                  <span class="checkme <?php echo $btn_more_value_mob; ?>"><?php echo $value; ?></span>
                </label>
                <?php } 
                }
                ?>
              </div>
            </div>
            

            <div class="form-group">
              <label class="fieldlabel">STIL</label>
              <div class="row home_checkbox_block">
                  <?php
                      $prod_cat_args = array(
                                  'orderby'                => 'name',
                                  'order'                  => 'ASC',
                                  'hide_empty'             => 0
                                );
                      $cabin_terms = get_terms( 'cabin_style', $prod_cat_args );
                      if ( ! empty( $cabin_terms ) && ! is_wp_error( $cabin_terms ) ) {
                    echo '<input type="hidden" class="group_checkbox" id="home_cabin_style_data" value="">';
                        foreach ( $cabin_terms as $term ) {
                          if(array_key_exists('term_id', $term) ) {
                          ?>
                            <div class="col-6">
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="cabin_style[]" class="custom-control-input"  <?php if(isset($cabin_style_arr) && in_array($term->slug, $cabin_style_arr) ) { echo ' checked="checked"'; }?> value="<?php echo $term->slug; ?>" id="home_<?php echo $term->slug; ?>">
                                <label class="custom-control-label" for="home_<?php echo $term->slug; ?>"><?php echo $term->name; ?></label>
                              </div>
                            </div>

                          <?php
                          }
                        }
                      }
                    ?>
                </div>
            </div>
           

            <div class="form-group">
              <label class="fieldlabel">TILLEGG</label>
              <div class="row home_checkbox_block">
                <?php 
                    $prod_cat_args = array (
                                'orderby'                => 'name',
                                'order'                  => 'ASC',
                                'hide_empty'             => 0
                              );
                    $cabin_terms = get_terms( 'cabin_amenity', $prod_cat_args );
                    if ( ! empty( $cabin_terms ) && ! is_wp_error( $cabin_terms ) ) {
                      echo '<input type="hidden" class="group_checkbox" id="home_cabin_amenity_data" value="">';
                      foreach ( $cabin_terms as $term ) {
                        if(array_key_exists('term_id', $term) ) {
                        ?>
                          <div class="col-6">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input cabin_amenity"  name="cabin_amenity[]" <?php if(isset($cabin_amenity_arr) && in_array($term->slug, $cabin_amenity_arr) ) { echo ' checked="checked"'; }?> value="<?php echo $term->slug; ?>"  id="home_<?php echo $term->slug; ?>">
                        <label class="custom-control-label" for="home_<?php echo $term->slug; ?>"><?php echo $term->name; ?></label>
                      </div>
                    </div>

                        <?php
                        }
                      }
                    }
                  ?>
              </div>
            </div>

            <button class="btn btn-block btn-theme1 btn_advanced_filter"><i class="fa fa-search"></i> <?php _e('Søk', 'hytteguiden'); ?></button>

        </div>
      </div>
    </div>
  </div>
</div>
