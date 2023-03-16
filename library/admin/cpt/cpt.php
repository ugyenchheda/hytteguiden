<?php
// Post Type Key: Catalog
function create_posts_kataloger() {
  $labels = array(
    'name' => __( 'Kataloger', 'Post Type General Name', 'hytteguiden' ),
    'singular_name' => __( 'Kataloger', 'Post Type Singular Name', 'hytteguiden' ),
    'menu_name' => __( 'Kataloger', 'hytteguiden' ),
    'name_admin_bar' => __( 'Kataloger', 'hytteguiden' ),
    'archives' => __( 'Kataloger Archives', 'hytteguiden' ),
    'attributes' => __( 'Kataloger Attributes', 'hytteguiden' ),
    'parent_item_colon' => __( 'Parent Kataloger:', 'hytteguiden' ),
    'all_items' => __( 'All Kataloger', 'hytteguiden' ),
    'add_new_item' => __( 'Add New Kataloger', 'hytteguiden' ),
    'add_new' => __( 'Add New', 'hytteguiden' ),
    'new_item' => __( 'New Kataloger', 'hytteguiden' ),
    'edit_item' => __( 'Edit Kataloger', 'hytteguiden' ),
    'update_item' => __( 'Update Kataloger', 'hytteguiden' ),
    'view_item' => __( 'View Kataloger', 'hytteguiden' ),
    'view_items' => __( 'View Kataloger', 'hytteguiden' ),
    'search_items' => __( 'Search Kataloger', 'hytteguiden' ),
    'not_found' => __( 'Not found', 'hytteguiden' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'hytteguiden' ),
    'featured_image' => __( 'Featured Image', 'hytteguiden' ),
    'set_featured_image' => __( 'Set featured image', 'hytteguiden' ),
    'remove_featured_image' => __( 'Remove featured image', 'hytteguiden' ),
    'use_featured_image' => __( 'Use as featured image', 'hytteguiden' ),
    'insert_into_item' => __( 'Insert into Kataloger', 'hytteguiden' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Kataloger', 'hytteguiden' ),
    'items_list' => __( 'Kataloger list', 'hytteguiden' ),
    'items_list_navigation' => __( 'Kataloger list navigation', 'hytteguiden' ),
    'filter_items_list' => __( 'Filter Kataloger list', 'hytteguiden' ),
  );
  $args = array(
    'label'               => __( 'Kataloger', 'hytteguiden' ),
    'description'         => __( 'All Kataloger', 'hytteguiden' ),
    'labels'              => $labels,
    'menu_icon'           => 'dashicons-format-aside',
    'supports'            => array('title', 'editor', 'thumbnail', ),
    'public'              => true,
    'hierarchical'        => false,
    'show_ui'             => true,
    'has_archive'         => false,
    'rewrite'             => true,
    'rewrite'      => array( 'slug' => 'kataloger', 'with_front' => false ),
    'publicly_queryable' => true,
    'query_var' => true,
  );
  register_post_type( 'kataloger', $args );
  flush_rewrite_rules( false );

}
add_action( 'init', 'create_posts_kataloger', 0 );
// Post Type Key: Producer
function create_posts_producer() {
  $labels = array(
    'name' => __( 'Produsenter', 'Post Type General Name', 'hytteguiden' ),
    'singular_name' => __( 'Produsent', 'Post Type Singular Name', 'hytteguiden' ),
    'menu_name' => __( 'Produsenter', 'hytteguiden' ),
    'name_admin_bar' => __( 'Produsent', 'hytteguiden' ),
    'archives' => __( 'Produsent Archives', 'hytteguiden' ),
    'attributes' => __( 'Produsent Attributes', 'hytteguiden' ),
    'parent_item_colon' => __( 'Parent Produsent:', 'hytteguiden' ),
    'all_items' => __( 'All Produsenter', 'hytteguiden' ),
    'add_new_item' => __( 'Add New Produsent', 'hytteguiden' ),
    'add_new' => __( 'Add New', 'hytteguiden' ),
    'new_item' => __( 'New Produsent', 'hytteguiden' ),
    'edit_item' => __( 'Edit Produsent', 'hytteguiden' ),
    'update_item' => __( 'Update Produsent', 'hytteguiden' ),
    'view_item' => __( 'View Produsent', 'hytteguiden' ),
    'view_items' => __( 'View Produsenter', 'hytteguiden' ),
    'search_items' => __( 'Search Produsent', 'hytteguiden' ),
    'not_found' => __( 'Not found', 'hytteguiden' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'hytteguiden' ),
    'featured_image' => __( 'Featured Image', 'hytteguiden' ),
    'set_featured_image' => __( 'Set featured image', 'hytteguiden' ),
    'remove_featured_image' => __( 'Remove featured image', 'hytteguiden' ),
    'use_featured_image' => __( 'Use as featured image', 'hytteguiden' ),
    'insert_into_item' => __( 'Insert into Produsent', 'hytteguiden' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Produsent', 'hytteguiden' ),
    'items_list' => __( 'Produsenter list', 'hytteguiden' ),
    'items_list_navigation' => __( 'Produsenter list navigation', 'hytteguiden' ),
    'filter_items_list' => __( 'Filter Produsenter list', 'hytteguiden' ),
  );
  $args = array(
    'label'               => __( 'Produsent', 'hytteguiden' ),
    'description'         => __( 'Produsent', 'hytteguiden' ),
    'labels'              => $labels,
    'menu_icon'           => 'dashicons-store',
    'supports'            => array('title', 'editor', 'thumbnail', ),
    'public'              => true,
    'hierarchical'        => false,
    'show_ui'             => true,
    'has_archive'         => false,
    'rewrite'             => true,
    'rewrite'      => array( 'slug' => 'producer', 'with_front' => false ),
    'publicly_queryable' => true,
    'query_var' => true,
  );
  register_post_type( 'producer', $args );
  flush_rewrite_rules( false );

}
add_action( 'init', 'create_posts_producer', 0 );

// Post Type Key: Cabin
function create_posts_cabin() {
 $labels = array(
   'name' => __( 'Hytter', 'Post Type General Name', 'hytteguiden' ),
   'singular_name' => __( 'Hytte', 'Post Type Singular Name', 'hytteguiden' ),
   'menu_name' => __( 'Hytter', 'hytteguiden' ),
   'name_admin_bar' => __( 'Hytte', 'hytteguiden' ),
   'archives' => __( 'Hytte Archives', 'hytteguiden' ),
   'attributes' => __( 'Hytte Attributes', 'hytteguiden' ),
   'parent_item_colon' => __( 'Parent Hytte:', 'hytteguiden' ),
   'all_items' => __( 'All Hytter', 'hytteguiden' ),
   'add_new_item' => __( 'Add New Hytte', 'hytteguiden' ),
   'add_new' => __( 'Add New', 'hytteguiden' ),
   'new_item' => __( 'New Hytte', 'hytteguiden' ),
   'edit_item' => __( 'Edit Hytte', 'hytteguiden' ),
   'update_item' => __( 'Update Hytte', 'hytteguiden' ),
   'view_item' => __( 'View Hytte', 'hytteguiden' ),
   'view_items' => __( 'View Hytter', 'hytteguiden' ),
   'search_items' => __( 'Search Hytte', 'hytteguiden' ),
   'not_found' => __( 'Not found', 'hytteguiden' ),
   'not_found_in_trash' => __( 'Not found in Trash', 'hytteguiden' ),
   'featured_image' => __( 'Featured Image', 'hytteguiden' ),
   'set_featured_image' => __( 'Set featured image', 'hytteguiden' ),
   'remove_featured_image' => __( 'Remove featured image', 'hytteguiden' ),
   'use_featured_image' => __( 'Use as featured image', 'hytteguiden' ),
   'insert_into_item' => __( 'Insert into Hytte', 'hytteguiden' ),
   'uploaded_to_this_item' => __( 'Uploaded to this Hytte', 'hytteguiden' ),
   'items_list' => __( 'Hytter list', 'hytteguiden' ),
   'items_list_navigation' => __( 'Hytter list navigation', 'hytteguiden' ),
   'filter_items_list' => __( 'Filter Hytter list', 'hytteguiden' ),
 );
 $args = array(

   'label'               => __( 'Hytte', 'hytteguiden' ),
   'description'         => __( 'Hytte', 'hytteguiden' ),
   'labels'              => $labels,
   'menu_icon'           => 'dashicons-store',
   'supports'            => array('title', 'editor', 'thumbnail', ),
   'taxonomies'          => array('cabin_style'),
   'public'              => true,
   'hierarchical'        => false,
   'show_ui'             => true,
   'has_archive'         => false,
   'rewrite'             => true,
   'rewrite'             => array( 'slug' => 'cabin', 'with_front' => false ),
   'publicly_queryable' => true,
   'query_var' => true,

 );
 register_post_type( 'cabin', $args );
 flush_rewrite_rules( false );

}
add_action( 'init', 'create_posts_cabin', 0 );

// Post Type Key: Department
function hytteguiden_department() {
 $labels = array(
   'name' => __( 'Avdelinger', 'Post Type General Name', 'hytteguiden' ),
   'singular_name' => __( 'Avdeling', 'Post Type Singular Name', 'hytteguiden' ),
   'menu_name' => __( 'Avdelinger', 'hytteguiden' ),
   'name_admin_bar' => __( 'Avdeling', 'hytteguiden' ),
   'archives' => __( 'Avdeling Archives', 'hytteguiden' ),
   'attributes' => __( 'Avdeling Attributes', 'hytteguiden' ),
   'parent_item_colon' => __( 'Parent Avdeling:', 'hytteguiden' ),
   'all_items' => __( 'All Avdelinger', 'hytteguiden' ),
   'add_new_item' => __( 'Add New Avdeling', 'hytteguiden' ),
   'add_new' => __( 'Add New', 'hytteguiden' ),
   'new_item' => __( 'New Avdeling', 'hytteguiden' ),
   'edit_item' => __( 'Edit Avdeling', 'hytteguiden' ),
   'update_item' => __( 'Update Avdeling', 'hytteguiden' ),
   'view_item' => __( 'View Avdeling', 'hytteguiden' ),
   'view_items' => __( 'View avdelinger', 'hytteguiden' ),
   'search_items' => __( 'Search Avdeling', 'hytteguiden' ),
   'not_found' => __( 'Not found', 'hytteguiden' ),
   'not_found_in_trash' => __( 'Not found in Trash', 'hytteguiden' ),
   'featured_image' => __( 'Featured Image', 'hytteguiden' ),
   'set_featured_image' => __( 'Set featured image', 'hytteguiden' ),
   'remove_featured_image' => __( 'Remove featured image', 'hytteguiden' ),
   'use_featured_image' => __( 'Use as featured image', 'hytteguiden' ),
   'insert_into_item' => __( 'Insert into Avdeling', 'hytteguiden' ),
   'uploaded_to_this_item' => __( 'Uploaded to this Avdeling', 'hytteguiden' ),
   'items_list' => __( 'Avdelinger list', 'hytteguiden' ),
   'items_list_navigation' => __( 'Avdelinger list navigation', 'hytteguiden' ),
   'filter_items_list' => __( 'Filter avdelinger list', 'hytteguiden' ),
 );
 $args = array(

   'label'               => __( 'Avdeling', 'hytteguiden' ),
   'description'         => __( 'Avdeling', 'hytteguiden' ),
   'labels'              => $labels,
   'menu_icon'           => 'dashicons-admin-multisite',
   'supports'            => array('title', 'editor', 'thumbnail', ),
   'taxonomies'          => array('cabin_style'),
   'public'              => true,
   'hierarchical'        => false,
   'show_ui'             => true,
   'has_archive'         => false,
   'rewrite'             => true,
   'rewrite'             => array( 'slug' => 'avdeling', 'with_front' => false ),
   'publicly_queryable' => true,
   'query_var' => true,

 );
 register_post_type( 'avdeling', $args );
 flush_rewrite_rules( false );

}
add_action( 'init', 'hytteguiden_department', 0 );


?>
