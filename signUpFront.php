<?php
/**
 * @var $connStatus
 */
    ini_set("display_errors", 0);
    include("config/db.config.php");
    if(!preg_match("/".$_SERVER['HTTP_HOST']."/i",$_SERVER['HTTP_REFERER'])){
        exit('Access Deny!!');
    }
?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BoardSignUp</title>
    <style>
        #page {width: 360px; height: 180px; background-color: antiquewhite; margin: 0 auto; position: absolute; top: 30%; left: 38%;}
        #title {text-align: center; font-size: larger; padding-top: 20px;}
        #inputID {display: inline; padding-left: 20%;}
        #inputPW {display: inline; padding-left: 17.7%;}
        #inputPW_Confirm {display: inline;}
        .text {height: 15px;}
        #btnBox {text-align: center; padding-top: 30px;}
        .btn {font-weight: bolder; background-color: darkslategrey; border-style: none; color: white; height: 30px; width: 65px;}
        .btn:hover {background-color: black;}
    </style>
</head>
<body>
<div id="conn">
    <?php echo $connStatus; ?>      <!-- DB 연결 상태 표시 -->
</div>
<form id="page" method="post">
    <div id="title"><strong>SignUp</strong></div>
    <p id="inputID">
        ID : <input class="text" type="text" name="id"><br>
    </p>
    <p id="inputPW">
        PW : <input class="text" type="password" name="pw"><br>
    </p>
    <p id="inputPW_Confirm">
        PW_Confirm : <input class="text" type="password" name="pwConfirm"><br>
    </p>
    <div id="btnBox">
        <input class="btn" type="submit" value="Done" onclick="form.action='config/signUpBack.php';"/>
        <input class="btn" type="submit" value="Cancel" onclick="form.action='index.php';"/>
    </div>
</form>
</body>
