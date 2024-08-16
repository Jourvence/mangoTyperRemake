<?php

// This declare strict types make's it so that you have to tell explicitly is it a string or a number etc
declare (strict_types = 1);

function get_user(object $pdo, string $username){
    $query = "SELECT * FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    // if the user exists in the db grab the data, and if he doesn't then we get a false stamenet
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}