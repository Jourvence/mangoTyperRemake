<?php
// Check how the user got to the page
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    try {
        require_once 'dbh.inc.php';
        // The order here is very important, first the model, then the contr
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        // ERROR HANDLERS
        $errors = [];

        if (is_input_empty($username, $password, $email)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (is_email_invalid($email)){
            $errors["invalid_email"] = "The email is invalid";
        }
        if (is_username_taken($pdo, $username)){
            $errors["username_taken"] = "This username is already taken";
        }
        if (is_email_reqistered($pdo, $email)){
            $errors["email_used"] = "This email is already registered";
        }

        require_once 'config_session.inc.php';

        if($errors){
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "username" => $username, 
                "email" => $email
            ];
            $_SESSION["signup_data"] = $signupData;

            header("Location: ../index.php");
            die(); 
        }

        create_user($pdo, $password, $username, $email);

        header("Location: ../index.php?signup=success");

        $pdo = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
// If they got here without submitting the form send them back
else{
    header("Location: ../index.php");
    die();
}