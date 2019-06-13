<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$issue_id = $_POST['issue_id'];
$title = $_POST['title'];
$content = $_POST['content'];
$brand_id = $_POST['brand_id'];

/*transaction*/
mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "update issue set title = '$title', content = '$content', brand_id = '$brand_id' where issue_id=$issue_id ");

if(!$ret)
{
	mysqli_query($conn, "rollback"); // 이슈 수정 query 수행 실패. 수행 전으로 rollback

    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit"); // 이슈 수정 query 수행 성공. 수행 내역 commit

    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=issue_list.php'>";
}

?>
