<?php
include_once('./_common.php');

$sql = " select * from {$g5['estimate_propose']} where idx = '$sub_idx' ";
$estimate_propose = sql_fetch($sql);

$sql = " select * from {$g5['estimate_list']} where idx = '{$estimate_propose['estimate_idx']}' ";
$estimate = sql_fetch($sql);

$sql = " update {$g5['estimate_propose']} set
			score = '$score', 
			review = '$review'
		 where idx = '$sub_idx' ";


sql_query($sql);

insert_notify($estimate_propose['rc_email'], '22', $estimate['title'].' 후기가 작성되었습니다.','',$idx, '','p8');


alert('후기를 작성하였습니다.', G5_URL.'/estimate/my_estimate_form.php?idx='.$idx);
?>