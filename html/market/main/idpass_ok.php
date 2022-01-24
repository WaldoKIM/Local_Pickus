<?
include('../common.php');
include($ROOT_DIR.'/lib/mail_class.php');
//$_POST=&$HTTP_POST_VARS;
$mail = new my_mime_mail();
$admin_stat = $db->object("cs_admin", "");

if( !$db->cnt("cs_member", "where name='$_POST[name]' and email='$_POST[email]'")) { $tools->errMsg('정확한 회원정보를 입력해주세요');}
$member_stat = $db->object("cs_member", "where name='$_POST[name]' and email='$_POST[email]'");
$newPasss = rand(1000, 9999);
$db->update("cs_member", "passwd=PASSWORD('$newPasss') where name='$_POST[name]' and email='$_POST[email]'");

// 메일폼 정보
$mailform1_stat	=	$db->object("cs_mailform", "where item=10");
$content=$mailform1_stat->content;

// 신규회원가입
$content = str_replace("__USER_NAME__", $member_stat->name, $content);
$content = str_replace("__USER_ID__", $member_stat->userid, $content);
$content = str_replace("__USER_PASSWD__", $newPasss, $content);
$content = str_replace("__USER_EMAIL__", $member_stat->email, $content);
$content = str_replace("__USER_TEL__", $member_stat->tel1."-".$member_stat->tel2."-".$member_stat->tel3, $content);
$content = str_replace("__USER_ADDRESS__", "(".$member_stat->zip1."-".$member_stat->zip2.")&nbsp;&nbsp;".$member_stat->add1."&nbsp;".$member_stat->add2, $content);
		
// 쇼핑몰 기본 정보
$content = str_replace("__SHOP_NAME__", $admin_stat->shop_name, $content);
$content = str_replace("__SHOP_DOMAIN__", $admin_stat->shop_domain, $content);
$content = str_replace("__SHOP_CEO__", $admin_stat->shop_ceo, $content);
$content = str_replace("__SHOP_TEL__", $admin_stat->shop_tel1, $content);
$content = str_replace("__SHOP_EMAIL__", $admin_stat->shop_email, $content);
$content = str_replace("__SHOP_ADDRESS__", $admin_stat->shop_address, $content);
$content = str_replace("__MAILFORM_IMAGES_URL__",$admin_stat->shop_url, $content);

// 제목에 대한 치완
$title= $mailform1_stat->title;
$title = str_replace("__USER_NAME__", $member_stat->name, $title);
$title = str_replace("__SHOP_NAME__", $admin_stat->shop_name, $title);

// 회원가입 메일
$mail->to = $member_stat->email;
$mail->from = $admin_stat->shop_email;
$mail->subject = $title;
$mail->body = $content;

if($mail->send()) {
	$tools->errMsg('임시 비밀번호를 해당 메일로 발송해 드렸습니다.\n\n정보수정에서 비밀번호를 변경하여 주세요.');
} else {
	$tools->errMsg('메일을 보내지 못했습니다.\n\n다시 보내세요');
}
?>
