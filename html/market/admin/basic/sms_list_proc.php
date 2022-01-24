<?
include('../../common.php'); 
//$_POST=&$HTTP_POST_VARS;
//$_GET=&$HTTP_GET_VARS;


if($_POST[mode]=="add"){
	$sql = "code='$_POST[code]', smsa='$_POST[smsa]', smsm='$_POST[smsm]', content_admin='$_POST[content_admin]', content_member='$_POST[content_member]', smsinfo='$_POST[smsinfo]'";
	// 디비 입력
	If( $db->insert("cs_sms_text", $sql)) { $tools->alertJavaGo("저장 완료 되었습니다.", "sms_list.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }
}elseif($_POST[mode]=="edit"){
	$sql = "code='$_POST[code]', smsa='$_POST[smsa]', smsm='$_POST[smsm]', content_admin='$_POST[content_admin]', content_member='$_POST[content_member]', smsinfo='$_POST[smsinfo]' where idx='$_POST[idx]'";
	// 디비 입력
	If( $db->update("cs_sms_text", $sql)) { $tools->alertJavaGo("수정 완료 되었습니다.", "sms_list.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }
}else{
	$sql = "where idx='$_GET[idx]'";
	// 디비 입력
	If( $db->delete("cs_sms_text", $sql)) { $tools->alertJavaGo("삭제 완료 되었습니다.", "sms_list.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }
}
?>
