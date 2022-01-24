<?php
include_once('./_common.php');

$sql = " select * from {$g5['match_list']} where idx = '$idx' ";
$match = sql_fetch($sql);

$sql = " insert into {$g5['match_propose']} (
			match_idx,
			rc_email,
			rc_nickname,
			email,
			nickname,
			price,
			content,
			delievery,
			photo1, 
			photo2,
			photo3,
			photo4,
			photo5,
			photo6,
			photo1_rotate, 
			photo2_rotate,
			photo3_rotate,
			photo4_rotate,
			photo5_rotate,
			photo6_rotate,			
			selected,
			proposetime,
			updatetime
		) values (
			'$idx',
			'{$member['mb_email']}',
			'{$member['mb_name']}',
			'{$match['email']}',
			'{$match['nickname']}',
			'$price',
			'$content',
			'$delievery',
			'$photo1', 
			'$photo2',
			'$photo3',
			'$photo4',
			'$photo5',
			'$photo6',
			'$photo1_rotate', 
			'$photo2_rotate',
			'$photo3_rotate',
			'$photo4_rotate',
			'$photo5_rotate',
			'$photo6_rotate',				
			'0',
			now(),
			now()
		) ";


sql_query($sql);
alert('견적에 참여하였습니다.', G5_URL.'/estimate/partner_match_list2.php');
?>