<?php

// Copy this file to a file called config.php and enter your credentials

if ($_SERVER['SERVER_NAME'] == 'testsdk.dev') {
    include('config-test.php');
    return;
}

// Example overwrites REDIRECT_URI so that they can share this config file
$SPID_CREDENTIALS = array(
    /**
        VGS_Client::CLIENT_ID       => '4cf36fa274dea2188534224',
        VGS_Client::CLIENT_SECRET   => 'foobar',
        VGS_Client::CLIENT_SIGN_SECRET => 'a274de',
        VGS_Client::STAGING_DOMAIN  => 'spp.dev',
        VGS_Client::HTTPS           => false,
        VGS_Client::REDIRECT_URI    => "http://sdk.dev/explorer.php",
        VGS_Client::DOMAIN          => 'sdk.dev',
        VGS_Client::COOKIE          => true,
        VGS_Client::API_VERSION     => 2,
        VGS_Client::PRODUCTION      => false,
    **/
);

if (!$SPID_CREDENTIALS) {
    die('You must configure $SPID_CREDENTIALS in examples/config.php first!');
}
// effects only apirequest.php, having it return the full container or just the data part
DEFINE('EXPLORER_SHOW_CONTAINER', false);

?>
