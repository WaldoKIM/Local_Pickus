<?php
include('../common.php');

// with KJS dance
/*
if( (!$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) && $_SESSION["LEVEL"] !=5) { 
	$tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../');
}
*/
$shop_link = $db->object("cs_admin", "", "shop_domain, shop_name");
$admin_stat = $db->object("cs_admin", "");
$design_stat = $db->object("cs_design", "");

$fl_name = explode("/",$_SERVER["SCRIPT_NAME"]); 
$arr_no = count($fl_name)-2;

?>