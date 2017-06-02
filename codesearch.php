<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 5. 30.
 * Time: AM 12:21
 */

session_start();
require_once 'class.user.php';
$user = new user();
$user_id = $_SESSION['user_session'];

$stmt = $user->runQuery("SELECT * FROM user WHERE id=:userId");
$stmt->execute(array(":userId"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])) {
    $title = $_POST['user_code_title1'];
    $userId = $userRow['id'];

    if(isset($_POST['userId'])) {
        $userId = $_POST['userId'];
    } else {
        $userId = $userRow['id'];
    }

    $openpub = '1';

    $stmt = $user->runQuery("SELECT * FROM code WHERE (title=:title OR id=:userId) AND openpub=:openpub");
    $stmt->bindparam(":title", $title);
    $stmt->bindparam(":userId", $userId);
    $stmt->bindparam(":openpub", $openpub);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['content'];
    }

} else {
    $user->redirection('main.php');
}