<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from issue natural join brand";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where title like '%$search_keyword%' or content like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <li></li>
        <tr>
            <th>No.</th>
            
            <th>제목</th>
            <th>브랜드</th>
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
            
            echo "<td><a href='issue_view.php?issue_id={$row['issue_id']}'>{$row['title']}</a></td>";
            // echo "<td>{$row['title']}</td>";
            echo "<td>{$row['brand_name']}</td>";
            echo "<td>{$row['added_date']}</td>";
            echo "<td width='17%'>
                <a href='issue_form.php?issue_id={$row['issue_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['issue_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(issue_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "issue_delete.php?issue_id=" + issue_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
