<?php
/*  AddOns Options
   ..................................... */
if ( ! function_exists( 'theme_settings_menu' ) ) {
	function theme_settings_menu() {
		$icon_url = get_template_directory_uri()."/library/admin/assets/images/theme_setting.png";
		add_menu_page('Theme Settings', 'Theme Settings', 'manage_options', 'hytte_dashboard',  'hytteguiden_dashboard', $icon_url, 21);
		add_submenu_page('hytte_dashboard', 'Template Endpoints', 'Template Endpoints', 'manage_options', 'tpl_endpoints', 'hytteguiden_tpl_endpoints');
		add_submenu_page('hytte_dashboard', 'Hytte Kontakt', 'Hytte Kontakt', 'manage_options', 'cabin_contact_list', 'hytte_cabin_contact_list');
		add_submenu_page('hytte_dashboard', 'Kataloger Bestilling', 'Kataloger Bestilling', 'manage_options', 'kataloger_contact_list', 'hytte_kataloger_contact_list');
		add_submenu_page('hytte_dashboard', 'Google Map API', 'Google Map API', 'manage_options', 'hytte_map_slug', 'hytteguiden_map_slugs');		

	}
}
add_action('admin_menu', 'theme_settings_menu');

function hytteguiden_dashboard(){
	include( get_template_directory() . '/library/admin/options/dashboard.php' );
}

function hytteguiden_tpl_endpoints(){
	include( get_template_directory() . '/library/admin/options/tpl_endpoints.php' );
}

function hytteguiden_map_slugs(){
	include( get_template_directory() . '/library/admin/options/map_api.php' );
}

function hytte_cabin_contact_list(){
	include( get_template_directory() . '/library/admin/options/hytte_cabin_contact_list.php' );
}

function hytte_kataloger_contact_list(){
	include( get_template_directory() . '/library/admin/options/hytte_kataloger_contact_list.php' );
}
?>
