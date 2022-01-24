<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
if($_GET[idx]) {
	if( $db->delete("cs_cash", "where idx=$_GET[idx]")) { $tools->metaGo("cash.php?userid=$_GET[userid]"); }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
