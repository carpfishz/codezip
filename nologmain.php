<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 5. 11.
 * Time: PM 6:41
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
    <title>CodeZip - Online Compiler</title>
</head>
<body>
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
</body>
</html>