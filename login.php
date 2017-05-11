<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 4. 22.
 * Time: PM 5:53
 */

session_start();
require_once 'class.user.php';
$login = new user();

if($login->is_loggedin()!="") {
    $login->redirection('main.php');
}

if(isset($_POST['submit'])) {
    $userId = strip_tags($_POST['userEmail']);
    $userEmail = strip_tags($_POST['userEmail']);
    $userPw = strip_tags($_POST['userPw']);

    if($login->doLogin($userId,$userEmail,$userPw)) {
        $login->redirection('main.php');
    } else {
        $error = "fail";
        $login->redirection('logmain.php');
    }
} else {
    $login->redirection('logmain.php');
}