<?php
/* Cabin Post metabox
-------------------------------------------------*/
add_action( 'cmb2_admin_init', 'post_meta' );
function post_meta() {
 $prefix = 'post_';

 $producers = array();
 $args = array(
     'post_type' => 'producer',
     'posts_per_page' => -1,
 );
 $query = new WP_Query( $args );
 $producers[0] = __('Select Producer', 'hytteguiden');

 if ($query->have_posts()) {
   while ( $query->have_posts() ) : $query->the_post();
    $producers[get_the_ID()] = get_the_title();
   endwhile;
 }
 wp_reset_query();
  $cmb_demo = new_cmb2_box( array(
    'id'            => $prefix . 'metabox',
    'title'         => esc_html__( 'News Additional Meta', 'cmb2' ),
    'object_types'  => array( 'post' ), 
  ) );

  $cmb_demo->add_field( array(
    'name'             => esc_html__( 'Producer', 'cmb2' ),
    'desc'             => esc_html__( 'Choose Producer (optional)', 'cmb2' ),
    'id'               => $prefix . 'producer_id',
    'type'             => 'select',
    'show_option_none' => false,
    'options'          => $producers,
  ) );
}

add_action( 'cmb2_admin_init', 'cabin_meta' );
function cabin_meta() {
 $prefix = 'cabin_';

 $producers = array();
 $args = array(
     'post_type' => 'producer',
     'posts_per_page' => -1,
 );
 $query = new WP_Query( $args );
 $producers[0] = __('Select Producer', 'hytteguiden');

 if ($query->have_posts()) {
   while ( $query->have_posts() ) : $query->the_post();
    $producers[get_the_ID()] = get_the_title();
   endwhile;
 }
 wp_reset_query();

 $cmb_demo = new_cmb2_box( array(
   'id'            => $prefix . 'metabox',
   'title'         => esc_html__( 'Cabin Additional Meta', 'cmb2' ),
   'object_types'  => array( 'cabin' ), // Post type
   // 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
   // 'context'    => 'normal',
   // 'priority'   => 'high',
   // 'show_names' => true, // Show field names on the left
   // 'cmb_styles' => false, // false to disable the CMB stylesheet
   // 'closed'     => true, // true to keep the metabox closed by default
   // 'classes'    => 'extra-class', // Extra cmb2-wrap classes
   // 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
 ) );

 $cmb_demo->add_field( array(
   'name' => esc_html__( 'Featured Item', 'cmb2' ),
   'desc' => esc_html__( 'Featured Item', 'cmb2' ),
   'id'   => $prefix . 'feature_item',
   'type' => 'checkbox',
 ) );

 $cmb_demo->add_field( array(
   'name'             => esc_html__( 'Producer', 'cmb2' ),
   'desc'             => esc_html__( 'Choose Producer (optional)', 'cmb2' ),
   'id'               => $prefix . 'producer_id',
   'type'             => 'select',
   'show_option_none' => false,
   'options'          => $producers,
 ) );

 $cmb_demo->add_field( array(
   'name'       => esc_html__( 'BYA', 'cmb2' ),
   'description'       => __( 'Legg til BYA for hytte (m<sup>2</sup>).', 'cmb2' ),
   'id'         => $prefix . 'base_area',
   'attributes'  => array('placeholder' => 'BYA'),
   'type'       => 'text',
 ) );

 $cmb_demo->add_field( array(
   'name'       => __( 'BRA <span class="hytte_tooltip">*</span>', 'cmb2' ),
   'id'         => $prefix . 'utility_area',
   'description'       => __( 'Legg til BRA for hytte (m<sup>2</sup>).', 'cmb2' ),
   'attributes'  => array('placeholder' => 'BRA', 'data-validation' => 'required', 'class' => 'hytte_required'),
   'type'       => 'text',
   'default' => '0',
 ) );

 $cmb_demo->add_field( array(
   'name'       => esc_html__( 'BTA', 'cmb2' ),
   'id'         => $prefix . 'build_area',
   'description'       =>  __( 'Legg til BTA for hytte (m<sup>2</sup>).', 'cmb2' ),
   'attributes'  => array('placeholder' => 'BTA'),
   'type'       => 'text',
 ) );

 $cmb_demo->add_field( array(
   'name'       => esc_html__( 'P-ROM', 'cmb2' ),
   'id'         => $prefix . 'gross_area',
   'description'       => __( 'Legg til P-ROM for hytte (m<sup>2</sup>).', 'cmb2' ),
   'attributes'  => array('placeholder' => 'P-ROM'),
   'type'       => 'text',
 ) );

 $cmb_demo->add_field( array(
   'name'       => esc_html__( 'Lengde', 'cmb2' ),
   'id'         => $prefix . 'length_width',
   'description'       => esc_html__( 'Legg til Lengde for hytte (m).', 'cmb2' ),
   'attributes'  => array('placeholder' => 'Lengde'),
   'type'       => 'text',
 ) );

 $cmb_demo->add_field( array(
   'name'       => esc_html__( 'Bredde', 'cmb2' ),
   'id'         => $prefix . 'width',
   'description'       => esc_html__( 'Legg til Bredde for hytte (m).', 'cmb2' ),
   'attributes'  => array('placeholder' => 'Bredde'),
   'type'       => 'text',
 ) );

 $cmb_demo->add_field( array(
   'name'       => esc_html__( 'Mønehøyde', 'cmb2' ),
   'id'         => $prefix . 'moon_height',
   'description'       => esc_html__( 'Legg til Mønehøyde for hytte (m).', 'cmb2' ),
   'attributes'  => array('placeholder' => 'Mønehøyde'),
   'type'       => 'text',
 ) );

 $cmb_demo->add_field( array(
   'name'       => esc_html__( 'Antall soverom', 'cmb2' ),
   'id'         => $prefix . 'bedroom',
   'description'       => esc_html__( 'Legg til Antall soverom.', 'cmb2' ),
   'attributes'  => array('placeholder' => 'Antall soverom'),
   'type'       => 'text',
 ) );

 $cmb_demo->add_field( array(
   'name'       => esc_html__( 'Antall bad', 'cmb2' ),
   'id'         => $prefix . 'bathroom',
   'description'       => esc_html__( 'Legg til Antall bad.', 'cmb2' ),
   'attributes'  => array('placeholder' => 'Antall bad'),
   'type'       => 'text',
 ) );

 $cmb_demo->add_field( array(
   'name'       => __( 'Antall senger <span class="hytte_tooltip">*</span>', 'cmb2' ),
   'id'         => $prefix . 'beds',
   'description'       => esc_html__( 'Legg til Antall senger.', 'cmb2' ),
   'attributes'  => array('placeholder' => 'Antall senger', 'class' => 'hytte_required'),
   'type'       => 'text',
   'default' => '0',
 ) );

 $cmb_demo->add_field( array(
   'name'       => esc_html__( 'Pris byggesett', 'cmb2' ),
   'id'         => $prefix . 'price_kit',
   'description'       => esc_html__( 'Legg til Pris byggesett.', 'cmb2' ),
   'attributes'  => array('placeholder' => 'Pris byggesett'),
   'type'       => 'text',
 ) );

 $cmb_demo->add_field( array(
   'name'       => __( 'Pris nøkkelferdig <span class="hytte_tooltip">*</span>', 'cmb2' ),
   'id'         => $prefix . 'price_turnkey',
   'description'       => esc_html__( 'Legg til Pris nøkkelferdig.', 'cmb2' ),
   'attributes'  => array('placeholder' => 'Pris nøkkelferdig', 'class' => 'hytte_required'),
   'type'       => 'text',
   'default' => '0',
 ) );

 $cmb_demo->add_field( array(
   'name'       => __( 'Hems (m<sup>2</sup>)', 'cmb2' ),
   'id'         => $prefix . 'hems',
   'description'       => __( 'Legg til Hems (m<sup>2</sup>).', 'cmb2' ),
   'attributes'  => array('placeholder' => 'Hems (m<sup>2</sup>)'),
   'type'       => 'text',
 ) );

 $cmb_demo->add_field( array(
   'name'       => __( 'Oppstugu (m<sup>2</sup>)', 'cmb2' ),
   'id'         => $prefix . 'rise',
   'description'       => __( 'Legg til Oppstugu (m<sup>2</sup>).', 'cmb2' ),
   'attributes'  => array('placeholder' => 'Oppstugu (m<sup>2</sup>)'),
   'type'       => 'text',
 ) );

 $cmb_demo->add_field( array(
   'name'       => __( 'BOD (m<sup>2</sup>)', 'cmb2' ),
   'id'         => $prefix . 'bod',
   'description'       => __( 'Legg til BOD (m<sup>2</sup>).', 'cmb2' ),
   'attributes'  => array('placeholder' => 'BOD '),
   'type'       => 'text',
 ) );

 $cmb_demo->add_field( array(
   'name'       => esc_html__( 'Youtube Link', 'cmb2' ),
   'id'         => $prefix . 'youtube_link',
   'attributes'  => array('placeholder' => 'Youtube Link'),
   'type'       => 'text_url',
 ) );

 $cmb_demo->add_field( array(
   'name' => 'Location',
   'desc' => 'Drag the marker to set the exact location',
   'id' => $prefix . 'location',
   'type' => 'pw_map',
   'split_values' => true, // Save latitude and longitude as two separate fields
 ) );

 $cmb_demo->add_field( array(
   'name'         => esc_html__( 'Images Gallery', 'cmb2' ),
   'desc'         => esc_html__( 'Upload or add multiple images.', 'cmb2' ),
   'id'           => $prefix . 'images_galleries',
   'type'         => 'file_list',
   'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
 ) );
 
/* Floor Plan
------------------------------ */
 $cmb_floor_plan = new_cmb2_box( array(
   'id'            => $prefix . 'floor_plan',
   'title'         => esc_html__( 'Floor Plan', 'cmb2' ),
   'object_types'  => array( 'cabin' ), // Post type
 ) );

 $cmb_floor_plan->add_field( array(
   'name'         => esc_html__( 'Floor Plan Image Gallery', 'cmb2' ),
   'desc'         => esc_html__( 'Upload or add multiple images for drawings of cabin area.', 'cmb2' ),
   'id'           => $prefix . 'floor_plan_galleries',
   'type'         => 'file_list',
   'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
 ) );
}


