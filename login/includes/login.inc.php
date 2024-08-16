<?php
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    // Get the data from the user
    // THIS Doesn't get the data for some reason
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        // ERROR HANDLERS
        $errors = [];
        // this is the broken bit becasue the username and password isn't grabbed from the index for some reason

        if (is_input_empty($username, $password)){
            $errors["empty_input"] = "Fill in all the fields!";
        }

        $result = get_user($pdo, $username);

        if (is_username_wrong($result)){
            $errors["login_incorrect"] = "Incorrect login info!";
        }
        if (!is_username_wrong($result) && is_password_wrong($password, $result["pwd"])){
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        require_once 'config_session.inc.php';

        if($errors){
            $_SESSION["errors_login"] = $errors;

            header("Location: ../index.php");
            die(); 
        }

        // This will create an entirely new id
        // Were creating a new SESSION id and we add (append) the USER id to it, so that we know that the user is logged in 
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        // Reset the last regeneration (I think so at least, ep29 dani tutorial 32:50) so that in 30 min it updates to a new one
        $_SESSION["last_regeneration"] = time();
        $_SESSION["userName"] = $username;
        header("Location: ../index.php?login=success&userName=$username");
        $pdo = null;
        $stmt = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}

else{
    header("Location: ../index.php");
    die();
}