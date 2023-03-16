<?php
/**
 * Hytteguiden functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Hytteguiden
 */
if ( ! function_exists( 'hytteguiden_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hytteguiden_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Hytteguiden, use a find and replace
		 * to change 'hytteguiden' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hytteguiden', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		add_image_size( 'post_image_xs', 100, 90, true );
		add_image_size( 'post_image_s', 240, 186, true );
		add_image_size( 'post_image_m', 263, 175, true );
		add_image_size( 'post_image_l', 387, 242, true );
		add_image_size( 'post_image_xl', 774, 484, true );
		add_image_size( 'producer_banner_s', 575, 520, true );
		add_image_size( 'producer_banner_m', 767, 580, true );
		add_image_size( 'producer_banner_l', 991, 640, true );
		add_image_size( 'producer_banner_xl', 1600, 840, true );
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary_menu' => esc_html__( 'Primary', 'hytteguiden' ),
		) );
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'hytteguiden_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'hytteguiden_setup' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hytteguiden_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'hytteguiden_content_width', 640 );
}
add_action( 'after_setup_theme', 'hytteguiden_content_width', 0 );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hytteguiden_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hytteguiden' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'hytteguiden' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="sectiontitle"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'hytteguiden' ),
		'id'            => 'footer_widget_area',
		'description'   => esc_html__( 'Add widgets here.', 'hytteguiden' ),
		'before_widget' => '<div id="%1$s" class="col-12 col-sm-6 col-lg-3 %2$s"><div class="footblock">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="foothead"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );
}
add_action( 'widgets_init', 'hytteguiden_widgets_init' );
/**
 * Enqueue scripts and styles.
 */
