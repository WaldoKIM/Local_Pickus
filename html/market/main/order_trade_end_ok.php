<? include('./include/head.inc.php');?>
<? include ('../class.sms.php');?>
<?
$res_cd = $_POST['res_cd'];

$smsinfo = $db->object("cs_sms_setup", "");
$sms_server	= "211.172.232.124";	## SMS 서버
$sms_id		= $smsinfo->smsid;				## icode 아이디
$sms_pw		= $smsinfo->smspw;				## icode 패스워드
$portcode	= 1;				## 정액제 : 2, 충전식 : 1

$SMS	= new SMS;
$SMS->SMS_con($sms_server,$sms_id,$sms_pw,$portcode);

include($ROOT_DIR.'/lib/mail_class.php');

//KCP 파라미터값 받아오기
include('../payplus/kcp_value.inc.php');
// 카드결제후 돌아 오는 테이타를 TRADE_CODE 데이타로 변경하여 정보처리한다.
if($res_cd=="0000") {
	$_POST[TRADE_CODE]=$_POST[ordr_idxx];
	if($_GET[tno]){ $tno = $_GET[tno]; } else if($_POST[tno]){ $tno = $_POST[tno]; }
}
if(!$_POST[TRADE_CODE]) { $tools->alertJavaGo('결제 오류 입니다.\n\n처음부터 다시 주문하세요\\n오류코드 : '.$res_cd, 'cart.php');}

// 구매 상품 입력
$cnt1=$db->cnt("cs_trade_tmp", "where item=0 and code is not null and code='$_POST[TRADE_CODE]'");
if($cnt1){
	$trade1_result=$db->select("cs_trade_tmp", "where item=0 and code is not null and code='$_POST[TRADE_CODE]' order by idx asc");
	while($trade1_row=@mysqli_fetch_object($trade1_result)) {
		$trade1_data	= $tools->decode( $trade1_row->data );
		$trade1_data[goods_name]=$db->addSlash(urldecode($trade1_data[goods_name]));
		$db->insert("cs_trade_goods", "trade_code='$trade1_data[trade_code]', part_idx='$trade1_data[part_idx]', goods_idx='$trade1_data[goods_idx]', goods_code='$trade1_data[goods_code]', goods_name='$trade1_data[goods_name]', goods_price='$trade1_data[goods_price]', trade_price='$trade1_data[trade_price]',  goods_cnt='$trade1_data[goods_cnt]', goods_point='$trade1_data[goods_point]', opt_data='$trade1_data[opt_data]', seller='$trade1_data[seller]', order_userid='$trade1_data[order_userid]', order_name='$trade1_data[order_name]', trade_deliv_price='$trade1_data[deliv_fee]', trade_day=now()");

		// 주문한 상품에서 수량을 삭제
		$goods_stat =$db->object("cs_goods", "where idx='$trade1_data[goods_idx]'");
		if($goods_stat->unlimit!=1) {
			$number=$goods_stat->number - $trade1_data[goods_cnt];
			$db->update("cs_goods", "number=$number where idx='$trade1_data[goods_idx]'");
		}

		//상품의 재구매처리가안되게 결과물 아이템변경
		$db->update("cs_trade_tmp", "item=5 where item=0 and code is not null and code='$_POST[TRADE_CODE]'");
	}
}

