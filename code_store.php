<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 5. 30.
 * Time: PM 9:08
 */

session_start();
require_once 'class.user.php';
$user = new user();
$user_id = $_SESSION['user_session'];

if(isset($_POST['submit'])) {
    $title = $_POST['user_code_title'];
    $txt = $_POST['user_code'];
    $lang = 'python';
    $openpub = $_POST['disclosure'];
    $fav = $_POST['fav'];

//    코드 저장
    $stmt = $user->runQuery("INSERT INTO code(title, content, lang, openpub, id) VALUES(:title, :txt, :lang, :openpub, :userId)");
    $stmt->bindparam(":title", $title);
    $stmt->bindparam(":txt", $txt);
    $stmt->bindparam(":lang", $lang);
    $stmt->bindparam(":openpub", $openpub);
    $stmt->bindparam(":userId", $user_id);
    $stmt->execute();

//    코드 검색
    $stmt = $user->runQuery("SELECT idx FROM code WHERE title=:title AND content=:txt AND lang=:lang AND openpub=:openpub AND id=:userId");
    $stmt->bindparam(":title", $title);
    $stmt->bindparam(":txt", $txt);
    $stmt->bindparam(":lang", $lang);
    $stmt->bindparam(":openpub", $openpub);
    $stmt->bindparam(":userId", $user_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $idx = $row['idx'];

//    즐겨찾기 여부 확인
    $stmt = $user->runQuery("SELECT * FROM favorite WHERE codeidx=:idx AND id=:userId");
    $stmt->bindparam(":idx", $idx);
    $stmt->bindparam(":userId", $user_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($stmt->rowCount() == 0) {
        $stmt = $user->runQuery("INSERT INTO favorite(id, codeidx, fav) VALUES(:userId, :idx, :favorite)");
        $stmt->bindparam(":userId", $user_id);
        $stmt->bindparam(":idx", $idx);
        $stmt->bindparam(":favorite", $fav);
        $stmt->execute();
    } else {
        $stmt = $user->runQuery("UPDATE favorite SET fav=:favorite WHERE codeidx=:idx AND id=:userId");
        $stmt->bindparam(":userId", $user_id);
        $stmt->bindparam(":idx", $idx);
        $stmt->bindparam(":favorite", $fav);
        $stmt->execute();
    }

    header("Location: http://223.194.105.180/main.php");
} else {
    // echo "fail";
    header("Location: http://223.194.105.180/main.php");
}