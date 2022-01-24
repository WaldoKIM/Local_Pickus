<?php 
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

$sql = " select * from {$g5['member_table']} where mb_email = '$email' ";
$mm = sql_fetch($sql);

if($mm){
	if($mm['mb_level'] == 2)
	{
		alert("업체 회원은 접근할 수 없습니다.",G5_URL);
	}
}
$now = date('Y-m-d');
$sql = "update g5_estimate_match set pay_confirm = 1, state = 8, pay_date = '$now' WHERE no_estimate = '$no_estimate' ";
sql_query($sql);


$sql = "select * from g5_estimate_match where no_estimate = '$no_estimate'";
$list = sql_fetch($sql);

$sql = "select * from g5_estimate_match_propose where no_estimate = '$no_estimate'";
$propose = sql_fetch($sql);

$sql = "select * from g5_estimate_match_propose_detail where no_estimate = '$no_estimate'";
$propose_detail = sql_fetch($sql);

if($propose['pro_as'] == "1"){
    $as = "가능";
}else{
    $as = "불가";
}

$list_item = array($propose_detail['item0'], $propose_detail['item1'], $propose_detail['item2'], $propose_detail['item3'], $propose_detail['item4'], $propose_detail['item5'], $propose_detail['item6'], $propose_detail['item7'], $propose_detail['item8'], $propose_detail['item9'], $propose_detail['item10']);
$list_item = array_values(array_filter(array_map('trim',$list_item)));
$list_item = implode( ',', $list_item );

$price_last = $propose_detail['amt0'] + $propose_detail['amt1'] + $propose_detail['amt2'] + $propose_detail['amt3'] + $propose_detail['amt4'] + $propose_detail['amt5'] + $propose_detail['amt6'] + $propose_detail['amt7'] + $propose_detail['amt8'] + $propose_detail['amt9'] + $propose_detail['amt10'] + $propose['shipping'];
kakaotalk_send($list['number'], 'SJT_058642', $list['title'].'|'.$propose['rc_nickname'].'|'.$list_item.'|'.$propose['shipping'].'|'.$as.'|'.$price_last);  //결제완료후 고객에게 날림

insert_notify($list['email'], '8', $propose['rc_nickname'].' 물품이 결제 되었습니다.업체서 고객님게 곧 연락드려 배송이 진행 됩니다.','',$no_estimate, '','cm8'); //고객 노티


$saletitle = "판매매칭";
$sql = "select mb_hp from g5_member where mb_email = '{$propose['rc_email']}'";
$member = sql_fetch($sql);
kakaotalk_send($member['mb_hp'], 'SJT_059837', $list['title'].'|'.$list['name'].'|'.$saletitle.'|'.$price_last);  //결제완료후 업체에게 날림

//insert_notify($list['rc_email'], '4', '(판매) '.$list['title'].' 물품이 결제 되었습니다.업체서 고객님게 곧 연락드려 배송이 진행 됩니다.','',$no_estimate, '','p4'); //고객 노티

insert_notify($propose['rc_email'], '4', '(판매)' . $list['title'].' 결제진행되었습니다.','',$no_estimate, '','p4');

alert('결제가 완료되었습니다.', G5_URL.'/estimate/my_estimate_form_match_sa.php?no_estimate='.$no_estimate);