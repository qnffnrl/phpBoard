<?php
/**
 * @var $mysqli
 */
ini_set("display_errors", 0);
include('db.config.php');

$num = $_POST['num'];
$title = $_POST['changedTitle'];
$writer = $_POST['changedWriter'];
$contents = $_POST['changedContents'];
$uploadFile = $_POST['changedUploadFile'];

$option = $_GET['option'];
$text = $_GET['searchText'];


$query = "update data set title='".$title."', writer='".$writer."' , contents='".$contents."' , file='".$uploadFile."' where num=$num";
$result = $mysqli->query($query);

if(!$result) {
    echo "<script>alert('잘못된 접근입니다.');</script>"; //수정 실패 시 updateWriter 페이지로
    echo "<meta http-equiv='refresh' content='0.1; url=../updateWriter.php?whereValue=$num&option=$option&searchText=$text'>";
}else {
    echo "<script>alert('수정이 완료되었습니다.');</script>"; //수정 성공 시 view 페이지로
    echo "<meta http-equiv='refresh' content='0.1; url=../view.php?whereValue=$num&option=$option&searchText=$text'>";
}
