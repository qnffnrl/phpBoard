<?php
/**
 * @var $connStatus    //타 파일에서 선언한 변수들
 * @var $rowCount
 * @var $result
 * @var $mysqli
 * @var $page
 * @var $block_start
 * @var $block_end
 * @var $total_page
 * @var $text
 * @var $searchCount
 * @var $title
 * @var $option
 */
ini_set("display_errors", 1);
include("config/select.php");
session_start();
if (!isset($_SESSION['is_login'])){
    echo "<script>alert('Need Login')</script>";
    header('Location:index.php');
}else{
?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Notice Board</title>
    <style>
        #page {width: 80%;margin: 0 auto;background-color: antiquewhite;}
        #conn {width: 80%;margin: 0 auto;}
        #contentsTop {padding-bottom: 10px;}
        #viewCount {font-size: small; font-weight: bold; display: inline;}
        #search {float: right;}
        #submit {font-weight: bolder; background-color: darkslategrey; border-style: none; color: white; height: 20px;}
        #title {text-align: center;}
        #refresh {text-decoration:none; color: black;}
        #logoutSector {text-align: right;}
        #welcome {color: green; float: left; font-weight: bolder;}
        #btnLogout {height: 30px; font-weight: bolder; background-color: darkslategrey; border-style: none; color: white;}
        #btnLogout:hover {background-color: black;}
        #hr {border-style: solid;}
        #table {text-align: center; width: 100%; border-collapse:collapse;}
        th {border-top: midnightblue solid; border-bottom: midnightblue solid; background-color: cadetblue;}
        tr {background-color: rgb(237 247 235);}
        td {height: 40px; border-bottom: grey ridge;}
        #pageNumber {text-align: center;}
        .btnNum {width: 30px; height: 30px; font-weight: bolder; background-color: darkslategrey; color: white; text-decoration: none; border: solid antiquewhite; font-size: larger;}
        .btnNum:hover {background-color: black;}
        #btnWrite {float: right; height: 30px; font-weight: bolder; background-color: darkslategrey; border-style: none; color: white;}
        button:hover{background-color: darkcyan;}
        #btnWrite:hover{background-color: black;}
        #submit:hover {background-color: black;}
        #a {text-decoration:none; color: black; font-weight: bold;}
        #a:hover {background-color: tomato;}
        #selectNum {color: red; display: inline; }
        #tableTitle {text-align: left;}
    </style>
</head>
<body>
<div id="conn">
    <?php echo $connStatus; ?>      <!-- DB 연결 상태 표시 -->
</div>
<div id="page">
    <div id="title" title="Refresh"><h1><a href="main.php" id="refresh">Notice Board</a></h1></div>
    <div id="logoutSector">
        <span id="welcome"><?php echo "Welcome, " . "<em>" . $_SESSION['id'] . "</em>" . " !"; ?></span>
        <button id="btnLogout" onclick="location.href='config/logout.php'">Logout</button>
    </div>
    <hr id="hr">
    <div id="contents">
        <div id="contentsTop">
            <p id="viewCount">
                전체 <?php echo $searchCount; ?>건
            </p>
            <form id="search">                                                         <!-- 검색 -->
                <select name="option">
                    <option name="title" value="title">Title</option>
                    <option name="writer" value="writer">Writer</option>
                </select>
                <input type="text" name="searchText">
                <input id="submit" type="submit" value="Search">
            </form>
        </div>
        <form id="form">                                                              <!-- DB 출력 -->
            <table id="table">
                <tr>
                    <th>Number</th> <th>Title</th> <th>Writer</th> <th>Date</th> <th>View</th>
                </tr>
                <?php
                if (!$result) {
                    echo "queryError : " . $mysqli->error;              //쿼리 오류
                }
                while($row = $result->fetch_array()){
                    ?>
                    <tbody>                                            <!-- 메인 컨텐츠 출력 -->
                    <tr>
                        <td><?php
                                if($row['depth'] == 0){            /* 답글은 게시글 번호 출력 X */
                                    echo $row['num'];
                                }else{
                                    null;
                                }
                            ?>
                        </td>
                        <td id="tableTitle">
                            <?php
                                if($row['depth'] > 0){
                                    echo "<img height=1 alt='' width=" . $row['depth']*15 . ">└>";
                                }else{
                                    null;
                                }
                            ?>
                            <a id="a" href="./view.php?whereValue=<?php echo $row['num'];?>&cnt=<?php echo $row['view']+1;?>&option=<?php echo$option?>&searchText=<?php echo $text?>">     <!-- view.php -->
                                <?php echo $row['title']; ?>
                            </a>
                        </td>
                        <td>
                            <?php
                            if($row['writer'] == "Anonymous") {                      //작성자가 'Anonymous' 일때 <em>태그
                                echo '<em>' . $row['writer'] . '</em>';
                            }else{
                                echo $row['writer'];
                            }
                            ?>
                        </td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['view']; ?></td>
                    </tr>
                    </tbody>
                    <?php
                }
                ?>
            </table>
        </form>
    </div>
    <div id="pageNumber">    <!-- 페이징 -->
        <br>
        <?php
        if($searchCount>7){   //출력 컬럼이 7보다 많을때 페이징
            if($page > 1){   //현재페이지가 1페이지 이상일때
                if($text == null){
                    echo "<a class='btnNum' href='main.php?page=1'>1... </a>";
                }else{
                    echo "<a class='btnNum' href='main.php?page=1&option=$option&searchText=$text'>1... </a>";
                }
            }else{             //현재페이지가 1일때
                null;
            }

            if($page <= 1){  //현재페이지가 1일때
                null;
            }else{           //현재페이지가 1이 아닐때
                $pre = $page - 1;
                if($text == null){
                    echo "<a class='btnNum' href='main.php?page=$pre'> 이전</a>";
                }else{
                    echo "<a class='btnNum' href='main.php?page=$pre&option=$option&searchText=$text'> 이전</a>";
                }
            }
            for($i = $block_start; $i <= $block_end; $i++){

                if($page == $i){   //현재 페이지
                    ?>
                    <h2 id="selectNum"><u> <?php echo $i ?></u></h2>
                    <?php
                }else{             //현재 페이지가 아닌 나머지 페이지
                    if($text == null){
                        echo "<a class='btnNum' href='main.php?page=$i'> $i </a>";
                    }else {
                        echo "<a class='btnNum' href='main.php?page=$i&option=$option&searchText=$text'> $i </a>";
                    }
                }
            }
            if($page >= $total_page){    //마지막 페이지일때
                null;
            }else{                       //마지막 페이지 아닐때
                $next = $page + 1;
                if($text == null){
                    echo "<a class='btnNum' href='main.php?page=$next'> 다음 </a>";
                }else {
                    echo "<a class='btnNum' href='main.php?page=$next&option=$option&searchText=$text'> 다음 </a>";
                }
            }
            if($page >= $total_page){    //마지막 페이지일때
                null;
            }else{                       //마지막 페이지 아닐때
                if($text == null){
                    echo "<a class='btnNum' href='main.php?page=$total_page'>  ...$total_page</a>";
                }else{
                    echo "<a class='btnNum' href='main.php?page=$total_page&option=$option&searchText=$text'>  ...$total_page</a>";
                }
            }
        }else{
            null;
        }
        ?>
        <button id="btnWrite" onclick="location.href='write.php'"><em>Notice Write</em></button>
    </div>
</div>
</body>
</html>
<?php
}