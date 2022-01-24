<?php
	include_once("/var/www/html/bbs/_common.php");
	include_once("/var/www/html/iamport.php");

	$iamport = new Iamport('8390891052477507', 'UGu5oaPfxMkqKruiHY4ru7bSyajamDFgjalIlbYSYjjIKN1rM5Tgd49LesWA5BRpLd87p60oqj7a78CT');
	$imp_uid = 'imp_983814909337';
	$result2 = $iamport->findByImpUID($imp_uid); //IamportResult 를 반환(success, data, error)

	echo var_dump($result2);
	exit();
/*
	$sql = " select * from g5_shop_order where od_shop_memo = 'ready' and od_settle_case = '가상계좌'";
	$result = sql_query($sql);

	$imp_uid = 'imp_765595897239';
	$iamport = new Iamport('8390891052477507', 'UGu5oaPfxMkqKruiHY4ru7bSyajamDFgjalIlbYSYjjIKN1rM5Tgd49LesWA5BRpLd87p60oqj7a78CT');
	$result2 = $iamport->findByImpUID($imp_uid); //IamportResult 를 반환(success, data, error)

	echo var_dump($result2);
	exit();

	while ($row=sql_fetch_array($result)) {
		$imp_uid =  $row['od_tno'];
		echo $row['od_shop_memo'];
		
		

		//imp_uid 로 주문정보 찾기(아임포트에서 생성된 거래고유번호)
		$result2 = $iamport->findByImpUID($imp_uid); //IamportResult 를 반환(success, data, error)

		echo $result2->data->status;

		echo "<br/>";
	}
*/
//	var_dump($sql_ccl);


/*
	$imp_uid = $sql_ccl['od_tno'];;
	$merchant_uid = trim($_REQUEST['merchant_uid']);//아임포트 거래 주문번호(결제시 생성);
	$p_uid = $_REQUEST['p_uid'];//주문번호
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



//	$imp_uid = 'imp_972489069629';
	$iamport = new Iamport('9876714072755529', 'QWujLUaKOTqv5PwN7hmCOAzPUxYqg9I66dpR8zCWt2sySYlZgHC5ibUdJSE02m68AwZI6CEzF68y5tyl');

	//imp_uid 로 주문정보 찾기(아임포트에서 생성된 거래고유번호)
	$result = $iamport->findByImpUID($imp_uid); //IamportResult 를 반환(success, data, error)


	echo $result->data->status;
	echo "<br />";
	echo $result->data->status;

	echo var_dump($result);


	




	exit();
*/

?>