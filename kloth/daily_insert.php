<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$title = $_POST['title'];
$season_name = $_POST['season_name'];
  $season_res=mysqli_query($conn,"select season_name from season where season_id=$season_name");
  while($season_row=mysqli_fetch_array($season_res)){
	$season1= $season_row['season_name'];
}
$user = $_POST['user'];
$daily_info = $_POST['daily_info'];

/*transaction*/
mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "insert into daily (title, season_name, user,daily_info, added_date) values('$title', '$season1','$user','$daily_info',  NOW())");
if(!$ret)
{
	mysqli_query($conn, "rollback"); // daily 등록 query 수행 실패. 수행 전으로 rollback

	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit"); // daily 등록 query 수행 성공. 수행 내역 commit

    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=daily_list.php'>"; //성 공 적 으 로 등 록 했 으 면 이 동 해 라 
}

?>

