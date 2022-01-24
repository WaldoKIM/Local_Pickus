<?
include('../../common.php'); 
//$_POST=&$HTTP_POST_VARS;
// 약관 정보 입력
if($_POST[agreement]) {	
	$_POST[agreement] = $db->stripSlash($_POST[agreement]);
	$_POST[agreement] = $db->addSlash($_POST[agreement]);
	// 디비 입력
	if( $db->cnt("cs_admin", "")) {If( $db->update("cs_admin", "agreement='$_POST[agreement]', agreement_tag='$_POST[agreement_tag]'")) { $tools->alertJavaGo("저장 완료 되었습니다.", "agreement.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }} 
	else { if( $db->insert("cs_admin",  "agreement='$_POST[agreement]', agreement_tag='$_POST[agreement_tag]'") ) { $tools->alertJavaGo("저장 완료 되었습니다.", "agreement.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
