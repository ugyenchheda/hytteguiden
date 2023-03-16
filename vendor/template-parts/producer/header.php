<?php
/**
 * The Header template for our theme
 */
?><!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
   <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/animate.css" /> 
  <?php /* For slider on arrangement page flexslider.css */ ?>
  <link href="<?php echo get_template_directory_uri();?>/css/flexslider.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
 
	<?php wp_head(); ?>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-87001955-1', 'auto');
ga('send', 'pageview');

</script>
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=1492329290978610";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</head>

<body <?php body_class(); ?>>
<?php if (basel_needs_header()): ?>
	<?php do_action( 'basel_after_body_open' ); ?>
	<?php 
		basel_header_block_mobile_nav(); 
		$cart_position = basel_get_opt('cart_position');
		if( $cart_position == 'side' ) {
			?>
				<div class="cart-widget-side">
					<div class="widget-heading">
						<h3 class="widget-title"><?php esc_html_e('Shopping cart', 'basel'); ?></h3>
						<a href="#" class="widget-close"><?php esc_html_e('close', 'basel'); ?></a>
					</div>
					<div class="widget woocommerce widget_shopping_cart"><div class="widget_shopping_cart_content"></div></div>
				</div>
			<?php
		}
	?>
<?php endif ?>
<div class="website-wrapper">
<?php if (basel_needs_header()): ?>
	<?php if( basel_get_opt('top-bar') ): ?>
		<div class="topbar-wrapp color-scheme-<?php echo esc_attr( basel_get_opt('top-bar-color') ); ?>">
			<div class="container">
				<div class="topbar-content">
					<div class="top-bar-left">
						
						<?php if( basel_get_opt( 'header_text' ) != '' ): ?>
							<?php echo do_shortcode( basel_get_opt( 'header_text' ) ); ?>
						<?php endif; ?>						
						
					</div>
					<div class="top-bar-right">
						<div class="topbar-menu">
							<?php 
								if( has_nav_menu( 'top-bar-menu' ) ) {
									wp_nav_menu(
										array(
											'theme_location' => 'top-bar-menu',
											'walker' => new BASEL_Mega_Menu_Walker()
										)
									);
								}
							 ?>
						</div>
					</div>
				</div>
			</div>
		</div> <!--END TOP HEADER-->
	<?php endif; ?>

	<?php 
		$header_class = 'main-header';
		$header = apply_filters( 'basel_header_design', basel_get_opt( 'header' ) );
		$header_bg = basel_get_opt( 'header_background' );
		$header_has_bg = ( ! empty($header_bg['background-color']) || ! empty($header_bg['background-image']));

		$header_class .= ( $header_has_bg ) ? ' header-has-bg' : ' header-has-no-bg';
		$header_class .= ' header-' . $header;
		$header_class .= ' icons-design-' . basel_get_opt( 'icons_design' );
		$header_class .= ' color-scheme-' . basel_get_opt( 'header_color_scheme' );
	?>
	<!-- HEADER -->
	<header class="<?php echo esc_attr( $header_class ); ?>">
			<div class="languageselector" >
      <a class="btnHoreca" href="http://palmer.mediaserver.no/din-liste/">Favorittliste (<span id="favCount"><?php echo count_wishlist($_COOKIE['gd_favuser']);  ?></span>)</a> |
				 <a class="btnHoreca" href="https://www.vectura.no/">Horeca</a>
				  <?php do_action('wpml_add_language_selector'); ?>
       <a href="https://www.facebook.com/Palmer-Group-As-176655646001439" target="_blank"> <img src="http://palmer.no/wp-content/uploads/sites/6/2017/10/palmerfacebook.png" style="height: 27px;"></a>
	<!--  <div class="fb-like" data-href="https://www.facebook.com/Palmer-Group-As-176655646001439" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div> -->
			</div>  
		<?php basel_generate_header( $header ); // location: inc/template-tags.php ?>		
	</header><!--END MAIN HEADER-->
	<div class="clear"></div>
	
	<?php // basel_page_top_part();  
		$main_container_class = basel_get_main_container_class(); ?>

			<?php endif ?>
 

  
       