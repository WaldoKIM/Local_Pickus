<?php
	include_once("./_common.php");
	include_once($_SERVER['DOCUMENT_ROOT']."/iamport.php");


	$imp_uid = trim($_REQUEST['imp_uid']);//아임포트 거래 고유번호(결제시 생성);ㅇ
	$merchant_uid = trim($_REQUEST['merchant_uid']);//아임포트 거래 주문번호(결제시 생성);x
	$p_uid = $_REQUEST['p_uid'];//주문번호x
	$amount = (int)$_REQUEST['amount'];//결제된 금액
	$p_name = $_REQUEST['p_name'];//주문명(상품명)
	$uname = $_REQUEST['uname'];//주문자
	$uemail = $_REQUEST['uemail'];//주문자 이메일
	$umobile = $_REQUEST['umobile'];//주문자 연락처(핸드폰 번호)
	//$uaddr = $_REQUEST['uaddr'];//주문자 주소(배송주소)
	//$apply_num = $_REQUEST['apply_num'];//카드승인번호
	$vbank_name = $_REQUEST['vbank_name'];//가상계좌 은행
	$vbank_num = $_REQUEST['vbank_num'];//가상계좌번호
	$items_count = $_REQUEST['items_count'];//물건 수량
	$company = $_REQUEST['company'];//업체

	$mobile = $_REQUEST['mobile'];//모바일인지 웹인지 구분자
	$no_estimate = $_REQUEST['no_estimate'];//모바일주문번호
	$imp_success = $_REQUEST['imp_success'];//모바일상태

	if($imp_success == 'false'){
		echo("<script>document.location.href='https://repickus.com/estimate/my_estimate_form_match_sa.php?no_estimate=$no_estimate'</script>"); 
	}

	$iamport = new Iamport('8390891052477507', 'UGu5oaPfxMkqKruiHY4ru7bSyajamDFgjalIlbYSYjjIKN1rM5Tgd49LesWA5BRpLd87p60oqj7a78CT');

	//imp_uid 로 주문정보 찾기(아임포트에서 생성된 거래고유번호)
	$result = $iamport->findByImpUID($imp_uid); //IamportResult 를 반환(success, data, error)

	
	//$vbank_status = $result->data->pay_method;//가상계좌인지 카드인지에 대한 구분자(모바일 대응)
	//$apply_num = $result->data->apply_num;//모바일 전용(카드사 승인번호)

	if($mobile == 'yes'){
		$vbank_name = $result->data->vbank_name;//모바일 전용(가상계좌 은행)
		$vbank_num = $result->data->vbank_num;//모바일 전용(가상계좌번호)
		$merchant_uid = $result->data->merchant_uid;//모바일 전용(카드사 거래 주문번호)
	}
	

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


		if ( $payment_data->status === "ready" && $payment_data->amount === $amount ) {

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

/*
			switch ($vbank_name) {
				case '기업은행':
					$vbank_name = '03';
					break;
				case '수협중앙회':
					$vbank_name = '07';
					break;
				case '농협중앙회':
					$vbank_name = '11';
					break;
				case '우리은행':
					$vbank_name = '20';
					break;
				case 'SC 제일은행':
					$vbank_name = '23';
					break;
				case '대구은행':
					$vbank_name = '31';
					break;
				case '부산은행':
					$vbank_name = '32';
					break;
				case '광주은행':
					$vbank_name = '34';
					break;
				case '전북은행':
					$vbank_name = '37';
					break;
				case '경남은행':
					$vbank_name = '39';
					break;
				case '한국씨티은행 (한미은행)':
					$vbank_name = '53';
					break;
				case '우체국':
					$vbank_name = '71';
					break;
				case '하나은행':
					$vbank_name = '81';
					break;
				case '신한(조흥)은행':
					$vbank_name = '88';
					break;
				case '케이뱅크':
					$vbank_name = '89';
					break;
			}
*/

			//$card_company = $payment_data->card_name;//카드사

			$time = date("Y-m-d H:i:s");//현재시간

			$sql = " select * from g5_shop_order where od_id =  '$p_uid' and mb_id = '$uemail' ";

			$sql_ccl = sql_fetch($sql);

			$id_test = $sql_ccl['od_id'];

			if($id_test == null){
				$sql_match = "insert into g5_shop_order (od_id, mb_id, od_name, od_tel, od_email, od_status, od_time, od_invoice, od_receipt_price, od_cart_count, od_delivery_company, od_cash_info, od_cash_no, od_tno, od_app_no, od_settle_case, od_misu) value('$p_uid','$uemail','$uname','$umobile','$uemail','입금','$time','$p_name','$amount','$items_count','$company', '$vbank_name', '$vbank_num','$imp_uid','$merchant_uid', '가상계좌', '$amount')";

				sql_query($sql_match);

				$sql_match = "update g5_estimate_match set pay_confirm = '2' where no_estimate = '$p_uid' and email = '$uemail' ";
				
				sql_query($sql_match);

			}else{
				$sql_match = "update g5_shop_order set od_delivery_company = '$company' where od_id = '$p_uid' and mb_id = '$uemail' ";
				
				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_receipt_price = '$amount' where od_id = '$p_uid' and mb_id = '$uemail' ";
				
				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_misu = '$amount' where od_id = '$p_uid' and mb_id = '$uemail' ";
				
				sql_query($sql_match);

				$sql_match = "update g5_estimate_match set pay_confirm = '2' where no_estimate = '$p_uid' and email = '$uemail' ";
				
				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_settle_case = '가상계좌' where od_id = '$p_uid' and mb_id = '$uemail' ";
				
				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_time = '$time' where od_id = '$p_uid' and mb_id = '$uemail' ";
				
				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_status = '입금' where od_id = '$p_uid' and mb_id = '$uemail' ";

				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_cash_info = '$vbank_name' where od_id = '$p_uid' and mb_id = '$uemail' ";

				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_cash_no = '$vbank_num' where od_id = '$p_uid' and mb_id = '$uemail' ";

				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_tno = '$imp_uid' where od_id = '$p_uid' and mb_id = '$uemail' ";

				sql_query($sql_match);

				$sql_match = "update g5_shop_order set od_app_no = '$merchant_uid' where od_id = '$p_uid' and mb_id = '$uemail' ";

				sql_query($sql_match);
			}

			$ret = true;
			$msg = "가상계좌가 생성되었습니다.";

			$title = $sql_ccl['od_invoice'];

			if($mobile == 'yes'){
				echo("<script>document.location.href='https://repickus.com/estimate/my_estimate_form_match_sa.php?no_estimate=$no_estimate'</script>");
			}

			//insert_notify($uemail, '11', $title.' 견적신청이 되었습니다.','',$p_uid, '','vc1');

		}else if($payment_data->status === "ready" && $payment_data->amount !== $amount){
			$ret = true;
			$msg = "실결제 금액 불일치";
		}else{
			$ret = false;
			$msg = "결제 확인 요망(결제는 진행하였습니다.)";
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
	exit();
?>