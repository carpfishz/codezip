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
    $lang = $_POST['lang'];
    $txt = $_POST['user_code'];

    if($lang == 'C') {
        $myfile = fopen("dockertest/". $rand_str . ".c", "w");
        fwrite($myfile, $txt);
        fclose($myfile);
        $command = "sudo /usr/bin/docker run --rm -m=30m --stop-signal=SIGTERM --stop-timeout=10 -v /var/www/html/dockertest/" . $rand_str . ".c" . ":/" . $rand_str . ".c" . " gcc:7.1 /bin/bash -c 'gcc " . $rand_str . ".c -o " . $rand_str . " ; ./". $rand_str . " 2>&1'";
        $output = shell_exec($command);
        $output = str_replace("\n", "<br>", $output);
        echo "<div style='word-break:break-all; word-wrap:break-word;width=100%'>".$output."</div>";
        unlink("dockertest/" . $rand_str . ".c");

    } elseif ($lang == 'C++') {
        $myfile = fopen("dockertest/". $rand_str . ".cpp", "w");
        fwrite($myfile, $txt);
        fclose($myfile);
//        $command = "sudo /usr/bin/docker run --rm -m=30m --stop-signal=SIGTERM --stop-timeout=10 -v /var/www/html/dockertest/" . $rand_str . ".c" . ":/" . $rand_str . ".c" . " gcc:7.1 /bin/bash -c 'gcc " . $rand_str . ".c -o " . $rand_str . " ; ./". $rand_str . " 2>&1'";
//        echo $command;
        $command = "g++ dockertest/" . $rand_str . ".cpp -o dockertest/" . $rand_str . "; ./dockertest/" . $rand_str . " 2>&1";
        $output = shell_exec($command);
        $output = str_replace("\n", "<br>", $output);
        echo "<div style='word-break:break-all; word-wrap:break-word;width=100%'>".$output."</div>";
        unlink("dockertest/" . $rand_str . ".cpp");
        unlink("dockertest/" . $rand_str);

    } elseif ($lang == 'Java') {
        $myfile = fopen("dockertest/". $rand_str . ".java", "w");
        fwrite($myfile, $txt);
        fclose($myfile);
        $command = "sudo /usr/bin/docker run --rm -m=30m --stop-signal=SIGTERM --stop-timeout=10 -v /var/www/html/dockertest/" . $rand_str . ".java" . ":/" . $rand_str . ".java" . " java:openjdk-8-jdk /bin/bash -c 'javac " . $rand_str . ".java ; java codezip" . " 2>&1'";
        $output = shell_exec($command);
        $output = str_replace("\n", "<br>", $output);
        echo "<div style='word-break:break-all; word-wrap:break-word;width=100%'>".$output."</div>";
        unlink("dockertest/" . $rand_str . ".java");

    } elseif ($lang == 'Python') {
        $myfile = fopen("dockertest/". $rand_str . ".py", "w");
        fwrite($myfile, $txt);
        fclose($myfile);
        $command = "sudo /usr/bin/docker run --rm -m=30m --stop-signal=SIGTERM --stop-timeout=10 -v /var/www/html/dockertest/" . $rand_str . ".py" . ":/" . $rand_str . ".py" . " python:2.7.13-slim python " . $rand_str . ".py" . " 2>&1";
        $output = shell_exec($command);
        $output = str_replace("\n", "<br>", $output);
        echo "<div style='word-break:break-all; word-wrap:break-word;width=100%'>".$output."</div>";
        unlink("dockertest/" . $rand_str . ".py");

    } elseif ($lang == 'Python3') {
        $myfile = fopen("dockertest/". $rand_str . ".py", "w");
        fwrite($myfile, $txt);
        fclose($myfile);

        //$command = "sudo /usr/bin/docker run --rm -m=30m --stop-signal=SIGTERM --stop-timeout=10 -v /var/www/html/dockertest/" . $rand_str . ".py" . ":/" . $rand_str . ".py" . " festival/demo1 python " . $rand_str . ".py" . " > " . $rand_str . ".txt 2>&1";

        $command = "sudo /usr/bin/docker run --rm -m=30m --stop-signal=SIGTERM --stop-timeout=10 -v /var/www/html/dockertest/" . $rand_str . ".py" . ":/" . $rand_str . ".py" . " festival/demo1 python " . $rand_str . ".py" . " 2>&1";
        $output = shell_exec($command);
        $output = str_replace("\n", "<br>", $output);
        echo "<div style='word-break:break-all; word-wrap:break-word;width=100%'>".$output."</div>";
        unlink("dockertest/" . $rand_str . ".py");

    } elseif ($lang == 'Ruby') {
        $myfile = fopen("dockertest/". $rand_str . ".rb", "w");
        fwrite($myfile, $txt);
        fclose($myfile);
        $command = "sudo /usr/bin/docker run --rm -m=30m --stop-signal=SIGTERM --stop-timeout=10 -v /var/www/html/dockertest/" . $rand_str . ".rb" . ":/" . $rand_str . ".rb" . " ruby:2.1.10-slim ruby " . $rand_str . ".rb" . " 2>&1";
        $output = shell_exec($command);
        $output = str_replace("\n", "<br>", $output);
        echo "<div style='word-break:break-all; word-wrap:break-word;width=100%'>".$output."</div>";
        unlink("dockertest/" . $rand_str . ".rb");

    } else {
        header("http://223.194.105.180/nologmain.php");
    }

} else {
    // echo "fail";
    header("http://223.194.105.180/nologmain.php");
}