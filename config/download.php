<?php
    include("db.config.php");
    ini_set("display_errors",0);

    $filepath = "/home/risker/www/board/download/";
    $file = $_GET['file'];
    $down = $filepath.$file;
    $filesize = filesize($down);


    //파일 다운로드
    if(file_exists($down)){        //파일의 존재여부 확인
        header("Content-Type:aplication/octet-stream");
        header("Content-Disposition:attachment;filename=$file");  //다운로드 대화상자 띄움
        header("Content-Transfer-Encoding:binary");               //인코딩 형식 지정정
        header("Content-Length:".filesize($filepath.$file));      //업로드한 파일 크기
        header("Cache-Control:cache,must-revalidate");            //캐싱 방지
        header("Pragma:public");                                  //캐싱 방지
        header("Expires:0");                                      //캐싱 방지

        if(is_file($down)){            //파일의 존재여부 확인
            $openFile = fopen($down,"r");    //파일 열기 , r : 읽기전용
            while(!feof($openFile)){         //파일 내용끝날때 까지
                $buf = fread($openFile,8192);//파일 읽기, 8192byte
                $read = strlen($buf);
                print($buf);
                flush();               //출력버퍼를 비움
            }
            fclose($openFile);               //파일 닫기
        }
        else{
            echo "None file";
        }
    } else{
        echo "<script>alert('존재하지 않는 파일입니다.')</script>";
        echo "<meta http-equiv='refresh' content='0.1; url=../view.php?whereValue=". $_GET['whereValue']."&option=".$_GET['option']."&searchText=".$_GET['text']."'>";
    }