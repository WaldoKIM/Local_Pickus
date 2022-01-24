<?
include('../common.php');
include ('../class.sms.php');

//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
	$smsinfo = $db->object("cs_sms_setup", "");
	$smsText = $db->object("cs_sms_text", "where code='memberout'");
	$sms_server	= "211.172.232.124";	## SMS 서버
	$sms_id		= $smsinfo->smsid;				## icode 아이디
	$sms_pw		= $smsinfo->smspw;				## icode 패스워드
	$portcode	= 1;				## 정액제 : 2, 충전식 : 1
	
	$SMS	= new SMS;
	$SMS->SMS_con($sms_server,$sms_id,$sms_pw,$portcode);

if($_POST[userid]==$_SESSION[USERID]) {
	if( !$db->cnt("cs_member", "where userid='$_SESSION[USERID]' and passwd=PASSWORD('$_POST[passwd]')")){ $tools->errMsg('회원정보입력이 정확하지 않습니다.');}
	// 넘어온 idx 로 삭제 레코드를 검색한다.
	$row = $db->object("cs_member", "where userid='$_SESSION[USERID]' and passwd=PASSWORD('$_POST[passwd]')");
	// 포인트 삭제
	$db->delete("cs_point", "where userid='$row->userid'");
	// wishlist 삭제
	$db->delete("cs_wishlist", "where userid='$row->userid'");
	// 주문 비회원으로
	$db->update("cs_trade", "order_userid='' where order_userid='$row->userid'");

	//문자 보내기
		if($smsText->smsm==1){
			$tran_callback = $smsinfo->smsinputnumber;		/* 회신번호 "-" 없이 적어 주십시오 */

			$content=$smsText->content_member;

			// 신규회원가입
			$content = str_replace("__{MEMBER}__", $row->name, $content);
			$content = str_replace("__{URL}__", $admin_stat->shop_domain, $content);
			$content = str_replace("__{COMPANY}__", $admin_stat->shop_name, $content);

			$tran_msg	  = $content;
			$tran_phone = $row->phone1.$row->phone2.$row->phone3;

			$SMS->Add($tran_phone,"$tran_callback","$sms_id","$tran_msg","");
		}
		if($smsText->smsa==1){
			$tran_callback = $row->phone1.$row->phone2.$row->phone3;		/* 회신번호 "-" 없이 적어 주십시오 */

			$content=$smsText->content_admin;

			// 신규회원가입
			$content = str_replace("__{MEMBER}__", $row->name, $content);
			$content = str_replace("__{URL}__", $admin_stat->shop_domain, $content);
			$content = str_replace("__{COMPANY}__", $admin_stat->shop_name, $content);

			$tran_msg	  = $content;
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



	// 회원삭제후 메인으로...
	if( $db->delete("cs_member", "where userid='$row->userid'") ) { $tools->alertJavaGo("회원탈퇴 완료 되었습니다", "login_ok.php?logout=1"); }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
