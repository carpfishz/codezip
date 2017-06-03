<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 4. 22.
 * Time: PM 5:34
 */

require_once("session.php");
require_once("class.user.php");

$getidx = $_GET['idx'];
$auth_user = new user();
$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM user WHERE id=:userId");
$stmt->execute(array(":userId"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $auth_user->runQuery("SELECT codeidx FROM favorite WHERE id=:userId AND fav='1'");
$stmt->execute(array(":userId"=>$user_id));
$stmt_temp = [];
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
        <a href="logout.php">로그아웃</a>
        <a href="#" id="ct-button" style="display: none;">비밀번호 변경</a>
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
            <input type="text" name="user_code_title1" placeholder="코드 제목" required>
            <input type="text" name="userId" placeholder="사용자 아이디">
            <input type="submit" value="Run" name="submit" id="code_submit1">
        </div>
    </form>
</div>

<div id="content">
    <aside id="main_aside">
        <div id="profile">
            <h1><?php print($userRow['name']); ?>님 환영합니다.</h1>
            <?php
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $idx = $row['codeidx'];
                $stmt1 = $auth_user->runQuery("SELECT * FROM code WHERE idx=:codeidx");
                $stmt1->execute(array(":codeidx"=>$idx));
                $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                $stmt_temp[$row1['idx']] = $row1;
                echo "<div onclick='location.href=".'"./main.php?idx=' .$row1['idx']. '"'."'>"  .$row1['title'] . "[" . $row1['lang'] . "]" ."</div>";
            }
            ?>
        </div>
    </aside>
    <section id="main_section">
        <div id="wrapper">
            <div id="form-wrapper">
                <form action="run.php" method="POST" id="code_form" novalidate>
                    <?php
                    $placeholder = "코드 제목";
                    $name = '';
                    if(isset($getidx)){
                        $placeholder = "";
                        $name = $stmt_temp[$getidx]['title'];
                    }
                    ?>
                    <input type="text" name="user_code_title" placeholder="<?php echo $placeholder?>" value="<?php echo $name?>" required>
                    <input type="radio" name="disclosure" value="1" checked>공개
                    <input type="radio" name="disclosure" value="0">비공개
                    <input type="radio" name="fav" value="1">즐겨찾기 설정
                    <input type="radio" name="fav" value="0" checked>즐겨찾기 미설정
                    <button type="button" id='store' onclick="storecode();">저장하기</button>
                    <button type="button" id='store' onclick="favset();">즐겨찾기 설정</button>
                    <button type="button" id='store' onclick="favclear();">즐겨찾기 해제</button>
                    <textarea class="codemirror-textarea" name="user_code" autocorrect="off" autocomplete="off" autocapitalize="off" spellcheck="false" wrap="off" style="width: 100%; height:600px;"><?php
                        if(isset($getidx)){print_r($stmt_temp[$getidx]['content']);
                        }else{
                            ?>print("hello!")<?php }
                        ?></textarea>
                    <input type="text" style="display: none" name="idx" value="<?php echo $getidx?>">
                    <input type="submit" value="Run" name="submit" id="code_submit">
                </form>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
                <script src="lib/codemirror.js"></script>
                <link rel="stylesheet" href="lib/codemirror.css">
                <script src="mode/python/python.js"></script>
                <script src="./default.js"></script>
                <script>
                    function storecode(){
                        $('#code_form').attr("action","code_store.php");
                        $('#code_form').submit();
                        $("#code_submit").click();
                    }

                    function favset(){
                        $('#code_form').attr("action","code_favset.php");
                        $('#code_form').submit();
                        $("#code_submit").click();
                    }

                    function favclear(){
                        $('#code_form').attr("action","code_favclear.php");
                        $('#code_form').submit();
                        $("#code_submit").click();
                    }
                </script>
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