<?php

// hytteguiden custom post taxonomy for Cabin Style
function hytteguiden_cabin_style_tax() {

  $labels = array(
		'name'                       => _x( 'Stil', 'Stil General Name', 'hytteguiden' ),
		'singular_name'              => _x( 'Stil', 'Stil Singular Name', 'hytteguiden' ),
		'menu_name'                  => __( 'Stil', 'hytteguiden' ),
		'all_items'                  => __( 'All Items', 'hytteguiden' ),
		'parent_item'                => __( 'Parent Stil', 'hytteguiden' ),
		'parent_item_colon'          => __( 'Parent Stil:', 'hytteguiden' ),
		'new_item_name'              => __( 'New Stil Name', 'hytteguiden' ),
		'add_new_item'               => __( 'Add New Stil', 'hytteguiden' ),
		'edit_item'                  => __( 'Edit Stil', 'hytteguiden' ),
		'update_item'                => __( 'Update Stil', 'hytteguiden' ),
		'view_item'                  => __( 'View Stil', 'hytteguiden' ),
		'separate_items_with_commas' => __( 'Separate Stil with commas', 'hytteguiden' ),
		'add_or_remove_items'        => __( 'Add or remove Stil', 'hytteguiden' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'hytteguiden' ),
		'popular_items'              => __( 'Stil', 'hytteguiden' ),
		'search_items'               => __( 'Search Stil', 'hytteguiden' ),
		'not_found'                  => __( 'Not Found', 'hytteguiden' ),
		'no_terms'                   => __( 'No items', 'hytteguiden' ),
		'items_list'                 => __( 'Stil list', 'hytteguiden' ),
		'items_list_navigation'      => __( 'Stil list navigation', 'hytteguiden' ),
	);

  register_taxonomy('cabin_style', 'cabin', array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'public' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'cabin_style' ),
  ));


}
add_action( 'init', 'hytteguiden_cabin_style_tax' );

// hytteguiden custom post taxonomy for Cabin Types
function hytteguiden_cabin_type_tax() {

  $labels = array(
		'name'                       => _x( 'Tak', 'Tak General Name', 'hytteguiden' ),
		'singular_name'              => _x( 'Tak', 'Tak Singular Name', 'hytteguiden' ),
		'menu_name'                  => __( 'Tak', 'hytteguiden' ),
		'all_items'                  => __( 'All Items', 'hytteguiden' ),
		'parent_item'                => __( 'Parent Tak', 'hytteguiden' ),
		'parent_item_colon'          => __( 'Parent Tak:', 'hytteguiden' ),
		'new_item_name'              => __( 'New Tak Name', 'hytteguiden' ),
		'add_new_item'               => __( 'Add New Tak', 'hytteguiden' ),
		'edit_item'                  => __( 'Edit Tak', 'hytteguiden' ),
		'update_item'                => __( 'Update Tak', 'hytteguiden' ),
		'view_item'                  => __( 'View Tak', 'hytteguiden' ),
		'separate_items_with_commas' => __( 'Separate Tak with commas', 'hytteguiden' ),
		'add_or_remove_items'        => __( 'Add or remove Tak', 'hytteguiden' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'hytteguiden' ),
		'popular_items'              => __( 'Tak', 'hytteguiden' ),
		'search_items'               => __( 'Search Tak', 'hytteguiden' ),
		'not_found'                  => __( 'Not Found', 'hytteguiden' ),
		'no_terms'                   => __( 'No items', 'hytteguiden' ),
		'items_list'                 => __( 'Tak list', 'hytteguiden' ),
		'items_list_navigation'      => __( 'Tak list navigation', 'hytteguiden' ),
	);

  register_taxonomy('cabin_type',array('cabin'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'cabin_type' ),
  ));

}
add_action( 'init', 'hytteguiden_cabin_type_tax' );

// hytteguiden custom post taxonomy for Cabin Amenity
function hytteguiden_cabin_amenity_tax() {

  $labels = array(
		'name'                       => _x( 'Tillegg', 'Tillegg General Name', 'hytteguiden' ),
		'singular_name'              => _x( 'Tillegg', 'Tillegg Singular Name', 'hytteguiden' ),
		'menu_name'                  => __( 'Tillegg', 'hytteguiden' ),
		'all_items'                  => __( 'All Items', 'hytteguiden' ),
		'parent_item'                => __( 'Parent Tillegg', 'hytteguiden' ),
		'parent_item_colon'          => __( 'Parent Tillegg:', 'hytteguiden' ),
		'new_item_name'              => __( 'New Tillegg Name', 'hytteguiden' ),
		'add_new_item'               => __( 'Add New Tillegg', 'hytteguiden' ),
		'edit_item'                  => __( 'Edit Tillegg', 'hytteguiden' ),
		'update_item'                => __( 'Update Tillegg', 'hytteguiden' ),
		'view_item'                  => __( 'View Tillegg', 'hytteguiden' ),
		'separate_items_with_commas' => __( 'Separate Tillegg with commas', 'hytteguiden' ),
		'add_or_remove_items'        => __( 'Add or remove Tillegg', 'hytteguiden' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'hytteguiden' ),
		'popular_items'              => __( 'Tillegg', 'hytteguiden' ),
		'search_items'               => __( 'Search Tillegg', 'hytteguiden' ),
		'not_found'                  => __( 'Not Found', 'hytteguiden' ),
		'no_terms'                   => __( 'No items', 'hytteguiden' ),
		'items_list'                 => __( 'Tillegg list', 'hytteguiden' ),
		'items_list_navigation'      => __( 'Tillegg list navigation', 'hytteguiden' ),
	);

  register_taxonomy('cabin_amenity',array('cabin'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'cabin_amenity' ),
  ));

}
add_action( 'init', 'hytteguiden_cabin_amenity_tax' );


?>
