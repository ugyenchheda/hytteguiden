<div class="modal fade contactformmodal" id="producercontactform" tabindex="-1" role="dialog" aria-labelledby="producercontactform" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<span class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true"><img src="<?php echo get_template_directory_uri(); ?>/images/cancel.svg" alt=""></span>
				<h4 class="modal-title"> <?php esc_html_e( 'Kontakt Produsenter', 'hytteguiden' ); ?></h4>
			</div>
			
			<div class="modal-body">
				<div class="formfilter">
					<form id="produsenter_contact_form">
						<div class="form-group">
							<label class="fieldlabel"><?php esc_html_e( 'Navn', 'hytteguiden' ); ?> *</label>
							<input type="text" id="con_name" name="con_name" class="form-control" placeholder="<?php esc_attr_e( 'Navn', 'hytteguiden' ); ?>">
							<input type="hidden" id="cabin_id" name="cabin_id" value="<?php echo get_the_ID(); ?>" />
						</div>
						<div class="form-group">
							<label class="fieldlabel"><?php esc_html_e( 'Epost', 'hytteguiden' ); ?> *</label>
							<input type="email" id="con_email" name="con_email"  class="form-control" placeholder="<?php esc_attr_e( 'Epost', 'hytteguiden' ); ?>">
						</div>
						<div class="form-group">
							<label class="fieldlabel"><?php esc_html_e( 'Telefon', 'hytteguiden' ); ?> *</label>
							<input type="text" id="con_phone" name="con_phone"  class="form-control" placeholder="<?php esc_attr_e( 'Telefon', 'hytteguiden' ); ?>">
						</div>
						<div class="form-group">
							<label class="fieldlabel"><?php esc_html_e( 'Spørsmål', 'hytteguiden' ); ?> *</label>
							<textarea id="con_message" name="con_message" class="form-control" placeholder="<?php esc_attr_e( 'Spørsmål', 'hytteguiden' ); ?>" rows="4"></textarea>
						</div>
						<button type="button" id="btn_contact_producer" class="btn btn-block btn-theme1"><?php esc_html_e( 'Submit', 'hytteguiden' ); ?></button>
						<div id="alert_msg" class="alert"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>