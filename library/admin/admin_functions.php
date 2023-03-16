<?php 
/* Get  all data from custom table */
function hytte_all_data( $tbl_name, $cond = '', $per_page = 5, $page_number = 1, $orderby = 'id', $order = 'desc' ) {

    global $wpdb;
  
    $sql = 'SELECT * FROM ' . $wpdb->prefix . $tbl_name . ' WHERE 1= 1';  
    
    if($cond != '' ){
        $sql .= $cond;
    }

    $sql .= ' ORDER BY ' .$orderby;
    $sql .= ' '.$order;  
    $sql .= " LIMIT $per_page";
  
    $sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;

    //echo $sql;
      
    $result = $wpdb->get_results( $sql );
  
    return $result;
}

function hytte_record_count( $tbl_name, $cond = '') {
    global $wpdb;
  
    $sql = 'SELECT COUNT(*) FROM ' . $wpdb->prefix . $tbl_name . ' WHERE 1= 1'; 
    if($cond != '' ){
        $sql .= $cond;
    }

    return $wpdb->get_var( $sql );
  }

  /* Delete record from table */
  function hytte_delete_record( $tbl_name, $pk_field = 'id', $pk_val = '') {
    global $wpdb;
  
    $sql = 'delete from ' . $wpdb->prefix . $tbl_name . ' WHERE '. $pk_field.'= '. $pk_val; 
    $wpdb->query($sql);
  }

    /* update record from table */
    function hytte_update_field( $tbl_name, $update_field, $update_val, $pk_field = 'id', $pk_val = '') {
        global $wpdb;
      
        $sql = 'update ' . $wpdb->prefix . $tbl_name . ' SET '. $update_field.' = "'. $update_val .'" WHERE '. $pk_field.'= '. $pk_val; 
        $wpdb->query($sql);
      }

    /* Delete record from table */ 
    function hytte_delete_cond_data( $tbl_name, $cond = '') {
        global $wpdb;
      
        $sql = 'delete from ' . $wpdb->prefix . $tbl_name .  ' WHERE 1= 1'; 
        
        if($cond != '' ){
            $sql .= $cond;
        }
        $wpdb->query($sql);
      }
    
    /* Get row from table */
    function hytte_row_from_table($tbl_name, $cond = ''){
        global $wpdb;

        $sql = 'SELECT * FROM '. $wpdb->prefix . $tbl_name . ' WHERE 1 = 1'; 
        if($cond != '' ){
            $sql .= $cond;
        }

        $row_data = $wpdb->get_row($sql);
        return $row_data;
    } 

    /* Delete record from table */ 
    function hytte_postmeta_mm_value( $meta_key, $option = 'min') {
        global $wpdb;
        $content = '';

        $args = array( 
            'post_type' => 'cabin',
            'posts_per_page' => 1,
            'orderby'  => 'meta_value_num',
            'meta_key'  => $meta_key,
            'order'  => 'ASC'
        );

        if($option == 'max'){
            $args['order'] = 'DESC';
        }

        $mm_posts = get_posts( $args );
        if($mm_posts){

            foreach( $mm_posts as $post ) :
                setup_postdata($post);
                $content = get_post_meta($post->ID, $meta_key, true);
            endforeach;
            wp_reset_postdata(); 
        }
        $content = str_replace(",",".",$content);
        $content = hytte_round_up($content, 0);
        return $content;
    }

    /* Hytte round up  */
    function hytte_round_up($number, $precision = 2) {
        $fig = (int) str_pad('1', $precision, '0');
        return (ceil($number * $fig) / $fig);
    }

    /* Hidden value save for Hytte */
    function hytte_save_membership_data_on_cabin($post_id){

        global $wpdb;

        if ( $the_post = wp_is_post_revision($post_id) ){
			$post_id = $the_post;
        }
        if ( $_POST['post_type'] != 'cabin' )   {
            return $post_id;
        }

        if ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
        }
        
        if(isset($_POST["cabin_producer_id"])){
            $membership_val = 0;
            $producer_membership = get_post_meta($_POST["cabin_producer_id"], 'producer_membership', true);
            if(!empty($producer_membership)){
                $membership_val = $producer_membership;                
            }
            update_post_meta($post_id, 'membership_value', $membership_val);
        }

    }

        /* Hidden value save for Producer */
        function hytte_save_membership_data_on_producer($post_id){

            global $wpdb;
    
            if ( $the_post = wp_is_post_revision($post_id) ){
                $post_id = $the_post;
            }
            if ( $_POST['post_type'] != 'producer' )   {
                return $post_id;
            }
    
            if ( !current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }

            $args = array(
                'post_type' => 'cabin',
                'posts_per_page' => -1,
                'meta_query' => array(
                                    array(
                                        'key'     => 'cabin_producer_id',
                                        'value'   => $post_id,
                                        'compare' => '='
                                    )
                            )
            );

            $membership_value = 0;
            if(isset($_POST["producer_membership"]) && !empty($_POST["producer_membership"])){
                $membership_value = $_POST["producer_membership"];
            }

            $producers = get_posts( $args );
            if($producers){
                foreach( $producers as $post ) :
                    setup_postdata($post);

                    update_post_meta($post->ID, 'membership_value', $membership_value);

                endforeach;
                wp_reset_postdata();       
            }
    
        }
    add_action('save_post', 'hytte_save_membership_data_on_cabin');	
    add_action('save_post', 'hytte_save_membership_data_on_producer');	


    /* Function to get the font variant on change of font from customizer */
