<?php
	include_once("./_common.php");
	include_once($_SERVER['DOCUMENT_ROOT']."/iamport.php");

	
	$p_uid = $_REQUEST['p_uid'];//주문번호
	$uemail = $_REQUEST['uemail'];//아이디(이메일)
	$vbank_name = $_REQUEST['vbank_name'];//환불은행
	$refund_account = $_REQUEST['refund_account'];//환불계좌
	$refund_name = $_REQUEST['refund_name'];//환불이름

	$refund_account_digits = $refund_account.length;

	//환불계좌
	if(empty($refund_account)){
		$ret = false;
		$msg = '환불계좌를 입력해주세요.';
	}else{
		/*기업은행:03, 수협은행:07, NH농협은행:11, 우리은행:20, SC제일은행:23, 대구은행:31, 부산은행:32, 광주은행:34, 
		전북은행:37, 경남은행:39, 한국씨티은행:53, 우체국:71, 하나은행:81, 신한은행:88, 케이뱅크:89*/

		$sql_match = "update g5_shop_order set od_deposit_name = '$vbank_name' where od_id = '$p_uid' and mb_id = '$uemail' ";
				
		sql_query($sql_match);

		$sql_match = "update g5_shop_order set od_addr_jibeon = '$refund_account' where od_id = '$p_uid' and mb_id = '$uemail' ";
					
		sql_query($sql_match);

		$sql_match = "update g5_shop_order set od_b_name = '$refund_name' where od_id = '$p_uid' and mb_id = '$uemail' ";
					
		sql_query($sql_match);

		$sql_match = "update g5_shop_order set od_shop_memo = 'ready' where od_id = '$p_uid' and mb_id = '$uemail' ";
					
		sql_query($sql_match);


		$sql_match = "update g5_estimate_match set pay_confirm = '3' where no_estimate = '$p_uid' and email = '$uemail' ";
					
		sql_query($sql_match);



		$ret = true;
		$msg = '환불계좌가 등록되었습니다.';
	}

	$arr = array(
		"ret" => $ret,
		"msg" => $msg,
		"code" => $result->error['code'],
		"message" => $result->error['message'],
	);

	echo(json_encode($arr));
	exit();
?>