<?php
/**
 * @var $connStatus
 */
    ini_set("display_errors", 0);
    include("config/db.config.php");
?>
<!doctype html>
<html lang="ko">
<?php
    session_start();
    if (isset($_SESSION['is_login'])){
        header('Location:main.php');
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BoardLogin</title>
    <style>
        #mainTitle {text-align: center; font-size: xx-large; font-family : 'Lobster'; color: brown;}
        #page {width: 360px; height: 180px; background-color: antiquewhite; margin: 0 auto; position: absolute; top: 30%; left: 38%; border: brown dotted;}
        #title {text-align: center; font-size: larger; padding-top: 20px;}
        #inputID {display: inline; padding-left: 20%;}
        #inputPW {display: inline; padding-left: 17.7%;}
        .text {height: 15px;}
        #btnBox {text-align: center; padding-top: 30px;}
        .btn {font-weight: bolder; background-color: darkslategrey; border-style: none; color: white; height: 30px; width: 65px;}
        .btn:hover {background-color: black;}
        #copy {text-align: right; padding-top: 20%; padding-right: 20%;}
    </style>
    <link href="//fonts.googleapis.com/css?family=Lobster&subset=latin,latin-ext" rel="stylesheet" type="text/css">
</head>
<body>
    <br>
    <div id="mainTitle"><h1><em>PHP Board By risker</em></h1></div>
    <form id="page" method="post">
        <div id="title"><strong>LOGIN</strong></div>
        <p id="inputID">
            ID : <input class="text" type="text" name="id"><br>
        </p>
        <p id="inputPW">
            PW : <input class="text" type="password" name="pw"><br>
        </p>
        <div id="btnBox">
            <input class="btn" type="submit" value="Sign In" onclick="form.action='config/signIn.php';"/>
            <input class="btn" type="submit" value="Sign Up" onclick="form.action='signUpFront.php';"/>
        </div>
    </form>
    <div id="copy"><strong>&copy; 2021 RISKER Co. All rights reserved.</strong></div>
</body>
