<?php
include_once('./_common.php');

$sql = " update {$g5['estimate_propose']} set
			score = '$score', 
			review = '$review'
		 where idx = '$sub_idx' ";

sql_query($sql);

alert('후기를 작성하였습니다.', G5_URL.'/estimate/my_estimate_list.php?page='.$page);
?>