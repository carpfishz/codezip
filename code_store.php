<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 5. 30.
 * Time: PM 9:08
 */

session_start();
require_once 'class.user.php';
$user = new user();
$user_id = $_SESSION['user_session'];

if(isset($_POST['submit'])) {
    $title = $_POST['user_code_title'];
    $txt = $_POST['user_code'];
    $lang = 'python';
    $openpub = $_POST['disclosure'];

    $stmt = $user->runQuery("INSERT INTO code(title, content, lang, openpub, id) VALUES(:title, :txt, :lang, :openpub, :userId)");
    $stmt->bindparam(":title", $title);
    $stmt->bindparam(":txt", $txt);
    $stmt->bindparam(":lang", $lang);
    $stmt->bindparam(":openpub", $openpub);
    $stmt->bindparam(":userId", $user_id);
    $stmt->execute();
    header("Location: http://223.194.105.180/main.php");
} else {
    // echo "fail";
    header("Location: http://223.194.105.180/main.php");
}