$cnt2=$db->cnt("cs_trade_tmp", "where item=1 and code is not null and code='$_POST[TRADE_CODE]'");
if($cnt2){
	$trade2_data_stat = $db->object("cs_trade_tmp", "where item=1 and code is not null and code='$_POST[TRADE_CODE]'");
	$trade2_data	= $tools->decode( $trade2_data_stat->data );
	$db->insert("cs_trade", "trade_code='$trade2_data[trade_code]', order_userid='$trade2_data[order_userid]', order_name='$trade2_data[order_name]', order_email='$trade2_data[order_email]', order_tel1='$trade2_data[order_tel1]', order_tel2='$trade2_data[order_tel2]', order_tel3='$trade2_data[order_tel3]', deliv_name='$trade2_data[deliv_name]', deliv_email='$trade2_data[deliv_email]', deliv_tel1='$trade2_data[deliv_tel1]', deliv_tel2='$trade2_data[deliv_tel2]', deliv_tel3='$trade2_data[deliv_tel3]', deliv_phone1='$trade2_data[deliv_phone1]', deliv_phone2='$trade2_data[deliv_phone2]', deliv_phone3='$trade2_data[deliv_phone3]', deliv_zip='$trade2_data[deliv_zip]', deliv_add1='$trade2_data[deliv_add1]', deliv_add2='$trade2_data[deliv_add2]', deliv_content='$trade2_data[deliv_content]', deliv_pree_day='$trade2_data[deliv_pree_day]',tno = '$tno',cartinfo = '$trade2_data[cartinfo]'");
	
	//상품의 재구매처리가안되게 결과물 아이템변경
	$db->update("cs_trade_tmp", "item=6 where item=1 and code is not null and code='$_POST[TRADE_CODE]'");
}else{
	$trade2_data_stat = $db->object("cs_trade_tmp", "where item=6 and code is not null and code='$_POST[TRADE_CODE]'");
	$trade2_data	= $tools->decode( $trade2_data_stat->data );
}
// 결제 정보 입력
$cnt3=$db->cnt("cs_trade_tmp", "where item=2 and code is not null and code='$_POST[TRADE_CODE]'");
if($cnt3){
	$trade3_data_stat = $db->object("cs_trade_tmp", "where item=2 and code is not null and code='$_POST[TRADE_CODE]'");
	$trade3_data	= $tools->decode( $trade3_data_stat->data );
	
	
	if ( $trade3_data[trade_method] == 4){
		$trade_method_info = $depositor.":".$bankname." [".$account."]";
	}else{
		$trade_method_info = $trade3_data[trade_method_info];
	}	
	
	$db->update("cs_trade", "trade_code='$trade3_data[trade_code]', trade_total_price='$trade3_data[trade_total_price]', trade_price='$trade3_data[trade_price]', trade_use_point='$trade3_data[trade_use_point]', trade_save_point='$trade3_data[trade_save_point]', trade_member_dc='$trade3_data[trade_member_dc]', trade_deliv_price='$trade3_data[trade_deliv_price]', trade_method='$trade3_data[trade_method]', trade_method_info='$trade_method_info', trade_day=now(), trade_stat=1 where trade_code='$trade2_data[trade_code]'");
	
	// 사용한 포인트를 삭제 사용포인트가 있을때만 이용
	if($trade3_data[trade_use_point] !=0 && $trade2_data[order_userid]) {
		$title="상품구입사용 거래번호 : ".$_POST[TRADE_CODE];
		$db->insert("cs_point", "userid='$trade2_data[order_userid]', title='$title', point='-$trade3_data[trade_use_point]', register=now()");
	}
	
	//상품의 재구매처리가안되게 결과물 아이템변경
	$db->update("cs_trade_tmp", "item=7 where item=2 and code is not null and code='$_POST[TRADE_CODE]'");
}else{
	$trade3_data_stat = $db->object("cs_trade_tmp", "where item=7 and code is not null and code='$_POST[TRADE_CODE]'");
	$trade3_data	= $tools->decode( $trade3_data_stat->data );
}
// !!!무통장의 경우는 아무것도 안해도 됨.(위에서 입력 다되었슴)
if( $trade3_data[trade_method] == 5) {
	##########################주문 메일 보내기##########################
	//결제 정보출력시 숫자 변수를 문자로 치완한다.

	// 관리자 정보
	$admin_stat=$db->object("cs_admin", "");
	// 메일폼 정보
	$mailform1_stat	=	$db->object("cs_mailform", "where item=2");
	$mailform2_stat	=	$db->object("cs_mailform", "where item=6");
	// 회원 정보
	if($admin_stat->order_member) {
		$mail = new my_mime_mail();
		$content=$mailform1_stat->content;
		// 상품주문 대한 치완
		$content = str_replace("__ORDER_NAME__", $trade2_data[order_name], $content);
		$content = str_replace("__TRADE_CODE__", $_POST[TRADE_CODE], $content);
		$content = str_replace("__TRADE_METHOD__", "무통장입금", $content);
		$content = str_replace("__TRADE_METHOD_INFO__", $trade3_data[trade_method_info], $content);
		$content = str_replace("__TRADE_PRICE__", $trade3_data[trade_price], $content);
		$content = str_replace("__TRADE_DAY__", date("Y-m-d H:i", time()), $content);
		//		$content = str_replace("__TRADE_MONEY_OK__", "결제일", $content);
		//		$content = str_replace("__TRADE_COMPANY__", $admin_stat->delivery_company, $content);
		//		$content = str_replace("__TRADE_NUMBER__","배송번호", $content);
		$content = str_replace("__DELIV_NAME__", $trade2_data[deliv_name], $content);
		$content = str_replace("__DELIV_TEL__", $trade2_data[deliv_tel1]."".$trade2_data[deliv_tel2]."".$trade2_data[deliv_tel3], $content);
		$content = str_replace("__DELIV_ADDRESS__", "(".$trade2_data[deliv_zip1]."-".$trade2_data[deliv_zip2].")&nbsp;".$trade2_data[deliv_add1]."&nbsp;".$trade2_data[deliv_add2], $content);

		$result=$db->select("cs_trade_goods", "where trade_code='$_POST[TRADE_CODE]'");
		while( $row=@mysqli_fetch_object( $result)) {
		$order_member_goods.="상품명 :".$row->goods_name.", 가격 :".number_format($row->goods_price)."원, 수량 :".$row->goods_cnt."개<br>";
		}
		$content = str_replace("__ORDER_GOODS__", $order_member_goods, $content);

		// 쇼핑몰 기본 정보 대한 치완
		$content = str_replace("__SHOP_NAME__", $admin_stat->shop_name, $content);
		$content = str_replace("__SHOP_DOMAIN__", $admin_stat->shop_domain, $content);
		$content = str_replace("__SHOP_CEO__", $admin_stat->shop_ceo, $content);
		$content = str_replace("__SHOP_TEL__", $admin_stat->shop_tel1, $content);
		$content = str_replace("__SHOP_EMAIL__", $admin_stat->shop_email, $content);
		$content = str_replace("__SHOP_ADDRESS__", $admin_stat->shop_address, $content);
		$content = str_replace("__MAILFORM_IMAGES_URL__",$admin_stat->shop_url, $content);

		// 제목에 대한 치완
		$title= $mailform1_stat->title;
		$title = str_replace("__SHOP_NAME__", $admin_stat->shop_name, $title);
		$title = str_replace("__ORDER_NAME__", $trade2_data[order_name], $title);

		// 상품 주문메일
		$mail->to = $trade2_data[order_email];
		$mail->from = $admin_stat->shop_email;
		$mail->subject = $title;
		$mail->body = $content;
		if(!$mail->send()) { $tools->msg('주문 내역을 메일으로 보내지 못했습니다.\n\n로그인 하셔서 주문 정보를 확인해 보세요');}
	}
	// 관리자에게 메일 보내기
	if($admin_stat->order_admin) {
		$mail = new my_mime_mail();
		$content=$mailform2_stat->content;
		// 상품주문 대한 치완
		$content = str_replace("__ORDER_NAME__", $trade2_data[order_name], $content);
		$content = str_replace("__TRADE_CODE__", $_POST[TRADE_CODE], $content);
		$content = str_replace("__TRADE_METHOD__", "무통장입금", $content);
		$content = str_replace("__TRADE_METHOD_INFO__", $trade3_data[trade_method_info], $content);
		$content = str_replace("__TRADE_PRICE__", $trade3_data[trade_price], $content);
		$content = str_replace("__TRADE_DAY__", date("Y-m-d H:i", time()), $content);
		//		$content = str_replace("__TRADE_MONEY_OK__", "결제일", $content);
		//		$content = str_replace("__TRADE_COMPANY__", $admin_stat->delivery_company, $content);
		//		$content = str_replace("__TRADE_NUMBER__","배송번호", $content);
		$content = str_replace("__DELIV_NAME__", $trade2_data[deliv_name], $content);
		$content = str_replace("__DELIV_TEL__", $trade2_data[deliv_tel1]."".$trade2_data[deliv_tel2]."".$trade2_data[deliv_tel3], $content);
		$content = str_replace("__DELIV_ADDRESS__", "(".$trade2_data[deliv_zip1]."-".$trade2_data[deliv_zip2].")&nbsp;".$trade2_data[deliv_add1]."&nbsp;".$trade2_data[deliv_add2], $content);

		$result=$db->select("cs_trade_goods", "where trade_code='$_POST[TRADE_CODE]'");
		while( $row=@mysqli_fetch_object( $result)) {
		$order_admin_goods.="상품명 :".$row->goods_name." ,  가격 :".number_format($row->goods_price)."원, 수량 :".$row->goods_cnt."개<br>";
		}
		$content = str_replace("__ORDER_GOODS__", $order_admin_goods, $content);

		// 쇼핑몰 기본 정보 대한 치완
		$content = str_replace("__SHOP_NAME__", $admin_stat->shop_name, $content);
		$content = str_replace("__SHOP_DOMAIN__", $admin_stat->shop_domain, $content);
		$content = str_replace("__SHOP_CEO__", $admin_stat->shop_ceo, $content);
		$content = str_replace("__SHOP_TEL__", $admin_stat->shop_tel1, $content);
		$content = str_replace("__SHOP_EMAIL__", $admin_stat->shop_email, $content);
		$content = str_replace("__SHOP_ADDRESS__", $admin_stat->shop_address, $content);
		$content = str_replace("__MAILFORM_IMAGES_URL__",$admin_stat->shop_url, $content);

		// 제목에 대한 치완
		$title= $mailform2_stat->title;
		$title = str_replace("__SHOP_NAME__", $admin_stat->shop_name, $title);
		$title = str_replace("__ORDER_NAME__", $trade2_data[order_name], $title);

		// 상품 주문메일
		$mail->to = $admin_stat->shop_email;
		$mail->from = $trade2_data[order_email];
		$mail->subject = $title;
		$mail->body = $content;
		$mail->send();	 //관리자에게 메일 보낸다.
	}
// 포인트전용 결제시 결제 완료로 변경한다.
} else if( $trade3_data[trade_method] <= 4) {
//PG사 결제의 경우 멘트설정

	if($res_cd=="0000") {
		$trade_stat = $db->object("cs_trade", "where trade_code='$_POST[TRADE_CODE]'");

		if($trade3_data[trade_method] != 4){ //가상계좌일 경우에는 결제대기
			$db->update("cs_trade", "trade_stat=2, trade_money_ok=now() where trade_code='$_POST[TRADE_CODE]'");
			$db->update("cs_trade_goods", "trade_stat=2 where trade_code='$_POST[TRADE_CODE]'");
			
		}
		///////////////////////////////////////주문 메일 보내기///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//결제 정보출력시 숫자 변수를 문자로 치완한다.
		if($trade3_data[trade_method]==1) $TRADE_METHOD = "카드결제";
		else if($trade3_data[trade_method]==2) $TRADE_METHOD = "계좌이체";
		else if($trade3_data[trade_method]==3) $TRADE_METHOD = "휴대폰";
		else if($trade3_data[trade_method]==4) $TRADE_METHOD = "가상계좌";
		// 관리자 정보
		$admin_stat=$db->object("cs_admin", "");
		// 메일폼 정보
		$mailform1_stat	=	$db->object("cs_mailform", "where item=3");
		$mailform2_stat	=	$db->object("cs_mailform", "where item=7");
		// 회원 정보
		if($admin_stat->account_member) {
			$mail = new my_mime_mail();
			$content=$mailform1_stat->content;
			// 상품주문 대한 치완
			$content = str_replace("__ORDER_NAME__", $trade2_data[order_name], $content);
			$content = str_replace("__TRADE_CODE__", $_POST[TRADE_CODE], $content);
			$content = str_replace("__TRADE_METHOD__", $TRADE_METHOD, $content);
			$content = str_replace("__TRADE_METHOD_INFO__", $trade3_data[trade_method_info], $content);
			$content = str_replace("__TRADE_PRICE__", $trade3_data[trade_price], $content);
			$content = str_replace("__TRADE_DAY__", date("Y-m-d H:i", time()), $content);
			$content = str_replace("__TRADE_MONEY_OK__", date("Y-m-d H:i", time()), $content);
			$content = str_replace("__DELIV_NAME__", $trade2_data[deliv_name], $content);
			$content = str_replace("__DELIV_TEL__", $trade2_data[deliv_tel1]."".$trade2_data[deliv_tel2]."".$trade2_data[deliv_tel3], $content);
			$content = str_replace("__DELIV_ADDRESS__", "(".$trade2_data[deliv_zip1]."-".$trade2_data[deliv_zip2].")&nbsp;".$trade2_data[deliv_add1]."&nbsp;".$trade2_data[deliv_add2], $content);
			$result=$db->select("cs_trade_goods", "where trade_code='$_POST[TRADE_CODE]'");
			while( $row=@mysqli_fetch_object( $result)) {
				$order_member_goods.="상품명 :".$row->goods_name.", 가격 :".number_format($row->goods_price)."원, 수량 :".$row->goods_cnt."개<br>";
			}
			$content = str_replace("__ORDER_GOODS__", $order_member_goods, $content);

			// 쇼핑몰 기본 정보 대한 치완
			$content = str_replace("__SHOP_NAME__", $admin_stat->shop_name, $content);
			$content = str_replace("__SHOP_DOMAIN__", $admin_stat->shop_domain, $content);
			$content = str_replace("__SHOP_CEO__", $admin_stat->shop_ceo, $content);
			$content = str_replace("__SHOP_TEL__", $admin_stat->shop_tel1, $content);
			$content = str_replace("__SHOP_EMAIL__", $admin_stat->shop_email, $content);
			$content = str_replace("__SHOP_ADDRESS__", $admin_stat->shop_address, $content);
			$content = str_replace("__MAILFORM_IMAGES_URL__",$admin_stat->shop_url, $content);

			// 제목에 대한 치완
			$title= $mailform1_stat->title;
			$title = str_replace("__SHOP_NAME__", $admin_stat->shop_name, $title);
			$title = str_replace("__ORDER_NAME__", $trade2_data[order_name], $title);

			// 상품 주문메일
			$mail->to = $trade2_data[order_email];
			$mail->from = $admin_stat->shop_email;
			$mail->subject = $title;
			$mail->body = $content;
			if(!$mail->send()) { $tools->msg('주문과 내역을 메일으로 보내지 못했습니다.\n\n로그인 하셔서 주문 조회로 확인해 보세요');}
		}
		// 관리자에게 메일 보내기
		if($admin_stat->account_admin) {
			$mail = new my_mime_mail();
			$content=$mailform2_stat->content;
			// 상품주문 대한 치완
			$content = str_replace("__ORDER_NAME__", $trade2_data[order_name], $content);
			$content = str_replace("__TRADE_CODE__", $_POST[TRADE_CODE], $content);
			$content = str_replace("__TRADE_METHOD__", $TRADE_METHOD, $content);
			$content = str_replace("__TRADE_PRICE__", $trade3_data[trade_price], $content);
			//		$content = str_replace("__TRADE_DAY__", date("Y-m-d H:i", time()), $content);
			$content = str_replace("__TRADE_MONEY_OK__", date("Y-m-d H:i", time()), $content);
			//		$content = str_replace("__TRADE_COMPANY__", $admin_stat->delivery_company, $content);
			//		$content = str_replace("__TRADE_NUMBER__","배송번호", $content);
			$content = str_replace("__DELIV_NAME__", $trade2_data[deliv_name], $content);
			$content = str_replace("__DELIV_TEL__", $trade2_data[deliv_tel1]."".$trade2_data[deliv_tel2]."".$trade2_data[deliv_tel3], $content);
			$content = str_replace("__DELIV_ADDRESS__", "(".$trade2_data[deliv_zip1]."-".$trade2_data[deliv_zip2].")&nbsp;".$trade2_data[deliv_add1]."&nbsp;".$trade2_data[deliv_add2], $content);
			$result=$db->select("cs_trade_goods", "where trade_code='$_POST[TRADE_CODE]'");
			while( $row=@mysqli_fetch_object( $result)) {
			$order_member_goods.="상품명 :".$row->goods_name.", 가격 :".number_format($row->goods_price)."원, 수량 :".$row->goods_cnt."개<br>";
			}
			$content = str_replace("__ORDER_GOODS__", $order_member_goods, $content);

			// 쇼핑몰 기본 정보 대한 치완
			$content = str_replace("__SHOP_NAME__", $admin_stat->shop_name, $content);
			$content = str_replace("__SHOP_DOMAIN__", $admin_stat->shop_domain, $content);
			$content = str_replace("__SHOP_CEO__", $admin_stat->shop_ceo, $content);
			$content = str_replace("__SHOP_TEL__", $admin_stat->shop_tel1, $content);
			$content = str_replace("__SHOP_EMAIL__", $admin_stat->shop_email, $content);
			$content = str_replace("__SHOP_ADDRESS__", $admin_stat->shop_address, $content);
			$content = str_replace("__MAILFORM_IMAGES_URL__",$admin_stat->shop_url, $content);

			// 제목에 대한 치완
			$title= $mailform2_stat->title;
			$title = str_replace("__SHOP_NAME__", $admin_stat->shop_name, $title);
			$title = str_replace("__ORDER_NAME__", $trade2_data[order_name], $title);

			// 상품 주문메일
			$mail->to = $admin_stat->shop_email;
			$mail->from = $trade2_data[order_email];
			$mail->subject = $title;
			$mail->body = $content;
			$mail->send();	 //관리자에게 메일 보낸다.
		}
	}
// 포인트전용 결제시 결제 완료로 변경한다.
} else if( $trade3_data[trade_method] == 6) {
		$db->update("cs_trade", "trade_stat=2, trade_money_ok=now() where trade_code='$_POST[TRADE_CODE]'");
		///////////////////////////////////////주문 메일 보내기///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//결제 정보출력시 숫자 변수를 문자로 치완한다.
		$TRADE_METHOD = "포인트전용";
		// 관리자 정보
		$admin_stat=$db->object("cs_admin", "");
		// 메일폼 정보
		$mailform1_stat	=	$db->object("cs_mailform", "where item=3");
		$mailform2_stat	=	$db->object("cs_mailform", "where item=7");
		// 회원 정보
		if($admin_stat->account_member) {
			$mail = new my_mime_mail();
			$content=$mailform1_stat->content;
			// 상품주문 대한 치완
			$content = str_replace("__ORDER_NAME__", $trade2_data[order_name], $content);
			$content = str_replace("__TRADE_CODE__", $_POST[TRADE_CODE], $content);
			$content = str_replace("__TRADE_METHOD__", $TRADE_METHOD, $content);
			$content = str_replace("__TRADE_PRICE__", $trade3_data[trade_price], $content);
			//		$content = str_replace("__TRADE_DAY__", date("Y-m-d H:i", time()), $content);
			$content = str_replace("__TRADE_MONEY_OK__", date("Y-m-d H:i", time()), $content);
			$content = str_replace("__DELIV_NAME__", $trade2_data[deliv_name], $content);
			$content = str_replace("__DELIV_TEL__", $trade2_data[deliv_tel1]."".$trade2_data[deliv_tel2]."".$trade2_data[deliv_tel3], $content);
			$content = str_replace("__DELIV_ADDRESS__", "(".$trade2_data[deliv_zip1]."-".$trade2_data[deliv_zip2].")&nbsp;".$trade2_data[deliv_add1]."&nbsp;".$trade2_data[deliv_add2], $content);
			$result=$db->select("cs_trade_goods", "where trade_code='$_POST[TRADE_CODE]'");
			while( $row=@mysqli_fetch_object( $result)) {
				$order_member_goods.="상품명 :".$row->goods_name.", 가격 :".number_format($row->goods_price)."원, 수량 :".$row->goods_cnt."개<br>";
			}
			$content = str_replace("__ORDER_GOODS__", $order_member_goods, $content);

			// 쇼핑몰 기본 정보 대한 치완
			$content = str_replace("__SHOP_NAME__", $admin_stat->shop_name, $content);
			$content = str_replace("__SHOP_DOMAIN__", $admin_stat->shop_domain, $content);
			$content = str_replace("__SHOP_CEO__", $admin_stat->shop_ceo, $content);
			$content = str_replace("__SHOP_TEL__", $admin_stat->shop_tel1, $content);
			$content = str_replace("__SHOP_EMAIL__", $admin_stat->shop_email, $content);
			$content = str_replace("__SHOP_ADDRESS__", $admin_stat->shop_address, $content);
			$content = str_replace("__MAILFORM_IMAGES_URL__",$admin_stat->shop_url, $content);

			// 제목에 대한 치완
			$title= $mailform1_stat->title;
			$title = str_replace("__SHOP_NAME__", $admin_stat->shop_name, $title);
			$title = str_replace("__ORDER_NAME__", $trade2_data[order_name], $title);

			// 상품 주문메일
			$mail->to = $trade2_data[order_email];
			$mail->from = $admin_stat->shop_email;
			$mail->subject = $title;
			$mail->body = $content;
			if(!$mail->send()) { $tools->msg('주문과 내역을 메일으로 보내지 못했습니다.\n\n로그인 하셔서 주문 조회로 확인해 보세요');}
		}
		// 관리자에게 메일 보내기
		if($admin_stat->account_admin) {
			$mail = new my_mime_mail();
			$content=$mailform2_stat->content;
			// 상품주문 대한 치완
			$content = str_replace("__ORDER_NAME__", $trade2_data[order_name], $content);
			$content = str_replace("__TRADE_CODE__", $_POST[TRADE_CODE], $content);
			$content = str_replace("__TRADE_METHOD__", $TRADE_METHOD, $content);
			$content = str_replace("__TRADE_PRICE__", $trade3_data[trade_price], $content);
			//		$content = str_replace("__TRADE_DAY__", date("Y-m-d H:i", time()), $content);
			$content = str_replace("__TRADE_MONEY_OK__", date("Y-m-d H:i", time()), $content);
			//		$content = str_replace("__TRADE_COMPANY__", $admin_stat->delivery_company, $content);
			//		$content = str_replace("__TRADE_NUMBER__","배송번호", $content);
			$content = str_replace("__DELIV_NAME__", $trade2_data[deliv_name], $content);
			$content = str_replace("__DELIV_TEL__", $trade2_data[deliv_tel1]."".$trade2_data[deliv_tel2]."".$trade2_data[deliv_tel3], $content);
			$content = str_replace("__DELIV_ADDRESS__", "(".$trade2_data[deliv_zip1]."-".$trade2_data[deliv_zip2].")&nbsp;".$trade2_data[deliv_add1]."&nbsp;".$trade2_data[deliv_add2], $content);
			$result=$db->select("cs_trade_goods", "where trade_code='$_POST[TRADE_CODE]'");
			while( $row=@mysqli_fetch_object( $result)) {
			$order_member_goods.="상품명 :".$row->goods_name.", 가격 :".number_format($row->goods_price)."원, 수량 :".$row->goods_cnt."개<br>";
			}
			$content = str_replace("__ORDER_GOODS__", $order_member_goods, $content);

			// 쇼핑몰 기본 정보 대한 치완
			$content = str_replace("__SHOP_NAME__", $admin_stat->shop_name, $content);
			$content = str_replace("__SHOP_DOMAIN__", $admin_stat->shop_domain, $content);
			$content = str_replace("__SHOP_CEO__", $admin_stat->shop_ceo, $content);
			$content = str_replace("__SHOP_TEL__", $admin_stat->shop_tel1, $content);
			$content = str_replace("__SHOP_EMAIL__", $admin_stat->shop_email, $content);
			$content = str_replace("__SHOP_ADDRESS__", $admin_stat->shop_address, $content);
			$content = str_replace("__MAILFORM_IMAGES_URL__",$admin_stat->shop_url, $content);

			// 제목에 대한 치완
			$title= $mailform2_stat->title;
			$title = str_replace("__SHOP_NAME__", $admin_stat->shop_name, $title);
			$title = str_replace("__ORDER_NAME__", $trade2_data[order_name], $title);

			// 상품 주문메일
			$mail->to = $admin_stat->shop_email;
			$mail->from = $trade2_data[order_email];
			$mail->subject = $title;
			$mail->body = $content;
			$mail->send();	 //관리자에게 메일 보낸다.
		}
}

