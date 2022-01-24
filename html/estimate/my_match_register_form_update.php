<?php
include_once('./_common.php');

if (!$is_member)
	alert("로그인 후 사용이 가능합니다.");

$sql = " insert into {$g5['match_list']} set
			email = '{$member['mb_email']}',
			nickname = '{$member['mb_name']}',
			phone = '{$member['mb_hp']}',
			title = '$title',
			content = '$content',
			area1 = '$area1',
			area2 = '$area2', 
			area3 = '$area3',
			item_cat = '$item_cat',
			item_cat_dtl = '$item_cat_dtl',
			floor = '$floor',
			elevator_yn = '$elevator_yn',
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
			photo6_rotate = '$photo6_rotate',
			state = '0',
			writetime = now() ";

sql_query($sql);

alert("중고매칭이 신청되었습니다.","./my_match_list.php");
?> 
