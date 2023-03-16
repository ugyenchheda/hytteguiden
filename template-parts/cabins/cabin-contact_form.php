
  <form class ="produsenter_contact_form">
    <div class="form-group">
      <input type="text" name="con_name" class="form-control con_name" placeholder="<?php esc_attr_e( 'Fullt navn', 'hytteguiden' ); ?>">
      <input type="hidden" class="cabin_id" name="cabin_id" value="<?php echo get_the_ID(); ?>" />
    </div>
    <div class="form-group">
      <input type="email" name="con_email"  class="form-control con_email" placeholder="<?php esc_attr_e( 'Din e-post', 'hytteguiden' ); ?>">
    </div>
    <div class="form-group">
      <input type="text" name="con_phone"  class="form-control con_phone" placeholder="<?php esc_attr_e( 'Telefon', 'hytteguiden' ); ?>">
    </div>
    <div class="form-group bmd-form-group">
      <textarea name="con_message" class="form-control con_message" placeholder="<?php esc_attr_e( 'Spørsmål', 'hytteguiden' ); ?>" rows="4"></textarea>
    </div>
    <button type="button" class="btn btn-block btn-theme1 btn_contact_producer"><?php esc_html_e( 'Send', 'hytteguiden' ); ?></button>
    <div class="alert_msg alert"></div>
  </form>
