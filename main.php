<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 4. 22.
 * Time: PM 5:34
 */

require_once("session.php");
require_once("class.user.php");
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>CodeZip - Online Compiler</title>
<!--    <link rel="stylesheet" href="css/init.css">-->
<!--    <link rel="stylesheet" href="css/nanumbarungothic.css">-->
<!--    <link rel="stylesheet" href="css/main.css">-->
<!--    <link rel="stylesheet" href="css/bootstrap.min.css">-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <style>
        #main_header > #logo > h1 {
            margin-top: 0 !important;
        }
    </style>
</head>
<body>
<header id="main_header">
    <div id="logo">
        <h1>CodeZip</h1>
    </div>
    <div id="logout">
        <a href="logout.php">로그아웃</a>
    </div>
</header>
<div id="content">
    <aside id="main_aside">
        <div id="profile">
            <h1><?php print($userRow['name']); ?>님 <br />환영합니다.</h1>
        </div>
        <div id="todayDo" class="toDO">
            <h3>
                Today
            </h3>
        </div>
        <div id="weekenDo" class="toDO">
            <h3>
                Week
            </h3>
        </div>
    </aside>
    <section id="main_section">
        <div id="wrapper">
            <div id="form-wrapper">
                <form action="mkdir_test.php" method="POST" id="code_form">
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
        notice
    </div>
</footer>
</body>
</html>