//문자보내기
if($trade3_data[trade_method] != 5 && $trade3_data[trade_method] != 4) {
	//문자 보내기
	$smsText = $db->object("cs_sms_text", "where code='payment'");
	if($smsText->smsm==1){
		$tran_callback = $smsinfo->smsinputnumber;		/* 회신번호 "-" 없이 적어 주십시오 */

		$content=$smsText->content_member;

		// 신규회원가입
		$content = str_replace("__{MEMBER}__", $trade2_data[order_name], $content);
		$content = str_replace("__{URL}__", $admin_stat->shop_domain, $content);
		$content = str_replace("__{COMPANY}__", $admin_stat->shop_name, $content);
		$content = str_replace("__{TRADECODE}__", $_POST[TRADE_CODE], $content);
		$content = str_replace("__{PRICE}__",  $trade3_data[trade_price], $content);
		$tran_msg = iconv("utf-8","euc-kr",$content);
		$tran_phone = $trade2_data[deliv_phone1].$trade2_data[deliv_phone2].$trade2_data[deliv_phone3];

		$SMS->Add($tran_phone,"$tran_callback","$sms_id","$tran_msg","");
	}
	if($smsText->smsa==1){
		$tran_callback = $trade2_data[deliv_phone1].$trade2_data[deliv_phone2].$trade2_data[deliv_phone3];		/* 회신번호 "-" 없이 적어 주십시오 */

		$content=$smsText->content_admin;

		// 신규회원가입
		$content = str_replace("__{MEMBER}__", $trade2_data[order_name], $content);
		$content = str_replace("__{URL}__", $admin_stat->shop_domain, $content);
		$content = str_replace("__{COMPANY}__", $admin_stat->shop_name, $content);
		$content = str_replace("__{TRADECODE}__", $_POST[TRADE_CODE], $content);
		$content = str_replace("__{PRICE}__",  $trade3_data[trade_price], $content);
		$tran_msg = iconv("utf-8","euc-kr",$content);
		$tran_phone = $smsinfo->smsnumber;

		$SMS->Add($tran_phone,"$tran_callback","$sms_id","$tran_msg","");
	}
	$result = $SMS->Send();
	if ($result) {
		$messge = "SMS 서버에 접속했습니다.<br>";
		$success = $fail = 0;
		foreach($SMS->Result as $result) {
			list($phone,$code)=explode(":",$result);
			if ($code=="Error") {
				$messge = $phone.'로 발송하는데 에러가 발생했습니다.<br>';
				$fail++;
			} else {
				$messge = $phone."로 전송했습니다. (메시지번호:".$code.")<br>";
				$success++;
			}
		}
		$messge = $success."건을 전송했으며 ".$fail."건을 보내지 못했습니다.<br>";
		$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
	} else {
		$messge = "에러: SMS 서버와 통신이 불안정합니다.<br>";
	}
}else{
//일반 주문완료 메세지
	$smsText = $db->object("cs_sms_text", "where code='order'");
	if($smsText->smsm==1){
		$tran_callback = $smsinfo->smsinputnumber;		/* 회신번호 "-" 없이 적어 주십시오 */

		$content=$smsText->content_member;

		// 신규회원가입
		$content = str_replace("__{MEMBER}__", $trade2_data[order_name], $content);
		$content = str_replace("__{URL}__", $admin_stat->shop_domain, $content);
		$content = str_replace("__{COMPANY}__", $admin_stat->shop_name, $content);
		$content = str_replace("__{TRADECODE}__", $_POST[TRADE_CODE], $content);
		$content = str_replace("__{PRICE}__", $trade3_data[trade_price], $content);
		$content = str_replace("__{BANK}__", $trade_method_info, $content);
		$content = str_replace("__{__TRADE_DAY__}__", date("Y-m-d H:i", time()),  $content);
		$tran_msg = iconv("utf-8","euc-kr",$content);
		$tran_phone = $trade2_data[deliv_phone1].$trade2_data[deliv_phone2].$trade2_data[deliv_phone3];

		$SMS->Add($tran_phone,"$tran_callback","$sms_id","$tran_msg","");
	}
	if($smsText->smsa==1){
		$tran_callback = $trade2_data[deliv_phone1].$trade2_data[deliv_phone2].$trade2_data[deliv_phone3];		/* 회신번호 "-" 없이 적어 주십시오 */

		$content=$smsText->content_admin;

		// 신규회원가입
		$content = str_replace("__{MEMBER}__", $trade2_data[order_name], $content);
		$content = str_replace("__{URL}__", $admin_stat->shop_domain, $content);
		$content = str_replace("__{COMPANY}__", $admin_stat->shop_name, $content);
		$content = str_replace("__{TRADECODE}__", $_POST[TRADE_CODE], $content);
		$content = str_replace("__{PRICE}__", $trade3_data[trade_price], $content);
		$content = str_replace("__{BANK}__", $trade_method_info, $content);
		$tran_msg = iconv("utf-8","euc-kr",$content);
		$tran_phone = $smsinfo->smsnumber;

		$SMS->Add($tran_phone,"$tran_callback","$sms_id","$tran_msg","");
	}
	$coins = get_coins("http://www.icodekorea.com/res/coin2.php", $sms_id, $sms_pw );
	if($coins[0] > 50){
		$result = $SMS->Send();
		if ($result) {
			$messge = "SMS 서버에 접속했습니다.<br>";
			$success = $fail = 0;
			foreach($SMS->Result as $result) {
				list($phone,$code)=explode(":",$result);
				if ($code=="Error") {
					$messge = $phone.'로 발송하는데 에러가 발생했습니다.<br>';
					$fail++;
				} else {
					$messge = $phone."로 전송했습니다. (메시지번호:".$code.")<br>";
					$success++;
				}
			}
			$messge = $success."건을 전송했으며 ".$fail."건을 보내지 못했습니다.<br>";
			$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
		} else {
			$messge = "에러: SMS 서버와 통신이 불안정합니다.<br>";
		}
	}
}

