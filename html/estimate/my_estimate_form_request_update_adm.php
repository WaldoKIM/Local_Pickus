<?php
include_once('./_common.php');

$sql = " select * from {$g5['estimate_list']} where idx = '$idx' ";
$estimate = sql_fetch($sql);

$sql = " insert {$g5['estimate_request']} set
			estimate_idx = '$idx', 
			rc_email = '$email' ";


sql_query($sql);

insert_notify($email, '22', $estimate['title'] . '  문의가 들어왔습니다.', '', $idx, '', 'p2');

/*insert_notify($email, '22', $estimate['title'].' 문의가 들어왔습니다.','',$idx);*/


alert('문의하였습니다.');
