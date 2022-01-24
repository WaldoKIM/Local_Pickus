<?
include('../common.php');
include($ROOT_DIR.'/lib/mail_class.php');


// 관리자 정보
$admin_stat=$db->object("cs_admin", "");
// 메일폼 정보
$mailform1_stat	=	$db->object("cs_mailform", "where item=1");
$mailform2_stat	=	$db->object("cs_mailform", "where item=5");
// 회원 정보
$member_stat		=	$db->object("cs_member", "where userid='$_SESSION[USERID]'");
if($admin_stat->register_member) {
	$mail = new my_mime_mail();
	$content=$mailform1_stat->content;
	// 신규회원가입
	$content = str_replace("__USER_NAME__", $member_stat->name, $content);
	$content = str_replace("__USER_ID__", $member_stat->userid, $content);
	$content = str_replace("__USER_PASSWD__", $member_stat->passwd, $content);
	$content = str_replace("__USER_JUMIN__", $member_stat->jumin1."-*******", $content);
	$content = str_replace("__USER_EMAIL__", $member_stat->email, $content);
	$content = str_replace("__USER_TEL__", $member_stat->tel1."-".$member_stat->tel2."-".$member_stat->tel3, $content);
	$content = str_replace("__USER_ADDRESS__", "(".$member_stat->zip1."-".$member_stat->zip2.")&nbsp;&nbsp;".$member_stat->add1."&nbsp;".$member_stat->add2, $content);
	// 상품주문
/*	$content = str_replace("__ORDER_NAME__","주문자 이름", $content);
	$content = str_replace("__TRADE_CODE__","주문 코드", $content);
	$content = str_replace("__TRADE_GOODS_NAME__","상품 이름", $content);
	$content = str_replace("__TRADE_GOODS_NUMBER__","상품 수량", $content);
	$content = str_replace("__TRADE_METHOD__","결제 방법", $content);
	$content = str_replace("__TRADE_METHOD_INFO__","결제 정보", $content);
	$content = str_replace("__TRADE_PRICE__","결제 금액", $content);
	$content = str_replace("__TRADE_DAY__","주문일", $content);
	$content = str_replace("__TRADE_MONEY_OK__","결제일", $content);
	$content = str_replace("__TRADE_COMPANY__","배송회사", $content);
	$content = str_replace("__TRADE_NUMBER__","배송번호", $content);
	$content = str_replace("__DELIV_NAME__","받을 사람이름", $content);
	$content = str_replace("__DELIV_TEL__","받을 사람 전화번호", $content);
	$content = str_replace("__DELIV_ADDRESS__","받을 주소", $content);
*/
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
	if($admin_stat->register_admin) {
		if(!$mail->send()) { $tools->msg('신규 회원가입 메일을 보내지 못했습니다.\n\n로그인 하셔서 회원 정보를 확인해 보세요');}
	} else {
		if($mail->send()) { $tools->javaGo('index.php');} else { $tools->alertJavaGo('신규 회원가입 메일을 보내지 못했습니다.\n\n로그인 하셔서 회원 정보를 확인해 보세요', 'index.php');}
	}
}
if($admin_stat->register_admin) {
	$mail = new my_mime_mail();
	if($mailform2_stat->tag) { $content=$tools->strHtml($mailform2_stat->content);} else { $content=$tools->strHtmlNo($mailform2_stat->content);}
	// 신규회원가입
	$content = str_replace("__USER_NAME__", $member_stat->name, $content);
	$content = str_replace("__USER_ID__", $member_stat->userid, $content);
	$content = str_replace("__USER_PASSWD__", $member_stat->passwd, $content);
	$content = str_replace("__USER_JUMIN__", $member_stat->jumin1."-*******", $content);
	$content = str_replace("__USER_EMAIL__", $member_stat->email, $content);
	$content = str_replace("__USER_TEL__", $member_stat->tel1."-".$member_stat->tel2."-".$member_stat->tel3, $content);
	$content = str_replace("__USER_ADDRESS__", "(".$member_stat->zip1."-".$member_stat->zip2.")&nbsp;&nbsp;".$member_stat->add1."&nbsp;".$member_stat->add2, $content);
	// 상품주문
/*	$content = str_replace("__ORDER_NAME__","주문자 이름", $content);
	$content = str_replace("__TRADE_CODE__","주문 코드", $content);
	$content = str_replace("__TRADE_GOODS_NAME__","상품 이름", $content);
	$content = str_replace("__TRADE_GOODS_NUMBER__","상품 수량", $content);
	$content = str_replace("__TRADE_METHOD__","결제 방법", $content);
	$content = str_replace("__TRADE_METHOD_INFO__","결제 정보", $content);
	$content = str_replace("__TRADE_PRICE__","결제 금액", $content);
	$content = str_replace("__TRADE_DAY__","주문일", $content);
	$content = str_replace("__TRADE_MONEY_OK__","결제일", $content);
	$content = str_replace("__TRADE_COMPANY__","배송회사", $content);
	$content = str_replace("__TRADE_NUMBER__","배송번호", $content);
	$content = str_replace("__DELIV_NAME__","받을 사람이름", $content);
	$content = str_replace("__DELIV_TEL__","받을 사람 전화번호", $content);
	$content = str_replace("__DELIV_ADDRESS__","받을 주소", $content);
*/
	// 쇼핑몰 기본 정보
	$content = str_replace("__SHOP_NAME__", $admin_stat->shop_name, $content);
	$content = str_replace("__SHOP_DOMAIN__", $admin_stat->shop_domain, $content);
	$content = str_replace("__SHOP_CEO__", $admin_stat->shop_ceo, $content);
	$content = str_replace("__SHOP_TEL__", $admin_stat->shop_tel1, $content);
	$content = str_replace("__SHOP_EMAIL__", $admin_stat->shop_email, $content);
	$content = str_replace("__SHOP_ADDRESS__", $admin_stat->shop_address, $content);
	$content = str_replace("__MAILFORM_IMAGES_URL__",$admin_stat->shop_url, $content);
	// 제목에 대한 치완
	$title= $mailform2_stat->title;
	$title = str_replace("__USER_NAME__", $member_stat->name, $title);
	$title = str_replace("__SHOP_NAME__", $admin_stat->shop_name, $title);
	// 회원가입 메일
	$mail->to = $admin_stat->shop_email;
	$mail->from = $member_stat->email;
	$mail->subject = $title;
	$mail->body = $content;
	$mail->send();
	$tools->javaGo('index.php');
}
?>