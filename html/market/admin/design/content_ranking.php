<?
include('../../common.php'); 
//if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
$_FILES=&$HTTP_POST_FILES;

//분류정리
for($j=0;$j<sizeof($_POST[ranking]);$j++) {
	$db->update("cs_mobile_main", "ranking='".$_POST[ranking][$j]."' where idx='".$_POST[idx][$j]."'");
} 
$tools->javaGo("content.php");
?>
