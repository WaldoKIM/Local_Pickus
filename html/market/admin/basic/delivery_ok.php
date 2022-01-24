<?
include('../../common.php'); 
//$_POST=&$HTTP_POST_VARS;
// 결제 및 배송 정보
if( $_POST[delivery] ) {	
	//if($_POST[delivery]) {$_POST[delivery] = $db->stripSlash ( $_POST[delivery] );}
	//if($_POST[delivery]) {$_POST[delivery] = $db->addSlash ( $_POST[delivery] );}
	if($_POST[delivery_company]) {$_POST[delivery_company] = $db->addSlash ( $_POST[delivery_company] );}
	if( $db->cnt("cs_admin", "")) { if( $db->update("cs_admin", "delivery_company='$_POST[delivery_company]', delivery_url='$_POST[delivery_url]', delivery='$_POST[delivery]', delivery_tag='$_POST[delivery_tag]'")) { $tools->alertJavaGo("저장 완료 되었습니다.", "delivery.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }}
	else { if( $db->insert("cs_admin",  "delivery_company='$_POST[delivery_company]', delivery_url='$_POST[delivery_url]', delivery='$_POST[delivery]', delivery_tag='$_POST[delivery_tag]'") ) { $tools->alertJavaGo("저장 완료 되었습니다.", "delivery.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
