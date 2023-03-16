<?php 
$bedrooms = '';
$bathrooms = '';
$beds = '';
$request_cabin_style = '';
$arr_cabin_style = array();
$request_cabin_amenity = '';
$arr_cabin_amenity = array();

/* Search Text Array */
$search_text = array(
    'price' => '',
    'size' => '',
    'bedrooms' => '',
    'bathrooms' => '',
    'beds' => '',
    'cabin_style' => '',
    'cabin_amenity' => '',
    'query_text' => '',
);


if(isset($_REQUEST['bedrooms']) && !empty($_REQUEST['bedrooms']) ) { 
    $bedrooms = $_REQUEST['bedrooms']; 
    $search_text['bedrooms'] = __('Soverom : ', 'hytteguiden') . $_REQUEST['bedrooms'] . ' <i class="fa fa-times delete bedrooms"></i>';
}
$bedrooms_arr = explode(',', $bedrooms);

if(isset($_REQUEST['bathrooms']) && !empty($_REQUEST['bathrooms']) ) { 
    $bathrooms = $_REQUEST['bathrooms']; 
    $search_text['bathrooms'] = __('Antall Bad : ', 'hytteguiden') . $_REQUEST['bathrooms'] . ' <i class="fa fa-times delete bathrooms"></i>';
}
$bathrooms_arr = explode(',', $bathrooms);


if(isset($_REQUEST['cabin_style']) && !empty($_REQUEST['cabin_style']) ) { 
    $request_cabin_style = $_REQUEST['cabin_style']; 
    $arr_cabin_style = explode(",",$request_cabin_style);
    $search_text['cabin_style'] = __('Stil : ', 'hytteguiden') . $_REQUEST['cabin_style'] . ' <i class="fa fa-times delete style"></i>';
}


if(isset($_REQUEST['cabin_amenity']) && !empty($_REQUEST['cabin_amenity']) ) { 
    $request_cabin_amenity = $_REQUEST['cabin_amenity']; 
    $arr_cabin_amenity = explode(",",$request_cabin_amenity);
    $search_text['cabin_amenity'] = __('Tillegg : ', 'hytteguiden') . $_REQUEST['cabin_amenity'] . ' <i class="fa fa-times delete amenity"></i>';
}


/* Search Text  */
if(( isset($_REQUEST['min_price']) && $_REQUEST['min_price'] == $GLOBALS['slider_defaults']['slider_min_price']) && (isset($_REQUEST['max_price']) && $_REQUEST['max_price'] == $GLOBALS['slider_defaults']['slider_max_price'] )){
    $search_text['price'] = '';
} else if(( isset($_REQUEST['min_price']) && $_REQUEST['min_price'] != '') && (isset($_REQUEST['max_price']) && $_REQUEST['max_price'] != '')){
    $search_text['price'] = __('Pris : ', 'hytteguiden') . $_REQUEST['min_price'] . ' - '. $_REQUEST['max_price']. ' <i class="fa fa-times delete price"></i>';
}

if(( isset($_REQUEST['min_size']) && $_REQUEST['min_size'] == $GLOBALS['slider_defaults']['slider_min_size'] ) && (isset($_REQUEST['max_size']) && $_REQUEST['max_size'] == $GLOBALS['slider_defaults']['slider_max_size'])){
    $search_text['size'] = '';
} else if(( isset($_REQUEST['min_size']) && $_REQUEST['min_size'] != '') && (isset($_REQUEST['max_size']) && $_REQUEST['max_size'] != '')){
    $search_text['size'] = __('Størrelse : ', 'hytteguiden') . $_REQUEST['min_size'] . ' - '. $_REQUEST['max_size']. ' <i class="fa fa-times delete size"></i>';
}

if(( isset($_REQUEST['min_size']) && $_REQUEST['min_size'] == $GLOBALS['slider_defaults']['slider_min_beds'] ) && (isset($_REQUEST['max_size']) && $_REQUEST['max_size'] == $GLOBALS['slider_defaults']['slider_max_beds'])){
    $search_text['beds'] = '';
} else if(( isset($_REQUEST['min_beds']) && $_REQUEST['min_beds'] != '') && (isset($_REQUEST['max_beds']) && $_REQUEST['max_beds'] != '')){
    $search_text['beds'] = __('Sengeplasser : ', 'hytteguiden') . $_REQUEST['min_beds'] . ' - '. $_REQUEST['max_beds']. ' <i class="fa fa-times delete beds"></i>';
}

if(isset($_REQUEST['s']) && !empty($_REQUEST['s'])){
	$search_text['query_text'] = __('Søkeord : ', 'hytteguiden') . $_REQUEST['s'] . ' <i class="fa fa-times delete query_text"></i>';
}



