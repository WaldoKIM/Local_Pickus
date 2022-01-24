<?
include('../common.php');
$_POST=&$HTTP_POST_VARS;

if($DB_HOST==$_POST[host] && $DB_USER==$_POST[user] && $DB_PWD==$_POST[passwd] && $DB_NAME==$_POST[name]){
	if($db->update("cs_admin", "admin_userid='admin', admin_passwd='admin'")){
		$tools->msgClose("ID : admin  PW : admin");
	}
}else{
	$tools->errMsg('DB정보를 확인하여 주세요.');
}

?>
