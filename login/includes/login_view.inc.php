<?php
// If this whole file doesn't work it means it should've been included somewhere, probably in the login.inc
declare(strict_types = 1);

function check_login_errors($name){
    if (isset($_SESSION["errors_login"])){
        $errors = $_SESSION["errors_login"];

        echo "<br>";
    
        // Here we output all the errors from a loop and the br is just for aesthetic reasons
        foreach ($errors as $error){
            echo '<p class="form-error">' . $error . '</p>';
        }

        unset($_SESSION['errors_login']);
    }
    // Now we create a succesful login message if we didn't have any errors
    // I think that _GET gets data from the link
    else if (isset($_GET['login']) && $_GET['login'] === 'success') {
        echo '<br>';
        echo '<p class ="form-success">The username is: ' . $name . '</p>';

        header("Location: http://localhost/firstSight/mangoTyperRemake/typer?login=$name");
    }
}