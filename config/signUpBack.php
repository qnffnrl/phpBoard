<?php
    /**
     * @var $mysqli
     */
    ini_set('display_errors', '0');
    include("db.config.php");

    /* posted information */
    $id = $_POST['id'];
    $pw = $_POST['pw'];
    $pwConfirm = $_POST['pwConfirm'];

    if($id != null && $pw != null){  /* 빈칸 예외처리 */
        if($pw == $pwConfirm){       /* 비밀번호 불일치 예외처리 */
            $query = "insert into login(id, pw) values('$id', '$pw')";
            if($query){
                $result = $mysqli->query($query);
                echo "<script>alert('회원가입이 완료되었습니다.');</script>";
                echo "<meta http-equiv='refresh' content='0.1; url=../index.php'>";
            }else{
                echo "FAIL";
            }
        }else{
            echo "<script>alert('비밀번호가 일치하지 않습니다.');</script>";
            echo "<meta http-equiv='refresh' content='0.1; url=../signUpFront.php'>";
        }
    }else{
        echo "<script>alert('빈칸이 존재합니다.');</script>";
        echo "<meta http-equiv='refresh' content='0.1; url=../signUpFront.php'>";
    }