?>

<script language="javascript">
	function receiptView(tno)
	{
		receiptWin = "http://admin.kcp.co.kr/Modules/Sale/Card/ADSA_CARD_BILL_Receipt.jsp?c_trade_no=" + tno
		window.open(receiptWin , "" , "width=420, height=670")
	}
</script>

<div class="site-wrapper" id="box_wrapper">
	<!--상단로고, 가이드메뉴-->
	<? include('./include/top_guide.inc.php');?>

	<!--상단메뉴, 로테이트베너-->
	<? include('./include/top_menu.inc.php');?>
		<!--페이지 위치-->
		<div class="my_location">
			<ol class="breadcrumb titletxt_B">
				<li><a href="index.php" class="titletxt_A">Home</a></li>
				<li class="arrow"><i class="fas fa-angle-right"></i></li>
				<li>주문완료</li>
			</ol>
		</div>
		<!--//페이지 위치-->

	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section order_trade">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<h3 class="tit">주문완료</h3>

						<!--********************내용영역 출력시작********************-->
						 <!--장바구니 테이블 시작-->
                         <div class="cart">

							<?
								// 장바구니를 먼저 비운다.
								if($cnt2){
									$db->delete("cs_cart", "where idx IN($trade2_data[cartinfo])");
								}
								$reade_end_stat = $db->object("cs_trade", "where trade_code='$_POST[TRADE_CODE]'");
							?>
							<?$reade_end_stat = $db->object("cs_trade", "where trade_code='$_POST[TRADE_CODE]'");?>
							<table width="100%" class='oolimmobilemenu'>
								<tr>
									<td height="1" bgcolor='333333'>
									</td>
									<td height="1" bgcolor='333333'>
									</td>
								</tr>
								<tr height='40'>
									<td align='left' width="120" height="35" bgcolor="F7F7F7" class="ordertitleM">주문코드</td>
									<td align='left' class="ordertitleM_Box"><?=$reade_end_stat->trade_code;?></td>
								</tr>
								<tr>
									<td height="1" bgcolor='DDDDDD'>
									</td>
									<td height="1" bgcolor='DDDDDD'>
									</td>
								</tr>
								<tr height='40'>
									<td align='left' width="120" bgcolor="F7F7F7" class="ordertitleM">구매금액</td>
									<td align='left' class='ordertitleM_Box'><?=number_format($reade_end_stat->trade_total_price);?>원</td>
								</tr>
								<tr>
									<td height="1" bgcolor='DDDDDD'>
									</td>
									<td height="1" bgcolor='DDDDDD'>
									</td>
								</tr>
								<? if($reade_end_stat->trade_member_dc) {?>
								<tr height='40'>
									<td align='left' width="120" bgcolor="F7F7F7" class="ordertitleM">회원할인금액</td>
									<td align='left' class='ordertitleM_Box'><?=number_format($reade_end_stat->trade_member_dc);?> 원</td>
								</tr>
								<tr>
									<td height="1" bgcolor='DDDDDD'>
									</td>
									<td height="1" bgcolor='DDDDDD'>
									</td>
								</tr>
								<?}?>
								<tr height='40'>
									<td align='left' width="120" bgcolor="F7F7F7" class="ordertitleM">배송비</td>
									<td align='left' class='ordertitleM_Box'><?=number_format($reade_end_stat->trade_deliv_price);?> 원</td>
								</tr>
								<tr>
									<td height="1" bgcolor='DDDDDD'>
									</td>
									<td height="1" bgcolor='DDDDDD'>
									</td>
								</tr>
								<? if($reade_end_stat->trade_use_point) {?>
								<tr height='40'>
									<td align='left' width="120" bgcolor="F7F7F7" class="ordertitleM">적립금 결제</td>
									<td align='left' class='ordertitleM_Box'><?=number_format($reade_end_stat->trade_use_point);?> 원</td>
								</tr>
								<tr>
									<td height="1" bgcolor='DDDDDD'>
									</td>
									<td height="1" bgcolor='DDDDDD'>
									</td>
								</tr>
								<?}?>
								<tr height='40'>
									<td align='left' width="120" height="35" bgcolor="F7F7F7" class="ordertitleM">결제정보</td>
									<td align='left' class='ordertitleM_Box'>
										<? if($reade_end_stat->trade_method==1){;?>카드결제<span style='padding-right:10px'></span>
										<?} else if($reade_end_stat->trade_method==2){;?>계좌이체<span style='padding-right:10px'></span><?} else if($reade_end_stat->trade_method==3){;?>휴대폰결제<span style='padding-right:10px'></span><?} else if($reade_end_stat->trade_method==4){;?>가상계좌<span style='padding-right:10px'></span> <?=$reade_end_stat->trade_method_info;?><span style='padding-right:10px'></span><?} else if($reade_end_stat->trade_method==5){;?>무통장입금<span style='padding-right:10px'></span><?=$reade_end_stat->trade_method_info;?><span style='padding-right:10px'></span><?} else if($reade_end_stat->trade_method==6){;?>적립금결제<span style='padding-right:10px'></span>
										<?}?>
									</td>
								</tr>
								<tr>
									<td height="1" bgcolor='DDDDDD'>
									</td>
									<td height="1" bgcolor='DDDDDD'>
									</td>
								</tr>
								<tr height='40'>
									<td align='left' width="120" height="35" bgcolor="F7F7F7" class="ordertitleM">결제금액</td>
									<td align='left' class='ordertitleM_Box'><span class=""><?=number_format($reade_end_stat->trade_price);?></span> 원</td>
								</tr>
								<tr>
									<td height="1" bgcolor='DDDDDD'>
									</td>
									<td height="1" bgcolor='DDDDDD'>
									</td>
								</tr>
								<? if($reade_end_stat->deliv_content) {?>
								<tr height='40'>
									<td align='left' width="120" bgcolor="F7F7F7" class="ordertitleM">주문시 요청사항</td>
									<td align='left' class='ordertitleM_Box'><?=$db->stripSlash($tools->strHtmlNo($reade_end_stat->deliv_content));?></td>
								</tr>
								<tr>
									<td height="1" bgcolor='DDDDDD'>
									</td>
									<td height="1" bgcolor='DDDDDD'>
									</td>
								</tr>
								<?}?>
								<? if($reade_end_stat->deliv_pree_day!='0000-00-00 00:00:00') {?>
								<tr height='40'>
									<td align='left' width="120" bgcolor="F7F7F7" class="ordertitleM">배송희망일</td>
									<td align='left' class='ordertitleM_Box'>
										<?=$tools->strDateCut($reade_end_stat->deliv_pree_day, 5);?>
									</td>
								</tr>
								<tr>
									<td height="1" bgcolor='DDDDDD'>
									</td>
									<td height="1" bgcolor='DDDDDD'>
									</td>
								</tr>
								<?}?>
								
								<? if($reade_end_stat->receipt_url){;?><!--영수증출력:토스 카드결제시활성-->
								<script language="javascript">
									function receiptView_toss(tno)
									{
										receiptWin = "<?=$reade_end_stat->receipt_url;?>"
										window.open(receiptWin , "" , "width=720, height=900")
									}
								</script>								
								<tr height='40'>
									<td align='left' width="120" bgcolor="F7F7F7" class="ordertitleM">영수증출력</td>
									<td align='left' class='ordertitleM_Box'><input style="margin: 0 !important; padding: 1%;"type="button" name="receiptView" value="영수증 확인" class="box" onClick="javascript:receiptView_toss('<?=$tno?>')"></td>
								</tr>
								<?}else{?>
									<? if($reade_end_stat->trade_method==1 && $tno){;?><!--영수증출력:카드결제시활성-->
									<tr height='40'>
										<td align='left' width="120" bgcolor="F7F7F7" class="ordertitleM">영수증출력</td>
										<td align='left' class='ordertitleM_Box'><input style="margin: 0 !important; padding: 1%;"type="button" name="receiptView" value="영수증 확인" class="box" onClick="javascript:receiptView('<?=$tno?>')"></td>
									</tr>
									<?}?>								
								<?}?>
								<tr height='40'>
									<td align="center" colspan="2" height="45" bgcolor="F7F7F7">※ 주문코드를 메모해 두시면 마이페이지 주문조회페이지에서 처리상태를 확인하실 수 있습니다.</td>
								</tr>
								<tr>
									<td height="1" bgcolor='333333'>
									</td>
									<td height="1" bgcolor='333333'>
									</td>
								</tr>
							</table>

							<table style='margin:0 auto;'>
									<tr>
										<td style='text-align:center;' height="75"><a href="<? if($_SESSION[USERID]) {?>my_order_list.php<?}else{?>order_check.php<?}?>" class="oolimbtn-botton1" style="width:150px">주문내역조회</a></td>
									<td height="75" align="center"><a href="index.php" class="oolimbtn-botton2" style="width:150px">쇼핑계속하기</a></td>
								</tr>
							</table>

						</div>
						<!--********************내용영역 출력 끝********************-->



				</div><!--to_animate-->
			</div><!--row-->
		</div><!--container-->
	</section>
	<!--컨텐츠 출력2 End-->

<br>


	<!--하단-->
	<? include('./include/footer.inc.php');?>
	<!--하단-->

</div><!--site-wrapper End-->
