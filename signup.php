<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 4. 22.
 * Time: PM 5:49
 */

session_start();
require_once 'class.user.php';
$login = new user();
if($login->is_loggedin()!="") {
    $login->redirection('main.php');
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>CodeZip sign up page</title>
    <link rel="stylesheet" href="css/init.css">
    <link rel="stylesheet" href="css/signup.css">
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
        <form action="registry.php" method="POST" id="signup_form">
            <input type="text" name="userId" placeholder="아이디" required autofocus>
            <input type="password" name="userPw" placeholder="비밀번호" required>
            <input type="text" name="userName" placeholder="이름" required>
            <input type="email" name="userEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="이메일 주소" required>
            <input type="submit" value="회원가입" name="submit" id="signup_submit">
        </form>
    </div>
</div>
</body>
</html>