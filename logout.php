<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 4. 22.
 * Time: PM 5:52
 */

require_once 'session.php';
require_once 'class.user.php';

$user_logout = new user();
$user_logout->doLogout();
$user_logout->redirection('logmain.php');