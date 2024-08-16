<?php

// This declare strict types make's it so that you have to tell explicitly is it a string or a number etc
declare (strict_types = 1);

// This is how you accept 2 data types, result can be either a bool or an array
// This function cchecks is the user in the db

function is_input_empty(string $username, string $password){
    if (empty($username) || empty($password)){
        return true;
    }else{
        return false;
    }
}

function is_username_wrong(bool|array $result){
    if (!$result){
        return true;
    } else{
        return false;
    }
}

function is_password_wrong(string $password, string $hashedPwd){
    if (!password_verify($password, $hashedPwd)){
        return true;
    } else{
        return false;
    }
}