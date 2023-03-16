<?php
		$banner_img = array();
		$banner_cnt = 1;
		$banner_ids=[];

		if ( has_post_thumbnail( get_the_ID()) ) {
			$banner_ids[] = get_post_thumbnail_id( get_the_ID() );
		}

        $cabin_images_galleries = get_post_meta( get_the_ID(), 'cabin_images_galleries', true);
        if($cabin_images_galleries):
			foreach ($cabin_images_galleries as $key => $gallery) {
				$banner_ids[] = $key;
			}
		  endif;
		  
		$count_banner = count($banner_ids);
		
		switch ($count_banner) {
			case '1':
				$count_class = ' imgcount01';
				break;
			case '2':
			    $count_class = ' imgcount02';
				break;
			case '3':
			case '4':
			    $count_class = ' imgcount03';
				break;
			
			default:
			    $count_class = ' imgcount05';
		}

		if(isset($count_banner) && $count_banner == 4 ){
			unset($banner_ids[3]);
		}
?>
<section class="sec-cabcollage">
	<div class="cabcollage <?php echo $count_class; ?>">
		<div class="user-options options-top">
		    <input type="hidden" name="cabin_id" id="cabin_id" value="<?php echo get_the_ID(); ?>">
			<?php echo hytte_sharethis_nav( get_the_ID() ); ?>
			<?php 
			echo hytteguiden_wishlist_status( get_the_ID());
			?>
			
			<!-- <a href="#" class="btn btn-light btn-xs selected"><i class="far fa-heart"></i> Save</a> -->
		</div>
		<!-- <div class="user-options options-btm">
			<a href="#" class="btn btn-light btn-xs"><i class="far fa-image"></i> View Photos</a>
		</div> -->


		<div class="clearfix">
			<div class="owl-carousel carousel-cabprofile">
		<?php

		    if(isset($banner_ids) && !empty($banner_ids)){
		    	foreach($banner_ids as $banner_id) {
		    		if($banner_cnt < 6) {

		    		echo '<div class="item">';
		    		 echo wp_get_attachment_image( $banner_id, "cabin_banner_l", "", array( "class" => "img-fluid" ) ); 
					//echo '<img src="'.$banner_img_url.'" alt="Vinterhytta" class="img-fluid">
					echo '</div>';
		    		}

					$banner_cnt++;
				}
		    }

		?>
			</div>
		</div>
	</div>
</section>
