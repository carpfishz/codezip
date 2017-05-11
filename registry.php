<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 4. 22.
 * Time: PM 5:35
 */

session_start();
require_once 'class.user.php';
$user = new user();

if($user->is_loggedin()!="") {
    $user->redirection('main.php');
}

if(isset($_POST['submit'])) {
    $userId = strip_tags($_POST['userId']);
    $userPw = strip_tags($_POST['userPw']);
    $userName = strip_tags($_POST['userName']);
    $userEmail = strip_tags($_POST['userEmail']);

    $stmt = $user->runQuery("SELECT id, email FROM user WHERE id=:userId OR email=:userEmail");
    $stmt->execute(array(':userId'=>$userId, ':userEmail'=>$userEmail));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['id'] == $userId) {
        echo "<script>
        alert('ID가 이미 사용중 입니다.');
        window.location.href='signup.php';
        </script>";
    } elseif ($row['email'] == $userEmail) {
        echo "<script>
        alert('E-mail이 이미 사용중 입니다.');
        window.location.href='signup.php';
        </script>";
    } else {
        $user->register($userId, $userPw, $userName, $userEmail);
        $user->redirection('logmain.php');
    }
} else {
    $user->redirection('signup.php');
}