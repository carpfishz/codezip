<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 5. 29.
 * Time: PM 10:27
 */

require_once("session.php");
require_once("class.user.php");

$auth_user = new user();
$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM user WHERE id=:userId");
$stmt->execute(array(":userId"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>CodeZip - Online Compiler</title>
    <link rel="stylesheet" href="css/init.css">
    <link rel="stylesheet" href="css/nanumbarungothic.css">
    <link rel="stylesheet" href="css/main.css">
    <!--    <link rel="stylesheet" href="css/bootstrap.min.css">-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="main.js"></script>

    <style>
        #main_header > #logo > h1 {
            margin-top: 0 !important;
        }
    </style>
</head>
<body>
<header id="main_header">
    <div id="logo">
        <a href="main.php"><h1>CodeZip</h1></a>
    </div>
    <div id="logout">
        <a href="#" id="cs-button">코드 검색</a>
        <a href="mypage.php">마이페이지</a>
        <a href="#" id="ct-button">비밀번호 변경</a>
        <a href="logout.php">로그아웃</a>
    </div>
</header>

<!--change pw-->
<div id="myModal1" class="modal">
    <form class="modal-content" action="changePW1.php" id="ct-form" method="POST">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Modal Header</h2>
        </div>
        <div class="modal-body">
            <input type="password" name="userPw" placeholder="비밀번호" required autofocus>
            <input type="password" name="userPwcheck" placeholder="비밀번호 확인" required>
            <input type="submit" value="비밀번호변경" name="submit" id="forgetpw_submit">
        </div>
    </form>
</div>

<!--search code-->
<div id="myModal2" class="modal">
    <form class="modal-content" action="codesearch.php" id="cs-form" method="POST">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Modal Header</h2>
        </div>
        <div class="modal-body">
            <input type="text" name="user_code_title" placeholder="코드 제목" required>
            <input type="text" name="userId" placeholder="사용자 아이디">
            <input type="submit" value="Run" name="submit" id="code_submit">
        </div>
    </form>
</div>

<div id="content">
    <aside id="main_aside">
        <div id="profile">
            <h1><?php print($userRow['name']); ?>님 환영합니다.</h1>
        </div>
    </aside>
    <section id="main_section">
        <div id="wrapper">
            <div id="form-wrapper">
                <form action="run1.php" method="POST" id="code_form">
                    <input type="text" name="user_code_title" placeholder="코드 제목" required>
<!--                    즐겨찾기 체크박스로-->
                    <button type="button">수정하기</button>
                    <button type="button">삭제하기</button>
                    <input type="radio" name="disclosure" value="1" checked>공개
                    <input type="radio" name="disclosure" value="0">비공개
                    <textarea class="codemirror-textarea" name="user_code" autocorrect="off" autocomplete="off" autocapitalize="off" spellcheck="false" wrap="off" style="width: 100%; height:600px;">print("hello!")</textarea>
                    <input type="submit" value="Run" name="submit" id="code_submit">
                </form>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
                <script src="lib/codemirror.js"></script>
                <link rel="stylesheet" href="lib/codemirror.css">
                <script src="mode/python/python.js"></script>
                <script src="./default.js"></script>
            </div>
        </div>
    </section>
</div>
<footer id="main_footer">
    <div id="notice">
        hi~~~
    </div>
</footer>
</body>
</html>