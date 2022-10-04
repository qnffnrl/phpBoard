<?php
/**
 * @var $mysqli
 */
ini_set("display_errors", 0);
include("db.config.php");

//검색 관련 정보 Get
$text = $_GET['searchText'];
$option = $_GET['option'];

$query = "";    //컬럼출력용
$query2 = "";   //컬럼갯수 COUNT 용

//페이징 *****************************************************
if (isset($_GET["page"])){
    $page = $_GET["page"];
}else{
    $page = 1;   //디폴트
}

$list = 7;                                              //한 페이지당 출력될 컬럼 수
$block_cnt = 3;                                         //페이징 숫자 갯수
$block_num = ceil($page / $block_cnt);                  //해당 페이지 별 블록 넘버

$block_start = (($block_num - 1) * $block_cnt) + 1;     //블록 별 시작 페이징 숫자

$block_end = $block_start + $block_cnt - 1;             //블록 별 끝 페이징 숫자
$page_start = ($page - 1) * $list;                      //페이지 별 시작 컬럼 / limit __, 7

//데이터 조회, Option 별 검색 조건문
if($option == 'title'){
    $query = "select * from data where title like '". "%" . $text . "%" ."' order by num desc limit $page_start, $list";
    $query2 = "select * from data where title like '". "%" . $text . "%" ."' order by num desc";
}else if($option == 'writer'){
    $query = "select * from data where writer like '". "%" . $text . "%" ."' order by num desc limit $page_start, $list";
    $query2 = "select * from data where writer like '". "%" . $text . "%" ."' order by num desc";
}else{
    $query = "select * from data order by listNum desc, depth asc limit $page_start, $list";      //MAX 7개 출력
    $query2 = "select * from data";
}
$result = $mysqli->query($query);    //전체 행 조회 for PRINT

$resultCount = $mysqli->query($query2);    //전체 행 조회 for COUNT cause LIMIT
$searchCount = $resultCount->num_rows;     // 검색시 나온 행 갯수 COUNT

$total_page  = ceil($searchCount / $list);            //총 페이징 숫자 수
if($block_end > $total_page){
    $block_end = $total_page;
}
$total_block = ceil($total_page / $block_cnt);          //총 블록 수
//$querySelectID = "select "

