<?php
/**
 * @var $mysqli
 */
ini_set("display_errors",0);
include("db.config.php");

$col_num = $_GET['whereValue'];

$query = "select * from reply where con_num=$col_num";

$result = $mysqli->query($query);