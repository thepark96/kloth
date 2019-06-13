<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
if (array_key_exists("brand_id", $_GET)) {
    $brand_id = $_GET["brand_id"];
    $query =  "select * from brand where brand_id = $brand_id";
    $res = mysqli_query($conn, $query);
    $brand = mysqli_fetch_array($res);
    if(!$brand) {
        msg("등록된 브랜드가 없습니다.");
    }
    $mode = "수정";
    $action = "brand_modify.php";
}

$countrys= array();

$query = "select * from country";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $countrys[$row['country_id']] = $row['country_name'];
}


?>
    <div class="container">
        <form name="brand_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="brand_id" value="<?=$brand['brand_id']?>"/>
            <h3>브랜드 정보<?=$mode?></h3>
             <p>
                <label for="brand_name">브랜드명 </label>
                <input type="text" placeholder="브랜드명 입력" id="brand_name" name="brand_name" value="<?=$brand['brand_name']?>"/>
            </p>
             <p>
                <label for="launching_year">설립연도</label>
                <input type="number" placeholder="연도 입력" id="launching_year" name="launching_year" value="<?=$brand['launching_year']?>" />
            </p>
            <p>
                <label for="country">국가 </label>
                <select name="country" id="country">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($countrys as $id => $name) {
                            if($name == $brand['country']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
             
            <p>
                <label for="brand_info">브랜드설명</label>
                <textarea placeholder="브랜드설명 입력" id="brand_info" name="brand_info" rows="10"><?=$brand['brand_info']?></textarea>
            </p>
           

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

			
            <script> 
                function validate() {   //입력 안된 거  메 세 지
                    if(document.getElementById("brand_name").value == "") {
                        alert ("브랜드명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("launching_year").value == "") {
                        alert ("설립연도를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("country").value == "-1") {
                        alert ("국가를 선택해 주십시오"); return false;
                    }
                   
                   
                    else if(document.getElementById("brand_info").value == "") {
                        alert ("브랜드설명을 입력해 주십시오"); return false;
                    }
                    
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>