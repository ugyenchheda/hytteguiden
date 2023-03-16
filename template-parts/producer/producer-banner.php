<div class="profile-feature"  itemscope itemtype="http://schema.org/ProfilePage
">
<p class="display-none" itemprop="url"><?php echo the_permalink(); ?></p>
	<?php
	// if ( has_post_thumbnail( ) ) {
 //    	echo '<div class="producerlogo">
	// 	<div class="container">
		
	// 	<div class="logowrap" itemprop="image" >'.get_the_post_thumbnail( get_the_ID(), array( 200, 150 ),'', array( "class" => "img-fluid" ) ).'</div></div></div>';

	// 	}
		$featured_sliders = array();
		$producer_banner_id = get_post_meta( get_the_ID(), 'producer_banner_id', true);	
		$producer_banner = get_post_meta( get_the_ID(), 'producer_banner', true);	
		$producer_location = get_post_meta( get_the_ID(), 'producer_location', true);
		$producer_video = get_post_meta( get_the_ID(), 'producer_youtube_link', true);
		$banner_images = [
			'575' => 'producer_banner_s',
			'767' => 'producer_banner_m',
			'991' => 'producer_banner_l',
			'1600' => 'producer_banner_xl'
		];

				
		if(!empty($producer_banner)) {
			$producer_content = '<picture>';
			foreach ($banner_images as $key => $banner_image) {
				$img = wp_get_attachment_image_src($producer_banner_id, $banner_image);				
				$producer_content .= '<source media="(max-width: '.$key.'px)" srcset="'.$img[0].'">';			
			}
			$producer_content .= '<img src="'.$producer_banner.'" alt="">';
			$producer_content .= '</picture>';
		

			$featured_sliders[] = array(
										'icon' => 'fa fa-home',
										'id' => 'pills-home-tab', 
										'controls' => 'pills-home', 
										'content' => $producer_content
									);

		}

		if(!empty($producer_location)) {

			$featured_sliders[] = array(
							'icon' => 'fa fa-map-marker-alt',
							'id' => 'pills-map-tab', 
							'controls' => 'pills-map', 
							'content' => '<div id="map" style="height: 500px;"></div><script>
											function initMap() {
											  var uluru = {lat: '. $producer_location['latitude'].', lng: '.  $producer_location['longitude'].'};
											  var map = new google.maps.Map(
											      document.getElementById("map"), {zoom: 18, center: uluru});
											  var marker = new google.maps.Marker({position: uluru, map: map});
											}
									    </script>'
						);
		}

		if(!empty($producer_video)) {

			$featured_sliders[] = array(
							'icon' => 'fa fa-video',
							'id' => 'pills-video-tab', 
							'controls' => 'pills-video', 
							'content' => '<iframe width="100%" height="500px" src="'.$producer_video.'" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
						);
		}

						    
	?>
	<div class="featured-block">
		<?php if($featured_sliders) { $cnt = 0; ?>
		<ul class="nav nav-pills" id="pills-tab" role="tablist">
			<?php foreach($featured_sliders as $featured_slider ) { ?>
			<li class="nav-item">
				<a class="nav-link <?php if($cnt == 0) { echo ' active'; }?>" id="<?php echo $featured_slider['id']; ?>" data-toggle="pill" href="#<?php echo $featured_slider['controls']; ?>" role="tab" aria-controls="<?php echo $featured_slider['controls']; ?>" aria-selected="true"><i class="<?php echo $featured_slider['icon']; ?>"></i></a>
			</li>
			<?php $cnt++; } ?>
		</ul>
		<?php } ?>

		<div class="tab-content" id="pills-tabContent">
			<?php if($featured_sliders) { $cnt = 0;
				foreach($featured_sliders as $featured_slider ) { ?>
			<div class="tab-pane fade show <?php if($cnt == 0) { echo ' active'; }?>" id="<?php echo $featured_slider['controls']; ?>" role="tabpanel" aria-labelledby="<?php echo $featured_slider['id']; ?>">
			<?php echo $featured_slider['content']; ?>			
			</div>
			<?php $cnt++; }
			} ?>


		</div>
	</div>
	<div class="profile-name">
		<div class="container">
			<!-- <h5>Eastern Norway</h5> -->
			<h1 itemprop="name"><?php the_title();?>		
			</h1>
			<?php
            if ( has_post_thumbnail( ) ) {
                echo '<div class="producerlogo mob_add_logo"><img src="'.get_the_post_thumbnail_url( get_the_ID(), 'full').'" class="img-fluid"></div>';
                }
        ?>
				<div class="clear"></div>
		</div>
	</div>
</div>