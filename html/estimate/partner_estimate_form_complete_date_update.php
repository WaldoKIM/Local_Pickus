<?php
include_once('./_common.php');

$sql = " update {$g5['estimate_propose']} set 
			completetime = '$change_complete_time'
		where 
			idx = '$sub_idx' ";
sql_query($sql);
$sql = " update {$g5['estimate_list']} set 
			state = 8
		where idx = '$idx'";
sql_query($sql);

$sql = "select * from {$g5['estimate_list']} where idx = '$idx'";
$list = sql_fetch($sql);

$sql = "select * from {$g5['estimate_propose']} where idx = '$sub_idx'";
$propose = sql_fetch($sql);

insert_notify($list['email'], '11', $list['title'] . ' ' . $change_complete_time .' 에 진행 됩니다. ','',$idx, '','cp7');

insert_notify($propose['rc_email'], '22', $list['title'] . ' ' . $change_complete_time .' 에 진행 됩니다. ','',$idx, '','p5');

kakaotalk_send($list['phone'], 'SJT_058640',   $list['title'] .'|'. $change_complete_time);

alert('변경하였습니다.', G5_URL.'/estimate/partner_estimate_form.php?idx='.$idx);

?>