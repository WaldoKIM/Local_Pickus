<?
include('../common.php');
include ('../class.sms.php');

$smsinfo = $db->object("cs_sms_setup", "");
$smsText = $db->object("cs_sms_text", "where code='memberjoin'");
$sms_server	= "211.172.232.124";	## SMS 서버 
$sms_id		= $smsinfo->smsid;				## icode 아이디
$sms_pw		= $smsinfo->smspw;				## icode 패스워드

$portcode	= 1;				## 정액제 : 2, 충전식 : 1

$SMS	= new SMS;
$SMS->SMS_con($sms_server,$sms_id,$sms_pw,$portcode);


//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
$_FILES=&$HTTP_POST_FILES;
$admin_stat = $db->object("cs_admin", "");
$arr_B = explode(",",$admin_stat->badid); 

// 한글 아이디 체크 및 중복검색
if( $tools->chkHan($_POST["userid"])) { $tools->alertJavaGo('한글아이디는 지원되지 않습니다.', 'joinform.php?code='.$_SESSION[CART].'&name='.$_POST[name].'&email='.$_POST[email]);} else { $userid_check = $db->cnt("cs_member", "where userid='$_POST[userid]'"); if( $userid_check ) { $tools->alertJavaGo('이미 사용중인 아이디 입니다.', 'joinform.php?code='.$_SESSION[CART].'&name='.$_POST[name].'&email='.$_POST[email]);}}
// 금지된 아이디 사용에 대한 검색
if(strlen(array_search(trim($_POST["userid"]), $arr_B)) > 0){
	$tools->errMsg('사용금지된 아이디 입니다.');
}

// 이메일 중복 검색
if( !$tools->chkMail($_POST["email"], 1)) { $tools->alertJavaGo('정확한 이메일주소를 입력해주세요.', 'joinform.php?code='.$_SESSION[CART].'&name='.$_POST[name].'&email='.$_POST[email]);} else { $mail_check = $db->cnt("cs_member", "where email='$_POST[email]'"); if( $mail_check ) { $tools->alertJavaGo('이미 사용중인 이메일주소 입니다.', 'joinform.php?code='.$_SESSION[CART].'&name='.$_POST[name].'&email='.$_POST[email]);}}

// 추천 회원 검색
if($_POST["recomid"]) {
	$recomid_check = $db->cnt("cs_member", "where userid='$_POST[recomid]'"); 
	if( !$recomid_check ) { $tools->alertJavaGo('추천한 회원이 없습니다. 정확한 아이디를 입력하세요.', 'joinform.php?code='.$_SESSION[CART].'&name='.$_POST[name].'&email='.$_POST[email]);}
}

