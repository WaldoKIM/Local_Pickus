<?php
include_once('./_common.php');

$sql = " select * from g5_estimate_match_propose where no_estimate = '$no_estimate' ";
$estimate_propose = sql_fetch($sql);

$sql = " select * from {$g5['estimate_match']} where no_estimate = '{$estimate_propose['no_estimate']}' ";
$estimate = sql_fetch($sql);

$now = date_create('now')->format('Y-m-d');
$sql = " update g5_estimate_match_propose set
			score = '$score', 
			review = '$review',
			updatetime = '$now'
		 where no_estimate = '$no_estimate' AND selected = 1 ";


sql_query($sql);

insert_notify($estimate_propose['rc_email'], '22', $estimate['title'].' 후기가 작성되었습니다.','',$estimate['no_estimate'], '','p8');

alert('후기를 작성하였습니다.', G5_URL.'/estimate/my_estimate_form_match_sa.php?no_estimate='.$no_estimate);
?>