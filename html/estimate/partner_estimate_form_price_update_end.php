<?php
include_once('./_common.php');

$sql = "select * from {$g5['estimate_list']} where idx = '$idx'";
$get_type = sql_fetch($sql);
$price_cha = $price - $price_pe;

$sql = " select * from {$g5['estimate_list']} where idx = '$idx' ";
$estimate = sql_fetch($sql);

$sql = " update {$g5['estimate_list']} set
			state = '5'
		where
			idx = '$idx' ";

sql_query($sql);

$sql = " update {$g5['estimate_propose']} set
		price = '$price',
		price_minus = '$price_pe',
		content = '$content',
		meet = '0',
		price_cha = '$price_cha',
		free = '$chk_free'
	where
		idx = '$sub_idx' and  rc_email = '{$member['mb_email']}'";


sql_query($sql);

$sql = "select * from {$g5['estimate_list']} where idx = '$idx'";
$list = sql_fetch($sql);

insert_notify($list['email'], '11', $list['title'].' 업체 견적이 수정되었습니다.','',$idx, '','cp5');

alert('완료하였습니다.', G5_URL.'/estimate/partner_estimate_form.php?idx='.$idx);

?>