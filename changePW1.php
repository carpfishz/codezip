<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 5. 23.
 * Time: AM 3:13
 */

session_start();
require_once 'class.user.php';
$user = new user();
$user_id = $_SESSION['user_session'];

$stmt = $user->runQuery("SELECT * FROM user WHERE id=:userId");
$stmt->execute(array(":userId"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])) {
    $userId = $userRow['id'];
    $userPw = strip_tags($_POST['userPw']);
    $userPwcheck = strip_tags($_POST['userPwcheck']);

    if($userPw == $userPwcheck) {
        $hashPassword = password_hash($userPw, PASSWORD_DEFAULT);
        $stmt = $user->runQuery("UPDATE user SET pw=:userPw WHERE id=:userId");
        $stmt->execute(array(':userPw'=>$hashPassword, ':userId'=>$userId));
        $user->redirection('mypage.php');
    } else {
        echo "<script>
        alert('비밀번호가 일치하지 않습니다.');
        </script>
        <form name='userform' method='post' action='changePWform.php'>
            <input type='hidden' name='userId' value='" . $userId . "'>;
        </form>
        <script>
            window.onload = function () {
                document.userform.submit();
            }
        </script>";
    }
} else {
    $user->redirection('mypage.php');
}