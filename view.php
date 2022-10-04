<?php
/**
 * @var $connStatus
 * @var $row
 * @var $text
 * @var $option
 * @var $num
 * @var $result
 * @var $mysqli
 */
ini_set("display_errors", 0);
include("config/clickedSelect.php");
include("config/replySelect.php");
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
        #mainContents {border: 1px black solid; width: 90%; height: 200px; background-color: white; margin: 0 auto;}
        #contents {font-weight: bold; padding-left: 10px;}
        #file {padding-left: 60px;}
        #btnControl {text-align: right; padding-right: 30px;}
        .btnS {font-weight: bolder; background-color: darkslategrey; border-style: none; color: white; height: 30px; width: 50px;}
        .btnS:hover {background-color: black;}
        #answerSector {padding-left: 60px;}
        #answerText {width: 50%; height: 100px;}
        .pwText {width: 100px;}
        #answerPrint {border-bottom: white solid 10px; width: 100%;}
        #changedContent {width: 60%; height: 50px; display: inline;}
        #answerTitle {width: 100%; text-align: center; font-weight: bolder; border-top: white solid 10px;}
        .replyForm {text-align: right; padding-right: 25%;}
        .replyBtn {font-weight: bolder; background-color: tomato; border-style: none; color: white; height: 25px; width: 45px;}
        .replyBtn:hover {background-color: black;}
        #updatePw {width: 100px;}
    </style>
    <script>
        function deleteCheck(){
            if (confirm("해당 게시물을 삭제합니다.") === true){
                return <?php echo "location.href='config/delete.php?whereValue=" . $row['num']."&file=".$row['file']; ?>';
            }else{
                return false;
            }
        }
    </script>
</head>
<body>
<div id="conn">
    <?php
    echo $connStatus;   //DB 연결 상태 표시
    ?>
</div>
<div id="page">                                                         <!-- 클릭된 행만 조회 -->
    <div id="title">
        <h1>Title : <?php echo $row['title'] ?></h1>
    </div>
    <hr id="hr">
    <div id="contentsInfo">
        <em>Num</em> : <strong><?php echo $row['num']; ?></strong>
        <em>Writer</em> : <strong><?php echo $row['writer']; ?></strong>
        <em>Date</em> : <strong><?php echo $row['date']; ?></strong>
        <em>View</em> : <strong><?php echo $row['view']; ?></strong><br><br>
    </div>
    <div id="mainContents">
        <p id="contents"><?php echo $row['contents']; ?></p>
    </div>
    <div id="file">
        <br>첨부파일 : <a href="config/download.php?file=<?php echo $row['file']?>&whereValue=<?php echo $row['num']?>&option=<?php echo $_GET['option']?>&searchText=<?php echo $text?>"><?php echo $row['file'];?></a>
    </div>
    <div id="btnControl">
        <button class="btnS" id="btnAnswer" onclick="location.href='answerWriteFront.php?whereValue=<?php echo $row['num'];?>&option=<?php echo $_GET['option']?>&searchText=<?php echo $text?>'">답글</button>
        <button class="btnS" id="btnUpdate" onclick="location.href='updateWrite.php?whereValue=<?php echo $row['num'];?>&option=<?php echo $_GET['option']?>&searchText=<?php echo $text?>'">수정</button>
        <button class="btnS" id="btnDelete" onclick="deleteCheck()">삭제</button>
        <button class="btnS" id="btnList" onclick="location.href='main.php?&option=<?php echo $_GET['option']?>&searchText=<?php echo $text?>'">목록</button>
    </div>
    <div id="answerSector">
        <form action="config/reply.php?whereValue=<?php echo $num; ?>&option=<?php echo $_GET['option'] ?>&searchText=<?php echo $text ?>" method="post">
            작성자 : <input type="text" name="answerWriter"><br>
            <p>댓글 :<textarea id="answerText" name="answerText"></textarea></p>
            <br>
            비밀번호 : <input class="pwText" type="password" name="pw" placeholder="only number">
            비밀번호 확인 : <input class="pwText" type="password" name="pwCheck" placeholder="only number">
            <input class="btnS" type="submit" value="확인">
        </form>
    </div>
    <h2 id="answerTitle">댓글</h2>
    <div id="answerSelect">
        <?php
        if(!$result){
            echo "queryError : . $mysqli->error";
        }else{
            while($row_reply = $result->fetch_array()){?>
                <div id="answerPrint">
                    <form class="replyForm" method="post">
                        <input type="hidden" name="num" value="<?php echo $row_reply['num']; ?>">
                        작성자 : <?php echo $row_reply['reply_writer']?><br>
                        댓글 : <textarea id="changedContent" name="changedContent"><?php echo $row_reply['reply_content']; ?></textarea><br>
                        비밀번호 : <input id="updatePw" type="password" name="updatePw">
                        <input type="submit" value="수정" class="replyBtn" onclick="form.action='config/replyUpdate.php?whereValue=<?php echo $num; ?>&option=<?php echo $_GET['option'] ?>&searchText=<?php echo $text ?>';">
                        <input type="submit" value="삭제" class="replyBtn" onclick="form.action='config/replyDelete.php?whereValue=<?php echo $num; ?>&option=<?php echo $_GET['option'] ?>&searchText=<?php echo $text ?>';">
                    </form>
                </div>
                <br>
                <?php
            }
        }
        ?>
    </div>
</div>
</body>
</html>