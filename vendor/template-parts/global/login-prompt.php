<div style="display:none">
    <div id="add-to-favourite">
        <h2 class="text-center"><?php esc_html_e( 'Logg Inn', 'hytteguiden' ); ?></h2><br>
        <p><?php esc_html_e( 'Du må logge inn først for å legge denne hytta til din favorittliste.', 'hytteguiden' ); ?></p><br>
        <a href="<?php echo  esc_url( home_url( '/' ) ) . $GLOBALS['route_defaults']['login_page']; ?>" class="btn btn-block btn-lg btn-theme1"><?php esc_html_e( 'Logg Inn', 'hytteguiden' ); ?></a>
    </div>
</div>