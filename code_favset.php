<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017-06-03
 * Time: 오후 10:40
 */

session_start();
require_once 'class.user.php';
$user = new user();
$user_id = $_SESSION['user_session'];

if(isset($_POST['submit'])) {
    $idx = $_POST['idx'];
    $fav = '1';

    $stmt = $user->runQuery("UPDATE favorite SET fav=:favorite WHERE codeidx=:idx AND id=:userId");
    $stmt->bindparam(":userId", $user_id);
    $stmt->bindparam(":idx", $idx);
    $stmt->bindparam(":favorite", $fav);
    $stmt->execute();
    header("Location: http://223.194.105.180/main.php");
} else {
    header("Location: http://223.194.105.180/main.php");
}