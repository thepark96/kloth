<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "daily_insert.php";

if (array_key_exists("daily_id", $_GET)) {
    $daily_id = $_GET["daily_id"];
    $query =  "select * from daily where daily_id = $daily_id";
    $res = mysqli_query($conn, $query);
    $daily = mysqli_fetch_array($res);
    if(!$daily) {
        msg("Daily 목록이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "daily_modify.php";
}

$seasons = array();

$query = "select * from season";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
     $seasons[$row['season_id']] = $row['season_name'];
    
}
?>
    <div class="container">
        <form name="daily_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="daily_id" value="<?=$daily['daily_id']?>"/>
            <h3>상품 정보 <?=$mode?></h3>
             <p>
                <label for="title">제목</label></label>
                <input type="text" placeholder="제목 입력" id="title" name="title" value="<?=$daily['title']?>"/>
            </p>
            
            <p>
                <label for="season_name">시즌 </label>
                <select name="season_name" id="season_name">
                
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($seasons as $id => $name) {
                            if($name == $daily['season_name']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
            <p>
                <label for="daily_info">daily 내용</label>
                <textarea placeholder="내용 입력" id="daily_info" name="daily_info" rows="10"><?=$daily['daily_info']?></textarea>
            </p>
             <p>
                <label for="user">등록자 이름</label></label>
                <input type="text" placeholder="이름 입력" id="user" name="user" value="<?=$daily['user']?>"/>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

			
            <script> 
                function validate() {   //입력 안된 거  메 세 지
                    if(document.getElementById("title").value == "") {
                        alert ("제목을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("season_name").value == "-1") {
                        alert ("시즌을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("daily_info").value == "") {
                        alert ("daily설명을 입력해 주십시오"); return false;
                    }else if(document.getElementById("user").value == "") {
                        alert ("등록자 이름을 입력해 주십시오"); return false;
                    }
                    
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>