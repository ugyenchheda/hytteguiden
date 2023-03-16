<?php
/**
 * The main template file
 *  Template Name: spid
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

get_header();
$wp_user = get_user_by( 'email', 'example@ex.com' );

print_r($wp_user);


// Include PHP SDK Client and a config file with credentials
$spidClientConfig = [
  VGS_Client::CLIENT_ID          => "5c496e3dfe20a2090b603e99",
  VGS_Client::CLIENT_SECRET      => "tx2hpRgjMuon3fhfvdj1",
  VGS_Client::CLIENT_SIGN_SECRET => "Xr7nR2CzgAvmjKNAbJdi",
  VGS_Client::STAGING_DOMAIN     => "identity-pre.schibsted.com",
  VGS_Client::HTTPS              => true,
  VGS_Client::REDIRECT_URI       => "https://hytte.indexportal.no/",
  VGS_Client::COOKIE             => false,
  VGS_Client::API_VERSION        => 2,
  VGS_Client::PRODUCTION         => false
];
// overwrite redirect url to be HERE
$spidClientConfig[VGS_Client::REDIRECT_URI] = "https://hytte.indexportal.no/spid-bijay";
$spidClientConfig[VGS_Client::COOKIE] = true; // disable cookie support for SDK

// Instantiate the SDK client
$client = new VGS_Client($spidClientConfig);
$client->argSeparator = '&';

// When a logout redirect comes from SPiD, delete the local session
if (isset($_GET['logout'])) {
   unset($_SESSION['sdk']);
}

// Code is part of the redirect back from SPiD, redirect to self to remove it from URL
// since it may only be used once, and it has been used to create session
if (isset($_GET['code'])) {
    // Get/Check if we have local session, creates ones if code GET param comes
    $_SESSION['sdk'] = $client->getSession(); 
  //  header( "Location: ". $client->getCurrentURI(array(), array('code','login','logout'))) ;
   // exit;
}
?>
<section class="section">
  <div class="container">
    <div class="login-form">
      <h2 class="sectiontitle" style="text-align: center;"><span> Logg Inn</span></h2>
      <p class="login-text">Vennligst bruk brukernavn og passord gitt til deg for å logge inn.</p>
      <?php     

        // May get credential errors
        if (isset($_GET['error'])) {
            echo '<h3 id="message" style="color:red">'.$_GET['error'].'</h3>';
        }

        $session = isset($_SESSION['sdk']) ? $_SESSION['sdk'] : false;

        // If we have session, that means we are logged in.
        if ($session) {
            // Authorize the client with the session saved user token
            $client->setAccessToken($session['access_token']);

            // Try since SDK may throw VGS_Client_Exceptions:
            //   For instance if the client is blocked, has exceeded ratelimit or lacks access right
            try {
                // Grab the logged in user's User Object, /me will include the entire User object
                $user = $client->api('/me');       

                $hytte_user = hytte_user_login( $user['email'] ); 
                
                print_r($hytte_user);

        
                 
                    if( $hytte_user ) {
                    wp_set_current_user( $hytte_user->ID );
                    wp_set_auth_cookie( $hytte_user->ID, true );
                    do_action( 'wp_login', $hytte_user->user_login, $hytte_user );
                    echo 'bj';
                    }

              


                echo '<h3 id="message">Welcome</h3>
                    <h4>Logged in as <span id="name" style="color:blue">'.
                    $user['displayName'].'</span> <small>id: <span id="userId" style="color:green">'.
                    $user['userId'].'</span> email: <span id="email" style="color:purple">'.
                    $user['email'].'</span></h4>';

                if (isset($_GET['order_id'])) {
                    echo '<pre>'.print_r($client->api('/order/'.$_GET['order_id']),true).'</pre>';
                }

            } catch (VGS_Client_Exception $e) {
                if ($e->getCode() == 401) {
                    // access denied, in case the access token is expired, try to refresh it
                    try {
                        // refresh tokens using the session saved refresh token
                        $client->refreshAccessToken($session['refresh_token']);
                        $_SESSION['sdk']['access_token'] = $client->getAccessToken();
                        $_SESSION['sdk']['refresh_token'] = $client->getRefreshToken();
                        // Sesssion refreshed with valid tokens
                        header( "Location: ". $client->getCurrentURI(array(), array('code','login','error','logout', 'order_id', 'spid_page'))) ;
                        exit;
                    } catch (Exception $e2) {
                        /* falls back to $e message bellow */
                    }
                }
                if ($e->getCode() == 400) {
                    header( "Location: ". $client->getLoginURI(array('redirect_uri' => $client->getCurrentURI(array(), array('logout','error','code', 'order_id', 'spid_page')))));
                    exit;
                }

                // API exception, show message, remove session as it is probably not usable
                unset($_SESSION['sdk']);
                echo '<h3 id="error" style="color:red">'.$e->getCode().' : '.$e->getMessage().'</h3>';
            }

         

            // Show a logout link
            echo '<p><a id="login-link" href="' . $client->getLogoutURI(array('redirect_uri' =>
                $client->getCurrentURI(array('logout' => 1), array('error','code', 'order_id', 'spid_page'))
            )) . '">Logout</a></p>';


          

        } else { // No session, user must log in
        
        
            // Show a login link
            echo '<p><a id="login-link" href="' . $client->getLoginURI(array(
                'redirect_uri' => $client->getCurrentURI(array('place' => 'oslo'), array('logout','error','code', 'default', 'cancel', 'order_id', 'spid_page')),
                'cancel_redirect_uri' => $client->getCurrentURI(array('cancel' => 1), array('logout','error','code', 'default', 'cancel', 'order_id', 'spid_page')),
            )) . '">Login</a> (standard auth flow)</p>';

           

        }

        ?>
    </div>
  </div>
</section>
<?php

get_footer();
