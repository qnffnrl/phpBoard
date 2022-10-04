<?php
/**
 * @var $mysqli
 */
ini_set("display_errors", 0);
include("db.config.php");

/* 변수 초기화 : start */
$writer= $_POST['writer']; //작성자
$query = ""; //쿼리문
/* 변수 초기화 : end */


/* 게시물 입력 정보 POST : start */
if($writer != null){
    $writer= $_POST['writer'];
}else{
    $writer = "Anonymous";
}
$title = $_POST['title'];
$contents = $_POST['contents'];
$date = date('Y:m:d');
$view = 0;
$uploadFile = $_POST['uploadFile'];
/* 게시물 입력 정보 POST : end */

if($title != null){
    if($_FILES['uploadFile']['name'] != null){      //파일업로드 할 시

        //파일 업로드
        $tmpFile = $_FILES['uploadFile']['tmp_name'];
        $file = $_FILES['uploadFile']['name'];
        $filepath = "/home/risker/www/board/download".$file;
        move_uploaded_file($tmpFile,$filepath);
        $query = "insert into data (num, writer, title, contents, date, view, file)
                    values(null, '$writer', '$title', '$contents', '$date', '$view', '".$file."')";
    }else {
        $query = "insert into data (num, writer, title, contents, date, view)
                    values(null, '$writer', '$title', '$contents', '$date', '$view')";
    }
    if($query){
        $result = $mysqli->query($query);
        echo "<script>alert('글이 등록되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0.1; url=../main.php'>";
    }else{
        echo "FAIL";
    }
}else{                 //if title == null
    echo "<script>alert('제목을 입력하세요!')</script>";
    echo "<meta http-equiv='refresh' content='0.1; url=../write.php'>";
}