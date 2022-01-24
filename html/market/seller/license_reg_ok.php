<?
include('../common.php'); 

$_POST=&$HTTP_POST_VARS;
	
// 디비입력 쿼리
$sql="sens_license='$_POST[shop_license]', trade_code='$_POST[trade_code]'";

// 디비입력
if( $db->cnt("cs_admin", "")) {
	if( $db->update("cs_admin", $sql) ) 
		$tools->alertMetaGo("정상적으로 등록 되었습니다. 다시 로그인 하여 주세요.","index.php");
	else
		$tools->errMsg('비상적으로 입력 되었습니다.'); 
} 
else 
{ 
	$tools->errMsg('솔루션이 설치가 되지 않았습니다. 확인하여 주세요.'); 
}
?>
