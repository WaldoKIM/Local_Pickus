<?php
include_once('./_common.php');

$sql = " select * from {$g5['match_list']} where idx = '$idx' ";
$match = sql_fetch($sql);

$sql = " update {$g5['match_propose']} set (
			price = '$price',
			content = '$content',
			delievery = '$delievery',
			photo1 = '$photo1', 
			photo2 = '$photo2',
			photo3 = '$photo3',
			photo4 = '$photo4',
			photo5 = '$photo5',
			photo6 = '$photo6',
			photo1_rotate = '$photo1_rotate', 
			photo2_rotate = '$photo2_rotate',
			photo3_rotate = '$photo3_rotate',
			photo4_rotate = '$photo4_rotate',
			photo5_rotate = '$photo5_rotate',
			photo6_rotate = '$photo6_rotate'
		where
			idx = '$idx' ";


sql_query($sql);
alert('견적에 수정하였습니다.', G5_URL.'/estimate/partner_match_list2.php');
?>