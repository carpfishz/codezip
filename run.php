<?php
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
    $txt = $_POST['user_code'];
    fwrite($myfile, $txt);
    fclose($myfile);

    //$command = "sudo /usr/bin/docker run --rm -m=30m --stop-signal=SIGTERM --stop-timeout=10 -v /var/www/html/dockertest/" . $rand_str . ".py" . ":/" . $rand_str . ".py" . " festival/demo1 python " . $rand_str . ".py" . " > " . $rand_str . ".txt 2>&1";

    $command = "sudo /usr/bin/docker run --rm -m=30m --stop-signal=SIGTERM --stop-timeout=10 -v /var/www/html/dockertest/" . $rand_str . ".py" . ":/" . $rand_str . ".py" . " festival/demo1 python " . $rand_str . ".py" . " 2>&1";
    $output = shell_exec($command);
    $output = str_replace("\n", "<br>", $output);
    echo "<div style='word-break:break-all; word-wrap:break-word;width=100%'>".$output."</div>";

    unlink("dockertest/" . $rand_str . ".py");
} else {
    // echo "fail";
    header("http://223.194.105.180/nologmain.php");
}