<?
include('../../common.php');
include($ROOT_DIR.'/lib/mail_class.php');
//$_POST=&$HTTP_POST_VARS;
$_FILES=&$HTTP_POST_FILES;


if( !$tools->chkMail($_POST[frommail], 1)) { $tools->errMsg('정확한 이메일주소를 입력해주세요.');}
if( $_POST[frommail]) {
	if($_POST[mailing] ==1) {
		$mail_result=$db->select('cs_member', 'where mailing=1', 'email');
	} else if($_POST[mailing] ==2) {
		$mail_result=$db->select('cs_member', '', 'email');
	}
	while( $mail_row=@mysqli_fetch_object($mail_result)) {
		$mail = new my_mime_mail();
		$mail->to = $mail_row->email;
		$mail->from = $_POST[frommail];	
		$mail->subject = $_POST[title];
		$content = $_POST[content];
		$mail->body = $content;
		if(!$mail->send()) {	$tools->msg($mail->to.'에게 메일을 보내지 못했습니다.\n\n계속 보냅니다.');}
	}
	$tools->alertJavaGo('그룹메일을 발송했습니다', 'groupmail.php');
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