function hytteguiden_scripts() {
	wp_enqueue_style( 'bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/all.css' );
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i' );  
	wp_enqueue_style( 'hytteguiden-google-fonts', hytteguiden_google_fonts_url(), array(), null );
	wp_enqueue_style( 'icomoon-icon', get_template_directory_uri() . '/library/admin/assets/icomoon/style.css' );
	wp_enqueue_style( 'nouislider', get_template_directory_uri() . '/css/nouislider.css' );
	
	wp_enqueue_style( 'theme', get_template_directory_uri() . '/css/theme.css' );
	
	if (!is_front_page()){
		wp_enqueue_style( 'owl.carousel.min', get_template_directory_uri() . '/assets/owlcarousel/owl.carousel.min.css' );
		wp_enqueue_style( 'jquery.fancybox.min', get_template_directory_uri() . '/assets/fancybox/jquery.fancybox.min.css' );
		wp_enqueue_style( 'dataTables.bootstrap4.min', get_template_directory_uri() . '/assets/datatables/dataTables.bootstrap4.min.css' );
	}
	
	wp_enqueue_style( 'hytteguiden-style', get_stylesheet_uri() );



	wp_enqueue_script( 'jquery-3.3.1.min', get_template_directory_uri() . '/js/jquery-3.3.1.min.js', array(), '20190207', true );
	wp_enqueue_script( 'popper.min.js', get_template_directory_uri() . '/js/popper.min.js', array(), '20190207', true );
	wp_enqueue_script( 'bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '20190207', true );
	wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/assets/owlcarousel/owl.carousel.js', array(), '20190207', true );
	wp_enqueue_script( 'bootstrap-material-design', get_template_directory_uri(). '/js/bootstrap-material-design.js', array(), '20190207', true );
	wp_enqueue_script( 'nouislider', get_template_directory_uri(). '/js/nouislider.js', array(), '20190207', true );
	if(!is_front_page()){	
		wp_enqueue_script( 'jquery.fancybox.min', get_template_directory_uri() . '/assets/fancybox/jquery.fancybox.min.js', array(), '20190207', true );
	}
	wp_enqueue_script( 'jquery.dataTables', get_template_directory_uri() . '/assets/datatables/jquery.dataTables.js', array(), '20190207', true );
	wp_enqueue_script( 'dataTables.bootstrap4.min', get_template_directory_uri() . '/assets/datatables/dataTables.bootstrap4.min.js', array(), '20190207', true );
	wp_enqueue_script( 'jquery.validate', get_template_directory_uri() . '/js/jquery.validate.js', array(), '20190207', true );
	
	if(is_single('cabin')){
		wp_enqueue_script( 'hytte-pinit-js', '//assets.pinterest.com/js/pinit.js', array(), NULL, true );
	}
	wp_enqueue_script( 'hytte-facebook-js', '//connect.facebook.net/en_US/all.js', array(), NULL, true );

	if(is_single('producer')){	
	$google_map_api = get_option('google_map_api');
	wp_enqueue_script( 'google-map', '//maps.googleapis.com/maps/api/js?key='. $google_map_api .'&callback=initMap', array(), '20190207', true );
	}	
	
	wp_enqueue_script( 'hytteguiden-custom', get_template_directory_uri() . '/js/custom.js', array(), '2019020143', true );		
	wp_register_script( 'hytteguiden_script', get_template_directory_uri() . '/js/hytteguiden.js', array(), '2019020157', true );
	wp_enqueue_script('hytteguiden_script');

	$slider_defaults = array(
		'slider_min_price' => '0',
		'slider_max_price' => '5000000',
		'slider_min_size' => '0',
		'slider_max_size' => '300',
		'slider_min_beds' => '0',
		'slider_max_beds' => '15',
	); 
	$route_defaults = array(
		'search_page' => 'finn',
		'login_page' => 'logg-inn',
		'profile_page' => 'min-side',
		'mycabins_page' => 'mine-hytter',
		'mycatalogue_page' => 'mine-kataloger',
	  ); 
	$slider_defaults_data = get_option('slider_defaults');
	$route_defaults_data = get_option('route_defaults');
	if(isset($slider_defaults_data) && !empty($slider_defaults_data)){
		$slider_defaults = $slider_defaults_data;
	}
	if(isset($route_defaults_data) && !empty($route_defaults_data)){
		$route_defaults = $route_defaults_data;
	}
	$hytteguiden_params = array(
		'admin_ajax_url' => admin_url( 'admin-ajax.php' ),
		'loading_text' => __('Laster...', 'hytteguiden'),
		'no_more_content_text' => __('Ingen flere innhold funnet.', 'hytteguiden'),
		'load_more_text' => __('Last mer', 'hytteguiden'),
		'processing' => __('Behandling..', 'hytteguiden'),
		'site_name' => get_bloginfo('name'),
		'mandatory_msg' => __('Fyll ut alle nødvendige felt.', 'hytteguiden'),
		'email_valid_msg' => __('Riktig e-post må oppgis.', 'hytteguiden'),
		'select_catalog' => __('Vennligst velg kataloger.', 'hytteguiden'),
		'facebook_appId' => get_option('facebook_appId'),
	);
	/* Route confiurations  */
	if($route_defaults){
		foreach($route_defaults as $key => $value){			
			$hytteguiden_params[$key] = $value;
		}
	}
	if( isset($route_defaults) && array_key_exists("search_page",$route_defaults) ){
		$hytteguiden_params['search_url'] = esc_url( home_url( '/' ) ) . $route_defaults['search_page'] . '/';
	}
	if( isset($route_defaults) && array_key_exists("myprofile_page",$route_defaults) ){
		$hytteguiden_params['profile_url'] = esc_url( home_url( '/' ) ) . $route_defaults['myprofile_page'] . '/';
	}
	/* Slider confiurations  */
	if($slider_defaults){
		foreach($slider_defaults as $key => $value){			
			$selected_val_slider = str_replace("slider_","",$key);
			$hytteguiden_params[$key] = $value;
			$hytteguiden_params[$selected_val_slider] = $value;
		}
	}
	if(isset($_REQUEST['min_price']) && !empty($_REQUEST['min_price'])){
		$hytteguiden_params['min_price'] = $_REQUEST['min_price'];
	}

	if(isset($_REQUEST['max_price']) && !empty($_REQUEST['max_price'])){
		$hytteguiden_params['max_price'] = $_REQUEST['max_price'];
	}
	if(isset($_REQUEST['min_size']) && !empty($_REQUEST['min_size'])){
		$hytteguiden_params['min_size'] = $_REQUEST['min_size'];
	}

	if(isset($_REQUEST['max_size']) && !empty($_REQUEST['max_size'])){
		$hytteguiden_params['max_size'] = $_REQUEST['max_size'];
	}

	if(isset($_REQUEST['min_beds']) && !empty($_REQUEST['min_beds'])){
		$hytteguiden_params['min_beds'] = $_REQUEST['min_beds'];
	}

	if(isset($_REQUEST['max_beds']) && !empty($_REQUEST['max_beds'])){
		$hytteguiden_params['max_beds'] = $_REQUEST['max_beds'];
	}

	wp_localize_script( 'hytteguiden_script', 'hytteguiden_params', $hytteguiden_params	);

	wp_enqueue_script( 'hytteguiden-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20190207', true );
	wp_enqueue_script( 'hytteguiden-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20190207', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hytteguiden_scripts' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* Custom file inclusion */
require get_template_directory() . '/library/config_manager.php';

/* SPID Configurations */
require get_template_directory() . '/vendor/autoload.php';
function tatwerat_startSession() {
	if(!session_id()) {
			session_start();
	}
}
add_action('init', 'tatwerat_startSession', 1);
//require get_template_directory() . '/config/config.php';
function hytte_user_login( $email ){
	$user_id = '';
	$exists = email_exists( $email );
		if ( $exists ) {
			$wp_user = get_user_by( 'email', $email );
			$user_id = $wp_user;			
		} else {
			$user_name = 'hytte_'.uniqid();
			$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
			$user_id = wp_create_user( $user_name, $random_password, $email );
				
		}
		return $user_id;

}

add_action( 'wp_ajax_hytte_update_profile', 'hytte_update_profile');
add_action( 'wp_ajax_nopriv_hytte_update_profile', 'hytte_update_profile');

/* Front Page Login
............................ */
if ( ! function_exists( 'hytte_update_profile' ) ) {

		function hytte_update_profile(){
						$post_id = $_POST['producer_id'];
						$my_post = array(
							'ID'           => $post_id,
							'post_title'   => $_POST['producer_name'],
						
					);
					// Update the post into the database
					wp_update_post( $my_post );
					update_post_meta( $post_id, 'producer_email', $_POST['user_email']);
					update_post_meta( $post_id, 'producer_address', $_POST['producer_address']);
					update_post_meta( $post_id, 'producer_website', $_POST['producer_web']);
					update_post_meta( $post_id, 'producer_contact_phone_1', $_POST['user_phone']);
					update_post_meta( $post_id, 'producer_contact_phone_2', $_POST['user_phone2']);
					$response_arr['status'] = 'success';   
					$response_arr['message'] = __('Success! Your profile has been updated.', 'hytteguiden');
					echo json_encode($response_arr);
			exit;

		}
}

/** Image Upload Ajax function ***/

add_action( 'wp_ajax_hytte_upload_profile_image', 'hytte_upload_profile_image');
add_action( 'wp_ajax_nopriv_hytte_upload_profile_image', 'hytte_upload_profile_image');

/* Front Page Login
............................ */
if ( ! function_exists( 'hytte_upload_profile_image' ) ) {

		function hytte_upload_profile_image(){

		$posted_data =  isset( $_POST ) ? $_POST : array();
		$file_data = isset( $_FILES ) ? $_FILES : array();

		$data = array_merge( $posted_data, $file_data );
		$post_id  = $_POST['post_id'];
		$response = array();
		//$uploaded_file = wp_handle_upload( $data['img'], array( 'test_form' => false ) );

		$file_return = wp_handle_upload($data['img'], array('test_form' => false));
				if(isset($file_return['error']) || isset($file_return['upload_error_handler'])){
					return false;
				}else{
					$filename = $file_return['file'];
					$attachment = array(
						'post_mime_type' => $file_return['type'],
						'post_content' => '',
						'post_type' => 'attachment',
						'post_status' => 'inherit',
						'guid' => $file_return['url']
					);
					if($title){
						$attachment['post_title'] ='test';
					}
					$attachment_id = wp_insert_attachment( $attachment, $filename );

					set_post_thumbnail( $post_id, $attachment_id );
					
					$response_arr['status'] = 'success';   
					$response_arr['message'] = __('Image changed.', 'hytteguiden');
					$response_arr['image_url'] = 	$file_return['url'];
					echo json_encode($response_arr);	
					wp_die();
				
				} 
}
}
// add class on body tag

add_filter( 'body_class', 'custom_class' );
function custom_class( $classes ) {
    if ( !is_front_page() ) {
        $classes[] = 'add_padding';
    }
    return $classes;
}

