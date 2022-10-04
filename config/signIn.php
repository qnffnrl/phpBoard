<?php
    /**
     * @var $mysqli
     */
    session_start();
    ini_set("display_errors", "0");
    include("db.config.php");

    /* Posted information */
    $id = $_POST['id'];
    $pw = $_POST['pw'];

    $query = "select * from login where id = '$id' ";
    $result = $mysqli->query($query);

    $data = mysqli_fetch_array($result);
    if($id != null && $pw != null){
        if($data[0] == $id){
            if($data[1] == $pw){
                $_SESSION['is_login']=true;
                $_SESSION['id']=$id;
                echo "<script>alert('로그인 성공');</script>";
                echo "<meta http-equiv='refresh' content='0.1; url=../main.php'>";
            }else{
                echo "<script>alert('회원정보를 확인하십시오');</script>";
                echo "<meta http-equiv='refresh' content='0.1; url=../index.php'>";
            }
        }else{
            echo "<script>alert('회원정보를 확인하십시오');</script>";
            echo "<meta http-equiv='refresh' content='0.1; url=../index.php'>";
        }
    }else{
        echo "<script>alert('회원정보를 확인하십시오');</script>";
        echo "<meta http-equiv='refresh' content='0.1; url=../index.php'>";
    }