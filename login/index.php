<?php
ini_set('display_errors', 0); 
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <section id="wrapper-login">
    <h1>Login</h1>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="username" id="login-username" placeholder="Username">
        <input type="text" name="password" id="login-password" placeholder="Password">
        <button name="login">Login</button>
    </form>    
    </section>

    <?php
        check_login_errors($_GET['userName']);
    ?>

    <section id="wrapper-signup">
        <h1>Signup</h1>
        <form action="includes/signup.inc.php" method="post">
            <?php 
                signup_inputs();
            ?>
            <button name="Signup">Signup</button>
        </form>
    </section>

    <?php 
        check_signup_errors();
    ?>

    <section id="wrapper-logout">
        <h1>Logout</h1>
        <form action="includes/logout.inc.php" method="post">
            <button name="logout">Logout</button>
        </form>    
    </section>
</body>
</html>


<!-- Figure out why the login_view.inc.php doesn't work -->