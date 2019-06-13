<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("daily_id", $_GET)) {
    $daily_id = $_GET["daily_id"];
    $query = "select * from daily where daily_id = $daily_id";
    $res = mysqli_query($conn, $query);
    $daily = mysqli_fetch_assoc($res);
    if (!$daily) {
        msg("등록된 이슈가 없습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>Daily 보기</h3>

        <p>
            <label for="issue_id">Daily 번호</label>
            <input readonly type="text" id="daily_id" name="daily_id" value="<?= $daily['daily_id'] ?>"/>
        </p>

        <p>
            <label for="title">제목</label>
            <input readonly type="text" id="title" name="title" value="<?= $daily['title'] ?>"/>
        </p>

         <p>
            <label for="season_name">시즌</label>
            <input readonly type="text" id="season_name" name="season_name" value="<?= $daily['season_name'] ?>"/>
        </p>
		 <p>
            <label for="user">등록자 이름</label>
            <input readonly type="text" id="user" name="user" value="<?= $daily['user'] ?>"/>
        </p>
        
         <p>
            <label for="daily_info">Daily 내용</label>
            <input readonly type="text" id="daily_info" name="daily_info" value="<?= $daily['daily_info'] ?>"/>
        </p>
    </div>
<? include("footer.php") ?>