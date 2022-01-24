<?php
include_once('./_common.php');

$sql = " update {$g5['estimate_list']} set
			state = '$state' 
		 where idx = '$idx' ";

sql_query($sql);

alert('견적을 취소하였습니다.', G5_URL.'/estimate/my_estimate_list.php?page='.$page);
?>