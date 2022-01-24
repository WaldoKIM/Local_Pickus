<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
if($_GET[tmp]) {
	// 임시 정보 삭제
	$db->delete("cs_cart", "where userid='' and TO_DAYS(register) < TO_DAYS(NOW())");					// 장바구니 삭제(어제까지의 정보를 삭제한다)
	$db->delete("cs_trade_tmp", "where TO_DAYS(register) < TO_DAYS(NOW())");		// 거래정보 삭제(어제까지의 정보를 삭제한다)
	$tools->javaGo("etc.php"); 
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