?>
<div class="tagmodules tagmoduleswrap">
    
    <span id="query_span" <?php echo ($search_text['query_text'] ? ' class="tag-item btn  btn-theme1"' : '');?>><?php echo $search_text['query_text']; ?></span>
    <span id="price_span"  <?php echo ($search_text['price'] ? ' class="tag-item btn  btn-theme1"' : '');?>><?php echo $search_text['price']; ?></span>
    <span id="size_span"  <?php echo ($search_text['size'] ? ' class="tag-item btn  btn-theme1"' : '');?>><?php echo $search_text['size']; ?></span>
    <span id="bedrooms_span"  <?php echo ($search_text['bedrooms'] ? ' class="tag-item btn  btn-theme1"' : '');?>><?php echo $search_text['bedrooms']; ?></span>
    <span id="bathrooms_span"  <?php echo ($search_text['bathrooms'] ? ' class="tag-item btn  btn-theme1"' : '');?>><?php echo $search_text['bathrooms']; ?></span>
    <span id="beds_span"  <?php echo ($search_text['beds'] ? ' class="tag-item btn  btn-theme1"' : '');?>><?php echo $search_text['beds']; ?></span>
    <span id="style_span"  <?php echo ($search_text['cabin_style'] ? ' class="tag-item btn  btn-theme1"' : '');?>><?php echo $search_text['cabin_style']; ?></span>  
    <span id="amenity_span"  <?php echo ($search_text['cabin_amenity'] ? ' class="tag-item btn  btn-theme1"' : '');?>><?php echo $search_text['cabin_amenity']; ?></span>
  

