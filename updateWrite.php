<?php
/**
 * @var $connStatus
 * @var $row
 */
ini_set("display_errors", 0);
include("config/clickedSelect.php");
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
        #contentsInfo {text-align: right;}
        #contents {font-weight: bold; padding-left: 10px;}
        #file {padding-left: 60px;}
        #textarea {width: 98%; height: 200px; background-color: white; margin: 0 auto;}
        .btnS {font-weight: bolder; background-color: darkslategrey; border-style: none; color: white; height: 30px; width: 50px; float: right;}
        .btnS:hover {background-color: black;}
    </style>
</head>
<body>
<div id="conn">
    <?php
    echo $connStatus;   //DB 연결 상태 표시
    ?>
</div>
<div id="page">
    <form method="post" action="config/update.php?option=<?php echo $_GET['option']?>&searchText=<?php echo $_GET['searchText']?>">
        <div id="title">
            <h1>Title : <input type="text" name="changedTitle" value="<?php echo $row['title']; ?>"></h1>
        </div>
        <hr id="hr">
        <div id="contentsInfo">
            <em>Num</em> : <strong><?php echo $row['num']; ?></strong>
            <em>Writer</em> : <input type="text" name="changedWriter" value="<?php echo $row['writer']; ?>">
            <em>Date</em> : <strong><?php echo $row['date']; ?></strong>
            <em>View</em> : <strong><?php echo $row['view']; ?></strong><br><br>
            <input type="hidden" name="num" value="<?php echo $row['num'] ?>">
        </div>
        <div id="mainContents">
                <span id="contents">
                    <textarea id="textarea" name="changedContents"><?php echo $row['contents']; ?></textarea>
                </span>
            <input id="file" type="file" name="changedUploadFile"><br>
        </div>
        <input class="btnS" type="submit" value="확인">
    </form>
    <button class="btnS" onclick="location.href='view.php?whereValue=<?php echo $row['num'];?>&option=<?php echo $_GET['option']?>&searchText=<?php echo $_GET['searchText']?>'">취소</button>
</div>
</body>
</html>