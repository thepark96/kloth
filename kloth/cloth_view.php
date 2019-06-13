<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("cloth_id", $_GET)) {
    $cloth_id = $_GET["cloth_id"];
    $query = "select * from cloth natural join brand where cloth_id = $cloth_id";
    $res = mysqli_query($conn, $query);
    $cloth = mysqli_fetch_assoc($res);
    if (!$cloth) {
        msg("옷이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>상품 정보 상세 보기</h3>

        <p>
            <label for="cloth_id">상품 코드</label>
            <input readonly type="text" id="cloth_id" name="cloth_id" value="<?= $cloth['cloth_id'] ?>"/>
        </p>
		<p>
            <label for="cloth_name">상품명</label>
            <input readonly type="text" id="cloth_name" name="cloth_name" value="<?= $cloth['cloth_name'] ?>"/>
        </p>
		
		<p>
            <label for="brand_name">브랜드</label>
            <input readonly type="text" id="brand_name" name="brand_name" value="<?= $cloth['brand_name'] ?>"/>
        </p>
         <p>
            <label for="making_year">제작연도</label>
            <input readonly type="number" id="making_year" name="making_year" value="<?= $cloth['making_year'] ?>"/>
        </p>
        <p>
            <label for="season_name">시즌 </label>
            <input readonly type="text" id="season_name" name="season_name" value="<?= $cloth['season_name'] ?>"/>
        </p>

		 <p>
            <label for="gender">성별</label>
            <input readonly type="text" id="gender" name="gender" value="<?= $cloth['gender'] ?>"/>
        </p>
         <p>
            <label for="position">부위</label>
            <input readonly type="text" id="position" name="position" value="<?= $cloth['position'] ?>"/>
        </p>
         <p>
            <label for="type">카테고리</label></label>
            <input readonly type="text" id="type" name="type" value="<?= $cloth['type'] ?>"/>
        </p>
       
        <p>
            <label for="cloth_ino">상품설명</label>
            <textarea readonly id="cloth_info" name="cloth_info" rows="10"><?= $cloth['cloth_info'] ?></textarea>
        </p>

        
    </div>
<? include("footer.php") ?>