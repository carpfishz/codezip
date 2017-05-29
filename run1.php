<?php

session_start();
require_once 'class.user.php';
$user = new user();
$user_id = $_SESSION['user_session'];

$stmt = $user->runQuery("SELECT * FROM user WHERE id=:userId");
$stmt->execute(array(":userId"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
}

$rand_str = random_str(8);

if(isset($_POST['submit'])) {
    $myfile = fopen("dockertest/". $rand_str . ".py", "w");
    $title = $_POST['user_code_title'];
    $txt = $_POST['user_code'];
    $lang = 'python';
    $openpub = $_POST['disclosure'];

    fwrite($myfile, $txt);
    fclose($myfile);

    $stmt = $user->runQuery("INSERT INTO code(title, content, lang, openpub, id) VALUES(:title, :txt, :lang, :openpub, :userId)");
    $stmt->bindparam(":title", $title);
    $stmt->bindparam(":txt", $txt);
    $stmt->bindparam(":lang", $lang);
    $stmt->bindparam(":openpub", $openpub);
    $stmt->bindparam(":userId", $userRow['id']);
    $stmt->execute();
//    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //$command = "sudo /usr/bin/docker run --rm -m=30m --stop-signal=SIGTERM --stop-timeout=10 -v /var/www/html/dockertest/" . $rand_str . ".py" . ":/" . $rand_str . ".py" . " festival/demo1 python " . $rand_str . ".py" . " > " . $rand_str . ".txt 2>&1";

    $command = "sudo /usr/bin/docker run --rm -m=30m --stop-signal=SIGTERM --stop-timeout=10 -v /var/www/html/dockertest/" . $rand_str . ".py" . ":/" . $rand_str . ".py" . " festival/demo1 python " . $rand_str . ".py" . " 2>&1";
    $output = shell_exec($command);
    $output = str_replace("\n", "<br>", $output);
    echo "<div style='word-break:break-all; word-wrap:break-word;width=100%'>".$output."</div>";

    unlink("dockertest/" . $rand_str . ".py");
} else {
    // echo "fail";
    header("Location: http://223.194.105.180/main.php");
}