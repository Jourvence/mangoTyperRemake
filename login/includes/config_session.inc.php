<!-- This whole file is basically a session security thing, for cookies etc -->

<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

session_start();
// Here we're checking if we have a user currently logged in into the website by checking if we
// have a current session variable that is equal to user_id or at least named user_id 
if (isset($_SESSION["user_id"])){
    if (!isset($_SESSION["last_regenetaion"])) {
        regenerate_session_id_loggedin(); 
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id_loggedin();
        }
    }

}else{
    // Here we have the code that will run if the user is no longer logged into the website
    if (!isset($_SESSION["last_regenetaion"])) {
        regenerate_session_id(); 
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id();
        }
    }
}

function regenerate_session_id_loggedin()
{
    session_regenerate_id(true);

    $userId = $_SESSION["user_id"];
    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $userId;
    session_id($sessionId);

    $_SESSION["last_regeneration"] = time();
}

function regenerate_session_id(){
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
}