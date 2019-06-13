<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$daily_id = $_POST['daily_id'];
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

$ret = mysqli_query($conn, "update daily set title = '$title', season_name = '$season1', user = '$user',daily_info='$daily_info' where daily_id=$daily_id");

if(!$ret)
{
	mysqli_query($conn, "rollback"); // daily 수정 query 수행 실패. 수행 전으로 rollback

    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit"); // daily 수정 query 수행 성공. 수행 내역 commit

    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=daily_list.php'>";
}

?>