/* Cabin Post metabox
-------------------------------------------------*/
add_action( 'cmb2_admin_init', 'producer_meta' );
function producer_meta() {
 $prefix = 'producer_';

 $cmb_producer = new_cmb2_box( array(
   'id'            => $prefix . 'producer',
   'title'         => esc_html__( 'Producers Additional Meta', 'cmb2' ),
   'object_types'  => array( 'producer' ), // Post type
 ) );

 $cmb_producer->add_field( array(
   'name'             => esc_html__( 'Membership Options', 'cmb2' ),
   'desc'             => esc_html__( 'Select membership type.', 'cmb2' ),
   'id'               => $prefix . 'membership',
   'type'             => 'radio_inline',
   'show_option_none' => 'None',
   'options'          => array(
     '1' => esc_html__( 'Standard -', 'cmb2' ),
     '2' => esc_html__( 'Standard', 'cmb2' ),
     '3' => esc_html__( 'Standard +', 'cmb2' ),
     '4' => esc_html__( 'Standard VIP ', 'cmb2' ),
     '5' => esc_html__( 'Premium -', 'cmb2' ),
     '6' => esc_html__( 'Premium', 'cmb2' ),
     '7' => esc_html__( 'Premium +', 'cmb2' ),
     '8' => esc_html__( 'Premium ++', 'cmb2' ),
     '9' => esc_html__( 'Premium ++', 'cmb2' ),
   ),
 ) );
 
 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'TagLine', 'cmb2' ),
   'id'         => $prefix . 'tagling',
   'attributes'  => array('placeholder' => 'TagLine'),
   'type'       => 'text',
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Website', 'cmb2' ),
   'id'         => $prefix . 'website',
   'attributes'  => array('placeholder' => 'Website'),
   'type'       => 'text',
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Email', 'cmb2' ),
   'id'         => $prefix . 'email',
   'attributes'  => array('placeholder' => 'Email'),
   'type'       => 'text_email',
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Address', 'cmb2' ),
   'id'         => $prefix . 'address',
   'attributes'  => array('placeholder' => 'Address'),
   'type'       => 'text',
 ) );

 $cmb_producer->add_field( array(
  'name'       => esc_html__( 'Zip Code', 'cmb2' ),
  'id'         => $prefix . 'zip_code',
  'attributes'  => array('placeholder' => 'Zip Code'),
  'type'       => 'text',
) );

