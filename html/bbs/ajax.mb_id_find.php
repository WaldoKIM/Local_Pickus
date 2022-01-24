<?php
include_once("./_common.php");

$sql = " select * from {$g5['member_table']} where mb_hp = '$mb_hp' ";
$row = sql_fetch($sql);

if($row){
	if(!$row['mb_leave_date'] && ( $row['mb_level'] == "0" || $row['mb_level'] == "2" ) )
	{
		echo '귀하의 ID는 <span>'.$row['mb_email'].'</span> 입니다.';
	}else{
		echo '회원 정보가 없습니다.';
	}
}else{
	echo '회원 정보가 없습니다.';
}
?>