<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hytteguiden
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head(); ?>
</head>

<?php
$body_class = '';
$header_class = '';

if(is_front_page() ){
	$body_class = 'pageheadoverlay';
	$header_class = ' headeroverlay';
	
} else if ( is_single( 'cabin' )){
	$header_class = ' headeroverlay';
}
else if ( is_single( 'producer' )){
	$body_class = 'pageheadoverlay';
	$header_class = ' headeroverlay';
}
?>

<body <?php body_class($body_class); ?>>
	<header class="header <?php echo $header_class; ?>">
		<div class="container-fluid">
			<div class="headwrap">
				<div class="headblock">
					<span class="navtrigger"><i class="fa fa-bars"></i></span>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="sitelogo">
						<?php
							$transparent_logo = get_theme_mod('transparent_logo',  get_template_directory_uri(). '/images/hytteguiden-logo-white.png');
							$main_logo = get_theme_mod('main_logo',  get_template_directory_uri(). '/images/hytteguiden-logo-theme.png');


							if(is_front_page() && !empty($transparent_logo)){
								echo '<img src="'.$transparent_logo.'" class="img-fluid logo-white">';
							}
							if(!empty($main_logo)){
								echo '<img src="'.$main_logo.'" class="img-fluid logo-theme">';
							}

						?>

					</a>
				</div>
				<nav class="navigation">
					<div class="navhead">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navlogo">
							<?php

							if(!empty($main_logo)){
								echo '<img src="'.$main_logo.'" class="img-fluid logo-theme">';
							}
							?>
						</a>
						<span class="closenav"><img src="<?php echo get_template_directory_uri(); ?>/images/cancel.svg" alt=""></span>
					</div>

					<?php
					$navigation_args =  array(
											    'theme_location' => 'primary_menu'
											);
					 wp_nav_menu($navigation_args); ?>
				</nav>
				<div class="usernav">
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['mycatalogue_page']; ?>"><i class="far fa-file-alt"></i> <span class="navnum kataloger_count"><?php echo hytteguiden_saved_count('kataloger'); ?></span><span class="navtext"><?php _e( 'Mine kataloger' , 'hytteguiden')?></span></a></li>
						<li><a href="<?php echo esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['mycabins_page']; ?>"><i class="far fa-heart"></i> </i> <span class="navnum cabin_count"><?php echo hytteguiden_saved_count('wishlists'); ?></span><span class="navtext"><?php _e( 'Mine Hytter' , 'hytteguiden')?></span></a></li>
					
						<?php echo hytte_user_login_nav(); 	?>
					
						<li class="searchtrigger"><span><i class="fa fa-search"></i></span></li>
					</ul>
				</div>
			</div>
		</div>
	<div class="headersearch">
	<form method="get" action="<?php echo hytteguiden_search_result_url(); ?>" id="global_search_form">
			<div class="form-group">
				<input type="text" id="global_search" name="s" value="<?php if(isset($_REQUEST['s']) && !empty($_REQUEST['s'])){ echo $_REQUEST['s']; } ?>" placeholder="Søk Etter Hytte" class="form-control">

				<a href="<?php echo hytteguiden_search_result_url(); ?>" class="btn btn-theme1 btn-filter">Se Alle Hytter</a>
				<span class="btn btn-theme1 btn-search"><i class="fa fa-times"></i></span>
			</div>
		</form>
	</div>										
	</header>
	<!-- //header -->
