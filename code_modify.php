<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 5. 30.
 * Time: PM 7:04
 */
//print_r($_POST) ;

session_start();
require_once 'class.user.php';
$user = new user();
$user_id = $_SESSION['user_session'];

if(isset($_POST['submit'])) {
    $idx = $_POST['idx'];
    $title = $_POST['user_code_title'];
    $txt = $_POST['user_code'];
    $lang = 'python';
    $openpub = $_POST['disclosure'];

    echo "<br />" . $idx . $title . $txt . $lang . $openpub;

    $stmt = $user->runQuery("UPDATE code SET title=:title, content=:txt, lang=:lang, openpub=:openpub WHERE idx=:idx");
//    update code set title='qweasd', content='print("sdfsdf")', lang='python', openpub='1' WHERE idx=13;
    $stmt->bindparam(":title", $title);
    $stmt->bindparam(":txt", $txt);
    $stmt->bindparam(":lang", $lang);
    $stmt->bindparam(":openpub", $openpub);
    $stmt->bindparam(":idx", $idx);
    $stmt->execute();
    header("Location: http://223.194.105.180/mypage.php");
} else {
    // echo "fail";
    header("Location: http://223.194.105.180/mypage.php");
}