<?php

/* Hytteguiden Theme activation hook
................................................. */
if ( ! function_exists( 'hytteguiden_create_dynamic_table' ) ) {
	function hytteguiden_create_dynamic_table() {
	  	global $wpdb;
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        
        /* Create contact_producer table */
		$sql = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."contact_producer` ( 
            `id` bigint(20) not null auto_increment,
			`con_name` varchar(70) not null,
            `con_email` varchar(70) not null,
            `con_phone` varchar(70) not null,
            `con_message` text NOT NULL,
            `ip_address` varchar(70) not null,
            `con_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `post_id` int(10) not null, PRIMARY KEY  (`id`));";

        dbDelta($sql);
        
        /* Create wishlist table */
        $sql = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."wishlists` ( 
            `id` bigint(20) not null auto_increment,
			`user_id` int(10) not null,
            `post_id` int(10) not null,
            `guest_id` varchar(170) not null,
            `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
             PRIMARY KEY  (`id`));";

        dbDelta($sql);
        
        /* Create wishlist table */
        $sql = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."kataloger` ( 
            `id` bigint(20) not null auto_increment,
            `user_id` int(10) not null,
            `kataloger_id` int(10) not null,
            `producer_id` int(10) not null,
            `guest_id` varchar(170) not null,
            `status` varchar(170) not null,
            `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY  (`id`));";

        dbDelta($sql);

	}
}
add_action('after_switch_theme', 'hytteguiden_create_dynamic_table');

?>