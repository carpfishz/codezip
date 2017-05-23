<?php
/**
 * Created by PhpStorm.
 * User: sangminlee
 * Date: 2017. 5. 11.
 * Time: PM 6:41
 */

session_start();
require_once 'class.user.php';
$login = new user();
if($login->is_loggedin()!="") {
    $login->redirection('main.php');
}


if(!isset($_POST['val1'])){
    $codejs = './default.js';
}else{
    $codejs = $_POST['val1'];
    $slt = $_POST['val2'];
}


?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>CodeZip - Online Compiler</title>
</head>
<body>
    <div id="wrapper">
        <div id="form-wrapper">
            <form action="mkdir_test.php" method="POST" id="code_form">
                <textarea id="code_area" class="codemirror-textarea" name="user_code" autocorrect="off" autocomplete="off" autocapitalize="off" spellcheck="false" wrap="off" style="width: 100%; height:600px;">print("hello!")</textarea>
                <select id="select_code" name="select_code" onchange="setValue()">
                    <option id="default" value="python">Python</option>
                    <option value="java">Java</option>
                    <option value="c">C</option>
                    <option value="ruby">Ruby</option>
                </select>
                <input type="submit" value="Run" name="submit" id="code_submit">
            </form>

            <script>
                var e = document.getElementById("select_code");
                var strUser = e.options[e.selectedIndex].value;
                console.log(strUser);

                function setValue() {
                    var e = document.getElementById("select_code");
                    var strUser = e.options[e.selectedIndex].value;
                    if(strUser == 'c') {
                        document.getElementById("code_mode").src = 'mode/clike/clike.js';
//                        document.getElementById("code_js").src = './mode_c.js';
                    } else if (strUser == 'java') {
                        document.getElementById("code_mode").src = 'mode/clike/clike.js';
//                        document.getElementById("code_js").src = './mode_java.js';
                    } else if (strUser == 'python') {
                        document.getElementById("code_mode").src = 'mode/python/python.js';
                        document.getElementById("code_js").src = './default.js';
                    }
                    console.log(strUser);
                }
            </script>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
            <script src="lib/codemirror.js"></script>
            <link rel="stylesheet" href="lib/codemirror.css">
            <script id="code_mode" src="mode/python/python.js"></script>
            <script id="code_js" src="<?=$codejs;?>"></script>
            <script src="custom.js"></script>

            <script src="mode/clike/clike.js"></script>
<!--            <script src="./mode_c.js"></script>-->
<!--            <script src="./mode_java.js"></script>-->
        </div>
    </div>
</body>
</html>


<?php
    if(isset($_POST['val1'])){
    ?>
    <script>
        var slt = '<?=$slt;?>';
        $('#default').text(slt);

    </script>
<?php
}
?>