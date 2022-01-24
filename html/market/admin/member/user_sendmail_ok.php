<?
include('../../common.php'); 
if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}
include($ROOT_DIR.'/lib/mail_class.php');
$mail = new my_mime_mail();
//$_POST=&$HTTP_POST_VARS;
$_FILES=&$HTTP_POST_FILES;

$admin_stat = $db->object("cs_admin", "");
if( !$tools->chkMail($_POST[tomail], 1)) { $tools->errMsg('정확한 이메일주소를 입력해주세요.');}
if( $_POST[tomail]) {
	$mail->to = $_POST[tomail];
	$mail->from = $admin_stat->shop_email;
	$mail->subject = $_POST[title];
	if($_POST[tag]==0) { $content = $tools->strHtmlNo($_POST[content]); } else if($_POST[tag]==1) {	$content = $tools->strHtml($_POST[content]);}
	$mail->body = $content;

	if($_FILES[add_file][size] > 0 ) {
		$mail->files[0]["file"] = $_FILES[add_file][tmp_name];
		$mail->files[0]["filename"] =  $_FILES[add_file][name];
		// 특정 파일 보낼때 기본은 일반파일	$mail->files[0]["filetype"] = 'application/octet-stream';
	}

	if($mail->send()) {
		@unlink($_FILES[add_file][tmp_name]);
		$tools->msgClose('메일을 발송했습니다');
	} else {
		@unlink($_FILES[add_file][tmp_name]);
		$tools->errMsg('메일을 보내지 못했습니다.\n\n다시 보내세요');
	}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
