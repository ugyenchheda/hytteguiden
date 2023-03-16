<?php
add_action( 'tgmpa_register', 'hytteguiden_register_required_plugins' );

function hytteguiden_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(


     		array(
    				'name'      => __( "Woocommerce", "hytteguiden"),
    				'slug'      => 'woocommerce',
    				'required'  => true,
     			),

    		array(
    			'name'      =>  __( "One Click Demo Import", "hytteguiden"),
     			'slug'      => 'one-click-demo-import',
     			'required'  => false,
     		),

    		array(

    			'name'      => __( "Widget Importer & Exporter", "hytteguiden"),
     			'slug'      => 'widget-importer-exporter',
     			'required'  => false,
     		),

    		array(

    			'name'      => __( "Contact Form 7", "hytteguiden"),
     			'slug'      => 'contact-form-7',
     			'required'  => false,
     		),

    		array(

    			'name'      => __( "Customizer Export/Import", "hytteguiden"),
     			'slug'      => 'customizer-export-import',
     			'required'  => false,
     		),

    		array(

    			'name'      => __( "Regenerate Thumbnails", "hytteguiden"),
     			'slug'      => 'regenerate-thumbnails',
     			'required'  => false,
     		),

	);

	$config = array(
		'id'           => 'hytteguiden',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.


	);

	tgmpa( $plugins, $config );
}
?>
