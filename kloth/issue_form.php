<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "issue_insert.php";

if (array_key_exists("issue_id", $_GET)) {
    $issue_id = $_GET["issue_id"];
    $query =  "select * from issue where issue_id = $issue_id";
    $res = mysqli_query($conn, $query);
    $issue = mysqli_fetch_array($res);
    if(!$issue) {
        msg("Issue가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "issue_modify.php";
}

$brands = array();

$query = "select * from brand";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $brands[$row['brand_id']] = $row['brand_name'];
}
?>
    <div class="container">
        <form name="issue_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="issue_id" value="<?=$issue['issue_id']?>"/>
            <h3>상품 정보 <?=$mode?></h3>
             <p>
                <label for="title">제목</label></label>
                <input type="text" placeholder="제목 입력" id="title" name="title" value="<?=$issue['title']?>"/>
            </p>
            
            <p>
                <label for="brand_id">관련 브랜드 </label>
                <select name="brand_id" id="brand_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($brands as $id => $name) {
                            if($id == $issue['brand_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
            <p>
                <label for="content">issue내용</label>
                <textarea placeholder="내용 입력" id="content" name="content" rows="10"><?=$issue['content']?></textarea>
            </p>
           

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

			
            <script> 
                function validate() {   //입력 안된 거  메 세 지
                    if(document.getElementById("title").value == "") {
                        alert ("제목을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("brand_id").value == "-1") {
                        alert ("브랜드명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("content").value == "") {
                        alert ("issue설명을 입력해 주십시오"); return false;
                    }
                    
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>