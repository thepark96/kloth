<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("brand_id", $_GET)) {
    $brand_id = $_GET["brand_id"];
    $query = "select * from   brand where brand_id = $brand_id";
    $res = mysqli_query($conn, $query);
    $brand = mysqli_fetch_assoc($res);
    if (!$brand) {
        msg("옷이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>브랜드 정보 상세 보기</h3>

        <p>
            <label for="brand_id">브랜드 코드</label>
            <input readonly type="text" id="brand_id" name="brand_id" value="<?= $brand['brand_id'] ?>"/>
        </p>
		
		<p>
            <label for="brand_name">브랜드</label>
            <input readonly type="text" id="brand_name" name="brand_name" value="<?= $brand['brand_name'] ?>"/>
        </p>
         <p>
            <label for="launching_year">설립연도</label>
            <input readonly type="number" id="launching_year" name="launching_year" value="<?= $brand['launching_year'] ?>"/>
        </p>
        <p>
            <label for="country">국가 </label>
            <input readonly type="text" id="country" name="country" value="<?= $brand['country'] ?>"/>
        </p>

		
        <p>
            <label for="brand_ino">브랜드설명</label>
            <textarea readonly id="brand_info" name="brand_info" rows="10"><?= $brand['brand_info'] ?></textarea>
        </p>

        
    </div>
<? include("footer.php") ?>