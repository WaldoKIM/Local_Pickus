<?php
include_once('./_common.php');

if($rc_email){ // 수거취소

	$sql = "update {$g5['estimate_propose']} set selected = 2, reason = '$reason' where estimate_idx = $idx AND rc_email = '$rc_email'";
	sql_query($sql);
	$sql = "insert into g5_cancel(estimate_idx, title, reason, rc_name, rc_email) VALUES($idx, '$title', '$reason', '$mb_name', '$rc_email')";
	sql_query($sql);
	
	$sql = "select * from {$g5['estimate_list']} where idx = '$idx'";
	$list = sql_fetch($sql);

	if($list['e_type'] == '0' || $list['e_type'] == '1'){
		insert_notify($list['email'], '11', $title.' 수거 취소 되었습니다. 다시 업체를 선택해 주세요. ','',$idx, '','cp10');
		insert_notify($rc_email, '22', $title.' 수거 취소가 되었습니다. ','',$idx, '','p11');	
	}else{ // 철거
		insert_notify($list['email'], '11', $title.' 철거 취소 되었습니다. 다시 업체를 선택해 주세요. ','',$idx, '','cp10');
		insert_notify($rc_email, '22', $title.' 철거 취소가 되었습니다. ','',$idx, '','p11');
	}
	
	kakaotalk_send($list['phone'], 'SJT_058801',  $title .'|'. $reason);    //알림톡미 업체견적 취소. 고객에게 발송

}else{ 
	$sql = " delete from {$g5['estimate_propose']} where idx = '$sub_idx' ";
	sql_query($sql);

	$sql = " delete from {$g5['estimate_propose_detail']} where estimate_idx = '$idx' and rc_email = '{$member['mb_email']}' ";
	sql_query($sql);	
}

$sql = "update g5_estimate_list set state = 1 where idx = $idx";
sql_query($sql);

alert('취소하였습니다.', G5_URL.'/estimate/partner_estimate_list.php');
?>