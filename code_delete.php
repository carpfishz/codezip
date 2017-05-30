<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 5. 30.
 * Time: PM 8:38
 */


session_start();
require_once 'class.user.php';
$user = new user();
$user_id = $_SESSION['user_session'];

if(isset($_POST['submit'])) {
    $idx = $_POST['idx'];
    $stmt = $user->runQuery("DELETE FROM code WHERE idx=:idx");
//    update code set title='qweasd', content='print("sdfsdf")', lang='python', openpub='1' WHERE idx=13;
    $stmt->bindparam(":idx", $idx);
    $stmt->execute();
    header("Location: http://223.194.105.180/mypage.php");
} else {
    // echo "fail";
    header("Location: http://223.194.105.180/mypage.php");
}