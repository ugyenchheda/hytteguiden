<div class="modal fade contactformmodal" id="catalog_order_form" tabindex="-1" role="dialog" aria-labelledby="catalog_order_form" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<span class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true"><img src="<?php echo get_template_directory_uri(); ?>/images/cancel.svg" alt=""></span>
				<h4 class="modal-title"> <?php esc_html_e( 'Velg katalog ', 'hytteguiden' ); ?></h4>
			</div>
			
			<div class="modal-body">
				<div class="formfilter">
				<form class ="produsenter_contact_form">
					<div class="form-group">
					<p class="text-center"> <?php esc_html_e( 'Vennligst velg katalogen du vil bestille.', 'hytteguiden' ); ?></p>
					<br>
<div class="row">
				<?php 
					global $post;
					$cabin_producer_id = get_the_ID();
					if(is_singular('cabin')){
						$cabin_producer_id = get_post_meta(get_the_ID(), 'cabin_producer_id', true);
					}

					$args = array(
						'post_type' => 'kataloger',
						'posts_per_page' => -1,
						'meta_query'=> array(
							array(
							'key' => '_catalogs_producer_id',
							'compare' => '=',
							'value' =>  $cabin_producer_id,
							)
						),
					);
					$myposts = get_posts( $args );
						if($myposts){
						foreach( $myposts as $post ) :
							setup_postdata($post);
							echo '<div class="col-6 text-center"><div class="catalog-wrap">';
							echo  get_the_post_thumbnail( $post->ID, 'post_image_l', array( "class" => "img-fluid" ) );
							echo '<div class="catalog-title-box">';
							echo '<input type="checkbox" name="kataloger_order[]" class="radio-catalog kataloger_order" value="'.$post->ID.'"><label class="label-catalog">'.get_the_title( $post->ID ).'</label>';
							echo '</div></div></div>';
						endforeach;
						}
						wp_reset_postdata();
							
				?></div>
					</div>
					<input type="hidden" name="cabin_producer_id" id="cabin_producer_id" value="<?php echo $cabin_producer_id; ?>">
					<button type="button" class="btn btn-block btn-theme1 btn_order_kataloger"><?php esc_html_e( 'Bestill katalog', 'hytteguiden' ); ?></button>
					<div class="alert_msg alert"></div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>