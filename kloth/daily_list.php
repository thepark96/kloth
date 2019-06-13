<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from daily ";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where title like '%$search_keyword%' or daily_info like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <li></li><tr>
            <th>No.</th>
            
            <th>제목</th>
            <th>시즌</th>
            <th>등록자</th>
            <th>등록일</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            
            echo "<td><a href='daily_view.php?daily_id={$row['daily_id']}'>{$row['title']}</a></td>";
           
            echo "<td>{$row['season_name']}</td>";
            echo "<td>{$row['user']}</td>";
            echo "<td>{$row['added_date']}</td>";
            echo "<td width='17%'>
                <a href='daily_form.php?daily_id={$row['daily_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['daily_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(daily_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "daily_delete.php?daily_id=" + daily_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
