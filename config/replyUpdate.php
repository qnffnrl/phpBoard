<?php
/**
 * @var $mysqli
 */

ini_set("display_errors", 1);
include("db.config.php");

//검색상태 유지*********************
$option = $_GET['option'];
$text = $_GET['searchText'];
//********************************

//DB 비밀번호 불러오기***************************************************
$num = $_GET['whereValue'];
$queryPw = "select reply_pw, num from reply where con_num=$num";
$resultPw = $mysqli->query($queryPw);
//*********************************************************************

//입력된 비번과 DB비번 선언*************
$insertPw = $_POST['updatePw'];
$rowPw = $resultPw->fetch_array();
//**********************************

$changedContents = $_POST['changedContent'];


$reply_num =  $_POST['num'];

if($insertPw == $rowPw['0']){
    $queryUpdate = "update reply set reply_content='".$changedContents."' where num=$reply_num";
    $resultUpdate = $mysqli->query($queryUpdate);
    if(!$resultUpdate){
        null;
    }else{
        echo "<script>alert('수정이 완료되었습니다.')</script>";
        echo "<meta http-equiv='refresh' content='0.1; url=../view.php?whereValue=$num&option=$option&searchText=$text'>";
    }
}else{
    echo "<script>alert('비밀번호가 일치하지 않습니다.')</script>";
    echo "<meta http-equiv='refresh' content='0.1; url=../view.php?whereValue=$num&option=$option&searchText=$text'>";

}