<?php
include_once('./_common.php');

$sql = " select * from {$g5['estimate_match']} where no_estimate = '$no_estimate' ";
$estimate = sql_fetch($sql);

$sql = " insert g5_estimate_request_match set
			no_estimate = '$no_estimate', 
			rc_email = '$email' ";


sql_query($sql);

insert_notify($email, '22', $estimate['title'] . '  문의가 들어왔습니다.', '', $idx, '', 'p2');
// /*insert_notify($email, '11', $title.'  문의가 들어왔습니다.','',$no_estimate, '','cp1');*/

alert('문의하였습니다.', G5_URL . '/estimate/my_estimate_form_match_sa.php?select_gubun=2&&no_estimate=' . $no_estimate);
