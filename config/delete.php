<?php
/**
* @var $mysqli
*/
    ini_set("display_errors", 0);
    include("db.config.php");

    $num = $_GET['whereValue'];
    $zero = 0;

    /* 부모글의 listNum 가져오기 */
    $queryCheck2 = "select listNum from data where num=$num";
    $resultCheck2 = $mysqli->query($queryCheck2);
    $row = $resultCheck2->fetch_array();
    /**************************************************************************/

    /* 삭제하려는 답글의 listNum을 가진 모든 행의 개수 구하기 */
    $queryCheck = "select count(*) from data where listNum = $row[0]";
    $resultCheck = $mysqli->query($queryCheck);
    $rowCheck = $resultCheck->fetch_array();
    /**************************************************************************/

    if($rowCheck[0] > 2){             /* 답글이 하나만 달린 부모 글의 답글이 삭제되면 해당 부모글의 listNum 0 처리 */
        null;
    }else{
        $query2 = "update data set listNum = $zero where listNum = $row[0]";
        $result2 = $mysqli->query($query2);
    }

    $query = "delete from data where num=$num";
    $result = $mysqli->query($query);

    unlink("/home/hw/www/download/".$_GET['file']); //DB 행 삭제 시 서버측 파일까지 삭제

    echo "<script>alert('삭제를 완료했습니다.');</script>";
    echo "<meta http-equiv='refresh' content='0.1; url=../main.php'>";

    mysqli_close($mysqli);
