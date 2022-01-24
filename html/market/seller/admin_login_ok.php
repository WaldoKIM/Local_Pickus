<?
session_start();
include('../common.php');
$_GET=&$HTTP_GET_VARS;
$_POST=&$HTTP_POST_VARS;
//$admin_stat=$db->object("cs_admin", "");
$admin_stat = $db->object("cs_admin", "where admin_userid='$_POST[admin_userid]' and admin_passwd='$_POST[admin_passwd]'");
if( $_GET[logout]==1) {
	@session_unregister("ADMIN_USERID")	or die("session_register err");
	@session_unregister("ADMIN_PASSWD")	or die("session_register err");
	@session_unregister("ADMIN_EMAIL")	or die("session_register err");
	@session_unregister("ADMIN_NAME")	or die("session_register err");
	$_SESSION["USERID"] = "";
	$_SESSION["NAME"] = "";
	$_SESSION["EMAIL"] = "";
	$_SESSION["PASSWD"] = "";
	$_SESSION["LEVEL"] = "";
	$tools->javaGo('../../');
} else {
	@session_unregister("ADMIN_USERID")	or die("session_register err");
	@session_unregister("ADMIN_PASSWD")	or die("session_register err");
	@session_unregister("ADMIN_EMAIL")	or die("session_register err");
	@session_unregister("ADMIN_NAME")	or die("session_register err");
	if($_POST[admin_userid] == $admin_stat->admin_userid && $_POST[admin_passwd] == $admin_stat->admin_passwd) {
		$ADMIN_USERID		= $admin_stat->admin_userid;
		$ADMIN_PASSWD	= $admin_stat->admin_passwd;
		$ADMIN_EMAIL		= $admin_stat->shop_email;
		$ADMIN_NAME		= "관리자";

		$_SESSION["ADMIN_USERID"] = $ADMIN_USERID;
		$_SESSION["ADMIN_PASSWD"] = $ADMIN_PASSWD;
		$_SESSION["ADMIN_EMAIL"] = $ADMIN_EMAIL;
		$_SESSION["ADMIN_NAME"] = $ADMIN_NAME;
		$tools->javaGo('./order/trade.php'); 
	} else {
		$tools->errMsg('관리자의 아이디와 패스워드가 올바르지 않습니다..');
	}
}
?>
<?
/*
include('../common.php');

if( $_GET[logout]==1) {
	$_SESSION["ADMIN_USERID"] = "";
	$_SESSION["ADMIN_PASSWD"] = "";
	$_SESSION["ADMIN_EMAIL"] = "";
	$_SESSION["ADMIN_NAME"] = "";
	$tools->javaGo('index.php');
}
*/
?>
