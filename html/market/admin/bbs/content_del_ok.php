<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

if($_GET[idx]) {
	// 파일 삭제
	if( $db->delete("cs_bbs_sns", "where idx=$_GET[idx]") ) { $tools->javaGo("content.php"); }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
