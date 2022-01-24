<?php
include_once('./_common.php');
$sql = " select * from {$g5['estimate_match']} where no_estimate = '$no_estimate' ";
$estimate = sql_fetch($sql);

$sql = " update {$g5['estimate_match']} set
			state = '$state'
		where
			no_estimate = '$no_estimate' ";

sql_query($sql);

//$sql = "select * from g5_estimate_match_propose where no_estimate = '$no_estimate' AND completetime IS NOT NULL"; 
$sql = "select * from g5_estimate_match_propose where no_estimate = '$no_estimate' ";
$fetch = sql_fetch($sql);

insert_notify($estimate['email'], '11', $fetch['rc_nickname'].' 배송 완료 되었습니다. 업체가 어땠는지 후기작성해 주세요.','',$estimate['no_estimate'], '','cm9');

kakaotalk_send($estimate['number'], 'SJT_059835', $fetch['rc_nickname'] );   //업체서 배송완료시 고객에게

alert('완료하였습니다.', G5_URL.'/estimate/partner_estimate_match_form.php?no_estimate='.$no_estimate);

?>