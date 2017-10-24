<?php

function siteURL() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    return $protocol;
}

define('PROJECT_NAME', '123VAMOS');
define('CONTACT_EMAIL', 'admin@123vamos.co');

define('FROM_NAME', '123VAMOS');
define('FROM_EMAIL', 'no-reply@123vamos.co');

$reqUri = explode("/", $_SERVER['REQUEST_URI']);

define('SITE_URL', siteURL());
define('HOME_URL', SITE_URL . $_SERVER['SERVER_NAME'] .'/'. $reqUri[1].'/123vamos/');

//================ retrive social url ======================
$fbSql = "SELECT * FROM settings WHERE slug = 'facebook_url'";

$fbResult = mysqli_query($con, $fbSql); // get all created event record

if (mysqli_num_rows($fbResult) > 0) {
    while ($row = mysqli_fetch_assoc($fbResult)) {
        define('FACEBOOK_URL', $row["value"]);
    }
} else {
    define('FACEBOOK_URL', $row[""]);
}

//------------------------------- instagram link --------------
$instagramSql = "SELECT * FROM settings WHERE slug = 'instagram'";

$instagramResult = mysqli_query($con, $instagramSql); // get all created event record

if (mysqli_num_rows($instagramResult) > 0) {
    while ($row = mysqli_fetch_assoc($instagramResult)) {
        define('INSTAGRAM_URL', $row["value"]);
    }
} else {
    define('INSTAGRAM_URL', $row[""]);
}

//---------------------------- google link ---------------------

$gSql = "SELECT * FROM settings WHERE slug = 'google_plus_url'";

$gResult = mysqli_query($con, $gSql); // get all created event record

if (mysqli_num_rows($gResult) > 0) {
    while ($row = mysqli_fetch_assoc($gResult)) {
        define('GOOGLE_PLUS_URL', $row["value"]);
    }
} else {
    define('GOOGLE_PLUS_URL', $row[""]);
}

//---------------------------- Instagram access token ---------------------

$instagramAccessTokenSql = "SELECT * FROM settings WHERE slug = 'instagram_access_token'";

$instagramAccessTokenResult = mysqli_query($con, $instagramAccessTokenSql); // get all created event record

if (mysqli_num_rows($instagramAccessTokenResult) > 0) {
    while ($row = mysqli_fetch_assoc($instagramAccessTokenResult)) {
        define('INSTAGRAM_ACCESS_TOKEN', $row["value"]);
    }
} else {
    define('INSTAGRAM_ACCESS_TOKEN', $row[""]);
}
//------------------------------- Nexmo Api Key --------------
$nexmoApiSql = "SELECT * FROM settings WHERE slug = 'nexmo_api_key'";

$nexmoApiResult = mysqli_query($con, $nexmoApiSql); // get all created event record

if (mysqli_num_rows($nexmoApiResult) > 0) {
    while ($row = mysqli_fetch_assoc($nexmoApiResult)) {
        define('NEXMO_API_KEY', $row["value"]);
    }
} else {
    define('NEXMO_API_KEY', $row[""]);
}

//---------------------------- Nexmo Api Secreet ---------------------

$nexmoSecretSql = "SELECT * FROM settings WHERE slug = 'nexmo_api_secret'";

$nexmoSecretResult = mysqli_query($con, $nexmoSecretSql); // get all created event record

if (mysqli_num_rows($nexmoSecretResult) > 0) {
    while ($row = mysqli_fetch_assoc($nexmoSecretResult)) {
        define('NEXMO_API_SECRET', $row["value"]);
    }
} else {
    define('NEXMO_API_SECRET', $row[""]);
}

//---------------------------- Nexmo Api From Number ---------------------

$nexmoFromNumberSql = "SELECT * FROM settings WHERE slug = 'nexmo_from_number'";

$nexmoFromNumberResult = mysqli_query($con, $nexmoFromNumberSql); // get all created event record

if (mysqli_num_rows($nexmoFromNumberResult) > 0) {
    while ($row = mysqli_fetch_assoc($nexmoFromNumberResult)) {
        define('NEXMO_FROM_NUMBER', $row["value"]);
    }
} else {
    define('NEXMO_FROM_NUMBER', $row[""]);
}
?>