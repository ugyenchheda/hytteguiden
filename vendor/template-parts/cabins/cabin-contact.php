<div class="modal fade contactformmodal" id="producercontactform" tabindex="-1" role="dialog" aria-labelledby="producercontactform" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<span class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true"><img src="<?php echo get_template_directory_uri(); ?>/images/cancel.svg" alt=""></span>
				<h4 class="modal-title"> <?php esc_html_e( 'Kontakt produsenten', 'hytteguiden' ); ?></h4>
			</div>
			
			<div class="modal-body">
				<div class="formfilter">
					<?php get_template_part( 'template-parts/cabins/cabin', 'contact_form' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>