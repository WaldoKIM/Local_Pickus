<?php
include_once('./_common.php');


if($idx){
	$sql = " update {$g5['estimate_list']} set
				state = '$state'
			 where idx = '$idx' ";
	sql_query($sql);
	alert('견적을 취소하였습니다.', G5_URL.'/estimate/my_estimate_list.php?page='.$page);
}else{
	$sql = " update {$g5['estimate_match']} set
				state = '$state'
			 where no_estimate = '$no_estimate' ";

	sql_query($sql);
	alert('견적을 취소하였습니다.', G5_URL.'/estimate/my_estimate_list_match.php');
}


?>