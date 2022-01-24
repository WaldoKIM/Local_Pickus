<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

if($_GET[idx]) {
	$info = $db->object("cs_page", "where idx='$_POST[idx]'");
	if( $info->title_img) { @unlink("../../data/designImages/".$row->title_img); }
	if( $db->delete("cs_page", "where idx=$_GET[idx]") ) { $tools->javaGo("page.php"); }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
