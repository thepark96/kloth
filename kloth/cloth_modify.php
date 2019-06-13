<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$cloth_id=$_POST['cloth_id'];
$cloth_name = $_POST['cloth_name'];
$brand_id = $_POST['brand_id'];
$making_year = $_POST['making_year'];

$season_name = $_POST['season_name'];
  $season_res=mysqli_query($conn,"select season_name from season where season_id=$season_name");
  while($season_row=mysqli_fetch_array($season_res)){
	$season1= $season_row['season_name'];
}

$gender = $_POST['gender'];
$gender_res=mysqli_query($conn,"select gender_gender from gender where gender_id=$gender");
  while($gender_row=mysqli_fetch_array($gender_res)){
	 $gender1= $gender_row['gender_gender'];
 
}

$category_type = array();

$cat_res = mysqli_query($conn, "select * from kind");
$index=1;
while($cat_row = mysqli_fetch_array($cat_res)) {
    $category_type[$index] = $cat_row['type'];
    
    $index++;
}


$type = $_POST['type'];
$type1=$category_type[$type];


$position_res=mysqli_query($conn,"select position from kind where type='$type1'");

while ($position_row=mysqli_fetch_array($position_res)){
	 $position= $position_row['position'];

 
}

$cloth_info = $_POST['cloth_info'];

/*transaction*/
mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "update cloth set cloth_name = '$cloth_name',
brand_id ='$brand_id', making_year = '$making_year',season_name='$season1',gender='$gender1',
position='$position',type='$type1',cloth_info='$cloth_info' where cloth_id=$cloth_id");

if(!$ret)
{
	mysqli_query($conn, "rollback"); // 옷 정보 수정 query 수행 실패. 수행 전으로 rollback

    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit"); // 옷 정보 수정 query 수행 성공. 수행 내역 commit

    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=cloth_list.php'>";
}

?>

