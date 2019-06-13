<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("issue_id", $_GET)) {
    $issue_id = $_GET["issue_id"];
    $query = "select * from issue natural join brand where issue_id = $issue_id";
    $res = mysqli_query($conn, $query);
    $issue = mysqli_fetch_assoc($res);
    if (!$issue) {
        msg("등록된 이슈가 없습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>issue 보기</h3>

        <p>
            <label for="issue_id">이슈 번호</label>
            <input readonly type="text" id="issue_id" name="issue_id" value="<?= $issue['issue_id'] ?>"/>
        </p>

        <p>
            <label for="title">제목</label>
            <input readonly type="text" id="title" name="title" value="<?= $issue['title'] ?>"/>
        </p>

         <p>
            <label for="brand_name">관련 브랜드</label>
            <input readonly type="text" id="brand_name" name="brand_name" value="<?= $issue['brand_name'] ?>"/>
        </p>

        <p>
            <label for="content">내용</label>
            <input readonly type="text" id="content" name="content" value="<?= $issue['content'] ?>"/>
        </p>


        
    </div>
<? include("footer.php") ?>