<?php
/**
 * @var $connStatus
 */
include("config/db.config.php");
session_start();
if (!isset($_SESSION['is_login'])){
    header('Location:index.php');
}
?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #page {width: 80%;margin: 0 auto;background-color: antiquewhite;}
        #conn {width: 80%;margin: 0 auto;}
        #title {text-align: center;}
        #hr {border-style: solid;}
        #contents {width: 80%; margin: 0 auto;}
        #form {width: 56.5%;}
        #text1 {width: 250px; float: right;}
        #text2 {width: 250px; float: right;}
        #text3 {width: 500px; height: 250px; float: right;}
        .btn {font-weight: bolder; background-color: darkslategrey; border: black solid; color: white; height: 30px; width: 50px; float: right;}
        .btn:hover {background-color: black;}
        #textareaHeight {height: 250px;}
    </style>
</head>
<body>
<div id="conn">
    <?php
    echo $connStatus;     //DB 연결 상태 표시
    ?>
</div>
<div id="page">
    <div id="title"><h1>글 쓰기</h1></div>
    <hr id="hr">
    <div id="contents">
        <form id="form" method="post" action="config/insert.php" enctype="multipart/form-data">
            <p>작성자 : <input id="text1" type="text" name="writer"></p>
            제목 : <input id="text2" type="text" name="title" placeholder="최대 50자">
            <p id="textareaHeight">글 : <textarea id="text3" name="contents" placeholder="최대 500자"></textarea></p>
            <input type="file" name="uploadFile"><br>
            <input type="submit" class="btn" value="작성">
        </form>
        <button class="btn" onclick="location.href='main.php'">목록</button>

    </div>
</div>
</body>
</html>