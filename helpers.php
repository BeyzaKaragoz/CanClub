<?php

function db_connect(){
    try {
        return $db = new PDO("mysql:host=localhost;dbname=canclub;charset=utf8", "root", "");
    } catch (PDOException $error) {
        return $error->getMessage();
    }
}

function login_control(){
    if (!isset($_SESSION["login_user"])){
        header("Location: login.php");
    }
}

function login_user_greeter(){
    return $_SESSION["login_user"]["username"]." - ".$_SESSION["login_user"]["name"]." ".$_SESSION["login_user"]["surname"];
}

function date_day_diff($publish_date){
    $date_second_diff = time() - strtotime($publish_date);
    $date_day_diff = round($date_second_diff / (60*60*20));
    return $date_day_diff;
}

?>