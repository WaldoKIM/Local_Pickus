<?php
include_once('./_common.php');

$sql = " select mb_biz_name from {$g5['member_table']} where mb_name = '$rc_nickname' ";
$rcmember = sql_fetch($sql);

//$rcmember['mb_biz_name'];


$sql = " select name from {$g5['estimate_match']} where no_estimate = '$no_estimate' ";
$estimate = sql_fetch($sql);

$sql = " select * from g5_estimate_match_propose where no_estimate = '$no_estimate' ";
$propose = sql_fetch($sql);

$sql = " select * from {$g5['member_table']} where mb_email = '{$propose['rc_email']}' ";
$user = sql_fetch($sql);

//$sql = " update g5_estimate_match_propose set selected = '1', charge_rate = '{$user['mb_biz_charge_rate']}', charge_amt = round(price/100*{$user['mb_biz_charge_rate']},0) where no_estimate = '$no_estimate' AND rc_nickname = '$rc_nickname'";
//$sql = " update g5_estimate_match_propose set selected = '1', charge_rate = '{$user['mb_biz_charge_rate']}', charge_amt = round(price/100*{$user['mb_biz_charge_rate']},0) where no_estimate = '$no_estimate' AND rc_nickname = '".$rcmember['mb_biz_name']."' ";
$sql = " update g5_estimate_match_propose set selected = '1', charge_rate = '{$user['mb_biz_charge_rate']}', charge_amt = round(price/100*{$user['mb_biz_charge_rate']},0) where no_estimate = '$no_estimate' ";
sql_query($sql);

//$sql = " update g5_estimate_match_propose set requesttime = '$requesttime' where no_estimate = '$no_estimate' AND rc_nickname = '$rc_nickname'";
$sql = " update g5_estimate_match_propose set requesttime = '$requesttime' where no_estimate = '$no_estimate' AND rc_nickname = '".$rcmember['mb_biz_name']."'";
sql_query($sql);

$sql = " update {$g5['estimate_match']} set state = '3' where no_estimate = '$no_estimate' ";
sql_query($sql);

$sql ="select * from {$g5['estimate_match']} where no_estimate = '$no_estimate' ";
$list = sql_fetch($sql);

insert_notify($list['email'], '11', '판매 ' .$propose['rc_nickname'].'가 선택 되었습니다. 업체 결제 요청 받은 후 결제를 진행해 주세요. ','',$no_estimate, '','cm23');

insert_notify($propose['rc_email'], '33', '판매 ' . $list['title'].' 견적 선택 되었습니다.','',$no_estimate, '','p23');

$sql = " 		select
					*
				from
					g5_estimate_match_propose a
					join {$g5['member_table']} b on a.rc_email = b.mb_email
					join g5_estimate_match_propose_detail c on c.no_estimate = a.no_estimate AND c.rc_email = a.rc_email
				where
					a.no_estimate = '$no_estimate'
					and a.selected = '1' ";

$propose_select = sql_fetch($sql);

$price_last = $propose_select['amt0'] + $propose_select['amt1'] + $propose_select['amt2'] + $propose_select['amt3'] + $propose_select['amt4'] + $propose_select['amt5'] + $propose_select['amt6'] + $propose_select['amt7'] + $propose_select['amt8'] + $propose_select['amt9'] + $propose_select['amt10'] + $propose_select['shipping'];

$saletitle = "판매매칭";
kakaotalk_send($user['mb_hp'], 'SJT_059836',  $list['title'].'|'.$estimate['name'].'|'.$saletitle.'|'.$price_last.'원');    //match_propose에 고객이름이 없을 수 있을까봐 estimate에서 받아옴.

alert("선택 완료했습니다. 곧 연락예정입니다.","./my_estimate_form_match_sa.php?no_estimate=$no_estimate");
?>