$cmb_producer->add_field( array(
  'name'       => esc_html__( 'Country Code', 'cmb2' ),
  'id'         => $prefix . 'country_code',
  'attributes'  => array('placeholder' => 'Country Code'),
  'type'       => 'text',
) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'VAT ID', 'cmb2' ),
   'id'         => $prefix . 'vat_id',
   'attributes'  => array('placeholder' => 'Enter VAT ID here...'),
   'type'       => 'text',
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Contact Phone 1', 'cmb2' ),
   'id'         => $prefix . 'contact_phone_1',
   'attributes'  => array('placeholder' => 'Contact Phone 1'),
   'type'       => 'text',
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Contact Phone 2', 'cmb2' ),
   'id'         => $prefix . 'contact_phone_2',
   'attributes'  => array('placeholder' => 'Contact Phone 2'),
   'type'       => 'text',
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Facebook Link', 'cmb2' ),
   'id'         => $prefix . 'facebook_link',
   'attributes'  => array('placeholder' => 'Facebook Link'),
   'type'       => 'text_url',
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Twitter Link', 'cmb2' ),
   'id'         => $prefix . 'twitter_link',
   'attributes'  => array('placeholder' => 'Twitter Link'),
   'type'       => 'text_url',
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Instagram Link', 'cmb2' ),
   'id'         => $prefix . 'instagram_link',
   'attributes'  => array('placeholder' => 'Instagram Link'),
   'type'       => 'text_url',
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Google+ Link', 'cmb2' ),
   'id'         => $prefix . 'gplus_link',
   'attributes'  => array('placeholder' => 'Google+ Link'),
   'type'       => 'text_url',
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Linkedin Link', 'cmb2' ),
   'id'         => $prefix . 'linkedin_link',
   'attributes'  => array('placeholder' => 'Linkedin Link'),
   'type'       => 'text_url',
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Youtube Link', 'cmb2' ),
   'id'         => $prefix . 'youtube_link',
   'attributes'  => array('placeholder' => 'Youtube Link'),
   'type'       => 'text_url',
 ) );

 $cmb_producer->add_field( array(
    'name' => 'Location',
    'desc' => 'Drag the marker to set the exact location',
    'id' => $prefix . 'location',
    'type' => 'pw_map',
    'split_values' => true, // Save latitude and longitude as two separate fields
 ) );

 $cmb_producer->add_field( array(
   'name'         => esc_html__( 'Banner Image', 'cmb2' ),
   'desc'         => esc_html__( 'Upload or add banner image.', 'cmb2' ),
   'id'           => $prefix . 'banner',
   'type'         => 'file',
 ) );

 $cmb_producer->add_field( array(
  'name'    => __( 'Attached Posts', 'cmb2' ),
  'desc'    => __( 'Drag posts from the left column to the right column to attach them to this page.<br />You may rearrange the order of the posts in the right column by dragging and dropping.', 'cmb2' ),
  'id'      => 'link_avdeling',
  'type'    => 'custom_attached_posts',
  'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
  'options' => array(
    'show_thumbnails' => true, // Show thumbnails on the left
    'filter_boxes'    => true, // Show a text box for filtering the results
    'query_args'      => array(
      'posts_per_page' => 10,
      'post_type'      => array('avdeling')
    ), // override the get_posts args
  ),
) );
 
}
add_action( 'cmb2_admin_init', 'page_custom_field' );
function page_custom_field() {
 $prefix = 'page_';

 $cmb_producer = new_cmb2_box( array(
   'id'            => $prefix . '',
   'title'         => esc_html__( 'Additional Fields', 'cmb2' ),
   'object_types'  => array( 'page' ), // Post type
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Page Title', 'cmb2' ),
   'id'         => $prefix . 'title',
   'attributes'  => array('placeholder' => 'Enter Page Title'),
   'type'       => 'text',
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Sub Title', 'cmb2' ),
   'id'         => $prefix . 'sub_title',
   'attributes'  => array('placeholder' => 'Enter Sub Title'),
   'type'       => 'text',
 ) );

 $cmb_producer->add_field( array(
  'name'         => esc_html__( 'Banner Image', 'cmb2' ),
  'desc'         => esc_html__( 'Upload or add banner image.', 'cmb2' ),
  'id'           => $prefix . 'banner',
  'type'         => 'file',
) );
}
// custom meta fields for department
add_action( 'cmb2_admin_init', 'department_custom_meta' );
function department_custom_meta() {
 $prefix = 'department_';

 $cmb_producer = new_cmb2_box( array(
   'id'            => $prefix . '',
   'title'         => esc_html__( 'Department Additional Meta', 'cmb2' ),
   'object_types'  => array( 'avdeling' ), // Post type
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Address', 'cmb2' ),
   'id'         => $prefix . 'address',
   'attributes'  => array('placeholder' => 'Address'),
   'type'       => 'text',
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Contact Phone', 'cmb2' ),
   'id'         => $prefix . 'contact_phone',
   'attributes'  => array('placeholder' => 'Contact Phone 1'),
   'type'       => 'text',
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Email', 'cmb2' ),
   'id'         => $prefix . 'email',
   'attributes'  => array('placeholder' => 'Email'),
   'type'       => 'text_email',
 ) );

 $cmb_producer->add_field( array(
   'name'       => esc_html__( 'Website', 'cmb2' ),
   'id'         => $prefix . 'website',
   'attributes'  => array('placeholder' => 'Website'),
   'type'       => 'text',
 ) );
}
    add_action( 'cmb2_admin_init', 'producer_avdelinger_meta' );
    function producer_avdelinger_meta() {
     $prefix = 'avdelinger_';
    
     $cmb_group = new_cmb2_box( array(
      'id'           => $prefix . 'avdelinger',
      'title'        => esc_html__( 'Ansatte Information', 'cmb2' ),
      'object_types' => array( 'avdeling' ),
    ) );


    
    // $group_field_id is the field id string, so in this case: $prefix . 'demo'
    $group_field_id = $cmb_group->add_field( array(
      'id'          => $prefix . 'producer_avdelinger',
      'type'        => 'group',
      'options'     => array(
        'group_title'   => esc_html__( 'Ansatte {#}', 'cmb2' ), // {#} gets replaced by row number
        'add_button'    => esc_html__( 'Add Another Ansatte', 'cmb2' ),
        'remove_button' => esc_html__( 'Remove Ansatte', 'cmb2' ),
        'sortable'      => true,
        // 'closed'     => true, // true to have the groups closed by default
      ),
    ) );
 
     $cmb_group->add_group_field( $group_field_id, array(
       'name'       => esc_html__( 'Navn', 'cmb2' ),
       'id'         => 'name',
       'type'       => 'text',
     ) );
 
     $cmb_group->add_group_field( $group_field_id, array(
       'name'        => esc_html__( 'Title', 'cmb2' ),
       'description' => esc_html__( 'Add title', 'cmb2' ),
       'id'          => 'title',
       'type'        => 'text',
     ) );
 
     $cmb_group->add_group_field( $group_field_id, array(
       'name' => esc_html__( 'Phone', 'cmb2' ),
       'id'   => 'phone',
       'type' => 'text',
     ) );
 
     $cmb_group->add_group_field( $group_field_id, array(
       'name' => esc_html__( 'Email', 'cmb2' ),
       'id'   => 'email',
       'type' => 'text',
     ) ); 

     $cmb_group->add_group_field( $group_field_id, array(
      'name'         => esc_html__( 'Bilde', 'cmb2' ),
      'desc'         => esc_html__( 'Last opp bildet av ansatt.', 'cmb2' ),
      'id'           => $prefix . 'banner',
      'type'         => 'file',
    ) );

    
 
}
add_action( 'cmb2_admin_init', 'catalogs_meta_boxes' );
/**
 * Define the metabox and field configurations.
 */
