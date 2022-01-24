<?
//with KJS dance
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//include('../../common.php');
include('/var/www/html/market/common.php');

if ((!$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) && $_SESSION["LEVEL"] < 5) {
	$tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../../');
}

$shop_link = $db->object("cs_admin", "", "shop_domain, shop_name");
$admin_stat = $db->object("cs_admin", "");
$design_stat = $db->object("cs_design", "");

$fl_name = explode("/", $_SERVER["SCRIPT_NAME"]);
$arr_no = count($fl_name) - 2;

?>
<!DOCTYPE html>
<html lang="ko">

<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta http-equiv="Content-Script-Type" content="text/javascript">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, maximum-scale=1.0, minimum-scale=1.0">
	<title>『 <?= $shop_link->shop_name; ?> 판매관리』</title>
	<LINK REL="stylesheet" HREF="/market/seller/css/admin_style.css?after" TYPE="TEXT/CSS">
	<LINK REL="stylesheet" HREF="/market/seller/css/joinform_layout.css" TYPE="TEXT/CSS">
	<LINK REL="stylesheet" HREF="/market/seller/css/joinform_style.css" TYPE="TEXT/CSS">
	<LINK REL="stylesheet" HREF="/market/lib/oolim_button_style.css" TYPE="TEXT/CSS">
	<LINK REL="stylesheet" HREF="/market/seller/css/calendar_add_poll.css" TYPE="TEXT/CSS">


	<script type="text/javascript" src="/market/lib/jquery.min.js"></script>
	<script type="text/javascript" src="/market/lib/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/market/lib/jquery.lightbox.js"></script>
