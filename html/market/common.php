<?php
//session_start();
header("Content-type: text/html;charset=UTF-8"); 

/*	
	if(count($HTTP_GET_VARS)) { 
		foreach($HTTP_GET_VARS as $key => $value) { 
		global ${$key}; 
		${$key} = $value; 
		} 
	} 

	if(count($HTTP_POST_VARS)) { 
		foreach($HTTP_POST_VARS as $key => $value) { 
		global ${$key}; 
		${$key} = $value; 
		} 
	} 

	if( $level && count($HTTP_COOKIE_VARS) ) { 
		foreach($HTTP_COOKIE_VARS as $key => $value) { 
		global ${$key}; 
		${$key} = $value; 
		} 
	} 

	if( $level && count($HTTP_SESSION_VARS) ) { 
		foreach($HTTP_SESSION_VARS as $key => $value) { 
		global ${$key}; 
		${$key} = $value; 
		} 
	} 

	if( $level && count($HTTP_SERVER_VARS) ) { 
		foreach($HTTP_SERVER_VARS as $key => $value) { 
		global ${$key}; 
		${$key} = $value; 
		} 
	} 
*/	
	@include("config.php");
	@include($ROOT_DIR.'/lib/basic_class.php');
	$db = new dbConnect($DB_HOST, $DB_NAME, $DB_USER, $DB_PWD);
	$tools = new tools();

	//���ǰ��� �α����� ����� ���� ������� �ֻ����� tempss ������ ���� ����Ȯ��/ ���ð��� �ø����� �ϽǶ� $lifttime = 60 * 60 * 1 <== 1(�ѽð�) �÷��ּ���.
	$_SESSION_LIFETIME = 60*60*1;
	//session_save_path($ROOT_DIR."/tempss"); 
	session_save_path("/var/www/html/data/session");
	ini_set("session.cache_expire", $_SESSION_LIFETIME); // ���� ��ȿ�ð� : �� 
	ini_set("session.gc_maxlifetime", $_SESSION_LIFETIME); // ���� ������ �÷���(�α��ν� �������� �ð�) : �� 
	set_time_limit(0);
	session_start();

	//�������
	//--------------- ��� �������� ��� (0 : �̻�� / 1 : ���)------------------
	$COMENTSIGN = 0;
	//���ȼ��� �����ϱ�
	$admin_stat = $db->object("cs_admin", "");
	//��Ų����
	$skin_url = str_replace($admin_stat->shop_domain,'', $admin_stat->shop_url);
	$skin_url = str_replace("/",'', $skin_url);
	$TempSubDir = explode("/",$admin_stat->shop_domain);
	for($i=1;$i<count($TempSubDir);$i++){
		$trueSubDir .= "/".$TempSubDir[$i];
	}

	$securityInfo = $db->object("cs_security_setup", "");
	$SECURITYDOMAIN = "";
	if($securityInfo->securityuse){

		//���� ������ ���� ����
		if($securityInfo->securityport){
			$SECURITYDOMAIN = "https://".$_SERVER["SERVER_NAME"].":".$securityInfo->securityport.$trueSubDir."/".$skin_url;
		}else{
			$SECURITYDOMAIN = "https://".$_SERVER["SERVER_NAME"].$trueSubDir."/".$skin_url;
		}


		//���ȼ��� ����� ������
		$SECURITYOUTDOMAIN = "http://".$_SERVER["SERVER_NAME"].$trueSubDir."/".$skin_url;
	}

	$MAXFILESIZE = 10;

	$IPINMODE = "T";	//T �׽�Ʈ, ����ԵǸ� ����μ������� ����

	//--------------- �߰��ʵ� �⺻����------------------
	$DEFAULTADDFIELD = 15;

	$jqcheck = array("","joinform.php","order.php","my_member_edit.php");

	$arr_browser = array ("iPhone","iPod","IEMobile","Mobile","lgtelecom","PPC"); 
	for($indexi = 0 ; $indexi < count($arr_browser) ; $indexi++) { 
		if(strpos($_SERVER['HTTP_USER_AGENT'],$arr_browser[$indexi]) == true){ 
			$mobiledivice = 1;
		} 
	} 
	define ("__MOBILE__",$mobiledivice);

	//��Ŀ�� ȸ�� ����
	if(!$_SESSION["USERID"]){
		if($_SESSION['ss_mb_id']){
			$userid = $_SESSION['ss_mb_id'];
			$member_cnt = $db->cnt("cs_member", "where userid='$userid'");
			
			if(!$member_cnt){ //��Ŀ�� ���� ȸ�� ���Ͽ� �߰�
				$member_repickus_cnt = $db->object("g5_member", "where mb_id='$userid'");
				$member_repickus = $db->object("g5_member", "where mb_id='$userid'");
				if($member_repickus_cnt && $member_repickus->mb_id){
					$db->insert(
						"cs_member", "userid='$member_repickus->mb_id', passwd='$member_repickus->mb_password', name='$member_repickus->mb_name', email='$member_repickus->mb_email', tel1='$member_repickus->mb_tel',
						phone1='$member_repickus->mb_hp', add1='$member_repickus->mb_addr1', add2='$member_repickus->mb_addr2', register = '$member_repickus->mb_datetime',
						bank='$member_repickus->mb_bank', account_num='$member_repickus->mb_bank_num'
					");
				}				
			}
			
			$member_stat = $db->object("cs_member", "where userid='$userid'");
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
		}		
	}else{
		if(!$_SESSION['ss_mb_id']){			
			$_SESSION["USERID"] = "";
			$_SESSION["NAME"] = "";
			$_SESSION["EMAIL"] = "";
			$_SESSION["PASSWD"] = "";
			$_SESSION["LEVEL"] = "";
		}
	}


?>
