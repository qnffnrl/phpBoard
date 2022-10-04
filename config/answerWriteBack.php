<?php
/**
 * @var $mysqli
 */
ini_set("display_errors", 1);
include("db.config.php");

/* 변수 초기화 : start */
$writer= $_POST['writer']; //작성자
$query = ""; //쿼리문
/* 변수 초기화 : end */
$whereValue = $_GET['whereValue'];
$option = $_GET['option'];
$text = $_GET['searchText'];

/* 게시물 입력 정보 POST : start */
if($writer != null){
    $writer= $_POST['writer'];
}else{
    $writer = "Anonymous";
}
$title = $_POST['title'];
$contents = $_POST['contents'];
$date = date('Y:m:d');
/* 게시물 입력 정보 POST : end */

/* 답글의 depth값 확인 */
$queryDepthCheck = "select depth from data where num = '$whereValue'";
$resultDepthCheck = $mysqli->query($queryDepthCheck);
$rowDepthCheck = $resultDepthCheck->fetch_array();
/***************************************************************************************/

/* 최상위 부모글의 num */
while($rowDepthCheck[0] == 0){
    $rowDepthCheck[0] =  $rowDepthCheck[0] - 1;
}
$queryCheckTopListNum = "select listNum from data where depth = '$rowDepthCheck[0]'";
$resultCheckTopListNum = $mysqli->query($queryCheckTopListNum);
$rowCheckTopListNum = $resultCheckTopListNum->fetch_array();
/***************************************************************************************/

if($title != null){          /* 제목 공백일시 confirm */
    if($rowDepthCheck[0] < 1){          /* 이중 답글인지 확인 */
        $query = "insert into data (num, writer, title, contents, date, depth, listNum)                  
                    values(null, '$writer', '$title', '$contents', '$date', '1', '$whereValue')";

        $query2 = "update data set listNum = '$whereValue' where num='$whereValue'";
        if($query && $query2){
            $result = $mysqli->query($query);
            $result2 = $mysqli->query($query2);
            echo "<script>alert('글이 등록되었습니다.');</script>";
            echo "<meta http-equiv='refresh' content='0.1; url=../main.php'>";
        }else{
            echo "FAIL";
        }
    }else{    /* 답글에 답글이 달릴때 */
        $depthPlusOne = $rowDepthCheck[0]+1;
        $query = "insert into data (num, writer, title, contents, date, depth, listNum) /*-> 최상위 부모글의 num  */                
                    values(null, '$writer', '$title', '$contents', '$date', '$depthPlusOne', '$rowCheckTopListNum[0]')";
        if($query){
            $result = $mysqli->query($query);
            echo "<script>alert('글이 등록되었습니다.');</script>";
            echo "<meta http-equiv='refresh' content='0.1; url=../main.php'>";
        }
    }
}else{                 //if title == null
    echo "<script>alert('제목을 입력하세요!')</script>";

    echo "<meta http-equiv='refresh' content='0.1; url=../answerWriteFront.php?whereValue=$whereValue&option=$option&searchText=$text'>";
}