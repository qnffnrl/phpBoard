<?php
/**
 * @var $mysqli
 */
ini_set('display_errors',1);
include("db.config.php");

//검색상태 유지
$option = $_GET['option'];
$text = $_GET['searchText'];

//댓글 입력 정보
$con_num = $_GET['whereValue'];
$reply_writer = $_POST['answerWriter'];;
if($reply_writer != null){
    $reply_writer = $_POST['answerWriter'];
}else{
    $reply_writer = "Anonymous";
}
$reply_content = $_POST['answerText'];
$pw = $_POST['pw'];
$pwCheck = $_POST['pwCheck'];

if($reply_content != null){
    if($pw == $pwCheck){
        $queryInsert = "insert into reply (num, con_num, reply_writer, reply_content, reply_pw) values(null, '$con_num', '$reply_writer', '$reply_content', '$pw')";
        $result = $mysqli->query($queryInsert);
        if($result){
            echo "<script>alert('글이 등록되었습니다.');</script>";
            echo "<meta http-equiv='refresh' content='0.1; url=../view.php?whereValue=$con_num&option=$option&searchText=$text'>";
        }else{
            null;
        }
    }else{
        echo "<script>alert('비밀번호가 동일하지않습니다!!');</script>";
        echo "<meta http-equiv='refresh' content='0.1; url=../view.php?whereValue=$con_num&option=$option&searchText=$text'>";
    }
}else{
    echo "<script>alert('글을 입력하세요!!');</script>";
    echo "<meta http-equiv='refresh' content='0.1; url=../view.php?whereValue=$con_num&option=$option&searchText=$text'>";
}