</div>
<div class="formfilter formfilteraside hide-sm-down" id="filter_option_form">
    <form>
        <div class="">
            <div class="card rangeslider">
                <div class="card-header" id="pris">
                    <label class="fieldlabel" data-toggle="collapse" data-target="#acc01" aria-expanded="true" aria-controls="acc01">Pris</label>
                </div>
                <div id="acc01" class="collapse show" aria-labelledby="pris">
                    <div class="card-body">
                        <div class="form-group">
                            <div id="slide_filter_price" class="slider"></div>
                            <div class="rangedisplay">
                                <div class="rangevalue form-group">
                                    <label>Min:</label>
                                    <input type="text" name="pris" id="filter_min_price" class="form-control" placeholder="1 400 000" value="3000.00">
                                </div>
                                <div class="rangevalue form-group">
                                    <label>Max:</label>
                                    <input type="text" name="pris" class="form-control" id="filter_max_price" placeholder="1 950 000" value="100000.00">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card rangeslider">
                <div class="card-header" id="storrelse">
                    <label class="fieldlabel" data-toggle="collapse" data-target="#acc02" aria-expanded="true" aria-controls="acc02">STØRRELSE</label>
                </div>
                <div id="acc02" class="collapse show" aria-labelledby="storrelse">
                    <div class="card-body">
                        <div class="form-group">
                            <div id="slide_filter_size" class="slider"></div>
                            <div class="rangedisplay">
                                <div class="rangevalue form-group">
                                    <label>Min:</label>
                                    <input type="text" name="pris" id="filter_min_size" class="form-control" placeholder="56" value="">
                                </div>
                                <div class="rangevalue form-group">
                                    <label>Max:</label>
                                    <input type="text" name="pris" id="filter_max_size"  class="form-control" placeholder="90" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="antallsoverom">
                    <label class="fieldlabel" data-toggle="collapse" data-target="#acc03" aria-expanded="true" aria-controls="acc03">Antall Soverom</label>
                </div>
                <div id="acc03" class="collapse show" aria-labelledby="antallsoverom">
                    <div class="card-body">
                        <div class="checkselection" id="bedrooms_filter_options">
                            <input type="hidden" class="group_checkbox" name="filter_bedrooms" id="filter_bedrooms" value="<?php echo $bedrooms; ?>">
                            <?php 
                            $bedrooms_options = array(
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6*' => '6+',
                            );
                            if($bedrooms_options){
                                foreach($bedrooms_options as $key => $value) {
                                    $btn_more_value = ($key == '6*' ? ' btn_more_value' : '');
                                    $checkbox_more = ($key == '6*' ? ' checkbox_more' : ' checkbox_normal');
                            ?>
                            <label class="customcheck">
                            <input type="checkbox" name="soverom[]" class="filter_count <?php echo $checkbox_more; ?>" value="<?php echo $key; ?>" <?php if(isset($bedrooms_arr) && in_array($key, $bedrooms_arr) ) { echo ' checked="checked"'; }?>>
                            <span class="checkme <?php echo $btn_more_value; ?>"><?php echo $value; ?></span>
                            </label>
                            <?php
                                }
                            } 
                          ?>
                        </div>
                    </div>
                </div>
            </div>



            <div class="card rangeslider">
                <div class="card-header" id="terrasse">
                    <label class="fieldlabel" data-toggle="collapse" data-target="#acc05" aria-expanded="true" aria-controls="acc05"><?php _e('ANTALL SENGEPLASSER', 'hytteguiden'); ?></label>
                </div>

                <div id="acc05" class="collapse show" aria-labelledby="terrasse">
                    <div class="card-body">
                        <div class="form-group">
                            <div id="slide_filter_beds" class="slider"></div>
                            <div class="rangedisplay">
                                <div class="rangevalue form-group">
                                    <label>Min:</label>
                                    <input type="text" name="beds" class="form-control" id="filter_min_beds" placeholder="0" value="">
                                </div>
                                <div class="rangevalue form-group">
                                    <label>Max:</label>
                                    <input type="text" name="beds" class="form-control" id="filter_max_beds" placeholder="15" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="antallbad">
                    <label class="fieldlabel" data-toggle="collapse" data-target="#acc06" aria-expanded="true" aria-controls="acc06"><?php _e('ANTALL BAD', 'hytteguiden'); ?></label>
                </div>
                <div id="acc06" class="collapse show" aria-labelledby="antallbad">
                    <div class="card-body">
                        <div class="checkselection" id="bathrooms_filter_options">
                        <input type="hidden" class="group_checkbox" name="filter_bathrooms" id="filter_bathrooms" value="<?php echo $bathrooms; ?>">
                            <?php 
                            $bathrooms_options = array(
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6*' => '6+',
                            );
                            if($bathrooms_options){
                                foreach($bathrooms_options as $key => $value) {
                                    $btn_more_value = ($key == '6*' ? ' btn_more_value' : '');
                                    $checkbox_more = ($key == '6*' ? ' checkbox_more' : ' checkbox_normal');
                            ?>
                            <label class="customcheck">
                            <input type="checkbox" name="antallbad[]" class="filter_count <?php echo $checkbox_more; ?>" value="<?php echo $key; ?>" <?php if(isset($bathrooms_arr) && in_array($key, $bathrooms_arr) ) { echo ' checked="checked"'; }?>>
                            <span class="checkme <?php echo $btn_more_value; ?>"><?php echo $value; ?></span>
                            </label>
                            <?php
                                }
                            } 
                          ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="stil">
                    <label class="fieldlabel" data-toggle="collapse" data-target="#acc07" aria-expanded="true" aria-controls="acc07"><?php _e('Stil', 'hytteguiden'); ?></label>
                </div>
                <div id="acc07" class="collapse show" aria-labelledby="stil">
                    <div class="card-body" id="style_filter_options">
                    <?php
                      $prod_cat_args = array (
                                  'orderby'                => 'name',
                                  'order'                  => 'ASC',
                                  'hide_empty'             => 0
                                );
                      $cabin_terms = get_terms( 'cabin_style', $prod_cat_args );
                      if ( ! empty( $cabin_terms ) && ! is_wp_error( $cabin_terms ) ) {
                          echo '<input type="hidden" class="group_checkbox" id="cabin_style_data" value="'. $request_cabin_style.'">';
                        foreach ( $cabin_terms as $term ) {
                          if(array_key_exists('term_id', $term) ) {
                           ?>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" <?php if(isset($arr_cabin_style) && in_array($term->slug, $arr_cabin_style) ) { echo ' checked="checked"'; }?> name="cabin_style[]" class="custom-control-input filter_cabin_style" value="<?php echo $term->slug; ?>"  id="<?php echo $term->slug; ?>">
                          <label class="custom-control-label" for="<?php echo $term->slug; ?>"><?php echo $term->name; ?></label>
                        </div>

                           <?php
                          }
                        }
                      }
                    ?>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="tillegg">
                    <label class="fieldlabel" data-toggle="collapse" data-target="#acc09" aria-expanded="true" aria-controls="acc09">TILLEGG</label>
                </div>
                <div id="acc09" class="collapse show" aria-labelledby="tillegg">
                    <div class="card-body" id="amenity_filter_options">
                    <?php
                    $prod_cat_args = array (
                                'orderby'                => 'name',
                                'order'                  => 'ASC',
                                'hide_empty'             => 0
                              );
                    $cabin_terms = get_terms( 'cabin_amenity', $prod_cat_args );
                    if ( ! empty( $cabin_terms ) && ! is_wp_error( $cabin_terms ) ) {
                        echo '<input type="hidden" class="group_checkbox" id="cabin_amenity_data" value="'. $request_cabin_amenity.'">';
                      foreach ( $cabin_terms as $term ) {
                        if(array_key_exists('term_id', $term) ) {
                         ?>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" <?php if(isset($arr_cabin_amenity) && in_array($term->slug, $arr_cabin_amenity) ) { echo ' checked="checked"'; }?> class="custom-control-input filter_cabin_amenity"  name="cabin_amenity[]" value="<?php echo $term->slug; ?>"  id="<?php echo $term->slug; ?>">
                        <label class="custom-control-label" for="<?php echo $term->slug; ?>"><?php echo $term->name; ?></label>
                      </div>

                         <?php
                        }
                      }
                    }
                  ?>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>