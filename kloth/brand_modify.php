<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$brand_id=$_POST['brand_id'];
$brand_name = $_POST['brand_name'];

$launching_year = $_POST['launching_year'];

$country_num = $_POST['country'];

  $country_res=mysqli_query($conn,"select country_name from country where country_id=$country_num");
  while($country_row=mysqli_fetch_array($country_res)){
	$country= $country_row['country_name'];

}



$brand_info = $_POST['brand_info'];

/*transaction*/
mysqli_query($conn, "set autocommit = 0");	// autocommit 해제 
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation


$ret = mysqli_query($conn, "update brand set brand_name = '$brand_name',launching_year = $launching_year,country='$country',brand_info='$brand_info'where brand_id=$brand_id");

if(!$ret)
{
	mysqli_query($conn,"rollback"); // 브랜드 수정 query 수행 실패. 수행 전으로 rollback

    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn,"commit"); // 브랜드 수정 query 수행 성공. 수행 내역 commit
 
	s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=brand_list.php'>";
}

?>

