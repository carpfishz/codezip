<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 5. 23.
 * Time: AM 3:27
 */

session_start();
require_once 'class.user.php';
$login = new user();
if($login->is_loggedin()!="") {
    $login->redirection('main.php');
}

$userId = strip_tags($_POST['userId']);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>CodeZip sign up page</title>
    <link rel="stylesheet" href="css/init.css">
    <link rel="stylesheet" href="css/forget.css">
    <link rel="stylesheet" href="css/nanumbarungothic.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>
<body>
<div id="wrapper">
    <div id="image-wrapper">
        <h1>
            <a href="logmain.php">CodeZip</a>
        </h1>
    </div>
    <div id="form-wrapper">
        <form action="changePW.php" method="POST" id="forgetpw_form">
            <input type="password" name="userPw" placeholder="비밀번호" required autofocus>
            <input type="password" name="userPwcheck" placeholder="비밀번호 확인" required>
            <input type="submit" value="비밀번호변경" name="submit" id="forgetpw_submit">
            <?php
                echo '<input type="hidden" name="userId" value="'.$userId.'">';
            ?>
        </form>
    </div>
</div>
</body>
</html>