function catalogs_meta_boxes() {

	// Start with an underscore to hide fields from custom fields list
  $prefix = '_catalogs_';
  

  $producers = array();
  $args = array(
      'post_type' => 'producer',
      'posts_per_page' => -1,
  );
  $query = new WP_Query( $args );
  $producers[0] = __('Velge Produsent', 'hytteguiden');

  if ($query->have_posts()) {
    while ( $query->have_posts() ) : $query->the_post();
      $producers[get_the_ID()] = get_the_title();
    endwhile;
  }
  wp_reset_query();

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(

		'id'            => 'catalog_box',
		'title'         => __( 'Catalog Additional Meta', 'cmb2' ),
		'object_types'  => array( 'kataloger', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, 
	) );

  $cmb->add_field( array(
    'name'             => esc_html__( 'Produsenter', 'cmb2' ),
    'desc'             => esc_html__( 'Tilordne denne katalogen til produsent', 'cmb2' ),
    'id'               => $prefix . 'producer_id',
    'type'             => 'select',
    'show_option_none' => false,
    'options'          => $producers,
  ) );
 

	$cmb->add_field( array(
		'name'       => __( 'ID Helthjem', 'cmb2' ),
		'desc'       => __( 'Legg til id for helthjem', 'cmb2' ),
		'id'         => $prefix . 'helthjem',
		'type'       => 'text',
	) );
  

}
add_action( 'cmb2_init', 'attach_posts_to_cabin' );
function attach_posts_to_cabin() {

	$attach_data = new_cmb2_box( array(
		'id'           => 'attach',
		'title'        => __( 'Attached Posts', 'cmb2' ),
		'object_types' => array( 'producer' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => false, // Show field names on the left
	) );

	$attach_data->add_field( array(
		'name'    => __( 'Attached Posts', 'cmb2' ),
		'desc'    => __( 'Drag posts from the left column to the right column to attach them to this page.<br />You may rearrange the order of the posts in the right column by dragging and dropping.', 'cmb2' ),
		'id'      => 'link_post',
		'type'    => 'custom_attached_posts',
		'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
		'options' => array(
			'show_thumbnails' => true, // Show thumbnails on the left
			'filter_boxes'    => true, // Show a text box for filtering the results
			'query_args'      => array(
				'posts_per_page' => 10,
				'post_type'      => array('post')
			), // override the get_posts args
		),
	) );

}
?>
