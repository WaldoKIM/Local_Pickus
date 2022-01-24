<?
include('../common.php');
//////$_GET=&$HTTP_GET_VARS;
//////$_POST=&$HTTP_POST_VARS;

// 변수 값
if( $_POST["userid"] ) { $userid = $_POST["userid"];} else if( $_GET["userid"] ) { $userid = $_GET["userid"];}
if( $_POST["passwd"] ) { $passwd = $_POST["passwd"];} else if( $_GET["passwd"] ) { $passwd = $_GET["passwd"];}

if( $_GET["logout"]==1) {
	$_SESSION["USERID"] = "";
	$_SESSION["NAME"] = "";
	$_SESSION["EMAIL"] = "";
	$_SESSION["PASSWD"] = "";
	$_SESSION["LEVEL"] = "";
	
	$tools->metaGo('index.php');
} else if( $_POST["login"] ==1 ){
	$mem_check = $db->cnt("cs_member", "where userid='$userid' and passwd=PASSWORD('$passwd')");
	if( !$mem_check) {
		$tools->errMsg('존재하지 않은 아이디이거나 \n\n비밀번호가 올바르지 않습니다.');
	} else {
		$member_stat = $db->object("cs_member", "where userid='$userid' and passwd=PASSWORD('$passwd')");
		
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

		//다른곳에서 이동했다면 원래 상태로 돌려 보내준다.
		if($_POST[login_go]) { $tools->metaGo($_POST[login_go]);} else {$tools->metaGo('index.php');}
	}
} else if( $_GET["relogin"] ==1 ){
	$_SESSION["USERID"] = "";
	$_SESSION["NAME"] = "";
	$_SESSION["EMAIL"] = "";
	$_SESSION["PASSWD"] = "";
	$_SESSION["LEVEL"] = "";
	$mem_check = $db->cnt("cs_member", "where userid='$userid'");
	if( !$mem_check) {
		$tools->errMsg('존재하지 않은 아이디이거나 \n\n비밀번호가 올바르지 않습니다.');
	} else {
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
		
		$tools->metaGo('index.php');
	}
}
?>
