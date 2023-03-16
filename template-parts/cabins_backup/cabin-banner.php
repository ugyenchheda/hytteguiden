<section class="sec-cabcollage">
	<div class="cabcollage">
		<div class="user-options options-top">
			<a href="#" class="btn btn-light btn-xs"><i class="fa fa-share-alt"></i> Share</a>
			<a href="#" class="btn btn-light btn-xs"><i class="far fa-heart"></i> Save</a>
			<!-- <a href="#" class="btn btn-light btn-xs selected"><i class="far fa-heart"></i> Save</a> -->
		</div>
		<!-- <div class="user-options options-btm">
			<a href="#" class="btn btn-light btn-xs"><i class="far fa-image"></i> View Photos</a>
		</div> -->


		<div class="clearfix">
			<div class="owl-carousel carousel-cabprofile">
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
		






		    if(isset($banner_ids) && !empty($banner_ids)){
		    	foreach($banner_ids as $banner_id) {
		    		if($banner_cnt < 6) {

		    		echo '<div class="item">';
		    		 echo wp_get_attachment_image( $banner_id, "post_image_xl", "", array( "class" => "img-fluid" ) ); 
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
