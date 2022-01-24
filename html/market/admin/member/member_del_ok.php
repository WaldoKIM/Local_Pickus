<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

if($_GET[mem_data]) {
	$mv_data	= $_GET[mem_data];
	$mem_data	= $tools->decode( $_GET[mem_data] );
	// 넘어온 idx 로 삭제 레코드를 검색한다.
	$row = $db->object("cs_member", "where idx=$mem_data[idx]");
	// 포인트 삭제
	$db->delete("cs_point", "where userid='$row->userid'");
	if( $db->delete("cs_member", "where idx=$mem_data[idx]") ) { $tools->javaGo("member.php?mem_data=$mv_data"); }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
