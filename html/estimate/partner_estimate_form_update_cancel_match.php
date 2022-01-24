<?php
include_once('./_common.php');
include_once($_SERVER['DOCUMENT_ROOT']."/iamport.php");
//error_reporting( E_ALL );
//  ini_set( "display_errors", 1 );

//$test = $_REQUEST;
//echo var_dump($test);


/*------------------------------------------------*/
/*
error_reporting( E_ALL );ini_set( "display_errors", 1 );
$iamport = new Iamport('8390891052477507', 'UGu5oaPfxMkqKruiHY4ru7bSyajamDFgjalIlbYSYjjIKN1rM5Tgd49LesWA5BRpLd87p60oqj7a78CT');

#3. 주문취소
$result = $iamport->cancel(array(
	'imp_uid'		=> 'imp_707958358719', 		//merchant_uid에 우선한다
	'merchant_uid'	=> '1620268855_1620268957652', 	//imp_uid 또는 merchant_uid가 지정되어야 함
	'amount' 		=> '100',//amount가 생략되거나 0이면 전액취소. 금액지정이면 부분취소(PG사 정책별, 결제수단별로 부분취소가 불가능한 경우도 있음)
	'reason'		=> '',				//취소사유
	'refund_holder' => '채영기', 		//이용 중인 PG사에서 가상계좌 환불 기능을 제공하는 경우. 일반적으로 특약 계약이 필요
	'refund_bank'	=> '11',
	'refund_account'=> '3527739542643'
));

echo var_dump($result);
exit();
*/
/*------------------------------------------------*/




$sql = "select * from {$g5['estimate_match']} where no_estimate = '$no_estimate' "; //state 변경전 보내기위해 상단에 위치
$list = sql_fetch($sql);

if($list['state'] == "3"){    //고객이 업체를 선택했고, 업체가 배송을 취소할시. 조건: state=3 물품확인중-견적선택시 고객에게 발송,결제요청전
//        kakaotalk_send($list['number'], 'SJT_058643', $mb_name.'|'.$reason);    //업체서 배송취소
        kakaotalk_send($list['number'], 'SJT_058643', $list['title'].'|'.$reason);    //업체서 배송취소
        
        insert_notify($list['email'], '111', $mb_name .' 물품이 결제가 취소 되었습니다. 다시 물품을 선택해 주세요','',$no_estimate, '','cm10'); //고객 노티
        
        insert_notify($member['mb_email'], '333', $title.' 배송 취소가 되었습니다. ','',$no_estimate, '','p13'); //업체 노티

}
if($list['state'] == "8"){    //고객이 업체를 선택했고, 업체가 배송을 취소할시. 조건: state=8 결제완료 고객에게 발송,결제요청 후
//        kakaotalk_send($list['number'], 'SJT_058643', $mb_name.'|'.$reason);    //업체서 배송취소
        kakaotalk_send($list['number'], 'SJT_058643', $list['title'].'|'.$reason);    //업체서 배송취소
        
        insert_notify($list['email'], '11', $mb_name .' 배송 취소 되었습니다.','',$no_estimate, '','cm10'); //고객 노티
        
        insert_notify($member['mb_email'], '33', $title.' 배송 취소가 되었습니다. ','',$no_estimate, '','p13'); //업체 노티
}

