<?php
/**
 * @var $mysqli
 */
ini_set('display_errors', 0);
include("db.config.php");

$num = $_GET['whereValue'];
$view = $_GET['cnt'];
$text = $_GET['searchText'];
//    echo $view;

//view 페이지 DB 출력
$query = "select * from data where num=$num";
$result = $mysqli->query($query);
$row = $result->fetch_array();

//조회수 count        * session 이나 cookie 사용해서 중복 counting 방지*
$queryCountUp = "update data set view='".$view."' where num=$num";
$resultCountUp = $mysqli->query($queryCountUp);

mysqli_close($mysqli);
