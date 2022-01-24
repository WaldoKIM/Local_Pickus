<?
include('../../common.php'); 
//if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}

//$_POST=&$HTTP_POST_VARS;
// 약관 정보 입력
if($_POST[memberinfoadmin]) {	
	$_POST[memberinfoadmin] = $db->stripSlash($_POST[memberinfoadmin]);
	$_POST[memberinfoadmin] = $db->addSlash($_POST[memberinfoadmin]);
	// 디비 입력
	if( $db->cnt("cs_admin", "")) {If( $db->update("cs_admin", "memberinfoadmin='$_POST[memberinfoadmin]'")) { $tools->alertJavaGo("저장 완료 되었습니다.", "memberinfoadmin.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }} 
	else { if( $db->insert("cs_admin",  "agreement='$_POST[agreement]', agreement_tag='$_POST[agreement_tag]'") ) { $tools->alertJavaGo("저장 완료 되었습니다.", "memberinfoadmin.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