if($rc_email){ // 배송취소
	$sql = " select * from g5_shop_order where od_id =  '$no_estimate' and mb_id = '$email' ";

	$sql_ccl = sql_fetch($sql);

	$iamport = new Iamport('8390891052477507', 'UGu5oaPfxMkqKruiHY4ru7bSyajamDFgjalIlbYSYjjIKN1rM5Tgd49LesWA5BRpLd87p60oqj7a78CT');

	

	#3. 주문취소
	$result = $iamport->cancel(array(
		'imp_uid'		=> $sql_ccl['od_tno'], 		//merchant_uid에 우선한다
		'merchant_uid'	=> $sql_ccl['od_app_no'], 	//imp_uid 또는 merchant_uid가 지정되어야 함
		'amount' 		=> $sql_ccl['od_receipt_price'],//amount가 생략되거나 0이면 전액취소. 금액지정이면 부분취소(PG사 정책별, 결제수단별로 부분취소가 불가능한 경우도 있음)
		'reason'		=> $reason,				//취소사유
		/*
		'refund_holder' => '', 		//이용 중인 PG사에서 가상계좌 환불 기능을 제공하는 경우. 일반적으로 특약 계약이 필요
		'refund_bank'	=> '',
		'refund_account'=> ''
		*/
		
		'refund_holder' => $sql_ccl['od_b_name'], 		//이용 중인 PG사에서 가상계좌 환불 기능을 제공하는 경우. 일반적으로 특약 계약이 필요
		'refund_bank'	=> $sql_ccl['od_deposit_name'],
		'refund_account'=> $sql_ccl['od_addr_jibeon']
	));


	if ( $result->success ) {

		/**
		*	IamportPayment 를 가리킵니다. __get을 통해 API의 Payment Model의 값들을 모두 property처럼 접근할 수 있습니다.
		*	참고 : https://api.iamport.kr/#!/payments/cancelPayment 의 Response Model
		*/
		/*
		$payment_data = $result->data;

		echo '## 취소후 결제정보 출력 ##';
		echo '결제상태 : ' 		. $payment_data->status;
		echo '결제금액 : ' 		. $payment_data->amount;
		echo '취소금액 : ' 		. $payment_data->cancel_amount;
		echo '결제수단 : ' 		. $payment_data->pay_method;
		echo '결제된 카드사명 : ' 	. $payment_data->card_name;
		echo '결제(취소) 매출전표 링크 : '	. $payment_data->receipt_url;
		//등등 __get을 선언해 놓고 있어 API의 Payment Model의 값들을 모두 property처럼 접근할 수 있습니다.
		*/

	} else {
		error_log($result->error['code']);
		error_log($result->error['message']);
	}

	$sql = "update g5_estimate_match_propose set selected = 2, reason = '$reason' where no_estimate = $no_estimate AND rc_email = '$rc_email'";
	sql_query($sql);

	$sql = "insert into g5_match_cancel(no_estimate, title, reason, rc_name, rc_email) VALUES($no_estimate, '$title', '$reason', '$mb_name', '$rc_email')";
	sql_query($sql);

	$sql = "update g5_estimate_match set state = 1 where no_estimate = $no_estimate";
	sql_query($sql);

	$cancel_price = $sql_ccl['od_cancel_price'];
	$cancel_price = $cancel_price + 1;

	$sql = "update g5_shop_order set od_delivery_company = '' where od_id = '$no_estimate' and mb_id = '$email' ";
	sql_query($sql);

	$sql = "update g5_shop_order set od_app_no = '' where od_id = '$no_estimate' and mb_id = '$email' ";
	sql_query($sql);

	$sql = "update g5_shop_order set od_tno = '' where od_id = '$no_estimate' and mb_id = '$email' ";
	sql_query($sql);

	$sql = "update g5_shop_order set od_settle_case = '' where od_id = '$no_estimate' and mb_id = '$email' ";
	sql_query($sql);

	$sql = "update g5_shop_order set od_b_name = '' where od_id = '$no_estimate' and mb_id = '$email' ";
	sql_query($sql);

	$sql = "update g5_shop_order set od_shop_memo = '' where od_id = '$no_estimate' and mb_id = '$email' ";
	sql_query($sql);

	$sql = "update g5_shop_order set od_addr_jibeon = '' where od_id = '$no_estimate' and mb_id = '$email' ";
	sql_query($sql);

	$sql = "update g5_shop_order set od_deposit_name = '' where od_id = '$no_estimate' and mb_id = '$email' ";
	sql_query($sql);

	$sql = "update g5_shop_order set od_cash_no = '' where od_id = '$no_estimate' and mb_id = '$email' ";
	sql_query($sql);

	$sql = "update g5_shop_order set od_cash_info = '' where od_id = '$no_estimate' and mb_id = '$email' ";
	sql_query($sql);

	$sql = "update g5_shop_order set od_cancel_price = '$cancel_price' where od_id = '$no_estimate' and mb_id = '$email' ";
	sql_query($sql);

	$sql = "update g5_shop_order set od_status = '취소' where od_id = '$no_estimate' and mb_id = '$email' ";
	sql_query($sql);

	$sql = "update g5_estimate_match set pay_confirm = '0' where no_estimate = '$no_estimate' and email = '$email' ";
	sql_query($sql);

	$sql = "update g5_estimate_match set req_payment = '0' where no_estimate = '$no_estimate' and email = '$email' ";
	sql_query($sql);

}else{ // 견적취소
	$sql = " delete from g5_estimate_match_propose where no_estimate = '$no_estimate' and rc_email = '{$member['mb_email']}'";
	sql_query($sql);

	$sql = " delete from g5_estimate_match_propose_detail where no_estimate = '$no_estimate' and rc_email = '{$member['mb_email']}' ";
	sql_query($sql);

	$sql = " delete from g5_estimate_list_photo_match where no_estimate = '$no_estimate' and rc_email = '{$member['mb_email']}' ";
	sql_query($sql);

}


alert('취소하였습니다.', G5_URL.'/estimate/partner_estimate_list.php?gubun=4');

?>