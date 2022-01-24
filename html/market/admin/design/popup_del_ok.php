<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

if($_GET[idx]) {
	// 넘어온 idx 로 삭제 레코드를 검색한다.
	$row = $db->object("cs_popup", "where idx=$_GET[idx]");
	// 파일 삭제
	if( $row->popup_images) { @unlink("../../data/designImages/".$row->popup_images); }
	if( $db->delete("cs_popup", "where idx=$_GET[idx]") ) { $tools->javaGo("popup.php"); }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
