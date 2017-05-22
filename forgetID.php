<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 5. 23.
 * Time: AM 2:53
 */

session_start();
require_once 'class.user.php';
$user = new user();

if($user->is_loggedin()!="") {
    $user->redirection('main.php');
}

if(isset($_POST['submit'])) {
    $userName = strip_tags($_POST['userName']);
    $userEmail = strip_tags($_POST['userEmail']);

    $stmt = $user->runQuery("SELECT id FROM user WHERE name=:userName OR email=:userEmail");
    $stmt->execute(array(':userName'=>$userName, ':userEmail'=>$userEmail));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['id'] == '') {
        echo "<script>
        alert('존재하지 않는 아이디입니다. 이름과, 메일주소를 다시 한번 확인해주세요.');
        window.location.href='forget.php';
        </script>";
    } else {
        echo "<script>
        alert('" . $row['id'] . "');
        window.location.href='logmain.php';
        </script>";
    }
} else {
    $user->redirection('logmain.php');
}