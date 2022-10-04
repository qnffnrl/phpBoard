<?php
$host = 'www.risker.shop';
$user = 'risker';
$pw = 'qnffnrl5958!';
$dbname = 'board';
$connStatus = '';

$mysqli = new mysqli($host, $user, $pw, $dbname);

if ($mysqli->connect_error) {        // DB 접속 실패
    $connStatus =  "MySQL Connection Failed";
    die('Connection failed : ' . $mysqli->connect_error);

}else{                               // DB 접속 성공
    $connStatus =  "MySQL Connection Successfully";
}