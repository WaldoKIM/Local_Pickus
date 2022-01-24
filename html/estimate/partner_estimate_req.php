<?php
include_once('./_common.php');


$sql = " update {$g5['estimate_match']} set
			req_payment = 1,
			state = 9
		where
			no_estimate = '$no_estimate'";

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

kakaotalk_send($list['number'], 'SJT_058641', $list['title'].'|'.$propose['rc_nickname'].'|'.$list_item.'|'.$propose['shipping'].'|'.$as.'|'.$price_last);

insert_notify($list['email'], '7', $propose['rc_nickname'].' 물품을 결제 요청해 주셨습니다.','',$no_estimate, '','cm7'); //고객 노티

alert('결제를 요청하였습니다.', G5_URL.'/estimate/partner_estimate_match_form.php?no_estimate='.$no_estimate);

?>