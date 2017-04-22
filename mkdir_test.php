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
//echo $rand_str;

if(isset($_POST['submit'])) {
    //mkdir("test/" . $rand_str, 0755, true);
    $myfile = fopen("dockertest/". $rand_str . ".py", "w");
    //$txt = "print('hahahahahaha')";
    $txt = $_POST['user_code'];
    fwrite($myfile, $txt);
    fclose($myfile);

    $command = "sudo /usr/bin/docker run --rm -v /var/www/html/dockertest/" . $rand_str . ".py" . ":/" . $rand_str . ".py" . " festival/demo1 python " . $rand_str . ".py" . " 2>&1";
    //$command = "sudo /usr/bin/docker run --rm -v /var/www/html/dockertest/" . $rand_str . ".py" . ":/" . $rand_str . ".py" . " python:3.6.0-slim python " . $rand_str . ".py" . " 2>&1";
    //$command = "sudo /usr/bin/docker run --rm -v /var/www/html/dockertest/" . $rand_str . ".py" . ":/" . $rand_str . ".py" . " festival/demo python " . $rand_str . ".py" . " 2>&1";
    //$output = shell_exec('RET=' . $command . ';echo $RET');
    $output = shell_exec($command);
    echo $output;

    unlink("dockertest/" . $rand_str . ".py");
} else {
    echo "fail";
}
