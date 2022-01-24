<?
include('../common.php');
$_GET=&$HTTP_GET_VARS;
$_POST=&$HTTP_POST_VARS;

// 변수 값
if( $_POST[userid] ) { $userid = $_POST[userid];}
if( $_POST[passwd] ) { $passwd = $_POST[passwd];}
if( $_POST[license] ) { $license = $_POST[license];}
if( $_POST[login]==1 ){
	$mem_check = $db->cnt("cs_admin", "where admin_userid='$userid' and admin_passwd='$passwd' and LEFT(sens_license, 4)='$license'");
	if( !$mem_check) {
		$tools->errMsg('정보가 올바르지 않습니다. 다시 확인하여 주세요. \n\n[라이센스정보는 대소문자 구분하여 주시기 바랍니다.]');
	} else {
		$admin_stat = $db->object("cs_admin", "where admin_userid='$userid' and admin_passwd='$passwd' and LEFT(sens_license, 4)='$license'");
		$ADMIN_USERID	= $admin_stat->admin_userid;
		$ADMIN_PASSWD	= $admin_stat->admin_passwd;
		$ADMIN_EMAIL	= $admin_stat->shop_email;
		$ADMIN_NAME		= "관리자";
		$_SESSION["ADMIN_USERID"] = $ADMIN_USERID;
		$_SESSION["ADMIN_PASSWD"] = $ADMIN_PASSWD;
		$_SESSION["ADMIN_EMAIL"] = $ADMIN_EMAIL;
		$_SESSION["ADMIN_NAME"] = $ADMIN_NAME;

		//다른곳에서 이동했다면 원래 상태로 돌려 보내준다.
		$tools->metaGo('./order/trade.php');
	}
}
?>
