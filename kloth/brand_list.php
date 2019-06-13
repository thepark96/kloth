<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from brand";
	 if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where  brand_name like '%$search_keyword%'or brand_info like '%$search_keyword%'";
    
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
            <th>브랜드</th>
            
            
            <th>기능</th>
        </tr>
       
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
             echo "<td><a href='brand_view.php?brand_id={$row['brand_id']}'>{$row['brand_name']}</a></td>";
           
            
         
            
            echo "<td width='17%'>
                <a href='brand_form.php?brand_id={$row['brand_id']}'><button class='button primary small'>수정</button></a>
                 
                </td>";
            echo "</tr>";
            $row_index++;
        }?>
        
        </tbody>
    </table>
  
</div>
<? include("footer.php") ?>
