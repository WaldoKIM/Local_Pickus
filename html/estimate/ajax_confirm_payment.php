<?php
	include_once("./_common.php");
	include_once($_SERVER['DOCUMENT_ROOT']."/iamport.php");

	$imp_uid = trim($_REQUEST['imp_uid']);//아임포트 거래 고유번호(결제시 생성);ㅇ
	$merchant_uid = trim($_REQUEST['merchant_uid']);//아임포트 거래 주문번호(결제시 생성);ㅇ
	$p_uid = $_REQUEST['p_uid'];//주문번호ㅇ
	$amount = (int)$_REQUEST['amount'];//결제된 금액ㅇ
	$p_name = $_REQUEST['p_name'];//주문명(상품명)ㅇ
	$uname = $_REQUEST['uname'];//주문자ㅇ
	$uemail = $_REQUEST['uemail'];//주문자 이메일ㅇ
	$umobile = $_REQUEST['umobile'];//주문자 연락처(핸드폰 번호)ㅇ
	//$uaddr = $_REQUEST['uaddr'];//주문자 주소(배송주소)
	$apply_num = $_REQUEST['apply_num'];//카드승인번호x
	$items_count = $_REQUEST['items_count'];//물건 수량
	$company = $_REQUEST['company'];//업체

	$mobile = $_REQUEST['mobile'];//모바일인지 웹인지 구분자
	$no_estimate = $_REQUEST['no_estimate'];//모바일주문번호
	$imp_success = $_REQUEST['imp_success'];//모바일상태

//	echo var_dump($_REQUEST).'<br>';

//	echo var_dump($imp_success).'<br>';
//	echo var_dump($no_estimate).'<br>';

	if($imp_success == 'false'){
		echo("<script>document.location.href='https://repickus.com/estimate/my_estimate_form_match_sa.php?no_estimate=$no_estimate'</script>"); 
	}

	$iamport = new Iamport('8390891052477507', 'UGu5oaPfxMkqKruiHY4ru7bSyajamDFgjalIlbYSYjjIKN1rM5Tgd49LesWA5BRpLd87p60oqj7a78CT');

	//imp_uid 로 주문정보 찾기(아임포트에서 생성된 거래고유번호)
	$result = $iamport->findByImpUID($imp_uid); //IamportResult 를 반환(success, data, error)
	
	$merchant_uid = $result->data->merchant_uid;//모바일 전용(카드사 거래 주문번호)
	$vbank_status = $result->data->pay_method;//가상계좌인지 카드인지에 대한 구분자(모바일 대응)
	$apply_num = $result->data->apply_num;//모바일 전용(카드사 승인번호)

//	echo var_dump($result).'<br>';
//	echo var_dump($result->data->pay_method);
//	exit();
	if ($result->success) {
		/**
		*	IamportPayment 를 가리킵니다. __get을 통해 API의 Payment Model의 값들을 모두 property처럼 접근할 수 있습니다.
		*	참고 : https://api.iamport.kr/#!/payments/getPaymentByImpUid 의 Response Model
		*/
		$payment_data = $result->data;

		/*
		echo '## 결제정보 출력 ##';
		echo '가맹점 주문번호 : ' 	. $payment_data->merchant_uid;
		echo '결제상태 : ' 		. $payment_data->status;
		echo '결제금액 : ' 		. $payment_data->amount;
		echo '결제수단 : ' 		. $payment_data->pay_method;
		echo '결제된 카드사명 : ' 	. $payment_data->card_name;
		echo '결제 매출전표 링크 : '	. $payment_data->receipt_url;
		*/

		/**
		*	IMP.request_pay({
		*		custom_data : {my_key : value}
		*	});
		*	와 같이 custom_data를 결제 건에 대해서 지정하였을 때 정보를 추출할 수 있습니다.(서버에는 json encoded형태로 저장합니다)
		*/

		/*
		echo 'Custom Data :'	. $payment_data->getCustomData('my_key');
		*/

		# 내부적으로 결제완료 처리하시기 위해서는 (1) 결제완료 여부 (2) 금액이 일치하는지 확인을 해주셔야 합니다.
		//$amount;


		if ( $payment_data->status === "paid" && $payment_data->amount === $amount ) {
			//TODO : 결제성공 처리
			/*
			//가맹점 서버에 주문 내역 저장
			$item->od_pg = $imp_uid;//고유번호
			$item->od_id = $payment_data->merchant_uid;//주문번호
			$item->od_invoice = $p_name;//제목
			$item->od_receopt_price = $payment_data->amount;//금액
			$item->od_name = $uname;//주문자
			$item->mb_id = $uemail;//아이디
			$item->od_tel = $umobile;//전화번호
			//$item->uaddr = $uaddr;
			
			$item->o_state = '완료';//결재상태
			$item->od_cash_info = $payment_data->card_name;//카드사
			$item->od_cash_no = $apply_num;//카드번호

			$db->insertArr($item, "g5_shop_order", true);
			*/

		
			$card_company = $payment_data->card_name;//카드사

			$time = date("Y-m-d H:i:s");//현재시간

			$sql = " select * from g5_shop_order where od_id =  '$p_uid' and mb_id = '$uemail' ";

			$sql_ccl = sql_fetch($sql);

			$id_test = $sql_ccl['od_id'];

			if($id_test == null){
				$sql_match = "insert into g5_shop_order (od_id, mb_id, od_name, od_tel, od_email, od_status, od_time, od_invoice, od_receipt_price, od_cart_count, od_delivery_company, od_cash_info, od_cash_no, od_tno, od_app_no, od_settle_case) value('$p_uid','$uemail','$uname','$umobile','$uemail','완료','$time','$p_name','$amount','$items_count','$company', '$card_company', '$apply_num','$imp_uid','$merchant_uid' ,'신용카드')";

				sql_query($sql_match);
			}else{
				$sql_match = "update g5_shop_order set od_settle_case = '신용카드' where od_id = '$p_uid' and mb_id = '$uemail' ";
				
				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_delivery_company = '$company' where od_id = '$p_uid' and mb_id = '$uemail' ";
				
				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_receipt_price = '$amount' where od_id = '$p_uid' and mb_id = '$uemail' ";
				
				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_time = '$time' where od_id = '$p_uid' and mb_id = '$uemail' ";
				
				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_status = '완료' where od_id = '$p_uid' and mb_id = '$uemail' ";

				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_cash_info = '$card_company' where od_id = '$p_uid' and mb_id = '$uemail' ";

				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_cash_no = '$apply_num' where od_id = '$p_uid' and mb_id = '$uemail' ";

				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_tno = '$imp_uid' where od_id = '$p_uid' and mb_id = '$uemail' ";

				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_app_no = '$merchant_uid' where od_id = '$p_uid' and mb_id = '$uemail' ";

				sql_query($sql_match);
			}

			if($mobile == 'yes'){
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

				echo("<script>document.location.href='https://repickus.com/estimate/my_estimate_form_match_sa.php?no_estimate=$no_estimate'</script>");
			}

			$ret = true;
			$msg = "결제 완료";
			

		}else if($payment_data->status === "paid" && $payment_data->amount !== $amount){
			$ret = true;
			$msg = "실결제 금액 불일치";
			
		}
	} else {
		$ret = false;
		$msg = "iamport 서버에서 정상적인 정보를 받아오지 못함";
		
		/*
		error_log($result->error['code']);
		error_log($result->error['message']);
		*/
	}

	$arr = array(
		"ret" => $ret,
		"msg" => $msg,
		"code" => $result->error['code'],
		"message" => $result->error['message'],
	);
	echo(json_encode($arr));
	//exit();
?>