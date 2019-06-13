<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$title = $_POST['title'];
$brand_id = $_POST['brand_id'];
$content = $_POST['content'];

/*transaction*/
mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "insert into issue (title, content, brand_id, added_date) values('$title', '$content','$brand_id',  NOW())");
if(!$ret)
{
	mysqli_query($conn, "rollback"); // 이슈 등록 query 수행 실패. 수행 전으로 rollback

	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit"); // 이슈 등록 query 수행 성공. 수행 내역 commit

    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=issue_list.php'>"; //성 공 적 으 로 등 록 했 으 면 이 동 해 라 
}

?>

