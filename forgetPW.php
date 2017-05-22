<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 5. 23.
 * Time: AM 2:54
 */

session_start();
require_once 'class.user.php';
$user = new user();

if($user->is_loggedin()!="") {
    $user->redirection('main.php');
}

if(isset($_POST['submit'])) {
    $userId = strip_tags($_POST['userId']);
    $userName = strip_tags($_POST['userName']);
    $userEmail = strip_tags($_POST['userEmail']);

    $stmt = $user->runQuery("SELECT id FROM user WHERE id=:userId OR name=:userName OR email=:userEmail");
    $stmt->execute(array(':userId'=>$userId, ':userName'=>$userName, ':userEmail'=>$userEmail));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['id'] == '') {
        echo "<script>
        alert('존재하지 않는 아이디입니다. 이름과, 메일주소를 다시 한번 확인해주세요.');
        window.location.href='forget.php';
        </script>";
    } else {
        ?>
        <form name="userform" method="POST" action="changePWform.php">
            <?php
                echo '<input type="hidden" name="userId" value="'.$userId.'">';
            ?>
        </form>
        <script>
            window.onload = function () {
                document.userform.submit();
            }
        </script>
        <?php
    }
} else {
    $user->redirection('logmain.php');
}