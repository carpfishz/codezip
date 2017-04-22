<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 4. 22.
 * Time: PM 5:33
 */

session_start();

require_once 'class.user.php';
$session = new user();

if(!$session->is_loggedin()) {
    $session->redirection('index.php'); //session 없으면 index.php
}