<?
include('../../common.php'); 
include($ROOT_DIR.'/lib/mail_class.php');
include ('../../class.sms.php');
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

$admin_stat = $db->object("cs_admin", "");
$smsinfo = $db->object("cs_sms_setup", "");
$sms_server	= "211.172.232.124";	## SMS 서버
$sms_id		= $smsinfo->smsid;				## icode 아이디
$sms_pw		= $smsinfo->smspw;				## icode 패스워드
$portcode	= 1;				## 정액제 : 2, 충전식 : 1

$SMS	= new SMS;
$SMS->SMS_con($sms_server,$sms_id,$sms_pw,$portcode);


//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

$mv_data	= $_GET[trade_data];
$trade_data	= $tools->decode( $_GET[trade_data] );
if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $trade_data[idx]; }

if($_POST[trade_stat] && $_POST[hidden_trade_idx]) {

	// 거래 정보 불러오기
	$trade_stat = $db->object("cs_trade", "where idx=$idx");

	// 결제완료
	if( $_POST[trade_stat] == 2 ){
		$db->update("cs_trade", "trade_stat=2, trade_money_ok=now() where idx=$idx");
		$db->update("cs_trade_goods", "trade_stat=2 where trade_code='$trade_stat->trade_code' ");	

		///////////////////////////////////////결제완료 메일 보내기///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
			$content = str_replace("__ORDER_NAME__", $trade_stat->order_name, $content);
			$content = str_replace("__TRADE_CODE__", $trade_stat->trade_code, $content);
			$content = str_replace("__TRADE_METHOD__", "무통장 입금", $content);
			$content = str_replace("__TRADE_METHOD_INFO__", $trade_stat->trade_method_info, $content);
			$content = str_replace("__TRADE_PRICE__", $trade_stat->trade_price, $content);
			//		$content = str_replace("__TRADE_DAY__", date("Y-m-d H:i", time()), $content);
			$content = str_replace("__TRADE_MONEY_OK__", date("Y-m-d H:i", time()), $content);
			//		$content = str_replace("__TRADE_COMPANY__", $admin_stat->delivery_company, $content);
			//		$content = str_replace("__TRADE_NUMBER__","배송번호", $content);
			$content = str_replace("__DELIV_NAME__", $trade_stat->deliv_name, $content);
			$content = str_replace("__DELIV_TEL__", $trade_stat->deliv_tel1."-".$trade_stat->deliv_tel2."-".$trade_stat->deliv_tel3, $content);
			$content = str_replace("__DELIV_ADDRESS__", "(".$trade_stat->deliv_zip1."-".$trade_stat->deliv_zip2.")&nbsp;".$trade_stat->deliv_add1."&nbsp;".$trade_stat->deliv_add2, $content);		
			
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
			$title = str_replace("__ORDER_NAME__", $trade_stat->order_name, $title);

			// 상품 주문메일
			$mail->to = $trade_stat->order_email;
			$mail->from = $admin_stat->shop_email;
			$mail->subject = $title;
			$mail->body = $content;
			if(!$mail->send()) { $tools->msg('주문과 내역을 메일으로 보내지 못했습니다.');}
		}
		
		// 관리자에게 메일 보내기
		if($admin_stat->account_admin) {
			$mail = new my_mime_mail();
			$content=$mailform2_stat->content;
			// 상품주문 대한 치완
			$content = str_replace("__ORDER_NAME__", $trade_stat->order_name, $content);
			$content = str_replace("__TRADE_CODE__", $trade_stat->trade_code, $content);
			$content = str_replace("__TRADE_METHOD__", "무통장 입금", $content);
			$content = str_replace("__TRADE_METHOD_INFO__", $trade_stat->trade_method_info, $content);
			$content = str_replace("__TRADE_PRICE__", $trade_stat->trade_price, $content);
			//		$content = str_replace("__TRADE_DAY__", date("Y-m-d H:i", time()), $content);
			$content = str_replace("__TRADE_MONEY_OK__", date("Y-m-d H:i", time()), $content);
			//		$content = str_replace("__TRADE_COMPANY__", $admin_stat->delivery_company, $content);
			//		$content = str_replace("__TRADE_NUMBER__","배송번호", $content);
			$content = str_replace("__DELIV_NAME__", $trade_stat->deliv_name, $content);
			$content = str_replace("__DELIV_TEL__", $trade_stat->deliv_tel1."-".$trade_stat->deliv_tel2."-".$trade_stat->deliv_tel3, $content);
			$content = str_replace("__DELIV_ADDRESS__", "(".$trade_stat->deliv_zip1."-".$trade_stat->deliv_zip2.")&nbsp;".$trade_stat->deliv_add1."&nbsp;".$trade_stat->deliv_add2, $content);		
			
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
			$title = str_replace("__ORDER_NAME__", $trade_stat->order_name, $title);

			// 상품 주문메일
			$mail->to = $admin_stat->shop_email;
			$mail->from = $trade_stat->order_email;
			$mail->subject = $title;
			$mail->body = $content;
			$mail->send();	 //관리자에게 메일 보낸다.
		}
		$smsText = $db->object("cs_sms_text", "where code='payment'");

		//문자 보내기
		if($smsText->smsm==1){
			$tran_callback = $smsinfo->smsinputnumber;		/* 회신번호 "-" 없이 적어 주십시오 */

			$content=$smsText->content_member;

			// 신규회원가입
			$content = str_replace("__{MEMBER}__", $trade_stat->order_name, $content);
			$content = str_replace("__{URL}__", $admin_stat->shop_domain, $content);
			$content = str_replace("__{COMPANY}__", $admin_stat->shop_name, $content);
			$content = str_replace("__{TRADENUMBER}__", $trade_stat->trade_number, $content);
			$content = str_replace("__{TRADECODE}__", $trade_stat->trade_code, $content);
			$tran_msg = iconv("utf-8","euc-kr",$content);
			$tran_phone = $trade_stat->deliv_phone1.$trade_stat->deliv_phone2.$trade_stat->deliv_phone3;

			$SMS->Add($tran_phone,"$tran_callback","$sms_id","$tran_msg","");
		}
		if($smsText->smsa==1){
			$tran_callback = $trade_stat->deliv_phone1.$trade_stat->deliv_phone2.$trade_stat->deliv_phone3;		/* 회신번호 "-" 없이 적어 주십시오 */

			$content=$smsText->content_admin;

			// 신규회원가입
			$content = str_replace("__{MEMBER}__", $trade_stat->order_name, $content);
			$content = str_replace("__{URL}__", $admin_stat->shop_domain, $content);
			$content = str_replace("__{COMPANY}__", $admin_stat->shop_name, $content);
			$content = str_replace("__{TRADENUMBER}__", $trade_stat->trade_number, $content);
			$content = str_replace("__{TRADECODE}__", $trade_stat->trade_code, $content);
			$content = str_replace("__{PRICE}__", $trade_stat->trade_price, $content);
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
		
	// 배송중
	} else if( $_POST[trade_stat] == 3 ){
		if( $trade_stat->trade_stat < 2 ) { $db->update("cs_trade", "trade_stat=2, trade_money_ok=now() where idx=$idx");}
		$db->update("cs_trade", "trade_stat=3, trade_start_day=now() where idx=$idx");
		$db->update("cs_trade_goods", "trade_stat=3, trade_start_day=now()  where trade_code='$trade_stat->trade_code' ");	

		///////////////////////////////////////배송 메일 보내기///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// 관리자 정보 
		$admin_stat=$db->object("cs_admin", "");
		// 메일폼 정보
		$mailform1_stat	=	$db->object("cs_mailform", "where item=4");
		$mailform2_stat	=	$db->object("cs_mailform", "where item=8");
		// 회원 정보
		if($admin_stat->delivery_member) {
			$mail = new my_mime_mail();
			$content=$mailform1_stat->content;
			// 상품주문 대한 치완
			$content = str_replace("__ORDER_NAME__", $trade_stat->order_name, $content);
			$content = str_replace("__TRADE_CODE__", $trade_stat->trade_code, $content);
			$content = str_replace("__TRADE_METHOD__", "무통장 입금", $content);
			$content = str_replace("__TRADE_METHOD_INFO__", $trade_stat->trade_method_info, $content);
			$content = str_replace("__TRADE_PRICE__", $trade_stat->trade_price, $content);
			$content = str_replace("__TRADE_DAY__", date("Y-m-d H:i", time()), $content);
			$content = str_replace("__TRADE_MONEY_OK__", date("Y-m-d H:i", time()), $content);
			$content = str_replace("__TRADE_COMPANY__", $admin_stat->delivery_company, $content);
			$content = str_replace("__TRADE_NUMBER__",$trade_stat->trade_number, $content);
			$content = str_replace("__DELIV_NAME__", $trade_stat->deliv_name, $content);
			$content = str_replace("__DELIV_TEL__", $trade_stat->deliv_tel1."-".$trade_stat->deliv_tel2."-".$trade_stat->deliv_tel3, $content);
			$content = str_replace("__DELIV_ADDRESS__", "(".$trade_stat->deliv_zip1."-".$trade_stat->deliv_zip2.")&nbsp;".$trade_stat->deliv_add1."&nbsp;".$trade_stat->deliv_add2, $content);		
			
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
			$title = str_replace("__ORDER_NAME__", $trade_stat->order_name, $title);

			// 상품 주문메일
			$mail->to = $trade_stat->order_email;
			$mail->from = $admin_stat->shop_email;
			$mail->subject = $title;
			$mail->body = $content;
			if(!$mail->send()) { $tools->msg('주문과 내역을 메일으로 보내지 못했습니다.');}
		}
		
		// 관리자에게 메일 보내기
		if($admin_stat->delivery_admin) {
			$mail = new my_mime_mail();
			$content=$mailform2_stat->content;
			// 상품주문 대한 치완
			$content = str_replace("__ORDER_NAME__", $trade_stat->order_name, $content);
			$content = str_replace("__TRADE_CODE__", $trade_stat->trade_code, $content);
			$content = str_replace("__TRADE_METHOD__", "무통장 입금", $content);
			$content = str_replace("__TRADE_METHOD_INFO__", $trade_stat->trade_method_info, $content);
			$content = str_replace("__TRADE_PRICE__", $trade_stat->trade_price, $content);
			$content = str_replace("__TRADE_DAY__", date("Y-m-d H:i", time()), $content);
			$content = str_replace("__TRADE_MONEY_OK__", date("Y-m-d H:i", time()), $content);
			$content = str_replace("__TRADE_COMPANY__", $admin_stat->delivery_company, $content);
			$content = str_replace("__TRADE_NUMBER__",$trade_stat->trade_number, $content);
			$content = str_replace("__DELIV_NAME__", $trade_stat->deliv_name, $content);
			$content = str_replace("__DELIV_TEL__", $trade_stat->deliv_tel1."-".$trade_stat->deliv_tel2."-".$trade_stat->deliv_tel3, $content);
			$content = str_replace("__DELIV_ADDRESS__", "(".$trade_stat->deliv_zip1."-".$trade_stat->deliv_zip2.")&nbsp;".$trade_stat->deliv_add1."&nbsp;".$trade_stat->deliv_add2, $content);		
			
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
			$title = str_replace("__ORDER_NAME__", $trade_stat->order_name, $title);

			// 상품 주문메일
			$mail->to = $admin_stat->shop_email;
			$mail->from = $trade_stat->order_email;
			$mail->subject = $title;
			$mail->body = $content;
			$mail->send();	 //관리자에게 메일 보낸다.
		}
		$smsText = $db->object("cs_sms_text", "where code='deliv'");

		//문자 보내기
		if($smsText->smsm==1){
			$tran_callback = $smsinfo->smsinputnumber;		/* 회신번호 "-" 없이 적어 주십시오 */

			$content=$smsText->content_member;

			// 신규회원가입
			$content = str_replace("__{MEMBER}__", $trade_stat->order_name, $content);
			$content = str_replace("__{URL}__", $admin_stat->shop_domain, $content);
			$content = str_replace("__{COMPANY}__", $admin_stat->shop_name, $content);
			$content = str_replace("__{TRADENUMBER}__", $trade_stat->trade_number, $content);
			$content = str_replace("__{TRADECODE}__", $trade_stat->trade_code, $content);
			$tran_msg = iconv("utf-8","euc-kr",$content);
			$tran_phone = $trade_stat->deliv_phone1.$trade_stat->deliv_phone2.$trade_stat->deliv_phone3;

			$SMS->Add($tran_phone,"$tran_callback","$sms_id","$tran_msg","");
		}
		if($smsText->smsa==1){
			$tran_callback = $trade_stat->deliv_phone1.$trade_stat->deliv_phone2.$trade_stat->deliv_phone3;		/* 회신번호 "-" 없이 적어 주십시오 */

			$content=$smsText->content_admin;

			// 신규회원가입
			$content = str_replace("__{MEMBER}__", $trade_stat->order_name, $content);
			$content = str_replace("__{URL}__", $admin_stat->shop_domain, $content);
			$content = str_replace("__{COMPANY}__", $admin_stat->shop_name, $content);
			$content = str_replace("__{TRADENUMBER}__", $trade_stat->trade_number, $content);
			$content = str_replace("__{TRADECODE}__", $trade_stat->trade_code, $content);
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

	// 판매완료
	} else if( $_POST[trade_stat] == 4 ){		
		// 적립할 포인트를 적립한다.
		if($trade_stat->order_userid && $trade_stat->trade_save_point !=0) {
			$title="상품구입적립금 거래번호 : ".$trade_stat->trade_code;
			$db->insert("cs_point", "userid='$trade_stat->order_userid', title='$title', point='$trade_stat->trade_save_point', register=now()");
		}
		if( $trade_stat->trade_stat < 2 ) { $db->update("cs_trade", "trade_stat=2, trade_money_ok=now() where idx=$idx");}
		if( $trade_stat->trade_stat < 3 ) { $db->update("cs_trade", "trade_stat=3, trade_start_day=now() where idx=$idx");}
		
		$db->update("cs_trade", "trade_stat=4, trade_end_day=now() where idx=$idx");
		$db->update("cs_trade_goods", "trade_stat=4, deliv_day=now() where trade_code='$trade_stat->trade_code' ");	
		
		//판매자에게 판매대금 적립
		$trade_goods_result=$db->select("cs_trade_goods", "where trade_code='$trade_stat->trade_code' order by idx asc");
		while( $trade_goods_row=@mysqli_fetch_object( $trade_goods_result)) {
			$selle_stat = $db->object("cs_member", "where userid = '$trade_goods_row->seller' ");
			//$title="수익금(판매금액-수수료(".$admin_stat->fee_rate."%), 거래번호 : ".$trade_stat->trade_code;
			//$fee_rate = (100 - $admin_stat->fee_rate) * 0.01;
			//$save_point = $trade_goods_row->goods_price * $fee_rate;
			$title="수익금(판매금액-수수료(".$admin_stat->fee_rate."%), 거래번호 : ".$trade_stat->trade_code."(".$trade_goods_row->goods_code.")배송비(".$trade_goods_row->trade_deliv_price.")";
			$fee_rate = (100 - $admin_stat->fee_rate)*0.01;
			$save_point = ($trade_goods_row->goods_price * $trade_goods_row->goods_cnt * $fee_rate)+$trade_goods_row->trade_deliv_price;			
			$db->insert("cs_cash", "userid='$trade_goods_row->seller', title='$title', point='$save_point', cash=1, register=now()");			
			//echo $trade_goods_row->seller."<br>";
			//echo $title."<br>";
			//echo $save_point."<br>";			
		}
	// 취소요청
	} else if( $_POST[trade_stat] == 5 ){
		//거래 상태 변경
		$db->update("cs_trade", "trade_stat=5,  refund_start=now() where idx=$idx");
		$db->update("cs_trade_goods", "trade_stat=5, where trade_code='$trade_stat->trade_code' ");	
	//취소확정	
	} else if( $_POST[trade_stat] == 51 ){
		// 상품 구매에 사용된 포인트를 삭제한다.
		if($trade_stat->order_userid && $trade_stat->trade_use_point!=0) {
			$title="상품구입취소 거래번호 : ".$trade_stat->trade_code;
			$db->insert("cs_point", "userid='$trade_stat->order_userid', title='$title', point='$trade_stat->trade_use_point', register=now()");
		}
		// 판매완료 된것을 삭제 할경우
		if($trade_stat->order_userid && $trade_stat->trade_save_point !=0 && $trade_stat->trade_stat==4) {
			$title="상품구입적립금취소 거래번호 : ".$trade_stat->trade_code;
			$db->insert("cs_point", "userid='$trade_stat->order_userid', title='$title', point='-$trade_stat->trade_save_point', register=now()");
		}
		// 상품을 원래되로 돌려 준다(단, 무제한은 제외)
		$trade_goods_result = $db->select("cs_trade_goods", "where trade_code='$trade_stat->trade_code'");
		while( $trade_goods_row = @mysqli_fetch_object( $trade_goods_result )) {
			$goods_stat = $db->object("cs_goods", "where idx=$trade_goods_row->goods_idx and unlimit=0", "number, unlimit");
			$goods_number = $goods_stat->number + $trade_goods_row->goods_cnt;
			$db->update("cs_goods", "number=$goods_number where unlimit=0 and idx=$trade_goods_row->goods_idx");
		}

		$smsText = $db->object("cs_sms_text", "where code='cancel'");

		//문자 보내기
		if($smsText->smsm==1){
			$tran_callback = $smsinfo->smsinputnumber;		/* 회신번호 "-" 없이 적어 주십시오 */

			$content=$smsText->content_member;

			// 신규회원가입
			$content = str_replace("__{MEMBER}__", $trade_stat->order_name, $content);
			$content = str_replace("__{URL}__", $admin_stat->shop_domain, $content);
			$content = str_replace("__{COMPANY}__", $admin_stat->shop_name, $content);
			$content = str_replace("__{TRADENUMBER}__", $trade_stat->trade_number, $content);
			$content = str_replace("__{TRADECODE}__", $trade_stat->trade_code, $content);
			$content = str_replace("__{PRODUCT}__",  $trade_goods_stat->goods_name, $content);
			$content = str_replace("__{BANK}__",  $trade_stat->trade_method_info, $content);
			$tran_msg = iconv("utf-8","euc-kr",$content);
			$tran_phone = $trade_stat->deliv_phone1.$trade_stat->deliv_phone2.$trade_stat->deliv_phone3;

			$SMS->Add($tran_phone,"$tran_callback","$sms_id","$tran_msg","");
		}
		if($smsText->smsa==1){
			$tran_callback = $trade_stat->deliv_phone1.$trade_stat->deliv_phone2.$trade_stat->deliv_phone3;		/* 회신번호 "-" 없이 적어 주십시오 */

			$content=$smsText->content_admin;

			// 신규회원가입
			$content = str_replace("__{MEMBER}__", $trade_stat->order_name, $content);
			$content = str_replace("__{URL}__", $admin_stat->shop_domain, $content);
			$content = str_replace("__{COMPANY}__", $admin_stat->shop_name, $content);
			$content = str_replace("__{TRADENUMBER}__", $trade_stat->trade_number, $content);
			$content = str_replace("__{TRADECODE}__", $trade_stat->trade_code, $content);
			$content = str_replace("__{PRICE}__", $trade_stat->trade_price, $content);
			$content = str_replace("__{PRODUCT}__",  $trade_goods_stat->goods_name, $content);
			$content = str_replace("__{BANK}__",  $trade_stat->trade_method_info, $content);
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
		//상태변경
		$db->update("cs_trade", "trade_stat=51, refund_ok=now()  where idx=$idx");
		$db->update("cs_trade_goods", "trade_stat=51 where trade_code='$trade_stat->trade_code' ");	
		//$db->delete("cs_trade_goods", "where trade_code='$trade_stat->trade_code'");
		//$db->delete("cs_trade", "where idx=$idx");
	//환불완료	
	} else if( $_POST[trade_stat] == 52 ){
		//거래 상태 변경
		$db->update("cs_trade", "trade_stat=52, refund_end=now() where idx=$idx");
		$db->update("cs_trade_goods", "trade_stat=52, refund_remark='관리자 직권 처리', refund_end=now() where trade_code='$trade_stat->trade_code' ");	
	//거래 내역삭제		
	} else if( $_POST[trade_stat] == 6 ){
		$db->delete("cs_trade_goods", "where trade_code='$trade_stat->trade_code'");
		$db->delete("cs_trade", "where idx=$idx");
	}
	$tools->javaGo("trade.php?trade_data=$mv_data");
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