if( $_POST["userid"] ) {	
	$admin_stat = $db->object("cs_admin", "", "point_register, member_check, member_invite, member_register, register_member, register_admin");

/*
	if($_POST[userid])	{$_POST[userid]		= $db->addSlash( $_POST[userid] );}
	if($_POST[name])	{$_POST[name]		= $db->addSlash( $_POST[name] );}
	if($_POST[email])	{$_POST[email]		= $db->addSlash( $_POST[email] );}
	if($_POST[add1])	{$_POST[add1]		= $db->addSlash( $_POST[add1] );}
	if($_POST[add2])	{$_POST[add2]		= $db->addSlash( $_POST[add2] );}
	if($_POST[content]) { $_POST[content] = $db->addSlash( $_POST[content] );}
*/

	// 회원 디비 입력
	if( $db->insert("cs_member", "userid='$_POST[userid]', passwd=PASSWORD('$_POST[passwd]'), birthy='$_POST[birthy]', birthm='$_POST[birthm]', birthd='$_POST[birthd]', name='$_POST[name]', email='$_POST[email]', tel1='$_POST[tel1]', tel2='$_POST[tel2]', tel3='$_POST[tel3]', phone1='$_POST[phone1]', phone2='$_POST[phone2]', phone3='$_POST[phone3]', zip='$_POST[zip]', add1='$_POST[add1]', add2='$_POST[add2]', recomid='$_POST[recomid]', content='$_POST[content]', level=1, mailing='$_POST[mailing]', dupinfo='$_POST[dupinfo]', coinfo1='$_POST[coinfo1]', coinfo2='$_POST[coinfo2]', ciupdate='$_POST[ciupdate]', checktype='$_POST[checktype]', register=now()") ) { 
		// 회원 가입 축하 포인트(비추천회원)
		$db->insert("cs_point", "userid='$_POST[userid]', title='신규회원가입축하금', point='$admin_stat->point_register', register=now()");
		// 회원 추천제
		if( $admin_stat->member_check && $recomid_check ) {
			// 가입회원이 추천하는  회원 포인트 추가
			$db->insert("cs_point", "userid='$_POST[recomid]', title='$_POST[userid] 께서 $_POST[recomid] 을 추천', point='$admin_stat->member_invite', register=now()");
			// 가입하는 회원이 회원을 추천했을 경우
			$db->insert("cs_point", "userid='$_POST[userid]', title='$_POST[recomid] 을 추천함', point='$admin_stat->member_register', register=now()");
		}

		// 회원 로그인 
		$member_stat = $db->object("cs_member", "where userid='$_POST[userid]'");
		$USERID		= $member_stat->userid;
		$NAME			= $member_stat->name;
		$EMAIL		= $member_stat->email;
		$PASSWD	= $member_stat->passwd;
		$LEVEL			= $member_stat->level;
		$db->update("cs_member", "connect=$member_stat->connect+1 where userid='$member_stat->userid'");

			$_SESSION["USERID"] = $USERID;
			$_SESSION["NAME"] = $NAME;
			$_SESSION["EMAIL"] = $EMAIL;
			$_SESSION["PASSWD"] = $PASSWD;
			$_SESSION["LEVEL"] = $LEVEL;
			$_SESSION["SNS"] = $SNS;			

		//문자 보내기
		if($smsText->smsm==1){
			$tran_callback = $smsinfo->smsinputnumber;		// 회신번호 "-" 없이 적어 주십시오

			$content=$smsText->content_member;

			// 신규회원가입
			$content = str_replace("__{MEMBER}__", $_POST[name], $content);
			$content = str_replace("__{URL}__", $admin_stat->shop_domain, $content);
			$content = str_replace("__{COMPANY}__", $admin_stat->shop_name, $content);

			$tran_msg = iconv("utf-8","euc-kr",$content);
			$tran_phone = $_POST[phone1].$_POST[phone2].$_POST[phone3];

			$SMS->Add($tran_phone,"$tran_callback","$sms_id","$tran_msg","");
		}
		if($smsText->smsa==1){
			$tran_callback = $_POST[phone1].$_POST[phone2].$_POST[phone3];		// 회신번호 "-" 없이 적어 주십시오 

			$content=$smsText->content_admin;

			// 신규회원가입
			$content = str_replace("__{MEMBER}__", $_POST[name], $content);
			$content = str_replace("__{URL}__", $admin_stat->shop_domain, $content);
			$content = str_replace("__{COMPANY}__", $admin_stat->shop_name, $content);

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


		// 회원에게 가입 메일 발송
		if( $admin_stat->register_member || $admin_stat->register_admin) {
			//메일 발송해야 됨
			$tools->javaGo('mail_to_register.php?mailform=1'); 
		} else {
			// 회원 가입완료
			$tools->alertJavaGo('회원 가입이 되었습니다.', 'index.php', 'joinform.php?code='.$_SESSION[CART].'&name='.$_POST[name].'&email='.$_POST[email]); 
		}

	} else {
		$tools->alertJavaGo('비상적으로 입력 되었습니다.', 'joinform.php?code='.$_SESSION[CART].'&name='.$_POST[name].'&email='.$_POST[email]);
	}

} else {
	$tools->alertJavaGo('경 고 !!!\n\n비정상적으로 접근했습니다.', 'joinform.php?code='.$_SESSION[CART].'&name='.$_POST[name].'&email='.$_POST[email]);
}
?>
