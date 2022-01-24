<?
include('../../common.php'); 
//admin 접근제어
//if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

if($_GET[idx]) {
	// 파일 삭제
	if( $db->delete("cs_mobile_main", "where idx=$_GET[idx]") ) { $tools->javaGo("content.php"); }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
