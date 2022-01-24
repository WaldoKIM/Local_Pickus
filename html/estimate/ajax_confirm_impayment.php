<?php
include_once("../_common.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/iamport.php");

$imp_uid = trim($_REQUEST['imp_uid']); //아임포트 거래 고유번호(결제시 생성);ㅇ
$merchant_uid = trim($_REQUEST['merchant_uid']); //아임포트 거래 주문번호(결제시 생성);ㅇ
$p_uid = $_REQUEST['p_uid']; //주문번호ㅇ
$amount = (int)$_REQUEST['amount']; //결제된 금액ㅇ
$p_name = $_REQUEST['p_name']; //주문명(상품명)ㅇ
$uname = $_REQUEST['uname']; //주문자ㅇ
$uemail = $_REQUEST['uemail']; //주문자 이메일ㅇ
$umobile = $_REQUEST['umobile']; //주문자 연락처(핸드폰 번호)ㅇ
//$uaddr = $_REQUEST['uaddr'];//주문자 주소(배송주소)
$apply_num = $_REQUEST['apply_num']; //카드승인번호x
$items_count = $_REQUEST['items_count']; //물건 수량
$company = $_REQUEST['company']; //업체

$mobile = $_REQUEST['mobile']; //모바일인지 웹인지 구분자
$no_estimate = $_REQUEST['no_estimate']; //모바일주문번호
$imp_success = $_REQUEST['imp_success']; //모바일상태


if ($imp_success == 'false') {
	echo ("<script>document.location.href='https://repickus.com/market/main/order_trade_end.php?CACHE=1'</script>");
}

$iamport = new Iamport('8390891052477507', 'UGu5oaPfxMkqKruiHY4ru7bSyajamDFgjalIlbYSYjjIKN1rM5Tgd49LesWA5BRpLd87p60oqj7a78CT');

//imp_uid 로 주문정보 찾기(아임포트에서 생성된 거래고유번호)
$result = $iamport->findByImpUID($imp_uid); //IamportResult 를 반환(success, data, error)

$merchant_uid = $result->data->merchant_uid; //모바일 전용(카드사 거래 주문번호)
$vbank_status = $result->data->pay_method; //가상계좌인지 카드인지에 대한 구분자(모바일 대응)
$apply_num = $result->data->apply_num; //모바일 전용(카드사 승인번호)

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


	if ($payment_data->status === "paid" && $payment_data->amount === $amount) {
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



		$ret = true;
		$msg = "결제 완료";
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
echo (json_encode($arr));
//exit();
