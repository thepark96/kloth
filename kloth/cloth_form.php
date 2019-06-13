<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "cloth_insert.php";

if (array_key_exists("cloth_id", $_GET)) {
    $cloth_id = $_GET["cloth_id"];
    $query =  "select * from cloth where cloth_id = $cloth_id";
    $res = mysqli_query($conn, $query);
    $cloth = mysqli_fetch_array($res);
    if(!$cloth) {
        msg("물품이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "cloth_modify.php";
}

$brands = array();

$query = "select * from brand";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $brands[$row['brand_id']] = $row['brand_name'];
}
$genders = array();

$query = "select * from gender";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $genders[$row['gender_id']] = $row['gender_gender'];
}


$category = array();

$query = "select * from kind";
$res = mysqli_query($conn, $query);
$index=1;
while($row1 = mysqli_fetch_array($res)) {
    $category[$index] = $row1['type'];
    
    $index++;
}


$seasons = array();

$query = "select * from season";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
     $seasons[$row['season_id']] = $row['season_name'];
    
}

?>


    <div class="container">
        <form name="cloth_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="cloth_id" value="<?=$cloth['cloth_id']?>"/>
            <h3>상품 정보 <?=$mode?></h3>
             <p>
                <label for="cloth_name">상품명 </label>
                <input type="text" placeholder="상품명 입력" id="cloth_name" name="cloth_name" value="<?=$cloth['cloth_name']?>"/>
            </p>
            <p>
                <label for="brand_id">브랜드 </label>
                <select name="brand_id" id="brand_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($brands as $id => $name) {
                            if($id == $cloth['brand_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="gender">성별 </label>
                <select name="gender" id="gender">
                    <option value="-1">선택해 주십시오.</option>
                     <?
                        foreach($genders as $id=>$name) {
                            if($name == $cloth['gender']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
             <p>
                <label for="type">카테고리 </label>
                <select name="type" id="type">
                	  
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($category as $id => $name) {
                            if($name == $cloth['type']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="season_name">시즌 </label>
                <select name="season_name" id="season_name">
                
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($seasons as $id => $name) {
                            if($name == $cloth['season_name']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
             <p>
                <label for="making_year">제작연도</label>
                <input type="number" placeholder="연도 입력" id="making_year" name="making_year" value="<?=$cloth['making_year']?>" />
            </p>
            <p>
                <label for="cloth_info">상품설명</label>
                <textarea placeholder="상품설명 입력" id="cloth_info" name="cloth_info" rows="10"><?=$cloth['cloth_info']?></textarea>
            </p>
           

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

			
            <script> 
                function validate() {   //입력 안된 거  메 세 지
                    if(document.getElementById("cloth_name").value == "") {
                        alert ("상품명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("brand_id").value == "-1") {
                        alert ("브랜드를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("gender").value == "-1") {
                        alert ("성별을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("season_name").value == "-1") {
                        alert ("시즌을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("type").value == "-1") {
                        alert ("카테고리를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("making_year").value == "") {
                        alert ("생산연도를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("cloth_info").value == "") {
                        alert ("상품설명을 입력해 주십시오"); return false;
                    }
                    
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>