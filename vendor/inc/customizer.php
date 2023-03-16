<?php
require_once get_template_directory() . '/library/admin/customizer/customizer-google-font.php';
require_once get_template_directory() . '/library/admin/customizer/customizer-google-font-variation.php';
require_once get_template_directory() . '/library/admin/customizer/customizer-google-font-subsets.php';

/**
 * Hytteguiden Theme Customizer
 *
 * @package Hytteguiden
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hytteguiden_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'hytteguiden_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'hytteguiden_customize_partial_blogdescription',
		) );
	}

	/* Custom codes for customizer
	.........................................  */

	$wp_customize->add_panel('hytteguiden_setting_panel', array(
				'capability' 		=> 'edit_theme_options',
				'theme_supports' 	=> '',
				'title' 			=> __('Hytteguiden Settings', 'hytteguiden'),
				'description' 		=> __('Setup website Settings', 'hytteguiden'),
				'priority' 			=> 12,
		));

	$wp_customize->add_panel('hytteguiden_page_banner', array(
				'capability' 		=> 'edit_theme_options',
				'theme_supports' 	=> '',
				'title' 			=> __('Home Page Banner Setting', 'hytteguiden'),
				'description' 		=> __('Setup banner Settings', 'hytteguiden'),
				'priority' 			=> 12,
		));	

   /* Searchox Section */

	$wp_customize->add_section(
		'section_headersetting' ,
		array(
			'title'       	=> __( 'Header Setting', 'hytteguiden' ),
			'description' 	=> __( 'Setup header settings.', 'hytteguiden' ),
			'panel'			=> 'hytteguiden_setting_panel',
		)
	);

	/* Main Logo*/
	$wp_customize->add_setting(
	 'main_logo',
	 array(
		 'default'			=> get_template_directory_uri() . '/images/hytteguiden-logo-theme.png',
		 'sanitize_callback' => 'hytteguiden_sanitize_url',
	 )
	);

	$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'main_logo',
		array(
			'label'    => __( 'Main logo', 'hytteguiden' ),
			'section'  => 'section_headersetting',
			'settings' => 'main_logo',
		)
	)
	);

	/* Transparent Logo*/
	$wp_customize->add_setting(
		 'transparent_logo',
		 array(
			 'default'			=> get_template_directory_uri() . '/images/hytteguiden-logo-white.png',
			 'sanitize_callback' => 'hytteguiden_sanitize_url',
		 )
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
		$wp_customize,
		'transparent_logo',
			array(
				'label'    => __( 'Transparent logo', 'hytteguiden' ),
				'section'  => 'section_headersetting',
				'settings' => 'transparent_logo',
			)
		)
	);

	/* Banner image */
	$wp_customize->add_setting(
		'banner_image',
		array(
			'default' 			=> get_template_directory_uri() . '/images/bannerbg.jpg',
			'sanitize_callback' => 'hytteguiden_sanitize_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'banner_image',
			array(
				'label'    => __( 'Upload Image for Banner', 'hytteguiden' ),
				'section'  => 'section_searchbox',
				'settings' => 'banner_image',
			)
		)
	);

		/* Searchox Section */

	$wp_customize->add_section(
		'section_searchbox' ,
		array(
			'title'       	=> __( 'Search Box', 'hytteguiden' ),
			'description' 	=> __( 'Setup search box settings.', 'hytteguiden' ),
			'panel'			=> 'hytteguiden_setting_panel',
		)
	);

	/* Searchbox Title */
	$wp_customize->add_setting(
		 'banner_title',
		 array(
			 'default'			=> __('Finn din drømmehytte', 'hytteguiden' ),
			 'sanitize_callback' => 'hytteguiden_sanitize_text',
		 )
	);

	$wp_customize->add_control(
		 'banner_title',
			 array(
				 'label'		=> __('Title', 'hytteguiden'),
				 'type'		=> 'text',
				 'section'	=> 'section_searchbox',
				 'settings'	=> 'banner_title',
		 )
	);

	/* Banner image */
	$wp_customize->add_setting(
		'banner_image',
		array(
			'default' 			=> get_template_directory_uri() . '/images/bannerbg.jpg',
			'sanitize_callback' => 'hytteguiden_sanitize_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'banner_image',
			array(
				'label'    => __( 'Upload Image for Banner', 'hytteguiden' ),
				'section'  => 'section_searchbox',
				'settings' => 'banner_image',
			)
		)
	);

	

	/* Searchbox Title */
	$wp_customize->add_setting(
		 'search_btn_name',
		 array(
			 'default'			=> __('Se alle hytter', 'hytteguiden' ),
			 'sanitize_callback' => 'hytteguiden_sanitize_text',
		 )
	);

	$wp_customize->add_control(
		 'search_btn_name',
			 array(
				 'label'		=> __('Filter Button Name', 'hytteguiden'),
				 'type'		=> 'text',
				 'section'	=> 'section_searchbox',
				 'settings'	=> 'search_btn_name',
		 )
	);

	/*  Page Option */
	$wp_customize->add_section(
		'page_banner' ,
		array(
			'title'       	=> __( 'Page Head Banner Image', 'hytteguiden' ),
			'description' 	=> __( 'Setup banner for pages.', 'hytteguiden' ),
			'panel'			=> 'hytteguiden_page_banner',
		)
	);

	/* page Banner image */
	$wp_customize->add_setting(
		'page_banner_image',
		array(
			'default' 			=> get_template_directory_uri() . '/images/bannerbg.jpg',
			'sanitize_callback' => 'hytteguiden_sanitize_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'page_banner_image',
			array(
				'label'    => __( 'Upload Image For Page Banner', 'hytteguiden' ),
				'section'  => 'page_banner',
				'settings' => 'page_banner_image',
			)
		)

	);


	/*  Page Heading Text Option */
	$wp_customize->add_section(
		'home_banner_title_section' ,
		array(
			'title'       	=> __( 'Page Banner Title', 'hytteguiden' ),
			'description' 	=> __( 'Add the title for banner image.', 'hytteguiden' ),
			'panel'			=> 'hytteguiden_page_banner',
		)
	);

	/* title block color */
	$wp_customize->add_setting(
		'home_banner_title_block_color' , 
			array(
				'default'   => '#000000',
				'transport' => 'refresh',
				'sanitize_callback' => 'hytteguiden_sanitize_hex_color',
			) 
	);

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
			$wp_customize, 
			'home_banner_title_block_color', 
			array(
				'label'      => __( 'Title Block Background Color', 'mytheme' ),
				'section'    => 'home_banner_title_section',
				'settings'   => 'home_banner_title_block_color',
			) 
		) 
	);

	/* page Banner title */
	$wp_customize->add_setting(
		'home_banner_title',
		array(
			'default'			=> __('Add title here..', 'hytteguiden' ),
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);

	$wp_customize->add_control(		
			'home_banner_title',
			array(
				'label'		=> __('Title For Banner Image', 'hytteguiden'),
				'type'		=> 'text',
				'section'	=> 'home_banner_title_section',
				'settings'	=> 'home_banner_title',
			)		

	);

	/* Font Family */
	$wp_customize->add_setting(
		'home_banner_title_font',
		array(
			'default'			=> 'Source Sans Pro',
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Hytte_Google_Font(
			$wp_customize,
			'home_banner_title_font',
			array(
				'label'   	=> __( 'Font Family', 'hytteguiden' ),
				'section'	=> 'home_banner_title_section',
				'settings'  => 'home_banner_title_font',
			)
		)
	);

	/* Font Variant */
	$wp_customize->add_setting(
		'home_banner_title_font_variant',
		array(
			'default'			=> 'Montserrat:regular',
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Hytte_Google_Font_Variation(
			$wp_customize,
			'home_banner_title_font_variant',
			array(
				'label'   	=> __( 'Font Variant', 'hytteguiden' ),
				'section'	=> 'home_banner_title_section',
				'settings'  => 'home_banner_title_font_variant',
			)
		)
	);

	/* Font Subsets */
	$wp_customize->add_setting(
		'home_banner_title_font_subset',
		array(
			'default'			=> '',
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Hytte_Google_Font_Subsets(
			$wp_customize,
			'home_banner_title_font_subset',
			array(
				'label'   	=> __( 'Font Subsets', 'hytteguiden' ),
				'section'	=> 'home_banner_title_section',
				'settings'  => 'home_banner_title_font_subset',
			)
		)
	);
	/* title color */
	$wp_customize->add_setting(
		'home_banner_title_colour' , 
			array(
				'default'   => '#ffffff',
				'transport' => 'refresh',
				'sanitize_callback' => 'hytteguiden_sanitize_hex_color',
			) 
	);

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
			$wp_customize, 
			'home_banner_title_colour', 
			array(
				'label'      => __( 'Tittle Color', 'mytheme' ),
				'section'    => 'home_banner_title_section',
				'settings'   => 'home_banner_title_colour',
			) 
		) 
	);
	/* page Banner title font size */
	$wp_customize->add_setting(
		'home_banner_title_font_size',
		array(
			'default'			=> __('25', 'hytteguiden' ),
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);

	$wp_customize->add_control(		
			'home_banner_title_font_size',
			array(
				'label'		=> __('Font Size', 'hytteguiden'),
				'description' => __('Add number only(px)', 'hytteguiden'),
				'type'		=> 'text',
				'section'	=> 'home_banner_title_section',
				'settings'	=> 'home_banner_title_font_size',
			)		

	);

	/* page Banner title line height */
	$wp_customize->add_setting(
		'home_banner_title_line_height',
		array(
			'default'			=> __('25', 'hytteguiden' ),
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);

	$wp_customize->add_control(		
			'home_banner_title_line_height',
			array(
				'label'		=> __('Line Height', 'hytteguiden'),
				'description' => __('Add number only (px)', 'hytteguiden'),
				'type'		=> 'text',
				'section'	=> 'home_banner_title_section',
				'settings'	=> 'home_banner_title_line_height',
			)		

	);

	/*  Page Subtitle Text Option */
	$wp_customize->add_section(
		'home_banner_subtitle_section' ,
		array(
			'title'       	=> __( 'Page Banner Subtitle ', 'hytteguiden' ),
			'description' 	=> __( 'Add the subtitle for Banner image.', 'hytteguiden' ),
			'panel'			=> 'hytteguiden_page_banner',
		)
	);

	/* home Banner subtitle */
	$wp_customize->add_setting(
		'home_banner_subtitle',
		array(
			'default'			=> __('Add subtitle here...', 'hytteguiden' ),
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);

	$wp_customize->add_control(		
			'home_banner_subtitle',
			array(
				'label'		=> __('Subtitle For Banner Image', 'hytteguiden'),
				'type'		=> 'text',
				'section'	=> 'home_banner_subtitle_section',
				'settings'	=> 'home_banner_subtitle',
			)		

	);
	/* Font Family */
	$wp_customize->add_setting(
		'home_banner_subtitle_font',
		array(
			'default'			=> 'Source Sans Pro',
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Hytte_Google_Font(
			$wp_customize,
			'home_banner_subtitle_font',
			array(
				'label'   	=> __( 'Font Family', 'hytteguiden' ),
				'section'	=> 'home_banner_subtitle_section',
				'settings'  => 'home_banner_subtitle_font',
			)
		)
	);
	/* Font Variant */
	$wp_customize->add_setting(
		'home_banner_subtitle_font_variant',
		array(
			'default'			=> 'Montserrat:regular',
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Hytte_Google_Font_Variation(
			$wp_customize,
			'home_banner_subtitle_font_variant',
			array(
				'label'   	=> __( 'Font Variant', 'hytteguiden' ),
				'section'	=> 'home_banner_subtitle_section',
				'settings'  => 'home_banner_subtitle_font_variant',
			)
		)
	);

	/* Font Subsets */
	$wp_customize->add_setting(
		'home_banner_subtitle_font_subset',
		array(
			'default'			=> '',
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Hytte_Google_Font_Subsets(
			$wp_customize,
			'home_banner_subtitle_font_subset',
			array(
				'label'   	=> __( 'Font Subsets', 'hytteguiden' ),
				'section'	=> 'home_banner_subtitle_section',
				'settings'  => 'home_banner_subtitle_font_subset',
			)
		)
	);
	/* subtitle color */
	$wp_customize->add_setting(
		'home_banner_subtitle_colour' , 
			array(
				'default'   => '#ffffff',
				'transport' => 'refresh',
				'sanitize_callback' => 'hytteguiden_sanitize_hex_color',
			) 
	);

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
			$wp_customize, 
			'home_banner_subtitle_colour', 
			array(
				'label'      => __( 'Subtitle Color', 'mytheme' ),
				'section'    => 'home_banner_subtitle_section',
				'settings'   => 'home_banner_subtitle_colour',
			) 
		) 
	);
	/* page Banner subtitle font size */
	$wp_customize->add_setting(
		'home_banner_subtitle_font_size',
		array(
			'default'			=> __('16', 'hytteguiden' ),
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);

	$wp_customize->add_control(		
			'home_banner_subtitle_font_size',
			array(
				'label'		=> __('Font size', 'hytteguiden'),
				'description' => __('Add number only(px)', 'hytteguiden'),
				'type'		=> 'text',
				'section'	=> 'home_banner_subtitle_section',
				'settings'	=> 'home_banner_subtitle_font_size',
			)		

	);

	/* page Banner subtitle line height */
	$wp_customize->add_setting(
		'home_banner_subtitle_line_height',
		array(
			'default'			=> __('16', 'hytteguiden' ),
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);

	$wp_customize->add_control(		
			'home_banner_subtitle_line_height',
			array(
				'label'		=> __('Line Height', 'hytteguiden'),
				'description' => __('Add number only(px)', 'hytteguiden'),
				'type'		=> 'text',
				'section'	=> 'home_banner_subtitle_section',
				'settings'	=> 'home_banner_subtitle_line_height',
			)		

	);


	/*  Page pretitle Text Option */
	$wp_customize->add_section(
		'home_banner_pretitle_section' ,
		array(
			'title'       	=> __( 'Page Banner Pretitle', 'hytteguiden' ),
			'description' 	=> __( 'Add The Pretitle For Banner Image.', 'hytteguiden' ),
			'panel'			=> 'hytteguiden_page_banner',
		)
	);

	/* page Banner pretitle */
	$wp_customize->add_setting(
		'home_banner_pretitle',
		array(
			'default'			=> __('Add pretitle here..', 'hytteguiden' ),
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);

	$wp_customize->add_control(		
			'home_banner_pretitle',
			array(
				'label'		=> __('Pretitle For Banner Image', 'hytteguiden'),
				'type'		=> 'text',
				'section'	=> 'home_banner_pretitle_section',
				'settings'	=> 'home_banner_pretitle',
			)		

	);
	/* Font Family */
	$wp_customize->add_setting(
		'home_banner_pretitle_font',
		array(
			'default'			=> 'Source Sans Pro',
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Hytte_Google_Font(
			$wp_customize,
			'home_banner_pretitle_font',
			array(
				'label'   	=> __( 'Font Family', 'hytteguiden' ),
				'section'	=> 'home_banner_pretitle_section',
				'settings'  => 'home_banner_pretitle_font',
			)
		)
	);
	/* Font Variant */
	$wp_customize->add_setting(
		'home_banner_pretitle_font_variant',
		array(
			'default'			=> 'Montserrat:regular',
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Hytte_Google_Font_Variation(
			$wp_customize,
			'home_banner_pretitle_font_variant',
			array(
				'label'   	=> __( 'Font Variant', 'hytteguiden' ),
				'section'	=> 'home_banner_pretitle_section',
				'settings'  => 'home_banner_pretitle_font_variant',
			)
		)
	);

	/* Font Subsets */
	$wp_customize->add_setting(
		'home_banner_pretitle_font_subset',
		array(
			'default'			=> '',
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Hytte_Google_Font_Subsets(
			$wp_customize,
			'home_banner_pretitle_font_subset',
			array(
				'label'   	=> __( 'Font Subsets', 'hytteguiden' ),
				'section'	=> 'home_banner_pretitle_section',
				'settings'  => 'home_banner_pretitle_font_subset',
			)
		)
	);
	/* pretitle color */
	$wp_customize->add_setting(
		'home_banner_pretitle_colour' , 
			array(
				'default'   => '#ffffff',
				'transport' => 'refresh',
				'sanitize_callback' => 'hytteguiden_sanitize_hex_color',
			) 
	);

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
			$wp_customize, 
			'home_banner_pretitle_colour', 
			array(
				'label'      => __( 'Pretitle Color', 'mytheme' ),
				'section'    => 'home_banner_pretitle_section',
				'settings'   => 'home_banner_pretitle_colour',
			) 
		) 
	);
	/* home Banner pretitle font size */
	$wp_customize->add_setting(
		'home_banner_pretitle_font_size',
		array(
			'default'			=> __('14', 'hytteguiden' ),
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);

	$wp_customize->add_control(		
			'home_banner_pretitle_font_size',
			array(
				'label'		=> __('Font Size', 'hytteguiden'),
				'description' => __('Add number only(px)', 'hytteguiden'),
				'type'		=> 'text',
				'section'	=> 'home_banner_pretitle_section',
				'settings'	=> 'home_banner_pretitle_font_size',
			)		
	);
	
	/* page Banner pretitle line height */
	$wp_customize->add_setting(
		'home_banner_pretitle_line_height',
		array(
			'default'			=> __('14', 'hytteguiden' ),
			'sanitize_callback' => 'hytteguiden_sanitize_text',
		)
	);

	$wp_customize->add_control(		
			'home_banner_pretitle_line_height',
			array(
				'label'		=> __('Line Height', 'hytteguiden'),
				'description' => __('Add number only', 'hytteguiden'),
				'type'		=> 'text',
				'section'	=> 'home_banner_pretitle_section',
				'settings'	=> 'home_banner_pretitle_line_height',
			)		

	);

	

	/* Filter Page Option */
	$wp_customize->add_section(
		'section_filter_page' ,
		array(
			'title'       	=> __( 'Filter Page Option', 'hytteguiden' ),
			'description' 	=> __( 'Setup filter result page.', 'hytteguiden' ),
			'panel'			=> 'hytteguiden_setting_panel',
		)
	);

		/* filter_page Title */
 	 $wp_customize->add_setting(
 		 'filter_page_title',
 		 array(
 			 'default'			=> __('Test header for filter option', 'hytteguiden' ),
 			 'sanitize_callback' => 'hytteguiden_sanitize_text',
 		 )
 	 );

 	 $wp_customize->add_control(
 		 'filter_page_title',
 		 array(
 			 'label'		=> __('Filter Page Title', 'hytteguiden'),
 			 'type'		=> 'text',
 			 'section'	=> 'section_filter_page',
 			 'settings'	=> 'filter_page_title',
 		 )
 	 );

	/* Filter option post per page */
	$wp_customize->add_setting( 'search_posts_per_page', array(
	  'default' => '10',
	  'sanitize_callback' => 'hytteguiden_sanitize_select',
	) );

 	$wp_customize->add_control(
 		 'search_posts_per_page',
 		 array(
		 	'label'	 => __('No. Of Post Per Page', 'hytteguiden'),
		 	'type'    => 'select',
	    	'choices' => array(
		        '1' => esc_html__( '1', 'hytteguiden' ),
		        '2' => esc_html__( '2', 'hytteguiden' ),
		        '3' => esc_html__( '3', 'hytteguiden' ),
		        '4' => esc_html__( '4', 'hytteguiden' ),
		        '5' => esc_html__( '5', 'hytteguiden' ),
		        '6' => esc_html__( '6', 'hytteguiden' ),
		        '7' => esc_html__( '7', 'hytteguiden' ),
		        '8' => esc_html__( '8', 'hytteguiden' ),
		        '9' => esc_html__( '9', 'hytteguiden' ),
		        '10' => esc_html__( '10', 'hytteguiden' ),
		        '11' => esc_html__( '11', 'hytteguiden' ),
		        '12' => esc_html__( '12', 'hytteguiden' ),
		        '13' => esc_html__( '13', 'hytteguiden' ),
		        '14' => esc_html__( '14', 'hytteguiden' ),
		        '15' => esc_html__( '15', 'hytteguiden' ),
		        '16' => esc_html__( '16', 'hytteguiden' ),
		        '17' => esc_html__( '17', 'hytteguiden' ),
		        '18' => esc_html__( '18', 'hytteguiden' ),
		        '17' => esc_html__( '19', 'hytteguiden' ),
		        '20' => esc_html__( '20', 'hytteguiden' ),
		    ),
 			'section'	=> 'section_filter_page',
 			'settings'	=> 'search_posts_per_page',
 		 )
 	 );
	/* Footer Section */
	$wp_customize->add_section(
	 'section_footer' ,
		 array(
			 'title'       	=> __( 'Footer Settings', 'hytteguiden' ),
			 'description' 	=> __( 'Setup footer settings.', 'hytteguiden' ),
			 'panel'			=> 'hytteguiden_setting_panel',
		 )
	);

	$wp_customize->add_setting(
		'btm_footer_text',
			array(
			 'default' 			=>  __( '&copy; 2018 <a href="/">Hytteguiden</a>. All Rights Reserved.', 'hytteguiden' ),
			 'sanitize_callback' => 'hytteguiden_sanitize_analytics',
		 )
	);

	$wp_customize->add_control(
		'btm_footer_text',
			array(
			 'label'		=> __('Bottom Footer Text', 'hytteguiden'),
			 'section' 	=> 'section_footer',
			 'type' 		=> 'textarea',
			 'settings'	=> 'btm_footer_text',
			)
	);

}
add_action( 'customize_register', 'hytteguiden_customize_register' );


/* Custom customizer sanitization start here
................................ */

function hytteguiden_sanitize_text($input){
	return wp_kses_post( force_balance_tags( $input ) );
}

function check_email( $value ) {
    return ( is_email( $value ) ) ? $value : null;
}

function hytteguiden_check_number( $value ) {
	if( !empty( $value ) ){
		$value = (int) $value; // Force the value into integer type.
    	return ( 0 < $value ) ? $value : null;
	}
	else{
		return '';
	}
}

function hytteguiden_sanitize_textarea( $text ) {
    return esc_textarea( $text );
}

function hytteguiden_sanitize_hex_color( $colour ){
	return sanitize_hex_color( $colour );
}

function hytteguiden_sanitize_url( $url ){
	return esc_url_raw( $url );
}

function hytteguiden_sanitize_choices( $input, $setting ) {
	global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    }
    else {
        return $setting->default;
    }
}

function hytteguiden_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function hytteguiden_sanitize_select( $input, $setting ) {
	global $wp_customize;
	$input = sanitize_key( $input );
	$choices = $wp_customize->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function hytteguiden_sanitize_analytics( $text ){
	return $text;
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function hytteguiden_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function hytteguiden_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function hytteguiden_customize_preview_js() {
	wp_enqueue_script( 'hytteguiden-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'hytteguiden_customize_preview_js' );
