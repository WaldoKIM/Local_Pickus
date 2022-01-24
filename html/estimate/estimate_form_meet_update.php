<?php
include_once('./_common.php');

$rc_email = $member['mb_email'];

$sql = " select * from {$g5['estimate_propose']} where estimate_idx = '$idx' and rc_email = '$rc_email' ";
$ep = sql_fetch($sql);

if($ep){
	alert('이미 참여한 방문견적입니다.', G5_URL.'/estimate/partner_estimate_list.php');
}

$sql = " select * from {$g5['estimate_list']} where idx = '$idx' ";
$estimate = sql_fetch($sql);

$sql = " insert into {$g5['estimate_propose']} (
			estimate_idx,
			rc_email,
			rc_nickname,
			email,
			nickname,
			price,
			meet,
			meet_confirm,
			selected,
			proposetime
		) values (
			'$idx',
			'{$member['mb_email']}',
			'{$member['mb_biz_name']}',
			'{$estimate['email']}',
			'{$estimate['nickname']}',
			'0',
			'1',
			'0',
			'0',
			now()
		) ";


sql_query($sql);

alert('방문견적에 참여하였습니다. 관리자 승인 후 주소가 공개 됩니다.', G5_URL.'/estimate/estimate_list2.php');
?>