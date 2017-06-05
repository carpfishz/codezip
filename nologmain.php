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

$lang = $_GET['lang'];
$stmt_temp = [];

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
            <form action="run.php" method="POST" id="code_form">
                <textarea id="code_area" class="codemirror-textarea" name="user_code" autocorrect="off" autocomplete="off" autocapitalize="off" spellcheck="false" wrap="off" style="width: 100%; height:600px;">print("hello!")</textarea>
                <input type="radio" name="lang" value="C" onclick="location.href='nologmain.php?lang=C'" id="langC">C
                <input type="radio" name="lang" value="C++" onclick="location.href='nologmain.php?lang=C%2B%2B'" id="langCplus">C++
                <input type="radio" name="lang" value="Java" onclick="location.href='nologmain.php?lang=Java'" id="langJava">Java
                <input type="radio" name="lang" value="Python" onclick="location.href='nologmain.php?lang=Python'" id="langPython">Python
                <input type="radio" name="lang" value="Python3" onclick="location.href='nologmain.php?lang=Python3'" id="langPython3" checked="checked">Python3
                <input type="radio" name="lang" value="Ruby" onclick="location.href='nologmain.php?lang=Ruby'" id="langRuby">Ruby
                <input type="submit" value="Run" name="submit" id="code_submit">
            </form>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
            <script src="lib/codemirror.js"></script>
            <link rel="stylesheet" href="lib/codemirror.css">
            <script id="code_mode" src="mode/python/python.js"></script>
            <script id="code_js" src="default.js"></script>
            <script src="custom.js"></script>
            <script src="mode/clike/clike.js"></script>
<!--            <script src="./mode_c.js"></script>-->
<!--            <script src="./mode_java.js"></script>-->
            <script> <?php if($lang == 'C') {echo "$('#langC').attr('checked', 'checked');";}?>
                <?php if($lang == 'C++') {echo "$('#langCplus').attr('checked', 'checked');";}?>
                <?php if($lang == 'Java') {echo "$('#langJava').attr('checked', 'checked');";}?>
                <?php if($lang == 'Python') {echo "$('#langPython').attr('checked', 'checked');";}?>
                <?php if($lang == 'Python3') {echo "$('#langPython3').attr('checked', 'checked');";}?>
                <?php if($lang == 'Ruby') {echo "$('#langRuby').attr('checked', 'checked');";}?>
            </script>
        </div>
    </div>
</body>
</html>