if ( ! function_exists( 'hytteguiden_font_variant' ) ) {
	function hytteguiden_font_variant() {
		$hytteguiden_font	= $_POST['font'];
		$font_id 		= $_POST['font_id'];
		$hytteguiden_value	= array();
		$option_label	= '';
		$option_value	= '';
		$check_heading	= 'no';

		if( empty( $hytteguiden_font ) ) {
			$exploded_font_id = explode( '-', $font_id );
			$heading_tags_arr = array( 'h1_font', 'h2_font', 'h3_font', 'h4_font', 'h5_font', 'h6_font' );
			if( in_array( end( $exploded_font_id ), $heading_tags_arr ) ) $check_heading = 'yes';
			if( 'yes' == $check_heading ) $hytteguiden_font = 'Josefin+Sans';
			else $hytteguiden_font = 'Montserrat';
		}
		else {
			$selected_font = explode( '%%', $hytteguiden_font );
			if( isset( $selected_font[0] ) && ! empty( $selected_font[0] ) ) {
				$hytteguiden_font = $selected_font[0];
			}
			else {
				$hytteguiden_font = 'Montserrat';
			}
		}
		$default_val  = $hytteguiden_font . ':regular';

		/* Variants */
		$hytteguiden_default_select	 = __( 'Select Font Variant', 'hytteguiden' );
		$hytteguiden_font_lists 	 	 = get_transient( 'google_fonts_variant_lists' );
		$hytteguiden_value['variant'] = '<select>';
			if ( false === $hytteguiden_font_lists ) {
			}
			else{
				if( isset( $hytteguiden_font_lists[$hytteguiden_font] ) && ! empty( $hytteguiden_font_lists[$hytteguiden_font] ) ) {
					$hytteguiden_variants = $hytteguiden_font_lists[$hytteguiden_font]['variants'];
					foreach( $hytteguiden_variants as $hytteguiden_v ) {
						if( 'italic' == $hytteguiden_v ) {
                            $option_label = 'Italic';
                            $option_value = $hytteguiden_font . ':400i';
                        }
                        else if( strpos( $hytteguiden_v, 'italic' ) ) {
                            $exp_val = explode( 'italic', $hytteguiden_v );
                            if( isset( $exp_val[0] ) && ! empty( $exp_val[0] ) ) {
                            	$option_label = $exp_val[0] . ' Italic';
                            	$option_value = $hytteguiden_font . ':' . $exp_val[0] . "i";
                            }
                        }
                        else {
                            $option_label = ucfirst( $hytteguiden_v );
                            $option_value = $hytteguiden_font . ':' . $hytteguiden_v;
                        }
						$hytteguiden_value['variant'] .= '<option value="' . $option_value . '" ' . selected( $default_val, $option_value, false ) . '>' . $option_label . '</option>';
					}
				}
			}
		$hytteguiden_value['variant'] .= '</select>';

		$font_id_exp = explode( '-control-', $font_id );
		if( isset( $font_id_exp[1] ) && ! empty( $font_id_exp[1] ) ) set_theme_mod( $font_id_exp[1] . '_variant', $default_val );

		/* Subset */
		$hytteguiden_value['subsets'] = '';
			if ( false === $hytteguiden_font_lists ) {
			}
			else{

				$hytteguiden_subset =  '_subset';
				if( isset( $font_id_exp[1] ) && !empty($font_id_exp[1]) ){
					$hytteguiden_subset = get_theme_mod( $font_id_exp[1] . '_subset' );
				}

				$multi_values  = !is_array( $hytteguiden_subset ) ? explode( ',', $hytteguiden_subset ) : $hytteguiden_subset;
				$subsets = $hytteguiden_font_lists[$hytteguiden_font]['subsets'];
				asort( $subsets );
				foreach( $subsets as $id => $subset ) :
					$exploded    = explode( '-', $subset );
					$first_text  = ( isset( $exploded[0] ) ? ucfirst( $exploded[0] ) : ucfirst( $subset ) );
					$second_text = ( isset( $exploded[1] ) ? 'Extended' : '' );
					$show_text 	 = $first_text . ' ' . $second_text;

					$checked  = ( 'latin' == $subset ) ? 'checked="checked" disabled="disabled"' : checked( in_array( $subset, $multi_values ), true, false );

		            $hytteguiden_value['subsets'] .= '<li>';
		                $hytteguiden_value['subsets'] .= '<label>';
		                    $hytteguiden_value['subsets'] .= '<input type="checkbox" value="' . esc_attr( $subset ) . '" ' . $checked . ' />';
		                    $hytteguiden_value['subsets'] .= esc_html( $show_text );
		                $hytteguiden_value['subsets'] .= '</label>';
		            $hytteguiden_value['subsets'] .= '</li>';
		    	endforeach;
			}

		$font_id_exp = explode( '-control-', $font_id );
		if( isset( $font_id_exp[1] ) && ! empty( $font_id_exp[1] ) ) remove_theme_mod( $font_id_exp[1] . '_subset' );

		echo json_encode( $hytteguiden_value );
		exit;

	}
}
add_action('wp_ajax_hytteguiden_font_variant', 'hytteguiden_font_variant');
  
?>