<?php

function get_list_users() {
    $result = db_fetch_array("SELECT * FROM `users`");
    return $result;
}

function get_user_by_email($email) {
    $item = db_fetch_row("SELECT * FROM `users` WHERE `email` = '{$email}'");
    return $item;
}

function add_user($data){
    return db_insert("users", $data);
}

function update_user($data, $email){
    return db_update("users", $data, "email = '{$email}' ");
}

function check_login($email, $password)
{
    $check_user = db_num_rows("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
    if ($check_user > 0) {
        return true;
    }
    return false;
}